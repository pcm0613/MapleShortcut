<?php
$host = "localhost:3306";
$user = "root";
$pw = "48241265qw";
$dbName = "MapleShortcut";
$conn = mysqli_connect($host, $user, $pw, $dbName);

$uid = $_GET["userid"];  //GET으로 넘긴 userid
$sql = "SELECT * FROM profile where id='$uid'";
$result = mysqli_fetch_array(mysqli_query($conn, $sql));

if (!$result) {
    echo "<span style='color:blue;'>$uid</span> 는 사용 가능한 아이디입니다.";
?><p><input type=button value="이 ID 사용" onclick="opener.parent.decide('<?php echo $uid?>'); window.close();"></p>

<?php
} else {
    echo "<span style='color:red;'>$uid</span> 는 중복된 아이디입니다.";
?><p><input type=button value="다른 ID 사용" onclick="/* opener.parent.change();  */window.close()"></p>
<?php
}
?>
