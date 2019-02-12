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
        $data_atual = date('Y-m-d');

        $sql = $paciente->inserirPacienteModal($nome,$sexo,$datanasc,$cpf,$celular,$data_atual);
     

     if(mysqli_query($paciente->conexao,$sql)){
           echo "true";
        }else{
           echo "false";
        }

}
     

?>
