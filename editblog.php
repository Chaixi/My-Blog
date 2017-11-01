<!DOCTYPE html>
<?php session_start(); ?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>博文编辑</title>
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
	<?php include 'mysqlconnect.php'; ?>
</head>

<?php include 'pageheader.php'; ?>

<div class="row clearfix">
	<!-- <br> -->
	<!-- 中间部分左侧边 -->
	<div class="col-md-2 column">
	</div>

	<!-- 博文编辑部分 -->
	<div class="col-md-8 column">
		<div class="row clearfix">
			<div class="col-md-12 column">
				<h3>
					博文编辑
				</h3>
				<hr>
				<br>				
				<form class="form-horizontal" onsubmit="return checkPost()" action="savePost.php" method="post">
					<div class="form-group">
						<label for="inputtitle" class="col-sm-2 control-label">博文标题：</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="inputtitle" id="inputtitle" value="" placeholder="请输入博文标题……" />
							<!-- 当前编辑博客的id，默认为新增博客，值为0 -->
							<input class="form-control" type="hidden" name="editid" id="editid" value="0">
						</div>
					</div>
					<div class="form-group">
						<label for="inputabstract" class="col-sm-2 control-label">博文简介：</label>
						<div class="col-sm-10">
							<textarea class="form-control" name="inputabstract" id="inputabstract" cols="30" rows="2" placeholder="请输入博文简介，建议不超过30字……"></textarea>
						</div>
					</div>
					<div class="form-group">
						<label for="inputreleasetime" class="col-sm-2 control-label">发布时间：</label>
						<div class="col-sm-10">
							<input type="text" readonly="true" class="form-control" name="inputreleasetime" id="inputreleasetime" placeholder="系统自动获取当前时间……" />
						</div>
					</div>
					<div class="form-group">
						<label for="inputedittime" class="col-sm-2 control-label">最近修改时间：</label>
						<div class="col-sm-10">
							<input type="text" readonly="true" class="form-control" name="inputedittime" id="inputedittime" placeholder="系统自动获取当前时间……" />
						</div>
					</div>
					<div class="form-group">
						<label for="inputpost" class="col-sm-2 control-label">博文内容：</label><br>
						<div class="col-sm-10">
							<textarea class="form-control" name="inputpost" id="inputpost" cols="30" rows="18" placeholder="编辑博文内容……"></textarea>
						</div>
					</div>
					
					<!-- 阅读权限 -->
					<!-- <div class="form-group">
						<label class="col-sm-2 control-label">阅读权限：</label>
						<div class="col-sm-offset-2 col-sm-10">
							<div class="checkbox">
								<input type="checkbox" />仅自己可见
							</div>
						</div>
					</div> -->
					<!-- 博文标签 -->
					<!-- <span class="label label-default">标签</span> -->
					<div class="form-group">						
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-primary"><!-- <span class="glyphicon glyphicon-ok"></span> --> 发  表</button>
							<button type="" class="btn btn-primary"><!-- <span class="glyphicon glyphicon-remove"></span> --> 取  消</button>
						</div>
					</div>
				</form>

				<?php 
					$editid = $_GET['id'];
					// 博客编辑
					if ($editid != 0)
					{
						$sql = "SELECT * FROM post WHERE postId='$editid'";
						$result = mysql_query($sql);
						$editpost = mysql_fetch_array($result);
						$title = str_replace("'", "\'", $editpost['title']);
						$abstract = str_replace("'", "\'", $editpost['abstract']);
						$content = str_replace("'", "\'", $editpost['content']);
						echo "<script>editPost('$editid', '".$title."', '".$abstract."', '".$editpost['releasetime']."', '".$editpost['edittime']."', '".$content."')</script>";
						// echo "<script>editPost($editid, '".$editpost['title']."', '".$editpost['abstract']."', '".$editpost['releasetime']."', '".$editpost['edittime']."', '".$editpost['content']."')</script>";
					}
				 ?>

			</div>
		</div>
	</div>

	<!-- 中间部分右侧边 -->
	<div class="col-md-2 column">
	</div>
</div>

<?php include 'footer.php'; ?>