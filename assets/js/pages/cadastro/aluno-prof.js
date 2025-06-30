var text_form = `
<div class="mb-2">
    <label for="turno" class="form-label">Turno:</label>
    <select class="form-select" id="turno" name="turno">
        <option value="manha">Manhã</option>
        <option value="tarde">Tarde</option>
        <option value="noite">Noite</option>
    </select>
</div>
<div class="mb-2">
<label for="turma" class="form-label">Turma:</label>
<input type="text" class="form-control" id="turma" name="turma" placeholder="EX: 1303 ou DS306">
</div>
<div class="mb-2">
    <label for="idioma" class="form-label">Idioma:</label>
    <select class="form-select" id="idioma" name="idioma">
        <option value="ingles">Inglês</option>
        <option value="frances">Francês</option>
        <option value="espanhol">Espanhol</option>
    </select>
</div>
`;

const selec_func = document.getElementById('funcao');
selec_func.addEventListener('change', aluno_ou_prof);

function aluno_ou_prof() {
    const funcSelecionada = selec_func.value;
    const div_espec = document.querySelector("div#espec-aluno");
    if (funcSelecionada === "alunos") {
        div_espec.innerHTML = text_form;
    }
    else {div_espec.innerHTML = null}
}