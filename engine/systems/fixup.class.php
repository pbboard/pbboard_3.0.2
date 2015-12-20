<?php

class PowerBBFixup
{
	var $Engine;

	function PowerBBFixup($Engine)
	{
		$this->Engine = $Engine;
	}

	function RepairTables()
	{
		$returns = array();

		foreach ($this->Engine->table as $k => $v)
		{
			$query = $this->Engine->DB->sql_query('REPAIR TABLE ' . $v);

			if ($query)
			{
				$returns[$v] = true;
			}
			else
			{
				$returns[$v] = false;
			}
		}

		return $returns;
	}
}

?>
