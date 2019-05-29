<?php
	
	if(isset($_POST['submit'])){
		$xname=$_POST['xname'];
		$xsex=$_POST['xsex'];
		$xpwd=md5($_POST['xpwd']);
		$xage=$_POST['xage'];
		$xcid=$_POST['xcid'];
		$xemail=$_POST['xemail'];
		$xaddress=$_POST['xaddress'];
		$xtel=$_POST['xtel'];
		$filename='';
		$arr=$_FILES['path'];//接收图片上传
		if(($arr["type"]=="image/png" || $arr["type"]=="image/jpeg") && $arr["size"]<102400){
			$filename="./upload/image/".date("YmdHis").$arr["name"];
			if(file_exists($filename)){
				echo "已存在";
			}else{
				move_uploaded_file($arr["tmp_name"],$filename);
			}
		}
		$sql="insert into huiyuan(xname,xpwd,xsex,xage,xcid,xemail,xaddress,xtel,path) values('$xname','$xpwd','$xsex',$xage,'$xcid','$xemail','$xaddress',$xtel,'$filename')";
		include "conn.php";
		$result=mysql_query($sql);
		if(!$result){
			die('注册失败'.mysql_error());
		}else{
			echo "<script>alert('注册成功');window.location.href='login.php';</script>";
		}
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
	<body background="img/banner2.jpg">
		<?php include('head.php') ?>
			<div style="margin-top: 30px;"></div>
			<form action="register.php" method="post" enctype="multipart/form-data">
				<table align="center">
					<tr>
						<td>姓名:</td><td><input type="text" name="xname" /></td>
					</tr>
					<tr>
						<td>密码:</td><td><input type="password" name="xpwd" /></td>
					</tr>
					<tr>
						<td>性别:</td><td><input type="radio" value="男" name="xsex" checked="checked" />&nbsp;男<input type="radio" value="女" name="xsex" />&nbsp;女</td>
					</tr>
					<tr>
						<td>年龄:</td><td><input type="number" name="xage" min="16" max="23" /></td>
					</tr>
					<tr>
						<td>身份证:</td><td><input type="text" name="xcid" /></td>
					</tr>
					<tr>
						<td>邮箱:</td><td><input type="email" name="xemail" /></td>
					</tr>
					<tr>
						<td>地址:</td><td><input type="text" name="xaddress" /></td>
					</tr>
					<tr>
						<td>电话:</td><td><input type="number" name="xtel" /></td>
					</tr>
					<tr>
						<td>头像:</td>
						<td><input type="file" name="file" /></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" name="submit" value="注册" /><button><a href="login.php">登录</a></button></td>
					</tr>
				</table>
			</form>
			<div style="margin-top: 30px;"></div>
		<?php include('footer.php') ?>	
	</body>
</html>
