<?php 
require_once '../../../php/global/auth.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../../assets/common/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../assets/aluno/css/pages/simulados_antigos/simulados_enem/simulados_enem.css">
    <link rel="icon" type="image/png" href="../../../assets/aluno/img/global/Brasão_Colégio_Pedro_II.png" />
    <title>Cadastro de Corretores</title>
</head>

<body>
    <section id="um">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="#" style="margin-left: 10px;">SIGAV CPII<span><img
                            src="../../../assets/aluno/img/global/Brasão_Colégio_Pedro_II.png"
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
                                href="../principal/principal.php">Principal</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page"
                                href="../minhas_redacoes/minhas_redacoes.php">Minhas Redações</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Simulados Antigos - CPII
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="../simulados_antigos/simulados_enem.php">ENEM e
                                        Gabaritos</a></li>
                                <li><a class="dropdown-item" href="../simulados_antigos/simulados_uerj.php">UERJ e
                                        Gabaritos</a></li>
                            </ul>
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
    </section>
    <main>
        <section id="dois" class="container">
            <h1 id="center" class="display-5 text-center" style="margin: 20px;">Simulados ENEM</h1>
            <div id="ano_2025">
                <h4 style="margin-right: 5px;">2025</h4><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                    fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                    <path
                        d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                </svg>
            </div>
            <div id="provas_2025"></div>
            <div id="ano_2024">
                <h4 style="margin-right: 5px;">2024</h4><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                    fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                    <path
                        d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                </svg>
            </div>
            <div id="provas_2024"></div>
            <div id="ano_2023">
                <h4 style="margin-right: 5px;">2023</h4><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                    fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                    <path
                        d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                </svg>
            </div>
            <div id="provas_2023"></div>
        </section>
    </main>
    <script src="../../../assets/corretor/js/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="../../../assets/aluno/js/pages/simulados_enem/dropdowns_enem.js"></script>
</body>

</html>