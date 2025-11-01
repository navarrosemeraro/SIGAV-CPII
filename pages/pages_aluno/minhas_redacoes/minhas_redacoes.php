<?php
require_once '../../../php/global/auth.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../assets/common/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../assets/aluno/css/pages/minhas_redacoes/minhas_redacoes.css">
    <link rel="icon" type="image/png" href="../../../assets/aluno/img/global/Brasão_Colégio_Pedro_II.png" />
    <title>Minhas Redações</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#" style="margin-left: 10px;">SIGAV CPII<span><img
                        src="../../../assets/aluno/img/global/Brasão_Colégio_Pedro_II.png" alt="Brasão Colégio PedroII"
                        style="position: relative; margin-left: 30px;"></span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../area_aluno/area_aluno.php">Área do Aluno</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../sobre/sobre.php">Sobre O Projeto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../suporte/suporte.php">Suporte</a>
                    </li>
                </ul>
                <div id="barra_usuario">
                    <a style="margin-right: 20px; margin-top: 0; color:rgba(0, 0, 0, 1); text-decoration:none;"
                        href="../perfil_aluno/perfil_aluno.php" class="dropdown-toggle">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-person-circle" viewBox="0 0 16 16"
                                style="height:30px; width:30px; margin-right: 10px">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                <path fill-rule="evenodd"
                                    d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                            </svg>
                        </span>
                        <?php echo ($_SESSION["nome"] . " (" . $_SESSION["turma"] . ")");?>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main>
    <section id="um" class="container">
        <h1 id="center" class="display-5 text-center" style="margin: 20px; margin-top: 100px">Minhas Redações</h1>
        <br>
<?php
//Conexão
include '../../../php/global/db.php';

//Recebe a matrícula do aluno
$mat = $_SESSION["matricula"];

//Prepara o SQL para as redações
$stmt_redacoes = $conn->prepare("SELECT redacao.id AS id_redacao, redacao.tema, redacao.aluno_id, redacao.nota_total,
                                redacao.caminho_arquivo, redacao.status_red, redacao.data_envio, 
                                alunos.nome AS nome_aluno, corretores.nome AS nome_corretor
                                FROM redacao
                                JOIN alunos ON alunos.id_matricula = redacao.aluno_id
                                LEFT JOIN corretores ON corretores.id_matricula = redacao.corretor_id
                                WHERE alunos.id_matricula = ?
                                ORDER BY status_red, data_envio desc;");
if (!$stmt_redacoes) {
    die("Erro no prepare: " . $conn->error);
}
$stmt_redacoes->bind_param("i", $mat); //substitui os ? pelo valor da variável "mat"
$stmt_redacoes->execute(); //executa a query
$result_redacoes = $stmt_redacoes->get_result(); //retorna uma tabela como resultado e atribui a $result

/*  IMPRIME O HTML DE ACORDO COM O RESULTADO  */
if($result_redacoes && $result_redacoes->num_rows > 0){
    echo "<div class='row row-cols-1 row-cols-md-3 g-4'>";
    while ($row = $result_redacoes->fetch_assoc()){
        $id_redacao = $row["id_redacao"];
        $autor = $row["nome_aluno"];
        $nome_corretor = $row["nome_corretor"];
        $nota_total = $row["nota_total"];
        $tema = $row["tema"];
        $status = $row["status_red"];
        $data = $row["data_envio"];
        if($status === "corrigida"){
            echo "<form action='../minhas_redacoes/visualizar_redacao_selecionada.php?nome_autor={$autor}&tema={$tema}' method='post'>
            <div class='col'>
                    <div class='card h-100 card-redFeita' style=' min-height: 250px; cursor: pointer;' onclick=\"this.closest('form').submit()\">
                        <div class='card-body'>
                            <h5 class='card-title'>{$tema}</h5>
                            <h3 class='card-title' style='font-weight:bold;'>Nota: {$nota_total}</h3>
                            <h6 class='card-text'><b>{$status}</b> - Corretor: {$nome_corretor}</h6>
                            <input type='hidden' id='id_red' name='id_red' value=". $id_redacao .">
                        </div>
                        <div id='visualizar_corrigida'>Visualizar Redação Corrigida</div>
                        <div class='card-footer'>
                            <small class='text-body-secondary'>Data de Envio: {$data}</small>
                        </div>
                    </div>
                    </a>
                </div>
                </form>";
        }
        if($status === "pendente"){
            echo "<div class='col'>
                    <div class='card h-100 card-redPendente' style=' min-height: 250px;'>
                        <div class='card-body' style='margin-bottom: 0;'>
                            <h5 class='card-title'>{$tema}</h5>
                            <h6 class='card-text'><b>{$status}</b></h6>
                        </div>
                        <div id='corr_pendente'>Correção Ainda Pendente ❌</div>
                        <div class='card-footer'>
                            <small class='text-body-secondary'>Data de Envio: {$data}</small>
                        </div>
                    </div>
                </div>";
        }
    }
    echo "</div>";
    
}
else{
    echo "<h4>Ainda não há redações feitas...</h4>";
}

$conn->close();
?>

    </section>
</main>

    <script src="../../../assets/corretor/js/bootstrap/bootstrap.bundle.min.js"></script>
</body>

</html>