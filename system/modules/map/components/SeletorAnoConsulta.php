<!-- seletor ano -->
<?php
// busca por ano padrão
$ano_padrao = true;

if (isset($_REQUEST['ano'])) {
    if ($_REQUEST['ano'] == 1) {
        $ano = 1;
    }
    if ($_REQUEST['ano'] == 2) {
        $ano = 2;
    }
    if ($_REQUEST['ano'] == 3) {
        $ano = 3;
    }

    $ano_padrao = false;
}

if (defined('ANO_PADRAO') && $ano_padrao) {
    if (ANO_PADRAO == 1) {
        $ano = 1;
    }
    if (ANO_PADRAO == 2) {
        $ano = 2;
    }
    if (ANO_PADRAO == 3) {
        $ano = 3;
    }
}
?>

<div id="seletor_ano" style="top: 10px;">
    <span id="ano_1"
          <?php echo ($ano == 1) ? 'class="ano_atual"' : ''; ?>>1991</span>
    <span id="ano_2"
          <?php echo ($ano == 2) ? 'class="ano_atual"' : ''; ?>>2000</span>
    <span id="ano_3"
          <?php echo ($ano == 3) ? 'class="ano_atual"' : ''; ?>>2010</span>
</div>
<!-- /seletor ano -->

<!-- aviso 1991 (rm e udh) -->
<div id="aviso_1991" class="alert" style="position:absolute; top: 15px; left: 450px; display: none; padding: 10px; height: auto;">
    <button type="button" class="close">&times;</button>
    <?php echo $lang_mng->getString('mp_aviso_sem_dados_rm_udh_1991'); ?>
</div>
<!-- aviso 1991 (rm e udh) -->


<script type="text/javascript">
    $(document).ready(function () {
        $('#aviso_1991 .close').click(function () {
            $(this).parent().hide();
        });
        
<?php
if (isset($_REQUEST['ano'])) {
    echo "MAPA_API.setAno('" . $_REQUEST['ano'] . "');\n";

    if (($_REQUEST['ano'] == 1) && (isset($_REQUEST['espacialidade']) 
            && ($_REQUEST['espacialidade'] == 5 || $_REQUEST['espacialidade'] == 6))) {
        echo "MAPA_API.mostraAviso1991(true);\n";
    }
}
?>
        $("#seletor_ano span").on("click", function () {
            var espacialidade, indicador;
            var ano = $(this).attr('id').replace(/^ano_/g, '');
            
            MAPA_API.setAno(ano);
            
            // reset ano anterior
            $('#seletor_ano span').removeClass('ano_atual');

            $('#aviso_1991').hide();

            // ano atual no seletor
            $(this).addClass('ano_atual');

            espacialidade   = MAPA_API.getEspacialidade();
            indicador       = MAPA_API.getIndicador();

            if (GMaps.testaDados1991(espacialidade, indicador, ano)) {
                MAPA_API.mostraAviso1991(true);
            } else {               
                $('#mapa_personalizado').data('ano_sel', ano); // ano atual
                mapaPersonalizado(true, true);
            }
        });
    });
</script>