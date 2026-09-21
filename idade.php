<?php 
    $nome = "";
    $idade = 0;
    $resultado = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST["nome"];
        $idade = $_POST["idade"];

        if ($idade > 18) {
            $resultado = "maior de idade";
        } else {
            $resultado = "menor de idade";
        }

    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IDADE - HTML & PHP</title>
    <link rel="stylesheet" href="idade.css">
</head>

<body>

    <form class="card" method="POST">
        <h1>Sistema de cadastro e situação</h1>

        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" placeholder="Digite o seu nome" required><br><br>

        <label for="idade">Idade:</label>
        <input type="number" id="idade" name="idade" placeholder="Digite a sua idade" required><br><br>

        <button type="submit">Enviar</button><br><br>

        <a href="index.php">Voltar ao Index</a>
    </form>
    
    <?php if($resultado != "") { ?>

        <p class="card">Seu nome é <strong><?= $nome ?></strong>, você tem <strong><?= $idade ?></strong> anos, portanto, você é <strong><?= $resultado ?></strong>.</p>

    <?php } ?>

</body>
</html>