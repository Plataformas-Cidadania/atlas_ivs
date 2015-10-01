<?php
$comPath = BASE_ROOT . "/system/modules/consulta_prosperidade/";
require_once BASE_ROOT . 'config/config_path.php';
require_once BASE_ROOT . 'config/config_gerais.php';
require_once $comPath . "model/bd.class.php";
//require_once $comPath . "util/protect_sql_injection.php";

//require_once PERFIL_PACKAGE . "controller/PerfilBuilder.class.php";

define("PATH_DIRETORIO", $path_dir);

/**
 * Description of Perfil
 *
 * @author Andre Castro (versão 2)
 * 
 * Adaptado por Gabriel Fonseca
 */
class Prosperidade extends bd {

    private $UrlNome;
    private $UrlUf;
    private $UrlCod;
    public $nome;
    private $uf;
    private $ufCru;
    private $id;
    private $estado;
    private $nomeCru;
    private $data = array();
    private $locale;
    private $tipo_rm;
    private $perfilType;
    private $nome_mun;
    private $nome_rm;
    private $lat;
    private $long;
    public $ivs;
    public $idh;

    public function getNomeCru() {
        if ($this->uf != null)
            return $this->nome . ", " . strtoupper($this->uf);
        else
            return $this->nome;
    }

    public function __construct($municipio, $perfilType = null) {
        parent::__construct();
//        if ($municipio == null || $municipio == "") {
//            
//        }
        $gets = explode("/", $_SERVER ['REQUEST_URI']);

        if ($perfilType != null)
            $this->perfilType = $perfilType;
        else
            $this->perfilType = @$gets[3];

        $divisao = explode('_', $this->retira_acentos($municipio));
        $this->nomeCru = $divisao[0];
        //$stringTratada = cidade_anti_sql_injection(str_replace('-', ' ', $divisao[0]));
        $stringTratada = str_replace('-', ' ', $divisao[0]);
        $this->UrlNome = $stringTratada;

        if (sizeof($divisao) > 1) {
            $this->ufCru = $divisao[1];
            //$stringUfTratada = cidade_anti_sql_injection(str_replace('-', ' ', $divisao[1]));
            $stringUfTratada = str_replace('-', ' ', $divisao[1]);
            $this->UrlUf = $stringUfTratada;
        }

        if (is_numeric($divisao[0]))
            $this->UrlCod = $divisao[0];
        else
            $this->UrlCod = 0;

		
        if (@$gets[3] == "municipios" || $perfilType == "municipios")
            $this->read();
        else if (@$gets[3] == "regiao-metropolitana" || $perfilType == "regiao-metropolitana")
            $this->readRM();
        else if (@$gets[3] == "estados" || $perfilType == "estados")
            $this->readUF();
        else if (@$gets[3] == "udh" || $perfilType == "udh")
            $this->readUDH();

//        else if (@$gets[3] == "perfil_rm" || $perfilType == "perfil_rm" || @$gets[3] == "perfil_udh" || $perfilType == "perfil_udh" )
//            echo "<script type='text/javascript'>alert('Este perfil ainda não se encontra disponível!');</script>";
    }

    private function retira_acentos($texto) {
        $array1 = array("á", "à", "â", "ã", "ä", "é", "è", "ê", "ë", "í", "ì", "î", "ï", "ó", "ò", "ô", "õ", "ö", "ú", "ù", "û", "ü", "ç"
            , "Á", "À", "Â", "Ã", "Ä", "É", "È", "Ê", "Ë", "Í", "Ì", "Î", "Ï", "Ó", "Ò", "Ô", "Õ", "Ö", "Ú", "Ù", "Û", "Ü", "Ç");
        $array2 = array("a", "a", "a", "a", "a", "e", "e", "e", "e", "i", "i", "i", "i", "o", "o", "o", "o", "o", "u", "u", "u", "u", "c"
            , "A", "A", "A", "A", "A", "E", "E", "E", "E", "I", "I", "I", "I", "O", "O", "O", "O", "O", "U", "U", "U", "U", "C");
        return str_replace($array1, $array2, $texto);
    }

    public function __destruct() {
        parent::__destruct();
    }

    //ORDERNAÇÂO ARRAY POR CAMPO
    private function orderMultiDimensionalArray($toOrderArray, $field, $inverse = false) {
        $position = array();
        $newRow = array();
        foreach ($toOrderArray as $key => $row) {
            $position[$key] = $row[$field];
            $newRow[$key] = $row;
        }
        if ($inverse) {
            arsort($position);
        } else {
            asort($position);
        }
        $returnArray = array();
        foreach ($position as $key => $pos) {
            $returnArray[] = $newRow[$key];
        }
        return $returnArray;
    }
    
    
    private function read() {

        $SQL = "SELECT municipio.nome, municipio.id, v1.valor, v1.fk_variavel FROM municipio
                    INNER JOIN valor_variavel_mun AS v1 ON v1.fk_municipio=municipio.id
                    WHERE (v1.valor IS NOT NULL AND (v1.fk_variavel=196 OR v1.fk_variavel=1) AND v1.fk_ano_referencia=3) AND
                     ( sem_acento(municipio.nome) ILIKE '{$this->UrlNome}' ) OR"
                . " municipio.id = {$this->UrlCod} OR"
                . " municipio.geocodmun = {$this->UrlCod} OR"
                . " municipio.geocodmun6 = {$this->UrlCod}";


        if ($this->UrlCod != null || $this->UrlCod == 0) {
            $results = parent::ExecutarSQL($SQL);

            if (sizeof($results) > 0) {
                $this->nome = $results[0]["nome"];
                $this->id = $results[0]["id"];
                if($results[0]["fk_variavel"] == "196" || $results[0]["fk_variavel"] == 196) {
                    $this->idh = $results[0]["valor"];
                    $this->ivs = $results[1]["valor"];
                }
                elseif($results[0]["fk_variavel"] == "1" || $results[0]["fk_variavel"] == 1) {
                    $this->idh = $results[1]["valor"];   
                    $this->ivs = $results[0]["valor"];
                }
            }
        }
    }

    private function readRM() {

        $SQL = "SELECT rm.nome, rm.id, tipo_rm, v1.valor, v1.fk_variavel FROM rm
                INNER JOIN valor_variavel_rm AS v1 ON v1.fk_rm=rm.id                  
                    WHERE (v1.valor IS NOT NULL AND (v1.fk_variavel=196 OR v1.fk_variavel=1) AND v1.fk_ano_referencia=3) AND (sem_acento(rm.nome) ILIKE '{$this->UrlNome}' OR rm.id = {$this->UrlCod} OR
                rm.cod_rmatlas ILIKE '{$this->UrlCod}')";

        if ($this->UrlCod != null || $this->UrlCod == 0) {
            $results = parent::ExecutarSQL($SQL);

            //if ($results[0]["id"] == 2 || $results[0]["id"]  == 16){//@#TEMPORARIO
            if (sizeof($results) > 0) {
                $this->nome = $results[0]["nome"];
                //$this->uf = $results[0]["uf"];
                $this->uf = "";
                $this->id = $results[0]["id"];
                //$this->estado = $results[0]["nomeestado"];
                $this->estado = "";
                $this->tipo_rm = $results[0]["tipo_rm"];
                if($results[0]["fk_variavel"] == "196" || $results[0]["fk_variavel"] == 196) {
                    $this->idh = $results[0]["valor"];
                    $this->ivs = $results[1]["valor"];
                }
                elseif($results[0]["fk_variavel"] == "1" || $results[0]["fk_variavel"] == 1) {
                    $this->idh = $results[1]["valor"];   
                    $this->ivs = $results[0]["valor"];
                }
            }
        }
    }

    private function readUF() {

        $SQL = "SELECT estado.nome, estado.id, v1.valor, v1.fk_variavel FROM estado
        INNER JOIN valor_variavel_estado AS v1 ON v1.fk_estado=estado.id
                    WHERE (v1.valor IS NOT NULL AND (v1.fk_variavel=196 OR v1.fk_variavel=1) AND v1.fk_ano_referencia=3) AND sem_acento(nome) ILIKE '{$this->UrlNome}'";
//                . "estado.id = {$this->UrlCod} OR "

        if ($this->UrlCod != null || $this->UrlCod == 0) {
            $results = parent::ExecutarSQL($SQL);

            if (sizeof($results) > 0) {
                $this->nome = $results[0]["nome"];
                //$this->uf = $results[0]["uf"];
                $this->uf = "";
                $this->id = $results[0]["id"];
                //$this->estado = $results[0]["nome"];
                $this->estado = "";
                if($results[0]["fk_variavel"] == "196" || $results[0]["fk_variavel"] == 196) {
                    $this->idh = $results[0]["valor"];
                    $this->ivs = $results[1]["valor"];
                }
                elseif($results[0]["fk_variavel"] == "1" || $results[0]["fk_variavel"] == 1) {
                    $this->idh = $results[1]["valor"];   
                    $this->ivs = $results[0]["valor"];
                }
            }
        }
    }

    private function readUDH() {

        $SQL = "SELECT udh.nome, udh.id, v1.valor, v1.fk_variavel FROM udh
                    INNER JOIN valor_variavel_udh AS v1 ON v1.fk_udh=udh.id
                    WHERE (v1.valor IS NOT NULL AND (v1.fk_variavel=196 OR v1.fk_variavel=1) AND v1.fk_ano_referencia=3) AND ( sem_acento(udh.nome) ILIKE '{$this->UrlNome}'  OR "
                . " udh.id = {$this->UrlCod} OR"
                . " udh.cod_udhatlas ILIKE '{$this->UrlCod}')";

        if ($this->UrlCod != null || $this->UrlCod == 0) {
            $results = parent::ExecutarSQL($SQL);

            if (sizeof($results) > 0) {
                $this->nome = $results[0]["nome"];
                $this->id = $results[0]["id"];
                if($results[0]["fk_variavel"] == "196" || $results[0]["fk_variavel"] == 196) {
                    $this->idh = $results[0]["valor"];
                    $this->ivs = $results[1]["valor"];
                }
                elseif($results[0]["fk_variavel"] == "1" || $results[0]["fk_variavel"] == 1) {
                    $this->idh = $results[1]["valor"];   
                    $this->ivs = $results[0]["valor"];
                }
            }
        }
    }

    public function getCityId() {
        return $this->id;
    }

    public function getCityName() {
        return $this->nome;
    }

    public function getUfName() {
        return $this->uf;
    }

    
}
?>
