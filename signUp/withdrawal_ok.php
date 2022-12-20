<?php
include "/usr/local/apache2.4/htdocs/db.php";
session_start();
$loginid = $_SESSION['userId'];
$id = $_GET['id'];



if ($loginid == $id) {
    $sql = "DELETE FROM profile where id='$loginid'";
}

$result = mysqli_query($conn, $sql);

if ($result == false) {
    echo "삭제에 문제가 생겼습니다. 관리자에게 문의해주세요.";
    echo mysqli_error($conn);
} else {
    session_unset();
    session_destroy();
?>
    <script>
        alert("계정삭제가 완료되었습니다");

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