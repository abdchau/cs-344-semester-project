<?php
require '../model/interface.php';
require 'commonElements.php';
?>

<!doctype html>
<html lang="en">
	<?php echo loadHeader("FAQs"); ?>

	<body ng-app="PageApp">
	<?php echo loadNavbar(getCategories($conn), getUserJson($conn)); ?>
	<h3 class="display-4 ml-5 my-3">FAQs</h3>
	<div id="accordion" class="my-5 col-md-8 mx-auto text-red">
	  <div class="card">
	    <div class="card-header" id="headingOne">
	      <h5 class="mb-0">
	        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
	          WHAT IS SHOPOHOLIC?
	        </button>
	      </h5>
	    </div>

	    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
	      <div class="card-body">
	        Shopoholic is a complete package for all your electronic e-commerce needs.
	      </div>
	    </div>
	  </div>
	  <div class="card">
	    <div class="card-header" id="headingTwo">
	      <h5 class="mb-0">
	        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
	          WHAT KIND OF PRODUCTS ARE ON OFFER?
	        </button>
	      </h5>
	    </div>
	    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
	      <div class="card-body">
	        Shopoholic is primarily intended for electronic devices and gadgets, and we want to be the best in field.<br><br> In the future, we intend to expand into other domains as well, so keep following us!
	      </div>
	    </div>
	  </div>
	  <div class="card">
	    <div class="card-header" id="headingThree">
	      <h5 class="mb-0">
	        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
	          WHY USE SHOPOHOLIC?
	        </button>
	      </h5>
	    </div>
	    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
	      <div class="card-body">
	        We are a world-class company with tried and tested methods. Our customers trust us fully, buyers and sellers alike!<br><br> Products are quality assured, and we even provide insurance policies in cases of fraud.
	      </div>
	    </div>
	  </div>
	  <div class="card">
	    <div class="card-header" id="headingFour">
	      <h5 class="mb-0">
	        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
	          WHAT KINDS OF AWARDS HAS SHOPOHOLIC WON?
	        </button>
	      </h5>
	    </div>
	    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
	      <div class="card-body">
	        Shopoholic has won the following awards:<br><br>
	        <ul>
	        	<li>Pakistan Best E-Commerce Website 2018</li>
	        	<li>Pakistan Best E-Commerce Website 2019</li>
	        	<li>Pakistan Best E-Commerce Website 2020</li>
	        	<li>Pakistan Best E-Commerce Website 2017</li>
	        	<li>Pakistan Best E-Commerce Website 2016</li>
	        </ul>
	      </div>
	    </div>
	  </div>
	</div>

		<?php echo loadCartIcon(); ?>
	    <?php echo loadFooter(); ?>
	</body>

</html>