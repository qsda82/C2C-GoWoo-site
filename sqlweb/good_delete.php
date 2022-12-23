<?php session_start(); ?>
<h1 align="left">商品管理 </h>&nbsp &nbsp
             <hr> 
<?php
     require_once("data/pass.php");//只讀取一次伺服器帳號密碼，為了不讓有心人士使用
     $s=mysqli_connect("$serv","$user","$pass") or die("連線失敗");//使用函數連線
     mysqli_select_db($s,"$dbnm");//選擇資料庫
	 
	 $sql=mysqli_query($s," SELECT * FROM good_table WHERE good_seller='".$_SESSION['username']."'"  );
	 $row2=mysqli_fetch_array($sql);
     if($row2[0]==null)
	 {	 echo' <script>
	           alert("尚未上傳任何商品");
	           </script>

	         ';
		echo '<meta http-equiv=REFRESH CONTENT=0;url=member.php>';
	 }
	 else
     {
		 
         echo '<table border="1" align="center">
	      <tr>
          <td style="width:158px ;height:50px" align="center" ><font size="5">圖片</font> </td>
          <td style="width:240px ;height:50px" align="center" ><font size="5">內容</font> </td>
		  <td style="width:110px ;height:50px" align="center" ><font size="5">金額</font> </td>
		  <td style="width:100px ;height:50px" align="center" ><font size="5">上傳時間</font> </td>
		  </tr>
          </table>
		  '; 
    $x=mysqli_query($s," SELECT * FROM good_table WHERE good_seller='".$_SESSION['username']."'"  )or die($s);
	$count=1;
	echo "<form action='good_delete_finish.php' method='POST' >";
    while($row=mysqli_fetch_array($x))
    {
	  echo  '<table border="1" align="center">
		      <tr>
		      <td style="width:61px ;height:90px" align="center" >
		             <input type="checkbox" name="rocord'.$count.'" align="center" value="'.$row[0].'">
		      </td>	
			  <td style="width:92px ;height:90px" align="center" ><img  src=" '.$row[4] . ' " height="50" width="50" >  </td>
              <td style="width:240px ;height:90px" align="center" ><font size="5">'.$row[1].'</font> </td>
              <td style="width:110px ;height:90px" align="center" ><font size="5">'.$row[2].'</font> </td>
			  <td style="width:100px ;height:90px" align="center" ><font size="5">'.$row[5].'</font> </td>
			 </tr>
		     </table>
		    ';
		    $count++;
		
	}
	echo "<br><div id='delete'><input type='submit' name='car_submit' value='刪除' align='center'></div>";
    echo '</form>';

	 }

    

?>
<div id="return">
  <input type=button onClick=" location.href='web_index.php' " value="返回">
</div>
<style type="text/css">
#delete{position:relative;top:60;left:500;}
#return{width:50px;height:50px;position:relative;top:5.5;left:580}';
</style>