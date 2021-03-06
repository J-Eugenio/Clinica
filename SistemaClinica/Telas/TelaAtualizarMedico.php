<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../tmp'));
session_start();
require_once '../util/daoGenerico.php';
require_once '../Medico/Medico.php';

include_once '../Login/ProtectPaginas.php';
protect();

if(isset($_SESSION["tipoUsuario"])){
    $tipo_user = $_SESSION["tipoUsuario"];
}

$medico = new Medico();
$metodo = $_GET;
if(isset($metodo["medico"])){
    $id = $metodo["medico"];
    $id = preg_replace('/[^[:alnum:]]/','', $id);
    $medico->valorpk = $id;
    $medico->pesquisarID($medico);
}

$dado = $medico->retornaDados("object");

?>

<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Atualizar Profissional</title>
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
                <h2 class="titulo-h2">Atualizar Profissional</h2>
                
            <form action="../Medico/AtualizaMedico.php?medico=<?php echo $dado->IDMEDICO ?>" method="POST">
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="nome">Nome:</label>
                        <input type="text" class="form-control up" value="<?php echo $dado->NOME ?>" name="nome" id="nome" required>
                    </div>

                    <div class="form-group col-sm-3">
                        <label for="DataNasc">Data de Nascimento</label>
                 <input type="text" class="form-control" value="<?php echo date("d/m/Y",strtotime($dado->DTANASCIMENTO)); ?>" name="dtanascimento" id="DataNasc" required>
                    </div>

                     <div class="form-group col-sm-3">
                        <label for="conselhoId" >Conselho:</label>
                        <input type= "text" class="form-control" value="<?php echo $dado->CONSELHO ?>" name="conselho" id="conselhoId" required>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-sm-5">
                        <label for="telefoneId">Telefone:</label>
                        <input type="text" class="form-control" value="<?php echo $dado->TELEFONE ?>" name="telefone" id="telefoneId" required>
                    </div>

                    <div class="form-group col-sm-7">
                        <label for="emailId">Email:</label>
                        <input type="text" class="form-control" value="<?php echo $dado->EMAIL ?>" name="email" id="emailId">
                    </div>
                </div>

                <div class="row"> 
                    <div class="form-group col-sm-6">
                        <label for="funcaoId">Função:</label>
                        <input type="text" class="form-control up" value="<?php echo $dado->FUNCAO ?>" name="funcao" id="funcaoId" required>
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="especialidadeId">Especialidade:</label>
                        <input type="text" class="form-control up" value="<?php echo $dado->ESPECIALIDADE ?>" name="especialidade" id="especialidadeId" required>
                    </div>
                </div>

                <button type="submit" class="bt-salvar">Salvar</button>
                <a href="../Medico/TelaMedicoTable.php"><button type="button" class="bt-buscar">Voltar</button></a>
            </form>
                    
            </div>
        </div>
</div>

<?php include '../util/footer.php' ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="../js/jquery-3.2.1.js"></script>
    <script src="../js/jquery.mask.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
      $('#DataNasc').mask('00/00/0000');
      $('#telefoneId').mask('(00) 00000-0000');
    });
    </script>
    </body>
</html>
