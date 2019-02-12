<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../tmp'));
date_default_timezone_set('America/Sao_Paulo');
session_start();
require_once '../Paciente/Paciente.php';
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
    $rg = addslashes($metodo["txtRG"]);
    $email = $metodo["txtEmail"];
    $email = preg_replace('/[^[:alnum:]@.]/','', $email);
    $profissao = addslashes($metodo["txtProfissao"]);
    $telefone = addslashes($metodo["txtTelefone"]);
    $celular = addslashes($metodo["txtCelular"]);
    $indicacao = addslashes($metodo["txtIndicacao"]);
    $estadocivil = addslashes($metodo["cxEstadoCivil"]);
    $endereco = addslashes($metodo["txtEndereco"]);
    $bairro = addslashes($metodo["txtBairro"]);
    $numero = addslashes($metodo["txtNumero"]);
    $cidade = addslashes($metodo["txtCidade"]);
    $estado = addslashes($metodo["txtEstado"]);
    $complemento = addslashes($metodo["txtComplemento"]);
    $cep = addslashes($metodo["txtCEP"]);
    
   

      
        $paciente = new Paciente();
        $data_atual = date('Y-m-d');

        //SETANDO OS VALORES NO PARA INSERIR
        $sql = $paciente->inserirPaciente($nome,$sexo,$datanasc,$data_atual,$cpf,$rg,
            $email,$profissao,$telefone,$celular,$indicacao,$estadocivil,$endereco,$bairro,$numero,$cidade,$estado,$complemento,$cep);


        if (mysqli_query($paciente->conexao,$sql)){
            echo "<script>alert('PACIENTE CADASTRADO COM SUCESSO!! ');window.history.back(1);</script>";  
        } else {
            echo "<script>alert('VOCE ESQUECEU DE PREENCHER ALGUM CAMPO OBRIGATÓRIO :/');window.history.back(1);</script>";
        }
    }

?>
