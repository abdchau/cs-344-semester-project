<?php require '../model/interface.php';
  require 'commonElements.php';
  if ($username==null)
    header("Location: index.php");
  $users = getUsers($conn);
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

    <div class="row my-sm-5 mx-0">
        <div class="col-sm-3" id="tabs">
          <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link active" id="v-pills-user-tab" data-toggle="pill" href="#v-pills-user" role="tab" aria-controls="v-pills-user" aria-selected="true">Users</a>
            <a class="nav-link" id="v-pills-products-tab" data-toggle="pill" href="#v-pills-products" role="tab" aria-controls="v-pills-products" aria-selected="false">Products</a>
            <a class="nav-link" id="v-pills-categories-tab" data-toggle="pill" href="#v-pills-categories" role="tab" aria-controls="v-pills-categories" aria-selected="false">Categories</a>
            <a class="nav-link" id="v-pills-other-tab" data-toggle="pill" href="#v-pills-other" role="tab" aria-controls="v-pills-other" aria-selected="false">Other Actions</a>
          </div>
        </div>
        <div class="col-sm-9 px-0">
          <div class="tab-content" id="v-pills-tabContent">
            <div ng-controller="users-ctrl" class="tab-pane fade show active" id="v-pills-user" role="tabpanel" aria-labelledby="v-pills-user-tab">
                  <div class="table-responsive">
                    <table class="table">
                        <caption>List of users</caption>
                        <thead>
                          <tr>
                            <th scope="col">User ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Options</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr ng-repeat="user in users">
                            <td>{{user.userID}}</td>
                            <td>{{user.firstName}} {{user.lastName}}</td>
                            <td>{{user.email}}</td>
                            <td>
                              <button data-id="{{user.userID}}" data-placement="top" title="Grant admin privileges" data-toggle="tooltip" type="button" class="btn btn-block-xs btn-outline-success my-auto make-admin">Admin</button>
                              <button data-id="{{user.userID}}" type="button" class="btn btn-block-xs btn-outline-danger my-auto rem-user">Remove</button>
                            </td>
                          </tr>

                        </tbody>
                      </table>
                  </div>
            </div>
            <div ng-controller="product-ctrl" class="tab-pane fade" id="v-pills-products" role="tabpanel" aria-labelledby="v-pills-products-tab">
                  <div class="table-responsive">
                    <table class="table">
                        <caption>List of products</caption>
                        <thead>
                          <tr>
                            <th scope="col">Product ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Category</th>
                            <th scope="col">Price</th>
                            <th scope="col">Seller</th>
                            <th scope="col">Options</th>
                         </tr>
                        </thead>
                        <tbody>
                          <tr ng-repeat="product in products">
                            <td>{{product.productID}}</td>
                            <td>{{product.productName}}</td>
                            <td>{{product.categoryName}}</td>
                            <td>{{product.price}}</td>
                            <td>{{product.firstName}} {{product.lastName}}</td>
                            <td><button data-id="{{product.productID}}" type="button" class="btn btn-outline-danger my-auto rem-prod">Remove</button></td>
                          </tr>

                        </tbody>
                      </table>
                  </div>
            </div>


            <div ng-controller="category-ctrl" class="tab-pane fade" id="v-pills-categories" role="tabpanel" aria-labelledby="v-pills-categories-tab">
                <div class="table-responsive">
                    <table class="table">
                        <caption>List of products</caption>
                        <thead>
                          <tr>
                            <th scope="col">Category ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Options</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr ng-repeat="category in categories">
                            <td>{{category.categoryID}}</td>
                            <td>{{category.categoryName}}</td>
                            <td>
                              <button data-id="{{category.categoryID}}" type="button" class="btn btn-block-xs btn-outline-success my-auto edit-cat">Edit</button>
                              <button data-id="{{category.categoryID}}" type="button" class="btn btn-block-xs btn-outline-danger my-auto rem-cat">Remove</button>
                            </td>
                          </tr>

                        </tbody>
                      </table>
                  </div>            
            </div>



            <div class="tab-pane fade" id="v-pills-other" role="tabpanel" aria-labelledby="v-pills-other-tab">
              <div class="col-sm-6 mx-auto">
                <button type="button" class="btn btn-danger btn-lg btn-block my-auto" id="resetDB">Reset Database</button>
              </div>
            </div>
          </div>
        </div>
    </div>

    <script type="text/javascript">
      App.controller('users-ctrl', function ($scope){
        $scope.users = JSON.parse('<?php echo $users; ?>');
      })
      .controller('product-ctrl', function ($scope){
        $scope.products = JSON.parse('<?php echo getProducts($conn); ?>');
      })
      .controller('category-ctrl', function ($scope){
        $scope.categories = JSON.parse('<?php echo getCategories($conn); ?>');
      });

      $(document).ready(function(){
        $('#resetDB').click(function(e){
          resetDB();
        });
        $('.rem-user').click(function(){
          deleteUser($(this).attr('data-id'));
        });
        $('.rem-prod').click(function(){
          deleteProduct($(this).attr('data-id'));
        });
        $('.make-admin').click(function(){
          makeAdmin($(this).attr('data-id'));
        });
        $('.rem-cat').click(function(){
          removeCategory($(this).attr('data-id'));
        });
        $('.edit-cat').click(function(){
          removeCategory($(this).attr('data-id'));
        });
      });
    </script>

  </body>
</html>