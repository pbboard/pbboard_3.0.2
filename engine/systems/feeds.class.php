<?php

/**
 * PowerBB Engine - The Engine Helps You To Create Bulletin Board System.
 */

/**
 * @package 	: 	PowerBBFeeds (Feedss)
 * @author 		: 	MSHRAQ abu-rakan ()
 * @start 		: 	18/8/2010 , 03:25 AM
 */


class PowerBBFeeds
{
	var $id;
	var $Engine;

	function PowerBBFeeds($Engine)
	{
		$this->Engine = $Engine;
	}

 	/**
 	 * Insert new Feeds
 	 *
 	 * @param :
 	 *			Oh :O it's a long list
 	 */
 	function InsertFeeds($param)
 	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$query = $this->Engine->records->Insert($this->Engine->table['feeds'],$param['field']);

		if ($param['get_id'])
		{
			$this->id = $this->Engine->DB->sql_insert_id();
		}

		return ($query) ? true : false;
 	}


	function DeleteFeeds($param)
	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$param['table'] = $this->Engine->table['feeds'];

		$del = $this->Engine->records->Delete($param);

		return ($del) ? true : false;
	}

	/**
	 * Get the list of Feeds
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
	function GetFeedsList($param)
	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$param['select'] 	= 	'*';
 		$param['from'] 		= 	$this->Engine->table['feeds'];

		$rows = $this->Engine->records->GetList($param);

		return $rows;
	}

	/**
	 * Get Feeds info
	 *
	 * $param =
	 *			array(	'id'	=>	'the id of Supermemberlogs');
	 *
	 * @return :
	 *			array -> of information
	 *			false -> when found no information
	 */
	function GetFeedsInfo($param)
	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$param['select'] 	= 	'*';
		$param['from'] 		= 	$this->Engine->table['feeds'];

		$rows = $this->Engine->records->GetInfo($param);

 	 	return $rows;
	}

	function GetFeedsNumber($param)
	{
		if (!isset($param))
		{
			$param 	= array();
		}

		$param['select'] 	= 	'*';
		$param['from'] 		= 	$this->Engine->table['feeds'];

		$num = $this->Engine->records->GetNumber($param);

		return $num;
	}

	 function UpdateFeeds($param)
 	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$query = $this->Engine->records->Update($this->Engine->table['feeds'],$param['field'],$param['where']);

		return ($query) ? true : false;
 	}

	function IsFeed($param)
	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$param['select'] 	= 	'*';
		$param['from'] 		= 	$this->Engine->table['feeds'];

		$num = $this->Engine->records->GetNumber($param);

		return ($num <= 0) ? false : true;
	}


}

?>
