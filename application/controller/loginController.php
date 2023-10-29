<?php
session_start();
include "../model/LoginModel.php";

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'POST') {
    doPost();
} elseif ($method == 'GET') {
    doGet();
}

function doGet()
{

}

function doPost()
{
    $content = file_get_contents("php://input");
    $_arr = json_decode($content, true);
    $model = new LoginModel(); //instancia da classe

    if (isset($_arr['logar'])) {

        $login = $_arr['login'];
        $senha = md5($_arr['senha']);
    
    
        $rs = $model->logar($login, $senha);
    
        if ($rs['status'] == 200) {
            $_SESSION["nome"] = $rs["nome"]; //guardando um valor em sessão
            $_SESSION["perfil"] = $rs["perfil"];
        }

        echo json_encode($rs, JSON_INVALID_UTF8_IGNORE);
        return;
    }   

    if (isset($_arr['recuperar_senha'])) {
        $email = $_arr['email'];
        $rs = $model->recuperarSenha($email);
    //    echo json_encode($rs, JSON_INVALID_UTF8_IGNORE);
    //     return;
    }
    
       
  
}
