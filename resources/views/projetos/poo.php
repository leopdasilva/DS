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
    //Mostrar o que é necessário e esconder detalhes complicados de funcionamento

    abstract class Personagem {
        public $nome;
        private $vida; // 'private' para encaplusamento
        public $dano;

        public function __construct($nome, $vida, $dano){
            $this->nome = $nome;
            $this->vida = $vida;
            $this->dano = $dano;
        }

        // GETTER
        public function getVida() {
            return $this->vida;
        }

        //SETTER
        public function setVida($vida) {
            if ($vida < 0) {
                echo "A vida não pode ser negativa!\n";
                return;
            }

            $this->vida = $vida;
        }

        // public function atacar() {
        //     echo "$this->nome realizou um ataque!\n";
        // }

        // Toda classe filha deverá implementar atacar()

        abstract public function atacar();
    }

    // ------------------------------------------------

    // $leonardo = new Personagem("Leonardo", 100, 10);

    // // Define novo valor de vida
    // $leonardo->setVida(50);

    // $alice = new Personagem("Alice", 50, 5);

    // // Remove 15 de vida da Alice diretamente
    // $alice->setVida($alice->getVida() - 15);

    // $jose = new Personagem("José", 30, 3);

    //$leonardo->atacar();

    // ------------------------------------------------

    class Guerreiro extends Personagem {
        // Sobreescrevendo o método da classe pai
        public function atacar(){
            echo "$this->nome atacou com uma espada!\n";
        }

        public function defender() {
            echo "$this->nome levantou o escudo!\n";
        }
    }

    // ------------------------------------------------

    //$guerreiro -> atacar(); // Método herdado
    //$guerreiro -> defender(); // Método próprio

    // ------------------------------------------------

    class Mago extends Personagem {
        // Sobreescrevendo o método da classe pai
        public function atacar() {
            echo "$this->nome lançou uma bola de fogo!\n";
        }
    }

    // ------------------------------------------------

    // $mago = new Mago("Alice", 50, 5);
    // $mago->atacar();        // Herdado de Personagem
    // $mago->lancarMagia();   // Próprio de Mago

    // ------------------------------------------------

    // ------------------------------------------------

    class Curandeiro extends Personagem {
        // Sobrescrevendo o método da clase pai

        public function atacar()
        {
            echo "$this->nome atacou com uma faca!\n";
        }

        public function curar(Personagem $alvo, int $quantidade) {
            $novaVida = $alvo->getVida() + $quantidade;
            $alvo->setVida($novaVida);
            echo "$this->nome curou {$alvo->nome} em $quantidade HP!\n";
        }
    }

    // ------------------------------------------------

    $guerreiro = new Guerreiro("Leonardo", 100, 10);
    $mago = new Mago("Alice", 50, 5);
    $curandeiro = new Curandeiro("Sabrina", 30, 3);

    $personagens = [$guerreiro, $mago, $curandeiro];

    foreach($personagens as $p) {
        $p->atacar();
    }

    echo "Vida antes da cura: " . $guerreiro->getVida() . "\n";

    $curandeiro->curar($guerreiro,25);

    echo "Vida depois da cura: " . $guerreiro->getVida() . "\n";

    // ------------------------------------------------

    //Rota: https://leonardo315.devlook.xyz/resources/views/projetos/poo.php

    // ------------------------------------------------

    //1. O que é uma classe?
    //Um molde para criar objetos

    //2. O que significa new Personagem()?
    //Criar um objeto da classe Personagem

    //3. Para que serve $this->nome?
    //Acesar o nome do objeto atual

    //4. O que significa extends?
    //Herdar características e métodos de outra classe

    // ------------------------------------------------

?>