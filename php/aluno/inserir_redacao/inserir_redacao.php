<?php
// Inicia a sessão para pegar a matrícula do aluno logado
session_start();

require_once '../../global/db.php';
require_once 'pdfUtils.php'; // Mantivemos apenas para usar a sanitização de nome

try {
    // 1. Verifica se o aluno está logado (ajuste 'id_matricula' para o nome exato da sua variável de sessão)
    if (!isset($_SESSION['id_matricula'])) {
        die("Erro: Usuário não está logado.");
    }

    $matricula_aluno = $_SESSION['id_matricula']; // Pega da sessão

    // 2. Verifica se o arquivo foi enviado
    if (isset($_FILES["redacao_pdf"]) && $_FILES['redacao_pdf']['error'] === UPLOAD_ERR_OK) {

        $arquivoTmp = $_FILES["redacao_pdf"]["tmp_name"];
        $nomeOriginal = $_FILES["redacao_pdf"]["name"];
        $arquivo_tamanho = $_FILES["redacao_pdf"]["size"];
        $tema_redacao = $_POST["tema"] ?? null;

        if (!$tema_redacao) {
            die("Erro: Tema não informado.");
        }

        // Validações básicas
        $extensoes_permitidas = ['pdf'];
        $extensao = strtolower(pathinfo($nomeOriginal, PATHINFO_EXTENSION));

        if (!in_array($extensao, $extensoes_permitidas)) {
            die("Erro: Apenas arquivos PDF são permitidos.");
        }

        if ($arquivo_tamanho > 5 * 1024 * 1024) { // 5MB
            die("Erro: O arquivo é muito grande (Máx: 5MB).");
        }

        // 3. Prepara o destino
        $pastaDestino = "../../../assets/uploads/pdfs_outputs";
        if (!is_dir($pastaDestino)) {
            mkdir($pastaDestino, 0777, true);
        }

        // Gera um nome seguro e único para evitar substituição de arquivos
        $nomeSeguro = pdfUtils::sanitizarNomeArquivo($nomeOriginal);
        // Exemplo de nome final: 2025001_tema_timestamp.pdf (opcional, mas recomendado)
        $nomeArquivoFinal = $matricula_aluno . "_" . time() . "_" . $nomeSeguro;
        $caminhoCompleto = $pastaDestino . "/" . $nomeArquivoFinal;

        // 4. Move o arquivo (Upload propriamente dito)
        if (move_uploaded_file($arquivoTmp, $caminhoCompleto)) {

            // 5. Insere no Banco de Dados
            // Nota: O status entra como 'pendente' e a data de envio é automática se sua tabela tiver timestamp
            $stmt = $conn->prepare("INSERT INTO redacao (aluno_id, tema, status_red, caminho_arquivo) VALUES (?, ?, 'pendente', ?)");
            
            // 's' = string. Se aluno_id for int no banco, mude o primeiro 's' para 'i'
            $stmt->bind_param("sss", $matricula_aluno, $tema_redacao, $caminhoCompleto);

            if ($stmt->execute()) {
                echo "Sucesso: Redação enviada corretamente.";
            } else {
                // Se der erro no banco, apaga o arquivo para não ficar lixo no servidor
                unlink($caminhoCompleto);
                echo "Erro ao salvar no banco de dados: " . $stmt->error;
            }
            $stmt->close();

        } else {
            echo "Erro ao mover o arquivo para a pasta de destino.";
        }

    } else {
        echo "Nenhum arquivo enviado ou erro no upload.";
    }
} catch (Exception $e) {
    echo "Ocorreu um erro: " . $e->getMessage();
}
?>