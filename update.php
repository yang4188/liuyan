<?php
	include('conn.php');
	if(isset($_POST['submit'])){
		$xname=$_POST['xname'];
		$xsex=$_POST['xsex'];
		$xage=$_POST['xage'];
		$xemail=$_POST['xemail'];
		$xtel=$_POST['xtel'];
		$uid=$_POST['id'];
		$filename='';
		$arr=$_FILES['file'];  
		$imsql=''; 
		if(!empty($arr["name"])){
			if(($arr["type"]=="image/png" || $arr["type"]=="image/jpeg")  && $arr["size"]<102400){
				$filename="./upload/image/".date("YmdHis").$arr["name"];
				if(file_exists($filename)){
					echo "已存在";
				}else{
					move_uploaded_file($arr["tmp_name"],$filename);
				}
			}
			$imsql="update huiyuan set xname='$xname',xsex=$xsex,xage=$xage,xemail='$xemail',xtel='$xtel',path='$filename' where ID='$uid' ";
		}
		else{
			$imsql="update huiyuan set xname='$xname',xsex=$xsex,xage=$xage,xemail='$xemail',xtel='$xtel' where ID='$uid' ";
		}
		$results=mysql_query($imsql);
		if($results){
			echo "<script>alert('修改成功');window.location.href='xiangxi.php?uid=".$uid."';</script>";
		}
		else{
			exit(mysql_error());
		}
	}	
	if(isset($_GET['uid'])){
		$uid=$_GET['uid'];
		$usql="select xname,xsex,xage,xemail,xtel,ID,path from huiyuan where ID=$uid";
		$ure=mysql_query($usql);
		$rows=mysql_fetch_row($ure);
	}else{
		echo "跳转到index.php";
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
		<h1 align="center">修改信息</h1>
		<form action="update.php" method="post" enctype="multipart/form-data">
			<input type="hidden" name="id" value="<?php echo $rows[5]; ?>" />
			<table align="center">
				<tr>
					<td>头像:</td>
					<td><input type="file" name="file"  /></td>
				</tr>
				<tr>
					<td>用户名:</td>
					<td><input type="text" name="xname" required="required" value="<?php echo $rows[0] ?>" /> </td>
				</tr>
				<tr>
					<td>性别:</td>
					<td><input type="radio" name="xsex" value="1" <?php echo $rows[1]==1 ? "checked" : "" ; ?> />男&nbsp;<input type="radio" name="xsex" value="0" <?php echo $rows[1]==0 ? "checked" : ""; ?> />女&nbsp;</td>
				</tr>
				<tr>
					<td>年龄:</td>
					<td><input type="text" name="xage" required="required" value="<?php echo $rows[2]; ?>" /> </td>
				</tr>
				<tr>
					<td>邮箱</td>
					<td><input type="email" name="xemail" required="required" value="<?php echo $rows[3]; ?>" /></td>
				</tr>
				<tr>
					<td>电话:</td>
					<td><input type="text" required="required" name="xtel" value="<?php echo $rows[4]; ?>" /></td>
				</tr>
				<tr align="center"><td colspan="2"><input type="submit" name="submit" value="修改" /><button><a href="javascript:history.go(-1)">返回</a></button></td>
				</tr>
			</table>
		</form>
		<?php include('footer.php') ?>		
	</body>
</html>
