<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../tmp'));
session_start();
require_once '../util/daoGenerico.php';
require_once './Usuario.php';

$usuario = new Usuario();

//Recuperando o id do URL
$Metodo = $_GET;
if(isset($Metodo["usuario"])){
    $id = $Metodo["usuario"];
    $id = preg_replace('/[^[:alnum:]]/','', $id);
}

$txtTitulo = $_POST;
//Recuperando valores do campo
if(isset($txtTitulo["nome"])){
$nome = addslashes($txtTitulo["nome"]);
$login = addslashes($txtTitulo["login"]);
$senha = addslashes($txtTitulo["senha"]);
$tipo = addslashes($txtTitulo["tipoUsuario"]);

$usuario->setValor("NOME", $nome);
$usuario->setValor("LOGIN", $login);
$usuario->setValor("SENHA", md5($senha));
$usuario->setValor("TIPOUSUARIO", $tipo);

$usuario->valorpk = $id;

if ($usuario->atualizar($usuario)){
    echo  "<script>alert('USUARIO ATUALIZADO COM SUCESSO!!');window.location = './TelaUsuarioTable.php';</script>";
}else{
    echo "<script>alert('NÃO FOI MODIFICADO NADA AINDA!!.');</script>";
}

}

?>
