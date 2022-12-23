<?php
require_once("data/pass.php");//只讀取一次伺服器帳號密碼，為了不讓有心人士使用
$s=mysqli_connect("$serv","$user","$pass") or die("連線失敗");//使用函數連線
mysqli_select_db($s,"$dbnm");//選擇資料庫

//計算總共有多少筆資料
$re3=mysqli_query($s,"SELECT COUNT(id) FROM tbk ")or die(mysqli_error($s));
$show3=mysqli_fetch_array($re3);//輸出的陣列給show3
$id=$show3[0]+1;

/*接收使用者輸入的值*/
$name=htmlspecialchars($_POST["name"]);
$message=htmlspecialchars($_POST["message"]);

if($name==null or $message==null)
{
	echo"表單請勿留白，請重新輸入";
	 mysqli_close($s);
   echo "<br><a href='/web/message/message_index.html'>回到最上層選單</a>";//選單連結
}
else
{
 $x=mysqli_query($s,"SELECT id FROM tbk WHERE message='$message'");
 if (mysqli_fetch_array($x))
 {
    echo "請勿輸入重複的message";
    mysqli_close($s);
    echo "<br><a href='/web/message/message_index.html'>回到最上層選單</a>";//選單連結
 }

 else
 {
    mysqli_query($s,"INSERT INTO tbk(id,name,message) VALUES('$id','$name','$message')")or die(mysqli_error($s));
   //印出資料庫所有內容
   $re=mysqli_query($s,"SELECT * FROM tbk ORDER BY id");
   echo"新增完成!<br>";
   echo"新資料如下:<br>";
   while($show=mysqli_fetch_array($re))
   {
	  echo "$show[0] : ";
	  echo "$show[1] : ";
	  echo "$show[2]  <br>";
   }
   mysqli_close($s);//取消連線
   echo "<br><a href='/web/message/message_index.html'>回到最上層選單</a>";//選單連結
 }
}
?>