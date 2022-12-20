<?php
include "/usr/local/apache2.4/htdocs/defalutLayout.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>갤러리</title>
</head>

<body>
	<div style="text-align: center;">
	<form enctype='multipart/form-data' action='upload_ok.php' method='post'>
		<div id="in_title">
			<textarea name="title" id="title" rows="1" cols="55" placeholder="제목" maxlength="100" style="width: 700px; height: 20px;"required></textarea>
		</div>

		<div class="wi_line"></div>
		<div id="in_content">
			<textarea name="content" id="content" placeholder="내용" style="width: 700px; height: 500px;"required></textarea>
		</div>
		<input type='file' name='myfile'>
		<button>보내기</button>
	</form>
	</div>
</body>

</html>