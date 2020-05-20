<?php
require '../model/interface.php';
require 'commonElements.php';
?>

<!doctype html>
<html lang="en">
	<?php echo loadHeader("Site Map"); ?>

	<body ng-app="PageApp">
	<?php echo loadNavbar(getCategories($conn), getUserJson($conn)); ?>
	<div class="container mt-5">


  <section id="sec1">

    <span class="h2">Products</span>&nbsp;&nbsp;&nbsp; <span class="d-none d-xs-none d-sm-none d-md-inline">(These will open with preset queries)</span>
    <div class="row">
      <div class="col-md-5">
        <ul>
          <li><a href="featuredProducts.php">Featured Products</a></li>
          <li><a href="bestSellers.php">Best Selling Products</a></li>
          <li><a href="productDetail.php?prd=1">Product Details</a></li>
          <li><a href="category.php?crd=1">Products by Category</a></li>
          <li><a href="productsBySeller.php?srd=1">Products by Seller</a></li>
        </ul>
      </div>

    </div>
  </section>
  <section id="sec2">

    <span class="h2">User</span>&nbsp;&nbsp;&nbsp; <span class="d-none d-xs-none d-sm-none d-md-inline">(You must be logged in to open these pages)</span>
    <div class="row">
      <div class="col-md-5">
        <ul>
          <li><a href="profile.php">Profile</a></li>
          <li><a href="admin.php">Admin - only for admin users</a></li>
          <li><a href="index.php">Home</a></li>
          <li><a href="checkout.php">Checkout</a></li>
          <li><a href="topVendors.php">Top Vendors</a></li>
        </ul>
      </div>
    </div>
  </section>
  <section id="sec3">

    <span class="h2">Miscellaneous</span>&nbsp;&nbsp;&nbsp; <span class="d-none d-xs-none d-sm-none d-md-inline">(Different kinds of pages)</span>
    <div class="row">
      <div class="col-md-5">
        <ul>
          <li><a href="aboutus.php">About Us</a></li>
          <li><a href="faqs.php">FAQs</a></li>
          <li><a href="contact.php">Contact Us</a></li>
          <li><a href="searchResult.php?query=samsung">Search Results</a></li>
        </ul>
      </div>
    </div>
  </section>
</div>

		<?php echo loadCartIcon(); ?>
	    <?php echo loadFooter(); ?>
	</body>

</html>