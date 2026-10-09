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

                <div class="caixa-campo-radio">
                    <span class="titulo-grupo">Prioridade:</span>
                    
                    <div class="opcao-radio">
                        <input type="radio" id="alta" name="prioridade" value="Alta">
                        <label for="alta">Alta</label>
                    </div>

                    <div class="opcao-radio">
                        <input type="radio" id="media" name="prioridade" value="Média">
                        <label for="media">Média</label>
                    </div>

                    <div class="opcao-radio">
                        <input type="radio" id="baixa" name="prioridade" value="Baixa" checked>
                        <label for="baixa">Baixa</label>
                    </div>
                </div>

            
                <button type="submit" name="acao" value="abrir-chamado">Enviar</button>
                
            </form>

        </section>

        <section class="lista-chamados">
            <h2>Chamados Registrados</h2>
            
            <?php if (empty($listaChamados)): ?>

                <p>Nenhum chamado registrado no momento.</p>

            <?php else: ?>

                <?php foreach ($listaChamados as $id => $chamado): ?>
                    <div class="card-chamado">
                        <h4>#<?php echo $id; ?> - <?php echo htmlspecialchars($chamado["nome"]); ?> [<?php echo $chamado["setor"]; ?>]</h4>
                        <p><strong><?php echo $chamado["equipamento"]; ?>:</strong> <?php echo htmlspecialchars($chamado["descricao"]); ?> (<?php echo $chamado["prioridade"]; ?> | <?php echo $chamado["status"]; ?>)</p>

                        <div class="acoes">
                            <!-- Atualizar -->
                            <form method="POST">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <select name="status">
                                    <option value="Aberto" <?php echo $chamado["status"] === "Aberto" ? "selected" : ""; ?>>Aberto</option>
                                    <option value="Em andamento" <?php echo $chamado["status"] === "Em andamento" ? "selected" : ""; ?>>Em andamento</option>
                                    <option value="Resolvido" <?php echo $chamado["status"] === "Resolvido" ? "selected" : ""; ?>>Resolvido</option>
                                </select>
                                <button type="submit" name="acao" value="atualizar-status">Mudar</button>
                            </form>

                            <!-- Excluir -->
                            <form method="POST" onsubmit="return confirm('Apagar?');">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <button type="submit" name="acao" value="excluir-chamado" class="btn-excluir">Excluir</button>
                            </form>
                        </div>
                    </div>


                <?php endforeach; ?>

            <?php endif; ?>
            
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