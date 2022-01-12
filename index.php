<?php
    require_once('./includes/header.php');
      
    if (!isset($_SESSION['FullName']))
    {   
        header("location:login.php");
    }    
?>

<div class="container">

    <?php        
        if (isset($_SESSION['FullName']))
        {   
            var_dump($_SESSION['FullName']);
        }    
    ?>


</div>

<?php require_once('./includes/footer.php'); ?>