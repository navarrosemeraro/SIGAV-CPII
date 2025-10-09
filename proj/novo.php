    <?php
    $raiz = $_SERVER['DOCUMENT_ROOT'];
    require $raiz.'../vendor/autoload.php';
    use thiagoalessio\TesseractOCR\TesseractOCR;

    ini_set('display_errors', 1); 
    ini_set('display_startup_errors', 1); 
    error_reporting(E_ALL);
    
        function convertePNG($arquivo){

            $xpdf = $_SERVER['DOCUMENT_ROOT'];
            $comando = $xpdf."/xpdf/bin64/pdftopng.exe -r 300 -gray " .$xpdf."/proj/".$arquivo. " pagina 2>NUL";
            exec($comando, $output, $return_var);
            if ($return_var === 0) {
                    echo "Conversão bem-sucedida!";

                } 
                else {
                    echo "\n Erro ao converter PDF. Saída: <pre>" . implode("\n", $output) . "</pre>";
                    echo $return_var;
                }
        }


        function extraiPDF($arquivo){

            $comando = "pdftk " . escapeshellarg($arquivo) . " burst" ;
            exec($comando, $output, $return_var);
            if ($return_var === 0) {
                    echo "Conversão bem-sucedida!";
                } 
                else {
                    echo "\n Erro ao converter PDF. Saída: <pre>" . implode("\n", $output) . "</pre>";
                    echo $return_var;
                }
        }


        function ocrImagem($arquivo){

            $text = (new TesseractOCR($arquivo))
                ->lang('eng') // Defina o idioma (ex: eng para inglês)
                ->executable('C:\Program Files\Tesseract-OCR\tesseract.exe')
                ->run();
            return $text;
        }

        function VerificaNumPag($arquivo)
        {
            $comando = "pdftk ". $arquivo . " dump_data | findstr NumberOfPages";
            exec($comando, $output, $return_var);
            return substr($output[0], 15, strlen($output[0])-15);
        }

        $arquivo_pdf = $_POST["arquivo.pdf"];

        $numPagina = VerificaNumPag("redacao.pdf");//retorna número de páginas do pdf
        convertePNG("redacao.pdf");
        extraiPDF("redacao.pdf");
        $arquivosPNG_encontrados = glob($raiz."/proj/" . "pagina*.png"); //guarda o nome dos arquivos PNG gerados
        $arquivosPDF_encontrados = glob($raiz."/proj/" . "pg*.pdf");//guarda os nomes dos arquivos PDF gerados

        for ($i=0; $i < count($arquivosPNG_encontrados); $i++) //itera sobre os arquivos PNG encontrados
        {
            $texto = ocrImagem($arquivosPNG_encontrados[$i]); //extrai o texto de cad PNG
            $primeiraLinha = explode("\n", $texto)[0]; //recupera somente a ptrimiera linha (matrícula)
            rename($arquivosPDF_encontrados[$i], $primeiraLinha.".pdf" ); //troca o nome de cada arquivo PDF pela matrícula retirar dop arquivo PNG
        }


    ?>