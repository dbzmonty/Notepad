<?php
    require_once('./includes/db.php'); 
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Notepad</title>
    <link rel="stylesheet" href="https://bootswatch.com/4/cerulean/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./css/custom.css">
</head>
<body>
    <!--Start Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand">Notepad</a>
            <?php 
                if (isset($_SESSION['FullName']))
                {
                    echo '<a class="navbar-brand">[';
                    echo $_SESSION['FullName'];
                    echo ']</a>';
                    echo '
                        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                            data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarResponsive">
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item">
                                    <button type="button" class="nav-link active btn" data-toggle="modal" data-target="#ModalCenter">Add</button>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active btn" href="index.php">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active btn" href="logout.php">Logout</a>
                                </li>                        
                            </ul>
                        </div>        
                    ';
                }
            ?>
        </div>
    </nav>
    <!--End Navigation-->