
<?php

require_once("data/pass.php");//只讀取一次伺服器帳號密碼，為了不讓有心人士使用
$s=mysqli_connect("$serv","$user","$pass") or die("連線失敗");//使用函數連線
mysqli_select_db($s,"$dbnm");//選擇資料庫

$id = htmlspecialchars($_POST['id']);
$pw = htmlspecialchars($_POST['pw']);
$pw2 = htmlspecialchars($_POST['pw2']);
$email = htmlspecialchars($_POST['email']);



//判斷帳號密碼是否為空值
//確認密碼輸入的正確性
if( $id != null && $pw != null && $pw2 != null )
{
	if($pw == $pw2)
    {    
        $sql = "INSERT INTO member_table( id,password,email) VALUES ('$id', '$pw', '$email')";
        if(mysqli_query($s,$sql))
        {
			    echo '<script language="javascript">';
                echo 'alert("新增成功!")';
	            echo '</script>';
                
				$sql = "SELECT * FROM member_table WHERE id = '$id'";
                $result = mysqli_query($s,$sql);
                $row = @mysqli_fetch_row($result);
				
			    /**信件傳送**/
				$to = "$row[2]";
                $subject = "帳號設定";
                $message = "您設定的帳號為:".$row[0]."\n您設定的密碼為:".$row[1]."\n您設定的信箱為:".$row[2];
                $headers = "From: qsda82@gmail.com";
                mail($to,$subject,$message,$headers);
				
				/**會員購物紀錄和購物車資料表新增**/
				$car_table="$id"."_car_table";
				$buy_table="$id"."_buy_table";
                mysqli_query($s,"CREATE TABLE  $car_table (car_id int(11),goods_id int(11),goods_name text,goods_price int(11),goods_num int(11),pic_name text,PRIMARY KEY(car_id))")or die($s);				
                mysqli_query($s,"CREATE TABLE  $buy_table (buy_id int(11),good_id int(11),good_name text,good_num int(11),good_total_price int(11),good_time datetime,good_pic text,PRIMARY KEY(buy_id))")or die($s);				       
	            echo '<meta http-equiv=REFRESH CONTENT=0;url=web_index.php>';
	   }
        else
        {
			    echo '<script language="javascript">';
                echo 'alert("帳號已被使用!")';
	            echo '</script>';               
                echo '<meta http-equiv=REFRESH CONTENT=0;url=register.php>';
        }
    }
    else
    {
	  echo '<script language="javascript">';
      echo 'alert("密碼不一致")';
	  echo '</script>';
      echo '<meta http-equiv=REFRESH CONTENT=0;url=register.php>';
    }	 
}
else
{
	    echo '<script language="javascript">';
        echo 'alert("表格請勿留白")';
	    echo '</script>';
        echo '<meta http-equiv=REFRESH CONTENT=0;url=register.php>';
}
 mysqli_close($s);//取消連線
?>