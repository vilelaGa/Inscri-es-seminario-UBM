<!DOCTYPE html>
<html lang="pt-br">

<?php
session_start();

define("NOME_PAGINA", "Suas atividades");

$id_aluno = $_SESSION['id_aluno'];

include '../gerencie/verifyAluno.php';

include "../gerencie/connect.php";

$sql = "SELECT * FROM users WHERE ID = $id_aluno";
$query = $pdo->prepare($sql);
$query->execute();

$dados = $query->fetch(PDO::FETCH_ASSOC, PDO::FETCH_OBJ);


$sqlRelacao = "SELECT * FROM relacao WHERE ID_USER = $id_aluno";
$queryRelacao = $pdo->prepare($sqlRelacao);
$queryRelacao->execute();
$dadosRelacao = $queryRelacao->fetchAll(PDO::FETCH_ASSOC);

define("NOME_SITE", "UBM");
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!----======== CSS ======== -->

    <link rel="stylesheet" href="../assets/css/styleAluno.css">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../assets/img/LogoProVest.ico" type="image/x-icon">

    <!----===== Boxicons CSS ===== -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>


    <title><?= NOME_SITE ?> - <?= NOME_PAGINA ?></title>
</head>

<body>

    <nav class="sidebar close">
        <header>
            <div class="image-text">

                <span class="image">
                    <a href="../aluno/dash-aluno/1" title="Dash">
                        <img src="../assets/img/logoProVest.png" alt="">
                    </a>
                </span>

                <div class="text logo-text">
                    <span class="name">Aluno</span>
                    <span class="profession"><?= substr($dados['NOME'], 0, 9); ?></span>
                </div>
            </div>

            <i class='bx bx-chevron-right toggle'></i>
        </header>

        <div class="menu-bar">
            <div class="menu">

                <li class="search-box">
                    <i class='bx bx-search icon'></i>
                    <form action="resultado" method="POST">
                        <input type="search" placeholder="Pesquise..." name='pesquisa'>
                        <input type="hidden" name='pesquisa-select' value="Sugestões de pesquisa">
                    </form>
                </li>

                <ul class="menu-links">
                    <li class="nav-link">
                        <a href="selecionados" title="Cursos selecionados">
                            <i class='bx bx-home-alt icon'></i>
                            <span class="text nav-text">Cursos selecionados</span>
                        </a>
                    </li>



                </ul>
            </div>

            <div class="bottom-content">
                <li class="">
                    <a href="../gerencie/logout.php">
                        <i class='bx bx-log-out icon'></i>
                        <span class="text nav-text">Logout</span>
                    </a>
                </li>

                <li class="mode">
                    <div class="sun-moon">
                        <i class='bx bx-moon icon moon'></i>
                        <i class='bx bx-sun icon sun'></i>
                    </div>
                    <span class="mode-text text">Dark mode</span>

                    <div class="toggle-switch">
                        <span class="switch"></span>
                    </div>
                </li>

            </div>
        </div>

    </nav>

    <section class="home">
        <div class="text">Cursos inscritos - <span><a style="font-size: 1rem" href="../aluno/dash-aluno/1">Voltar</a></span></div>
        <div class="container mt-4">
            <div class="row">
                <?php

                for ($i = 0; $i < count($dadosRelacao); $i++) {

                    $id_curso_array = $dadosRelacao[$i]['ID_CURSO'];

                    $sqlCurso = "SELECT * FROM atividades WHERE ID = $id_curso_array";
                    $queryCursos = $pdo->prepare($sqlCurso);
                    $queryCursos->execute();

                    $row = $queryCursos->fetchAll(PDO::FETCH_ASSOC);

                ?>
                    <div class="col-md-3">
                        <div class="card cardVerMais text-center" style="width: 16rem;">
                            <img style="object-fit: cover; border-radius: 25px;  border-bottom: #b73861 solid 3px;" src="<?php switch ($row[0]['CLASS']) {
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
                                <h6 class="card-title"><b><?= $row[0]['CURSO'] ?></b></h6>
                                <hr>
                                <span>
                                    <p style="overflow: hidden; white-space: nowrap ;text-overflow: ellipsis;"><?= $row[0]['PROGRAMACAO'] ?></p>
                                    <?= $row[0]['DATA'] . ' - ' . $row[0]['HORA'] . 'h' ?>
                                </span>
                                <br><br>
                                <a href="vercurso/<?= $row[0]['ID'] ?>" class="btn btn-primary btnVerMais">Ver mais</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>

    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/jquery/jquery-3.6.0.min.js"></script>

    <script>
        const body = document.querySelector('body'),
            sidebar = body.querySelector('nav'),
            toggle = body.querySelector(".toggle"),
            searchBtn = body.querySelector(".search-box"),
            modeSwitch = body.querySelector(".toggle-switch"),
            modeText = body.querySelector(".mode-text");


        toggle.addEventListener("click", () => {
            sidebar.classList.toggle("close");
        })

        searchBtn.addEventListener("click", () => {
            sidebar.classList.remove("close");
        })

        modeSwitch.addEventListener("click", () => {
            body.classList.toggle("dark");

            if (body.classList.contains("dark")) {
                modeText.innerText = "Light mode";
            } else {
                modeText.innerText = "Dark mode";

            }
        });
    </script>

</body>

</html>