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



//주식을 포트폴리오에 추가하는 함수
function add_stock($id,$portname, $ticker, $buy_price, $stock_num) {
  global $mysqli;
  
  $sql = "SELECT * FROM port WHERE portname = '$portname' AND id = '$id' ";
  $result = mysqli_query($mysqli, $sql);
  $result_array = mysqli_fetch_array($result);
  if (!isset($result_array['ticker'])) { 
    $sql = "UPDATE port SET buy_price = '$buy_price', stock_num = '$stock_num', ticker = '$ticker' WHERE portname = '$portname' AND id = '$id'";
    mysqli_query($mysqli, $sql);

  } else { 
    $sql = "INSERT INTO port (id, portname, ticker, buy_price, stock_num) VALUES ('$id', '$portname', '$ticker', '$buy_price', '$stock_num')";
    mysqli_query($mysqli, $sql);
  }
}




if (isset($_POST['submit'])) {
  // 입력 값 검증하기
  if (empty($_POST['portname']) || empty($_POST['ticker']) || empty($_POST['buy_price']) || empty($_POST['stock_num'])) {
    echo "모든 필드를 입력해주세요.";
  } else {
    // 입력 값 변수에 저장하기
    $id = $username;
    $portname = $_POST['portname'];
    $ticker = $_POST['ticker'];
    $buy_price = $_POST['buy_price'];
    $stock_num = $_POST['stock_num'];
    if(!is_numeric($ticker) || !is_numeric($buy_price) || !is_numeric($stock_num)){
      echo "입력된 티커, 가격, 개수는 숫자여야합니다";
    }
    else{
      // 함수 호출하기
    add_stock($id,$portname, $ticker, $buy_price, $stock_num);

    // 결과 출력하기
    echo "주식이 성공적으로 추가되었거나 업데이트되었습니다.";
    }

    
  }
}



?>


<!-- HTML 폼 생성 -->
<form action="" method="post">
  <p>포트폴리오 이름: <input type="text" name="portname"></p>
  <p>주식 티커: <input type="text" name="ticker"></p>
  <p>매수 가격: <input type="number" name="buy_price"></p>
  <p>주식 수량: <input type="number" name="stock_num"></p>
  <p><input type="submit" name="submit" value="추가하기"></p>
</form>


<button type="button" class="btn" onclick="location.href='portF.php'">
            back to portfolio
     </button>


