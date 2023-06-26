<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">

<?php
define("NOME_PAGINA", "Login / Cadastro");
include("_head.php");
?>

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

    <nav class="navbar colorNavBarLogin text-center">
        <div class="container">
            <a class="navbar-brand" href="home">
                <img src="./assets/img/logoProVest.png" alt="logoProvest">
                <!-- <span style="    color: #fff;
    font-size: 1.5rem;">UBM</span> -->
            </a>
        </div>
    </nav>

    <div class="container text-center">
        <div class="row">
            <div class="col-md-12">

                <ul class="nav nav-tabs centerNavsTabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="login-tab" data-bs-toggle="tab" data-bs-target="#login" type="button" role="tab" aria-controls="home" aria-selected="true">Login</button>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
                        <div class="container widthContainer">
                            <div class="row">
                                <div class="col-md-12 cardForm">
                                    <!-- <form action="gerencie/login-a.php" method="POST"> -->
                                    <form action="" method="POST">
                                        <?php
                                        if (isset($_SESSION['user_invalido'])) :
                                        ?>
                                            <div style="font-size: 16px; border-radius: 50px;" class="alert alert-danger" role="alert">
                                                Credencias Incorretas
                                            </div>
                                        <?php
                                        endif;
                                        unset($_SESSION['user_invalido']);
                                        ?>
                                        <input type="text" id='cpf' class="form-control" name="cpf" placeholder="Seu cpf"><br>
                                        <button type="submit" class="form-control btnLogin">Entrar</button><br>
                                        <a style="font-size: 16px;" href="NORMAS PARA REALIZAÇÃO DO SEMINÁRIO DE ENSINO E EXTENSÃO 2023.1.pdf" target="_blank">Normas de realização</a>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
    <footer class="DEUSTANOCODIGO">
        <p style="color: #000;">EKBALLO</p>
    </footer>
    </div>


    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/jquery/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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

        $(document).ready(function() {
            $('#cpf').mask('000.000.000-00')
        });
    </script>

</body>

</html>