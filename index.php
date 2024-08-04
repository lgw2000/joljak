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
        <h2><?php echo "Hi, $username";?></h2>
        <button type="button" class="btn" onclick="location.href='pred.php'">
            predict
        </button>
        <button type="button" class="btn" onclick="location.href='portF.php'">
            portfolio
        </button>
        <button type="button" class="btn" onclick="location.href='community.php'">
        community
        </button>
        <button type="button" class="btn" onclick="location.href='logout.php'">
            LOGOUT
        </button>
    </div>
</body>