<?php
header("Content-Type:text/html; charset=utf-8");
$error="";$result="";
if(isset($_POST["send"]))
{
 $id=$_POST["id"];
 $title=$_POST["title"];
 $author=$_POST["author"];
 $price=$_POST["price"];
 $category=$_POST["category"];
 $pubdate=$_POST["pubdate"];
 if(empty($id))
 {
  $error="書號欄位不可是空白<br>";
 }
 else
 {
  if(empty($title))
   $error="書名欄位不可是空白<br>";
  else 
  {
   $db=mysqli_connect("localhost","root","");
   mysqli_select_db($db,"ppttest");
   //mysql_query("SET NAMES UTF8");
   $sql="INSERT INTO book".
   "(id,title,author,price,category,pubdate)".
   "VALUES('$id','$title','$author','$price','$category','$pubdate')";
   if(!mysqli_query($db,$sql))
   {
    $result="新增失敗...<br>".mysqli_error($db);
   }
   else 
	$result="新增成功...<br>";
   mysqli_close($db);
   }
  }
 }
 else
 {
  $id= ""; $title="";
  $author=""; $category="";
  $price=""; $pubdate="";
 }
 ?>
 
 <!DOCTYPE html>
 <html>
 <head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
 <title>book</title>
 </head>
 <body>
 <h1>新增紀錄</h1>
 <div style="color:red"><?php echo $error ?></div>
 <form method="post" action="" >
  <div>
     <label for="id">書號:</label>
	 <input type="text" name="id" id="id" value=" <?php echo $id?> ">
  </div>
  <div>
      <label for="title">書名:</label>
	  <input type="text" name="title" id="title" value="<?php echo $title ?>">
  </div>
   <div>
      <label for="author">作者:</label>
	  <input type="text" name="author" id="author" value="<?php echo $author ?>">
  </div>
   <div>
      <label for="price">書價:</label>
	  <input type="text" name="price" id="price" value="<?php echo $price ?>">
  </div>
   <div>
      <label for="category">分類:</label>
	  <input type="text" name="category" id="category" value="<?php echo $category ?>">
  </div>
   <div>
      <label for="pubdate">出版日:</label>
	  <input type="text" name="pubdate" id="pubdate" value="<?php echo $pubdate ?>">
  </div><hr>
  <input type="submit" name="send" value="新增紀錄">
 </form>
 <?php echo $result ?>
 </body>
 </html>