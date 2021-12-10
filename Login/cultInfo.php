<?php
    include('../PHP/Session.php');
    include('../PHP/CRUD.php');
    $pdo = new CRUD();

    if (!isset($_GET['id']))
        header('location: dashboard.php');

    $idTime = $_GET['id'];
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Culto | Batista da Fé</title>
        <?php include('PHP/meta.php'); ?>
        <link rel="stylesheet" type="text/css" href="CSS/Cult.css">
    </head>
    <body>
        <?php $titlePage = 'Culto'; include('PHP/header.php'); ?>
        <section class='filterTable'>
            <div>
                <h1><a href="dashboard.php">< Voltar</a></h1>
            </div>
        </section>
        <section class='tablePersonalized center'>
            <?php
                $pdo->setTable('cult');
                $pdo->setSQLGeneric("SELECT 
                                        b.DayWeek as DayWeek,
                                        b.Address as Address,
                                        b.Date as Date,
                                        a.Time as Time,
                                        b.Name as Name,
                                        sum(c.Places) as Places,
                                        b.Situation as Situation
                                    FROM
                                        cult_time a,
                                        cult b,
                                        cult_ticket c
                                    WHERE
                                        a.IDCult = b.ID AND c.IDTime = a.ID AND a.ID = :ID
                                    ORDER BY a.ID ASC LIMIT 1;");
                $pdo->execSQL(['ID' => $idTime]);

                $date = date('d/m/Y', strtotime($pdo->FETCH['Date'])) . ' às ' . date('H:i', strtotime($pdo->FETCH['Time']));

                switch ($pdo->FETCH['Situation']) {
                    case '1':
                        $color = 'blue';
                        $situation = 'Em Breve';
                         
                        if (date('d/m/Y') == $date)
                            $situation = 'Em instantes';
                        break;
                    case '2':
                        $color = 'yellow';
                        $situation = 'Pendente';
                        break;
                    case '3':
                        $color = 'red';
                        $situation = 'Cancelado';
                        break;
                    case '4':
                        $color = 'green';
                        $situation = 'Finalizado';
                        break;
                }

                echo "<article class='center'>";
                    echo "<div class='info'>";
                        echo "<h3 class='txtGreen'>" . $pdo->FETCH['DayWeek'] . "</h3>";
                        echo "<h1 class='txtBlack'>" . $pdo->FETCH['Address'] . "</h1>";
                        echo "<h2 class='txtGrey'>";
                            echo "<img src='IMG/Custom/Date.png'>";
                            echo $date;
                        echo "</h2>";
                    echo "</div>";
                    echo "<span>";
                        echo "<h1 class='txtBlack txt500'>" . $pdo->FETCH['Name'] . "</h1>";
                        echo "<h2 class='txtGrey txt500'>" . $pdo->FETCH['Places'] . " lugares preenchidos</h2>";
                    echo "</span>";
                    echo "<div class='situation'>";
                        echo "<span class='$color'>";
                            echo "<h1 class='txtUpper txt500 txtWhite'>$situation</h1> ";
                        echo "</span>";
                    echo "</div>";
                echo "</article>";
            ?>
        </section>
        <section class='tablePersonalized center'>
            <div class='expansive'>
                <h1 class='title txtLeft'>Inscritos</h1>
                <?php
                    $pdo->setTable('cult_ticket');
                    $pdo->setSQLGeneric("SELECT 
                                            Name, Cell, Places
                                        FROM
                                            cult_ticket
                                        WHERE
                                            IDTime = :ID
                                        ORDER BY ID ASC;");
                    $pdo->execSQL(['ID' => $idTime], true);

                    foreach ($pdo->FETCH as $f) {
                        switch ($f['Places']) {
                            case '1':
                                $color = 'green';
                                break;
                            case '2':
                                $color = 'blue';
                                break;
                            case '3':
                                $color = 'purple';
                                break;
                            case '4':
                                $color = 'yellow';
                                break;
                            case '5':
                                $color = 'red';
                                break;
                            default:
                                $color = 'blue';
                        }

                        echo "<article class='itemsBetween'>";
                            echo "<div class='info' style='justify-content:center'>";
                                echo "<h1 class='txtBlack'>" . $f['Name'] . "</h1>";
                                echo "<h2 class='txtGrey txt500'>" . $f['Cell'] . "</h2>";
                            echo "</div>";
                            echo "<div class='situation'>";
                                echo "<span class='$color'>";
                                    echo "<h1 class='txt500 txtWhite'>" . $f['Places'] . "</h1>";
                                echo "</span>";
                            echo "</div>";
                        echo "</article>";
                    }
                ?>
            </div>
        </section>
    </body>
</html>