function my_add()
{
	var todo = prompt("New TODO").trim();
	if (!todo)
		return;
	var list = document.getElementById("ft_list");
	var add = document.createElement('div');
	add.onclick = function(){my_del(this)};
	add.appendChild(document.createTextNode(todo));
	list.insertBefore(add, list.firstChild);
	setCook(list);
}

function my_del( elem )
{
	if (confirm("Do you really want delete this to do ?"))
	{
		var list = document.getElementById("ft_list");
		list.removeChild(elem);
		setCook(list);
	}
}

function my_load()
{
	var name ="todo_list";
	var ls = document.cookie.split(';');
	for (var i = 0 ; i < ls.length ; i++)
		if (ls[i].substring(0, name.length) == name)
		{
			var ds = ls[i].substring(name.length + 1).split('`');
			for (var j = ds.length - 1 ; j >= 0 ; j--)
			{
				var list = document.getElementById("ft_list");
				if (ds[j])
				{
					var add = document.createElement('div');
					add.onclick = function(){my_del(this)};
					add.appendChild(document.createTextNode(ds[j]));
					list.insertBefore(add, list.firstChild);
				}
			}
		}
}

function setCook(list)
{
	document.cookie = "todo_list=; expires=Thu, 01 Jan 1970 00:00:00 UTC";
	var d = new Date();
	d.setTime(d.getTime() + (24*60*60*1000));
	var expires = "expires="+d.toUTCString();
	s = "";
	var size = list.childNodes.length;
	for (var i = 0 ; i < size - 1; i++)
		s = s.concat(list.childNodes[i].innerHTML).concat('`');
	document.cookie = "todo_list" + "=" + s + "; " + expires;
}
