<?php
include "/usr/local/apache2.4/htdocs/db.php";

$category=3;
$now = date("Y-m-d H:i:s");


for($i=0;$i<100;$i++)
{
    $sql = "INSERT INTO review (writer, contents, writeAt,number) VALUES ('키우리', '$i.번째 댓글입니다 !!','$now',601);";
    echo $sql;
    $result = mysqli_query($conn, $sql);
}
?>
