<?php

/**
 * PowerBB Engine - The Engine Helps You To Create Bulletin Board System.
 */

/**
 * @package 	: 	PowerBBEmailMessages (EmailMessages)
 * @author 		: 	MSHRAQ abu-rakan ()
 * @start 		: 	6/3/2010 , 10:49 PM
 */


class PowerBBEmailMessages
{
	var $id;
	var $Engine;

	function PowerBBEmailMessages($Engine)
	{
		$this->Engine = $Engine;
	}

 	/**
 	 * Insert new EmailMessages
 	 *
 	 * @param :
 	 *			Oh :O it's a long list
 	 */
 	function InsertEmailMessages($param)
 	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$query = $this->Engine->records->Insert($this->Engine->table['emailmessages'],$param['field']);

		if ($param['get_id'])
		{
			$this->id = $this->Engine->DB->sql_insert_id();
		}

		return ($query) ? true : false;
 	}


	function DeleteEmailMessages($param)
	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$param['table'] = $this->Engine->table['emailmessages'];

		$del = $this->Engine->records->Delete($param);

		return ($del) ? true : false;
	}

	/**
	 * Get the list of EmailMessages
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
	function GetEmailMessagesList($param)
	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$param['select'] 	= 	'*';
 		$param['from'] 		= 	$this->Engine->table['emailmessages'];

		$rows = $this->Engine->records->GetList($param);

		return $rows;
	}

	/**
	 * Get EmailMessages info
	 *
	 * $param =
	 *			array(	'id'	=>	'the id of Supermemberlogs');
	 *
	 * @return :
	 *			array -> of information
	 *			false -> when found no information
	 */
	function GetEmailMessagesInfo($param)
	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$param['select'] 	= 	'*';
		$param['from'] 		= 	$this->Engine->table['emailmessages'];

		$rows = $this->Engine->records->GetInfo($param);

 	 	return $rows;
	}

	function GetEmailMessagesNumber($param)
	{
		if (!isset($param))
		{
			$param 	= array();
		}

		$param['select'] 	= 	'*';
		$param['from'] 		= 	$this->Engine->table['emailmessages'];

		$num = $this->Engine->records->GetNumber($param);

		return $num;
	}

	 function UpdateEmailMessages($param)
 	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$query = $this->Engine->records->Update($this->Engine->table['emailmessages'],$param['field'],$param['where']);

		return ($query) ? true : false;
 	}

	function IsEmailMessages($param)
	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$param['select'] 	= 	'*';
		$param['from'] 		= 	$this->Engine->table['emailmessages'];

		$num = $this->Engine->records->GetNumber($param);

		return ($num <= 0) ? false : true;
	}

}

?>
