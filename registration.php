<?php
    require_once('./includes/header.php');

    if (isset($_POST["submit"]))
    {        
        // Filling variables
        $UserName = $_POST['inputUserName'];
        $Password = md5($_POST['inputPassword']);
        $FullName = $_POST['inputFullName'];
        
        // Check if username exists

        // Query
        $checkQuery = 'SELECT * FROM users where UserName = ?';
        // Create prepared statement
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $checkQuery))
        {
            header("location:registration.php?unsucc=true");
        }
        else
        {
            // Binding parameters
            mysqli_stmt_bind_param($stmt, 's', $UserName);
            // Executing prepared statement
            mysqli_stmt_execute($stmt);
    
            $result = mysqli_stmt_get_result($stmt);
            $num_rows = $result->num_rows;
            
            if ($num_rows == 0)
            {
                // If username available

                // Query
                $sql = 'INSERT INTO users (UserName, Password, FullName) VALUES(?, ?, ?)';
                // Create prepared statement
                $stmt = mysqli_stmt_init($conn);
                
                if (!mysqli_stmt_prepare($stmt, $sql))
                {
                    header("location:registration.php?unsucc=true");
                }
                else
                {
                    // Binding parameters                                  
                    mysqli_stmt_bind_param($stmt, 'sss', $UserName, $Password, $FullName);
                    // Executing prepared statement
                    mysqli_stmt_execute($stmt);
                    header("location:login.php?succreg=true");
                }
            }
            else
            {
                // If username exists
                header("location:registration.php?userexists=true");
            }
        }
    }
?>

<div class="container">

    <?php
        // Unsuccessful registration warning
        if (isset($_GET["unsucc"]))
        {		
            if ($_GET["unsucc"] == "true")
            {
            print '
                <p>
                    <div class="alert alert-danger">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Unsuccessful registration, try again!</strong>
                    </div>   
                </p>';
            }
        }

        // User already exists warning
        if (isset($_GET["userexists"]))
        {		
            if ($_GET["userexists"] == "true")
            {
            print '
                <p>
                    <div class="alert alert-warning">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Username already exists, try another one!</strong>
                    </div>   
                </p>';
            }
        }
    ?>

    <div class="col-6 mx-auto">
        <div class="card">
            <h4 class="card-header">Registration</h4>
                <div class="card-body">
                    <form action="registration.php" method="POST">                                
                        <label for="inputFullName" class="form-label">Full name:</label>
                        <input type="text" id="inputFullName" name="inputFullName" class="form-control" placeholder="Full name" required>
                        <br />
                        <label for="inputUserName" class="form-label">Username:</label>
                        <input type="text" id="inputUserName" name="inputUserName" class="form-control" placeholder="Username" required>
                        <br />
                        <label for="inputPassword" class="form-label">Password:</label>
                        <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required>
                        <br />                                
                        <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Registration</button>
                    </form>
                </div>                    
        </div>
    </div>
</div>

<?php require_once './includes/footer.php';?>