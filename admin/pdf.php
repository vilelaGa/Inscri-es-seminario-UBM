<?php

require_once '../vendor/autoload.php';
require '../gerencie/connect.php';
require_once '../admin/InformacoesAluno.php';

$id = $_GET['vall'];

$sql = "SELECT
            alunos.NOME,
            alunos.CPF,
            chave.DATA_ATV,
            atvs.PROGRAMACAO
        FROM
            users alunos
                INNER JOIN relacao chave ON alunos.ID = chave.ID_USER
                INNER JOIN atividades atvs ON atvs.ID = chave.ID_CURSO
            WHERE
                atvs.ID = $id ORDER BY alunos.NOME ASC
";
$query = $pdo->prepare($sql);
$query->execute();

$count = $query->rowCount();

$dados = $query->fetchAll(PDO::FETCH_ASSOC);

// var_dump($dados);

// die();
@$DATA = $dados[0]['DATA_ATV'];
@$Atividade = $dados[0]['PROGRAMACAO'];

// die();

// for ($i = 0; $i < $count; $i++) {

//     $CPF = $dados[$i]['CPF'];
//     $NOME = $dados[$i]['NOME'];
//     $res = InformacoesAluno($CPF);

//     // echo '<pre>';
//     // print_r($res);

//     // var_dump($res[0]['EMAIL']);
// }
// die();

// referenciando o namespace do dompdf

use Dompdf\Dompdf;

// instanciando o dompdf

$dompdf = new Dompdf(['enable_remote' => true]);

//lendo o arquivo HTML correspondente

$html = "
<!DOCTYPE html>
<html lang='pt-br'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv='X-UA-Compatible' content='ie=edge'>

    <title>Lista de presença</title>
</head>


<body>

    <style>
        h1 {
            text-align: center;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        table {
            border-collapse: collapse;
            margin: auto;
        }

        th,
        td {
            padding: 6px;
            text-align: center;
            width: 180px;
            font-size: 12px
        }

        th {
            font-weight: bold;
            font-size: 12px
        }

        
    </style>

    <center>
        <img width='100' src='http://sistema.ubm.br:8090/seminario/assets/img/lista.jpeg'>
        <h5>

           <span>Atividade: $Atividade</span><br>

            Data: $DATA<br>
        </h5>
    </center>  

    <table>
        <thead>
            <tr>   
                <th style='width: 50px; height: 20px; font-size: 12px;'></th>
                <th style='width: 280px; height: 20px; font-size: 12px;'>Nome</th>
                <th style='width: 50px; height: 20px; font-size: 12px;'>Matrícula</th>
                <th style='width: 50px; height: 20px; font-size: 12px;'>Período</th>
                <th>Curso</th>
                <th style='width: 280px; height: 20px; font-size: 12px;'>Assinatura</th>
            </tr>
        </thead>

        <tbody>
            ";
for ($i = 0; $i < $count; $i++) {

    @$CPF = $dados[$i]['CPF'];
    @$NOME = strtoupper($dados[$i]['NOME']);
    @$res = InformacoesAluno($CPF);

    @$RA = $res[0]['RA'];
    @$PERIODO = $res[0]['PERIODO'];
    @$CURSO = $res[0]['CURSO'];

    $html .= '<tr>';
    $html .= "<td style='width: 50px; height: 20px; font-size: 12px;'>$i</td>";
    $html .= "<td style='width: 280px; height: 20px; font-size: 12px;'>$NOME</td>";
    $html .= "<td style='width: 80px; height: 20px; font-size: 12px;'>$RA</td>";
    $html .= "<td style='width: 50px; height: 20px; font-size: 12px;'>$PERIODO</td>";
    $html .= "<td>$CURSO</td>";
    $html .= "<td style='width: 280px; height: 20px; font-size: 12px;'></td>";
    $html .= '</tr>';
}

$html .= '
</tbody>
</table>
</body>

</html>';


//inserindo o HTML que queremos converter

$dompdf->loadHtml($html);

// Definindo o papel e a orientação

$dompdf->setPaper('A4', 'landscape');

// Renderizando o HTML como PDF

$dompdf->render();

// Enviando o PDF para o browser

$dompdf->stream();
