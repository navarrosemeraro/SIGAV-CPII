<?php 
require_once '../../../php/global/auth.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../assets/common/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../assets/aluno/css/pages/principal/principal.css">
    <link rel="icon" type="image/png" href="../../../assets/aluno/img/global/Brasão_Colégio_Pedro_II.png" />
    <title>Página Principal</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#" style="margin-left: 10px;">SIGAV CPII<span><img
                        src="../../../assets/aluno/img/global/Brasão_Colégio_Pedro_II.png" alt="Brasão Colégio PedroII"
                        style="position: relative; margin-left: 30px;"></span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../principal/principal.php">Principal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page"
                            href="../minhas_redacoes/minhas_redacoes.php">Minhas Redações</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Simulados Antigos - CPII
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="../simulados_antigos/simulados_enem.html">ENEM e
                                    Gabaritos</a></li>
                            <li><a class="dropdown-item" href="../simulados_antigos/simulados_uerj.html">UERJ e
                                    Gabaritos</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../suporte/suporte.html">Suporte</a>
                    </li>
                </ul>
                <div id="barra_usuario">
                    <a style="margin-right: 20px; margin-top: 0; color:rgba(0, 0, 0, 1); text-decoration:none;"
                        href="../perfil_aluno/perfil_aluno.php" class="dropdown-toggle">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-person-circle" viewBox="0 0 16 16"
                                style="height:30px; width:30px; margin-right: 10px">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                <path fill-rule="evenodd"
                                    d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                            </svg>
                        </span>
                        <?php echo ($_SESSION["nome"] . " (" . $_SESSION["turma"] . ")");?>
                    </a>
                </div>
            </div>
        </div>
    </nav>
<main>
    <section id="um">
        <h1 id="center" class="display-5 text-center" style="margin: 20px;">Automação de Correções de Redação e
            Simulados ENEM</h1>
        <br>
        <div id="center">
            <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel" style="width: 50%;">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="../../../assets/aluno/img/pages/principal/ENEM/caderno-questoes.png"
                            class="d-block w-100" alt="Caderno de Questões">
                    </div>
                    <div class="carousel-item">
                        <img src="../../../assets/aluno/img/pages/principal/ENEM/folha-red.png" class="d-block w-100"
                            alt="Folha de Redação">
                    </div>
                    <div class="carousel-item">
                        <img src="../../../assets/aluno/img/pages/principal/ENEM/cartao-resposta.png"
                            class="d-block w-100" alt="Cartão Resposta">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <br><br><br>
    <section id="dois">
        <div id="center">
            <div class="container">
                <h4 class="display-4" style="position: relative; left: 15px;">Sobre o
                    Projeto</h4>
                <div class="bg-dark my-4 position-relative" style="height: 0.5px; width: 94%; left: 12px; top: 20px;">
                </div>
                <div id="pai" class="container">
                    <div id="esquerda">
                        <p class="text-start text-break fs-6 lh-base">O projeto "SIGAV CPII" tem como
                            objetivo
                            otimizar
                            e antecipar os processos de entrega e devolução das redações
                            produzidas conforme os critérios do modelo Enem. A proposta possibilita maior controle e
                            organização por
                            parte do usuário quanto à gestão dos critérios avaliativos,
                            à atribuição de notas individualizadas e à emissão de feedbacks personalizados para cada
                            aluno.
                            As redações, uma vez submetidas ao sistema, permanecem registradas com todo o histórico de
                            correções e
                            atribuições realizadas até o momento.</p>
                        <p class="text-start text-break fs-6 lh-base">Além disso, o projeto contempla a automatização da
                            correção de
                            simulados aplicados aos alunos do 3º ano do Ensino Médio.
                            A funcionalidade permite a definição prévia de um gabarito e, com base nele, o escaneamento
                            e a
                            correção
                            automatizada das provas restantes, conferindo agilidade
                            e precisão ao processo avaliativo.</p>
                        <p class="fs-6">
                            Com a integração entre tecnologia e educação, o sistema promove não apenas a eficiência na
                            correção de
                            avaliações, mas também contribui para a formação pedagógica mais justa e transparente. Ao
                            reunir os
                            dados de
                            desempenho dos estudantes em um ambiente acessível e organizado, o projeto oferece subsídios
                            importantes
                            para intervenções pedagógicas mais precisas, além de representar uma solução inovadora e
                            sustentável
                            para
                            desafios recorrentes no contexto escolar.
                        </p>
                    </div>
                    <div id="direita">
                    </div>
                </div>
            </div>
        </div><br><br>
    </section>
    <section id="tres" class="container">
        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            <h1 class="display-6">Idealizadora</h1>
        </div>
            <div id="sec-1">
                <div class="card h-100">
                    <img src="../../../assets/aluno/img/pages/principal/Devs/Lucia-Deborah-Araujo.png" class="card-img-top" alt="Professora Lúcia Deborah">
                        <div class="card-body">
                            <h5 class="card-title">Lúcia Deborah</h5>
                            <p class="card-text">Professora do Colégio Pedro II</p>
                            <p class="card-text fw-bold">Corretora ENEM</p>
                        </div>
                </div>
                <div id="lucia_texto"><p>"O curso de Desenvolvimento de Sistemas do Ensino Médio Integrado do Pedro II sempre me encantou, pela potência de seus projetos,
                     muito bem orientados pelos docentes e cuidadosamente executados pelos alunos. Sempre imaginei que um desses projetos pudesse vir
                      ao encontro de demandas da disciplina de Português, mais especificamente no que toca à Redação, facilitando o processo de devolutiva das correções
                       e tornando-o mais próximo do que se vivencia nos ambientes de correção do Enem e de outros certames. 
                    Dei a conhecer esse sonho em sala de aula e fui agraciada com a escuta de três jovens estudantes, brilhantes, inquietos e capazes.
                     Nem acreditei que eles iriam finalmente trazer para o mundo concreto as minhas ideias e – melhor ainda! – que iriam aprimorá-las. Esbanjando competência,
                      a construção do ambiente de correções foi acontecendo e, em breve, poderá ser uma ferramenta de grande valor para professores de Português e para os alunos,
                       que terão suas redações corrigidas conforme os parâmetros do Enem, com todas as cinco Competências contempladas especificamente, com resultados 
                       individuais numéricos de 0 a 1000, acompanhados de justificativas em forma de texto - tudo segundo o padrão adotado pelo Inep. 
                    Além de representar um marco histórico para o Pedro II, este projeto comprova a qualidade da formação técnica dos estudantes e constitui um produto
                     inicial para a vida profissional de seus criadores, projetando-os positivamente no mercado."</p>
                </div>
            </div>
            <br>
        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            <h1 class="display-6">Desenvolvedores - DS306</h1>
        </div>
        <div class="container" id="center">
            <div id="sec-1">
                <div class="row">
                    <div class="col-6 col-md-3">
                        <div class="card h-100">
                            <img src="../../../assets/aluno/img/pages/principal/Devs/bruno-foto.jpeg"
                                class="card-img-top" alt="Desenvolvedor Bruno">
                            <div class="card-body">
                                <h5 class="card-title">Bruno Dantas</h5>
                                <p class="card-text">18 Anos</p>
                                <p class="card-text fw-bold">Desenvolvedor Back-End</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="card h-100">
                            <img src="../../../assets/aluno/img/pages/principal/Devs/giovanni-foto.jpeg"
                                class="card-img-top" alt="Desenvolvedor Giovanni">
                            <div class="card-body">
                                <h5 class="card-title">Giovanni Navarro</h5>
                                <p class="card-text">18 Anos</p>
                                <p class="card-text fw-bold">Desenvolvedor Full Stack</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="card h-100">
                            <img src="../../../assets/aluno/img/pages/principal/Devs/otto-foto.jpeg"
                                class="card-img-top" alt="Desenvolvedor Otto">
                            <div class="card-body">
                                <h5 class="card-title">Otto Mafra</h5>
                                <p class="card-text">17 Anos</p>
                                <p class="card-text fw-bold">Desenvolvedor Front-End</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

    <script src="../../../assets/corretor/js/bootstrap/bootstrap.bundle.min.js"></script>
</body>

</html>