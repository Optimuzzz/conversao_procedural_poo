<?php

    //include_once -> rejeita uma segunda inclusão
    include_once "config/utils.php";
    include_once "config/conexao.php";

     $nome = $_POST["nome"];
     $email = $_POST["email"];
     $dtNasc = databanco($_POST["dtNasc"]);
     $cpf = $_POST["cpf"];
     $cep = $_POST["cep"];
     $logradouro = $_POST["logradouro"];
     $numero = $_POST["numero"];
     $complemento = $_POST["complemento"];
     $bairro = $_POST["bairro"];
     $cidade = $_POST["cidade"];
     $uf = $_POST["uf"];

    //Iniciando a transação
     $con->beginTransaction();

    $stmt = $con->prepare("INSERT INTO cliente VALUES(?,?,?,?,now())");

    $stmt->bindParam(1,$nome);
    $stmt->bindParam(2,$email);
    $stmt->bindParam(3,$dtNasc);
    $stmt->bindParam(4,$cpf);

    if($stmt->execute()){
        //echo "gravou cliente";
        $idCliente = $con->lastInsertId();

        $stmt = $con->prepare("INSERT INTO endereco VALUES(null,?,?,?,?,?,?,?,?)");
        $stmt->bindParam(1, $logradouro);
        $stmt->bindParam(2, $numero);
        $stmt->bindParam(3, $complemento);
        $stmt->bindParam(4, $cep);
        $stmt->bindParam(5, $bairro);
        $stmt->bindParam(6, $cidade);
        $stmt->bindParam(7, $uf);
        $stmt->bindParam(8, $idCliente);

        if($stmt->execute()){
            $msg =  "Cliente cadastrado com sucesso!";
            $con->commit();//confirma a transação
        }else{
            $msg = "erro no endereço!";
            $con->rollBack(); //Desfaz a transação até o último commit
        }

    }else{
        $msg =  "erro no cliente";
    }
     
?>

<script>
    alert('<?php echo $msg; ?>');
    location.href='cadastrar-cliente.php';
</script>
