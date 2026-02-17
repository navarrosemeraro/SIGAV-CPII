<?php
    require_once '../../../php/global/db.php';
    require_once '../../../php/global/auth.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área de Redação</title>
    <link rel="stylesheet" href="../../../assets/aluno/css/pages/enviar_redacao/enviar_redacao.css">
    <link rel="stylesheet" href="../../../assets/common/bootstrap/css/bootstrap.min.css">
    <link rel="icon" type="image/png" href="../../../assets/corretor/img/global/Brasão_Colégio_Pedro_II.png">
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
                        <a class="nav-link active" aria-current="page" href="../area_aluno/area_aluno.php">Área do
                            Aluno</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../sobre/sobre.php">Sobre O Projeto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../suporte/suporte.php">Suporte</a>
                    </li>
                </ul>
                <div class="dropdown">
                    <button style="background-color: white;" class="btn btn-secondary" type="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
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
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="../perfil_aluno/perfil_aluno.php">Ver Perfil</a></li>
                        <li><a class="dropdown-item" href="../../../php/global/logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
        </div>
    </nav>

    <section id="um">
        <main>
            <div id="center">
                <h2 class="display-2 text-center">Redações</h2>
            </div>
            <div id="center">
                <div class="container my-5">
                            <div id="center">
                                <h2 class="display-6 text-center">Enviar Redação para Correção</h2>
                            </div><br>
                            <div class="container mt-4">
                                <form action="../../../php/aluno/inserir_redacao/inserir_redacao.php" method="post"
                                    enctype="multipart/form-data">
                                    <fieldset class="border p-4" style="max-width: 900px; margin: auto;">
                                        <div class="mb-3">
                                            <label for="tema" class="form-label">Tema da Redação:</label>
                                            <input type="text" class="form-control" id="tema" name="tema">
                                        </div>
                                        <div class="mb-3">
                                            <label for="redacao_pdf" class="form-label">Arquivo:</label>
                                            <input type="file" class="form-control" id="redacao_pdf" name="redacao_pdf"
                                                accept=".pdf" required>
                                            <span class="form-text text-danger">(*Precisa estar em formato .pdf)</span>
                                        </div>
                                        <div class="mb-2">
                                            <button type="submit" class="btn btn-outline-primary">Enviar
                                                Redação</button>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                            <div class="position-relative">
                                <div class="container" style="display: flex; justify-content: center;">
                                    <div id="mensagem_sucesso"></div><br>
                                    <div id="mensagem_fracasso"></div>
                                </div>
                            </div>
                </div>
            </div>

        </main>
    </section>



    <script src="../../../assets/common/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>