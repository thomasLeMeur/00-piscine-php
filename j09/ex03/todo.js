function my_load()
{
	$.get('select.php', function(data)
	{
		console.log("load" + data);
		if (data == "null")
			return ;
		var e = document.getElementById('ft_list');
		var size = e.childNodes.length;
		for (var i = size - 1 ; i >= 0; i--)
			e.removeChild(e.childNodes[i]);
		var ds = data.split(";");
		for (var j = 0; j < ds.length; j++)
		{
			var list = document.getElementById("ft_list");
			if (ds[j])
			{
				var add = document.createElement('div');
				add.onclick = function(){my_sub(this)};
				add.appendChild(document.createTextNode(ds[j]));
				list.insertBefore(add, list.firstChild);
			}
		}
	});
}

function my_add()
{
	var todo = prompt("Please enter your new task to do :");
	if (todo != null)
	{
		$.get('insert.php?data=' + todo, function(data)
		{
			console.log("insert" + data);
			my_load();
		});
	}
}

function my_sub(todo)
{
	console.log(todo.innerHTML);
	if (confirm("Sure to delete this to do ?"))
	{
		$.get('delete.php?data=' + todo.innerHTML, function(data)
		{
			console.log("delete" + data);
			my_load();
		});
	}
}
