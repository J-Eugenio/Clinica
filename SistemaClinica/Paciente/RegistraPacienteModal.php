<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../tmp'));
session_start();
include '../Paciente/Paciente.php';
/**
 * Description of Paciente
 *
 * @author Felipe
 */
$metodo = $_POST;

//PEGANDO VALORES DOS CAMPOS
if (isset($metodo["txtNome"])) {
    $nome = addslashes($metodo["txtNome"]);
    $sexo = addslashes($metodo["cxSexo"]);
    $datanasc = addslashes($metodo["txtDataNasc"]);
    $cpf = addslashes($metodo["txtCPF"]);
    $celular = addslashes($metodo["txtCelular"]);

      //SETANDO OS VALORES NO OBJETO
        $paciente = new Paciente();

        $paciente->setValor("NOME", $nome);
        $paciente->setValor("SEXO", $sexo);
        $paciente->setValor("DATANASC", date("Y-m-d",strtotime(str_replace('/','-',$datanasc))));
        $paciente->setValor("DATACADASTRO", date('Y-m-d')); //DATA DE CADASTRO DE CADA PACIENTE
        $paciente->setValor("CPF", $cpf);
        $paciente->setValor("CELULAR", $celular);

     if($paciente->inserir($paciente)){
            echo "PACIENTE CADASTRADO COM SUCESSO!!";
        }

}
     

?>
