<?php

//Dados para conexão MySQL
$host = "localhost";
$banco = "leonardo315";
$usuario = "leonardo315";
$senha = "315!@#";

// PDO = PHP Data Objects - É uma ferramenta do PHP para conversar com banco de dados.

try {
    $pdo = new PDO("mysql:host=$host;dbname=$banco;charset=utf8mb4", $usuario, $senha);

    // "->" Serve para puxar algo pertende aquele objeto
    //PDO::ATTR_ERRMODE - É para configurar o modo de erros do PDO
    //PDO::ERRMODE_EXCEPTION - É para quando acontecer algum erro, transformar em execução
    $pdo -> setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION 
    );

    echo "Conetado com sucesso!";

} catch (PDOException $erro) {

    echo "Eroo ao conectar: ".$erro->getMessage();

}