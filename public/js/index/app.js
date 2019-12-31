(function () {
	/* Angular - Start */
	var app = angular.module("myApp", ["ngRoute", "ngAnimate"]);

	app.config([
		"$interpolateProvider",
		"$compileProvider",
		function ($interpolateProvider, $compileProvider) {
			$interpolateProvider.startSymbol("{*");
			$interpolateProvider.endSymbol("*}");
			$compileProvider.commentDirectivesEnabled(false);
			$compileProvider.cssClassDirectivesEnabled(false);
		}
	]);

	app.config([
		"$routeProvider",
		function ($routeProvider) {
			$routeProvider
				.when("/", {
					controller: "IndexCtrl",
					controllerAs: "idx",
					templateUrl: "tpl/index/index.html"
				})
				/*
					動態載入 Controller & Template

					TODO: 目前這個方式會有錯誤 (Controller 部份)

				.when("/lotto/:type", {
					controller: function (params) {
						return params.type + "Ctrl";
					},
					templateUrl: function (params) {
						return "tpl/lotto/" + params.type + "/index.html";
					}
				})
				*/
				.when("/lotto/ThreeD", {
					controller: "ThreeDCtrl",
					controllerAs: "_3d",
					templateUrl: "tpl/lotto/ThreeD/index.html"
				})
				.when("/lotto/FourD", {
					controller: "FourDCtrl",
					controllerAs: "_4d",
					templateUrl: "tpl/lotto/FourD/index.html"
				})
				.otherwise({
					redirectTo: "/"
				});
		}
	]);

	// Controllers
	app.controller("BodyCtrl", BodyCtrl);
	BodyCtrl.$inject = ["$scope", "$route", "$routeParams", "$location"];
	function BodyCtrl($scope, $route, $routeParams, $location) {

		// View Model
		var vm = this;

		vm.val = "BodyCtrl is running. (vm)";
		$scope.val = "BodyCtrl is running. ($scope)";

		vm.$route = $route;
		vm.$routeParams = $routeParams;
		vm.$location = $location;

		vm.isActive = isActive;

		// 有點耗資源
		function isActive(path) {
			return path === $location.path();
		}
	};

	app.controller("IndexCtrl", IndexCtrl);
	IndexCtrl.$inject = ["$scope"];
	function IndexCtrl($scope) {

		// View Model
		var vm = this;

		vm.val = "IndexCtrl is running. (vm)";
		$scope.val = "IndexCtrl is running. ($scope)";

	};

	app.controller("ThreeDCtrl", ThreeDCtrl);
	ThreeDCtrl.$inject = ["$scope"];
	function ThreeDCtrl($scope) {

		// View Model
		var vm = this;

		vm.val = "ThreeDCtrl is running. (vm)";
		$scope.val = "ThreeDCtrl is running. ($scope)";

	};

	app.controller("FourDCtrl", FourDCtrl);
	FourDCtrl.$inject = ["$scope"];
	function FourDCtrl($scope) {

		// View Model
		var vm = this;

		vm.val = "FourDCtrl is running. (vm)";
		$scope.val = "FourDCtrl is running. ($scope)";

	};
	/* Angular - End */
})();
