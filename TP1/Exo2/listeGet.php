<?php

	if (isset($_GET['nbItems']))
	{
		$_GET['nbItems'] = htmlentities($_GET['nbItems']);
		if (is_numeric($_GET['nbItems']))
		{
			echo "<ul>";
			for ($i=0; $i<(int)$_GET['nbItems']; $i++)
			{
				echo "<li>Element n°" . $i . "</li>";
			}
			echo "</ul>";
		}
	}
	
?>