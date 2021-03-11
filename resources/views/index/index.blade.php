<!DOCTYPE html>
<html lang="zh-Hant">
	<head>
		<meta charset="UTF-8" />
		<title>H5 Nav bar</title>
		<link rel="stylesheet" href="{{ asset('css/style.css') }}" />
		<link id="effect-css" rel="stylesheet" href="{{ asset('css/effects/slide-pop.css') }}" />

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

		{{-- ngView 轉場效果 --}}
		<select
			ng-model="body.effect"
			ng-options="v.value as (v.no + ': ' + v.label) for v in body.ng_view_animation_effects"
			ng-change="body.changeEffect()"></select>
		<pre>body.effect = {* body.effect | json *}</pre>

		<pre>$location.path() = {* body.$location.path() *}</pre>
		<pre>$route.current.templateUrl = {* body.$route.current.templateUrl *}</pre>
		<pre>$route.current.params = {* body.$route.current.params *}</pre>
		<pre>$routeParams = {* body.$routeParams *}</pre>

		<hr />
		<h3>body</h3>
		<ul>
			<li>val: {* val *}</li>
			<li>body.val: {* body.val *}</li>
		</ul>

		<h3>Event</h3>
		<button ng-click="body.emitEvent('myEvent', 'Body')">Emit body event</button>
		<button ng-click="body.broadcastEvent('myEvent', 'Body')">Broadcast body event</button>
		<pre>Count: {* body.count *}, Who: {* body.who *}</pre>

		<hr />
		<div class="content">
			<div ng-class="body.effect" ng-view></div>
		</div>




		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="{{ asset('js/index/app.js') }}"></script>
		<script>
		$(function () {
			{{-- Angular - Setting --}}
			angular.module("myApp")
				.constant("BASE_URI", "{{ url('/') }}");

			angular.bootstrap(document, ["myApp"], {
				strictDi: true
			});
		});
		</script>
	</body>
</html>
