<?php

include_once '../util/daoGenerico.php';
include_once '../BancoDeDados/Conexao_Banco_ClinicaTorres.php.inc';

class PesquisarPorNome extends ConexaoDB {
        
    public function Pesquisar($nome){
           
        $dao = new daoGenerico();
        
        $sql = "SELECT NOME FROM USUARIO LIKE '%$nome%'";
        
        $resultado_pesquisa = mysqli_query($this->conexao, $sql);
        
        if($resultado_pesquisa){
            return $resultado_pesquisa;
        }else{
            echo "<script>alert('ERRO AO TENTAR BUSCAR USUARIO NO BANCO!!');window.location = '../Telas/TelaCadastroUsuario.php';</script>";
        }
        
    }
}
