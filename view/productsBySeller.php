<?php require '../model/interface.php';
  require 'commonElements.php';
  $seller = getUserJSON($conn, $_GET['srd']);
  $products = getProdsBySeller($conn);
?>

<!doctype html>
<html lang="en">
  <?php echo loadHeader("Category"); ?>

  <body ng-app="PageApp">
	<?php echo loadNavbar(getCategories($conn), getUserJson($conn)); ?>


	<div class="album py-5 bg-light" ng-controller="SellerInfoControl">
    <div class="row mx-5 my-3 alert alert-success">
			<span class="mx-auto">Seller: {{seller.firstName}} {{seller.lastName}} <b>|</b>
      Email: {{seller.email}}</span>
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
                        <h6 class="card-title text-success">Rs{{product.price}}</h6>
                        </div>
                    </div>
                </a>
                </div>

            </div>
        </div>
	</div>

	<?php echo loadCartIcon(); ?>

    <script>
      App.controller('SellerInfoControl', function ($scope){
      $scope.seller = JSON.parse('<?php echo $seller ?>');
      $scope.products = JSON.parse('<?php echo $products ?>');
      });
    </script>
    </body>
</html>