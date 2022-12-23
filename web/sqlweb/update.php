<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
require_once("data/pass.php");//只讀取一次伺服器帳號密碼，為了不讓有心人士使用
$s=mysqli_connect("$serv","$user","$pass") or die("連線失敗");//使用函數連線
mysqli_select_db($s,"$dbnm");//選擇資料庫

if($_SESSION['username'] != null)
{
        //將$_SESSION['username']丟給$id
        //這樣在下SQL語法時才可以給搜尋的值
        $id = $_SESSION['username'];
        //若以下$id直接用$_SESSION['username']將無法使用
        /*$sql = "SELECT * FROM member_table where id='$id'";
        $result = mysqli_query($s,$sql);
        $row = @mysqli_fetch_row($result);*/
    
        echo "<form name=\"form\" method=\"post\" action=\"update_finish.php\">";
        echo "密碼：<input type=\"password\" name=\"pw\"  /> <br>";
        echo "再一次輸入密碼：<input type=\"password\" name=\"pw2\"  /> <br>";
        echo "email：<input type=\"text\" name=\"email\" /> <br>";
        echo "<input type=\"submit\" name=\"button\" value=\"確定\" />";
        echo "</form>";
}
else
{
        echo '您無權限觀看此頁面!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
}
 mysqli_close($s);//取消連線
?>