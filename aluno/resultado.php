<!DOCTYPE html>
<html lang="pt-br">

<?php
session_start();

define("NOME_PAGINA", "Resultados");
define("NOME_SITE", "UBM");

$id_aluno = $_SESSION['id_aluno'];

include '../gerencie/verifyAluno.php';
include "../gerencie/connect.php";

$sql = "SELECT * FROM users WHERE ID = $id_aluno";
$query = $pdo->prepare($sql);
$query->execute();

$dados = $query->fetch(PDO::FETCH_ASSOC, PDO::FETCH_OBJ);

// PESQUISA

@$caixa = $_POST['pesquisa'];

@$caixa = $_POST['pesquisa-select'] == 'Sugestões de pesquisa' ? $caixa : $_POST['pesquisa-select'];

$sqlPesquisa = "SELECT * FROM atividades WHERE CLASS LIKE '%$caixa%' OR PROGRAMACAO LIKE '%$caixa%' OR DATA LIKE '%$caixa%' OR CURSO LIKE '%$caixa%'";
$queryPesquisa = $pdo->prepare($sqlPesquisa);
$queryPesquisa->execute();

$dadosPesquisa = $queryPesquisa->fetchAll(PDO::FETCH_ASSOC);

// PESQUISA
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="shortcut icon" href="../assets/img/LogoProVest.ico" type="image/x-icon">
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
            <a class="logoUBM" href="dash-aluno/1">
                <img src="../assets/img/logoProVest.png">
            </a>

            <button style="color: #fff;" class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <i class="bi bi-list"></i>
            </button>

            <div class="collapse navbar-collapse linksLogSig" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <span class="spanPi text-light">
                        <?= substr($dados['NOME'], 0, 9); ?>
                    </span>

                    <span class="spanPi">
                        <a class="links-vermais" href="selecionados">Cursos selecionados</a>
                    </span>

                    <span class="spanPi">
                        <a class="links-vermais" href="../gerencie/logout.php">Logout</a>
                    </span>

                </div>
            </div>
    </nav>

    <div class="container cardContainerPesquisa">
        <div class="row">
            <a href="dash-aluno/1">Voltar</a>
            <div class="col-md-12">
                <form action="" method="post">
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
        </form>
    </div>
    </div>
    </div>


    <div class="container">
        <div class="row mt-4">
            <h5 class="mb-4">Resultados para: "<b><?= $caixa ?></b>"</h5>
            <?php if (count($dadosPesquisa) != 0) : ?>
                <?php foreach ($dadosPesquisa as $row) : ?>
                    <div class="col-md-4 cardsAling p-2">
                        <div class="card cardVerMais text-center" style="width: 16rem;">
                            <img style="object-fit: cover; border-radius: 25px;  border-bottom: #b73861 solid 3px;" src="<?php switch ($row['CLASS']) {
                                                                                                                                case ('Engenharias'):
                                                                                                                                    echo '../assets/img/simbolo-engenharia.jpg';
                                                                                                                                    break;
                                                                                                                                case ('Ciências da Saúde'):
                                                                                                                                    echo '../assets/img/simbolo-medicina.jpeg';
                                                                                                                                    break;
                                                                                                                                case ('Ciências Sociais Aplicadas'):
                                                                                                                                    echo '../assets/img/simbolo-sociais.jpeg';
                                                                                                                                    break;
                                                                                                                            }
                                                                                                                            ?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h6 class="card-title"><b><?= $row['CURSO'] ?></b></h6>
                                <hr>
                                <span>
                                    <p style="overflow: hidden; white-space: nowrap ;text-overflow: ellipsis;"><?= $row['PROGRAMACAO'] ?></p>
                                    <?= $row['DATA'] . ' - ' . $row['HORA'] . 'h' ?>
                                </span>
                                <br><br>
                                <a href="vercurso/<?= $row['ID'] ?>" class="btn btn-primary btnVerMais">Ver mais</a>
                            </div>
                        </div>

                    </div>
                <?php endforeach; ?>
            <?php else : ?>

                <div class="col-md-4 cardsAling p-2">
                    <h4>Nenhum resultado disponivel</h4>

                </div>

            <?php endif; ?>

        </div>
    </div>

    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/jquery/jquery-3.6.0.min.js"></script>
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