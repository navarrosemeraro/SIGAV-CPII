<?php
require_once 'vendor/autoload.php';

use setasign\Fpdi\Fpdi;

if(isset($_FILES["redacao_pdf"]) && $_FILES['redacao_pdf']['error'] === UPLOAD_ERR_OK) {

    $arquivoTmp = $_FILES["redacao_pdf"]["tmp_name"]; // Esse será passado ao FPDI
    $nomeOriginal = $_FILES["redacao_pdf"]["name"];

    // Extensões permitidas
    $extensoes_permitidas = ['pdf'];

    // Pega a extensão do arquivo
    $extensao = strtolower(pathinfo($arquivo, PATHINFO_EXTENSION));

    // Valida extensão
    if (!in_array($extensao, $extensoes_permitidas)) {
        die("Erro: formato de imagem não permitido.");
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

        $nomeArquivo = "../../../assets/uploads/pdfs_outputs/". $nomeOriginal. "_Pag" . $i . ".pdf";
        $novoPdf->Output($nomeArquivo, "F"); // "F" salva no disco
        echo "Gerado: $nomeArquivo\n";
    }
}
else{
    echo "Nenhum arquivo enviado ou erro no upload";
}
?>