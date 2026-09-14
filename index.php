<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HTML & PHP</title>
</head>
<body>
    <?php 
        $nome = "Leonardo";
        $idade = 27;
        if ($idade > 18) {
            $maioridade = "Sim";
        } else {
            $maioridade = "Não";
        }
    ?>
    <h1>Nome: <?= $nome ?> </h1>
    <p>Idade: <?= $idade ?> </p>
    <p>Maior de idade?: <?= $maioridade ?></p>
</body>
</html>