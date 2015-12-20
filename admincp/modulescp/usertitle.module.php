<?php

(!defined('IN_PowerBB')) ? die() : '';

define('IN_ADMIN',true);

$CALL_SYSTEM				=	array();
$CALL_SYSTEM['USERTITLE'] 	= 	true;

include('../common.php');

define('CLASS_NAME','PowerBBUsertitleMOD');

class PowerBBUsertitleMOD extends _functions
{
	function run()
	{
		global $PowerBB;

		if ($PowerBB->_CONF['member_permission'])
		{
			$PowerBB->template->display('header');

			if ($PowerBB->_CONF['rows']['group_info']['admincp_membertitle'] == '0')
			{
			  $PowerBB->functions->error($PowerBB->_CONF['template']['_CONF']['lang']['error_permission']);
			}

			if ($PowerBB->_GET['add'])
			{
				if ($PowerBB->_GET['main'])
				{
					$this->_AddMain();
				}
				elseif ($PowerBB->_GET['start'])
				{
					$this->_AddStart();
				}
			}
			elseif ($PowerBB->_GET['control'])
			{
				if ($PowerBB->_GET['main'])
				{
					$this->_ControlMain();
				}
			}
			elseif ($PowerBB->_GET['edit'])
			{
				if ($PowerBB->_GET['main'])
				{
					$this->_EditMain();
				}
				elseif ($PowerBB->_GET['start'])
				{
					$this->_EditStart();
				}
			}
			elseif ($PowerBB->_GET['del'])
			{
				if ($PowerBB->_GET['main'])
				{
					$this->_DelMain();
				}
				elseif ($PowerBB->_GET['start'])
				{
					$this->_DelStart();
				}
			}

			$PowerBB->template->display('footer');
		}
	}

	function _AddMain()
	{
		global $PowerBB;

		$PowerBB->template->display('usertitle_add');
	}

	function _AddStart()
	{
		global $PowerBB;

		if (empty($PowerBB->_POST['title'])
			or empty($PowerBB->_POST['posts']))
		{
			$PowerBB->functions->error($PowerBB->_CONF['template']['_CONF']['lang']['Please_fill_in_all_the_information']);
		}

		$UTArr 			= 	array();
		$UTArr['field']	=	array();

		$UTArr['field']['usertitle'] 	= 	$PowerBB->_POST['title'];
		$UTArr['field']['posts'] 		= 	$PowerBB->_POST['posts'];

		$insert = $PowerBB->usertitle->InsertUsertitle($UTArr);

		if ($insert)
		{

	       $cache = $PowerBB->usertitle->UpdateTitlesCache(null);
	       //////////
			$PowerBB->functions->msg($PowerBB->_CONF['template']['_CONF']['lang']['usertitle_has_been_added_successfully']);
			$PowerBB->functions->redirect('index.php?page=usertitle&amp;control=1&amp;main=1');
		}
	}

	function _ControlMain()
	{
		global $PowerBB;

		$UTArr 						= 	array();
		$UTArr['proc'] 				= 	array();
		$UTArr['proc']['*'] 		= 	array('method'=>'clean','param'=>'html');

		$UTArr['order']				=	array();
		$UTArr['order']['field']	=	'posts';
		$UTArr['order']['type']		=	'ASC';

		$PowerBB->_CONF['template']['while']['UTList'] = $PowerBB->usertitle->GetUsertitleList($UTArr);

		$PowerBB->template->display('usertitles_main');
	}

	function _EditMain()
	{
		global $PowerBB;

		$this->check_by_id($PowerBB->_CONF['template']['Inf']);

		$PowerBB->template->display('usertitle_edit');
	}

	function _EditStart()
	{
		global $PowerBB;

		$this->check_by_id($UTInfo);

		if (empty($PowerBB->_POST['title'])
			or empty($PowerBB->_POST['posts']))
		{
			$PowerBB->functions->error($PowerBB->_CONF['template']['_CONF']['lang']['Please_fill_in_all_the_information']);
		}

		$UTArr 			= 	array();
		$UTArr['field']	=	array();

		$UTArr['field']['usertitle'] 	= 	$PowerBB->_POST['title'];
		$UTArr['field']['posts'] 		= 	$PowerBB->_POST['posts'];
		$UTArr['where']					=	array('id',$UTInfo['id']);

		$update = $PowerBB->usertitle->UpdateUsertitle($UTArr);

		if ($update)
		{
	       $cache = $PowerBB->usertitle->UpdateTitlesCache(null);
	       //////////
			$PowerBB->functions->msg($PowerBB->_CONF['template']['_CONF']['lang']['usertitle_has_been_updated_successfully']);
			$PowerBB->functions->redirect('index.php?page=usertitle&amp;control=1&amp;main=1');
		}
	}

	function _DelMain()
	{
		global $PowerBB;

		$this->check_by_id($PowerBB->_CONF['template']['Inf']);

		$PowerBB->template->display('usertitle_del');
	}

	function _DelStart()
	{
		global $PowerBB;

		$this->check_by_id($UTInfo);

		$DelArr 			= 	array();
		$DelArr['where'] 	= 	array('id',$PowerBB->_GET['id']);

		$del = $PowerBB->usertitle->DeleteUsertitle($DelArr);

		if ($del)
		{
	       $cache = $PowerBB->usertitle->UpdateTitlesCache(null);
	       //////////
			$PowerBB->functions->msg($PowerBB->_CONF['template']['_CONF']['lang']['usertitle_has_been_deleted_successfully']);
			$PowerBB->functions->redirect('index.php?page=usertitle&amp;control=1&amp;main=1');
		}
	}
}

class _functions
{
	function check_by_id(&$UTInfo)
	{
		global $PowerBB;

		if (empty($PowerBB->_GET['id']))
		{
			$PowerBB->functions->error($PowerBB->_CONF['template']['_CONF']['lang']['The_request_is_not_valid']);
		}

		$PowerBB->_GET['id'] = $PowerBB->functions->CleanVariable($PowerBB->_GET['id'],'intval');

		$UTArr 				= 	array();
		$UTArr['where'] 	= 	array('id',$PowerBB->_GET['id']);

		$UTInfo = $PowerBB->usertitle->GetUsertitleInfo($UTArr);

		if ($UTInfo == false)
		{
			$PowerBB->functions->error($PowerBB->_CONF['template']['_CONF']['lang']['usertitle_requested_does_not_exist']);
		}

		$PowerBB->functions->CleanVariable($UTInfo,'html');
	}
}

?>
