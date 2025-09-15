function validarFormulario() {
    let valido = true;

    // Limpa mensagens de erro
    document.querySelectorAll(".error").forEach(el => el.textContent = "");

    // Validação nome
    const nome = document.getElementById("nome").value.trim();
    if (!/^[A-Za-zÀ-ÿ\s]+$/.test(nome)) {
        document.getElementById("erroNome").textContent = "Nome deve conter apenas letras.";
        valido = false;
    }

    // Validação CPF
    const cpf = document.getElementById("cpf").value.trim();
    if (!validarCPF(cpf)) {
        document.getElementById("erroCPF").textContent = "CPF inválido.";
        valido = false;
    }

    // Validação telefone
    const telefone = document.getElementById("telefone").value.trim();
    if (!/^\(?\d{2}\)?\s?\d{4,5}-?\d{4}$/.test(telefone)) {
        document.getElementById("erroTelefone").textContent = "Telefone inválido.";
        valido = false;
    }

    // Validação cidade
    const cidade = document.getElementById("cidade").value.trim();
    if (!/^[A-Za-zÀ-ÿ\s]+$/.test(cidade)) {
        document.getElementById("erroCidade").textContent = "Cidade deve conter apenas letras.";
        valido = false;
    }

    return valido;
}

function validarCPF(cpf) {
    cpf = cpf.replace(/[^\d]+/g, '');
    if (cpf.length !== 11 || /^(\d)\1+$/.test(cpf)) return false;

    let soma = 0;
    for (let i = 0; i < 9; i++) soma += parseInt(cpf.charAt(i)) * (10 - i);
    let resto = 11 - (soma % 11);
    if (resto === 10 || resto === 11) resto = 0;
    if (resto !== parseInt(cpf.charAt(9))) return false;

    soma = 0;
    for (let i = 0; i < 10; i++) soma += parseInt(cpf.charAt(i)) * (11 - i);
    resto = 11 - (soma % 11);
    if (resto === 10 || resto === 11) resto = 0;
    return resto === parseInt(cpf.charAt(10));
}