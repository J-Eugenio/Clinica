<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../tmp'));
session_start();
require_once '../util/daoGenerico.php';
require_once '../Paciente/Paciente.php';
/**
 * Description of Paciente
 *
 * @author Felipe
 */

//PEGANDO O ID DO USUARIO A SER DELETADO
$pegarId = $_GET;
if(isset($pegarId["Idpaciente"])){
    $id = $pegarId["Idpaciente"];
    $id = preg_replace('/[^[:alnum:]]/','', $id);
    
    $paciente = new Paciente();
    $paciente->valorpk = $id;
    
    if ($paciente->deletar($paciente)){
        echo "
		<script>
			alert('PACIENTE EXCLUIDO COM SUCESSO!!')
			location.href='TelaPacienteTable.php';
		</script>";
    }else{
        echo "
		<script>
			alert('NÃO FOI POSSIVEL EXCLUIR O PACIENTE!!');
			location.href='TelaPacienteTable.php';
		</script>";
    }
}
