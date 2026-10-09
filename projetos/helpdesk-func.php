<?php

// Caminho do arquivo onde os chamados serão salvos
define('caminho_json', __DIR__ . "/chamados.json");

// Lê o arquivo JSON e o transforma em array PHP
function lerChamados() {
    if (!file_exists(caminho_json)) {
        file_put_contents(caminho_json, json_encode([]));
        return [];
    }
    $json = file_get_contents(caminho_json);
    return json_decode($json, true) ?? [];
}

// Pega o arrya do PHP, transforma em JSON e salva no arquivo
function salvarChamados($chamados) {
    $json = json_encode($chamados, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    return file_put_contents(caminho_json, $json);
}

// Cria um novo chamado com status "Aberto" e adiciona ma lista
function cadastrarChamado($nome, $setor, $equipamento, $descricao, $prioridade) {
    if (empty(trim($nome)) || empty(trim($descricao))) {
        return "Erro: O nome do solicitante e a descrição são obrigatórios.";
    }

    $chamados = lerChamados();
    $novoChamado = [
        "nome"        => strip_tags(trim($nome)),
        "setor"       => $setor,
        "equipamento" => $equipamento,
        "descricao"   => strip_tags(trim($descricao)),
        "prioridade"  => $prioridade,
        "status"      => "Aberto" 
    ];

    $chamados[] = $novoChamado;
    
    if (salvarChamados($chamados)) {
        return "Chamado registrado com sucesso!";
    }
    return "Erro ao salvar o chamado no sistema.";
}

// Procura o chamado pelo ID e muda o status dele (Aberto, Em andamenro ou Resolvido)
function atualizarStatusChamado($id, $novoStatus) {
    $statusPermitidos = ["Aberto", "Em andamento", "Resolvido"];
    
    if (!in_array($novoStatus, $statusPermitidos)) {
        return "Erro: Status inválido enviado.";
    }

    $chamados = lerChamados();

    if (!isset($chamados[$id])) {
        return "Erro: Chamado inexistente.";
    }

    $chamados[$id]["status"] = $novoStatus;

    if (salvarChamados($chamados)) {
        return "Status do chamado #$id updated!";
    }
    return "Erro ao atualizar o status.";
}

// Apaga um chamado pelo ID e reorganiza a lista
function excluirChamado($id) {
    $chamados = lerChamados();

    if (!isset($chamados[$id])) {
        return "Erro: Chamado inexistente.";
    }

    unset($chamados[$id]);
    
    $chamados = array_values($chamados);

    if (salvarChamados($chamados)) {
        return "Chamado excluído com sucesso!";
    }
    return "Erro ao excluir o chamado.";
}


// Conta a quatidade de chamados e quantos existem em cada status
function gerarRelatorioChamados() {
    $chamados = lerChamados();
    
    $relatorio = [
        "total"        => count($chamados),
        "abertos"      => 0,
        "em_andamento" => 0,
        "resolvidos"   => 0
    ];

    foreach ($chamados as $chamado) {
        if ($chamado["status"] === "Aberto") {
            $relatorio["abertos"]++;
        } elseif ($chamado["status"] === "Em andamento") {
            $relatorio["em_andamento"]++;
        } elseif ($chamado["status"] === "Resolvido") {
            $relatorio["resolvidos"]++;
        }
    }

    return $relatorio;
}
?>
