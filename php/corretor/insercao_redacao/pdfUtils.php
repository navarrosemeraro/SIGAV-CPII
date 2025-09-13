<?php
class pdfUtils{

    public static function extrairMatricula($texto){
    // Remove espaços extras no texto
    $texto = preg_replace('/\s+/', ' ', $texto);

    // Captura: "Matrícula: 2025001" ou "Matricula: M15501238"
    if (preg_match('/matr[ií]cula\s*:\s*([A-Z0-9]+)/i', $texto, $matches)) {
        return trim($matches[1]);
    }
    return null;
    }

    public static function sanitizarNomeArquivo($nomeOriginal){
        $nome = basename($nomeOriginal);
        return preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $nome);
    }
}
?>