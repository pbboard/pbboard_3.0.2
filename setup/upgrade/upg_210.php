<?php

/**
*  upgrader to version 2.1.0 Beta
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

		return ($PowerBB->_CONF['info_row']['MySBB_version'] == '2.0.5') ? true : false;
	}


	function UpdateVersion()
	{
		global $PowerBB;

		$update = $PowerBB->DB->sql_query("UPDATE " . $PowerBB->table['info'] . " SET value='2.1.0' WHERE var_name='MySBB_version'");

		return ($update) ? true : false;
	}

     function CreateAddons()
    {
    global $PowerBB;

	    $this->_TempArr['CreateArr']        =   array();
	    $this->_TempArr['CreateArr']['table_name']  =   $PowerBB->table['addons'];
	    $this->_TempArr['CreateArr']['fields']    =   array();
	    $this->_TempArr['CreateArr']['fields'][]  =   'id INT( 9 ) NOT NULL AUTO_INCREMENT PRIMARY KEY';
	    $this->_TempArr['CreateArr']['fields'][]  =   'name VARCHAR( 250 ) NOT NULL';
	    $this->_TempArr['CreateArr']['fields'][]  =   'title VARCHAR( 250 ) NOT NULL';
	    $this->_TempArr['CreateArr']['fields'][]  =   'version VARCHAR( 25 ) NOT NULL';
	    $this->_TempArr['CreateArr']['fields'][]  =   'description TEXT NOT NULL';
	    $this->_TempArr['CreateArr']['fields'][]  =   'author VARCHAR( 250 ) NOT NULL';
	    $this->_TempArr['CreateArr']['fields'][]  =   'url VARCHAR( 350 ) NOT NULL';
	    $this->_TempArr['CreateArr']['fields'][]  =   'installcode TEXT NOT NULL';
	    $this->_TempArr['CreateArr']['fields'][]  =   'uninstallcode TEXT NOT NULL';
  	    $this->_TempArr['CreateArr']['fields'][]  =   "active SMALLINT UNSIGNED NOT NULL DEFAULT '1'";



    $create = $this->create_table($this->_TempArr['CreateArr']);

    return ($create) ? true : false;
    }


    function CreateHooks()
    {
    global $PowerBB;

	    $this->_TempArr['CreateArr']        =   array();
	    $this->_TempArr['CreateArr']['table_name']  =   $PowerBB->table['hooks'];
	    $this->_TempArr['CreateArr']['fields']    =   array();
	    $this->_TempArr['CreateArr']['fields'][]  =   'id INT( 9 ) NOT NULL AUTO_INCREMENT PRIMARY KEY';
	    $this->_TempArr['CreateArr']['fields'][]  =   'addon_id INT( 9 ) NOT NULL ';
	    $this->_TempArr['CreateArr']['fields'][]  =   'main_place VARCHAR( 250 ) NOT NULL';
	    $this->_TempArr['CreateArr']['fields'][]  =   'place_of_hook VARCHAR( 250 ) NOT NULL';
	    $this->_TempArr['CreateArr']['fields'][]  =   'phpcode LONGTEXT NOT NULL';


    $create = $this->create_table($this->_TempArr['CreateArr']);

    return ($create) ? true : false;
    }

    function CreateTemplatesEdits()
    {
    global $PowerBB;

	    $this->_TempArr['CreateArr']        =   array();
	    $this->_TempArr['CreateArr']['table_name']  =   $PowerBB->table['templates_edits'];
	    $this->_TempArr['CreateArr']['fields']    =   array();
	    $this->_TempArr['CreateArr']['fields'][]  =   'id INT( 9 ) NOT NULL AUTO_INCREMENT PRIMARY KEY';
	    $this->_TempArr['CreateArr']['fields'][]  =   'addon_id INT( 9 ) NOT NULL ';
	    $this->_TempArr['CreateArr']['fields'][]  =   'template_name VARCHAR( 250 ) NOT NULL';
	    $this->_TempArr['CreateArr']['fields'][]  =   'action VARCHAR( 250 ) NOT NULL';
	    $this->_TempArr['CreateArr']['fields'][]  =   'old_text LONGTEXT NOT NULL';
	    $this->_TempArr['CreateArr']['fields'][]  =   'text LONGTEXT NOT NULL';


    $create = $this->create_table($this->_TempArr['CreateArr']);

    return ($create) ? true : false;
    }

    function CreateVisitorMessage()
    {
    global $PowerBB;

	    $this->_TempArr['CreateArr']        =   array();
	    $this->_TempArr['CreateArr']['table_name']  =   $PowerBB->table['visitormessage'];
	    $this->_TempArr['CreateArr']['fields']    =   array();
	    $this->_TempArr['CreateArr']['fields'][]  =   'id INT( 9 ) NOT NULL AUTO_INCREMENT PRIMARY KEY';
		$this->_TempArr['CreateArr']['fields'][]  =   "userid int(10) unsigned NOT NULL default '0'";
		$this->_TempArr['CreateArr']['fields'][]  =   "postuserid int(10) unsigned NOT NULL default '0'";
		$this->_TempArr['CreateArr']['fields'][]  =   "postusername varchar(100) NOT NULL default ''";
		$this->_TempArr['CreateArr']['fields'][]  =   "dateline int(10) unsigned NOT NULL default '0'";
		$this->_TempArr['CreateArr']['fields'][]  =   "pagetext mediumtext";
		$this->_TempArr['CreateArr']['fields'][]  =   "ipaddress varchar(20) NOT NULL default '0'";
		$this->_TempArr['CreateArr']['fields'][]  =   "messageread smallint(5) unsigned NOT NULL default '0'";


    $create = $this->create_table($this->_TempArr['CreateArr']);

    return ($create) ? true : false;
    }

	function CreateUserRating()
	{
		global $PowerBB;

		$this->_TempArr['CreateArr']				= 	array();
		$this->_TempArr['CreateArr']['table_name'] 	= 	$PowerBB->table['userrating'];
		$this->_TempArr['CreateArr']['fields'] 		= 	array();
		$this->_TempArr['CreateArr']['fields'][] 	= 	'id INT( 9 ) NOT NULL AUTO_INCREMENT PRIMARY KEY';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'rating varchar(200) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'posts int(9) NOT NULL';

		$create = $this->create_table($this->_TempArr['CreateArr']);

		return ($create) ? true : false;
	}

    function CreateEmailMessages()
    {
         global $PowerBB;

        $this->_TempArr['CreateArr']        =   array();
        $this->_TempArr['CreateArr']['table_name']  =   $PowerBB->table['emailmessages'];
        $this->_TempArr['CreateArr']['fields']    =   array();
	    $this->_TempArr['CreateArr']['fields'][]  =   'id INT( 9 ) NOT NULL AUTO_INCREMENT PRIMARY KEY';
        $this->_TempArr['CreateArr']['fields'][]  =   'title VARCHAR( 250 ) NOT NULL';
        $this->_TempArr['CreateArr']['fields'][]  =   'number_messages int( 9 ) NOT NULL';
	    $this->_TempArr['CreateArr']['fields'][]  =   'seconds int( 9 ) NOT NULL';
        $this->_TempArr['CreateArr']['fields'][]  =   'user_group VARCHAR( 200 ) NOT NULL';
	    $this->_TempArr['CreateArr']['fields'][]  =   'message longtext NOT NULL';

       $create = $this->create_table($this->_TempArr['CreateArr']);

    return ($create) ? true : false;
    }

	function InsertUserRating()
	{
		global $PowerBB;

		$UserRatingArray = array();

		$UserRatingArray[0] 					= 	array();
		$UserRatingArray[0]['rating'] 		= 	'look/images/rating/rating_0.gif';
		$UserRatingArray[0]['posts'] 		= 	'10';

		$UserRatingArray[1] 					= 	array();
		$UserRatingArray[1]['rating'] 		= 	'look/images/rating/rating_1.gif';
		$UserRatingArray[1]['posts'] 		= 	'100';

		$UserRatingArray[2] 					= 	array();
		$UserRatingArray[2]['rating'] 		= 	'look/images/rating/rating_2.gif';
		$UserRatingArray[2]['posts'] 		= 	'200';

		$UserRatingArray[3] 					= 	array();
		$UserRatingArray[3]['rating'] 		= 	'look/images/rating/rating_3.gif';
		$UserRatingArray[3]['posts'] 		= 	'400';

		$UserRatingArray[4] 					= 	array();
		$UserRatingArray[4]['rating'] 		= 	'look/images/rating/rating_4.gif';
		$UserRatingArray[4]['posts'] 		= 	'600';

		$UserRatingArray[5] 					= 	array();
		$UserRatingArray[5]['rating'] 		= 	'look/images/rating/rating_5.gif';
		$UserRatingArray[5]['posts'] 		= 	'1000';


		$x = 0;
		$i = array();

		while ($x < sizeof($UserRatingArray))
		{
			$insert = $PowerBB->DB->sql_query("INSERT INTO " . $PowerBB->table['userrating'] . " SET
														id='NULL',
														rating='" . $UserRatingArray[$x]['rating'] . "',
														posts='" . $UserRatingArray[$x]['posts'] . "'");

			$i[$x] = ($insert) ? 'true' : 'false';

			$x += 1;
		}

		return $i;
	}

    function AddMemberVisitorMessage()
	{
		global $PowerBB;

		$this->_TempArr['AddArr']					=	array();
		$this->_TempArr['AddArr']['table']			=	$PowerBB->table['member'];
		$this->_TempArr['AddArr']['field_name']		=	'visitormessage';
		$this->_TempArr['AddArr']['field_des']		=	"int(1) NOT NULL DEFAULT '1'";

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

    function AddVoteUserIp()
	{
		global $PowerBB;

		$this->_TempArr['AddArr']					=	array();
		$this->_TempArr['AddArr']['table']			=	$PowerBB->table['vote'];
		$this->_TempArr['AddArr']['field_name']		=	'user_ip';
		$this->_TempArr['AddArr']['field_des']		=	'varchar(50) NOT NULL';

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

    function AddGroupVisitorMessage()
	{
		global $PowerBB;

		$this->_TempArr['AddArr']					=	array();
		$this->_TempArr['AddArr']['table']			=	$PowerBB->table['group'];
		$this->_TempArr['AddArr']['field_name']		=	'visitormessage';
		$this->_TempArr['AddArr']['field_des']		=	"int(1) NOT NULL DEFAULT '1'";

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

    function AddGroupSeeWhoOnTopic()
	{
		global $PowerBB;

		$this->_TempArr['AddArr']					=	array();
		$this->_TempArr['AddArr']['table']			=	$PowerBB->table['group'];
		$this->_TempArr['AddArr']['field_name']		=	'see_who_on_topic';
		$this->_TempArr['AddArr']['field_des']		=	"int(1) NOT NULL DEFAULT '1'";

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

    function AddReputationNumber()
	{
		global $PowerBB;

		$this->_TempArr['AddArr']					=	array();
		$this->_TempArr['AddArr']['table']			=	$PowerBB->table['group'];
		$this->_TempArr['AddArr']['field_name']		=	'reputation_number';
		$this->_TempArr['AddArr']['field_des']		=	"int(1) NOT NULL DEFAULT '10'";

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

    function AddLastMove()
	{
		global $PowerBB;

		$this->_TempArr['AddArr']					=	array();
		$this->_TempArr['AddArr']['table']			=	$PowerBB->table['online'];
		$this->_TempArr['AddArr']['field_name']		=	'last_move';
		$this->_TempArr['AddArr']['field_des']		=	'varchar(30) NOT NULL';

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

    function AddReputationread()
	{
		global $PowerBB;

		$this->_TempArr['AddArr']					=	array();
		$this->_TempArr['AddArr']['table']			=	$PowerBB->table['reputation'];
		$this->_TempArr['AddArr']['field_name']		=	'reputationread';
		$this->_TempArr['AddArr']['field_des']		=	"smallint(5) unsigned NOT NULL default '0'";

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}


	function UpdateGroups()
	{
		global $PowerBB;

		$update = $PowerBB->DB->sql_query("UPDATE " . $PowerBB->table['group'] . " SET
												visitormessage='0',
												reputation_number='0',
												see_who_on_topic='0'
													WHERE id='6'");

       	$update = $PowerBB->DB->sql_query("UPDATE " . $PowerBB->table['group'] . " SET
                                                reputation_number='0',
												see_who_on_topic='0'
													WHERE id='7'");

       	$update = $PowerBB->DB->sql_query("UPDATE " . $PowerBB->table['group'] . " SET
												reputation_number='100'
													WHERE id='1'");

       	$update = $PowerBB->DB->sql_query("UPDATE " . $PowerBB->table['group'] . " SET
												reputation_number='50'
													WHERE id='2'");

       	$update = $PowerBB->DB->sql_query("UPDATE " . $PowerBB->table['group'] . " SET
												reputation_number='30'
													WHERE id='3'");

       	$update = $PowerBB->DB->sql_query("UPDATE " . $PowerBB->table['group'] . " SET
												reputation_number='50'
													WHERE id='8'");
		return ($update) ? true : false;
	}

	function AddActiveAddons()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='active_addons',value='1'");

		return ($insert) ? true : false;
	}


	function AddVisitorMessage_chars()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='visitor_message_chars',value='1700'");

		return ($insert) ? true : false;
	}
	function AddHaidLinksForGuest()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='haid_links_for_guest',value='0'");

		return ($insert) ? true : false;
	}
	function AddGuestMessageForHaidLinks()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='guest_message_for_haid_links',value='لمشاهدة الروابط يلزمك التسجيل'");

		return ($insert) ? true : false;
	}

	function AddTagsAutomatic()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='add_tags_automatic',value='0'");

		return ($insert) ? true : false;
	}

	// The wordwrap entry
	function AddCreateWordwrap()
	{
		global $PowerBB;

		$CreateWordwrap = ('460');

	   $update = $PowerBB->DB->sql_query('UPDATE ' . $PowerBB->table['info'] . " SET value='" . $CreateWordwrap . "' WHERE var_name='wordwrap'");

		return ($update) ? true : false;
	}

}

$PowerBB->install = new PowerBBTHETA;

$PowerBB->html->page_header('معالج ترقية برنامج منتديات PBBoard 2.1.0');

$logo = $PowerBB->html->create_image(array('align'=>'right','alt'=>'PowerBB','src'=>'../logo.jpg','return'=>true));
$PowerBB->html->open_table('100%',true);
$PowerBB->html->cells($logo,'header_logo_side');

if (!$PowerBB->install->CheckVersion())
{
	$PowerBB->html->cells('اصدار غير صحيح','main1');
	$PowerBB->html->close_table();

	$PowerBB->functions->errorstop('يرجى التحقق من انك قمت بتشغيل تحديثات upg_205.php');
$PowerBB->html->close_table();
}
if ($PowerBB->_GET['step'] == 0)
{
$PowerBB->html->close_p();
$PowerBB->html->close_table();
$PowerBB->html->cells('الترقية إلى الإصدار 2.1.0 من  برنامج PBBoard','main1');
$PowerBB->html->close_p();
$PowerBB->html->close_table();
$PowerBB->html->make_link('الخطوه الأولى -> أدخال الإستعلامات','?step=1');
}
if ($PowerBB->_GET['step'] == 1)
{
	$PowerBB->html->cells('عمليات الاضافه','main1');
	$PowerBB->html->close_table();


   $p[1] 		= 	$PowerBB->install->AddMemberVisitorMessage();
   $msgs[1] 	= 	($p[1]) ? 'تم إنشاء حقل visitormessage في جدول الأعضاء' : 'لم يتم إنشاء حقل visitormessage في جدول الأعضاء';

   $p[2] 		= 	$PowerBB->install->AddVoteUserIp();
   $msgs[2] 	= 	($p[2]) ? 'تم إنشاء حقل عنوان الآي بي ادرس user_ip في جدول vote   ' : 'لم يتم إنشاء حقل عنوان الآي بي ادرس user_ip في جدول vote ';

   $p[3] 		= 	$PowerBB->install->AddGroupVisitorMessage();
   $msgs[3] 	= 	($p[3]) ? 'تم إنشاء حقل visitormessage في جدول المجموعات' : 'لم يتم إنشاء حقل visitormessage في جدول المجموعات';

   $p[4] 		= 	$PowerBB->install->AddGroupSeeWhoOnTopic();
   $msgs[4] 	= 	($p[10]) ? 'تم إدخال حقل مشاهدة المتواجدين بالموضوع' : 'لم يتم إدخال حقل مشاهدة المتواجدين بالموضوع';

   $p[5] 		= 	$PowerBB->install->AddActiveAddons();
   $msgs[5] 	= 	($p[5]) ? 'تم إنشاء حقل active_addons ' : 'لم يتم إنشاء حقل active_addons';

   $p[6] 		= 	$PowerBB->install->AddVisitorMessage_chars();
   $msgs[6] 	= 	($p[6]) ? 'تم إنشاء حقل visitor_message_chars' : 'لم يتم إنشاء حقل visitor_message_chars';

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

    $p[7] 		= 	$PowerBB->install->CreateUserRating();
    $msgs[7] 	= 	($p[7]) ? 'تم إنشاء الجدول userRating' : 'لم يتم إنشاء الجدول userRating';

    $p[8] 		= 	$PowerBB->install->InsertUserRating();
    $msgs[8] 	= 	($p[8]) ? 'تم إدخال نجوم الأعضاء ' : 'لم يتم إدخال نجوم الأعضاء';

    $p[9] 		= 	$PowerBB->install->AddReputationread();
    $msgs[9] 	= 	($p[9]) ? 'تم إدخال حقل reputationread في جدول  reputation' : 'لم يتم إدخال إدخال حقل reputationread في جدول  reputation';

	$p[10] 		= 	$PowerBB->install->AddReputationNumber();
	$msgs[10] 	= 	($p[10]) ? 'تم إنشاء حقل reputation_number' : 'لم يتم إنشاء حقل reputation_number';

    $p[11] 		= 	$PowerBB->install->AddLastMove();
    $msgs[11] 	= 	($p[11]) ? 'تم إدخال حقل آخر نشاط للعضو' : 'لم يتم إدخال حقل آخر نشاط للعضو';

    $p[12] 		= 	$PowerBB->install->AddCreateWordwrap();
    $msgs[12] 	= 	($p[12]) ? 'تم تحديث عدد الأحرف قبل إلتفاف النص ' : 'لم يتم تحديث عدد الأحرف قبل إلتفاف النص ';


	$PowerBB->html->open_p();

	foreach ($msgs as $msg)
	{
		$PowerBB->html->p_msg($msg);
	}

$PowerBB->html->close_p();

$PowerBB->html->close_table();
$PowerBB->html->make_link('الخطوه الثانية -> أدخال الإستعلامات','?step=3');
 }
if ($PowerBB->_GET['step'] == 3)
{
	$PowerBB->html->cells('عمليات الاضافه','main1');
	$PowerBB->html->close_table();


	$p[13] 		= 	$PowerBB->install->AddGuestMessageForHaidLinks();
	$msgs[13] 	= 	($p[13]) ? 'تم إنشاء حقل guest_message_for_haid_links' : 'لم يتم إنشاء حقل guest_message_for_haid_links';

	$p[14] 		= 	$PowerBB->install->AddHaidLinksForGuest();
	$msgs[14] 	= 	($p[14]) ? 'تم إنشاء حقل haid_links_for_guest' : 'لم يتم إنشاء حقل haid_links_for_guest';

    $p[15] 		= 	$PowerBB->install->UpdateGroups();
    $msgs[15] 	= 	($p[15]) ? 'تم تحديث المجموعات بقيم الحقول الجديدة' : 'لم يتم تحديث المجموعات بقيم الحقول الجديدة';

	$p[16] 		= 	$PowerBB->install->AddTagsAutomatic();
	$msgs[16] 	= 	($p[16]) ? 'تم إنشاء حقل add_tags_automatic' : 'لم يتم إنشاء حقل add_tags_automatic';

	$PowerBB->html->open_p();

	foreach ($msgs as $msg)
	{
		$PowerBB->html->p_msg($msg);
	}

	$PowerBB->html->close_p();
$PowerBB->html->close_table();
$PowerBB->html->make_link('الخطوه الثالثة والأخيرة -> اتمام الترقية','?step=4');
}
elseif ($PowerBB->_GET['step'] == 4)
{
	$PowerBB->html->cells('الخطوة النهائية','main1');

	$PowerBB->html->close_table();

	$Create_visitor_message = $PowerBB->install->CreateVisitorMessage();
	$Create_addons = $PowerBB->install->CreateAddons();
	$Create_Hooks = $PowerBB->install->CreateHooks();
	$Create_TemplatesEdits = $PowerBB->install->CreateTemplatesEdits();
    $Create_EmailMessages = $PowerBB->install->CreateEmailMessages();
	 $NewVersion = $PowerBB->install->UpdateVersion();


		$PowerBB->html->open_p();
        $PowerBB->html->p_msg('تم الترقية إلى الأصدار 2.1.0 بنجاح');
		$PowerBB->html->close_p();

		$PowerBB->html->open_p();
		$PowerBB->html->make_link('البدأ بالترقية إلى الإصدار 2.1.1','upg_211.php?step=1');
		$PowerBB->html->close_p();


}


?>
