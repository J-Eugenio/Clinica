<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../tmp'));
session_start();

require_once '../util/daoGenerico.php';
require_once '../Atendimento/Atendimento.php';

$metodo = $_GET;
if(isset($metodo["atendimento"])){
    $id = $metodo["atendimento"];
    $id = preg_replace('/[^[:alnum:]]/','', $id);
    $atendimento = new Atendimento();
    $atendimento->valorpk = $id;
    
    if($atendimento->deletar($atendimento)){
        echo "<script>alert('ATENDIMENTO EXCLUIDO COM SUCESSO!!');location.href='TelaAtendimentoTable.php';</script>";
    }else{
        
        echo "<script>alert('NÃO FOI POSSIVEL EXCLUIR O ATENDIMENTO ESCOLHIDO!!');location.href='TelaAtendimentoTable.php';</script>";
    }
}
