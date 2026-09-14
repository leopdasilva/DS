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
        $nome = "Leonardo";
        $idade = 27;
        if ($idade > 18) {
            $maioridade = "Sim 👍";
        } else {
            $maioridade = "Não 👎";
        }
    ?>

    <div class="card">
        <h1>Nome: <?= $nome ?> </h1>
        <p>Idade: <?= $idade ?> </p>
        <p>Maior de idade?: <?= $maioridade ?></p>
    </div>
    
</body>
</html>