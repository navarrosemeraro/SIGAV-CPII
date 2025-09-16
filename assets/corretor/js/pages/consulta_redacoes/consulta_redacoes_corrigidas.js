let selec_func = document.getElementById("func");
let txt_func = document.getElementById("lbl_func");
let nome = document.getElementById("nome_user");
let div_altera = document.getElementById("div_altera");

selec_func.addEventListener('change', muda_texto);

function muda_texto() {
    if (selec_func.value === "aluno") {
        div_altera.innerHTML = `<div class="mb-2">
                                    <label for="turma" class="form-label" id="lbl_func">Turma do Aluno:</label>
                                    <input type="text" name="txt_turma" id="txt_turma" class="form-control"
                                        style="width: 250px;" required>
                                </div>
                                <div class="mb-2">
                                    <button type="submit" class="btn btn-outline-primary">Buscar</button>
                                </div>`;
    }
    else{
        div_altera.innerHTML = `<div class="mb-2">
                                    <label for="turma" class="form-label" id="lbl_func">Matrícula do Professor: </label>
                                    <input type="text" name="txt_turma" id="txt_turma" class="form-control"
                                        style="width: 250px;" required>
                                </div>
                                <div class="mb-2">
                                    <button type="submit" class="btn btn-outline-primary">Buscar</button>
                                </div>
                                <div class="mb-2">
                                    <label for="nome_user" class="form-label">Nome do(a) Professor(a)</label>
                                    <input type="text" name="nome" id="nome_user" class="form-control"
                                        style="width: 500px; background-color: rgb(211, 211, 211)" readonly>
                                </div>`;
    }
}