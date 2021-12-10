<?php
    include('PHP/CRUD.php');
    $pdo = new CRUD();
    $erro = '';
    if (isset($_POST['submit']) && isset($_GET['type'])) {
        if ($_GET['type'] == '1') {
            $pdo->setTable('cult_ticket');
            $pdo->setSQLGeneric("SELECT Cell FROM cult_ticket 
                                 WHERE Cell = :Cell AND IDCult = :IDCult LIMIT 1");
            $pdo->execSQL(['Cell' => $_POST['cell'], 'IDCult' => $_POST['idCult']]);

            if ($pdo->FETCH['Cell'] == null) {
                $pdo->setSQL($_POST, 'insert', null);
                $pdo->execSQL();
                header('location: RegisterSuccess.php?type=1');
            } else
                $erro = 'Esse Número de Celular já possui uma inscrição!';
        }
        if ($_GET['type'] == '2') {
            $pdo->setTable('course_ticket');
            $pdo->setSQLGeneric("SELECT Cell FROM course_ticket 
                                 WHERE Cell = :Cell AND IDCourse = :IDCourse LIMIT 1");
            $pdo->execSQL(['Cell' => $_POST['cell'], 'IDCourse' => $_POST['idCourse']]);

            if ($pdo->FETCH['Cell'] == null) {
                $pdo->setSQL($_POST, 'insert', null);
                $pdo->execSQL();
                header('location: RegisterSuccess.php?type=2');
            } else
                $erro = 'Esse Número de Celular já possui uma inscrição!';
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Inscrição | Batista da Fé</title>
        <?php include('PHP/meta.php') ?>
        <script src='JS/Register.js'></script>
        <link rel="stylesheet" type="text/css" href="CSS/Register.css">
    </head>
    <body>
        <form method='post'>
            <a href="index.php">
                <img src="IMG/Logo/Logo2.png" alt="Logo">
            </a>
            <h1>Inscrição</h1>
            <h3 class='txtRed txt400 txtCenter'><?= $erro ?></h3>
        <?php
            if (isset($_GET['type'])) {
                switch ($_GET['type']) {
                    case '1':
                        include('registerCult.php');
                        break;
                    case '2':
                        include('registerCourse.php');
                        break;
                }
            } else
                include('registerType.php');
        ?>
        </form>
    </body>
</html>