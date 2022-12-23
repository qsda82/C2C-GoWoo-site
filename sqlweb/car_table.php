<?php
             /**計算購物車中有幾筆資料**/
         $check=mysqli_query($s,"SELECT COUNT(car_id) FROM $car_table ")or die(mysqli_error($s));
         $row=mysqli_fetch_array($check);
		 

         echo '<h1 align="left">購物車 </h>&nbsp &nbsp
               <hr>
			  ';
         echo '<div id="table" style="word-break: normal">';
	     
         echo  '<table border="1" align="center">
	            <tr>
                <td style="width:158px ;height:50px" align="center" ><font size="5">圖片</font> </td>
                <td style="width:300px ;height:50px" align="center" ><font size="5">內容</font> </td>
                <td style="width:80px ;height:50px" align="center" ><font size="5">數量</font> </td>
		        <td style="width:80px ;height:50px" align="center" ><font size="5">金額</font> </td>
		        </tr>
                </table>
		       '; 
    
         echo "<form action='buy_record.php' method='POST' >";
	     
		 $total2=0;//購物車之總金額
		 /**將每筆資料選是在表格中**/
	     for($i=1;$i<=$row[0];$i++)
         {		
           $sql2=mysqli_query($s,"SELECT * FROM $car_table WHERE car_id= '$i' ");
           $row2=mysqli_fetch_array($sql2);
	 
           echo  '<table border="1" align="center">
	              <tr>
		          <td style="width:60px ;height:90px" align="center" >
		             <input type="checkbox" name="rocord'.$i.'" align="center" value="'.$row2[1].'">
		          </td>		
                  <td style="width:93px ;height:90px" align="center" ><img  src=" '.$row2[5] . ' " height="50" width="50" >  </td>
                  <td style="width:300px ;height:90px" align="center" ><font size="5">'.$row2[2].'</font> </td>
                  <td style="width:80px ;height:90px" align="center" ><font size="5">'.$row2[4].'</font> </td>
		          <td style="width:80px ;height:90px" align="center" ><font size="5">'.($row2[4]*$row2[3]).'</font> </td>
		          </tr>
                  </table> 
		         ';     	
		   $total2=($row2[4]*$row2[3])+$total2;//計算每筆金額之總和
	     }
	 
	     echo  '<table border="1" align="center">
	         <tr>
             <td style="width:158px ;height:50px" align="center" ><font size="5">總價</font> </td>
             <td style="width:472px ;height:50px" align="center" ><font size="5">'.$total2.'</font> </td>
		     </tr>
             </table>
		    '; 
	     echo '</div>';
	
	     echo '<style type="text/css">';
         echo '#submit1{width:50px;height:50px;position:relative;top:20px;left:710px}';
	     echo '#return{width:50px;height:50px;position:relative;top:-79px;left:600px}';
         echo '#delete{width:50px;height:50px;position:relative;top:-30px;left:500px}';
	     echo '</style>';
 	 
	     echo '<div id="submit1">';
	     echo "<input type='submit' name='car_submit' value='確認購買' >";
	     echo '</div>';
     
 	     echo '<div id="delete">';
	     echo "<input type='submit' name='car_submit' value='刪除' >";
	     echo '</div>';
		 $index="'web_index.php'";
		 echo'<div id="return">
              <input type=button onClick=" location.href='.$index.' " value="返回">
              </div>
			 ';
	     echo '</form>';
 ?>