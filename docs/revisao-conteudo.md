# 🎓 Guia Aprofundado — Entendendo PHP de Verdade
> Não só *o que* fazer, mas *por que* cada coisa funciona assim

---

## 🧠 Antes de tudo: Como PHP funciona na prática

Você precisa entender uma coisa fundamental antes de qualquer código:

**PHP roda no SERVIDOR. HTML vai para o NAVEGADOR.**

Quando alguém acessa seu site, acontece isso:

```
Usuário clica em "Enviar" no formulário
        ↓
O navegador manda uma REQUISIÇÃO para o servidor
        ↓
O servidor lê o arquivo .php
        ↓
PHP executa TODO o código <?php ?>
        ↓
PHP gera um HTML puro como resultado
        ↓
Esse HTML puro vai para o navegador
        ↓
O usuário vê a página atualizada
```

**Isso explica por que:**
- Você coloca o PHP no topo: ele precisa processar os dados ANTES de montar o HTML
- `<?= $variavel ?>` funciona dentro do HTML: o PHP substitui isso pelo valor antes de mandar para o navegador
- A página "recarrega" ao submeter um formulário: uma nova requisição começa do zero

---

## 1️⃣ A Sintaxe PHP dentro do HTML — Por que é assim?

### As chaves de abertura e fechamento

```php
<?php
    // Aqui é PHP puro. O servidor entende isso.
    $nome = "Leonardo";
?>

<!-- Aqui é HTML puro. O navegador entende isso. -->
<p>Olá!</p>

<?php
    // Posso abrir PHP de novo a qualquer momento
    echo "Mundo!";
?>
```

**Por que tem `<?php` e `?>`?**
Pensa assim: o arquivo `.php` é como uma mistura de dois idiomas. O PHP precisa de "marcadores" para saber quando está falando PHP e quando está falando HTML. O `<?php` diz "começa PHP aqui" e o `?>` diz "acabou o PHP, volta pro HTML".

### O atalho `<?= ?>`

```php
<!-- Forma longa: -->
<?php echo $nome; ?>

<!-- Forma curta (atalho): -->
<?= $nome ?>
```

**Por que existe `<?=`?**
É simplesmente um atalho para `<?php echo`. O `echo` é o comando que "imprime" (coloca) algo no HTML. Como você usa muito isso, o PHP criou uma versão mais curta. Os dois fazem exatamente a mesma coisa.

### Como misturar PHP com HTML de forma inteligente

**Problema:** Você quer mostrar uma `<div>` só se o usuário já enviou o formulário. Como fazer?

**Solução — "abrir e fechar" o PHP em volta do HTML:**

```php
<?php if ($resultado != "") { ?>

    <div>
        <p>O resultado é: <?= $resultado ?></p>
    </div>

<?php } ?>
```

**Por que funciona?** Porque o PHP não se importa que você abriu e fechou várias vezes. Ele lembra do contexto. O `if` que foi aberto no primeiro bloco `<?php` ainda está "aberto" quando você fecha o `?>` e escreve HTML. Quando você abre `<?php` de novo para o `}`, ele fecha o `if`.

Visualizando como o PHP "vê" o código acima:
```php
if ($resultado != "") {
    // [AQUI ELE IMPRIME O HTML QUE ESTAVA NO MEIO]
    echo '<div><p>O resultado é: ' . $resultado . '</p></div>';
}
```

---

## 2️⃣ Formulários e `$_POST` / `$_GET` — Por que existe essa distinção?

### O que é um formulário HTTP?

Quando você clica em "Enviar", o navegador manda os dados do formulário para o servidor. Mas ele pode mandar de dois jeitos:

| Método | Como manda | Onde aparece | Usado para |
|---|---|---|---|
| `GET` | Na URL: `?nome=Leo&idade=19` | Visível na barra de endereço | Buscas, filtros, navegação |
| `POST` | No "corpo" da requisição | Invisível na URL | Cadastros, logins, deletar dados |

**Por que usar POST para formulários de cadastro?**
- Os dados não aparecem na URL (mais seguro para senhas)
- Pode enviar muito mais dados
- Não fica salvo no histórico do navegador

### Como o PHP captura os dados

```html
<!-- HTML: o form define o método e os campos têm "name" -->
<form action="/index.php?rota=idade" method="POST">
    <input type="text" name="nome">
    <input type="number" name="idade">
    <button type="submit">Enviar</button>
</form>
```

```php
<?php
// PHP: $_POST é um array que contém tudo que veio do formulário
// A chave é o "name" do input
$nome  = $_POST["nome"];   // pega o input com name="nome"
$idade = $_POST["idade"];  // pega o input com name="idade"
?>
```

**Por que o `name` do input é tão importante?**
É a chave que o PHP usa para encontrar o valor. Se você escrever `name="usuario"` no HTML, o PHP vai buscar `$_POST["usuario"]`. Se o nome não bater, o PHP não encontra.

### Verificando SE o formulário foi enviado

```php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Só entra aqui SE o usuário clicou em "Enviar"
    $nome = $_POST["nome"];
}
```

**Por que esse `if` é necessário?**
Quando alguém acessa a página pela primeira vez (só navegando), ela carrega via `GET` (sem dados). Se você tentasse pegar `$_POST["nome"]` sem esse `if`, daria erro porque o formulário ainda não foi enviado. Esse `if` protege o código para ele só rodar quando houver dados para processar.

### O operador `??` — Coalescência Nula

```php
$rota = $_GET['rota'] ?? 'portfolio';
```

**Tradução em português:** "Tente pegar `$_GET['rota']`. Se não existir (ou for null), use `'portfolio'` no lugar."

**Por que usar?** Para evitar erros quando um valor pode não existir. É mais limpo que:
```php
// Versão sem ??  — mais verbosa
if (isset($_GET['rota'])) {
    $rota = $_GET['rota'];
} else {
    $rota = 'portfolio';
}
```

---

## 3️⃣ O Sistema de Rotas — Por que existe e como funciona

### O problema que ele resolve

Sem um sistema de rotas, cada página seria um arquivo `.php` separado. O usuário acessaria `/projetos/idade.php`, `/projetos/notas.php` etc. Isso é bagunçado e difícil de controlar.

**A solução do seu projeto:** Tudo passa por um único arquivo, o `index.php`. Ele decide para onde ir com base na URL.

### Visualizando o fluxo completo

```
Usuário acessa: /index.php?rota=helpdesk  (método POST)
                          ↑
                    parâmetro GET

index.php:
├── Lê o arquivo routes/web.php e guarda o mapa de rotas em $rotas
├── Pega a rota da URL: $rota = $_GET['rota'] → "helpdesk"
├── Pega o método: $metodo = $_SERVER['REQUEST_METHOD'] → "POST"
├── Verifica se existe: $rotas["POST"]["helpdesk"] → ✅ existe!
├── Extrai: $controller = HelpdeskController, $acao = "index"
└── Executa: $controller->index()
                   ↓
        HelpdeskController::index()
        ├── Cria um objeto Chamado: $model = new Chamado()
        ├── Busca os dados: $chamados = $model->lerChamados()
        └── Carrega a view: require ".../helpdesk.php"
                               ↓
                        helpdesk.php (HTML + PHP)
                        Usa $chamados, $relatorio, $mensagem
                        que vieram do Controller
```

### Por que `[$controller, $acao] = $rotas[$metodo][$rota]`?

```php
// O que está dentro de $rotas["GET"]["helpdesk"]:
[new HelpdeskController(), 'index']
//  ↑ objeto do controller    ↑ nome do método

// Isso é um array com 2 posições:
// posição 0 = o objeto controller
// posição 1 = o nome do método

// Desestruturação — pega as duas posições de uma vez:
[$controller, $acao] = $rotas[$metodo][$rota];
// $controller = new HelpdeskController()
// $acao = 'index'

// Chama o método dinamicamente:
$controller->$acao();
// É igual a: $controller->index()
```

### O `require` vs `require_once` — Por que dois?

```php
require     "arquivo.php";  // Inclui o arquivo. Se falhar, para tudo.
require_once "arquivo.php"; // Inclui apenas UMA vez (ignora se já foi incluído antes)
```

**Por que `require_once` para classes?**
Se você incluir uma classe duas vezes, o PHP reclama que ela já foi definida. O `require_once` evita isso automaticamente.

---

## 4️⃣ JSON em PHP — A Lógica de "Banco de Dados em Arquivo"

### O que é JSON?

JSON é um formato de texto para guardar dados estruturados. Parece com um array PHP, mas é texto puro:

```json
[
    { "nome": "Leonardo", "idade": 19, "curso": "DS" },
    { "nome": "Alice",    "idade": 20, "curso": "RDS" }
]
```

**Por que usar JSON em vez de banco de dados?**
Para projetos simples, é mais rápido de implementar. Não precisa de MySQL instalado. O arquivo `.json` fica na pasta do projeto.

### O ciclo completo de vida do JSON

```
Arquivo dados.json (texto no disco)
         ↓ file_get_contents()   ← LÊ o arquivo, retorna uma STRING
String JSON: '[{"nome":"Leo"}]'
         ↓ json_decode($json, true)   ← CONVERTE string → array PHP
Array PHP: [ ["nome" => "Leo"] ]
         ↓ (você modifica o array aqui: adiciona, edita, deleta)
Array PHP modificado
         ↓ json_encode($array, flags)   ← CONVERTE array PHP → string
String JSON atualizada
         ↓ file_put_contents($caminho, $string)   ← GRAVA no arquivo
Arquivo dados.json atualizado ✅
```

### Entendendo cada função

```php
// 1. file_get_contents — lê o arquivo inteiro como texto
$json = file_get_contents("dados.json");
// $json agora é uma string: '[{"nome":"Leo","idade":19}]'

// 2. json_decode — converte texto JSON em estrutura PHP
$alunos = json_decode($json, true);
//                          ↑
//               O "true" é OBRIGATÓRIO para virar array associativo
//               Sem ele, vira um "objeto StdClass" que é mais difícil de usar
// $alunos agora é: [ ["nome"=>"Leo", "idade"=>19] ]

// 3. Você modifica o array normalmente
$novoAluno = ["nome" => "Bia", "idade" => 18];
$alunos[] = $novoAluno;  // [] sem índice = adiciona no final

// 4. json_encode — converte array PHP de volta para texto JSON
$jsonAtualizado = json_encode($alunos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
//                                     ↑ indenta bem     ↑ não bagunça acentos (ç, ã, é)

// 5. file_put_contents — grava o texto no arquivo
file_put_contents("dados.json", $jsonAtualizado);
```

### CREATE — Cadastrar (do json.php)

```php
if ($acao === "cadastrar") {
    // Cria o novo item como array associativo
    $novoAluno = [
        "nome"  => $_POST["nome"],
        "idade" => $_POST["idade"],
        "curso" => $_POST["curso"]
    ];

    // Adiciona ao array existente ([] sem índice = push no final)
    $alunos[] = $novoAluno;

    // Salva de volta no arquivo
    file_put_contents($caminho, json_encode($alunos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}
```

### UPDATE — Atualizar (do json.php)

```php
if ($acao === "atualizar") {
    $nome     = $_POST["nome"];
    $novaIdade = $_POST["idade"];

    // Percorre CADA aluno com sua posição no array
    foreach ($alunos as $posicao => $aluno) {
        if ($aluno["nome"] == $nome) {
            // Atualiza usando a POSIÇÃO (não o $aluno, que é uma cópia)
            $alunos[$posicao]["idade"] = $novaIdade;
        }
    }

    file_put_contents($caminho, json_encode($alunos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}
```

> **Por que `$alunos[$posicao]["idade"]` e não `$aluno["idade"]`?**
> O `$aluno` dentro do `foreach` é uma **cópia** do elemento. Modificar a cópia não muda o array original. Você precisa usar `$alunos[$posicao]` para acessar o item original pelo índice.

### DELETE — Deletar (do Chamado.php)

```php
// 1. Verifica se a posição existe antes de tentar deletar
if (!isset($chamados[$posicao])) {
    return false;  // Posição inválida, aborta
}

// 2. Remove o item naquela posição
unset($chamados[$posicao]);

// 3. OBRIGATÓRIO: reindexa o array
// Sem isso, o array ficaria com "buracos": [0, 1, 3, 4] (o 2 sumiu)
// Com array_values: [0, 1, 2, 3] (renumerado do zero)
$chamados = array_values($chamados);

// 4. Salva
$this->salvarChamados($chamados);
```

### Como o input hidden passa a posição para o formulário

```html
<!-- No HTML, dentro do foreach ($chamados as $id => $chamado) -->
<form method="POST">
    <!-- Campo invisível que guarda qual item estamos mexendo -->
    <input type="hidden" name="posicao" value="<?php echo $id; ?>">

    <button type="submit" name="acao" value="excluir-chamado">Excluir</button>
</form>
```

```php
// No PHP, ao receber o POST:
$posicao = (int) ($_POST["posicao"] ?? -1);
// (int) converte para número inteiro
// ?? -1 garante que se não vier, usa -1 (que nunca existe no array)
```

**Por que `input hidden`?** Porque você precisa dizer ao PHP qual chamado deletar. O `hidden` envia o índice junto com o formulário sem mostrar para o usuário.

---

## 5️⃣ POO (Programação Orientada a Objetos) — A Lógica por Trás

### Por que POO existe?

Sem POO, se você tivesse 3 personagens:
```php
$nome1 = "Leo"; $vida1 = 100; $dano1 = 10;
$nome2 = "Alice"; $vida2 = 50; $dano2 = 5;
// Para 100 personagens... impossível de gerenciar
```

Com POO, você cria um "molde" (classe) e faz quantas cópias quiser (objetos):
```php
$p1 = new Personagem("Leo", 100, 10);
$p2 = new Personagem("Alice", 50, 5);
// Para 100 personagens: basta criar 100 objetos com new
```

### Anatomia de uma Classe

```php
class NomeDaClasse {
//    ↑ palavra reservada  ↑ nome com inicial maiúscula (convenção)

    // ATRIBUTOS — as "características" do objeto
    public $nome;      // público: qualquer um pode acessar
    private $vida;     // privado: só a própria classe pode acessar

    // CONSTRUTOR — executado automaticamente ao fazer "new"
    public function __construct($nome, $vida) {
        // $this->  refere-se ao OBJETO ATUAL que está sendo criado
        $this->nome = $nome;   // Salva o parâmetro no atributo do objeto
        $this->vida = $vida;
    }

    // MÉTODO — uma "ação" que o objeto pode fazer
    public function atacar() {
        echo "$this->nome atacou!";
        // $this->nome pega o nome DESTE objeto específico
    }
}
```

**Por que `$this->`?**
Dentro de uma classe, você tem vários objetos que usam o mesmo código. O `$this` é como dizer "eu mesmo" — se é o objeto `$guerreiro` rodando o método, `$this->nome` é o nome do guerreiro. Se é o `$mago`, é o nome do mago.

### Criando e usando objetos

```php
// "new" chama o __construct e cria o objeto
$guerreiro = new Guerreiro("Leonardo", 100, 10);
//                           ↑nome        ↑vida ↑dano  → vai para __construct($nome, $vida, $dano)

// Acessar atributo público:
echo $guerreiro->nome;     // "Leonardo"

// Chamar método:
$guerreiro->atacar();      // "Leonardo atacou com uma espada!"

// Acessar atributo PRIVADO — só via getter:
echo $guerreiro->getVida();  // 100
// echo $guerreiro->vida;    // ❌ ERRO! vida é private
```

### Encapsulamento — Por que `private` + getter/setter?

```php
private $vida;

// GETTER: só lê, não modifica
public function getVida() {
    return $this->vida;
}

// SETTER: modifica COM validação
public function setVida($vida) {
    if ($vida < 0) {           // Garante que vida nunca seja negativa
        echo "Valor inválido";
        return;
    }
    $this->vida = $vida;
}
```

**Por que não deixar `public $vida` direto?**
Se `$vida` fosse público, qualquer código poderia fazer:
```php
$guerreiro->vida = -999;  // Vida negativa? Não faz sentido!
```
Com `private` + setter, você coloca uma "portaria" que valida antes de deixar entrar.

### Herança — `extends`

```php
// Classe PAI (base):
abstract class Personagem {
    public $nome;
    private $vida;
    // ... __construct, getVida, setVida, atacar() abstrato
}

// Classe FILHA herda TUDO da pai:
class Guerreiro extends Personagem {
    // Já tem: $nome, getVida(), setVida(), __construct()
    // Só precisa implementar o que é próprio dela:

    public function atacar() {         // Implementa o método abstrato
        echo "$this->nome atacou com uma espada!";
    }

    public function defender() {        // Método EXTRA, só do Guerreiro
        echo "$this->nome levantou o escudo!";
    }
}
```

**Por que herança?** Evita repetição de código. `Guerreiro`, `Mago` e `Curandeiro` todos têm nome, vida, dano e um construtor. Em vez de escrever isso 3 vezes, você escreve uma vez em `Personagem` e os filhos herdam.

### Abstração — `abstract`

```php
// "abstract class" = classe que NÃO pode ser instanciada diretamente
abstract class Personagem {

    // "abstract function" = método que NÃO tem implementação aqui
    // mas TODA classe filha É OBRIGADA a implementar
    abstract public function atacar();
}
```

**Por que `abstract`?**
Porque `Personagem` genérico não sabe como atacar — cada tipo ataca diferente. Mas você quer GARANTIR que todo personagem vai ter um `atacar()`. O `abstract` serve como um contrato: "qualquer coisa que herdar de mim PRECISA ter esse método".

```php
// ❌ Erro! Não pode instanciar classe abstrata
$p = new Personagem("Leo", 100, 10);

// ✅ Certo! Instancia a classe filha
$p = new Guerreiro("Leo", 100, 10);
```

### Polimorfismo — Mesmo método, comportamentos diferentes

```php
$guerreiro  = new Guerreiro("Leo", 100, 10);
$mago       = new Mago("Alice", 50, 5);
$curandeiro = new Curandeiro("Sabrina", 30, 3);

$personagens = [$guerreiro, $mago, $curandeiro];

// O foreach chama atacar() em cada um — mas cada um faz diferente!
foreach ($personagens as $p) {
    $p->atacar();
}
// "Leo atacou com uma espada!"
// "Alice lançou uma bola de fogo!"
// "Sabrina atacou com uma faca!"
```

**Por que isso é poderoso?** Você pode adicionar um `Arqueiro` depois, e o `foreach` funciona sem mudar nenhuma linha — só cria a nova classe com seu próprio `atacar()`.

---

## 6️⃣ A Classe `Chamado` — Como o Model funciona na prática

Esta é a classe mais completa do projeto e reúne JSON + POO + MVC:

```php
class Chamado {

    // Método privado: só usado internamente pela classe
    public function lerChamados() {
        $arquivo = __DIR__ . "/chamados.json";
        //          ↑ __DIR__ = caminho da pasta onde ESTE arquivo está

        // Cria o arquivo vazio se não existir ainda
        if (!file_exists($arquivo)) {
            file_put_contents($arquivo, "[]");
        }

        $conteudo = file_get_contents($arquivo);
        $chamados  = json_decode($conteudo, true);

        // is_array garante que retorna array mesmo se o JSON estiver corrompido
        return is_array($chamados) ? $chamados : [];
    }

    public function salvarChamados($chamados) {
        $arquivo = __DIR__ . "/chamados.json";
        return file_put_contents(
            $arquivo,
            json_encode($chamados, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
        ) !== false;  // retorna true se salvou, false se falhou
    }

    public function cadastrarChamados($nome, $setor, $equipamento, $descricao, $prioridade) {
        // Validação: nome e descrição não podem ser vazios
        if (trim($nome) === "" || trim($descricao) === "") {
            return false;
        }

        $chamados = $this->lerChamados();  // Lê os existentes

        $novoChamado = [
            "nome"        => trim($nome),
            "setor"       => $setor,
            "equipamento" => $equipamento,
            "descricao"   => trim($descricao),
            "prioridade"  => $prioridade,
            "status"      => "Aberto"      // sempre começa como Aberto
        ];

        $chamados[] = $novoChamado;        // Adiciona ao array

        return $this->salvarChamados($chamados);  // Salva e retorna true/false
    }

    public function atualizarChamado($posicao, $novoStatus) {
        $chamados = $this->lerChamados();

        $statusPermitidos = ["Aberto", "Em andamento", "Resolvido"];

        // isset verifica se a posição existe no array
        if (!isset($chamados[$posicao])) return false;

        // in_array verifica se o status é um dos permitidos
        if (!in_array($novoStatus, $statusPermitidos, true)) return false;

        $chamados[$posicao]["status"] = $novoStatus;

        return $this->salvarChamados($chamados);
    }

    public function excluirChamado($posicao) {
        $chamados = $this->lerChamados();

        if (!isset($chamados[$posicao])) return false;

        unset($chamados[$posicao]);
        $chamados = array_values($chamados);  // Reindexa

        return $this->salvarChamados($chamados);
    }

    public function gerarRelatorio() {
        $chamados = $this->lerChamados();

        $relatorio = ["total" => count($chamados), "abertos" => 0, "andamento" => 0, "resolvidos" => 0];

        foreach ($chamados as $chamado) {
            if ($chamado["status"] === "Aberto")        $relatorio["abertos"]++;
            elseif ($chamado["status"] === "Em andamento") $relatorio["andamento"]++;
            elseif ($chamado["status"] === "Resolvido")    $relatorio["resolvidos"]++;
        }

        return $relatorio;
    }
}
```

---

## 7️⃣ PDO e MySQL — Banco de Dados Real (jogos.php)

```php
// Conexão: cria um objeto PDO
$pdo = new PDO("mysql:host=localhost;dbname=leonardo315;charset=utf8mb4", $usuario, $senha);
//              ↑ driver:configurações                                      ↑ usuário  ↑ senha
```

**`exec()` vs `query()` — Por que dois métodos?**

```php
// exec() — execute e não me dê nada de volta
// Usado para: INSERT, DELETE, UPDATE, CREATE TABLE
$pdo->exec("INSERT INTO lista_jogos (nome, genero) VALUES ('$nome', '$genero')");

// query() — execute E me retorne os dados
// Usado para: SELECT
$stmt  = $pdo->query("SELECT * FROM lista_jogos");
$jogos = $stmt->fetchAll(PDO::FETCH_ASSOC);
//                        ↑ retorna como array associativo (["nome"=>"FF7"])
//                          em vez de array numérico ([0=>"FF7"])
```

---

## 8️⃣ Guia de Sobrevivência para a Prova — Como criar do zero

### 🔴 Se pedir algo estilo `poo2.php` (POO com formulário)

**Passo 1 — Criar as classes no topo do arquivo:**
```php
<?php
// 1. Classe abstrata base
abstract class NomeDaBase {
    public $nome;
    private $valor;

    public function __construct($nome) {
        $this->nome  = $nome;
        $this->valor = 0;
    }

    public function getValor()          { return $this->valor; }
    public function registrar($qtd)     { $this->valor += $qtd; }

    abstract public function operar();  // Cada filho implementa diferente
}

// 2. Classes filhas (herança)
class TipoA extends NomeDaBase {
    public function operar() { return "Fazendo coisa A..."; }
}
class TipoB extends NomeDaBase {
    public function operar() { return "Fazendo coisa B..."; }
}

// 3. Processar o formulário
$mensagem = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST["nome"] ?? "";
    $tipo = $_POST["tipo"] ?? "";
    $qtd  = $_POST["quantidade"] ?? 0;

    if ($nome === "" || $qtd <= 0) {
        $mensagem = "Preencha corretamente!";
    } else {
        // Instanciar a classe certa com base no tipo selecionado
        if ($tipo === "tipoA")      $objeto = new TipoA($nome);
        elseif ($tipo === "tipoB")  $objeto = new TipoB($nome);

        $objeto->registrar($qtd);
        $mensagem = "Cadastrado com sucesso!";
    }
}
?>
```

**Passo 2 — HTML com formulário e exibição:**
```html
<!DOCTYPE html>
<html lang="pt-br">
<head><meta charset="UTF-8"><title>Meu Sistema POO</title></head>
<body>

<form action="/index.php?rota=poo2" method="POST">
    <label>Nome:</label>
    <input type="text" name="nome" required><br>

    <label>Tipo:</label>
    <select name="tipo" required>
        <option value="tipoA">Tipo A</option>
        <option value="tipoB">Tipo B</option>
    </select><br>

    <label>Quantidade:</label>
    <input type="number" name="quantidade" min="1" required><br>

    <button type="submit">Cadastrar</button>
</form>

<!-- Exibir resultado só se houver mensagem -->
<?php if ($mensagem != "") { ?>
    <p><?= $mensagem ?></p>
    <?php if (isset($objeto)) { ?>
        <p>Nome: <?= $objeto->nome ?></p>
        <p>Valor: <?= $objeto->getValor() ?></p>
        <p>Operação: <?= $objeto->operar() ?></p>
    <?php } ?>
<?php } ?>

</body>
</html>
```

---

### 🔴 Se pedir algo estilo Helpdesk (CRUD com JSON)

**Estrutura completa em um só arquivo:**

```php
<?php
// CAMINHO DO ARQUIVO JSON
$caminho = __DIR__ . "/dados.json";

// CARREGAR DADOS EXISTENTES
if (!file_exists($caminho)) file_put_contents($caminho, "[]");
$dados = json_decode(file_get_contents($caminho), true) ?: [];

$mensagem = "";

// PROCESSAR FORMULÁRIO
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $acao = $_POST["acao"] ?? "";

    // CREATE
    if ($acao === "cadastrar") {
        $novo = [
            "nome"  => trim($_POST["nome"] ?? ""),
            "campo" => trim($_POST["campo"] ?? ""),
            "status" => "Ativo"
        ];
        if ($novo["nome"] !== "") {
            $dados[] = $novo;
            file_put_contents($caminho, json_encode($dados, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            $mensagem = "Cadastrado com sucesso!";
        }
    }

    // UPDATE
    elseif ($acao === "atualizar") {
        $pos = (int)($_POST["posicao"] ?? -1);
        if (isset($dados[$pos])) {
            $dados[$pos]["status"] = $_POST["status"] ?? $dados[$pos]["status"];
            file_put_contents($caminho, json_encode($dados, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            $mensagem = "Atualizado!";
        }
    }

    // DELETE
    elseif ($acao === "excluir") {
        $pos = (int)($_POST["posicao"] ?? -1);
        if (isset($dados[$pos])) {
            unset($dados[$pos]);
            $dados = array_values($dados);  // Reindexa!
            file_put_contents($caminho, json_encode($dados, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            $mensagem = "Excluído!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head><meta charset="UTF-8"><title>Sistema CRUD</title></head>
<body>

<!-- FORMULÁRIO DE CADASTRO -->
<h2>Cadastrar</h2>
<form method="POST">
    <input type="text" name="nome" placeholder="Nome" required>
    <input type="text" name="campo" placeholder="Outro campo">
    <button type="submit" name="acao" value="cadastrar">Cadastrar</button>
</form>

<!-- MENSAGEM DE RETORNO -->
<?php if ($mensagem != "") { ?>
    <p><?= $mensagem ?></p>
<?php } ?>

<!-- LISTAGEM -->
<h2>Registros</h2>
<?php foreach ($dados as $id => $item): ?>
    <div>
        <p>#<?= $id ?> — <?= $item["nome"] ?> — <?= $item["status"] ?></p>

        <!-- Atualizar status -->
        <form method="POST">
            <input type="hidden" name="posicao" value="<?= $id ?>">
            <select name="status">
                <option value="Ativo"    <?= $item["status"] === "Ativo"    ? "selected" : "" ?>>Ativo</option>
                <option value="Inativo"  <?= $item["status"] === "Inativo"  ? "selected" : "" ?>>Inativo</option>
            </select>
            <button type="submit" name="acao" value="atualizar">Mudar</button>
        </form>

        <!-- Excluir -->
        <form method="POST">
            <input type="hidden" name="posicao" value="<?= $id ?>">
            <button type="submit" name="acao" value="excluir">Excluir</button>
        </form>
    </div>
<?php endforeach; ?>

</body>
</html>
```

---

### 🔴 Se pedir algo estilo jogos.php (formulário simples + exibição condicional)

```php
<?php
$resultado = "";
$nome = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome  = $_POST["nome"] ?? "";
    $valor = $_POST["valor"] ?? 0;

    // Sua lógica aqui — exemplo simples:
    if ($valor > 100) {
        $resultado = "Alto";
    } else {
        $resultado = "Baixo";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head><meta charset="UTF-8"><title>Sistema</title></head>
<body>

<form method="POST">
    <input type="text" name="nome" placeholder="Nome" required>
    <input type="number" name="valor" placeholder="Valor" required>
    <button type="submit">Enviar</button>
</form>

<?php if ($resultado != "") { ?>
    <p><?= $nome ?> tem resultado: <?= $resultado ?></p>
<?php } ?>

</body>
</html>
```

---

## 9️⃣ Referência Rápida de Sintaxes

### Operadores lógicos

```php
&&   // E  — as duas condições precisam ser verdadeiras
||   // OU — pelo menos uma condição é verdadeira
!    // NÃO — inverte: !true = false
```

### Comparações

```php
==   // igual em valor:        "5" == 5   → true  (converte tipos)
===  // idêntico em valor E tipo: "5" === 5 → false (mais rigoroso, prefira este)
!=   // diferente em valor
!==  // diferente em valor OU tipo
```

### Estruturas de controle

```php
// IF/ELSE
if ($condição) {
    // faz isso
} elseif ($outra) {
    // faz aquilo
} else {
    // faz o padrão
}

// TERNÁRIO — if/else em uma linha
$cor = ($aprovado) ? "green" : "red";
//      ↑ condição    ↑ se true  ↑ se false

// FOREACH — percorre arrays
foreach ($array as $item) { ... }              // só o valor
foreach ($array as $indice => $item) { ... }   // índice + valor

// FOREACH sintaxe alternativa (mesma coisa, visual diferente):
foreach ($array as $id => $item):
    // código
endforeach;
```

### Funções de array úteis

```php
count($array)              // quantos itens tem
isset($array[$pos])        // a posição existe?
in_array($valor, $array)   // o valor existe no array?
unset($array[$pos])        // remove o item
array_values($array)       // reindexa do zero
trim($texto)               // remove espaços das bordas
```

---

## ✅ Checklist Mental para a Prova

**Antes de escrever qualquer código, pergunte:**

1. **O que devo salvar?** → Quais dados virão do formulário?
2. **Preciso de POO?** → Há um "tipo de coisa" com propriedades e ações?
3. **Como guardo os dados?** → JSON (arquivo) ou MySQL (banco)?
4. **Quantas ações o formulário tem?** → Uma? Várias? Use `name="acao"` com `value` diferente para cada botão
5. **O que mostrar ao usuário?** → Use `if ($variavel != "") { ?>...<?php }` para blocos condicionais

**Ordem de escrita recomendada:**
1. Escreva as classes PHP no topo (se usar POO)
2. Processe o formulário: `if ($_SERVER["REQUEST_METHOD"] === "POST")`
3. Busque/carregue os dados atualizados
4. Feche o PHP com `?>`
5. Escreva o HTML com o formulário
6. Use `<?php if ... ?>` para mostrar resultados
7. Use `<?php foreach ... ?>` para listar dados
