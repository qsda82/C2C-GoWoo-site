<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
require_once("data/pass.php");//只讀取一次伺服器帳號密碼，為了不讓有心人士使用
$s=mysqli_connect("$serv","$user","$pass") or die("連線失敗");//使用函數連線
mysqli_select_db($s,"$dbnm");//選擇資料庫


$pw =htmlspecialchars( $_POST['pw']);
$pw2 = htmlspecialchars($_POST['pw2']);
$email = htmlspecialchars($_POST['email']);

//判斷密碼是否填寫正確
if($_SESSION['username'] != null)     
{
 if($pw != null && $pw2 != null &&$email!=null)
 {	
   if($pw == $pw2)
   {
	 $id = $_SESSION['username'];
	 $sql = "UPDATE member_table SET password='$pw' , email='$email' WHERE id='$id'";        
     if(mysqli_query($s,$sql))
     {
		 
       echo '
	         <script>
	          alert("修改成功!");
	         </script>	   
	        ';
       echo '<meta http-equiv=REFRESH CONTENT=0;url=member.php>';
     }
     else
     {
       echo '
	         <script>
	          alert("修改失敗!");
	         </script>	   
	        ';
       echo '<meta http-equiv=REFRESH CONTENT=0;url=update.php>';
     }
   }
  else
  {
      echo '
	         <script>
	          alert("密碼輸入不同!");
	         </script>	   
	        ';
       echo '<meta http-equiv=REFRESH CONTENT=0;url=update.php>';
  }
 }
 else
  {
      echo '
	         <script>
	          alert("輸入處請勿留白!");
	         </script>	   
	        ';
       echo '<meta http-equiv=REFRESH CONTENT=0;url=update.php>';
  }
  
}
 mysqli_close($s);//取消連線
?>