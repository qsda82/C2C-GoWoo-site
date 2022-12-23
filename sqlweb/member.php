<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
require_once("data/pass.php");//只讀取一次伺服器帳號密碼，為了不讓有心人士使用
$s=mysqli_connect("$serv","$user","$pass") or die("連線失敗");//使用函數連線
mysqli_select_db($s,"$dbnm");//選擇資料庫


?>

<div id="table">
<table border="1" align="center">
  <tr>
    <td style="width:311px " align="center" >會員中心 </td>
  </tr>
</table>

<table border="1" align="center" >
  <tr>
    <td style="width:105px" align="center">帳號</td>
  <td style="width:200px" align="center"> <?php echo $_SESSION['username']; ?></td>
  </tr>

  <tr>
    <td style="width:105px" align="center">信箱</td>
    <td align="center" style="width:200px"> 
      <?php   
	   /**讀取會員email*/
       $id=$_SESSION['username'];
       $sql = "SELECT email FROM member_table WHERE id='$id'"; 
       $result = mysqli_query($s,$sql);
       $row =mysqli_fetch_row($result);
       echo $row[0];
	    mysqli_close($s);//取消連線
      ?> 
    </td>
  </tr>

  <tr>
    <td style="width:105px" colspan='2' align="center">
      <a href="buy_record_show.php">購物紀錄</a>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
      <a href="update.php">修改密碼</a>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
      <a href="good_delete.php">商品管理</a>
    </td>

  </tr>
</table>
</div>	
<div id="return">
  <input type=button onClick=" location.href='web_index.php' " value='返回'>
</div>
<style type="text/css">
#table{position:absolute;top:50;left:325;}
#return{position:absolute;top:170;left:460;}
</style>

















