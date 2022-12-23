<?php session_start(); ?>
<html>
 <meta charset="utf-8">
 <head>
   <?php
    /*****資料庫連結*****/
     require_once("data/pass.php");//只讀取一次伺服器帳號密碼，為了不讓有心人士使用
     $s=mysqli_connect("$serv","$user","$pass") or die("連線失敗");//使用函數連線
     mysqli_select_db($s,"$dbnm");//選擇資料庫
	
	 /***計算總商品數量並存成陣列***/
	
    if( @$_SESSION['username']!=null)
	{
		$car_table=$_SESSION['username']."_car_table";
		$re=mysqli_query($s,"SELECT COUNT(car_id) FROM $car_table ")or die(mysqli_error($s));
	    $row=mysqli_fetch_array($re);
		
		
		echo '<div id="top">';
		echo'<h5 align="right">'.'哈囉！  '.$_SESSION['username'].'</h>';
	    echo '&nbsp  &nbsp';
	    echo'<a href="member.php">會員中心</a>';
	    echo '&nbsp  &nbsp';
	    echo'<a href="car.php">購物車 ('.$row[0].')</a>';
	    echo '&nbsp  &nbsp';
	    echo'<a href="pic_upload.php">上傳商品</a>';
	    echo '&nbsp  &nbsp';
	    echo'<a href="logout.php">登出</a>';
	    echo '&nbsp &nbsp &nbsp &nbsp';
		
		echo '</div>';
		
		echo '<style type="text/css">';	
		echo '#top{width:990px;height:1px;align="right";	}';
	    echo '</style>';

	}	
	else
	{
	    echo'<h5 align="right">還沒登入嗎?</h>';
	    echo '&nbsp  &nbsp';
	    echo'<a href="index.php">按此登入</a>';
	    echo '&nbsp  &nbsp';
	    echo'<a href="register.php">註冊會員</a>';
	}
   ?>
   &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp<br>
    <div id="title">
	<h1 align="left">購物網</h>&nbsp &nbsp	
    <hr>
	</div>
	<style type="text/css">
	#title{width:990px;height:90px;align="left";position:absolute;top:18px;left:10px;	}
	</style>
  </head>
  <body>

	<?php
	//word-wrap:break-word ;自動斷行	
	$sql=mysqli_query($s,"SELECT COUNT(good_id) FROM good_table ");
	$row=mysqli_fetch_array($sql);//$row[0]=有幾張圖片
	
	
	for($i=1;$i<=$row[0];$i++)
	{
	 $sql2=mysqli_query($s,"SELECT * FROM good_table WHERE good_id= '$i' ");
     $row2=mysqli_fetch_array($sql2);
	 
	 if($i==1)
	 {
       echo '<style type="text/css">';
       echo '#a'.$i.'{text-align:center;width:100px;height:130px;border-style:dotted;padding:10px;position:absolute;top:'. (150) .'px;left:'. (200) .'px}';
	   echo '</style>';
     }
	 else if(($i>1)&&($i<=3))
	 {
       echo '<style type="text/css">';
       echo '#a'.$i.'{text-align:center;width:100px;height:130px;border-style:dotted;padding:10px;position:absolute;top:'. (150) .'px;left:'. ($i*200) .'px}';
	   echo '</style>'; 
	 }
	 
	 else if($i>3)
	  {
		if($i%3==1)
		{
		  $h1=$i/3;
          echo '<style type="text/css">';
          echo '#a'.$i.'{text-align:center;width:100px;height:130px;border-style:dotted;padding:10px;position:absolute;top:'. (150+floor($h1)*200) .'px;left:'. (200) .'px}';
	      echo '</style>'; 
	    }	
		else if($i%3==2)
	    {
		  $h2=$i/3;
          echo '<style type="text/css">';
          echo '#a'.$i.'{text-align:center;width:100px;height:130px;border-style:dotted;padding:10px;position:absolute;top:'. (150+floor($h2)*200) .'px;left:'. (400) .'px}';//floor()為取整數
	      echo '</style>'; 
	    }
   		else if($i%3==0)
        {
		  $h3=$i/3;
          echo '<style type="text/css">';
          echo '#a'.$i.'{text-align:center;width:100px;height:130px;border-style:dotted;padding:10px;position:absolute;top:'. ( ($h3-1)*200+150) .'px;left:'. (600) .'px}';
	      echo '</style>'; 
	    }
      }
	  
     echo '<div id="a'.$i.'" style="word-break: normal">'; 
	 echo " <a href='good_text.php?text=".$row2[5]."'> <img  src=' ".$row2[4] . " ' height='50' width='50' ></a><br>";       
	 echo "<font  size='2'>名稱:". $row2[1]."</font><br>";
	 echo "<font  size='2'>價錢:" . $row2[2]."</font><br>";  
	 echo "<form action='car.php' method='POST' >";
	 echo '<font size="2">數量:</font><select name="good_num">
            <option value="1">1</option>
            <option value="2">2</option>
　          <option value="3">3</option>
　          <option value="4">4</option>
　          <option value="5">5</option>
　          <option value="6">6</option>
　          <option value="7">7</option>
　          <option value="8">8</option>
　          <option value="9">9</option>
　          <option value="10">10</option>
           </select>';
     
     echo "<input type='hidden' name='good_id' value='".$i."'>";
	 echo "<input type='hidden' name='pic_name' value='".$row2[4]."'>";
	 echo "<input type='hidden' name='good_name' value='".$row2[1]."'>";
	 echo "<input type='hidden' name='good_price' value='".$row2[2]."'>";
	 echo "<input type='hidden' name='good_seller' value='".$row2[3]."'>";
     echo "<input type='submit' name='good_submit' value='加入購物車'>";
     echo "</form>";
	 echo '</div>';
	}
	
	
	echo'
	<div id="dad">
	<hr><br>
	
	<div id="a" align="center">
	<h1 >COMPANY</h1><br>
	<font>關於品牌</font><br><br>
	<font>門市資訊</font>
	</div>
	
	<div id="b" align="center">
	<h1 >SERVICE</h1><br>
	<font>購買須知</font><br><br>
	<font>售後服務</font><br><br>
	</div>

	<div id="c" align="center">
	<h1 >CONTACT US</h1>
	<font>營業時間</font><br>
	<font>8:00~20:00</font><br><br>
	<font>電話:</font><br>
	<font>0800-800800</font>
	</div>	
    </div>
	
	<style type="text/css">
	#a{width:170;height:250;position:absolute;top:30;left:10;}
	#b{width:170;height:250;position:absolute;top:30;left:410;}
	#c{width:170;height:250;position:absolute;top:30;left:810;}
	</style>
	';
	if(($row[0]==1)||($row[0]==0))
	 {
       echo '<style type="text/css">';
       echo '#dad{width:990px;height:20px;padding:10px;position:absolute;top:'. (500) .'px;left:'. (0) .'px}';
	   echo '</style>';
     }
	 else if(($row[0]>1)&&($row[0]<=3))
	 {
       echo '<style type="text/css">';
       echo '#dad{width:990px;height:20px;padding:10px;position:absolute;top:'. (500) .'px;left:'. (0) .'px}';
	   echo '</style>'; 
	 }
	 
	 else if($row[0]>3)
	  {
		if($row[0]%3==1)
		{
		  $h1=$row[0]/3;
          echo '<style type="text/css">';
          echo '#dad{width:990px;height:20px;padding:10px;position:absolute;top:'. (300+floor($h1)*200) .'px;left:'. (0) .'px}';
	      echo '</style>'; 
	    }	
		else if($row[0]%3==2)
	    {
		  $h2=$row[0]/3;
          echo '<style type="text/css">';
          echo '#dad{width:990px;height:20px;padding:10px;position:absolute;top:'. (300+floor($h2)*200) .'px;left:'. (0) .'px}';//floor()為取整數
	      echo '</style>'; 
	    }
   		else if($row[0]%3==0)
        {
		  $h3=$row[0]/3;
          echo '<style type="text/css">';
          echo '#dad{width:990px;height:20px;padding:10px;position:absolute;top:'. ( ($h3-1)*200+300) .'px;left:'. (0) .'px}';
	      echo '</style>'; 
	    }
      }
    
   mysqli_close($s);//取消連線
?>
 
 <style type="text/css">
 #dad{position:relative;}
 </body>
</html>