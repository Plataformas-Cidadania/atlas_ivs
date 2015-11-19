<?php
    ob_start(); 
    $url = str_replace(strrchr($_SERVER["REQUEST_URI"], "?"), "", $_SERVER["REQUEST_URI"]);
    $separator = explode("/",$_GET["cod"]);
    require_once '../system/modules/consulta_prosperidade/controller/Prosperidade.class.php';

    if($separator[0] == "pt" || $separator[0] == "en" || $separator[0] == "es")
    {
        array_shift ($separator);
    }
    $espacialidade = "";
    $prosp = new Prosperidade($pagNext2);

    if($separator[2] != "") { 
        $gets = explode("/", $_SERVER ['REQUEST_URI']);
        if ($separator[1] == "municipios") {
            $espacialidade = "Município: ";
        }
        elseif ($separator[1] == "estados") {
            $espacialidade = "Estado: ";   
        }
        elseif ($separator[1] == "rm") {
            $espacialidade = "Região Metropolitana: ";   
        }
        elseif ($separator[1] == "udh") {
            $espacialidade = "Unidade de Desenvolvimento Humano: ";
        }
        $prosp = new Prosperidade($pagNext2,$pagNext);
    }
    
?>

<script type="text/javascript">
    var baseUrl = "pt/prosperidade/";
    var storedName = "";

    $(document).ready(function() {
        inputHandler.add($('#perfil_search_municipio'), 'buscaHome', 2, "", false, getNomeMunUF);
        inputHandler.add($('#perfil_search_rm'), 'buscaPerfilRM', 6, "", false, getNomeMunUFRM);
        inputHandler.add($("#perfil_search_uf"), 'buscaPerfilUF', 4, "", false, getNomeMunUFUF)
        inputHandler.add($("#perfil_search_udh"), 'buscaPerfilUDH', 5, "", false, getNomeMunUFUDH)

        // seleciona o input correto
        /*$(".buscaHome li a[rel^='perfil-']").click(function(e){
            e.preventDefault();
            $(".buscaHome li a[rel^='perfil-']").removeClass("ativo");
            $(this).addClass("ativo");
            var idBusca = $(this).attr('rel');
            $('.perfil-search-main_home').hide();
            $('.perfil-search-main_home.'+idBusca).show()
        });*/
    });

    function getNomeMunUF(nome) {
        storedName = retira_acentos(nome);
        buscaPerfil();
    }

    function buscaPerfil() {
        if ($("#buscaHome").attr("i") != 0)
            RedirectSearch(storedName, "municipios/");
        else if (storedName == "") {
            document.getElementById('home_erroBusca').style.display = "block";
        }

    }
    
    function getNomeMunUFUF(nome) {
        storedName = retira_acentos(nome);
        buscaPerfilUF();
    }

    function buscaPerfilUF() {
        if($("#buscaPerfilUF").attr("i") != 0) {
            RedirectSearch(storedName, "estados/");
        } else if(storedName == "") {
            document.getElementById("setaMenu").style.display = 'block';
        }
    }

    function getNomeMunUFRM(nome) {
        storedName = retira_acentos(nome);
        buscaPerfilRM();
    }

    function buscaPerfilRM() {
        if($("#buscaPerfilRM").attr("i") != 0) {
            RedirectSearch(storedName, "regiao-metropolitana/");
        } else if(storedName == "") {
            document.getElementById("setaMenu").style.display = 'block';
        }
    }

    function getNomeMunUFUDH(nome) {
        storedName = retira_acentos(nome);
        buscaPerfilUDH();
    }

    function buscaPerfilUDH() {
        if($("#buscaPerfilUDH").attr("i") != 0) {
            RedirectSearch(storedName, "udh/");
        } else if(storedName == "") {
            document.getElementById("setaMenu").style.display = 'block';
        }
    }

    function RedirectSearch(nome, perfilType) {
        window.location = baseUrl + perfilType + retira_acentos(nome);
    }

</script>

<script type="text/javascript">
    function myfunction(valor){
       lang = '<?=$_SESSION["lang"]?>';
        pag = '<?=$path_dir?>' + lang + '/prosperidade/';

        if(valor == 1){
            /*url = pag + "atlas_municipio/";*/
            url = pag + "municipios/";
        }

        else if(valor == 2){
            /*url = pag + "atlas_regiao_metropolitana/";*/
            url = pag + "estados/";
        }
        
        else if(valor == 3){
            /*url = pag + "atlas_regiao_metropolitana/";*/
            url = pag + "regiao-metropolitana/";
        }

        else if(valor == 4){
            /*url = pag + "atlas_regiao_metropolitana/";*/
            url = pag + "udh/";
        }
        
        location.href= url;
    }
</script>

<div class="contentPages">
    <div class="containerPage">
        <div class="containerTitlePage">
            <div class="titlePage">
                <div class="titletopPage" id="">Prosperidade Social</div>
            </div>
        </div>  
        <!--<div class="menuAtlas">
            <ul class="menuAtlasUl" style="margin-left: 19px">
                <li><a id="prosperidade_menuMunicipal" onclick="myfunction('1')" 
                    <?php if($separator[1] == 'Municipal' || $separator[0] == '') {echo 'class="ativo2"'; } ?>></a><span class='ballMarker'>&bull;</span></li>
                <li><a id="prosperidade_menuEstadual" onclick="myfunction('2')" 
                    <?php if($separator[1] == 'Estadual') {echo 'class="ativo2"'; } ?>></a><span class='ballMarker'>&bull;</span></li>
                <li><a id="prosperidade_menuRM" onclick="myfunction('3')" 
                    <?php if($separator[1] == 'RegiaoMetropolitana') {echo 'class="ativo2"';}?> ></a><span class='ballMarker'>&bull;</span></li>
                <li><a id="prosperidade_menuUDH" onclick="myfunction('4')" 
                    <?php if($separator[1] == 'UDH') {echo 'class="ativo2"';}?> ></a><span class='ballMarker'></span></li>
            </ul>
        </div>-->
        <div class="linhaDivisoria"></div>
        <br />
        <div class="row nh-busca-perfil">
            <div class="span12">
            <?php if (buscaPerfil_has_lang(@$_SESSION["lang"])) {     #Só irá aparecer a caixa de busca do perfil para as linguagens setadas
            ?>
            <!-- ========================== PERFIL ====================================== --> 
                <div class="containerPerfil nh-containerPerfil">
                    <div class="contentPerfil">
                        <div class="contentTitlePefil">
                            <div class="titulo_divs">
                                <div class="h1Home nh-h1Home" id="home_titlePerfil"></div>
                                <span id="home_textoPerfil" style="font-size:27px;">Consulte a <span class="destaque_azul">Prosperidade Social</span> da sua localidade</span>
                            </div>
                        </div>

                        <div class="buscaHome">
                            <div id="home_erroBusca" class="erro_BuscaHome"></div>
                            <div class="nh-perfil-busca">
                                <ul>
                                <li><a onclick="myfunction('1')" rel="perfil-municipio" <?php if($separator[1] == 'municipios' || $separator[1] == '') {echo 'class="ativo"'; } ?> ><?php echo $lang_mng->getString('home_busca_municipio')?></a></li>
                                    <li><a onclick="myfunction('2')" rel="perfil-uf" <?php if($separator[1] == 'estados') {echo 'class="ativo"'; } ?> ><?php echo $lang_mng->getString('home_busca_estado')?></a></li>
                                    <li><a onclick="myfunction('3')" rel="perfil-rm" <?php if($separator[1] == 'regiao-metropolitana') {echo 'class="ativo"'; } ?> ><?php echo $lang_mng->getString('home_busca_rm')?></a></li>
                                    <li><a onclick="myfunction('4')" rel="perfil-udh" <?php if($separator[1] == 'udh') {echo 'class="ativo"'; } ?> ><?php echo $lang_mng->getString('home_busca_udh')?></a></li>
                                </ul>
                            </div>
                            <div class="perfil-search-main_home nh-perfil-search-main_home perfil-busca perfil-municipio"  id="perfil_search_municipio" <?php if($separator[1] == 'municipios' || $separator[1] == '') {echo 'style="display:block;"';} else {echo 'style="display:none;"';} ?> >
                                <a onclick="buscaPerfil()" id="busca"><button id="home_buttonBusca" title="" type="button" name="" value="" class="blue_button big_bt"  style=" padding:5px 15px; margin-top: 18px; margin-right: 10px; float: right">Busca</button></a>
                            </div>

                            <div class="perfil-search-main_home nh-perfil-search-main_home perfil-busca perfil-uf"  id="perfil_search_uf" <?php if($separator[1] == 'estados') {echo 'style="display:block;"';} else {echo 'style="display:none;"';} ?> >
                                <button id="busca" onclick="buscaPerfilUF()" title="" type="button" name="" value="" class="blue_button big_bt"  style=" padding:5px 15px; margin-top: 18px; margin-right: 10px; float: right">Busca</button>
                            </div>

                            <div class="perfil-search-main_home nh-perfil-search-main_home perfil-busca perfil-rm"  id="perfil_search_rm" <?php if($separator[1] == 'regiao-metropolitana') {echo 'style="display:block;"';} else {echo 'style="display:none;"';} ?> >
                                <button id="busca" onclick="buscaPerfilRM()" title="" type="button" name="" value="" class="blue_button big_bt"  style=" padding:5px 15px; margin-top: 18px; margin-right: 10px; float: right">Busca</button>
                            </div>

                            <div class="perfil-search-main_home nh-perfil-search-main_home perfil-busca perfil-udh"  id="perfil_search_udh" <?php if($separator[1] == 'udh') {echo 'style="display:block;"';} else {echo 'style="display:none;"';} ?> >
                                <button id="busca" onclick="buscaPerfilUDH()" title="" type="button" name="" value="" class="blue_button big_bt"  style=" padding:5px 15px; margin-top: 18px; margin-right: 10px; float: right">Busca</button>
                            </div>

                        </div>
                        <p style="margin-left: 250px;" id="home_exemploBusca"></p>
                    </div> <!-- /contentPerfil -->
                </div> <!-- /containerPerfil -->
                <?php } ?>
            </div> <!-- /span12 -->
        </div>
        <?php
            if($separator[2] != "") {
            ?>
            <div class="calculo_prosperidade">
                <h2><?php echo ($prosp->getCityName()); ?></h2>
                <span class="container"><div>IDHM</div><div class="caixa"><?php echo $prosp->idh  ?></div></span>
                <span class="adendo">X</span>
                <span class="container"><div>IVS</div><div class="caixa"><?php echo $prosp->ivs ?></div></span>
                <span class="adendo">=</span>
                <span class="container"><div>Prosperidade Social</div><div class="caixa" style="width: 200px;"> 
                <?php 
                $cprosperidade = "";
                $ivs = $prosp->ivs;
                $idh = $prosp->idh;
                $civs = 0;
                $cidh = 0;
	                if($ivs <= 0.2) {
	                	$civs = 1;
	                }
	                elseif($ivs <= 0.3) {
	                	$civs = 2;
	                }
	            	elseif($ivs <= 0.4) {
	                	$civs = 3;
	                }
	                elseif($ivs <= 0.5) {
	                	$civs = 4;
	                }
	                else {
	                	$civs = 5;
	                }
	                if($idh < 0.5) {
	                	$cidh = 5;
	                }
	                elseif($idh < 0.6) {
	                	$cidh = 4;
	                }
	                elseif($idh < 0.7) {
	                	$cidh = 3;
	                }
	                elseif($idh < 0.8) {
	                	$cidh = 2;
	                }
	                else {
	                	$cidh = 1;
	                }
	                if(($cidh <= 2) && ($civs <= 2)) {
	                	$cprosperidade = "Muito Alta";
	                }
	                elseif((($cidh <= 2) && ($civs <= 3)) || (($cidh <= 3) && ($civs <= 2))) {
	                	$cprosperidade = "Alta";
	                }
	                elseif((($cidh <= 5) && ($civs <= 2)) || (($cidh <= 2) && ($civs <= 5)) || (($cidh <= 3) && ($civs <= 3))  ) {
	                	$cprosperidade = "Média";
	                }
	                elseif((($cidh <= 5) && ($civs <= 3)) || (($cidh <= 3) && ($civs <= 5))) {
	                	$cprosperidade = "Baixa";
	                }
	                else {
	                	$cprosperidade = "Muito Baixa";
	                }
	                echo $cprosperidade;
                ?></div>
                </span>
            </div>
        <?php } ?>
        <h3><span class="destaque_azul">O QUE É A PROSPERIDADE SOCIAL?</span></h3>
        <p>A análise integrada do Desenvolvimento Humano com a Vulnerabilidade Social oferece o que se denomina aqui de <span class="destaque_azul">Prosperidade Social</span>, a ocorrência simultânea do <em>alto</em> Desenvolvimento Humano com a <em>baixa</em> Vulnerabilidade Social, sugerindo que nas porções do território onde ela se verifica, ocorre uma trajetória de desenvolvimento humano menos vulnerável e socialmente mais próspera. </p>
        <p>A Prosperidade Social, nesse sentido, reflete uma situação em que o desenvolvimento humano se assenta em bases sociais mais robustas, onde o capital familiar e escolar, as con-dições de inserção no mundo do trabalho e as condições de moradia e de acesso à infraes-trutura urbana da população são tais que há uma perspectiva de prosperidade não apenas econômica, mas das condições de vida no meio social. </p>

        <div id="conteudo_atlas">
            <?php
                if($separator[1] == 'municipios' || $separator[1] == ''){
                    include 'prosperidade/'.$_SESSION["lang"].'/prosperidadeMunicipios.php';
                }
                else if($separator[1] == 'estados'){
                    include 'prosperidade/'.$_SESSION["lang"].'/prosperidadeEstados.php';
                }
                else if($separator[1] == 'regiao-metropolitana'){
                    include 'prosperidade/'.$_SESSION["lang"].'/prosperidadeRM.php';
                }
                else if($separator[1] == 'udh'){
                    include 'prosperidade/'.$_SESSION["lang"].'/prosperidadeUDH.php';
                }
            ?>
        </div>
    </div>
    
    <input type="button" class="voltarTopo" onclick="$j('html,body').animate({scrollTop: $('#voltarTopo').offset().top}, 2000);" value="<?php echo $lang_mng->getString("voltarTopo")?>">
</div>

<script type="text/javascript">
//     $(".voltarTopo").html(lang_var.getString("voltarTopo"));;
     $("#prosperidade_menuMunicipal").html(lang_mng.getString("prosperidade_menuMunicipal"));
     $("#prosperidade_menuEstadual").html(lang_mng.getString("prosperidade_menuEstadual"));
     $("#prosperidade_menuRM").html(lang_mng.getString("prosperidade_menuRM"));
     $("#prosperidade_menuUDH").html(lang_mng.getString("prosperidade_menuUDH"));
</script>
<?php
    $title = $lang_mng->getString("atlas_title");
    $meta_title = $lang_mng->getString("atlas_metaTitle");
    $meta_description = $lang_mng->getString("atlas_metaDescricao");
    $content = ob_get_contents();
    ob_end_clean();
    include "base.php";
?>
