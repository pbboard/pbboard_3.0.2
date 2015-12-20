<?php

(!defined('IN_PowerBB')) ? die() : '';

define('IN_ADMIN',true);
define('STOP_STYLE',true);

include('../common.php');

define('CLASS_NAME','PowerBBLogoutMOD');

class PowerBBLogoutMOD
{
	function run()
	{
		global $PowerBB;

		if ($PowerBB->_CONF['member_permission'])
		{
			setcookie($PowerBB->_CONF['admin_username_cookie'],'');
			setcookie($PowerBB->_CONF['admin_password_cookie'],'');
            session_destroy();
			@header("Location: index.php");
			exit;
		}
	}
}

?>
