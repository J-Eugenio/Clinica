<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../tmp'));
session_start();

include_once '../Atendimento/Atendimento.php';

$Metodo = $_POST;
if(isset($Metodo["nome"])){
    $nome = $Metodo["nome"];
    $nome = preg_replace('/[^[:alnum:]]/','', $nome);
    
    $atendimento = new Atendimento();
    $atendimento ->setValor("TIPOATENDIMENTO", $nome);
    
    if($atendimento->inserir($atendimento)){
        echo  "<script>alert('ATENDIMENTO CADASTRADO COM SUCESSO!!');window.location = '../Telas/TelaCadastroAtendimento.php';</script>";
    }else{
        echo  "<script>alert('VOCE ESQUECEU DE PREENCHER ALGUM CAMPO OBRIGATÓRIO!! :/');window.history.back(1);</script>";
    }
    
}



