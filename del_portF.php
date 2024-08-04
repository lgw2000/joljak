<?php
session_start();
if(!isset($_SESSION['username'])) { //세션에 username이 세팅되어 있지 않다면 실행
    echo "<script>location.replace('login.php');</script>";            //로그인 화면으로 이동
}

else {
    $username = $_SESSION['username'];

} 
?>


<?php

$host = '127.0.0.1';
$user = 'root';
$pw = 'Gunwoo((@))73150';
$mysqli_name = 'joljak';

$mysqli = new mysqli($host, $user, $pw, $mysqli_name,"6866"); //db 연결


?>





<meta charset="utf-8">
  <title>delete portfolio</title>
</head>
<body>
  <form method="post" action="check_del_pf.php">
    <h2>delete portfolio</h2>
    <div class="idForm">
      <input type="portname" name="portname" class="pn" placeholder="portname">
    </div>
    <button type="submit" class="btn" onclick="button()">
        delete portfolio
    </button>
  </form>

  <button type="button" class="btn" onclick="location.href='portF.php'">
            back to portfolio
     </button>

</body>
</html>