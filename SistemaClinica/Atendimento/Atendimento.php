<?php

require_once '../util/baseBD.php';

class Atendimento extends baseBD {
    public function __construct($campos=array()){
        parent::__construct();
        $this->tabela = "ATENDIMENTO";
        if(sizeof($campos)<=0){
            $this->campos_valores = array(
            "TIPOATENDIMENTO" => NULL,
            
            );
            
        }else{
            $this->campos_valores = $campos;
        }
            
        $this->campopk = "IDATENDIMENTO";
    }
    
    
 }



