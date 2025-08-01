let _2025 = document.querySelector("div#ano_2025");
let _2024 = document.querySelector("div#ano_2024");
let _2023 = document.querySelector("div#ano_2023");

_2025.addEventListener('click', dropdown_2025);
_2024.addEventListener('click', dropdown_2024);
_2023.addEventListener('click', dropdown_2023);

var c2025 = 0;
var c2024 = 0;
var c2023 = 0;
function dropdown_2025() {
    var p_g = document.getElementById("provas_2025");
    if (c2025 == 0) {
        p_g.innerHTML = `<div style="width: 100%; height: auto; background-color: blanchedalmond; border-radius: 10px; border: solid 1px #2d543d;
            border-top: none; padding: 10px;">
            <div class="container text-center">
                <div class="row">
                    <div class="col">
                        <p style="opacity: 0.5;">1º Simulado (23/05)</p>
                        <a href="../../../assets/aluno/pdf/simulados_cp2/UERJ/2025/1º SIMULADO UERJ 2025.pdf"><p>Prova</p></a>
                        <a href="../../../assets/aluno/pdf/simulados_cp2/UERJ/2025/GABARITO -  1º SIMULADO UERJ 2025.pdf"><p>Gabarito</p></a>
                    </div>
                    <div class="col">
                        <p style="opacity: 0.5;">2º Simulado (18/08)</p>
                        <a href="#"><p>Prova</p></a>
                        <a href="#"><p>Gabarito</p></a>
                    </div>
                </div>
            </div>
        </div>`;
        c2025++;
    }
    else {
        p_g.innerHTML = null;
        c2025--;
    }

}
function dropdown_2024() {
    var p_g = document.getElementById("provas_2024");
    if (c2024 == 0) {
        p_g.innerHTML = `<div style="width: 100%; height: auto; background-color: blanchedalmond; border-radius: 10px; border: solid 1px #2d543d;
            border-top: none; padding: 10px;">
                <p style="opacity: 0.5;">1º Simulado (24/08)</p>
                <a href="../../../assets/aluno/pdf/simulados_cp2/UERJ/2024/1º SIMULADO UERJ 2024.pdf"><p>Prova</p></a>
                <a href="../../../assets/aluno/pdf/simulados_cp2/UERJ/2024/GABARITO - 1º SIMULADO UERJ 2024.pdf"><p>Gabarito</p></a>
            </div>`;
        c2024++;
    }
    else {
        p_g.innerHTML = null;
        c2024--;
    }
}
function dropdown_2023() {
    var p_g = document.getElementById("provas_2023");
    if (c2023 == 0) {
        p_g.innerHTML = `<div style="width: 100%; height: auto; background-color: blanchedalmond; border-radius: 10px; border: solid 1px #2d543d;
            border-top: none; padding: 10px;">
            <div class="container text-center">
                <div class="row">
                    <div class="col">
                        <p style="opacity: 0.5;">1º Simulado (20/05)</p>
                        <a href="../../../assets/aluno/pdf/simulados_cp2/UERJ/2023/1º SIMULADO UERJ 2023.pdf"><p>Prova</p></a>
                        <a href="../../../assets/aluno/pdf/simulados_cp2/UERJ/2023/GABARITO - 1º SIMULADO UERJ 2023.pdf"><p>Gabarito</p></a>
                    </div>
                    <div class="col">
                        <p style="opacity: 0.5;">2º Simulado (19/08)</p>
                <a href="../../../assets/aluno/pdf/simulados_cp2/UERJ/2023/2º SIMULADO UERJ 2023.pdf"><p>Prova</p></a>
                <a href="../../../assets/aluno/pdf/simulados_cp2/UERJ/2023/GABARITO - 2º SIMULADO UERJ 2023.pdf"><p>Gabarito</p></a>
                    </div>
                </div>
            </div>
        </div>`;
        c2023++;
    }
    else {
        p_g.innerHTML = null;
        c2023--;
    }
}
