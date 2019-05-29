<?php
	$conn=@mysql_connect("localhost","kp09b","kp09b") or die("连接失败".mysql_error());
	mysql_query("set names utf8");
	mysql_select_db("kp09b_zengxingxing_blog_201901",$conn);
?>