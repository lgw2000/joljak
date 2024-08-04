<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <title></title>
</head>
<body>
   <?php
   session_start();

   

      
      //login.php에서 입력받은 id, password
      $username = $_POST['id'];
      $userpass = $_POST['pw'];
            
      //결과가 존재하면 세션 생성
      if ($username == "ace9907" && $userpass == "ace9907") {
         $_SESSION['admin_username'] = $username;
         echo "<script>location.replace('admins.php');</script>";
         exit;
      }
      
      //결과가 존재하지 않으면 로그인 실패
      if($row == null){
         echo "<script>alert('Invalid username or password')</script>";
         echo "<script>location.replace('admin.php');</script>";
         exit;
      }
      ?>
   </body>