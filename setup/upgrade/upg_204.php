<?php

/**
*  upgrader to version 2.0.4
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


	function UpdateVersion()
	{
		global $PowerBB;

		$update = $PowerBB->DB->sql_query("UPDATE " . $PowerBB->table['info'] . " SET value='2.0.4' WHERE var_name='MySBB_version'");

		return ($update) ? true : false;
	}

    function CreateEmailed()
    {
    global $PowerBB;

	    $this->_TempArr['CreateArr']        =   array();
	    $this->_TempArr['CreateArr']['table_name']  =   $PowerBB->table['emailed'];
	    $this->_TempArr['CreateArr']['fields']    =   array();
	    $this->_TempArr['CreateArr']['fields'][]  =   'id INT( 9 ) NOT NULL AUTO_INCREMENT PRIMARY KEY';
	    $this->_TempArr['CreateArr']['fields'][]  =   'user_id int( 9 ) NOT NULL';
	    $this->_TempArr['CreateArr']['fields'][]  =   'subject_title VARCHAR( 200 ) NOT NULL';
	    $this->_TempArr['CreateArr']['fields'][]  =   'section_title VARCHAR( 200 ) NOT NULL';
	    $this->_TempArr['CreateArr']['fields'][]  =   'subject_id int( 9 ) NOT NULL';
	    $this->_TempArr['CreateArr']['fields'][]  =   'section_id int( 9 ) NOT NULL';
	    $this->_TempArr['CreateArr']['fields'][]  =   "autosubscribe int(1) NOT NULL DEFAULT '0'";

    $create = $this->create_table($this->_TempArr['CreateArr']);

    return ($create) ? true : false;
    }

    function CreateVisitor()
    {
    global $PowerBB;

	    $this->_TempArr['CreateArr']        =   array();
	    $this->_TempArr['CreateArr']['table_name']  =   $PowerBB->table['visitor'];
	    $this->_TempArr['CreateArr']['fields']    =   array();
	    $this->_TempArr['CreateArr']['fields'][]  =   'id INT( 9 ) NOT NULL AUTO_INCREMENT PRIMARY KEY';
	    $this->_TempArr['CreateArr']['fields'][]  =   'lang_id int( 9 ) NOT NULL';
	    $this->_TempArr['CreateArr']['fields'][]  =   'ip VARCHAR( 100 ) NOT NULL';

     $create = $this->create_table($this->_TempArr['CreateArr']);

    return ($create) ? true : false;
    }

    function CreateAward()
    {
         global $PowerBB;

        $this->_TempArr['CreateArr']        =   array();
        $this->_TempArr['CreateArr']['table_name']  =   $PowerBB->table['award'];
        $this->_TempArr['CreateArr']['fields']    =   array();
        $this->_TempArr['CreateArr']['fields'][]  =   'id INT( 10 ) NOT NULL AUTO_INCREMENT PRIMARY KEY';
        $this->_TempArr['CreateArr']['fields'][]  =   'award VARCHAR( 200 ) NOT NULL';
        $this->_TempArr['CreateArr']['fields'][]  =   'award_path VARCHAR( 250 ) NOT NULL';
	    $this->_TempArr['CreateArr']['fields'][]  =   'username VARCHAR( 100 ) NOT NULL';
	    $this->_TempArr['CreateArr']['fields'][]  =   'user_id int( 9 ) NOT NULL';

       $create = $this->create_table($this->_TempArr['CreateArr']);

    return ($create) ? true : false;
    }

    function CreateAdsense()
    {
    global $PowerBB;

	    $this->_TempArr['CreateArr']        =   array();
	    $this->_TempArr['CreateArr']['table_name']  =   $PowerBB->table['adsense'];
	    $this->_TempArr['CreateArr']['fields']    =   array();
	    $this->_TempArr['CreateArr']['fields'][]  =   'id INT( 9 ) NOT NULL AUTO_INCREMENT PRIMARY KEY';
	    $this->_TempArr['CreateArr']['fields'][]  =   'name VARCHAR( 100 ) NOT NULL';
	    $this->_TempArr['CreateArr']['fields'][]  =   'adsense text NOT NULL';
	    $this->_TempArr['CreateArr']['fields'][]  =   'home int( 9 ) NOT NULL';
	    $this->_TempArr['CreateArr']['fields'][]  =   'forum int( 9 ) NOT NULL';
	    $this->_TempArr['CreateArr']['fields'][]  =   'topic int( 9 ) NOT NULL';


    $create = $this->create_table($this->_TempArr['CreateArr']);

    return ($create) ? true : false;
    }

    function CreateFriends()
    {
    global $PowerBB;

	    $this->_TempArr['CreateArr']        =   array();
	    $this->_TempArr['CreateArr']['table_name']  =   $PowerBB->table['friends'];
	    $this->_TempArr['CreateArr']['fields']    =   array();
	    $this->_TempArr['CreateArr']['fields'][]  =   'id INT( 9 ) NOT NULL AUTO_INCREMENT PRIMARY KEY';
	    $this->_TempArr['CreateArr']['fields'][]  =   'username VARCHAR( 100 ) NOT NULL';
	    $this->_TempArr['CreateArr']['fields'][]  =   'userid_friend int( 9 ) NOT NULL';
	    $this->_TempArr['CreateArr']['fields'][]  =   'username_friend VARCHAR( 100 ) NOT NULL';
	    $this->_TempArr['CreateArr']['fields'][]  =   'approval int( 1 ) NOT NULL';



    $create = $this->create_table($this->_TempArr['CreateArr']);

    return ($create) ? true : false;
    }

	function AddCharactersKeywordSsearch()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='characters_keyword_search',value='3'");

		return ($insert) ? true : false;
	}

	function AddFloodSearch()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='flood_search',value='40'");

		return ($insert) ? true : false;
	}

	function AddActivateEmailed()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='allowed_emailed',value='1'");

		return ($insert) ? true : false;
	}

	function AddActivateEmailedPM()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='allowed_emailed_pm',value='1'");

		return ($insert) ? true : false;
	}

	function AddRewriteRule()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='rewriterule',value='0'");

		return ($insert) ? true : false;
	}

	function AddSiteMap()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='sitemap',value='0'");

		return ($insert) ? true : false;
	}

	function ChangeAwayMsg()
	{
		global $PowerBB;

		$change = $PowerBB->DB->sql_query("ALTER TABLE " . $PowerBB->table['member'] . " CHANGE away_msg away_msg VARCHAR( 255 ) NOT NULL");

		return ($change) ? true : false;
	}

	function ChangeLangValue()
	{
		global $PowerBB;

		$change = $PowerBB->DB->sql_query("ALTER TABLE " . $PowerBB->table['member'] . " CHANGE lang lang int(9) NOT NULL DEFAULT '1'");

		return ($change) ? true : false;
	}


	function AddIpaddressBan()
	{
		global $PowerBB;

		$change = $PowerBB->DB->sql_query("ALTER TABLE " . $PowerBB->table['banned'] . " ADD ip VARCHAR( 100 ) NOT NULL");

		return ($change) ? true : false;
	}

	function AddReasonBan()
	{
		global $PowerBB;

		$change = $PowerBB->DB->sql_query("ALTER TABLE " . $PowerBB->table['banned'] . " ADD reason VARCHAR( 255 ) NOT NULL");

		return ($change) ? true : false;
	}
    function AddLastSearchTime()
	{
		global $PowerBB;

		$this->_TempArr['AddArr']					=	array();
		$this->_TempArr['AddArr']['table']			=	$PowerBB->table['member'];
		$this->_TempArr['AddArr']['field_name']		=	'lastsearch_time';
		$this->_TempArr['AddArr']['field_des']		=	'varchar(15) NOT NULL';

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

    function AddPmEmailed()
	{
		global $PowerBB;

		$this->_TempArr['AddArr']					=	array();
		$this->_TempArr['AddArr']['table']			=	$PowerBB->table['member'];
		$this->_TempArr['AddArr']['field_name']		=	'pm_emailed';
		$this->_TempArr['AddArr']['field_des']		=	"int(1) NOT NULL DEFAULT '0'";

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

	function AddPmWindow()
	{
		global $PowerBB;

		$this->_TempArr['AddArr']					=	array();
		$this->_TempArr['AddArr']['table']			=	$PowerBB->table['member'];
		$this->_TempArr['AddArr']['field_name']		=	'pm_window';
		$this->_TempArr['AddArr']['field_des']		=	"int(1) NOT NULL DEFAULT '1'";

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

	function ChangeLangInfo()
	{
		global $PowerBB;

		$update = $PowerBB->info->UpdateInfo(array('value'=>'1','var_name'=>'def_lang'));

		return ($update) ? true : false;
	}

}

$PowerBB->install = new PowerBBTHETA;

$PowerBB->html->page_header('معالج ترقية برنامج منتديات PBBoard 2.0.4');

$logo = $PowerBB->html->create_image(array('align'=>'right','alt'=>'PowerBB','src'=>'../logo.jpg','return'=>true));
$PowerBB->html->open_table('100%',true);
$PowerBB->html->cells($logo,'header_logo_side');

if (!$PowerBB->install->CheckVersion())
{
	$PowerBB->html->cells('اصدار غير صحيح','main1');
	$PowerBB->html->close_table();

	$PowerBB->functions->errorstop('يرجى التحقق من انك قمت بتشغيل تحديثات upg_203.php');
$PowerBB->html->close_table();
}
if ($PowerBB->_GET['step'] == 0)
{
$PowerBB->html->close_p();
$PowerBB->html->close_table();
$PowerBB->html->cells('الترقية إلى الإصدار 2.0.4 من  برنامج PBBoard','main1');
$PowerBB->html->close_p();
$PowerBB->html->close_table();
 $PowerBB->html->make_link('الخطوه الأولى -> أدخال الإستعلامات','?step=1');
}
if ($PowerBB->_GET['step'] == 1)
{
	$PowerBB->html->cells('عمليات الاضافه','main1');
	$PowerBB->html->close_table();


    $p[1] 		= 	$PowerBB->install->AddCharactersKeywordSsearch();
    $msgs[1] 	= 	($p[1]) ? 'تم إنشاء حقل characters_keyword_search' : 'لم يتم إنشاء حقل characters_keyword_search';

    $p[2] 		= 	$PowerBB->install->AddFloodSearch();
    $msgs[2] 	= 	($p[2]) ? 'تم اضافة حقل تحديد الوقت بين كل عملية بحث' : 'لم يتم اضافة حقل تحديد الوقت بين كل عملية بحث';

    $p[3] 		= 	$PowerBB->install->AddActivateEmailed();
    $msgs[3] 	= 	($p[3]) ? 'تم اضافة حقل امكانية تفعيل وتعطيل الاشتراكات البريدية' : 'لم يتم اضافة حقل  امكانية تفعيل وتعطيل الاشتراكات البريدية';

    $p[4] 		= 	$PowerBB->install->AddActivateEmailedPM();
    $msgs[4] 	= 	($p[4]) ? 'تم اضافة حقل امكانية تفعيل وتعطيل إرسال اشعار بريدي بوجود رسالة خاصة جديدة' : 'لم يتم اضافة حقل  امكانية تفعيل وتعطيل إرسال اشعار بريدي بوجود رسالة خاصة جديدة';

    $p[5] 		= 	$PowerBB->install->AddRewriteRule();
    $msgs[5] 	= 	($p[5]) ? 'تم اضافة حقل تحويل الروابط من html إلى php والعكس' : 'لم يتم اضافة حقل تحويل الروابط من html إلى php والعكس';

    $p[6] 		= 	$PowerBB->install->AddSiteMap();
    $msgs[6] 	= 	($p[6]) ? 'تم اضافة حقل مولد الخرائط' : 'لم يتم اضافة حقل  مولد الخرائط';

	$PowerBB->html->open_p();

	foreach ($msgs as $msg)
	{
		$PowerBB->html->p_msg($msg);
	}

	$PowerBB->html->close_p();

$PowerBB->html->close_table();
$PowerBB->html->make_link('الخطوه الثانية -> أدخال الإستعلامات','?step=2');
 }
if ($PowerBB->_GET['step'] == 2)
{
	$PowerBB->html->cells('عمليات الاضافه','main1');
	$PowerBB->html->close_table();

    $p[7] 		= 	$PowerBB->install->ChangeAwayMsg();
    $msgs[7] 	= 	($p[7]) ? 'تم تغيير حجم حقل سبب الغياب' : 'لم يتم تغيير حجم حقل سبب الغياب';

    $p[8] 		= 	$PowerBB->install->AddLastSearchTime();
    $msgs[8] 	= 	($p[8]) ? 'تم اضافة حقل إدخال وقت آخر عملية بحث للعضو' : 'لم يتم اضافة حقل إدخال وقت آخر عملية بحث للعضو';

    $p[9] 		= 	$PowerBB->install->AddPmEmailed();
    $msgs[9] 	= 	($p[9]) ? 'تم اضافة حقل تفعيل استلام اشعار بريدي بوجود رسالة خاصة جديدة' : 'لم يتم اضافة حقل تفعيل استلام اشعار بريدي بوجود رسالة خاصة جديدة';

    $p[10] 		= 	$PowerBB->install->AddIpaddressBan();
    $msgs[10] 	= 	($p[10]) ? 'تم اضافة حقل حظر عناوين الآيبي آدريس' : 'لم يتم اضافة حقل حقل حظر عناوين الآيبي آدريس';

    $p[11] 		= 	$PowerBB->install->AddReasonBan();
    $msgs[11] 	= 	($p[11]) ? 'تم اضافة حقل سبب حظر الآيبي' : 'لم يتم اضافة حقل سبب حظر الآيبي';

    $p[12] 		= 	$PowerBB->install->ChangeLangValue();
    $msgs[12] 	= 	($p[12]) ? 'تم تغير قيمة حقل اللغة الإفتراضية بجدول الأعضاء إلى القيمة 1' : 'لم يتم تغيير قيمة حقل اللغة الإفتراضية بجدول الأعضاء إلى  القيمة 1';

	$PowerBB->html->open_p();

	foreach ($msgs as $msg)
	{
		$PowerBB->html->p_msg($msg);
	}

	$PowerBB->html->close_p();
$PowerBB->html->close_table();
$PowerBB->html->make_link('الخطوه الثالثة -> أدخال الإستعلامات','?step=3');
 }
if ($PowerBB->_GET['step'] == 3)
{
	$PowerBB->html->cells('عمليات الاضافه','main1');
	$PowerBB->html->close_table();

    $p[13] 		= 	$PowerBB->install->ChangeLangInfo();
    $msgs[13] 	= 	($p[13]) ? 'تم تغيير قيمة حقل اللغة الإفتراضية من الاسم إلى الرقم' : 'لم يتم قيمة حقل اللغة الإفتراضية من الاسم إلى الرقم';

    $p[14] 		= 	$PowerBB->install->AddPmWindow();
    $msgs[14] 	= 	($p[14]) ? 'تم اضافة حقل تفعيل استلام اشعار بريدي بوجود رسالة خاصة جديدة' : 'لم يتم اضافة حقل تفعيل استلام اشعار بريدي بوجود رسالة خاصة جديدة';


	$PowerBB->html->open_p();

	foreach ($msgs as $msg)
	{
		$PowerBB->html->p_msg($msg);
	}

	$PowerBB->html->close_p();
$PowerBB->html->close_table();
$PowerBB->html->make_link('الخطوه الرابعة والأخيرة -> اتمام الترقية','?step=4');
}
elseif ($PowerBB->_GET['step'] == 4)
{
	$PowerBB->html->cells('الخطوة النهائية','main1');

	$PowerBB->html->close_table();
	$PowerBB->install->CreateEmailed();
	$PowerBB->install->CreateVisitor();
	$PowerBB->install->CreateAward();
	$PowerBB->install->CreateAdsense();
	$PowerBB->install->CreateFriends();

	$NewVersion = $PowerBB->install->UpdateVersion();

		$PowerBB->html->open_p();
        $PowerBB->html->p_msg('تم الترقية إلى الأصدار 2.0.4 بنجاح');
		$PowerBB->html->close_p();

		$PowerBB->html->open_p();
		$PowerBB->html->make_link('البدأ بالترقية إلى الإصدار 2.0.5','upg_205.php?step=1');
		$PowerBB->html->close_p();

}


?>
