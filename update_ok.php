<?php
include "/usr/local/apache2.4/htdocs/db.php";
session_start();
$writer=$_SESSION['nickName'];

$title = trim($_POST['title']);
$content= trim($_POST['content']);
$category= trim($_POST['category']);
$number= trim($_POST['number']);
$where;
if($category==1)
{
    $where="boards/job_board.php";
}else if($category==2){
    $where="boards/info_board.php";
}else if($category==3){
    $where="boards/community_board.php";
}

$today = date("Y-m-d");

$sql = "UPDATE post SET contents='$content',date='$today',title='$title' WHERE number='$number'";

$result = mysqli_query($conn, $sql);

if ($result == false) {
    echo "수정에 문제가 생겼습니다. 관리자에게 문의해주세요.";
    echo mysqli_error($conn);
} else {
?>
    <script>
        alert("글수정이 완료되었습니다.");
        location.href = '<?php echo $where ?>';
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
