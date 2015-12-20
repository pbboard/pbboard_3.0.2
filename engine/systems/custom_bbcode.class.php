<?php

/**
 * PowerBB Engine - The Engine Helps You To Create Bulletin Board System.
 */

/**
 * @package 	: 	PowerBBCustom_bbcode (Custom_bbcode)
 * @author 		: 	MSHRAQ abu-rakan ()
 * @start 		: 	30/11/2010 , 03:25 AM
 */


class PowerBBCustom_bbcode
{
	var $id;
	var $Engine;

	function PowerBBCustom_bbcode($Engine)
	{
		$this->Engine = $Engine;
	}

 	/**
 	 * Insert new Custom_bbcode
 	 *
 	 * @param :
 	 *			Oh :O it's a long list
 	 */
 	function InsertCustom_bbcode($param)
 	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$query = $this->Engine->records->Insert($this->Engine->table['custom_bbcode'],$param['field']);

		if ($param['get_id'])
		{
			$this->id = $this->Engine->DB->sql_insert_id();
		}

		return ($query) ? true : false;
 	}


	function DeleteCustom_bbcode($param)
	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$param['table'] = $this->Engine->table['custom_bbcode'];

		$del = $this->Engine->records->Delete($param);

		return ($del) ? true : false;
	}

	/**
	 * Get the list of Custom_bbcode
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
	function GetCustom_bbcodeList($param)
	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$param['select'] 	= 	'*';
 		$param['from'] 		= 	$this->Engine->table['custom_bbcode'];

		$rows = $this->Engine->records->GetList($param);

		return $rows;
	}

	/**
	 * Get Custom_bbcode info
	 *
	 * $param =
	 *			array(	'id'	=>	'the id of Supermemberlogs');
	 *
	 * @return :
	 *			array -> of information
	 *			false -> when found no information
	 */
	function GetCustom_bbcodeInfo($param)
	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$param['select'] 	= 	'*';
		$param['from'] 		= 	$this->Engine->table['custom_bbcode'];

		$rows = $this->Engine->records->GetInfo($param);

 	 	return $rows;
	}

	function GetCustom_bbcodeNumber($param)
	{
		if (!isset($param))
		{
			$param 	= array();
		}

		$param['select'] 	= 	'*';
		$param['from'] 		= 	$this->Engine->table['custom_bbcode'];

		$num = $this->Engine->records->GetNumber($param);

		return $num;
	}

	 function UpdateCustom_bbcode($param)
 	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$query = $this->Engine->records->Update($this->Engine->table['custom_bbcode'],$param['field'],$param['where']);

		return ($query) ? true : false;
 	}



	function CreateCustom_bbcodeCache($param)
 	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$Custom_bbcode = $this->GetCustom_bbcodeList($param);

 		$cache 	= 	array();
 		$x		=	0;
 		$n		=	sizeof($Custom_bbcode);

		while ($x < $n)
		{
			$cache[$x] 					                    = 	array();
			$cache[$x]['id']		 	                    = 	$Custom_bbcode[$x]['id'];
			$cache[$x]['bbcode_title']		 	            = 	$Custom_bbcode[$x]['bbcode_title'];
			$cache[$x]['bbcode_desc']		 	            = 	$Custom_bbcode[$x]['bbcode_desc'];
			$cache[$x]['bbcode_tag']		 	            = 	$Custom_bbcode[$x]['bbcode_tag'];
			$cache[$x]['bbcode_replace']		 	        = 	$Custom_bbcode[$x]['bbcode_replace'];
			$cache[$x]['bbcode_useoption']		 	        = 	$Custom_bbcode[$x]['bbcode_useoption'];
			$cache[$x]['bbcode_example']		 	        = 	$Custom_bbcode[$x]['bbcode_example'];
			$cache[$x]['bbcode_switch']		 	            = 	$Custom_bbcode[$x]['bbcode_switch'];
			$cache[$x]['bbcode_add_into_menu']		     	= 	$Custom_bbcode[$x]['bbcode_add_into_menu'];
			$cache[$x]['bbcode_menu_option_text']		 	= 	$Custom_bbcode[$x]['bbcode_menu_option_text'];
			$cache[$x]['bbcode_menu_content_text']		 	= 	$Custom_bbcode[$x]['bbcode_menu_content_text'];

			$x += 1;
		}

		$cache = serialize($cache);

		return $cache;
 	}


 	function UpdateCustom_bbcodeCache($param)
 	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

 		$cache = $this->CreateCustom_bbcodeCache($param);

 		$update_cache = $this->Engine->info->UpdateInfo(array('value'=>$cache,'var_name'=>'custom_bbcodes_list_cache'));

 		return ($update_cache) ? true : false;
 	}

}

?>
