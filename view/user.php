<?php require '../model/interface.php'; 
  require 'commonElements.php';
  $cart = getCart($conn, $username);
?>

<!doctype html>
<html lang="en">
  <head>
    <?php echo loadHeader("User"); ?>
  </head>
  <body ng-app="PageApp">
    <?php echo loadNavbar(getCategories($conn), $username); ?>

    <nav class="navbar navbar-expand-sm navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#tabs" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    </nav>

    <div class="row my-sm-5 mx-0">
        <div class="col-sm-3" id="tabs">
          <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link active" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="true">Profile</a>
            <a class="nav-link" id="v-pills-cart-tab" data-toggle="pill" href="#v-pills-cart" role="tab" aria-controls="v-pills-cart" aria-selected="false">Cart</a>
            <a class="nav-link" id="v-upload-item-tab" data-toggle="pill" href="#v-pills-upload-item" role="tab" aria-controls="v-pills-upload-item" aria-selected="false">Upload Product</a>
            <a class="nav-link" id="v-pills-orders-tab" data-toggle="pill" href="#v-pills-orders" role="tab" aria-controls="v-pills-orders" aria-selected="false">Active Orders</a>
            <a class="nav-link" id="v-pills-history-tab" data-toggle="pill" href="#v-pills-history" role="tab" aria-controls="v-pills-history" aria-selected="false">History</a>
            <a class="nav-link" id="v-pills-password-change-tab" data-toggle="pill" href="#v-pills-password-change" role="tab" aria-controls="v-pills-password-change" aria-selected="false">Change Password</a>
            <a class="nav-link" id="v-pills-delete-account-tab" data-toggle="pill" href="#v-pills-delete-account" role="tab" aria-controls="v-pills-delete-account" aria-selected="false">Delete Account</a>
          </div>
        </div>
        <div class="col-sm-9 px-0">
          <div class="tab-content" id="v-pills-tabContent">
            <div ng-controller="ProfileData" class="tab-pane fade show active" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                <form class="container">
                    <h1 class="h3 mb-3 font-weight-normal">Profile</h1>
                    <h5 class="h5 mb-3 font-weight-normal">Edit your details</h5>
                        <div class="form-group row">

                            <div class="col-sm-10">
                                 <input type="text" class="form-control" id="firstName" value="{{user.firstName}}">
                            </div>
                      </div>
                      <div class="form-group row">

                            <div class="col-sm-10">
                                 <input type="text" class="form-control" id="lastName" value="{{user.lastName}}">
                            </div>
                      </div>
                      <div class="form-group row">

                            <div class="col-sm-10">
                                 <input type="email" class="form-control" id="inputEmail" value="{{user.email}}">
                            </div>
                      </div>

                      <div class="form-group row">

                            <div class="col-sm-10">
                                 <input type="text" class="form-control" id="address" value="{{user.address}}">
                            </div>
                      </div>
                    <div class="form-group row">

                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="city" value="{{user.cityName}}">
                        </div>
                    </div>
                    <div class="form-group row">

                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="phone" value="Phone no">
                        </div>
                    </div>
                    <div class="form-group row">

                        <div class="col-sm-10">
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
            <div ng-controller="Cart" class="tab-pane fade" id="v-pills-cart" role="tabpanel" aria-labelledby="v-pills-cart-tab">
                <div class="table-responsive">
                    <table class="table">
                        <caption>List of users</caption>
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Handle</th>
                            <th scope="col">Handle</th>
                          </tr>
                        </thead>
                        <tbody ng-repeat="product in cart">
                          <tr>
                            <th scope="row">1</th>
                            <td>{{product.productName}}</td>
                            <td>{{product.price}}</td>
                            <td>{{product.quantity}}</td>
                          </tr>

                        </tbody>
                      </table>
                  </div>
            </div>






            <div class="tab-pane fade" id="v-pills-upload-item" role="tabpanel" aria-labelledby="v-pills-upload-item-tab">
                <form action="../model/upload.php" enctype="multipart/form-data" method="post" class="container">
                    <div class="form-group">
                        <h1 class="h3 mb-3 font-weight-normal">New Product</h1>
                        <h5 class="h5 mb-3 font-weight-normal">Enter product details</h5>
                    </div>
                    <div class="form-row">
                        <div class="col-7">
                            <label for="#inputProductName">Name:</label>
                            <input name="productName" type="text" class="form-control" id="inputProductName" placeholder="E.g. Smartphone">
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
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
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
                            <input class="btn btn-lg btn-primary btn-block" type="submit" value="Upload"></input>
                        </div>
                    </div>
                </form>
            </div>






            <div class="tab-pane fade" id="v-pills-orders" role="tabpanel" aria-labelledby="v-pills-orders-tab">
                <div class="table-responsive">
                    <table class="table">
                        <caption>List of users</caption>
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">First</th>
                            <th scope="col">Last</th>
                            <th scope="col">Handle</th>
                            <th scope="col">Handle</th>
                            <th scope="col">Handle</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                          </tr>
                          <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                          </tr>
                          <tr>
                            <th scope="row">3</th>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
                          </tr>
                          <tr>
                            <th scope="row">3</th>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
                          </tr>
                          <tr>
                            <th scope="row">3</th>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
                          </tr>
                        </tbody>
                      </table>
                  </div>
            </div>
            <div class="tab-pane fade" id="v-pills-history" role="tabpanel" aria-labelledby="v-pills-history-tab">
                <div class="table-responsive">
                    <table class="table">
                        <caption>List of users</caption>
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">First</th>
                            <th scope="col">Last</th>
                            <th scope="col">Handle</th>
                            <th scope="col">Handle</th>
                            <th scope="col">Handle</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                          </tr>
                          <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                          </tr>
                          <tr>
                            <th scope="row">3</th>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
                          </tr>
                          <tr>
                            <th scope="row">3</th>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
                          </tr>
                          <tr>
                            <th scope="row">3</th>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
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
                            <h5 class="h5 mb-3 font-weight-normal">Are you sure you want to delete your account? All of you data will be permanently deleted and cannot be recovered later.</h5>
                            <button class="btn btn-lg btn-danger btn-block" type="submit" id="delete_account">Yes, Delete my Account</button>
                        </div>
                    </div>
                </form>
            </div>
          </div>
        </div>
    </div>
    <div  id="cartIcon" style="position:fixed;bottom:20px;left:90%;" >
        <a href=checkout.php><img height=80% width=80% src="images/cart.png"></a>
</div>


  <script type="text/javascript">
    console.log("hellooo");
    App.controller('ProfileData', function ($scope){
      // $scope.user = {"firstName":"sharique","lastName":"pervaiz","Email":"pervaizsharique09@gmail.com","Address":"B-88, Block 13-D-1, gulshan-e-iqbal"}
      // $scope.user = {"firstName":"sharique","lastName":"pervaiz","email":"pervaizsharique09@gmail.com"}
      $scope.user = JSON.parse('<?php echo getUserJSON($conn); ?>');
      console.log($scope.user+'ding');
    })
    .controller('Cart', function ($scope){
      $scope.cart = JSON.parse('<?php echo $cart; ?>');
      console.log($scope.cart+'ding');
    });
  </script>
  </body>
</html>