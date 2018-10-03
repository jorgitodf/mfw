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
    let cor_input = "#FF6347";
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


    function redirectPageLogin(base_url) {
        return window.location.replace(base_url+"/login");
    }

    function redirectPageHome(base_url) {
        return window.location.replace(base_url+"/");
    }

});

