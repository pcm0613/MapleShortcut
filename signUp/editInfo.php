<?php
include "/usr/local/apache2.4/htdocs/db.php";
session_start();
$id = $_SESSION['userId'];
$sql = "SELECT * FROM profile where id = '$id';";
$result = mysqli_query($conn, $sql);

while ($data = $result->fetch_object()) {
  $name = $data->name;
  $nickName = $data->nickName;
  $email = $data->email;
  $password = $data->password;
};

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>회원정보수정</title>

  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- font awesome -->
  <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" title="no title" charset="utf-8">
  <!-- Custom style -->
  <link rel="stylesheet" href="css/style.css" media="screen" title="no title" charset="utf-8">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
  
  <article class="container">
    <form name="important" method="post" action="">
      <div class="page-header">
        <h1>정보수정 <small>Edit infomation</small></h1>
        <button type="submit" class="btn btn-info" onclick="changePassword();">비밀번호 번경</button>
        <button type="submit" class="btn btn-warning" onclick="withdrawal();">회원 탈퇴</button>
      </div>
    </form>
    <form name="SignUpForm" method="post" action="">
      
    <div class="col-md-6 col-md-offset-3">
        <div class="form-group">
          <label for="userId">아이디</label>
          <div>
            <?php echo $id ?>
          </div>
        </div>

        <div class="form-group">
          <label for="userPw">비밀번호</label>
          <input type="password" class="form-control" name="userPw" placeholder="비밀번호가 일치해야 정보가 수정됩니다.">
        </div>


        <div class="form-group">
          <label for="nickName">닉네임</label>
          <div>
            <?php echo $nickName ?>
          </div>
        </div>

        <div class="form-group">
          <label for="name">이름</label>
          <input type="text" class="form-control" name="name" value="<?php echo $name ?>" placeholder="이름을 입력해 주세요">
        </div>

        <div class="form-group">
          <label for="email">이메일 주소</label>
          <input type="email" class="form-control" name="email" value="<?php echo $email ?>" placeholder="이메일 주소를 입력해 주세요">
        </div>

        <div class="form-group text-center">
          <button type="submit" class="btn btn-info" onclick="CompleteWriting();">수정완료<i class="fa fa-check spaceLeft"></i></button>
          <button type="submit" class="btn btn-warning" onclick="goBack();">취소<i class="fa fa-times spaceLeft"></i></button>
        </div>
      </div>
    </form>

  </article>

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.min.js"></script>
  <script>
    function overlapCheckNick() {
      var nick = document.SignUpForm.nickName.value;
      if (nick) //userid로 받음
      {
        url = "checkNick.php?nickName=" + nick;
        window.open(url, "chkNick", "width=400,height=200");
      } else {
        alert("닉네임을 입력하세요.");
      }
    }

    function CompleteWriting() {
      var F = document.SignUpForm;
      
      if (F.userPw.value == "") {
        alert("비밀번호를 입력해주세요");
        F.userPw.focus();
        return false;
      }


      if (F.name.value == "") {
        alert("이름을 입력해주세요");
        F.name.focus();
        return false;
      }
      if (F.email.value == "") {
        alert("이메일을 입력해주세요");
        F.email.focus();
        return false;
      }
     

      if (F.userPw.value != '<?php echo $password ?>') {
        alert("비밀번호가 일치하지 않습니다.");
        F.userPw.focus();
        return false;
      }


      F.action = "editInfo_ok.php";
      F.submit();
    }


    function goBack() {
      document.SignUpForm.action = "/"
    }

    function decideNick(nick) {
      document.SignUpForm.nickName.value = nick;
    }

    function withdrawal() {
      if (confirm("탈퇴하시겠습니까?")) {
        document.important.action="withdrawal.php"
      }else{
        
      }
    }

    function changePassword() {
      if (confirm("비밀번호를 변경하시겠습니까?")) {
        document.important.action="changePassword.php"
      }else{
        
      }
    }
  </script>
</body>

</html>