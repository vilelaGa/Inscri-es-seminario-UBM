<!DOCTYPE html>
<html lang="pt-br">

<?php
define("NOME_PAGINA", "Início");
include("_head.php") ?>

<body style="background-color: #f4f4f4">

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

    <section class="bg-rgb">
        <style>
            .scrolling-active {
                background-color: #fff !important;
                box-shadow: 0 0 1em rgba(180, 180, 180, 0.486);
                border-bottom: 1px solid rgba(180, 180, 180, 0.486);
                transition: 0.5s;
            }

            .scrolling-active .navProVest {
                color: #000;

            }

            .scrolling-active .colorLinks {
                border: 1px solid #000;

            }

            .scrolling-active .linksLogSig a {
                color: #000 !important;
            }

            .scrolling-active .linksLogSig a:hover {
                color: #c4c4c4 !important;
            }
        </style>

        <?php include('_nav.php'); ?>

        <div class="bg-video">
            <video autoplay muted loop style="filter: saturate( 0% )!important;">
                <source src="assets/img/pexels-yan-krukov-8197045.mp4" type="video/mp4">
            </video>
            <div class="container tudoMeio">
                <div class="row">
                    <div class="col-md-6 d-flex justify-content-center">
                        <h2 class="tittle_semi">SEMINÁRIO<br>
                            de ENSINO<br>
                            <span class="eMonster">E</span> EXTENSÃO
                        </h2>
                    </div>
                    <div class="col-md-1">
                        <div class="barra"></div>
                    </div>
                    <div class="col-md-4">
                        <h3 class="tittle_2">MINICUROS<br>
                            PALESTRAS<br>
                            SEMINÁRIOS<br>
                            <span class="eMonster">E</span> MUITO MAIS<span class="eMonster">...</span>
                        </h3>
                    </div>
                </div>
            </div>
            <footer class="DEUSTANOCODIGO">
                <a class="nav-link active colorLinks text-center mb-2" aria-current="page" href="login">Login</a>
            </footer>
        </div>

    </section>

    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/jquery/jquery-3.6.0.min.js"></script>
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
    <script>
        // window.addEventListener('scroll', function() {
        //     let nav = document.querySelector('nav');
        //     let windowPosition = window.scrollY > 0;
        //     nav.classList.toggle('scrolling-active', windowPosition);
        // })
    </script>
</body>

</html>