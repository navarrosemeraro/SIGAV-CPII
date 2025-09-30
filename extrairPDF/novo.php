    <?php
    ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
        function convertePNG($arquivo){

            $comando = "C:/xampp/htdocs/xpdf/bin64/pdftopng.exe -r 300 -gray C:/xampp/htdocs/SIGAV-CPII/extrairPDF/".$arquivo." imagem 2>NUL";

            exec($comando, $output, $return_var);
            if ($return_var === 0) {
                    echo "Conversão bem-sucedida!";
                } else {
                    echo "\n Erro ao converter PDF. Saída: <pre>" . implode("\n", $output) . "</pre>";
                    echo $return_var;
                }
        }


        function extraiPDF($arquivo){

            $comando = "pdftk " . escapeshellarg($arquivo) . " burst" ;
            exec($comando, $output, $return_var);
            if ($return_var === 0) {
                    echo "Conversão bem-sucedida!";
                } else {
                    echo "\n Erro ao converter PDF. Saída: <pre>" . implode("\n", $output) . "</pre>";
                    echo $return_var;
                }
        }

        convertePNG("Matricula.pdf");

        $saida = shell_exec("python ExtrairPdfOCR.py");
        echo $saida;


    ?>