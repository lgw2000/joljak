<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <title></title>
</head>
<body>
   <?php
   session_start();
   $host = '127.0.0.1';
   $user = 'root';
   $pw = 'Gunwoo((@))73150';
   $db_name = 'joljak';
   
      $mysqli = new mysqli($host, $user, $pw, $db_name,"6866"); //db 연결
      
      //find_id_pw.php에서 입력받은 email nickname pwhint
      $email = $_POST['em'];
      $nickname = $_POST['nk'];
      $pwHint = $_POST['ph'];
      
      $check_query = "SELECT * FROM user_info WHERE nickname = '$nickname' AND email = '$email' AND pass_hint = '$pwHint'";
      $check_result = $mysqli->query($check_query);
      if ($check_result->num_rows > 0) {
        $row = mysqli_fetch_row($check_result);
        echo "id pw 찾기 성공 5초후 로그인 화면으로 돌아갑니다";
        echo "<br />";
        echo 'ID: '.$row[0];
        echo "<br />";
        echo 'PW: '.$row[1];
        echo "<script>setTimeout(function() {window.location.href = 'login.php';}, 5000);</script>"; // 5초후 login page 로 돌아감
      }else{
    echo "찾으시려는 정보가 없습니다. 로그인 화면으로 돌아갑니다.";
      echo "<script>setTimeout(function() {window.location.href = 'login.php';}, 5000);</script>";
      }

      
      

      ?>
   </body>