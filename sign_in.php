<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="utf-8">
  <title>LOGIN</title>
</head>
<body>
  <form method="post" action="check_sign_in.php" class="loginForm">
    <h2>sign in</h2>
    <div class="idForm">
      <input type="text" name="id" class="id" placeholder="Username">
    </div>
    <div class="passForm">
      <input type="password" name="pw" class="pw" placeholder="Password">
    </div>
    <div class="emailForm">
      <input type="email" name="em" class="em" placeholder="email">
    </div>
    <div class="nicknameForm">
      <input type="nickname" name="nk" class="nk" placeholder="nickName">
    </div>
    <div class="passhintForm">
      <input type="passhint" name="ph" class="ph" placeholder="passHint">
    </div>

    <button type="submit" class="btn" onclick="button()">
      sign in
    </button>
  </form>
</body>
</html>