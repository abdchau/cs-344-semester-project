<?php require '../model/interface.php';
  require 'commonElements.php';
  $products = searchProducts($conn);
  $query = $_GET['query'];
?>

<!doctype html>
<html lang="en">
  <head>
    <?php echo loadHeader("Search Results"); ?>

	<title>Search Results</title>

  </head>
  <body ng-app="PageApp">
	<?php echo loadNavbar(getCategories($conn), getUserJson($conn)); ?>

	<div class="album py-5 bg-light" ng-controller="SearchInfoControl">
		<div class="container card shadow-lg">
			<h3 class="display-4 mb-5 mr-auto">Showing results for "{{query}}"</h3>
      <div ng-if="products == null">
        Oops! Sorry but we couldnt find any results in our inventory. Try searching something else.
      </div>
        <div class="row" style="padding: 5%" ng-repeat="product in products">
           <div class="card mb-3 prcard" style="width: 100%;">
          <a href="productDetail.php?prd={{product.productID}}">
				    <div class="row no-gutters">
				      <div class="col-md-4">
				        <div class="card-img-top" style="background: url('{{product.imageURL}}'); background-size:contain; background-position: center center;background-repeat:no-repeat; min-height:250px">
              </div>
				      </div>
				      <div class="col-md-8">
				        <div class="card-body">
				          <h5 class="card-title">{{product.productName}}</h5>
				          <p class="card-text">{{product.productDscrptn}}</p>
				          <p class="card-text"><small class="text-muted">Price: Rs{{product.price}}</small></p>
				        </div>
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
    <script>

      App.controller('SearchInfoControl', function ($scope){
            $scope.query = ('<?php echo $query ?>');
            console.log($scope.query);
            $scope.products = JSON.parse('<?php echo $products ?>');
            console.log($scope.products);

          });
  </script>
  </body>
</html>