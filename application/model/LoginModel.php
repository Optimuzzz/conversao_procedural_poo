<?php
include "../database/conexao.php";
class LoginModel extends conexao
{
    public function logar($login, $senha)
    {
        $stmt = $this->con->prepare("SELECT nome, perfil FROM usuario WHERE login = ? AND senha = ?");
        $stmt->bindParam(1, $login);
        $stmt->bindParam(2, $senha);

        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            //...
            $row = $stmt->fetch(); // Armazendo em variável os dados que o banco retorna

            return [
                'status' => 200,
                'message' => 'login efetuado com sucesso',
                'nome' => $row["nome"],
                'perfil' => $row["perfil"]
            ];

        } else {

            return ['status' => 401, 'message' => 'login e senha inválidos'];
        }
    }

    public function recuperarSenha($email)
    {
        
    }
}
