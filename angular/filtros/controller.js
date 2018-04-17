angular.module("mainModule",[])
	.filter("removerHtml",function(){
		return function(texto){
			return String(texto).replace(/<[^>]+>/gm,'');
		}
	})
	.controller("FiltersController",function($scope){
		$scope.mi_html = "<p>Hola Mundo</p>"
		$scope.arreglo = {};
		$scope.arreglo.title = "hola erick";
		$scope.arreglo.body = "chao";
		$scope.costo = 200000;
	});