<?php
    $cod = $_GET["cod"];

    include "config/conexao.php";

    $stmt = $con->prepare("DELETE FROM usuario WHERE cod = ?");
    $stmt->bindParam(1,$cod);

    if($stmt->execute()){
        $msg = "Usuário excluído com sucesso!";
    }else{
        $msg = "Erro ao excluir usuário";
    }
?>

<script>
    alert('<?php echo $msg; ?>');
    location.href="consultar-usuario.php";
</script>