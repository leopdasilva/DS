<?php 
    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    class PortfolioController
    {
        public function index(){
            return view('portfolio');
        }

        public function idade() {
            return view('projetos.idade');
        }
    
        public function notas() {
            return view('projetos.notas');
        }
    
        public function login() {
            return view('projetos.login-basico');
        }
    
        public function jogos() {
            return view('projetos.jogos');
        }

        public function poo2() {
            return view('projetos.poo2');
        }

    }


?>