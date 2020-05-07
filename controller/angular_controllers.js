//  Main

angular.module('Homepage', [])
    .controller('navbar_controller', ['$scope', '$http', function ($scope, $http) {
        $http({
        method: 'POST',
        url: '../model/categories.php',
        data: {'func':'getCategories'},
        }).then(function(response) {
        console.log(response.data);
        $scope.categories = response.data;
        });
        }])
    .controller('main_body_controller', ['$scope', '$http', function ($scope, $http) {
		console.log("Hi");

		$http({
			method: 'POST',
			url: '../model/categories.php',
			data: {'func':'getCategories'},
			}).then(function(response) {
			$scope.categories_lists = response.data;
			angular.forEach($scope.categories_lists, function(record) {
				console.log(JSON.stringify(record));

			  });
			});

        }]);


// Functions