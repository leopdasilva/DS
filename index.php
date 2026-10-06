<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HTML & PHP - DS</title>
    <link rel="stylesheet" href="style/index.css">
</head>
<body>
    <header>
        <!-- ==========================  
            MENU DE NAVEGAÇÃO
        ========================== -->
        <nav class="navbar">
            <h2 class="logo">Meu portifólio</h2>

            <ul class="menu">
                <li><a href="#inicio">Inicio</a></li>
                <li><a href="#sobre">Sobre</a></li>
                <li><a href="#habilidades">Habilidades</a></li>
                <li><a href="#projetos">Projetos</a></li>
                <li><a href="#contato">Contato</a></li>
            </ul>
        </nav>

    </header>

    <main>
        <!-- ==========================  
            MENU DE NAVEGAÇÃO
        ========================== -->
        <section id="inicio" class="inicio">
            <div class="incio-conteudo"> 
                <p class="saudacao">Olá! Eu sou </p>

                <h1>Leonardo P. da Silva</h1>

                <h2>Desenvolvedor em formação</h2>

                <p>
                    Estudante de Desenvolvimento de Sistemas,
                    Formado em Gestão de Tecnologia da Informação.
                </p>

                <a href="#projetos" class="botao">
                    Ver meus projetos
                </a>    
            </div>
        </section>

        <!-- ==========================  
            MENU DE NAVEGAÇÃO
        ========================== -->
        <section id="sobre" class="secao">
            <div class="sobre_conteudo">
                <div class="foto">
                    JS
                </div>
                <div class="sobre-texto">
                    <h3>Quem sou eu?</h3>
                    <p>
                        Meu nome é Leonardo P. da Silva e sou estudante
                        de Desenvolvimento de Sistemas.
                    </p>
                    <p>
                        Atualmente estou cursando desenvolvimento em front-end
                        e back-end.
                        Este portifílio reúne alguns dos projetos desenvolvidos
                        durante o curso de Desenvolvimento de Sistemas.
                    </p>
                    <p>
                        Meu objetivo é conitinuar evoluindo como Desenvolvedor, 
                        aprendendo novas tecnologias e se adaptar ao cenário
                        mais recente do mercado.
                    </p>
                </div>
            </div>
        </section>
        <!-- ==========================  
            HABILIDADES
        ========================== -->
        <section id="habilidades" class="secao secao-destaque">
            <h2 class="titulo-secao">Minhas Habilidades</h2>
            <p class="subtitulo-secao">
                Algumas tecnologias que eu estou estudando:
            </p>
            <div class="lista-habilidades">
                <div class="habilidade">
                    HTML
                </div>
                <div class="habilidade">
                    CSS
                </div>
                <div class="habilidade">
                    JS
                </div>
                <div class="habilidade">
                    REACT
                </div>
                <div class="habilidade">
                    PYTHON
                </div>
                <div class="habilidade">
                    LINGUAGEM C
                </div>
                <div class="habilidade">
                    PHP
                </div>
            </div>
        </section>
        <!-- ==========================  
            PROJETOS - CURSO
        ========================== -->
        <section id="projetos-curso" class="secao">
            <h2 class="titulo-secao">Meus projetos</h2>
            <p class="subtitulo-secao">
                Alguns projetso desenvolvidos durante o curso.
            </p>
            <!-- PROJETO 1 -->
            <div class="projeto-card">
                <div class="projeto-numero">
                    01
                </div>
                <h3>Banco de Dados estilo anos 60 (C e Pyhton)</h3>
                <p>
                    Sistema híbrido que recria o conceito de gerenciamento de dados de baixo nível
                    inspirado nos primórdios da computação. O projeto une a alta performance e o 
                    controle de memória da Linguagem C com uma interface gráfica integrada em Python (Tkinter), 
                    simulando a identidade visual clássica dos sistemas legados. 
                </p>
                <div class="tecnologias">
                    <span>Python</span>
                    <span>Linguagem C</span>
                </div>
                <a href="https://github.com/leopdasilva/Banco-de-Dados-anos-60" class="link-projeto">Ver projeto →</a>
            </div>
            <!-- PROJETO 2 -->
            <div class="projeto-card">
                <div class="projeto-numero">
                    02
                </div>
                <h3>Cluster em Banco de Dados - Mongo DB Compass</h3>
                <p>
                    Cluster local de banco de dados NoSQL projetado para simular alta disponibilidade e resiliência em sistemas distribuídos.
                    O projeto utiliza o MongoDB 8.0 estruturado em Replica Set (nós Principal, Reserva e Árbitro), validando o mecanismo de failover 
                    automatizado em tempo real por meio de uma aplicação cliente em Python que intercepta quedas de hardware com zero perda de dados.
                </p>
                <div class="tecnologias">
                    <span>Mongo DB Compass versão 8.0</span>
                </div>
                <a href="https://github.com/leopdasilva/projeto_cluster" class="link-projeto">Ver projeto →</a>
            </div>
            <!-- PROJETO 3 -->
            <div class="projeto-card">
                <div class="projeto-numero">
                    03
                </div>
                <h3>Sensor de velocidade</h3>
                <p>
                    Ecossistema de Internet das Coisas (IoT) voltado para telemetria automotiva e monitoramento de velocidade 
                    em tempo real. O projeto integra um firmware em C/C++ (ESP32-S3) que captura pulsos magnéticos via interrupções de hardware, 
                    uma API em Node.js (Express) com MySQL para a ingestão e persistência dos dados de rede, e um dashboard web responsivo que 
                    atualiza dinamicamente indicadores digitais por meio de consumo assíncrono.
                </p>
                <div class="tecnologias">
                    <span>ESP32</span>
                    <span>Front-End (HTML, CSS, JavaScript)</span>
                    <span>Backe-end: Node.js, Express, REST API (JSON / HTTP)</span>
                </div>
                <a href="https://github.com/leopdasilva/Sensor_Velocidade#sistema-inteligente-de-velocidade" class="link-projeto">Ver projeto →</a>
            </div>
        </section>
        <!-- ==========================  
            PROJETOS - PHP
        ========================== -->
        <section id="projetos-php" class="secao">
            <h2 class="titulo-secao">Meus projetos</h2>
            <p class="subtitulo-secao">
                Alguns projetso desenvolvidos durante as aulas de PHP.
            </p>
            <!-- PROJETO 1 -->
            <div class="projeto-card">
                <div class="projeto-numero">
                    01
                </div>
                <h3>Vereficar idade em PHP</h3>
                <p>
                    Aplicação web responsiva desenvolvida em PHP estruturado e HTML5 para 
                    validação dinâmica de dados e controle de fluxo. O projeto processa 
                    requisições de formulários via método POST de forma nativa, realizando a 
                    captura, tratamento de variáveis e renderização condicional na 
                    mesma interface para determinar a maioridade do usuário com base nas 
                    regras de negócio implementadas.
                </p>
                <div class="tecnologias">
                    <span>HTML</span>
                    <span>CSS</span>
                    <span>PHP</span>
                </div>
                <a href="projetos/idade.php" class="link-projeto">Ver projeto →</a>
            </div>
            <!-- PROJETO 2 -->
            <div class="projeto-card">
                <div class="projeto-numero">
                    02
                </div>
                <h3>Vereficar notas em PHP</h3>
                <p>
                    Sistema de gestão acadêmica em PHP nativo e HTML5 que processa e 
                    valida o desempenho de estudantes via formulário POST. A aplicação calcula médias 
                    ponderadas complexas cruzando notas e frequência, aplicando uma lógica de negócio 
                    backend para determinar o status escolar e renderizar o resultado de forma condicional 
                    e reativa na interface.
                </p>
                <div class="tecnologias">
                    <span>HTML</span>
                    <span>CSS</span>
                    <span>PHP</span>
                </div>
                <a href="projetos/notas.php" class="link-projeto">Ver projeto →</a>
            </div>
            <!-- PROJETO 3 -->
            <div class="projeto-card">
                <div class="projeto-numero">
                    03
                </div>
                <h3>Login básico em PHP</h3>
                <p>
                    Mecanismo básico de autenticação desenvolvido em PHP nativo e HTML5 
                    para simular o fluxo de login de um usuário. O script processa credenciais 
                    estáticas de forma síncrona via requisições POST, validando os dados no backend 
                    para exibir mensagens de feedback dinâmicas na interface e incluindo um helper 
                    em JavaScript para exibição de credenciais de teste.
                </p>
                <div class="tecnologias">
                    <span>HTML</span>
                    <span>CSS</span>
                    <span>PHP</span>
                    <span>JavaScript</span>
                </div>
                <a href="projetos/login-basico.php" class="link-projeto">Ver projeto →</a>
            </div>
            <!-- PROJETO 4 -->
            <div class="projeto-card">
                <div class="projeto-numero">
                    04
                </div>
                <h3>Cadastro de jogos em PHP</h3>
                <p>
                    Aplicação CRUD em PHP nativo utilizando a extensão PDO para integração, persistência e leitura de 
                    dados em um banco de dados MySQL. O projeto realiza a criação automatizada de tabelas estruturais 
                    (Data Definition Language), gerencia o fluxo de cadastro seguro via autenticação por token estático 
                    no backend e consome dados do servidor de forma síncrona para renderizar listagens dinâmicas em 
                    tabelas HTML.
                </p>
                <div class="tecnologias">
                    <span>HTML</span>
                    <span>CSS</span>
                    <span>PHP</span>
                </div>
                <a href="projetos/jogos.php" class="link-projeto">Ver projeto →</a>
            </div>
        </section>
         <!-- ==========================  
            CONTATO
        ========================== -->
        <section id="contato" class="secao secao-destaque">
            <h2 class="titulo-secao">Contato</h2>
            <p class="subtitulo-secao">
                Quer entrar em contato comigo?
            </p>
            <div class="contato-container">
                <div class="contato-item">
                    <h3>Whatsapp</h3>
                    <p>+55 (41) xxxxx-xxxx</p>
                </div>
                <div class="contato-item">
                    <h3>GitHub</h3>
                    <a href="https://github.com/leopdasilva">github.com/leopdasilva</a>
                </div>
                <div class="contato-item">
                    <h3>LinkedIn</h3>
                    <a href=""></a>
                </div>
            </div>
        </section>
        <footer>
            <p>
                Desenvolvido por <a href="https://leonardo315.devlook.xyz">Leonardo P. da Silva </a> • 2026
            </p>
        </footer>

    </main>
</body>
</html>