<?php
session_start();
$nickName = $_SESSION['nickName'];
$chatOn = $_SESSION['chatOn'];
if($_SESSION['chatOn']=="")
{
    $chatOn="false";
}
#쿠키에서 로그인정보 불러오기#
if (isset($_COOKIE['userId'])) {
    $userId = $_COOKIE['userId'];
    $idSaveCheck = "checked";
}
?>
<input type="hidden" id="nickName" value="<?= $nickName ?>">
<input type="hidden" id="chatOn" value="<?= $chatOn ?>">
<!doctype html>
<html>

<head>
    <meta charset="euc-kr">
    <link rel="stylesheet" href="/my_css.css?137">

<body>
    <header>
        <!-- img src="images/hoyoung.png" class="img_logo" /></a> -->

        <nav>

            <div class="nav_items">
                <ul>
                    <li><a href="/">메인</a></li>
                    <li><a href="/boards/job_board.php">직업 게시판</a></li>
                    <li><a href="/boards/info_board.php">정보공유 게시판</a></li>
                    <li><a href="/boards/community_board.php">커뮤니티 게시판</a></li>
                    <li><a href="/boards/gallery.php">갤러리</a></li>

                </ul>
                <form name="frmData" id="frmData" method="post">
                    <input type="hidden" name="nickName" id="nickName" value="<?= $nickName ?>" />
                </form>
                <ul><?php
                    if ($_SESSION['userId'] == "") {
                        echo '<input type="button" value="회원가입" onclick="signUp();"><input type="button" value="로그인" style="margin-left: 20px;"onclick="login();">';
                    } else {
                        echo ' <input type="button" value="채팅" onclick="openPop()"> <input type="button" value="글쓰기" onclick="write1();"> <input type="button" value="정보수정" onclick="editinfo();"> <input type="button" value="로그아웃" onclick="logout();">';
                        echo "  Welcome! " . $nickName;
                    } ?>
                    <?php
                    if ($_SESSION['userId'] != "") {
                    } ?>



                    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

            </div>


        </nav>



    </header>

    <main>

        <!--로그인 폼 유효성 체크 부분-->
        <script>
            function LoginCheck() {
                var F = document.LoginForm;
                if (F.userId.value == "") {
                    alert("ID를 입력해주세요");
                    F.userId.focus();
                    return false;
                }
                if (F.userPw.value == "") {
                    alert("PassWord를 입력해주세요");
                    F.userPw.focus();
                    return false;
                }
                F.action = "/login.php";
                F.submit();
            }

            function logout() {

                location.href = '/signUp/logout.php';

            }

            function login() {
                location.href = '/signUp/login.php';
            }

            function editinfo() {
                location.href = '/signUp/editInfo.php';
            }

            function write1() {
                location.href = '/write.php';
            }

            /* function chating() {
                var url = 'https://mapleshortcut.ml:8080';
                window.open('', 'Chatting', 'width=800,height=1000')

            }
 */
            function openPop() {

                $.ajax({
                    type: "POST", // HTTP method type(GET, POST) 형식이다.
                    /* dataType: "json", */
                    url: "/chatOn.php", // 컨트롤러에서 대기중인 URL 주소이다.
                    data: {
                        giveMe: "true"
                    },
                    success: function(nowLogedNick) {
                        if($('#nickName').val() == nowLogedNick)
                        {
                            var pop_title = "Chatting";
                            var w = window.open("", pop_title, 'width=500,height=1000');
                            var frmData = document.frmData;
                            frmData.target = pop_title;
                            frmData.action = "https://mapleshortcut.ml:8080";
                            frmData.submit();
                        }
                        else {
                            alert("현재 로그인한 아이디와 다릅니다.");
                        }
                    }
                });

            }



            function signUp() {
                location.href = '/signUp/signUp.php';
            }

            function activity() {
                location.href = '/activity.php';
            }
        </script>