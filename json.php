<?php 
    // 1. DECLARAR O CAMINHO DO ARQUIVO JSON
    $caminho = __DIR__ .  "/dados.json";

    // 2. ABRIR/LER O ARQUIVO JSON
    $json = file_get_contents($caminho);

    // 3.  TRANSFORMAR EM ARRAY PHP
    $alunos = json_decode($json, true);

    // 4. CRIAR UM ALUNO
    $novoAluno = [
        "nome" => "Leonardo",
        "idade" => 27,
        "curso" => "Desenvolvimento de Sistemas"
    ];

    // 5. ADICIONAR O ALUNO ARRAY
    $alunos[] = $novoAluno;

    // 6. TRANSFORMAR ARRAY PHP EM JSON
    $jsonAtualizado = json_encode($alunos,
        JSON_PRETTY_PRINT |
        JSON_UNESCAPED_UNICODE    
    );

    // 7. SAKVAR NO ARQUIVO
    file_put_contents($caminho, $jsonAtualizado);
    echo "DADOS REGISTRADOS EM dados.json";

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>