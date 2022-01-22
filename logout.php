<?php
    session_start();
    unset($_SESSION['UserID']);
    unset($_SESSION['FullName']);
    header("location:login.php?succlogout=true");
?>
