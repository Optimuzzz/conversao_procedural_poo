<?php

    //Atualização em banco de dados
    //1 - Resgatar os dados do form

    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $login = $_POST["login"];
    $cod = $_POST["cod"];
    $perfil = $_POST["perfil"];

    //2 - Abrir conexão com o banco de dados

    //$con = new PDO("mysql:host=localhost;dbname=projetophp", "root", "");
        include "config/conexao.php";

    /*if ($con) {
        echo "Conectado com sucesso!";
    }*/

    //3 - Preparar a instrução SQL  de Atualização

    $stmt = $con->prepare("UPDATE usuario SET nome = ?, email= ?, login = ?, perfil = ? WHERE cod = ?");//instrução q vai ser exec
    $stmt->bindParam(1,$nome);
    $stmt->bindParam(2,$email);
    $stmt->bindParam(3,$login);
    $stmt->bindParam(4,$perfil);
    $stmt->bindParam(5,$cod);
    //valores 

    //4- Executar a instrução SQL
    if($stmt->execute()){
        $msg = "Usuário atualizado com sucesso!";
    }else{
        $msg = "Erro ao atualizar!";
    }

?>

<script>
    alert('<?php echo $msg; ?>');
    location.href='consultar-usuario.php';//Redirecionamento em JS
</script>