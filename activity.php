<?php
include "/usr/local/apache2.4/htdocs/db.php";
$sql = mysqli_query($conn, "SELECT * FROM post where number=$boardCategory");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>내 활동</title>
</head>

<body>
  <input type="button" value="최근 본 글"><input type="button" value="내가 쓴 글"><input type="button" value="내가 쓴 댓글">
  <table class="innerTable">
    <caption>&lt; 최근 본 글 &gt;</caption>
    <thead>
      <tr>
        <th>제목</th>
        <th>글쓴이</th>
        <th>조회</th>
      </tr>
    </thead>
    <tr>

      <td>ㅁㅁㅁ</td>
      <td>ㅂㅂㅂ</td>

      <td>ㅋㅋㅋ</td>

    </tr>

  </table>



  <script>
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
      var cookieCheck = getCookie("recent");
      
      if (cookieCheck != "N") window.open(url, '', 'width=450,height=500,left=0,top=0')
    }
  </script>
</body>

</html>