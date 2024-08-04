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
// db 연결
$host = '127.0.0.1';
$user = 'root';
$pw = 'Gunwoo((@))73150';
$db_name = 'joljak';

$mysqli = new mysqli($host, $user, $pw, $db_name,"6866"); //db 연결

$post_number = $_GET['postnum'];

$postnum = $post_number;
$sql = "SELECT * FROM commu WHERE post_num = '$postnum'";
$post = $mysqli->query($sql);
$rows = mysqli_fetch_array($post);
echo "<h1>제목:".$rows['title']."</h1>";
echo "<h4>작성자:".$rows['id']."</h4>";
echo "<h3>".$rows['detail']."</h3>";
echo '</br>';



if(isset($_POST["report"])){
    $rep_sel_sql = "SELECT * FROM report WHERE id = '$username' AND rep_post_id = '$post_number'";
    $reported_sql = $mysqli->query($rep_sel_sql);
    if($reported_sql->num_rows > 0){
        echo "이미 신고 되었습니다.";
    }
    else{
        $report_this_post = "INSERT INTO report (id, rep_post_id) VALUES ('$username', '$post_number')";
        mysqli_query($mysqli, $report_this_post);
        echo "신고 되었습니다.";
    }

}


if(isset($_POST["del"])){
    $del_sql = "DELETE FROM commu WHERE id = '$username' AND post_num = '$post_number'";
    mysqli_query($mysqli, $del_sql);
    echo "삭제 되었습니다.";
    echo "<script>setTimeout(function() {window.location.href = 'community.php';}, 1000);</script>";
}



if($rows['id']==$username){
    $available = "block";
}
else{
    $available = "none";
}


?>


<form action="" method="post">
<input type="submit" name="del" value="Delete This Post" style="display: <?php echo $available; ?>">
</form>


<form action="" method="post">
    <button type="submit" class="btn" name="report">
            report this post
        </button>
</form>


</br>
</br>


<button type="button" class="btn" onclick="location.href='community.php'">
        go back
    </button>