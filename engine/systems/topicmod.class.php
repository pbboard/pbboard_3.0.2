<?php

/**
 * PowerBB Engine - The Engine Helps You To Create Bulletin Board System.
 */

/**
 * @package 	: 	PowerBBTopicMod (TopicMod)
 * @author 		: 	MSHRAQ abu-rakan ()
 * @start 		: 	9/12/2010 , 03:25 AM
 */


class PowerBBTopicmodr
{
	var $id;
	var $Engine;

	function PowerBBTopicmodr($Engine)
	{
		$this->Engine = $Engine;
	}
 	/**
 	 * Insert new TopicMod
 	 *
 	 * @param :
 	 *			Oh :O it's a long list
 	 */
 	function InsertTopicMod($param)
 	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$query = $this->Engine->records->Insert($this->Engine->table['topicmod'],$param['field']);

		if ($param['get_id'])
		{
			$this->id = $this->Engine->DB->sql_insert_id();
		}

		return ($query) ? true : false;
 	}


	function DeleteTopicMod($param)
	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$param['table'] = $this->Engine->table['topicmod'];

		$del = $this->Engine->records->Delete($param);

		return ($del) ? true : false;
	}

	/**
	 * Get the list of TopicMod
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
	function GetTopicModList($param)
	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$param['select'] 	= 	'*';
 		$param['from'] 		= 	$this->Engine->table['topicmod'];

		$rows = $this->Engine->records->GetList($param);

		return $rows;
	}

	/**
	 * Get TopicMod info
	 *
	 * $param =
	 *			array(	'id'	=>	'the id of Supermemberlogs');
	 *
	 * @return :
	 *			array -> of information
	 *			false -> when found no information
	 */
	function GetTopicModInfo($param)
	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$param['select'] 	= 	'*';
		$param['from'] 		= 	$this->Engine->table['topicmod'];

		$rows = $this->Engine->records->GetInfo($param);

 	 	return $rows;
	}

	function GetTopicModNumber($param)
	{
		if (!isset($param))
		{
			$param 	= array();
		}

		$param['select'] 	= 	'*';
		$param['from'] 		= 	$this->Engine->table['topicmod'];

		$num = $this->Engine->records->GetNumber($param);

		return $num;
	}

	 function UpdateTopicMod($param)
 	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$query = $this->Engine->records->Update($this->Engine->table['topicmod'],$param['field'],$param['where']);

		return ($query) ? true : false;
 	}

	function IsTopicMod($param)
	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$param['select'] 	= 	'*';
		$param['from'] 		= 	$this->Engine->table['topicmod'];

		$num = $this->Engine->records->GetNumber($param);

		return ($num <= 0) ? false : true;
	}


}

?>
