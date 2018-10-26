$(document).ready(function () {

    $(document).ready(function() {
        $('#table_extrato').DataTable( {
            "scrollY": "470px",
            "scrollCollapse": true,
            "paging":         false,
            "bInfo" : false,
            "searching": false
        } );
    } );

    jQuery.browser = {};
    (function () {
        jQuery.browser.msie = false;
        jQuery.browser.version = 0;
        if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
            jQuery.browser.msie = true;
            jQuery.browser.version = RegExp.$1;
        }
    })();

    jQuery(document).ready(function ($) {
        $("#valor").maskMoney({showSymbol: true, symbol:'R$ ', thousands:'.', decimal:',', symbolStay: true});
        $("#encargos").maskMoney({showSymbol: true, symbol:'R$ ', thousands:'.', decimal:',', symbolStay: true});
        $("#iof").maskMoney({showSymbol: true, symbol:'R$ ', thousands:'.', decimal:',', symbolStay: true});
        $("#anuidade").maskMoney({showSymbol: true, symbol:'R$ ', thousands:'.', decimal:',', symbolStay: true});
        $("#juros_fat").maskMoney({showSymbol: true, symbol:'R$ ', thousands:'.', decimal:',', symbolStay: true});
        $("#protecao_prem").maskMoney({showSymbol: true, symbol:'R$ ', thousands:'.', decimal:',', symbolStay: true});
        $("#valor_pagar").maskMoney({showSymbol: true, symbol:'R$ ', thousands:'.', decimal:',', symbolStay: true});
        $("#numero_cartao").mask("9999.9999.9999.9999");
        $("#data_validade").mask("99/9999");
    });

    switch ("{{ uri.getPath() }}") {
        case "/":
            $("#home").attr("class", "active");
            break;
        case "/livros":
            $("#livros").attr("class", "active");
            break;
    }

    $(function() {
        $('table#table_lista_itens_fatura tbody tr').hover(
            function(){
                $(this).addClass('destaque');
            },
            function(){
                $(this).removeClass('destaque');
            }
        );
    });

    $(function(){
        $(".remove-color-name").click(function(){
            $("#name").val("").css("background", "white");
            $("#name").css("color", "black");
        });
    });

    $(function(){
        $(".remove-color-email").click(function(){
            $("#email").val("").css("background", "white");
            $("#email").css("color", "black");
        });
    });

    $(function(){
        $(".remove-color-password").click(function(){
            $("#password").val("").css("background", "white");
            $("#password").attr("type", "password").css("color", "black");
        });
    });

    $(function(){
        $(".remove-color-re-password").click(function(){
            $("#re_password").val("").css("background", "white");
            $("#re_password").attr("type", "password").css("color", "black");
        });
    });

    $(function(){
        $(".remove-color-input-cbanco").click(function(){
            $("#cod_banco").val("").css("background", "white");
            $("#cod_banco").attr("type", "text").css("color", "black");
        });
    });

    $(function(){
        $(".remove-color-input-nbanco").click(function(){
            $("#nome_banco").val("").css("background", "white");
            $("#nome_banco").attr("type", "text").css("color", "black");
        });
    });

    $(function(){
        $(".remove-color-input-money").click(function() {
            let str = $(this).val();
            if (str.indexOf("Preencha") > -1 || str.indexOf("Informe") > -1 || str.indexOf("Valor") > -1) {
                $(this).val("").css("background", "white").css("color", "black");
            }
        });
        $(".remove-color-input-money").focus(function() {
            let str = $(this).val();
            if (str.indexOf("Preencha") > -1 || str.indexOf("Informe") > -1 || str.indexOf("Valor") > -1) {
                $(this).val("").css("background", "white").css("color", "black");
            }
        });
    });

    $(function() {
        $(".remove-color-input").click(function() {
            let str = $(this).val();
            if (str.indexOf("Preencha") > -1 || str.indexOf("Números") > -1 || str.indexOf("caracters") > -1) {
                $(this).val("").css("background", "white");
                $(this).attr("type", "text").css("color", "black");            
            }
        });
        $(".remove-color-input").focus(function () {
            let str = $(this).val();
            if (str.indexOf("Preencha") > -1 || str.indexOf("Números") > -1 || str.indexOf("caracters") > -1) {
                $(this).val("").css("background", "white");
                $(this).attr("type", "text").css("color", "black");            
            }
        });
    });

    $(function() {
        $(".remove-color-input-date").click(function() {
            let str = $(this).val();
            if (str.indexOf("Preencha") > -1 || str.indexOf("Informe") > -1 || str.indexOf("Data") > -1) {
                $(this).val("").css("background", "white");
                $(this).attr("type", "date").css("color", "black");
            }    
        });
        $(".remove-color-input-date").focus(function () {
            let str = $(this).val();
            if (str.indexOf("Preencha") > -1 || str.indexOf("Informe") > -1 || str.indexOf("Data") > -1) {
                $(this).val("").css("background", "white");
                $(this).attr("type", "date").css("color", "black");
            }   
        });
    });

    $(function() {
        $(".remove-color-input-num-card").click(function() {
            $(this).mask("9999.9999.9999.9999");
            $(this).val("").css("background", "white");
            $(this).attr("type", "text").css("color", "black");
            
        });
        $(".remove-color-input-num-card").focus(function () {
            $(this).mask("9999.9999.9999.9999");
            $(this).val("").css("background", "white");
            $(this).attr("type", "text").css("color", "black");
        });
    });
    

    $(function(){
        $(".remove-color-option").click(function() {
            $(this).css("background", "white");
            $(this).find('option').css('color', 'black');
            $(this).css('color', 'black');
        });
        $(".remove-color-option").focus(function () {
            $(this).css("background", "white");
            $(this).find('option').css('color', 'black');
            $(this).css('color', 'black');
        });
    });


    $(function(){
        $("#tipo_conta").click(function () {
            $(this).find('option').css('color', 'black');
        });
    });

    $(function(){
        $("#banco").click(function () {
            $(this).find('option').css('color', 'black');
        });
    });

    $(function(){
        $("#categoria").click(function () {
            $(this).find('option').css('color', 'black');
        });
        $("#categoria").change(function () {
            $(this).css('color', 'black');
        });
    });

    $(function(){
        conta = $("#_has_conta").val();
        if (conta > 0) {
            $("#menu_div_banco").removeClass("disabled");
            $("#menu_div_extrato").removeClass("disabled");
            $("#menu_div_banco").removeClass("disabled");
            $("#menu_div_trasacoes").removeClass("disabled");
            $("#menu_div_cartao_credito").removeClass("disabled");
            $("#menu_div_agendamentos").removeClass("disabled");
            $("#menu_div_dashboards").removeClass("disabled");
        }    
    });

    $(function(){
        $("#btn-trocar-conta").click(function () {
            let url = '/conta/clean-session-conta';
            let _csrf_token = $("#_csrf_token").val();
            axios.get(url, {
                params: {
                     _csrf_token: _csrf_token
                }
            })
            .then(function(response) {
                if (response.status == 201) {
                    window.location.replace(response.data['base_url']);
                }
            })
            .catch(function(error) {
                if (error.response.status == 500) {
                    alert(error.response.data.error);
                }
            })
        });
    });


    // FORMULÁRIO QUITAR FATURA DE CARTÃO DE CRÉDITO
    $('#btn_pagar_fatura').click(function () {
        let vp = $("#valor_pagar").val();
        let vpg = replace(vp);
        if (vpg != "") {
            $('#span-success-quitar-fatura-cartao-credito').remove();
        }
        if (vpg != 0) {
            $('#valor_pagar').val(numberToReal(vpg));
        }
    });
    $(function () {
        $("#formPagarFatura").submit(function(e) {
            let url = $("#formPagarFatura").attr("action");
            let id_cartao_fat = $("#id_cartao_fat").val();
            let id_cartao_cre = $("#id_cartao_cre").val();
            let dt_vencimento = $("#dt_vencimento").val();
            let encargos = $("#encargos").val();
            let iof = $("#iof").val();
            let anuidade = $("#anuidade").val();
            let protecao_prem = $("#protecao_prem").val();
            let juros_fat = $("#juros_fat").val();
            let restante = $("#restante").val();
            let valor_total = $("#valor_total").val();
            let valor_pagar = $("#valor_pagar").val();
            

            let _csrf_token = $("#_csrf_token").val();
            let data = {id_cartao_fat: id_cartao_fat, id_cartao_cre: id_cartao_cre, dt_vencimento: dt_vencimento,
                encargos: encargos, iof: iof, anuidade: anuidade, protecao_prem: protecao_prem, juros_fat: juros_fat, restante: restante,
                valor_total: valor_total, valor_pagar: valor_pagar ,_csrf_token: _csrf_token};
            e.preventDefault();

            axios.post(url, simpleQueryString.stringify(data))
                .then(function(response) {
                    if (response.status == 201) {
                        $("#btn_novo_pgto_fatura").removeAttr('disabled');
                        $("#btn_calcular_fatura").attr('disabled', 'disabled');
                        $("#btn_pagar_fatura").attr('disabled', 'disabled');
                        $("#btn_limpar_pgto_fatura").attr('disabled', 'disabled');
                        $("#encargos").attr('disabled', 'disabled');
                        $("#iof").attr('disabled', 'disabled');
                        $("#anuidade").attr('disabled', 'disabled');
                        $("#protecao_prem").attr('disabled', 'disabled');
                        $("#juros_fat").attr('disabled', 'disabled');
                        $("#valor_pagar").attr('disabled', 'disabled');
                        $("#div-msg-quitar-fatura-cartao-credito").html("<span class='alert alert-success msgSuccess' id='span-success-quitar-fatura-cartao-credito'>"+ response.data['success'] +"</span>").css("display", "block");
                    }
                })
                .catch(function(error) {
                    if (error.response.status == 500) {
                        if (!error.response.data.error['error_valor_pagar'] == "") {
                            $("#div-msg-quitar-fatura-cartao-credito").html("<span class='alert alert-danger msgError' id='span-success-quitar-fatura-cartao-credito'>"+ error.response.data.error['error_valor_pagar'] +"</span>").css("display", "block");
                        }

                        if (!error.response.data.error['error_token_conta'] == "") {
                            $("#div-msg-quitar-fatura-cartao-credito").html("<span class='alert alert-danger msgError' id='span-success-quitar-fatura-cartao-credito'>"+ error.response.data.error['error_token_conta'] +"</span>").css("display", "block");
                        }
                    }
                })
        });    
    });


    // FORMULÁRIO FECHAR PAGAMENTO FATURA DE CARTÃO DE CRÉDITO
    $('#btn_limpar_pgto_fatura').click(function () {
        $("#encargos").val("");
        $("#iof").val("");
        $("#anuidade").val("");
        $("#protecao_prem").val("");
        $("#juros_fat").val("");
        $("#restante").val("");
        $("#valor_total").val("");
        $("#valor_pagar").val("");
        $('#span-success-quitar-fatura-cartao-credito').remove();
    });

    $('#btn_novo_pgto_fatura').click(function () {
        $("#btn_novo_pgto_fatura").attr('disabled', 'disabled');
        $("#btn_calcular_fatura").removeAttr('disabled');
        $("#btn_pagar_fatura").removeAttr('disabled');
        $("#btn_limpar_pgto_fatura").removeAttr('disabled');
        $("#encargos").removeAttr('disabled');
        $("#encargos").val('');
        $("#iof").removeAttr('disabled');
        $("#iof").val('');
        $("#anuidade").removeAttr('disabled');
        $("#anuidade").val('');
        $("#protecao_prem").removeAttr('disabled');
        $("#protecao_prem").val('');
        $("#juros_fat").removeAttr('disabled');
        $("#juros_fat").val('');
        $("#valor_pagar").removeAttr('disabled');
        $("#valor_pagar").val('');
        $('#span-success-quitar-fatura-cartao-credito').remove();
    });

    $('#btn_calcular_fatura').click(function () {
        let url = $('#action').val();
        let id_cartao_cre = $('#id_cartao_cre').val();
        let _csrf_token = $("#_csrf_token").val();
        let data = {id_cartao_cre: id_cartao_cre, _csrf_token: _csrf_token};

        let str = $('#subtotal').val();
        let subtotal = replace(str);

        let enc = $('#encargos').val();
        let encargos = replace(enc);
        if (encargos === "") {
            encargos = 0;
        }

        let i = $('#iof').val();
        let iof = replace(i);
        if (iof === "") {
            iof = 0;
        }
        let anu = $('#anuidade').val();
        let anuidade = replace(anu);
        if (anuidade === "") {
            anuidade = 0;
        }
        let prot = $('#protecao_prem').val();
        let protecao_prem = replace(prot);
        if (protecao_prem === "") {
            protecao_prem = 0;
        }
        let jur = $('#juros_fat').val();
        let juros_fat = replace(jur);
        if (juros_fat === "") {
            juros_fat = 0;
        }
        let rest = $('#restante').val();
        let restante = replace(rest);
        if (restante === "") {
            restante = 0;
        }
        let valor_pg = $('#valor_pagar').val();
        let valor_pagar = replace(valor_pg);
        if (valor_pagar === "") {
            valor_pagar = 0;
        }
        let total = 0;
        if (subtotal > 0) {
            total = (parseFloat(subtotal) + parseFloat(encargos) + parseFloat(iof) + parseFloat(anuidade) + parseFloat(protecao_prem)
                + parseFloat(juros_fat) + parseFloat(restante));
            //let num = total.toString();   
            //let tot = num.replace('.',',');
        }

        axios.post(url, simpleQueryString.stringify(data))
        .then(function(response) {
            if (response.status == 202) {
                let val = response.data['value'].toString();
                let res = val.replace('.',',');
                if (res == 0) {
                    res = '0,00';
                }
                $('#restante').val('R$ ' + res);
            }
        })
        .catch(function(error) {
            if (error.response.status == 500) {
                if (!error.response.data.error['error_fatura'] == "") {
                    $("#div-msg-pagar-fatura-cartao-credito").html("<span class='alert alert-danger msgError' id='span-success-pagar-fatura-cartao-credito'>"+ error.response.data.error['error_fatura'] +"</span>").css("display", "block");
                    $("#fatura").css("background", "#EBA8A3").css("color", "white");
                } else {
                    $("#fatura").css("background", "#ffffb1").css("color", "black");
                }

                if (!error.response.data.error['error_token_conta'] == "") {
                    $("#div-msg-pagar-fatura-cartao-credito").html("<span class='alert alert-danger msgError' id='span-success-pagar-fatura-cartao-credito'>"+ error.response.data.error['error_token_conta'] +"</span>").css("display", "block");
                }
            }
        })
        if (encargos != 0) {
            $('#encargos').val(numberToReal(encargos));
        }
        if (iof != 0) {
            $('#iof').val(numberToReal(iof));
        }
        if (anuidade != 0) {
            $('#anuidade').val(numberToReal(anuidade));
        }
        if (protecao_prem != 0) {
            $('#protecao_prem').val(numberToReal(protecao_prem));
        }
        if (juros_fat != 0) {
            $('#juros_fat').val(numberToReal(juros_fat));
        }
        if (valor_pagar != 0) {
            $('#valor_pagar').val(numberToReal(valor_pagar));
        }

        $('#valor_total').val(numberToReal(total));

    });

    function replace(str) {
        let encargos = str.replace('R$', '');
        encargos = encargos.replace(',', '.'); 
        return encargos;
    }
    function arred(val,casas) { 
        let aux = Math.pow(2,casas);
        return Math.floor(val * aux) / aux;
    }

    // FORMULÁRIO PAGAR FATURA DE CARTÃO DE CRÉDITO
    $('#btn-nov-pagar-fatura-cartao').click(function () {
        $("#btn-pagar-fatura-cartao").removeAttr('disabled');
        $("#btn-nov-pagar-fatura-cartao").attr('disabled', 'disabled');
        $("#fatura").removeAttr('disabled');
        $("#fatura").focus();
        $("#fatura").css("background", "white");
        $('#span-success-pagar-fatura-cartao-credito').remove();
        $("#fatura").val("");
    });
    $(function () {
        $("#formPagarFaturaCartaoCredito").submit(function(e) {
            let url = $("#formPagarFaturaCartaoCredito").attr("action");
            let fatura = $("#fatura").val();
            if (fatura != "") {
                $('#span-success-pagar-fatura-cartao-credito').remove();
            }

            let _csrf_token = $("#_csrf_token").val();
            
            let data = {fatura: fatura, _csrf_token: _csrf_token};
            e.preventDefault();

            axios.post(url, simpleQueryString.stringify(data))
                .then(function(response) {
                    if (response.status == 202) {
                        window.location.replace(response.data['base_url']);
                    }
                })
                .catch(function(error) {
                    if (error.response.status == 500) {
                        if (!error.response.data.error['error_fatura'] == "") {
                            $("#div-msg-pagar-fatura-cartao-credito").html("<span class='alert alert-danger msgError' id='span-success-pagar-fatura-cartao-credito'>"+ error.response.data.error['error_fatura'] +"</span>").css("display", "block");
                            $("#fatura").css("background", "#EBA8A3").css("color", "white");
                        } else {
                            $("#fatura").css("background", "#ffffb1").css("color", "black");
                        }

                        if (!error.response.data.error['error_token_conta'] == "") {
                            $("#div-msg-pagar-fatura-cartao-credito").html("<span class='alert alert-danger msgError' id='span-success-pagar-fatura-cartao-credito'>"+ error.response.data.error['error_token_conta'] +"</span>").css("display", "block");
                        }
                    }
                })
        });    
    });
     

    // FORMULÁRIO GERAR FATURA DE CARTÃO DE CRÉDITO
    $('#btn-nov-fatura-cartao').click(function () {
        $("#btn-fatura-cartao").removeAttr('disabled');
        $("#btn-nov-fatura-cartao").attr('disabled', 'disabled');
        $("#cartao").removeAttr('disabled');
        $("#cartao").focus();
        $("#data_pagamento").removeAttr('disabled');
        $("#cartao").css("background", "white");
        $("#data_pagamento").css("background", "white");
        $('#span-success-desp-fatura-cartao-credito').remove();
        $("#cartao").val("");
        $("#data_pagamento").val("");
    });
    $(function () {
        $("#formFaturaCartaoCredito").submit(function(e) {
            let url = $("#formFaturaCartaoCredito").attr("action");
            let cartao = $("#cartao").val();
            if (cartao != "") {
                $('#span-success-desp-fatura-cartao-credito').remove();
            }

            let data_pagamento = $("#data_pagamento").val();
            if (data_pagamento == 'Informe a Data do Pagamento!') {
                data_pagamento = "";
            }			

            let _csrf_token = $("#_csrf_token").val();
            
            let data = {cartao: cartao, data_pagamento: data_pagamento, _csrf_token: _csrf_token};
            e.preventDefault();

            axios.post(url, simpleQueryString.stringify(data))
                .then(function(response) {
                    if (response.status == 201) {
                        $("#btn-fatura-cartao").attr('disabled', 'disabled');
                        $("#btn-nov-fatura-cartao").removeAttr('disabled');
                        $("#cartao").attr('disabled', 'disabled');
                        $("#data_pagamento").attr('disabled', 'disabled');
                        $(".white").css("background", "#ffffb1");
                        $("#div-msg-gerar-fatura-cartao-credito").html("<span class='alert alert-success msgSuccess' id='span-success-desp-fatura-cartao-credito'>"+ response.data['success'] +"</span>").css("display", "block");
                    }
                })
                .catch(function(error) {
                    if (error.response.status == 500) {
                        if (!error.response.data.error['error_cartao'] == "") {
                            $("#div-msg-gerar-fatura-cartao-credito").html("<span class='alert alert-danger msgError' id='span-success-desp-fatura-cartao-credito'>"+ error.response.data.error['error_cartao'] +"</span>").css("display", "block");
                            $("#cartao").css("background", "#EBA8A3").css("color", "white");
                        } else {
                            $("#cartao").css("background", "#ffffb1").css("color", "black");
                        }

                        if (!error.response.data.error['error_data_pagamento'] == "") {
                            $("#data_pagamento").attr("type", "text");
                            $("#data_pagamento").val(error.response.data.error['error_data_pagamento']).css("background", "#EBA8A3").css("color", "white");
                        } else {
                            $("#data_pagamento").css("background", "#ffffb1");
                        }

                        if (!error.response.data.error['error_token_conta'] == "") {
                            $("#div-msg-gerar-fatura-cartao-credito").html("<span class='alert alert-danger msgError' id='span-success-desp-fatura-cartao-credito'>"+ error.response.data.error['error_token_conta'] +"</span>").css("display", "block");
                        }
                    }
                })
        });    
    });

    // FORMULÁRIO DE DESPESA DE CARTÃO DE CRÉDITO
    $('#btn-nov-desp-cartao').click(function () {
        $("#btn-desp-cartao").removeAttr('disabled');
        $("#btn-nov-desp-cartao").attr('disabled', 'disabled');
        $("#cartao").removeAttr('disabled');
        $("#cartao").focus();
        $("#descricao").removeAttr('disabled');
        $("#data_compra").removeAttr('disabled');
        $("#valor").removeAttr('disabled');
        $("#numero_parcela").removeAttr('disabled');
        $("#cartao").css("background", "white");
        $("#descricao").css("background", "white");
        $("#data_compra").css("background", "white");
        $("#valor").css("background", "white");
        $("#numero_parcela").css("background", "white");
        $('#span-success-desp-cartao-credito').remove();
        $("#cartao").find('option:selected').html("");
        $("#cartao").val("");
        $("#descricao").val("");
        $("#data_compra").val("");
        $("#valor").val("");
        $("#numero_parcela").val("");
    });
    $(function () {
        $("#formCadDespCartaoCredito").submit(function(e) {
            let url = $("#formCadDespCartaoCredito").attr("action");
            let cartao = $("#cartao").val();
            if (cartao == 'Informe o Cartão!') {
                cartao = "";
            }
            let descricao = $("#descricao").val();
            if (descricao == 'Preencha a Descrição!' || descricao == 'Descrição sem Números!' || descricao == 'Descrição acima de 3 caracters!') {
                descricao = "";
            }			
            let data_compra = $("#data_compra").val();
            if (data_compra == 'Informe a Data da Compra!') {
                data_compra = "";
            }
            let valor = $("#valor").val();
            if (valor == 'Preencha o Valor!' || valor == 'Valor somente Números!') {
                valor = "";
            }
            let numero_parcela = $("#numero_parcela").val();
            if (numero_parcela == 'Informe o Número de Parcela(s)!' || numero_parcela == 'Número de Parcela(s) somente Números') {
                numero_parcela = "";
            }
            let _csrf_token = $("#_csrf_token").val();
            let data = {cartao: cartao, descricao: descricao, data_compra: data_compra, valor: valor,
                numero_parcela: numero_parcela, _csrf_token: _csrf_token};
            e.preventDefault();

            axios.post(url, simpleQueryString.stringify(data))
                .then(function(response) {
                    if (response.status == 201) {
                        $("#btn-desp-cartao").attr('disabled', 'disabled');
                        $("#btn-nov-desp-cartao").removeAttr('disabled');
                        $("#cartao").attr('disabled', 'disabled');
                        $("#descricao").attr('disabled', 'disabled');
                        $("#data_compra").attr('disabled', 'disabled');
                        $("#valor").attr('disabled', 'disabled');
                        $("#numero_parcela").attr('disabled', 'disabled');
                        $(".white").css("background", "#ffffb1");
                        $("#div-msg-cadastro-desp-cartao-credito").html("<span class='alert alert-success msgSuccess' id='span-success-desp-cartao-credito'>"+ response.data['success'] +"</span>").css("display", "block");
                    }
                })
                .catch(function(error) {
                    if (error.response.status == 500) {
                        if (!error.response.data.error['error_cartao'] == "") {
                            $("#cartao").find('option:selected').html(error.response.data.error['error_cartao']);
                            $("#cartao").css("background", "#EBA8A3").css("color", "white");
                        } else {
                            $("#cartao").css("background", "#ffffb1").css("color", "black");
                        }

                        if (!error.response.data.error['error_descricao'] == "") {
                            $("#descricao").val(error.response.data.error['error_descricao']).css("background", "#EBA8A3").css("color", "white");
                        } else {
                            $("#descricao").css("background", "#ffffb1");
                        }

                        if (!error.response.data.error['error_data_compra'] == "") {
                            $("#data_compra").attr("type", "text");
                            $("#data_compra").val(error.response.data.error['error_data_compra']).css("background", "#EBA8A3").css("color", "white");
                        } else {
                            $("#data_compra").css("background", "#ffffb1");
                        }

                        if (!error.response.data.error['error_valor'] == "") {
                            $("#valor").val(error.response.data.error['error_valor']).css("background", "#EBA8A3").css("color", "white");
                        } else {
                            $("#valor").css("background", "#ffffb1");
                        }

                        if (!error.response.data.error['error_numero_parcela'] == "") {
                            $("#numero_parcela").find('option:selected').html(error.response.data.error['error_numero_parcela']);
                            $("#numero_parcela").css("background", "#EBA8A3").css("color", "white");
                        } else {
                            $("#numero_parcela").css("background", "#ffffb1").css("color", "black");
                        }

                        if (!error.response.data.error['error_token_conta'] == "") {
                            $("#div-msg-cadastro-desp-cartao-credito").html("<span class='alert alert-danger msgError' id='span-success-desp-cartao-credito'>"+ error.response.data.error['error_token_conta'] +"</span>").css("display", "block");
                        }
                    }
                })
        });    
    });


    // FORMULÁRIO EXTRATO POR PERÍODO
    $('#btn-nov-extrato').click(function () {
        $("#btn-bus-extrato").removeAttr('disabled');
        $("#btn-nov-extrato").attr('disabled', 'disabled');
        $("#data_inicial").removeAttr('disabled');
        $("#data_inicial").focus();
        $("#data_final").removeAttr('disabled');
        $("#data_inicial").css("background", "white");
        $("#data_final").css("background", "white");
        $('#span-success-bus-extrac-per').remove();
        $("#data_inicial").val("");
        $("#data_final").val("");
    });
    $(function () {
        $("#formExtratoPeriodo").submit(function(e) {
            let url = $("#formExtratoPeriodo").attr("action");
            let data_inicial = $("#data_inicial").val();
            if (data_inicial == 'Preencha a Data Inicial!') {
                data_inicial = "";
            }

			let data_final = $("#data_final").val();
            if (data_final == 'Preencha a Data Final!') {
                data_final = "";
            }			
			
            let _csrf_token = $("#_csrf_token").val();
            let data = {data_inicial: data_inicial, data_final: data_final, _csrf_token: _csrf_token};
            e.preventDefault();

            axios.post(url, simpleQueryString.stringify(data))
                .then(function(response) {
                    if (response.status == 201) {
                        $("#well_extrato").html(generateTableExtract(response.data.extrato));               
                    }
                })
                .catch(function(error) {
                    if (error.response.status == 500) {
                        if (!error.response.data.error['error_data_inicial'] == "") {
                            $("#data_inicial").attr("type", "text");
                            $("#data_inicial").val(error.response.data.error['error_data_inicial']).css("background", "#EBA8A3").css("color", "white");
                        } else {
                            $("#data_inicial").css("background", "#ffffb1");
                        }

                        if (!error.response.data.error['error_data_final'] == "") {
                            $("#data_final").attr("type", "text");
                            $("#data_final").val(error.response.data.error['error_data_final']).attr("type", "text").css("background", "#EBA8A3").css("color", "white");
                        } else {
                            $("#data_final").css("background", "#ffffb1");
                        }
						
                        if (!error.response.data.error['error_token_conta'] == "") {
                            $("#div-msg-extrato").html("<span class='alert alert-danger msgError' id='span-success-bus-extrac-per'>"+ error.response.data.error['error_token_conta'] +"</span>").css("display", "block");
                        }

                    }
                })
        });    
    });

    // FORMULÁRIO DE CRÉDITO CONTA
    $('#btn-nov-credito').click(function () {
        $("#btn-cad-credito").removeAttr('disabled');
        $("#btn-nov-credito").attr('disabled', 'disabled');
        $("#data_movimentacao_deb").removeAttr('disabled');
        $("#data_movimentacao_deb").focus();
        $("#movimentacao").removeAttr('disabled');
        $("#valor").removeAttr('disabled');
        $("#categoria").removeAttr('disabled');
        $("#data_movimentacao_deb").css("background", "white");
        $("#movimentacao").css("background", "white");
        $("#valor").css("background", "white");
        $("#categoria").css("background", "white");
        $('#span-success-cadastro-credito').remove();
        $("#data_movimentacao_deb").val("");
        $("#movimentacao").val("");
        $("#valor").val("");
        $("#categoria").val("");
    });
    $(function () {
        $("#formCadCredito").submit(function(e) {
            let url = $("#formCadCredito").attr("action");
            let data_movimentacao_deb = $("#data_movimentacao_deb").val();
            let movimentacao = $("#movimentacao").val();
            if (movimentacao == 'Preencha a Movimentação!' || movimentacao == 'Movimentação sem Números!' || movimentacao == 'Movimentação acima de 3 caracters!') {
                movimentacao = "";
            }
            let valor = $("#valor").val();
            if (valor == 'Preencha o Valor!') {
                valor = "";
            }
            let categoria = $("#categoria").val();
            if (categoria == 'Preencha a Categoria!') {
                categoria = "";
            }
            let _csrf_token = $("#_csrf_token").val();
            let data = {data_movimentacao_deb: data_movimentacao_deb, movimentacao: movimentacao, valor: valor,
                categoria: categoria, _csrf_token: _csrf_token};
            e.preventDefault();

            axios.post(url, simpleQueryString.stringify(data))
                .then(function(response) {
                    if (response.status == 201) {
                        $("#btn-cad-credito").attr('disabled', 'disabled');
                        $("#btn-nov-credito").removeAttr('disabled');
                        $("#data_movimentacao_deb").attr('disabled', 'disabled');
                        $("#movimentacao").attr('disabled', 'disabled');
                        $("#valor").attr('disabled', 'disabled');
                        $("#categoria").attr('disabled', 'disabled');
                        $(".white").css("background", "#ffffb1");
                        $("#div-msg-cadastro-credito").html("<span class='alert alert-success msgSuccess' id='span-success-cadastro-credito'>"+ response.data['success'] +"</span>").css("display", "block");
                    }
                })
                .catch(function(error) {
                    if (error.response.status == 500) {
                        if (!error.response.data.error['error_data_mov'] == "") {
                            $("#data_movimentacao_deb").html(error.response.data.error['error_data_mov']).css("background", "#EBA8A3").css("color", "white");
                        } else {
                            $("#data_movimentacao_deb").css("background", "#ffffb1");
                        }

                        if (!error.response.data.error['error_mov'] == "") {
                            $("#movimentacao").val(error.response.data.error['error_mov']).css("background", "#EBA8A3").css("color", "white");
                        } else {
                            $("#movimentacao").css("background", "#ffffb1");
                        }

                        if (!error.response.data.error['error_valor'] == "") {
                            $("#valor").val(error.response.data.error['error_valor']).css("background", "#EBA8A3").css("color", "white");
                        } else {
                            $("#valor").css("background", "#ffffb1");
                        }

                        if (!error.response.data.error['error_categoria'] == "") {
                            $("#categoria").find('option:selected').html(error.response.data.error['error_categoria']);
                            $("#categoria").css("background", "#EBA8A3").css("color", "white");
                        } else {
                            $("#categoria").css("background", "#ffffb1").css("color", "black");
                        }

                        if (!error.response.data.error['error_saldo'] == "") {
                            $("#div-msg-cadastro-credito").html("<span class='alert alert-danger msgError' id='span-success-cadastro-credito'>"+ error.response.data.error['error_saldo'] +"</span>").css("display", "block");
                        }

                        if (!error.response.data.error['error_token_conta'] == "") {
                            $("#div-msg-cadastro-credito").html("<span class='alert alert-danger msgError' id='span-success-cadastro-credito'>"+ error.response.data.error['error_token_conta'] +"</span>").css("display", "block");
                        }

                    }
                })
        });    
    });


    // FORMULÁRIO DE DÉBITO CONTA
    $('#btn-nov-debito').click(function () {
        $("#btn-cad-debito").removeAttr('disabled');
        $("#btn-nov-debito").attr('disabled', 'disabled');
        $("#data_movimentacao_deb").removeAttr('disabled');
        $("#data_movimentacao_deb").focus();
        $("#movimentacao").removeAttr('disabled');
        $("#valor").removeAttr('disabled');
        $("#categoria").removeAttr('disabled');
        $("#data_movimentacao_deb").css("background", "white");
        $("#movimentacao").css("background", "white");
        $("#valor").css("background", "white");
        $("#categoria").css("background", "white");
        $('#span-success-cadastro-debito').remove();
        $("#data_movimentacao_deb").val("");
        $("#movimentacao").val("");
        $("#valor").val("");
        $("#categoria").val("");
    });
    $(function () {
        $("#formCadDebito").submit(function(e) {
            let url = $("#formCadDebito").attr("action");
            let data_movimentacao_deb = $("#data_movimentacao_deb").val();
            let movimentacao = $("#movimentacao").val();
            if (movimentacao == 'Preencha a Movimentação!' || movimentacao == 'Movimentação sem Números!' || movimentacao == 'Movimentação acima de 3 caracters!') {
                movimentacao = "";
            }
            let valor = $("#valor").val();
            if (valor == 'Preencha o Valor!') {
                valor = "";
            }
            let categoria = $("#categoria").val();
            if (categoria == 'Preencha a Categoria!') {
                categoria = "";
            }
            let _csrf_token = $("#_csrf_token").val();
            let data = {data_movimentacao_deb: data_movimentacao_deb, movimentacao: movimentacao, valor: valor,
                categoria: categoria, _csrf_token: _csrf_token};
            e.preventDefault();

            axios.post(url, simpleQueryString.stringify(data))
                .then(function(response) {
                    if (response.status == 201) {
                        $("#btn-cad-debito").attr('disabled', 'disabled');
                        $("#btn-nov-debito").removeAttr('disabled');
                        $("#data_movimentacao_deb").attr('disabled', 'disabled');
                        $("#movimentacao").attr('disabled', 'disabled');
                        $("#valor").attr('disabled', 'disabled');
                        $("#categoria").attr('disabled', 'disabled');
                        $(".white").css("background", "#ffffb1");
                        $("#div-msg-cadastro-debito").html("<span class='alert alert-success msgSuccess' id='span-success-cadastro-debito'>"+ response.data['success'] +"</span>").css("display", "block");
                    }
                })
                .catch(function(error) {
                    if (error.response.status == 500) {
                        if (!error.response.data.error['error_data_mov'] == "") {
                            $("#data_movimentacao_deb").html(error.response.data.error['error_data_mov']).css("background", "#EBA8A3").css("color", "white");
                        } else {
                            $("#data_movimentacao_deb").css("background", "#ffffb1");
                        }

                        if (!error.response.data.error['error_mov'] == "") {
                            $("#movimentacao").val(error.response.data.error['error_mov']).css("background", "#EBA8A3").css("color", "white");
                        } else {
                            $("#movimentacao").css("background", "#ffffb1");
                        }

                        if (!error.response.data.error['error_valor'] == "") {
                            $("#valor").val(error.response.data.error['error_valor']).css("background", "#EBA8A3").css("color", "white");
                        } else {
                            $("#valor").css("background", "#ffffb1");
                        }

                        if (!error.response.data.error['error_categoria'] == "") {
                            $("#categoria").find('option:selected').html(error.response.data.error['error_categoria']);
                            $("#categoria").css("background", "#EBA8A3").css("color", "white");
                        } else {
                            $("#categoria").css("background", "#ffffb1").css("color", "black");
                        }

                        if (!error.response.data.error['error_saldo'] == "") {
                            $("#div-msg-cadastro-debito").html("<span class='alert alert-danger msgError' id='span-success-cadastro-debito'>"+ error.response.data.error['error_saldo'] +"</span>").css("display", "block");
                        }

                        if (!error.response.data.error['error_token_conta'] == "") {
                            $("#div-msg-cadastro-debito").html("<span class='alert alert-danger msgError' id='span-success-cadastro-debito'>"+ error.response.data.error['error_token_conta'] +"</span>").css("display", "block");
                        }

                    }
                })
        });    
    });


    // AGENDAMENTO DE PAGAMENTO
    $('#btn-nov-agd-pgto').click(function () {
        $("#btn-cad-agd-pgto").removeAttr('disabled');
        $("#btn-nov-agd-pgto").attr('disabled', 'disabled');
        $("#data_pagamento").removeAttr('disabled');
        $("#data_pagamento").focus();
        $("#movimentacao").removeAttr('disabled');
        $("#valor").removeAttr('disabled');
        $("#categoria").removeAttr('disabled');
        $("#data_pagamento").css("background", "white");
        $("#movimentacao").css("background", "white");
        $("#valor").css("background", "white");
        $("#categoria").css("background", "white");
        $('#span-success-cadastro-agd-pgto').remove();
        $("#data_pagamento").val("");
        $("#movimentacao").val("");
        $("#valor").val("");
        $("#categoria").val("");
    });

    $(function () {
        $("#formCadAgendamentoPagamento").submit(function(e) {
            let url = $("#formCadAgendamentoPagamento").attr("action");
            let data_pagamento = $("#data_pagamento").val();
            let movimentacao = $("#movimentacao").val();
            if (movimentacao == 'Preencha a Movimentação!') {
                movimentacao = "";
            }
            let valor = $("#valor").val();
            if (valor == 'Preencha o Valor!') {
                valor = "";
            }
            let categoria = $("#categoria").val();
            if (categoria == 'Preencha a Categoria!') {
                categoria = "";
            }
            let _csrf_token = $("#_csrf_token").val();
            let data = {data_pagamento: data_pagamento, movimentacao: movimentacao, valor: valor,
                categoria: categoria, _csrf_token: _csrf_token};
            e.preventDefault();

            axios.post(url, simpleQueryString.stringify(data))
                .then(function(response) {
                    if (response.status == 201) {
                        $("#btn-cad-agd-pgto").attr('disabled', 'disabled');
                        $("#btn-nov-agd-pgto").removeAttr('disabled');
                        $("#data_pagamento").attr('disabled', 'disabled');
                        $("#movimentacao").attr('disabled', 'disabled');
                        $("#valor").attr('disabled', 'disabled');
                        $("#categoria").attr('disabled', 'disabled');
                        $(".white").css("background", "#ffffb1");
                        $("#div-msg-cadastro-agd-pgto").html("<span class='alert alert-success msgSuccess' id='span-success-cadastro-agd-pgto'>"+ response.data['success'] +"</span>").css("display", "block");
                    }
                })
                .catch(function(error) {
                    if (error.response.status == 500) {
                        if (!error.response.data.error['error_data_pgto'] == "") {
                            $("#data_pagamento").html(error.response.data.error['error_data_pgto']).css("background", cor_input).css("color", "white");
                        } else {
                            $("#data_pagamento").css("background", "#ffffb1");
                        }

                        if (!error.response.data.error['error_movimentacao'] == "") {
                            $("#movimentacao").val(error.response.data.error['error_movimentacao']).css("background", cor_input).css("color", "white");
                        } else {
                            $("#movimentacao").css("background", "#ffffb1");
                        }

                        if (!error.response.data.error['error_valor'] == "") {
                            $("#valor").val(error.response.data.error['error_valor']).css("background", cor_input).css("color", "white");
                        } else {
                            $("#valor").css("background", "#ffffb1");
                        }

                        if (!error.response.data.error['error_categoria'] == "") {
                            $("#categoria").find('option:selected').html(error.response.data.error['error_categoria']);
                            $("#categoria").css("background", cor_input).css("color", "white");
                        } else {
                            $("#categoria").css("background", "#ffffb1").css("color", "black");
                        }

                        if (!error.response.data.error['error-token-banco'] == "") {
                            $("#div-msg-cadastro-banco").html("<span class='alert alert-danger msgError' id='span-success-cadastro-banco'>"+ error.response.data.error['error-token-banco'] +"</span>").css("display", "block");
                        }

                    }
                })
        });    
    });


    // CADASTRO DE CARTÃO DE CRÉDITO
    $('#btn-nov-cartao').click(function () {
        $("#btn-cad-cartao").removeAttr('disabled');
        $("#btn-nov-cartao").attr('disabled', 'disabled');
        $("#numero_cartao").removeAttr('disabled');
        $("#numero_cartao").focus();
        $("#data_validade").removeAttr('disabled');
        $("#bandeira").removeAttr('disabled');
        $("#banco").removeAttr('disabled');
		$("#dia_pgto_fatura").removeAttr('disabled');
        $("#numero_cartao").css("background", "white");
        $("#data_validade").css("background", "white");
        $("#bandeira").css("background", "white");
        $("#banco").css("background", "white");
		$("#dia_pgto_fatura").css("background", "white");
        $('#span-msg-cadastro-cartao').remove();
        $("#numero_cartao").val("");
        $("#data_validade").val("");
        $("#bandeira").val("");
        $("#banco").val("");
		$("#dia_pgto_fatura").val("");
    });

    $(function () {
        $("#formCadCartaoCredito").submit(function(e) {
            let url = $("#formCadCartaoCredito").attr("action");
            let numero_cartao = $("#numero_cartao").val();
            if (numero_cartao == 'Preencha o Número do Cartão!') {
                numero_cartao = "";
            }			
            let data_validade = $("#data_validade").val();
            if (data_validade == 'Informe a Data de Validade do Cartão') {
                data_validade = "";
            }
            let bandeira = $("#bandeira").val();
            if (bandeira == 'Informe a Bandeira do Cartão!') {
                bandeira = "";
            }
            let banco = $("#banco").val();
            if (banco == 'Informe a Banco do Cartão!') {
                banco = "";
            }
            let dia_pgto_fatura = $("#dia_pgto_fatura").val();
            if (dia_pgto_fatura == 'Informe o dia do Pagamento do Cartão!' || dia_pgto_fatura == 'Dia do Pagamento Somente Números!') {
                dia_pgto_fatura = "";
            }			
			
            let _csrf_token = $("#_csrf_token").val();
            let data = {numero_cartao: numero_cartao, data_validade: data_validade, bandeira: bandeira,
                banco: banco, dia_pgto_fatura: dia_pgto_fatura, _csrf_token: _csrf_token};
            e.preventDefault();

            axios.post(url, simpleQueryString.stringify(data))
                .then(function(response) {
                    if (response.status == 201) {
                        $("#btn-cad-cartao").attr('disabled', 'disabled');
                        $("#btn-nov-cartao").removeAttr('disabled');
                        $("#numero_cartao").attr('disabled', 'disabled');
                        $("#data_validade").attr('disabled', 'disabled');
                        $("#bandeira").attr('disabled', 'disabled');
                        $("#banco").attr('disabled', 'disabled');
						$("#dia_pgto_fatura").attr('disabled', 'disabled');
                        $(".white").css("background", "#ffffb1");
                        $("#div-msg-cadastro-cartao-credito").html("<span class='alert alert-success msgSuccess' id='span-msg-cadastro-cartao'>"+ response.data['success'] +"</span>").css("display", "block");
                    }
                })
                .catch(function(error) {
                    if (error.response.status == 500) {
                        if (!error.response.data.error['error_numero_cartao'] == "") {
                            $("#numero_cartao").val(error.response.data.error['error_numero_cartao']).css("background", "#EBA8A3").css("color", "white");
                        } else {
                            $("#numero_cartao").css("background", "#ffffb1");
                        }

                        if (!error.response.data.error['error_data_validade'] == "") {
                            $("#data_validade").val(error.response.data.error['error_data_validade']).css("background", "#EBA8A3").css("color", "white");
                        } else {
                            $("#data_validade").css("background", "#ffffb1");
                        }

                        if (!error.response.data.error['error_bandeira'] == "") {
                            $("#bandeira").find('option:selected').html(error.response.data.error['error_bandeira']);
                            $("#bandeira").css("background", "#EBA8A3").css("color", "white");
                        } else {
                            $("#bandeira").css("background", "#ffffb1").css("color", "black");
                        }

                        if (!error.response.data.error['error_banco'] == "") {
                            $("#banco").find('option:selected').html(error.response.data.error['error_banco']);
                            $("#banco").css("background", "#EBA8A3").css("color", "white");
                        } else {
                            $("#banco").css("background", "#ffffb1").css("color", "black");
                        }
						
						if (!error.response.data.error['error_dia_pgto_fatura'] == "") {
                            $("#dia_pgto_fatura").val(error.response.data.error['error_dia_pgto_fatura']).css("background", "#EBA8A3").css("color", "white");
                        } else {
                            $("#dia_pgto_fatura").css("background", "#ffffb1");
                        }

                        if (!error.response.data.error['error_cartao'] == "") {
                            $("#div-msg-cadastro-cartao-credito").html("<span class='alert alert-danger msgError' id='span-msg-cadastro-cartao'>"+ error.response.data.error['error_cartao'] +"</span>").css("display", "block");
                        }

                        if (!error.response.data.error['error_token_cartao'] == "") {
                            $("#div-msg-cadastro-cartao-credito").html("<span class='alert alert-danger msgError' id='span-msg-cadastro-cartao'>"+ error.response.data.error['error_token_cartao'] +"</span>").css("display", "block");
                        }

                    }
                })
        });    
    });


    // ACESSA CONTA 
    $(function () {
        $("#table_contas input:radio").click(function(e) {
            let url = '/conta/list';
            let id_conta = $(this).val()
            let _csrf_token = $("#_csrf_token").val();
            e.preventDefault();
            axios.get(url, {
                    params: {
                        id_conta: id_conta,
                        _csrf_token: _csrf_token
                    }
                })
                .then(function(response) {
                    if (response.status == 201) {
                        window.location.replace(response.data['base_url']);
                    }
                })
                .catch(function(error) {
                    if (error.response.status == 500) {
                        alert(error.response.data.error);
                    }
                })

        });
    });

    // LOGIN USUÁRIO
    $(function () {
        $("#formLogin").submit(function(e) {
            let url = $("#formLogin").attr("action");
            let email = $("#email").val();
            let password = $("#password").val();
            let data = {email: email, password: password};
            $(".msgError").html("");
            $(".msgError").css("display", "none");

            e.preventDefault();

            axios.interceptors.response.use((response) => {
                window.localStorage.setItem('token', response.data.token);
            return response;
        });
            axios.post(url, simpleQueryString.stringify(data))
                .then(function(response) {
                    if (response.status == 202) {
                        window.location.replace(response.data['base_url']);
                    }
                })
                .catch(function(error) {
                    if (error.response.status == 401) {
                        $("#div-error-login").html("<span class='alert alert-danger msgError' id='span-error-login'>"+ error.response.data.error +"</span>");
                        $("#div-error-login").css("display", "block");
                    }
                })

        });
    });

    // CADASTRO NOVO USUÁRIO
    //cor fundo input
    let cor_input = "#EBA8A3";
    $(function () {
        $("#formRegister").submit(function(e) {
            let url = $("#formRegister").attr("action");
            let name = $("#name").val();
            if (name == 'Preencha o seu nome Completo' || name == '') {
                name = '';
            }
            let email = $("#email").val();
            let password = $("#password").val();
            let re_password = $("#re_password").val();
            let data = {name: name, email: email, password: password, re_password: re_password};

            e.preventDefault();
            axios.post(url, simpleQueryString.stringify(data))
                .then(function(response) {
                    if (response.status == 201) {
                        $(".white").css("background", "#ffffb1");
                        $("#div-success-cadastro-usuario").html("<span class='alert alert-success msgSuccess' id='span-success-cadastro-user'>"+ response.data['success'] +"</span>").css("display", "block");
                        setInterval(function() {
                            redirectPageLogin(response.data['base_url']);
                        }, 3000);
                    }
                })
                .catch(function(error) {
                    if (error.response.status == 500) {
                        if (!error.response.data.error['error-name'] == "") {
                            $("#name").val(error.response.data.error['error-name']).css("background", cor_input).css("color", "white");
                        } else {
                            $("#name").css("background", "#ffffb1");
                        }

                        if (!error.response.data.error['error-email'] == "") {
                            $("#email").val(error.response.data.error['error-email']).css("background", cor_input).css("color", "white");
                        } else {
                            $("#email").css("background", "#ffffb1");
                        }

                        if (!error.response.data.error['error-password'] == "") {
                            $("#password").val(error.response.data.error['error-password']).attr("type", "text").css("background", cor_input).css("color", "white");
                        } else {
                            $("#password").css("background", "#ffffb1");
                        }

                        if (!error.response.data.error['error-re-password'] == "") {
                            $("#re_password").val(error.response.data.error['error-re-password']).attr("type", "text").css("background", cor_input).css("color", "white");
                        } else {
                            $("#re_password").css("background", "#ffffb1");
                        }

                    }
                })
        });
    });

    // CADASTRO NOVO BANDEIRA CARTÃO
    $('#btn-nov-ban').click(function () {
        $("#btn-cad-ban").removeAttr('disabled');
        $("#btn-nov-ban").attr('disabled', 'disabled');
        $("#bandeira").removeAttr('disabled');
        $("#bandeira").focus();
        $("#bandeira").css("background", "white");
        $('#span-msg-cadastro-bandeira').remove();
        $("#bandeira").val("");
    });

    $(function () {
        $("#formCadBandeira").submit(function(e) {
            let url = $("#formCadBandeira").attr("action");
            let bandeira = $("#bandeira").val();
            if (bandeira == 'Preencha o Nome da Bandeira!' || bandeira == 'Bandeira já Cadastrada!' || bandeira == 'Bandeira somente Números!' ||  bandeira == '') {
                bandeira = '';
            }
            let _csrf_token = $("#_csrf_token").val();
            let data = {bandeira: bandeira, _csrf_token: _csrf_token};
            e.preventDefault();

            axios.post(url, simpleQueryString.stringify(data))
                .then(function(response) {
                    if (response.status == 201) {
                        $("#btn-cad-ban").attr('disabled', 'disabled');
                        $("#btn-nov-ban").removeAttr('disabled');
                        $("#bandeira").attr('disabled', 'disabled');
                        $(".white").css("background", "#ffffb1");
                        $("#div_msg_cadastro_bandeira").html("<span class='alert alert-success msgSuccess' id='span-msg-cadastro-bandeira'>"+ response.data['success'] +"</span>").css("display", "block");
                    }
                })
                .catch(function(error) {
                    if (error.response.status == 500) {
                        if (!error.response.data.error['error_nome_bandeira'] == "") {
                            $("#bandeira").val(error.response.data.error['error_nome_bandeira']).css("background", cor_input).css("color", "white");
                        } else {
                            $("#bandeira").css("background", "#ffffb1");
                        }

                        if (!error.response.data.error['error_bandeira'] == "") {
                            $("#div_msg_cadastro_bandeira").html("<span class='alert alert-danger msgError' id='span-msg-cadastro-bandeira'>"+ error.response.data.error['error_bandeira'] +"</span>").css("display", "block");
                        }

                        if (!error.response.data.error['error_token_bandeira'] == "") {
                            $("#div_msg_cadastro_bandeira").html("<span class='alert alert-danger msgError' id='span-msg-cadastro-bandeira'>"+ error.response.data.error['error_token_bandeira'] +"</span>").css("display", "block");
                        }
                    }
                })
        });    
    });

    // CADASTRO NOVO BANCO
    $('#btn-nov-bnc').click(function () {
        $("#btn-cad-bnc").removeAttr('disabled');
        $("#btn-nov-bnc").attr('disabled', 'disabled');
        $("#cod_banco").removeAttr('disabled');
        $("#nome_banco").removeAttr('disabled');
        $("#cod_banco").css("background", "white");
        $("#nome_banco").css("background", "white");
        $('#span-success-cadastro-banco').remove();
        $("#cod_banco").val("");
        $("#nome_banco").val("");
    });

    $(function () {
        $("#formCadBanco").submit(function(e) {
            let url = $("#formCadBanco").attr("action");
            let cod_banco = $("#cod_banco").val();
            if (cod_banco == 'Preencha o Código do Banco!' || cod_banco == 'Código do Banco já Cadastrado!' || cod_banco == '') {
                cod_banco = '';
            }
            let nome_banco = $("#nome_banco").val();
            if (nome_banco == 'Preencha o nome do Banco!' || nome_banco == '') {
                nome_banco = '';
            }
            let _csrf_token = $("#_csrf_token").val();
            let data = {cod_banco: cod_banco, nome_banco: nome_banco, _csrf_token: _csrf_token};
            e.preventDefault();

            axios.post(url, simpleQueryString.stringify(data))
                .then(function(response) {
                    if (response.status == 201) {
                        $("#btn-cad-bnc").attr('disabled', 'disabled');
                        $("#btn-nov-bnc").removeAttr('disabled');
                        $("#cod_banco").attr('disabled', 'disabled');
                        $("#nome_banco").attr('disabled', 'disabled');
                        $(".white").css("background", "#ffffb1");
                        $("#div-msg-cadastro-banco").html("<span class='alert alert-success msgSuccess' id='span-success-cadastro-banco'>"+ response.data['success'] +"</span>").css("display", "block");
                    }
                })
                .catch(function(error) {
                    if (error.response.status == 500) {
                        if (!error.response.data.error['error_data_pgto'] == "") {
                            $("#cod_banco").val(error.response.data.error['error_data_pgto']).css("background", cor_input).css("color", "white");
                        } else {
                            $("#cod_banco").css("background", "#ffffb1");
                        }

                        if (!error.response.data.error['error_movimentacao'] == "") {
                            $("#nome_banco").val(error.response.data.error['error_movimentacao']).css("background", cor_input).css("color", "white");
                        } else {
                            $("#nome_banco").css("background", "#ffffb1");
                        }

                        if (!error.response.data.error['error-token-banco'] == "") {
                            $("#div-msg-cadastro-banco").html("<span class='alert alert-danger msgError' id='span-success-cadastro-banco'>"+ error.response.data.error['error-token-banco'] +"</span>").css("display", "block");
                        }

                    }
                })
        });    
    });

    // CADASTRO NOVA CONTA
    $('#btn-nov-conta').click(function () {
        $("#btn-cad-conta").removeAttr('disabled');
        $("#btn-nov-conta").attr('disabled', 'disabled');
        $("#codigo_agencia").removeAttr('disabled');
        $("#digito_verificador_agencia").removeAttr('disabled');
        $("#numero_conta").removeAttr('disabled');
        $("#digito_verificador_conta").removeAttr('disabled');
        $("#codigo_operacao").removeAttr('disabled');
        $("#tipo_conta").removeAttr('disabled');
        $("#banco").removeAttr('disabled');
        $("#codigo_agencia").css("background", "white");
        $("#digito_verificador_agencia").css("background", "white");
        $("#numero_conta").css("background", "white");
        $("#digito_verificador_conta").css("background", "white");
        $("#codigo_operacao").css("background", "white");
        $("#tipo_conta").css("background", "white");
        $("#banco").css("background", "white");
        $('#span-success-cadastro-conta').remove();
        $("#codigo_agencia").val("");
        $("#digito_verificador_agencia").val("");
        $("#numero_conta").val("");
        $("#digito_verificador_conta").val("");
        $("#codigo_operacao").val("");
        $("#tipo_conta").val("");
        $("#banco").val("");
    });
    $(function () {
        $("#formCadConta").submit(function(e) {
            let url = $("#formCadConta").attr("action");

            let codigo_agencia = $("#codigo_agencia").val();
            if (codigo_agencia == 'Preencha o Código da Agência!' || codigo_agencia == 'Cód. da Agência somente Números!' || codigo_agencia == 'Cód. da Agência deve conter até 4 dígitos!' || codigo_agencia == '') {
                codigo_agencia = '';
            }

            let digito_verificador_agencia = $("#digito_verificador_agencia").val();
            if (digito_verificador_agencia == 'Díg. Verificador da Agência somente Números!' || digito_verificador_agencia == 'Díg. Verificador da Ag. deve conter 1 dígito!' || digito_verificador_agencia == '') {
                digito_verificador_agencia = '';
            }

            let numero_conta = $("#numero_conta").val();
            if (numero_conta == 'Preencha o Número da Conta!' || numero_conta == 'Número da Conta somente Números!' || numero_conta == 'Número da Conta deve conter até 9 dígitos!', numero_conta == '') {
                numero_conta = '';
            }

            let digito_verificador_conta = $("#digito_verificador_conta").val();
            if (digito_verificador_conta == 'Preencha o Dígito Verificador da Conta!' || digito_verificador_conta == 'Díg. Verif. da Conta somente Números!' || digito_verificador_conta == 'Díg. Verif. da Conta deve conter 1 dígito!', digito_verificador_conta == '') {
                digito_verificador_conta = '';
            }

            let codigo_operacao = $("#codigo_operacao").val();
            if (codigo_operacao == 'Cód. da Operação somente Números!' || codigo_operacao == 'Cód. da Operação deve conter até 3 dígitos!' || codigo_operacao == '') {
                codigo_operacao = '';
            }

            let tipo_conta = $("#tipo_conta").val();
            if (tipo_conta == 'Preencha o Tipo da Conta!' || tipo_conta == '') {
                tipo_conta = '';
            }

            let banco = $("#banco").val();
            if (banco == 'Selecione o Banco!' || banco == '') {
                banco = '';
            }

            let _csrf_token = $("#_csrf_token").val();

            let data = {codigo_agencia: codigo_agencia, digito_verificador_agencia: digito_verificador_agencia, 
                numero_conta: numero_conta, digito_verificador_conta: digito_verificador_conta, 
                codigo_operacao: codigo_operacao, tipo_conta: tipo_conta, banco: banco, _csrf_token: _csrf_token};
            e.preventDefault();

            axios.post(url, simpleQueryString.stringify(data))
                .then(function(response) {
                    if (response.status == 201) {
                        $("#btn-cad-conta").attr('disabled', 'disabled');
                        $("#btn-nov-conta").removeAttr('disabled');
                        $("#codigo_agencia").attr('disabled', 'disabled');
                        $("#digito_verificador_agencia").attr('disabled', 'disabled');
                        $("#numero_conta").attr('disabled', 'disabled');
                        $("#digito_verificador_conta").attr('disabled', 'disabled');
                        $("#codigo_operacao").attr('disabled', 'disabled');
                        $("#tipo_conta").attr('disabled', 'disabled');
                        $("#banco").attr('disabled', 'disabled');
                        $("#tipo_conta").css("background", "white").css("color", "black");
                        $("#banco").css("background", "white").css("color", "black");
                        $(".white").css("background", "white");
                        $("#div-msg-cadastro-conta").html("<span class='alert alert-success msgSuccess' id='span-success-cadastro-conta'>"+ response.data['success'] +"</span>").css("display", "block");
                        setInterval(function() {
                            redirectPageHome(response.data['base_url']);
                        }, 3000);
                    }
                })
                .catch(function(error) {
                    if (error.response.status == 500) {
                        if (!error.response.data.error['error-cod-agencia'] == "") {
                            $("#codigo_agencia").val(error.response.data.error['error-cod-agencia']).css("background", cor_input).css("color", "white");
                        } else {
                            $("#codigo_agencia").css("background", "#ffffb1");
                        }

                        if (!error.response.data.error['error-dig-ver-agencia'] == "") {
                            $("#digito_verificador_agencia").val(error.response.data.error['error-dig-ver-agencia']).css("background", cor_input).css("color", "white");
                        } else {
                            $("#digito_verificador_agencia").css("background", "white");
                        }

                        if (!error.response.data.error['error-num-conta'] == "") {
                            $("#numero_conta").val(error.response.data.error['error-num-conta']).css("background", cor_input).css("color", "white");
                        } else {
                            $("#numero_conta").css("background", "#ffffb1");
                        }

                        if (!error.response.data.error['error-dig-ver-conta'] == "") {
                            $("#digito_verificador_conta").val(error.response.data.error['error-dig-ver-conta']).css("background", cor_input).css("color", "white");
                        } else {
                            $("#digito_verificador_conta").css("background", "#ffffb1");
                        }

                        if (!error.response.data.error['error-cod-operacao'] == "") {
                            $("#codigo_operacao").val(error.response.data.error['error-cod-operacao']).css("background", cor_input).css("color", "white");
                        } else {
                            $("#codigo_operacao").css("background", "white");
                        }

                        if (!error.response.data.error['error_categoria'] == "") {
                            $("#tipo_conta").find('option:selected').html(error.response.data.error['error_categoria']);
                            $("#tipo_conta").css("background", cor_input).css("color", "white");
                        } else {
                            $("#tipo_conta").css("background", "#ffffb1").css("color", "black");
                        }

                        if (!error.response.data.error['error-tp-banco'] == "") {
                            $("#banco").find('option:selected').html(error.response.data.error['error-tp-banco']);
                            $("#banco").css("background", cor_input).css("color", "white");
                        } else {
                            $("#banco").css("background", "#ffffb1").css("color", "black");
                        }

                        if (!error.response.data.error['error-token-conta'] == "" || !error.response.data.error['error-conta'] == "") {
                            $("#div-msg-cadastro-conta").html("<span class='alert alert-danger msgError' id='span-success-cadastro-conta'>"+ error.response.data.error['error-token-conta'] +"</span>").css("display", "block");
                            $("#div-msg-cadastro-conta").html("<span class='alert alert-danger msgError' id='span-success-cadastro-conta'>"+ error.response.data.error['error-conta'] +"</span>").css("display", "block");
                        }

                    }
                })
        });    
    });

});




function redirectPageLogin(base_url) {
    return window.location.replace(base_url+"/auth/login");
}

function redirectPageHome(base_url) {
    return window.location.replace(base_url + "/");
}

function formateDate(inputFormat) {
    function pad(s) { return (s < 10) ? '0' + s : s; }
    let d = new Date(inputFormat);
    return [pad(d.getDate()), pad(d.getMonth()+1), d.getFullYear()].join('/');
}

function numberToReal(valor) {
    let numero = parseFloat(valor).toFixed(2).split('.');
    numero[0] = "R$ " + numero[0].split(/(?=(?:...)*$)/).join('.');
    return numero.join(',');
}

function generateTableExtract(datas) {

    let table = "<table class='table table-striped table-hover table-bordered table-condensed display' id='table_extrato_din'>";
    table +=  "<thead>";
    table +=   	"<tr>";
    table +=       "<th class='th'>Data</th>";
    table +=       "<th class='th'>Movimentação</th>";
    table +=       "<th class='th'>Categoria</th>";
    table +=       "<th class='th'>Valor</th>";
    table +=       "<th class='th'>Saldo</th>";
    table +=    "</tr>";
    table +=  "</thead>";
    table +=  "<tbody>";
    
        for (attr in datas) {
            table +=  "<tr>";
            if (datas[attr].tipo == 'D') {
                table += "<td class='fonte_data td'>" + formateDate(datas[attr].data_movimentacao) + "</td>";
                if (datas[attr].despesa_fixa == 'S') {
                    table += "<td class='fonte_despesa td'>" + datas[attr].movimentacao + "</td>";
                    table += "<td class='fonte_despesa td'>" + datas[attr].nome_categoria + "</td>";
                    table += "<td class='fonte_despesa td'>" + numberToReal(datas[attr].valor) + "</td>";
                    table += "<td class='fonte_despesa td'>" + numberToReal(datas[attr].saldo) + "</td>";
                } else {
                    table += "<td class='fonte_despesa_fixa td'>" + datas[attr].movimentacao + "</td>";
                    table += "<td class='fonte_despesa_fixa td'>" + datas[attr].nome_categoria + "</td>";
                    table += "<td class='fonte_despesa_fixa td'>" + numberToReal(datas[attr].valor) + "</td>";
                    table += "<td class='fonte_despesa_fixa td'>" + numberToReal(datas[attr].saldo) + "</td>";					
                }
            } else {
                table += "<td class='fonte_data td'>" + formateDate(datas[attr].data_movimentacao) + "</td>";
                table += "<td class='fonte_receita td'>" + datas[attr].movimentacao + "</td>";
                table += "<td class='fonte_receita td'>" + datas[attr].nome_categoria + "</td>";
                table += "<td class='fonte_receita td'>" + numberToReal(datas[attr].valor) + "</td>";
                table += "<td class='fonte_receita td'>" + numberToReal(datas[attr].saldo) + "</td>";
            }
            table +=  "</tr>";	
        }
    
    table +=  "</tbody>";	
    table += "</table>";	

    table += "<script>";
    table +=    "$('#table_extrato_din').ready(function() {";
    table +=        "$('#table_extrato_din').DataTable( {";
    table +=        "'scrollY': '470px',";    
    table +=        "'scrollCollapse': true,";
    table +=        "'paging': false,";
    table +=        "'bInfo': false,";
    table +=        "'searching': false,";
    table +=        "});";    
    table +=    "});";
    table += "</script>";
    
    return table;            
}


