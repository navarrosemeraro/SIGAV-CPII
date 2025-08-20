<?php
require_once '../../../php/global/auth.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../assets/common/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../assets/corretor/css/pages/selecionar_redacoes/selecionar_redacoes.css">
    <link rel="icon" type="image/png" href="../../../assets/corretor/img/global/Brasão_Colégio_Pedro_II.png">
    <title>Cadastro de Corretores</title>
</head>

<body>
    <section id="um">
         <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#" style="margin-left: 10px;">SIGAV CPII<span><img
                        src="../../../assets/corretor/img/global/Brasão_Colégio_Pedro_II.png" alt="Brasão Colégio PedroII"
                        style="position: relative; margin-left: 30px;"></span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../../pages_corretor/principal/principal.php">Principal</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Redações
                        </a>
                        <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="../correcao/selecionar_redacao.php">Corrigir</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item disabled" href="#">Separated link</a></li>
                                <li><a class="dropdown-item"
                                        href="../../pages_corretor/consulta/banco_redacoes.php">Banco de Redações</a>
                                </li>
                                <li><a class="dropdown-item" href="../../pages_corretor/consulta/inserir_redacoes.php">Inserir Novas Redações</a></li>
                            </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../pages_corretor/suporte/suporte.php">Suporte</a>
                    </li>
                </ul>
                <div id="barra_usuario">
                    <a style="margin-right: 20px; margin-top: 0; color:rgba(0, 0, 0, 1); text-decoration:none;" href="../perfil_corretor/perfil_corretor.html" class="dropdown-toggle">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-person-circle" viewBox="0 0 16 16" style="height:30px; width:30px; margin-right: 10px">
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
    </section><br>
    <section id="dois">
        <div id="center">
            <h2 class="display-2 text-center">Selecione a Redação</h2>
        </div><br>
        <div class="container">
                <?php 
                // Conexão
                include '../../../php/global/db.php';
                
                //Prepara o SQL para as redações
                $stmt_redacoes = $conn->prepare("SELECT redacao.id, redacao.tema, redacao.aluno_id, redacao.caminho_arquivo, redacao.status_red, redacao.data_envio, 
                                                alunos.nome AS 'nome_aluno', alunos.id_matricula
                                                FROM redacao
                                                JOIN alunos ON alunos.id_matricula = redacao.aluno_id
                                                WHERE redacao.status_red = 'pendente';");
                if (!$stmt_redacoes) {
                    die("Erro no prepare: " . $conn->error);
                }
                $stmt_redacoes->execute(); //executa a query
                $result_redacoes = $stmt_redacoes->get_result(); //retorna uma tabela como resultado e atribui a $result

                /*  IMPRIME O HTML DE ACORDO COM O RESULTADO  */
                if($result_redacoes && $result_redacoes->num_rows > 0){
                echo "<div class='row row-cols-1 row-cols-md-3 g-4'>";
                while ($row = $result_redacoes->fetch_assoc()){
                $id_redacao = $row["id"];
                $autor = $row["nome_aluno"];
                $tema = $row["tema"];
                $status = $row["status_red"];
                $data = $row["data_envio"];
                echo "<div class='col'>
                    <a href='corrigir_redacao.php?id={$id_redacao}&nome_autor={$autor}&tema={$tema}' style='text-decoration:none;'>
                    <div class='card h-100'>
                        <img src='...' class='card-img-top' alt='...'>
                        <div class='card-body'>
                            <h6 class='card-title'><b>{$autor}</b></h6>
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
    echo "</div>";
    
}
            ?>

        </div>
    </section>

    <script src="../../../assets/corretor/js/bootstrap/bootstrap.bundle.min.js"></script>
</body>

</html>