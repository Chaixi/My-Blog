<body>	
	<div class="container">
		<!-- 页头部分 第一个row -->
		<div class="row clearfix">
			<div class="col-md-10 column">
				<div class="header">
					<h1>
						<a class="a-title" href="index.php">国庆培训七天乐 <small><cite>网络编程之美--搭建个人博客</cite></small></a>
					</h1>
				</div>
			</div>

			<!-- 根据是否登录，判断显示内容 -->
			<div class="col-md-2 column">					
				<div>
					<?php
					if (isset($_SESSION['username']))
					{
						$crtuser = $_SESSION['username'];
						$crtrole = $_SESSION['role'];
						$loggedin = TRUE;
					}
					else
					{
						$loggedin = FALSE;
					}
					if ($loggedin) 
					{ 
						?>
						<ul class="nav navbar-nav navbar-right" style="display: block;">
							<li class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#">
									<span class="glyphicon glyphicon-user"></span> 欢迎您，<?php echo $crtuser; ?>
									<b class="caret"></b>
								</a>
								<ul class="dropdown-menu">
									<?php
									if ($crtrole == "admin")
									{
										echo "<li><a href='editblog.php?id=0'><i class='icon-cog'></i><span class='glyphicon glyphicon-edit'></span> 写博客</a></li>";
										echo "<li><a href='administrator.php'><i class='icon-envelope'></i><span class='glyphicon glyphicon-cog'></span> 后台管理</a></li>";
									}
									?>								
									<li class="divider"></li>
									<li><a href="logout.php"><i class="icon-off"></i><span class="glyphicon glyphicon-off"></span> 退出</a></li>
								</ul>
							</li>
						</ul>

						<?php }	else { ?>

						<ul id="loginandsignup" class="nav navbar-nav navbar-right" style="display: block;">
							<li><a data-toggle="modal" data-target="#register" href="">
								<span class="glyphicon glyphicon-user"></span> 注册</a>
							</li>
							<li><a onclick="test();" data-toggle="modal" data-target="#login" href="">
								<span class="glyphicon glyphicon-log-in"></span> 登录</a>
							</li>
						</ul>

						<?php } ?>					
					</div>

					<!-- 注册窗口 -->
					<div id="register" class="modal fade" tabindex="-1">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-body">
									<button class="close" data-dismiss="modal">
										<span>&times;</span>
									</button>
								</div>
								<div class="modal-title">
									<h1 class="text-center">注册</h1>
								</div>
								<div class="modal-body">
									<form class="form-group" id="regform" onsubmit="return regcheck()" action="register.php" method="post">
										<div class="form-group">
											<label for="">用户名</label>
											<input id="regusername" name="regusername" class="form-control" type="text" placeholder="6-15位字母或数字" required="true" autofocus="true">
										</div>
										<div class="form-group">
											<label for="">密码</label>
											<input id="regpwd1" name="regpwd1" class="form-control" type="password" placeholder="至少6位字母或数字" required="true">
										</div>
										<div class="form-group">
											<label for="">再次输入密码</label>
											<input id="regpwd2" name="regpwd2" class="form-control" type="password" placeholder="至少6位字母或数字" required="true">
										</div>
										<div class="form-group">
											<label for="">邮箱</label>
											<input id="regemail" name="regemail" class="form-control" type="email" placeholder="例如:123@123.com" required="true">
										</div>
										<div class="text-right">
											<button class="btn btn-primary" type="submit">提交</button>
											<button class="btn btn-danger" data-dismiss="modal">取消</button>
										</div>
										<a href="" data-toggle="modal" data-dismiss="modal" data-target="#login">已有账号？点我登录</a>
									</form>
								</div>
							</div>
						</div>
					</div>

					<!-- 登录窗口 -->
					<div id="login" class="modal fade" tabindex="0">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-body">
									<button class="close" data-dismiss="modal">
										<span>&times;</span>
									</button>
								</div>
								<!-- modal-headermodal-footer会有一条横线不好看，直接用modal-title -->
								<!-- <div class="modal-header">
									<h1 class="text-center">用户登录</h1>
								</div> -->
								<div class="modal-title">
									<h1 class="text-center">登录</h1>
								</div>
								<div class="modal-body">
									<form class="form-group" action="logincheck.php" method="post">
										<div class="form-group">
											<label for="">用户名</label>
											<input id="inputusername" name="inputusername" class="form-control" type="text" placeholder="请输入用户名" required="true" autofocus="true">
										</div>
										<div class="form-group">
											<label for="">密码</label>
											<input id="inputpwd" name="inputpwd" class="form-control" type="password" placeholder="请输入密码" required="true">
										</div>
										<div class="text-right">
											<button class="btn btn-primary" type="submit">登录</button>
											<button class="btn btn-danger" data-dismiss="modal">取消</button>
										</div>
										<a href="" data-toggle="modal" data-dismiss="modal" data-target="#register">还没有账号？点我注册</a>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<hr>
			<br>