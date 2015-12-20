<?php

/**
*  The create date entry
*/

define('NO_TEMPLATE',true);

$CALL_SYSTEM				= 	array();
$CALL_SYSTEM['SECTION'] 	= 	true;

include('../common.php');

class PowerBBTHETA extends PowerBBInstall
{
	var $_TempArr 	= 	array();
	var $_Masseges	=	array();



	// The create_date entry
	function AddCreateDateEntry()
	{
		global $PowerBB;

      $info_query = $PowerBB->DB->sql_query("SELECT * FROM " . $PowerBB->table['subject'] . " WHERE id ORDER BY id ASC");
      $info_row   = $PowerBB->DB->sql_fetch_array($info_query);

		$CreateDate = $info_row['native_write_time'];

	   $update = $PowerBB->DB->sql_query('UPDATE ' . $PowerBB->table['info'] . " SET value='" . $CreateDate . "' WHERE var_name='create_date'");

		return ($update) ? true : false;
	}

}

$PowerBB->install = new PowerBBTHETA;

$PowerBB->html->page_header('تعديل تاريخ إنشاء وعمر المنتدى PBBoard');
$logo = $PowerBB->html->create_image(array('align'=>'right','alt'=>'PowerBB','src'=>'../logo.jpg','return'=>true));
$PowerBB->html->open_table('100%',true);
$PowerBB->html->cells($logo,'header_logo_side');

$PowerBB->html->close_table();
$PowerBB->html->make_link('الخطوه الأولى -> تعديل تاريخ إنشاء وعمر المنتدى','?step=1');

if ($PowerBB->_GET['step'] == 1)
{
	$PowerBB->html->close_table();


    $p[1] 		= 	$PowerBB->install->AddCreateDateEntry();
    $msgs[1] 	= 	($p[1]) ? 'تم تعديل تاريخ إنشاء وعمر المنتدى' : 'لم تم تعديل تاريخ إنشاء وعمر المنتدى';


	$PowerBB->html->open_p();

	foreach ($msgs as $msg)
	{
		$PowerBB->html->p_msg($msg);
	}

	$PowerBB->html->close_p();

$PowerBB->html->make_link('الخطوه الثانيه والأخيرة -> اتمام التعديل','?step=2');
}
elseif ($PowerBB->_GET['step'] == 2)
{

	$PowerBB->html->close_table();

		$PowerBB->html->open_p();
        $PowerBB->html->p_msg('تم تعديل تاريخ إنشاء المنتدى وعمره بنجاح');
		$PowerBB->html->close_p();

	    $PowerBB->html->make_link('الدخول إلى لوحة الإدارة','../../admin.php');
        $PowerBB->html->p_msg('');
        $PowerBB->html->make_link('الدخول إلى صفحة المنتدى الرئيسية','../../index.php');


}


?>
