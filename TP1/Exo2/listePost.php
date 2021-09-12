<?php

	if (isset($_POST['nbItems']))
	{
		$_POST['nbItems'] = htmlentities($_POST['nbItems']);
		if (is_numeric($_POST['nbItems']))
		{
			echo "<ul>";
			for ($i=0; $i<(int)$_POST['nbItems']; $i++)
			{
				echo "<li>Element n°" . $i . "</li>";
			}
			echo "</ul>";
		}
	}
	
?>