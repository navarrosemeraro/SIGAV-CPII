<?php
// Conexão
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "automacao";
$charset = "utf8mb4";

$conn = new mysqli($servername, $username, $password, $db_name);
$conn->set_charset($charset);

if($conn->connect_error){
    die("Erro na conexão: " . $conn->connect_error);
}

//Recebe os Dados inseridos no formulário
$mat = $_POST["matricula"];
$senha = $_POST["senha"];


//Prepara o SQL para ADMIN
$stmt_admin = $conn->prepare("SELECT nome, id_matricula, nivel_acesso FROM adm WHERE id_matricula = ? AND senha_hash = ?");
$stmt_admin->bind_param("ss", $mat, $senha);
$stmt_admin->execute();
$result_admin = $stmt_admin->get_result();

if($result_admin && $result_admin->num_rows > 0){
    $dados_admin = $result_admin->fetch_assoc();
    session_start();
    $_SESSION["matricula"] = $dados_admin['id_matricula'];
    $_SESSION["nome"] = $dados_admin['nome'];
    $_SESSION["nivel_acesso"] = $dados_admin['nivel_acesso'];
    session_write_close();
    header("Location: ../../../pages/pages_admin/principal/principal.php");
    exit;
}

//Prepara o SQL para CORRETOR
$stmt_corretores = $conn->prepare("SELECT nome, id_matricula, email, nivel_acesso FROM corretores WHERE id_matricula = ? AND senha_hash = ?");
$stmt_corretores->bind_param("is", $mat, $senha);
$stmt_corretores->execute();
$result_corretores = $stmt_corretores->get_result();

if($result_corretores && $result_corretores->num_rows > 0){
    $dados_corretores = $result_corretores->fetch_assoc();
    session_start();
    $_SESSION["matricula"] = $dados_corretores['id_matricula'];
    $_SESSION["nome"] = $dados_corretores['nome'];
    $_SESSION["nivel_acesso"] = $dados_corretores['nivel_acesso'];
    $_SESSION["email"] = $dados_corretores['email'];
    header("Location: ../../../pages/pages_corretor/area_corretor/area_corretor.php");
    exit;
}

//Prepara o SQL para ALUNO
$stmt_alunos = $conn->prepare("SELECT nome, id_matricula, email, cpf, turno, turma, idioma, nivel_acesso FROM alunos WHERE id_matricula = ? AND senha_hash = ?");
$stmt_alunos->bind_param("is", $mat, $senha);
$stmt_alunos->execute();
$result_alunos = $stmt_alunos->get_result();


if($result_alunos && $result_alunos->num_rows > 0){
    $dados_aluno = $result_alunos->fetch_assoc();
    session_start();
    $_SESSION["matricula"] = $dados_aluno['id_matricula'];
    $_SESSION["nome"] = $dados_aluno['nome'];
    $_SESSION["email"] = $dados_aluno['email'];
    $_SESSION["cpf"] = $dados_aluno['cpf'];
    $_SESSION["turno"] = $dados_aluno['turno'];
    $_SESSION["turma"] = $dados_aluno['turma'];
    $_SESSION["idioma"] = $dados_aluno['idioma'];
    $_SESSION["nivel_acesso"] = $dados_aluno['nivel_acesso'];

    session_write_close();
    header("Location: ../../../pages/pages_aluno/area_aluno/area_aluno.php");
    exit;
}
echo ("<p>Matrícula e/ou senha incorretas!</p>");

$conn->close();

?>