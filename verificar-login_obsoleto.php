<?php

    session_start();// iniciando o uso da sessão

    // $login = $_POST["login"];
    // $senha = md5($_POST["senha"]);
    
    $content = file_get_contents("php://input");
    $_arr = json_decode($content, true);
    include "config/conexao.php";
    $senha = md5($_arr['senha']);
    $test = "SELECT * FROM usuario WHERE login = $_arr[login] AND senha = $_arr[senha]";

    $stmt = $con->prepare("SELECT * FROM usuario WHERE login = ? AND senha = ?");
    $stmt->bindParam(1, $_arr['login']);
    $stmt->bindParam(2, $senha);

    $stmt->execute();

    if($stmt->rowCount() == 1){
        //...
        $row = $stmt->fetch();// Armazendo em variável os dados que o banco retorna
        $_SESSION["nome"] = $row["nome"];//guardando um valor em sessão
        $_SESSION["perfil"] = $row["perfil"];
        
        echo json_encode(['status' => 200, 'message' => 'login efetuado com sucesso'], JSON_INVALID_UTF8_IGNORE);
        // header("location:painel.php");
        
    }else{
        //echo "erro";
        // $msg = "Login/Senha invávlido(s)";
        // header("location:index.php?msg=".$msg);
        echo json_encode(['status' => 401, 'message' => 'login e senha inválidos'], JSON_INVALID_UTF8_IGNORE);
    }

?>