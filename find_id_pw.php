<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="utf-8">
  <title>LOGIN</title>
</head>
<body>
  <form method="post" action="check_find_id_pw.php" class="loginForm">
    <h2>Find ID Password</h2>
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
    Find ID Password
    </button>
  </form>
</body>
</html>