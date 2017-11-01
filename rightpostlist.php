<!-- 中间右侧面板 -->
					<div class="col-md-4 column">
						<h3>
							最新文章
						</h3>
						<ul class="list-group">
						<?php
							$zxwz_sql = "SELECT * FROM post ORDER BY releasetime DESC LIMIT 5";
							$zxwz_result = mysql_query($zxwz_sql);
							while ($zxwz_list = mysql_fetch_array($zxwz_result))
							{
								echo "<li class='list-group-item'><a href='readingblog.php?id=".$zxwz_list['postId']."' title='".$zxwz_list['abstract']."'>".$zxwz_list['title']."</a></li>";
								// echo "<li class='list-group-item'><span class='badge'>新</span>".$zxwz_list['title']."</li>";
							}
						?>
						</ul>
						<br>

						<h3>
							阅读排行
						</h3>
						<ul class="list-group">
						<?php
							$ydph_sql = "SELECT * FROM post ORDER BY readings DESC LIMIT 5";
							$ydph_result = mysql_query($ydph_sql);
							while ($ydph_list = mysql_fetch_array($ydph_result))
							{
								echo "<li class='list-group-item'><a href='readingblog.php?id=".$ydph_list['postId']."' title='".$ydph_list['abstract']."'>".$ydph_list['title']."(".$ydph_list['readings'].")</a></li>";
								// echo "<li class='list-group-item'><span class='glyphicon glyphicon-fire'></span> ".$ydph_list['title']."(".$ydph_list['readings'].")</li>";
							}
						?>
						</ul>
						<br>

						<h3>
							人气最高
						</h3>
						<ul class="list-group">
						<?php
							$rqzg_sql = "SELECT * FROM post ORDER BY likes DESC LIMIT 5";
							$rqzg_result = mysql_query($rqzg_sql);
							while ($rqzg_list = mysql_fetch_array($rqzg_result))
							{
								echo "<li class='list-group-item'><a href='readingblog.php?id=".$rqzg_list['postId']."' title='".$rqzg_list['abstract']."'>".$rqzg_list['title']."(".$rqzg_list['likes'].")</a></li>";
								// echo "<li class='list-group-item'><span class='badge'><span class='glyphicon glyphicon-fire'></span></span>".$rqzg_list['title']."(".$rqzg_list['likes'].")</li>";
							}
						?>
						</ul>
					</div>