<?php
    $nome = "";
    $idade = 0;
    $media = 0;
    $situacao = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //Nome e Idade
        $nome = $_POST["nome"];
        $idade = $_POST["idade"];

        //Notas
        $nota1 = $_POST["nota1"];
        $nota2 = $_POST["nota2"];
        $nota3 = $_POST["nota3"];
        $nota4 = $_POST["nota4"];
        $nota5 = $_POST["nota5"];

        //Calculo de média 
        $media = (($nota1 * 2) + ($nota2 * 3) + ($nota3 * 1) + ($nota4 * 1) + ($nota5 * 3)) / 10;

        if ($media >= 7) {
            $situacao = "Aprovado";
        } else if ($media >= 5 & $media < 7) {
            $situacao = "Recuperação";
        } else {
            $situacao = "Reprovado";
        }
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notas - HTML & PHP</title>
</head>

<body>

    <form class="card" method="POST">
        <h1>Verificador de Idade</h1>

        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" placeholder="Digite o seu nome" required><br><br>

        <label for="idade">Idade:</label>
        <input type="number" id="idade" name="idade" placeholder="Digite a sua idade" required><br><br>

        <label for="idade">Nota 1:</label>
        <input type="number" id="nota1" name="nota1" placeholder="Digite a primeira nota" required><br><br>

        <label for="idade">Nota 2:</label>
        <input type="number" id="nota2" name="nota2" placeholder="Digite a segunda nota" required><br><br>

        <label for="idade">Nota 3:</label>
        <input type="number" id="nota3" name="nota3" placeholder="Digite a terceira nota" required><br><br>
        
        <label for="idade">Nota 4:</label>
        <input type="number" id="nota4" name="nota4" placeholder="Digite a quarta nota" required><br><br>

        <label for="idade">Nota 5:</label>
        <input type="number" id="nota5" name="nota5" placeholder="Digite a quinta nota" required><br><br>

        <button type="submit">Enviar</button><br><br>

    </form>

    <a href="index.php">Voltar ao Index</a>

    <?php if($situacao != "") { ?>
        <p>Aluno: <?=$nome?></p>
        <p>Idade: <?=$idade?></p><br><br>

        <p>Nota 1: <?=$nota1?></p>
        <p>Nota 2: <?=$nota2?></p>
        <p>Nota 3: <?=$nota3?></p>
        <p>Nota 4: <?=$nota4?></p>
        <p>Nota 5: <?=$nota5?></p><br><br>

        <p>Media final: <strong><?=$media?></strong></p><br><br>

        <p>Situação: 
            <span style="color: <?= ($situacao == 'Aprovado') ? 'green' : (($situacao == 'Recuperação') ? 'orange' : 'red') ?>; font-weight: bold;">
                <?= $situacao ?>
            </span>
        </p>
    <?php } ?>
</body>
</html>