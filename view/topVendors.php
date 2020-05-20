<?php require '../model/interface.php';
  require 'commonElements.php';
  if (!isset($_GET['srd'])) {
    header('Location: 404.php');
  }
  $Sellers = getTopVendors($conn);
?>

<!doctype html>
<html lang="en">
  <?php echo loadHeader("Top Vendors"); ?>

  <body ng-app="PageApp">
	<?php echo loadNavbar(getCategories($conn), getUserJson($conn)); ?>

	<div class="album py-5 bg-light" ng-controller="SellerInfoControl">
        <a href="productsBySeller.php?srd={{seller.sellerID}}" ng-repeat="seller in sellers">
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
        </a>
	</div>

	<?php echo loadCartIcon(); ?>
    <?php echo loadFooter(); ?>


    <script>
      App.controller('SellerInfoControl', function ($scope){
      $scope.sellers = JSON.parse('<?php echo $sellers ?>');
      });
    </script>
    </body>
</html>