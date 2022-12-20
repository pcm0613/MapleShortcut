<!doctype html>
<html>

<head>
    <meta charset="euc-kr">
    <title>메이플 지름길</title>
    <script>
        
    </script>
</head>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1">

<body>

    <?php
    $join_id = $_POST['decide_id'];
    if (isset($_COOKIE['userId'])) {
        $userId = $_COOKIE['userId'];
        $idSaveCheck = "checked";
    }
    ?>
    <div>
        <form name="SignUpForm" method="post" action="">
            <input type="text" name="userId" placeholder="ID" value="<?= $userId ?>">
            <input type="button" value="중복확인" onclick="overlapCheck();">
            <div><input type="password" name="userPw" placeholder="Password">
            </div>
            <div><input type="password" name="userPwCheck" placeholder="PasswordCheck">
            </div>
            <div><input type="text" name="nickName" placeholder="NickName">
            </div>
            <div><input type="text" name="name" placeholder="Name">
            </div>
            <div><input type="text" name="email" placeholder="E-mail">
            </div>
            <input type="button" value="작성완료" onclick="CompleteWriting();">

        </form>
    </div>




    <!--로그인 폼 유효성 체크 부분-->
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


        function decide() {
            document.getElementById("decide").innerHTML = "<span style='color:red;'>ID 중복 여부를 확인해주세요.</span>"
            document.getElementById("decide_id").value = document.getElementById("uid").value
            document.getElementById("uid").disabled = true
            document.getElementById("join_button").disabled = false
            document.getElementById("check_button").value = "다른 ID로 변경"
            document.getElementById("check_button").setAttribute("onclick", "change()")
        }

        function change() {
            document.getElementById("decide").innerHTML = "<span style='color:red;'>ID 중복 여부를 확인해주세요.</span>"
            document.getElementById("uid").disabled = false
            document.getElementById("uid").value = ""
            document.getElementById("join_button").disabled = true
            document.getElementById("check_button").value = "ID 중복 검사"
            document.getElementById("check_button").setAttribute("onclick", "checkid()")
        }
    </script>
</body>

</html>