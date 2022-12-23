<?php session_start(); ?>
<h1 align="left">購物紀錄 </h>&nbsp &nbsp
<hr>
<?php
     require_once("data/pass.php");//只讀取一次伺服器帳號密碼，為了不讓有心人士使用
     $s=mysqli_connect("$serv","$user","$pass") or die("連線失敗");//使用函數連線
     mysqli_select_db($s,"$dbnm");//選擇資料庫
     $buy_table=$_SESSION['username']."_buy_table";//讀取會員購物紀錄資料表
	 
	 /*****建立表格*****/
     echo '<div id="table">';
	 echo '<style type="text/css">';
	 echo '</style>';
     echo  '<table border="1" align="center">
	      <tr>
          <td style="width:88px ;height:50px" align="center" ><font size="5">圖片</font> </td>
          <td style="width:270px ;height:50px" align="center" ><font size="5">內容</font> </td>
          <td style="width:80px ;height:50px" align="center" ><font size="5">數量</font> </td>
		  <td style="width:80px ;height:50px" align="center" ><font size="5">金額</font> </td>
		  <td style="width:100px ;height:50px" align="center" ><font size="5">購買時間</font> </td>
		  </tr>
          </table>
		  '; 
		  
		  /**讀取購物紀錄資料表的資料，並一一列出**/
     $x=mysqli_query($s," SELECT * FROM $buy_table ORDER BY  buy_id")or die($s);
	 while($w=mysqli_fetch_array($x))
	 {
		 echo  '<table border="1" align="center">
	      <tr>
		 	
          <td style="width:88px ;height:90px" align="center" ><img  src=" '.$w[6] . ' " height="50" width="50" >  </td>
          <td style="width:270px ;height:90px" align="center" ><font size="5">'.$w[2].'</font> </td>
          <td style="width:80px ;height:90px" align="center" ><font size="5">'.$w[3].'</font> </td>
		  <td style="width:80px ;height:90px" align="center" ><font size="5">'.$w[4].'</font> </td>
		  <td style="width:100px ;height:90px" align="center" ><font size="5">'.$w[5].'</font> </td>
		  </tr>
          </table> 
		  '; 
     }
     echo '</div>';
	 mysqli_close($s);//取消連線
?>
<!--返回按鈕-->
<style type="text/css">
#return{width:50px;height:50px;position:relative;top:20px;left:500px}';
</style>
<div id="return">
  <input type=button onClick=" location.href='web_index.php' " value='返回'>
</div>