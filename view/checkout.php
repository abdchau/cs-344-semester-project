<?php require '../model/interface.php';
  require 'commonElements.php';
  $products = getCart($conn, $username);
?>

<!DOCTYPE html>
<html>
<head>
	<?php echo loadHeader("Checkout"); ?>
</head >



<body class="bg-light" ng-app="PageApp">

  <?php echo loadNavbar(getCategories($conn), $username); ?>

    <div class="container">
  <div class="py-5 text-center">
    <img class="d-block mx-auto mb-4" src="images/logo.jpeg" alt="" width="72" height="72">
    <h2>Checkout form</h2>
    <p class="lead">Your cart is displayed below. Please fill the required details and press the checkout button to complete your order.</p>
  </div>

  <div class="row" ng-controller="ListControl">
    <div class="col-md-4 order-md-2 mb-4"  >
      <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted">Your cart</span>
        <span class="badge badge-secondary badge-pill">{{products.length}}</span>
      </h4>
      <ul class="list-group mb-3" >
        <li class="list-group-item d-flex justify-content-between lh-condensed" ng-repeat="product in products">
          <div>
            <h6 class="my-0" >{{product.productName}}</h6>
            <small class="text-muted">{{product.productDscrptn}}</small>
          </div>
          <span class="text-muted">Rs{{product.price}}</span>
        </li>
        <li class="list-group-item d-flex justify-content-between">
          <span>Total (RS)</span>
          <strong>{{total}}</strong>
        </li>
      </ul>
    </div>
    <div class="col-md-8 order-md-1">
      <h4 class="mb-3">Billing address</h4>
      <form class="needs-validation" novalidate="">
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="firstName">First name</label>
            <input type="text" class="form-control" id="firstName" value="{{user.firstName}}" value="" required="">
            <div class="invalid-feedback">
              Valid first name is required.
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="lastName">Last name</label>
            <input type="text" class="form-control" id="lastName" value="{{user.lastName}}" value="" required="">
            <div class="invalid-feedback">
              Valid last name is required.
            </div>
          </div>
        </div>

        <div class="mb-3">
          <label for="email">Email <span class="text-muted">(Optional)</span></label>
          <input type="email" class="form-control" id="email" value="{{user.email}}">
          <div class="invalid-feedback">
            Please enter a valid email address for shipping updates.
          </div>
        </div>

        <div class="mb-3">
          <label for="address">Address</label>
          <input type="text" class="form-control" id="address" value="{{user.address}}" required="">
          <div class="invalid-feedback">
            Please enter your shipping address.
          </div>
        </div>

        <div class="mb-3">
          <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
          <input type="text" class="form-control" id="address2" placeholder="Apartment or suite">
        </div>

        <div class="row">
          <div class="col-md-5 mb-3">
            <label for="country">City</label>
            <select class="custom-select d-block w-100" id="city" required="">
              <option value="">{{user.cityName}}</option>
              <option>Karachi</option>
              <option>Islamabad</option>
              <option>Quetta</option>
              <option>Lahore</option>
              <option>Faislabad</option>
              <option>Peshawar</option>
            </select>
            <div class="invalid-feedback">
              Please select a valid City
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <label for="zip">Zip</label>
            <input type="text" class="form-control" id="zip" value="{{user.postcode}}" required="">
            <div class="invalid-feedback">
              Zip code required.
            </div>
          </div>
        </div>
        <hr class="mb-4">
        <button class="btn btn-primary btn-lg btn-block" type="submit">BUY</button>
      </form>
    </div>
  </div>

  <footer class="my-5 pt-5 text-muted text-center text-small">
    <p class="mb-1">© 2017-2019 Company Name</p>
    <ul class="list-inline">
      <li class="list-inline-item"><a href="#">Privacy</a></li>
      <li class="list-inline-item"><a href="#">Terms</a></li>
      <li class="list-inline-item"><a href="#">Support</a></li>
    </ul>
  </footer>
</div>
      
      
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="/docs/4.4/assets/js/vendor/jquery.slim.min.js"><\/script>')</script>
      <script src="/docs/4.4/dist/js/bootstrap.bundle.min.js" integrity="sha384-6khuMg9gaYr5AxOqhkVIODVIvm9ynTT5J4V1cfthmT+emCG6yVmEZsRHdxlotUnm" crossorigin="anonymous"></script>
        <script src="form-validation.js"></script>
        <script>
        	
      App.controller('ListControl', function ($scope){
        $scope.products = JSON.parse('<?php echo $products ?>');

        // $scope.user = {"firstName":"sharique","lastName":"pervaiz","Email":"pervaizsharique09@gmail.com","Address":"B-88, Block 13-D-1, gulshan-e-iqbal"}
        // $scope.user = {"firstName":"sharique","lastName":"pervaiz","email":"pervaizsharique09@gmail.com"}
        $scope.user = JSON.parse('<?php echo getUserJSON($conn); ?>');
        // console.log($scope.user);
      });
        </script>
</body>
</html>