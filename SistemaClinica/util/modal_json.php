<?php

include_once '../util/daoGenerico.php';
$dao =  new daoGenerico();

  $nome = $_POST['name'];

  $query = $dao->retornarPorNome($nome);
  $qtd = mysqli_num_rows($query);
  
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="../css/modal.css">
</head>
<body>
  <table>
     <?php while ($dado = $query->fetch_array()) { ?>
    <tr class="linhas_tabela">
      <td id="col2" hidden><?php echo $qtd; ?></td>
      <td colspan="2"><?php echo $dado['NOME']; ?></td>
      <td><button type="button" style="border-radius: 20px; color: black;" onclick="add('<?php echo $dado['NOME'];?>');"><img src="../img/add3.png"></button></td>
    </tr>
     <?php } ?>
  </table>
  <script type="text/javascript">

  </script>
</body>
</html>