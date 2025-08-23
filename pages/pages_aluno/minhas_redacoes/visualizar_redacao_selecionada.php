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
    <link rel="stylesheet" href="../../../assets/aluno/css/pages/visualiza_redacao/visualiza_redacao.css">
    <link rel="icon" type="image/png" href="../../../assets/aluno/img/global/Brasão_Colégio_Pedro_II.png" />
    <title>Cadastro de Corretores</title>
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
                        <a class="nav-link active" aria-current="page" href="../principal/principal.php">Principal</a>
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
                            <li><a class="dropdown-item" href="../simulados_antigos/simulados_enem.html">ENEM e
                                    Gabaritos</a></li>
                            <li><a class="dropdown-item" href="../simulados_antigos/simulados_uerj.html">UERJ e
                                    Gabaritos</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../suporte/suporte.html">Suporte</a>
                    </li>
                </ul>
                <p style="margin-right: 20px; margin-top: 16px; color:rgba(0, 0, 0, 0.3); font-size: 18px;">Minhas
                    Redações</p>
            </div>
        </div>
    </nav>

    <h1 id="center" class="display-5 text-center" style="margin: 20px;">Minhas Redações</h1><br>

    <section id="um" class="container">
        <div class="container d-flex flex-column flex-md-row justify-content-between align-items-start gap-4"
            id="div-correcao">
            <div id="resultado_consulta" class="w-100 w-md-auto" style="flex: 2;">
                <!-- Imagem da redação com o caminho do arquivo a ser passado via POST -->
                <h2 id="tema_redacao_txt"></h2>
                <h4 id="nome_autor_txt"></h4>
                <img id="redacao_img" 
                src="<?php
                        $id = $_GET['id']; 
                        $stmt = $conn->prepare("SELECT nota_total, nota_comp1, nota_comp2, nota_comp3, nota_comp4, nota_comp5, observacoes, caminho_arquivo FROM redacao WHERE id = ?");
                        $stmt->bind_param("i", $id);
                        $stmt->execute();
                        $result_caminho = $stmt->get_result();
                        $row = $result_caminho->fetch_assoc();
                        $base_url = "/sigav-cpii/";
                        echo $base_url . $row['caminho_arquivo']; ?>" 
                alt="foto-redacao" style="width:100%; height:100%; border-radius: 10px flex: 2; border: 5px solid black; border-radius:10px;">
            </div><br>
            <div class="w-100 w-md-auto" style="flex: 1;">
                <fieldset class="border border-2 p-4 w-100">
                    <div style="display: flex; gap: 200px; align-items:last baseline; justify-content: center;">
                        <div class="container text-center">
                            <div class="row">
                                <div class="col" style="border: 1px rgba(0, 0, 0, 0.3) solid; padding: 0;">
                                    <label><b>Competência 1: <?php echo $row["nota_comp1"]; ?></b></label><br>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col" style="border: 1px rgba(0, 0, 0, 0.3) solid; padding: 0;">
                                    <label><b>Competência 2: <?php echo $row["nota_comp2"]; ?></b></label><br>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col" style="border: 1px rgba(0, 0, 0, 0.3) solid; padding: 0;">
                                    <label><b>Competência 3: <?php echo $row["nota_comp3"]; ?></b></label><br>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col" style="border: 1px rgba(0, 0, 0, 0.3) solid; padding: 0;">
                                    <label><b>Competência 4: <?php echo $row["nota_comp4"]; ?></b></label><br>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col" style="border: 1px rgba(0, 0, 0, 0.3) solid; padding: 0;">
                                    <label><b>Competência 5: <?php echo $row["nota_comp5"]; ?></b></label><br>
                                </div>
                            </div><br>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <label for="nota_tot" class="form-label" style="margin: 0;"><b>Total:</b></label>
                                <input type="text" class="form-control w-100" name="nota_redacao" id="nota_redacao"
                                 readonly value="<?php echo $row["nota_total"]; ?>">
                            </div><br>
                            <div class="row" style="text-align: left;">
                                <label for="comentario_corretor"><b>Comentários:</b></label>
                                <textarea class="form-control" name="comentario_corretor" id="comentario_corretor" rows="6" readonly><?php echo $row["observacoes"] ?? "Nenhum Comentário..."; ?></textarea>
                            </div><br>
                        </div>
                    </div>
            </div>
        </div>

    </section>

    <script src="../../../assets/corretor/js/bootstrap/bootstrap.bundle.min.js"></script>
    <script>
        // pega o nome do autor pelo método get e mostra na tela
        let nome_autor = "<?= $_GET['nome_autor']?>";
        document.getElementById("nome_autor_txt").innerText = nome_autor;

        // pega o tema da redacao pelo método get e mostra na tela
        let tema_redacao = "<?= $_GET['tema']?>";
        document.getElementById("tema_redacao_txt").innerText = tema_redacao;

    </script>
</body>

</html>
?>