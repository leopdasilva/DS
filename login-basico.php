<?php
    $usuario = "leonardo25";
    $senha = "bananada";
    $mensagem = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $usuario = $_POST["usuario"];
        $senha = $_POST["senha"];

        if ($usuario == "leonardo25" && $senha == "bananada") {
            $mensagem = "Login realizado com sucesso!";
        } else {
            $mensagem = "Usuário e/ou senha incorretos";
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login básico - PHP</title>
    <link rel="stylesheet" href="style/login-basico.css">
</head>
<body>
    <form method="POST" class="card">
        <h1>Login</h1>

        <label for="nome">Usuário:</label>
        <input type="text" id="usuario" name="usuario" placeholder="Digite o seu usuário" required><br><br>

        <label for="idade">Senha:</label>
        <input type="password" id="senha" name="senha" min=8 placeholder="Digite a sua senha" required><br><br>

        <button type="submit">Login</button><br><br>
        
        <a href="javascript:void(0)" onclick="alert('Usuário: leonardo25\nSenha: bananada')">Usuário e senha</a><br><br>

        <a href="index.php">Voltar ao Index</a>
        
        <?php if($mensagem != "") { ?>
            <div>
                <p><?= $mensagem ?></p>
            </div>
        <?php } ?>
    </form>

</body>
</html>