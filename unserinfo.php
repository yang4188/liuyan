<?php
	include('conn.php');
	if(isset($_GET["uid"])){
		$xid=$_GET["uid"];
		$sql="select xname,xcid,xage,xsex,xtel from huiyuan where ID=$xid";
		$infore=mysql_query($sql);
		$rows=mysql_fetch_array($infore);
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title></title>
		<style>
			a{text-decoration: none;color: black;}
		</style>
	</head>
	<body bgcolor="burlywood">
		<h1 align="center">个人信息</h1>
				<div align="center">
					<p>姓名:<?php echo $rows[0] ?></p>
					<p>年龄:<?php echo $rows[2] ?></p>
					<p>性别:<?php echo $rows[3] ?></p>
					<p>电话:<?php echo $rows[4] ?></p>
					<p><a href="javascript:history.go(-1);">返回上一页</a></p>
				</div>
		<?php include("footer.php"); ?>
	</body>
</html>
