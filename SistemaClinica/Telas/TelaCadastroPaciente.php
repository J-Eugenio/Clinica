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
    <title>Cadastro Paciente</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat+Alternates">
    <link href="https://fonts.googleapis.com/css?family=Raleway:600" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/CadastroAtualizar.css">
    <link rel="stylesheet" type="text/css" href="../css/menu.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway:700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:600" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="estilo.css" rel="stylesheet">
    <script src="..bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/popover.css">
    <script src="bootstrap/js/bootstrap.js"></script>
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
                <h2 class="titulo-h2">Cadastro Paciente</h2>
            <form action="../Paciente/RegistraPaciente.php" method="POST" onsubmit="return Verificar_CPF();">

            <div class="row">
             <div class="form-group col-md-9" >
              <label for="nome">Nome:</label>
              <span class="obg" style="color: #A12126; font-size: 20px; float: right;">*</span>
              <input type="text" class="form-control up" name="txtNome" id="nome" autocomplete="off" required>
            </div>
          
            <div class="form-group col-md-3">
              <label for="dataNasc">Data de Nasc:</label>
              <span class="obg" style="color: #A12126; font-size: 20px; float: right;">*</span>
              <input type="text" class="form-control" name="txtDataNasc" id="dataNasc" autocomplete="off" required> 
            </div>

            </div>

            <div class="row">
              <div class="form-group col-md-3">
                <label for="cpf">CPF:</label>
                <input type="text" class="form-control" name="txtCPF" id="cpfi" data-toggle="popover" data-placement="bottom" data-trigger="manual" data-content="CPF INVÁLIDO!!" onblur="return Verificar_CPF()" autocomplete="off">
              </div>

              <div class="form-group col-md-3">
                <label>RG:</label>
                <input type="text" class="form-control" name="txtRG" id="rg" autocomplete="off">
              </div>

              <div class="form-group col-md-4">
                <label for="email">Email:</label>
                <input type="text" class="form-control" name="txtEmail" id="email" autocomplete="off">
              </div>

              <div class="form-group col-md-2">
                <label for="sexo">Sexo:</label>
                <select class="form-control" name="cxSexo" id="sexo">
                                <option value="">-----</option>
                                <option value="Masculino">Masculino</option>
                                <option value="Feminino">Feminino</option>
                </select>
              </div>
              
              </div>

              <div class="row">


                <div class="form-group col-md-3">
                  <label for="indica">Indicação:</label>
                  <input type="text" class="form-control up" name="txtIndicacao" id="indica" autocomplete="off"> 
                </div>
          
                <div class="form-group col-md-2">
                  <label for="eCivil">Estado Civil:</label>
                  <select class="form-control" name="cxEstadoCivil" id="eCivil">
                                <option value="">-----</option>
                                <option value="Casado(a)">Casado(a)</option>
                                <option value="Solteiro(a)">Solteiro(a)</option>
                                <option value="Divorciado(a)">Divorciado(a)</option>
                                <option value="Viúvo(a)">Viúvo(a)</option>
                                <option value="Separado(a)">Separado(a)</option>
                  </select>
                </div>

                <div class="form-group col-md-4">
                  <label for="profissao">Profissão:</label>
                  <input type="text" class="form-control up" name="txtProfissao" id="profissao" autocomplete="off">
                </div>

                <div class="form-group col-md-3">
                  <label for="cidade">Cidade:</label>
                  <input type="text" class="form-control up" name="txtCidade" id="cidade" autocomplete="off">
                </div>
                
              </div>

              <div class="row">
                <div class="form-group col-md-3">
                  <label for="estado">Estado:</label>
                  <input type="text" class="form-control up" name="txtEstado" id="estado" autocomplete="off">
                </div>


                <div class="form-group col-md-3">
                  <label for="telefone">Telefone:</label>
                  <input type="text" class="form-control" name="txtTelefone" id="telefone" autocomplete="off">
                </div>

                <div class="form-group col-md-3">
                  <label for="celular">Celular:</label>
                  <input type="text" class="form-control" name="txtCelular" id="celular" autocomplete="off">
                </div>

                <div class="form-group col-md-3">
                  <label for="CEP">CEP:</label>
                  <input type="text" class="form-control" name="txtCEP" id="CEP" autocomplete="off">
                </div>
              </div>

              <div class="row">
                <div class="form-group col-md-3">
                  <label for="bairro">Bairro:</label>
                  <input type="text" class="form-control up" name="txtBairro" id="bairro" autocomplete="off">
                </div>

                <div class="form-group col-md-3">
                  <label for="endereco">Endereço:</label>
                  <input type="text" class="form-control up" name="txtEndereco" id="endereco" autocomplete="off">
                </div>

                <div class="form-group col-md-3">
                  <label for="numero">Numero:</label>
                  <input type="text" class="form-control" name="txtNumero" id="numero" autocomplete="off">  
                </div>

                <div class="form-group col-md-3">
                  <label for="complemento">Complemento:</label>
                  <input type="text" class="form-control up" name="txtComplemento" id="complemento" autocomplete="off">
                </div>
              </div>

              <button type="submit" value="Cadastrar" name="btnSalvar" class="bt-salvar">Salvar</button>
              <a href="../Paciente/TelaPacienteTable.php"><button type="button" class="bt-buscar">Buscar</button></a>

             </form>
            </div>

        </div>

    </div> 
    <footer>
      <h1 style="font-family: 'Raleway', sans-serif !important;"><strong>Copyright &copy 2018 - Fábrica de Software</strong></h1>
    </footer>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="../js/ValidaCpf.js"></script>
    <script src="../js/jquerymask.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
      $('#cpfi').mask('000.000.000-00');
      $('#dataNasc').mask('00/00/0000');
      $('#numero').mask('#########');
      $('#celular').mask('(00) 00000-0000');
      $('#telefone').mask('(00) 0000-0000');
      $('#CEP').mask('00000-000');
    });
    </script>
  </body>
</html>
