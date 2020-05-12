<?php require '../model/interface.php';
  require 'commonElements.php';
  $categoryName = getCategoryName($conn);
  $products = getProdsByCategory($conn);
?>

<!doctype html>
<html lang="en">

<?php echo loadHeader("Category"); ?>

  <body ng-app="PageApp">
	<?php echo loadNavbar(getCategories($conn), $username); ?>


	<div class="album py-5 bg-light" ng-controller="CategoryInfoControl">
		<div class="container card shadow-lg">
			<h3 class="display-4 mb-5 mr-auto">{{category.categoryName}}</h3>
            <div class="row">

                <div class="col-lg-3" ng-repeat="product in products">
                <a href="productDetail.php?prd={{product.productID}}" class="text-decoration-none">
                    <div class="card mb-4 shadow-sm product-info">
                        <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
                        <div class="card-body">
                        <h5 class="card-title text-secondary">{{product.productName}}</h5>
                        <p class="card-text text-body">{{product.productDscrptn}}</p>
                        <h6 class="card-title text-success">Rs{{product.price}}</h6>
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

	<div  id="promotion" style="position:fixed;bottom:20px;left:90%;" >
        <a href="checkout.html"><img height=80% width=80% src="images/cart.png"></a>
    </div>
	<!-- Optional JavaScript -->

    <script>
      App.controller('CategoryInfoControl', function ($scope){
      $scope.category = JSON.parse('<?php echo $categoryName ?>');
      $scope.products = JSON.parse('<?php echo $products ?>');
      });
    </script>
    </body>
</html>