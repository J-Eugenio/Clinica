<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../tmp'));
session_start();
include '../Paciente/Paciente.php';
include_once("../../BancoDeDados/conexao.php");
/**
 * Description of Paciente
 *
 * @author Felipe
 */

//DATA DE CADASTRO DE CADA PACIENTE
$data_cadastro = date('d-m-Y');
$metodo = $_POST;


//PEGANDO VALORES DOS CAMPOS
if (isset($metodo["txtNome"])) {
    $nome = addslashes($metodo["txtNome"]);
    $sexo = addslashes($metodo["cxSexo"]);
    $cpf = addslashes($metodo["txtCPF"]);
    $celular = addslashes($metodo["txtCelular"]);
    $estadocivil = addslashes($metodo["cxEstadoCivil"]);
    $d = date("Y-m-d",strtotime($data_cadastro));

        $sql = "INSERT INTO PACIENTE(NOME,SEXO,CPF,CELULAR,ESTADOCIVIL,DATACADASTRO) VALUES ('$nome','$sexo','$cpf','$celular','$estadocivil','$d')";

        $res = mysqli_query($conn,$sql);

         if(mysqli_num_rows($res) > 0 ){
            echo "<script>alert('Paciente cadastrado com sucesso!');window.location = '../Telas/TelaCadastroPaciente.php';</script>";
        } else {
            echo "<script>alert('Você esqueceu de preencher algum campo obrigatório :/');window.history.back(1);</script>";
        }
       
    }
     

?>
