
/* =========================== VARIAVEIS GLOBAIS ================================*/
function LocalSelectorG()
{
    var value_indicador = new Array();
    var value_indicador_old = new Array();
    var load = false;
    var this_selector_element = null;
    var value_multiselect;
    var lazy_select = false;
    var lazy_array;
    var to_hide;

    var estados;
    var regioes;
    var espacialidade_selecionada = -1;
    var cidades = new Array();
    var contadorMunicipio = 20;
    var contadorEstado = 20;

    //total de lugares escolhidos
    var total = 0;

    var skipLimit = false;

    this.html = function(idElement)
    {
        console.log('html');
        var button = '<div id="' + idElement + '" style="float: right;">'
                + '<div class="divCallOutLugares">'
                + '<button class="blue_button big_bt selector_popover" data-toggle="dropdown" style="margin-right: 27px !important; height: 34px; font-size: 14px;" rel="popover" >' + lang_mng.getString("selecionar") + '</button>'
                + '</div>'
                + '</div>';

        return button;
    }
    /* =========================== FIM VARIAVEIS GLOBAIS ================================*/

    var divSeletor = $('<div class="divSeletor">');

    /**
     * @param multiselect - Especifica se a lista de indicadores será de múltipla seleção ou de seleção simples
     */
    this.startSelector = function(multiselect, id_element_context, listener_param, orientation, _to_hide, skip)
    {
        console.log('startSelector');
        this_selector_element = '#' + id_element_context;
        value_multiselect = multiselect;
        listener = listener_param;
        to_hide = '#' + _to_hide;
        skipLimit = skip;

        html = "";
        html += '<div><div class="box1 box"><h6 class="title_box">' + lang_mng.getString("seletor_espacialidade") + '</h6><ul class="nav nav-list list_menu_indicador lista1">' +
                '</ul></div>' +
                '<div class="box2 box">' +
                '<h6 class="title_box">' + lang_mng.getString("seletor_estado") + '</h6><ul class="nav nav-list list_menu_indicador lista2">' +
                '</ul></div>' +
                '<div class="box3 box"><img id="ui_city_loader" style="position:absolute; display:none; top: 45%; left: 55%;" src="assets/img/loader.gif" /><h6 class="title_box"></h6><ul class="nav nav-list list_menu_indicador lista3">' +
                '</ul></div>';
        if (value_multiselect == true) {
            html += '<div class="itens_selecionados box"><a class="close lugar">&times;</a><h6 class="title_box">' + lang_mng.getString("seletor_selecionados") + '</h6><ul class="nav nav-list list_menu_indicador lista4"></ul></div></div>';
        }
        html += '</div>';
        html += '<div class="btn_select" style="display:none">';
        html += '<div class="messages">Espacialidades restantes: </div><div class="contadorMunicipio">20</div><div class="contadorEstado">20</div> ';
        html += '<div class="buttons" >';
        html += '<button class="blue_button small_bt btn_ok" type="button" style="font-size: 14px; height: 30px; font-family: helvetica; width: 38px; float: right;">Ok</button>';
        html += '<button class="gray_button big_bt btn_clean" id ="bt_limpar_selecionandos_lug" type="button" style="width:162px; margin-left: 20px; font-size: 14px; height: 30px;">' + lang_mng.getString("limpar_selecionados") + '</button><div>';
        html += '</div>';

        divSeletor.html(html);

        $(this_selector_element).find('.selector_popover').popover({
            html: true,
            trigger: 'manual',
            placement: orientation,
            delay: {show: 350, hide: 100},
            content: divSeletor.html()
        }).click(function(e) {
            $(this_selector_element).find('.messages').html("Espacialidades restantes: ");
            $(to_hide).find('.divCallOut').removeClass('open');
            $(to_hide).find('.divCallOut .popover').css('display', 'none');
            startPopOver();
        });

        $('html').on('click.popover.divCallOutLugares', function(e)
        {
            if ($(e.target).has('.divCallOutLugares').length == 1)
            {
                $(this_selector_element).find('.divCallOutLugares .popover').hide();
                value_indicador = value_indicador_old.slice();
            }
        });
    }


    function startPopOver()
    {
        console.log('startPopOver');

        refresh();
        console.log('espacialidade_selecionada: ' + espacialidade_selecionada);

        if (espacialidade_selecionada == 4) {   //Se a espacialidade já selecionada for 'Estadual'
            $(this_selector_element).find('.contadorEstado').html(contadorEstado);
            $(this_selector_element).find('.contadorEstado').css("display", "block");
            $(this_selector_element).find('.contadorMunicipio').css("display", "none");
        }
        else if (espacialidade_selecionada == 2) { //Se a espacialidade já selecionada for 'Municipal'
            $(this_selector_element).find('.contadorMunicipio').html(contadorMunicipio);
            $(this_selector_element).find('.contadorEstado').css("display", "none");
            $(this_selector_element).find('.contadorMunicipio').css("display", "block");
        }

        if (contadorMunicipio < 0) {
            $(this_selector_element).find('.contadorMunicipio').css("color", "red");
        }
        else {
            $(this_selector_element).find('.contadorMunicipio').css("color", "black");
        }

        if (contadorEstado < 0) {
            $(this_selector_element).find('.contadorEstado').css("color", "red");
        }
        else {
            $(this_selector_element).find('.contadorEstado').css("color", "black");
        }


//        else if(contadorEstado < 0){
//            
//        }


        $(this_selector_element).find('.divCallOutLugares .popover').toggle(); //Exibir ou ocultar os elementos combinados.


        value_indicador_old = value_indicador.slice();  //Salva na variável value_indicador_old, os valores escolhidos, para ficarem guardados

        if (load == false)
        {
            $(this_selector_element).find('.selector_popover').popover('show');

            loadData(listener);

            if (value_multiselect == true)
            {
                $(this_selector_element).find('div.divCallOutLugares .popover-inner,div.divCallOutLugares .popover-content,div.divCallOutLugares .popover').css('height', '425px');
                $(this_selector_element).find('div.divCallOutLugares .popover-inner,div.divCallOutLugares .popover-content,div.divCallOutLugares .popover').css('width', '703px');

                $(this_selector_element).find('.btn_select').css('width', '689px');

                $(this_selector_element).find('.btn_select').css('display', 'inline');

                $(this_selector_element).find('.btn_clean').click(function(e)   //Ao clicar no Botão "Limpar Selecionados"
                {
                    contadorMunicipio = 20;
                    contadorEstado = 20;
                    $(this_selector_element).find('.contadorMunicipio').html('20');
                    $(this_selector_element).find('.contadorMunicipio').css("display", "block");
                    $(this_selector_element).find('.contadorEstado').css("display", "none");
                    $(this_selector_element).find('.contadorMunicipio').css("color", "black");
                    
                    value_indicador = new Array();

                    $(this_selector_element).find('.box3 ul li').removeClass('selected');
                    $(this_selector_element).find('.box2 ul li').removeClass('selected');


                    value_indicador_old = value_indicador.slice();
                    total = value_indicador.length;
                    fillSelectedItens();
                });

                $(this_selector_element).find('.btn_ok').click(function(e) {
                    $(this_selector_element).find('.divCallOutLugares .popover').toggle();

                    dispatchListener(listener);
                });
            }

            $(this_selector_element).find('.close').click(function(e) {
                $(this_selector_element).find('.divCallOutLugares .popover').hide();
                return 0;
            });
        }


        fillSelectedItens();

        if (espacialidade_selecionada == 4)
        {
            filterByBox2(estados, espacialidade_selecionada);
        }
        else if (espacialidade_selecionada == 2)
        {
            filterByBox3(cidades);
        }
    }

    this.getData = function()
    {
        console.log('getData');
        return value_indicador;
    }

    var contMun = 0;
    var contEst = 0;

    function dispatchListener(listener)
    {
        console.log('dispatchListener');
        fillSelectedItens();

        var locais_municipal = new Array();
        var locais_estadual = new Array();

        var LugSelectedMun = new Array();  //Guarda os municípios selecionados
        var LugSelectedEst = new Array();  //Guarda os estados selecionados

        $.each(value_indicador, function(i, item) {
            if (item.e == 2) {    //Espacialidade Municipal
                if (item.c == true) {
                    LugSelectedMun.push(item.c);
                }
            }
            else if (item.e == 4) {   //Espacialidade Estadual
                if (item.c == true) {
                    LugSelectedEst.push(item.c);
                }
            }
        });
        console.log('LugSelectedMun: ' + LugSelectedMun.length);

        $.each(value_indicador, function(i, item) {    //Percorre os elementos selecionados 
            var tamLugSelectedMun = LugSelectedMun.length;  //Total de municipios selecionados
            var tamLugSelectedEst = LugSelectedEst.length;  //Total de Estados selecionados

            var local = new Local();
            local.id = item.id;
            local.n = item.n;

            if (item.e == 2) {    //Se a espacialidade for igual a municipio
                if (item.c == undefined) {    //Se não foi setado o valor de item.c. Geralmente isso acontece na primeira vez que é selecionado
                    if (contMun < 20 && tamLugSelectedMun < 20) {
                        local.c = true;
                        console.log('contMun: ' + contMun);
                        contMun++;
                    }
                }
                else if (item.c == true) {
                    local.c = true;
                }
                else if (tamLugSelectedMun >= 20) {
                    local.c = false;
                }
            }

            if (item.e == 4) {    //Se a espacialidade for igual a estado
                if (item.c == undefined) {    //Se não foi setado o valor de item.c. Geralmente isso acontece na primeira vez que é selecionado
                    if (contEst < 20 && tamLugSelectedEst < 20) {
                        local.c = true;
                        contEst++;
                    }
                }
                else if (item.c == true) {
                    local.c = true;
                }
                else if (tamLugSelectedEst >= 20) {
                    local.c = false;
                }
            }

            local.s = false;

            if (item.e == 2)
                locais_municipal.push(local);

            if (item.e == 4)
                locais_estadual.push(local);

        });

        var lugar_municipal = new Lugar();
        lugar_municipal.e = 2;                  //Espacialidade 
        lugar_municipal.ac = true;              //Ativo
        lugar_municipal.l = locais_municipal;   //Array de municípios

        var lugar_estadual = new Lugar();
        lugar_estadual.e = 4;               //Espacialidade
        lugar_estadual.ac = false;          //Inativo
        lugar_estadual.l = locais_estadual; //Array de Estados

        listener([lugar_municipal, lugar_estadual]);
    }

    //Preenche o Box dos selecionados
    function fillSelectedItens()
    {
        console.log('fillSelectedItens');
        var html = "";

        $.each(value_indicador, function(i, item) {
            html += "<li data-id=" + item.id + " data-texto='" + item.n + "'><a>" + item.n + "</a></li>";
        });

        $(this_selector_element).find('.itens_selecionados .nav').html(html);
    }

    function loadData(listener)
    {
        console.log('loadData');
        load = true;

        $.getJSON('system/modules/local/local.php', function(data) {
            fillData(data);
        });
    }

    function injetaEspacialidade(array, espacialidade)
    {
        console.log('injetaEspacialidade');
        $.each(array, function(i, item)
        {
            item.e = espacialidade;
        });

        return array;
    }

    function fillData(data)
    {
        console.log('fillData');
        estados = injetaEspacialidade(data.estados, 4);
        if (estados.length > 1)
        {
            var value = [];

            value.n = "Todos os estados";
            value.id = '-1';
            var newArray = [value];
            estados = newArray.concat(estados);
        }
        fillFiltroBox1(getItensBox1());
    }

    function getItensBox1()
    {
        console.log('getItensBox1');
        var array = new Array();
        var objeto;

        objeto = {};
        objeto.id = 4;
        objeto.n = lang_mng.getString("seletor_estadual");
        array.push(objeto);

        objeto = {};
        objeto.id = 2;
        objeto.n = lang_mng.getString("seletor_municipal");
        array.push(objeto);

        return array;
    }

    function fillFiltroBox1(array)
    {
        console.log('fillFiltroBox1');
        var html = "";
        $.each(array, function(i, item)
        {
            if (item.n == "[BROKER]")
                html += "<div style=\"margin-top: 10px; margin-bottom: 10px; border-top: 1px solid #999; width: 150px;\"></div>";
            else
                html += "<li data-id=" + item.id + "><a>" + item.n + "</a></li>";
        });

        $(this_selector_element).find('.box1 .nav').html(html);

        $(this_selector_element).find('.box1 ul li').click(function(e)
        {
            $(this_selector_element).find('.box1 ul li').removeClass('active');
            $(this).addClass('active');

            $(this_selector_element).find('.box2 .nav').html('');
            $(this_selector_element).find('.box3 .nav').html('');

            var valorSelecionadoBox1 = parseInt($(this_selector_element).find('.box1 ul li.active').attr('data-id'));


            if (valorSelecionadoBox1 == 2)  //Espacialidade Selecionada: Municipal
            {
                estados[0].n = lang_mng.getString("seletor_todos_estados");
                $(this_selector_element).find('.box2 .title_box').html(lang_mng.getString("seletor_estado"));
                $(this_selector_element).find('.box3 .title_box').html(lang_mng.getString("seletor_municipios"));
                $(this_selector_element).find('.contadorMunicipio').html(contadorMunicipio);
                $(this_selector_element).find('.contadorEstado').css("display", "none");
                $(this_selector_element).find('.contadorMunicipio').css("display", "block");
            }
            else if (valorSelecionadoBox1 == 4) //Espacialidade Selecionada: Estadual
            {
                estados[0].n = lang_mng.getString("marcar_todos");
                $(this_selector_element).find('.box2 .title_box').html(lang_mng.getString("seletor_estado"));
                $(this_selector_element).find('.box3 .title_box').html('');
                $(this_selector_element).find('.contadorEstado').html(contadorEstado);
                $(this_selector_element).find('.contadorEstado').css("display", "block");
                $(this_selector_element).find('.contadorMunicipio').css("display", "none");
            }
            
            if (contadorMunicipio < 0) {
            $(this_selector_element).find('.contadorMunicipio').css("color", "red");
        }
        else {
            $(this_selector_element).find('.contadorMunicipio').css("color", "black");
        }

        if (contadorEstado < 0) {
            $(this_selector_element).find('.contadorEstado').css("color", "red");
        }
        else {
            $(this_selector_element).find('.contadorEstado').css("color", "black");
        }

            filtroBox2($(this).attr('data-id'));

            espacialidade_selecionada = valorSelecionadoBox1;
        });
    }

    function filtroBox2(value)
    {
        console.log('filtroBox2');
        filterByBox2(estados, value);
    }

    //Box de Municípios
    function filterByBox2(array, value)
    {
        console.log('filterByBox2');
        $(this_selector_element).find('.box2 ul li').removeClass('active');
        $(this_selector_element).find('.box2 ul li').removeClass('selected');

        var html = "";

        $.each(array, function(i, item)
        {
            var htmlespacialidade = ((value == 2) ? "" : "data-espacialidade=" + item.e);
            if (value == 4 || value == 7)
                var classItem = ((contains(item) == true) ? 'class="selected"' : '');
            html += "<li " + htmlespacialidade + " data-id=" + item.id + " data-texto='" + item.n + "'" + classItem + " data-tematica=" + item.tam + "><a>" + item.n + "</a></li>";
        });

        $(this_selector_element).find('.box2 .nav').html(html);

        if (value == 4)
        {
            $(this_selector_element).find('.box2 ul li').click(function(e)
            {
                var valorSelecionado = parseInt($(this).attr('data-id'));

                if (valorSelecionado == -1)
                {
                    $.each($(this_selector_element).find('.box2 ul li'), function(pos, itemList)
                    {
                        var id = parseInt($(this).attr('data-id'));
                        if (id == -1)
                            return;
                        var objeto = {};
                        objeto.id = id;
                        objeto.n = $(this).text();
                        objeto.e = 4; //espacialidade estadual

                        adicionaElemento(objeto, $(this));
                    });
                }
                else
                {
                    var objeto = {};
                    objeto.id = valorSelecionado;
                    objeto.n = $(this).text();
                    objeto.e = 4; //espacialidade estadual

                    if ($(this).hasClass('selected') == false)
                    {
                        adicionaElemento(objeto, $(this));
                    }
                    else
                    {
                        removeElemento(objeto);
                        $(this).removeClass('selected');
                    }
                }
            });
        }

        else if (value == 2)
        {
            $(this_selector_element).find('.box2 ul li').click(function(e)
            {
                $(".box3 ul").empty();
                $("#ui_city_loader").show();

                var objeto = {};
                objeto.id = parseInt($(this).attr('data-id'));
                objeto.n = $(this).text();
                objeto.e = 4; //espacialidade estadual

                $(this_selector_element).find('.box2 ul li').removeClass('active');
                $(this).addClass('active');

                filtroBox3($(this).attr('data-id'));
            });
        }
    }


    function filterByBox3(array)
    {
        console.log('filterByBox3');
        $("#ui_city_loader").hide();

        array = injetaEspacialidade(array, 2);

        if (array.length > 1)
        {
            var value = [];
            value.n = lang_mng.getString("marcar_todos");
            value.id = '-1';
            var newArray = [value];
            array = newArray.concat(array);
        }

        var html = "";

        $.each(array, function(i, item)
        {
            var classItem = ((contains(item) == true) ? 'class="selected"' : '');
            html += "<li data-espacialidade=" + item.e + " data-id=" + item.id + " data-texto='" + item.n + "'" + classItem + "><a>" + item.n + "</a></li>";
        });

        $(this_selector_element).find('.box3 .nav').html(html);

        listenerClickItens();
    }

    function filtroBox3(value)
    {
        console.log('filtroBox3');
        $.getJSON('system/modules/local/cidades_por_estado.php', {estado: value}, function(data) {
            cidades = data.cidades;
            filterByBox3(data.cidades)
        });
    }

    function adicionaItemTodos(array)
    {
        console.log('adicionaItemTodos');
        var html = "";

        if (array.length > 1)
        {
            var value = [];
            value.nome = "Todos";
            value.nivel = "2";
            value.id = '-1';
            var newArray = [value];
            array = newArray.concat(array);
        }
    }


    /**
     * @param value_multiselect - Informa se a lista é de múltiplca seleção ou de simples seleção
     * Habilita o evento de click na lista.
     */
    function listenerClickItens()
    {
        console.log('listenerClickItens');


        if (value_multiselect == false)
        {
            $(this_selector_element).find('.box3 ul li').click(function(e)
            {
                $(this_selector_element).find('.box3 ul li').removeClass('active');
                $(this).addClass('active');

                $(this_selector_element).find('div.divCallOutLugares .popover').hide();

                var objeto = {};//getIndicadorById(parseInt($(this).attr('data-id')));
                objeto.id = parseInt($(this).attr('data-id'));

                value_indicador[0] = objeto;

                fillLabelButtonIndicador();

                dispatchListener(listener);
            });
        }
        else
        {
            $(this_selector_element).find('.box3 ul li').click(function(e)  //Percorre o Box3, dos Municípios
            {
                var valorSelecionado = parseInt($(this).attr('data-id'));   //Id do município escolhido
                if (valorSelecionado == -1)  //Se foi escolhido marcar todos
                {
                    $(this_selector_element).find('.box3 ul li[data-id=-1]').removeClass('selected');   //Remove a classe do item Marcar Todos

                    var itens = new Array();

                    $.each($(this_selector_element).find('.box3 ul li'), function(pos, itemList)  //Percorre a lista com todos os municipios selecionados
                    {
                        var id = parseInt($(this).attr('data-id'));     //Id do município escolhido
                        if (id == -1)    //Se o item for Marcar Todos, não faz nada, apenas dá um return
                            return;

                        var objeto = {};
                        objeto.id = id; //Id do município escolhido
                        objeto.n = $(this).text();  //Nome do município escolhido
                        objeto.e = 2; //espacialidade municipal

                        if (contains(objeto) == false)
                            itens.push(objeto);
                    });
                    contadorMunicipio = contadorMunicipio - itens.length;
                    console.log(contadorMunicipio);
                    $(this_selector_element).find('.contadorMunicipio').html(contadorMunicipio);
                    $(this_selector_element).find('.contadorEstado').css("display", "none");
                    $(this_selector_element).find('.contadorMunicipio').css("display", "block");
                    if (contadorMunicipio < 0) {
            $(this_selector_element).find('.contadorMunicipio').css("color", "red");
        }
        else {
            $(this_selector_element).find('.contadorMunicipio').css("color", "black");
        }

        if (contadorEstado < 0) {
            $(this_selector_element).find('.contadorEstado').css("color", "red");
        }
        else {
            $(this_selector_element).find('.contadorEstado').css("color", "black");
        }

//                    if(contadorEstado < 0){
//                        $(this_selector_element).find('.contadorEstado').css("color", "red");
//                    }
//                    else{
//                        $(this_selector_element).find('.contadorEstado').css("color", "black");
//                    }


//                    if(contadorMunicipio < 0 || contadorEstado < 0){
//                        $(this_selector_element).css("color", "red");
//                    }
                    adicionaVariosElementos(itens);
                }
                else
                {
                    var objeto = {};//getIndicadorById(parseInt($(this).attr('data-id')));
                    objeto.id = parseInt($(this).attr('data-id'));  //Id do município escolhido
                    objeto.n = $(this).text();  //Nome do município escolhido
                    objeto.e = 2; //espacialidade municipal

//                    var cont = contadorEspacialidade($(this));
//                    console.log('cont: '+cont);
//                    var messageContador = 'Espacialidades restantes: ' + cont;
//                    $(this_selector_element).find('.messages').html(messageContador);

                    //Se o elemento(município) não estiver selecionado, adiciona ele. Isso pode acontecer quando abrimos o componente uma segunda vez depois de termos escolhido um elemento
                    if ($(this).hasClass('selected') == false)   //hasClass retorna true se a classe existir, quando não existir retorna false
                    {
//                        if (espacialidade_selecionada == 2) {
//                            contadorMunicipio--;  //Possível contador de espacialidade
                        adicionaElemento(objeto, $(this));
//                        }

//                        else if (espacialidade_selecionada == 4) {
//                            contadorEstado--;
//                            adicionaElemento(objeto, $(this), contadorEstado);
//                        }
//
//                        console.log('contadorMunicipio: ' + contadorMunicipio);

                    }
                    else
                    {
                        removeElemento(objeto);
                        $(this).removeClass('selected');
                    }
                }
//                if (espacialidade_selecionada == 2) {
//                    var messageContador = 'Espacialidades restantes: ' + contadorMunicipio;
//                    $(this_selector_element).find('.messages').html(messageContador);
//                }
//                else if (espacialidade_selecionada == 4) {
//                    var messageContador = 'Espacialidades restantes: ' + contadorEstado;
//                    $(this_selector_element).find('.messages').html(messageContador);
//                }
            });
        }


    }

    function fillLabelButtonIndicador()
    {
        console.log('fillLabelButtonIndicador');
        var objeto = value_indicador[0];
        textoIndicadorSelecionado = objeto.nome;

        if (textoIndicadorSelecionado.length > 8)
            textoIndicadorSelecionado = textoIndicadorSelecionado.slice(0, 8) + '...';

        $(this_selector_element).find('.selector_popover').html(textoIndicadorSelecionado);
        $(this_selector_element).find('.selector_popover').prop('title', objeto.nome);
    }


    /**
     * @description Verifica se o indicador está no array de indicadores selecionados
     */
    function contains(value)
    {
        console.log('contains');
        var length = value_indicador.length
        for (var i = 0; i < length; i++)
        {
            if (value_indicador[i].id == value.id && value_indicador[i].e == value.e) {
                return true;
            }
        }
        return false;
    }

    function contadorEspacialidade(elemento) {
        if ($(elemento).hasClass('selected') == false)   //hasClass retorna true se a classe existir, quando não existir retorna false
        {
            if (espacialidade_selecionada == 2) {
                contadorMunicipio -= 1;  //Possível contador de espacialidade
                return contadorMunicipio;
            }

            else if (espacialidade_selecionada == 4) {
                contadorEstado -= 1;
                return contadorEstado;
            }
        }
    }

    /**
     * Adiciona o indicador a lista de indicadores selecionados.
     * Verifica antes se o item já não está na lista
     */
    function adicionaElemento(value, elemento, size)
    {
        console.log('adicionaElemento');

        var cont = contadorEspacialidade(elemento);
//        console.log('cont: '+cont);
//        var messageContador = 'Espacialidades restantes: ' + cont;
        if (espacialidade_selecionada == 2) {
            $(this_selector_element).find('.contadorMunicipio').html(cont);
            $(this_selector_element).find('.contadorEstado').css("display", "none");
            $(this_selector_element).find('.contadorMunicipio').css("display", "block");
        }
        else if (espacialidade_selecionada == 4) {
            $(this_selector_element).find('.contadorEstado').html(cont);
            $(this_selector_element).find('.contadorEstado').css("display", "block");
            $(this_selector_element).find('.contadorMunicipio').css("display", "none");
        }

//        if(cont < 0 || cont < 0){
//            $(this_selector_element).css("color", "red");
//        }

        if (contadorMunicipio < 0) {
            $(this_selector_element).find('.contadorMunicipio').css("color", "red");
        }
        else {
            $(this_selector_element).find('.contadorMunicipio').css("color", "black");
        }

        if (contadorEstado < 0) {
            $(this_selector_element).find('.contadorEstado').css("color", "red");
        }
        else {
            $(this_selector_element).find('.contadorEstado').css("color", "black");
        }

        if (size == undefined || size == null)
            size = 0;

        if (contains(value) == false)
        {
            if (!skipLimit)
            {
                var idc = geral.getIndicadores().length;
                var lug;
                if (size == 0)
                    lug = (total + 1);
                else
                    lug = (total + size);
                var produto = idc * lug;

//                if(produto >= JS_LIMITE_TELA && produto < JS_LIMITE_DOWN)
//                {
//                    var message = '<div class="alert">';
//                    message += '<button type="button" class="close" data-dismiss="alert">&times;</button>'
//                    message += 'Seleção atual: Indicadores ('+ idc +'), Lugares ('+ lug +'), Células('+ produto +'). A tabela será disponibilizada para download.';
//                    message += '</div>';
//                    $(this_selector_element).find('.messages').html(message);
//                }
//                else if(produto >= JS_LIMITE_DOWN)
//                {
//                    var message = '<div class="alert">';
//                    message += '<button type="button" class="close" data-dismiss="alert">&times;</button>'
//                    message += 'Atenção: sua consulta superou o limite de ('+ JS_LIMITE_DOWN +') células na tabela. <br/>Acesse "Download" e baixe todos os dados do Atlas Brasil 2013.';
//                    message += '</div>';
//                    $(this_selector_element).find('.messages').html(message); 
//                    return 0;
//                }    
            }

            total = lug;
            value_indicador.push(value);   //Acrescenta na variável value_indicador, que guarda os lugares, o município escolhido no momento
            elemento.addClass('selected');
            fillSelectedItens();

        }
    }

    function adicionaVariosElementos(value)
    {
        console.log('adicionaVariosElementos');
//        $(this_selector_element).find('.messages').html("");

        if (!skipLimit)
        {
            var idc = geral.getIndicadores().length;
            var lug = total + value.length;
            var produto = idc * lug;

//                if(produto >= JS_LIMITE_TELA && produto < JS_LIMITE_DOWN)
//                {
//                    var message = '<div class="alert">';
//                    message += '<button type="button" class="close" data-dismiss="alert">&times;</button>'
//                    message += 'Seleção atual: Indicadores ('+ idc +'), Lugares ('+ lug +'), Células('+ produto +'). A tabela será disponibilizada para download.';
//                    message += '</div>';
//                    $(this_selector_element).find('.messages').html(message);
//                }
//                else if(produto >= JS_LIMITE_DOWN)
//                {
//                    var message = '<div class="alert">';
//                    message += '<button type="button" class="close" data-dismiss="alert">&times;</button>'
//                    message += 'Atenção: sua consulta superou o limite de ('+ JS_LIMITE_DOWN +') células na tabela. <br/>Acesse "Download" e baixe todos os dados do Atlas Brasil 2013.';
//                    message += '</div>';
//                    $(this_selector_element).find('.messages').html(message); 
//                    return 0;
//                }    
        }

        total = lug;
        $(this_selector_element).find('.box3 ul li').addClass('selected');
        value_indicador = value_indicador.concat(value);
        fillSelectedItens();

    }
    /**
     * Remove um indicador da lista
     */
    function removeElemento(value, size)
    {
        console.log('removeElemento');
        console.log(contadorEstado);
        if (espacialidade_selecionada == 2) { //Municipal
            if(contadorMunicipio < 20){
                contadorMunicipio++;
            }
            $(this_selector_element).find('.contadorMunicipio').html(contadorMunicipio);
            $(this_selector_element).find('.contadorEstado').css("display", "none");
            $(this_selector_element).find('.contadorMunicipio').css("display", "block");
        }
        else if (espacialidade_selecionada == 4) {    //Estadual
            if(contadorEstado < 20){
                contadorEstado++;
            }
            
            $(this_selector_element).find('.contadorEstado').html(contadorEstado);
            $(this_selector_element).find('.contadorEstado').css("display", "block");
            $(this_selector_element).find('.contadorMunicipio').css("display", "none");
        }
        
        if(contadorMunicipio < 0){
            $(this_selector_element).find('.contadorMunicipio').css("color", "red");
        }
        else{
            $(this_selector_element).find('.contadorMunicipio').css("color", "black");
        }
        
        if(contadorEstado < 0){
            $(this_selector_element).find('.contadorEstado').css("color", "red");
        }
        else{
            $(this_selector_element).find('.contadorEstado').css("color", "black");
        }
        
        console.log(contadorEstado);
        var length = value_indicador.length;
        if (size == undefined || size == null)
            size = 0;

        for (var i = 0; i < length; i++)
        {
            if (value_indicador[i].id == value.id)
            {
                value_indicador.splice(i, 1);
                fillSelectedItens();
                break;
            }
        }


        if (size > 0)
            total -= size;
        else
            total -= 1;


//        $(this_selector_element).find('.messages').html("");

        if (!skipLimit)
        {
            var idc = geral.getIndicadores().length;
            var lug = total;
            var produto = idc * lug;

//                if(produto >= JS_LIMITE_TELA && produto < JS_LIMITE_DOWN)
//                {
//                    var message = '<div class="alert">';
//                    message += '<button type="button" class="close" data-dismiss="alert">&times;</button>'
//                    message += 'Seleção atual: Indicadores ('+ idc +'), Lugares ('+ lug +'), Células('+ produto +'). A tabela será disponibilizada para download.';
//                    message += '</div>';
//                    $(this_selector_element).find('.messages').html(message);
//                }
//                else if(produto >= JS_LIMITE_DOWN)
//                {
//                    var message = '<div class="alert">';
//                    message += '<button type="button" class="close" data-dismiss="alert">&times;</button>'
//                    message += 'Atenção: sua consulta superou o limite de ('+ JS_LIMITE_DOWN +') células na tabela. <br/>Acesse "Download" e baixe todos os dados do Atlas Brasil 2013.';
//                    message += '</div>';
//                    $(this_selector_element).find('.messages').html(message); 
//                    return 0;
//                }
        }

    }

    /**
     * @description Pega o objeto da lista de indicadores a partir do id
     */
    function getIndicadorById(value)
    {
        console.log('getCIndicadorById');
        var length = array_indicadores.length;

        for (var i = 0; i < length; i++)
        {
            var item = array_indicadores[i];
            if (item.id == value)
                return item;
        }
    }

    /**
     * @description Pega o objeto da lista de indicadores a partir da sigla
     */
    function getIndicadorBySigla(value)
    {
        console.log('getIndicadorBySigla');
        var length = array_indicadores.length;
        for (var i = 0; i < length; i++)
        {
            var item = array_indicadores[i];
            if (item.sigla == value)
                return item;
        }
    }

    function convertToArray(value)
    {
        console.log('convertToArray');
        if ($.isArray(value))
            return value;
        else
            return [value];
    }

    this.setLugares = function(lugares)
    {
        console.log('setLugares');
        setLugaresValue(lugares);
    }

    function setLugaresValue(lugares)
    {
        console.log('setLugaresValue');
        var array = new Array();

        $.each(lugares, function(i, item)
        {
            var locais = item.l;
            var espacialidade = item.e;
            $.each(locais, function(k, local)
            {
                local.e = espacialidade;
                array.push(local);
            });
        });

        value_indicador = array;
    }


    this.refresh = function()
    {
        console.log('this.refresh');
        refresh();
    }

    function refresh()
    {
        console.log('refresh');
        setLugaresValue(geral.getLugares().slice());
    }
}