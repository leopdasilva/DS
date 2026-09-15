<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HTML & PHP</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <?php 
        $nome = "";
        $idade = "";
        $resultado = "";

        if ($_SERVER["REQUEST_METHOD" == "POST"]) {

            if ($idade > 18) {
                $resultado = "maior de idade";
            } else {
                $resultado = "menor de idade";
            }

            echo "Olá $nome!, você tem $idade anos, portanto, você é $resultado.";
        }
    ?>

    <form class="card" method="POST">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="Nome" placeholder="Digite o seu nome" required><br><br>

        <label for="idade">Idade:</label>
        <input type="number" id="idade" name="Idade" placeholder="Digite a sua idade" required><br><br>

        <button type="submit" value="Enviar">Enviar</button><br><br>

        <div></div>
    </form>
    
</body>
</html>