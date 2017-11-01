// 通过ID获取HTML对象的通用方法，使用$代替函数名称
function $(elementId)
{
	return document.getElementById(elementId);
}

// 注册时用户信息验证
function regcheck() 
{
	var regusername = $('regusername');
	var regpwd1 = $('regpwd1');
	var regpwd2 = $('regpwd2');
	var regemail = $('regemail');

	if (regusername.value.length < 1 || regusername.value.length > 16)
	{
		alert('用户名不合法，请重新输入4-16位用户名！');
		// form.regusername.focus();
		return false;
	}
	
	if (regpwd1.value.length < 3 || regpwd1.value.length > 16)
	{
		alert('密码不合法，请重新输入3-16位密码！');
		// form.regpwd1.focus();
		return false;
	}
	
	if (regpwd1.value != regpwd2.value)
	{
		alert('两次输入密码不一致，请检查重试！');
		// form.regpwd2.focus();
		return false;
	}
}

function nonePre() 
{
	$('prePostBtn').style.display = "none";

	// var dt = document.getElementById("dt").value;
	// alert(dt);
	// prePost(dt);
}

function noneNext() 
{
	$('nextPostBtn').style.display = "none";

	// alert(dt);
	// nextPost(dt);
}

//发表评论前先检查
function commentsPost()
{
	var username = $('ip_username').value;	
	var comment = $('comment').value;
	if (comment == "")
	{
		// alert('评论内容不能为空！');
		$('commentWarning').style.display="block";
		$('comment').focus();
		return false;
	}
	else
	{
		$('commentWarning').style.display="none";	
	}
	if (username == "")
	{
		alert('请先登录或注册！');
		return false;
	}	
}

//发表博文内容检查
function checkPost()
{
	var title = $('inputtitle').value;
	var datestr = getNowFormatDate();
	var editid = $('editid').value;
	var content = $('inputpost').value;

	if (title == "")
	{
		alert('博文标题不能为空！');
		return false;
	}
	if (content == "")
	{
		alert('博文内容不能为空！');
		return false;
	}
	// if (title.length > 20)
	// {
	// 	alert('');
	// 	return false;
	// }
	if (editid == 0)
	{
		$('inputreleasetime').value = datestr;//新博客的发布时间为当前系统时间
	}	
	$('inputedittime').value = datestr;
}

//获取当前系统时间，格式为：yyyy-mm-dd H:i:s
function getNowFormatDate()
{
	var date = new Date();
	var seperator1 = "-";
	var seperator2 = ":";
	var month = date.getMonth() + 1;
	var strDate = date.getDate();
	if (month >= 1 && month <= 9) {
		month = "0" + month;
	}
	if (strDate >= 0 && strDate <= 9) {
		strDate = "0" + strDate;
	}
	var currentdate = date.getFullYear() + seperator1 + month + seperator1 + strDate
	+ " " + date.getHours() + seperator2 + date.getMinutes()
	+ seperator2 + date.getSeconds();
	return currentdate;
}

//删除确认对话框
function deleteConfirm(url)
{
	// $('deleteurl').value = "123";
	$('deleteurl').value=url;
}

//删除确认按钮
function deleteurlSubmit()
{
	var url = $('deleteurl').value;
	window.location.href = url;
}

//编辑博客，填充博客内容
function editPost(id, title, abstract, rtime, etime, content)
{
	$('editid').value = id;
	$('inputtitle').value = title;
	$('inputabstract').value = abstract;
	$('inputreleasetime').value = rtime;
	$('inputedittime').value = etime;
	$('inputpost').value = content;
}

//登录后才允许评论
function allowComment(bool)
{
	if (bool == 'TRUE')
	{
		$('commentForm').style.display="block";
		$('loginTip').style.display="none";
	}
	else
	{
		$('commentForm').style.display="none";
		$('loginTip').style.display="block";
	}	
}

//登录填充管理员账户和密码
function test()
{
	$('inputusername').value="alex";
	$('inputpwd').value="123";
}

//点击评论页面点位到正确位置
function scrollToComment()
{
	$('commentDiv').scrollIntoView();
	$('comment').focus();
}

//喜欢和阅读量增加1条，但前台未更新
function plus(type, id)
{
	var url="readandlike.php";

	$.ajax({
		url:url,
		type:"POST",
		// async:false,
		data:{type:type, id:id},
		datatype:"json",
		success:function function_name(data)
		{
			// console.log(data);
			data = $.parseJSON(data);
			// console.log(data);
			//alert(data.su+'!'+data.v);
			// alert(data.v);
		}
	});

	window.location.reload();
}