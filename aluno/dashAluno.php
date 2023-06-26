<!DOCTYPE html>
<html lang="pt-br">

<?php
session_start();

define("NOME_PAGINA", "Home");

$id_aluno = $_SESSION['id_aluno'];

include '../gerencie/verifyAluno.php';

include "_head.php";

include "../gerencie/connect.php";

$sql = "SELECT * FROM users WHERE ID = $id_aluno";
$query = $pdo->prepare($sql);
$query->execute();

$dados = $query->fetch(PDO::FETCH_ASSOC, PDO::FETCH_OBJ);

$sqlCurso = "SELECT * FROM atividades";
$queryCursos = $pdo->prepare($sqlCurso);
$queryCursos->execute();

$linha = $queryCursos->fetchAll(PDO::FETCH_ASSOC);

// PAGINAÇÃO
$limite = 8;

$pg = (isset($_GET['pag'])) ? (int)$_GET['pag'] : 1;

$countPag = $queryCursos->rowCount();

$qtdPag = ceil($countPag / $limite);

$inicio = ($pg * $limite) - $limite;

$sqlPag = "SELECT * FROM atividades ORDER BY ID ASC LIMIT " . $inicio . ", " . $limite;
$queryPag = $pdo->prepare($sqlPag);
$queryPag->execute();
$linhaPag = $queryPag->fetchAll(PDO::FETCH_ASSOC);

// PAGINAÇÃO
?>

<body>

    <?php include('_nav.php') ?>

    <section class="home">
        <div class="text d-flex justify-content-between">Cursos disponíveis

            <form action="../resultado.php" method="POST" class="form-position">
                <button name="pesquisa" value="Engenharias" class="btn btn-enge">Engenharias</button>
                <button name="pesquisa" value="Ciências da Saúde" class="btn btn-saude">Ciências da saúde</button>
                <button name="pesquisa" value="Ciências Sociais Aplicadas" class="btn btn-sociais">Ciências Sociais Aplicadas</button>
                <input type="hidden" name='pesquisa-select' value="Sugestões de pesquisa">
            </form>
        </div>
        <div class="container mt-4">
            <div class="row">
                <?php foreach ($linhaPag as $row) : ?>
                    <div class="col-md-3 mb-5">
                        <div class="card cardVerMais text-center" style="width: 16rem;">
                            <img style="object-fit: cover; border-radius: 25px; border-bottom: #b73861 solid 3px;" src="<?php switch ($row['CLASS']) {
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
                                                                                                                        ?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h6 class="card-title"><b><?= $row['CURSO'] ?></b></h6>
                                <hr>
                                <span class="">
                                    <p style="overflow: hidden; white-space: nowrap ;text-overflow: ellipsis;"><?= $row['PROGRAMACAO'] ?></p>
                                    <?= $row['DATA'] . ' - ' . $row['HORA'] . 'h' ?>
                                </span>
                                <br><br>
                                <a href="../vercurso/<?= $row['ID'] ?>" class="btn btn-primary btnVerMais">Ver mais</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

                <nav class="d-flex justify-content-center">
                    <?php if ($qtdPag > 1 && $pg <= $qtdPag) :
                    ?>
                        <?php for ($i = 1; $i <= $qtdPag; $i++) : ?>
                            <?php if ($i == $pg) : ?>

                                <ul class="pagination pagination-lg">
                                    <li class="page-item active" aria-current="page">
                                        <span class="page-link"><?= $i ?></span>
                                    </li>
                                </ul>

                            <?php else : ?>

                                <ul class="pagination pagination-lg">
                                    <li class="page-item"><a class="page-link" href="<?= $i ?>"><?= $i ?></a></li>
                                </ul>
                            <?php endif; ?>
                        <?php endfor; ?>
                    <?php endif;
                    ?>
                </nav>
            </div>
        </div>
    </section>



    <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../../assets/jquery/jquery-3.6.0.min.js"></script>

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