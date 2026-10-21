<?php 

    require_once __DIR__ . '/../app/Http/Controllers/PortfolioController.php';
    //require_once __DIR__ . '/../app/Http/Controllers/HelpdeskController.php';


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