<?php

include_once '../util/daoGenerico.php';
include_once '../BancoDeDados/Conexao_Banco_ClinicaTorres.php.inc';

class ValidaCadastro extends ConexaoDB {
         
    public function validarCadastro($login){
           
        $dao = new daoGenerico();
        
        $sql = "SELECT LOGIN FROM USUARIO WHERE LOGIN = '$login' ";
        
        $resultado = mysqli_query($this->conexao, $sql);
        
        if($resultado){
            return $resultado;
        }else{
            echo "<script>alert('ERRO AO TENTAR BUSCAR USUARIO NO BANCO!!');window.location = '../Telas/TelaCadastroUsuario.php';</script>";
        }
        
    }
    
}
