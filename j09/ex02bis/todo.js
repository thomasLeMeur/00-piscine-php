$(document).ready(function()
{
	$('body').ready(function()
	{
		if ((val = $.cookie("todo_list")))
		{
			var ds = val.split('`');
			for (var j = ds.length - 1 ; j >= 0 ; j--)
				if (ds[j])
					$("#ft_list").prepend("<div id='i'>" + ds[j] + "</div>");
		}
	}),
	$('#b').click(function()
	{
		if ((todo = prompt("New TODO")) && (todo = todo.trim()))
		{
			$("#ft_list").prepend("<div id='i'>" + todo + "</div>");
			setCook();
		}
	}),
	$('div').on('click', 'div#i', function()
	{
		if (confirm("Do you really want delete this to do ?"))
		{
			$(this).remove();
			setCook();
		}
	});
});

function setCook()
{
	$.removeCookie("todo_list");
	s = "";
	var size = $("#ft_list").length;
	$('#ft_list').children('div').each(function()
			{
				s += $(this).text() + '`';
			});
	$.cookie("todo_list", s);
}
