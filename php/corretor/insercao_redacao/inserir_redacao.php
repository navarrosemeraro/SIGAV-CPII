<?php
require_once '../../../vendor/autoload.php';
require_once '../../global/db.php';
require_once 'pdfUtils.php';

use setasign\Fpdi\Fpdi;
use Fpdf\Fpdf;
use Smalot\PdfParser\Parser;

try {
    if (isset($_FILES["redacao_pdf"]) && $_FILES['redacao_pdf']['error'] === UPLOAD_ERR_OK) {

        $arquivoTmp = $_FILES["redacao_pdf"]["tmp_name"]; // Esse será passado ao FPDI
        $nomeOriginal = $_FILES["redacao_pdf"]["name"];
        $arquivo_tamanho = $_FILES["redacao_pdf"]["size"];
        $tema_redacao = $_POST["tema"];

        // Extensões permitidas
        $extensoes_permitidas = ['pdf'];

        // Pega a extensão do arquivo
        $extensao = strtolower(pathinfo($nomeOriginal, PATHINFO_EXTENSION));

        // Valida extensão
        if (!in_array($extensao, $extensoes_permitidas)) {
            die("Erro: formato de arquivo não permitido.");
        }

        // Valida tamanho (ex: até 5MB)
        if ($arquivo_tamanho > 5 * 1024 * 1024) {
            die("Erro: arquivo muito grande.");
        }

        // Sanitizando o nome do arquivo
        $nomeSeguro = pdfUtils::sanitizarNomeArquivo($nomeOriginal);

        // Verifica se a pasta existe e tem permissão de escrita
        $pastaDestino = "../../../assets/uploads/pdfs_outputs";
        if (!is_dir($pastaDestino)) {
            mkdir($pastaDestino, 0777, true); // cria recursivamente com permissão total
        }

        // Descobrir quantas páginas tem o PDF
        $pdfTemp = new Fpdi();
        $paginas = $pdfTemp->setSourceFile($arquivoTmp);

        // Loop para criar um PDF para cada página
        for ($i = 1; $i <= $paginas; $i++) {
            $novoPdf = new Fpdi();
            $novoPdf->AddPage();

            // Cada instância deve importar a página diretamente do arquivo original
            $novoPdf->setSourceFile($arquivoTmp);
            $template = $novoPdf->importPage($i);
            $novoPdf->useTemplate($template);

            $nomeArquivo = $pastaDestino . "/" . $nomeSeguro . "_Pag" . $i . ".pdf";
            $novoPdf->Output($nomeArquivo, "F");

            // Extrair texto do PDF individualizado
            $parser = new Parser();
            $pdfParser = $parser->parseFile($nomeArquivo);
            $texto = $pdfParser->getText();

            // Extrair matrícula
            $matricula_aluno = pdfUtils::extrairMatricula($texto);
            if ($matricula_aluno == null) {
                $mensagens[] = strval("Matrícula não encontrada na página ". $i);
                continue; // pula para a próxima página
            }
            $matricula_aluno = trim($matricula_aluno);
            $matricula_aluno = strval($matricula_aluno);

            $mensagens[] = "Gerado: $nomeArquivo, matrícula: " . $matricula_aluno;

            //verifica se existe a determinada matricula encontrada existe no banco de dados
            $stmt = $conn->prepare("SELECT 1 FROM alunos WHERE id_matricula = ?");
            $stmt->bind_param("s", $matricula_aluno);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $stmt_inserir = $conn->prepare("INSERT INTO redacao (aluno_id, tema, status_red, caminho_arquivo)
                                            VALUES (?, ?, 'pendente', ?)");
                $stmt_inserir->bind_param("sss", $matricula_aluno, $tema_redacao, $nomeArquivo);
                $stmt_inserir->execute();
                $stmt_inserir->close();

            } else {
                $mensagens[] = "Matrícula $matricula_aluno da pag $i não encontrada em alunos";
            }
            unset($novoPdf, $pdfParser);
        }

        echo implode("<br>", $mensagens);
    } else {
        echo "Nenhum arquivo enviado ou erro no upload";
    }
} catch (Exception $e) {
    echo "Ocorreu um erro: " . $e->getMessage();
}
?>
