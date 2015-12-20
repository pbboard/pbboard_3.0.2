<?php

/**
 * PowerBB Engine - The Engine Helps You To Create Bulletin Board System.
 */

/**
 * @package 	: 	PowerBBVisitor
 * @author 		: 	Abu Rakan
 * @start 		: 	5/12/2009 , 02:04 AM
 */

class PowerBBVisitor
{
	var $id;
	var $Engine;

	function PowerBBVisitor($Engine)
	{
		$this->Engine = $Engine;
	}

	function InsertVisitor($param)
	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$query = $this->Engine->records->Insert($this->Engine->table['visitor'],$param['field']);

		if ($param['get_id'])
		{
			$this->id = $this->Engine->DB->sql_insert_id();
		}

		return ($query) ? true : false;
	}

	function GetVisitorInfo($param)
	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$param['select'] 	= 	'*';
		$param['from']		=	$this->Engine->table['visitor'];

		$rows = $this->Engine->records->GetInfo($param);

		return $rows;
	}

	function IsVisitor($param)
	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$param['select'] 	= 	'*';
		$param['from'] 		= 	$this->Engine->table['visitor'];

		$num = $this->Engine->records->GetNumber($param);

		return ($num <= 0) ? false : true;
	}

	function DeleteVisitor($param)
	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$param['table'] = $this->Engine->table['visitor'];

 		$query = $this->Engine->records->Delete($param);

 		return ($query) ? true : false;
	}

	function UpdateVisitor($param)
 	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$query = $this->Engine->records->Update($this->Engine->table['visitor'],$param['field'],$param['where']);

		return ($query) ? true : false;
 	}

}


?>
