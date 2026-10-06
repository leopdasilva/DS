</html>

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
    <title>Idade | PHP</title>
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
            <h1>Nome da atividade</h1>
            <p>Atividade desenvolvida durantes as aulas de desenvolvimento de sistemas</p>
        </section>

        <!-- ATIVIDADE: DESENVOLVA A ATIVIDADE A PARTIR DAQUI -->
        <section class="conteudo-projeto">
            <form class="card" method="POST">
                <h1>Verificador de Idade</h1>

                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" placeholder="Digite o seu nome" required><br><br>

                <label for="idade">Idade:</label>
                <input type="number" id="idade" name="idade" placeholder="Digite a sua idade" required><br><br>

                <button type="submit">Enviar</button><br><br>

                <a href="../index.php">Voltar ao Index</a>
            </form>
            
            <?php if($resultado != "") { ?>

                <p class="card">Seu nome é <strong><?= $nome ?></strong>, você tem <strong><?= $idade ?></strong> anos, portanto, você é <strong><?= $resultado ?></strong>.</p>

            <?php } ?>

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