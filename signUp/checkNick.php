<?php
$host = "localhost:3306";
$user = "root";
$pw = "48241265qw";
$dbName = "MapleShortcut";
$conn = mysqli_connect($host, $user, $pw, $dbName);

$nickName = $_GET["nickName"];  //GET으로 넘긴 userid
$sql = "SELECT * FROM profile where nickName='$nickName'";
$result = mysqli_fetch_array(mysqli_query($conn, $sql));

if (!$result) {
    echo "<span style='color:blue;'>$nickName</span> 는 사용 가능한 닉네임입니다.";
?><p><input type=button value="이 닉네임 사용" onclick="opener.parent.decideNick('<?php echo $nickName?>'); window.close();"></p>

<?php
} else {
    echo "<span style='color:red;'>$nickName</span> 는 중복된 닉네임입니다.";
?><p><input type=button value="다른 닉네임 사용" onclick="/* opener.parent.change();  */window.close()"></p>
<?php
}
?>
