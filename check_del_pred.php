<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <title></title>
</head>
<body>
   <?php
   session_start();
   if(!isset($_SESSION['username'])) { //세션에 username이 세팅되어 있지 않다면 실행
       echo "<script>location.replace('login.php');</script>";            //로그인 화면으로 이동
   }
   else {
     $username = $_SESSION['username'];
   
   } 
   date_default_timezone_set('Asia/Seoul');
   $host = '127.0.0.1';
   $user = 'root';
   $pw = 'Gunwoo((@))73150';
   $db_name = 'joljak';
   
      $mysqli = new mysqli($host, $user, $pw, $db_name,"6866"); //db 연결
      
      //predicting.php에서 입력받은 ticker
      $ticker = $_POST['pred_ticker'];

      $dashboard_query = "SELECT * FROM pred WHERE id = '$username' AND pred_ticker = '$ticker'";
      $check_result = $mysqli->query($dashboard_query);
      if ($check_result->num_rows <= 0){
         echo "없는 주식 예측을 삭제할수 없습니다";
         echo "<script>setTimeout(function() {window.location.href = 'del_predicting.php';}, 5000);</script>"; // 5초후 del_predicting page 로 돌아감
      }
      else{
         $check_preds = mysqli_fetch_array($check_result);
         $lens = $check_preds["pred_len"];
         if ($lens == "day") {
            // "day" 변수가 전송된 경우, 현재 시간을 가져와서 12시인지 확인합니다.
            $currentHour = date("H");
            if ($currentHour <= 12 || $currentHour >= 16) {
             echo '<script type="text/javascript">'; // 하루 예측 성공 메세지
             echo 'alert("현재는 예측삭제가 가능한 시간입니다. 즉 예측삭제가 적용되었습니다.");';
             echo "setTimeout(function() {window.location.href = 'del_predicting.php';}, 500);</script>";
             
             
                
            } else {
                echo '<script type="text/javascript">'; // 하루 예측 실패 메세지
                echo 'alert("현재는 예측삭제가 가능한 시간이 아닙니다.");';
                echo "setTimeout(function() {window.location.href = 'del_predicting.php';}, 500);</script>";
                exit;
            }
        } elseif ($lens == "week") {
            // "week" 변수가 전송된 경우, 현재 요일을 가져와서 수요일인지 확인합니다.
            $currentDayOfWeek = date("N"); // 1 (월요일)부터 7 (일요일)까지의 숫자
            if ($currentDayOfWeek <= 3 || $currentDayOfWeek >= 6) {
                echo '<script type="text/javascript">'; // 한주 예측 성공 메세지
                echo 'alert("현재는 수요일 이전 또는 금요일 이후 입니다. 즉 예측삭제가 적용되었습니다.");';
                echo "setTimeout(function() {window.location.href = 'del_predicting.php';}, 500);</script>";
                
                
            } else {
             echo '<script type="text/javascript">'; // 한주 예측 실패 메세지
             echo 'alert("현재는 예측삭제가 가능한 시간이 아닙니다.");';
             echo "setTimeout(function() {window.location.href = 'del_predicting.php';}, 500);</script>";
             exit;
            }
        } else {
            
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
    
            if ($currentDate < new DateTime()) {
             echo '<script type="text/javascript">';
             echo 'alert("현재는 예측삭제가 가능한 시간이 아닙니다.");';
             echo "setTimeout(function() {window.location.href = 'del_predicting.php';}, 500);</script>";
             exit;
                
            } else {
             echo '<script type="text/javascript">';
             echo 'alert("현재는 예측삭제가 가능한 3째주 금요일 이전입니다.");';
             echo "setTimeout(function() {window.location.href = 'del_predicting.php';}, 500);</script>";
             exit;
            }
        }
         
      
         $q = "DELETE FROM pred WHERE id = '$username' AND pred_ticker = '$ticker'";
         $result = $mysqli->query($q);
         echo "<script>setTimeout(function() {window.location.href = 'del_predicting.php';}, 1000);</script>"; // 1초후 del_predicting page 로 돌아감
         
      }

      


      
      

      ?>
   </body>