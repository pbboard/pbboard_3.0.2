<?php

// ##########################################||
// #
// #   PowerBB Version 2.0.4
// #   http://www.pbboard.info
// #   Copyright (c) 2009 by Abu.Rakan
// #
// #   filename : emailed_notification.class.php
// #   members emailed notification
// #
// #########################################||


class PowerBBEmailed
{
	var $Engine;

	function PowerBBEmailed($Engine)
	{
		$this->Engine = $Engine;
	}

	function InsertEmailed($param)
	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$query = $this->Engine->records->Insert($this->Engine->table['emailed'],$param['field']);

		if ($param['get_id'])
		{
			$this->id = $this->Engine->DB->sql_insert_id();
		}

		return ($query) ? true : false;
	}

	function IsEmailed($param)
	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$param['select'] 	= 	'*';
		$param['from'] 		= 	$this->Engine->table['emailed'];

		$num = $this->Engine->records->GetNumber($param);

		return ($num <= 0) ? false : true;
	}

	 function UpdateEmailed($param)
 	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$query = $this->Engine->records->Update($this->Engine->table['emailed'],$param['field'],$param['where']);

		return ($query) ? true : false;
 	}

	function GetEmailedList($param)
	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

 		$param['select'] 	= 	'*';
 		$param['from']		=	$this->Engine->table['emailed'];

		$rows = $this->Engine->records->GetList($param);

		return $rows;
	}

	function GetEmailedInfo($param)
	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$param['select'] 	= 	'*';
		$param['from']		=	$this->Engine->table['emailed'];

		$rows = $this->Engine->records->GetInfo($param);

		return $rows;
	}

	function DeleteEmailed($param)
	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$param['table'] = $this->Engine->table['emailed'];

		$del = $this->Engine->records->Delete($param);

		return ($del) ? true : false;
	}

	function GetEmailedNumber($param)
 	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$param['select'] 	= 	'*';
		$param['from'] 		= 	$this->Engine->table['emailed'];

		$num   = $this->Engine->records->GetNumber($param);

		return $num;
 	}

     function UnScubscribe($subject_id)
    {
       global $PowerBB;


             $DelSubject                        =    array();
             $DelSubject['where']              =    array();

             $DelSubject['where'][0]          = array();
             $DelSubject['where'][0]['name']    = 'subject_id';
             $DelSubject['where'][0]['oper']    =  '=';
             $DelSubject['where'][0]['value']    = $subject_id;

             $DeleteSubject = $PowerBB->emailed->DeleteEmailed($DelSubject);


    }
	function MassDeleteEmailed($param)
	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$param['table'] = $this->Engine->table['emailed'];

		$del = $this->Engine->records->Delete($param);

		return ($del) ? true : false;
	}

}


?>
