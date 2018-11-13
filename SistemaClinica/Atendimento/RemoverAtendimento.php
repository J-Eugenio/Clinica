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
        echo "<script>alert('Atendimento deletada com sucesso!');location.href='TelaAtendimentoTable.php';</script>";
    }else{
        
        echo "<script>alert('Nao foi possivel deletar o atendimento.');location.href='TelaAtendimentoTable.php';</script>";
    }
}
