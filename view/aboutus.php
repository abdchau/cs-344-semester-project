<?php
require '../model/interface.php';
require 'commonElements.php';
?>

<!doctype html>
<html lang="en">
	<?php echo loadHeader("About Us"); ?>

	<body ng-app="PageApp">
		<?php echo loadNavbar(getCategories($conn), getUserJson($conn)); ?>
	<div class="bg-light">
	  <div class="container py-4">
	    <div class="row h-50 align-items-center	mx-auto">
	      <div class="col-lg-6">
	        <h1 class="display-4">About us</h1>

	      </div>
	      <div class="col-lg-6 d-none d-lg-block"></div>
	    </div>
	  </div>
	</div>


<div class="bg-white pt-3 mx-2	">
  <div class="container">
    <div class="row align-items-center mb-3">
      <div class="col-lg-6 order-2 order-lg-1"><i class="fas fa-address-card  fa-2x mb-3 text-primary"></i>
        <h2 class="font-weight-light">Students of NUST H-12</h2>
        <p class="font-italic text-muted mb-4">Aspiring Computer Scientists, programming enthusiasts, and lovers of Web Engineering.</p>
      </div>
    </div>

  </div>
</div>

	    <div class="row text-center mt-0">

	      <div class="col-xl-3 col-sm-6 mb-5">
	        <div class="bg-white rounded shadow-sm py-5 px-4"><img src="https://res.cloudinary.com/mhmd/image/upload/v1556834133/avatar-2_f8dowd.png" alt="" width="100" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
	          <h5 class="mb-0">Sharique Pervaiz</h5><span class="small text-uppercase text-muted">CEO - Founder</span>
	          <ul class="social mb-0 list-inline mt-3">
	            <li class="list-inline-item"><a href="https://www.facebook.com" class="social-link"><i class="fab fa-facebook-square"></i></a></li>
	            <li class="list-inline-item"><a href="https://twitter.com" class="social-link"><i class="fab fa-twitter-square"></i></a></li>
	            <li class="list-inline-item"><a href="https://linkedin.com" class="social-link"><i class="fab fa-linkedin"></i></a></li>
	          </ul>
	        </div>
	      </div>

	      <div class="col-xl-3 col-sm-6 mb-5">
	        <div class="bg-white rounded shadow-sm py-5 px-4"><img src="https://res.cloudinary.com/mhmd/image/upload/v1556834133/avatar-2_f8dowd.png" alt="" width="100" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
	          <h5 class="mb-0">Ahmad Jarrar</h5><span class="small text-uppercase text-muted">Janitor</span>
	          <ul class="social mb-0 list-inline mt-3">
	            <li class="list-inline-item"><a href="https://www.facebook.com" class="social-link"><i class="fab fa-facebook-square"></i></a></li>
	            <li class="list-inline-item"><a href="https://twitter.com" class="social-link"><i class="fab fa-twitter-square"></i></a></li>
	            <li class="list-inline-item"><a href="https://linkedin.com" class="social-link"><i class="fab fa-linkedin"></i></a></li>
	          </ul>
	        </div>
	      </div>

	      <div class="col-xl-3 col-sm-6 mb-5 mx-auto">
	        <div class="bg-white rounded shadow-sm py-5 px-4"><img src="https://res.cloudinary.com/mhmd/image/upload/v1556834133/avatar-2_f8dowd.png" alt="" width="100" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
	          <h5 class="mb-0">Abdullah Hassan Chaudhry</h5><span class="small text-uppercase text-muted">CFO - Founder</span>
	          <ul class="social mb-0 list-inline mt-3">
	            <li class="list-inline-item"><a href="https://www.facebook.com" class="social-link"><i class="fab fa-facebook-square"></i></a></li>
	            <li class="list-inline-item"><a href="https://twitter.com" class="social-link"><i class="fab fa-twitter-square"></i></a></li>
	            <li class="list-inline-item"><a href="https://linkedin.com" class="social-link"><i class="fab fa-linkedin"></i></a></li>
	          </ul>
	        </div>
	      </div>
	    </div>
	  </div>
	</div>

	
	<?php echo loadCartIcon(); ?>
    <?php echo loadFooter(); ?>
	</body>

</html>