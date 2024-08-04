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
$db_name = 'joljak';

$mysqli = new mysqli($host, $user, $pw, $db_name,"6866"); //db 연결


function write_post($id,$post_num,$board,$title,$detail){
    global $mysqli;
    $sql = "INSERT INTO commu (id, post_num, board, title, detail) VALUES ('$id', '$post_num', '$board', '$title', '$detail')";
    mysqli_query($mysqli, $sql);

}

function max_of_post_num(){
    global $mysqli;
    $sql = 'SELECT MAX(post_num) AS max_post_num FROM commu';
    $result_of_max = mysqli_query($mysqli, $sql);
    $rows = mysqli_fetch_array($result_of_max);
    if(!isset($rows["max_post_num"])){
        return 1;
    }
    else{
        return $rows["max_post_num"];
    }
}


if (isset($_POST['submit'])) {
    // 입력 값 검증하기
    if (empty($_POST['board']) || empty($_POST['title']) || empty($_POST['detail'])) {
      echo "모든 필드를 입력해주세요.";
    } else {
      // 입력 값 변수에 저장하기
      $id = $username;
      $post_num = max_of_post_num();
      $post_num = $post_num + 1;
      $board = $_POST['board'];
      $title = $_POST['title'];
      $detail = $_POST['detail'];



      write_post($id,$post_num, $board, $title, $detail);

      }
  
      
    }
  


?>



<form method="post" action="">
    <p>제목: <input type="text" name="title"></p>
    <p>상세: <textarea rows="10" cols="30" name="detail"></textarea></p>
    <select name="board">
            <option value="free">자유게시판</option>
            <option value="info">정보</option>
          </select>
    
    <p><input type="submit" name="submit" value="글쓰기"></p>
  </form>



<button type="button" class="btn" onclick="location.href='community.php'">
        go back
    </button>