<?php
		include('conn.php');
		session_start();
		@$name=$_SESSION['xname'];
		@$uid=$_SESSION['id'];
		$sql1="select * from liuyan where id=$uid";
		$sreg=mysql_query($sql1);
		if(isset($_GET["page"]))
		{
			$page=$_GET["page"];
		}
		else
		{
			$page=1;
		}
		$pagesize=2;	//每页显示的数量
		$start=($page-1)*$pagesize;//从那条数据开始
		$sql1="select a.*,b.xname,b.path from liuyan a,huiyuan b where a.hid = b.id order by a.id desc limit {$start},{$pagesize}";
		$sreg=mysql_query($sql1);
		
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title></title>
		<style>
			.index{width:100%;}
.middle{width: 100%;
		background-color: beige;}
.mdiv{width: 15%;                                                        
 	  height: 340px;
 	  margin-left:10%;
 	  float: left;}
.mul{list-style: none;margin: 0;padding: 0;}
.mul li{text-align: center;line-height: 40px;}
a{text-decoration: none;color: black;}
.mil{width: 90%;height: 150px; margin-left: 5%;}
		</style>
	</head>
	<body>
		<div style="float: right;">欢迎光临:<?php echo $name=='' ? "<a href='login.php'>请先登录</a>" : $name ?>
			&nbsp;&nbsp;<?php echo $name=='' ? "" : "<a href='xiangxi.php?id=".$_SESSION['id' ]."'>个人中心</a>" ?>
			&nbsp;&nbsp;<?php echo $name=='' ? "" : "<a href='liuyan.php'>留言板</a>" ?>
			&nbsp;&nbsp;<?php echo $name=='' ? "" : "<a href='exit.php'>退出登录</a>" ?>
		</div>
		<?php include('head.php') ?>
			<div class="top">
				<img src="img/banner2.jpg" style="width: 100%;" />
				<h1 align="center">专为前段而研制的核心产品</h1>
			<div class="middle">
				
				<div class="mdiv">
					<ul class="mul">
						<li><img src="img/Big_icon2.png" /></li>
						<li>JS基础库</li>
						<li>从小阿斯利康的房价。是因为而快乐就好谁哦就，发射计划房间看电视了。</li>
						<li>水电费离开。</li>
					</ul>
				</div>
				<div class="mdiv">
					<ul class="mul">
						<li><img src="img/Big_icon3.png" /></li>
						<li>JS基础库</li>
						<li>从小阿斯利康的房价。是因为而快乐就好谁哦就，发射计划房间看电视了。</li>
						<li>水电费离开。</li>
					</ul>
				</div>
				<div class="mdiv">
					<ul class="mul">
						<li><img src="img/Big_icon4.png" /></li>
						<li>JS基础库</li>
						<li>从小阿斯利康的房价。是因为而快乐就好谁哦就，发射计划房间看电视了。</li>
						<li>水电费离开。</li>
					</ul>
				</div>
				<div style="width: 16%;border:1px solid ;padding-top: 15px;float:right;">
					<?php
						while($row=mysql_fetch_array($sreg)){
								echo "<div class='mil'>";
								echo "<table border='1'>";
								echo "<tr>";
									echo "<td><img src='".$row['path']."' width='100' height='60' /></td>";
									echo "<td style='font-size:10px'>"."标题:".$row['biaoti']."</td>";
								echo "</tr>";
								echo "<tr>";
									echo "<td>"."用户名:".$row['xname']."</td>";
									echo "<td style='font-size:10px'>".$row['date']."</td>";
								echo "</tr>";
								echo "</table>";
								echo "</div>";
						}	
					?>
					<div><a href="liuyan.php" style="float: right;">查看更多>></a></div>
				</div>
			</div>
			<div style="clear: both;"></div>
			</div>
		<?php include('footer.php') ?>	
	</body>
</html>
