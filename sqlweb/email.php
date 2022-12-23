
<?php

$to ="qsda82@gmail.com";
$subject = "Test mail";
$message = "您設定的帳號為:";
$headers = "From: qsda82@gmail.com";
mail($to,$subject,$message,$headers);

?>