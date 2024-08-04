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
    <h2><?php echo "Hi, $username here is everyone's predict!";?></h2>
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
        $len_of_veiw_pred = 0;
        if(is_numeric($row["pred"])){
            if($row["pred_len"]== "day"){
                $len_of_veiw_pred = "day_pn";
            }
            elseif($row["pred_len"]== "week"){
                $len_of_veiw_pred = "week_pn";
            }
            else{
                $len_of_veiw_pred = "month_pn";
            }
        }
        else{
            if($row["pred_len"]== "day"){
                $len_of_veiw_pred = "day_cp";
            }
            elseif($row["pred_len"]== "week"){
                $len_of_veiw_pred = "week_cp";
            }
            else{
                $len_of_veiw_pred = "month_cp";
            }
        }
        $view_pred = $row["pred_ticker"];
        $qu = "SELECT * FROM stock WHERE stock_ticker = '$view_pred'";
        $view_row = $mysqli->query($qu);
        $view_rows = mysqli_fetch_array($view_row);

        if($view_rows[$len_of_veiw_pred]=="0"){
        echo 'predict ticker: '.$row["pred_ticker"];
        echo "<br />";
        echo 'predict price: predicting progress is not done yet';
        echo "<br />";
        echo 'predict length: '.$row["pred_len"];
        echo "<br />";
        echo "<br />";
        }
        else{
        echo 'predict ticker: '.$row["pred_ticker"];
        echo "<br />";
        echo 'predict price: '.$view_rows[$len_of_veiw_pred];
        echo "<br />";
        echo 'predict length: '.$row["pred_len"];
        echo "<br />";
        echo "<br />";
        }
    }
    
    
    
  }else{
    echo "예측한것이 하나도 없습니다.";
  }
  echo "</br>";
  echo "</br>";
  ?>
  
  
 <button type="button" class="btn" onclick="location.href='pred.php'">
        back to dashboard
 </button>
 <button type="button" class="btn" onclick="location.href='index.php'">
        back to home
 </button>
</div>
</body>