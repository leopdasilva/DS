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
    <title>Login básico | PHP</title>
    <link rel="stylesheet" href="../style/layout.css">
</head>
<body>
     <!-- CABEÇALHO -->
    <header>
        <nav class="navbar">
            <h2 class="logo">Meu portifólio</h2>

            <ul class="menu">
                <li><a href="../index.php">Inicio</a></li>
                <li><a href="../index.php#projetos-php">Atividades</a></li>
            </ul>
        </nav>
    </header>

    <!-- CONTEÚDO DA ATIVIDADE -->
    <main class="pagina-projeto">
        <!-- CABEÇALHO DA ATIVIDADE -->
        <section class="cabecalho-projeto">
            <p class="projeto-tipo">
                atividade
            </p>
            <h1>Login básico</h1>
            <p>Atividade desenvolvida durantes as aulas de desenvolvimento de sistemas</p>
        </section>

        <!-- ATIVIDADE: DESENVOLVA A ATIVIDADE A PARTIR DAQUI -->
        <section class="conteudo-projeto">

            <form method="POST" class="card">
                <label for="nome">Usuário:</label>
                <input type="text" id="usuario" name="usuario" placeholder="Digite o seu usuário" required><br><br>

                <label for="idade">Senha:</label>
                <input type="password" id="senha" name="senha" min=8 placeholder="Digite a sua senha" required><br><br>

                <button type="submit">Login</button><br><br>
                
                <a href="javascript:void(0)" onclick="alert('Usuário: leonardo25\nSenha: bananada')">Usuário e senha</a><br><br>
                
                <?php if($mensagem != "") { ?>
                    <div>
                        <p><?= $mensagem ?></p>
                    </div>
                <?php } ?>
            </form>

        </section>

        <!-- FIM DA ATIVIDADE -->
        <div class="voltar-projetos">
            <a href="../index.php#projetos-php"> ← Voltar para atividades</a>
        </div>
    </main>

    <!-- RODAPÈ -->
    <footer>
        <p>
            Desenvolvido por <a href="https://leonardo315.devlook.xyz">Leonardo P. da Silva </a> • 2026
        </p>
    </footer>

    
</body>
</html>