<?php 
require_once '../../../php/global/auth.php';
include '../../../php/global/db.php'; 
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../assets/common/bootstrap/css/bootstrap.min.css">
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
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item"
                                        href="../../pages_corretor/consulta/banco_redacoes.php">Banco de Redações</a>
                                </li>
                                <li><a class="dropdown-item"
                                        href="../../pages_corretor/consulta/inserir_redacoes.php">Inserir Novas
                                        Redações</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../pages_corretor/suporte/suporte.php">Suporte</a>
                        </li>
                    </ul>
                    <div id="barra_usuario">
                        <a style="margin-right: 20px; margin-top: 0; color:rgba(0, 0, 0, 1); text-decoration:none;"
                            href="../perfil_corretor/perfil_corretor.php" class="dropdown-toggle">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-person-circle" viewBox="0 0 16 16"
                                    style="height:30px; width:30px; margin-right: 10px">
                                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                    <path fill-rule="evenodd"
                                        d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                                </svg>
                            </span>
                            <?php echo ($_SESSION["nome"]);?>
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </section>
    <main>
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
                            <div id="div_altera" style="display: flex; gap: 20px; align-items:last baseline; justify-content: center;">
                                <div class="mb-2">
                                    <label for="turma" class="form-label" id="lbl_func">Turma do Aluno:</label>
                                    <input type="text" name="txt_turma" id="txt_turma" class="form-control"
                                        style="width: 250px;" required>
                                </div>
                                <div class="mb-2">
                                    <button type="submit" class="btn btn-outline-primary">Buscar</button>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form><br>


                <?php
// Código PHP só executa aqui após o clique no botão de envio
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

$func = $_POST['func'];
//Recebe a matrícula do aluno/corretor

//caso seja o select forneça a informação de ser um corretor
if($func == "corretor"){
$mat = strval($_POST['txt_mat']);
$stmt_redacoes = $conn->prepare("SELECT alunos.nome AS nome_aluno, corretores.nome AS nome_corretor, 
                                redacao.id AS id_redacao, redacao.tema, redacao.nota_total, redacao.data_envio, redacao.status_red,
                                redacao.nota_comp1, redacao.nota_comp2, redacao.nota_comp3, redacao.nota_comp4, redacao.nota_comp5
                                FROM corretores
                                JOIN redacao ON corretores.id_matricula = redacao.corretor_id
                                JOIN alunos ON alunos.id_matricula = redacao.aluno_id
                                WHERE corretores.id_matricula = ?;");
if (!$stmt_redacoes) {
    die("Erro no prepare: " . $conn->error);
}
$stmt_redacoes->bind_param("s", $mat); //substitui os ? pelo valor da variável "mat"
$stmt_redacoes->execute(); //executa a query
$result_redacoes = $stmt_redacoes->get_result(); //retorna uma tabela como resultado e atribui a $result

/*  IMPRIME O HTML DE ACORDO COM O RESULTADO  */
if($result_redacoes && $result_redacoes->num_rows > 0){
    echo '<h6>Redações corrigidos pelo professor de matrícula "'. $mat . '":</h6>';
    while ($row = $result_redacoes->fetch_assoc()){
        $id_redacao = $row["id_redacao"];
        $nome_aluno = $row["nome_aluno"];
        $nome_corretor = $row["nome_corretor"];
        $nota_total = $row["nota_total"];
        $tema = $row["tema"];
        $status = $row["status_red"];
        $data = $row["data_envio"];
        echo "<div class='col' style='margin-bottom:10px;'>
                    <a href='../visualiza_redacao/visualizar_redacao_selecionada.php?id={$id_redacao}&nome_autor={$nome_aluno}&tema={$tema}' style='text-decoration:none;'>
                    <div class='card h-100 card-pend'>
                        <div class='card-body'>
                            <h6 class='card-title'><b>{$nome_aluno}</b></h6>
                            <h5 class='card-title'>{$tema}</h5>
                            <p class='card-text'>{$status}</p>
                        </div>
                        <div class='card-footer'>
                            <small class='text-body-secondary'>Data de Envio: {$data}</small>
                        </div>
                    </div>
                    </a>
                </div>";
    }
}
else{ // não encontrou redacoes corrigidas pelo corretor de matrícula determinada
    echo "<h4>Não foram encontradas redações que atendam tais requisitos...</h4>";
}
}

//caso seja o select forneça a informação de ser um aluno
else{
$turma = strval($_POST['txt_turma']);
$stmt_redacoes = $conn->prepare("SELECT alunos.nome AS nome_aluno, corretores.nome AS nome_corretor, 
                                redacao.id AS id_redacao, redacao.tema, redacao.nota_total, redacao.data_envio, redacao.status_red,
                                redacao.nota_comp1, redacao.nota_comp2, redacao.nota_comp3, redacao.nota_comp4, redacao.nota_comp5
                                FROM corretores
                                JOIN redacao ON corretores.id_matricula = redacao.corretor_id
                                JOIN alunos ON alunos.id_matricula = redacao.aluno_id
                                WHERE alunos.turma = ? AND redacao.status_red = 'corrigida'
                                ORDER BY redacao.data_envio");
if (!$stmt_redacoes) {
    die("Erro no prepare: " . $conn->error);
}
$stmt_redacoes->bind_param("s", $turma); //substitui os ? pelo valor da variável "mat"
$stmt_redacoes->execute(); //executa a query
$result_redacoes = $stmt_redacoes->get_result(); //retorna uma tabela como resultado e atribui a $result

/*  IMPRIME O HTML DE ACORDO COM O RESULTADO  */
if($result_redacoes && $result_redacoes->num_rows > 0){
    echo '<h6>Redações correspontes a alunos da turma "' . $turma . '"</h6>';
     while ($row = $result_redacoes->fetch_assoc()){
        $id_redacao = $row["id_redacao"];
        $nome_aluno = $row["nome_aluno"];
        $nome_corretor = $row["nome_corretor"];
        $nota_total = $row["nota_total"];
        $tema = $row["tema"];
        $status = $row["status_red"];
        $data = $row["data_envio"];
        echo "<div class='col' style='margin-bottom:10px;'>
                    <a href='../visualiza_redacao/visualizar_redacao_selecionada.php?id={$id_redacao}&nome_autor={$nome_aluno}&tema={$tema}' style='text-decoration:none;'>
                    <div class='card h-100 card-pend'>
                        <div class='card-body'>
                            <h6 class='card-title'><b>{$nome_aluno}</b></h6>
                            <h5 class='card-title'>{$tema}</h5>
                            <p class='card-text'>{$status}</p>
                        </div>
                        <div class='card-footer'>
                            <small class='text-body-secondary'>Data de Envio: {$data}</small>
                        </div>
                    </div>
                    </a>
                </div>";
    }
}
else{
    echo "<h4>Não foram encontradas redações que atendam tais requisitos...</h4>";
}
}
}
if (isset($conn) && $conn instanceof mysqli) {
    mysqli_close($conn);
}
?>
            </div>
        </div>
        </div>
        </section>
    </main>

    <script src="../../../assets/common/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../../assets/corretor/js/pages/consulta_redacoes/consulta_redacoes_corrigidas.js"></script>
    <script>
        $nome_user = <?= $row["nome_corretor"] ?>;
        document.getElementById("nome_user").value; = $nome_user;
    </script>

</body>

</html>