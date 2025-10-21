<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/common/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/common/cadastro-e-login/css/pages/login/login.css">
        <link rel="icon" type="image/png" href="../../assets/common/cadastro-e-login/img/global/Brasão_Colégio_Pedro_II.png" />
    <title>Login</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#" style="margin-left: 10px;">SIGAV CPII<span><img
                        src="../../assets/common/cadastro-e-login/img/global/Brasão_Colégio_Pedro_II.png" alt="Brasão Colégio PedroII"
                        style="position: relative; margin-left: 30px;"></span></a>
            <p style="margin-right: 20px; margin-top: 16px; color:rgba(0, 0, 0, 0.3)">Login</p>
        </div>
    </nav>
    <div id="center" style="margin: 0;">
        <div class="position-relative">
            <div id="mensagem"></div><br>
        </div>
    </div>
    <div id="center-form" style="position: fixed; left: 50%; top: 25%; margin: 0;">
        <div class="position-absolute">
            <h1 class="display-1 center">LOGIN</h1>
            <form action="../../php/global/cadastro-e-login/login-usuario.php" method="post" style="width: 500px;">
                <fieldset style="border: 2px black solid; padding: 50px;">
                    <legend>Insira seus dados</legend>
                    <div class="mb-2">
                        <label for="matricula" class="form-label">Matrícula:</label>
                        <input type="text" class="form-control" id="matricula" name="matricula"
                            placeholder="Ex: 000000">
                    </div>
                    <div class="mb-2">
                        <label for="senha" class="form-label">Senha:</label>
                        <input type="password" class="form-control" id="senha" name="senha">
                        <div class="form-check">
                              <input class="form-check-input" type="checkbox" id="mostrarSenha">
                              <label class="form-check-label" for="mostrarSenha">Mostrar senha</label>
                        </div>

                    </div>
                    <a href="cadastro.php"><span>Não possui cadastro?</span></a><br><br>
                    <button type="submit" class="btn btn-outline-primary">
                        Login
                    </button>
                </fieldset>
            </form>
        </div>

    </div>

    <script src="../../assets/common/bootstrap/js/bootstrap.bundle.min.js"></script>


    <script>
        const cadastro = <?php echo json_encode($_GET["cadastro"] ?? null); ?>;
        if (cadastro === 'sucesso') {
            document.getElementById('mensagem').innerHTML =
                '<div style="margin-top: 40px" class="alert alert-success" role="alert">Cadastro realizado com sucesso! Faça login para continuar.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" onclick="apagar_msg()"></button></div>';
        }

        const acesso = <?php echo json_encode($_GET["acess"] ?? null); ?>;
        if(acesso === 'refused'){
            document.getElementById('mensagem').innerHTML =
            '<div style="margin-top: 40px" class="alert alert-danger" role="alert">Não foi possível efetuar o login. Matrícula e/ou Senha incorretos.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" onclick="apagar_msg()"></button></div>'
        }
    </script>
    <script>
        function apagar_msg(){
            $mensagem = document.getElementById('mensagem');
            $mensagem.innerHTML = "";
            $mensagem.style.display = "none";
            
        }
    </script>
    <script>
    document.getElementById('mostrarSenha').addEventListener('change', function() {
         const campoSenha = document.getElementById('senha');
          campoSenha.type = this.checked ? 'text' : 'password';
});
</script>

</body>

</html>