<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
//將session清空
unset($_SESSION['username']);
 echo '<script language="javascript">';
 echo 'alert("登出中......")';
 echo '</script>';
 echo '<meta http-equiv=REFRESH CONTENT=0;url=web_index.php>';
?>