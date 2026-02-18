<?php
// Inicia a sessão para pegar a matrícula do aluno logado
session_start();

require_once '../../global/db.php';
require_once 'pdfUtils.php'; // Mantivemos apenas para usar a sanitização de nome




try {
    // 1. Verifica se o aluno está logado (ajuste 'id_matricula' para o nome exato da sua variável de sessão)
    if (!isset($_SESSION['matricula'])) {
        $_SESSION["mensagem"] = "Erro: Usuário não está logado (Faça o Logout e acesse o sistema novamente)";
        $_SESSION["tipo_msg"] = "erro";

        header("Location: ../../../pages/pages_aluno/enviar_redacao/enviar_redacao.php");
    }

    $matricula_aluno = $_SESSION['matricula']; // Pega da sessão

    // 2. Verifica se o arquivo foi enviado
    if (isset($_FILES["redacao_pdf"]) && $_FILES['redacao_pdf']['error'] === UPLOAD_ERR_OK) {

        $arquivoTmp = $_FILES["redacao_pdf"]["tmp_name"];
        $nomeOriginal = $_FILES["redacao_pdf"]["name"];
        $arquivo_tamanho = $_FILES["redacao_pdf"]["size"];
        $tema_redacao = $_POST["tema"] ?? null;

        if (!$tema_redacao) {
            $_SESSION["mensagem"] = "Erro: Tema da redação não informado";
            $_SESSION["tipo_msg"] = "erro";

            header("Location: ../../../pages/pages_aluno/enviar_redacao/enviar_redacao.php");
        }

        // Validações básicas
        $extensoes_permitidas = ['pdf'];
        $extensao = strtolower(pathinfo($nomeOriginal, PATHINFO_EXTENSION));

        if (!in_array($extensao, $extensoes_permitidas)) {
            $_SESSION["mensagem"] = "Erro: Apenas arquivos do formato .pdf são permitidos";
            $_SESSION["tipo_msg"] = "erro";

            header("Location: ../../../pages/pages_aluno/enviar_redacao/enviar_redacao.php");
        }

        if ($arquivo_tamanho > 5 * 1024 * 1024) { // 5MB
            $_SESSION["mensagem"] = "Erro: O Arquivo é muito grande (Máximo permitido: 5Mb)";
            $_SESSION["tipo_msg"] = "erro";

            header("Location: ../../../pages/pages_aluno/enviar_redacao/enviar_redacao.php");
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
                //Enviar a mensagem de sucesso (ou erro posteriormente) a partir de valores da SESSÃO, protegendo meus erros ( ao invés de expô-los na URL)
                $_SESSION["mensagem"] = "Redação Enviada com Sucesso!";
                $_SESSION["tipo_msg"] = "sucesso";

                header("Location: ../../../pages/pages_aluno/enviar_redacao/enviar_redacao.php");
            } else {
                unlink($caminhoCompletoFisico); // Apaga usando o caminho físico se der erro
                $_SESSION["mensagem"] = "Erro ao salvar no banco: " . $stmt->error;
                $_SESSION["tipo_msg"] = "erro";

                header("Location: ../../../pages/pages_aluno/enviar_redacao/enviar_redacao.php");
            }
            $stmt->close();

        } else {
                $_SESSION["mensagem"] = "Erro ao mover o arquivo";
                $_SESSION["tipo_msg"] = "erro";

                header("Location: ../../../pages/pages_aluno/enviar_redacao/enviar_redacao.php");
        }

    } else {
            $_SESSION["mensagem"] = "Nenhum arquivo enviado ou erro no upload";
            $_SESSION["tipo_msg"] = "erro";

            header("Location: ../../../pages/pages_aluno/enviar_redacao/enviar_redacao.php");
    }
} catch (Exception $e) {
    echo "Ocorreu um erro: " . $e->getMessage();
}
?>