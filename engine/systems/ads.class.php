<?php

class PowerBBAds
{
	var $id;
	var $Engine;

	function PowerBBAds($Engine)
	{
		$this->Engine = $Engine;
	}

 	function InsertAds($param)
 	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$query = $this->Engine->records->Insert($this->Engine->table['ads'],$param['field']);

		if ($param['get_id'])
		{
			$this->id = $this->Engine->DB->sql_insert_id();
		}

		return ($query) ? true : false;
 	}

 	function UpdateAds($param)
 	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$query = $this->Engine->records->Update($this->Engine->table['ads'],$param['field'],$param['where']);

		return ($query) ? true : false;
 	}

	function DeleteAds($param)
	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$param['table'] = $this->Engine->table['ads'];

		$del = $this->Engine->records->Delete($param);

		return ($del) ? true : false;
	}

	function GetAdsInfo($param)
	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

 	 	$param['select'] 	= 	'*';
 	 	$param['from'] 		= 	$this->Engine->table['ads'];

 	 	$rows = $this->Engine->records->GetInfo($param);

 	 	return $rows;
	}

	function NewVisit($param)
	{
		if (empty($param['clicks'])
			and $param['clicks'] != 0)
		{
			trigger_error('ERROR::NEED_PARAMETER -- FROM NewVisit() -- EMPTY clicks',E_USER_ERROR);
		}

		$param['field'] = array();
		$param['field']['clicks'] = $param['clicks'] + 1;

		$update = $this->UpdateAds($param);

		return ($update) ? true : false;
	}

 	function GetAdsList($param)
 	{
  		if (!isset($param)
  			or !is_array($param))
 		{
 			$param = array();
 		}

 		$param['select'] 	= 	'*';
 		$param['from'] 		= 	$this->Engine->table['ads'];

 	 	$rows = $this->Engine->records->GetList($param);

 		return $rows;
 	}
}

 ?>
