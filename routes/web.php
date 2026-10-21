<?php 

    require_once __DIR__ . '/../app/Http/Controller/PortfolioController.php';
    //require_once __DIR__ . '/../app/Http/Controller/HelpdeskController.php';


    // Lisatando em arrays as rotas que vamos criar
    return [
        'GET' => [
            'portfolio' => [new PortfolioController(), 'index'],
            //'helpdesk' => [new HelpdeskController(), 'index'],
            //'jogos' => [],
            //'idade' => [],
            //'notas' => [],
            //'login-basico' => []
        ],
        'POST' => [
            //'helpdesk' => [new HelpdeskController(), '']
        ]
    ];






?>