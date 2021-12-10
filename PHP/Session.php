<?php
    session_start();
    date_default_timezone_set('Brazil/east');
    if (!isset($_SESSION['LOGIN'])) {
        session_destroy();
        header('location: ../login.php');
    }
?>