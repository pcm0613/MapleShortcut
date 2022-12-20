<?php
include "/usr/local/apache2.4/htdocs/db.php";
session_start();
$id=$_SESSION['userId'];
$userPw= trim($_POST['userPw']);
$email= trim($_POST['email']);

$name= trim($_POST['name']);



$sql = "UPDATE profile SET email='$email', name='$name' WHERE id = '$id'";

echo $sql;
$result = mysqli_query($conn, $sql);

if ($result == false) {
    echo "저장에 문제가 생겼습니다. 관리자에게 문의해주세요.";
    echo mysqli_error($conn);
} else {
?>
    <script>
        alert("정보수정이 완료되었습니다");
        location.href = "/";
    </script>
<?php
}
?>

