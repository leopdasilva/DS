<?php 

    require_once __DIR__ . '/../app/Http/Controllers/PortfolioController.php';
    //require_once __DIR__ . '/../app/Http/Controllers/HelpdeskController.php';


    // Lisatando em arrays as rotas que vamos criar
    return [
        'GET' => [
            'portfolio' => [new PortfolioController(), 'index'],
            'idade' => [new PortfolioController(), 'idade'],
            'notas' => [new PortfolioController(), 'notas'],
            'login' => [new PortfolioController(), 'login'],
            'jogos' => [new PortfolioController(), 'jogos'],
            'helpdesk' => [new PortfolioController(), 'helpdesk'],
        ],
        'POST' => [
            'login' => [new PortfolioController(), 'login'],
            'helpdesk' => [new PortfolioController(), 'helpdesk']
        ]
    ];






?>