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
      
      //sing_in.php에서 입력받은 id, password
      $username = $_POST['id'];
      $userpass = $_POST['pw'];
      $email = $_POST['em'];
      $nickname = $_POST['nk'];
      $pwHint = $_POST['ph'];
      
      $check_query = "SELECT * FROM user_info WHERE id = '$username'";
      $check_result = $mysqli->query($check_query);
      if ($check_result->num_rows > 0) {
        echo "이미 사용 중인 아이디입니다. 로그인 화면으로 돌아갑니다.";
        echo "<script>setTimeout(function() {window.location.href = 'login.php';}, 5000);</script>";
      }else{
      $q = "INSERT INTO user_info (`id`, `pw`, `nickname`, `email`, `pass_hint`) VALUES ('$username', '$userpass', '$nickname', '$email', '$pwHint')";
      $result = $mysqli->query($q);
      echo "회원가입 성공";
      echo "<script>setTimeout(function() {window.location.href = 'login.php';}, 5000);</script>";
      }

      
      

      ?>
   </body>