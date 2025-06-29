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
function verifica(event){
    event.stopPropagation(); // evita qualquer propagação do clique
    for (let i = 1; i<=5; i++){
        const inputSelecionado = document.querySelector(`input[name="c${i}"]:checked`)
        if (!inputSelecionado){
            alert(`Nenhuma opção selecionada na Competência ${i}`);
            event.preventDefault(); // previne envio do formulário
            break;
        }
    }
}

// adiciona o evento corretamente
 const radios = document.querySelectorAll('input[type="radio"]');
 radios.forEach(radio => {
    radio.addEventListener('change', pega_nota);
 });
 const button = document.getElementById("btn_envio")
 button.addEventListener('click', verifica)