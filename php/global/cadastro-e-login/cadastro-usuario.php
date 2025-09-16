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

$erro = "";
$sucesso = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $funcao = $_POST['funcao'];
    $tabela_permitida = ['alunos', 'corretores'];

    if (!in_array($funcao, $tabela_permitida)) {
        $erro = "Função inválida escolhida.";
    } else {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $telefone = $_POST['tel'];
        $cpf = $_POST['cpf'];
        $id_matricula = (int) $_POST['matricula'];
        $senha_hash = $_POST['senha_hash'];
        $newsenha = $_POST['newsenha'];

        if ($senha_hash !== $newsenha) {
            $erro = "As senhas não coincidem.";
        } else {
            // $senha_hash = password_hash($senha_hash, PASSWORD_DEFAULT); // Descomente se quiser criptografar

            if ($funcao === "alunos") {
                $turno  = $_POST['turno'];
                $turma  = $_POST['turma'];
                $idioma = $_POST['idioma'];

                // Verifica matrícula
                $stmt_ex = $conn->prepare("SELECT COUNT(*) FROM alunos WHERE id_matricula = ?");
                $stmt_ex->bind_param("i", $id_matricula);
                $stmt_ex->execute();
                $stmt_ex->bind_result($existeMatricula);
                $stmt_ex->fetch();
                $stmt_ex->close();

                if ($existeMatricula > 0) {
                    $erro = "Matrícula já cadastrada!";
                } else {
                    // Verifica CPF
                    $stmt_cpf = $conn->prepare("SELECT COUNT(*) FROM alunos WHERE cpf = ?");
                    $stmt_cpf->bind_param("s", $cpf);
                    $stmt_cpf->execute();
                    $stmt_cpf->bind_result($existeCPF);
                    $stmt_cpf->fetch();
                    $stmt_cpf->close();

                    if ($existeCPF > 0) {
                        $erro = "CPF já cadastrado!";
                    } else {
                        $stmt = $conn->prepare("INSERT INTO alunos
                            (id_matricula, nome, email, cpf, senha_hash, telefone, turma, turno, idioma)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)"
                        );
                        $stmt->bind_param("issssssss", $id_matricula, $nome, $email, $cpf, $senha_hash, $telefone, $turma, $turno, $idioma);

                        if ($stmt->execute()) {
                            $sucesso = true;
                        } else {
                            $erro = "Erro ao cadastrar: " . $stmt->error;
                        }

                        $stmt->close();
                    }
                }

            } else if ($funcao === "corretores") {
                // Verifica matrícula
                $stmt_ex = $conn->prepare("SELECT COUNT(*) FROM corretores WHERE id_matricula = ?");
                $stmt_ex->bind_param("i", $id_matricula);
                $stmt_ex->execute();
                $stmt_ex->bind_result($existeMatricula);
                $stmt_ex->fetch();
                $stmt_ex->close();

                if ($existeMatricula > 0) {
                    $erro = "Matrícula já cadastrada!";
                } else {
                    // Verifica CPF
                    $stmt_cpf = $conn->prepare("SELECT COUNT(*) FROM corretores WHERE cpf = ?");
                    $stmt_cpf->bind_param("s", $cpf);
                    $stmt_cpf->execute();
                    $stmt_cpf->bind_result($existeCPF);
                    $stmt_cpf->fetch();
                    $stmt_cpf->close();

                    if ($existeCPF > 0) {
                        $erro = "CPF já cadastrado!";
                    } else {
                        $stmt = $conn->prepare("INSERT INTO corretores
                            (id_matricula, nome, email, cpf, senha_hash, telefone)
                            VALUES (?, ?, ?, ?, ?, ?)"
                        );
                        $stmt->bind_param("isssss", $id_matricula, $nome, $email, $cpf, $senha_hash, $telefone);

                        if ($stmt->execute()) {
                            $sucesso = true;
                        } else {
                            $erro = "Erro ao cadastrar: " . $stmt->error;
                        }

                        $stmt->close();
                    }
                }
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
