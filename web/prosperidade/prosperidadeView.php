<?php
    ob_start(); 
    $url = str_replace(strrchr($_SERVER["REQUEST_URI"], "?"), "", $_SERVER["REQUEST_URI"]);
    $separator = explode("/",$_GET["cod"]);
    

    if($separator[0] == "pt" || $separator[0] == "en" || $separator[0] == "es")
    {
        array_shift ($separator);
    }
    
?>

<script type="text/javascript">
    function myfunction(valor){
       lang = '<?=$_SESSION["lang"]?>';
        pag = '<?=$path_dir?>' + lang + '/o_atlas/prosperidade-social/';

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
         <div class="menuAtlas">
            <ul class="menuAtlasUl" style="margin-left: 19px">
                <li><a id="atlas_menuAtlasProsperidadeMunicipal" onclick="myfunction2('1')" 
                    <?php if($separator[2] == 'Municipal' || $separator[0] == '') {echo 'class="ativo2"'; } ?>></a><span class='ballMarker'>&bull;</span></li>
                <li><a id="atlas_menuAtlasProsperidadeEstadual" onclick="myfunction2('2')" 
                    <?php if($separator[2] == 'Estadual' || $separator[0] == '') {echo 'class="ativo2"'; } ?>></a><span class='ballMarker'>&bull;</span></li>
                <li><a id="atlas_menuAtlasProsperidadeRegiaoMetropolitana" onclick="myfunction2('3')" 
                    <?php if($separator[2] == 'RegiaoMetropolitana') {echo 'class="ativo2"';}?> ></a><span class='ballMarker'></span></li>
                <li><a id="atlas_menuAtlasProsperidadeUDH" onclick="myfunction2('4')" 
                    <?php if($separator[2] == 'RegiaoMetropolitana') {echo 'class="ativo2"';}?> ></a><span class='ballMarker'></span></li>
            </ul>
        </div>
        <div class="linhaDivisoria"></div>
        
        <p>A análise integrada do Desenvolvimento Humano com a Vulnerabilidade Social oferece o que se denomina aqui de Prosperidade Social, a ocorrência simultâ¬nea do alto Desenvolvimento Humano com a baixa Vulnerabilidade Social, sugerindo que nas porções do território onde ela se verifica, ocorre uma trajetória de desenvolvimento humano menos vulnerável e socialmente mais próspera. </p>
        <p>A Prosperidade Social, nesse sentido, reflete uma situação em que o desenvolvimento humano se assenta em bases sociais mais robustas, onde o capital familiar e escolar, as con-dições de inserção no mundo do trabalho e as condições de moradia e de acesso à infraes-trutura urbana da população são tais que há uma perspectiva de prosperidade não apenas econômica, mas das condições de vida no meio social. </p>

        <div id="conteudo_atlas">
            <?php
                if($separator[2] == 'municipios' || $separator[1] == ''){
                    include 'prosperidade/'.$_SESSION["lang"].'/prosperidadeMunicipios.php';
                }
                else if($separator[2] == 'estados'){
                    include 'prosperidade/'.$_SESSION["lang"].'/prosperidadeEstados.php';
                }
                else if($separator[2] == 'regiao-metropolitana'){
                    include 'prosperidade/'.$_SESSION["lang"].'/prosperidadeRM.php';
                }
                else if($separator[2] == 'udh'){
                    include 'prosperidade/'.$_SESSION["lang"].'/prosperidadeUDH.php';
                }
                else {
                    include 'prosperidade/'.$_SESSION["lang"].'/prosperidadeMunicipios.php';
                }
            ?>
        </div>
    </div>
    
    <input type="button" class="voltarTopo" onclick="$j('html,body').animate({scrollTop: $('#voltarTopo').offset().top}, 2000);" value="<?php echo $lang_mng->getString("voltarTopo")?>">
</div>

<script type="text/javascript">
//     $(".voltarTopo").html(lang_var.getString("voltarTopo"));;
     $("#atlas_titleOAtlas").html(lang_mng.getString("atlas_titleOAtlas"));
     $("#atlas_menuOAtlas").html(lang_mng.getString("atlas_menuOAtlas"));
     $("#atlas_menuQuemFaz").html(lang_mng.getString("atlas_menuQuemFaz"));
     $("#atlas_menuParaQue").html(lang_mng.getString("atlas_menuParaQue"));
     $("#atlas_menuProcesso").html(lang_mng.getString("atlas_menuProcesso"));
     $("#atlas_menuVulnerabilidadeSocial").html(lang_mng.getString("atlas_menuVulnerabilidadeSocial"));
     $("#atlas_menuIvs").html(lang_mng.getString("atlas_menuIvs"));
     $("#atlas_menuIvs").html(lang_mng.getString("atlas_menuProsperidade"));
     $("#atlas_menuMetodologia").html(lang_mng.getString("atlas_menuMetodologia"));
     $("#atlas_menuGlossario").html(lang_mng.getString("atlas_menuGlossario"));
     $("#atlas_menuFAQ").html(lang_mng.getString("atlas_menuFAQ"));
     $("#atlas_menututorial").html(lang_mng.getString("atlas_menututorial"));
</script>
<?php
    $title = $lang_mng->getString("atlas_title");
    $meta_title = $lang_mng->getString("atlas_metaTitle");
    $meta_description = $lang_mng->getString("atlas_metaDescricao");
    $content = ob_get_contents();
    ob_end_clean();
    include "base.php";
?>
