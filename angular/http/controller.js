var app = angular.module("MyFirstApp",[]);

app.controller("FirstController",function($scope,$http){
	$scope.posts = [];
	$scope.newPost = {};
	$http.get("http://jsonplaceholder.typicode.com/posts")
		
	.then(function(response){ 
		//console.log(response.data); 
		$scope.posts = response.data; 
	},function(err){ 
		console.log(err); 
	});

	$scope.addPost = function(){
		$http.post("http://jsonplaceholder.typicode.com/posts", { 
			title: $scope.newPost.title, 
			body: $scope.newPost.body, 
			userID: 1 
		})
		.then( function(response){
			//console.log(response.data);
			$scope.posts.push($scope.newPost); 
			$scope.newPost = {}; 
		}, 
		function(err){ 
			console.log(err.data); 
		})
	}
}); 



		