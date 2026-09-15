<?php 
    $nome = "";
    $idade = 0;
    $resultado = "";

    if ($_SERVER["REQUEST_METHOD" == "POST"]) {
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HTML & PHP</title>
    <link rel="stylesheet" href="index.css">
</head>

<body>

    <form class="card" method="POST">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" placeholder="Digite o seu nome" required><br><br>

        <label for="idade">Idade:</label>
        <input type="number" id="idade" name="idade" placeholder="Digite a sua idade" required><br><br>

        <button type="submit">Enviar</button><br><br>
    </form>
    
    <?php if($resultado != "") { ?>

        <p>Seu nome é <?= $nome ?>, você tem <?= $idade ?> anos, portanto, você é <?= $resultado ?>.</p>;

    <?php } ?>

</body>
</html>