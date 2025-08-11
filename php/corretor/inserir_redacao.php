<?php
// Conexão com o banco (ajuste os dados conforme seu ambiente)
$host = "localhost";
$db = "automacao";
$user = "root";
$pass = "";
$conn = new mysqli($host, $user, $pass, $db);

// Verifica conexão
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Verifica se um arquivo foi enviado
if (isset($_FILES['redacao_pdf']) && $_FILES['redacao_pdf']['error'] == 0) {
    $aluno_id = $_POST['aluno_id'];
    $tema = $_POST['tema'];
    $nome_temporario = $_FILES['redacao_pdf']['tmp_name'];
    $conteudo_pdf = file_get_contents($nome_temporario); // Converte para binário

    // Prepara e executa a inserção
    $stmt = $conn->prepare("INSERT INTO redacao (aluno_id, tema, texto_arquivo) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $aluno_id, $tema, $conteudo_pdf);

    if ($stmt->execute()) {
        echo "Redação enviada com sucesso!";
    } else {
        echo "Erro ao salvar: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Erro ao enviar o arquivo.";
}

$conn->close();

/*

if (isset($_FILES['arquivo'])) {
    $nomeOriginal = $_FILES['redacao_pdf']['name'];
    $ext = pathinfo($nomeOriginal, PATHINFO_EXTENSION);
    $novoNome = uniqid() . '.' . $ext;
    move_uploaded_file($_FILES['arquivo']['tmp_name'], __DIR__ . '/arquivos/' . $novoNome);

    // salva no banco o caminho
    $sql = "INSERT INTO arquivos (nome, caminho) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $nomeOriginal, $novoNome);
    $stmt->execute();
}
*/
?>

