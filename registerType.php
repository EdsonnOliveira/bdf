<section class='type'>
    <div class='type' onclick="location. href='register.php?type=1'">
        <img src="IMG/Custom/Cult.png" alt="">
        <h1>Cultos</h1>
    </div>
    <?php
        $pdo->setTable('course');
        $pdo->setSQLGeneric("SELECT count(*) as qt FROM course
                             WHERE Situation = 1");
        $pdo->execSQL();
        if ($pdo->FETCH['qt'] > 0) {
            ?>
            <div class='type' onclick="location. href='register.php?type=2'">
                <img src="IMG/Custom/Course.png" alt="">
                <h1>Cursos</h1>
            </div>
            <?php
        }
    ?>
</section>
<a href="index.php" class='txtCenter'>Voltar</a>