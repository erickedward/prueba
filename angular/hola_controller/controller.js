var app = angular.module("MyFirstApp",[]);

app.controller("FirstController",function($scope){
	$scope.nombre = "Erick"
	$scope.nuevoComentario = {};
	$scope.comentarios = [
		{
			comentario: "Primer Comentario",
			username: "Erick"
		},
		{
			comentario: "Segundo Comentario",
			username: "Nailet"
		}
	];
	$scope.agregarComentario = function(){
		$scope.comentarios.push($scope.nuevoComentario);
		$scope.nuevoComentario = {};
	}
});