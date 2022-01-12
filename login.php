<?php
    require_once('./includes/header.php');

    if (isset($_POST["submit"]))
    {
        // Filling variables
        $UserName = $_POST['inputUserName'];
        $Password = md5($_POST['inputPassword']);
        
        // Check if username exists

        // Query
        $checkQuery = 'SELECT * FROM users where UserName = ? AND Password = ?';
        // Create prepared statement
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $checkQuery))
        {
            header("location:login.php?errlogin=true");
        }
        else
        {
            // Binding parameters
            mysqli_stmt_bind_param($stmt, 'ss', $UserName, $Password);
            // Executing prepared statement
            mysqli_stmt_execute($stmt);
    
            $result = mysqli_stmt_get_result($stmt);
            $num_rows = $result->num_rows;
            
            if ($num_rows == 1)
            {
                // If username / password correct
                $row = mysqli_fetch_assoc($result);
                $_SESSION['FullName'] = $row['FullName'];
                header("location:index.php");
            }
            else
            {
                // If username / password incorrect
                header("location:login.php?incorrectuser=true");
            }
        }
    }
?>

<div class="container">

    <?php
    // Successful registration
    if (isset($_GET["succreg"]))
    {		
        if ($_GET["succreg"] == "true")
        {
        print '
            <p>
                <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Successful registration!</strong>
                </div>   
            </p>';
        }
    }

    // Successful logout
    if (isset($_GET["succlogout"]))
    {		
        if ($_GET["succlogout"] == "true")
        {
        print '
            <p>
                <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>You logged out successfully!</strong>
                </div>   
            </p>';
        }

        if (isset($_SESSION['FullName']))
        {
            var_dump($_SESSION['FullName']);
        }
    }

    // Unsuccessful login
    if (isset($_GET["errlogin"]))
    {		
        if ($_GET["errlogin"] == "true")
        {
        print '
            <p>
                <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Failed to log in!</strong>
                </div>   
            </p>';
        }
    }

    // Incorrect Username / Password
    if (isset($_GET["incorrectuser"]))
    {		
        if ($_GET["incorrectuser"] == "true")
        {
        print '
            <p>
                <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Incorrect Username / Password!</strong>
                </div>   
            </p>';
        }
    }
    ?>
 
    <div class="col-6 mx-auto"> 
        <div class="card">
            <h4 class="card-header">Login</h4>
                <div class="card-body">
                    <form action="login.php" method="POST">                                                        
                        <label for="inputUserName" class="form-label">Username:</label>
                        <input type="text" id="inputUserName" name="inputUserName" class="form-control" placeholder="Username" required>
                        <br />                            
                        <label for="inputPassword" class="form-label">Password:</label>
                        <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required>
                        <br />
                        <button type="submit" class="btn btn-lg btn-primary btn-block" name="submit">Login</button>
                        <br />                            
                        Not registered yet? <a href="registration.php" class="btn btn-primary">Registration</a>
                    </form>
                </div>                    
        </div>
    </div>
</div>

<?php require_once('./includes/footer.php'); ?>