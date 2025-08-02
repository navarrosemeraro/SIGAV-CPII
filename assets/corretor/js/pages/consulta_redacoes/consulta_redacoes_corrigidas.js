let selec_func = document.getElementById("func");
let txt_func = document.getElementById("lbl_func");
let nome = document.getElementById("nome_user");

selec_func.addEventListener('change', muda_texto);

function muda_texto() {
    if (selec_func.value === "aluno") {
        txt_func.innerHTML = "Nome do(a) Aluno(a): ";
        nome.innerHTML = "Nome do(a) Aluno(a): ";
    }
    else{
        txt_func.innerHTML = "Matrícula do(a) Corretor(a):";
        nome.innerHTML = "Nome do(a) Corretor(a):";
    }
}