

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

                <?php
                    $cod= base64_decode($_GET["cod"]);

                    include "config/conexao.php";
                    
                    $stmt = $con->prepare("SELECT * FROM usuario WHERE cod = ?");
                    $stmt->bindParam(1, $cod);
                    $stmt->execute();

                    $row = $stmt->fetch();//buscando os dados que o banco retornou e armazenando na variável
                    //var_dump($row);
                ?>

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Alteração do Usuário: <?php echo $row["nome"]; ?></h1>


                    <!-- Nome, e-mail, login, senha, perfil(adm/user) -->

                    <form action="atualizar-usuario.php" method="post" autocomplete="off" class="w-50"> 

                    <input type="hidden" name="cod" value="<?php echo $row["cod"]; ?>">

                    <div class="form-group">   
                        <label for="nome">Informe o nome do usuário</label>
                        <input type="text" class="form-control" id="nome" name="nome" required  value="<?php echo $row["nome"]; ?>">
                    </div>    
                    
                    <div class="form-group">   
                        <label for="e-mail">Informe o seu e-mail</label>
                        <input type="e-mail" class="form-control" id="e-mail" name="email" required value="<?php echo $row["email"]; ?>">
                    </div> 

                    <div class="form-group">   
                        <label for="login">Informe o seu login </label>
                        <input type="text" class="form-control" id="login" name="login" required value="<?php echo $row["login"]; ?>">
                    </div> 

                    <!-- <div class="form-group">   
                        <label for="senha">Informe o sua senha </label>
                        <input type="password" class="form-control" id="senha" name="senha" required placeholder="**************">
                    </div>  -->

                    <select name="perfil" class="custom-select" required>
                        <option value="" disabled selected> Escolha o perfil</option>
                        <option value="adm" <?php if($row["perfil"] == "adm") {echo "selected";}?> > Administrador</option>
                        <option value="user" <?php if($row["perfil"] == "user") {echo "selected";}?> >Usuário</option>
                    </select>

                    <button class="btn btn-primary mt-3">Atualizar Cadastro </button>


                    </form>


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
	
	
    
</body>
</html>