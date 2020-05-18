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
  <?php echo loadHeader("Profile"); ?>
  <body ng-app="PageApp">
    <?php echo loadNavbar(getCategories($conn), getUserJson($conn)); ?>

    <div ng-controller="nav-ctrl" class="row my-sm-5 mx-0 mt-3">
        <div class="col-sm-3 bg-light mb-3 rounded" id="tabs">
          <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link active" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="true"><i class="fas fa-user-edit"></i>&nbsp; Profile</a>
            <a class="nav-link" id="v-pills-cart-tab" data-toggle="pill" href="#v-pills-cart" role="tab" aria-controls="v-pills-cart" aria-selected="false"><i class="fas fa-shopping-cart"></i>&nbsp; Cart</a>
            <a class="nav-link" id="v-upload-item-tab" data-toggle="pill" href="#v-pills-upload-item" role="tab" aria-controls="v-pills-upload-item" aria-selected="false"><i class="fas fa-upload"></i>&nbsp; Upload Product</a>
            <a class="nav-link" id="v-active-item-tab" data-toggle="pill" href="#v-pills-active-item" role="tab" aria-controls="v-pills-upload-item" aria-selected="false"><i class="fas fa-list-alt"></i>&nbsp; Listed Products</a>
            <a class="nav-link" id="v-pills-orders-tab" data-toggle="pill" href="#v-pills-orders" role="tab" aria-controls="v-pills-orders" aria-selected="false"><i class="fas fa-paper-plane"></i>&nbsp; Placed Orders</a>
            <a class="nav-link" id="v-pills-orders-received-tab" data-toggle="pill" href="#v-pills-orders-received" role="tab" aria-controls="v-pills-orders-received" aria-selected="false"><i class="fas fa-arrow-alt-circle-down"></i>&nbsp; Received Orders</a>
            <a class="nav-link" id="v-pills-password-change-tab" data-toggle="pill" href="#v-pills-password-change" role="tab" aria-controls="v-pills-password-change" aria-selected="false"><i class="fas fa-key"></i>&nbsp; Change Password</a>
            <a class="nav-link" id="v-pills-delete-account-tab" data-toggle="pill" href="#v-pills-delete-account" role="tab" aria-controls="v-pills-delete-account" aria-selected="false"><i class="fas fa-eraser"></i>&nbsp; Delete Account</a>
          </div>
            <a ng-if="isAdmin==true" class="nav-link" style="color: red" href="admin.php" ><i class="fas fa-random"></i>&nbsp; Admin Panel</a>
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
                    <table class="table table-hover">
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
                            <td><button data-id="{{product.productID}}" type="button" class="btn btn-outline-danger my-auto rem-cart"><i class="fas fa-trash-alt"></i></button></td>
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
            <div ng-controller="active-product-ctrl" class="tab-pane fade" id="v-pills-active-item" role="tabpanel" aria-labelledby="v-pills-active-item-tab">
                <div class="table-responsive">
                    <table class="table table-hover">
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
                          <tr ng-repeat="product in active">
                            <th>{{product.productID}}</th>
                            <td>{{product.productName}}</td>
                            <td>{{product.price}}</td>
                            <td>{{product.stock}}</td>

                            <td><div class="btn-group" role="group">
                                <div class="btn-group" role="group">
                                  <button data-productID="{{product.productID}}" data-productStock="{{product.stock}}" type="button" class="btn btn-block-xs btn-outline-success my-auto openModal" data-toggle="modal" data-target="#editModal"><i class="fa fa-edit"></i></button>
                                  <button data-id="{{product.productID}}" type="button" class="btn btn-outline-danger my-auto rem-active-prod"><i class="fas fa-trash-alt"></i></button>
                                </div>
                              </div>
                            </td>
                          </tr>

                        </tbody>
                      </table>
                  </div>
            </div>
            <div class="modal fade" id="editModal" data-backdrop="static" tabindex="-1" role="dialog">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Product Stock</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <input name="categoryName" type="text" class="form-control" id="inputEditProductStock" placeholder="E.g Smartphone">
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary"  id="stock-edit">Save Changes</button>
                  </div>
                </div>
              </div>
            </div>
            <div ng-controller="placed-order-ctrl" class="tab-pane fade" id="v-pills-orders" role="tabpanel" aria-labelledby="v-pills-orders-tab">
                <div class="table-responsive">
                    <table class="table table-hover">
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
                    <table class="table table-hover">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Price</th>
                            <th scope="col">Billing Name</th>
                            <th scope="col">Billing Address</th>
                            <th scope="col">Actions</th>
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
                            <td>
                              <div class="btn-group" role="group">
                                <button data-stock="{{item.stock}}" data-qtty="{{item.quantity}}" data-id="{{item.orderID}}" type="button" class="btn btn-block-xs btn-outline-success my-auto com-order"><i class="fas fa-check"></i></button>
                                <button data-id="{{item.orderID}}" type="button" class="btn btn-block-xs btn-outline-danger my-auto del-order"><i class="fas fa-ban"></i></button></td>
                              </div>
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
                            <button class="btn btn-lg btn-danger btn-block" type="submit" id="delete_account">Yes, Delete my Account </button>
                        </div>
                    </div>
                </form>
            </div>
          </div>
        </div>
    </div>
    <?php echo loadCartIcon(); ?>

  <script type="text/javascript">
    receivedOrders = JSON.parse('<?php echo $receivedOrders; ?>');
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
    .controller('active-product-ctrl', function ($scope){
      $scope.active = JSON.parse('<?php echo getProductsByID($conn,$username); ?>');
      console.log($scope.actve);
    })
    .controller('upload-ctrl',function($scope){
      $scope.categories = JSON.parse('<?php echo getCategories($conn); ?>');
    })
    .controller('received-order-ctrl', function ($scope){
      $scope.receivedOrders = receivedOrders;
      console.log("received order");
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

    $('document').ready(function(){
      $('.rem-cart').click(function(){
          // console.log($(this).attr('data-id'));
          removeFromCart(JSON.parse('<?php echo getUserJSON($conn); ?>')['userID'], $(this).attr('data-id'));
          console.log("hiiii");
      });
      $('.rem-active-prod').click(function(){
          deleteProduct($(this).attr('data-id'));
      });
      $('.del-order').click(function(){
          deleteOrder($(this).attr('data-id'));
      });
      $('.openModal').click(function(){
          $('#inputEditProductStock').val($(this).attr('data-productStock'));
          $('#stock-edit').attr('data-productID', $(this).attr('data-productID'));

        });

      $('.com-order').click(function(){
          if($(this).attr('data-stock')<$(this).attr('data-qtty'))
          {
            alert("you dont have enough items in your inventory!");
          }
          else
            completeOrder($(this).attr('data-id'));
      });
    });

    $('#delete_account').click(function(){
      deleteUser(JSON.parse('<?php echo getUserJSON($conn); ?>')['userID']);
      window.location.href = 'index.php';
    });
    $('#stock-edit').click(function(){
      console.log($('#inputEditProductStock').val());
      editStock($(this).attr('data-productID'),$('#inputEditProductStock').val());
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
  <script>tinymce.init({selector:"textarea"});</script>
  </body>
</html>