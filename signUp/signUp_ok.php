<?php
include "/usr/local/apache2.4/htdocs/db.php";

$userId = trim($_POST['userId']);
$userPw= trim($_POST['userPw']);
$email= trim($_POST['email']);
$nickName= trim($_POST['nickName']);
$name= trim($_POST['name']);

echo "1";

$sql = "INSERT INTO profile (id, password, email,nickName,name) VALUES ('$userId', '$userPw', '$email','$nickName','$name')";
echo $sql;
$result = mysqli_query($conn, $sql);

if ($result == false) {
    echo "저장에 문제가 생겼습니다. 관리자에게 문의해주세요.";
    echo mysqli_error($conn);
} else {
?>
    <script>
        alert("회원가입이 완료되었습니다");
        location.href = "/";
    </script>
<?php
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>aa</title>
</head>
<body>

</body>
</html>