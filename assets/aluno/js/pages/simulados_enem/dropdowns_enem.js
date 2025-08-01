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
        p_g.innerHTML = `<div style="width: 100%; height: auto; background-color: blanchedalmond; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px; border: solid 1px #2d543d;
            border-top: none; padding: 10px;">
                <p style="opacity: 0.5;">1º Simulado</p>
                <a href="../../../assets/aluno/pdf/simulados_cp2/ENEM/2025/SIMULADO ENEM 25 DIA 1.pdf"><p>Dia 01 (12/07)</p></a>
                <a href="../../../assets/aluno/pdf/simulados_cp2/ENEM/2025/GABARITO-DO-SIMULADO-ENEM-DIA-01.pdf"><p>Gabarito Dia 01</p></a>
                <a href="../../../assets/aluno/pdf/simulados_cp2/ENEM/2025/SIMULADO ENEM 25 DIA 2.pdf"><p>Dia 02 (19/07)</p></a>
                <a href="../../../assets/aluno/pdf/simulados_cp2/ENEM/2025/GABARITO-DO-SIMULADO-ENEM 2025 DIA-02.pdf"><p>Gabarito Dia 02</p></a>
                <p style="opacity: 0.5;">2º Simulado</p>
                <a href="#"><p>Dia 01 (12/07)</p></a>
                <a href="#"><p>Gabarito Dia 01</p></a>
                <a href="#"><p>Dia 02 (19/07)</p></a>
                <a href="#"><p>Gabarito Dia 02</p></a>
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
        p_g.innerHTML = `<div style="width: 100%; height: auto; background-color: blanchedalmond; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px; border: solid 1px #2d543d;
            border-top: none; padding: 10px;">
                <p style="opacity: 0.5;">1º Simulado</p>
                <a href="../../../assets/aluno/pdf/simulados_cp2/ENEM/2024/1 SIMULADO ENEM 2024 DIA 1.pdf"><p>Dia 01 (05/10)</p></a>
                <a href="../../../assets/aluno/pdf/simulados_cp2/ENEM/2024/GABARITO-DO-1 -SIMULADO-ENEM 2024-DIA-01.pdf"><p>Gabarito Dia 01</p></a>
                <a href="../../../assets/aluno/pdf/simulados_cp2/ENEM/2024/1 SIMULADO ENEM 2024 DIA 2.pdf"><p>Dia 02 (12/10)</p></a>
                <a href="../../../assets/aluno/pdf/simulados_cp2/ENEM/2024/GABARITO-DO-1 SIMULADO-ENEM 2024-DIA-02.pdf"><p>Gabarito Dia 02</p></a>
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
        p_g.innerHTML = `<div style="width: 100%; height: auto; background-color: blanchedalmond; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px; border: solid 1px #2d543d;
            border-top: none; padding: 10px;">
                <p style="opacity: 0.5;">1º Simulado</p>
                <a href="../../../assets/aluno/pdf/simulados_cp2/ENEM/2023/1º SIMULADO ENEM 23 DIA 1.pdf"><p>Dia 01 (03/07)</p></a>
                <a href="../../../assets/aluno/pdf/simulados_cp2/ENEM/2023/GABARITO-DO 1 SIMULADO-ENEM-DIA-01.pdf"><p>Gabarito Dia 01</p></a>
                <a href="../../../assets/aluno/pdf/simulados_cp2/ENEM/2023/1º SIMULADO ENEM 23 DIA 2.pdf"><p>Dia 02 (08/07)</p></a>
                <a href="../../../assets/aluno/pdf/simulados_cp2/ENEM/2023/GABARITO-DO 1 SIMULADO-ENEM-DIA-02.pdf"><p>Gabarito Dia 02</p></a>
                <p style="opacity: 0.5;">2º Simulado</p>
                <a href="../../../assets/aluno/pdf/simulados_cp2/ENEM/2023/2º SIMULADO ENEM 23 DIA 1.pdf"><p>Dia 01 (09/10)</p></a>
                <a href="../../../assets/aluno/pdf/simulados_cp2/ENEM/2023/GABARITO DO 2 SIMULADO-ENEM-DIA-01.pdf"><p>Gabarito Dia 01</p></a>
                <a href="../../../assets/aluno/pdf/simulados_cp2/ENEM/2023/2º SIMULADO ENEM 23 DIA 2.pdf"><p>Dia 02 (18/10)</p></a>
                <a href="../../../assets/aluno/pdf/simulados_cp2/ENEM/2023/GABARITO DO 2 SIMULADO ENEM-DIA-02.pdf"><p>Gabarito Dia 02</p></a>
            </div>`;
        c2023++;
    }
    else {
        p_g.innerHTML = null;
        c2023--;
    }
}
