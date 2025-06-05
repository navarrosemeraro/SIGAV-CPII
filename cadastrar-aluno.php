<?php 
$host = "localhost";
$user = "root";
$pass = "";
$db_name = "correcao_redacao";
$charset = 'utf8mb4';
$variavel ='Global';
teste();
echo ('Valor: ' .$variavel. '!<br>');

function teste(){
    global $variavel;
    $variavel ='Local';
}

?>