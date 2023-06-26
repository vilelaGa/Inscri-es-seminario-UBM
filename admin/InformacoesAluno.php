<?php


function InformacoesAluno($cpf)
{

    include '../gerencie/connect-sqlsrv.php';

    $sqlInformacoes = "SELECT 
        EMAIL,
        CPF,
        RA,
        NOME,
        CODCURSO,
        CURSO,
        PERIODO
    FROM (
    
    SELECT
        PPE.EMAIL,
        PPE.CPF,
        SAL.RA,
        UPPER(PPE.NOME) NOME,
        SCU.CODCURSO,
        SCU.NOME CURSO,
        SMA.PERIODO
    FROM
        SMATRICPL SMA (NOLOCK)
        INNER JOIN SPLETIVO SPL (NOLOCK) ON SMA.CODCOLIGADA = SPL.CODCOLIGADA
        AND SMA.IDPERLET = SPL.IDPERLET
        INNER JOIN SALUNO SAL (NOLOCK) ON SMA.CODCOLIGADA = SAL.CODCOLIGADA
        AND SMA.RA = SAL.RA
        INNER JOIN PPESSOA PPE (NOLOCK) ON SAL.CODPESSOA = PPE.CODIGO
        INNER JOIN SHABILITACAOFILIAL SHF (NOLOCK) ON SMA.CODCOLIGADA = SHF.CODCOLIGADA
        AND SMA.IDHABILITACAOFILIAL = SHF.IDHABILITACAOFILIAL
        INNER JOIN SCURSO SCU (NOLOCK) ON SHF.CODCOLIGADA = SCU.CODCOLIGADA
        AND SHF.CODCURSO = SCU.CODCURSO
    WHERE
        SPL.CODPERLET = '20231'
        AND SHF.CODTIPOCURSO = 1
        AND SCU.NOME NOT LIKE '%EAD%'
        AND SMA.CODSTATUS IN (1, 8, 11, 12, 14, 15, 16, 54)
      
    UNION
    ALL
    SELECT
        PPE.EMAIL,
        PPE.CPF,
        SAL.RA,
        UPPER(PPE.NOME) NOME,
        SCU.CODCURSO,
        SCU.NOME CURSO,
        SMA.PERIODO
    FROM
        SMATRICPL SMA (NOLOCK)
        INNER JOIN SPLETIVO SPL (NOLOCK) ON SMA.CODCOLIGADA = SPL.CODCOLIGADA
        AND SMA.IDPERLET = SPL.IDPERLET
        INNER JOIN SALUNO SAL (NOLOCK) ON SMA.CODCOLIGADA = SAL.CODCOLIGADA
        AND SMA.RA = SAL.RA
        INNER JOIN PPESSOA PPE (NOLOCK) ON SAL.CODPESSOA = PPE.CODIGO
        INNER JOIN SHABILITACAOFILIAL SHF (NOLOCK) ON SMA.CODCOLIGADA = SHF.CODCOLIGADA
        AND SMA.IDHABILITACAOFILIAL = SHF.IDHABILITACAOFILIAL
        INNER JOIN SCURSO SCU (NOLOCK) ON SHF.CODCOLIGADA = SCU.CODCOLIGADA
        AND SHF.CODCURSO = SCU.CODCURSO
    WHERE
        SPL.CODTIPOCURSO = 8
        AND SMA.CODSTATUS IN (121, 127, 130, 131, 133, 134, 146)
        AND CAST(CAST(GETDATE() AS DATE) AS DATETIME) BETWEEN CONVERT(
            DATETIME,
            '01/' + RIGHT(SPL.CODPERLET, 2) + '/' + LEFT(SPL.CODPERLET, 4),
            103
        )
        AND DATEADD(
            MONTH,
            6,
            CONVERT(
                DATETIME,
                '01/' + RIGHT(SPL.CODPERLET, 2) + '/' + LEFT(SPL.CODPERLET, 4),
                103
            )
        ) -1
       
        ) Alunos WHERE CPF = '$cpf'";

    $queryInformacoes = $pdo_sqlsrv->prepare($sqlInformacoes);
    $queryInformacoes->execute();

    $linhaInformacoes = $queryInformacoes->fetchAll(PDO::FETCH_ASSOC);


    // echo '<pre>';
    // print_r($linhaInformacoes);

    // die();

    if ($linhaInformacoes == NULL) {
        $linhaInformacoes = [
            0 => [
                "EMAIL" => "Não e aluno",
                "CPF" => "Não e aluno",
                "RA" => "Não e aluno",
                "NOME" => "Não e aluno",
                "CODCURSO" => "Não e aluno",
                "CURSO" => "Não e aluno",
                "PERIODO" => "-",
            ]
        ];

        return $linhaInformacoes;
    } else {
        return $linhaInformacoes;
    }
}
