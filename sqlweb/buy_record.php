
<?php session_start(); //啟動session?>
<?php

  /*****資料庫連結*****/
  require_once("data/pass.php");//只讀取一次伺服器帳號密碼，為了不讓有心人士使用
  $s=mysqli_connect("$serv","$user","$pass") or die("連線失敗");//使用函數連線
  mysqli_select_db($s,"$dbnm");//選擇資料庫
  
  /****創建會員的購物車跟購買紀錄表單****/
  $buy_table=$_SESSION['username']."_buy_table";
  $car_table=$_SESSION['username']."_car_table";
  
  $check=0;//確認使用者是否勾選商品
  $send_total=0;
  /*** 如果會員按下確認購買按鈕***/
  if ($_POST['car_submit'] == '確認購買') 
  {
	/***計算總商品數量並存成陣列***/
	$re=mysqli_query($s,"SELECT COUNT(good_id) FROM good_table ")or die(mysqli_error($s));
	$row=mysqli_fetch_array($re);
	//$arr=array($row[0]);
	/***將勾選的商品一個一個從購物車存到購物紀錄表單，並從購物車中刪除***/
	for($i=1;$i<=$row[0];$i++)
	{
	 /*當有勾選*/
	 if(@$_POST['rocord'.$i])
	 {
	  $check++;//勾選一個就+1
	  $good_id=$_POST['rocord'.$i];//接收勾選的內容:商品編號
	  
	  $sql=mysqli_query($s,"SELECT * FROM $car_table WHERE goods_id ='$good_id' ")or die($s);//得知會員要的商品之編號後，再選取購物車中會員要的商品
      $row2=mysqli_fetch_array($sql)or die($s);//存成陣列
	  $total=$row2[3]*$row2[4];//商品總金額=數量*金額
	  $send_total=$send_total+$total;
	  $a[$i]=$row2[2];
	   
	  $count2=mysqli_query($s,"SELECT COUNT(buy_id) FROM $buy_table ")or die(mysqli_error($s));
      $show=mysqli_fetch_array($count2);
      $car_id=$show[0]+1;
	  /*將商品資料存到購物紀錄資料表*/
	  mysqli_query($s,"INSERT INTO $buy_table (buy_id,good_id,good_name,good_num,good_total_price,good_time,good_pic) VALUES('$car_id','$row2[1]','$row2[2]','$row2[4]','$total',now(),'$row2[5]')")or die($s);
	  /*將已經買完的商品從購物車中刪除*/
	  mysqli_query($s,"DELETE FROM $car_table WHERE goods_id='$good_id'")or die($s);
	  
	  /*刪除完購物車要重新編號*/
	  $count=1;//編號1號
	  $x=mysqli_query($s," SELECT car_id FROM $car_table ORDER BY car_id ")or die($s);//選取購物車中剩餘的商品列
	  
	  while($w=mysqli_fetch_array($x))
	  {
		 mysqli_query($s,"UPDATE $car_table SET car_id = '$count' WHERE car_id='$w[0]'");//從第一列開始修改
		 $count++;//修改完一列編號要+1
      }
 

	 }
	 
	}
	    echo '<script>
	           alert("請填寫收件資料");
	          </script>
			  
	          <div id="email" align="center">
			   <form action="mail_confirm.php" method="POST">
			    <h3>請填寫收件人資料</h3>
			    收件人:<br><input type="text" name="receiver" size="15"><br>
			    收件地址:<br><textarea name="location" cols="30" rows="1" ></textarea><br>
			    收件人信箱:<br><textarea name="email" cols="30" rows="1" ></textarea><br><br>';
				for($o=1;$o<=count($a);$o++)
				 echo'<input type="hidden" name="good_name'.$o.'" value="'.$a[$o].'">';

				echo'
				<input type="hidden" name="total" value="'.$send_total.'">
				<input type="hidden" name="arr_num" value="'.count($a).'">
				<Input Type="Submit" value="完成">
			   </form>
			  </div>
			   
			   
			   
	         ';
		   
	/*如果會員沒有選取就重新刷新*/
	if($check==0)
	 echo '<meta http-equiv=REFRESH CONTENT=0;url=car.php>';
    
  } 
  /**如果會員按下確認刪除按鈕**/
  else if ($_POST['car_submit'] == '刪除') 
  {
	
		/***計算總商品數量並存成陣列***/
    $re=mysqli_query($s,"SELECT COUNT(good_id) FROM good_table ")or die(mysqli_error($s));
	$row=mysqli_fetch_array($re);
	    /***計算總購物車商品數量並存成陣列**
	$car_num=mysqli_query($s,"SELECT COUNT(car_id) FROM $car_table ")or die(mysqli_error($s));
	$car_row=mysqli_fetch_array($car_num)or die($s);*/
	
	/**將勾選的商品一個一個從購物車中刪除**/
	for($i=1;$i<=$row[0];$i++)
	{
	 if(@$_POST['rocord'.$i])
	 {
	  $good_id=$_POST['rocord'.$i];
	  mysqli_query($s,"DELETE FROM $car_table WHERE goods_id='$good_id'")or die($s);
	  
	 }
	 
	} 
	/**重新編號，同上**/
	 $count=1;
	 $x=mysqli_query($s," SELECT car_id FROM $car_table ORDER BY car_id ")or die($s);
	 while($w=mysqli_fetch_array($x))
	 {
		 mysqli_query($s,"UPDATE $car_table SET car_id = '$count' WHERE car_id='$w[0]'");
		 $count++;
     }
	 
	echo '<meta http-equiv=REFRESH CONTENT=0;url=car.php>';
  }
   mysqli_close($s);//取消連線
 ?>
 <style type="text/css">
 #email{width:300;height:250;border-style:solid;position:absolute;top:80;left:340}
</style>
 
