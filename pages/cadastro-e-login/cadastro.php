<?php
session_start();

// Inclui o PHP de processamento
require_once '../../php/global/cadastro-e-login/cadastro-usuario.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/common/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/common/cadastro-e-login/css/pages/cadastro/cadastro.css">
    <link rel="icon" type="image/png" href="../../assets/common/cadastro-e-login/img/global/Brasão_Colégio_Pedro_II.png">
    <title>Cadastro</title>
</head>
<body>
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="#" style="margin-left: 10px;">SIGAV CPII
            <span><img src="../../assets/common/cadastro-e-login/img/global/Brasão_Colégio_Pedro_II.png" 
                alt="Brasão Colégio Pedro II" style="position: relative; margin-left: 30px;"></span>
        </a>
        <p style="margin-right: 20px; margin-top: 16px; color:rgba(0, 0, 0, 0.3)">Cadastro</p>
    </div>
</nav>

<section id="dois">
    <div id="center-form" class="container min-vh-100 d-flex justify-content-center" style="margin-top: 30px;">
        <form id="form_cad" action="" method="post">
            <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center gap-4">
                <h1 class="display-1">Cadastro</h1>
                <label for="funcao">Função:</label>
                <select class="form-select" id="funcao" name="funcao">
                    <option value="corretores" <?= (isset($funcao) && $funcao=="corretores")?'selected':'' ?>>Docente</option>
                    <option value="alunos" <?= (isset($funcao) && $funcao=="alunos")?'selected':'' ?>>Discente(Aluno)</option>
                </select>
            </div>

            <?php if(!empty($erro)): ?>
                <div class="alert alert-danger mt-3"><?= $erro ?></div>
            <?php endif; ?>
            <?php if(!empty($sucesso)): ?>
                <div class="alert alert-success mt-3"><?= $sucesso ?></div>
            <?php endif; ?>

            <fieldset style="border: 2px black solid; padding: 30px; width: 800px;">
                <legend>Dados pessoais</legend>

                <div class="mb-2">
                    <label for="nome" class="form-label">Nome completo:</label>
                    <input type="text" class="form-control" id="nome" name="nome" 
                        placeholder="Ex: Lúcia Débora da Silva" autofocus required>
                </div>

                <div class="mb-2">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" name="email"
                        placeholder="Ex: exemplo@gmail.com" required>
                </div>

                <div class="mb-2">
                   <label for="tel" class="form-label">Telefone de Contato:</label>
                   <input type="tel" class="form-control" id="tel" name="tel"
                    pattern="^\(\d{2}\) \d{4,5}-\d{4}$"
                    title="Preencha com o seguinte formato: (XX) 99999-9999 ou (XX) 9999-9999." 
                    placeholder="Ex: (DDD) 99999-9999" 
                    maxlength="15" required>
                </div>

                <div class="mb-2">
                    <label for="cpf" class="form-label">CPF:</label>
                     <input type="text" class="form-control" id="cpf" name="cpf"
                      pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" 
                      title="Preencha com o seguinte formato: xxx.xxx.xxx-xx" 
                      placeholder="000.000.000-00" 
                        maxlength="14" required>
                </div>

                <div class="mb-2">
                    <label for="matricula" class="form-label">Matrícula CPII:</label>
                    <input type="text" class="form-control" id="matricula" name="matricula"
                        placeholder="****" required>
                </div>

                <div id="espec-aluno">
                    <?php if(isset($funcao) && $funcao=="alunos"): ?>
                        <div class="mb-2">
                            <label for="turno">Turno:</label>
                            <select class="form-select" name="turno">
                                <option value="Manhã">Manhã</option>
                                <option value="Tarde">Tarde</option>
                                <option value="Noite">Noite</option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="turma">Turma:</label>
                            <input type="text" class="form-control" name="turma" placeholder="Ex: 1A">
                        </div>
                        <div class="mb-2">
                            <label for="idioma">Idioma:</label>
                            <select class="form-select" name="idioma">
                                <option value="Francês">Francês</option>
                                <option value="Inglês">Inglês</option>
                                <option value="Espanhol">Espanhol</option>
                            </select>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="mb-2">
                    <label for="senha_hash" class="form-label">Senha:</label>
                    <input type="password" class="form-control" id="senha_hash" name="senha_hash" required>
                </div>

                <div class="mb-2">
                    <label for="senha_rep" class="form-label">Confirmar Senha:</label>
                    <input type="password" class="form-control" id="senha_rep" name="senha_rep" required>
                    <span id="erro_senha"></span>
                </div>

                <br>
                <button type="submit" id="btn_cadastro" class="btn btn-outline-primary">Finalizar Cadastro</button>
            </fieldset>
        </form>
    </div>
</section>

<script src="../../assets/common/cadastro-e-login/js/pages/cadastro/verifica.js"></script>
<script src="../../assets/common/cadastro-e-login/js/pages/cadastro/aluno-prof.js"></script>
<script>
    // Exibe os campos de aluno se "Discente" estiver selecionado
    document.getElementById('funcao').addEventListener('change', function() {
        const espec = document.getElementById('espec-aluno');
        if(this.value === 'alunos') {
            espec.style.display = 'block';
        } else {
            espec.style.display = 'none';
        }
    });
</script>

<script>
    // 1. Lógica para mostrar/ocultar campos de aluno (Função: Docente/Discente)
    document.getElementById('funcao').addEventListener('change', function() {
        const espec = document.getElementById('espec-aluno');
        if(this.value === 'alunos') {
            espec.style.display = 'block';
        } else {
            espec.style.display = 'none';
        }
    });

    // 2. --- MÁSCARA DE CPF (XXX.XXX.XXX-XX) ---
    const inputCPF = document.getElementById('cpf');
    inputCPF.addEventListener('input', function (e) {
        let value = e.target.value;
        value = value.replace(/\D/g, ''); // 1. Remove tudo que não for dígito
        value = value.substring(0, 11); // 2. Limita a 11 dígitos
        
        // 3. Aplica a máscara
        value = value.replace(/(\d{3})(\d)/, '$1.$2'); 
        value = value.replace(/(\d{3})(\d)/, '$1.$2'); 
        value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2'); 

        e.target.value = value;
    });

    // 3. --- MÁSCARA DE TELEFONE CORRIGIDA ( (XX) XXXX-XXXX ou (XX) XXXXX-XXXX ) ---
    const inputTel = document.getElementById('tel');
    inputTel.addEventListener('input', function (e) {
        let value = e.target.value;

        value = value.replace(/\D/g, ''); // 1. Remove tudo que não for dígito
        value = value.substring(0, 11); // 2. Limita a 11 (DDD + 9 dígitos)

        // 3. Aplica a máscara:
        
        // Se houver 11 dígitos (9º dígito): (XX) XXXXX-XXXX
        if (value.length == 11) {
            value = value.replace(/^(\d{2})(\d{5})(\d{4})$/, '($1) $2-$3');
        } 
        // Se houver 10 dígitos (8 dígitos fixo): (XX) XXXX-XXXX
        else if (value.length == 10) { 
            value = value.replace(/^(\d{2})(\d{4})(\d{4})$/, '($1) $2-$3');
        } 
        // Se houver de 3 a 9 dígitos (aplica só o DDD e o espaço)
        else if (value.length > 2) {
             // Formata: (XX) XXXXXXX...
            value = value.replace(/^(\d{2})(\d+)/, '($1) $2'); 
        }
        // Se houver 1 ou 2 dígitos (só o DDD)
        else if (value.length > 0) {
             // Formata: (X) ou (XX)
            value = value.replace(/^(\d{1,2})/, '($1'); 
        }
        
        e.target.value = value;
    });
</script>

</body>
</html>
