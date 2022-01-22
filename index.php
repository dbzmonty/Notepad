<?php
    require_once('./includes/header.php');
      
    if (!isset($_SESSION['FullName']))
    {   
        header("location:login.php");
    }    
?>

<div class="container">

    <!-- Add note code -->
    <div class="modal fade" id="ModalCenter" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLongTitle">Add note</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <form action="add.php" method="POST">
                    <div class="modal-body">
                        <textarea class="form-control" id="inputNote" name="inputNote" rows="3" maxlength="255" required></textarea>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- List note(s) code -->
    <?php
        // Database error
        if (isset($_GET["error"]))
        {		
            if ($_GET["error"] == "true")
            {
            echo '
                <p>
                    <div class="alert alert-danger">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Something is wrong with the database :(</strong>
                    </div>   
                </p>';
            }
        }

        $UserID = $_SESSION['UserID'];
        $UserFullName = $_SESSION['FullName'] ;

        // Query
        $sql = 'SELECT * FROM notes WHERE CreatorUserID = ? ORDER BY ID desc';

        // Create prepared statement
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql))
        {
            header("location:index.php?error=true");
        }
        else
        {
            // Binding parameters
            mysqli_stmt_bind_param($stmt, 's', $UserID);
            // Executing prepared statement
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);
            
            while ($row = mysqli_fetch_assoc($result))
            {
                $ID = $row['ID'];
                $CreatedDate = $row['CreatedDate'];
                $ModifiedDate = $row['ModifiedDate'];
                $NoteText = $row['NoteText'];

                // Showing notes
                echo '
                <div class="col-6 mx-auto"> 
                    <div class="card">
                        <h4 class="card-header">
                            ';echo $CreatedDate; echo'
                            <div class="btn-group btn-group-sm float-right" role="group" aria-label="First group">
                                <button type="button" class="btn btn-info">M</button>
                                <button type="button" class="btn btn-warning">X</button>
                            </div>
                        </h4>
                        
                        <div class="card-body">';echo $NoteText; echo'</div>
                    </div>
                </div>
                ';
            }
        }
    ?>

</div>

<?php require_once('./includes/footer.php'); ?>