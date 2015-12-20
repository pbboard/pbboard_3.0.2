<?php

/**
 * PowerBB Engine - The Engine Helps You To Create Bulletin Board System.
 */

/**
 * @package 	: 	PowerBBVisitorMessage (VisitorMessage)
 * @author 		: 	MSHRAQ abu-rakan ()
 * @start 		: 	2/2/2010 , 02:49 AM
 */


class PowerBBVisitorMessage
{
	var $id;
	var $Engine;

	function PowerBBVisitorMessage($Engine)
	{
		$this->Engine = $Engine;
	}

 	/**
 	 * Insert new VisitorMessage
 	 *
 	 * @param :
 	 *			Oh :O it's a long list
 	 */
 	function InsertVisitorMessage($param)
 	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$query = $this->Engine->records->Insert($this->Engine->table['visitormessage'],$param['field']);

		if ($param['get_id'])
		{
			$this->id = $this->Engine->DB->sql_insert_id();
		}

		return ($query) ? true : false;
 	}


	function DeleteVisitorMessage($param)
	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$param['table'] = $this->Engine->table['visitormessage'];

		$del = $this->Engine->records->Delete($param);

		return ($del) ? true : false;
	}

	/**
	 * Get the list of VisitorMessage
	 *
	 * $param =
	 *			array(	'sql_statment'	=>	'complete SQL statement',
	 *					'proc'			=>	true // When you want proccess the outputs
	 *					);
	 *
	 * @return :
	 *				array -> of information
	 *				false -> when found no information
	 */
	function GetVisitorMessageList($param)
	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$param['select'] 	= 	'*';
 		$param['from'] 		= 	$this->Engine->table['visitormessage'];

		$rows = $this->Engine->records->GetList($param);

		return $rows;
	}

	/**
	 * Get VisitorMessage info
	 *
	 * $param =
	 *			array(	'id'	=>	'the id of Supermemberlogs');
	 *
	 * @return :
	 *			array -> of information
	 *			false -> when found no information
	 */
	function GetVisitorMessageInfo($param)
	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$param['select'] 	= 	'*';
		$param['from'] 		= 	$this->Engine->table['visitormessage'];

		$rows = $this->Engine->records->GetInfo($param);

 	 	return $rows;
	}

	function GetVisitorMessageNumber($param)
	{
		if (!isset($param))
		{
			$param 	= array();
		}

		$param['select'] 	= 	'*';
		$param['from'] 		= 	$this->Engine->table['visitormessage'];

		$num = $this->Engine->records->GetNumber($param);

		return $num;
	}

	 function UpdateVisitorMessage($param)
 	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$query = $this->Engine->records->Update($this->Engine->table['visitormessage'],$param['field'],$param['where']);

		return ($query) ? true : false;
 	}

	function IsVisitorMessage($param)
	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$param['select'] 	= 	'*';
		$param['from'] 		= 	$this->Engine->table['visitormessage'];

		$num = $this->Engine->records->GetNumber($param);

		return ($num <= 0) ? false : true;
	}

}

?>
