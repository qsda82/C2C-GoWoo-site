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
<div id="type">商品種類:<select name="type">
            <option value="cloth">服飾</option>
            <option value="3c">3c</option>
　          <option value="daily">日常用品</option>   
           </select>
</div><br>
<div id="content">商品介紹：</div>
<div id="text">  
 <textarea name="good_text" cols="33" rows="5" >介紹內容</textarea>
</div>
<div id="upload"><Input Type="Submit" value=" 開始上傳"></div>
</Form>
</div>
<style type="text/css">
#pic{width:300;height:350;border-style:solid;position:absolute;top:80;left:340}
#goodpic{position:absolute;top:103;left:22;}
#file{position:absolute;top:125;left:22;}
#type{position:absolute;top:155;left:22;}
#content{position:absolute;top:185;left:22;}
#text{position:absolute;top:210;left:22;}
#upload{position:absolute;top:310;left:110;}
</style>
</BODY>
</HTML>