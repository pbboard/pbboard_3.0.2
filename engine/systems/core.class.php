<?php

class PowerBBCore
{
	var $id;
	var $Engine;

	function PowerBBCore($Engine)
	{
		$this->Engine = $Engine;
	}

 	/**
 	 * Insert new Core
 	 *
 	 * @param :
 	 */
 	function Insert($param,$table)
 	{
		global $PowerBB;

  		if (!isset($param)
  			or !is_array($param))
 		{
 			$param = array();
 		}

		$query = $this->Engine->records->Insert($PowerBB->prefix.$table,$param['field']);

		if ($param['get_id'])
		{
			$this->id = $this->Engine->DB->sql_insert_id();
		}

		return ($query) ? true : false;
 	}


	function GetNumber($param,$table)
	{
		global $PowerBB;
		if (!isset($param))
		{
			$param 	= array();
		}

		$param['select'] 	= 	'*';
		$param['from'] 		= 	$PowerBB->prefix.$table;

		$num = $this->Engine->records->GetNumber($param);

		return $num;
	}


 	/**
 	 * Update Core information
 	 *
 	 * @param :
 	 *			long list :\
 	 */
 	function Update($param,$table)
 	{
		global $PowerBB;

  		if (!isset($param)
  			or !is_array($param))
 		{
 			$param = array();
 		}

		$query = $this->Engine->records->Update($PowerBB->prefix.$table,$param['field'],$param['where']);

		return ($query) ? true : false;
 	}

	function Deleted($param,$table)
	{
		global $PowerBB;

  		if (!isset($param)
  			or !is_array($param))
 		{
 			$param = array();
 		}

		$param['table'] = $PowerBB->prefix.$table;

		$del = $this->Engine->records->Delete($param);

		return ($del) ? true : false;
	}
 	/**
 	 * Get Core list
 	 *
 	 * @param :
 	 *			sql_statment	->	to complete SQL query
 	 */
	function GetList($param,$table)
	{
		global $PowerBB;

 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$param['select'] 	= 	'*';
 		$param['from'] 		= 	$PowerBB->prefix.$table;

 	 	$rows = $this->Engine->records->GetList($param);

		return $rows;
  	 }

	/**
	 * Set the correct Core for member or user
	 *
	 * @return : the information about the correct Core
	 */
	function GetInfo($param,$table)
	{
		global $PowerBB;

 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$param['select'] 	= 	'*';
		$param['from'] 		= 	$PowerBB->prefix.$table;

		$rows = $this->Engine->records->GetInfo($param);

		return $rows;
	}


 	function Is($param,$table)
	{
		global $PowerBB;

 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$param['select'] 	= 	'*';
		$param['from'] 		= 	$PowerBB->prefix.$table;

		$num = $this->Engine->records->GetNumber($param);

		return ($num <= 0) ? false : true;
	}

	function NewVisit($param,$table)
	{
		global $PowerBB;
		if (empty($param['clicks'])
			and $param['clicks'] != 0)
		{
			trigger_error('ERROR::NEED_PARAMETER -- FROM NewVisit() -- EMPTY clicks',E_USER_ERROR);
		}

		$param['field'] = array();
		$param['field']['clicks'] = $param['clicks'] + 1;

		$update = $this->Update($param,$table);

		return ($update) ? true : false;
	}

 	function CreateStyleCache($param,$table)
 	{
		global $PowerBB;
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$style 	= 	$this->GetInfo($param,$table);
		$cache 	= 	'';

		if ($style != false)
		{
			$cache = array();

			$cache['style_path'] 		= 	$style['style_path'];
			$cache['image_path'] 		= 	$style['image_path'];

			$cache = base64_encode(serialize($cache));
		}
		else
		{
			return false;
		}

		return $cache;
 	}

	function GetRequestInfo($param,$table)
	{
		global $PowerBB;
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$param['select'] 	= 	'*';
		$param['from'] 		= 	$PowerBB->prefix.$table;

		if (!empty($param['code'])
			and !empty($param['type'])
			and !empty($param['username']))
		{
			$param['where'] 				= 	array();

			$param['where'][0] 				= 	array();
			$param['where'][0]['name'] 		= 	'random_url';
			$param['where'][0]['oper'] 		= 	'=';
			$param['where'][0]['value'] 	= 	$param['code'];

			$param['where'][1] 				= 	array();
			$param['where'][1]['con'] 		= 	'AND';
			$param['where'][1]['name'] 		= 	'request_type';
			$param['where'][1]['oper'] 		= 	'=';
			$param['where'][1]['value'] 	= 	$param['type'];

			$param['where'][2] 				= 	array();
			$param['where'][2]['con'] 		= 	'AND';
			$param['where'][2]['name'] 		= 	'username';
			$param['where'][2]['oper'] 		= 	'=';
			$param['where'][2]['value'] 	= 	$param['username'];
		}

		$rows = $this->Engine->records->GetInfo($param);

		return $rows;
	}

	function MessageProccess($param,$table)
	{
		global $PowerBB;

		$search_array 		= 	array();
		$replace_array 		= 	array();

		$search_array[]		=	'[MySBB]username[/MySBB]';
		$replace_array[]	=	$param['username'];

		$search_array[]		=	'[MySBB]board_title[/MySBB]';
		$replace_array[]	=	$param['title'];

		$search_array[]		=	'[MySBB]url[/MySBB]';
		$replace_array[]	=	$param['active_url'];

		$search_array[]		=	'[MySBB]change_url[/MySBB]';
		$replace_array[]	=	$param['change_url'];

		$search_array[]		=	'[MySBB]cancel_url[/MySBB]';
		$replace_array[]	=	$param['cancel_url'];

		$text = str_replace($search_array,$replace_array,$param['text']);

		return $text;
	}

 	function Create_last_posts_cache($param, $time, $limit)
	{
	   global $PowerBB;
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}
        $table = 'subject';
		$param['select'] 	= 	'*';
 		$param['from'] 		= 	$PowerBB->prefix.$table;
		$param['order'] 					= 	array();

		$param['order']['field'] 		= 	'write_time';
		$param['order']['type'] 			= 	'DESC';
		$param['limit']		        =	$limit;

 	 	$Posts = $this->Engine->records->GetList($param);
       if($Posts)
       {

	 		$cache 	= 	array();
	 		$x		=	0;
	 		$numb =sizeof($Posts);
        	 if($limit>$numb)
			{
	 		 $n		=	$limit;
	 		}
	 		else
			{
	 		 $n		=	$numb;
	 		}
			while ($x < $n)
			{

				$cache[$x] 					            = 	array();
				$cache[$x]['id']		 	            = 	$Posts[$x]['id'];
				$cache[$x]['section'] 	                = 	$Posts[$x]['section'];
				$cache[$x]['writer'] 		            = 	$Posts[$x]['writer'];
				$cache[$x]['title'] 		            = 	$Posts[$x]['title'];
				$cache[$x]['review_reply']              = 	$Posts[$x]['review_reply'];
				$cache[$x]['write_time']                = 	$Posts[$x]['write_time'];
				$cache[$x]['icon'] 		                = 	$Posts[$x]['icon'];
				$cache[$x]['visitor'] 		            = 	$Posts[$x]['visitor'];
				$cache[$x]['last_replier'] 		        = 	$Posts[$x]['last_replier'];
				$cache[$x]['sec_subject'] 		        = 	$Posts[$x]['sec_subject'];
				$cache[$x]['last_replier'] 		        = 	$Posts[$x]['last_replier'];
				$cache[$x]['review_subject'] 		    = 	$Posts[$x]['review_subject'];
				$cache[$x]['prefix_subject'] 		    = 	$Posts[$x]['prefix_subject'];
				$cache[$x]['native_write_time'] 		= 	$Posts[$x]['native_write_time'];
				$cache[$x]['special'] 		            = 	$Posts[$x]['special'];
				$cache[$x]['attach_subject'] 		    = 	$Posts[$x]['attach_subject'];

				$x += 1;
			}
			$cache = serialize($cache);
			$update_cache_time = $this->Engine->info->UpdateInfo(array('var_name'=>'last_time_cache','value'=>$time));
			$update = $this->Engine->info->UpdateInfo(array('var_name'=>'last_posts_cache','value'=>$cache));
			return ($update) ? true : false;
		}
		else
		{
		return  false;
		}
 	}

}

?>
