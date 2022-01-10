<?php

    $link = mysqli_connect('localhost', 'root', '', 'notepad');
    if (!$link) {
        echo "Database connection failed";
    }

?>