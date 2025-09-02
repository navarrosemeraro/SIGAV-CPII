<?php
session_start();

// Inclui os arquivos necessários

include '../../../php/global/auth.php';
include '../../../php/global/db.php';



if ($_SERVER['REQUEST_METHOD'] === "POST") {

    // Dados recebidos do formulário
    $motivo_form = isset($_POST["tipo"]) ? $_POST["tipo"] : null;
    $tema        = isset($_POST["tema"]) ? $_POST["tema"] : null;
    $mensagem    = isset($_POST["msg"]) ? $_POST["msg"] : null;

    // Dados da sessão
    $nome        = isset($_SESSION["nome"]) ? $_SESSION["nome"] : null;
    $matricula   = isset($_SESSION["matricula"]) ? $_SESSION["matricula"] : null;
    $email       = isset($_SESSION["email"]) ? $_SESSION["email"] : null;
    $tipo_user   = isset($_SESSION["nivel_acesso"]) ? $_SESSION["nivel_acesso"] : "aluno";

    // Definir motivo e prioridade
    switch (strtolower($motivo_form)) {
        case "problema":
            $motivo    = "Problema técnico";
            $prioridade = "Alta";
            break;
        case "duvida":
            $motivo    = "Dúvida";
            $prioridade = "Média";
            break;
        case "sugestao":
            $motivo    = "Sugestão";
            $prioridade = "Baixa";
            break;
        default:
            $motivo    = "Outro";
            $prioridade = "Baixa";
            break;
    }

    // Pasta onde será salva a imagem
    $pasta = 'uploads/';
    
    // Informações do arquivo enviado
    $arquivo = $_FILES['anexo']['name'];
    $arquivo_tmp = $_FILES['anexo']['tmp_name'];
    $arquivo_tipo = $_FILES['anexo']['type'];
    $arquivo_tamanho = $_FILES['anexo']['size'];

    // Extensões permitidas
    $extensoes_permitidas = ['jpg', 'jpeg', 'png', 'gif'];

    // Pega a extensão do arquivo
    $extensao = strtolower(pathinfo($arquivo, PATHINFO_EXTENSION));

    // Valida extensão
    if (!in_array($extensao, $extensoes_permitidas)) {
        die("Erro: formato de imagem não permitido.");
    }

    // Valida tamanho (ex: até 5MB)
    if ($arquivo_tamanho > 5 * 1024 * 1024) {
        die("Erro: arquivo muito grande.");
    }

    // Move o arquivo para a pasta desejada
    $novo_nome = uniqid() . "." . $extensao; // evita sobrescrever arquivos
    $caminho_final = $pasta . $novo_nome;
    if (move_uploaded_file($arquivo_tmp, $caminho_final)) {
        echo "Imagem enviada com sucesso!<br>";
        echo "Caminho do arquivo: " . $caminho_final . "<br>";
    } else {
        echo "Erro ao enviar a imagem.";
    }

    $stmt_suporte = $conn->prepare("INSERT INTO suporte (tipo_usuario, nome, matricula, email, tema, mensagem, prioridade, anexo, `status`)
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'pendente')");
    $stmt_suporte->bind_param("ssssssss", $tipo_user, $matricula, $email, $tema, $mensagem, $prioridade, $caminho_final);
    $stmt_suporte->execute();
    $result_suporte = $stmt_suporte->get_result();
     // Aqui você pode inserir no banco
    // ...
}
?>
