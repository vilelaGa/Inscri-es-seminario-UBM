<?php

if (!$_SESSION['id_aluno']) {
    header("Location: http://sistema.ubm.br:8090/seminario/login");
    exit();
}
