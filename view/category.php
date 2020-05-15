<?php require '../model/interface.php';
  require 'commonElements.php';
  if (!isset($_GET['crd'])) {
    header('Location: 404.php');
  }
  $categoryName = getCategoryName($conn);
  $products = getProdsByCategory($conn);
?>

<!doctype html>
<html lang="en">
<?php echo loadHeader("Category"); ?>

  <body ng-app="PageApp">
	<?php echo loadNavbar(getCategories($conn), getUserJson($conn)); ?>


	<div class="album py-5 bg-light" ng-controller="CategoryInfoControl">
		<div class="container card shadow-lg">
			<h3 class="display-4 mb-5 mr-auto">{{category.categoryName}}</h3>
            <div class="row">
                <div class="col-md-6 col-lg-3" ng-repeat="product in products">
                <a href="productDetail.php?prd={{product.productID}}" class="text-decoration-none">
                    <div class="card mb-4 shadow-sm product-info prcard">
                    <div class="card-img-top" style="background: url('{{product.imageURL}}'); background-size:contain; background-position: center center;background-repeat:no-repeat; min-height:250px">
							      </div>
                        <div class="card-body">
                        <h5 class="card-title text-secondary">{{product.productName}}</h5>
                        <h6 class="card-title text-success">Rs {{product.price}}</h6>
                        </div>
                    </div>
                </a>
                </div>

            </div>
            <nav class="mx-auto">
                <ul class="pagination">
                  <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                      <span aria-hidden="true">&laquo;</span>
                    </a>
                  </li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                      <span aria-hidden="true">&raquo;</span>
                    </a>
                  </li>
                </ul>
              </nav>
        </div>
	</div>

	<?php echo loadCartIcon(); ?>
	<?php echo loadFooter(); ?>

    <script>
      App.controller('CategoryInfoControl', function ($scope){
      $scope.category = JSON.parse('<?php echo $categoryName ?>');
      $scope.products = JSON.parse('<?php echo $products ?>');
      });
    </script>
    </body>
</html>