<?php

/**
*  upgrader to version 2.0.3 nm 1
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

		return ($PowerBB->_CONF['info_row']['MySBB_version'] == '2.0.3') ? true : false;
	}

	function AddLastTime()
	{
		global $PowerBB;

		$this->_TempArr['AddArr'] 			= 	array();
		$this->_TempArr['AddArr']['table'] 		= 	$PowerBB->table['section'];
		$this->_TempArr['AddArr']['field_name'] 	= 	'last_time';
		$this->_TempArr['AddArr']['field_des'] 		= 	'VARCHAR( 60 ) NOT NULL';

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

	function AddLastReply()
	{
		global $PowerBB;

		$this->_TempArr['AddArr'] 			= 	array();
		$this->_TempArr['AddArr']['table'] 		= 	$PowerBB->table['section'];
		$this->_TempArr['AddArr']['field_name'] 	= 	'last_reply';
		$this->_TempArr['AddArr']['field_des'] 		= 	'int(9) NOT NULL';

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

	function AddLastCountPerpage()
	{
		global $PowerBB;

		$this->_TempArr['AddArr'] 			= 	array();
		$this->_TempArr['AddArr']['table'] 		= 	$PowerBB->table['section'];
		$this->_TempArr['AddArr']['field_name'] 	= 	'last_berpage_nm';
		$this->_TempArr['AddArr']['field_des'] 		= 	'int(9) NOT NULL';

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

	function AddLastTimeSubject()
	{
		global $PowerBB;

		$this->_TempArr['AddArr'] 			= 	array();
		$this->_TempArr['AddArr']['table'] 		= 	$PowerBB->table['subject'];
		$this->_TempArr['AddArr']['field_name'] 	= 	'last_time';
		$this->_TempArr['AddArr']['field_des'] 		= 	'VARCHAR( 60 ) NOT NULL';

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

	 function AddLastTimeReply()
	{
		global $PowerBB;

		$this->_TempArr['AddArr'] 			= 	array();
		$this->_TempArr['AddArr']['table'] 		= 	$PowerBB->table['reply'];
		$this->_TempArr['AddArr']['field_name'] 	= 	'last_time';
		$this->_TempArr['AddArr']['field_des'] 		= 	'VARCHAR( 60 ) NOT NULL';

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}


}

$PowerBB->install = new PowerBBTHETA;

$PowerBB->html->page_header('معالج ترقية برنامج منتديات PBBoard');

$logo = $PowerBB->html->create_image(array('align'=>'right','alt'=>'PowerBB','src'=>'../logo.jpg','return'=>true));
$PowerBB->html->open_table('100%',true);
$PowerBB->html->cells($logo,'header_logo_side');

if (!$PowerBB->install->CheckVersion())
{
	$PowerBB->html->cells('اصدار غير صحيح','main1');
	$PowerBB->html->close_table();

	$PowerBB->functions->errorstop('يرجى التحقق من انك قمت بتشغيل تحديثات upg_203.php');
}
else
{
$PowerBB->html->close_table();

$PowerBB->html->make_link('الخطوه الأولى -> إدخال الحقول الملحقة الأضافية','?step=1');
 }
if ($PowerBB->_GET['step'] == 1)
{
	$PowerBB->html->cells('عمليات الاضافه','main1');
	$PowerBB->html->close_table();


    $p[105] 		= 	$PowerBB->install->AddLastTime();
    $msgs[105] 	= 	($p[105]) ? 'تم إنشاء حقل last_time' : 'لم يتم إنشاء حقل last_time';

    $p[106] 		= 	$PowerBB->install->AddLastReply();
    $msgs[106] 	= 	($p[106]) ? 'تم إنشاء حقل last_reply' : 'لم يتم إنشاء حقل last_reply';

    $p[107] 		= 	$PowerBB->install->AddLastCountPerpage();
    $msgs[107] 	= 	($p[107]) ? 'تم إنشاء حقل last_berpage_nm' : 'لم يتم إنشاء حقل last_berpage_nm';

    $p[108] 		= 	$PowerBB->install->AddLastTimeSubject();
    $msgs[108] 	= 	($p[108]) ? 'تم إنشاء حقل last_time2' : 'لم يتم إنشاء حقل last_time2';

    $p[109] 		= 	$PowerBB->install->AddLastTimeReply();
    $msgs[109] 	= 	($p[109]) ? 'تم إنشاء حقل last_time3' : 'لم يتم إنشاء حقل last_time3';


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

		$PowerBB->html->open_p();
        $PowerBB->html->p_msg('تم الترقية إلى الأصدار 2.0.3 بنجاح');
		$PowerBB->html->close_p();

	$PowerBB->html->open_p();
    $PowerBB->html->make_link('البدأ بالترقية إلى الإصدار 2.0.4','upg_204.php?step=1');
	$PowerBB->html->close_p();


}


?>
