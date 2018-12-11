<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../tmp'));
session_start();

require_once '../util/daoGenerico.php';
require_once './Usuario.php';

//Recuperar o id do usuario a ser Deletado
$Metodo = $_GET;
if(isset($Metodo["usuario"])){
    $id = $Metodo["usuario"];
    $id = preg_replace('/[^[:alnum:]]/','', $id);
    
    $usuario = new Usuario();
    $usuario->valorpk = $id;
    
    if ($usuario->deletar($usuario)){
        echo "
		<script>
			alert('USUARIO EXCLUIDO COM SUCESSO!!')
			location.href='TelaUsuarioTable.php';
		</script>";
    }else{
        echo "
		<script>
			alert('NÃO FOI POSSIVEL EXCLUIR O USUARIO ESCOLHIDO!!');
			location.href='TelaUsuarioTable.php';
		</script>";
    }
}
