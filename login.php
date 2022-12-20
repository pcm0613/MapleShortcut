<?php
include "/usr/local/apache2.4/htdocs/db.php";
session_start();
$userId = trim($_POST['userId']);
$userPw= trim($_POST['userPw']);
$idSaveCheck = trim($_POST['idSaveCheck']);
 
$mysqli =mysqli_connect($host, $user, $pw, $dbName);
if ($mysqli->connect_errno) {
    die('Connect Error: '.$mysqli->connect_error);
}
 
if ($result = $mysqli->query("select * from profile where id='".$userId."' and password='".$userPw."'")){
    while ($row = $result->fetch_object()) {
        $_SESSION['nickName']=$row->nickName;
                $Exist = "1";
                echo "<script>alert('로그인 성공'); history.back();</script>";
                
    }
}
 
if ($Exist ==""){
    echo "<script>alert('로그인 정보가 다릅니다'); history.back();</script>";
    session_destroy();
    exit;
}
 
if ($idSaveCheck =="on"){
    setcookie('userId',$userId,time()+(86400*30),'/');
}else{
    setcookie('userId',$userId,time()-(86400*30),'/');
    unset($_COOKIE['userId']);
}
 
$_SESSION['userId'] = $userId;


?>
<meta http-equiv='refresh' content='0;url=/'>