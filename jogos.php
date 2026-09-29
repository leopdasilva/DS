<?php
    $nome = "";
    $genero = "";
    $nota = 0;

    require "conexao.php";

    echo "<br>Meu sistema está conectado!";

    $sql = "CREATE TABLE IF NOT EXISTS lista_jogos (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(100) NOT NULL,
        genero VARCHAR (50) NOT NULL,
        nota INT NOT NULL
    )";

    $pdo -> exec($sql);

    echo "<br>Tabela criada com sucesso!";
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST["nome"];
        $genero = $_POST["genero"];
        $nota = $_POST["nota"];
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de jogos - PHP</title>
</head>
<body>
    <form action="POST" class="card">
        <h1>Verificador de Idade</h1>

        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" placeholder="Digite o nome do jogo" required><br><br>

        <label for="genero">Gênero:</label>
        <input type="text" id="genero" name="genero" placeholder="Digite o gênero do jogo" required><br><br>

        <label for="nota">Nota:</label>
        <input type="number" id="nota" name="nota" min=0 max=5 placeholder="Digite a nota do jogo (0 a 5)" required><br><br>

        <button type="submit">Enviar</button><br><br>

        <a href="index.php">Voltar ao Index</a>

        <?php if($resultado != "") { ?>

            <p class="msg_res">Jogo cadastrado!</p>

        <?php } ?>

    </form>
</body>
</html>