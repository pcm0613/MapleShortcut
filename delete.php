<?php
include "/usr/local/apache2.4/htdocs/db.php";
session_start();
$writer=$_SESSION['nickName'];

$number = $_GET['number'];


//글삭제 + 댓글삭제
$sql = "DELETE FROM post where writer='$writer' and number=$number;";
$sql.="DELETE * FROM review where number=$number;";

echo $sql;
$result = mysqli_multi_query($conn, $sql);


if ($result == false) {
    echo "삭제에 문제가 생겼습니다. 관리자에게 문의해주세요.";
    echo mysqli_error($conn);
} else {
?>
    <script>
        alert("글삭제가 완료되었습니다");
        location.href = "/";
    </script>
<?php
}
?>
