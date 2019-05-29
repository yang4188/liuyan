<?php
	session_start();
	include('conn.php');
	if(isset($_GET['id'])){
	$xid=$_GET['id'];
	$regs=mysql_query("delete from liuyan where id=$xid");
	if($regs)
	{
		echo "<script>alert('删除成功');window.location.href='xiangxi.php';</script>";
	}
}
?>