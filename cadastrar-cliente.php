<?php include "config/auth.php"; ?>
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

    <style>
        /* formatando a msg de erro*/
        label.error{
            font-size: 12px;
            color: red;
        }
    </style>

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
                    <h1 class="h3 mb-4 text-gray-800">Cadastro do Cliente</h1>

                    <form action="gravar-cliente.php" method="post" autocomplete="off">

                        <div class="row"> 
                            <!-- md: tamanho da lacuna; mb: tamanho da borda -->
                            <!-- nome e email -->
                            <div class="col-md-6 mb-2"> 
                                <input type="text" name="nome" placeholder="Nome do Cliente" class="form-control">
                            </div>   
                            <div class="col-md-6 mb-2"> 
                                <input type="text" name="email" placeholder="E-mail do Cliente" class="form-control">
                            </div>  
                            <!-- datanasc e cpf -->
                            <div class="col-md-6 mb-2"> 
                                <input type="text" name="dtNasc" id="data" placeholder="Data de Nascimento" class="form-control">
                            </div>   
                            <div class="col-md-6 mb-2"> 
                                <input type="text" name="cpf" id="cpf" placeholder="CPF do Cliente" class="form-control">
                            </div>  
                            <!-- cep -->
                            <div class="col-md-12 mb-2"> 
                                <input type="text" name="cep" id="cep" placeholder="CEP do Cliente" class="form-control">
                            </div>
                            <!-- Logradouro, nº e complemento -->
                            <div class="col-md-6 mb-2"> 
                                <input type="text" name="logradouro" id="logradouro" placeholder="Logradouro"  class="form-control">
                            </div>   
                            <div class="col-md-2 mb-2"> 
                                <input type="text" name="numero" id="numero" placeholder="número" class="form-control">
                            </div>  
                            <div class="col-md-4 mb-2"> 
                                <input type="text" name="complemento" placeholder="Complemento" class="form-control">
                            </div> 
                            <!-- Bairro, cidade e uf -->
                            <div class="col-md-5 mb-2"> 
                                <input type="text" name="bairro" id="bairro" placeholder="Bairro" class="form-control">
                            </div>   
                            <div class="col-md-5 mb-2"> 
                                <input type="text" name="cidade" id="cidade" placeholder="Cidade" class="form-control">
                            </div>  
                            <div class="col-md-2 mb-2"> 
                                <input type="text" name="uf" id="uf" placeholder="UF" class="form-control">
                            </div> 
                        </div>
                        <button class="btn btn-primary">Realizar Cadastro</button>

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
    
    <?php include "layout/modal.php"; ?>
	
	

    <!-- Bootstrap core JavaScript-->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

    <script src="js/cpf-databr.js"></script>

    <script>
        //inicializando a biblioteca jQuery
        $(document).ready(function(){
            $('#data').mask('00/00/0000');
            $('#cpf').mask('000.000.000-00');
            $('#cep').mask('00000-000');

            //link da documentação https://jqueryvalidation.org/documentation/
            $('form').validate({
                rules : {
                    nome: {
                        required:true,
                        minlength: 3
                    },
                    email: {
                        required:true,
                        email: true
                    },
                    dtNasc:{
                        required: true,
                        dateBR: true
                    },
                    cpf:{
                        required: true,
                        cpf:true
                    }
                },
                messages:{
                    nome:{
                        required:'Por favor preencha o campo nome!',
                        minlength: 'Digite pelo menos 3 caracteres'
                    },
                    email:{
                        required: 'Por favor preencha o campo e-mail!',
                        email: 'Informe um e-mail válido!'
                    },
                    dtNasc:{
                        required: 'Por favor preencha o campo de data!'
                    },
                    cpf:{
                        required: 'Por favor preencha o campo cpf!'
                    }

                }                        
            });
                
            

            //evento de soltar uma tecla no campo cep e consultar API
            $('#cep').keyup(function(){
                
                let cepDigitado = $('#cep').val(); //guardando o valor do input em uma variável
                console.log(cepDigitado.length);//quant. de caract. de variável

                //se a quant. de caract. do cep está completa
                if(cepDigitado.length == 9){
                    $.getJSON('https://viacep.com.br/ws/'+cepDigitado+'/json/', 
                        function(dados){
                            //console.log(dados);

                        if(dados.erro != true){    
                        $('#logradouro').val(dados.logradouro);
                        $('#bairro').val(dados.bairro);
                        $('#cidade').val(dados.localidade);
                        $('#uf').val(dados.uf);
                        $('#numero').focus();
                        }else{
                            alert('cep não encontrado!');
                        }        

                    })

                }

            })
        })
    </script>
	
	
    
</body>
</html>