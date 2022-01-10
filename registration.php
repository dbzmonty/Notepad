<?php require_once('./includes/header.php'); ?>

    <div class="container">
      
      <form class="py-4" action="index.php" method="POST">
            <div class="row">
                <div class="col">
                    <input type="text" name="username" class="form-control" placeholder="Username">
                </div>
                <div class="col">
                    <input type="text" name="useremail" class="form-control" placeholder="Email Address">
                </div>
                <div class="col">
                    <input type="submit" name="submit" class="form-control btn btn-secondary" value="Add New User">
                    <?php echo isset($error) ? "<p>Field can't be blank</p>": ''; ?>
                </div>
            </div>
        </form>

    </div>

<?php require_once('./includes/footer.php'); ?>