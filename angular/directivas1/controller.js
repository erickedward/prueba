angular.module("tosrc",[])
.directive('backImg',function(){
	return function(scope,element,attrs){
		// attrs.backImg //esto cuando la url de la imagen no viene de angular sino que es fija
		attrs.$observe('backImg',function(value){
			element.css({
				"background":"url("+value+")" ,
				"background-position": "center",
				"background-size": "cover"
			});
		})
	}
})

//
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