<?php

    $bdd= new PDO('mysql:host=localhost; dbname=SEAL', 'pierre', 'BaseDeDonnĂ©es@2023');

    if (!$bdd) {
        die('error connected');
    }

?>