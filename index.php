<?php 
    // Carregando o arquivo de rotas
    $rotas = require __DIR__ .  "/routes/web.php";

    // Captura o caminho limpo da URL (ex: /login ou /login-basico)
    $rota = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $rota = trim($rota, '/'); // Remove as barras das pontas

    // Se o usuário acessar a raiz do site, vai direto para o portfólio
    if ($rota === '') {
        $rota = 'portfolio';
    }

    // Definindo a variável de verificação de método HTTP requisitado
    $metodo = $_SERVER['REQUEST_METHOD'];

    // Verificando se a rota existe, se não existir, define status 404
    if (!isset($rotas[$metodo][$rota])) {
        http_response_code(404);
        echo "Página não encontrada! Rota [{$metodo}] '/{$rota}' não existe.";
        exit;
    }

    // Separa o Controller e a Ação
    [$controller, $acao] = $rotas[$metodo][$rota];

    // Executa o método
    $controller->$acao();
?>

