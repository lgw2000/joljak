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
$db_name = 'joljak';

$mysqli = new mysqli($host, $user, $pw, $db_name,"6866"); //db 연결

function search_stock_price($ticker){
    global $mysqli;
    $sql = "SELECT * FROM stock WHERE stock_ticker = '$ticker'";
    $result = mysqli_query($mysqli, $sql);
    $wow = mysqli_fetch_array($result);
    $res = $wow["stock_price"];
    return $res;

}


$dashboard_query = "SELECT * FROM port WHERE id = '$username'"; //사용자의 포트폴리오 내역을 가져오는 쿼리
$check_result = $mysqli->query($dashboard_query);
if ($check_result->num_rows <= 0) {
    echo "There is no portfolio on your id";

}
else{
    $port_names =  array();
    while($row = mysqli_fetch_array($check_result)){
        array_push($port_names, $row["portname"]);

    }
    $port_names = array_unique($port_names);

    
    foreach($port_names as $ptn){
        echo 'portfolio : '.$ptn;
        echo "</br>";
        //포트폴리오 이름, 사용자이름 받고 검색 주식 갯수만큼 반복하여 주식 표시
        $stock_name_sql = "SELECT * FROM port WHERE id = '$username' AND portname = '$ptn'";
        $check_stock = $mysqli->query($stock_name_sql);
        while($rows = mysqli_fetch_array($check_stock)){
                    if(isset($rows["ticker"])){
                    echo 'stock ticker : '.$rows["ticker"];
                    echo "</br>";
                    $now_price = search_stock_price($rows["ticker"]);
                    echo "now_price : ".$now_price;
                    echo "</br>";
                    echo "your buy price : ".$rows["buy_price"];
                    echo "</br>";
                    echo "stock number : ".$rows["stock_num"];
                    echo "</br>";
                    echo "revenue : ".($now_price - $rows["buy_price"]) * $rows["stock_num"];
                    echo "</br>";
                    echo "</br>";
                    }
                else{
                    echo "there is no stocks in this portfolio";
                }
        }
        echo "</br>"; 
        echo "</br>";
    }
}



?>



<body>
    <div class="base">
        <button type="button" class="btn" onclick="location.href='make_portF.php'">
            make portfolio
        </button>
        <button type="button" class="btn" onclick="location.href='del_portF.php'">
            delete portfolio
        </button>
        <button type="button" class="btn" onclick="location.href='add_stock_in_PF.php'">
            add stock into portfolio
        </button>
        <button type="button" class="btn" onclick="location.href='del_stock_in_PF.php'">
            delete stock into portfolio
        </button>
        <button type="button" class="btn" onclick="location.href='index.php'">
            back to home
        </button>
    </div>
</body>


