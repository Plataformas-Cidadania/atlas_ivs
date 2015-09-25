<?php
    $url = str_replace(strrchr($_SERVER["REQUEST_URI"], "?"), "", $_SERVER["REQUEST_URI"]);
    $separator = explode("/",$_GET["cod"]);
    
    if($separator[0] == "pt" || $separator[0] == "en" || $separator[0] == "es")
    {
        array_shift ( $separator );
    } 

?>

<script type="text/javascript">
    function myfunction2(valor){//só para redirecionar
        lang = '<?=$_SESSION["lang"]?>';
        pag = '<?=$path_dir?>' + lang + '/o_atlas/metodologia/';

        if(valor == 1){
            url = pag + "calculo-do-ivs/";
            /*url = pag + "calculo-do-idhm-e-seus-subindices/";*/
        }

        else if(valor == 2){
            url = pag + "ivs_dados/";
            
        }

        else if(valor == 3){
            url = pag + "ivs_renda/";
        }

        else if(valor == 4){
            url = pag + "construcao-das-unidades-de-desenvolvimento-humano/";
        }
        
        location.href= url;
    }
</script>

<div id="processo" style="width:900px;">
    <div class="areatitle" id='atlas_Metodologia'></div>
    
    <div class="menuAtlasMet">
        <ul class="menuAtlasMetUl">
                <li>
                    <a id="atlas_menuIvsDados" onclick="myfunction2('1')" 
                <?php if($separator[2] == 'ivs_dados' || $separator[0] == '') {echo 'class="ativo2"'; } ?>> IVS </a>
                <span class='ballMarker'>&bull;</span>
                </li>              
                <li><a id="atlas_menuProsperidade" onclick="myfunction2('3')" 
                <?php if($separator[2] == 'prosperidade' || $separator[0] == '') {echo 'class="ativo2"'; } ?>>Prosperidade</a><!--<span class='ballMarker'>&bull;</span>--></li>
            <!--<li><a id="atlas_menuIvs" onclick="myfunction2('2')" 
                <?php if($separator[2] == 'idhm_educacao') {echo 'class="ativo2"';}?> >IVS EDUCAÇÃO</a><span class='ballMarker'>&bull;</span></li>
            <li><a id="atlas_menuIvs" onclick="myfunction2('3')" 
                <?php if($separator[2] == 'idhm_renda') {echo 'class="ativo2"';} ?> >IVS RENDA</a></li>
                <li>
                    <a id="atlas_aba_2" onclick="myfunction2('4')" 
                <?php if($separator[2] == 'construcao-das-unidades-de-desenvolvimento-humano') {echo 'class="ativo2"';}?> >IDHM EDUCAÇÃO</a>
                <!-- <span class='ballMarker'>&bull;</span> -->
                <!--</li>-->
        </ul>
    </div>
    <div class="linhaDivisoriaMet"></div>
    
    <?php
                if($separator[2] == 'ivs_dados' || $separator[1] == ''){
                    include 'o_atlas/'.$_SESSION["lang"].'/ivsDadosView.php';
                }

                else if($separator[2] == 'calculo-do-ivs'){
                    include 'o_atlas/'.$_SESSION["lang"].'/ivsCalculoView.php';
                }
                
                else if($separator[2] == 'prosperidade'){
                    include 'o_atlas/'.$_SESSION["lang"].'/prosperidadeMetView.php';
                }
                
                /*else if($separator[2] == 'idhm_renda'){
                    include 'o_atlas/'.$_SESSION["lang"].'/idhmRendaView.php';
                }*/

                else {
                    include 'o_atlas/'.$_SESSION["lang"].'/ivsDadosView.php';
                }
            ?>
</div>

<script type="text/javascript">
    $("#atlas_Metodologia").html(lang_mng.getString("atlas_Metodologia"));
    $("#atlas_aba_1").html(lang_mng.getString("atlas_metodologia_aba_1"));
    $("#atlas_aba_2").html(lang_mng.getString("atlas_metodologia_aba_2"));
    /*$("#atlas_menuIdhmEducacao").html(lang_mng.getString("atlas_menuIdhmEducacao"));
    $("#atlas_menuIdhmRenda").html(lang_mng.getString("atlas_menuIdhmRenda"));*/
</script>