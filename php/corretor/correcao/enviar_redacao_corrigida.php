<?php
include '../../global/db.php';
include '../../global/auth.php';

if((isset($_POST['c1'])) && (isset($_POST['c2'])) && (isset($_POST['c3'])) && (isset($_POST['c4'])) && (isset($_POST['c5']))) {
$id_redacao = $_POST['id_redacao'];
$id_corretor = $_SESSION["matricula"];
$nota_c1 = $_POST['c1'];
$nota_c2 = $_POST['c2'];
$nota_c3 = $_POST['c3'];
$nota_c4 = $_POST['c4'];
$nota_c5 = $_POST['c5'];
$nota_total = $nota_c1 + $nota_c2 + $nota_c3 + $nota_c4 + $nota_c5;
$observacoes = $_POST['comentario_corretor'];



$stmt = $conn->prepare("UPDATE redacao 
                        SET corretor_id = ?, nota_comp1 = ?, nota_comp2 = ?, nota_comp3 = ?, nota_comp4 = ?, nota_comp5 = ?, nota_total = ?, status_red = 'corrigida', observacoes = ?
                        WHERE id = ?");
$stmt->bind_param("iiiiiiisi",
                    $id_corretor,
                    $nota_c1, 
                    $nota_c2, 
                    $nota_c3, 
                    $nota_c4, 
                    $nota_c5, 
                    $nota_total, 
                    $observacoes, 
                    $id_redacao);
$stmt->execute();
header("Location: /sigav-cpii/pages/pages_corretor/correcao/selecionar_redacao.php");
exit;
}

?>