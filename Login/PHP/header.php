<header>
    <aside>
        <a href="#" class='button btRound btRed btRounded txtWhite txt500 txtUpper txtNoDecoration'>
            <img src="IMG/Custom/play.png" alt="Play">
            Adicionar Live
        </a>
    </aside>
    <nav>
        <ul>
            <li>
                <a href="dashboard.php">
                    <img src="IMG/Custom/Home.png" alt="Home">
                    Dashboard
                </a>
            </li>
            <li>
                <a href="dashboard.php">
                    <img src="IMG/Custom/Ministry.png" alt="Ministry">
                    Ministérios
                </a>
            </li>
            <li>
                <a href="dashboard.php">
                    <img src="IMG/Custom/Member.png" alt="Member">
                    Membros
                </a>
            </li>
            <li>
                <a href="dashboard.php">
                    <img src="IMG/Custom/Church.png" alt="Church">
                    Igreja
                </a>
            </li>
            <li>
                <a href="dashboard.php">
                    <img src="IMG/Custom/Scale.png" alt="Scale">
                    Escalas
                </a>
            </li>
            <li>
                <a href="dashboard.php">
                    <img src="IMG/Custom/Finance.png" alt="Finance">
                    Financeiro
                </a>
            </li>
        </ul>
    </nav>
</header>
<div id='headerTop'>
    <img src="IMG/Custom/Menu.png" alt="" id='openMenu' >
    <div id='logo'>
        <img src="IMG/Logo/Logo2.png" alt="">
    </div>
    <h1 class='txtBlack txt500'><?= $titlePage; ?></h1>
    <div id='user'>
        <div>
            <h1 class='txtWhite txt400'><?= substr($_SESSION['LOGIN']['Name'], 0, 1) ?></h1>
        </div>
        <span>
            <h1 class='txtBlack txt400'><?= $_SESSION['LOGIN']['Name']?></h1>
            <h2 class='txtGrey txt400'><?= $_SESSION['LOGIN']['Type']?></h2>
        </span>
    </div>
    <aside>
        <nav>
            <ul>
                <li><a href="../login.php?exit">Sair</a></li>
            </ul>
        </nav>
    </aside>
</div>