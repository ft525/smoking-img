<!doctype html>
<html lang="zh-Hant">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

		<meta name="csrf-token" content="{{ csrf_token() }}" />

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />

		<!-- Custom style -->
		<style>
		#uploaded-imgs img {
			max-width: 120px;
			max-height: 80px;
			z-index: 1;
		}
		</style>

		<title>檔案上傳 Demo</title>
	</head>


	<body>
		<div class="container-fluid">
			<form></form>

			<div class="row">
				<!-- 上傳按鈕 -->
				<div class="col-sm-2">
					<div id="upload-btn" class="p-3 py-4 mb-2 bg-light text-center rounded">
						<svg class="bi bi-upload" width="2em" height="2em" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" d="M2.5 10a.5.5 0 01.5.5V14a1 1 0 001 1h12a1 1 0 001-1v-3.5a.5.5 0 011 0V14a2 2 0 01-2 2H4a2 2 0 01-2-2v-3.5a.5.5 0 01.5-.5zM7 6.854a.5.5 0 00.707 0L10 4.56l2.293 2.293A.5.5 0 1013 6.146L10.354 3.5a.5.5 0 00-.708 0L7 6.146a.5.5 0 000 .708z" clip-rule="evenodd"></path>
							<path fill-rule="evenodd" d="M10 4a.5.5 0 01.5.5v8a.5.5 0 01-1 0v-8A.5.5 0 0110 4z" clip-rule="evenodd"></path>
						</svg>
					</div>
				</div>

				<!-- 已上傳列表 -->
				<div class="col-sm-8">
					<div id="uploaded-imgs"></div>
				</div>

				<!-- 垃圾桶 -->
				<div class="col-sm-2">
					<div id="trash-can" class="p-3 py-4 mb-2 bg-light text-center rounded">
						<svg class="bi bi-trash" width="2em" height="2em" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
							<path d="M7.5 7.5A.5.5 0 018 8v6a.5.5 0 01-1 0V8a.5.5 0 01.5-.5zm2.5 0a.5.5 0 01.5.5v6a.5.5 0 01-1 0V8a.5.5 0 01.5-.5zm3 .5a.5.5 0 00-1 0v6a.5.5 0 001 0V8z"></path>
							<path fill-rule="evenodd" d="M16.5 5a1 1 0 01-1 1H15v9a2 2 0 01-2 2H7a2 2 0 01-2-2V6h-.5a1 1 0 01-1-1V4a1 1 0 011-1H8a1 1 0 011-1h2a1 1 0 011 1h3.5a1 1 0 011 1v1zM6.118 6L6 6.059V15a1 1 0 001 1h6a1 1 0 001-1V6.059L13.882 6H6.118zM4.5 5V4h11v1h-11z" clip-rule="evenodd"></path>
						</svg>
					</div>
				</div>

				<input id="input-file" type="file" name="files[]" accept="image/*" style="display:none" multiple />
			</div>
		</div>




		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
		-->
		<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


		<!-- jQuery UI - Draggable 需要 -->
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>


		<!--
			The Load Image plugin is included for the preview images and image resizing functionality
			(如果沒有使用相關 Plugin 可以不用載入)

		<script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-load-image/2.24.0/load-image.all.min.js"></script>
		-->
		<!--
			jQuery-File-Upload
				https://github.com/blueimp/jQuery-File-Upload/wiki

			Plugin files 解釋
				https://github.com/blueimp/jQuery-File-Upload/wiki/Plugin-files
		 -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-file-upload/10.4.0/js/vendor/jquery.ui.widget.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-file-upload/10.4.0/js/jquery.iframe-transport.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-file-upload/10.4.0/js/jquery.fileupload.min.js"></script>
		<!--
		<script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-file-upload/10.4.0/js/jquery.fileupload-process.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-file-upload/10.4.0/js/jquery.fileupload-image.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-file-upload/10.4.0/js/jquery.fileupload-audio.min.js"></script>
		-->


		<script>
		(function () {
			var ajax_sent = false,
				draggable_options = {
					revert: "invalid",
					containment: "document",
					helper: "clone",
					drag: function(event, ui) {
						ui.helper.css("opacity", 0.9);
					}
				},
				f = document.forms[0];


			/* Laravel - CSRF Protection */
			$.ajaxSetup({
				headers: {
					"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
				},
				beforeSend: function () {
					ajax_sent = true;
				},
				error: function (jqXHR) {
					if (jqXHR.status == "419") {
						if (confirm("Session 已失效，請重新整理頁面.")) {
							location.reload();
						}
					} else {
						alert("網路連線錯誤.");
					}
				},
				complete: function (jqXHR, textStatus) {
					ajax_sent = false;
				}
			});



			/* jQuery-file-upload - Start */

			$("#upload-btn").click(function () {
				if (ajax_sent) {
					return;
				}
				$("#input-file").click();
			});

			/*
				Options 參考
					https://github.com/blueimp/jQuery-File-Upload/wiki/Options
			*/
			$("#input-file").fileupload({
				/* AJAX Options */
				url: "/uploading/file",
				dataType: "json",
				/* Validation options */
				acceptFileTypes: /\.(gif|jpe?g|png)$/i,
				/* General Options */
				sequentialUploads: true,
				limitMultiFileUploads: 3,
				recalculateProgress: false,
				/* Callback Options */
				start: function(e) {
					ajax_sent = true;
				},
				done: function(e, data) {
					$.each(data.result.files, function(index, file) {
						// 是否上傳成功
						if (file.url) {
							if (/image\/*/.test(file.type)) {
								// 圖片
								var img = document.createElement("img");
								img.src = file.thumbnailUrl ? file.thumbnailUrl : file.url;
								$(img).dblclick(function() {
									console.log("新增圖片: " + file.name);
								}).draggable(draggable_options).attr({
									"data-deleteUrl": file.deleteUrl,
									"data-deleteType": file.deleteType
								}).addClass("img-thumbnail");
								$("#uploaded-imgs").append(img);
								$(f).append('<input type="hidden" name="images[]" value="' + file.url + '" />');
							} else {
								// 一般檔案
								console.log("新增一般檔案: " + file.name);
							}
						} else if (file.error) {
							alert(file.error);
						}

					});
				},
				always: function(e, data) {
					ajax_sent = false;
				},
				progressall: function(e, data) {
					var progress = parseInt(data.loaded / data.total * 100, 10);
					console.log("上傳進度: ", progress);
				}
			});

			$("#trash-can").droppable({
				accept: "#uploaded-imgs img",
				activeClass: "activated",
				drop: function(event, ui) {
					var img = ui.draggable.get(0);
					var iid = img.getAttribute("data-iid");
					if (iid) {
						$(f).append('<input type="hidden" name="delete_images[]" value="' + iid + '" />');
					}
					var delete_url = img.getAttribute("data-deleteUrl"),
						delete_type = img.getAttribute("data-deleteType");
					if (delete_url && delete_type) {
						$.ajax({
							url: delete_url,
							type: delete_type
						});
					}
					/* 文章替換圖片
					var reg = new RegExp(img.src.substring(img.src.indexOf('//')), "g");
					editor.setData(editor.getData().replace(reg, "{{ url('img/post/img_deleted.jpg') }}"), {noSnapshot: true});
					editor.undoManager.reset();
					*/
					img.parentNode.removeChild(img);
					$(this).removeClass("hover");
				},
				over: function(event, ui) {
					$(this).addClass("hover");
				},
				out: function(event, ui) {
					$(this).removeClass("hover");
				}
			});

			/* jQuery-file-upload - End */
		})();
		</script>
	</body>
</html>
