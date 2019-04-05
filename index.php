<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />


<style>
html, body {}
.page-content { padding:1em; max-width:64em; margin:auto }

.click-count { color:green; font-weight:bold }
</style>

</head>
<body>

<div class="page-content">




<?php 

$clickcount = explode("\n", file_get_contents('counter.txt'));
foreach($clickcount as $line){
	$tmp = explode('||', $line);
	$count[trim($tmp[0])] = trim($tmp[1]);
	}

?>

<button class="click-trigger" data-click-id="click-001">Click Me</button> 
Clicked <span id="click-001" class="click-count"><?php echo $count['click-001'];?></span> times.
<br/><br/>






<script>
var clicks = document.querySelectorAll('.click-trigger'); // IE8
for(var i = 0; i < clicks.length; i++){
	clicks[i].onclick = function(){
		var id = this.getAttribute('data-click-id');
		var post = 'id='+id; // post string
		var req = new XMLHttpRequest();
		req.open('POST', 'counter.php', true);
		req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		req.onreadystatechange = function(){
			if (req.readyState != 4 || req.status != 200) return; 
			document.getElementById(id).innerHTML = req.responseText;
			};
		req.send(post);
		}
	}
</script>

</body>
</html>