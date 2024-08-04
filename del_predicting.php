<?php
session_start();
if(!isset($_SESSION['username'])) { //세션에 username이 세팅되어 있지 않다면 실행
    echo "<script>location.replace('login.php');</script>";            //로그인 화면으로 이동
}
else {
  $username = $_SESSION['username'];

} 

?>

<head>
  <meta charset="utf-8">
  <title>delete</title>
</head>
<body>
  <form method="post" action="check_del_pred.php">
    <h2>delete</h2>
    <div class="idForm">
      <input type="pred_ticker" name="pred_ticker" class="pt" placeholder="pred_ticker">
    </div>
    <button type="submit" class="btn" onclick="button()">
      delete it!
    </button>
    
  </form>
  <button type="button" class="btn" onclick="location.href='pred.php'">
            go dashboard
     </button>
</body>
</html>