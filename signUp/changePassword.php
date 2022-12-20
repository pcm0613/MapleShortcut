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
    <title>비밀번호 변경</title>

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
                <h1>비밀번호 변경<small>PasswordChange</small></h1>
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
                    <input type="password" class="form-control" name="userPw" placeholder="비밀번호를 입력해 주세요">
                </div>
                <div class="form-group">
                    <label for="userPw">새 비밀번호</label>
                    <input type="password" class="form-control" name="newPw" placeholder="새 비밀번호">
                </div>
                <div class="form-group">
                    <label for="userPw">새 비밀번호 확인</label>
                    <input type="password" class="form-control" name="newPwCheck" placeholder="새 비밀번호 확인">
                </div>



                <div class="form-group text-center">
                    <button type="submit" class="btn btn-info" onclick="CompleteWriting();">비밀번호 변경<i class="fa fa-check spaceLeft"></i></button>
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
        function CompleteWriting() {
            var F = document.SignUpForm;

            if (F.userPw.value == "") {
                alert("비밀번호를 입력해주세요");
                F.userPw.focus();
                return false;
            }
            if (F.newPw.value == "") {
                alert("새 비밀번호를 입력해주세요");
                F.newPw.focus();
                return false;
            }
            if (F.newPwCheck.value == "") {
                alert("새 비밀번호 확인을 입력해주세요");
                F.newPwCheck.focus();
                return false;
            }
            if (F.newPw.value != F.newPwCheck.value) {
                alert("새 비밀번호가 일치하지 않습니다.");
                F.newPwCheck.focus();
                return false;
            }

            if (F.userPw.value != '<?php echo $password ?>') {
                alert("비밀번호가 일치하지 않습니다.");
                F.userPw.focus();
                return false;
            }

            F.action = "changePassword_ok.php?id";
            F.submit();
        }

        function goBack() {
            document.SignUpForm.action = "/"
        }
    </script>
</body>

</html>