<?php

(!defined('IN_PowerBB')) ? die() : '';

$CALL_SYSTEM				=	array();
$CALL_SYSTEM['SUBJECT'] 	= 	true;
$CALL_SYSTEM['SECTION'] 	= 	true;
$CALL_SYSTEM['MODERATORS'] 	= 	true;
$CALL_SYSTEM['REPLY'] 		= 	true;
$CALL_SYSTEM['SUPERMEMBERLOGS'] 			= 	true;

define('JAVASCRIPT_PowerCode',true);

include('common.php');

define('CLASS_NAME','PowerBBAJAXtMOD');

class PowerBBAJAXtMOD
{
	function run()
	{
		global $PowerBB;

		if ($PowerBB->_CONF['member_permission'])
		{
			if ($PowerBB->_GET['subjects'])
			{
		      $PowerBB->_POST['m_subject'] = $PowerBB->functions->CleanVariable($PowerBB->_POST['m_subject'],'intval');

				if ($PowerBB->_GET['rename'])
				{
					$this->_SubjectRename();
				}
				else
				{
			  	    $SubjectArr = array();
					$SubjectArr['where'] = array('id',$PowerBB->_POST['m_subject']);

					$SubjectInfo = $PowerBB->core->GetInfo($SubjectArr,'subject');
					echo "<a href='index.php?page=topic&show=1&id=".$PowerBB->_POST['m_subject']."{$password}'>".$SubjectInfo['title']."</a>";
				}
			}
			elseif ($PowerBB->_GET['coverPhotoUpload'])
			{
			 $this->_coverPhotoUpload();
			}
			elseif ($PowerBB->_GET['coverPhotoUploadStart'])
			{
			if ($PowerBB->_GET['ajaxValidate'])
			 {
			 $this->_coverPhotoUploadStart();
			 }
			}
			elseif ($PowerBB->_GET['coverPhotoRemove'])
			{
			 $this->_coverPhotoRemove();
			}
			else
			{
				@header("Location: index.php");
				exit;
			}
		}
		else
		{
			@header("Location: index.php");
			exit;
		}
	}


	function _SubjectRename()
	{
		global $PowerBB;
		if (empty($PowerBB->_POST['title']))
		{
			exit($PowerBB->_CONF['template']['_CONF']['lang']['no_title']);
		}

		$PowerBB->_POST['title'] 	= 	$PowerBB->functions->CleanVariable($PowerBB->_POST['title'],'html');
		$PowerBB->_POST['title'] = $PowerBB->functions->CleanVariable($PowerBB->_POST['title'],'sql');
        $PowerBB->_POST['title'] = $PowerBB->Powerparse->censor_words($PowerBB->_POST['title']);

		$SecArr 			= 	array();
		$SecArr['field'] 	= 	array();

		$SecArr['field']['title'] 	= 	$PowerBB->_POST['title'];
		$SecArr['field']['actiondate'] 	= 	$PowerBB->_CONF['now'];
     	$SecArr['field']['action_by'] 	= 	$PowerBB->_CONF['member_row']['username'];
		$SecArr['where']			= 	array('id',$PowerBB->_POST['m_subject']);

		$update = $PowerBB->core->Update($SecArr,'subject');

		$SectionArr 			= 	array();
		$SectionArr['field'] 	= 	array();

		$SectionArr['field']['last_subject'] 	= 	$PowerBB->_POST['title'];
		$SectionArr['where']			= 	array('last_subjectid',$PowerBB->_POST['m_subject']);

		$updateSection = $PowerBB->core->Update($SectionArr,'section');

		if ($updateSection)
		{
			  	    $SubjectArr = array();
					$SubjectArr['where'] = array('id',$PowerBB->_POST['m_subject']);

					$SubjectInfo = $PowerBB->core->GetInfo($SubjectArr,'subject');

     				$SecArr 			= 	array();
					$SecArr['where'] 	= 	array('id',$SubjectInfo['section']);

					$SectionInfo = $PowerBB->core->GetInfo($SecArr,'section');

     		// Update section's cache
     		$UpdateArr 				= 	array();
     		$UpdateArr['parent'] 	= 	$SectionInfo['parent'];

     		$update_cache = $PowerBB->section->UpdateSectionsCache($UpdateArr);

     		unset($UpdateArr);

			$cache = $PowerBB->section->UpdateSectionsCache(array('parent'=>$SubjectInfo['section']));
		}

		if ($update)
		{
			echo "<a href='index.php?page=topic&show=1&id=".$PowerBB->_POST['m_subject']."{$password}'>".$PowerBB->_POST['title']."</a>";
		}
	}



	function _coverPhotoRemove()
	{
		global $PowerBB;

		if(!isset($_SESSION['csrf']))
		{
		@header("Location: index.php");
		exit;
		}

		$user_id = $PowerBB->_CONF['member_row']['id'];

		$user_id = $PowerBB->functions->CleanVariable($user_id,'intval');

		if (file_exists($PowerBB->_CONF['member_row']['profile_cover_photo'])) {
		@unlink($PowerBB->_CONF['member_row']['profile_cover_photo']);
		}
		$UPDATE_user  = $PowerBB->DB->sql_query("UPDATE " . $PowerBB->table['member'] . " SET profile_cover_photo = '' WHERE id = '$user_id'");

		@header("Location: ".$PowerBB->_SERVER['HTTP_REFERER']);
		exit;
	}
}

?>
