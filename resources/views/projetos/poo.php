<?php 
    // PoO: Programação Orientada a Objetos

    // Exemplo SEM POO

    //     $nome1 = "Leonardo";
    //     $vida1 = 100;
    //     $dano1 = 10;

    //     $nome2 = "Alice";
    //     $vida2 = 100;
    //     $dano2 = 15;

    //     function atacar($nome) {
    //         echo "$nome realizou um ataque!";
    //     }

    //     atacar($nome);

    // Exemplo COM POO

    //ENCAPSULAMENTO
    //Proteger informações para que não sejam alteradas de qualquer jeito.
    //HERANÇA
    //Criar uma classe nova aproveitando caracyeristicas da outra.
    //POLIMORFISMO
    //Permitir que objetos diferentes respondam à mesma ação de maneiras diferentes.
    //ABSTRAÇÃO
    //Mostrar o que é necessário e escontar detalhes complicados de funcionamento

    class Personagem {
        public $nome;
        public $vida;
        public $dano;

        public function __construct($nome, $vida, $dano){
            $this->nome = $nome;
            $this->vida = $vida;
            $this->dano = $dano;
        }

        public function atacar() {
            echo "$this->nome realizou um ataque!";
        }

    }

    $leonardo = new Personagem("Leonardo", 100, 10);
    $alice = new Personagem("Alice", 50, 5);
    $jose = new Personagem("José", 30, 3);


?>