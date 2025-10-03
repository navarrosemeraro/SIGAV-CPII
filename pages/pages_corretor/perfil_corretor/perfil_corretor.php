<?php 
require_once '../../../php/global/auth.php';
include '../../../php/global/db.php'; 
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../../assets/common/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../assets/corretor/css/pages/perfil_corretor/perfil_corretor.css">
    <link rel="icon" type="image/png" href="../../../assets/corretor/img/global/Brasão_Colégio_Pedro_II.png">
    <title>Perfil do Corretor</title>

</head>

<body>


    <div id="breadcrumb" style="border-bottom: 2px solid white;">
        <a href="../principal/principal.php" style="text-decoration: none; margin-bottom: 10px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
                <path
                    d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0m3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z" />
            </svg>
        </a>
        <h5 style="margin-left: 15px;"><a href="../area_corretor/area_corretor.php" style="font-size: 20px;">Retornar à Área do Corretor</a></h5>
    </div>


    <div class="profile-header">
        <img src="https://via.placeholder.com/80" alt="Foto de Perfil">
        <h2>
            <?php echo ($_SESSION["nome"]);?>
        </h2>
        <form action="../../../php/global/logout.php"><button type="submit">Logout</button></form>
    </div>

    <div class="content">
        <div class="left-panel">
            <div class="card">
                <h3>Detalhes do usuário</h3>
                <div class="info-value"><span class="info-label">Matrícula:</span> <?php echo ($_SESSION["matricula"]);?></div>
                <div class="info-value"><span class="info-label">Endereço de e-mail:</span><a
                        href="mailto:<?php echo strval($_SESSION["email"])?>"> <?php echo ($_SESSION["email"]);?></a> (Visível para os
                    admnistradores)</div>
                <div class="info-value"><span class="info-label">CPF:</span> <?php echo ($_SESSION["cpf"]);?></div>
                <div class="info-value"><span class="info-label">Dia de Hoje: </span><?php $agora = new DateTime(); echo $agora->format('d/m/Y'); ?></div>
            </div>

            <div class="card">
                <h3>Privacidade e Políticas</h3>
                <div class="info-value">Resumo de retenção de dados</div>
            </div>
        </div>

        <div class="right-panel">
            <div class="card">
                <h3>Histórico</h3>
                <div class="list-links">
                    <a href="#">Quantidade de Redações corrigidas</a>
                    <a href="#">Mensagens do fórum</a>
                    <a href="#">Discussões do fórum</a>
                    <a href="#">Planos de aprendizagem</a>
                </div>
            </div>

            <div class="card">
                <h3>Relatórios</h3>
                <div class="list-links">
                    <a href="#">Sessões do navegador</a>
                    <a href="#">Visão geral das notas</a>
                </div>
            </div>

            <div class="card">
                <h3>Atividade de login</h3>
                <div class="info-value"><strong>Primeiro acesso ao site</strong></div>
            </div>
        </div>
    </div>

</body>

</html>