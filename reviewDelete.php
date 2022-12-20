<?php
include "/usr/local/apache2.4/htdocs/db.php";
session_start();
$writer=$_SESSION['nickName'];
$id = $_GET['id'];
$number = $_GET['number'];



$sql = "DELETE FROM review where writer='$writer' and id='$id'";

echo $sql;
$result = mysqli_query($conn, $sql);

if ($result == false) {
    echo "삭제에 문제가 생겼습니다. 관리자에게 문의해주세요.";
    echo mysqli_error($conn);
} else {
?>
    <script>
        alert("댓글삭제가 완료되었습니다");
        location.href = "/read.php?number=<?php echo $number?>";
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