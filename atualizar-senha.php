<?php

    //Atualização em banco de dados
    //1 - Resgatar os dados do form
    
    $senha= md5($_POST["senha"]);
     $cod = $_POST["cod"];
    

    //2 - Abrir conexão com o banco de dados

    //$con = new PDO("mysql:host=localhost;dbname=projetophp", "root", "");
        include "config/conexao.php";

    /*if ($con) {
        echo "Conectado com sucesso!";
    }*/

    //3 - Preparar a instrução SQL  de Atualização

    $stmt = $con->prepare("UPDATE usuario SET senha = ? WHERE cod = ?");//instrução q vai ser exec
    $stmt->bindParam(1,$senha);
    $stmt->bindParam(2,$cod);

    //4- Executar a instrução SQL
    if($stmt->execute()){
        $msg = "Senha atualizada com sucesso!";
    }else{
        $msg = "Erro ao atualizar!";
    }

?>

<script>
    alert('<?php echo $msg; ?>');
    location.href='consultar-usuario.php';//Redirecionamento em JS
</script>