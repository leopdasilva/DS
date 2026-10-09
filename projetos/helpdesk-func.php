<?php

// Caminho do arquivo onde os chamados serão salvos
define('caminho_json', __DIR__ . "/chamados.json");

// Lê o arquivo JSON e o transforma em array PHP
function lerChamados() {
    return file_exists(caminho_json) ? (json_decode(file_get_contents(caminho_json), true) ?? []) : [];
}

// Pega o array do PHP, transforma em JSON e salva no arquivo
function salvarChamados($chamados) {
    return file_put_contents(caminho_json, json_encode($chamados, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

// Cria um novo chamado com status "Aberto" e adiciona na lista
function cadastrarChamado($nome, $setor, $equipamento, $descricao, $prioridade) {
    if (empty(trim($nome)) || empty(trim($descricao))) {
        return "Erro: O nome do solicitante e a descrição são obrigatórios.";
    }

    $chamados = lerChamados();
    
    // Limpa todas as strings recebidas de uma só vez
    $dados = array_map(fn($v) => strip_tags(trim($v)), compact('nome', 'setor', 'equipamento', 'descricao', 'prioridade'));
    $dados['status'] = "Aberto";

    $chamados[] = $dados;
    return salvarChamados($chamados) ? "Chamado registrado com sucesso!" : "Erro ao salvar o chamado no sistema.";
}

// Procura o chamado pelo ID e muda o status dele
function atualizarStatusChamado($id, $novoStatus) {
    $chamados = lerChamados();

    if (!in_array($novoStatus, ["Aberto", "Em andamento", "Resolvido"])) return "Erro: Status inválido enviado.";
    if (!isset($chamados[$id])) return "Erro: Chamado inexistente.";

    $chamados[$id]["status"] = $novoStatus;
    return salvarChamados($chamados) ? "Status do chamado #$id atualizado!" : "Erro ao atualizar o status.";
}

// Apaga um chamado pelo ID e reorganiza a lista
function excluirChamado($id) {
    $chamados = lerChamados();

    if (!isset($chamados[$id])) return "Erro: Chamado inexistente.";

    unset($chamados[$id]);
    return salvarChamados(array_values($chamados)) ? "Chamado excluído com sucesso!" : "Erro ao excluir o chamado.";
}

// Conta a quantidade de chamados e quantos existem em cada status
function gerarRelatorioChamados() {
    $chamados = lerChamados();
    
    // Extrai apenas a coluna de status e conta as repetições automaticamente
    $contagem = array_count_values(array_column($chamados, 'status'));

    return [
        "total"        => count($chamados),
        "abertos"      => $contagem["Aberto"] ?? 0,
        "em_andamento" => $contagem["Em andamento"] ?? 0,
        "resolvidos"   => $contagem["Resolvido"] ?? 0
    ];
}
