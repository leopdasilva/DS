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
    <style>
        /* ===========================================
            ESTILIZAÇÃO DO FORMULÁRIO DE NOTAS
        =========================================== */

        .conteudo-projeto form {
            display: flex;
            flex-direction: column;
            gap: 12px;
            max-width: 600px;
        }

        .conteudo-projeto label {
            font-weight: bold;
            color: #374151;
            font-size: 14px;
        }

        .conteudo-projeto input[type="text"],
        .conteudo-projeto input[type="number"] {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 15px;
            background-color: #f9fafb;
            transition: border-color 0.2s, background-color 0.2s, box-shadow 0.2s;
        }

        .conteudo-projeto input:focus {
            outline: none;
            border-color: #2563eb;
            background-color: #ffffff;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .conteudo-projeto button[type="submit"] {
            background-color: #2563eb;
            color: white;
            font-weight: bold;
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.2s;
            margin-top: 10px;
        }

        .conteudo-projeto button[type="submit"]:hover {
            background-color: #1d4ed8;
        }

    </style>
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
            <h1>Vereficador de idade</h1>
            <p>Atividade desenvolvida durantes as aulas de desenvolvimento de sistemas</p>
        </section>

        <!-- ATIVIDADE: DESENVOLVA A ATIVIDADE A PARTIR DAQUI -->
        <section class="conteudo-projeto">
            <form class="card" method="POST">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" placeholder="Digite o seu nome" required><br><br>

                <label for="idade">Idade:</label>
                <input type="number" id="idade" name="idade" placeholder="Digite a sua idade" required><br><br>

                <button type="submit">Enviar</button><br><br>
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