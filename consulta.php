<?php 
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "automacao";
$charset = 'utf8mb4';
$variavel ='Global';

$sql = "SELECT DISTINCT 'alunos.nome', 'alunos.matricula', 'redacao.id', 'redacao.tema', 'redacao.texto_arquivo', FROM 'alunos' JOIN 'redacao';";

$conn = new mysqli($servername, $username, $password, $db_name, $charset);

if($conn->connect_error){
    die("Connection Failed:" . $conn->connect_error);
}
else{
    $conn->query($sql);
    if($result == null){
        echo ("Error: " . $sql . "<br>" . $conn->error);
    }
    else{
        while($row == $result->fetch_assoc){
            echo ('<option value="' . $row["redacao.id"] . '">' . $row["alunos.nome"] . $row["alunos.matricula"] . $row["redacao.tema"] . $row["redacao.texto_arquivo"] . '</option>');
        }
    }
    echo ("</select>");
}
$conn->close();

?>