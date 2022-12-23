<?php session_start(); //啟動session?>
<?php
  require_once("data/pass.php");//只讀取一次伺服器帳號密碼，為了不讓有心人士使用
  $s=mysqli_connect("$serv","$user","$pass") or die("連線失敗");//使用函數連線
  mysqli_select_db($s,"$dbnm");//選擇資料庫
if ($_POST['car_submit'] == '刪除') 
{
	$re=mysqli_query($s,"SELECT COUNT(good_id) FROM good_table WHERE good_seller='".$_SESSION['username']."'")or die(mysqli_error($s));
	$row=mysqli_fetch_array($re);
	
	for($i=1;$i<=$row[0];$i++)
	{
     if(@$_POST['rocord'.$i])
	 {
	  $good_id=$_POST['rocord'.$i];
	  mysqli_query($s,"DELETE FROM good_table WHERE good_id='$good_id'")or die($s);
	  @mysqli_query($s,"DELETE FROM good_table_3c WHERE good_id='$good_id'")or die($s);
	  @mysqli_query($s,"DELETE FROM good_table_daily WHERE good_id='$good_id'")or die($s);
	  @mysqli_query($s,"DELETE FROM good_table_cloth WHERE good_id='$good_id'")or die($s);
	 }
	 
	} 
	/**重新編號**/
	 $count=1;
	 $x=mysqli_query($s," SELECT good_id FROM good_table ORDER BY good_id ")or die($s);
	 while($w=mysqli_fetch_array($x))
	 {
		 mysqli_query($s,"UPDATE good_table SET good_id = '$count' WHERE good_id='$w[0]'");
		 @mysqli_query($s,"UPDATE good_table_3c SET good_id = '$count' WHERE good_id='$w[0]'");
		 @mysqli_query($s,"UPDATE good_table_cloth SET good_id = '$count' WHERE good_id='$w[0]'");
		 @mysqli_query($s,"UPDATE good_table_daily SET good_id = '$count' WHERE good_id='$w[0]'");
		 $count++;
     }
	  
	 $count2=1;
	 $x2=@mysqli_query($s," SELECT good_table_id FROM good_table_3c ORDER BY good_table_id ")or die($s);
	 while($w2=@mysqli_fetch_array($x2))
	 {
		 @mysqli_query($s,"UPDATE good_table_3c SET good_table_id = '$count2' WHERE good_table_id='$w2[0]'");
		 $count2++;
     }
	 
	 $count3=1;
	 $x3=@mysqli_query($s," SELECT good_table_id FROM good_table_cloth ORDER BY good_table_id ")or die($s);
	 while($w3=@mysqli_fetch_array($x3))
	 {
		 @mysqli_query($s,"UPDATE good_table_cloth SET good_table_id = '$count3' WHERE good_table_id='$w3[0]'");
		 $count3++;
     }
    
	 $count4=1;
	 $x4=@mysqli_query($s," SELECT good_table_id FROM good_table_daily ORDER BY good_table_id ")or die($s);
	 while($w4=@mysqli_fetch_array($x4))
	 {
		 @mysqli_query($s,"UPDATE good_table_daily SET good_table_id = '$count4' WHERE good_table_id='$w4[0]'");
		 $count4++;
     }
	
	
}	

?>
<script>
alert("已刪除所選取商品");
</script>
<meta http-equiv=REFRESH CONTENT=0;url=web_index.php>