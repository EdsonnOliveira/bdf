<label for="name">
    <h1>Nome</h1>
    <input type="text" name='name' id='name' placeholder='Digite seu nome' class='input ipRound ipBorder ipBorderBlack' maxlength='25' required>
</label>
<label for="cell">
    <h1>Celular</h1>
    <input type="text" name='cell' id='cell' placeholder='Digite seu número de Celular' class='input ipRound ipBorder ipBorderBlack celular' required>
</label>
<label for="cult">
    <h1>Culto</h1>
    <select name="idCult" id="cult" class='input ipRound ipBorder ipBorderBlack' required>
        <?php
            $pdo->setTable('cult');
            $pdo->setSQLGeneric("SELECT * FROM cult
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
            }
        ?>
    </select>
</label>
<label for=''>
    <div>
        <h1>Horário</h1>
        <select name="idTime" class='input ipRound ipBorder ipBorderBlack txtCenter' required>
            <?php
                $pdo->setTable('cult_time');
                $pdo->setSQLGeneric("SELECT a.ID, a.IDCult, a.Time FROM cult_time a, cult b
                                        WHERE a.IDCult = b.ID AND b.Situation = 1");
                $pdo->addOrderBy('ID', 'ASC');
                $pdo->execSQL(null, true);
                
                $i = 0;
                foreach ($pdo->FETCH as $f) {
                    if ($i == 0)
                        echo '<option value="' . $f['ID'] . '" cult="' . $f['IDCult'] . '" selected>' . $f['Time'] . '</option>';
                    else
                        echo '<option value="' . $f['ID'] . '" cult="' . $f['IDCult'] . '">' . $f['Time'] . '</option>';
                    $i++;
                }
            ?>
        </select>
    </div>
    <div>
        <h1>Lugares</h1>
        <input type="number" name='places' value='1' class='input ipRound ipBorder ipBorderBlack txtCenter places' min='1' max='5' required>
    </div>
</label>
<input type="submit" name='submit' class='button btBlack btBigger btRound txtWhite txt300' value='Inscrever-se'>
<a href="register.php" class='txtCenter'>Voltar</a>