<?php
session_start();
	include("conn.php");
	if(!isset($_SESSION["xname"])){
		echo "<script>alert('你还没有登录');window.location.href='login.php';</script>";
	}
if(isset($_GET["page"]))
{
	$page=$_GET["page"];
}
else
{
	$page=1;
}
$pagesize=3;	//每页显示的数量
$start=($page-1)*$pagesize;//从那条数据开始
$sql1="select a.*,b.xname,b.path from liuyan a,huiyuan b where a.hid = b.id order by a.id desc limit {$start},{$pagesize}";
$sreg=mysql_query($sql1);

$sql="select * from liuyan";
$reg=mysql_query($sql);
$rows=mysql_num_rows($reg);
$pagenum=ceil($rows/$pagesize);

if(isset($_POST['submit']))
{
	$id=$_SESSION['id'];
	$liu=$_POST['text'];
	$zhuti=$_POST['zhuti'];
	$sql2="insert into liuyan(hid,xinxi,biaoti) value ($id,'$liu','$zhuti')";
	$reg=mysql_query($sql2);
	if($reg)
	{
		echo "<script>alert('留言成功');window.location.href='liuyan.php';</script>";
	}
	else{
		echo "<script>alert('留言失败');window.location.href='liuyan.php';</script>";
	}
}
?>
<!DOCTYPE html> 
<html>
	<head>
		<meta charset="utf-8" />
		<title></title>
		<style>
			.middle{width:70%;margin:0 auto;}
			.left{width:68%; height:200px;margin:0 auto;}
			.right{width:80%;margin:0 auto;}
			a{text-decoration:none;color:black;margin:0 auto;line-height:30px;}
			.aa{text-align:center; margin:0 auto;}
			.mil{border:1px solid; margin-top:20px;}
			.kk{float:left;width:600px;margin-left:5%;height:80px;}
		</style>
	</head>
	<body background="img/banner2.jpg">
		     <?php
		     	include('head.php');
		     ?>
		     <div class="middle">
		     	<h3 align="center">IT论坛</h3>
		     	<div class="right">
		     		<?php 
		     			while($row=mysql_fetch_array($sreg)){
								echo "<div class='mil'>";
								echo "<a><center>"."标题:".$row['biaoti']."</center></a>";
								echo "<a>"."用户名:".$row['xname']."</a>"."<br/>";
								echo "<img src='".$row['path']." ' width='100' height='80' style='float:left;' />";
								echo "<div class='kk''>".$row['xinxi']."</div>"."<br/>";
								echo "<div style='clear:both;'></div>";
								echo "<p style='float:right'>"."发表时间:".$row['date']."</p>"."<br/>";
								echo "<div style='clear:both;'></div>";
								echo "&nbsp;&nbsp;";
								echo "<br/>";echo "<br/>";
								echo "</div>";
		     			}	
		     		?>
		     		<p>
				 		<?php
				 		echo "<center>";
				 		 if($page==1)
						 {
						 	echo "首页&nbsp&nbsp";
						 }
						 else{
						 	echo "<a href=liuyan.php?page=1>首页&nbsp&nbsp</a>";
						 }
						  if($page==1)
						 {
						 	echo "上一页&nbsp&nbsp";
						 }
						 else{
						 	echo "<a href=liuyan.php?page=".($page-1).">上一页&nbsp&nbsp</a>";
						 }
						   if($page==$pagenum)
						 {
						 	echo "下一页&nbsp&nbsp";
						 }
						 else
							 {
							 	echo "<a href=liuyan.php?page=".($page+1).">下一页&nbsp&nbsp</a>";
							 }
						  if($page==$pagenum)
							 {
							 	echo "末页&nbsp&nbsp";
							 }
						 else
							 {
							 	echo "<a href=liuyan.php?page=".$pagenum.">末页&nbsp&nbsp</a>";
							 }
							echo "</center>"; 
				 		?>
				 	</p>	
				 	<br />
		     	</div>
		     	<div class="left">
			     	<form action="" method="post">
			     		<table width="100%" align="center">
			     			<tr>
			     				<td>表题:</td>
			     				<td><input type="text" name="zhuti" /></td>
			     			</tr>
			     			<tr>
			     				<td>内容:</td>
			     				<td><textarea name="text" rows="7" cols="80"></textarea></td>
			     			</tr>
			     			<tr>
			     				
			     				<td></td>
			     				<td><input type="submit" name="submit" value="发表" /></td>
			     			</tr>
			     		</table>
			     	</form>	
		     	</div>	
		     </div>
		     <div style="clear: none;"></div>
		     <?php
		     	include('footer.php');
	   		  ?>
	</body>
</html>