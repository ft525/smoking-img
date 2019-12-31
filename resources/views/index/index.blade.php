<!DOCTYPE html>
<html lang="zh-Hant">
	<head>
		<meta charset="UTF-8" />
		<title>H5 Nav bar</title>
		<link rel="stylesheet" href="{{ asset('css/style.css') }}" />
		<link rel="stylesheet" href="{{ asset('css/ng-view-animations.css') }}" />

		<script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.7.8/angular.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.7.8/angular-route.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.7.8/angular-animate.min.js"></script>
	</head>

	<body ng-controller="BodyCtrl as body">
		{{-- Nav --}}
		<ul>
			<li><a href="#!/" ng-class="{active: body.isActive('/')}">首頁</a></li>
			<li><a href="#!/lotto/ThreeD" ng-class="{active: body.isActive('/lotto/ThreeD')}">3 星彩</a></li>
			<li><a href="#!/lotto/FourD" ng-class="{active: body.isActive('/lotto/FourD')}">4 星彩</a></li>
		</ul>

		<div class="slide-pop" ng-view></div>

		<hr />

		<h3>body</h3>
		<ul>
			<li>val: {* val *}</li>
			<li>body.val: {* body.val *}</li>
		</ul>

		<hr />

		<pre>$location.path() = {* body.$location.path() *}</pre>
		<pre>$route.current.templateUrl = {* body.$route.current.templateUrl *}</pre>
		<pre>$route.current.params = {* body.$route.current.params *}</pre>
		<pre>$routeParams = {* body.$routeParams *}</pre>




		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="{{ asset('js/index/app.js') }}"></script>
		<script>
		$(function () {
			{{-- Angular - Setting --}}
			angular.module("myApp");

			angular.bootstrap(document, ["myApp"], {
				strictDi: true
			});
		});
		</script>
	</body>
</html>
