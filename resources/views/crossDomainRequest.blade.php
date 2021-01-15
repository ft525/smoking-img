<!DOCTYPE html>
<html lang="zh-Hant">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />

		<title>Cross-site request Demo</title>
	</head>


	<body class="container">
		<div class="row">
			<div class="col">
				<form>
					<div class="form-group">
						<label for="external-url">External URL</label>
						<input type="text" class="form-control" id="external-url" name="external_url" value="http://i7di.local" />
					</div>

					<div class="form-group">
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="is_local" id="is-local1" value="1" checked />
							<label class="form-check-label" for="is-local1">Local</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="is_local" id="is-local2" value="" />
							<label class="form-check-label" for="is-local2">External</label>
						</div>
					</div>

					<div class="form-group">
						<div class="form-check">
							<input type="checkbox" class="form-check-input" id="simple" name="simple" />
							<label class="form-check-label" for="simple">Simple</label>
						</div>
					</div>

					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<button type="button" id="jsonp-btn" class="btn btn-outline-secondary">Jsonp</button>
						</div>
						<div class="input-group-prepend">
							<button type="button" id="cors-btn" class="btn btn-outline-secondary">Cors</button>
						</div>
						<div class="input-group-prepend">
							<button type="button" id="set-session-btn" class="btn btn-outline-secondary">Set session</button>
						</div>
						<div class="input-group-prepend">
							<button type="button" id="get-session-btn" class="btn btn-outline-secondary">Get session</button>
						</div>
						<input type="text" class="form-control" name="msg" placeholder="typing msg." />
					</div>
				</form>
			</div>
		</div>




		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
		<script>
		$(function () {
			var f = document.forms[0];

			$("#jsonp-btn").click(function () {
				if (! f.external_url.value) {
					return;
				} else if (! f.msg.value) {
					return;
				}
				$.ajax({
					method: "GET",				// Jsonp 只能是 GET (會強制轉)
					url: f.external_url.value + "/kyo/jsonp",
					data: {
						client_msg: f.msg.value
					},
					dataType: "jsonp",
					jsonpCallback: "myJsonpCallback",
					success: function (data, textStatus, jqXHR) {
						f.msg.value = "";
					},
					error: function (jqXHR, textStatus, errorThrown) {
						console.log("Jsonp occurred error.");
					}
				});
			});

			$("#cors-btn").click(function () {
				if (! f.external_url.value) {
					return;
				} else if (! f.msg.value) {
					return;
				}
				$.ajax({
					method: "POST",
					url: f.external_url.value + (f.simple.checked ? "/kyo/corsSimple" : "/kyo/cors"),
					data: {
						client_msg: f.msg.value
					},
					dataType: "json",
					success: function (data, textStatus, jqXHR) {
						f.msg.value = "";
						console.log("Cors success: ", data);
					},
					error: function (jqXHR, textStatus, errorThrown) {
						console.log("Cors occurred error.");
					}
				});
			});

			$("#set-session-btn").click(function () {
				if (!f.is_local.value && !f.external_url.value) {
					return;
				} else if (! f.msg.value) {
					return;
				}
				$.ajax({
					method: "POST",
					url: (f.is_local.value ? "" : f.external_url.value) + (f.simple.checked ? "/kyo/sessionSimple" : "/kyo/session"),
					data: {
						client_msg: f.msg.value
					},
					dataType: "json",
					xhrFields: {
						withCredentials: f.is_local.value ? false : true
					},
					success: function (data, textStatus, jqXHR) {
						f.msg.value = "";
						console.log("Set session success: ", data);
					},
					error: function (jqXHR, textStatus, errorThrown) {
						console.log("Set session occurred error.");
					}
				});
			});

			$("#get-session-btn").click(function () {
				if (!f.is_local.value && !f.external_url.value) {
					return;
				}
				$.ajax({
					method: "POST",
					url: (f.is_local.value ? "" : f.external_url.value) + (f.simple.checked ? "/kyo/sessionSimple" : "/kyo/session"),
					dataType: "json",
					/*
						需要 Server 配合回應 Header
							Access-Control-Allow-Credentials: true
					*/
					xhrFields: {
						withCredentials: f.is_local.value ? false : true
					},
					success: function (data, textStatus, jqXHR) {
						console.log("Get session success: ", data);
					},
					error: function (jqXHR, textStatus, errorThrown) {
						console.log("Get session occurred error.");
					}
				});
			});
		});

		// Jsonp callback 使用 object method 會有 parse error (但是可以正常執行)
		function myJsonpCallback(data) {
			console.log("myJsonpCallback called: ", data);
		}
		</script>
	</body>
</html>
