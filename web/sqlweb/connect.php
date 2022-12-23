<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
require_once("data/pass.php");//只讀取一次伺服器帳號密碼，為了不讓有心人士使用
$s=mysqli_connect("$serv","$user","$pass") or die("連線失敗");//使用函數連線
mysqli_select_db($s,"$dbnm");//選擇資料庫
$id=htmlspecialchars($_POST['id']);
$pw=htmlspecialchars($_POST['pw']);

/**搜尋資料庫資料**/
$sql = "SELECT * FROM member_table where id = '$id'";
$result = mysqli_query($s,$sql);
$row = @mysqli_fetch_row($result);

//判斷帳號與密碼是否為空白
//以及MySQL資料庫裡是否有這個會員
if($id != null && $pw != null && $row[0] == $id && $row[1] == $pw)
{
        //將帳號寫入session，方便驗證使用者身份
        $_SESSION['username'] = $id;
		echo '<script language="javascript">';
        echo 'alert("登入成功!")';
		echo '</script>';
        echo '<meta http-equiv=REFRESH CONTENT=0;url=web_index.php>';
		
}
else if($row[0] != $id)
{       echo '<script language="javascript">';
        echo 'alert("無此會員!")';
		echo '</script>';
        echo '<meta http-equiv=REFRESH CONTENT=0;url=index.php>';
}
else if($id == null && $pw == null)
{
	    echo '<script language="javascript">';
        echo 'alert("輸入處請勿留白!")';
		echo '</script>';
        echo '<meta http-equiv=REFRESH CONTENT=0;url=index.php>';
}
else
{
	    echo '<script language="javascript">';
        echo 'alert("登入失敗!")';
		echo '</script>';
        echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';
}	
 mysqli_close($s);//取消連線
?>