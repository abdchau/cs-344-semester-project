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

  <?php echo loadNavbar(getCategories($conn), getUserJson($conn)); ?>

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
            <small class="text-muted">Quantity: {{product.quantity}}</small><br>
            <small class="text-muted">Added on: {{product.timeAdded}}</small>
          </div>
          <span class="text-muted">Rs{{product.price}}</span>
        </li>
        <li class="list-group-item d-flex justify-content-between">
          <span>Total (RS)</span>
          <strong id="total">{{total}}</strong>
        </li>
      </ul>
    </div>
    <div class="col-md-8 order-md-1">
      <h4 class="mb-3">Billing address</h4>
      <form class="needs-validation" novalidate="">
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="firstName">First name</label>
            <input type="text" class="form-control" id="firstName" value="{{user.firstName}}" required="">
            <div class="invalid-feedback">
              Valid first name is required.
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="lastName">Last name</label>
            <input type="text" class="form-control" id="lastName" value="{{user.lastName}}" required="">
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
              <option ng-repeat="city in cities">{{city.cityName}}</option>
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
        <button id="buy" class="btn btn-primary btn-lg btn-block" type="submit">BUY</button>
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
          products = JSON.parse('<?php echo $products ?>');
          user = JSON.parse('<?php echo getUserJSON($conn); ?>');
          cities = JSON.parse('<?php echo getCities($conn); ?>');
          App.controller('ListControl', function ($scope){
            $scope.total = 0;
            $scope.products = products;
            $scope.cities = cities;
            angular.forEach($scope.products, function (value, index) {
                 $scope.total+= $scope.products[index].quantity*$scope.products[index].price
            });
            $scope.user = user;
          });
        </script>
        <script>
          $(document).ready(function(){
            $('#buy').click(function(){
              var billingName = $('#firstName').val()+' '+$('#lastName').val();
              var billingAddress = $('#address').val()+' '+$('#address2').val()+' '+$('#city').val()+' '+$('#zip').val();
              var amount = parseInt($('#total').html());
              console.log(amount);
              var buyerID = user['userID'];
              placeOrder(buyerID, amount, billingName, billingAddress, products);
            });
          });
        </script>
</body>
</html>