<label for="name">
    <h1>Nome</h1>
    <input type="text" name='name' id='name' placeholder='Digite seu nome' class='input ipRound ipBorder ipBorderBlack' maxlength='25' required>
</label>
<label for="cell">
    <h1>Celular</h1>
    <input type="text" name='cell' id='cell' placeholder='Digite seu número de Celular' class='input ipRound ipBorder ipBorderBlack celular' required>
</label>
<label for="course">
    <h1>Curso</h1>
    <select name="idCourse" id="course" class='input ipRound ipBorder ipBorderBlack' required>
        <?php
            $pdo->setTable('course');
            $pdo->setSQLGeneric("SELECT * FROM course
                                 WHERE Situation = 1");
            $pdo->addOrderBy('ID', 'ASC');
            $pdo->execSQL(null, true);
            
            $i = 0;
            foreach ($pdo->FETCH as $f) {
                if ($i == 0)
                    echo '<option value="' . $f['ID'] . '" selected>' . $f['Name'] . ' - ' . $f['DayWeek'] . '</option>';
                else
                    echo '<option value="' . $f['ID'] . '">' . $f['Name'] . ' - ' . $f['DayWeek'] . '</option>';
                $i++;
                $subscription = $f['Subscription'];
                $dateInitial = $f['DateInitial'];
                $dateFinal = $f['DateFinal'];
            }
        ?>
    </select>
</label>
<label for="name">
    <h1>Inscrição</h1>
    <input type="text" name='subscription' id='subscription' value="<?= $subscription ?>" class='input ipRound ipBorder ipBorderBlack' disabled>
</label>
<label for=''>
    <div>
        <h1>Data Inicial</h1>
        <input type="text" value="<?= date('d/m/Y', strtotime($dateInitial)) ?>" class='input ipRound ipborder ipBorderBlac txtCenter' disabled>
    </div>
    <div>
        <h1>Data Final</h1>
        <input type="text" value="<?= date('d/m/Y', strtotime($dateFinal)) ?>" class='input ipRound ipborder ipBorderBlac txtCenter' disabled>
    </div>
</label>
<input type="submit" name='submit' class='button btBlack btBigger btRound txtWhite txt300' value='Inscrever-se'>
<a href="register.php" class='txtCenter'>Voltar</a>