<?php
// 설정
include "/usr/local/apache2.4/htdocs/db.php";
$uploads_dir = '/usr/local/apache2.4/htdocs/uploads';

$allowed_ext = array('jpg', 'jpeg', 'png', 'gif');
$now=date("Y-m-d H:i:s");
// 변수 정리
$error = $_FILES['myfile']['error'];
$name = $_FILES['myfile']['name'];
$ext = array_pop(explode('.', $name));

$saveName="$now$name";
// 오류 확인
if ($error != UPLOAD_ERR_OK) {
	switch ($error) {
		case UPLOAD_ERR_INI_SIZE:
		case UPLOAD_ERR_FORM_SIZE:
			echo "파일이 너무 큽니다. ($error)";
			break;
		case UPLOAD_ERR_NO_FILE:
			echo "파일이 첨부되지 않았습니다. ($error)";
			break;
		default:
			echo "파일이 제대로 업로드되지 않았습니다. ($error)";
	}
	exit;
}

// 확장자 확인
if (!in_array($ext, $allowed_ext)) {
	echo "허용되지 않는 확장자입니다.";
	exit;
}

// 파일 이동
if (move_uploaded_file($_FILES['myfile']['tmp_name'], "$uploads_dir/$saveName")) {
	$saveDir ="/uploads/$saveName";
	echo "성공";
	$title = trim($_POST['title']);
	$content = trim($_POST['content']);
	$today = date("Y-m-d");


	$sql = "INSERT INTO gallery (title, writer, contents, date,image,views,recommentations) VALUES ('$title', '관리자','$content','$today','$saveDir',0,0)";
	echo $sql;
	$result = mysqli_query($conn, $sql);
?>
	<script>
		alert("글작성이 완료되었습니다.");
		location.href = "boards/gallery.php";
	</script>
<?php
} else {
	echo "실패";
}


// 파일 정보 출력
echo "<h2>파일 정보</h2>
<ul>
	<li>파일명: $saveName</li>
	<li>확장자: $ext</li>
	<li>파일형식: {$_FILES['myfile']['type']}</li>
	<li>파일크기: {$_FILES['myfile']['size']} 바이트</li>
</ul>";
?>