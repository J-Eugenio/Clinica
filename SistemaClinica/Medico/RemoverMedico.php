<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../tmp'));
session_start();

require_once '../util/daoGenerico.php';
require_once '../Medico/Medico.php';

$metodo = $_GET;
if(isset($metodo["medico"])){
   $id = $metodo["medico"];
   $id = preg_replace('/[^[:alnum:]]/','', $id);
   $medico = new Medico();
   $medico->valorpk = $id;
if($medico->deletar($medico)){
    echo "
		<script>
			alert('PROFISSIONAL EXCLUIDO COM SUCESSO!!')
			location.href='TelaMedicoTable.php';
		</script>";
}else{
    echo "
		<script>
			alert('NÃO FOI POSSIVEL EXCLUIR O PROFISSIONAL ESCOLHIDO!!');
			location.href='TelaMedicoTable.php';
		</script>";
}   
}
