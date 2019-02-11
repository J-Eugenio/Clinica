<script type="text/javascript">

   function setar(id,nome){
     $('#Idbtn').val(id);
     $('#selecionado').text(nome.toUpperCase());
     $('#icon').css("visibility","visible");
     document.getElementById('Idbtn').disabled = false;
   }

   //* REINICIAR MODAL AO CLICAR NO BOTAO DE ABRIR*//
   function limparModal(){
     $('#Idbtn').val('');
     $('#campo_pesquisa').val('');
     $('#selecionado').text('');
     $('#icon').css("visibility","hidden");
     document.getElementById('Idbtn').disabled = true;
     
      $('.tabela tr').each(function(){
          $('#cl0').html('');
          $(this).find('#cl1').show();
      });
   }

   function zerar(){
     $('#diaIni').val('');
     $('#diaFim').val('');
     $('#anoCadastro').val('');
   }

   // FUNCAO PESQUISAR DO CAMPO MODAL PACIENTE
    function pesquisar(){

           var valor = $('#campo_pesquisa').val();

              $.ajax({
                    url: '../util/modal_pesquisa_json.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {campo:valor},
                    success: function(response){

                              if(valor != ''){

                                  $('#cl0').html(response);
                                  
                                  $('.tabela tr').each(function(){
                                    $(this).find('#cl1').hide();
                                  });                       

                              }else{

                                   $('#cl0').html('');
                                   
                                   $('.tabela tr').each(function(){
                                     $(this).find('#cl1').show();
                                   });
                               }  
          
                          }
                     });   
 }

</script>
  <!-------------------------------------------- MODAIS TELA DE RELATORIO ------------------------------------------------------------------>
	<!-- MODAL DE ESCOLHA DE MEDICO -->
                 <div class="modal fade" id="ModalMedico" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">SELECIONE UM MÉDICO</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form action="../Relatorio/Agenda/RelatorioAgendaProfissional.php" method="POST" target="_blank">
                          <div class="modal-body">
                            <div class="conteudo">              
              					     	<select class="custom-select" style="text-transform: uppercase; height: 38px !important;" name="medico">
                                <?php while ($dadoMedic = $medic->retornaDados("object")) { ?>  
              									 <option value="<?php echo $dadoMedic->IDMEDICO; ?>"><?php echo $dadoMedic->NOME; ?></option>
                                <?php  }  ?>
              								</select>
                            </div>
                          </div>
                          <div class="modal-footer">
                          	<button type="submit" class="btn btn-success" style="margin: 0 auto;">GERAR RELATÓRIO</button>
                          </div>
                        </form>
                        </div>
                      </div>
                  </div>
 <!-- F I M  M O D A L -->

 <!-- MODAL DE ESCOLHA DE PACIENTE -->
                 <div class="modal fade" id="ModalPaciente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">SELECIONE UM PACIENTE</h5>
                            <button type="button" class="close"  data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form action="../Relatorio/Agenda/RelatorioAgendaPaciente.php" method="POST" target="_blank">
                            <div class="input-group">
                             <input type="text" id="campo_pesquisa" class="form-control up" style="border-radius: 10px; border: 1px solid rgba(0, 0, 0, 0.2); margin: 4px 4px;" onkeyup="pesquisar();" autocomplete="off">
                                <span class="input-group-btn">      
                                <button type="button" class="btn btn-default" id="botao_pes" style="height: 38px; margin: 4px 4px;"><i class="fas fa-search"></i></button>
                                </span>
                            </div>
                            <hr style="margin-bottom: 0px;margin-top: 6px;">
                          <div class="modal-body-pac">
                            <div class="conteudo">
                              <table class="tabela">
                                   
                                   <!-- PESQUISA NOMES DO MODAL AQUI -->
                                   <tr><td id="cl0"></td></tr>

                                   <!-- CARREGAMENTO DE NOMES AUTOMATICO DO MODAL AQUI -->
                                   <?php while ($dadoPac = $pac->retornaDados("object")) { ?>    
                                   <tr onclick="setar('<?php echo $dadoPac->IDPACIENTE;?>','<?php echo $dadoPac->NOME;?>');">
                                   <td class="form-control up" id="cl1" style="width: 348px;padding-top: 0px;"><?php echo $dadoPac->NOME;?></td>
                                   </tr>
                                   <?php    }  ?>

                              </table>              
                            </div>
                          </div>
                          <div class="modal-footer" style="height: 50px;">
                            <img src="../img/confirm.png" id="icon" style="visibility: hidden;">
                            <label id="selecionado" style="margin: 0 auto;"></label>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" name="Idpac" id="Idbtn" class="btn btn-success" style="margin: 0 auto;">GERAR RELATÓRIO</button>
                          </div>
                        </form>
                        </div>
                      </div>
                  </div>
 <!-- F I M  M O D A L -->

 <!-- MODAL DE ESCOLHA DE ATENDIMENTO -->
                 <div class="modal fade" id="ModalAtendimento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">SELECIONE UM ATENDIMENTO</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form action="../Relatorio/Agenda/RelatorioAgendaAtendimento.php" method="POST" target="_blank">
                          <div class="modal-body">
                            <div class="conteudo">              
                              <select class="custom-select" style="text-transform: uppercase; height: 38px !important;" name="atendimento">
                                <?php while ($dadoAtend = $tipoAten->retornaDados("object")) { ?>  
                                <option value="<?php echo $dadoAtend->IDATENDIMENTO; ?>"><?php echo $dadoAtend->TIPOATENDIMENTO; ?></option>
                                <?php  }  ?>
                              </select>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-success" style="margin: 0 auto;">GERAR RELATÓRIO</button>
                          </div>
                        </form>
                        </div>
                      </div>
                  </div>
  <!-- F I M  M O D A L -->

  <!-- MODAL DE ESCOLHA DE SEXO -->
                 <div class="modal fade" id="ModalSexo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">SELECIONE UM SEXO</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form action="../Relatorio/Paciente/RelatorioPacienteSexo.php" method="POST" target="_blank">
                          <div class="modal-body">
                            <div class="conteudo">              
                              <select class="custom-select" style="text-transform: uppercase; height: 38px !important;" name="sexo">
                                <option value="Masculino">MASCULINO</option>
                                <option value="Feminino">FEMININO</option>
                              </select>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-success" style="margin: 0 auto;">GERAR RELATÓRIO</button>
                          </div>
                        </form>
                        </div>
                      </div>
                  </div>
  <!-- F I M  M O D A L -->

   <!-- MODAL DE AGENDAMENTOS POR DATA -->
                 <div class="modal fade" id="ModalAgendaData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document" style="width: 420px;">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">SELECIONE O PERIODO</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form action="../Relatorio/Agenda/RelatorioAgendaPorMes.php" method="POST" id="form_data" target="_blank">
                          <div class="modal-body">
                            <div class="conteudo">
                            <div class="row">             
                              <div class="form-group col-sm-6">
                                <label for="diaIni">Data Inicial:</label>
                                <input class="form-control" type="date" name="DataInicial" id="diaIni" style="height: 38px !important;" required>
                              </div>
                              <div class="form-group col-sm-6">
                                <label for="diaFim">Data Final:</label>
                                <input class="form-control" type="date" name="DataFinal" id="diaFim" style="height: 38px !important;" required>
                              </div>
                            </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-success" style="margin: 0 auto;">GERAR RELATÓRIO</button>
                          </div>
                        </form>
                        </div>
                      </div>
                  </div>
  <!-- F I M  M O D A L -->

   <!-- MODAL DE PACIENTES CADASTRADOS POR DIA -->
                 <div class="modal fade" id="ModalPacienteDia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">SELECIONE DATA</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form action="../Relatorio/Paciente/RelatorioPacienteDia.php" method="POST" target="_blank">
                          <div class="modal-body">
                            <div class="conteudo">
                            <div class="row">             
                              <div class="form-group col-sm-6" style="margin: 0 auto;">
                                <label for="date">DATA DO CADASTRO:</label>
                                <input class="form-control" type="date" name="data_registro_paciente" id="date" style="width: 165px !important;" value="<?php echo date("Y-m-d");?>" required>
                              </div>
                            </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-success" style="margin: 0 auto;">GERAR RELATÓRIO</button>
                          </div>
                        </form>
                        </div>
                      </div>
                  </div>
  <!-- F I M  M O D A L -->

  <!-- MODAL DE PACIENTES CADASTRADOS POR MES -->
                 <div class="modal fade" id="ModalPacienteMes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">SELECIONE O MÊS</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form action="../Relatorio/Paciente/RelatorioPacienteMes.php" method="POST" target="_blank">
                          <div class="modal-body">
                            <div class="conteudo">
                             
                            <label for="mes_registro_paciente">MÊS DE CADASTRO:</label>
                            <select class="custom-select" style="text-transform: uppercase; height: 38px !important; width: 170px;" name="mes_registro_paciente">
                                <option value="01">JANEIRO</option>
                                <option value="02">FEVEREIRO</option>
                                <option value="03">MARÇO</option>
                                <option value="04">ABRIL</option>
                                <option value="05">MAIO</option>
                                <option value="06">JUNHO</option>
                                <option value="07">JULHO</option>
                                <option value="08">AGOSTO</option>
                                <option value="09">SETEMBRO</option>
                                <option value="10">OUTUBRO</option>
                                <option value="11">NOVEMBRO</option>
                                <option value="12">DEZEMBRO</option>
                            </select>

                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-success" style="margin: 0 auto;">GERAR RELATÓRIO</button>
                          </div>
                        </form>
                        </div>
                      </div>
                  </div>
  <!-- F I M  M O D A L -->

  <!-- MODAL DE PACIENTES CADASTRADOS POR ANO -->
                 <div class="modal fade" id="ModalPacienteAno" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">SELECIONE O ANO</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form action="../Relatorio/Paciente/RelatorioPacienteAno.php" method="POST" target="_blank">
                          <div class="modal-body">
                             <div class="conteudo">
                               <div class="row">     
                                 <div class="form-group col-sm-6" style="margin: 0 auto; ">
                                  <label for="date">ANO DE CADASTRO:</label>
                                  <input type="text" name="anoCadastroPaciente" id="anoCadastro" class="form-control" style="width: 120px !important; margin: 0 auto;" autocomplete="off" required>
                                 </div>
                               </div>
                             </div>
                           </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-success" style="margin: 0 auto;">GERAR RELATÓRIO</button>
                          </div>
                        </form>
                        </div>
                      </div>
                  </div>
 <!-- F I M  M O D A L -->

   <!-- MODAL DE PACIENTES POR MES DE NASCIMENTO -->
                 <div class="modal fade" id="ModalPacienteMesNiver" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">SELECIONE O ANO</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form action="../Relatorio/Paciente/RelatorioPacienteMesNiver.php" method="POST" target="_blank">
                          <div class="modal-body">
                            <div class="conteudo">
                            <label for="mes_registro_paciente">MÊS DE NASCIMENTO:</label>
                            <select class="custom-select" style="text-transform: uppercase; height: 38px !important; width: 155px;" name="dataMesNiver">
                                <option value="01">JANEIRO</option>
                                <option value="02">FEVEREIRO</option>
                                <option value="03">MARÇO</option>
                                <option value="04">ABRIL</option>
                                <option value="05">MAIO</option>
                                <option value="06">JUNHO</option>
                                <option value="07">JULHO</option>
                                <option value="08">AGOSTO</option>
                                <option value="09">SETEMBRO</option>
                                <option value="10">OUTUBRO</option>
                                <option value="11">NOVEMBRO</option>
                                <option value="12">DEZEMBRO</option>
                            </select>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-success" style="margin: 0 auto;">GERAR RELATÓRIO</button>
                          </div>
                        </form>
                        </div>
                      </div>
                  </div>
  <!-- F I M  M O D A L -->

  <!-- MODAL DE PACIENTES POR ANO DE NASCIMENTO -->
                 <div class="modal fade" id="ModalPacienteAnoNiver" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document" style="width: 390px;">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">SELECIONE O ANO</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form action="../Relatorio/Paciente/RelatorioPacienteAnoNiver.php" method="POST" target="_blank">
                          <div class="modal-body">
                             <div class="conteudo">
                              <div class="row">    
                                 <div class="form-group col-sm-6" style="margin: 0 auto;">
                                    <label for="date">ANO DE NASCIMENTO:</label>
                                    <input type="text" name="dataAnoNiver" id="anoCadastro" class="form-control" style="height: 38px !important;" required>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-success" style="margin: 0 auto;">GERAR RELATÓRIO</button>
                          </div>
                        </form>
                        </div>
                      </div>
                  </div>
  <!-- F I M  M O D A L -->

 