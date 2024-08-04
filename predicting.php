<?php
session_start();
if(!isset($_SESSION['username'])) { //세션에 username이 세팅되어 있지 않다면 실행
    echo "<script>location.replace('login.php');</script>";            //로그인 화면으로 이동
}
else {
  $username = $_SESSION['username'];

} 



    $host = '127.0.0.1';
    $user = 'root';
    $pw = 'Gunwoo((@))73150';
    $db_name = 'joljak';
    
    $mysqli = new mysqli($host, $user, $pw, $db_name,"6866"); //db 연결

    $dashboard_query = "SELECT * FROM pred WHERE id = '$username'";
    $check_result = $mysqli->query($dashboard_query);
    if ($check_result->num_rows > 4) {
        echo "5개 이상 예측할수 없습니다.";
    }
?>

<head>
  <meta charset="utf-8">
  <title>predicting</title>
</head>
<body>
  <form method="post" action="check_pred.php">
    <h2>predicting</h2>
    <div class="idForm">
      <input type="pred_ticker" name="pred_ticker" class="pt" placeholder="pred_ticker">
    </div>
    <select name="pred_len">
            <option value="day">day</option>
            <option value="week">week</option>
            <option value="month">month</option>
          </select>
    <div class="pred">
      <input type="pred" name="pred" class="pd" placeholder="pred">
    </div>
    <button type="submit" class="btn" onclick="button()">
      predict it!
    </button>
  </form>
  <button type="button" class="btn" onclick="location.href='pred.php'">
            go dashboard
     </button>
</body>
</html>