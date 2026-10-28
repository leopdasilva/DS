<?php 

//==================================================
// SISTEMA DE CONTROLE DE PRODUÇÃO INDUSTRIAL
//==================================================    

// 1. CLASSE ABSTRATA
abstract class Maquina {
    public $nome;
    private $producao;

    public function __construct($nome)
    {
        $this->nome = $nome;
        $this->producao = 0;
    }

    //ENCAPSULAMENTO - GETTER
    public function getProducao(){
        return $this->producao;
    }

    //ENCAPSULAMENTO - ALTERAÇÃO CONTROLADA
        public function registrarProducao($quantidade) {
            if ($quantidade <= 0) {
                return false;
            }

            $this->producao += $quantidade;
            return true;
        }

}

?>