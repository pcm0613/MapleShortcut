<?php
include "/usr/local/apache2.4/htdocs/db.php";
session_start();
session_destroy();
?>
<script>
    alert("로그아웃이 완료되었습니다");
    location.href = "/";
</script>
<meta http-equiv='refresh' content='0;url=/'>