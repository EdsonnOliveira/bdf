<?php
    include('../PHP/Session.php');
    include('../PHP/CRUD.php');
    $pdo = new CRUD();
    
    $filter = [];
    for ($i = 1; $i < 5; $i++) {
        $pdo->setSQLGeneric("SELECT count(*) as qt FROM cult WHERE Situation = $i");
        $pdo->execSQL(null);
        array_push($filter, $pdo->FETCH['qt']);
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Dashboard | Batista da Fé</title>
        <?php include('PHP/meta.php'); ?>
    </head>
    <body>
        <?php $titlePage = 'Dashboard'; include('PHP/header.php'); ?>
        <section class='filterTable'>
            <div onclick="location. href='?filter=1'">
                <h1>Em Breve</h1>
                <aside class='blue'>
                    <h2><?=$filter[0]?></h2>
                </aside>
            </div>
            <div onclick="location. href='?filter=2'">
                <h1>Pendentes</h1>
                <aside class='yellow'>
                    <h2><?=$filter[1]?></h2>
                </aside>
            </div>
            <div onclick="location. href='?filter=3'">
                <h1>Cancelados</h1>
                <aside class='red'>
                    <h2><?=$filter[2]?></h2>
                </aside>
            </div>
            <div onclick="location. href='?filter=4'">
                <h1>Finalizado</h1>
                <aside class='green'>
                    <h2><?=$filter[3]?></h2>
                </aside>
            </div>
        </section>
        <section class='tablePersonalized center'>
            <?php
                $situation = 'is not null';
                if (isset($_GET['filter']))
                    $situation = ' = ' . $_GET['filter'];

                $pdo->setSQLGeneric("SELECT 
                                        a.id as id,
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
                                        a.IDCult = b.ID AND c.IDTime = a.ID AND b.Situation $situation
                                    GROUP BY a.id
                                    ORDER BY a.ID DESC;");
                $pdo->execSQL(null, true);
                foreach ($pdo->FETCH as $f) {
                    $id = $f['id'];
                    $link = '"cultInfo.php?id='."$id".'"';

                    $date = date('d/m/Y', strtotime($f['Date'])) . ' às ' . date('H:i', strtotime($f['Time']));

                    switch ($f['Situation']) {
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

                    echo "<article class='center' onclick='location. href=$link'>";
                        echo "<div class='info'>";
                            echo "<h3 class='txtGreen'>" . $f['DayWeek'] . "</h3>";
                            echo "<h1 class='txtBlack'>" . $f['Address'] . "</h1>";
                            echo "<h2 class='txtGrey'>";
                                echo "<img src='IMG/Custom/Date.png'>";
                                echo $date;
                            echo "</h2>";
                        echo "</div>";
                        echo "<span>";
                            echo "<h1 class='txtBlack txt500'>" . $f['Name'] . "</h1>";
                            echo "<h2 class='txtGrey txt500'>" . $f['Places'] . " lugares preenchidos</h2>";
                        echo "</span>";
                        echo "<div class='situation'>";
                            echo "<span class='$color'>";
                                echo "<h1 class='txtUpper txt500 txtWhite'>$situation</h1> ";
                            echo "</span>";
                        echo "</div>";
                    echo "</article>";
                }
            ?>
        </section>
    </body>
</html>