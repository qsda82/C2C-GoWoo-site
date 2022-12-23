<?php
$back="'web_index.php'";
echo'<div id="text" >
      <H3 align="center">商品介紹</H3>
	  <div id="content">
	  內容:<br>'.$_GET["text"].'
	  </div>
	  
	  <div id="return">
         <input type=button onClick=" location.href='.$back.' " value="返回">
      </div>
	  
	  
     </div>
    ';
//echo "送過來的值：".;


?>
<style type="text/css">
#text{width:300;height:330;border-style:solid;position:absolute;top:80;left:340}
#content{width:240;height:200;position:absolute;top:80;left:30}
#return{position:absolute;top:300;left:135;}
</style>