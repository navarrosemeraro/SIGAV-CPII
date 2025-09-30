<?php
    session_start();
    session_destroy();
    header('Location: ../../pages/cadastro-e-login/pag-login.php');
    exit;
?>