<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../tmp'));
session_start();
require_once '../Agenda/Agenda.php';
require_once '../Agenda/ListarAgenda.php';
include_once '../Login/ProtectPaginas.php';
include_once '../Medico/Medico.php';
include_once("../BancoDeDados/conexao.php");
protect();

if(isset($_SESSION["tipoUsuario"])){
    $tipo_user = $_SESSION["tipoUsuario"];
}

$medic = new Medico();
$listaAgenda = new ListarAgenda();

//* LISTAR MEDICOS NO COMBOBOX
$medic->retornaTudo($medic);

?>﻿

<html>
<head>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Clinica Cândido Torres</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat+Alternates">
  <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
  <link rel="stylesheet" type="text/css" href="../css/menu.css">
	<link href="https://fonts.googleapis.com/css?family=Raleway:700" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">  
</head>

<body ondragstart="return false;">
	
<?php include '../util/nav.php' ?>

<div class="container-modal">
  <div class="container main">
    <form action="Home.php" method="POST" style="text-transform: uppercase;">
      <div class="row input-group col-md-10 offset-md-1 SearchMed grid">
        <select name="nomeMedico" class="form-control" style="text-transform: uppercase; height: 38px !important;">
          <option value="">Selecione um Médico</option>
            <?php while ($dadoMedic = $medic->retornaDados("object")) { ?>  
            <option value="<?php echo $dadoMedic->NOME; ?>"><?php echo $dadoMedic->NOME; ?></option>
            <?php } ?>
        </select>
        <button type="submit" style="width: 30px; background: #f3f3f3; border: none;">
          <i class="fas fa-search"></i>  
        </button>
      </div> 
    </form>
<div class="row linha col-md-10 offset-md-1">
      <table class="table table-striped table-hover grid">
        <thead class="thead-dark">
          <tr>
            <th>PACIENTE</th>
            <th>MÉDICO</th>
            <th>ATENDIMENTO</th>
            <th>DATA</th>
            <th>TELEFONE</th>
            <th>CHECK</th>
            <th></th>
          </tr>
        </thead>
        <tbody class="tbody-light">
          <?php 
          
          if($_POST){   
            $nMedico = $_POST['nomeMedico'];     
            $con = $listaAgenda->ListarPorFiltro2($nMedico);
          }else{
            $con = $listaAgenda->ListarDadosNaHome();    
          }

          while ($dado = $con->fetch_array()){ ?>
          <tr>
            <td><?php echo $dado['NOMEDOPACIENTE']; ?></td>
            <td><?php echo $dado['NOMEDOMEDICO']; ?></td>
            <td><?php echo $dado["TIPODEATENDIMENTO"]; ?></td>
            <td><?php echo date("d/m/Y", strtotime($dado["DATADEATENDIMENTO"])); ?></td>
            <td><?php echo $dado["CELULAR"]; ?></td>
            <td>
              <a href="">
                <i class="fas fa-calendar-check"></i>
              </a>
            </td>
            <td>
              <a href="" data-toggle="modal" data-target="example">
                <i class="fas fa-dollar-sign"></i>
              </a>
            </td>
          </tr>
          <?php } ?> 
        </tbody>
      </table> 
     </div>
   </div>
</div>


  <?php include '../util/footer.php' ?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script type="text/javascript">
            
       $(document).ready(function(){
              
        var tipo_user = "<?php echo $tipo_user ?>";
              
        if(tipo_user != "Administrador"){
            $('#opcaoUser').remove();
        }
                               
      });
</script>    
</body>
</html>
