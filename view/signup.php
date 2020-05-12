<?php require '../model/interface.php'; 
  require 'commonElements.php';
  ?>

<!doctype html>
<html lang="en">
  <head>
   <?php echo loadHeader("Search Results"); ?>


    <script type="text/javascript">
      $(document).ready(function(){
        $('#submit').click(function(e){
          //e.preventDefault();
          addUser($('#inputEmail').val(), $('#inputPassword').val(),
              $('#firstName').val(), $('#lastName').val(), $('#address').val(),
              $('#city').val(), $('#zipcode').val());

        });
      });
    </script>
  </head>
  <body ng-app="PageApp">
	<!-- Just an image -->
	<?php echo loadNavbar(getCategories($conn), $username); ?>

	<div class="container signupformouter">
	
  <form class="container signupform" >
  	<img class="mb-4" src="images/logo.jpg" alt="" width="72" height="72">
    <h1 class="h3 mb-3 font-weight-normal">SIGN UP</h1>
	<h3 class="h3 mb-3 font-weight-normal">Please fill the following form</h3>
  		<div class="form-group row">
  		
      		<div class="col-sm-12">
       			<input type="text" class="form-control" id="firstName" placeholder="First Name">
      		</div>
    	</div>
    	<div class="form-group row">
      	
      		<div class="col-sm-12">
       			<input type="text" class="form-control" id="lastName" placeholder="Last Name">
      		</div>
    	</div>
    	<div class="form-group row">
      	
      		<div class="col-sm-12">
       			<input type="email" class="form-control" id="inputEmail" placeholder="Email">
      		</div>
    	</div>
   		<div class="form-group row">
      	
      		<div class="col-sm-12">
       			<input type="password" class="form-control" id="inputPassword" placeholder="Password">
      		</div>
    	</div>
    	<div class="form-group row">
      	
      		<div class="col-sm-12">
       			<input type="password" class="form-control" id="confirmPassword" placeholder="Confirm Password">
      		</div>
    	</div>
      	
    	<div class="form-group row">
      	
      		<div class="col-sm-12">
       			<input type="text" class="form-control" id="address" placeholder="Address">
      		</div>
    	</div>
      <div class="form-group row">
        
          <div class="col-sm-12">
            <select class="custom-select d-block w-100" id="country" required="">
              <option value="">Choose city...</option>
              <option>Karachi</option>
              <option>Islamabad</option>
              <option>Quetta</option>
              <option>Lahore</option>
              <option>Faislabad</option>
              <option>Peshawar</option>
            </select>
          </div>
      </div>
      <div class="form-group row">
        
          <div class="col-sm-12">
            <input type="text" class="form-control" id="phone" placeholder="Phone no">
          </div>
      </div>
      <div class="form-group row">
        
          <div class="col-sm-12">
            <input type="text" class="form-control" id="zipcode" placeholder="ZIP">
          </div>
      </div>
   		<fieldset class="form-group row">
      
      <div class="col-sm-10">
        <div class="form-check" style="text-align: left;">
          <label class="form-check-label">
            <input class="form-check-input" type="radio">
            I agree to the <a href="#">terms and user</a> condition
          </label>
        </div>
    <div class="form-group row">
      <div class="offset-sm-2 col-sm-10" style="padding-top: 20px ">
        <button class="btn btn-lg btn-primary btn-block" type="submit" id="submit">Create my account</button>
      </div>
    </div>
  </form>
</div>

   
  </body>
</html>