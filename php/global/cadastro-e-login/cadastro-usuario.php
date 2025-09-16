<?php
// Conexão
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "automacao";
$charset = "utf8mb4";

$conn = new mysqli($servername, $username, $password, $db_name);
$conn->set_charset($charset);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $funcao = $_POST['funcao'];
    $tabela_permitida = ['alunos', 'corretores'];

    if (!in_array($funcao, $tabela_permitida)) {
        die("<p>Erro: Função inválida escolhida.</p>");
    }

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['tel'];
    $cpf = $_POST['cpf'];
    $id_matricula = (int) $_POST['matricula'];
    $senha_hash = $_POST['senha_hash'];
    $newsenha = $_POST['newsenha'];

    if ($senha_hash !== $newsenha) {
        die("<p>Erro: As senhas não coincidem.</p>");
    }

    // $senha_hash = password_hash($senha_hash, PASSWORD_DEFAULT);

 if ($funcao === "alunos") {
    $turno  = $_POST['turno'];
    $turma  = $_POST['turma'];
    $idioma = $_POST['idioma'];

    // Consulta se já existe na tabela ALUNOS
    $stmt_ex = $conn->prepare("SELECT COUNT(*) FROM alunos WHERE id_matricula = ?");
    $stmt_ex->bind_param("s", $id_matricula);
    $stmt_ex->execute();
    $stmt_ex->bind_result($existe);
    $stmt_ex->fetch();
    $stmt_ex->close();

    if ($existe > 0) {
        echo "Matrícula já cadastrada!";
    } else {
        $stmt = $conn->prepare("INSERT INTO alunos
            (id_matricula, nome, email, cpf, senha_hash, telefone, turma, turno, idioma)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)"
        );
        $stmt->bind_param("issssssss", $id_matricula, $nome, $email, $cpf, $senha_hash, $telefone, $turma, $turno, $idioma);

        if ($stmt->execute()) {
            header("Location: ../../../pages/cadastro-e-login/pag-login.php?cadastro=sucesso");
            exit;
        } else {
            echo "<h1>Erro ao cadastrar: " . $stmt->error . "</h1>";
        }

        $stmt->close();
    }

} else if ($funcao === "corretores") {
    $stmt_ex = $conn->prepare("SELECT COUNT(*) FROM corretores WHERE id_matricula = ?");
    $stmt_ex->bind_param("s", $id_matricula);
    $stmt_ex->execute();
    $stmt_ex->bind_result($existe);
    $stmt_ex->fetch();
    $stmt_ex->close();

    if ($existe > 0) {
        echo "Matrícula já cadastrada!";
    } else {
        $stmt = $conn->prepare("INSERT INTO corretores
            (id_matricula, nome, email, cpf, senha_hash, telefone)
            VALUES (?, ?, ?, ?, ?, ?)"
        );
        $stmt->bind_param("isssss", $id_matricula, $nome, $email, $cpf, $senha_hash, $telefone);

        if ($stmt->execute()) {
            header("Location: ../../../pages/cadastro-e-login/pag-login.php?cadastro=sucesso");
            exit;
        } else {
            echo "<h1>Erro ao cadastrar: " . $stmt->error . "</h1>";
        }

        $stmt->close();
    }

} else {
    die("<p>Erro: função não tratada no código.</p>");
}
} else {
    echo "<p>Nenhum dado foi recebido.</p>";
}

$conn->close();
?>