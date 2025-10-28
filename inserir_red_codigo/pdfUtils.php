<?php
class pdfUtils{


    public static function sanitizarNomeArquivo($nomeOriginal){
        $nome = basename($nomeOriginal);
        return preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $nome);
    }
}
?>