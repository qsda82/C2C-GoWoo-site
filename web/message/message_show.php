<?php
require_once("data/pass.php");//只讀取一次伺服器帳號密碼，為了不讓有心人士使用
$s=mysqli_connect("$serv","$user","$pass") or die("連線失敗");//使用函數連線
mysqli_select_db($s,"$dbnm");//選擇資料庫

$re=mysqli_query($s,"SELECT * FROM tbk ORDER BY id")or die(mysqli_error($s));//選擇資料庫並排序
//印出資料庫所有內容
if(mysqli_fetch_array($re))
{
	$x=mysqli_query($s,"SELECT * FROM tbk ORDER BY id")or die(mysqli_error($s));//選擇資料庫並排序
	while($show=mysqli_fetch_array($x))
    {
	  echo "$show[0] : ";
	  echo "$show[1] : ";
	  echo "$show[2]  <br>";
    }
   
   mysqli_close($s);//取消連線
   echo "<br><a href='/web/message/message_index.html'>回到最上層選單</a>";//選單連結
}
else
{
    echo"資料庫內無資料";
    mysqli_close($s);//取消連線
    echo "<br><a href='/web/message/message_index.html'>回到最上層選單</a>";//選單連結
}
?>