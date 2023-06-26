<?php

require '../gerencie/connect.php';

@$serc = $_POST['serc'];

$sql = "SELECT * FROM atividades WHERE CURSO LIKE '%$serc%' OR DATA LIKE '%$serc%'";
$query = $pdo->prepare($sql);
$query->execute();

$dados = $query->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UBM | Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</head>

<body>

    <nav class="navbar bg-dark d-flex justify-content-between">
        <div class="container">
            <div class="">
                <a class="navbar-brand text-white">UBM | Lista de presença</a>
            </div>
            <div class="">
                <div class="input-group mt-3 mb-3">
                    <form class="d-flex" action="" method="POST">
                        <input type="search" name='serc' class="form-control" placeholder="Curso, Data" aria-label="Recipient's username" aria-describedby="button-addon2">
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Selecionar</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <?php foreach ($dados as $linha) : ?>
                    <p><a class="btn btn-primary" href="pdf.php?vall=<?= $linha['ID'] ?>"><strong>Lista de presença: <?= $linha['CURSO'] ?></strong><?= ' - Dia: ' . $linha['DATA'] . ' - ' . $linha['HORA'] . 'h | ' . $linha['LOCAL'] ?></a></p>
                <?php endforeach; ?>
            </div>
        </div>
    </div>


</body>

</html>