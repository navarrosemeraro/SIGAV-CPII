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
    <link rel="stylesheet" href="../../../assets/common/visualiza_redacao/visualiza_redacao.css">
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
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Redações
                        </a>
                        <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="../correcao/selecionar_redacao.php">Corrigir</a></li>
                                <li><hr class="dropdown-divider"></li>
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
                <p style="margin-right: 20px; margin-top: 16px; color:rgba(0, 0, 0, 0.3); font-size: 18px;">Minhas
                    Redações</p>
            </div>
        </div>
    </nav>


    <main style="margin-top: 50px;">
        <section id="um">
            <div id="nome-e-tema" class="container w-100 w-md-auto">
                <h2 id="tema_redacao_txt"></h2>
                <h4 id="nome_autor_txt"></h4>
            </div>


            <div class="container d-flex flex-column flex-md-row justify-content-between align-items-start gap-4"
                id="div-correcao">
                <div id="resultado_consulta" class="w-100 w-md-auto" style="flex: 2;">
                    <!-- Imagem da redação com o caminho do arquivo a ser passado via POST -->
                    <h2 id="tema_redacao_txt"></h2>
                    <h4 id="nome_autor_txt"></h4>
                    <img id="redacao_img" src="<?php
                        $id = $_GET['id']; 
                        $stmt = $conn->prepare("SELECT nota_total, nota_comp1, nota_comp2, nota_comp3, nota_comp4,
                        nota_comp5, observacoes, caminho_arquivo FROM redacao WHERE id=?"); $stmt->bind_param("i", $id);
                    $stmt->execute();
                    $result_caminho = $stmt->get_result();
                    $row = $result_caminho->fetch_assoc();
                    $base_url = "/sigav-cpii/";
                    echo $base_url . $row['caminho_arquivo']; ?>"
                    alt="foto-redacao" style="width:70%; height:100%; border-radius: 10px; margin-right:10px; border: 5px solid black;
                    border-radius:10px;">
                    <form action="../../../php/corretor/correcao/enviar_redacao_corrigida.php" method="POST"
                        class="w-100 w-md-auto" style="flex: 1;">
                        <fieldset class="border border-2 p-4 w-100">
                            <div style="display: flex; gap: 200px; align-items:last baseline; justify-content: center;">
                                <div class="container text-center">
                                    <div class="row">
                                       <div class="col d-flex flex-column flex-md-row gap-4" style="padding: 0; align-items:start;">
                                            <div style="float:left;">
                                                <div id="bolinha1" class="bolas_comp">C1</div>
                                                <label>Nota:</label><br>
                                                <label><?php echo $row["nota_comp1"]; ?></label>
                                            </div>
                                            <div style="float:right; width:100%;">
                                                <label style="font-size:16px; text-align:left;"><b>Demonstrar domínio da norma culta da língua portuguesa</b></label><br><br>
                                                <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" data-nota="<?= $row['nota_comp1']; ?>">
                                                    <div class="progress-bar" style="background-color: #3B82F6;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br><br>
                                    <div class="row">
                                        <div class="col d-flex flex-column flex-md-row gap-4" style="padding: 0; align-items:start;">
                                            <div style="float:left;">
                                                <div id="bolinha2" class="bolas_comp">C2</div>
                                                <label>Nota:</label><br>
                                                <label><?php echo $row["nota_comp2"]; ?></label>
                                            </div>
                                            <div style="float:right; width:100%;">
                                                <label style="font-size:16px; text-align:left;"><b>Compreender proposta e aplicar diferentes conhecimentos</b></label><br><br>
                                                <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" data-nota="<?= $row['nota_comp2']; ?>">
                                                    <div class="progress-bar" style="background-color: #10B981;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br><br>
                                    <div class="row">
                                        <div class="col d-flex flex-column flex-md-row gap-4" style="padding: 0; align-items:start;">
                                            <div style="float:left;">
                                                <div id="bolinha3" class="bolas_comp">C3</div>
                                                <label>Nota:</label><br>
                                                <label><?php echo $row["nota_comp3"]; ?></label>
                                            </div>
                                            <div style="float:right; width:100%;">
                                                <label style="font-size:16px; text-align:left;"><b>Organização e clareza da argumentação</b></label><br><br>
                                                <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" data-nota="<?= $row['nota_comp3']; ?>">
                                                    <div class="progress-bar" style="background-color: #8B5CF6;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br><br>
                                    <div class="row">
                                        <div class="col d-flex flex-column flex-md-row gap-4" style="padding: 0; align-items:start;">
                                            <div style="float:left;">
                                                <div id="bolinha4" class="bolas_comp">C4</div>
                                                <label>Nota:</label><br>
                                                <label><?php echo $row["nota_comp4"]; ?></label>
                                            </div>
                                            <div style="float:right; width:100%;">
                                                <label style="font-size:16px; text-align:left;"><b>Demonstrar conhecimento dos mecanismos linguísticos</b></label><br><br>
                                                <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" data-nota="<?= $row['nota_comp4']; ?>">
                                                    <div class="progress-bar" style="background-color: #F97316;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br><br>
                                    <div class="row">
                                        <div class="col d-flex flex-column flex-md-row gap-4" style="padding: 0; align-items:start;">
                                            <div style="float:left;">
                                                <div id="bolinha5" class="bolas_comp">C5</div>
                                                <label>Nota:</label><br>
                                                <label><?php echo $row["nota_comp5"]; ?></label>
                                            </div>
                                            <div style="float:right; width:100%;">
                                                <label style="font-size:16px; text-align:left;"><b>Proposta de solução para o problema abordado</b></label><br><br>
                                                <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" data-nota="<?= $row['nota_comp5']; ?>">
                                                    <div class="progress-bar" style="background-color: #EC4899;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br><br>
                                    <div class="row">
                                        <div class="col d-flex flex-column flex-md-row gap-4" style="padding: 0; align-items:start;">
                                            <div style="float:left;">
                                                <div id="div_nota">
                                                    <label>Nota Total: </label><br>
                                                    <label style="margin-left: 5px; padding:4px; border: 1px white solid"><?php echo $row["nota_total"]; ?></label>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

        </section>
        <br>
        <section id="dois">
        <div class="container-xxl d-flex flex-column" id="div-correcao2">
            <div class="w-100 w-md-auto" style="flex: 1;">
                <fieldset class="border border-2 p-4 w-100">
                    <div style="display: flex; gap: 200px; align-items:last baseline; justify-content: center;">
                        <div class="row" style="text-align: left;">
                            <label for="comentario_corretor" style="margin"><b>Comentários do Corretor(a):</b></label><br>
                            <textarea class="form-control" name="comentario_corretor" id="comentario_corretor" rows="6" cols="100" readonly>
                                <?php echo $row["observacoes"] ?? "Nenhum Comentário..."; ?>
                            </textarea>
                        </div><br>
                    </div>
            </div>
            </fieldset>
        </div>
        </div>
        </section>

    </main>

    <script src="../../../assets/corretor/js/bootstrap/bootstrap.bundle.min.js"></script>
    <script>
        // pega o nome do autor pelo método get e mostra na tela
        let nome_autor = "<?= $_GET['nome_autor']?>";
        document.getElementById("nome_autor_txt").innerText = "Autor: " + nome_autor;

        // pega o tema da redacao pelo método get e mostra na tela
        let tema_redacao = "<?= $_GET['tema']?>";
        document.getElementById("tema_redacao_txt").innerText = tema_redacao;

    </script>
    <script>
        // Define a nota máxima que uma competência pode ter
        const max = 200;

        // Seleciona todas as divs com a classe "progress" (containers das barras)
        document.querySelectorAll('.progress').forEach(container => {
    
        // Lê a nota que foi inserida no atributo "data-nota" pelo PHP
        let nota = container.getAttribute('data-nota');
    
        // Converte a nota em porcentagem em relação ao máximo (ex.: 150/200 = 75%)
        let percent = (nota / max) * 100;
    
        // Acessa a div interna ".progress-bar" e aplica a largura proporcional
        container.querySelector('.progress-bar').style.width = percent + "%";
});
    </script>
</body>

</html>
