<?php

class PowerBBPages
{
	var $id;
	var $Engine;

	function PowerBBPages($Engine)
	{
		$this->Engine = $Engine;
	}

	function InsertPage($param)
	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$query = $this->Engine->records->Insert($this->Engine->table['pages'],$param['field']);

		if ($param['get_id'])
		{
			$this->id = $this->Engine->DB->sql_insert_id();
		}

		return ($query) ? true : false;
	}

	function UpdatePage($param)
	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$query = $this->Engine->records->Update($this->Engine->table['pages'],$param['field'],$param['where']);

		return ($query) ? true : false;
	}

	function DeletePage($param)
	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$param['table'] = $this->Engine->table['pages'];

		$del = $this->Engine->records->Delete($param);

		return ($del) ? true : false;
	}

	function GetPageInfo($param)
	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$param['select'] 	= 	'*';
		$param['from'] 		= 	$this->Engine->table['pages'];

		$rows = $this->Engine->records->GetInfo($param);

		return $rows;
	}

	function GetPagesList($param)
	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$param['select'] 	= 	'*';
 		$param['from'] 		= 	$this->Engine->table['pages'];

 	 	$rows = $this->Engine->records->GetList($param);

 		return $rows;
	}

}

?>
