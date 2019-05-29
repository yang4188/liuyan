<?php
 include('conn.php');
 session_start();
 if(isset($_GET['id'])){
 	$id=$_GET['id'];
	$usql="select biaoti,xinxi,id from liuyan where id=$id";
	$ure=mysql_query($usql);
	$rows=mysql_fetch_array($ure);
 }
if(isset($_POST['submit'])){
 	$id=$_POST['id'];
	$biaoti=$_POST['biaoti'];
	$text=$_POST['text'];
	$sql="update liuyan set biaoti='$biaoti',xinxi='$text' where id='$id'";
	$result=mysql_query($sql);
	if($result){
			echo "<script>alert('修改成功');window.location.href='xiangxi.php?id=".$_SESSION['id']."';</script>";
		}
		else{
			exit(mysql_error());
		}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title></title>
	</head>
	<body background="img/banner2.jpg">
		<form method="post" action="updateliu.php" enctype="multipart/form-data">
			<h3 align="center">修改论坛</h3>
			<table align="center">  
				<tr>
					<td>标题:</td>
					
					<td><input type="hidden" name="id" value="<?php echo $rows[2]; ?>" ><input type="text" name="biaoti" required="required" value="<?php echo $rows[0]; ?>" /></td>
				</tr>
				<tr>
					<td>内容:</td>
					<td><textarea name="text" rows="7" cols="80" required="required" ><?php echo $rows[1]; ?></textarea></td>
				</tr>
				
				<tr>
					<td><input type="submit" name="submit" value="确定" /></td>
					<td></td>
				</tr>
			</table>
		</form>
		<div style="height: 40px;"></div>
		<?php include('footer.php'); ?>
	</body>
</html>
