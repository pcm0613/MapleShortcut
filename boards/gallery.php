<?php
include "/usr/local/apache2.4/htdocs/db.php";
include "/usr/local/apache2.4/htdocs/defalutLayout.php";
$category = $_GET['category'];
$search = $_GET['search'];
if ($category == "") {
    $sql = "SELECT * FROM gallery ORDER BY number DESC;";
} else {
    $sql = "SELECT * FROM gallery where $category like '%{$search}%' ORDER BY number DESC;";
}

$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>갤러리</title>
</head>

<body>
  <input type="button" value="사진 올리기" onclick="location.href='/upload.php'">
  
<div class="board_list_wrap">
    <table class="board_list">
        <caption>&lt; 갤러리 &gt;</caption>
        <thead>
            <tr>
                <th>번호</th>
                <th>미리보기</th>
                <th>제목</th>
                <th>글쓴이</th>
                <th>작성일</th>
                <th>조회</th>
                
            </tr>
        </thead>
        <?php while ($data = $result->fetch_array()) : ?>
            <tr>
                <td><?php echo $data['number'] ?></td>
                <td><img src="<?php echo $data['image']?>" width ="50px" height="50px"></td>
                <td class="tit"><a href="/galleryRead.php?number=<?php echo $data["number"]; ?>"><?php echo $data['title'] ?></td>
                <td><?php echo $data['writer'] ?></td>
                <td><?php echo $data['date'] ?></td>
                <td><?php echo $data['views'] ?></td>
                
            </tr>

        <?php endwhile ?>
        <!-- <iframe width="1536" height="864" src="https://www.youtube.com/embed/eJi7YLHO1kk" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->

    </table>
    <!-- <div class="paging">
        <a href="#" class="bt">첫 페이지</a>
        <a href="#" class="bt">이전 페이지</a>
        <a href="#" class="num on">1</a>
        <a href="#" class="num">2</a>
        <a href="#" class="num">3</a>
        <a href="#" class="bt">다음 페이지</a>
        <a href="#" class="bt">마지막 페이지</a>
    </div> -->
    <form action="/boards/job_board.php?number=<?php echo $data["number"]; ?>" method="get">
        <select name="category">
            <option value="title">제목</option>
            <option value="writer">글쓴이</option>
            <option value="contents">내용</option>
        </select>
        <input type="text" name="search" size="40" required="required">
        <button class="btn btn-primary">검색</button>
    </form> 
</div>
</body>

</html>