<!DOCTYPE html>
<html>
    <head>
        <title>Inscrição Enviada | Batista da Fé</title>
        <?php include('PHP/meta.php') ?>
        <script src='JS/Register.js'></script>
        <link rel="stylesheet" type="text/css" href="CSS/Register.css">
    </head>
    <body id='bodySuccess' style='align-items: center; justify-content: center'>
        <a href="index.php">
            <img src="IMG/Logo/Logo2.png" alt="Logo">
        </a>
        <section id='success'>
            <img src="IMG/Custom/Success.png" alt="">
            <?php
                switch ($_GET['type']) {
                    case '1':
                        echo "<h1 class='txtGreen txt700 txtCenter'>Obrigado<br>e um bom Culto!</h1>";
                        break;
                    case '2':
                        echo "<h1 class='txtGreen txt700 txtCenter'>Obrigado<br>e um bom Curso!</h1>";
                        break;
                }
            ?>
            <a href="index.php" class='txtCenter txtBlack'>Voltar</a>
        </section>
    </body>
</html>