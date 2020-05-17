<?php require '../model/interface.php';
  require 'commonElements.php';
  if (!isset($_GET['srd'])) {
    header('Location: 404.php');
  }
  $seller = getUserJSON($conn, $_GET['srd']);
  $products = getProdsBySeller($conn);
?>

<!doctype html>
<html lang="en">
  <?php echo loadHeader("Category"); ?>

  <body ng-app="PageApp">
	<?php echo loadNavbar(getCategories($conn), getUserJson($conn)); ?>


	<div class="album py-5 bg-light" ng-controller="SellerInfoControl">

  <div class="container card shadow my-3">
          <div class="row no-gutters">
            <div class="col-md-4">
              <div class="card-img-top" style="background: url('images/profile.png'); background-size:contain; background-position: center center;background-repeat:no-repeat; min-height:200px">
              </div>
            </div>
            <div class="col-md-8">
              <div class="card-body">
              <h3 class="card-title mt-4 text-secondary">{{seller.firstName}} {{seller.lastName}}</h3>
                <h5 class="card-title mt-3 text-secondary">Email: {{seller.email}}</h5>
              </div>
            </div>
          </div>
        </div>
		<div class="container card shadow-lg">
			<h3 class="display-4 mb-5 mr-auto">Products</h3>
            <div class="row">
                <div class="col-md-6 col-lg-3" ng-repeat="product in products">
                <a href="productDetail.php?prd={{product.productID}}" class="text-decoration-none">
                    <div class="card mb-4 shadow-sm product-info prcard">
                    <div class="card-img-top" style="background: url('{{product.imageURL}}'); background-size:contain; background-position: center center;background-repeat:no-repeat; min-height:250px">
							      </div>
                        <div class="card-body">
                        <h5 class="card-title text-secondary">{{product.productName}}</h5>
                        <h6 class="text-success">Rs {{product.price}} <span class="text-warning" ng-if="product.stock > 0 && product.stock <11" style="font-size: 70%; float: right"> *Limited stock</span><span class="text-danger" ng-if="product.stock == 0" style="font-size: 70%; float: right"> *Out of stock</span></h6>
                        </div>
                    </div>
                </a>
                </div>

            </div>
        </div>
	</div>

	<?php echo loadCartIcon(); ?>
    <?php echo loadFooter(); ?>


    <script>
      App.controller('SellerInfoControl', function ($scope){
      $scope.seller = JSON.parse('<?php echo $seller ?>');
      $scope.products = JSON.parse('<?php echo $products ?>');
      });
    </script>
    </body>
</html>