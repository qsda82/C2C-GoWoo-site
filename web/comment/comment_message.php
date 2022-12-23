<?php 
  require_once("data/pass.php");//只讀取一次伺服器帳號密碼，為了不讓有心人士使用
  $s=mysqli_connect("$serv","$user","$pass") or die("連線失敗");//使用函數連線
  mysqli_select_db($s,"$dbnm");//選擇資料庫
  
  
  