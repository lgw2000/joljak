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


$host = '127.0.0.1';
$user = 'root';
$pw = 'Gunwoo((@))73150';
$mysqli_name = 'joljak';

$mysqli = new mysqli($host, $user, $pw, $mysqli_name,"6866"); //db 연결





// 주식을 삭제하는 함수
function delete_stock($portname, $ticker, $id) {
  global $mysqli;
  $sql = "DELETE FROM port WHERE portname = '$portname' AND ticker = '$ticker' AND id = '$id'";
  mysqli_query($mysqli, $sql);
}




if (isset($_POST['submit'])) {
  // 입력 값 검증하기
  if (empty($_POST['portname']) || empty($_POST['ticker'])) {
    echo "모든 필드를 입력해주세요.";
  } else {
    // 입력 값 변수에 저장하기
    $id = $username;
    $portname = $_POST['portname'];
    $ticker = $_POST['ticker'];
    if(!is_numeric($ticker)){
      echo "입력된 티커는 숫자여야합니다";
    }
    else{
      // 함수 호출하기
      delete_stock($portname, $ticker, $id);

    // 결과 출력하기
    echo "주식이 성공적으로 삭제되거나 업데이트되었습니다.";
    }

    
  }
}



?>


<!-- HTML 폼 생성 -->
<form action="" method="post">
  <p>포트폴리오 이름: <input type="text" name="portname"></p>
  <p>주식 티커: <input type="text" name="ticker"></p>
  <p><input type="submit" name="submit" value="삭제하기"></p>
</form>


<button type="button" class="btn" onclick="location.href='portF.php'">
            back to portfolio
     </button>


