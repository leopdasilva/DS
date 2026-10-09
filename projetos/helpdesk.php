<?php 
    require_once "helpdesk-func.php";

    $mensagemFeedback = "";

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $acao = $_POST["acao"];

        if ($acao === "abrir-chamado") {
            $mensagemFeedback = cadastrarChamado(
                $_POST["nome"] ?? '',
                $_POST["setor"] ?? '',
                $_POST["equipamento"] ?? '',
                $_POST["desc-prob"] ?? '',
                $_POST["prioridade"] ?? 'Baixa'
            );
        }

        if ($acao === "atualizar-status") {
            $id = isset($_POST["id"]) ? (int)$_POST["id"] : -1;
            $novoStatus = $_POST["status"] ?? '';
            $mensagemFeedback = atualizarStatusChamado($id, $novoStatus);
        }

        if ($acao === "excluir-chamado") {
            $id = isset($_POST["id"]) ? (int)$_POST["id"] : -1;
            $mensagemFeedback = excluirChamado($id);
        }
    }

    $listaChamados = lerChamados();
    $relatorio = gerarRelatorioChamados();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help Desk | PHP</title>
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
            <h1>Help Desk</h1>
            <p>Atividade desenvolvida durantes as aulas de desenvolvimento de sistemas</p>
        </section>

        <!-- ATIVIDADE: DESENVOLVA A ATIVIDADE A PARTIR DAQUI -->
        <section class="conteudo-projeto">

            <form method="POST" class="card">
                <label for="nome">Funcionário:</label>
                <input type="text" id="nome" name="nome" placeholder="Digite o nome do funcionário" required><br><br>

                <label for="setor">Setor:</label>
                <select id="setor" name="setor" required>
                    <option value="Produção">Produção</option>
                    <option value="Administrativo">Administrativo</option>
                    <option value="Logística">Logística</option>
                    <option value="Financeiro">Financeiro</option>
                    <option value="TI">TI</option>
                </select><br><br>

                <label for="equipamento">Equipamento Afetado:</label>
                <select id="equipamento" name="equipamento" required>
                    <option value="Computador">Computador</option>
                    <option value="Impressora">Impressora</option>
                    <option value="Rede">Rede</option>
                    <option value="Sistema">Sistema</option>
                    <option value="Outro">Outro</option>
                </select><br><br>

                <label for="desc-prob">Descrição do problema:</label>
                <input type="text" id="desc-prob" name="desc-prob" class="desc-prob" placeholder="Detalhe o qual foi o problema" required><br><br>

                <p>Prioridade:</p>
                <input type="radio" id="prioridade" name="prioridade" value="Alta" checked>
                <label for="alta">Alta</label><br>

                <input type="radio" id="prioridade" name="prioridade" value="Média" checked>
                <label for="media">Média</label><br>

                <input type="radio" id="prioridade" name="prioridade" value="Baixa" checked>
                <label for="baixa">Baixa</label><br>
            
                <button type="submit" name="acao" value="abrir-chamado">Enviar</button>
                
            </form>

            <h2>Chamado</h2>

            <div class="table-container">
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Funcionário</th>
                        <th>Setor</th>
                        <th>Equip. Afetado</th>
                        <th>Desc. do problema</th>
                        <th>Prioridade</th>
                        <th>Status atual</th>
                    </tr>
                
                    <?php foreach($chamados as $chamado) {?>
                        <tr>
                            <td><?= $chamado["id"]?></td>
                            <td><?= $chamado["nome"]?></td>
                            <td><?= $chamado["setor"]?></td>
                            <td><?= $chamado["equipamento"]?></td>
                            <td><?= $chamado["desc-prob"]?></td>
                            <td><?= $chamado["prioridade"]?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>

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