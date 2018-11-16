<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../tmp'));
session_start();


include_once '../Login/ProtectPaginas.php';
include_once '../util/daoGenerico.php';
include_once '../Paciente/Paciente.php';
include_once '../Atendimento/Atendimento.php';
include_once '../Medico/Medico.php';

 
protect();
 
 
$medic = new Medico();
$tipoAten = new Atendimento();
$paciente = new Paciente();
$dao = new daoGenerico();


 
if (isset($_SESSION["tipoUsuario"])) {
    $tipo_user = $_SESSION["tipoUsuario"];
}

 
   //PARA LISTAR NOS COMBOBOX
   $tipoAten->retornaTudo($tipoAten);
   $medic->retornaTudo($medic);
 
   //PARA LISTAR JANELA MODAL
   $paciente->retornaTudo($paciente);

  
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Cadastro Agenda</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat+Alternates">
        <link href="https://fonts.googleapis.com/css?family=Raleway:600" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <link rel="stylesheet" type="text/css" href="../css/CadastraAtualiza.css">
        <link rel="stylesheet" type="text/css" href="../css/menu.css">
        <link href="https://fonts.googleapis.com/css?family=Raleway:700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Nunito:600" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="estilo.css" rel="stylesheet">
        <script src="../js/jquery-3.2.1.js"></script>
        <script src="../js/login.js"></script>
        <script type="text/javascript">
 
            $(document).ready( function () {
 
                var tipo_user = "<?php echo $tipo_user ?>";
                var id = "<?php echo $id ?>";
               
 
                if (tipo_user != "Administrador") {
                    document.getElementById("opcaoUser").style.display = "none";
                }
               
             });

        </script>
 
    </head>
    <body>
 
  <?php include '../util/nav.php' ?>
 
        <div class="container mid">
 
 
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="titulo-h2">Cadastro Agenda</h2>
 
            <!-- FORMULARO DE CADASTRO AGENDA -->    
                <form id="form" action="../Agenda/RegistraAgenda.php" method="POST">
                        <div class="row col-sm-12">
                          <div class="form-group col-sm-5">
                            <label for="paciente">Paciente:</label>
                            <span class="obg" style="color: #A12126; font-size: 20px; float: right;">*</span>  
                            <input type="text" class="form-control up" id="paciente" name="paciente" disabled="true" required>
                            <button id="botaoAbreModal" type="button" data-toggle="modal" data-target="#exampleModal" style="width: 25px; height: 25px; border-radius: 50%; background: #00beaa; border: none; position: relative; top: -27px; left: -3px; float: right;">
                              <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                            </button>
                            <input type="hidden" id="CampoId" name="Idpaciente">
                          </div>
 
                          <div class="form-group col-sm-4">
                            <label for="IdMedic">Médico:</label>
                            <span class="obg" style="color: #A12126; font-size: 20px; float: right;">*</span>
                            <select class="form-control" name="medico" id="IdMedic" style="text-transform: uppercase; outline: 0;">  
                              <?php while ($dadoMedic = $medic->retornaDados("object")) { ?>  
                                  <option value="<?php echo $dadoMedic->IDMEDICO; ?>"><?php echo $dadoMedic->NOME; ?></option>
                              <?php } ?>
                            </select>
                          </div>
 
                            <div class="form-group col-sm-3">
                                <label for="DataAtendId" style="white-space:nowrap;">Data de Atend.:</label>
                                <span class="obg" style="color: #A12126; font-size: 20px; float: right;">*</span>
                                <input type="text" class="form-control" name="datadeatendimento" id="DataAtendId" required>
                            </div>
                        </div>
 
                        <div class="row col-sm-12">
                         
                            <div class="form-group col-md-6">
                                <label for="IdTipoAtend">Tipo Atendimento:</label>
                                <span class="obg" style="color: #A12126; font-size: 20px; float: right;">*</span>
                                <select class="form-control" name="TipoAtendimento" id="IdTipoAtend" >
                                    <?php while ($dadoAtendimento = $tipoAten->retornaDados("object")) { ?>
                                    <option value="<?php echo $dadoAtendimento->IDATENDIMENTO; ?>"><?php echo $dadoAtendimento->TIPOATENDIMENTO; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
 
 
                         <div class="form-group col-sm-6">
                                <label for="obsId">Observação:</label>
                                <input type="text" class="form-control" name="observacao" id="obsId">
                            </div>
                         </div>
                        
                        <button type="submit" class="bt-salvar" style="margin-left: 12px;">Salvar</button>
                        <a href="../Agenda/TelaAgendaTable.php"><button type="button" class="bt-buscar">Buscar</button></a>
 
       
                </form>
            <!-- FIM DO FORMULARO -->  
 
              <!-- MODAL DE ESCOLHA DE PACIENTE -->
                 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">SELECIONE UM PACIENTE</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="conteudo">              
                            <div class="input-group">
                             <input type="text" id="campo" class="form-control" style="border-radius: 0; border: 1px solid rgba(0, 0, 0, 0.2);">
                                <span class="input-group-btn">      
                                <button class="btn btn-default" id="btnPes" style="height: 30px;"><i class="fas fa-search"></i></button>
                               </span>
                            </div>
                              <hr>
                              <!-- LISTA DADOS PESQUISADOS AQUI -->
                              <input type="text" class="form-control" id="col1" style="border-radius: 0; text-align: center;" disabled>
                              <!-- -->
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-danger" style="margin: 0 auto;">CANCELAR</button>
                            <button type="button" data-dismiss="modal" id="btnInserir" disabled="true" class="btn btn-success" style="margin: 0 auto;">INSERIR</button>
                            <button type="button" id="btnNovo" disabled="true" data-toggle="modal" data-target="#cadastroPaciente" class="btn btn-primary" style="margin: 0 auto;">NOVO</button>
                          </div>
                        </div>
                      </div>
                  </div>
                  <!-- F I M  M O D A L -->

                  <!-- MODAL DE CADASTRO DE PACIENTE -->
                 <div class="modal fade" id="cadastroPaciente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">PREENCHE TODOS OS CAMPOS</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="conteudo">              
                              <form action="../Paciente/RegistraPaciente.php" method="POST" onsubmit="return VerificaCPF();">
                                <div class="form-group">
                                  <label for="nome">Paciente:</label>
                                  <input class="form-control" type="text" name="txtNome" id="nome" style="border-radius: 0; border: 1px solid rgba(0, 0, 0, 0.2);" required>
                                </div>

                                <div class="form-group">
                                  <label for="cpf">CPF:</label>
                                  <input type="text" class="form-control" name="txtCPF" id="cpf" style="border-radius: 0; border: 1px solid rgba(0, 0, 0, 0.2);" onblur="return VerificaCPF();">
                                  <span id="error" style="color: red;font-style: italic;"></span>
                                </div>

                                <div class="form-group">
                                  <label for="sexo">Sexo:</label>
                                  <select class="form-control" name="cxSexo" style="border-radius: 0; border: 1px solid rgba(0, 0, 0, 0.2);" id="sexo" >
                                                  <option value="">-----</option>
                                                  <option value="Masculino">Masculino</option>
                                                  <option value="Feminino">Feminino</option>
                                  </select>
                                </div>

                                <div class="form-group">
                                  <label for="eCivil">Estado Civil:</label>
                                  <select class="form-control" name="cxEstadoCivil" style="border-radius: 0; border: 1px solid rgba(0, 0, 0, 0.2);" id="eCivil" >
                                                <option value="">-----</option>
                                                <option value="Casado(a)">Casado(a)</option>
                                                <option value="Solteiro(a)">Solteiro(a)</option>
                                                <option value="Divorciado(a)">Divorciado(a)</option>
                                                <option value="Viúvo(a)">Viúvo(a)</option>
                                                <option value="Separado(a)">Separado(a)</option>
                                  </select>
                              </div>

                              <div class="form-group">
                                <label for="celular">Celular:</label>
                                <input type="text" class="form-control" name="txtCelular" style="border-radius: 0; border: 1px solid rgba(0, 0, 0, 0.2);" id="celular" required>
                              </div>

                              </form>
                              <hr>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-danger" style="margin: 0 auto;">CANCELAR</button>
                            <button type="button" id="btnNovo" disabled="true" class="btn btn-primary" style="margin: 0 auto;">SALVAR</button>
                          </div>
                        </div>
                      </div>
                  </div>
                  <!-- F I M  M O D A L -->
                 
                </div>
            </div>
        </div>
 
    <?php include '../util/footer.php' ?>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/modal.css">
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <script src="../js/jquery-3.2.1.js"></script>
        <script src="../js/jquery.mask.js"></script>
        <script type="text/javascript">


            $(document).ready(function () {

                var btnInserir = $('#btnInserir');
                var campoModalCPF = $('#campo');

                btnInserir.click(function(){
                   console.log($('#col1').html());
                    $('#paciente').val($('#col1').val());
                });

                $('#botaoAbreModal').click(function(){
                  $('#exampleModal').find('input').val('');
                });

                //MASCARAS DOS CAMPOS
                $('#DataAtendId').mask('00/00/0000');
                $('#campo').mask('000.000.000-00');
                //--------------------

                //FUNCAO DO BOTAO DE PESQUISA MODAL
                $('#btnPes').on("click",function(){
                  
                  var valor = campoModalCPF.val();
                  var botao =  document.getElementById('btnNovo');
                  var botao2 =  document.getElementById('btnInserir');

                  $.ajax({
                    url: '../util/modal_json.php',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {cpf:valor},
                    success: function(response){
                    var quant = response.qtd;
                    if(quant > 0){
                        $('#col1').val(response.nome);
                        $('#col1').css("background", "#f3f3f3"); 
                        $('#col1').css("color", "#181818"); 
                        botao.disabled = true;
                        botao2.disabled = false;
                    }else{
                        $('#col1').val('Nenhum Resultado Encontrado');
                        $('#col1').css("background", "#A12126");
                        $('#col1').css("color", "#f3f3f3");
                        botao.disabled = false;  
                        botao2.disabled = true;
                       }
                                                                        
                    },error: function(){
                        alert('Error..Servidor nao Encontrado!!');           
                    }
                  });

                });
               //------------------------------
               
            });
        </script>
    </body>
</html>