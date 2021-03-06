<?php
/**
 * Description of Paciente
 *
 * @author Felipe
 */
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../tmp'));
session_start();
require_once '../util/daoGenerico.php';
require_once '../Paciente/Paciente.php';
include_once '../Login/ProtectPaginas.php';

protect();

if(isset($_SESSION["tipoUsuario"])){
    $tipo_user = $_SESSION["tipoUsuario"];
}

$paciente = new Paciente();

//RECUPERANDO ID PASSADO PELA URL
$Metodo = $_GET;
if(isset($Metodo["Idpaciente"])){
    $id = $Metodo["Idpaciente"];
    $id = preg_replace('/[^[:alnum:]]/','', $id);
    
$paciente->valorpk=$id;
$paciente->pesquisarID($paciente);
}

while ($dado = $paciente->retornaDados("object")) { 

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
            <form action="" method="POST" onsubmit="return Verificar_CPF()">

            <div class="row">
              <div class="form-group col-md-9" >
              <label for="nome">Nome:</label>
              <span class="obg" style="color: #A12126; font-size: 20px; float: right;">*</span>
              <input type="text" class="form-control up" name="txtNome" value="<?php echo $dado->NOME?>" id="nome" required>
              </div>
          
            <div class="form-group col-md-3">
              <label for="dataNasc">Data de Nasc:</label>
              <input type="text" class="form-control" name="txtDataNasc" value="<?php echo $dado->DATANASC != '' ? date('d/m/Y',strtotime($dado->DATANASC)) : '' ?>" id="dataNasc">
              <input type="hidden" name="txtDataCadastro" value="<?php echo date("d/m/Y", strtotime($dado->DATACADASTRO)); ?>">
            </div>

            </div>

            <div class="row">
              <div class="form-group col-md-3">
                <label for="cpf">CPF:</label>
                <input type="text" class="form-control" name="txtCPF" value="<?php echo $dado->CPF ?>" id="cpfi" data-toggle="popover" data-placement="bottom" data-trigger="manual" data-content="CPF INVÁLIDO!!" onblur="return Verificar_CPF()">
              </div>

              <div class="form-group col-md-3">
                <label>RG:</label>
                
                <input type="text" class="form-control" name="txtRG" value="<?php echo $dado->RG ?>" id="rg" >
              </div>

              <div class="form-group col-md-4">
                <label for="email">Email:</label>
                 
                <input type="text" class="form-control" name="txtEmail" value="<?php echo $dado->EMAIL ?>" id="email" >
              </div>

              <div class="form-group col-md-2">
                <label for="sexo">Sexo:</label>        
                <select class="form-control" name="cxSexo" id="sexo">
                                <option value="">-----</option>
                                <option value="Masculino" <?php if($dado->SEXO == "Masculino") echo 'selected'; ?>>Masculino</option>
                                <option value="Feminino" <?php if($dado->SEXO == "Feminino") echo 'selected'; ?>>Feminino</option>
                </select>
              </div>
              
              </div>

              <div class="row">


                <div class="form-group col-md-3">
                  <label for="indica">Indicação:</label>
                  <input type="text" class="form-control up" name="txtIndicacao" value="<?php echo $dado->INDICACAO ?>" id="indica"> 
                </div>
          
                <div class="form-group col-md-2">
                  <label for="eCivil">Estado Civil:</label>
                  <select class="form-control" name="cxEstadoCivil" id="eCivil">
                                <option value="" <?php if($dado->ESTADOCIVIL == "") echo 'selected';?>>-----</option>
                                <option value="Casado(a)" <?php if($dado->ESTADOCIVIL == "Casado(a)") echo 'selected';?>>Casado(a)</option>
                                <option value="Solteiro(a)" <?php if($dado->ESTADOCIVIL == "Solteiro(a)") echo 'selected';  ?>>Solteiro(a)</option>
                                <option value="Divorciado(a)" <?php if($dado->ESTADOCIVIL == "Divorciado(a)") echo 'selected';  ?>>Divorciado(a)</option>
                                <option value="Viúvo(a)" <?php if($dado->ESTADOCIVIL == "Viúvo(a)") echo 'selected';  ?>>Viúvo(a)</option>
                                <option value="Separado(a)" <?php if($dado->ESTADOCIVIL == "Separado(a)") echo 'selected';  ?>>Separado(a)</option>
                  </select>
                </div>

                <div class="form-group col-md-4">
                  <label for="profissao">Profissão:</label>
                   
                  <input type="text" class="form-control up" name="txtProfissao" value="<?php echo $dado->PROFISSAO ?>" id="profissao" >
                </div>

                <div class="form-group col-md-3">
                  <label for="cidade">Cidade:</label>
                  
                  <input type="text" class="form-control up" name="txtCidade" value="<?php echo $dado->CIDADE ?>" id="cidade" >
                </div>
                
              </div>

              <div class="row">

                <div class="form-group col-md-3">
                  <label for="estado">Estado:</label>
                  
                  <input type="text" class="form-control up" name="txtEstado" value="<?php echo $dado->ESTADO ?>" id="estado" >
                </div>


                <div class="form-group col-md-3">
                  <label for="telefone">Telefone:</label>
                  <input type="text" class="form-control" name="txtTelefone" value="<?php echo $dado->TELEFONE ?>" id="telefone">
                </div>

                <div class="form-group col-md-3">
                  <label for="celular">Celular:</label>
                  <input type="text" class="form-control" name="txtCelular" value="<?php echo $dado->CELULAR ?>" id="celular">
                </div>

                <div class="form-group col-md-3">
                  <label for="CEP">CEP:</label>
                  
                  <input type="text" class="form-control" name="txtCEP" value="<?php echo $dado->CEP ?>" id="cep" >
                </div>
              </div>

              <div class="row">
                <div class="form-group col-md-3">
                  <label for="bairro">Bairro:</label>
             
                  <input type="text" class="form-control up" name="txtBairro" value="<?php echo $dado->BAIRRO ?>" id="bairro" >
                </div>

                <div class="form-group col-md-3">
                  <label for="endereco">Endereço:</label>
                  
                  <input type="text" class="form-control up" name="txtEndereco" value="<?php echo $dado->ENDERECO ?>" id="endereco" >
                </div>

                <div class="form-group col-md-3">
                  <label for="numero">Numero:</label>
                   
                  <input type="text" class="form-control" name="txtNumero" value="<?php echo $dado->NUMERO ?>" id="numero" >  
                </div>

                <div class="form-group col-md-3">
                  <label for="complemento">Complemento:</label>
                  <input type="text" class="form-control up" name="txtComplemento" value="<?php echo $dado->COMPLEMENTO ?>" id="complemento">
                </div>
              </div>

                    <button type="submit" value="Atualizar" name="btnAtualizar" class="bt-atualizar">Salvar</button>
                    <a href="../Paciente/TelaPacienteTable.php"><button type="button" class="bt-voltar">Voltar</button></a>
                </form>

            </div>

        </div>

    </div> 
    <?php } ?>
    <?php include '../util/footer.php' ?>

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
      $('#cep').mask('00000-000');
    });
    </script>
  </body>
</html>

<?php
$metodo = $_POST;

//PEGANDO VALORES DOS CAMPOS PARA ATUALIZAR
if (isset($metodo["txtNome"])) {
    $nome = addslashes($metodo["txtNome"]);
    $sexo = addslashes($metodo["cxSexo"]);
    $datanasc = addslashes($metodo["txtDataNasc"]);
    $data_cadastro = addslashes($metodo["txtDataCadastro"]);
    $cpf = addslashes($metodo["txtCPF"]);
    $rg = $metodo["txtRG"];
    $email = $metodo["txtEmail"];
    $email = preg_replace('/[^[:alnum:]@.]/','', $email);
    $profissao = addslashes($metodo["txtProfissao"]);
    $telefone = addslashes($metodo["txtTelefone"]);
    $celular = addslashes($metodo["txtCelular"]);
    $indicacao = addslashes($metodo["txtIndicacao"]);
    $estadocivil = addslashes($metodo["cxEstadoCivil"]);
    $endereco = addslashes($metodo["txtEndereco"]);
    $bairro = addslashes($metodo["txtBairro"]);
    $numero = addslashes($metodo["txtNumero"]);
    $cidade = addslashes($metodo["txtCidade"]);
    $estado = addslashes($metodo["txtEstado"]);
    $complemento = addslashes($metodo["txtComplemento"]);
    $cep = addslashes($metodo["txtCEP"]);

   
    $paci = new Paciente();
    $data_atual = date('Y-m-d');

     //SETANDO VALORES PARA ATUALIZAR
    $sql = $paci->atualizarPaciente($nome,$sexo,$datanasc,$data_atual,$cpf,$rg,
            $email,$profissao,$telefone,$celular,$indicacao,$estadocivil,$endereco,$bairro,$numero,$cidade,$estado,$complemento,$cep,$id);

if (mysqli_query($paci->conexao,$sql)){
    echo  "<script>alert('PACIENTE ATUALIZADO COM SUCESSO!!');window.location = '../Paciente/TelaPacienteTable.php';</script>";
}else{
    echo "<script>alert('NENHUM DADO FOI MODIFICADO!!');</script>";
}

}

?>
