function verifica(_nome, _email, _telefone, _cpf, _matricula, _senha, _conSenha){
    

}
var nome = document.getElementById("nome"); 
var email = document.getElementById("email"); ;
var tel = document.getElementById("tel");  
var cpf = document.getElementById("cpf"); 
var mat = document.getElementById("matricula");
var senha = document.getElementById("senha_hash"); 
var con_senha = document.getElementById("newsenha");

var button = document.querySelector("button#btn_cadastro");
button.addEventListener("click", verifica(nome, email, tel, cpf, mat, senha, con_senha));