<?php
	session_start();
	unset($_SESSION["xname"]);
	session_destroy();
	
	if(isset($_SESSION["xname"])){
		echo '退出失败';
	}
	else{
		echo "<script>alert('退出成功');window.location.href='index.php';</script>";
	}
?>