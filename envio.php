<?php

function validarCPF($cpf) {
    // Remove caracteres não numéricos
    $cpf = preg_replace('/[^0-9]/', '', $cpf);
    if (strlen($cpf) != 11 || preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }

    // Valida primeiro dígito
    for ($t = 9; $t < 11; $t++) {
        $soma = 0;
        for ($i = 0; $i < $t; $i++) {
            $soma += $cpf[$i] * (($t + 1) - $i);
        }
        $resto = (10 * $soma) % 11;
        if ($resto == 10) $resto = 0;
        if ($cpf[$t] != $resto) return false;
    }
    return true;
}

function validarTexto($texto) {
    return preg_match('/^[A-Za-zÀ-ÿ\s]+$/u', $texto);
}

function validarTelefone($telefone) {
    return preg_match('/^\(?\d{2}\)?\s?\d{4,5}-?\d{4}$/', $telefone);
}

// Recebe dados do POST
$nome = trim($_POST['nome'] ?? '');
$cpf = trim($_POST['cpf'] ?? '');
$telefone = trim($_POST['telefone'] ?? '');
$cidade = trim($_POST['cidade'] ?? '');
$estado = $_POST['estado'] ?? '';

$erros = [];

if (!validarTexto($nome)) {
    $erros[] = "Nome inválido.";
}

if (!validarCPF($cpf)) {
    $erros[] = "CPF inválido.";
}

if (!validarTelefone($telefone)) {
    $erros[] = "Telefone inválido.";
}

if (!validarTexto($cidade)) {
    $erros[] = "Cidade inválida.";
}

if (empty($estado)) {
    $erros[] = "Estado não selecionado.";
}

if (!empty($erros)) {
    echo "<h3>Erros no formulário:</h3>";
    echo "<ul>";
    foreach ($erros as $erro) {
        echo "<li>" . htmlspecialchars($erro) . "</li>";
    }
    echo "</ul>";
    echo '<a href="index.html">Voltar</a>';
    exit;
}

// Se passou na validação, pode salvar no banco ou mostrar dados
echo "<h3>Formulário enviado com sucesso!</h3>";
echo "<p><strong>Nome:</strong> " . htmlspecialchars($nome) . "</p>";
echo "<p><strong>CPF:</strong> " . htmlspecialchars($cpf) . "</p>";
echo "<p><strong>Telefone:</strong> " . htmlspecialchars($telefone) . "</p>";
echo "<p><strong>Cidade:</strong> " . htmlspecialchars($cidade) . "</p>";
echo "<p><strong>Estado:</strong> " . htmlspecialchars($estado) . "</p>";
