// ͨ��ID��ȡHTML�����ͨ�÷�����ʹ��$���溯������
function $(elementId)
{
	return document.getElementById(elementId);
}

// ע��ʱ�û���Ϣ��֤
function regcheck() 
{
	var regusername = $('regusername');
	var regpwd1 = $('regpwd1');
	var regpwd2 = $('regpwd2');
	var regemail = $('regemail');

	if (regusername.value.length < 1 || regusername.value.length > 16)
	{
		alert('�û������Ϸ�������������4-16λ�û�����');
		// form.regusername.focus();
		return false;
	}
	
	if (regpwd1.value.length < 3 || regpwd1.value.length > 16)
	{
		alert('���벻�Ϸ�������������3-16λ���룡');
		// form.regpwd1.focus();
		return false;
	}
	
	if (regpwd1.value != regpwd2.value)
	{
		alert('�����������벻һ�£��������ԣ�');
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

//��������ǰ�ȼ��
function commentsPost()
{
	var username = $('ip_username').value;	
	var comment = $('comment').value;
	if (comment == "")
	{
		// alert('�������ݲ���Ϊ�գ�');
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
		alert('���ȵ�¼��ע�ᣡ');
		return false;
	}	
}

//���������ݼ��
function checkPost()
{
	var title = $('inputtitle').value;
	var datestr = getNowFormatDate();
	var editid = $('editid').value;
	var content = $('inputpost').value;

	if (title == "")
	{
		alert('���ı��ⲻ��Ϊ�գ�');
		return false;
	}
	if (content == "")
	{
		alert('�������ݲ���Ϊ�գ�');
		return false;
	}
	// if (title.length > 20)
	// {
	// 	alert('');
	// 	return false;
	// }
	if (editid == 0)
	{
		$('inputreleasetime').value = datestr;//�²��͵ķ���ʱ��Ϊ��ǰϵͳʱ��
	}	
	$('inputedittime').value = datestr;
}

//��ȡ��ǰϵͳʱ�䣬��ʽΪ��yyyy-mm-dd H:i:s
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

//ɾ��ȷ�϶Ի���
function deleteConfirm(url)
{
	// $('deleteurl').value = "123";
	$('deleteurl').value=url;
}

//ɾ��ȷ�ϰ�ť
function deleteurlSubmit()
{
	var url = $('deleteurl').value;
	window.location.href = url;
}

//�༭���ͣ���䲩������
function editPost(id, title, abstract, rtime, etime, content)
{
	$('editid').value = id;
	$('inputtitle').value = title;
	$('inputabstract').value = abstract;
	$('inputreleasetime').value = rtime;
	$('inputedittime').value = etime;
	$('inputpost').value = content;
}

//��¼�����������
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

//��¼������Ա�˻�������
function test()
{
	$('inputusername').value="alex";
	$('inputpwd').value="123";
}

//�������ҳ���λ����ȷλ��
function scrollToComment()
{
	$('commentDiv').scrollIntoView();
	$('comment').focus();
}

//ϲ�����Ķ�������1������ǰ̨δ����
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