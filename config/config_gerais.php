<?php

/*
 * Config gerais.
 * 
 * @author AtlasBrasil
 */


require_once 'config_path.php';

/* =========================================================================
  CONFIGURAÇÃO BANNER
  ========================================================================== */

/* Imagens Banner Top */
$home_ImgBannerTop = array(
    $path_dir . 'assets/img/home/banner/des4.jpg', // 1º Imagem
    $path_dir . 'assets/img/home/banner/des1.jpg', // 2º Imagem
    $path_dir . 'assets/img/home/banner/des2.jpg', // 3º Imagem
    $path_dir . 'assets/img/home/banner/des3.jpg', // 4º Imagem
);

/* Links Banner Top */
$home_LinkBannerTop = array(
    '#myModal', // 1º Link
    'destaques/faixas_idhm', // 2º Link
    'destaques/longevidade', // 3º Link
    'destaques/destaque3', // 4º Link
);

/* =========================================================================
  CONFIGURAÇÃO FOOTER
  ========================================================================== */
//Perguntas Frequentes
$home_perguntasFrequentes = 'o_atlas/perguntas_frequentes';

//Links Redes Sociais PNUD
$home_FooterFacebook = 'https://www.facebook.com/IPEA1964?ref=ts&fref=ts';    // Link Facebook
$home_FooterGooglePlus = 'https://plus.google.com/+agenciaipea';                              // Link Google Plus
$home_FooterTwitter = 'https://twitter.com/ipeaonline';                             // Link Twitter
$home_FooterYoutube = 'https://www.youtube.com/user/agenciaipea';               //Link Youtube

$home_footerPNUD = 'http://www.pnud.org.br/';                     //Link PNUD
$home_footerFJP = 'http://www.fjp.mg.gov.br/';                   //Link Fundação João Pinheiro
$home_footerIPEA = 'http://www.ipea.gov.br/portal/';              //Link IPEA
$home_footerSae = 'http://www.sae.gov.br/';                //Link Sae
$home_footerGovernoFederal = 'http://www.brasil.gov.br/';                  //Link Governo Federal

//Caminho dos arquivos de dados brutos para download
$downloadDadosBrutos = array(
    "pt" => "dadosbrutos/atlas2013_dadosbrutos_pt.xlsx",
    "es" => "data/rawData/atlas2013_datosbrutos_es.xlsx",
    "en" => "data/rawData/atlas2013_rawdata_en.xlsx"
);

//Configuração para exibir a troca de idiomas
define("LINKS_IDIOMAS", "pt|en|es"); /*HABILITA OS IDIOMAS*/
/*define("LINKS_IDIOMAS", false);*/ /*DESABILITA OS IDIOMAS*/

//Caminho para o mapas IPEA
define("URL_MAPAS_IPEA", "$dominio/");

//Navegadores bloqueados
//$NavegadoresBloqueados = array("Firefox" => 6, "Safari" => 4);
$NavegadoresBloqueadosGERAL = array("IE" => 8, "Firefox" => 6, "Opera" => 12, "Safari" => 4);

/**
 * Configurações de mapas
 * verifica se é um servidor Linux ou Windows
 */
if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
    //NÃO ALTERE AQUI ESSA É A VERSÃO WINDOWS!!
    define("MAP_FILE_ZERO", BASE_ROOT . "com/mobiliti/map/zero.map");
    define("MAP_FILE_SELECTION", BASE_ROOT . "com/mobiliti/map/selection.map");
    define("MAP_IMG_PATH", "/ms4w/apps/$base/tmp/");
    define("MAP_IMG_URL", "/$base/tmp/");
} else {
    define("MAP_FILE_ZERO", "/var/www/$base/com/mobiliti/map/zero.map");
    define("MAP_FILE_SELECTION", "/var/www/$base/com/mobiliti/map/selection.map");
    define("MAP_IMG_PATH", "/var/www/$base/tmp/");
    define("MAP_IMG_URL", "/$base/tmp/");
}

define("MAP_DELTA_X", 8);
define("MAP_HIGHLIGHT_COLOR_RED", 255);
define("MAP_HIGHLIGHT_COLOR_GREEN", 255);
define("MAP_HIGHLIGHT_COLOR_BLUE", 255);

define("EXIBIR_ALERTA_DOWNLOAD", "true");

define("MOBILITI_PACKAGE", BASE_ROOT . "com/mobiliti/");
define("PERFIL_PACKAGE", BASE_ROOT . "system/modules/perfil/");

//Arquivo contendo TODA a base de indicadores (caminho completo, pois poderá estar em outro servidor)
//    define("BASE_COMPLETA_XLS_PT","dadosbrutos/atlas2013_dados_brutos_pt.xls");
//	define("BASE_COMPLETA_XLS","dadosbrutos/atlas2013_dados_brutos_pt.xls");
//define("BASE_COMPLETA_XLS","https://dl.dropboxusercontent.com/u/26443338/altas2013_dados_brutos.xls");
define("BASE_COMPLETA_CSV", "https://dl.dropboxusercontent.com/u/104022554/relatorio.csv");

//Arquivo template para exportar tabelas em XLS (caminho a partir da base)
define("TEMPLATE_XLS", "");


//Limitador de exibição de resultados na tabela, default = 10
define("LIMITE_EXIBICAO_TABELA", 6000);

//IDH dos indicadores do IDH
define("INDICADOR_IDH", 196);
define("INDICADOR_LONGEVIDADE", 198);
define("INDICADOR_RENDA", 197);
define("INDICADOR_EDUCACAO", 199);


define("JS_LIMITE_TELA", 113000);
define("JS_LIMITE_DOWN", 112000);



define("QUINTIL_COLORS", "{\"colors\":[\"#c5d9e7\",\"#92b8d3\",\"#6699c2\",\"#337eae\",\"#005f9d\"]}");
define("BORDA_ESTADO", "#999999");
define("BORDA_CIDADE", "#cccccc");

#Arquivos para download dos dados brutos
//    define("DADOS_BRUTOS_pt", "atlas2013_dadosbrutos_pt.xlsx");
//    define("DADOS_BRUTOS_es", "atlas2013_datosbrutos_es.xlsx");
//    define("DADOS_BRUTOS_en", "atlas2013_rawdata_en.xlsx");

// não é aqui que se habilitam os menus principais - se mexer aqui eles somem mas causam problemas nas consultas

define("HOME_HAS_LANG", "pt|en|es");
define("ATLAS_HAS_LANG", "pt|en|es");
define("DESTAQUE_HAS_LANG", "pt|en|es");
define("PERFIL_HAS_LANG", "pt|en|es");
define("CONSULTA_HAS_LANG", "pt|en|es");
define("MAPA_HAS_LANG", "pt|en|es");
define("ARVORE_HAS_LANG", "pt|en|es");
define("GRAFICO_HAS_LANG", "");
define("RANKING_HAS_LANG", "pt|en|es");
define("DONWLOAD_HAS_LANG", "pt|en|es");
define("PROSPERIDADE_HAS_LANG", "pt|en|es");
define("HIDE_INTER", true);



/*
 * Define o formato que lê as config do mapa.
 * 
 * @example XML, JSON ou PHP.
 */
define('CONFIG_MAP_TYPE', 'JSON');

/*
 * Define o arquivo leitor de config do mapa.
 * 
 */
define('CONFIG_MAP_FILE', BASE_ROOT . '/config/config_map.json');

/*
 * Define a quantidade máxima de espacialidades
 *
 */
define('MAX_ESPACIALIDADES_AGREGACAO', 200);
