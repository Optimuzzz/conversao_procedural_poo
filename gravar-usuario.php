<?php

    //Gravação em banco de dados
    //1 - Resgatar os dados do form

    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $login = $_POST["login"];
    $senha = md5($_POST["senha"]);
    $perfil = $_POST["perfil"];

    //2 - Abrir conexão com o banco de dados

    //$con = new PDO("mysql:host=localhost;dbname=projetophp", "root", "");
        include "config/conexao.php";
    //endereço, usuario, senha

    /*if ($con) {
        echo "Conectado com sucesso!";
    }*/

    //3 - Preparar a instrução SQL  de gravação

    $stmt = $con->prepare("INSERT INTO usuario VALUES(null, ?, ?, ?, ?, ?)");//instrução q vai ser exec
    $stmt->bindParam(1,$nome);
    $stmt->bindParam(2,$email);
    $stmt->bindParam(3,$login);
    $stmt->bindParam(4,$senha);
    $stmt->bindParam(5,$perfil);
    //valores 

    //4- Executar a instrução SQL
    if($stmt->execute()){
        $msg = "Usuário cadastrado com sucesso!";
    }else{
        $msg = "Erro ao gravar!";
    }

?>

<script>
    alert('<?php echo $msg; ?>');
    location.href='cadastrar-usuario.php';
</script>