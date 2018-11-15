<?php

include_once '../util/daoGenerico.php';

$dao = new daoGenerico();

  $nome_cpf = $_POST['cpf'];

  $query = $dao->retornarPorCpf($nome_cpf);
 
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
</head>
<body>
    <table>
    	  <?php while ($dado = $query->fetch_array()) { ?>
    	<tr>
    	   <td><?php echo $dado['NOME']; ?></td>
    	   <td><?php print_r(mysqli_num_rows($query)) ?></td>
    	</tr>
    	  <?php } ?>
    </table>
</body>
</html>
