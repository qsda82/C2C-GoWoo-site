<?php

require_once("data/pass.php");//只讀取一次伺服器帳號密碼，為了不讓有心人士使用
$s=mysqli_connect("$serv","$user","$pass") or die("連線失敗");//使用函數連線
mysqli_select_db($s,"$dbnm");//選擇資料庫

/******取得使用者IP*******/
$ip=getenv("REMOTE_ADDR") ;

/****接收主題欄輸入的主題名*****/
$sub=htmlspecialchars($_GET['sub']);

/**計算資料庫中有幾個資料，再進行自動編碼**/
$re3=mysqli_query($s,"SELECT COUNT(id) FROM subtb")or die(mysqli_error($s));
$show3=mysqli_fetch_array($re3);//輸出的陣列給show3
$id=$show3[0]+1;

/**若sub輸入欄不為空值時，將資料輸入置資料庫**/
if($sub<>"")
{
	mysqli_query($s,"INSERT INTO subtb (id,subname,date,ip) VALUES('$id','$sub',now(),'$ip')");
}

/**於0秒時重整網頁，並將網頁導向至首頁**/
header("Refresh:0; url=index.php");

/*****切斷資料庫*****/
mysqli_close($s);

?>