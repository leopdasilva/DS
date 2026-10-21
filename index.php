<?php 
    // Carregando o arquivo de rotas e guardando o valor retornado por ele na variavel $rotas
    $rotas = require __DIR__ .  "/routes/web.php";

    // Se a rota estiver vazia, vai direcionar automaticmanete para o portifólio.
    $rota = $_GET['rota'] ?? 'portifolio';

    // Defininfo a varável de verificação de método HTTP requisitado
    $metodo = $_SERVER['REQUEST_METHOD'];

    // Vereficando se a rota existe, se não existir, define status 404
    if (!isset($rotas[$metodo][$rota])) {
        http_response_code(404);
        echo "Página não encontrada!";
        exit;
    }

    // 
    [$controller, $acao] = $rotas[$metodo][$rota];


    //
    $controller -> $acao();



?>