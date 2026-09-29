<?php
    $nome = "";
    $genero = "";
    $nota = 0;
    $ano = 0;
    $resultado = "";

    require "conexao.php";

    $sql = "CREATE TABLE IF NOT EXISTS lista_jogos (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(100) NOT NULL,
        genero VARCHAR (50) NOT NULL,
        nota INT NOT NULL
        ano INT NOT NULL
    )";

    $pdo -> exec($sql);
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST["nome"];
        $genero = $_POST["genero"];
        $nota = $_POST["nota"];
        $ano = $_POST["ano"];

        $sql_cadastro = "INSERT INTO lista_jogos (nome, genero, nota, ano) VALUES ('$nome', '$genero', $nota, $ano)";
        
        if ($pdo->exec($sql_cadastro)) {
            $resultado = "Jogo cadastrado!";
        } else {
            $resultado = "Erro! Jogo não cadastrado!";
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de jogos - PHP</title>
    <link rel="stylesheet" href="">
</head>
<body>
    <form method="POST" class="card">
        <h1>Cadastro de jogos</h1>

        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" placeholder="Digite o nome do jogo" required><br><br>

        <label for="genero">Gênero:</label>
        <input type="text" id="genero" name="genero" placeholder="Digite o gênero do jogo" required><br><br>

        <label for="nota">Nota:</label>
        <input type="number" id="nota" name="nota" min=0 max=5 placeholder="Digite a nota do jogo (0 a 5)" required><br><br>

        <label for="ano">Ano:</label>
        <input type="number" id="ano" name="ano" min=1980 max=2026 placeholder="Digite o ano de lançamento do jogo" required><br><br>

        <button type="submit">Enviar</button><br><br>

        <?php if($resultado != "") { ?>

            <span style="color: <?= ($resultado == 'Jogo cadastrado!') ? 'green' : 'red' ?>; font-weight: bold;">
                    <?= $resultado ?><br><br>
            </span>

        <?php } ?>

        <a href="index.php">Voltar ao Index</a><br><br>

    </form>
</body>
</html>