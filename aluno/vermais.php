<!DOCTYPE html>
<html lang="pt-br">

<?php
session_start();

define("NOME_PAGINA", "Ver Mais");
define("NOME_SITE", "UBM");

$id_aluno = $_SESSION['id_aluno'];

include '../gerencie/verifyAluno.php';
include "../gerencie/connect.php";

$id_curso = $_GET['id'];

$sqlCurso = "SELECT * FROM atividades WHERE ID = $id_curso";
$queryCursos = $pdo->prepare($sqlCurso);
$queryCursos->execute();

$linha = $queryCursos->fetch(PDO::FETCH_ASSOC, PDO::FETCH_OBJ);

$dataAtv = $linha['DATA'];
// aluno

$sql = "SELECT * FROM users WHERE ID = $id_aluno";
$query = $pdo->prepare($sql);
$query->execute();

$dados = $query->fetch(PDO::FETCH_ASSOC, PDO::FETCH_OBJ);

?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="shortcut icon" href="../../assets/img/LogoProVest.ico" type="image/x-icon">
    <title><?= NOME_SITE ?> - <?= NOME_PAGINA ?></title>
</head>

<body>

    <!-- início do preloader -->
    <div id="preloader">
        <div class="inner">
            <!-- HTML DA ANIMAÇÃO MUITO LOUCA DO SEU PRELOADER! -->
            <div class="bolas">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>
    <!-- fim do preloader -->
    <style>
        .navbar {
            background-color: #b73861 !important;
        }
    </style>


    <nav style="transition: 0.5s;" class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container">
            <a class="logoUBM" href="../dash-aluno/1">
                <img src="../../assets/img/logoProVest.png">
            </a>

            <script>
                function goBack() {
                    window.history.back()
                }
            </script>

            <button style="color: #fff;" class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <i class="bi bi-list"></i>
            </button>

            <div class="collapse navbar-collapse linksLogSig" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <span class="spanPi text-light">
                        <?= substr($dados['NOME'], 0, 9); ?>
                    </span>

                    <span class="spanPi">
                        <a class="links-vermais" href="../selecionados">Cursos selecionados</a>
                    </span>

                    <span class="spanPi">
                        <a class="links-vermais" href="../../gerencie/logout.php">Logout</a>
                    </span>
                </div>
            </div>
    </nav>

    <div class="container cardContainerPesquisa">
        <div class="row">
            <a href="../dash-aluno/1">Voltar</a>

            <div class="col-md-12">
                <form action="../resultado" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <form action="" method="POST">
                                <input class="form-control mt-4" aria-label="Default select example" name='pesquisa' type="text" placeholder="Faça sua pesquisa">
                                <button class="search-btnNav">
                                    <i style="color: #fff;" class="bi bi-search"></i>
                                </button>

                        </div>
                        <div class="col-md-6">
                            <select class="form-select mt-4" aria-label="Default select example" name='pesquisa-select'>
                                <option selected>Sugestões de pesquisa</option>
                                <option value="Engenharias">Engenharias</option>
                                <option value="Ciencias da Saude">Ciências da Saúde</option>
                                <option value="Ciencias Sociais Aplicadas">Ciências Sociais Aplicadas</option>
                            </select>
                </form>
            </div>
        </div>
    </div>


    <div class="container mt-3">
        <div class="row" style="margin-top: 28px;">
            <div class="col-md-6 p-4 text-center">
                <h2><?= $linha['CURSO'] ?> <br><span class="spanCategoriaCurso"><?= $linha['CLASS'] ?></span> <span class="spanView"><i style="color: #f5e200;" class="bi bi-star-fill"></i>5</span></h2>
                <img class="mt-3 imgSize" style="object-fit: cover; border-radius: 32px;     box-shadow: inset 0 0 1em white, 0 0 1em #9d9d9d;" src="
                <?php switch ($linha['CLASS']) {
                    case ('Engenharias'):
                        echo '../../assets/img/simbolo-engenharia.jpg';
                        break;
                    case ('Ciências da Saúde'):
                        echo '../../assets/img/simbolo-medicina.jpeg';
                        break;
                    case ('Ciências Sociais Aplicadas'):
                        echo '../../assets/img/simbolo-sociais.jpeg';
                        break;
                }
                ?>" alt="...">
            </div>
            <div class="col-md-6 p-4">
                <center class="mt-3 btWrap">
                    <!-- <a href="#" class="btnEntrarContato text-center">Contato pelo chat</a> -->
                    <?php
                    // RELAÇÃO
                    $selectVerificaRelacao = "SELECT COUNT(*) numVerificaRelacao FROM relacao WHERE ID_USER = $id_aluno AND ID_CURSO = $id_curso";
                    $queryVerificaRelacao = $pdo->prepare($selectVerificaRelacao);
                    $queryVerificaRelacao->execute();
                    $dadosVerificaRelacao = $queryVerificaRelacao->fetch(PDO::FETCH_ASSOC);
                    // FIM RELAÇÃO

                    $inscritos = $linha['INSCRITOS'];


                    // 

                    $sqlNumero_de_relacionamentos = "SELECT COUNT(*) numero_de_relacionamentos FROM relacao WHERE ID_USER = $id_aluno";
                    $queryNumero_de_relacionamentos = $pdo->prepare($sqlNumero_de_relacionamentos);
                    $queryNumero_de_relacionamentos->execute();

                    $dadosNumero_de_relacionamentos = $queryNumero_de_relacionamentos->fetch(PDO::FETCH_ASSOC);

                    $numero_de_relacionamentos = $dadosNumero_de_relacionamentos['numero_de_relacionamentos'];

                    // 

                    // LANÇO VERIFICA DATA

                    $sqlVerificaData = "SELECT COUNT(*) numVerificaData FROM relacao WHERE ID_USER = $id_aluno AND DATA_ATV = '$dataAtv'";
                    $queryVerificaData = $pdo->prepare($sqlVerificaData);
                    $queryVerificaData->execute();
                    $dadosVerificaData = $queryVerificaData->fetch(PDO::FETCH_ASSOC);
                    ?>

                    <?php

                    date_default_timezone_set("America/Sao_Paulo");

                    $data = date('d/m/Y H:i:s');


                    if ($data >= '20/05/2023 08:00:00') : ?>

                        <h3>Incrições encerradas</h3>

                    <?php elseif ($dadosVerificaRelacao['numVerificaRelacao'] >= 1) : ?>

                        <!-- <form action="../../gerencie/desinscrever.php" method="POST">
                            <input type="hidden" name="curso" value="<?= $id_curso ?>">
                            <button type="submit" class="btnOutrosContatos text-center">Desinscrever</button>
                        </form> -->

                    <?php elseif ($dadosVerificaData['numVerificaData'] >= 1) : ?>

                        <span class="btnOutrosContatos text-center">Você já está escrito em um curso do dia <?= $dataAtv ?></span>

                    <?php elseif ($inscritos >= $linha['VAGAS']) : ?>

                        <span class="btnOutrosContatos text-center">Vagas esgotado</span>

                    <?php elseif ($numero_de_relacionamentos >= 4) : ?>

                        <span class="btnOutrosContatos text-center">Você já está escrito em 4 atividades</span>

                    <?php else : ?>

                        <!-- <form action="../../gerencie/inscreva.php" method="POST">
                            <input type="hidden" name="curso" value="<?= $id_curso ?>">
                            <button type="submit" class="btnOutrosContatos text-center">Inscreva-se</button>
                        </form> -->

                    <?php endif; ?>
                </center>
                <p style="margin-top: 60px;
    text-align: justify;
    background: #efefef;
    padding: 28px;
    border-radius: 36px;
    color: #8b0d64;
    box-shadow: inset 0 0 1em white, 0 0 1em #9d9d9d">
                    <span><b>Programação: </b></span><br>
                    <?= $linha['PROGRAMACAO'] ?><br><br>

                    <span><b>Convidados:</b></span><br>
                    <?= $linha['CONVIDADOS'] ?><br><br>

                    <span><b>Local:</b></span><br>
                    <?= $linha['LOCAL'] ?><br><br>

                    <span><b>Vagas disponiveis:</b> <?= $linha['VAGAS'] - $linha['INSCRITOS'] ?> <br> <b>Inscritos:</b> <?= is_null($linha['INSCRITOS']) ? 0 : $linha['INSCRITOS'] ?></span>
                </p>
            </div>
        </div>

    </div>


    <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../../assets/jquery/jquery-3.6.0.min.js"></script>
    <script>
        //<![CDATA[
        $(window).on('load', function() {
            $('#preloader .inner').fadeOut();
            $('#preloader').delay(350).fadeOut('slow');
            $('body').delay(350).css({
                'overflow': 'visible'
            });
        })
        //]]>
    </script>

</body>

</html>