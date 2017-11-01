<!DOCTYPE html>
<?php session_start(); ?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>博客全文阅读</title>
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

		<!-- 正文部分 第二个row -->
		<div class="row clearfix">
			<!-- 左侧边部分 -->
			<div class="col-md-2 column">
			</div>

			<!-- 中间主要内容部分 -->
			<div class="col-md-8 column">				
				<div class="row clearfix">
					<!-- 中间左侧博客正文详情 -->
					<div class="col-md-8 column">
						<div class="row clearfix">
							<div class="col-md-12 column">
								<!-- 根据博文Id查询博客内容 -->
								<?php
									$postid = $_GET['id'];
									
									$sql = "SELECT * FROM post WHERE postId = '$postid'";
									$result = mysql_query($sql);
									$row = mysql_fetch_array($result);
									// echo $postid.$row['title'];
								?>
								<h3>
									<?php echo $row['title']; ?>
								</h3>
								
								<p>
									<a onclick="plus('like', '<?php echo($row['postId']) ?>')" class="btn"><span class="glyphicon glyphicon-heart"></span>喜欢(<?php echo $row['likes']; ?>)</a>
									<a class="btn" href="#"><span class="glyphicon glyphicon-eye-open"></span>阅读量(<?php echo $row['readings']; ?>)</a>
									<a onclick="scrollToComment()" class="btn"><span class="glyphicon glyphicon-comment"></span><?php echo "评论("; echo getComments($row['postId']); echo ")"; ?></a>
								</p>

								<hr>								
								<p style="text-indent: 2em; font-size: 12pt; line-height: 20pt">
									<?php echo $row['content']; ?>
								</p>

								<br>
								<blockquote>
									<p>
										<small>										
											<cite>Alex</cite> 发表于 <?php echo $row['releasetime']; ?><br>最后更新于 <?php echo $row['edittime']; ?>										
										</small>
									</p>
								</blockquote>
								<br>

								
								<ul class="pager">
									<li id="prePostBtn" class="previous" style="display: block;"><a href="prepost.php?id=<?php echo($postid) ?>&dt=<?php echo $row['releasetime']; ?>" >&larr; 上一篇</a></li>
									<li id="nextPostBtn" class="next" style="display: block;"><a href="nextpost.php?id=<?php echo($postid) ?>&dt=<?php echo $row['releasetime']; ?>" >下一篇 &rarr;</a></li>
								</ul>

								<?php
									if ($postid == getLatestPostid())
									{
										echo "<script>nonePre();</script>";
									}
									else if ($postid == getOldestPostid())
									{
										echo "<script>noneNext();</script>";
									}
								?>

								<hr>

							</div>
						</div>

						<!-- 评论部分 -->
						<div class="row clearfix">
							<div class="col-md-12 column">
								<h3>
									<cite>
										<?php getComments($postid) ?>条评论
										<!-- <div>
											———————————
										</div> -->
									</cite>
								</h3>
								<hr>
								<?php 
									$sql = "SELECT * FROM comments WHERE postid = '$postid' ORDER BY commenttime ASC";//最新评论在底部
									$result = mysql_query($sql);
									$commentCounts = mysql_num_rows($result);
									$j = 0;
									if ($commentCounts != 0)
									{
										while ( $row = mysql_fetch_array($result))
										{
											$j++;
											// echo "<div class="row clearfix"><div class="col-md-3 column"><img alt="140x140" src="3/default3.jpg" /></div><div class="col-md-9 column"><h2>$row['commentator'] | $row['commenttime']</h2><p>$row['comment']</p><p><a class="btn" href="">回复</a></p></div></div>";
											echo "<div class='row clearfix'>";
											echo "<div class='col-md-2 column'>";
											// echo "<img class='img-circle' alt='120x120' src='img/userpic".$j.".jpg' width='65px' /></div>";
											echo "<img alt='120x120' src='img/userpic".$j.".jpg' width='65px' /></div>";
											echo "<div class='col-md-10 column'>";
											echo "<h4>".$row['commentator']." | <small><cite>".$row['commenttime']." | ".$j."#</cite><a class='btn' href='#'>回复</a></small></h4>";
											echo "<p><cite>".$row['comment']."</cite></p>";
											echo "<br></div></div>";
										}
									}
								?>
							</div>
						</div>
						<br>

						<!-- 发表评论部分 -->
						<div id="commentDiv" class="row clearfix">
							<div class="col-md-12 column">
								<h3>
									<cite>
										发表评论
										<!-- <div>
											———————————
										</div> -->
									</cite>
								</h3>
								<hr>
								<div id="loginTip" class="alert alert-dismissable alert-warning">
									<h4>
										您需要<a class="alert-link" data-toggle="modal" data-target="#login" href="">登录</a>后才可以评论~
									</h4>
								</div>
								<form id="commentForm" class="form-group" style="display: none;" onsubmit="return commentsPost()" action="commentspost.php" method="post">
									<textarea class="form-control" name="comment" id="comment" cols="45" rows="5" placeholder="Leave a reply……"></textarea>
									<input type="text" name="ip_username" id="ip_username" style="display: none;" value="<?php echo($crtuser) ?>">
									<input type="text" name="postid" id="postid" style="display: none;" value="<?php echo($postid) ?>">
									<br>
									<p class="text-right"><button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> 提交评论</button></p>
								</form>

								<div id="commentWarning" style="display: none;" class="alert alert-dismissable alert-warning">
									<!-- <button type="button" class="close" data-dismiss="aria-hidden" aria-hidden="true">×</button> -->
									<h4>
										注意!
									</h4> <strong>Warning!</strong> 评论内容不能为空！
								</div>

								<?php 
									if (isset($_SESSION['username']))
									{
										echo "<script>allowComment('TRUE');</script>"; 
									}
									else
									{
										echo "<script>allowComment('FALSE');</script>";
									}
								 ?>
									<!-- </div> -->
									<!-- <div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label">评论内容</label>
										<div class="col-sm-10">
											<input type="email" class="form-control" id="inputEmail3" />
										</div>
									</div>
									<div class="form-group">
										<label for="inputPassword3" class="col-sm-2 control-label">Password</label>
										<div class="col-sm-10">
											<input type="password" class="form-control" id="inputPassword3" />
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-offset-2 col-sm-10">
											<div class="checkbox">
												<label><input type="checkbox" />Remember me</label>
											</div>
										</div>
									</div> -->
									<!-- <div class="form-group">
										<div class="col-sm-offset-2 col-sm-10">
											<button type="submit" class="btn btn-default">Sign in</button>
										</div>
									</div> -->
								
								<!-- <div class="row clearfix">
									<div class="col-md-6 column">
										<button type="button" class="btn btn-default btn-primary">发表</button>
									</div>
									<div class="col-md-6 column">
										<button type="button" class="btn btn-default btn-primary">取消</button>
									</div>
								</div> -->
							</div>
						</div>
					</div>

					<!-- 中间右侧面板 -->
					<?php include 'rightpostlist.php'; ?>
				</div>
			</div>

			<!-- 右侧边部分 -->
			<div class="col-md-2 column">
			</div>
		</div>
		
<?php include 'footer.php'; ?>