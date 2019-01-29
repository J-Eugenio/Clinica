<?php

require_once '../util/daoGenerico.php';

    $dao =  new daoGenerico();

    $valor = $_POST['campo'];

    $query = $dao->retornarPesquisaModal($valor);    
 
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <style type="text/css">
    #nome{
      cursor: pointer;
      border: none;
    }
    #nome:hover{
     background-color: #DCDCDC;
    }
    #celula{
      width: 348px;
      border-radius: 4px;
      padding: 6px 12px;
      padding-top: 0px;
      text-transform: uppercase;
    }
  </style>
</head>
<body>
   <table>    
    <?php  while ($dado = $query->fetch_array()){  ?>
    <tr onclick="setar('<?php echo $dado['IDPACIENTE'];?>','<?php echo $dado['NOME'];?>');"  id="nome"><td id="celula"><?php echo $dado['NOME']?></td></tr>
    <?php   } ?>
   </table>
</body>
</html>
