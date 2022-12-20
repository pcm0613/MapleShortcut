<?php
session_start();
include "/usr/local/apache2.4/htdocs/db.php";
include "/usr/local/apache2.4/htdocs/defalutLayout.php";
$number = $_GET['number'];
// 조회 수 증가
$increase_sql = "UPDATE post SET views = views+1 WHERE number ='$number';";
$increase_result = mysqli_query($conn, $increase_sql);
$nickName = $_SESSION['nickName'];
// 해당 글을 읽어오기 위한 쿼리문..
$sql = "SELECT * FROM post WHERE number='$number';";
$result = mysqli_query($conn, $sql);
$data = $result->fetch_array(MYSQLI_ASSOC);

$category;

$now=date("Y-m-d H:i:s");

$lovesql = "SELECT * FROM love where nickName='$nickName' and number='$number'";
$lovesqlResult = mysqli_query($conn, $lovesql);
$likeChecked = mysqli_num_rows($lovesqlResult);


if ($data['category'] == 1) {
    $category = "직업 게시판";
} else if ($data['category'] == 2) {
    $category = "정보공유 게시판";
} else if ($data['category'] == 3) {
    $category = "커뮤니티 게시판";
}


function When($time)
{

    
}


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
<input type="hidden" id="nickName" value="<?= $nickName ?>">
<input type="hidden" id="number" value="<?= $number ?>">
<input type="hidden" id="likeChecked" value="<?= $likeChecked ?>">
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
                <caption>&lt; <?php echo $category; ?> &gt;</caption>
                <td colspan="2" style='<?php
                                        if ($_SESSION['nickName'] != $data['writer']) {
                                            echo "visibility: hidden;
                                                               text-align: right";
                                        } else {
                                            echo "visibility: visible;
                                                               text-align: right";
                                        } ?>'>
                    <input type="button" value="수정" onclick="location.href='/update.php?number=<?php echo $number ?>'"></button>
                    <input type="button" value="삭제" onclick="location.href='/delete.php?number=<?php echo $number ?>'"></button>
                </td>
            </thead>
            <tbody id="abc">
                <tr class="title">
                    <td class="tit"><?php echo $data['title']; ?></td>
                    <td class="date"><?php echo $data['date']; ?></td>
                </tr>

                <tr>
                    <td class="writer"><?php echo $data['writer']; ?></td>
                    <td class="views">조회 수 : <?php echo $data['views']; ?></td>
                </tr>

                <tr>
                    <td class="contents" colspan="2"><?php echo $data['contents']; ?></td>
                </tr>
                <?php
                $reviewSQL = "select * from review where number ='$number'";
                $reviewResult = mysqli_query($conn, $reviewSQL);
                $total_review = mysqli_num_rows($reviewResult);


                $list = 30;
                $block_ct = 5;
                $page = 1;
                $block_num = ceil($page / $block_ct); // 현재 페이지 블록 구하기
                $block_start = (($block_num - 1) * $block_ct) + 1; // 블록의 시작번호
                $block_end = $block_start + $block_ct - 1; //블록 마지막 번호

                $total_page = ceil($total_review / $list); // 페이징한 페이지 수 구하기
                if ($block_end > $total_page) $block_end = $total_page; //만약 블록의 마지박 번호가 페이지수보다 많다면 마지박번호는 페이지 수
                $total_block = ceil($total_page / $block_ct); //블럭 총 개수
                $start_num = ($page - 1) * $list;


                $SQL = "select * from review where number ='$number' ORDER BY number DESC limit 0, 30;";
                $SQLResult = mysqli_query($conn, $SQL);
                ?>
                <input type="hidden" id="total_review" value="<?= $total_review ?>">
                <input type="hidden" id="total_page" value="<?= $total_page ?>">
                <tr class="commentTr">
                    <td class="commentCount"><img class="like" src=
                    <?php if($likeChecked==0)
                    {
                        echo "/images/emptyHeart.png";
                    }
                    else
                    {
                        echo "/images/heart.png";
                    }?> width=20px height=20px onclick="clickLike();"><a class="likeCount" href="#"> 좋아요 <b><?php echo $data['love'] ?></b></a> &nbsp;<a class="comment_a" href="javascript:void(0);">댓글 <b><?php echo $total_review ?></b></a></td>
                    <td class="commentCount" id="reviewPages" style="text-align:right">
                        <?php

                        echo '<a class="reviewPage" href="#" onclick="reviewPaging(-1)"> &lt; </a>';
                        for ($i = 1; $i <= $block_end; $i++) {
                            if ($i == 1) {
                                echo '<a class="selectedList" id="reviewList' . $i . '" href="#" onclick="reviewPaging(' . $i . ')">' . $i . '</a> ';
                            } else {
                                echo '<a class="reviewPage" id="reviewList' . $i . '" href="#" onclick="reviewPaging(' . $i . ')">' . $i . '</a> ';
                            }
                        }

                        echo '<a class="reviewPage" href="#" onclick="reviewPaging(-2)"> &gt; </a>';
                        ?>
                    </td>
                </tr>
                <tr class="commentTr">
                <td class="commentCount" id="likeList" colspan="2" style="text-align: left;">
                <?php
                $likeListSQL="SELECT * FROM love where number='$number'";
                $likeListResult = mysqli_query($conn, $likeListSQL);
                while ($data = $likeListResult->fetch_array()) : ?>
                <?php echo $data['nickName'];/* "(".$data['create_time'].")" */ ?>
                <?php endwhile ?>
                </td>
                </tr>
                <?php
                $index = 0;
                while ($data = $SQLResult->fetch_array()) : ?>

                    <tr class="aaa">
                        <td class="review">ㄴ<?php echo $data['writer'];
                                            echo '(';
                                            echo $data['writeAt'];
                                            echo ')' ?></td>
                        <td class="review" style='<?php
                                                    if ($_SESSION['nickName'] != $data['writer']) {
                                                        echo "visibility: hidden;
                                                               text-align: right";
                                                    } else {
                                                        echo "visibility: visible;
                                                               text-align: right";
                                                    } ?>'><a href="#" onclick="editComment('<?php echo $data['contents']; ?>','<?php echo $index; ?>','<?php echo $number; ?>','<?php echo $data['id'] ?>');">수정</a> |
                            <a href="/reviewDelete.php?id=<?php echo $data['id'] ?>&number=<?php echo $number ?>">삭제</a>
                        </td>

                    </tr>
                    <tr class="aaa" id='<?php echo $index ?>'>
                        <td class="review"><?php echo $data['contents']; ?></td>
                    </tr>
                    <!-- <tr>
                        <td><textarea name="" id="" cols="30" rows="10"></textarea></td>
                    </tr> -->
                    <!-- <tr>
                        <td class="review" colspan="2" name="commentEdit"><textarea name="" id="" style="width: 100%; height: 100px;"></textarea></td>
                    </tr> -->

                <?php $index += 1;
                endwhile ?>


                <tr class="writeComment" style="text-align: right; ">
                    <td colspan="2">
                        <form enctype="multipart/form-data" action="review_ok.php" method="post">
                            <input type="hidden" value="<?php echo $number ?>" name="number" id="number">
                            <textarea name="content" id="content" placeholder="댓글을 작성해 주세요" style="width: 100%; height: 100px;" required></textarea>
                            <button type="submit">댓글 등록</button>
                        </form>
                    </td>
                </tr>
            </tbody>

        </table>

    </div>
    <script>
        var like;
        if($("#likeChecked").val()>=1)
        {
            like="on";
        }else
        {
            like="off";
        }
        var canEdit = '1';

        function editComment(contents, index, number, id) {
            if (canEdit == '1') {
                let abc = document.getElementById(index);
                let commentEdit_tr = document.createElement('tr');
                commentEdit_tr.setAttribute('style', 'text-align: right;');
                commentEdit_tr.setAttribute('class', 'editTr');
                let commentEdit_td = document.createElement('td');
                commentEdit_tr.appendChild(commentEdit_td);
                commentEdit_td.setAttribute('colspan', '2');
                commentEdit_td.setAttribute('class', 'aaa');
                let commentEdit_textarea = document.createElement('textarea');
                commentEdit_td.appendChild(commentEdit_textarea);
                commentEdit_textarea.setAttribute('style', 'width: 100%; height: 100px;');
                commentEdit_textarea.setAttribute('name', 'editTextarea');
                commentEdit_textarea.setAttribute('required', '');
                commentEdit_textarea.innerHTML = contents;
                let complete = document.createElement('input');
                complete.setAttribute('type', 'button');
                complete.setAttribute('style', 'margin-right: 15px')
                complete.setAttribute('value', '수정완료');
                complete.setAttribute('onclick', 'completeEdit(\'' + number + '\',\'' + id + '\',\'' + commentEdit_textarea + '\');');
                let cancel = document.createElement('input');
                cancel.setAttribute('type', 'button');
                cancel.setAttribute('value', '취소');
                cancel.setAttribute('onclick', 'editCancel(\'' + id + '\',\'' + contents + '\',\'' + index + '\');');
                //complete.addEventListener()
                commentEdit_td.appendChild(complete);
                commentEdit_td.appendChild(cancel);
                /* abc.appendChild(commentEdit_tr); */




                /* var index=$(this).index()+1;
                abc.replaceChild(commentEdit_tr,abc.childNodes[index]);
                abc.removeChild(abc.childNodes[index+1]); */
                /* abc.replaceChild(commentEdit_tr, abc.childNodes[7]); */
                /* abc.replace(commentEdit_tr); */
                abc.replaceWith(commentEdit_tr);
                canEdit = '2';
            }


        }

        function completeEdit(number, id, textarea) {

            //textarea.value='';
            /* $(textarea).val("새로운 값을 지정합니다."); */

            location.href = "/reviewUpdate.php?id=" + id + "&number=" + number + "&contents=" + $(document.getElementsByName('editTextarea')).val();
        }


        $(".comment_a").click(function() {

            if ($(".aaa").is(":visible")) {
                $(".aaa").css("display", "none");

            } else {
                $(".aaa").css("display", "block");
            }
        })

        var page = 1;
        var before = $("#reviewList" + 1);
        var totalReview = $("#total_review").val();
        var totalPage = $("#total_page").val();
        var block = 5;
        var blockNum = 1;
        var blockStart = 1;
        var blockEnd = 5;
        var startNum = 1;

        function editCancel(id, contents, index) {

            let contents_tr = document.createElement('tr');
            /* contents_tr.setAttribute('style', 'text-align: right;'); */
            contents_tr.setAttribute('class', 'aaa');
            contents_tr.setAttribute('id', id);
            let contents_td = document.createElement('td');
            contents_tr.appendChild(contents_td);
            contents_td.setAttribute('colspan', '2');
            contents_td.setAttribute('class', 'review');
            contents_td.innerHTML = contents;
            $('.editTr').replaceWith(contents_tr);
            canEdit = '1';
        }

        function reviewPaging(index) {
            canEdit = '1';
            before.attr('class', 'reviewPage');
            if (index == -1) {
                if (page > 1) {
                    page -= 1;
                    if (page < blockStart) {
                        if (blockEnd % 5 == 0) {
                            blockEnd -= 5;
                        } else {
                            while (blockEnd % 5 != 0) {
                                blockEnd -= 1;
                            }
                        }
                        blockNum--;
                        blockStart -= 5;
                        $(".reviewPage").remove();
                        var htmlCode = '';
                        htmlCode += '<a class="reviewPage" href="#" onclick="reviewPaging(-1)"> &lt; </a>';
                        for (var i = blockStart; i <= blockEnd; i++) {
                            if (i == blockEnd) {
                                htmlCode += '<a class="selectedList" id="reviewList' + i + '" href="#" onclick="reviewPaging(' + i + ')">' + i + '</a> ';
                            } else {
                                htmlCode += '<a class="reviewPage" id="reviewList' + i + '" href="#" onclick="reviewPaging(' + i + ')">' + i + '</a> ';
                            }
                        }
                        htmlCode += '<a class="reviewPage" href="#" onclick="reviewPaging(-2)"> &gt; </a>';
                        $("#reviewPages").append(htmlCode);
                    }



                }
            } else if (index == -2) {
                if (page < totalPage) {

                    page += 1;
                    if (page > blockEnd) {
                        blockEnd += 5;
                        if (blockEnd > totalPage) {
                            blockEnd = totalPage;
                        }
                        blockNum++;
                        blockStart += 5;
                        $(".reviewPage").remove();
                        var htmlCode = '';
                        htmlCode += '<a class="reviewPage" href="#" onclick="reviewPaging(-1)"> &lt; </a>';
                        for (var i = blockStart; i <= blockEnd; i++) {
                            if (i == blockStart) {
                                htmlCode += '<a class="selectedList" id="reviewList' + i + '" href="#" onclick="reviewPaging(' + i + ')">' + i + '</a> ';
                            } else {
                                htmlCode += '<a class="reviewPage" id="reviewList' + i + '" href="#" onclick="reviewPaging(' + i + ')">' + i + '</a> ';
                            }
                        }
                        htmlCode += '<a class="reviewPage" href="#" onclick="reviewPaging(-2)"> &gt; </a>';
                        $("#reviewPages").append(htmlCode);
                    }

                }
            } else {
                page = index;
            }


            before = $("#reviewList" + page);
            before.attr('class', 'selectedList');





            $.ajax({
                type: "POST", // HTTP method type(GET, POST) 형식이다.
                /* dataType: "json", */
                url: "/reviewReturn.php", // 컨트롤러에서 대기중인 URL 주소이다.
                data: {
                    number: $('#number').val(),
                    page: page
                },
                success: function(data) {
                    /* alert("arr[0]['writer']"); */
                    $(".aaa").remove();
                    $(".writeComment").remove();

                    var arr = JSON.parse(data);
                    var htmlCode = '';
                    for (var i = 0; i < arr.result.length; i++) {

                        var visible;
                        if ($('#nickName').val() == arr.result[i]['writer']) {

                            visible = '"visibility: visible; text-align: right;">';
                        } else {

                            visible = '"visibility: hidden;text-align: right;">';
                        }

                        htmlCode += '<tr class="aaa">'
                        htmlCode += '<td class="review">ㄴ' + arr.result[i]['writer'] + '(' + arr.result[i]['writeAt'] + ')' + '</td>';
                        htmlCode += '<td class="review" style=' + visible + '<a href="#" onclick="editComment(\'' + arr.result[i]['contents'] + '\',\'' + i + '\',\'' + arr.result[i]['number'] + '\',\'' + arr.result[i]['id'] + '\');">';
                        htmlCode += '수정</a> | <a href="/reviewDelete.php?id=' + arr.result[i]['id'] + '&number=' + arr.result[i]['number'] + '">삭제</a></td>'
                        htmlCode += '</tr>';
                        htmlCode += '<tr class="aaa" id=' + i + '>' + '<td class="review">' + arr.result[i]['contents']; + '</td>';
                        htmlCode += '</tr>';


                    }
                    htmlCode += '<tr class="writeComment" style="text-align: right; "><td colspan="2"><form enctype="multipart/form-data" action="review_ok.php" method="post"><input type="hidden" value="';
                    htmlCode += $('#number').val() + '" name="number" id="number"><textarea name="content" id="content" placeholder="댓글을 작성해 주세요" style="width: 100%; height: 100px;" required></textarea>';
                    htmlCode += '<button type="submit">댓글 등록</button></form></td></tr>';
                    $("#abc").append(htmlCode);
                    return;

                },
                error: function(jqXHR, textStatus, errorThrown) {

                }
            });

        }


        function likeText()
        {

        }

        function setCookie(name, value, expiredays) {
            var date = new Date();
            date.setDate(date.getDate() + expiredays);
            document.cookie = escape(name) + "=" + escape(value) + "; expires=" + date.toUTCString();
        }

        function saveRecent() {

            var number = <?php echo $number ?>;
            setCookie("recent", number, 5);
        }

        function clickLike() {
            if (like == "off") {

                $.ajax({
                    type: "POST", // HTTP method type(GET, POST) 형식이다.
                    url: "/like.php", // 컨트롤러에서 대기중인 URL 주소이다.
                    data: {
                        number: $('#number').val(),
                    },
                    success: function(data) { // 비동기통신의 성공일경우 success콜백으로 들어옵니다. 'res'는 응답받은 데이터이다.
                        //$(".likeCount").text(" 좋아요 " + res);
                        var arr = JSON.parse(data);
                        var htmlCode = '';
                        $(".likeCount").text(" 좋아요 " + arr.result.length);
                        for (var i = 0; i < arr.result.length; i++) {
                            htmlCode+=' '+arr.result[i]['nickName']+' ';
                        }
                        $('#likeList').empty();
                        $('#likeList').append(htmlCode);
                       /*  $('#likeList').innerHTML(htmlCode); */
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) { // 비동기 통신이 실패할경우 error 콜백으로 들어옵니다.
                        alert("통신 실패.")
                    }
                });
                $(".like").attr("src", "images/heart.png");
                like = "on";
            } else {
                $.ajax({
                    type: "POST", // HTTP method type(GET, POST) 형식이다.
                    url: "/like.php", // 컨트롤러에서 대기중인 URL 주소이다.
                    data: {
                        number: $('#number').val(),
                        dislike: 'true'
                    },
                    success: function(data) { // 비동기통신의 성공일경우 success콜백으로 들어옵니다. 'res'는 응답받은 데이터이다.
                        var arr = JSON.parse(data);
                        var htmlCode = '';
                        $(".likeCount").text(" 좋아요 " + arr.result.length);
                        for (var i = 0; i < arr.result.length; i++) {
                            htmlCode+=' '+arr.result[i]['nickName']+' ';
                        }
                        $('#likeList').empty();
                        $('#likeList').append(htmlCode);
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) { // 비동기 통신이 실패할경우 error 콜백으로 들어옵니다.
                        alert("통신 실패.")
                    }
                });
                $(".like").attr("src", "images/emptyHeart.png");
                like = "off";
            }

        }
    </script>

    <body onload="javascript:saveRecent()">
    </body>
</body>


</html>