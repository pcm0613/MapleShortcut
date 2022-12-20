<?php
include "/usr/local/apache2.4/htdocs/db.php";
include "/usr/local/apache2.4/htdocs/defalutLayout.php";
$number = $_GET['number'];

// 조회 수 증가
$increase_sql = "UPDATE gallery SET views = views+1 WHERE number ='$number'";
$increase_result = mysqli_query($conn, $increase_sql);

// 해당 글을 읽어오기 위한 쿼리문..
$sql = "SELECT * FROM gallery WHERE number='$number'";
$result = mysqli_query($conn, $sql);
$data = $result->fetch_array(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html>

<head>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="/test/js/bootstrap.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>글 읽기</title>
    <link rel="stylesheet" href="/test/css/bootstrap.css">
</head>
<!--php의 변수 html로 가져오기-->
<input type="hidden" id="d1" value="<?= $index ?>">
<!--삭제를 위한 스크립트-->
<script>
    $(document).ready(function() {
        //삭제 버튼 클릭시
        $('#delete_btn').click(function() {
            $.ajax({
                type: 'POST',
                url: 'http://192.168.0.2:80/test/notice_board/delete',
                data: {
                    idx: $("#d1").val()
                },
                success: function(result) {
                    if (result == "success") {
                        alert("글 삭제 성공");
                        location.replace('http://wamp서버ip주소:80/test/main');
                    } else if (result == "Fail:delete") {
                        alert("글 삭제 실패...다시 시도 해주세요.");
                    }
                },
                error: function(xtr, status, error) {
                    alert(xtr + ":" + status + ":" + error);
                }
            });
        });
    });
</script>

<body>
    <div class="container">
        <table class="read">
            <thead>
                <caption>&lt; 갤러리 &gt;</caption>
            </thead>
            <tbody>
                <tr class="title">
                    <td class="tit"><?php echo $data['title']; ?></td>
                    <td class="date"><?php echo $data['date']; ?></td>
                </tr>
                <tr>

                </tr>
                <tr>
                    <td class="writer"><?php echo $data['writer']; ?></td>
                    <td class="views">조회 수 : <?php echo $data['views']; ?></td>
                </tr>

                <tr>
                    <td class="contents" colspan="2"><?php echo $data['contents']; ?></td>
                </tr>
                <tr>
                    <td colspan="2"><img src="<?php echo $data['image'] ?>" width="100%" height="400px"></td>
                </tr>
            </tbody>


        </table>
        <!--본인이 작성한 글이라면 수정,삭제 버튼 보이기-->
        <?php
        if ($_SESSION['userNAME'] == $data['author']) {
        ?>
            <!-- <a class="btn btn-outline-primary" id="update_btn" href="/test/notice_board/update_write?idx=<?php echo $index; ?>">수정하기</a>
            <input type="button" class="btn btn-outline-primary" id="delete_btn" value="삭제하기"> -->
        <?php } ?>
    </div>
</body>

</html>