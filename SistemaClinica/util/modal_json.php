<?php

include_once '../util/daoGenerico.php';
$dao =  new daoGenerico();

  $nome = $_POST['name'];

  $query = $dao->retornarDadosModal($nome);
  $qtd = mysqli_num_rows($query);
  
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="../css/modal.css">
  <style type="text/css">
   /*NOME*/
    #column1{
      width: 330px;
    }
   /*ENDERECO*/ 
    #column2{
      width: 165px;
      text-align: center;
    }
    /*BOTAO*/
    #column3{
      width: 120px;
      text-align: right;
    }
  </style>
</head>
<body>
  <table>
     <?php while ($dado = $query->fetch_array()) { ?>
    <tr class="linhas_tabela">
      <td id="col2" hidden><?php echo $qtd; ?></td>
      <td id="column1"><?php echo $dado['NOME']; ?></td>
      <td id="column2"><?php 
      if($dado['ENDERECO']!=""){
        echo $dado['ENDERECO'];
      }else{
        echo "...";
      }  
       ?></td>
      <td id="column3"><button  data-dismiss="modal" type="button" style="border-radius: 20px; color: black;" onclick="add('<?php echo $dado['NOME'];?>','<?php echo $dado['IDPACIENTE'];?>');"><img src="../img/add3.png"></button></td>
    </tr>
     <?php } ?>
  </table>
</body>
</html>
