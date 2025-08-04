<?php 
require_once '../../../php/global/auth.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../assets/common/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../../../assets/corretor/css/pages/banco_redacoes/banco_redacoes.css">
    <link rel="icon" type="image/png" href="../../../assets/corretor/img/global/Brasão_Colégio_Pedro_II.png">
    <title>Cadastro de Corretores</title>
</head>

<body>
    <section id="um">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="#" style="margin-left: 10px;">SIGAV CPII<span><img
                            src="../../../assets/corretor/img/global/Brasão_Colégio_Pedro_II.png"
                            alt="Brasão Colégio PedroII" style="position: relative; margin-left: 30px;"></span></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page"
                                href="../../pages_corretor/principal/principal.php">Principal</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Redações
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="../correcao/selecionar_redacao.php">Corrigir</a></li>
                                <li><a class="dropdown-item"
                                        href="../../pages_corretor/consulta/banco_redacoes.php">Banco de Redações</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../pages_corretor/suporte/suporte.php">Suporte</a>
                        </li>
                    </ul>
                    <a style="margin-right: 20px; margin-top: 0; color:rgba(0, 0, 0, 1)">
                        <?php echo ($_SESSION["nome"] . " (" . $_SESSION["nivel_acesso"] . ")");?>
                    </a>
                </div>
            </div>
        </nav>
    </section>
    <section id="tres">
        <section id="dois">
            <div id="center">
                <h2 class="display-2 text-center">Inserir Novas Redações No Banco de Dados</h2>
            </div><br>
            <div class="container mt-4">
                <form action="../../../assets/php/inserir_redacao.php" method="post" enctype="multipart/form-data">
                    <fieldset class="border p-4" style="max-width: 900px; margin: auto;">
                        <div class="mb-3">
                            <label for="matricula" class="form-label">Matrícula:</label>
                            <input type="text" class="form-control" id="aluno_id" name="matricula">
                        </div>
                        <div class="mb-3">
                            <label for="tema" class="form-label">Tema da Redação:</label>
                            <input type="text" class="form-control" id="tema" name="tema">
                        </div>
                        <div class="mb-3">
                            <label for="redacao_pdf" class="form-label">Arquivo:</label>
                            <input type="file" class="form-control" id="redacao_pdf" name="redacao_pdf" accept=".pdf"
                                required>
                            <span class="form-text text-danger">(*Precisa estar em formato .pdf)</span>
                        </div>
                        <div class="mb-2">
                            <button type="submit" class="btn btn-outline-primary">Envia Redação(ões)</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </section><br><br>
        <div id="center">
            <hr class="border border-dark" style="width: 70%;">
        </div><br><br>
        <div id="center">
            <h2 class="display-2 text-center">Pesquisar Redações Corrigidas</h2>
        </div><br>
        <div id="center">
            <div class="container">
                <form action="banco_redacoes.php" method="post">
                    <fieldset class="border p-4" style="max-width: 2000px; margin: auto;">
                        <div style="display: flex; gap: 20px; align-items:last baseline; justify-content: center;">
                            <div class="mb-2">
                                <select class="form-control" name="func" id="func" style="text-align: center;">
                                    <option value="aluno">Consulta por Alunos(as)</option>
                                    <option value="corretor">Consulta por Corretores(as)</option>
                                </select>
                            </div>
                            <div class="mb-2">
                                <label for="nome" class="form-label" id="lbl_func">Nome do(a) Aluno(a):</label>
                                <input type="text" name="txt_func" id="txt_func" class="form-control"
                                    style="width: 250px;" required>
                            </div>
                            <div class="mb-2">
                                <button type="submit" class="btn btn-outline-primary">Buscar</button>
                            </div>
                            <div class="mb-2">
                                <label for="nome" class="form-label" id="nome_user">Nome do(a) Aluno(a):</label>
                                <input type="text" name="nome" id="nome" class="form-control"
                                    style="width: 500px; background-color: rgb(211, 211, 211)" readonly>
                            </div>
                        </div>
                    </fieldset>
                </form><br>
                <div id="resultado_consulta">
                    

<?php
// Código PHP só executa aqui após o clique no botão de envio
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
$stmt_redacoes = $conn->prepare("SELECT alunos.nome AS nome_aluno, corretores.nome AS nome_corretor, redacao.tema, redacao.nota_total, redacao.data_envio, redacao.nota_comp1,
                                redacao.nota_comp2, redacao.nota_comp3, redacao.nota_comp4, redacao.nota_comp5
                                FROM corretores
                                JOIN redacao ON corretores.id_matricula = redacao.corretor_id
                                JOIN alunos ON alunos.id_matricula = redacao.aluno_id
                                WHERE corretores.id_matricula = ?;");
$stmt_redacoes->bind_param("s", $mat); //substitui os ? pelo valor da variável "mat"
$stmt_redacoes->execute(); //executa a query
$result_redacoes = $stmt_redacoes->get_result(); //retorna uma tabela como resultado e atribui a $result

/*  IMPRIME O HTML DE ACORDO COM O RESULTADO  */
if($result_redacoes && $result_redacoes->num_rows > 0){
    echo '<h6>Redações corrigidos pelo professor de matrícula "'. $mat . '":</h6>';
    echo '<select name="arquivos" id="arquivos" class="form-control" style="margin-bottom: 50px;">';
    while ($row = $result_redacoes->fetch_assoc()){
        $nome_cor = $row["nome_corretor"];
        $nome_al = $row["nome_aluno"];
        $tema = $row["tema"];
        $nota_total = $row["nota_total"];
        $c1 = $row["nota_comp1"];
        $c2 = $row["nota_comp2"];
        $c3 = $row["nota_comp3"];
        $c4 = $row["nota_comp4"];
        $c5 = $row["nota_comp5"];
        $texto = utf8_encode($row["texto_arquivo"]);
        echo "<option><b>Corretor: $nome_cor</b> / Autor: $nome_al / Tema: $tema / $nota_total / $c1-$c2-$c3-$c4-$c5 </option>";
    }
    echo '</select>';
}
else{
    echo "<h4>Não foram encontradas redações que atendam tais requisitos...</h4>";
}
}
else{
$nome = "%" . $_POST['txt_func'] . "%";
$stmt_redacoes = $conn->prepare("SELECT alunos.nome AS nome_aluno, corretores.nome AS nome_corretor, redacao.tema, redacao.texto_arquivo, redacao.nota_total, redacao.data_envio, redacao.nota_comp1,
                                redacao.nota_comp2, redacao.nota_comp3, redacao.nota_comp4, redacao.nota_comp5
                                FROM alunos
                                JOIN redacao ON alunos.id_matricula = redacao.aluno_id
                                JOIN corretores ON corretores.id_matricula = redacao.corretor_id
                                WHERE alunos.nome LIKE ?;");
$stmt_redacoes->bind_param("s", $nome); //substitui os ? pelo valor da variável "mat"
$stmt_redacoes->execute(); //executa a query
$result_redacoes = $stmt_redacoes->get_result(); //retorna uma tabela como resultado e atribui a $result

/*  IMPRIME O HTML DE ACORDO COM O RESULTADO  */
if($result_redacoes && $result_redacoes->num_rows > 0){
    echo '<h6>Redações correspontes ao Autor "' . $nome . '"</h6>';
    echo '<select name="arquivos" id="arquivos" class="form-control" style="margin-bottom: 50px;">';
    while ($row = $result_redacoes->fetch_assoc()){
        $nome_cor = $row["nome_corretor"];
        $nome_al = $row["nome_aluno"];
        $tema = $row["tema"];
        $nota_total = $row["nota_total"];
        $c1 = $row["nota_comp1"];
        $c2 = $row["nota_comp2"];
        $c3 = $row["nota_comp3"];
        $c4 = $row["nota_comp4"];
        $c5 = $row["nota_comp5"];
        $texto = utf8_encode($row["texto_arquivo"]);
        echo "<option> Corretor: $nome_cor / <b>Autor: $nome_al</b> / Tema: $tema / $nota_total / $c1-$c2-$c3-$c4-$c5 </option>";
    }
    echo '</select>';
}
else{
    echo "<h4>Não foram encontradas redações que atendam tais requisitos...</h4>";
}
}
}

$conn->close();
?>
                </div>
            </div>
        </div>
    </section>

    <script src="../../../assets/corretor/js/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="../../../assets/corretor/js/pages/consulta_redacoes/consulta_redacoes_corrigidas.js"></script>

</body>

</html>