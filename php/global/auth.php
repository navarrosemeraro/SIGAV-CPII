<?php
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    if (!isset($_SESSION['nome'])) {
    header("Location: ../../pages/cadastro-e-login/pag-login.php");
    exit();
}
?>