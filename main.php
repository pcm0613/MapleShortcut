<?php
include "/usr/local/apache2.4/htdocs/defalutLayout.php";
include "/usr/local/apache2.4/htdocs/db.php";


$sql = "SELECT * FROM post ORDER BY views DESC limit 15;";
$result = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>메이플 지름길</title>
</head>

<div style="height: 100%; float: left;margin-top: 250px">
  <img src="/images/hoyoung.png" style="width: 200px;height: 250px;margin-left: 50px">
</div>


<div class="main_wrap">
  <table class="main">

    <table class="innerTable">
      <caption>&lt; 화제 글 &gt;</caption>
      <thead>
        <tr>
          <th>제목</th>
          <th>글쓴이</th>

          <th>조회</th>
        </tr>
      </thead>
      <?php while ($data = $result->fetch_array()) : ?>
        <tr>

          <td class="tit"><a href="/read.php?number=<?php echo $data["number"]; ?>"><?php echo $data['title'] ?></td>
          <td><?php echo $data['writer'] ?></td>

          <td><?php echo $data['views'] ?></td>

        </tr>

      <?php endwhile ?>

    </table>

    <?php
    $sql = "SELECT * FROM post ORDER BY number DESC limit 15;";
    $result = mysqli_query($conn, $sql);

    ?>
    <table class="innerTable">
      <caption>&lt; 최신 글 &gt;</caption>
      <thead>
        <tr>
          <th class="titleth">제목</th>
          <th>글쓴이</th>
          <th>조회</th>
        </tr>
      </thead>
      <?php while ($data = $result->fetch_array()) : ?>
        <tr>

          <td class="tit"><a href="/read.php?number=<?php echo $data["number"]; ?>"><?php echo $data['title'] ?></td>
          <td><?php echo $data['writer'] ?></td>

          <td><?php echo $data['views'] ?></td>

        </tr>

      <?php endwhile ?>
    </table>

    <?php
    $sql = "SELECT * FROM post ORDER BY date DESC limit 15;";
    $result = mysqli_query($conn, $sql);

    ?>
    <table class="innerTable">
      <caption>&lt; 메이플 소식 &gt;</caption>
      <thead>
        <tr>
          <th class="titleth">제목</th>
          <th>글쓴이</th>
          <th>조회</th>
        </tr>
      </thead>
      <?php while ($data = $result->fetch_array()) : ?>
        <tr>
          <td class="tit"><a href="/read.php?number=<?php echo $data["number"]; ?>"><?php echo $data['title'] ?></td>
          <td><?php echo $data['writer'] ?></td>
          <td><?php echo $data['views'] ?></td>
        </tr>
      <?php endwhile ?>
    </table>


    <?php
    $sql = "SELECT * FROM gallery ORDER BY date DESC limit 3;";
    $result = mysqli_query($conn, $sql);

    ?>

    <!-- <div style="width:50%; height:500px; overflow:auto"> -->
    <table class="innerTable">
      <caption>&lt; 갤러리 &gt;</caption>



      <?php while ($data = $result->fetch_array()) : ?>


        <tr>
          <td class="img"><img src="<?php echo $data['image'] ?>" width="250px" height="150px"></td>
        </tr>
        <tr>
          <td><a href="/galleryRead.php?number=<?php echo $data["number"]; ?>"><?php echo $data['title'] ?></td>
        </tr>

      <?php endwhile ?>
      </tbody>
    </table>



  </table>
</div>
<script type="text/javascript">
  function getCookie(name) {
    var cookie = document.cookie;
    if (document.cookie != "") {
      var cookie_array = cookie.split("; ");
      for (var index in cookie_array) {
        var cookie_name = cookie_array[index].split("=");
        if (cookie_name[0] == "popupYN") {
          return cookie_name[1];
        }
      }
    }
    return;
  }

  function openPopup(url) {
    var cookieCheck = getCookie("popupYN");
    if (cookieCheck != "N") window.open(url, '', 'width=450,height=500,left=0,top=0')
  }
</script>
<body onload="javascript:openPopup('popup.html')">
</body>
<div style="height: 100%; float: left;margin-top: 250px">
  <img src="/images/ark.png" style="width: 200px;height: 250px;">
</div>

</html>