<?php
session_start();
if(!isset($_SESSION['username'])) { //세션에 username이 세팅되어 있지 않다면 실행
    echo "<script>location.replace('login.php');</script>";            //로그인 화면으로 이동
}

else {
    $username = $_SESSION['username'];

} 
?>




<?php
echo "this is your portfolio <b>$username</b> </br></br>";

$host = '127.0.0.1';
$user = 'root';
$pw = 'Gunwoo((@))73150';
$mysqli_name = 'joljak';

$mysqli = new mysqli($host, $user, $pw, $mysqli_name,"6866"); //db 연결


$portname = $_POST['portname'];

$check_query = "SELECT * FROM port WHERE id = '$username' AND portname = '$portname'";
$check_result = $mysqli->query($check_query);
if ($check_result->num_rows > 0) {
  echo "이미 사용 중인 포트폴리오 이름입니다. 포트폴리오 화면으로 넘어갑니다";
  echo "<script>setTimeout(function() {window.location.href = 'portF.php';}, 5000);</script>";
}else{
$q = "INSERT INTO port (`id`, `portname`) VALUES ('$username', '$portname')";
$result = $mysqli->query($q);
echo "입력 성공";
echo "<script>setTimeout(function() {window.location.href = 'portF.php';}, 5000);</script>";
}


?>