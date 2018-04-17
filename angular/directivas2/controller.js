angular.module("tosrc",[])
.directive("myAutocomplete",function(){
	function link(scope,element,attrs){
		$(element).autocomplete({
			source: scope[attrs.myAutocomplete],
			select: function(ev,ui){
				ev.preventDefualt();
				if(ui.item){
					scope.optionSelected(ui.item.value);
				}
			},
			focus: function(ev,ui){
				ev.preventDefualt();
				$(this).val(ui.item.label);
			}
		});
	};
	return {
		link : link
	};
})
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

	//$http.get("https://api.github.com/users/codigofacilito/repos")
	$http.get("https://api.github.com/users/erickedward/repos")
	.then(function(response){ 
		//console.log(response.data); 
		$scope.repositorio = response.data; 
		for(var i=response.data.length -1;i>=0;i--){
			
			if (response.data[i].name!=''){
				var repo = response.data[i];
				$scope.repositorio.push(repo.name);
			}
		}
	},function(err){ 
		console.log(err); 
	});

	$scope.optionSelected = function(data){
		$scope.$apply(function(){
			$scope.main_repor = data;
		})
	}
});