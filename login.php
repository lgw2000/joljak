<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="utf-8">
  <title>LOGIN</title>
</head>
<body>
  <form method="post" action="check_login.php" class="loginForm">
    <h2>Login</h2>
    <div class="idForm">
      <input type="text" name="id" class="id" placeholder="Username">
    </div>
    <div class="passForm">
      <input type="password" name="pw" class="pw" placeholder="Password">
    </div>
    <button type="submit" class="btn" onclick="button()">
      LOGIN
    </button>
    <div class="bottomText">
      <a href="sign_in.php">Sign up</a>
      <a href="find_id_pw.php">Find ID Password</a>
    </div>
  </form>
</body>

made by ace9907@kku.ac.kr </br>
대충 아무렇게나 회원가입 하셔도 됩니다. </br>
(해싱안해서 정보가 올라가는거라서 개인정보는 입력해서 올리지 마시기 바랍니다.) </br>


</html>