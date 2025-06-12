<?php
// Conexão com o banco de dados (ajuste os dados conforme sua configuração)
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "cadastro_306";

$conn = new mysqli($host, $user, $pass, $dbname);

// Verifica conexão
if ($conn->connect_error) {
  die("Erro na conexão: " . $conn->connect_error);
}

exit();

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Pega os dados do formulário e aplica segurança básica
  $nome = $conn->real_escape_string($_POST["nome"]);
  $email = $conn->real_escape_string($_POST["email"]);
  $idade = (int) $_POST["idade"];
  $bio = $conn->real_escape_string($_POST["bio"]);
  $profissao = $conn->real_escape_string($_POST["profissao"]);
  $linguagem = $conn->real_escape_string($_POST["linguagem"]);

  // Monta a query SQL
  $sql = "INSERT INTO usuarios (nome, email, idade, bio, profissao, linguagem)
          VALUES ('$nome', '$email', $idade, '$bio', '$profissao', '$linguagem')";

  // Executa e verifica
  if ($conn->query($sql) === TRUE) {
    echo "<h1>Cadastro realizado com sucesso!</h1>";
  } else {
    echo "Erro ao cadastrar: " . $conn->error;
  }
} else {
  echo "<p>Nenhum dado foi enviado.</p>";
}

// Fecha conexão
$conn->close();
?>
