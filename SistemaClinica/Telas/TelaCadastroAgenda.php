<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../tmp'));
session_start();
date_default_timezone_set('America/Sao_Paulo');

require_once '../Paciente/Paciente.php';
include_once '../Login/ProtectPaginas.php';
include_once '../Atendimento/Atendimento.php';
include_once '../Medico/Medico.php';

protect();

$medic = new Medico();
$tipoAten = new Atendimento();

 
if (isset($_SESSION["tipoUsuario"])) {
    $tipo_user = $_SESSION["tipoUsuario"];
}

 
   //PARA LISTAR NOS COMBOBOX
   $tipoAten->retornaTudo($tipoAten);
   $medic->retornaTudo($medic);
 

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
        <link rel="stylesheet" type="text/css" href="../css/CadastroAtualizar.css">
        <link rel="stylesheet" type="text/css" href="../css/menu.css">
        <link href="https://fonts.googleapis.com/css?family=Raleway:700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Nunito:600" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
        <link href="estilo.css" rel="stylesheet">
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/popover.css"> 
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
                <form id="form" action="../Agenda/RegistraAgenda.php" method="POST" onsubmit="return enviar();">
                        <div class="row col-sm-12">
                          <div class="form-group col-sm-5">
                            <label for="paciente">Paciente:</label>
                            <span class="obg" style="color: #A12126; font-size: 20px; float: right;">*</span>  
                            <input type="text" class="form-control up" id="paciente" name="paciente" disabled="true" required>
                            <button id="botaoAbreModal" type="button" data-toggle="modal" data-target="#modal-escolha-paciente" style="width: 25px; height: 25px; border-radius: 50%; background: #00beaa; border: none; position: relative; top: -27px; left: -3px; float: right;">
                              <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                            </button>
                            <input type="hidden" id="CampoId" name="Idpaciente">
                          </div>
 
                            
                            <div class="form-group col-sm-4">
                              <label for="IdMedic">Médico:</label>
                              <span class="obg" style="color: #A12126; font-size: 20px; float: right;">*</span>
                              <select class="form-control up" name="medico" id="IdMedic" style="text-transform: uppercase; outline: 0;">  
                                <?php while ($dadoMedic = $medic->retornaDados("object")) { ?>  
                                    <option value="<?php echo $dadoMedic->IDMEDICO; ?>"><?php echo $dadoMedic->NOME; ?></option>
                                <?php } ?>
                              </select>
                          </div>

                           <div class="form-group col-sm-3">
                                <label for="DataAtendId" style="white-space:nowrap;">Data:</label>
                                <span class="obg" style="color: #A12126; font-size: 20px; float: right;">*</span>
                               <input type="hidden" class="form-control" name="datadeatendimento" id="DataAtendId" required>
                               <input type="date" class="form-control" name="datadeatendimento" id="DataAtendId" required>
                             
                            </div>
                        </div>
 
                        <div class="row col-sm-12">
                         
                            <div class="form-group col-md-6">
                                <label for="IdTipoAtend">Tipo Atendimento:</label>
                                <span class="obg" style="color: #A12126; font-size: 20px; float: right;">*</span>
                                <select class="form-control up" name="TipoAtendimento" id="IdTipoAtend" >
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
                 <div class="modal fade" id="modal-escolha-paciente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div id="modal" class="modal-dialog" role="document">
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
                             <input type="text" id="campo" class="form-control up" style="border-radius: 0; border: 1px solid rgba(0, 0, 0, 0.2);">
                                <span class="input-group-btn">      
                                <button class="btn btn-default" id="btnPes" style="height: 30px;"><i class="fas fa-search"></i></button>
                               </span>
                            </div>
                              <hr>
                              <!-- LISTA DADOS JSON PESQUISADOS AQUI -->
                              <table style="margin-top: -30px;">
                                <tr>
                                  <td id="col1">
                                  </td>
                                </tr>
                              </table>
                              <!-- --------------------------------- -->
                              <div class="alert alert-danger" id="msg" style="text-align: center; font-weight: 600; font-size: 16px; visibility: hidden;">Nenhum Resultado Encontrado</div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-danger" style="margin: 0 auto;">CANCELAR</button>
                            <button type="button" id="btnNovo" data-toggle="modal" data-target="#modal-cadastro-paciente" class="btn btn-primary" style="margin: 0 auto;" data-dismiss="modal" disabled>NOVO</button>
                          </div>
                        </div>
                      </div>
                  </div>
                  <!-- F I M  M O D A L -->

                  <!-- MODAL DE CADASTRO DE PACIENTE -->
               <div class="modal fade" id="modal-cadastro-paciente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document" style="width: 550px;">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">PREENCHE TODOS OS CAMPOS</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                      <!-- I N I C I O  F O R M -->
                      <form id="form_cadastro_pac"  onsubmit="return Verificar_CPF()">
                          <div class="modal-body" style="height: 380px;">
                            <div class="conteudo">              
                                <div class="form-group">
                                  <label for="nome">Paciente:</label>
                                  <span class="obg" style="color: #A12126; font-size: 20px; float: right;">*</span>  
                                  <input class="form-control up" type="text" name="txtNome" id="nome" style="border-radius: 0; border: 1px solid rgba(0, 0, 0, 0.2);" required>
                                </div>

                                <div class="form-group">
                                  <label for="cpfi">CPF:</label>
                                  <span class="obg" style="color: #A12126; font-size: 20px; float: right;">*</span>   
                                  <input id="cpfi" type="text1" class="form-control" name="txtCPF"  style="border-radius: 0; border: 1px solid rgba(0, 0, 0, 0.2);" data-toggle="popover" data-placement="bottom" data-trigger="manual" data-content="CPF INVÁLIDO!" onblur="return Verificar_CPF()" required>
                                </div>

                                 <div class="form-group">
                                  <label for="dataNasc">Data de Nasc:</label>
                                  <span class="obg" style="color: #A12126; font-size: 20px; float: right;">*</span>
                                  <input type="text" class="form-control" name="txtDataNasc" id="dataNasc" style="border-radius: 0; border: 1px solid rgba(0, 0, 0, 0.2);" required>
                                </div>

                                <div class="form-group">
                                  <label for="sexo">Sexo:</label>
                                  <span class="obg" style="color: #A12126; font-size: 20px; float: right;">*</span>   
                                  <select id="select_sexo" class="form-control" name="cxSexo" style="border-radius: 0; border: 1px solid rgba(0, 0, 0, 0.2);" id="sexo" required>
                                       <option id="opc1" value="">-----</option>
                                       <option value="Masculino">Masculino</option>
                                       <option value="Feminino">Feminino</option>
                                  </select>
                                </div>

                              <div class="form-group">
                                <label for="celular">Celular:</label>
                                <span class="obg" style="color: #A12126; font-size: 20px; float: right;">*</span>    
                                <input type="text1" class="form-control" id="cel" name="txtCelular" style="border-radius: 0; border: 1px solid rgba(0, 0, 0, 0.2);" id="celular" required>
                              </div>              
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-danger" style="margin: 0 auto;">CANCELAR</button>
                            <button type="button" id="btnSalvar" class="btn btn-primary" style="margin: 0 auto;">SALVAR</button>
                          </div>
                        </form>
                        <!-- F I M  F O R M -->
                        </div>
                      </div>
                  </div>
                  <!-- F I M  M O D A L -->
                 
                </div>
            </div>
        </div>

        <?php include '../util/footer.php' ?>

        <script src="../js/jquery-3.2.1.js"></script> 
        <script src="../js/ValidaCpf.js"></script>
        <script src="../js/jquerymask.js"></script>
        <script type="text/javascript">
    
              //MASCARAS DOS CAMPOS
                $('#DataAtendId').mask('00/00/0000');
                $('#cel').mask('(00)00000-0000');
                $('#cpfi').mask('000.000.000-00');
                $('#dataNasc').mask('00/00/0000');
                //--------------------

                // FUNCAO REINICIAR MODAL LIMPO
                $('#botaoAbreModal').click(function(){
                  $('#modal-escolha-paciente').find('input').val('');
                  $('#modal-escolha-paciente').find('td').text('');
                  $('#msg').css("visibility","hidden");   
                  $('#btnNovo').prop('disabled',true);      
                });
                $('#btnNovo').click(function(){
                  $('#modal-cadastro-paciente').find('input[type="text1"]').val('');
                  $('#modal-cadastro-paciente').find('select').val($('#opc1').val());
                });
                 //--------------------           
         
    </script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/modal.css"> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>  
        <script type="text/javascript">

          //FUNCAO DO CAMPO DE PESQUISA MODAL  -------->    
             $('#campo').on("keyup",function(){

                  var botao =  document.getElementById('btnNovo');
                  var valor = $('#campo').val();
                  var qtd;

                  $.ajax({
                    url: '../util/modal_json.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {name:valor},
                    success: function(response){

                       $('#col1').html(response); 
                       qtd = $('#col2').text();
                       
                       if(qtd > 0){

                          if(valor != ""){

                            $('#col1').html(response);                    
                            $('#col1').css("color", "#181818");
                            $('#msg').css("visibility","hidden");   
                            botao.disabled = true;

                            }else{
                                $('#col1').text("");
                                $('#msg').css("visibility","hidden");  
                            }          
                         
                      }else{
                            $('#msg').css("visibility","visible");
                            botao.disabled = false;      
                      }      
                                                                  
                    },error: function(){
                        alert('ERRO..SERVIDOR/CAMINHO NAO ENCONTRADO!!');           
                    }

                  });

                });
               //----------------------------------------------
                                 
                        // EVENTO CLIQUE DO BOTAO NOVO
                        $('#btnNovo').click(function(){
                          $('#nome').val($('#campo').val());
                        });

                        // FUNCAO ADICIONAR NOME NO CAMPO
                         function add(nome,id){
                            $('#paciente').val(nome);
                            $('#CampoId').val(id);
                         }

                        // FUNCAO SE O CAMPO PACIENTE ESTIVER VAZIO
                         function enviar(){
                            if($('#paciente').val() == ""){
                              alert("ESCOLHA UM PACIENTE...");
                              return false;
                             }else{
                              return true;
                             }
                        }

        </script>
        <script type="text/javascript">

           // FUNCAO CADASTRO PACIENTE MODAL
           $('#form_cadastro_pac').submit(function(){

            $('#btnSalvar').click(function(){

                  $.post("../Paciente/RegistraPacienteModal.php", 
                
                    $( "#form_cadastro_pac" ).serialize()
                  
                   ,function(data){

                        alert(data);
                        window.location = '../Telas/TelaCadastroAgenda.php';
                      
                    }).error(function() {

                        alert("ERRO..SERVIDOR/CAMINHO NAO ENCONTRADO!!");
                      
                    });

            })
              
       });

        </script>    
    </body>
</html>