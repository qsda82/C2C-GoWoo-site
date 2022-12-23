<?php
      require_once("data/pass.php");//只讀取一次伺服器帳號密碼，為了不讓有心人士使用
      $s=mysqli_connect("$serv","$user","$pass") or die("連線失敗");//使用函數連線
      mysqli_select_db($s,"$dbnm");//選擇資料庫
         $re=mysqli_query($s,"SELECT COUNT(good_id) FROM good_table_".$good_type)or die(mysqli_error($s));
         $show=mysqli_fetch_array($re);
         $good_table_id=$show[0]+1;
		 
		 $re2=mysqli_query($s,"SELECT good_id FROM good_table WHERE good_name='$good_name'")or die(mysqli_error($s));
		 $show2=mysqli_fetch_array($re2);
		 $good_id=$show2[0];
		  /**將商品存進商品資料表**/
         $sql="INSERT INTO good_table_".$good_type."(good_table_id,good_id,good_name,good_price,good_location,good_seller,good_text) VALUES('$good_table_id','$good_id','$good_name','$good_price','$good_location', '$good_seller','$good_text')";
         
		 mysqli_query($s,$sql);
		 
		 
		 
		 
?>