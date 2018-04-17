angular.module("ToDoList",["LocalStorageModule"])
.controller("ToDoController",function($scope,localStorageService){
	if(localStorageService.get("angular-arreglo_datos")){
		$scope.todo = localStorageService.get("angular-arreglo_datos");
	}else{
		$scope.todo = [];
	}

	
	/*
	{
		descripcion:'terminar curso de angular'
		fecha: '02-03-15 2:00pm'
	}
	*/
	$scope.$watchCollection('todo',function(newValue,oldValue){
		/*console.log(newValue);
		console.log(oldValue);*/
		localStorageService.set("angular-arreglo_datos",$scope.todo);
	});
	$scope.addActv = function(){
		$scope.todo.push($scope.newActv);
		$scope.newActv = {};
	}
	/*$scope.cleanActv = function(){
		$scope.todo = [];
	}*/
});