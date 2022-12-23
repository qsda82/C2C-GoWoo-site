<?php
require_once("data/pass.php");//只讀取一次伺服器帳號密碼，為了不讓有心人士使用
$s=mysqli_connect("$serv","$user","$pass") or die("連線失敗");//使用函數連線
mysqli_select_db($s,"$dbnm");//選擇資料庫

//htmlspecialchars:若有人輸入php語言會使其無法輸入
$delete=htmlspecialchars($_POST["delete"]);

$x=mysqli_query($s,"SELECT id FROM tbk WHERE id='$delete'");
if (mysqli_fetch_array($x))
{  //以防有人輸入可以改變資料庫資料的數值
   //程式會在 string subject 中進行比對是否有符合 string pattern 條件的結果
   if(preg_match("/[^0-9]/",$delete))
   {
	 echo "請勿輸入數字以外的內容";
     mysqli_close($s);//取消連線
     echo "<br><a href='/web/message/message_index.html'>回到最上層選單</a>";//選單連結
   }
   else
   {
   //刪除指定的欄位
   mysqli_query($s,"DELETE FROM tbk WHERE id=$delete")or die(mysqli_error($s));
   echo"已刪除資料<br>";
   echo"剩餘資料如下:<br>";
   
   //計算總共有多少筆資料
   $re3=mysqli_query($s,"SELECT COUNT(id) FROM tbk ")or die(mysqli_error($s));
   $show3=mysqli_fetch_array($re3);
   $id=$show3[0]-$delete;

   //修改刪除後的順序
   for($i=1;$i<=$id+1;$i++)
   {   
    mysqli_query($s,"UPDATE tbk SET id=$delete WHERE id=$delete+1")or die(mysqli_error($s));
    $delete++;
   }
   $re=mysqli_query($s,"SELECT * FROM tbk ORDER BY id")or die(mysqli_error($s));//選擇資料庫並排序
   //印出資料庫所有內容
   
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
else
{
   echo "請輸入存在的編號";
   mysqli_close($s);
   echo "<br><a href='/web/message/message_index.html'>回到最上層選單</a>";//選單連結
}

?>
