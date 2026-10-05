<?php
    require "conexao.php";

    echo "<br>Meu sistema está conectado!";

    $sql = "CREATE TABLE IF NOT EXISTS teste (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(100),
        idade INT
    )";

    $pdo -> exec($sql);

    echo "<br>Tabela criada com sucesso!";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HTML & PHP - DS</title>
    <link rel="stylesheet" href="style/index.css">
</head>
<body>
    <h1>Lista de Atividades</h1>
    <ul>
        <li><a href="projetos/idade.php">Atividade 01 - Idade</a></li>
        <li><a href="projetos/notas.php">Atividade 02 - Notas</a></li>
        <li><a href="projetos/notas-desafio.php">Atividade 02 - Notas (Desafio usando GET)</a></li>
        <li><a href="projetos/login-basico.php">Atividade 03 - Login básico</a></li>
        <li><a href="projetos/jogos.php">Atividade 04 - Cadastro de jogos</a></li>
    </ul>

</body>
</html>