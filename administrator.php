<!DOCTYPE html>
<?php session_start(); ?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>后台管理</title>
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
	<!-- 左侧边部分 -->
	<div class="col-md-1 column">
	</div>

	<div class="col-md-10 column">
		<div class="tabbable" id="tabs-717492">
			<ul class="nav nav-tabs">
				<li class="active">
					<a href="#panel-usermanage" data-toggle="tab">用户管理</a>
				</li>
				<li>
					<a href="#panel-postmanage" data-toggle="tab">博文管理</a>
				</li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="panel-usermanage">
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th>用户名</th>
								<th>密码</th>
								<th>邮箱</th>
								<th>注册时间</th>
								<th>操作</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$ul_sql = "SELECT * FROM user ORDER BY regtime ASC";
								$result = mysql_query($ul_sql);
								$user_counts = mysql_num_rows($result);

								for ($i = 0; $i < $user_counts; $i++)
								{
									$user_row = mysql_fetch_array($result);
									echo "<tr><td>".$user_row['username']."</td>";
									echo "<td>".$user_row['pwd']."</td>";
									echo "<td>".$user_row['email']."</td>";
									echo "<td>".$user_row['regtime']."</td>";
									echo "<td>";
									// echo "<a onClick='deleteConfirm('deleteuser.php?username=".$user_row['username']."'); return false;' title='删除用户' >";
									// echo "<a href='deleteuser.php?username=".$user_row['username']."' title='删除用户' >";
									// echo "<a onClick='deleteConfirm('deleteuser.php?username=".$user_row['username']."')' data-toggle='modal' data-target='#deleteConfirmModel' href='' title='删除用户' >";
									// echo "<button onClick='deleteConfirm(deleteuser.php?username=".$user_row['username'].")' title='删除用户' >";
									$url="deleteuser.php?username=".$user_row['username'];
									echo "<a onclick='deleteConfirm(\"$url\");' data-toggle='modal' data-target='#deleteConfirmModel' href='' title='删除用户'>";
									echo "<span class='glyphicon glyphicon-remove'></span> 删除</a>";
									echo "</td></tr>";
								}
							?>
						</tbody>
					</table>					
				</div>
				<div class="tab-pane" id="panel-postmanage">
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th>标题</th>
								<th>简介</th>
								<th>发表时间</th>
								<th>修改时间</th>
								<th>阅读</th>
								<th>喜欢</th>
								<th>评论</th>
								<th>操作</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$pl_sql = "SELECT * FROM post ORDER BY releasetime ASC";
								$result = mysql_query($pl_sql);
								$post_counts = mysql_num_rows($result);

								for ($i = 0; $i < $post_counts; $i++)
								{
									$post_row = mysql_fetch_array($result);
									echo "<tr><td><a href='readingblog.php?id=".$post_row['postId']."' title='".$post_row['abstract']."…' >".$post_row['title']."</a></td>";
									echo "<td>".$post_row['abstract']."</td>";
									echo "<td>".$post_row['releasetime']."</td>";
									echo "<td>".$post_row['edittime']."</td>";
									echo "<td>".$post_row['readings']."</td>";
									echo "<td>".$post_row['likes']."</td>";
									echo "<td>";
									getComments($post_row['postId']);
									echo "</td>";
									echo "<td>";
									echo "<ul><a href='editblog.php?id=".$post_row['postId']."' title='编辑博文' ><span class='glyphicon glyphicon-pencil'></span> 编辑</a>";
									$url="deletepost.php?id=".$post_row['postId'];
									echo "<a onclick='deleteConfirm(\"$url\");' data-toggle='modal' data-target='#deleteConfirmModel' href='' title='删除博文'>";
									echo "<span class='glyphicon glyphicon-remove'></span> 删除</a></ul></td></tr>";
									echo "</td></tr>";
								}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<!-- 删除确认对话框 -->
		<div class="modal fade" id="deleteConfirmModel" tabindex="-1">  
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button class="close" data-dismiss="modal">
							<span>&times;</span>
						</button>
						<h4 class="text-center">删除确认</h4>
						<input id="deleteurl" type="hidden">
					</div>
					<div class="modal-body">  
						<p>您确认要删除吗？</p>  
					</div>  
					<div class="modal-footer text-right">
						<a onclick="deleteurlSubmit()"; class="btn btn-success" >确认</a>
						<!-- <a onclick="deleteurlSubmit()"; class="btn btn-success" href='deleteuser.php?username=<?php echo($user_row['username']) ?>' >确认</a> -->
						<button class="btn btn-danger" data-dismiss="modal">取消</button>
					</div>
				</div><!-- /.modal-content -->  
			</div><!-- /.modal-dialog -->  
		</div><!-- /.modal -->  

		<!-- <ul class="pagination">
			<li><a href="#">Prev</a></li>
			<li><a href="#">1</a></li>
			<li><a href="#">2</a></li>
			<li><a href="#">3</a></li>
			<li><a href="#">4</a></li>
			<li><a href="#">5</a></li>
			<li><a href="#">Next</a></li>
		</ul> -->
	</div>

	<!-- 右侧边部分 -->
	<div class="col-md-1 column">
	</div>
</div>

<?php include 'footer.php'; ?>