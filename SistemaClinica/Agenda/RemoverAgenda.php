<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../tmp'));
session_start();

require_once '../util/daoGenerico.php';
require_once '../Agenda/Agenda.php';

$metodo = $_GET;
if(isset($metodo["agenda"])){
    $id = $metodo["agenda"];
    $agenda = new Agenda();
    $agenda->valorpk = $id;
    
    if($agenda->deletar($agenda)){
        echo "<script>alert('AGENDA EXCLUIDA COM SUCESSO!!');location.href='TelaAgendaTable.php';</script>";
    }else{
        
        echo "<script>alert('NÃO FOI POSSIVEL EXCLUIR A AGENDA ESCOLHIDA!!');location.href='TelaAgendaTable.php';</script>";
    }
}
