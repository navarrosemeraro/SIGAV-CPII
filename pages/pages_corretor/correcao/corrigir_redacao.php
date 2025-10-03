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
    <link rel="stylesheet" href="../../../assets/corretor/css/pages/corrigir_redacoes/corrigir_redacao.css">
    <link rel="icon" type="image/png" href="../../../assets/corretor/img/global/Brasão_Colégio_Pedro_II.png">
    <title>Corrigir Redação</title>
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
                            <a class="nav-link active" aria-current="page"
                                href="../area_corretor/area_corretor.php">Área do Corretor</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page"
                                href="../sobre/sobre.php">Sobre o Projeto</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../suporte/suporte.php">Suporte</a>
                        </li>
                    </ul>
                <a style="margin-right: 20px; margin-top: 0; color:rgba(0, 0, 0, 1)"><?php echo ($_SESSION["nome"] . " (" . $_SESSION["nivel_acesso"] . ")");?></a>
            </div>
        </div>
    </nav>
    </section><br>
    <section id="dois">
        <div id="center">
            <h2 class="display-2 text-center">Corrigir Redação</h2>
        </div><br><br>
        <div class="container d-flex flex-column flex-md-row justify-content-between align-items-start gap-4"
            id="div-correcao">
            <div id="resultado_consulta" class="w-100 w-md-auto" style="flex: 2;">
                <!-- Imagem da redação com o caminho do arquivo a ser passado via POST -->
                <h2 id="tema_redacao_txt"></h2>
                <h4 id="nome_autor_txt"></h4>
                <iframe id="redacao_img" 
                src="<?php
                        $id = $_GET['id']; 
                        $stmt = $conn->prepare("SELECT caminho_arquivo FROM redacao WHERE id = ?");
                        $stmt->bind_param("i", $id);
                        $stmt->execute();
                        $result_caminho = $stmt->get_result();
                        $row = $result_caminho->fetch_assoc();
                        $base_url = "/sigav-cpii/";
                        echo $base_url . $row['caminho_arquivo']; ?>" 
                alt="foto-redacao" style="width:100%; height:1000px; border-radius: 10px flex: 2; border: 5px solid black; border-radius:10px;"></iframe>
            </div><br>
            <form action="../../../php/corretor/correcao/enviar_redacao_corrigida.php" method="POST" class="w-100 w-md-auto" style="flex: 1;">
                <fieldset class="border border-2 p-4 w-100">
                    <div style="display: flex; gap: 200px; align-items:last baseline; justify-content: center;">
                        <div class="container text-center">
                            <div class="row">
                                <div class="col divs_comp" id="div_comp1">
                                    <label><b>Competência 1:</b></label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="c1" id="c1_00" value="0">
                                        <label class="form-check-label" for="c1_0">0</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="c1" id="c1_40" value="40">
                                        <label class="form-check-label" for="c1_40">40</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="c1" id="c1_80" value="80">
                                        <label class="form-check-label" for="c1_80">80</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="c1" id="c1_120" value="120">
                                        <label class="form-check-label" for="c1_120">120</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="c1" id="c1_160" value="160">
                                        <label class="form-check-label" for="c1_160">160</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="c1" id="c1_200" value="200">
                                        <label class="form-check-label" for="c1_200">200</label>
                                    </div>
                                    <textarea class="form-control" name="comentario_corretor" id="com_c1" rows="6"
                                    placeholder="Espaço para os Descritores" style="margin-top: 10px; resize: none;" disabled></textarea>
                                </div>
                            </div>
                            <br><br>
                            <div class="row">
                                <div class="col divs_comp" id="div_comp2">
                                    <label><b>Competência 2:</b></label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="c2" id="c2_00" value="0">
                                        <label class="form-check-label" for="c2_0">0</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="c2" id="c2_40" value="40">
                                        <label class="form-check-label" for="c2_40">40</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="c2" id="c2_80" value="80">
                                        <label class="form-check-label" for="c2_80">80</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="c2" id="c2_120" value="120">
                                        <label class="form-check-label" for="c2_120">120</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="c2" id="c2_160" value="160">
                                        <label class="form-check-label" for="c2_160">160</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="c2" id="c2_200" value="200">
                                        <label class="form-check-label" for="c2_200">200</label>
                                    </div>
                                    <textarea class="form-control" name="comentario_corretor" id="com_c2" rows="6"
                                    placeholder="Espaço para os Descritores" style="margin-top: 10px; resize: none;" disabled></textarea>
                                </div>
                            </div>
                            <br><br>
                            <div class="row">
                                <div class="col divs_comp" id="div_comp3">
                                    <label><b>Competência 3:</b></label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="c3" id="c3_00" value="0">
                                        <label class="form-check-label" for="c3_0">0</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="c3" id="c3_40" value="40">
                                        <label class="form-check-label" for="c3_40">40</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="c3" id="c3_80" value="80">
                                        <label class="form-check-label" for="c3_80">80</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="c3" id="c3_120" value="120">
                                        <label class="form-check-label" for="c3_120">120</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="c3" id="c3_160" value="160">
                                        <label class="form-check-label" for="c3_160">160</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="c3" id="c3_200" value="200">
                                        <label class="form-check-label" for="c3_200">200</label>
                                    </div>
                                    <textarea class="form-control" name="comentario_corretor" id="com_c3" rows="6"
                                    placeholder="Espaço para os Descritores" style="margin-top: 10px; resize: none;" disabled></textarea>
                                </div>
                            </div>
                            <br><br>
                            <div class="row">
                                <div class="col divs_comp" id="div_comp4">
                                    <label><b>Competência 4:</b></label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="c4" id="c4_00" value="0">
                                        <label class="form-check-label" for="c4_0">0</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="c4" id="c4_40" value="40">
                                        <label class="form-check-label" for="c4_40">40</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="c4" id="c4_80" value="80">
                                        <label class="form-check-label" for="c4_80">80</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="c4" id="c4_120" value="120">
                                        <label class="form-check-label" for="c4_120">120</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="c4" id="c4_160" value="160">
                                        <label class="form-check-label" for="c4_160">160</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="c4" id="c4_200" value="200">
                                        <label class="form-check-label" for="c4_200">200</label>
                                    </div>
                                    <textarea class="form-control" name="comentario_corretor" id="com_c4" rows="6"
                                    placeholder="Espaço para os Descritores" style="margin-top: 10px; resize: none;" disabled></textarea>
                                </div>
                            </div>
                            <br><br>
                            <div class="row">
                                <div class="col divs_comp" id="div_comp5">
                                    <label><b>Competência 5:</b></label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="c5" id="c5_00" value="0">
                                        <label class="form-check-label" for="c5_0">0</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="c5" id="c5_40" value="40">
                                        <label class="form-check-label" for="c5_40">40</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="c5" id="c5_80" value="80">
                                        <label class="form-check-label" for="c5_80">80</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="c5" id="c5_120" value="120">
                                        <label class="form-check-label" for="c5_120">120</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="c5" id="c5_160" value="160">
                                        <label class="form-check-label" for="c5_160">160</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="c5" id="c5_200" value="200">
                                        <label class="form-check-label" for="c5_200">200</label>
                                    </div>
                                    <textarea class="form-control" name="comentario_corretor" id="com_c5" rows="6"
                                    placeholder="Espaço para os Descritores" style="margin-top: 10px; resize: none;" disabled></textarea>
                                </div>
                            </div><br>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <label for="nota_tot" class="form-label" style="margin: 0;"><b>Total:</b></label>
                                <input type="text" class="form-control w-100" name="nota_redacao" id="nota_redacao"
                                 readonly required>
                            </div><br>
                            <div class="row" style="text-align: left;">
                                <label for="comentario_corretor"><b>Comentários:</b></label>
                                <textarea class="form-control" name="comentario_corretor" id="comentario_corretor" rows="6"
                                    placeholder="Deixe um comentário adicional sobre a redação..."></textarea>
                            </div><br>
                            <div class="row mt-4">
                                <button type="submit" class="btn btn-outline-primary w-100"
                                    style="background-color: #0074FF; color: white;" id="btn_envio">Enviar</button>
                            </div>
                        </div>
                    </div>
        </div>
        <!-- Armazena o SRC da imagem da redação, que é o caminho para o arquivo e identicador no banco de dados-->
        <input type="hidden" name="id_redacao" id="id_redacao">
        </fieldset>
        </form>
        </div>
    </section>

    <script src="../../../assets/corretor/js/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="../../../assets/corretor/js/pages/corrigir_redacao/calcula_nota.js"></script>
    <script src="../../../assets/corretor/js/pages/corrigir_redacao/textos_comps.js"></script>
    <script>
        // passa o src da imagem para o input escondido caminho_arquivo, a fim de passar o id da redação para "enviar_redacao_corrigida" 
        let id_redacao = <?= $_GET["id"] ?>;
        document.getElementById("id_redacao").value = id_redacao;

        // pega o nome do autor pelo método get e mostra na tela
        let nome_autor = "<?= $_GET['nome_autor']?>";
        document.getElementById("nome_autor_txt").innerText = nome_autor;

        // pega o tema da redacao pelo método get e mostra na tela
        let tema_redacao = "<?= $_GET['tema']?>";
        document.getElementById("tema_redacao_txt").innerText = tema_redacao;

    </script>
</body>

</html>