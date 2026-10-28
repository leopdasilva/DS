<?php 

    class PortfolioController
    {
        public function index(){
            require __DIR__ . "/../../../resources/views/portfolio.php";
        }

        public function idade() {
            require __DIR__ . "/../../../resources/views/projetos/idade.php";
        }
    
        public function notas() {
            require __DIR__ . "/../../../resources/views/projetos/notas.php";
        }
    
        public function login() {
            require __DIR__ . "/../../../resources/views/projetos/login-basico.php";
        }
    
        public function jogos() {
            require __DIR__ . "/../../../resources/views/projetos/jogos.php";
        }

        public function poo() {
            require __DIR__ . "/../../../resources/views/projetos/poo2.php";
        }

    }


?>