<?php

if($_GET["web"]==0)
	$back="'web_index.php'";
else if($_GET["web"]==1)
   $back="'web_index_cloth.php'";
else if($_GET["web"]==2)
   $back="'web_index_3c.php'";
else if($_GET["web"]==3)
   $back="'web_index_daily.php'";

echo'<div id="text" >
      <H3 align="center">商品介紹</H3>
	  &nbsp &nbsp&nbsp &nbsp&nbsp 內容: 
	  <div id="content">
	  <br>'.$_GET["text"].'
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
#content{width:240;height:200;position:absolute;top:80;left:30;border-style:solid;}
#return{position:absolute;top:300;left:135;}
</style>