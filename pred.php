<?php
session_start();
if(!isset($_SESSION['username'])) { //세션에 username이 세팅되어 있지 않다면 실행
    echo "<script>location.replace('login.php');</script>";            //로그인 화면으로 이동
}

else {
    $username = $_SESSION['username'];

} 
?>


<body>
    <div class="base">
        <h2><?php echo "Hi, $username here is your predict dashboard!";?></h2>
</br>
    <?php 
    $host = '127.0.0.1';
    $user = 'root';
    $pw = 'Gunwoo((@))73150';
    $db_name = 'joljak';
    
    $mysqli = new mysqli($host, $user, $pw, $db_name,"6866"); //db 연결

    $dashboard_query = "SELECT * FROM pred WHERE id = '$username'"; //사용자가 예측한것들을 불러오는 쿼리
    $check_result = $mysqli->query($dashboard_query);
    if ($check_result->num_rows > 0) {
        
        while($row = mysqli_fetch_array($check_result)){
            echo 'predict ticker: '.$row["pred_ticker"];
            echo "<br />";
            echo 'predict price: '.$row["pred"];
            echo "<br />";
            echo 'predict length: '.$row["pred_len"];
            echo "<br />";
            echo "<br />";
        }
        
      }else{
        echo "예측한것이 하나도 없습니다.";
      }
      echo "</br>"
      ?>
      
      <button type="button" class="btn" onclick="location.href='predicting.php'">
            do predict
     </button>
     <button type="button" class="btn" onclick="location.href='del_predicting.php'">
            del predict
     </button>
     <button type="button" class="btn" onclick="location.href='view_pred.php'">
            view predict
     </button>
     <button type="button" class="btn" onclick="location.href='index.php'">
            go home
     </button>
    </div>
</body>


<?php

echo "<br/>";


date_default_timezone_set('Asia/Seoul');

$currentHour = date("H");
$currentDayOfWeek = date("N");
$currentDate = new DateTime();

// 현재 월의 첫 번째 날을 설정합니다.
$currentDate->modify('first day of this month');

// 현재 월의 첫 번째 날을 가져옵니다.
$firstDayOfMonth = $currentDate->format('Y-m-d');

// 현재 월의 첫 번째 날이 어느 요일인지 가져옵니다 (0: 일요일, 1: 월요일, ..., 6: 토요일).
$firstDayOfWeek = $currentDate->format('w');

// 현재 날짜를 "주" 단위로 늘려서 세 번째 주 금요일을 찾습니다.
$currentDate->modify('+2 weeks'); // 세 번째 주로 이동
$currentDate->modify('+5 days'); // 금요일로 이동

echo "현재 날짜 : ". date("Y-m-d")."<br/>";
echo "현재 시간 : ". date("H:i:s")."<br/>";
echo "현재 일시 : ". date("Y-m-d H:i:s")."<br/><br/>";


if ($currentHour <= 12 || $currentHour >= 16) {

    echo '오늘의 예측이 가능한 시간입니다';
    echo "</br>";

    
    
    
} else {
    echo '오늘의 예측이 가능한 시간이 아닙니다.';
    echo "</br>";
}



if ($currentDayOfWeek <= 3 || $currentDayOfWeek >= 6) {
    echo '주간 예측이 가능합니다';
    echo "</br>";
    
    
} else {
 echo '주간 예측이 불가능 합니다';
 echo "</br>";

}


if ($currentDate < new DateTime()) {
    echo '월간 예측이 가능한 시간이 아닙니다.';
    echo "</br>";
   }
else{
    echo '월간 예측이 가능한 시간입니다.';
    echo "</br>";
}



?>