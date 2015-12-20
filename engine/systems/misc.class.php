<?php

class PowerBBMisc
{
	var $Engine;

	function PowerBBMisc($Engine)
	{
		$this->Engine = $Engine;
	}

	function GetForumAge($param)
	{
     	$age = time() - $param['date'];
     	$age = @ceil($age/(60*60*24));

     	return $age;
	}
}

?>
