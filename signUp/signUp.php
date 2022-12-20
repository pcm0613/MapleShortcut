<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>회원가입</title>

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
    <div class="page-header">
      <h1>회원가입 <small>Sign up</small></h1>
    </div>
    <form name="SignUpForm" method="post" action="">
      <div class="col-md-6 col-md-offset-3">
        <div class="form-group">
          <label for="userId">아이디</label>

          <input type="text" class="form-control" name="userId" placeholder="아이디">
          <button type="submit" class="btn btn-info" onclick="overlapCheck();">중복확인</button>
        </div>

        <div class="form-group">
          <label for="userPw">비밀번호</label>
          <input type="password" class="form-control" name="userPw" placeholder="비밀번호">
        </div>

        <div class="form-group">
          <label for="userPwCheck">비밀번호 확인</label>
          <input type="password" class="form-control" name="userPwCheck" placeholder="비밀번호 확인">
          <p class="help-block">비밀번호 확인을 위해 다시 한번 입력 해 주세요</p>
        </div>
        <div class="form-group">
          <label for="nickName">닉네임</label>
          <input type="text" class="form-control" name="nickName" placeholder="닉네임을 입력해 주세요">
          <button type="submit" class="btn btn-info" onclick="overlapCheckNick();">중복확인</button>
        </div>

        <div class="form-group">
          <label for="name">이름</label>
          <input type="text" class="form-control" name="name" placeholder="이름을 입력해 주세요">
        </div>

        <div class="form-group">
          <label for="email">이메일 주소</label>
          <input type="email" class="form-control" name="email" placeholder="이메일 주소를 입력해 주세요">
        </div>

        <div class="form-group text-center">
          <button type="submit" class="btn btn-info" onclick="CompleteWriting();">회원가입<i class="fa fa-check spaceLeft"></i></button>
          <button type="submit" class="btn btn-warning" onclick="goBack();" value="가입취소">가입취소<i class="fa fa-times spaceLeft"></i></button>
        </div>
      </div>
    </form>

  </article>

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.min.js"></script>
  <script>
  
    function overlapCheck() {
      var userid = document.SignUpForm.userId.value;
      if (userid) //userid로 받음
      {
        url = "check.php?userid=" + userid;
        window.open(url, "chkid", "width=400,height=200");
      } else {
        alert("아이디를 입력하세요.");
      }
    }

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
      if (F.userId.value == "") {
        alert("ID를 입력해주세요");
        F.userId.focus();
        return false;
      }
      if (F.userPw.value == "") {
        alert("비밀번호를 입력해주세요");
        F.userPw.focus();
        return false;
      }
      if (F.userPwCheck.value == "") {
        alert("비밀번호재확인을 입력해주세요");
        F.userPwCheck.focus();
        return false;
      }
      if (F.userPwCheck.value != F.userPw.value) {
        alert("비밀번호가 일치하지 않습니다.");
        F.userPw.focus();
        return false;
      }

      if (F.nickName.value == "") {
        alert("별명을 입력해주세요");
        F.NickName.focus();
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

     



      F.action = "signUp_ok.php";
      F.submit();
    }

    function decide(id) {
      document.SignUpForm.userId.value=id;
    }
    function decideNick(nick) {
      document.SignUpForm.nickName.value=nick;
    }

    function goBack(){
      document.SignUpForm.action="/"
    }

  </script>
</body>

</html>