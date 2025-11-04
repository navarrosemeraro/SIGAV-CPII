// Espere a página inteira carregar ANTES de tentar fazer qualquer coisa
document.addEventListener('DOMContentLoaded', function() {
    
    let selec_func = document.getElementById("func");
    let div_altera = document.getElementById("div_altera");

    if (!selec_func) {
        console.error("ERRO: Não foi possível encontrar o elemento <select> com id='func'");
        return; // Para a execução
    }

    if (!div_altera) {
        console.error("ERRO: Não foi possível encontrar a <div> com id='div_altera'");
        return; // Para a execução
    }

    function muda_texto() {
        
        if (selec_func.value === "corretor") {
            div_altera.innerHTML = `<div class="mb-2">
                                        <label for="turma" class="form-label" id="lbl_func">Matrícula do Professor: </label>
                                        <input type="text" name="txt_mat" id="txt_mat" class="form-control"
                                            style="width: 250px;" required>
                                    </div>
                                    <div class="mb-2">
                                        <button type="submit" class="btn btn-outline-primary">Buscar</button>
                                    </div>`;
        } 
        else {
            div_altera.innerHTML = `<div class="mb-2">
                                        <label for="turma" class="form-label" id="lbl_func">Turma do Aluno:</label>
                                        <input type="text" name="txt_turma" id="txt_turma" class="form-control"
                                            style="width: 250px;" required>
                                    </div>
                                    <div class="mb-2">
                                        <button type="submit" class="btn btn-outline-primary">Buscar</button>
                                    </div>`;
        }
    }

    selec_func.addEventListener('change', muda_texto);

    muda_texto();

});