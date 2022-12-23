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
        echo'<div id="change">';
		echo'<h3 align="center">修改密碼</h3>';
        echo "<form name=\"form\" method=\"post\" action=\"update_finish.php\">";
        echo "  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp密碼： <br>  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp<input type=\"password\" name=\"pw\"  /> <br>";
        echo "  &nbsp &nbsp &nbsp&nbsp &nbsp &nbsp再一次輸入密碼：<br> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp<input type=\"password\" name=\"pw2\"  /> <br>";
        echo " &nbsp &nbsp &nbsp  &nbsp &nbsp  &nbsp email：<br> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp<input type=\"text\" name=\"email\" /> <br>";
        echo "<div id='confirm'><input type=\"submit\" name=\"button\" value=\"確定\" /></div>";
        echo "</form>";
		echo'</div>';
}
else
{
        echo '您無權限觀看此頁面!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
}
 mysqli_close($s);//取消連線
?>
<div id="return">
  <input type=button onClick=" location.href='member.php' " value="返回">
</div>
<style type="text/css">
#change{width:250;height:250;position:absolute;top:100;left:350;border-style:solid;}
#confirm{position:absolute;top:200;left:60;}
#return{position:absolute;top:302;left:500;}
</style>