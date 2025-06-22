<?php 
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "automacao_tcc";
$charset = 'utf8mb4';

$sql = "INSERT INTO " . $_GET['funcao'] . " (nome, email, cpf, senha_hash, telefone) VALUES ("
 . $_GET['nome'] . ", " . $_GET['email'] . ", "
. $_GET['cpf'] . ", " . $_GET['senha'] . ", " . $_GET['tel'] . ")";

$conn = new mysqli($servername, $username, $password, $db_name, $charset);

if($conn->connect_error){
    die("Connection Failed:" . $conn->connect_error);
}

if($conn->query($sql)){
    echo "<h1>Cadastro executado com sucesso!</h1>";
}
else{
    echo "Erro ao cadastrar: " . $conn->error;
}
$conn->close();

?>