<?php

/**
*  upgrader to version 3.0.2
*/

define('NO_TEMPLATE',true);

include('../common.php');

class PowerBBTHETA extends PowerBBInstall
 {
	var $_TempArr 	= 	array();
	var $_Masseges	=	array();

	function CheckVersion()
	{
		global $PowerBB;

		return $PowerBB->_CONF['info_row']['MySBB_version'];
	}


	function UpdateVersion()
	{
		global $PowerBB;

		$update = $PowerBB->DB->sql_query("UPDATE " . $PowerBB->table['info'] . " SET value='3.0.2' WHERE var_name='MySBB_version'");

		return ($update) ? true : false;
	}


	}
    $PowerBB->install = new PowerBBTHETA;
    $NewVersion = $PowerBB->install->CheckVersion();
     $PowerBB->html->page_footer($NewVersion);

?>
