<?php
//se não (!) estiver vazio
if(!empty($_POST['nome'])){

    $nome = $_POST['nome'];

    include "config/conexao.php";
    include "config/utils.php";

$stmt = $con->prepare("SELECT * FROM cliente INNER JOIN endereco ON cliente.idCliente = endereco.idCliente WHERE nome LIKE ? '%';");
$stmt->bindParam(1,$nome);

$stmt->execute();
if($stmt->rowCount() > 0){
    //echo "encontrou!";
    while($row = $stmt->fetch()){
        //var_dump($row);
    ?>

    <div class="bg-white p-3 border w-75">

        <div class="mb-3 d-flex justify-content-between">
            <div class="mt-2">                    
             <?php echo $row["nome"]?> - 
             <?php echo $row["email"]?> - 
             <?php echo datatela($row["dtNasc"])?> - 
             <?php echo $row["cpf"]?>
            </div> 
    
            <button class="btn btn-primary" data-toggle="collapse" href="#cliente<?php echo $row[0]?>"> + </button>
    </div>    

         <div class="collapse" id="cliente<?php echo $row[0]?>">
             <h6>Dados de Endereço</h6>
             <?php echo $row["logradouro"]?>, <?php echo $row["numero"]?> <?php echo $row["complemento"]?> -  
             <?php echo $row["bairro"]?> -
             <?php echo $row["cidade"]?> -
             <?php echo $row["uf"]?> - 
             <?php echo $row["cep"]?>
        </div>
    </div>

    <hr>

    <?php
    
    }

}else{
    echo "<h5> nenhum cliente encontrado </h5>";
}
}

?>