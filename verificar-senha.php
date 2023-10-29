<?php

    $email = $_POST["email"];

    include "config/conexao.php";

    $stmt = $con->prepare("SELECT email FROM usuario WHERE email = ?");
    $stmt-> bindParam(1, $email);

    $stmt->execute();

    if($stmt->rowCount() == 1){
        //echo "$email";
        $novasenha = "crud".date("His");
        echo "$novasenha";

        $stmt = $con->prepare("UPDATE usuario SET senha = md5(?) WHERE email = ?");
        $stmt->bindParam(1, $novasenha);
        $stmt->bindParam(2, $email);

        if($stmt->execute()){
            $msg = "senha atualizada e enviada para o seu e-mail!". $novasenha;

            $header = "Mime-version:1.0 \n";
            $header = $header. "Content-type:text/html;utf-8 \n";
            
            $header = $header. "From: ProjetoPHP <noreply@cotiinformatica.com.br> \n";
            //$header = $header. "Cc: ProjetoPHP <contatocopia@cotiinformatica.com.br> \n";
            //"copia oculta" -> $header = $header. "Bcc: ProjetoPHP <contatocopia@cotiinformatica.com.br> \n";
            $header = $header. "Reply-to: suporte@cotiinformatica.com.br \n"; //para quem será respondido o e-mail

            $msgEmail = "<P>Olá, segua sua nova senha <br> <strong>".$novasenha." </strong></p>";
            

            //envio do e-mail
            mail($email, "Recuperação de senha", $msgEmail, $header);
        

        }else{
            $msg = "ocorreu um erro, tente novamente";
        }
        header("location:index.php?msg=". $msg);

    }else{

        //echo "email não encontrado";
        $msg = "E-mail não cadastrado!";
        header("location:recuperar-senha.php?msg=". $msg);
    }


?>