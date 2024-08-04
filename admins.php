<?php
session_start();
if(!isset($_SESSION['admin_username'])) { //세션에 username이 세팅되어 있지 않다면 실행
    echo "<script>location.replace('login.php');</script>";            //로그인 화면으로 이동
}

else {
    $username = $_SESSION['admin_username'];

} 
?>


<form method="post" action="">
  <input type="submit" name="db_init" value="db_init">
</form>

<form method="post"><input type="submit" name="day_pred" id="day_pred" value="day_pred" /></form>
<form method="post"><input type="submit" name="day_back" id="day_back" value="day_back" /></form>
<form method="post"><input type="submit" name="week_pred" id="week_pred" value="week_pred" /></form>
<form method="post"><input type="submit" name="week_back" id="week_back" value="Rweek_back" /></form>
<form method="post"><input type="submit" name="month_pred" id="month_pred" value="month_pred" /></form>
<form method="post"><input type="submit" name="month_back" id="month_back" value="month_back" /></form>

<?php
    set_time_limit(300);

    function db_init()
    {

        echo "hello world!</br>";
        $python_path  = "C:/Users/Administrator/AppData/Local/Programs/Python/Python310/python.exe";
        $script_path = "C:/xampp/htdocs/term_proj/stock_weight/stock_db_init.py";

        exec("$python_path $script_path",$output);
        while($row = $output){
            echo "$rows";
        }
        echo "done world!";
         

    }


?>

<?php
// button.php
if (isset($_POST['run'])) { // run이라는 이름의 버튼이 눌렸을 때
  $python_path = "C:/Users/Administrator/AppData/Local/Programs/Python/Python310/python.exe"; // 파이썬 경로
  $script_path = "C:/xampp/htdocs/term_proj/hello.py"; // 파이썬 파일 경로
  exec("$python_path $script_path"); // 파이썬 파일을 실행하고 결과를 $output 배열에 저장

}
?>



<?php   
    if(array_key_exists('db_init',$_POST)){
        db_init();
     }

?>