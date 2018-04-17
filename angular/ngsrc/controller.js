angular.module("tosrc",[])
.controller("ToSrcController",function($scope,$http){
	$scope.repositorio = [];

	$http.get("https://api.github.com/users/erickedward/repos")
	//$http.get("https://api.github.com/users/codigofacilito/repos")

	.then(function(response){ 
		//console.log(response.data); 
		$scope.repositorio = response.data; 
	},function(err){ 
		console.log(err); 
	});

});