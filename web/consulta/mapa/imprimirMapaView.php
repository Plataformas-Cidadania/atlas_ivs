<?php
    ob_start();
    //header('Content-Type: text/html; charset=utf-8');
?>

<script type="text/javascript">
    $(document).ready(function() 
    {
        $('#m_leg_title').html(lang_mng.getString("mapa_leg").toUpperCase());
        $('#img_lg_idhm').attr("src",lang_mng.getString("mapa_idh_img"));
        javascript:self.print();
    });
</script>

<style type="text/css"> 
    
  .map-title-print 
  {
    line-height: 16pt;
    position: relative;
    float: left;
    font-size: 16pt;
    font-family: Passion One;
    width: 590px;
    padding: 0px;
    margin: 0px;
    border: 0px;
  }
  
  .data_impressao
  {
     
    position: relative;
    /*float: right;*/
    padding: 0px;
    margin: 0px;
    border: 0px;
  }
  
</style>

<hr/>
<span class="map-title-print"><?php echo $_POST["p_ano"]; ?> - <?php echo $_POST["p_indicador"]; ?></span>
<span class="data_impressao"> <?php echo date("d/m/Y"); ?> </span>        
<?php if(strlen($_POST["p_indicador"]) > 45){ echo "<br/>";/*echo "<br/><br/>";*/ } ?>
<br/>
<hr/>

<div style="position:relative; float: left;  top:0px; left:0px; padding: 0px; margin: 0px; border: 0px;">
<!--<div style="position:relative;  top:0px; left:0px; padding: 0px; margin: 0px; border: 0px;">
    <img style="position:relative; left:150px;" src="<?php //echo $_POST["p_map"]; ?>" />-->
    <img style="position:relative; left:0px; height:355px; width:510px;" src="<?php echo $_POST["p_map"]; ?>" />
    <div style="position:absolute; top:0; left:0;">
         <img style="position:relative; left:150px; <?php if( $_POST["p_selection"] == ""){ echo "display:none;"; } ?>"  src="<?php echo $_POST["p_selection"]; ?>" />
    </div> 
</div>

<div style="position: relative; float: left; margin-left: 5px; height: 150px; " ><!-- margin-left: 150px; -->
    <span id="m_leg_title" style="font-weight: bold; margin-left: 5px;"> </span><br/>
    <img src="<?php echo $_POST["p_legend"]; ?>"  /> 
</div>

<!--
<div style="position: relative; float: right; margin-right: 150px;" >
<span  style="<?php //if( $_POST["p_selection"] == ""){ echo "display:none;"; } ?> position: relative; float: right;" >
    <span style="font-weight: bold;">  <?php //echo $_POST["p_title" ]; ?>: </span> 
    <span style="font-weight: bold; color: #00ADEE;">  <?php //echo $_POST["p_nome_local"]; ?> </span>
</span> <br/>
<div style="<?php //if( $_POST["p_selection"] == ""){ echo "display:none;"; } ?> position: relative; float: right; background-color: white; height: 125px; width: 120px;">
    <table style="position: absolute; left:10px; top: 0px; width: 100px; border:0px; margin:0px; padding: 0px;"> 
        <tbody>
                <tr>
                   <td> 
                       <img id="img_lg_idhm" src="" alt="" /> 
                   </td>
                   <td id="miniperfil_idh" style="height: 32px; width: 32px; border:0px; margin:0px; padding: 0px; vertical-align: middle; text-align:center;">
                      <?php //echo $_POST["p_value_idh"]; ?>
                   </td>
                 </tr>

                 <tr>
                     <td style="height: 32px; width: 32px; border:0px; margin:0px; padding: 0px;"> 
                         <img style="height: 32px; width: 32px;" src="assets/img/map/idh_longevidade.png" alt="Longevidade" /> 
                     </td>

                     <td id="miniperfil_longevidade" style="height: 32px; width: 32px; border:0px; margin:0px; padding: 0px; vertical-align: middle; text-align:center;">
                         <?php //echo $_POST["p_value_longevidade"]; ?>
                     </td>
                 </tr>

                 <tr>
                     <td style="height: 32px; width: 32px; border:0px; margin:0px; padding: 0px;" > 
                          <img style="height: 32px; width: 32px;" src="assets/img/map/idh_renda.png" alt="Renda" /> 
                     </td>

                     <td id="miniperfil_renda" style="border:0; height: 32px; width: 32px; border:0px; margin:0px; padding: 0px; vertical-align: middle; text-align:center;">
                         <?php //echo $_POST["p_value_renda"]; ?>
                     </td>
                 </tr>

                 <tr>
                     <td style="height: 32px; width: 32px; border:0px; margin:0px; padding: 0px;"> 
                          <img style="height: 32px; width: 32px;" src="assets/img/map/idh_educacao.png" alt="Educação"/> 
                     </td>

                     <td id="miniperfil_educacao" style="height: 32px; width: 32px; border:0px; margin:0px; padding: 0px; vertical-align: middle; text-align:center;">
                         <?php //echo $_POST["p_value_educacao"]; ?>
                     </td>
                 </tr>
            </tbody>  
    </table>
</div>
</div>
-->
    
<?php
    $title = 'Impressão do Mapa';
    $title_print = 'Mapa';
    $content = ob_get_contents();
    ob_end_clean();
    include "base.php";
?>

