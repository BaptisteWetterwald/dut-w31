<?php
	if (!isset($_COOKIE['counter']))
	{
		setcookie('counter', 0, 0);
		$_COOKIE['counter'] = 0;
	}
	else
	{
		$_COOKIE['counter']++;
		setcookie('counter', $_COOKIE['counter']);
	}
	echo $_COOKIE['counter'];
?>	
<body>
	<a href="resetCounter.php">Reset</a>
</body>

