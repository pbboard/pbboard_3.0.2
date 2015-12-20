<?php

/**
 * PowerBB Engine - The Engine Helps You To Create Bulletin Board System.
 */

/**
 * @package 		: 	PowerBBTemplatesEdits (TemplatesEdits)
 * @author 		: 	shadi mashaqi. exchangeboss (exchangeboss@gmail.com)
 * @start 		: 	19/2/2010 , 03:47 PM
 * @end			:	19/2/2010 , 01:56 PM
 */


class PowerBBTemplatesEdits
{
	var $id;
	var $Engine;

	function PowerBBTemplatesEdits($Engine)
	{
		$this->Engine = $Engine;
	}

 	/**
 	 * Insert new Addons
 	 *
 	 * @param :
 	 *			Oh :O it's a long list
 	 */
 	function InsertTemplatesEdits($param)
 	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$query = $this->Engine->records->Insert($this->Engine->table['templates_edits'],$param['field']);

		if ($param['get_id'])
		{
			$this->id = $this->Engine->DB->sql_insert_id();
		}

		return ($query) ? true : false;
 	}


	function DeleteTemplatesEdits($param)
	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$param['table'] = $this->Engine->table['templates_edits'];

		$del = $this->Engine->records->Delete($param);

		return ($del) ? true : false;
	}

	/**
	 * Get the list of Addons
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
	function GetTemplatesEditsList($param)
	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$param['select'] 	= 	'*';
 		$param['from'] 		= 	$this->Engine->table['templates_edits'];

		$rows = $this->Engine->records->GetList($param);

		return $rows;
	}

	/**
	 * Get Addons info
	 *
	 * $param =
	 *			array(	'id'	=>	'the id of Supermemberlogs');
	 *
	 * @return :
	 *			array -> of information
	 *			false -> when found no information
	 */
	function GetTemplatesEditsInfo($param)
	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$param['select'] 	= 	'*';
		$param['from'] 		= 	$this->Engine->table['templates_edits'];

		$rows = $this->Engine->records->GetInfo($param);

 	 	return $rows;
	}

	function GetTemplatesEditsNumber($param)
	{
		if (!isset($param))
		{
			$param 	= array();
		}

		$param['select'] 	= 	'*';
		$param['from'] 		= 	$this->Engine->table['templates_edits'];

		$num = $this->Engine->records->GetNumber($param);

		return $num;
	}

	 function UpdateTemplatesEdits($param)
 	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$query = $this->Engine->records->Update($this->Engine->table['templates_edits'],$param['field'],$param['where']);

		return ($query) ? true : false;
 	}


}

?>
