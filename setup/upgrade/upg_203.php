<?php

/**
*  upgrader to version 2.0.3
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

		return ($PowerBB->_CONF['info_row']['MySBB_version'] == '2.0.2') ? true : false;
	}



	function UpdateVersion()
	{
		global $PowerBB;

		$update = $PowerBB->DB->sql_query("UPDATE " . $PowerBB->table['info'] . " SET value='2.0.3' WHERE var_name='MySBB_version'");

		return ($update) ? true : false;
	}

	function CreateChat_Message()
    {
    global $PowerBB;

	    $this->_TempArr['CreateArr']        =   array();
	    $this->_TempArr['CreateArr']['table_name']  =   $PowerBB->table['chat'];
	    $this->_TempArr['CreateArr']['fields']    =   array();
	    $this->_TempArr['CreateArr']['fields'][]  =   'id INT( 9 ) NOT NULL AUTO_INCREMENT PRIMARY KEY';
	    $this->_TempArr['CreateArr']['fields'][]  =   'username VARCHAR( 150 ) NOT NULL';
	    $this->_TempArr['CreateArr']['fields'][]  =   'country VARCHAR( 100 ) NOT NULL';
	    $this->_TempArr['CreateArr']['fields'][]  =   'message TEXT NOT NULL';
	    $this->_TempArr['CreateArr']['fields'][]  =   'user_id int( 9 ) NOT NULL';


    $create = $this->create_table($this->_TempArr['CreateArr']);

    return ($create) ? true : false;
    }


	function AddMaxOnline()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='max_online',value='1'");

		return ($insert) ? true : false;
	}

	function AddMaxOnlineDate()
	{
		global $PowerBB;
        $date = date("d/m/Y الساعة h:i a");
		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='max_online_date',value='$date'");

		return ($insert) ? true : false;
	}

	function AddSmilesNmMaxInBox()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='smiles_nm',value='12'");

		return ($insert) ? true : false;
	}

		function Addshow_online_list_today()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='show_online_list_today',value='1'");

		return ($insert) ? true : false;
	}

		function Addrandom_ads()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='random_ads',value='0'");

		return ($insert) ? true : false;
	}

	function Addshow_ads()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='show_ads',value='1'");

		return ($insert) ? true : false;
	}

	function Addshow_list_last_5_posts_member()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='show_list_last_5_posts_member',value='0'");

		return ($insert) ? true : false;
	}

	function Addlast_subject_writer_nm()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='last_subject_writer_nm',value='5'");

		return ($insert) ? true : false;
	}

	function Addlast_subject_writer_not_in()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='last_subject_writer_not_in',value='700,800,900'");

		return ($insert) ? true : false;
	}

	function Addactivate_chat_bar()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='activate_chat_bar',value='0'");

		return ($insert) ? true : false;
	}

	function Addchat_message_num()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='chat_message_num',value='15'");

		return ($insert) ? true : false;
	}

	function Addchat_num_mem_posts()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='chat_num_mem_posts',value='20'");

		return ($insert) ? true : false;
	}

	function Addchat_num_characters()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='chat_num_characters',value='350'");

		return ($insert) ? true : false;
	}

	function Addchat_hide_country()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='chat_hide_country',value='1'");

		return ($insert) ? true : false;
	}

	function Addchat_bar_dir()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='chat_bar_dir',value='right'");

		return ($insert) ? true : false;
	}
 /*
	function AddLangOrder()
	{
		global $PowerBB;

		$this->_TempArr['AddArr'] 			= 	array();
		$this->_TempArr['AddArr']['table'] 		= 	$PowerBB->table['lang'];
		$this->_TempArr['AddArr']['field_name'] 	= 	'lang_order';
		$this->_TempArr['AddArr']['field_des'] 		= 	'int(9) NOT NULL';

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}
  */

}

$PowerBB->install = new PowerBBTHETA;

$PowerBB->html->page_header('معالج ترقية برنامج منتديات PBBoard 2.0.3');

$logo = $PowerBB->html->create_image(array('align'=>'right','alt'=>'PowerBB','src'=>'../logo.jpg','return'=>true));
$PowerBB->html->open_table('100%',true);
$PowerBB->html->cells($logo,'header_logo_side');

if (!$PowerBB->install->CheckVersion())
{
	$PowerBB->html->cells('اصدار غير صحيح','main1');
	$PowerBB->html->close_table();

	$PowerBB->functions->errorstop('يرجى التحقق من انك قمت بتشغيل تحديثات upg_202.php');
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


	$p[89] 		= 	$PowerBB->install->AddMaxOnline();
    $msgs[89] 	= 	($p[89]) ? 'تمت اضافة حقل أكبر تواجد بالمنتدى' : 'لم يتم اضافة حقل أكبر تواجد بالمنتدى';

    $p[90] 		= 	$PowerBB->install->AddMaxOnlineDate();
    $msgs[90] 	= 	($p[90]) ? 'تمت اضافة حقل تاريخ أكبر تواجد بالمنتدى ' : 'لم يتم اضافة حقل تاريخ أكبر تواجد بالمنتدى ';

	$p[91] 		= 	$PowerBB->install->AddSmilesNmMaxInBox();
    $msgs[91] 	= 	($p[91]) ? 'تم اضافة حقل عدد الابتسامات في الصندوق ' : 'لم يتم اضافة حقل عدد الابتسامات في الصندوق ';

    $p[92] 		= 	$PowerBB->install->Addshow_online_list_today();
    $msgs[92] 	= 	($p[92]) ? 'تم اضافة حقل تفعيل ظهور قائمة المتواجدون اليوم ' : 'لم يتم اضافة حقل  تفعيل ظهور قائمة المتواجدون اليوم ';

    $p[93] 		= 	$PowerBB->install->Addrandom_ads();
    $msgs[93] 	= 	($p[93]) ? 'تم اضافة حقل تمكين مشاهدة الإعلانات العشوائية ' : 'لم يتم اضافة حقل تمكين مشاهدة الإعلانات العشوائية ';

    $p[94] 		= 	$PowerBB->install->Addshow_ads();
    $msgs[94] 	= 	($p[94]) ? 'تم اضافة حقل مشاهدة كافة الإعلانات التجارية ' : 'لم يتم اضافة حقل  مشاهدة كافة الإعلانات التجارية ';

    $p[95] 		= 	$PowerBB->install->Addshow_list_last_5_posts_member();
    $msgs[95] 	= 	($p[95]) ? 'تم اضافة حقل عرض قائمة آخر 5 مواضيع للعضو أسفل معلوماته في المشاركات والمواضيع ' : 'لم يتم اضافة حقل  عرض قائمة آخر 5 مواضيع للعضو أسفل معلوماته في المشاركات والمواضيع ';

    $p[96] 		= 	$PowerBB->install->Addlast_subject_writer_nm();
    $msgs[96] 	= 	($p[96]) ? 'تم اضافة حقل عدد مواضيع العضو ' : 'لم يتم اضافة حقل  عدد مواضيع العضو ';

    $p[97] 		= 	$PowerBB->install->Addlast_subject_writer_not_in();
    $msgs[97] 	= 	($p[97]) ? 'تم اضافة ارقام المنتديات التي ترغب بإخفاء مواضيعها من الظهور في قائمة من مواضيع العضو ' : 'لم يتم اضافة حقل ارقام المنتديات التي ترغب بإخفاء مواضيعها من الظهور في قائمة من مواضيع العضو ';

    $p[98] 		= 	$PowerBB->install->Addactivate_chat_bar();
    $msgs[98] 	= 	($p[98]) ? 'تمت اضافة حقل تفعيل مشاهدة شريط الإهداءات' : 'لم يتم اضافة حقل تفعيل مشاهدة شريط الإهداءات';

    $p[99] 		= 	$PowerBB->install->Addchat_num_mem_posts();
    $msgs[99] 	= 	($p[99]) ? 'تمت اضافة حقل تحديد الحد الأدنى لـ عدد المشاركات (مشاركات العضو) ليتمكن من اضافة إهداء' : 'لم يتم اضافة حقل تحديد الحد الأدنى لـ عدد المشاركات (مشاركات العضو) ليتمكن من اضافة إهداء';

    $p[100] 		= 	$PowerBB->install->Addchat_num_characters();
    $msgs[100] 	= 	($p[100]) ? 'تمت اضافة حقل أقصى عدد لحروف الإهداء' : 'لم يتم اضافة حقل أقصى عدد لحروف الإهداء';

    $p[101] 		= 	$PowerBB->install->Addchat_hide_country();
    $msgs[101] 	= 	($p[101]) ? 'تمت اضافة حقل إظهار البلد' : 'لم يتم اضافة حقل إظهار البلد';

    $p[102] 		= 	$PowerBB->install->Addchat_bar_dir();
    $msgs[102] 	= 	($p[102]) ? 'تمت اضافة حقل تحديد إتجاه مسار شريط الإهداءات' : 'لم يتم اضافة حقل تحديد إتجاه مسار شريط الإهداءات';

    $p[103] 		= 	$PowerBB->install->Addchat_message_num();
    $msgs[103] 	= 	($p[103]) ? 'تمت اضافة حقل عدد الإهداءات التي تظهر بالشريط' : 'لم يتم اضافة حقل عدد الإهداءات التي تظهر بالشريط';
    /*
    $p[104] 		= 	$PowerBB->install->AddLangOrder();
    $msgs[104] 	= 	($p[104]) ? 'تم اضافة حقل ترتيب اللغات' : 'لم يتم اضافة حقل ترتيب اللغات';
    */

	$PowerBB->html->open_p();

	foreach ($msgs as $msg)
	{
		$PowerBB->html->p_msg($msg);
	}

	$PowerBB->html->close_p();

$PowerBB->html->make_link('الخطوه الثانيه  -> إدخال الحقول الملحقة الأضافية','?step=2');
}
elseif ($PowerBB->_GET['step'] == 2)
{
$PowerBB->html->cells('الخطوة الثانية','main1');

	$PowerBB->html->close_table();
    $PowerBB->install->CreateChat_Message();
    $NewVersion = $PowerBB->install->UpdateVersion();

	$PowerBB->html->open_p();
    $PowerBB->html->make_link('إدخال الحقول الملحقة الأضافية','upg_203_1.php?step=1');
	$PowerBB->html->close_p();


}


?>
