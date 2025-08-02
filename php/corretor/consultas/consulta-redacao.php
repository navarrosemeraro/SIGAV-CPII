<?php
// Conexão
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "automacao";
$charset = "utf8mb4";

$conn = new mysqli($servername, $username, $password, $db_name);
$conn->set_charset($charset);

if($conn->connect_error){
    die("Erro na conexão: " . $conn->connect_error);
}

$func = $_POST['func'];
//Recebe a matrícula do aluno/corretor
if($func == "corretor"){
$mat = $_POST['txt_func'];
$stmt_redacoes = $conn->prepare("SELECT corretores.nome, redacao.tema, redacao.nota_total, redacao.data_envio, redacao.nota_comp1,
                                redacao.nota_comp2, redacao.nota_comp3, redacao.nota_comp4, redacao.nota_comp5
                                FROM corretores
                                JOIN redacao ON corretores.id_matricula = redacao.corretor_id
                                WHERE corretores.id_matricula = ? AND redacao.status_red = 'corrigida'");
$stmt_redacoes->bind_param("s", $mat); //substitui os ? pelo valor da variável "mat"
$stmt_redacoes->execute(); //executa a query
$result_redacoes = $stmt_redacoes->get_result(); //retorna uma tabela como resultado e atribui a $result

/*  IMPRIME O HTML DE ACORDO COM O RESULTADO  */
if($result_redacoes && $result_redacoes->num_rows > 0){
    while ($row = $result_redacoes->fetch_assoc()){
        $nome = $row["nome"];
        $tema = $row["tema"];
        $nota_total = $row["nota_total"];
        $c1 = $row["nota_comp1"];
        $c2 = $row["nota_comp2"];
        $c3 = $row["nota_comp3"];
        $c4 = $row["nota_comp4"];
        $c5 = $row["nota_comp5"];
        $texto = utf8_encode($row["texto_arquivo"]);
        echo "<option>Autor: $nome / Tema: $tema / $nota_total / $c1-$c2-$c3-$c4-$c5 </option>";
    }
}
else{
    echo "<h4>Não foram encontradas redações que atendam tais requisitos...</h4>";
}
}
else{
$nome = "%" . $_POST['txt_func'] . "%";
$stmt_redacoes = $conn->prepare("SELECT alunos.nome, redacao.tema, redacao.texto_arquivo, redacao.nota_total, redacao.data_envio, redacao.nota_comp1,
                                redacao.nota_comp2, redacao.nota_comp3, redacao.nota_comp4, redacao.nota_comp5
                                FROM alunos
                                JOIN redacao ON alunos.id_matricula = redacao.aluno_id
                                WHERE alunos.nome LIKE ? AND redacao.status_red = 'corrigida'");
$stmt_redacoes->bind_param("s", $nome); //substitui os ? pelo valor da variável "mat"
$stmt_redacoes->execute(); //executa a query
$result_redacoes = $stmt_redacoes->get_result(); //retorna uma tabela como resultado e atribui a $result

/*  IMPRIME O HTML DE ACORDO COM O RESULTADO  */
if($result_redacoes && $result_redacoes->num_rows > 0){
    while ($row = $result_redacoes->fetch_assoc()){
        $nome = $row["nome"];
        $tema = $row["tema"];
        $nota_total = $row["nota_total"];
        $c1 = $row["nota_comp1"];
        $c2 = $row["nota_comp2"];
        $c3 = $row["nota_comp3"];
        $c4 = $row["nota_comp4"];
        $c5 = $row["nota_comp5"];
        $texto = utf8_encode($row["texto_arquivo"]);
        echo "<option>Autor: $nome / Tema: $tema / $nota_total / $c1-$c2-$c3-$c4-$c5 </option>";
    }
}
else{
    echo "<h4>Não foram encontradas redações que atendam tais requisitos...</h4>";
}
}

$conn->close();
?>