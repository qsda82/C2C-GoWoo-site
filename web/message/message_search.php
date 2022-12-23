<?php
require_once("data/pass.php");//只讀取一次伺服器帳號密碼，為了不讓有心人士使用
$s=mysqli_connect("$serv","$user","$pass") or die("連線失敗");//使用函數連線
mysqli_select_db($s,"$dbnm");//選擇資料庫
$search=htmlspecialchars($_POST["search"]);
if($search==null )
{
	echo"表單請勿留白，請重新輸入";
	mysqli_close($s);
    echo "<br><a href='/web/message/message_index.html'>回到最上層選單</a>";//選單連結
}
else
{
 $re=mysqli_query($s,"SELECT *FROM tbk WHERE message LIKE '%$search%'")or die(mysqli_error($s));
//印出資料庫所有內容
 if(mysqli_fetch_array($re))
 {
   $x=mysqli_query($s,"SELECT *FROM tbk WHERE message LIKE '%$search%'")or die(mysqli_error($s));
   echo"查詢結果如下:<br>";
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
    echo"查無此相關內容";
    mysqli_close($s);//取消連線
    echo "<br><a href='/web/message/message_index.html'>回到最上層選單</a>";//選單連結
  }
}
?>