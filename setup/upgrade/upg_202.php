<?php

/**
*  upgrader to version 2.0.2
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

		return ($PowerBB->_CONF['info_row']['MySBB_version'] == '2.0.1') ? true : false;
	}



	function UpdateVersion()
	{
		global $PowerBB;

		$update = $PowerBB->DB->sql_query("UPDATE " . $PowerBB->table['info'] . " SET value='2.0.2' WHERE var_name='MySBB_version'");

		return ($update) ? true : false;
	}

    function CreateReputation()
    {
    global $PowerBB;

	    $this->_TempArr['CreateArr']        =   array();
	    $this->_TempArr['CreateArr']['table_name']  =   $PowerBB->table['reputation'];
	    $this->_TempArr['CreateArr']['fields']    =   array();
	    $this->_TempArr['CreateArr']['fields'][]  =   'id INT( 9 ) NOT NULL AUTO_INCREMENT PRIMARY KEY';
	    $this->_TempArr['CreateArr']['fields'][]  =   'by_username VARCHAR( 100 ) NOT NULL';
	    $this->_TempArr['CreateArr']['fields'][]  =   'username VARCHAR( 100 ) NOT NULL';
	    $this->_TempArr['CreateArr']['fields'][]  =   'subject_title VARCHAR( 100 ) NOT NULL';
	    $this->_TempArr['CreateArr']['fields'][]  =   'reputationdate VARCHAR( 100 ) NOT NULL';
	    $this->_TempArr['CreateArr']['fields'][]  =   'reply_id int( 9 ) NOT NULL';
	    $this->_TempArr['CreateArr']['fields'][]  =   'subject_id int( 9 ) NOT NULL';
	    $this->_TempArr['CreateArr']['fields'][]  =   'comments TEXT NOT NULL';
	    $this->_TempArr['CreateArr']['fields'][]  =   'peg_count int( 9 ) NOT NULL';


    $create = $this->create_table($this->_TempArr['CreateArr']);

    return ($create) ? true : false;
    }

    function CreateRating()
    {
    global $PowerBB;

	    $this->_TempArr['CreateArr']        =   array();
	    $this->_TempArr['CreateArr']['table_name']  =   $PowerBB->table['rating'];
	    $this->_TempArr['CreateArr']['fields']    =   array();
	    $this->_TempArr['CreateArr']['fields'][]  =   'id INT( 9 ) NOT NULL AUTO_INCREMENT PRIMARY KEY';
	    $this->_TempArr['CreateArr']['fields'][]  =   'username VARCHAR( 100 ) NOT NULL';
	    $this->_TempArr['CreateArr']['fields'][]  =   'by_username VARCHAR( 100 ) NOT NULL';
	    $this->_TempArr['CreateArr']['fields'][]  =   'subject_title VARCHAR( 100 ) NOT NULL';
	    $this->_TempArr['CreateArr']['fields'][]  =   'ratingdate VARCHAR( 100 ) NOT NULL';
	    $this->_TempArr['CreateArr']['fields'][]  =   'subject_id int( 9 ) NOT NULL';


    $create = $this->create_table($this->_TempArr['CreateArr']);

    return ($create) ? true : false;
    }

	function AddActivateClosestick()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='activate_closestick',value='1'");

		return ($insert) ? true : false;
	}

	function AddReputationallw()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='reputationallw',value='0'");

		return ($insert) ? true : false;
	}

	function AddReputation_number()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='reputation_number',value='10'");

		return ($insert) ? true : false;
	}

	function AddShow_reputation_number()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='show_reputation_number',value='10'");

		return ($insert) ? true : false;
	}

    function AddReputation()
	{
		global $PowerBB;

		$this->_TempArr['AddArr']					=	array();
		$this->_TempArr['AddArr']['table']			=	$PowerBB->table['member'];
		$this->_TempArr['AddArr']['field_name']		=	'reputation';
		$this->_TempArr['AddArr']['field_des']		=	'INT( 9 ) NOT NULL';

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

	    function AddRating()
	{
		global $PowerBB;

		$this->_TempArr['AddArr']					=	array();
		$this->_TempArr['AddArr']['table']			=	$PowerBB->table['subject'];
		$this->_TempArr['AddArr']['field_name']		=	'rating';
		$this->_TempArr['AddArr']['field_des']		=	'INT( 9 ) NOT NULL';

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

	function AddRating_show()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='rating_show',value='1'");

		return ($insert) ? true : false;
	}

	function AddShow_rating_num_max()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='show_rating_num_max',value='5'");

		return ($insert) ? true : false;
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

	$PowerBB->functions->errorstop('يرجى التحقق من انك قمت بتشغيل تحديثات upg_201.php');
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


	$p[81] 		= 	$PowerBB->install->AddActivateClosestick();
    $msgs[81] 	= 	($p[81]) ? 'تم اضافة حقل تفعيل (إغلاق/تثبيت الموضوع) في الرد السريع' : 'لم يتم اضافة حقل تفعيل (إغلاق/تثبيت الموضوع) في الرد السريع';

    $p[82] 		= 	$PowerBB->install->AddReputationallw();
    $msgs[82] 	= 	($p[82]) ? 'تم اضافة حقل تفعيل نظام تقييم العضو ' : 'لم يتم اضافة حقل تفعيل نظام تقييم العضو ';

	$p[83] 		= 	$PowerBB->install->AddReputation_number();
    $msgs[83] 	= 	($p[83]) ? 'تم اضافة حقل عدد نقاط التقييم ' : 'لم يتم اضافة حقل عدد نقاط التقييم ';

	$p[84] 		= 	$PowerBB->install->AddShow_reputation_number();
    $msgs[84] 	= 	($p[84]) ? 'تم اضافة حقل عدد التقيمات المراد عرضها ' : 'لم يتم اضافة حقل عدد التقيمات المراد عرضها ';

    $p[85] 		= 	$PowerBB->install->AddReputation();
    $msgs[85] 	= 	($p[85]) ? 'تم اضافة حقل عدد نقاط سمعة العضو ' : 'لم يتم اضافة حقل عدد نقاط سمعة العضو ';

    $p[86] 		= 	$PowerBB->install->AddRating();
    $msgs[86] 	= 	($p[86]) ? 'تم اضافة حقل عدد نقاط تقييم الموضوع ' : 'لم يتم اضافة حقل عدد نقاط تقييم الموضوع ';

    $p[87] 		= 	$PowerBB->install->AddShow_rating_num_max();
    $msgs[87] 	= 	($p[87]) ? 'تم اضافة حقل تفعيل خاصية تقييم الموضوع ' : 'لم يتم اضافة حقل تفعيل خاصية تقييم الموضوع ';

    $p[88] 		= 	$PowerBB->install->AddRating_show();
    $msgs[88] 	= 	($p[88]) ? 'تم اضافة حقل أعلى عدد نقاط تقييم للموضوع ' : 'لم يتم اضافة حقل أعلى عدد نقاط تقييم للموضوع ';

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
    $PowerBB->install->CreateReputation();
    $PowerBB->install->CreateRating();

    $NewVersion = $PowerBB->install->UpdateVersion();

		$PowerBB->html->open_p();
        $PowerBB->html->p_msg('تم الترقية إلى الأصدار 2.0.2 بنجاح');
		$PowerBB->html->close_p();

	$PowerBB->html->open_p();
    $PowerBB->html->make_link('البدأ بالترقية إلى الإصدار 2.0.3','upg_203.php?step=1');
	$PowerBB->html->close_p();


}


?>
