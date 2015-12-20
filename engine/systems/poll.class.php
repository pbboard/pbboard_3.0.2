<?php

class PowerBBPoll
{
	var $id;
	var $Engine;

	function PowerBBPoll($Engine)
	{
		$this->Engine = $Engine;
	}

	function InsertPoll($param)
	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

        $param['field']['answers'] = serialize($param['field']['answers']);

		$query = $this->Engine->records->Insert($this->Engine->table['poll'],$param['field']);

		if ($param['get_id'])
		{
			$this->id = $this->Engine->DB->sql_insert_id();
		}

		return ($query) ? true : false;
	}

 	function UpdatePoll($param)
 	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

 		$param['field']['answers'] = serialize($param['field']['answers']);

		$query = $this->Engine->records->Update($this->Engine->table['poll'],$param['field'],$param['where']);

		return ($query) ? true : false;
 	}

	function DeletePoll($param)
	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$param['table'] = $this->Engine->table['poll'];

		$del = $this->Engine->records->Delete($param);

		return ($del) ? true : false;
	}

	function GetPollInfo($param)
	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$param['select'] 	= 	'*';
		$param['from']		=	$this->Engine->table['poll'];

		$rows = $this->Engine->records->GetInfo($param);


		return $rows;
	}

}

?>
