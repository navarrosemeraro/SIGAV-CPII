<?php
// Inicia a sessão para pegar a matrícula do aluno logado
session_start();

require_once '../../global/db.php';
require_once 'pdfUtils.php'; // Mantivemos apenas para usar a sanitização de nome




try {
    // 1. Verifica se o aluno está logado (ajuste 'id_matricula' para o nome exato da sua variável de sessão)
    if (!isset($_SESSION['matricula'])) {
        die("Erro: Usuário não está logado.");
    }

    $matricula_aluno = $_SESSION['matricula']; // Pega da sessão

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

       // Define o caminho WEB (como ele será salvo no banco e acessado pelo navegador)
        $caminhoWeb = "assets/uploads/pdfs_outputs"; 
        
        // Define o caminho FÍSICO (para o PHP saber onde gravar)
        // volta 3 níveis
        $pastaDestinoFisica = "../../../" . $caminhoWeb;

        // Cria a pasta física se não existir
        if (!is_dir($pastaDestinoFisica)) {
            mkdir($pastaDestinoFisica, 0777, true);
        }

        // Sanitiza nome
        $nomeSeguro = pdfUtils::sanitizarNomeArquivo($nomeOriginal);
        
        // Nome do arquivo (Matrícula + Timestamp + Nome)
        $nomeArquivo = $matricula_aluno . "_" . time() . "_" . $nomeSeguro;
        
        // Monta os dois caminhos finais
        $caminhoCompletoFisico = $pastaDestinoFisica . "/" . $nomeArquivo; // Para o move_uploaded_file
        $caminhoCompletoBanco  = $caminhoWeb . "/" . $nomeArquivo;         // Para o INSERT no banco

        // Move o arquivo usando o caminho FÍSICO
        if (move_uploaded_file($arquivoTmp, $caminhoCompletoFisico)) {
            
            // Insere no banco usando o caminho WEB (mais limpo)
            $stmt = $conn->prepare("INSERT INTO redacao (aluno_id, tema, status_red, caminho_arquivo) VALUES (?, ?, 'pendente', ?)");
            
            // Note que usamos $caminhoCompletoBanco aqui no final
            $stmt->bind_param("sss", $matricula_aluno, $tema_redacao, $caminhoCompletoBanco);

            if ($stmt->execute()) {
                echo "Sucesso: Redação enviada.";
            } else {
                unlink($caminhoCompletoFisico); // Apaga usando o caminho físico se der erro
                echo "Erro ao salvar no banco: " . $stmt->error;
            }
            $stmt->close();

        } else {
             echo "Erro ao mover o arquivo.";
        }

    } else {
        echo "Nenhum arquivo enviado ou erro no upload.";
    }
} catch (Exception $e) {
    echo "Ocorreu um erro: " . $e->getMessage();
}
?>