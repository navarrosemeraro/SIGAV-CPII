<?php
require_once 'vendor/autoload.php';
require_once '../global/db.php';
require_once 'pdfUtils.php';

use setasign\Fpdi\Fpdi;
use Smalot\PdfParser\Parser;

try{
if(isset($_FILES["redacao_pdf"]) && $_FILES['redacao_pdf']['error'] === UPLOAD_ERR_OK) {

    $arquivoTmp = $_FILES["redacao_pdf"]["tmp_name"]; // Esse será passado ao FPDI
    $nomeOriginal = $_FILES["redacao_pdf"]["name"];
    $arquivo_tamanho = $_FILES["redacao_pdf"]["size"];

    // Extensões permitidas
    $extensoes_permitidas = ['pdf'];

    // Pega a extensão do arquivo
    $extensao = strtolower(pathinfo($nomeOriginal, PATHINFO_EXTENSION));

    // Valida extensão
    if (!in_array($extensao, $extensoes_permitidas)) {
        die("Erro: formato de imagem não permitido.");
    }

    // Valida tamanho (ex: até 5MB)
        if ($arquivo_tamanho > 5 * 1024 * 1024) {
            die("Erro: arquivo muito grande.");
        }

    // Sanitizando o nome do arquivo para um seguro ao sistema
    $nomeSeguro = pdfUtils::sanitizarNomeArquivo($nomeOriginal);

    //verifica se a pasta existe e tem permissão de escrita
    $pastaDestino = "../../../assets/uploads/pdfs_outputs";
    if (!is_dir($pastaDestino)) {
        //se algum dos dois requisitos não forem atendidos, se providencia as permissões
        mkdir($pastaDestino, 0777, true); // cria recursivamente com permissão total
    }

    // Descobrir quantas páginas tem o PDF
    $pdf = new Fpdi();
    $paginas = $pdf->setSourceFile($arquivoTmp);

    // Loop para criar um PDF para cada página
    for ($i = 1; $i <= $paginas; $i++) {
        $novoPdf = new Fpdi();
        $novoPdf->AddPage();

        $template = $novoPdf->importPage($i);
        $novoPdf->useTemplate($template);

        $nomeArquivo = "../../../assets/uploads/pdfs_outputs/". $nomeSeguro. "_Pag" . $i . ".pdf";
        $novoPdf->Output($nomeArquivo, "F"); // "F" salva no disco
        
        // Extrair texto do PDF individualizado
        $parser = new Parser();
        $pdfParser = $parser->parseFile($nomeArquivo); // sempre pegar o caminho do arquivo, não o objeto FPDI
        $texto = $pdfParser->getText();

        //Extrair matricula do texto do PDF individualizado
        $matricula_aluno = pdfUtils::extrairMatricula($texto);
        if($matricula_aluno == null){
            die("Matrícula não encontrada");
        }
        $matricula_aluno = intval($matricula_aluno);

        $mensagens[] = "Gerado: $nomeArquivo, matrícula:". strval($matricula_aluno). "\n";

        $stmt_inserir = $conn->prepare("INSERT INTO redacao (aluno_id, status_red, caminho_arquivo)
                                        VALUES (?, 'pendente', ?)");
        $stmt_inserir->bind_param("is", $matricula_aluno, $nomeArquivo);
        $stmt_inserir->execute();
        $stmt_inserir->close();
        
        unset($novoPdf, $pdfParser);
    }
    echo implode("<br>", $mensagens);
}
else{
    echo "Nenhum arquivo enviado ou erro no upload";
}
}
catch (Exception $e){
    echo "Ocorreu um erro: " . $e->getMessage();
}
?>