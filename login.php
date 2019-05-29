<?php
	session_start();
	@include 'conn.php';
	if(isset($_POST['submit'])){
		$xname=$_POST['xname'];
		$xpwd=md5($_POST['xpwd']);
		$xcode=$_POST['xcode'];
		if($xname && $xpwd){
			if($xcode==$_SESSION['authcode']){
				$sql="select ID,xname,xpwd from huiyuan where xname='$xname' and xpwd='$xpwd' ";
				
				$result=mysql_query($sql);
				$row=mysql_fetch_row($result);
			
				if($row){
						$_SESSION['xname']=$xname;
						$_SESSION['id']=$row[0];
					echo "<script>alert('登录成功".$row[0]."');window.location.href='index.php';</script>";
				}else{
					echo "<script>alert('登录失败,密码或用户错误');window.location.href='login.php';</script>";
				}
			}else{
				echo "<script>alert('登录失败,验证码错误');window.location.href='login.php';</script>"; 
			}
		}else{
			echo "<script>alert('登录失败');window.location.href='login.php';</script>";
		}		
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title></title>
		<style>
			.login{width: 30%;margin: 0 auto;}
		</style>
		
	</head>
	<body background="img/banner2.jpg">
		<div class="login">
			<form action="login.php" method="post">
				<table align="center" width="80%">
					<tr>
						<input type="hidden" name="id"  />
						<td style="color: lawngreen; font-size: 26px;font-weight: bold;">用户名:</td>
						<td><input type="text" name="xname" /></td>
					</tr>
					<tr>
						<td style="color: lawngreen;font-size: 26px;font-weight: bold;">密码:</td>
						<td><input type="password" name="xpwd" /></td>
					</tr>
					<tr>
						<td style="color: lawngreen;font-size: 26px;font-weight: bold;">验证码:</td>
						<td><input type="text" name="xcode" /></td>
					</tr>
					<tr>
						<td></td>
						<td><img src="code.php" onclick="this.src='code.php?nocache='+Math.random()" alt="点击换一张" /></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" value="登录" name="submit" /><button><a href="register.php" style="text-decoration: none;color: black;" />注册</a></button></td>
					</tr>
				</table>
			</form>
		</div>
	</body>
</html>