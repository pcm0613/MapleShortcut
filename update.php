<?php
include "/usr/local/apache2.4/htdocs/defalutLayout.php";
include "/usr/local/apache2.4/htdocs/db.php";

$number = $_GET['number'];

// 조회 수 증가
$sql = "SELECT * FROM post WHERE number=$number";
$result = mysqli_query($conn, $sql);
$data = $result->fetch_array(MYSQLI_ASSOC);

?>
<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <title>글수정</title>

    <!-- include libraries(jQuery, bootstrap) -->
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>

    <!-- include summernote css/js -->
    <link href="/summerNote/summernote-0.8.18-dist/summernote-lite.css" rel="stylesheet">
    <script src="/summerNote/summernote-0.8.18-dist/summernote-lite.js"></script>
    <script src="/summerNote/summernote-0.8.18-dist/lang/summernote-ko-KR.js"></script>

    <!-- summernote 실행 및 기본설정 [ Deep dive - Initialization options 참고 ] -->
    <script>
        $(document).ready(function() {
            var $summernote = $('#summernote').summernote({
                codeviewFilter: false,
                codeviewIframeFilter: true,
                lang: 'ko-KR',
                height: 600,
                callbacks: {
                    onImageUpload: function(files) {
                        for (var i = 0; i < files.length; i++) {
                            if (i > 10) {
                                alert('10개까지만 등록할 수 있습니다.');
                                return;
                            }
                        }
                        for (var i = 0; i < files.length; i++) {
                            if (i > 10) {
                                alert('10개까지만 등록할 수 있습니다.');
                                return;
                            }
                            sendFile($summernote, files[i]);
                        }
                    }
                }
            });
        });




        function sendFile($summernote, file) {
            var formData = new FormData();
            formData.append("file", file);
            $.ajax({
                url: '/saveImage.php',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                success: function(data) {
                    if (data == -1) {
                        alert('용량이 너무크거나 이미지 파일이 아닙니다.');
                        return;
                    } else {
                        $summernote.summernote('insertImage', data, function($image) {
                            $image.attr('src', data);
                            $image.attr('class', 'childImg');
                        });
                        var imgUrl = $("#imgUrl").val();
                        if (imgUrl) {
                            imgUrl = imgUrl + ",";
                        }
                        $("#imgUrl").val(imgUrl + data);
                    }
                }
            });
        }
    </script>
</head>

<body>
    <? $board_id = $_GET['board_id']; ?>
    <table class="read">
        <thead>
            <caption style="text-align: center;">&lt; 글쓰기 &gt;</caption>
        </thead>


        </thead>
        <tbody>
            <form enctype="multipart/form-data" action="update_ok.php" method="post">
                <tr>
                    <td>
                        <textarea name="title" id="title" rows="1" cols="55" placeholder="제목" maxlength="100" style="width: 900px; height: 35px;" required><?php echo $data['title'] ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <textarea name="content" id="summernote" placeholder="내용" required><?php echo $data['contents'] ?></textarea>
                    </td>
                </tr>
                <tr style="text-align: center;">
                    <td>
                        <input type="hidden" value="<?php echo $number ?>" name="number" id="number">
                        <input type="hidden" value="<?php echo $data['category'] ?>" name="category" id="category">
                        <button type="submit" style="text-align: center;">수정 완료</button>
                    </td>
                </tr>

            </form>
        </tbody>
    </table>
</body>

</html>