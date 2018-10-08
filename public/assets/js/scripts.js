$(document).ready(function () {

    switch ("{{ uri.getPath() }}") {
        case "/":
            $("#home").attr("class", "active");
            break;
        case "/livros":
            $("#livros").attr("class", "active");
            break;
    }

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
        $(".remove-color-input").click(function(){
            $(this).val("").css("background", "white");
            $(this).attr("type", "text").css("color", "black");
        });
        $(".remove-color-input").focus(function () {
            $(this).val("").css("background", "white");
            $(this).attr("type", "text").css("color", "black");
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
                        if (!error.response.data.error['error-cod-banco'] == "") {
                            $("#cod_banco").val(error.response.data.error['error-cod-banco']).css("background", cor_input).css("color", "white");
                        } else {
                            $("#cod_banco").css("background", "#ffffb1");
                        }

                        if (!error.response.data.error['error-nome-banco'] == "") {
                            $("#nome_banco").val(error.response.data.error['error-nome-banco']).css("background", cor_input).css("color", "white");
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

                        if (!error.response.data.error['error-tp-conta'] == "") {
                            $("#tipo_conta").find('option:selected').html(error.response.data.error['error-tp-conta']);
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


    function redirectPageLogin(base_url) {
        return window.location.replace(base_url+"/auth/login");
    }

    function redirectPageHome(base_url) {
        return window.location.replace(base_url + "/");
    }

});

