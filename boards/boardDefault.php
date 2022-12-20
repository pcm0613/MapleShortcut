<?php
$category = $_GET['category'];
$search = $_GET['search'];
if (isset($_GET["page"])) {
    $page = $_GET["page"]; //1,2,3,4,5
} else {
    $page = 1;
}
if ($category == "") {
    $sql1 = mysqli_query($conn, "SELECT * FROM post where category=$boardCategory");
} else {
    $sql1 = mysqli_query($conn, "SELECT * FROM post where $category like '%{$search}%' and category = $boardCategory");
}
$total_record = mysqli_num_rows($sql1);
$list = 10;
$block_ct = 10;
$block_num = ceil($page / $block_ct); // 현재 페이지 블록 구하기
$block_start = (($block_num - 1) * $block_ct) + 1; // 블록의 시작번호
$block_end = $block_start + $block_ct - 1; //블록 마지막 번호

$total_page = ceil($total_record / $list); // 페이징한 페이지 수 구하기
if ($block_end > $total_page) $block_end = $total_page; //만약 블록의 마지박 번호가 페이지수보다 많다면 마지박번호는 페이지 수
$total_block = ceil($total_page / $block_ct); //블럭 총 개수
$start_num = ($page - 1) * $list;







if ($category == "") {

    $sql = "SELECT * FROM post where category = $boardCategory ORDER BY number DESC limit $start_num, $list;";
} else {
    $isSearching = "&category=$category&search=$search";
    $sql = "SELECT * FROM post where $category like '%{$search}%' and category = $boardCategory ORDER BY number DESC limit $start_num, $list;";
}
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $boardtitle ?></title>
</head>

</body>

</html>

<div class="board_list_wrap">
    <table class="board_list">
        <caption>&lt; <?php echo $boardtitle ?> &gt;</caption>
        <thead>
            <tr>
                <th>번호</th>
                <th>제목</th>
                <th>글쓴이</th>
                <th>작성일</th>
                <th>조회</th>
                <th>좋아요</th>
            </tr>
        </thead>
        <?php while ($data = $result->fetch_array()) : ?>
            <tr>
                <td><?php echo $data['number'] ?></td>
                <td class="tit"><a href="/read.php?number=<?php echo $data["number"]; ?>"><?php echo $data['title'] ?></td>
                <td><?php echo $data['writer'] ?></td>
                <td><?php echo $data['date'] ?></td>
                <td><?php echo $data['views'] ?></td>
                <td><?php echo $data['love'] ?></td>
            </tr>

        <?php endwhile ?>

    </table>
    <div class="paging">
    <?php
        $where = "/boards/" . $boardName . "?page=1";
        $where .= $isSearching;
        echo '<a href=' . $where . ' class="bt">첫 페이지</a>';
         if ($page > $block_ct) {
            $where = "/boards/" . $boardName . "?page=" . $block_start - $block_ct;
            $where .= $isSearching;
            echo '<a href=' . $where . ' class="bt">이전 페이지</a>';
        }

        for ($i = $block_start; $i <= $block_end; $i++) {
            $where = "/boards/" . $boardName . "?page=" . $i;
            $where .= $isSearching;
            if ($i == $page) {
                echo '<a href=' . $where . ' class="num on">' . $i . '</a>';
            } else {
                echo '<a href=' . $where . ' class="num">' . $i . '</a>';
            }
        }

        if ($block_num < $total_block) {
            $where = "/boards/" . $boardName . "?page=" . $block_start + $block_ct;
            $where .= $isSearching;
            echo '<a href=' . $where . ' class="bt">다음 페이지</a>';
        }

        $where = "/boards/" . $boardName . "?page=" . $total_page;
        $where .= $isSearching;
        echo '<a href=' . $where . ' class="bt">마지막 페이지</a>';
        ?>
        
    </div>
    <form action="/boards/<?php echo $boardName ?>?number=<?php echo $data["number"]; ?>" method="get">
        <select name="category">
            <option value="title">제목</option>
            <option value="writer">글쓴이</option>
            <option value="contents">내용</option>
        </select>
        <span>
            
        <input type="text" name="search" size="40" required="required" onclick='getCheckboxValue(event)'>
        </span>
        <button class="btn btn-primary">검색</button>
        
        <br>

    </form>
</div>



</main>

</body>



</head>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1">



</html>
