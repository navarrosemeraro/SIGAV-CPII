<?php
require_once '../../../php/global/auth.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../assets/common/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../assets/aluno/css/pages/area_aluno/area_aluno.css">
    <link rel="icon" type="image/png" href="../../../assets/aluno/img/global/Brasão_Colégio_Pedro_II.png" />
    <title>Área do Aluno</title>
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
        <section id="um">
            <div style="display: flex; justify-content: center; align-items: center; margin-top: 30px;">
            <h1 id="titulo" class="display-4 text-center">Área do Aluno</h1>
            <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor"
                    class="bi bi-backpack-fill" viewBox="0 0 16 16">
                    <path d="M5 13v-3h4v.5a.5.5 0 0 0 1 0V10h1v3z" />
                    <path
                        d="M6 2v.341C3.67 3.165 2 5.388 2 8v5.5A2.5 2.5 0 0 0 4.5 16h7a2.5 2.5 0 0 0 2.5-2.5V8a6 6 0 0 0-4-5.659V2a2 2 0 1 0-4 0m2-1a1 1 0 0 1 1 1v.083a6 6 0 0 0-2 0V2a1 1 0 0 1 1-1m0 3a4 4 0 0 1 3.96 3.43.5.5 0 1 1-.99.14 3 3 0 0 0-5.94 0 .5.5 0 1 1-.99-.14A4 4 0 0 1 8 4M4.5 9h7a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-4a.5.5 0 0 1 .5-.5" />
            </svg>
            </div>
            <div class="container-xxl" style="display: flex; justify-content: center;">
                <div class="card" style="width: 30rem; margin-top: 60px; box-shadow: 0px 5px 10px #0080807e;">
                    <div class="card-body">
                        <h3 class="card-title">Redações</h3>
                        <p class="card-text" style="font-size: 17px;">Ver os status e a Correção de Minhas Redações</p>
                        <a id="btn1" href="../area_redacao/area_redacao.php" class="btn btn-primary">Ver Redações</a>
                        <svg style="position: relative; left: 52%; width: 60px; height: 60px; color: #008080;"
                            xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-book-half" viewBox="0 0 16 16">
                            <path
                                d="M8.5 2.687c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="container-xxl" style="display: flex; justify-content: left; margin-top: 30px;">
                <div class="cards-row text-center">
                    <div class="row">
                        <div class="col">
                            <div class="card"
                                style="width: 100%; margin: 10px; box-shadow: 0px 5px 10px rgba(40, 120, 80, 0.5)">
                                <div class="card-body" style="text-align: left;">
                                    <h3 class="card-title">Simulados Antigos - UERJ</h3>
                                    <p class="card-text" style="font-size: 17px;">Simulados Antigos Elaborados pelos Professores do Colégio Pedro
                                        II
                                    </p>
                                    <a id="btn2" href="../simulados_antigos/simulados_uerj.php" class="btn btn-primary">Ver Simulados UERJ</a>
                                    <svg style="position: relative; left: 48%; width: 60px; height: 60px; color: rgba(40, 120, 80, 1);"
                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-pencil" viewBox="0 0 16 16">
                                        <path
                                            d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card"
                                style="width: 100%; margin: 10px; box-shadow: 0px 5px 10px rgba(100, 100, 0, 0.5);">
                                <div class="card-body" style="text-align: left;">
                                    <h3 class="card-title">Simulados Antigos - ENEM</h3>
                                    <p class="card-text" style="font-size: 17px;">Simulados Antigos Elaborados pelos Professores do Colégio Pedro II
                                    </p>
                                    <a id="btn3" href="../simulados_antigos/simulados_enem.php" class="btn btn-primary">Ver Simulados ENEM</a>
                                    <svg style="position: relative; left: 48%; width: 60px; height: 60px; color: rgba(100, 100, 0, 1);"
                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </main>
    <script src="../../../assets/corretor/js/bootstrap/bootstrap.bundle.min.js"></script>
</body>

</html>