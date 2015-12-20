<?php

/**
*  upgrader to version 2.0.5
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

		return ($PowerBB->_CONF['info_row']['MySBB_version'] == '2.0.4') ? true : false;
	}


	function UpdateVersion()
	{
		global $PowerBB;

		$update = $PowerBB->DB->sql_query("UPDATE " . $PowerBB->table['info'] . " SET value='2.0.5' WHERE var_name='MySBB_version'");

		return ($update) ? true : false;
	}

    function AddAddReasonEditReply()
	{
		global $PowerBB;

		$this->_TempArr['AddArr']					=	array();
		$this->_TempArr['AddArr']['table']			=	$PowerBB->table['reply'];
		$this->_TempArr['AddArr']['field_name']		=	'reason_edit';
		$this->_TempArr['AddArr']['field_des']		=	'varchar(200) NOT NULL';

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

    function AddAddReasonEditSubject()
	{
		global $PowerBB;

		$this->_TempArr['AddArr']					=	array();
		$this->_TempArr['AddArr']['table']			=	$PowerBB->table['subject'];
		$this->_TempArr['AddArr']['field_name']		=	'reason_edit';
		$this->_TempArr['AddArr']['field_des']		=	'varchar(200) NOT NULL';

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

	function AddAllowedPowered()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='allowed_powered',value='1'");

		return ($insert) ? true : false;
	}

}

$PowerBB->install = new PowerBBTHETA;

$PowerBB->html->page_header('معالج ترقية برنامج منتديات PBBoard 2.0.5');

$logo = $PowerBB->html->create_image(array('align'=>'right','alt'=>'PowerBB','src'=>'../logo.jpg','return'=>true));
$PowerBB->html->open_table('100%',true);
$PowerBB->html->cells($logo,'header_logo_side');

if (!$PowerBB->install->CheckVersion())
{
	$PowerBB->html->cells('اصدار غير صحيح','main1');
	$PowerBB->html->close_table();

	$PowerBB->functions->errorstop('يرجى التحقق من انك قمت بتشغيل تحديثات upg_204.php');
$PowerBB->html->close_table();
}
if ($PowerBB->_GET['step'] == 0)
{
$PowerBB->html->close_p();
$PowerBB->html->close_table();
$PowerBB->html->cells('الترقية إلى الإصدار 2.0.5 من  برنامج PBBoard','main1');
$PowerBB->html->close_p();
$PowerBB->html->close_table();
$PowerBB->html->make_link('الخطوه الأولى -> أدخال الإستعلامات','?step=1');
}
if ($PowerBB->_GET['step'] == 1)
{
	$PowerBB->html->cells('عمليات الاضافه','main1');
	$PowerBB->html->close_table();


    $p[1] 		= 	$PowerBB->install->AddAddReasonEditReply();
    $msgs[1] 	= 	($p[1]) ? 'تم إنشاء حقل reason_edit_reply' : 'لم يتم إنشاء حقل reason_edit';

    $p[2] 		= 	$PowerBB->install->AddAddReasonEditSubject();
    $msgs[2] 	= 	($p[2]) ? 'تم إنشاء حقل reason_edit_subject' : 'لم يتم إنشاء حقل reason_edit';

    $p[3] 		= 	$PowerBB->install->AddAllowedPowered();
    $msgs[3] 	= 	($p[3]) ? 'تم إنشاء حقل allowed_powered' : 'لم يتم إنشاء حقل reason_edit';

	$PowerBB->html->open_p();

	foreach ($msgs as $msg)
	{
		$PowerBB->html->p_msg($msg);
	}

	$PowerBB->html->close_p();

$PowerBB->html->close_table();
$PowerBB->html->make_link('الخطوه الثانية والأخيرة -> اتمام الترقية','?step=2');
}
elseif ($PowerBB->_GET['step'] == 2)
{
	$PowerBB->html->cells('الخطوة النهائية','main1');

	$PowerBB->html->close_table();

	$NewVersion = $PowerBB->install->UpdateVersion();

		$PowerBB->html->open_p();
        $PowerBB->html->p_msg('تم الترقية إلى الأصدار 2.0.5 بنجاح');
		$PowerBB->html->close_p();

		$PowerBB->html->open_p();
		$PowerBB->html->make_link('البدأ بالترقية إلى الإصدار 2.1.0','upg_210.php?step=1');
		$PowerBB->html->close_p();


}


?>
