<?php session_start(); ?>

<?php
 require_once("data/pass.php");//只讀取一次伺服器帳號密碼，為了不讓有心人士使用
 $s=mysqli_connect("$serv","$user","$pass") or die("連線失敗");//使用函數連線
 mysqli_select_db($s,"$dbnm");//選擇資料庫
 if( @$_SESSION['username'])	 
 {
  $car_table=$_SESSION['username']."_car_table";
  
  if( @$_POST['good_submit'] == '加入購物車')//按下加入購物車按鈕
  {	 
      $good_seller=htmlspecialchars($_POST['good_seller']);
	  if($good_seller!=$_SESSION['username'])//商品不是自己上傳的商品才能買
	  {
		   
         $good_id=htmlspecialchars($_POST['good_id']);
         $good_name=htmlspecialchars($_POST['good_name']);
         $good_price=htmlspecialchars($_POST['good_price']);
         $pic_name=htmlspecialchars($_POST['pic_name']);
         $good_num=htmlspecialchars($_POST['good_num']);
	  
	     /**讀取重複購買的資料**/
         $repeat=mysqli_query($s,"SELECT goods_num FROM $car_table WHERE goods_name='$good_name'");
	     $repeat_num=mysqli_fetch_array($repeat);
	
 	     if($repeat_num)
	     {
	        /**將購物車中原來的數量加上後來購買的相同商品的數量**/
	        $total=$repeat_num[0]+$good_num;
	        mysqli_query($s,"UPDATE $car_table SET goods_num='$total' WHERE goods_name='$good_name'");
			
	        echo '<meta http-equiv=REFRESH CONTENT=1.5;url=web_index.php>';
  	     }
	     else//沒有重複時
	     {	
	         /**購物車商品編號**/
		     /**算購物車資料表有幾筆資料，下筆資料編號就是原來資料數+1**/
             $count=mysqli_query($s,"SELECT COUNT(car_id) FROM $car_table ")or die(mysqli_error($s));
             $show=mysqli_fetch_array($count);
             $car_id=$show[0]+1;
		
             /**將欲購買的商品資料存到購物車資料表**/
             mysqli_query($s,"INSERT INTO $car_table(car_id,goods_id,goods_name,goods_price,goods_num,pic_name) VALUES('$car_id','$good_id','$good_name','$good_price','$good_num','$pic_name')");
			 
	         echo '<meta http-equiv=REFRESH CONTENT=1.5;url=web_index.php>';
			
		  }
		  
         include('car_table.php');//呼叫car.table檔來顯示表格
        		 
	  }
	  else if($good_seller==$_SESSION['username'])//商品是自己上傳的不能買   
	      echo '<script language="javascript">';
          echo 'alert("自己的商品不能購買喔")';
	      echo '</script>';
		  echo '<meta http-equiv=REFRESH CONTENT=0;url=web_index.php>';
     		  
   }
   else
     include('car_table.php');//呼叫car.table檔來顯示表格  
 }
 else
 { 
    echo '<script language="javascript">';
    echo 'alert("請先登入")';
	echo '</script>';
    echo '<meta http-equiv=REFRESH CONTENT=0;url=web_index.php>';
 }
  mysqli_close($s);//取消連線
?>
 
  