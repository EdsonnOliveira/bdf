<?php
    session_start();
    include('PHP/CRUD.php');
    $pdo = new CRUD();
    $erro = '';

    if (isset($_GET['exit'])) {
        session_destroy();
        header('location: login.php');
        die();
    }

    if (isset($_SESSION['LOGIN'])) {
        header('location: Login/dashboard.php');
        die();
    }

    if (isset($_POST['submit'])) {
        $pdo->setTable('users');
        $pdo->setSQLGeneric("SELECT User, Password, Name, Type FROM users 
                             WHERE User = :User AND Password = :Password 
                             LIMIT 1");
        $pdo->execSQL(['User' => $_POST['user'], 'Password' => $_POST['password']]);
        if ($pdo->COUNT > 0) {
            $_SESSION['LOGIN']['USER'] = $_POST['user'];
            $_SESSION['LOGIN']['Name'] = $pdo->FETCH['Name'];

            switch ($pdo->FETCH['Type']) {
                case '1':
                    $_SESSION['LOGIN']['Type'] = 'Pastor';
                    break;
                case '2':
                    $_SESSION['LOGIN']['Type'] = 'Obreiro';
                    break;
            }
            
            header('location: Login/dashboard.php');
        } else
            $erro = 'Usuário e/ou Senha incorretos!';
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Login | Batista da Fé</title>
        <?php include('PHP/meta.php') ?>
        <link rel="stylesheet" type="text/css" href="CSS/Login.css">
    </head>
    <body>
        <form method='post'>
            <a href="index.php">
                <img src="IMG/Logo/Logo2.png" alt="Logo">
            </a>
            <h1>Login</h1>
            <h3 class='txtRed txt400 txtCenter' style='margin-top:-30px;margin-bottom:30px'><?= $erro ?></h3>
            <label for="user">
                <h1>Usuário</h1>
                <input type="text" name='user' id='user' placeholder='Digite seu Usuário' class='input ipRound ipBorder ipBorderBlack' maxlength='20' required autofocus>
            </label>
            <label for="password">
                <h1>Senha</h1>
                <input type="password" name='password' id='password' placeholder='Digite sua Senha' class='input ipRound ipBorder ipBorderBlack' maxlength='20' required>
            </label>
            <input type="submit" name='submit' class='button btBlack bt100 btRound txtWhite txt300' value='Entrar'>
            <a href="index.php" class='txtCenter'>Voltar</a>
        </form>
    </body>
</html>