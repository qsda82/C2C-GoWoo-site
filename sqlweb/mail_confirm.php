<?php
   $receiver=$_POST['receiver'];
   $location=$_POST['location'];
   $email=$_POST['email'];
   $arr_num=$_POST['arr_num'];
   $total=$_POST['total'];
   for($i=1;$i<=$arr_num;$i++)
	$a[$i]=$_POST['good_name'.$i];
   $msg=" ";
   for($i=1;$i<=$arr_num;$i++)
    $msg=$msg.$i.".".$a[$i]."  ";
   
   $to = $email;
   $subject = "訂單確認";
   $message = "您所購買的商品有:".$msg."\n總金額為:".$total."\n收件地址為:".$location."\n感謝您的訂購";	  
   $headers = "From: qsda82@gmail.com";
   mail($to,$subject,$message,$headers);

   
    	
?>
<script>
alert("訂單明細已傳送至收件人信箱");
</script>
<meta http-equiv=REFRESH CONTENT=0;url=web_index.php>