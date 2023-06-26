<nav class="sidebar close">
    <header>
        <div class="image-text">

            <span class="image">
                <a href="../dash-aluno/1" title="Dash">
                    <img src="../../assets/img/logoProVest.png" alt="">
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
                <form action="../resultado" method="POST">
                    <input type="search" placeholder="Pesquise..." name='pesquisa'>
                    <input type="hidden" name='pesquisa-select' value="Sugestões de pesquisa">
                </form>
            </li>

            <ul class="menu-links">
                <li class="nav-link">
                    <a href="../selecionados" title="Cursos selecionados">
                        <i class='bx bx-home-alt icon'></i>
                        <span class="text nav-text">Cursos selecionados</span>
                    </a>
                </li>



            </ul>
        </div>

        <div class="bottom-content">
            <li class="">
                <a href="../../gerencie/logout.php">
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