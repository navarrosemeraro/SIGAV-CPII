<?php
    require_once '../../../php/global/auth.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../../assets/common/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../assets/aluno/css/pages/perfil_aluno/perfil_aluno.css">
    <link rel="icon" type="image/png" href="../../../assets/corretor/img/global/Brasão_Colégio_Pedro_II.png">
    <title>Perfil do Usuário - Colégio Pedro II</title>

</head>

<body>
    <section id="um">
    <div style="display: flex; align-items: center; width: 100%; height: 100%; Top: 50%">
        <div class="container" id="profile">
            <div id="foto">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-person-circle" viewBox="0 0 16 16" style="height:70px; width:70px; margin-right: 10px">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                    <path fill-rule="evenodd"
                        d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                </svg>
            </div>
            <p style="display: flex; justify-content: center;" id="txt_nome"></p>
            <div class="container text-center">
                <div class="row">
                    <div class="col">
                        <label for="txt_mat" class="form-label"><b>Matrícula</b></label><br>
                        <input type="text" name="dados_aluno" id="txt_mat" class="form-control" readonly>
                        <br>
                        <label for="txt_email" class="form-label"><b>Email:</b></label><br>
                        <input type="text" name="dados_aluno" id="txt_email" class="form-control" readonly>
                        <br>
                        <label for="txt_turma" class="form-label"><b>Turma</b></label><br>
                        <input type="text" name="dados_aluno" id="txt_turma" class="form-control" readonly>
                    </div>
                    <div class="col">
                        <label for="txt_cpf" class="form-label"><b>CPF</b></label><br>
                        <input type="text" name="dados_aluno" id="txt_cpf" class="form-control" readonly>
                        <br>
                        <label for="txt_turno" class="form-label"><b>Turno</b></label><br>
                        <input type="text" name="dados_aluno" id="txt_turno" class="form-control" readonly>
                        <br>
                        <label for="txt_idioma" class="form-label"><b>Idioma</b></label><br>
                        <input type="text" name="dados_aluno" id="txt_idioma" class="form-control" readonly>
                    </div>
                </div>
            </div>
            <div id="link-retorno">
                <a href="../principal/principal.php">
                    <svg style="text-decoration:none; color: #143c2c;" xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                        class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16" style="margin-bottom: 9px;">
                        <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0m3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z" />
                    </svg>
                </a>
                <h5 style="margin-left: 15px;"><a href="../principal/principal.php" style=" text-decoration:none; color:#143c2c;">Retornar à página Principal</a></h5>
            </div>
        </div>
    </div>
    </section>
</body>
<script>
    const dadosSessao = <?= json_encode($_SESSION); ?>;

    document.getElementById("txt_nome").innerHTML = dadosSessao.nome;
    document.getElementById("txt_mat").value = dadosSessao.matricula;
    document.getElementById("txt_email").value = dadosSessao.email;
    document.getElementById("txt_turma").value = dadosSessao.turma;
    document.getElementById("txt_cpf").value = dadosSessao.cpf;
    document.getElementById("txt_turno").value = dadosSessao.turno;
    document.getElementById("txt_idioma").value = dadosSessao.idioma;

</script>

</html>