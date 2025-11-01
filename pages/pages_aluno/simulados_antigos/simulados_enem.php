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
  <title>Simulados ENEM</title>
</head>

<body>
  <section id="um">
    <nav class="navbar navbar-expand-lg">
      <div class="container-fluid">
        <a class="navbar-brand" href="#" style="margin-left: 10px;">SIGAV CPII<span><img
              src="../../../assets/aluno/img/global/Brasão_Colégio_Pedro_II.png" alt="Brasão Colégio PedroII"
              style="position: relative; margin-left: 30px;"></span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
          <div class="dropdown">
                        <button style="background-color: white;" class="btn btn-secondary" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
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
  </section>
  <main>
    <section id="dois" class="container">
      <h1 id="center" class="display-5 text-center" style="margin: 20px;">Simulados ENEM</h1>

      <div class="accordion" id="accordionPanelsStayOpenExample">
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button" type="button" data-bs-toggle="collapse"
              data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
              aria-controls="panelsStayOpen-collapseOne">
              2025
            </button>
          </h2>
          <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse">
            <div class="accordion-body">
              <div class="container text-center">
                <div class="row">
                  <div class="col">
                    <p style="opacity: 0.5;">1º Simulado</p>
                    <a target="_blank"
                      href="../../../assets/aluno/pdf/simulados_cp2/ENEM/2025/SIMULADO ENEM 25 DIA 1.pdf">
                      <p>Dia 01 (12/07)</p>
                    </a>
                    <a target="_blank"
                      href="../../../assets/aluno/pdf/simulados_cp2/ENEM/2025/GABARITO-DO-SIMULADO-ENEM-DIA-01.pdf">
                      <p>Gabarito Dia 01</p>
                    </a>
                    <a target="_blank"
                      href="../../../assets/aluno/pdf/simulados_cp2/ENEM/2025/SIMULADO ENEM 25 DIA 2.pdf">
                      <p>Dia 02 (19/07)</p>
                    </a>
                    <a target="_blank"
                      href="../../../assets/aluno/pdf/simulados_cp2/ENEM/2025/GABARITO-DO-SIMULADO-ENEM 2025 DIA-02.pdf">
                      <p>Gabarito Dia 02</p>
                    </a>
                  </div>
                  <div class="col">
                    <p style="opacity: 0.5;">2º Simulado</p>
                    <a target="_blank" href="#">
                      <p>Dia 01 (12/07)</p>
                    </a>
                    <a target="_blank" href="#">
                      <p>Gabarito Dia 01</p>
                    </a>
                    <a target="_blank" href="#">
                      <p>Dia 02 (19/07)</p>
                    </a>
                    <a target="_blank" href="#">
                      <p>Gabarito Dia 02</p>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
              data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
              aria-controls="panelsStayOpen-collapseTwo">
              2024
            </button>
          </h2>
          <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
            <div class="accordion-body">
              <p style="opacity: 0.5;">1º Simulado</p>
              <a target="_blank"
                href="../../../assets/aluno/pdf/simulados_cp2/ENEM/2024/1 SIMULADO ENEM 2024 DIA 1.pdf">
                <p>Dia 01 (05/10)</p>
              </a>
              <a target="_blank"
                href="../../../assets/aluno/pdf/simulados_cp2/ENEM/2024/GABARITO-DO-1 -SIMULADO-ENEM 2024-DIA-01.pdf">
                <p>Gabarito Dia 01</p>
              </a>
              <a target="_blank"
                href="../../../assets/aluno/pdf/simulados_cp2/ENEM/2024/1 SIMULADO ENEM 2024 DIA 2.pdf">
                <p>Dia 02 (12/10)</p>
              </a>
              <a target="_blank"
                href="../../../assets/aluno/pdf/simulados_cp2/ENEM/2024/GABARITO-DO-1 SIMULADO-ENEM 2024-DIA-02.pdf">
                <p>Gabarito Dia 02</p>
              </a>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
              data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false"
              aria-controls="panelsStayOpen-collapseThree">
              2023
            </button>
          </h2>
          <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse">
            <div class="accordion-body">
                <div class="container text-center">
                  <div class="row">
                    <div class="col">
                      <p style="opacity: 0.5;">1º Simulado</p>
                      <a target="_blank"
                        href="../../../assets/aluno/pdf/simulados_cp2/ENEM/2023/1º SIMULADO ENEM 23 DIA 1.pdf">
                        <p>Dia 01 (03/07)</p>
                      </a>
                      <a target="_blank"
                        href="../../../assets/aluno/pdf/simulados_cp2/ENEM/2023/GABARITO-DO 1 SIMULADO-ENEM-DIA-01.pdf">
                        <p>Gabarito Dia 01</p>
                      </a>
                      <a target="_blank"
                        href="../../../assets/aluno/pdf/simulados_cp2/ENEM/2023/1º SIMULADO ENEM 23 DIA 2.pdf">
                        <p>Dia 02 (08/07)</p>
                      </a>
                      <a target="_blank"
                        href="../../../assets/aluno/pdf/simulados_cp2/ENEM/2023/GABARITO-DO 1 SIMULADO-ENEM-DIA-02.pdf">
                        <p>Gabarito Dia 02</p>
                      </a>
                    </div>
                    <div class="col">
                      <p style="opacity: 0.5;">2º Simulado</p>
                      <a target="_blank"
                        href="../../../assets/aluno/pdf/simulados_cp2/ENEM/2023/2º SIMULADO ENEM 23 DIA 1.pdf">
                        <p>Dia 01 (09/10)</p>
                      </a>
                      <a target="_blank"
                        href="../../../assets/aluno/pdf/simulados_cp2/ENEM/2023/GABARITO DO 2 SIMULADO-ENEM-DIA-01.pdf">
                        <p>Gabarito Dia 01</p>
                      </a>
                      <a target="_blank"
                        href="../../../assets/aluno/pdf/simulados_cp2/ENEM/2023/2º SIMULADO ENEM 23 DIA 2.pdf">
                        <p>Dia 02 (18/10)</p>
                      </a>
                      <a target="_blank"
                        href="../../../assets/aluno/pdf/simulados_cp2/ENEM/2023/GABARITO DO 2 SIMULADO ENEM-DIA-02.pdf">
                        <p>Gabarito Dia 02</p>
                      </a>
                    </div>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>

    </section>
  </main>
  <script src="../../../assets/corretor/js/bootstrap/bootstrap.bundle.min.js"></script>
  <script src="../../../assets/aluno/js/pages/simulados_enem/dropdowns_enem.js"></script>
</body>

</html>