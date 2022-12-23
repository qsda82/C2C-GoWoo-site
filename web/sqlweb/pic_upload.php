<HTML>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5">
<title>商品上傳</title>
</head>
<BODY>

<div id="pic" align="center">
<Form Action="pic_upload_finish.php" Method="POST" 
Enctype="multipart/form-data"><H3>商品上傳</H3>

商品名稱：<input type="text" name="good_name" /> <br>
商品價錢：<input type="text" name="good_price" /> <br>
<div id="goodpic" >商品圖片：</div>

<div id="file"><Input Type="File" Name="upfile" ><br></div>
<div id="content">商品介紹：</div>
<div id="text">  
 <textarea name="good_text" cols="33" rows="5" >介紹內容</textarea>
</div>
<div id="upload"><Input Type="Submit" value=" 開始上傳"></div>
</Form>
</div>
<style type="text/css">
#pic{width:300;height:300;border-style:solid;position:absolute;top:80;left:340}
#goodpic{position:absolute;top:103;left:22;}
#file{position:absolute;top:125;left:22;}
#content{position:absolute;top:155;left:22;}
#text{position:absolute;top:175;left:22;}
#upload{position:absolute;top:270;left:110;}
</style>
</BODY>
</HTML>