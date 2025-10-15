function veri_senha(senha, senha_rep) {
    const spanErro = document.getElementById("erro_senha");

    if (senha !== senha_rep) {
        spanErro.innerHTML = `<p style="color: red; position:relative;"> Senhas não coincidem!</p>`;
        return false;
    }
    else {
        spanErro.innerHTML = "";
        return true;
    }
}

const form_cad = document.querySelector("#form_cad");

form_cad.addEventListener("submit", function (e) {

    const senha = document.getElementById("senha_hash").value;
    const senha_rep = document.getElementById("senha_rep").value;

    if (!veri_senha(senha, senha_rep)) {
        e.preventDefault();
    }
});

