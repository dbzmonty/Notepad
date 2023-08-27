<?php

    $conn = mysqli_connect('localhost', 'dbz', 'root', 'notepad');
    mysqli_set_charset($conn, "utf8");

    if(!$conn)
    {
        echo "<div class='alert alert-danger' role='alert'>Database connection failed!</div>";
    }

?> 