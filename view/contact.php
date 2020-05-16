<?php require '../model/interface.php';
  require 'commonElements.php';
?>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<!doctype html>
<html lang="en">
  <head>
    <?php echo loadHeader("Contact us"); ?>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">

    <title>Contact Us</title>



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
	<!-- Just an image -->

  <?php echo loadNavbar(getCategories($conn), getUserJson($conn)); ?>

  <section class="jumbotron text-center" style="background-color: white">
        <div class="container">
          <p>Got a Question?</p>
          <h1 class="jumbotron-heading">Contact Shopoholic</h1>
          <p class="lead text-muted">At Shopoholic we believe in providing excellent Service to our Customers.
However, if you still require more information or assistance, we’re here to help and answer any question you might have. We look forward to hearing from you 🙂.</p>
        </div>
  </section>
  <div style="padding: 5%; padding-top: 0%">
  <form class="container" style=" padding: 5%; border-radius: 50px; box-shadow: 5px 10px 8px 10px #e3f2fd;">
    <img class="mb-4" src="images\logo.jpg" alt="" width="72" height="72" style="display: block;margin: auto;">
    <p class="lead text-muted">Accurately selecting your specific issue from the drop-down lists below will enable us to direct your message to the right department. Once you select your issue, you will be able to contact us.</p>
      <div class="form-group row">

          <div class="col-sm-12">
          Your Email Address:
            <input type="email" class="form-control" name="Email" >
          </div>
      </div>
      <div class="form-group row">

          <div class="col-sm-12">

            <label for="city">How can we help you?</label>
            <select class="custom-select d-block w-100" id="country" required="">
              <option value="">Choose...</option>
              <option>I have a question related to delivery of my product</option>
              <option>I have an issue buying or selling</option>
              <option>I have a technical issue</option>
              <option>I want to report a fraud</option>
              <option>I have a question about my account</option>
            </select>
          </div>
      </div>
      <div class="form-group row">
          <div class="col-sm-12">
          Description and further details:
            <textarea type="text" class="form-control" rows="6"></textarea>
          </div>
      </div>
      <div class="form-group row">
          <div class="col-sm-6">
          Name:
            <input type="text" class="form-control" name="name" >
          </div>
          <div class="col-sm-6">
          Phone:
            <input type="email" class="form-control" name="Phone" >
          </div>
      </div>

      <div class="col-sm-9">
    <div class="form-group row">
      <div class="offset-sm-2 col-sm-12" style="padding-top: 20px ">
        <button class="btn btn-lg btn-primary btn-block" type="submit" id="submit">Submit</button>
      </div>
    </div>
  </div>
  <section id="contact" style="display: block;margin: auto;">
       <div class="container" >
           <div class="row">
             <div class="col-sm-12 col-md-6 col-lg-3 my-5">
               <div class="card border-0">
                  <div class="card-body text-center">
                    <i class="fa fa-phone fa-5x mb-3" aria-hidden="true"></i>
                    <h4 class="text-uppercase mb-5">call us</h4>
                    <p>+923322821541,+923000078220,+923345341819</p>
                  </div>
                </div>
             </div>
             <div class="col-sm-12 col-md-6 col-lg-3 my-5">
               <div class="card border-0">
                  <div class="card-body text-center">
                     <a href="https://www.google.com/maps/place/NUST/@33.6428817,72.9904797,17z/data=!3m1!4b1!4m5!3m4!1s0x38df9675aaaaaaab:0xc5180922c44eb86b!8m2!3d33.6428817!4d72.9926684" style="color: black">
                      <i class="fa fa-map-marker-alt fa-5x mb-3" aria-hidden="true"></i>
                    <h4 class="text-uppercase mb-5">office loaction</h4>
                   <address>NUST H-12, Islamabad</address>
                 </a>
                  </div>
                </div>
             </div>
             <div class="col-sm-12 col-md-6 col-lg-3 my-5">
               <div class="card border-0">
                  <div class="card-body text-center">
                    <i class="fa fa-globe fa-5x mb-3" aria-hidden="true"></i>
                    <h4 class="text-uppercase mb-5">email</h4>
                    <p>http://al.a.shopoholic.com</p>
                  </div>
                </div>
             </div>
           </div>
       </div>
    </section>
  </form>
</div>


  <?php echo loadCartIcon(); ?>
  <?php echo loadFooter(); ?>

  </body>
</html>