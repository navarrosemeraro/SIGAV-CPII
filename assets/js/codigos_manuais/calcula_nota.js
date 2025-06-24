function pega_nota(event) {
    event.preventDefault(); // previne envio do formulário
    event.stopPropagation(); // evita qualquer propagação do clique

    let soma = 0;

    for (let i = 1; i <= 5; i++) {
        const inputSelecionado = document.querySelector(`input[name="c${i}"]:checked`);
        if (inputSelecionado) {
            soma += parseInt(inputSelecionado.value);
        }
    }

    document.getElementById('nota_redacao').value = soma.toString(); 
}

// adiciona o evento corretamente
const button = document.getElementById('btn_calcula');
button.addEventListener('click', pega_nota);