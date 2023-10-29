const LoginController = (() => {

    const logar = (param) => {
        console.log(param)

        fetch('application/controller/loginController.php', {
            method: "POST",
            body: JSON.stringify(param),
            headers: { "Content-type": "application/json; charset=UTF-8" }
        }).then(response => response.json())
            .then((json) => {
                
                if (json.status == 200) {

                    $('#msg_login').text(json.message).removeClass('d-none alert-danger').addClass('alert-success');

                    setInterval(() => {
                        location.href = 'painel.php';
                    }, 1000);
                    return
                }

                $('#msg_login').text(json.message).removeClass('d-none');
            });
    }



    $('#btn_login').click(() => {

        const param = {
            logar: 1,
            login: $('#login').val(),
            senha: $('#senha').val()
        }

        logar(param);
    });



})();