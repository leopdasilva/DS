<?php 

//==================================================
// SISTEMA DE CONTROLE DE PRODUÇÃO INDUSTRIAL
//==================================================    

// 1. CLASSE ABSTRATA
abstract class Maquina {
    public $nome;
    private $producao;

    public function __construct($nome)
    {
        $this->nome = $nome;
        $this->producao = 0;
    }

    // ENCAPSULAMENTO - GETTER
    public function getProducao(){
        return $this->producao;
    }

    // ENCAPSULAMENTO - ALTERAÇÃO CONTROLADA
    public function registrarProducao($quantidade) {
        if ($quantidade <= 0) {
            return false;
        }

        $this->producao += $quantidade;
        return true;
    }

    // ABSTRAÇÃO
    abstract public function operar();

}

// 2. HERANÇA

class Esteira extends Maquina {
    public function operar() {
        return "Transportando peças...";
    }
}

class Prensa extends Maquina {
    public function operar() {
        return "Prensando peças...";
    }
}

class RoboSoldagem extends Maquina {
    public function operar() {
        return "Soldandoo peças...";
    }
}

// 3. SESSÃO = ARMAZENAMENTO TEMPORÁRIO 

if (!isset($_SESSION["maquinas"])) {
    $_SESSION["maquinas"] = [];
}

$mensagem = "";

// 4. RECEBER FORMULÁRIO VIA POST

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST["nome"] ?? "";
    $tipo = $_POST["tipo"] ?? "";
    $quantidade = $_POST["quantidade"] ?? null; 

    if(
        $nome === "" ||
        $quantidade === false ||
        $quantidade <= 0
    ) {
        $mensagem = "Preencha os campos corretamente!";
    } else {
        // CRIANDO OBJETOS COM BASE NO FORMULÁRIO
        if ($tipo === "esteira") {
            $maquina = new Esteira($nome);
        } elseif ($tipo === "prensa") {
            $maquina = new Prensa($nome);
        } elseif ($tipo === "robosoldagem") {
            $maquina = new RoboSoldagem($nome);
        }

        // EXECUTANDO OS MÉTODOS DO OBJETO
        $maquina->registrarProducao($quantidade);

        // GUARDANDO O OBJETO NA SESSÃO
        $_SESSION["maquinas"][] = $maquina;

        $mensagem = "Máquina cadastrada com sucesso!";
    }
}


// Evitar interpretar textos como HTML  
function escapar($texto) {
    return htmlspecialchars(
        (string) $texto,
        ENT_QUOTES,
        "UTF-8");
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layout de atividades | PHP</title>
    <link rel="stylesheet" href="/resources/css/helpdesk.css">
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
            <h1>Programação Orientada a Objetos - Sistema de Controle de Produção Insdustrial</h1>
            <p>Atividade desenvolvida durantes as aulas de desenvolvimento de sistemas</p>
        </section>

        <!-- ATIVIDADE: DESENVOLVA A ATIVIDADE A PARTIR DAQUI -->
        <section class="conteudo-projeto">
            <form action="/index.php?rota=poo2" method="post" class="card">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" placeholder="Digite o seu nome" required><br><br>

                <label for="tipo">Tipo:</label>
                <select id="tipo" name="tipo" required>
                    <option value="esteira">Esteira</option>
                    <option value="prensa">Prensa</option>
                    <option value="robosoldagem">Robo Soldagem</option>
                </select><br><br>

                <label for="quantidade">Quantidade:</label>
                <input type="number" id="quantidade" name="quantidade" placeholder="Digite a quantidade" required min=0 max=999><br><br>

                <button type="submit" name="acao" value="enviar">Enviar</button>

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