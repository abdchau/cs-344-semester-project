<?php require '../model/interface.php'; 
  require 'commonElements.php';
  // if (!getUserJSON($conn)==null) {
  //   header("Location: index.php");
  // }
?>
<!doctype html>
<html lang="en">
  <head>
    <?php echo loadHeader("Search Results"); ?>

    <script type="text/javascript">
      $(document).ready(function(){
        $('#signin').click(function(e){
          e.preventDefault();
          verifyUser($('#inputEmail').val(), $('#inputPassword').val());

        });
      });
    </script>


  </head>
  <body ng-app="PageApp">
	<?php echo loadNavbar(getCategories($conn), $username); ?>


    
	<form class="form-signin" style="">
		<img class="mb-4" src="images/logo.jpg" alt="" width="72" height="72">
		<h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
		<label for="inputEmail" class="sr-only">Email address</label>
		<input type="email" id="inputEmail" class="form-control" placeholder="Email address" required="" autofocus="">
    <p style="color: white">.</p>
		<label for="inputPassword" class="sr-only">Password</label>
		<input type="password" id="inputPassword" class="form-control" placeholder="Password" required="">
		<div class="checkbox mb-3" style="padding-top: 20px">
		  <label>
		    <input type="checkbox" value="remember-me"> Remember me
		  </label>
		</div>
    <div style="padding-bottom: 20px">
		<button class="btn btn-lg btn-primary btn-block" type="submit" id="signin">Sign in</button>
		</div>
    <p>Dont have an account?</p>
    <a href=signup.html class="btn btn-lg btn-primary btn-block">Create an account</a>
  		<p class="mt-5 mb-3 text-muted">© 2020</p>
	</form>






    <!-- Optional JavaScript -->
    </body>
</html>