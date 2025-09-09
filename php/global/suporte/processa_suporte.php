<?php
session_start();

// Inclui os arquivos necessários

include '../../../php/global/auth.php';
include '../../../php/global/db.php';


// verifica se o método do form é post (se o form foi enviado)
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

    if($tipo_user === "corretor"){
        // Pasta onde será salva a imagem caso seja corretor
        $pasta = __DIR__ . "/../../../assets/uploads/anexos_suporte/corretores/";
    }
    if($tipo_user === "aluno"){
        // Pasta onde será salva a imagem caso seja aluno
        $pasta = __DIR__  . "/../../../assets/uploads/anexos_suporte/alunos/";
    }
    if($tipo_user === "admin"){
        // Pasta onde será salva a imagem caso seja administrador
        $pasta =  __DIR__ . "/../../../assets/uploads/anexos_suporte/admins/";
    }
    
    // Informações do arquivo enviado
    if(isset($_FILES['anexo']) && $_FILES['anexo']['error'] === UPLOAD_ERR_OK){
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
        $novo_nome = "anexo" . uniqid() . "." . $extensao; // evita sobrescrever arquivos, crindo uma identificação
        $caminho_final = $pasta . $novo_nome; // define o caminho final para mover o arquivo/anexo
        if (move_uploaded_file($arquivo_tmp, $caminho_final)) {
            echo "Imagem enviada com sucesso!<br>";
            echo "Caminho do arquivo: " . $caminho_final . "<br>";
        } else {
        echo "Erro ao enviar a imagem.";
        }
    }
    else {
        $arquivo = null;
    }

    //insere o registro do suporte no banco de dados, a aguardar por resposta
    $stmt_suporte = $conn->prepare("INSERT INTO suporte (tipo_usuario, nome, matricula, email, tema, mensagem, prioridade, caminho_anexo, `status`)
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'pendente')");
    $stmt_suporte->bind_param("ssssssss", $tipo_user, $nome, $matricula, $email, $tema, $mensagem, $prioridade, $caminho_final);
    $stmt_suporte->execute();
}
?>
