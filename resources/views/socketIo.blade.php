<!DOCTYPE html>
<html lang="zh-Hant">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />

		<title>Socket.io Demo</title>
	</head>


	<body class="container">
		<div class="row">
			<div class="col">
				<form>
					<div class="form-group">
						<label for="socket-io-url">socket.io URL</label>
						<input type="text" id="socket-io-url" class="form-control" name="websocket_url" value="ws://ws.smoking.gov:13000" />
					</div>

					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<button type="button" id="send-btn" class="btn btn-outline-secondary">Send</button>
						</div>
						<input type="text" class="form-control" name="msg" placeholder="typing msg." />
					</div>

					<div class="form-group">
						<label for="user-id">Your user ID</label>
						<input type="number" id="user-id" class="form-control" name="user_id" />
					</div>

					<div class="form-group">
						<label for="send-to">Send to user ID</label>
						<select id="send-to" class="custom-select" name="send_to">
							<option value="all">All</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
							<option value="10">10</option>
						</select>
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
		<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/3.0.1/socket.io.min.js"></script>
		<script>
		$(function () {
			var socket = null,
				f = document.forms[0];

			$("#connect-btn").click(function () {
				if (socket && socket.connected) {
					alert("請先斷開前一個 Socket.");
					return;
				}

				if (socket && socket.disconnected) {
					// 重新連線
					console.log("重新連線");
					socket.connect();	// 或用 socket.open() 也可以
					return;
				}

				// 建立新連線
				socket = new io(f.websocket_url.value, {
					reconnection: false,
					query: {
						user_id: f.user_id.value
					}
				});
				bindSocketEvent(socket);
			});

			$("#disconnect-btn").click(function () {
				if (! socket) {
					return;
				}
				if (socket.connected) {
					socket.close();
				}
				socket = null;
			});

			$("#send-btn").click(function () {
				if (!socket || socket.disconnected) {
					return;
				}
				// send 同等於發送 message 事件
				socket.send(f.msg.value, f.send_to.value);
				f.msg.value = "";
			});

			function bindSocketEvent(_socket) {
				_socket.on("connect", function () {
					console.log("Connected.");
				});

				_socket.on("disconnect", function (reason) {
					console.log("Disconnected.", reason);
				});

				_socket.on("connect_error", function (error) {
					console.log("Connect error.", error);
				});

				_socket.on("message", function (msg) {
					console.log("On message.", msg);
				});

				// 自訂事件
				_socket.on("userIdsUpdated", function (arg) {
					console.log("On user ids updated.", arg);
				});
			}
		});
		</script>
	</body>
</html>
