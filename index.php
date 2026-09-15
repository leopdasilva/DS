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
        if ($_SERVER["REQUEST_METHOD" == "POST"]) {
            $name = htmlspecialchars($_POST['Nome']);
            $idade = (int)htmlspecialchars($_POST['Idade']);

            if ($idade > 18) {
                $maioridade = "maior de idade";
            } else {
                $maioridade = "menor de idade";
            }

            echo "Olá $nome!, você tem $idade anos, portanto, você é $maioridade.";
        }
    ?>

    <form class="card" action="" method="post">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="Nome" placeholder="Nome" required><br><br>

        <label for="idade">Idade:</label>
        <input type="number" id="idade" name="Idade" placeholder="Idade" required><br><br>

        <button type="submit" value="Enviar">Enviar</button>
    </form>
    
</body>
</html>