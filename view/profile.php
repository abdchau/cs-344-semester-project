<?php require '../model/interface.php';
  require 'commonElements.php';
  $cart = getCart($conn, $username);
  $placedOrders = getPlacedOrders($conn, $username['userID']);
  $receivedOrders = getReceivedOrders($conn, $username['userID']);
  if ($username==null)
    header("Location: index.php");
?>

<!doctype html>
<html lang="en">
  <head>
    <?php echo loadHeader("User"); ?>
  </head>
  <body ng-app="PageApp">
    <?php echo loadNavbar(getCategories($conn), getUserJson($conn)); ?>

    <nav class="navbar navbar-expand-sm navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#tabs" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    </nav>

    <div ng-controller="nav-ctrl" class="row my-sm-5 mx-0">
        <div class="col-sm-3" id="tabs">
          <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link active" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="true">Profile</a>
            <a class="nav-link" id="v-pills-cart-tab" data-toggle="pill" href="#v-pills-cart" role="tab" aria-controls="v-pills-cart" aria-selected="false">Cart</a>
            <a class="nav-link" id="v-upload-item-tab" data-toggle="pill" href="#v-pills-upload-item" role="tab" aria-controls="v-pills-upload-item" aria-selected="false">Upload Product</a>
            <a class="nav-link" id="v-pills-orders-tab" data-toggle="pill" href="#v-pills-orders" role="tab" aria-controls="v-pills-orders" aria-selected="false">Active Orders</a>
            <a class="nav-link" id="v-pills-orders-received-tab" data-toggle="pill" href="#v-pills-orders-received" role="tab" aria-controls="v-pills-orders-received" aria-selected="false">Received Orders</a>
            <a class="nav-link" id="v-pills-password-change-tab" data-toggle="pill" href="#v-pills-password-change" role="tab" aria-controls="v-pills-password-change" aria-selected="false">Change Password</a>
            <a class="nav-link" id="v-pills-delete-account-tab" data-toggle="pill" href="#v-pills-delete-account" role="tab" aria-controls="v-pills-delete-account" aria-selected="false">Delete Account</a>
          </div>
            <a ng-if="isAdmin==true" class="nav-link" style="color: red" href="admin.php" >Open Admin Panel</a>
        </div>





        <div class="col-sm-9 px-0">
          <div class="tab-content" id="v-pills-tabContent">
            <div ng-controller="profile-data-ctrl" class="tab-pane fade show active" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                <form class="container">
                    <h1 class="h3 mb-3 font-weight-normal">Profile</h1>
                    <h5 class="h5 mb-3 font-weight-normal">Edit your details</h5>
                        <div class="form-group row">
                          <div class="col-sm-5">
                              <label for="firstName">First Name</label>
                              <input type="text" class="form-control" id="firstName" value="{{user.firstName}}">
                          </div>
                          <div class="col-sm-5">
                              <label for="lastName">Last Name</label>
                              <input type="text" class="form-control" id="lastName" value="{{user.lastName}}">
                          </div>
                      </div>
                      <div class="form-group row">
                            <div class="col-sm-10">
                              <label for="inputEmail">Email</label>
                              <input type="email" class="form-control" id="inputEmail" value="{{user.email}}">
                            </div>
                      </div>

                      <div class="form-group row">

                            <div class="col-sm-10">
                              <label for="address">Address</label>
                              <input type="text" class="form-control" id="address" value="{{user.address}}">
                            </div>
                      </div>
                    <div class="form-group row">
                      <div class="col-md-5 mb-3">
                        <label for="city">City</label>
                        <select class="custom-select d-block w-100" id="city" required="">
                          <option ng-repeat="city in cities" value="{{city.cityID}}" ng-selected="{{city.cityID}}=={{user.cityID}}">
                            {{city.cityName}}
                          </option>
                        </select>
                      </div>
                        <div class="col-sm-5">
                            <label for="zipcode">Zip</label>
                          <input type="text" class="form-control" id="zipcode" value="{{user.postcode}}">
                        </div>
                    </div>
                    <div class="form-group row">

                        <div class="col-sm-10">
                            <button class="btn btn-lg btn-primary btn-block" type="submit" id="save_changes">Save Changes</button>
                        </div>
                    </div>
                </form>
            </div>






            <div ng-controller="cart-ctrl" class="tab-pane fade" id="v-pills-cart" role="tabpanel" aria-labelledby="v-pills-cart-tab">
                <div class="table-responsive">
                    <table class="table">
                        <caption>List of users</caption>
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Options</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr ng-repeat="product in cart">
                            <th>{{product.productID}}</th>
                            <td>{{product.productName}}</td>
                            <td>{{product.price}}</td>
                            <td>{{product.quantity}}</td>
                            <td><button data-id="{{product.productID}}" type="button" class="btn btn-outline-danger my-auto rem-cart">Remove</button></td>
                          </tr>

                        </tbody>
                      </table>
                  </div>
            </div>
            <div ng-controller="upload-prod-ctrl" class="tab-pane fade" id="v-pills-upload-item" role="tabpanel" aria-labelledby="v-pills-upload-item-tab">
                <form action="../model/upload.php" enctype="multipart/form-data" method="post" class="container">
                    <div class="form-group">
                        <h1 class="h3 mb-3 font-weight-normal">New Product</h1>
                        <h5 class="h5 mb-3 font-weight-normal">Enter product details</h5>
                    </div>
                    <div class="form-row">
                        <div class="col-4">
                            <label for="#inputProductName">Name:</label>
                            <input name="productName" type="text" class="form-control" id="inputProductName" placeholder="E.g. Smartphone">
                        </div>
                        <div class="col-3">
                            <label for="#inputPrice">Price:</label>
                            <input name="price" type="text" class="form-control" id="inputPrice" placeholder="E.g. 500">
                        </div>
                        <div class="col-3">
                            <label for="#inputQuantity">Quantity:</label>
                            <input name="stock" type="text" class="form-control" id="inputQuantity" placeholder="E.g. 5">
                        </div>
                      </div>

                    <div class="form-group row">
                        <div class="col-sm-10">
                            <label for="inputCategory">Category:</label>
                            <select name="categoryID" class="form-control" id="inputCategory">
                              <option value="null">Choose Category</option>
                              <option ng-repeat="category in categories" value="{{category.categoryID}}">{{category.categoryName}}</option>
                            </select>
                        </div>

                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <label for="inputDescription">Description:</label>
                            <textarea name="description" class="form-control" id="inputDescription" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <label for="inputProductImage">Product Image:</label>
                            <input name="image" type="file" class="form-control-file" id="inputProductImage">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <input class="btn btn-lg btn-primary btn-block" type="submit" value="Upload">
                        </div>
                    </div>
                </form>
            </div>
            <div ng-controller="placed-order-ctrl" class="tab-pane fade" id="v-pills-orders" role="tabpanel" aria-labelledby="v-pills-orders-tab">
                <div class="table-responsive">
                    <table class="table">
                        <caption>Orders placed</caption>
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Price</th>
                            <th scope="col">Billing Name</th>
                            <th scope="col">Billing Address</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr ng-repeat="item in placedOrders">
                            <th scope="row">1</th>
                            <td>{{item.productName}}</td>
                            <td>{{item.quantity}}</td>
                            <td>{{item.price}}</td>
                            <td>{{item.billingName}}</td>
                            <td>{{item.billingAddress}}</td>
                          </tr>
                        </tbody>
                      </table>
                  </div>
            </div>
            <div ng-controller="received-order-ctrl" class="tab-pane fade" id="v-pills-orders-received" role="tabpanel" aria-labelledby="v-pills-orders-received-tab">
                <div class="table-responsive">
                    <table class="table">
                        <caption>List of users</caption>
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Price</th>
                            <th scope="col">Billing Name</th>
                            <th scope="col">Billing Address</th>
                            <th scope="col">Handle</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr ng-repeat="item in receivedOrders">
                            <th scope="row">1</th>
                            <td>{{item.productName}}</td>
                            <td>{{item.quantity}}</td>
                            <td>{{item.price}}</td>
                            <td>{{item.billingName}}</td>
                            <td>{{item.billingAddress}}</td>
                            <td><button data-id="{{item.orderID}}" type="button" class="btn btn-block-xs btn-outline-success my-auto rem-user">Complete</button></td>
                          </tr>
                        </tbody>
                      </table>
                  </div>
            </div>
            <div class="tab-pane fade" id="v-pills-password-change" role="tabpanel" aria-labelledby="v-pills-password-change-tab">
                <form class="container">
                    <h1 class="h3 mb-3 font-weight-normal">Change Password</h1>
                    <div class="form-group row">
                        <div class="col-sm-10">
                                <input type="password" class="form-control" id="inputOldPassword" placeholder="Old Password">
                        </div>
                    </div>
                        <div class="form-group row">

                        <div class="col-sm-10">
                                <input type="password" class="form-control" id="inputNewPassword" placeholder="New Password">
                        </div>
                    </div>
                    <div class="form-group row">

                        <div class="col-sm-10">
                                <input type="password" class="form-control" id="confirmNewPassword" placeholder="Confirm New Password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button class="btn btn-lg btn-primary btn-block" type="submit" id="change_password">Change Password</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="v-pills-delete-account" role="tabpanel" aria-labelledby="v-pills-delete-account-tab">
                <form class="container">
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <h1 class="h3 mb-3 font-weight-normal">Delete Account</h1>
                            <h5 class="h5 mb-3 font-weight-normal">Are you sure you want to delete your account? All of your data will be permanently deleted and cannot be recovered later.</h5>
                            <button class="btn btn-lg btn-danger btn-block" type="submit" id="delete_account">Yes, Delete my Account</button>
                        </div>
                    </div>
                </form>
            </div>
          </div>
        </div>
    </div>
    <?php echo loadCartIcon(); ?>


  <script type="text/javascript">
    console.log("hellooo");
    App.controller('profile-data-ctrl', function ($scope){
      $scope.user = JSON.parse('<?php echo getUserJSON($conn); ?>');
      $scope.cities = JSON.parse('<?php echo getCities($conn); ?>');
    })
    .controller('cart-ctrl', function ($scope){
      $scope.cart = JSON.parse('<?php echo $cart; ?>');
    })
    .controller('placed-order-ctrl', function ($scope){
      $scope.placedOrders = JSON.parse('<?php echo $placedOrders; ?>');
      console.log($scope.placedOrders);
    })
    .controller('upload-ctrl',function($scope){
      $scope.categories = JSON.parse('<?php echo getCategories($conn); ?>');
    })
    .controller('received-order-ctrl', function ($scope){
      $scope.receivedOrders = JSON.parse('<?php echo $receivedOrders; ?>');
      console.log($scope.receivedOrders);
    })
    .controller('upload-prod-ctrl', function ($scope){
      $scope.categories = JSON.parse('<?php echo getCategories($conn); ?>');
      console.log($scope.categories);
    })
    .controller('nav-ctrl', function ($scope){
      $scope.isAdmin = JSON.parse('<?php echo getUserJSON($conn); ?>')['isAdmin'];
      console.log($scope.categories);
    });
    $('.rem-cart').click(function(){
      // console.log($(this).attr('data-id'));
      removeFromCart(JSON.parse('<?php echo getUserJSON($conn); ?>')['userID'], $(this).attr('data-id'));
      console.log("hiiii");
    });
    $('#delete_account').click(function(){
      deleteUser(JSON.parse('<?php echo getUserJSON($conn); ?>')['userID']);
      window.location.href = 'index.php';
    });
    $('#save_changes').click(function(){
      var userID=JSON.parse('<?php echo getUserJSON($conn); ?>')['userID'];
      changeUser(userID, $('#inputEmail').val(), $('#firstName').val(),
        $('#lastName').val(), $('#address').val(),
        $('option:selected').val(), $('#zipcode').val());

    });
    $('#change_password').click(function(e){
      e.preventDefault();
      var user = JSON.parse('<?php echo getUserJSON($conn); ?>');
      if ($('#inputOldPassword').val() !== user['password'])
        alert('Old password does not match');
      else if ($('#inputNewPassword').val() === $('#confirmNewPassword').val())
        changePassword($('#inputNewPassword').val(), user['userID']);
      else
        alert('Confirm password does not match');
    });

  </script>
  </body>
</html>