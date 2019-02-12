<?php

require_once '../BancoDeDados/Conexao_Banco_ClinicaTorres.php.inc';

class daoGenerico extends ConexaoDB {
    
    public function inserir($objeto){
       $sql = "INSERT INTO ".$objeto->tabela." (";
       for($i=0; $i<count($objeto->campos_valores); $i++){
           $sql .= key($objeto->campos_valores);
           if($i< (count($objeto->campos_valores)-1)){
               $sql .=", ";
           }else{
               $sql .=") ";
           }
           next($objeto->campos_valores);     
        }
        reset($objeto->campos_valores);
        $sql .= "VALUES (";
        for($i=0; $i<count($objeto->campos_valores); $i++){
           $sql .= is_numeric($objeto->campos_valores[key($objeto->campos_valores)]) ?
                   $objeto->campos_valores[key($objeto->campos_valores)] :
                   "'".$objeto->campos_valores[key($objeto->campos_valores)]."'";
           if($i< (count($objeto->campos_valores)-1)){
               $sql .=", ";
           }else{
               $sql .=") ";
           }
           next($objeto->campos_valores);     
        }
            //echo $sql;
           return $this->executaSQL($sql);
       }
       
   public function atualizar($objeto){
           $sql = "UPDATE ".$objeto->tabela." SET ";
       for($i=0; $i<count($objeto->campos_valores); $i++){
           $sql .= key($objeto->campos_valores)."=";
           $sql .= is_numeric($objeto->campos_valores[key($objeto->campos_valores)]) ?
                   $objeto->campos_valores[key($objeto->campos_valores)] :
                   "'".$objeto->campos_valores[key($objeto->campos_valores)]."'";
           if($i< (count($objeto->campos_valores)-1)){
               $sql .=", ";
           }else{
               $sql .=" ";
           }
           next($objeto->campos_valores);     
        }
        $sql .= "WHERE ".$objeto->campopk."=";
        $sql .= is_numeric($objeto->valorpk) ? $objeto->valorpk : "'".$objeto->valorpk."'";
        
           return $this->executaSQL($sql);
   }
   
   public function deletar($objeto){
        $sql = "DELETE FROM ".$objeto->tabela;
         
        $sql .= " WHERE ".$objeto->campopk."=";
        $sql .= is_numeric($objeto->valorpk) ? $objeto->valorpk : "'".$objeto->valorpk."'";
         
           return $this->executaSQL($sql);
    }
    
     public function pesquisarID($objeto){
        $sql = " SELECT * FROM ".$objeto->tabela;
      
        $sql .= "  WHERE ".$objeto->campopk."=";
        $sql .= is_numeric($objeto->valorpk) ? $objeto->valorpk : "'".$objeto->valorpk."'";
         
        //echo $sql;
        return $this->executaSQL($sql);
    }
    
    public function retornaTudo($objeto){
       $sql = "SELECT * FROM ".$objeto->tabela;
       if($objeto->extra_select!=null){
           $sql .= " ".$objeto->extra_select;
       }
       return $this->executaSQL($sql);
   }
   
    public function retornaCampos($objeto){
        $sql = "SELECT ";
         for($i=0; $i<count($objeto->campos_valores); $i++){
           $sql .= key($objeto->campos_valores);
           if($i< (count($objeto->campos_valores)-1)){
               $sql .=", ";
           }else{
               $sql .=" ";
           }
           next($objeto->campos_valores);     
        }
        
        $sql .= " FROM ".$objeto->tabela;
       if($objeto->extra_select!=null){
           $sql .= " ".$objeto->extra_select;
       }
       return $this->executaSQL($sql);
   }
   
   public function executaSQL($sql=null){
       if ($sql != null){
           $query = mysqli_query($this->conexao, $sql) or $this->trataErro(__FILE__,__FUNCTION__);
           $this->linhaAfetada = mysqli_affected_rows($this->conexao);
           if(substr(trim(strtolower($sql)),0,6)=='select'){
               $this->dataset = $query;
               return $query;
           }else{
               return $this->linhaAfetada;
           }
       }
   }
   
   public function retornaDados($tipo=null){
       switch(strtolower($tipo)){
           case "array":
               return mysqli_fetch_array($this->dataset);
               break;
           case "assoc":
               return mysqli_fetch_assoc($this->dataset);
               break;
           case "object":
               return mysqli_fetch_object($this->dataset);
               break;
       }
   }


   //* LISTAR DADOS DA AGENDA NA TABELA
   public function ListarAgendas(){
     $sql = "SELECT A.IDAGENDA AS 'ID', A.DATADEATENDIMENTO AS 'DATADEATENDIMENTO', P.NOME AS 'NOMEDOPACIENTE', M.NOME AS 'NOMEDOMEDICO', 
        T.TIPOATENDIMENTO AS 'TIPODEATENDIMENTO'
        FROM AGENDA A
        INNER JOIN PACIENTE P
        ON P.IDPACIENTE = A.ID_PACIENTE
        INNER JOIN MEDICO M
        ON M.IDMEDICO = A.ID_MEDICO
        INNER JOIN ATENDIMENTO T
        ON T.IDATENDIMENTO= A.ID_ATENDIMENTO";

        return $this->executaSQL($sql);
   }


   //* LISTAR AGENDAMENTOS FEITOS POR DATA NA HOME
   public function retornarPorData($dataInicial,$dataFinal){
     $sql = "SELECT G.DATADEATENDIMENTO AS 'DATADEATENDIMENTO', P.NOME AS 'NOMEDOPACIENTE' ,M.NOME AS 'NOMEDOMEDICO',A.TIPOATENDIMENTO AS 'TIPODEATENDIMENTO', P.CELULAR AS 'CELULAR' FROM AGENDA AS G INNER JOIN PACIENTE AS P ON IDPACIENTE = ID_PACIENTE INNER JOIN MEDICO AS M ON IDMEDICO = ID_MEDICO INNER JOIN ATENDIMENTO AS A ON IDATENDIMENTO = ID_ATENDIMENTO WHERE G.DATADEATENDIMENTO BETWEEN '$dataInicial' AND '$dataFinal'";

      return $this->executaSQL($sql);
   }


   //* LISTAR AGENDAMENTOS NA HOME POR FILTRO
   public function ListarPorFiltro($nomeM,$dataInicial,$dataFinal){
    $sql = "SELECT G.DATADEATENDIMENTO AS 'DATADEATENDIMENTO', P.NOME AS 'NOMEDOPACIENTE' ,M.NOME AS 'NOMEDOMEDICO',A.TIPOATENDIMENTO AS 'TIPODEATENDIMENTO', P.CELULAR AS 'CELULAR' FROM AGENDA AS G INNER JOIN PACIENTE AS P ON IDPACIENTE = ID_PACIENTE INNER JOIN MEDICO AS M ON IDMEDICO = ID_MEDICO INNER JOIN ATENDIMENTO AS A ON IDATENDIMENTO = ID_ATENDIMENTO WHERE G.DATADEATENDIMENTO BETWEEN '$dataInicial' AND '$dataFinal' AND M.NOME LIKE '%$nomeM%'";

    return $this->executaSQL($sql);
   }

   //* LISTAR NOME E ENDERECO NO MODAL CADASTRO AGENDA
   public function retornarDadosModal($name){
     $sql = "SELECT IDPACIENTE,NOME,ENDERECO FROM PACIENTE WHERE NOME LIKE '%$name%'";
     return $this->executaSQL($sql);
   }

    public function retornarPesquisaModal($name){
     $sql = "SELECT IDPACIENTE,NOME FROM PACIENTE WHERE NOME LIKE '%$name%'";
     return $this->executaSQL($sql);
   }

   //INSERIR PACIENTE COM OU SEM DATA
   public function inserirPaciente($nome,$sexo,$valorData,$data_atual,$cpf,$rg,
            $email,$profissao,$telefone,$celular,$indicacao,$estadocivil,$endereco,$bairro,$numero,$cidade,$estado,$complemento,$cep){
     
     if($valorData != null){

       $data_formatada = date("Y-m-d",strtotime(str_replace('/','-',$valorData)));

       $sql = "INSERT INTO PACIENTE (NOME,SEXO,DATANASC,DATACADASTRO,CPF,RG,EMAIL,PROFISSAO,TELEFONE,CELULAR,INDICACAO,ESTADOCIVIL,
        ENDERECO,BAIRRO,NUMERO,CIDADE,ESTADO,COMPLEMENTO,CEP) VALUES ('$nome','$sexo','$data_formatada','$data_atual','$cpf','$rg','$email',
        '$profissao','$telefone','$celular','$indicacao','$estadocivil','$endereco','$bairro','$numero','$cidade','$estado','$complemento',
       '$cep')";
     }else{

        $sql = "INSERT INTO PACIENTE (NOME,SEXO,DATANASC,DATACADASTRO,CPF,RG,EMAIL,PROFISSAO,TELEFONE,CELULAR,INDICACAO,ESTADOCIVIL,
        ENDERECO,BAIRRO,NUMERO,CIDADE,ESTADO,COMPLEMENTO,CEP) VALUES ('$nome','$sexo',null,'$data_atual','$cpf','$rg','$email','$profissao','$telefone','$celular','$indicacao','$estadocivil','$endereco','$bairro','$numero','$cidade','$estado','$complemento','$cep')";
     }

     return $sql;

   }

   //INSERIR PACIENTE COM OU SEM DATA NO MODAL
    public function inserirPacienteModal($nome,$sexo,$valorData,$cpf,$celular,$data_atual){
    
     if($valorData != null){

       $data_formatada = date("Y-m-d",strtotime(str_replace('/','-',$valorData)));

       $sql = "INSERT INTO PACIENTE (NOME,SEXO,DATANASC,CPF,CELULAR,DATACADASTRO) VALUES ('$nome','$sexo','$data_formatada','$cpf','$celular','$data_atual')";
     }else{

       $sql = "INSERT INTO PACIENTE (NOME,SEXO,DATANASC,CPF,CELULAR,DATACADASTRO) VALUES ('$nome','$sexo',NULL,'$cpf','$celular','$data_atual')";
     }

     return $sql;

   }

   //ATUALIZAR TABELA PACIENTE COM OU SEM DATA
    public function atualizarPaciente($nome,$sexo,$valorData,$data_atual,$cpf,$rg,
            $email,$profissao,$telefone,$celular,$indicacao,$estadocivil,$endereco,$bairro,$numero,$cidade,$estado,$complemento,$cep,$id){
     
     if($valorData != null){

       $data_formatada = date("Y-m-d",strtotime(str_replace('/','-',$valorData)));

       $sql = "UPDATE PACIENTE SET NOME = '$nome',SEXO = '$sexo',DATANASC = '$data_formatada',DATACADASTRO = '$data_atual',CPF = '$cpf',RG = '$rg',EMAIL = '$email',PROFISSAO = '$profissao',TELEFONE = '$telefone',CELULAR = '$celular',INDICACAO = '$indicacao',ESTADOCIVIL = '$estadocivil',ENDERECO = '$endereco',BAIRRO = '$bairro',NUMERO = '$numero',CIDADE = '$cidade',ESTADO = '$estado',COMPLEMENTO = '$complemento',CEP = '$cep' WHERE IDPACIENTE = '$id'";
     }else{

        $sql = "UPDATE PACIENTE SET NOME = '$nome',SEXO = '$sexo',DATANASC = NULL, DATACADASTRO = '$data_atual',CPF = '$cpf',RG = '$rg',EMAIL = '$email',PROFISSAO = '$profissao',TELEFONE = '$telefone',CELULAR = '$celular',INDICACAO = '$indicacao',ESTADOCIVIL = '$estadocivil',ENDERECO = '$endereco',BAIRRO = '$bairro',NUMERO = '$numero',CIDADE = '$cidade',ESTADO = '$estado',COMPLEMENTO = '$complemento',CEP = '$cep' WHERE IDPACIENTE = '$id'";
     }

     return $sql;

   }



}
