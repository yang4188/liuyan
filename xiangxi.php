<?php
include('conn.php');
session_start();
if(!isset($_SESSION["xname"])){
		echo "<script>alert('你还没有登录');window.location.href='login.php';</script>";
	}
$uid=$_GET['id'];
$sql="select * from huiyuan where ID=$uid";
$reg=mysql_query($sql);


$sql1="select * from liuyan where hid=$uid";
$sreg=mysql_query($sql1);
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
$sql1="select a.*,b.xname,b.path from liuyan as a,huiyuan as b where a.hid=$uid and a.hid = b.id order by a.id desc limit {$start},{$pagesize}";
$sreg=mysql_query($sql1);

$sql2="select * from liuyan where hid=$uid";
$reg2=mysql_query($sql2);
$rows=mysql_num_rows($reg2);
$pagenum=ceil($rows/$pagesize);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title></title>
				<style>
			a{
				text-decoration: none;
				color: black;
			}
			.liuyan{width: 70%;float: left;}
			.mil{border: 1px solid; margin-top: 20px;}
			.kk{float:left;width: 600px;margin-left: 5%;height: 80px;}
		</style>
	</head>
	<body background="img/banner2.jpg">
		<?php include('head.php') ?>
			<div style="height: 50px;"></div>
			<h3 align="center">个人中心</h3>
			<div style="width: 200px;margin-left:30px;font-size: 22px;float: left;font-weight: bold;">
			<table>
					<?php
					while($row=mysql_fetch_array($reg)){
								echo "<tr>"."编号:".$row['ID']."</tr>"."<br/>";
								echo "<br/>";
								echo "<img src='".$row['path']." ' width='100' height='80' /><br/>";						echo "<br/>";
								echo "<tr><a>"."用户名:".$row["xname"]."</a></tr>"."<br/>";
								echo "<br/>";
								echo "<tr>"."性别:".$row['xsex']."</tr>"."<br/>";
								echo "<br/>";
								echo "<tr>"."年龄:".$row['xage']."</tr>"."<br/>";
								echo "<br/>";
								echo "<tr>"."邮箱:".$row['xemail']."</tr>"."<br/>";
								echo "<br/>";
								echo "<tr>"."电话:".$row['xtel']."</tr>"."<br/>";
								echo "<br/>";
								echo "<tr><a href='update.php?uid=".$row['ID']." '>修改</a></tr>";
					}	
					?>
				</table></div>
				<div class="liuyan">
					<div>
					<?php 	
		     			while($row=mysql_fetch_array($sreg)){
		     				if($row['hid']==$_SESSION['id'])
								{
								echo "<div class='mil'>";
								echo "<a><center>"."标题:".$row['biaoti']."</center></a>";
								echo "<a>"."用户名:".$row['xname']."</a>"."<br/>";
								echo "<img src='".$row['path']." ' width='100' height='80' style='float:left;' />";
								echo "<div class='kk'>".$row['xinxi']."</div>"."<br/>";
								echo "<div style='clear:both;'></div>";
								echo "<p style='float:right'>"."发表时间:".$row['date']."</p>"."<br/>";
								echo "<div style='clear:both;'></div>";
								 echo "<a style='float:right;margin-right:20px;' href='delete.php?id=".$row['id']."' >删除</a>";
								 echo "<a style='float:right;margin-right:20px;' href='updateliu.php?id=".$row['id']."' >修改</a>";
								echo "&nbsp;&nbsp;";
								echo "<br/>";echo "<br/>";
								echo "</div>";
								}
		     			}	
		     		?>
		     		<p>
				 		<?php
				 		echo "<center>";
				 		 if($page==1)
						 {
						 	echo "首页&nbsp;&nbsp;";
						 }
						 else{
						 	echo "<a href='xiangxi.php?page=1&id=".$uid."'>首页&nbsp;&nbsp;</a>";
						 }
						  if($page==1)
						 {
						 	echo "上一页&nbsp&nbsp";
						 }
						 else{
						 	echo "<a href='xiangxi.php?page=".($page-1)."&id=".$uid."'>上一页&nbsp&nbsp</a>";
						 }
						   if($page==$pagenum)
						 {
						 	echo "下一页&nbsp&nbsp";
						 }
						 else
							 {
							 	echo "<a href='xiangxi.php?page=".($page+1)."&id=".$uid."'>下一页&nbsp&nbsp</a>";
							 }
						  if($page==$pagenum)
							 {
							 	echo "末页&nbsp&nbsp";
							 }
						 else
							 {
							 	echo "<a href='xiangxi.php?page=".$pagenum."&id=".$uid."'>末页&nbsp&nbsp</a>";
							 }
							echo "</center>";
								
				 		?>
				 	</p>
				 	<br />
				 	</div>
				</div>
				<div style="height: 50px;clear:both;"></div>
		<?php include('footer.php') ?>	
	</body>
</html>
