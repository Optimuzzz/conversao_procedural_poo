<?php
session_start();
include "../model/LoginModel.php";

$content = file_get_contents("php://input");

$_arr = json_decode($content, true);
$login = $_arr['login'];
$senha = md5($_arr['senha']);

$model = new LoginModel(); //instancia da classe

$rs = $model->logar($login, $senha);

if ($rs['status'] == 200) {
    $_SESSION["nome"] = $rs["nome"]; //guardando um valor em sessão
    $_SESSION["perfil"] = $rs["perfil"];
}

echo json_encode($rs, JSON_INVALID_UTF8_IGNORE);
