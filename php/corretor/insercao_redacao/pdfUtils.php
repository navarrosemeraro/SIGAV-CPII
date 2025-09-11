<?php
class pdfUtils{

    public static function extrairMatricula($texto){
        /* Encontra padrões no texto a partir de Regex (Regular Expression)*/
        if (preg_match('/[Mm]atr[ií]cula[:\s]*([0-9]+)/i', $texto, $matches)) {
            return $matches[1]; // retorna o valor encontrado
        }    
        return null;
    }

    public static function sanitizarNomeArquivo($nomeOriginal){
        $nome = basename($nomeOriginal);
        return preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $nome);
    }
}
?>