    <?php
    // $raiz = $_SERVER['DOCUMENT_ROOT'];
    $raiz = dirname(__DIR__); // Define $raiz como a pasta do projeto (ex: C:\xampp\htdocs\sigav-cpii)
    $xpdfRoot = $_SERVER['DOCUMENT_ROOT'];

    require __DIR__ . '/../vendor/autoload.php';
    require_once 'pdfUtils.php';
    require __DIR__ . '/../php/global/db.php';
    use thiagoalessio\TesseractOCR\TesseractOCR;

    ini_set('display_errors', 1); 
    ini_set('display_startup_errors', 1); 
    error_reporting(E_ALL);
    
        function convertePNG($arquivo){

            global $xpdfRoot, $raiz; // Puxa as variáveis globais

            // Caminho do executável (usa $xpdfRoot)
            $pdfExe = $xpdfRoot . "/xpdf/bin64/pdftopng.exe";
    
            $inputFile = escapeshellarg($arquivo); 
    
            // Prefixo de SAÍDA
            $outputPrefix = escapeshellarg($raiz . "/pdfs_outputs/pagina"); 

            $comando = "$pdfExe -r 300 -gray $inputFile $outputPrefix 2>&1";
    
            exec($comando, $output, $return_var);
            if ($return_var === 0) {
                echo "Conversão PNG bem-sucedida!";
            } else {
                echo "\n Erro ao converter PNG. Comando: $comando <pre>" . implode("\n", $output) . "</pre>";
                echo $return_var;
            }
        }


        function extraiPDF($arquivo){
            global $raiz; // Puxa a variável global
    
            $inputFile = escapeshellarg($arquivo);
    
            // Padrão de SAÍDA (usa $raiz)
            $outputPattern = '"' . $raiz . '/pdfs_outputs/pg_%04d.pdf' . '"'; 

            $caminhoPDFTK = '"C:\Program Files (x86)\PDFtk\bin\pdftk.exe"';
    
            $comando = "$caminhoPDFTK $inputFile burst output $outputPattern 2>&1";
    
            exec($comando, $output, $return_var);
            if ($return_var === 0) {
                echo "Extração de PDF bem-sucedida!";
            } else {
                echo "\n Erro ao extrair PDF. Comando: $comando <pre>" . implode("\n", $output) . "</pre>";
                echo $return_var;
            }
        }


        function ocrImagem($arquivo){

            $text = (new TesseractOCR($arquivo))
                ->lang('eng') // Defina o idioma (ex: eng para inglês, por para português)
                ->executable('C:\Program Files\Tesseract-OCR\tesseract.exe') // para o PC do Giovanni
                ->run();
            return $text;
        }

        function VerificaNumPag($arquivo)
        {
            $caminhoPDFTK = '"C:\Program Files (x86)\PDFtk\bin\pdftk.exe"';

            $comando = "$caminhoPDFTK ". escapeshellarg($arquivo) . " dump_data | findstr NumberOfPages 2>&1";
            exec($comando, $output, $return_var);
    
            if ($return_var === 0 && isset($output[0])) {
                return substr($output[0], 15, strlen($output[0])-15);
            }
            return 0; // Retorna 0 se falhar
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

        // Pega o nome do arquivo SEM a extensão
        $nomeBase = pathinfo($nomeOriginal, PATHINFO_FILENAME);

        // Sanitiza apenas o nome base
        $nomeSeguro = pdfUtils::sanitizarNomeArquivo($nomeBase);

        $data = new DateTime();
        $ano_atual = $data->format('Y');

        // Verifica se a pasta existe e tem permissão de escrita
        $pastaDestino = "../assets/uploads/arquivos_redacoes/" . $ano_atual . "/3_ano";

        if (!is_dir($pastaDestino)) {
            mkdir($pastaDestino, 0777, true); // cria recursivamente com permissão total
        }


    // Define a pasta de processamento
    $pastaProcessamento = $raiz . "/pdfs_outputs"; // ex: C:\...\sigav-cpii\pdfs_outputs
    if (!is_dir($pastaProcessamento)) {
        mkdir($pastaProcessamento, 0777, true); 
    }
    // Mova o arquivo temporário para um local permanente
    $arquivoDeEntrada = $pastaProcessamento . "/" . $nomeSeguro . ".pdf"; // ex: C:\...\sigav-cpii\pdfs_outputs\redacao_original.pdf
    if (!move_uploaded_file($arquivoTmp, $arquivoDeEntrada)) {
        die("Erro fatal ao mover o arquivo de upload.");
    }

    // chame as funções usando o NOVO caminho $arquivoDeEntrada
    $numPagina = VerificaNumPag($arquivoDeEntrada); 
    convertePNG($arquivoDeEntrada); // Passa o caminho permanente
    extraiPDF($arquivoDeEntrada);   // Passa o caminho permanente
    
    // O glob usa $pastaProcessamento
    $arquivosPNG_encontrados = glob($pastaProcessamento . "/pagina*.png");
    $arquivosPDF_encontrados = glob($pastaProcessamento . "/pg*.pdf");

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

            $caminhoCompletoBD = "assets/uploads/arquivos_redacoes/" . $ano_atual . "/3_ano" . "/" . $nomeArquivo;

            //verifica se existe a determinada matricula encontrada existe no banco de dados
            $stmt = $conn->prepare("SELECT 1 FROM alunos WHERE id_matricula = ?");
            $stmt->bind_param("s", $matriculaLimpa);
            $stmt->execute();
            $stmt->store_result();

            //insere o registro da redação no banco de dados 
            if ($stmt->num_rows > 0) {
                $stmt_inserir = $conn->prepare("INSERT INTO redacao (aluno_id, tema, status_red, caminho_arquivo)
                                            VALUES (?, ?, 'pendente', ?)");
                $stmt_inserir->bind_param("sss", $matriculaLimpa, $tema_redacao, $caminhoCompletoBD);
                $stmt_inserir->execute();
                $stmt_inserir->close();

            } else {
                $mensagens[] = "Matrícula $matriculaLimpa da pag $i não encontrada em alunos";
            }
        }

        // LIMPEZA: Apaga os arquivos PNG temporários
        foreach ($arquivosPNG_encontrados as $pngFile) {
            if (file_exists($pngFile)) {
            unlink($pngFile);
            }
        }

        header("Location: ../pages/pages_corretor/consulta/inserir_redacoes.php?inserir=sucesso");

    }
    else {
        echo "Nenhum arquivo enviado ou erro no upload";
    }
    }
    catch (Exception $e) {
    echo "Ocorreu um erro: " . $e->getMessage();
    }


    ?>