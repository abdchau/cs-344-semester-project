<?php require '../model/interface.php';
  require 'commonElements.php';
  if ($username==null || $username['isAdmin']==false)
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
                            <td ng-if="user.userID!==adminID">
                              <button ng-if="user.isAdmin==false" data-id="{{user.userID}}" data-placement="top" title="Grant admin privileges" data-toggle="tooltip" type="button" class="btn btn-block-xs btn-outline-success my-auto toggle-admin">Admin</button>
                              <button ng-if="user.isAdmin==true" data-id="{{user.userID}}" data-placement="top" title="Revoke admin privileges" data-toggle="tooltip" type="button" class="btn btn-block-xs btn-success my-auto toggle-admin">Admin</button>
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
                            <td>
                              <button ng-if="product.featured==false" data-id="{{product.productID}}" data-placement="top" title="Make featured product" data-toggle="tooltip" type="button" class="btn btn-block-xs btn-outline-success my-auto feat-prod">Feature</button>
                              <button ng-if="product.featured==true" data-id="{{product.productID}}" data-placement="top" title="Unfeature product" data-toggle="tooltip" type="button" class="btn btn-block-xs btn-success my-auto feat-prod">Feature</button>
                              <button data-id="{{product.productID}}" type="button" class="btn btn-outline-danger my-auto rem-prod">Remove</button>
                            </td>
                          </tr>

                        </tbody>
                      </table>
                  </div>
            </div>


            <div ng-controller="category-ctrl" class="tab-pane fade" id="v-pills-categories" role="tabpanel" aria-labelledby="v-pills-categories-tab">
              <button type="button" class="btn btn-outline-success btn-lg my-auto add-cat" data-toggle="modal" data-target="#addModal">Add New Category</button>
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
                              <button data-categoryID="{{category.categoryID}}" data-categoryName="{{category.categoryName}}" type="button" class="btn btn-block-xs btn-outline-success my-auto openModal" data-toggle="modal" data-target="#editModal">Edit</button>
                              <button data-id ="{{category.categoryID}}" type="button" class="btn btn-block-xs btn-outline-danger my-auto rem-cat">Remove</button>
                            </td>
                          </tr>

                        </tbody>
                      </table>
                  </div>
            </div>

            <div class="modal fade" id="addModal" data-backdrop="static" tabindex="-1" role="dialog">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <input name="categoryName" type="text" class="form-control" id="inputAddCategoryName" placeholder="E.g Smartphone">
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary"  id="cat-add">Add Category</button>
                  </div>
                </div>
              </div>
            </div>

            <div class="modal fade" id="editModal" data-backdrop="static" tabindex="-1" role="dialog">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <input name="categoryName" type="text" class="form-control" id="inputEditCategoryName" placeholder="E.g Smartphone">
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary"  id="cat-edit">Save Changes</button>
                  </div>
                </div>
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
        $scope.adminID = JSON.parse('<?php echo getUserJSON($conn); ?>')['userID'];
        console.log($scope.adminID);
      })
      .controller('product-ctrl', function ($scope){
        $scope.products = JSON.parse('<?php echo getProducts($conn); ?>');
      })
      .controller('category-ctrl', function ($scope){
        $scope.categories = JSON.parse('<?php echo getCategories($conn); ?>');
        console.log($scope.categories);
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
        $('.toggle-admin').click(function(){
          toggleAdmin($(this).attr('data-id'));
        });
        $('.rem-cat').click(function(){
          removeCategory($(this).attr('data-id'));
        });

        $('#cat-edit').click(function(){
          console.log($('#inputEditCategoryName').val())
          editCategory($(this).attr('data-categoryID'),$('#inputEditCategoryName').val());
        });
        $('#cat-add').click(function(){
          console.log($('#inputAddCategoryName').val());
          addCategory($('#inputAddCategoryName').val());
        });

        $('.openModal').click(function(){
          $('#inputEditCategoryName').val($(this).attr('data-categoryName'));
          $('#cat-edit').attr('data-categoryID', $(this).attr('data-categoryID'));

        });
        $('.add-cat').click(function(){
          $('#inputAddCategoryName').attr('placeholder','New category name');
          // console.log($('[ng-controller="category-ctrl"]'));
        });
        $('.feat-prod').click(function(){
          toggleFeatured($(this).attr('data-id'));
        });
      });
    </script>

  </body>
</html>