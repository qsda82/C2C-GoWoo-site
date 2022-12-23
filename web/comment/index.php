<?php
#連結到首頁時，畫面會顯示全部主題
#畫面下方的文字方塊中可以輸入新的主題
#輸入之後點選按鈕可以呼叫檔案本身，並製作新的主題
  require_once("data/pass.php");//只讀取一次伺服器帳號密碼，為了不讓有心人士使用
  $s=mysqli_connect("$serv","$user","$pass") or die("連線失敗");//使用函數連線
  mysqli_select_db($s,"$dbnm");//選擇資料庫
  $re=mysqli_query($s,"SELECT * FROM subtb");
 
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>留言板首頁</title>
</head>
 <body bgcolor="lightsteelblue">
  <font size="7" color="indigo">這裡是留言板喔</font><br><br>
  請點按你想看的主題
  <hr>
  <font size="5">(主題一欄)</font><br>
  <?php
  
  while($x=mysqli_fetch_array($re))
   {
    echo "<a href='comment_message.php?id= $x[0] '>" ."編號:".$x[0] ."   主題名稱:". $x[1] ."</a>";
    echo "<br>";
   }
   mysqli_close($s);
  ?>
  <hr> 
  <font size="5">(發表主題)</font>
  <br>
  要發表新主題請來這裡
  <br>
  
  <form method="GET" action="comment_entersub.php">
   新主題的標題
   <input type="text" name="sub" size="50">
   <br>
   <input type="submit" value="發表">
</form>
<hr>

<font size="5">(訊息搜尋)</font>


<a href="comment_search.php">點這裡進行搜尋</a>
<hr>
</body>
</html>