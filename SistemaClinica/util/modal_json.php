<?php

include_once '../util/daoGenerico.php';
  $dao =  new daoGenerico();

  //ARRAY DE DADOS
  $dados = array();

  $nome_cpf = $_POST['cpf'];

  $query = $dao->retornarPorCpf($nome_cpf);

  //LOOP DE INSERCAO NO ARRAY
  while ($dado = $query->fetch_array()) {
  	    $qtd = mysqli_num_rows($query);
   	    $dados['nome'] = $dado['NOME'];
   	    $dados['qtd'] = $qtd;
  }

  //DADOS NO JSON
  echo json_encode($dados);

?>