<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../tmp'));
session_start();

include_once '../Agenda/Agenda.php';
include_once '../Medico/Medico.php';
include_once '../Atendimento/Atendimento.php';
include_once '../Medico/Pesquisar.php';
include_once '../Atendimento/Pesquisar.php';


$Metodo = $_POST;


    $IdPaci = addslashes($Metodo['Idpaciente']);
    $data = addslashes($Metodo["datadeatendimento"]);
    $observacao = addslashes($Metodo['observacao']);
    $IdMedico = addslashes($Metodo["medico"]);
    $IdTipoAtendimento = addslashes($Metodo['TipoAtendimento']);

    //SETANDO VALORES
    $agenda = new Agenda();
    $agenda->setValor("DATADEATENDIMENTO", date("Y-m-d",strtotime(str_replace('/','-',$data))));
    $agenda->setValor("OBSERVACAO", $observacao);
    $agenda->setValor("ID_PACIENTE",$IdPaci);
    $agenda->setValor("ID_MEDICO", $IdMedico);
    $agenda->setValor("ID_ATENDIMENTO", $IdTipoAtendimento);

   if ($agenda->inserir($agenda)) {
        echo "<script>alert('AGENDA CADASTRADA COM SUCESSO!!');window.location = '../Agenda/TelaAgendaTable.php';</script>";
    } else {
        echo "<script>alert('VOCE ESQUECEU DE PREENCHER ALGUM CAMPO OBRIGATÓRIO!! :/');window.history.back(1);</script>";
    }





