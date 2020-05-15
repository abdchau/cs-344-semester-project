<?php require '../model/interface.php';
  require 'commonElements.php';
  if (getUserJSON($conn)!="null") {
    header("Location: index.php");
  }
?>
<!doctype html>
<html lang="en">
  <head>
    <?php echo loadHeader("Sign In"); ?>

    <script type="text/javascript">
      $(document).ready(function(){
        $('#signin').click(function(e){
          // e.preventDefault();
          verifyUser($('#inputEmail').val(), $('#inputPassword').val());

        });
      });
    </script>

  </head>
  <body ng-app="PageApp">
	<?php echo loadNavbar(getCategories($conn), getUserJSON($conn)); ?>



	<form class="col-md-4 mx-3 mx-auto my-5 form-signin">
      <div class="container-md col-lg-10 mb-4">
        <img class="mb-4" src="images/logo.jpg" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" class="form-control my-3" placeholder="Email address" required="" autofocus="">
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control my-2" placeholder="Password" required="">
        <div class="checkbox mb-3">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <div style="padding-bottom: 20px">
        <button class="btn btn-lg btn-primary btn-block" type="submit" id="signin">Sign in</button>
        </div>
        <p>Dont have an account?</p>
        <a href=signup.php class="btn btn-lg btn-primary btn-block">Create an account</a>
    </div>
	</form>
  <?php echo loadFooter(); ?>
    </body>
</html>