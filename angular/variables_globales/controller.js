angular.module("MyFirstApp",[])
	.run(function($rootScope){
		$rootScope.nombre = "codigo facilito"
	})
	.controller("FirstController",function($scope){
		$scope.nombre = "Erick Ramirez";
	})
	.controller("ChildController",function($scope){
		//$scope.nombre = "Nailet Colina";
	});