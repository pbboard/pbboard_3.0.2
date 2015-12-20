<?php

/**
*  upgrader to version 2.1.2
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

		return ($PowerBB->_CONF['info_row']['MySBB_version'] == '2.1.1') ? true : false;
	}


	function UpdateVersion()
	{
		global $PowerBB;

		$update = $PowerBB->DB->sql_query("UPDATE " . $PowerBB->table['info'] . " SET value='2.1.2' WHERE var_name='MySBB_version'");

		return ($update) ? true : false;
	}

    function Addreview_reply()
	{
		global $PowerBB;

		$this->_TempArr['AddArr']					=	array();
		$this->_TempArr['AddArr']['table']			=	$PowerBB->table['group'];
		$this->_TempArr['AddArr']['field_name']		=	'review_reply';
		$this->_TempArr['AddArr']['field_des']		=	"int(1) NOT NULL DEFAULT '0'";

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

    function Addreview_subject()
	{
		global $PowerBB;

		$this->_TempArr['AddArr']					=	array();
		$this->_TempArr['AddArr']['table']			=	$PowerBB->table['group'];
		$this->_TempArr['AddArr']['field_name']		=	'review_subject';
		$this->_TempArr['AddArr']['field_des']		=	"int(1) NOT NULL DEFAULT '0'";

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

}

$PowerBB->install = new PowerBBTHETA;

$PowerBB->html->page_header('معالج ترقية برنامج منتديات PBBoard 2.1.2');

$logo = $PowerBB->html->create_image(array('align'=>'right','alt'=>'PowerBB','src'=>'../logo.jpg','return'=>true));
$PowerBB->html->open_table('100%',true);
$PowerBB->html->cells($logo,'header_logo_side');

if (!$PowerBB->install->CheckVersion())
{
	$PowerBB->html->cells('اصدار غير صحيح','main1');
	$PowerBB->html->close_table();

	$PowerBB->functions->errorstop('يرجى التحقق من انك قمت بتشغيل تحديثات upg_210.php');
$PowerBB->html->close_table();
}
if ($PowerBB->_GET['step'] == 0)
{

$PowerBB->html->cells('الترقية إلى الإصدار 2.1.2 من  برنامج PBBoard','main1');
$PowerBB->html->close_p();
$PowerBB->html->close_table();
$PowerBB->html->make_link('الخطوه الأولى -> أدخال الإستعلامات','?step=1');
}
if ($PowerBB->_GET['step'] == 1)
{
	$PowerBB->html->cells('عمليات الاضافه','main1');
	$PowerBB->html->close_table();


   $p[1] 		= 	$PowerBB->install->Addreview_reply();
   $msgs[1] 	= 	($p[1]) ? 'تم إنشاء حقل review_reply ' : 'لم يتم إنشاء حقل review_reply';

   $p[2] 		= 	$PowerBB->install->Addreview_subject();
   $msgs[2] 	= 	($p[2]) ? 'تم إنشاء حقل review_subject ' : 'لم يتم إنشاء حقل review_subject';


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
        $PowerBB->html->p_msg('تم الترقية إلى الأصدار 2.1.2 بنجاح');
		$PowerBB->html->close_p();

		$PowerBB->html->open_p();
		$PowerBB->html->make_link('البدأ بالترقية إلى الإصدار 2.1.3','upg_213.php?step=1');
		$PowerBB->html->close_p();


}


?>
