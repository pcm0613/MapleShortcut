<div class="board_list_wrap">
    <table class="board_list">
        <caption>&lt; 직업 게시판 &gt;</caption>
        <thead>
            <tr>
                <th>번호</th>
                <th>제목</th>
                <th>글쓴이</th>
                <th>작성일</th>
                <th>조회</th>
                <th>추천수</th>
            </tr>
        </thead>
        <?php while ($data = $result->fetch_array()) : ?>
            <tr>
                <td><?php echo $data['number'] ?></td>
                <td class="tit"><a href="/read.php?number=<?php echo $data["number"]; ?>"><?php echo $data['title'] ?></td>
                <td><?php echo $data['writer'] ?></td>
                <td><?php echo $data['date'] ?></td>
                <td><?php echo $data['views'] ?></td>
                <td><?php echo $data['recommentations'] ?></td>
            </tr>

        <?php endwhile ?>

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



</head>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1">

<body>

</body>

</html>