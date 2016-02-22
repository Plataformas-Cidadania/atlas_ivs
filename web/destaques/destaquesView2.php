<?php
    ob_start();
    $url = str_replace(strrchr($_SERVER["REQUEST_URI"], "?"), "", $_SERVER["REQUEST_URI"]);
    $separator = explode("/", $_GET["cod"]);


    if ($separator[0] == "pt" || $separator[0] == "en" || $separator[0] == "es") {
        array_shift($separator);
    }
?>

<script type="text/javascript">
    function myfunction(valor) {
        lang = '<?= $_SESSION["lang"] ?>';
        pag = '<?= $path_dir ?>' + lang + '/destaques/';

        if (valor == 1) {
            url = pag + "metodologia/";
           /* url = pag + "regioes-metropolitanas-alto-indice-desenvolvimento-humano/";*/
        }

        else if (valor == 2) {
            url = pag + "regioes-metropolitanas-avancam-desenvolvimento-humano-reduzem-disparidades/";
            /*url = pag + "faixas_idhm/";*/
        }

        else if (valor == 3) {
            url = pag + "regioes-metropolitanas-alto-indice-desenvolvimento-humano/";
            /*url = pag + "idhm_brasil/";*/
        }

        else if (valor == 4) {
            url = pag + "educacao/";
        }

        else if (valor == 5) {
            url = pag + "longevidade/";
        }

        else if (valor == 6) {
            url = pag + "renda/";
        }

        else if(valor == 7){
            url = pag + "idhmBrasil/";
        }

        location.href = url;
    }
</script>

<div class="contentPages">
    <div class="containerPage">
        <div class="containerTitlePage">
            <div class="titlePage">
                <div id='destaques_title' class="titletopPage"></div>
            </div>
        </div>   
        <!-- <div class="menuAtlas" > -->
            <ul class="menuAtlasUl" >
                <!-- <li><a id='destaques_metodologia' onclick="myfunction('1')" style="font-size:13px;" 
                    <?php
                    if ($separator[1] == 'metodologia' || $separator[1] == '')
                        echo 'class="ativo2"';
                    ?>></a><span class='ballMarker'>&bull;</span>
                </li> -->
               <!--  <li><a id='destaques_faixas_idhm' onclick="myfunction('2')" style="font-size:13px;" 
                    <?php
                    if ($separator[1] == 'faixas_idhm')
                        echo 'class="ativo2"';
                    ?> ></a><span class='ballMarker'>&bull;</span>
                </li> -->
                <!-- <li><a id='destaques_idhmBrasil' onclick="myfunction('3')" style="font-size:13px;" 
                    <?php
                    if ($separator[1] == 'idhm_brasil')
                        echo 'class="ativo2"';
                    ?> ></a><span class='ballMarker'>&bull;</span>
                </li> -->
               <!--  <li><a id='destaques_educacao' onclick="myfunction('4')" style="font-size:13px;" 
                    <?php
                    if ($separator[1] == 'educacao')
                        echo 'class="ativo2"';
                    ?> ></a><span class='ballMarker'>&bull;</span>
                </li> -->
                <!-- <li><a id='destaques_longevidade' onclick="myfunction('5')" style="font-size:13px;" 
                    <?php
                    if ($separator[1] == 'longevidade')
                        echo 'class="ativo2"';
                    ?> ></a><span class='ballMarker'>&bull;</span>
                </li>
                <li><a id='destaques_renda' onclick="myfunction('6')" style="font-size:13px;" 
                    <?php
                    if ($separator[1] == 'renda')
                        echo 'class="ativo2"';
                    ?> ></a>
                </li> -->
            </ul>
        <!-- </div> -->
        <div class="linhaDivisoria"></div>

        <div id="conteudo_atlas">
        	<div>
                <img src="./assets/img/icons/favicon.png" style="vertical-align: baseline;" />
        	    <a style="display: inline-block;font-size: 16px;margin-bottom: 16px;" href="http://g1.globo.com/distrito-federal/noticia/2015/09/vulnerabilidade-social-cai-mas-ainda-e-alta-no-norte-e-no-nordeste-diz-ipea.html">
                    <span style="float:left;">Vulnerabilidade social cai, mas ainda é alta no Norte e no Nordeste, diz Ipea</span>
                    <span style="float:left; clear:left; color:#AAA; font-size:12px;">terça-feira, 1 de setembro de 2015 - 12:16:18</span>
                    <span style="clear:both;"></span>
                </a>
            </div>
            <div>
                <img src="./assets/img/icons/favicon.png" style="vertical-align: baseline;" />
                <a style="display: inline-block;font-size: 16px;margin-bottom: 16px;" href="http://g1.globo.com/al/alagoas/noticia/2015/09/al-e-o-estado-do-nordeste-com-maior-vulnerabilidade-social-revela-ipea.html">
		            <span style="float:left;">AL é o estado do Nordeste com maior vulnerabilidade social, revela Ipea</span>
		            <span style="float:left; clear:left; color:#AAA; font-size:12px;">terça-feira, 1 de setembro de 2015 - 13:06:08</span>
		            <span style="clear:both;"></span>
		        </a>
		    </div>
		    <div>
                <img src="./assets/img/icons/favicon.png" style="vertical-align: baseline;" />
                <a style="display: inline-block;font-size: 16px;margin-bottom: 16px;" href="http://diariocatarinense.clicrbs.com.br/sc/economia/noticia/2015/09/vulnerabilidade-social-o-que-significa-o-indice-do-ipea-em-que-sc-se-destaca-4838033.html">
		            <span style="float:left;">Vulnerabilidade social: o que significa o índice do Ipea em que SC se destaca</span>
		            <span style="float:left; clear:left; color:#AAA; font-size:12px;">terça-feira, 1 de setembro de 2015 - 13:23:00</span>
		            <span style="clear:both;"></span>
		        </a>
		    </div>
            <div>
                <img src="./assets/img/icons/favicon.png" style="vertical-align: baseline;" />
                <a style="display: inline-block;font-size: 16px;margin-bottom: 16px;" href="http://diariodoaco.com.br/noticia/96789-11/minas/minas-ocupa-4o-lugar-no-sudeste-no-quesito-renda-e-trabalho-do-ipea">
		            <span style="float:left;">Minas ocupa 4º lugar no Sudeste no quesito Renda e Trabalho do Ipea</span>
		            <span style="float:left; clear:left; color:#AAA; font-size:12px;">terça-feira, 1 de setembro de 2015 - 14:49:00</span>
		            <span style="clear:both;"></span>
		        </a>
		    </div>
			<div>
                <img src="./assets/img/icons/favicon.png" style="vertical-align: baseline;" />
                <a style="display: inline-block;font-size: 16px;margin-bottom: 16px;" href="http://noticias.r7.com/record-news/jornal-da-record-news/videos/especialista-fala-sobre-politicas-publicas-baseadas-no-indice-de-vulnerabilidade-social-01092015">
		            <span style="float:left;">Especialista fala sobre políticas públicas baseadas no Índice de Vulnerabilidade Social</span>
		            <span style="float:left; clear:left; color:#AAA; font-size:12px;">terça-feira, 1 de setembro de 2015 - 23:03:08</span>
		            <span style="clear:both;"></span>
		        </a>
		    </div>
			<div>
                <img src="./assets/img/icons/favicon.png" style="vertical-align: baseline;" />
                <a style="display: inline-block;font-size: 16px;margin-bottom: 16px;" href="http://new.d24am.com/noticias/saude/municipios-amazonas-ainda-alta-vulnerabilidade-social-ipea/139406">
		            <span style="float:left;">Municípios do Amazonas ainda têm alta vulnerabilidade social, diz Ipea</span>
		            <span style="float:left; clear:left; color:#AAA; font-size:12px;">quarta-feira, 2 de setembro de 2015 - 10:08:28</span>
		            <span style="clear:both;"></span>
		        </a>
		    </div>
			<div>
                <img src="./assets/img/icons/favicon.png" style="vertical-align: baseline;" />
                <a style="display: inline-block;font-size: 16px;margin-bottom: 16px;" href="http://www.dgabc.com.br/Noticia/1574828/grande-abc-registra-melhora-em-indice-de-vulnerabilidade">
		            <span style="float:left;">Grande ABC registra melhora em índice de vulnerabilidade</span>
		            <span style="float:left; clear:left; color:#AAA; font-size:12px;">quarta-feira, 2 de setembro de 2015 - 07:07:58</span>
		            <span style="clear:both;"></span>
		        </a>
		    </div>
			<div>
                <img src="./assets/img/icons/favicon.png" style="vertical-align: baseline;" />
                <a style="display: inline-block;font-size: 16px;margin-bottom: 16px;" href="http://www.hnews.com.br/noticia/Dw4NDAsKCQgHBgUEAwIBANnHqLh2HY-p1eBjMJxqGYs,/ipea_destaca_maringa_com_indice_baixo_de_vulnerabilidade_.html">
		            <span style="float:left;">Ipea destaca Maringá com índice baixo de vulnerabilidade</span>
		            <span style="float:left; clear:left; color:#AAA; font-size:12px;">quarta-feira, 2 de setembro de 2015 - 17:39:18</span>
		            <span style="clear:both;"></span>
		        </a>
		    </div>
			<div>
                <img src="./assets/img/icons/favicon.png" style="vertical-align: baseline;" />
                <a style="display: inline-block;font-size: 16px;margin-bottom: 16px;" href="http://www.clebertoledo.com.br/estado/2015/09/03/72088-paraiso-do-tocantins-se-destaca-nos-indices-de-vulnerabilidade-social-publicado-pelo-ipea">
		            <span style="float:left;">Paraíso do Tocantins se destaca nos índices de vulnerabilidade social publicado pelo Ipea</span>
		            <span style="float:left; clear:left; color:#AAA; font-size:12px;">quinta-feira, 3 de setembro de 2015 - 11:57:58</span>
		            <span style="clear:both;"></span>
		        </a>
		    </div>
			<div>
                <img src="./assets/img/icons/favicon.png" style="vertical-align: baseline;" />
                <a style="display: inline-block;font-size: 16px;margin-bottom: 16px;" href="http://g1.globo.com/pa/para/noticia/2015/09/riquezas-do-minerio-nao-chegam-aos-moradores-de-maraba-diz-ipea.html">
		            <span style="float:left;">Riquezas do minério não chegam aos moradores de Marabá, diz Ipea</span>
		            <span style="float:left; clear:left; color:#AAA; font-size:12px;">terça-feira, 8 de setembro de 2015 - 17:24:14</span>
		            <span style="clear:both;"></span>
		        </a>
		    </div>
		    <div>
                <img src="./assets/img/icons/favicon.png" style="vertical-align: baseline;" />
                <a style="display: inline-block;font-size: 16px;margin-bottom: 16px;" href="http://www.diarioonline.com.br/noticias/para/noticia-343732-para-tem-3-municipios-mais-vulneraveis-do-brasil.html">
		            <span style="float:left;">Pará tem 3 municípios mais vulneráveis do Brasil</span>
		            <span style="float:left; clear:left; color:#AAA; font-size:12px;">Domingo, 13 de setembro de 2015 - 07:14:25</span>
		            <span style="clear:both;"></span>
		        </a>
		    </div>
		    <div>
                <img src="./assets/img/icons/favicon.png" style="vertical-align: baseline;" />
                <a style="display: inline-block;font-size: 16px;margin-bottom: 16px;" href="http://www.brasil.gov.br/cidadania-e-justica/2015/10/realidade-social-melhorou-em-16-regioes-metropolitanas">
		            <span style="float:left;">Realidade social melhorou em 16 regiões metropolitanas</span>
		            <span style="float:left; clear:left; color:#AAA; font-size:12px;">segunda-feira, 05 de outubro de 2015 - 14:30:10</span>
		            <span style="clear:both;"></span>
		        </a>
		    </div>
		    <div>
                <img src="./assets/img/icons/favicon.png" style="vertical-align: baseline;" />
                <a style="display: inline-block;font-size: 16px;margin-bottom: 16px;" href="http://g1.globo.com/politica/noticia/2015/10/goiania-rio-e-sao-paulo-sao-regioes-que-menos-reduziram-vulnerabilidade.html">
		            <span style="float:left;">Goiânia, Rio e São Paulo são regiões que menos reduziram vulnerabilidade</span>
		            <span style="float:left; clear:left; color:#AAA; font-size:12px;">segunda-feira, 05 de outubro de 2015 - 14:30:37</span>
		            <span style="clear:both;"></span>
		        </a>
		    </div>
		    <div>
                <img src="./assets/img/icons/favicon.png" style="vertical-align: baseline;" />
                <a style="display: inline-block;font-size: 16px;margin-bottom: 16px;" href="http://www.gazetadigital.com.br/conteudo/show/secao/9/materia/458961/t/vulnerabilidade-social-reduz-31-na-grande-cuiaba">
		            <span style="float:left;">Vulnerabilidade social reduz 31% na Grande Cuiabá</span>
		            <span style="float:left; clear:left; color:#AAA; font-size:12px;">segunda-feira, 05 de outubro de 2015 - 14:33:32</span>
		            <span style="clear:both;"></span>
		        </a>
		    </div>		
			<div>
                <img src="./assets/img/icons/favicon.png" style="vertical-align: baseline;" />
                <a style="display: inline-block;font-size: 16px;margin-bottom: 16px;" href="http://g1.globo.com/ceara/noticia/2015/10/grande-fortaleza-reduz-indice-de-vulnerabilidade-social-diz-ipea.html">
		            <span style="float:left;">Grande Fortaleza reduz índice de vulnerabilidade social, diz Ipea</span>
		            <span style="float:left; clear:left; color:#AAA; font-size:12px;">segunda-feira, 05 de outubro de 2015 - 15:51:12</span>
		            <span style="clear:both;"></span>
		        </a>
		    </div>		
			<div>
                <img src="./assets/img/icons/favicon.png" style="vertical-align: baseline;" />
                <a style="display: inline-block;font-size: 16px;margin-bottom: 16px;" href="http://fotos.estadao.com.br/galerias/brasil,as-5-regioes-metropolitanas-com-maior-indice-de-vulnerabilidade-social,21677?startSlide=0&f=0">
		            <span style="float:left;">As 5 regiões metropolitanas com maior índice de vulnerabilidade social</span>
		            <span style="float:left; clear:left; color:#AAA; font-size:12px;">segunda-feira, 05 de outubro de 2015 - 16:11:19</span>
		            <span style="clear:both;"></span>
		        </a>
		    </div>				
			<div>
                <img src="./assets/img/icons/favicon.png" style="vertical-align: baseline;" />
                <a style="display: inline-block;font-size: 16px;margin-bottom: 16px;" href="http://www.correio24horas.com.br/detalhe/noticia/apesar-do-desemprego-vulnerabilidade-social-reduz-na-regiao-metropolitana-de-salvador/?cHash=54a30e82f6328ac62fa0b410aa5a01c3">
		            <span style="float:left;">Apesar do desemprego, vulnerabilidade social reduz na Região Metropolitana de Salvador</span>
		            <span style="float:left; clear:left; color:#AAA; font-size:12px;">segunda-feira, 05 de outubro de 2015 - 17:45:39</span>
		            <span style="clear:both;"></span>
		        </a>
		    </div>			
			<div>
                <img src="./assets/img/icons/favicon.png" style="vertical-align: baseline;" />
                <a style="display: inline-block;font-size: 16px;margin-bottom: 16px;" href="http://www.otempo.com.br/cidades/vulnerabilidade-social-caiu-27-5-na-grande-bh-entre-2000-e-2010-1.1131043">
		            <span style="float:left;">Vulnerabilidade Social caiu 27,5% na grande BH entre 2000 e 2010</span>
		            <span style="float:left; clear:left; color:#AAA; font-size:12px;">segunda-feira, 05 de outubro de 2015 - 18:15:59</span>
		            <span style="clear:both;"></span>
		        </a>
		    </div>		
			<div>
                <img src="./assets/img/icons/favicon.png" style="vertical-align: baseline;" />
                <a style="display: inline-block;font-size: 16px;margin-bottom: 16px;" href="http://www.gazetadopovo.com.br/vida-e-cidadania/indicador-de-vulnerabilidade-social-cai-225-na-grande-sp-aykzgwr2lthnkxmcrttal4v1q">
		            <span style="float:left;">Indicador de vulnerabilidade social cai 22,5% na Grande SP</span>
		            <span style="float:left; clear:left; color:#AAA; font-size:12px;">segunda-feira, 05 de outubro de 2015 - 19:58:37</span>
		            <span style="clear:both;"></span>
		        </a>
		    </div>		
			<div>
                <img src="./assets/img/icons/favicon.png" style="vertical-align: baseline;" />
                <a style="display: inline-block;font-size: 16px;margin-bottom: 16px;" href="http://www.ejornais.com.br/jornal_diario_amazonas.html">
		            <span style="float:left;">Vulnerabilidade social passa para alta na Região Metropolitana de Manaus</span>
		            <span style="float:left; clear:left; color:#AAA; font-size:12px;">terça-feira, 06 de outubro de 2015 - 08:01:10</span>
		            <span style="clear:both;"></span>
		        </a>
		    </div>		
		    <div>
                <img src="./assets/img/icons/favicon.png" style="vertical-align: baseline;" />
                <a style="display: inline-block;font-size: 16px;margin-bottom: 16px;" href="http://www.folhaweb.com.br/?id_folha=2-1--538-20151006&tit=vulnerabilidade+social+na+rmc+cai+267">
		            <span style="float:left;">Vulnerabilidade social na RMC cai 26,7%</span>
		            <span style="float:left; clear:left; color:#AAA; font-size:12px;">terça-feira, 06 de outubro de 2015 - 13:44:17</span>
		            <span style="clear:both;"></span>
		        </a>
		    </div>
			<div>
                <img src="./assets/img/icons/favicon.png" style="vertical-align: baseline;" />
                <a style="display: inline-block;font-size: 16px;margin-bottom: 16px;" href="http://www1.folha.uol.com.br/cotidiano/2015/10/1690801-vulnerabilidade-social-cai-em-areas-metropolitanas-do-pais-aponta-ipea.shtml">
		            <span style="float:left;">Vulnerabilidade social cai em áreas metropolitanas do país, aponta Ipea</span>
		            <span style="float:left; clear:left; color:#AAA; font-size:12px;">terça-feira, 06 de outubro de 2015 - 14:54:15</span>
		            <span style="clear:both;"></span>
		        </a>
		    </div>		
			<div>
                <img src="./assets/img/icons/favicon.png" style="vertical-align: baseline;" />
                <a style="display: inline-block;font-size: 16px;margin-bottom: 16px;" href="http://www.institutomillenium.org.br/blog/vulnerabilidade-social-recuou-22-em-10-anos-rio/">
		            <span style="float:left;">Vulnerabilidade social recuou 22% em 10 anos no Rio</span>
		            <span style="float:left; clear:left; color:#AAA; font-size:12px;">terça-feira, 06 de outubro de 2015 - 10:18:17</span>
		            <span style="clear:both;"></span>
		        </a>
		    </div>		
			<div>
                <img src="./assets/img/icons/favicon.png" style="vertical-align: baseline;" />
                <a style="display: inline-block;font-size: 16px;margin-bottom: 16px;" href="http://www.cartacapital.com.br/sociedade/brasil-reduziu-vulnerabilidade-social-em-regioes-metropolitanas-em-10-anos-5519.html">
		            <span style="float:left;">Brasil reduziu vulnerabilidade social em áreas urbanas em 10 anos</span>
		            <span style="float:left; clear:left; color:#AAA; font-size:12px;">quarta-feira, 07 de outubro de 2015 - 10:18:17</span>
		            <span style="clear:both;"></span>
		        </a>
		    </div>		
		    <div>
                <img src="./assets/img/icons/favicon.png" style="vertical-align: baseline;" />
                <a style="display: inline-block;font-size: 16px;margin-bottom: 16px;" href="http://www1.folha.uol.com.br/colunas/raquelrolnik/2015/10/1695545-como-andam-nossas-metropoles.shtml">
		            <span style="float:left;">Como andam nossas metrópoles</span>
		            <span style="float:left; clear:left; color:#AAA; font-size:12px;">segunda-feira, 19 de outubro de 2015 - 02:00:07</span>
		            <span style="clear:both;"></span>
		        </a>
		    </div>
			<div>
                <img src="./assets/img/icons/favicon.png" style="vertical-align: baseline;" />
                <a style="display: inline-block;font-size: 16px;margin-bottom: 16px;" href="http://carta.fee.tche.br/article/vulnerabilidade-e-prosperidade-social-na-regiao-metropolitana-de-porto-alegre/">
		            <span style="float:left;">Vulnerabilidade e prosperidade social na Região Metropolitana de Porto Alegre</span>
		            <span style="float:left; clear:left; color:#AAA; font-size:12px;">segunda-feira, 28 de dezembro de 2015 - 02:57:09</span>
		            <span style="clear:both;"></span>
		        </a>
		    </div>		
					
					
					
		    
		    <?php
            /*if ($separator[1] == 'metodologia' || $separator[1] == '') {
                /*include 'destaques/' . $_SESSION["lang"] . '/metodologiaView.php';*/
            /*    include 'destaques/' . $_SESSION["lang"] . '/listaDestaques.php';
            } 
            else if ($separator[1] == 'regioes-metropolitanas-avancam-desenvolvimento-humano-reduzem-disparidades') {
                
                include 'destaques/' . $_SESSION["lang"] . '/noticias/regioesMetropolitanasReduzDisparidades.php';
            } 
            else if ($separator[1] == 'regioes-metropolitanas-alto-indice-desenvolvimento-humano') {
                include 'destaques/' . $_SESSION["lang"] . '/noticias/regioesMetropolitanasAltoIndice.php';
            } 
            else if ($separator[1] == 'educacao') {
                include 'destaques/' . $_SESSION["lang"] . '/educacaoView.php';
            } 
            else if ($separator[1] == 'longevidade') {
                include 'destaques/' . $_SESSION["lang"] . '/longevidadeView.php';
            } 
            else if ($separator[1] == 'renda') {
                include 'destaques/' . $_SESSION["lang"] . '/rendaView.php';
            }
            else if ($separator[1] == 'idhmBrasil') {
                include 'destaques/' . $_SESSION["lang"] . '/idhmBrasilView.php';
            }*/
            ?>
        </div>
    </div>
    <input type="button" class="voltarTopo" onclick="$j('html,body').animate({scrollTop: $('#voltarTopo').offset().top}, 2000);" value="Voltar ao topo" >
</div>

<script type="text/javascript">
    /*$("#destaques_longevidade").html(lang_mng.getString("destaques_longevidade"));
    $("#destaques_renda").html(lang_mng.getString("destaques_renda"));
    $("#destaques_educacao").html(lang_mng.getString("destaques_educacao"));
    $("#destaques_idhmBrasil").html(lang_mng.getString("destaques_idhmBrasil"));
    $("#destaques_faixas_idhm").html(lang_mng.getString("destaques_faixas_idhm"));
    $("#destaques_metodologia").html(lang_mng.getString("destaques_metodologia"));*/
    $("#destaques_title").html(lang_mng.getString("destaques_title"));
</script>
<?php
    $title = "Destaques";
    $meta_title = 'Destaques';
    $meta_description = 'O Atlas do Desenvolvimento Humano no Brasil 2013 é uma plataforma de consulta ao Índice de Desenvolvimento Humano Municipal – IDHM - de 5.565 municípios brasileiros, além de mais de 180 indicadores de população, educação, habitação, saúde, trabalho, renda e vulnerabilidade, com dados extraídos dos Censos Demográficos de 1991, 2000 e 2010.';
    $content = ob_get_contents();
    ob_end_clean();
    include "base.php";
?>
