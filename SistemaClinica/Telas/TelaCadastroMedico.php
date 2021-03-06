<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../tmp'));
session_start();
include_once '../Login/ProtectPaginas.php';
protect();

if(isset($_SESSION["tipoUsuario"])){
    $tipo_user = $_SESSION["tipoUsuario"];
}

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Cadastro Profissional</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat+Alternates">
        <link href="https://fonts.googleapis.com/css?family=Raleway:600" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <link rel="stylesheet" type="text/css" href="../css/CadastroAtualizar.css">
        <link rel="stylesheet" type="text/css" href="../css/menu.css">
        <link href="https://fonts.googleapis.com/css?family=Raleway:700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Nunito:600" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="estilo.css" rel="stylesheet">
        <script src="../js/jquery-3.2.1.js"></script>
    	<script src="../js/login.js"></script>
    	
        <script type="text/javascript">
                
                $(document).ready(function(){
                  
                  var tipo_user = "<?php echo $tipo_user ?>";
                  
                  if(tipo_user != "Administrador"){
                       $("#opcaoUser").remove();
                  }
                                   
                });
        
        </script>

    </head>
    <body>

  <?php include '../util/nav.php' ?>
  
        <div class="container mid">


        <div class="row">
            <div class="col-sm-12">
                <h2 class="titulo-h2">Cadastro Profissional</h2>
                
            <form action="../Medico/RegistraMedico.php" method="POST" autocomplete="off">
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="nome">Nome:</label>
                        <span class="obg" style="color: #A12126; font-size: 20px; float: right;">*</span>
                        <input type="text" class="form-control up" name="nome" autocomplete="off" required>
                    </div>

                    <div class="form-group col-sm-3">
                        <label for="DataNasc">Data de Nascimento:</label>
                        <span class="obg" style="color: #A12126; font-size: 20px; float: right;">*</span>
                        <input type="text" class="form-control" name="dtanascimento" id="dataNasc" autocomplete="off" required>
                    </div>

                     <div class="form-group col-sm-3">
                        <label for="conselhoId" >Conselho:</label>
                        <span class="obg" style="color: #A12126; font-size: 20px; float: right;">*</span>
                        <input type= "text" class="form-control up" name= "conselho" id="conselhoId" autocomplete="off" required>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-sm-5">
                        <label for="telefoneId">Telefone:</label>
                        <span class="obg" style="color: #A12126; font-size: 20px; float: right;">*</span>
                        <input type="text" class="form-control" name="telefone" id="telefoneId" autocomplete="off" required>
                    </div>

                    <div class="form-group col-sm-7">
                        <label for="emailId">Email:</label>
                        <span class="obg" style="color: #A12126; font-size: 20px; float: right;">*</span>
                        <input type="text" class="form-control" name="email" id="emailId" autocomplete="off" required>
                    </div>
                </div>

                <div class="row"> 
                    <div class="form-group col-sm-6">
                        <label for="funcaoId">Função:</label>
                        <span class="obg" style="color: #A12126; font-size: 20px; float: right;">*</span>
                        <input type="text" class="form-control up" name="funcao" id="funcaoId" autocomplete="off" required>
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="especialidadeId">Especialidade:</label>
                        <span class="obg" style="color: #A12126; font-size: 20px; float: right;">*</span>
                        <input type="text" class="form-control up" name="especialidade" id="especialidadeId" autocomplete="off" required>
                    </div>
                </div>

                <button type="submit" class="bt-salvar">Salvar</button>
                <a href="../Medico/TelaMedicoTable.php"><button type="button" class="bt-buscar">Buscar</button></a>
            </form>
                    
            </div>
        </div>
</div>

<?php include '../util/footer.php' ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src=".../bootstrap/js/bootstrap.min.js"></script>
    <script src="../js/jquery-3.2.1.js"></script>
    <script src="../js/jquerymask.js"></script>
    <script type="text/javascript">

          $(document).ready(function(){
          $('#dataNasc').mask('00/00/0000');
          $('#telefoneId').mask('(00) 00000-0000');
          });

    </script>
    </body>
</html>



