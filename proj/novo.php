    <?php
    $raiz = $_SERVER['DOCUMENT_ROOT'];
    require __DIR__ . '/../vendor/autoload.php';
    require_once 'pdfUtils.php';
    require __DIR__ . '../php/global/db.php';
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


    try{

    if (isset($_FILES["arquivo_pdf"]) && $_FILES['arquivo_pdf']['error'] === UPLOAD_ERR_OK) {
        
        $arquivoTmp = $_FILES["arquivo_pdf"]["tmp_name"];
        $nomeOriginal = $_FILES["arquivo_pdf"]["name"];
        $arquivo_tamanho = $_FILES["arquivo_pdf"]["size"];
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


        $numPagina = VerificaNumPag($arquivoTmp);//retorna número de páginas do pdf
        convertePNG($arquivoTmp);
        extraiPDF($arquivoTmp);
        $arquivosPNG_encontrados = glob($raiz."/proj/" . "pagina*.png"); //guarda o nome dos arquivos PNG gerados
        $arquivosPDF_encontrados = glob($raiz."/proj/" . "pg*.pdf");//guarda os nomes dos arquivos PDF gerados

        for ($i=0; $i < count($arquivosPNG_encontrados); $i++) //itera sobre os arquivos PNG encontrados
        {

            $texto = ocrImagem($arquivosPNG_encontrados[$i]); //extrai o texto de cad PNG
            $primeiraLinha = explode("\n", $texto)[0]; //recupera somente a primeira linha (matrícula)

            // Sanitiza a matrícula
            $matriculaLimpa = preg_replace("/[^A-Za-z0-9_-]/", '', $primeiraLinha);

            if (empty($matriculaLimpa)) {
            // Se o OCR falhou ou a linha estava vazia, pula este arquivo
            echo "Aviso: Não foi possível ler a matrícula do arquivo " . $arquivosPNG_encontrados[$i];
            continue; // Pula para a próxima página
            }

            $nomeArquivo = $nomeSeguro . "_Pag" . $i . "_" . $matriculaLimpa . ".pdf";
            
            $caminhoCompletoDestino = $pastaDestino . "/" . $nomeArquivo;
            
            rename($arquivosPDF_encontrados[$i], $caminhoCompletoDestino);

            $mensagens[] = "Gerado: $nomeArquivo, matrícula: " . $matriculaLimpa;

            //verifica se existe a determinada matricula encontrada existe no banco de dados
            $stmt = $conn->prepare("SELECT 1 FROM alunos WHERE id_matricula = ?");
            $stmt->bind_param("s", $matriculaLimpa);
            $stmt->execute();
            $stmt->store_result();

            //inserre o registro da redação no banco de dados 
            if ($stmt->num_rows > 0) {
                $stmt_inserir = $conn->prepare("INSERT INTO redacao (aluno_id, tema, status_red, caminho_arquivo)
                                            VALUES (?, ?, 'pendente', ?)");
                $stmt_inserir->bind_param("sss", $matriculaLimpa, $tema_redacao, $nomeArquivo);
                $stmt_inserir->execute();
                $stmt_inserir->close();

            } else {
                $mensagens[] = "Matrícula $matriculaLimpa da pag $i não encontrada em alunos";
            }
        }
    }
    else {
        echo "Nenhum arquivo enviado ou erro no upload";
    }
    }
    catch (Exception $e) {
    echo "Ocorreu um erro: " . $e->getMessage();
    }


    ?>