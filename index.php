<!DOCTYPE html>
<?php session_start(); ?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>国庆培训七天乐</title>
	<link rel="icon" href="img/guoqing.ico" type="image/x-icon"/>
	<link rel="stylesheet" type="text/css" href="css/alexblog.css">

	<!-- 引入 Bootstrap -->
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<!-- jQuery (Bootstrap 的 JavaScript 插件需要引入 jQuery) -->
	<script src="https://code.jquery.com/jquery.js"></script>
	<!-- 包括所有已编译的插件 -->
	<!-- <script src="js/bootstrap.min.js"></script> -->
	<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
	<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/alexblog.js" charset="utf-8"></script>
	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
	<?php include 'mysqlconnect.php'; ?>	
</style>
</head>

<?php include 'pageheader.php'; ?>
		<!-- 正文部分 第二个row -->
		<div class="row clearfix">
			<!-- 左侧边部分 -->
			<div class="col-md-2 column">
			</div>

			<!-- 中间主要内容部分 -->
			<div class="col-md-8 column">
				<div class="row clearfix">
					<!-- 中间左侧博客列表 -->
					<div id="postlist" class="col-md-8 column">
						<?php 
						$sql = "SELECT * FROM post ORDER BY releasetime DESC";
						$postResult = mysql_query($sql);
						$counts = mysql_num_rows($postResult);
						$j = 0;
						while ( $row = mysql_fetch_array($postResult)) {
							$j++;
						?>
						
						<h3>
							<?php echo "<a onclick=\"plus('read', '".$row['postId']."')\" class='a-title' href='readingblog.php?id=".$row['postId']."'>".$row['title']."</a>"; ?>
						</h3>
						<!-- <p align="text-right" style="color: gainsboro"><span><?php echo $row['releasetime']."post by Alex"; ?></span></p> -->
						<p>
							<span><?php echo $row['abstract']."…"; ?></span>
						</p>
						<p>
							<a onclick="plus('like', '<?php echo($row['postId']) ?>')" class="btn"><span class="glyphicon glyphicon-heart"></span><?php echo " 喜欢(".$row['likes'].")"; ?></a>
							<a class="btn"><span class="glyphicon glyphicon-comment"></span><?php echo " 评论("; echo getComments($row['postId']); echo ")"; ?></a>
							<a onclick="plus('read', '<?php echo($row['postId']) ?>')" class="btn" href="readingblog.php?id=<?php echo($row['postId']) ?>"><span class="glyphicon glyphicon-eye-open"></span><?php echo " 阅读全文(".$row['readings'].") »"; ?></a>
						</p>
						<hr>
						
						<?php 
						}
						?>

						<!-- 静态博客列表 -->
						<!-- <div>
							<h3>
								编程之美，博客入门
							</h3>
							<p>
								<span>增强学生突击完成短期目标能力，激发实践潜能；增强学生网络编程的能力，训练开发思路与技巧；奠基学生对实验室在建网项目上的基础，为实验室今后的相关项目预做指引……</span>
							</p>
							<p>
								<a class="btn" href="#">喜欢()</a>
								<a class="btn" href="#">评论()</a>
								<a class="btn" href="#">阅读全文() »</a>
							</p>
							<h3>
								国庆七天乐小记
							</h3>
							<p>
								<span>增强学生突击完成短期目标能力，激发实践潜能；增强学生网络编程的能力，训练开发思路与技巧；奠基学生对实验室在建网项目上的基础，为实验室今后的相关项目预做指引……</span>
							</p>
							<p>
								<a class="btn" href="#">喜欢()</a>
								<a class="btn" href="#">评论()</a>
								<a class="btn" href="#">阅读全文() »</a>
							</p>
							<h3>
								编程之美
							</h3>
							<p class="MsoNormal">
								<span>推荐的学习网站：</span>
							</p>
							<p class="MsoNormal">
								<a href="http://www.w3school.com.cn/">http://www.w3school.com.cn/</a>
							</p>
							<p class="MsoNormal">
								<a href="http://www.runoob.com/bootstrap/bootstrap-tutorial.html">http://www.runoob.com/bootstrap/bootstrap-tutorial.html</a>
							</p>
							<p class="MsoNormal">
								<span>网上还有更多的相关的个人博客网站，可以参照里面的样式和功能</span>
							</p>
							<p>
								<a class="btn" href="#">喜欢()</a>
								<a class="btn" href="#">评论()</a>
								<a class="btn" href="#">阅读全文() »</a>
							</p> 
						</div> -->
					</div>

					<!-- 中间右侧博客列表部分 -->
					<?php include 'rightpostlist.php'; ?>
				</div>
			</div>

			<!-- 右侧边部分 -->
			<div class="col-md-2 column">
			</div>
		</div>

		<?php include 'footer.php'; ?>