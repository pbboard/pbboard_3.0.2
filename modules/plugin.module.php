<?php
(!defined('IN_PowerBB')) ? die() : '';
include('common.php');

$CALL_SYSTEM			=	array();
$CALL_SYSTEM['SECTION'] 	= 	true;
$CALL_SYSTEM['GROUP'] 		= 	true;
$CALL_SYSTEM['SUBJECT'] 	= 	true;
$CALL_SYSTEM['REPLY'] 			= 	true;
$CALL_SYSTEM['CACHE'] 			= 	true;

define('CLASS_NAME','PowerBBPluginMOD');

class PowerBBPluginMOD
{
	function run()
	{
		global $PowerBB;


            if ($PowerBB->_GET['main'])
			{
				if ($PowerBB->_GET['control'])
				{
					$this->_ControlMain();
				}

			}
			elseif ($PowerBB->_GET['update'])
			{
				$this->StartUpdate();
			}
			else
			{
				@header("Location: index.php");
				exit;
			}
		$PowerBB->functions->GetFooter();
	}

	function _ControlMain()
	{
		global $PowerBB;

       $PowerBB->functions->ShowHeader();

     eval($PowerBB->functions->get_fetch_hooks('PluginHooksMain'));
	}

	function StartUpdate()
	{
		global $PowerBB;
       $PowerBB->functions->ShowHeader();

      eval($PowerBB->functions->get_fetch_hooks('PluginHooksUpdate'));

	}


}



?>
