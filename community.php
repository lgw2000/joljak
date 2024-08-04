<?php
session_start();
if(!isset($_SESSION['username'])) { //세션에 username이 세팅되어 있지 않다면 실행
    echo "<script>location.replace('login.php');</script>";            //로그인 화면으로 이동
}

else {
    $username = $_SESSION['username'];

} 
?>



<button type="button" class="btn" onclick="location.href='write_commu.php'">
            write
     </button>
     <button type="button" class="btn" onclick="location.href='index.php'">
            go home
     </button>



<form method="post" action="">
    <select name="board">
            <option value="free">자유게시판</option>
            <option value="info">정보</option>
            <option value="all">전체보기</option>
          </select>
    <button type="submit" class="btn" onclick="button()">
        change board
    </button>
  </form>



<?php
// db 연결
$host = '127.0.0.1';
$user = 'root';
$pw = 'Gunwoo((@))73150';
$db_name = 'joljak';

$mysqli = new mysqli($host, $user, $pw, $db_name,"6866"); //db 연결

function echo_all_post($board_name){
    global $mysqli;
    $sql = "SELECT * FROM commu WHERE board = '$board_name'";
    if($board_name=="all")
    {
        $sql = "SELECT * FROM commu";
    }
    $posts = $mysqli->query($sql);

    echo "글번호         말머리         제목         아이디";
    echo "</br>";

        if($board_name=="all"){
            $all_sql = "SELECT * FROM commu";
        }
        elseif($board_name=="free"){
            $all_sql = "SELECT * FROM commu WHERE board = 'free'";
        }
        else {
            $all_sql = "SELECT * FROM commu WHERE board = 'info'";
        }
        
        $alls = $mysqli->query($all_sql);
        while($rows = mysqli_fetch_array($alls)){
            echo $rows["post_num"];
            echo "      ";
            echo $rows["board"];
            echo "      ";
            echo '<a href=/saw_detail.php?postnum='.$rows["post_num"].'>';
            echo $rows["title"];
            echo "</a>";
            echo "      ";
            echo $rows["id"];
            echo "</br>";
        }
    
    

    
    

}



$dashboard_query = "SELECT * FROM commu";
$check_result = $mysqli->query($dashboard_query);
if ($check_result->num_rows <= 0) {
    echo "There is no post";
    echo "</br>";
    echo "</br>";

}
else{
    if(isset($_POST['board'])){
        echo_all_post($_POST["board"]);
    }
    else{
        echo_all_post("all");
    }

}


?>



