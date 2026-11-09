<?php 
    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    class PortfolioController
    {
        public function index(){
            return view('portfolio');
        }

        // Idade
        public function idade() {
            return view('projetos.idade');
        }

        public function salvarIdade(Request $request)
        {
            return view('projetos.idade');
        }
    
        // Notas
        public function notas() {
            return view('projetos.notas');
        }
    
        // Login
        public function login() {
            return view('projetos.login-basico');
        }
    
        // Jogos
        public function jogos() {
            return view('projetos.jogos');
        }


        // PoO
        public function poo2() {
            return view('projetos.poo2');
        }

    }


?>