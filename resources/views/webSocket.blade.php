<!DOCTYPE html>
<html lang="zh-Hant">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />

		<title>WebSocket Demo</title>
	</head>


	<body class="container">
		<div class="row">
			<div class="col">
				<form>
					<div class="form-group">
						<label for="websocket-url">WebSocket URL</label>
						<input type="text" class="form-control" name="websocket_url" value="ws://ws.smoking.gov:11215" />
					</div>

					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<button type="button" id="send-btn" class="btn btn-outline-secondary">Send</button>
						</div>
						<input type="text" class="form-control" name="msg" placeholder="typing msg." />
					</div>

					<button type="button" id="connect-btn" class="btn btn-success">Connect</button>
					<button type="button" id="disconnect-btn" class="btn btn-danger">Disconnect</button>
				</form>
			</div>
		</div>




		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
		<script>
		$(function () {
			// WebSocket 參考: https://developer.mozilla.org/en-US/docs/Web/API/WebSocket
			var ws = null,
				f = document.forms[0];

			$("#connect-btn").click(function () {
				if (ws) {
					alert("請先斷開前一個 WebSocket.");
					return;
				}

				ws = new WebSocket(f.websocket_url.value);
				bindWsEvent(ws);
			});

			$("#disconnect-btn").click(function () {
				if (! ws) {
					return;
				}
				if (ws.readyState != WebSocket.OPEN) {
					return;
				}
				var status_code = 1000,			// 參考: https://developer.mozilla.org/en-US/docs/Web/API/CloseEvent#Status_codes
					reason = "使用者斷開.";
				ws.close(status_code, reason);
				ws = null;
			});

			$("#send-btn").click(function () {
				if (! ws) {
					return;
				} else if (ws.readyState != WebSocket.OPEN) {
					return;
				}
				ws.send(f.msg.value);
				f.msg.value = "";
			});

			function bindWsEvent(_ws) {
				_ws.onopen = function (event) {
					console.log("Opened.", event);
				};

				_ws.onmessage = function (event) {
					console.log("Got message.", event);
				};

				_ws.onclose = function (event) {
					console.log("Closed.", event);
					ws = null;
				};

				_ws.onerror = function (event) {
					console.log("Error." . event);
				};

				// 自訂事件 (TODO: 目前不知如何觸發)
				_ws.onServerGotMessage = function (event) {
					console.log("Server got message.", event);
				};
			}
		});
		</script>
	</body>
</html>
