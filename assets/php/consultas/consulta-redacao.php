<?php 
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "automacao";
$charset = 'utf8mb4';

//define a consulta a ser executada
$sql = "SELECT  'redacao.id', 'redacao.tema', 'redacao.aluno_id', 'redacao.status_red', 'redacao.data_envio' FROM 'redacao'
JOIN 'alunos' ON 'alunos.id_matricula' = 'redacao.aluno_id'
JOIN 'corretores' ON 'corretores.id_matricula' = 'redacao.corretor_id'
WHERE 'redacao.status_red' = 'pendente';";

//estabelece conexão
$conn = new mysqli($servername, $username, $password, $db_name, $charset);

//caso dê erro na conexão, o código para
if ($conn->connect_error){
    die("Error: " . $conn->connect_error);
}

//executa a query e atribui à variável toda a tabela sql
$result = $conn->query($sql);
//se for null, a query deu erro
if ($result == null){
    echo ("Error: " . $sql . "<br>" . $conn->error);
}
//se não der erro, imprime no site um select com todas as redações
else{
    echo ("<select class='form-select' multiple aria-label='Multiple select example'>")
    while($row = $result->fetch_assoc()){
        echo = ("<option value = " . $row['redacao.id'] .">"
                . $row['redacao.aluno_id'] . " " . $row['alunos.nome']
                . " " . $row['redacao.tema'] . " " . $row['redacao.data_envio']
                 . "</option>");
    }
    echo ("</select>");
}

$conn->close();