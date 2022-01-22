<?php
    require_once('./includes/header.php');
    
    if (!isset($_SESSION['FullName']))
    {   
        header("location:login.php");
    }    
    else if (isset($_POST["submit"]))
    {
        $UserID = $_SESSION['UserID'];
        $NoteText = $_POST['inputNote'];

        // Query
        $sql = 'INSERT INTO notes (CreatorUserID, NoteText) VALUES(?, ?)';

        // Create prepared statement
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql))
        {
            header("location:index.php?error=true");
        }
        else
        {
            // Binding parameters
            mysqli_stmt_bind_param($stmt, 'is', $UserID, $NoteText);
            // Executing prepared statement
            mysqli_stmt_execute($stmt);
            // Redirect to index site
            header("location:index.php");
        }

        require_once('./includes/footer.php');
    }
    else
    {
        header("location:index.php");
    }
?>
