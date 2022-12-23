<?php session_start(); ?>
<HTML>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>圖片檔案上傳</title>
</head><BODY>

<?php
      echo "<BLOCKQUOTE>";
      
      //連結SQL Server
      require_once("data/pass.php");//只讀取一次伺服器帳號密碼，為了不讓有心人士使用
      $s=mysqli_connect("$serv","$user","$pass") or die("連線失敗");//使用函數連線
      mysqli_select_db($s,"$dbnm");//選擇資料庫
       
	  /**如果有資料上傳**/
	  if($_FILES["upfile"]["size"] >0)
	  {
      if ( ($_FILES["upfile"]["type"] == "image/jpeg") or ($_FILES["upfile"]["type"] == "image/png") ) 
        {   
         $good_seller= $_SESSION['username'];
         $good_name=htmlspecialchars($_POST['good_name']);
		 $good_price=htmlspecialchars($_POST['good_price']);
		 $good_text=htmlspecialchars($_POST['good_text']);
		 /**將上傳之資料存到image資料夾**/
		 move_uploaded_file($_FILES['upfile']['tmp_name'],"image/".$_FILES['upfile']['name']);
         $good_location="image/". $_FILES['upfile']['name'];//紀錄檔案位置

         /**計算商品資料表內有幾筆商品並編號**/
         $re=mysqli_query($s,"SELECT COUNT(good_id) FROM good_table ")or die(mysqli_error($s));
         $show=mysqli_fetch_array($re);
         $good_id=$show[0]+1;
         
         
		  
         /**將商品存進商品資料表**/
         $sql="INSERT INTO good_table (good_id,good_name,good_price,good_location,good_seller,good_text) VALUES('$good_id','$good_name','$good_price','$good_location', '$good_seller','$good_text')";
         
		 /**選取已存在的商品**/
		 $sql2="SELECT good_name FROM good_table WHERE good_name='$good_name'";
		 $re2=mysqli_query($s,$sql2);
                 
         /**商品存在**/
		 if(mysqli_fetch_array($re2))
		 {
			 echo "
			<script>
			 alert('商品名已存在');
			</script>
			     ";
			 
			 echo '<meta http-equiv=REFRESH CONTENT=0;url=pic_upload.php>';
		 }
		 else//商品不存在
		 {	
          if(mysqli_query($s,$sql))
           {	
	         $back='"web_index.php"';
           	 echo" 
			 <script>
			 alert('您所上傳的檔案已儲存進入資料庫');
			 </script>
			 ";
             echo "<div id='confirm' align='center'>
			 <H3>圖檔存入相關資訊：</H3>
			 
			 檔案名稱：" . $_FILES["upfile"]["name"] ."<br><br>
			 <div id='pic'>預覽圖：</div>
			 <img src='image/".$_FILES['upfile']['name']."' height='80' width='80'>
			 
			 <div id='text1'>商品內容:</div>
			 <div id='text2' align='left'>".$good_text."</div>
			 
			 <div id='return'>
              <input type=button onClick=' location.href=".$back." ' value='返回'>
             </div>
			 </div>";	
			 
          
		   }
          else
           {
            echo "
			<script>
			 alert('您所上傳的檔案無法儲存進入資料庫');
			</script>
			     ";
			echo '<meta http-equiv=REFRESH CONTENT=0;url=pic_upload.php>';
           } 
		  }
        }
      else
        {echo "
			<script>
			 alert('請選擇圖片檔(.jpg or.png)');
			</script>
			  ";
         
		 echo '<meta http-equiv=REFRESH CONTENT=0;url=pic_upload.php>';
        }
	  }
	  else
		{
			echo "
			<script>
			 alert('尚未選取檔案');
			</script>
			     ";
         
		echo '<meta http-equiv=REFRESH CONTENT=0;url=pic_upload.php>';
        }
      echo "</BLOCKQUOTE>";
	   mysqli_close($s);//取消連線
?>
<style type="text/css">
#confirm{position:absolute;top:50;left:340;border-style:solid;width:300;height:390;}
img{border-style:solid;	position:absolute;top:100;left:150;}
#pic{position:absolute;top:100;left:46;}
#text1{position:absolute;top:190;left:46;}
#text2{position:absolute;top:210;left:46;width:220;height:130;border-style:solid;}
#return{position:absolute;top:350;left:135;}
</style>
</BODY>
</HTML>