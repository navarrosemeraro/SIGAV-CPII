<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../assets/common/bootstrap/bootstrap.min.css">
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
                            <li><a class="dropdown-item" href="../../pages_corretor/consulta/banco_redacoes.php">Banco de Redações</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../pages_corretor/suporte/suporte.php">Suporte</a>
                    </li>
                </ul>
                <a style="margin-right: 20px; margin-top: 0; color:rgba(0, 0, 0, 1)"><?php session_start(); echo ($_SESSION["nome"] . " (" . $_SESSION["nivel_acesso"] . ")");?></a>
            </div>
        </div>
    </nav>
    </section><br>
    <section id="dois">
        <div id="center">
            <h2 class="display-2 text-center">Selecione a Redação</h2>
        </div><br>
        <div class="container">
            <div id="resultado_consulta"></div>
            <select name="arquivo" id="arquivo" class="form-control"></select>
        </div>
    </section>

    <script src="../../../assets/corretor/js/bootstrap/bootstrap.bundle.min.js"></script>
</body>

</html>