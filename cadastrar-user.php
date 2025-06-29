<?php 
//Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "automacao";
$charset = 'utf8mb4';

//Estabelece Conexão
$conn = new mysqli($servername, $username, $password, $db_name, $charset);

//Verifica a Conexão
if($conn->connect_error){
    die("Connection Failed:" . $conn->connect_error);
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $id_matricula = (int) $_POST['matricula'];
    $nome = $conn->real_escape_string($_POST['nome']);
    $email = $conn->real_escape_string($_POST['email']);
    $cpf = $conn->real_escape_string($_POST['nome']);
    $senha_hash = $conn->real_escape_string($_POST['senha_hash']);
    $telefone = $conn->real_escape_string($_POST['tel']);

    $sql = "INSERT INTO " . $_GET['funcao'] . " (id_matricula, nome, email, cpf, senha_hash, telefone) 
    VALUES (" . $id_matricula . ", " . $nome . ", " . $email . ", " . $cpf . ", " . $senha_hash . ", " . $telefone ")";

    if($conn->query($sql) === TRUE){
        echo "<h1>Cadastro realizado com sucesso!</h1>";
    }
    else {
        echo "Erro ao cadastrar: " . $conn->error;
    }

} else { echo"<p>Nenhum dado foi inserido</p>";}


$conn->close();





?>