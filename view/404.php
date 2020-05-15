<?php require '../model/interface.php';
  require 'commonElements.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <?php echo loadHeader("User"); ?>

  </head>
  <body ng-app="PageApp">
    <?php echo loadNavbar(getCategories($conn), getUserJson($conn)); ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="error-template">
                <h1>
                    Oops!</h1>
                <h2>
                    404 Not Found</h2>
                <div class="error-details">
                    Sorry, an error has occured, Requested page not found!
                </div>
                <div class="error-actions">
                    <a href="index.php" class="btn btn-primary btn-lg"><i class="fa fa-home"></i>
                    Take Me Home </a>
                    <a href="contact.php" class="btn btn-default btn-lg"><i class="fas fa-envelope"></i> Contact Support </a>
                </div>
            </div>
        </div>
    </div>
</div>
  </body>
</html>