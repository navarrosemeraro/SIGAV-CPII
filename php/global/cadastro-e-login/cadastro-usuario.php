<?php

// Conexão
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "automacao";
$conn = new mysqli($servername, $username, $password, $db_name);
$conn->set_charset("utf8mb4");

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Inicializa variáveis
$erro = "";
$sucesso = false;
$form_values = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $funcao = $_POST['funcao'];
    $nome = $_POST['nome'] ?? "";
    $email = $_POST['email'] ?? "";
    $telefone = $_POST['tel'] ?? "";
    $cpf = $_POST['cpf'] ?? "";
    $id_matricula = $_POST['matricula'] ?? "";
    $senha = $_POST['senha_hash'] ?? "";
    $confirma_senha = $_POST['newsenha'] ?? "";

    $form_values = [
        'nome' => $nome,
        'email' => $email,
        'tel' => $telefone,
        'cpf' => $cpf,
        'matricula' => $id_matricula,
    ];

    // Verifica senhas
    if ($senha !== $confirma_senha) {
        $erro = "As senhas não coincidem.";
    } else {
        $senha_hash = $senha; // Criptografe se quiser usando password_hash()

        // Verifica se CPF ou matrícula já estão cadastrados em qualquer tabela
        $stmt = $conn->prepare("
            SELECT COUNT(*) FROM (
                SELECT id_matricula, cpf FROM alunos
                UNION ALL
                SELECT id_matricula, cpf FROM corretores
            ) AS todos
            WHERE id_matricula = ? OR cpf = ?
        ");
        $stmt->bind_param("ss", $id_matricula, $cpf);
        $stmt->execute();
        $stmt->bind_result($existe);
        $stmt->fetch();
        $stmt->close();

        if ($existe > 0) {
            $erro = "Matrícula ou CPF já cadastrado em outro usuário.";
        } else {
            if ($funcao === "alunos") {
                $turno  = $_POST['turno'] ?? "";
                $turma  = $_POST['turma'] ?? "";
                $idioma = $_POST['idioma'] ?? "";

                $stmt = $conn->prepare("
                    INSERT INTO alunos
                    (id_matricula, nome, email, cpf, senha_hash, telefone, turma, turno, idioma, nivel_acesso)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'aluno')
                ");
                $stmt->bind_param("sssssssss", $id_matricula, $nome, $email, $cpf, $senha_hash, $telefone, $turma, $turno, $idioma);

            } elseif ($funcao === "corretores") {
                $stmt = $conn->prepare("
                    INSERT INTO corretores
                    (id_matricula, nome, email, cpf, senha_hash, telefone)
                    VALUES (?, ?, ?, ?, ?, ?)
                ");
                $stmt->bind_param("ssssss", $id_matricula, $nome, $email, $cpf, $senha_hash, $telefone);
            } else {
                $erro = "Função inválida.";
            }

            if (!$erro && $stmt->execute()) {
                $stmt->close();
                $conn->close();
                header("Location: pag-login.php?cadastro=sucesso");
                exit();
            } elseif (!$erro) {
                $erro = "Erro ao cadastrar: " . $stmt->error;
            }
        }
    }
}

$conn->close();
?>

<!-- HTML: Mensagens de sucesso ou erro -->
<?php if (!empty($erro)): ?>
    <div style="color: red; font-weight: bold; margin: 10px 0;">
        <?= htmlspecialchars($erro) ?>
    </div>
<?php elseif ($sucesso): ?>
    <div style="color: green; font-weight: bold; margin: 10px 0;">
        Cadastro realizado com sucesso!
    </div>
<?php endif; ?>
