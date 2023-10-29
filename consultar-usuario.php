<?php include "config/auth.php";?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

    <title>Sistema CRUD</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">   
    
    <!-- Custom fonts for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" type="text/css">
    
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/css/bootstrap.min.css">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include"layout/sidebar.php"; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include "layout/topbar.php"; ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Consulta de usuários</h1>

                    <p>Digite um nome para pesquisar</p>
                    <hr>
                    <form action="consultar-usuario.php" method="get" autocomplete="off">
                        
                        <input type="text" name="nome" class="form-class" placeholder="Ex: Ana Silva" > 
                        <button class="btn btn-primary">Pesquisar</button>

                    </form>
                    <!-- Local onde serão exibidos os resultados da busca -->
                    <div class="Resultado">
                        
                     <?php
                     //se exisitir (variavel foi declarado e está diferente de NULL)
                     if(isset($_GET["nome"])){
                        $nome = $_GET["nome"];
                        
                        include "config/conexao.php";
                        $stmt = $con->prepare("SELECT * FROM usuario WHERE nome LIKE ? '%' ORDER BY nome ");
                        $stmt->bindParam(1, $nome);

                        $stmt->execute();//executando a consulta
                                
                        //Se a consulta retornou algum registro
                        if($stmt->rowCount() > 0){
                        //echo "Usuário econtrado";

                        ?>

                        <table class="table mt-3">
                        <tr>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Login</th>
                            <th>Perfil</th>
                            <th class="text-center">Alterar senha</th>
                            <th class="text-center">Editar</th>
                            <th class="text-center">Excluir</th>
                        </tr>

                        <?php
                            while($row = $stmt->fetch()){
                            //var_dump($row);
                        ?>

                        <tr>
                            <td><?php echo $row["nome"];?></td>
                            <td><?php echo $row["email"];?></td>
                            <td><?php echo $row["login"];?></td>
                            <td><?php echo $row["perfil"];?></td>
                            <td class="text-center"><a href="alterar-senha.php?cod=<?php echo base64_encode($row[0]);?>"><i class="fas fa-key"></i></a></td>

                            <td class="text-center"><a href="editar-usuario.php?cod=<?php echo base64_encode($row[0]);?>" title="Editar <?php echo $row["nome"];?>"><i class="fas fa-user-edit"></i></a></td>

                            <td class="text-center"><a href="#" onclick="ConfirmarExclusão(<?php echo $row[0]?>,'<?php echo $row[1]?>')" title="Excluir <?php echo $row["nome"];?> "><i class="fas fa-user-times text-danger"></i></a></td>

                        </tr>
                        <?php } //fim do loop ?>
                        </table>

                        <?php
                            echo "Total de registros:".$stmt->rowCount();
                            }else {
                            echo"<br><h5> Nenhum usuário encontrado!</h5>";  
                            }


                            }
                            
                            
                        ?>

                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
                <?php include "layout/footer.php";?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    
    <?php include"layout/modal.php"; ?>
	
	

    <!-- Bootstrap core JavaScript-->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    
    <script>
        function ConfirmarExclusão(cod,nome){
            //alert(cod);
            if(confirm('Deseja realmente excluir '+nome+'?')){
                location.href='excluir-usuario.php?cod='+cod;
            }
        }
    </script>
	
	
    
</body>
</html>