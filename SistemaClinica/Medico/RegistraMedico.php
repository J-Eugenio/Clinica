<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../tmp'));
session_start();

include_once '../Medico/Medico.php';

$Metodo = $_POST;
if(addslashes($Metodo["nome"])){    
    $nome = addslashes($Metodo["nome"]);
    $telefone = addslashes($Metodo["telefone"]);
    $email = $Metodo["email"];
    $email = preg_replace('/[^[:alnum:]@.]/','', $email);
    $dtanascimento = addslashes($Metodo["dtanascimento"]);
    $conselho = addslashes($Metodo["conselho"]);
    $especialidade = addslashes($Metodo["especialidade"]);
    $funcao = addslashes($Metodo["funcao"]);
    
    $medico = new Medico();
    $medico->setValor("NOME", $nome);
    $medico->setValor("TELEFONE", $telefone);
    $medico->setValor("EMAIL", $email);
    $medico->setValor("DTANASCIMENTO",date("Y-m-d",strtotime(str_replace('/','-',$dtanascimento))));
    $medico->setValor("CONSELHO", $conselho);
    $medico->setValor("ESPECIALIDADE", $especialidade);
    $medico->setValor("FUNCAO", $funcao);
    
    if($medico ->inserir($medico)){
         echo  "<script>alert('PROFISSIONAL CADASTRADO COM SUCESSO!!');window.location = '../Telas/TelaCadastroMedico.php';</script>";
    }else{
        echo  "<script>alert('VOCE ESQUECEU DE PREENCHER ALGUM CAMPO OBRIGATÓRIO :/');window.history.back(1);</script>";
}
}
