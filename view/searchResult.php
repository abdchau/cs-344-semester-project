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
	<?php echo loadNavbar(getCategories($conn), $username); ?>

	<div class="album py-5 bg-light" ng-controller="SearchInfoControl">
		<div class="container card shadow-lg">
			<h3 class="display-4 mb-5 mr-auto">Showing results for "{{query}}"</h3>
      <div ng-if="products == null">
        Oops! Sorry but we couldnt find any results in our inventory. Try searching something else.
      </div>
        <div class="row" style="padding-left: 5%" ng-repeat="product in products">
          <a href="productDetail.php?prd={{product.productID}}">		
           <div class="card mb-3 prcard" style="max-width: 540px;">
				    <div class="row no-gutters">
				      <div class="col-md-4">
				        <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
				      </div>
				      <div class="col-md-8">
				        <div class="card-body">
				          <h5 class="card-title">{{product.productName}}</h5>
				          <p class="card-text">{{product.productDscrptn}}</p>
				          <p class="card-text"><small class="text-muted">Price: Rs{{product.price}}</small></p>
				        </div>
				      </div>
				    </div>
			 	   </div>
          </a>		
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
  <div  id="cartIcon" style="position:fixed;bottom:20px;left:90%;" >
        <a href=checkout.php><img height=80% width=80% src="images/cart.png"></a>
</div>
	<!-- Optional JavaScript -->

    <script src="../controller/angular-1.3.14.js"></script>
    <script>
   
      App.controller('SearchInfoControl', function ($scope){
            $scope.query = ('<?php echo $query ?>');
            console.log($scope.query);
            $scope.products = JSON.parse('<?php echo $products ?>');
            console.log($scope.products);

          });
  </script>  
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  </body>
</html>