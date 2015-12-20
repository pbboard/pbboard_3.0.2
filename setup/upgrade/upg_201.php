<?php

/**
*  upgrader to version 2.0.1
*/

define('NO_TEMPLATE',true);

$CALL_SYSTEM				= 	array();
$CALL_SYSTEM['SECTION'] 	= 	true;

include('../common.php');

class PowerBBTHETA extends PowerBBInstall
{
	var $_TempArr 	= 	array();
	var $_Masseges	=	array();

	function CheckVersion()
	{
		global $PowerBB;

		return ($PowerBB->_CONF['info_row']['MySBB_version'] == '2.0.0') ? true : false;
	}


	function UpdateVersion()
	{
		global $PowerBB;

		$update = $PowerBB->DB->sql_query("UPDATE " . $PowerBB->table['info'] . " SET value='2.0.1' WHERE var_name='MySBB_version'");

		return ($update) ? true : false;
	}


	function AddReviewReplySubject()
	{
		global $PowerBB;

		$this->_TempArr['AddArr']					=	array();
		$this->_TempArr['AddArr']['table']			=	$PowerBB->table['subject'];
		$this->_TempArr['AddArr']['field_name']		=	'review_reply';
		$this->_TempArr['AddArr']['field_des']		=	'int(1) NOT NULL';

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

	function AddReviewReply()
	{
		global $PowerBB;

		$this->_TempArr['AddArr']					=	array();
		$this->_TempArr['AddArr']['table']			=	$PowerBB->table['member'];
		$this->_TempArr['AddArr']['field_name']		=	'review_reply';
		$this->_TempArr['AddArr']['field_des']		=	'int(1) NOT NULL';

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

	function AddReview_Reply()
	{
		global $PowerBB;

		$this->_TempArr['AddArr']					=	array();
		$this->_TempArr['AddArr']['table']			=	$PowerBB->table['reply'];
		$this->_TempArr['AddArr']['field_name']		=	'review_reply';
		$this->_TempArr['AddArr']['field_des']		=	'int(1) NOT NULL';

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

	function ChangeActionDateSubject()
	{
		global $PowerBB;

		 $change = $PowerBB->DB->sql_query("ALTER TABLE " . $PowerBB->table['subject'] . " CHANGE actiondate actiondate VARCHAR( 50 ) NOT NULL");

        return ($change) ? true : false;
	}

	function ChangeSmilePathReply()
	{
		global $PowerBB;

		 $change = $PowerBB->DB->sql_query("ALTER TABLE " . $PowerBB->table['reply'] . " CHANGE actiondate actiondate VARCHAR( 50 ) NOT NULL");

        return ($change) ? true : false;
	}




}

$PowerBB->install = new PowerBBTHETA;

$PowerBB->html->page_header('معالج ترقية برنامج منتديات PowerBB');

$logo = $PowerBB->html->create_image(array('align'=>'right','alt'=>'PowerBB','src'=>'../logo.jpg','return'=>true));
$PowerBB->html->open_table('100%',true);
$PowerBB->html->cells($logo,'header_logo_side');

if (!$PowerBB->install->CheckVersion())
{
	$PowerBB->html->cells('اصدار غير صحيح','main1');
	$PowerBB->html->close_table();

	$PowerBB->functions->errorstop('يرجى التحقق من انك قمت بتشغيل تحديثات THETA');
}
else
{
$PowerBB->html->close_table();

$PowerBB->html->make_link('الخطوه الأولى -> أدخال الإستعلامات','?step=1');
 }
if ($PowerBB->_GET['step'] == 1)
{
	$PowerBB->html->cells('عمليات الاضافه','main1');
	$PowerBB->html->close_table();


	$p[76] 		= 	$PowerBB->install->AddReviewReplySubject();
	$msgs[76] 	= 	($p[76]) ? 'تم اضافة حقل1 ردود في انتظار الموافقه' : 'لم يتم اضافة حقل1 ردود في انتظار الموافقه';

	$p[77] 		= 	$PowerBB->install->AddReviewReply();
	$msgs[77] 	= 	($p[77]) ? 'تم اضافة حقل2 ردود في انتظار الموافقه' : 'لم يتم اضافة حقل2 ردود في انتظار الموافقه';

	$p[78] 		= 	$PowerBB->install->AddReview_Reply();
	$msgs[78] 	= 	($p[78]) ? 'تم اضافة حقل3 ردود في انتظار الموافقه' : 'لم يتم اضافة حقل3 ردود في انتظار الموافقه';

	$p[79] 		= 	$PowerBB->install->ChangeActionDateSubject();
	$msgs[79] 	= 	($p[79]) ? 'تم تغيير حقل تاريخ تحرير الموضوع' : 'لم يتم تغيير حقل تاريخ تحرير الموضوع';

	$p[80] 		= 	$PowerBB->install->ChangeSmilePathReply();
	$msgs[80] 	= 	($p[80]) ? 'تم تغيير حقل تاريخ تحرير المشاركة' : 'لم يتم تغيير حقل تاريخ تحرير المشاركة';


	$PowerBB->html->open_p();

	foreach ($msgs as $msg)
	{
		$PowerBB->html->p_msg($msg);
	}

	$PowerBB->html->close_p();

$PowerBB->html->make_link('الخطوه الثانيه والأخيرة -> اتمام الترقية','?step=2');
}
elseif ($PowerBB->_GET['step'] == 2)
{
	$PowerBB->html->cells('الخطوة النهائية','main1');

	$PowerBB->html->close_table();

	$Update = $PowerBB->section->UpdateAllSectionsCache();

    $PowerBB->section->UpdateSectionsCache(array('id'=>'normal'));
    $NewVersion = $PowerBB->install->UpdateVersion();

    $PowerBB->html->open_p();
	$PowerBB->html->make_link('البدأ بالترقية إلى الإصدار 2.0.2','upg_202.php?step=1');
	$PowerBB->html->close_p();



}


?>
