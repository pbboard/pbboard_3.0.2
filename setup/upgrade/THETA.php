<?php

/**
* THETA upgrader
*/

define('NO_TEMPLATE',true);

$CALL_SYSTEM				= 	array();
$CALL_SYSTEM['SECTION'] 	= 	true;
$CALL_SYSTEM['POLL'] 		= 	true;
include('../common.php');

class PowerBBTHETA extends PowerBBInstall
{
	var $_TempArr 	= 	array();
	var $_Masseges	=	array();

	function CheckVersion()
	{
		global $PowerBB;

		return ($PowerBB->_CONF['info_row']['MySBB_version'] == '2.0 OMEGA') ? true : false;
	}

	function UpdateVersion()
	{
		global $PowerBB;

		$update = $PowerBB->DB->sql_query("UPDATE " . $PowerBB->table['info'] . " SET value='2.0.0' WHERE var_name='MySBB_version'");

		return ($update) ? true : false;
	}


	function AddDefLang()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='def_lang',value='ar'");

		return ($insert) ? true : false;
	}

		function AddNoSub()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='no_sub',value='1'");

		return ($insert) ? true : false;
	}

		function AddNoModerators()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='no_moderators',value='1'");

		return ($insert) ? true : false;
	}

		function AddNoDescribe()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='no_describe',value='1'");

		return ($insert) ? true : false;
	}

	function AddDefaultAvatar()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='default_avatar',value='default_avatar.gif'");

		return ($insert) ? true : false;
	}

		function AddWarningNumberTtoBan()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='warning_number_to_ban',value='10'");

		return ($insert) ? true : false;
	}

		function AddRegSat()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='reg_Sat',value='1'");

		return ($insert) ? true : false;
	}

		function AddRegSun()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='reg_Sun',value='1'");

		return ($insert) ? true : false;
	}

	function AddRegMon()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='reg_Mon',value='1'");

		return ($insert) ? true : false;
	}

		function AddRegTue()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='reg_Tue',value='1'");

		return ($insert) ? true : false;
	}

	function AddRegWed()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='reg_Wed',value='1'");

		return ($insert) ? true : false;
	}

		function AddRegThu()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='reg_Thu',value='1'");

		return ($insert) ? true : false;
	}

	function AddRegFri()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='reg_Fri',value='1'");

		return ($insert) ? true : false;
	}

		function AddAdminNotes()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='admin_notes',value=''");

		return ($insert) ? true : false;
	}


	function AddPmFeature()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='pm_feature',value='1'");

		return ($insert) ? true : false;
	}

	function AddWordwrap()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='wordwrap',value='300'");

		return ($insert) ? true : false;
	}

	function AddSubjectDescribeShow()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='subject_describe_show',value='1'");

		return ($insert) ? true : false;
	}


		function AddRules()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='rules',value='عليك قراءة هذه القوانين حتى لا تتعرض للتوقيف أو المخالفة:
1- الالتزام بآداب الحديث والحوار وعدم التعرض للدين الإسلامي بالإساءة.
2- عدم التعرض لأي شخص بالإهانة أو أو التجريح أو المساس بولاة الأمر.
3- عدم الإعلان عن منتديات ومواقع أخرى بفتح مواضيع جديدة أو في التوقيع أو الرسائل الخاصة.
4- عدم تكرار طرح نفس الموضوع في أكثر من قسم.
5- عدم طرح أي شكوى ضد أي مشرف أو عضو علناً ، ولتقديم شكوى يجب مراسلة إدارة المنتدى.
6- يمنع منعاً باتاً التدخل في شؤون إدارة المنتدى ، ولإدارة المنتدى كامل الصلاحية في حذف أو تعديل أو نقل أو إغلاق أي موضوع أو إيقاف عضوية أي مشترك دون ذكر الأسباب.
7- عدم طرح أي مواضيع مضمونها معصية الله تعالى وفيما يغضبه سبحانه من المحرمات.
8- عدم طرح مواضيع الـHACK والاختراق وطرق اختراق البروكسي.
9- عدم استخدام إسم غير لائق لعضويتك عند التسجيل أو التسجيل بحروف مبهمة أو أرقام أو بريد الكتروني.
10- عدم وضع البريد الإلكتروني او رقم الهاتف في المواضيع والردود أو التوقيع.
بعد قراءتك الشروط والتسجيل فأي مخالفة تصدر منك سيتم الاتخاذ الاجراء اللازم بحقك أو إيقاف عضويتك'");

		return ($insert) ? true : false;
	}

	function AddCensorWords()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='censorwords',value='SCRIPT
XSS
document
cookie
alert
equiv'");

		return ($insert) ? true : false;
	}



	 function AddMembersSendPm()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='members_send_pm',value='7'");

		return ($insert) ? true : false;
	}

	function AddDescription()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='description',value='هذا المنتدى يستخدم برنامج PBBoard لمعرفة المزيد عنه اذهب إلى www.pbboard.info'");

		return ($insert) ? true : false;
	}

	function AddKeywords()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='keywords',value='منتدى,منتديات,PBBoard,Power,bulletin,board,arab,forums,forum,pbboard.info'");

		return ($insert) ? true : false;
	}

	function AddContent_Language()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='content_language',value='ar'");

		return ($insert) ? true : false;
	}

   	function AddCharset()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='charset',value='utf-8'");

		return ($insert) ? true : false;
	}

	function AddContent_Dir()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='content_dir',value='rtl'");

		return ($insert) ? true : false;
	}


	// Add operation(s)
	function AddAjaxSearch()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='ajax_search',value='0'");

		return ($insert) ? true : false;
	}

	function AddAjaxRegister()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='ajax_register',value='0'");

		return ($insert) ? true : false;
	}

	function AddAjaxReply()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='ajax_freply',value='0'");

		return ($insert) ? true : false;
	}

	function AddAjaxMainRename()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='get_group_username_style',value='0'");

		return ($insert) ? true : false;
	}

	function UpdateIconPathn()
	{
		global $PowerBB;

		$update = $PowerBB->DB->sql_query("UPDATE " . $PowerBB->table['info'] . " SET value='look/images/icons/' WHERE var_name='icon_path'");


		return ($update) ? true : false;
	}

	function AddModerators()
	{
		global $PowerBB;

		$this->_TempArr['AddArr'] 			= 	array();
		$this->_TempArr['AddArr']['table'] 		= 	$PowerBB->table['section'];
		$this->_TempArr['AddArr']['field_name'] 	= 	'moderators';
		$this->_TempArr['AddArr']['field_des'] 		= 	'TEXT NOT NULL';

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

	function AddAnswers()
	{
		global $PowerBB;

		$this->_TempArr['AddArr'] 			= 	array();
		$this->_TempArr['AddArr']['table'] 		= 	$PowerBB->table['poll'];
		$this->_TempArr['AddArr']['field_name'] 	= 	'answers';
		$this->_TempArr['AddArr']['field_des'] 		= 	'TEXT NOT NULL AFTER qus';

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

	function AddUsername()
	{
		global $PowerBB;

		$this->_TempArr['AddArr'] 			= 	array();
		$this->_TempArr['AddArr']['table'] 		= 	$PowerBB->table['vote'];
		$this->_TempArr['AddArr']['field_name'] 	= 	'username';
		$this->_TempArr['AddArr']['field_des'] 		= 	'VARCHAR(255) NOT NULL';

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

	function AddAnswerNumber()
	{
		global $PowerBB;

		$this->_TempArr['AddArr'] 			= 	array();
		$this->_TempArr['AddArr']['table'] 		= 	$PowerBB->table['vote'];
		$this->_TempArr['AddArr']['field_name'] 	= 	'answer_number';
		$this->_TempArr['AddArr']['field_des'] 		= 	'int(9) NOT NULL';

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

	function AddSubjectId()
	{
		global $PowerBB;

		$this->_TempArr['AddArr'] 			= 	array();
		$this->_TempArr['AddArr']['table'] 		= 	$PowerBB->table['vote'];
		$this->_TempArr['AddArr']['field_name'] 	= 	'subject_id';
		$this->_TempArr['AddArr']['field_des'] 		= 	'int(9) NOT NULL';

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

	function AddVotes()
	{
		global $PowerBB;

		$this->_TempArr['AddArr'] 			= 	array();
		$this->_TempArr['AddArr']['table'] 		= 	$PowerBB->table['vote'];
		$this->_TempArr['AddArr']['field_name'] 	= 	'votes';
		$this->_TempArr['AddArr']['field_des'] 		= 	'int(9) NOT NULL';

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

	function AddAutoreply()
	{
		global $PowerBB;

		$this->_TempArr['AddArr'] 			= 	array();
		$this->_TempArr['AddArr']['table'] 		= 	$PowerBB->table['member'];
		$this->_TempArr['AddArr']['field_name'] 	= 	'autoreply';
		$this->_TempArr['AddArr']['field_des'] 		= 	'INT(9) NOT NULL';

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

	function AddAutoreplyTitle()
	{
		global $PowerBB;

		$this->_TempArr['AddArr'] 			= 	array();
		$this->_TempArr['AddArr']['table'] 		= 	$PowerBB->table['member'];
		$this->_TempArr['AddArr']['field_name'] 	= 	'autoreply_title';
		$this->_TempArr['AddArr']['field_des'] 		= 	'VARCHAR(255) NOT NULL';

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

	function AddAutoreplyMsg()
	{
		global $PowerBB;

		$this->_TempArr['AddArr'] 			= 	array();
		$this->_TempArr['AddArr']['table'] 		= 	$PowerBB->table['member'];
		$this->_TempArr['AddArr']['field_name'] 	= 	'autoreply_msg';
		$this->_TempArr['AddArr']['field_des'] 		= 	'TEXT NOT NULL';

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

	function AddPMSenders()
	{
		global $PowerBB;

		$this->_TempArr['AddArr'] 			= 	array();
		$this->_TempArr['AddArr']['table'] 		= 	$PowerBB->table['member'];
		$this->_TempArr['AddArr']['field_name'] 	= 	'pm_senders';
		$this->_TempArr['AddArr']['field_des'] 		= 	'INT(1) NOT NULL';

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

	function AddPMSendersMsg()
	{
		global $PowerBB;

		$this->_TempArr['AddArr'] 			= 	array();
		$this->_TempArr['AddArr']['table'] 		= 	$PowerBB->table['member'];
		$this->_TempArr['AddArr']['field_name'] 	= 	'pm_senders_msg';
		$this->_TempArr['AddArr']['field_des'] 		= 	'VARCHAR(255) NOT NULL';

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

	function AddTagsCache()
	{
		global $PowerBB;

		$this->_TempArr['AddArr'] 			= 	array();
		$this->_TempArr['AddArr']['table'] 		= 	$PowerBB->table['subject'];
		$this->_TempArr['AddArr']['field_name'] 	= 	'tags_cache';
		$this->_TempArr['AddArr']['field_des'] 		= 	'TEXT NOT NULL';

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

	function AddCloseReason()
	{
		global $PowerBB;

		$this->_TempArr['AddArr'] 			= 	array();
		$this->_TempArr['AddArr']['table'] 		= 	$PowerBB->table['subject'];
		$this->_TempArr['AddArr']['field_name'] 	= 	'close_reason';
		$this->_TempArr['AddArr']['field_des'] 		= 	'VARCHAR(255) NOT NULL';

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

	function AddMemberIP()
	{
		global $PowerBB;

		$this->_TempArr['AddArr'] 			= 	array();
		$this->_TempArr['AddArr']['table'] 		= 	$PowerBB->table['member'];
		$this->_TempArr['AddArr']['field_name'] 	= 	'member_ip';
		$this->_TempArr['AddArr']['field_des'] 		= 	'VARCHAR(20) NOT NULL';

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}


	function AddMIMEType()
	{
		global $PowerBB;

		$this->_TempArr['AddArr'] 			= 	array();
		$this->_TempArr['AddArr']['table'] 		= 	$PowerBB->table['extension'];
		$this->_TempArr['AddArr']['field_name'] 	= 	'mime_type';
		$this->_TempArr['AddArr']['field_des'] 		= 	'VARCHAR(255) NOT NULL';

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}


	function AddDelReason()
	{
		global $PowerBB;

		$this->_TempArr['AddArr'] 			= 	array();
		$this->_TempArr['AddArr']['table'] 		= 	$PowerBB->table['subject'];
		$this->_TempArr['AddArr']['field_name'] 	= 	'delete_reason';
		$this->_TempArr['AddArr']['field_des'] 		= 	'varchar(255)';

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

	function AddAjaxModeratorOptions()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='ajax_moderator_options',value='0'");

		return ($insert) ? true : false;
	}

	function AddCaptcha()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='captcha_o',value='1'");

		return ($insert) ? true : false;
	}

	function AddAcStat()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='activate_last_static_list',value='0'");

		return ($insert) ? true : false;
	}


    function AddLastStaticNum()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='last_static_num',value='5'");

		return ($insert) ? true : false;
	}

     function AddLastPostsStaticNum()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='last_posts_static_num',value='10'");

		return ($insert) ? true : false;
	}

     function AddForumIdNotInStatic()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='forum_id_not_in_static',value='700,800,900'");

		return ($insert) ? true : false;
	}

     function AddActivateLastsPostsBar()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='activate_lasts_posts_bar',value='0'");

		return ($insert) ? true : false;
	}

    function AddForumIdNotInLastsPostsBar()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='forum_id_not_in_lasts_posts_bar',value='700,800,900'");

		return ($insert) ? true : false;
	}

    function AddLastsPostsBarNum()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='lasts_posts_bar_num',value='10'");

		return ($insert) ? true : false;
	}

    function AddLastsPostsBarDir()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='lasts_posts_bar_dir',value='right'");

		return ($insert) ? true : false;
	}

	function AddActivateSpecialBar()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='activate_special_bar',value='0'");

		return ($insert) ? true : false;
	}

	function AddSpecialBarDir()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='special_bar_dir',value='right'");

		return ($insert) ? true : false;
	}

     function AddNoPosts()
	{
		global $PowerBB;

		$this->_TempArr['AddArr']					=	array();
		$this->_TempArr['AddArr']['table']			=	$PowerBB->table['section_group'];
		$this->_TempArr['AddArr']['field_name']		=	'no_posts';
		$this->_TempArr['AddArr']['field_des']		=	"INT( 1 ) NOT NULL DEFAULT '1'";

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

	 function AddNoPostsGroup()
	{
		global $PowerBB;

		$this->_TempArr['AddArr']					=	array();
		$this->_TempArr['AddArr']['table']			=	$PowerBB->table['group'];
		$this->_TempArr['AddArr']['field_name']		=	'no_posts';
		$this->_TempArr['AddArr']['field_des']		=	"INT( 1 ) NOT NULL DEFAULT '1'";

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

	function AddReviewSubjectSection()
	{
		global $PowerBB;

		$this->_TempArr['AddArr']					=	array();
		$this->_TempArr['AddArr']['table']			=	$PowerBB->table['section'];
		$this->_TempArr['AddArr']['field_name']		=	'review_subject';
		$this->_TempArr['AddArr']['field_des']		=	'int(1) NOT NULL';

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

	function AddReviewSubject()
	{
		global $PowerBB;

		$this->_TempArr['AddArr']					=	array();
		$this->_TempArr['AddArr']['table']			=	$PowerBB->table['member'];
		$this->_TempArr['AddArr']['field_name']		=	'review_subject';
		$this->_TempArr['AddArr']['field_des']		=	'int(1) NOT NULL';

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

	function AddInviter()
	{
		global $PowerBB;

		$this->_TempArr['AddArr']					=	array();
		$this->_TempArr['AddArr']['table']			=	$PowerBB->table['member'];
		$this->_TempArr['AddArr']['field_name']		=	'inviter';
		$this->_TempArr['AddArr']['field_des']		=	'VARCHAR( 200 ) NOT NULL';

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

		function AddInviteNum()
	{
		global $PowerBB;

		$this->_TempArr['AddArr']					=	array();
		$this->_TempArr['AddArr']['table']			=	$PowerBB->table['member'];
		$this->_TempArr['AddArr']['field_name']		=	'invite_num';
		$this->_TempArr['AddArr']['field_des']		=	'INT( 9 ) NOT NULL';

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

	function AddWarnings()
	{
		global $PowerBB;

		$this->_TempArr['AddArr']					=	array();
		$this->_TempArr['AddArr']['table']			=	$PowerBB->table['member'];
		$this->_TempArr['AddArr']['field_name']		=	'warnings';
		$this->_TempArr['AddArr']['field_des']		=	"INT UNSIGNED NOT NULL DEFAULT '0'";

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

	function AddLangMember()
	{
		global $PowerBB;

		$this->_TempArr['AddArr']					=	array();
		$this->_TempArr['AddArr']['table']			=	$PowerBB->table['member'];
		$this->_TempArr['AddArr']['field_name']		=	'lang';
		$this->_TempArr['AddArr']['field_des']		=	'int(9) NOT NULL';

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

	function AddReview_subject()
	{
		global $PowerBB;

		$this->_TempArr['AddArr']					=	array();
		$this->_TempArr['AddArr']['table']			=	$PowerBB->table['subject'];
		$this->_TempArr['AddArr']['field_name']		=	'review_subject';
		$this->_TempArr['AddArr']['field_des']		=	'int(1) NOT NULL';

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

	function AddSpecial()
	{
		global $PowerBB;

		$this->_TempArr['AddArr']					=	array();
		$this->_TempArr['AddArr']['table']			=	$PowerBB->table['subject'];
		$this->_TempArr['AddArr']['field_name']		=	'special';
		$this->_TempArr['AddArr']['field_des']		=	'int(1) NOT NULL';

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

	function AddPmId()
	{
		global $PowerBB;

		$this->_TempArr['AddArr']					=	array();
		$this->_TempArr['AddArr']['table']			=	$PowerBB->table['attach'];
		$this->_TempArr['AddArr']['field_name']		=	'pm_id';
		$this->_TempArr['AddArr']['field_des']		=	'int( 9 ) NOT NULL';

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

	function AddSendWarning()
	{
		global $PowerBB;

		$this->_TempArr['AddArr']					=	array();
		$this->_TempArr['AddArr']['table']			=	$PowerBB->table['group'];
		$this->_TempArr['AddArr']['field_name']		=	'send_warning';
		$this->_TempArr['AddArr']['field_des']		=	"INT UNSIGNED NOT NULL DEFAULT '0'";

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

	function AddCanWarned()
	{
		global $PowerBB;

		$this->_TempArr['AddArr']					=	array();
		$this->_TempArr['AddArr']['table']			=	$PowerBB->table['group'];
		$this->_TempArr['AddArr']['field_name']		=	'can_warned';
		$this->_TempArr['AddArr']['field_des']		=	"INT UNSIGNED NOT NULL DEFAULT '0'";

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

	function AddHideAllow()
	{
		global $PowerBB;

		$this->_TempArr['AddArr']					=	array();
		$this->_TempArr['AddArr']['table']			=	$PowerBB->table['group'];
		$this->_TempArr['AddArr']['field_name']		=	'hide_allow';
		$this->_TempArr['AddArr']['field_des']		=	"INT UNSIGNED NOT NULL DEFAULT '0'";

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}



	// Rename operation(s)
	function RenameModeratorTable()
	{
		global $PowerBB;

		$rename = $this->rename_table($PowerBB->prefix . 'sectionadmin',$PowerBB->prefix . 'moderators');

		return ($rename) ? true : false;
	}

	// Drop operation(s)
	/****/

    function CreateExtrafields()
    {
    global $PowerBB;

	    $this->_TempArr['CreateArr']        =   array();
	    $this->_TempArr['CreateArr']['table_name']  =   $PowerBB->table['extrafield'];
	    $this->_TempArr['CreateArr']['fields']    =   array();
	    $this->_TempArr['CreateArr']['fields'][]  =   'id INT( 9 ) NOT NULL AUTO_INCREMENT PRIMARY KEY';
	    $this->_TempArr['CreateArr']['fields'][]  =   'name VARCHAR( 200 ) NOT NULL';
	    $this->_TempArr['CreateArr']['fields'][]  =   'show_in_forum VARCHAR( 3 ) NOT NULL';
	    $this->_TempArr['CreateArr']['fields'][]  =   'required VARCHAR( 3 ) NOT NULL';
	    $this->_TempArr['CreateArr']['fields'][]  =   'type VARCHAR( 250 ) NOT NULL';
	    $this->_TempArr['CreateArr']['fields'][]  =   'options TEXT NOT NULL';


    $create = $this->create_table($this->_TempArr['CreateArr']);

    return ($create) ? true : false;
    }

        function CreateWarnlog()
    {
    global $PowerBB;

	    $this->_TempArr['CreateArr']        =   array();
	    $this->_TempArr['CreateArr']['table_name']  =   $PowerBB->table['warnlog'];
	    $this->_TempArr['CreateArr']['fields']    =   array();
	    $this->_TempArr['CreateArr']['fields'][]  =   'id INT( 10 ) NOT NULL AUTO_INCREMENT PRIMARY KEY';
	    $this->_TempArr['CreateArr']['fields'][]  =   'warn_from VARCHAR( 200 ) NOT NULL';
	    $this->_TempArr['CreateArr']['fields'][]  =   'warn_to VARCHAR( 200 ) NOT NULL';
	    $this->_TempArr['CreateArr']['fields'][]  =   'warn_text LONGTEXT NOT NULL';
	    $this->_TempArr['CreateArr']['fields'][]  =   'warn_date VARCHAR( 200 ) NOT NULL';


    $create = $this->create_table($this->_TempArr['CreateArr']);

    return ($create) ? true : false;
    }



	// Create operation(s)
    function CreateTagsTable()
    {
    	global $PowerBB;

		$this->_TempArr['CreateArr']			= 	array();
		$this->_TempArr['CreateArr']['table_name'] 	= 	$PowerBB->table['tag'];
		$this->_TempArr['CreateArr']['fields'] 		= 	array();
		$this->_TempArr['CreateArr']['fields'][] 	= 	'id INT( 9 ) NOT NULL AUTO_INCREMENT PRIMARY KEY';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'tag VARCHAR( 100 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'number INT( 9 ) NOT NULL';

		$create = $this->create_table($this->_TempArr['CreateArr']);

		return ($create) ? true : false;
    }

	function CreateTagsSubjectTable()
	{
		global $PowerBB;

		$this->_TempArr['CreateArr']				= 	array();
		$this->_TempArr['CreateArr']['table_name'] 	= 	$PowerBB->table['tag_subject'];
		$this->_TempArr['CreateArr']['fields'] 		= 	array();
		$this->_TempArr['CreateArr']['fields'][] 	= 	'id INT( 9 ) NOT NULL AUTO_INCREMENT PRIMARY KEY';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'tag_id INT( 9 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'subject_id INT( 9 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'tag VARCHAR( 255 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'subject_title VARCHAR( 255 ) NOT NULL';

		$create = $this->create_table($this->_TempArr['CreateArr']);

		return ($create) ? true : false;
    }

    /** New sections system **/
    // Step 1 : Add parent field
    function AddParent()
	{
		global $PowerBB;

		$this->_TempArr['AddArr'] 			= 	array();
		$this->_TempArr['AddArr']['table'] 		= 	$PowerBB->table['section'];
		$this->_TempArr['AddArr']['field_name'] 	= 	'parent';
		$this->_TempArr['AddArr']['field_des'] 		= 	'VARCHAR(9) NOT NULL AFTER section_describe';

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

	// Step 2 : Change the value of "parent" to 0 for sections which have "main_section" equal 1
	function ChangeMainSections()
	{
		global $PowerBB;

		$update = $PowerBB->DB->sql_query("UPDATE " . $PowerBB->table['section'] . " SET parent='0' WHERE main_section='1'");

		return ($update) ? true : false;
	}

	// Step 3 : Change the value of "parent" to x for sections which have "main_section" not equal 1
	// and "from_main_section" equal x
	function ChangeSections()
	{
		global $PowerBB;

		$update = $PowerBB->DB->sql_query("UPDATE " . $PowerBB->table['section'] . " AS s SET parent=s.from_main_section WHERE main_section<>'1'");

		return ($update) ? true : false;
	}

	function ChangeSubSections()
	{
		global $PowerBB;


		    $sql_Section = $PowerBB->DB->sql_query("SELECT  *   FROM " . $PowerBB->table['section'] . " WHERE main_section = '1' ");

		       while ($getSection_row = $PowerBB->DB->sql_fetch_array($sql_Section))
		      {




					$SecArr 			= 	array();
					$SecArr['field']	=	array();

					$SecArr['field']['parent'] 	= 	'0';
					$SecArr['where']			= 	array('id',$getSection_row['id']);

					$update = $PowerBB->core->Update($SecArr,'section');

               }

           if ($update)
			{
		    $sql_Section1 = $PowerBB->DB->sql_query("SELECT  *   FROM " . $PowerBB->table['section'] . " WHERE from_main_section > 0 ");

		       while ($getSection1_row = $PowerBB->DB->sql_fetch_array($sql_Section1))
		      {


					$Sec1Arr 			= 	array();
					$Sec1Arr['field']	=	array();

					$Sec1Arr['field']['parent'] 	= 	$getSection1_row['from_main_section'];
					$Sec1Arr['where']			= 	array('id',$getSection1_row['id']);

					$update = $PowerBB->section->UpdateSection($Sec1Arr);

               }
            }

		return ($update) ? true : false;
	}


	// Step 4 : Drop unwanted fields
	function DropUnwantedFields()
	{
		global $PowerBB;

		$this->_TempArr['DropArr'] 			= 	array();
		$this->_TempArr['DropArr']['table_name'] 	= 	$PowerBB->table['section'];
		$this->_TempArr['DropArr']['field_name'] 	= 	'main_section';

		$drop = $this->drop_field($this->_TempArr['DropArr']);

		unset($this->_TempArr['DropArr']);

		$this->_TempArr['DropArr'] 			= 	array();
		$this->_TempArr['DropArr']['table_name'] 	= 	$PowerBB->table['section'];
		$this->_TempArr['DropArr']['field_name'] 	= 	'from_main_section';

		$drop = $this->drop_field($this->_TempArr['DropArr']);

		unset($this->_TempArr['DropArr']);

		$this->_TempArr['DropArr'] 			= 	array();
		$this->_TempArr['DropArr']['table_name'] 	= 	$PowerBB->table['section'];
		$this->_TempArr['DropArr']['field_name'] 	= 	'sub_section';

		$drop = $this->drop_field($this->_TempArr['DropArr']);

		unset($this->_TempArr['DropArr']);

		$this->_TempArr['DropArr'] 			= 	array();
		$this->_TempArr['DropArr']['table_name'] 	= 	$PowerBB->table['section'];
		$this->_TempArr['DropArr']['field_name'] 	= 	'from_sub_section';

		$drop = $this->drop_field($this->_TempArr['DropArr']);

		unset($this->_TempArr['DropArr']);

		$this->_TempArr['DropArr'] 			= 	array();
		$this->_TempArr['DropArr']['table_name'] 	= 	$PowerBB->table['section'];
		$this->_TempArr['DropArr']['field_name'] 	= 	'sub_section';

		$drop = $this->drop_field($this->_TempArr['DropArr']);

		unset($this->_TempArr['DropArr']);

		// Sorry for this!
		return true;
	}


	function AddUsePowerCodeAllow()
	{
		global $PowerBB;

		$this->_TempArr['AddArr']					=	array();
		$this->_TempArr['AddArr']['table']			=	$PowerBB->table['section'];
		$this->_TempArr['AddArr']['field_name']		=	'use_power_code_allow';
		$this->_TempArr['AddArr']['field_des']		=	"INT( 1 ) NOT NULL DEFAULT '1'";

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

	function AddIcon()
	{
		global $PowerBB;

		$this->_TempArr['AddArr']					=	array();
		$this->_TempArr['AddArr']['table']			=	$PowerBB->table['section'];
		$this->_TempArr['AddArr']['field_name']		=	'icon';
		$this->_TempArr['AddArr']['field_des']		=	'VARCHAR( 50 ) NOT NULL';

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}
		function AddHeader()
	{
		global $PowerBB;

		$this->_TempArr['AddArr']					=	array();
		$this->_TempArr['AddArr']['table']			=	$PowerBB->table['section'];
		$this->_TempArr['AddArr']['field_name']		=	'header';
		$this->_TempArr['AddArr']['field_des']		=	'text NOT NULL';

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

	function AddFooter()
	{
		global $PowerBB;

		$this->_TempArr['AddArr']					=	array();
		$this->_TempArr['AddArr']['table']			=	$PowerBB->table['section'];
		$this->_TempArr['AddArr']['field_name']		=	'footer';
		$this->_TempArr['AddArr']['field_des']		=	'text NOT NULL';

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}


		function AddAttachExtension()
	{
		global $PowerBB;

		$this->_TempArr['AddArr']					=	array();
		$this->_TempArr['AddArr']['table']			=	$PowerBB->table['attach'];
		$this->_TempArr['AddArr']['field_name']		=	'extension';
		$this->_TempArr['AddArr']['field_des']		=	'VARCHAR( 20 ) NOT NULL';

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

	/** New Poll System **/
	function ConvertPollInformation()
	{
		global $PowerBB;

		// TODO :: page support
		$query = $PowerBB->DB->sql_query("SELECT * FROM " . $PowerBB->table['poll'] . " ORDER BY id ASC");

		while ($r = $PowerBB->DB->sql_fetch_array($query))
		{
			// We must know the answers number to start work
			$answers = 2;

			if (!empty($r['ans8']))
			{
				$answers_number = 8;
			}
			elseif (!empty($r['ans7'])
					and empty($r['ans8']))
			{
				$answers_number = 7;
			}
			elseif (!empty($r['ans6'])
					and empty($r['ans7']))
			{
				$answers_number = 6;
			}
			elseif (!empty($r['ans5'])
					and empty($r['ans6']))
			{
				$answers_number = 5;
			}
			elseif (!empty($r['ans4'])
		           and empty($r['ans5']))
			{
				$answers_number = 4;
			}
			elseif (!empty($r['ans3'])
		           and empty($r['ans4']))
			{
				$answers_number = 3;
			}
			elseif (!empty($r['ans2'])
                  and empty($r['ans3']))
			{
				$answers_number = 2;
			}
			elseif (!empty($r['ans1'])
                 and empty($r['ans2']))
			{
				$answers_number = 1;
			}



     		       $answers = array();

     				$x = 0;

     				while ($x < $answers_number)
     				{
     					// The text of the answer
     					$answers[$x][0] = $r['ans'][$x];

     					// The result
     					$answers[$x][1] = 0;

     					$x += 1;
     				}

     				$PollArr 				= 	array();
     				$PollArr['field']	=	array();
     				$PollArr['field']['answers'] 	= $answers;
     				$PollArr['where']		=	array('id',$r['id']);

     				$UpdatePoll = $PowerBB->poll->UpdatePoll($PollArr);

		}

		return true;
	}

	function DropAnswerFields()
	{
		global $PowerBB;

		$this->_TempArr['DropArr'] = array();
		$this->_TempArr['DropArr']['table_name'] 	= 	$PowerBB->table['poll'];
		$this->_TempArr['DropArr']['field_name'] 	= 	'ans1';

		$drop = $this->drop_field($this->_TempArr['DropArr']);

		unset($this->_TempArr['DropArr']);

		$this->_TempArr['DropArr'] = array();
		$this->_TempArr['DropArr']['table_name'] 	= 	$PowerBB->table['poll'];
		$this->_TempArr['DropArr']['field_name'] 	= 	'ans2';

		$drop = $this->drop_field($this->_TempArr['DropArr']);

		unset($this->_TempArr['DropArr']);

		$this->_TempArr['DropArr'] = array();
		$this->_TempArr['DropArr']['table_name'] 	= 	$PowerBB->table['poll'];
		$this->_TempArr['DropArr']['field_name'] 	= 	'ans3';

		$drop = $this->drop_field($this->_TempArr['DropArr']);

		unset($this->_TempArr['DropArr']);

		$this->_TempArr['DropArr'] = array();
		$this->_TempArr['DropArr']['table_name'] 	= 	$PowerBB->table['poll'];
		$this->_TempArr['DropArr']['field_name'] 	= 	'ans4';

		$drop = $this->drop_field($this->_TempArr['DropArr']);

		unset($this->_TempArr['DropArr']);

		$this->_TempArr['DropArr'] = array();
		$this->_TempArr['DropArr']['table_name'] 	= 	$PowerBB->table['poll'];
		$this->_TempArr['DropArr']['field_name'] 	= 	'ans5';

		$drop = $this->drop_field($this->_TempArr['DropArr']);

		unset($this->_TempArr['DropArr']);

		$this->_TempArr['DropArr'] = array();
		$this->_TempArr['DropArr']['table_name'] 	= 	$PowerBB->table['poll'];
		$this->_TempArr['DropArr']['field_name'] 	= 	'ans6';

		$drop = $this->drop_field($this->_TempArr['DropArr']);

		unset($this->_TempArr['DropArr']);

		$this->_TempArr['DropArr'] = array();
		$this->_TempArr['DropArr']['table_name'] 	= 	$PowerBB->table['poll'];
		$this->_TempArr['DropArr']['field_name'] 	= 	'ans7';

		$drop = $this->drop_field($this->_TempArr['DropArr']);

		unset($this->_TempArr['DropArr']);

		$this->_TempArr['DropArr'] = array();
		$this->_TempArr['DropArr']['table_name'] 	= 	$PowerBB->table['poll'];
		$this->_TempArr['DropArr']['field_name'] 	= 	'ans8';

		$drop = $this->drop_field($this->_TempArr['DropArr']);

		unset($this->_TempArr['DropArr']);

		$this->_TempArr['DropArr'] = array();
		$this->_TempArr['DropArr']['table_name'] 	= 	$PowerBB->table['poll'];
		$this->_TempArr['DropArr']['field_name'] 	= 	'res1';

		$drop = $this->drop_field($this->_TempArr['DropArr']);

		unset($this->_TempArr['DropArr']);

		$this->_TempArr['DropArr'] = array();
		$this->_TempArr['DropArr']['table_name'] 	= 	$PowerBB->table['poll'];
		$this->_TempArr['DropArr']['field_name'] 	= 	'res2';

		$drop = $this->drop_field($this->_TempArr['DropArr']);

		unset($this->_TempArr['DropArr']);

		$this->_TempArr['DropArr'] = array();
		$this->_TempArr['DropArr']['table_name'] 	= 	$PowerBB->table['poll'];
		$this->_TempArr['DropArr']['field_name'] 	= 	'res3';

		$drop = $this->drop_field($this->_TempArr['DropArr']);

		unset($this->_TempArr['DropArr']);

		$this->_TempArr['DropArr'] = array();
		$this->_TempArr['DropArr']['table_name'] 	= 	$PowerBB->table['poll'];
		$this->_TempArr['DropArr']['field_name'] 	= 	'res4';

		$drop = $this->drop_field($this->_TempArr['DropArr']);

		unset($this->_TempArr['DropArr']);

		$this->_TempArr['DropArr'] = array();
		$this->_TempArr['DropArr']['table_name'] 	= 	$PowerBB->table['poll'];
		$this->_TempArr['DropArr']['field_name'] 	= 	'res5';

		$drop = $this->drop_field($this->_TempArr['DropArr']);

		unset($this->_TempArr['DropArr']);

		$this->_TempArr['DropArr'] = array();
		$this->_TempArr['DropArr']['table_name'] 	= 	$PowerBB->table['poll'];
		$this->_TempArr['DropArr']['field_name'] 	= 	'res6';

		$drop = $this->drop_field($this->_TempArr['DropArr']);

		unset($this->_TempArr['DropArr']);

		$this->_TempArr['DropArr'] = array();
		$this->_TempArr['DropArr']['table_name'] 	= 	$PowerBB->table['poll'];
		$this->_TempArr['DropArr']['field_name'] 	= 	'res7';

		$drop = $this->drop_field($this->_TempArr['DropArr']);

		unset($this->_TempArr['DropArr']);

		$this->_TempArr['DropArr'] = array();
		$this->_TempArr['DropArr']['table_name'] 	= 	$PowerBB->table['poll'];
		$this->_TempArr['DropArr']['field_name'] 	= 	'res8';

		$drop = $this->drop_field($this->_TempArr['DropArr']);

		unset($this->_TempArr['DropArr']);

		// Sorry! :/
		return true;
	}

	function AddUsernameStyleCache()
	{
		global $PowerBB;

		$this->_TempArr['AddArr']					=	array();
		$this->_TempArr['AddArr']['table']			=	$PowerBB->table['member'];
		$this->_TempArr['AddArr']['field_name']		=	'username_style_cache';
		$this->_TempArr['AddArr']['field_des']		=	'varchar( 255 ) NOT NULL';

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

	/** Username style cache **/
	function GenerateUsernameStyleCache()
	{
		global $PowerBB;

		$query = $PowerBB->DB->sql_query('SELECT * FROM ' . $PowerBB->table['group']);

		// TODO :: Pager is important here
		while ($r = $PowerBB->DB->sql_fetch_array($query))
		{
			$mem_query = $PowerBB->DB->sql_query('SELECT * FROM ' . $PowerBB->table['member'] . " WHERE usergroup='" . $r['id'] . "'");

			// Server will hate us :(
			while ($mem_r = $PowerBB->DB->sql_fetch_array($mem_query))
			{
				$style = $r['username_style'];
				$username_style_cache = str_replace('[username]',$mem_r['username'],$style);

				$update = $PowerBB->DB->sql_query('UPDATE ' . $PowerBB->table['member'] . " SET username_style_cache='" . $username_style_cache . "' WHERE id='" . $mem_r['id'] . "'");

			}
		}
	}
}

$PowerBB->install = new PowerBBTHETA;

$PowerBB->html->page_header('معالج ترقية برنامج منتديات PBBoard v2.0.3');
$logo = $PowerBB->html->create_image(array('align'=>'right','alt'=>'PowerBB','src'=>'../logo.jpg','return'=>true));
$PowerBB->html->open_table('100%',true);
$PowerBB->html->cells($logo,'header_logo_side');

if (!$PowerBB->install->CheckVersion())
{
	$PowerBB->html->cells('اصدار غير صحيح','main1');
	$PowerBB->html->close_table();

	$PowerBB->functions->errorstop('يرجى التحقق من انك قمت بتشغيل تحديثات OMEGA');
}

if ($PowerBB->_GET['step'] == 1)
 {
	$PowerBB->html->cells('عمليات الاضافه','main1');
	$PowerBB->html->close_table();

	$p 			= 	array();
	$msgs 		= 	$PowerBB->install->_Masseges;

	$p[1] 		= 	$PowerBB->install->AddAjaxSearch();
	$msgs[1] 	= 	($p[1]) ? 'تم اضافة حقل البحث بإستخدام اجاكس' : 'لم يتم اضافة حقل البحث بإستخدام اجاكس';

	$p[2] 		= 	$PowerBB->install->AddAjaxRegister();
	$msgs[2] 	= 	($p[2]) ? 'تم اضافة حقل التسجيل بإستخدام اجاكس' : 'لم يتم اضافة حقل التسجيل بإستخدام اجاكس';

	$p[3] 		= 	$PowerBB->install->AddAjaxReply();
	$msgs[3] 	= 	($p[3]) ? 'تم اضافة حقل الرد بإستخدام اجاكس' : 'لم يتم اضافة حقل الرد بإستخدام اجاكس';

	$p[3] 		= 	$PowerBB->install->AddAjaxMainRename();
	$msgs[3] 	= 	($p[3]) ? 'تم اضافة حقل  تغيير الاسم بإستخدام اجاكس' : 'لم يتم اضافة حقل تغيير الاسم بإستخدام اجاكس';

	$p[4] 		= 	$PowerBB->install->AddModerators();
	$msgs[4] 	= 	($p[4]) ? 'تم اضافة حقل المشرفين' : 'لم يتم اضافة حقل المشرفين';

	$p[4] 		= 	$PowerBB->install->AddAnswers();
	$msgs[4] 	= 	($p[4]) ? 'تم اضافة حقل الاجوبه' : 'لم يتم اضافة حقل الاجوبه';

	$p[5] 		= 	$PowerBB->install->AddUsername();
	$msgs[5] 	= 	($p[5]) ? 'تم اضافة حقل اسم المستخدم' : 'لم يتم اضافة حقل اسم المستخدم';

	$p[6] 		= 	$PowerBB->install->AddAutoreply();
	$msgs[6] 	= 	($p[6]) ? 'تم اضافة حقل الرد التلقائي' : 'لم يتم اضافة حقل الرد التلقائي';

	$p[7] 		= 	$PowerBB->install->AddAutoreplyTitle();
	$msgs[7] 	= 	($p[7]) ? 'تم اضافة حقل عنوان الرد التلقائي' : 'لم يتم اضافة حقل عنوان الرد التلقائي';

	$p[8] 		= 	$PowerBB->install->AddAutoreplyMsg();
	$msgs[8] 	= 	($p[8]) ? 'تم اضافة حقل محتوى الرد التلقائي' : 'لم يتم اضافة حقل محتوى الرد التلقائي';

	$p[9] 		= 	$PowerBB->install->AddPMSenders();
	$msgs[9] 	= 	($p[9]) ? 'تم اضافة حقل رساله للمرسلين' : 'لم يتم اضافة حقل رساله للمرسلين';

	$p[10] 		= 	$PowerBB->install->AddPMSendersMsg();
	$msgs[10] 	= 	($p[10]) ? 'تم اضافة حقل محتوى الرساله للمرسلين' : 'لم يتم اضافة حقل محتوى الرساله للمرسلين';


	$PowerBB->html->open_p();

	foreach ($msgs as $msg)
	{
		$PowerBB->html->p_msg($msg);
	}

	$PowerBB->html->close_p();

	$PowerBB->html->make_link('الخطوه الثانيه -> عمليات الإضافة 2','?stepAdd=2');

}
 elseif ($PowerBB->_GET['stepAdd'] == 2)
{
	$PowerBB->html->cells(' عمليات الاضافه 2','main1');
	$PowerBB->html->close_table();

	$p 			= 	array();
	$msgs 		= 	$PowerBB->install->_Masseges;

	$p[11] 		= 	$PowerBB->install->AddTagsCache();
	$msgs[11] 	= 	($p[11]) ? 'تم اضافة حقل المعلومات المخبأه للعلامات' : 'لم يتم اضافة حقل المعلومات المخبأه للعلامات';

	$p[12] 		= 	$PowerBB->install->AddCloseReason();
	$msgs[12] 	= 	($p[12]) ? 'تم اضافة حقل سبب الاغلاق' : 'لم يتم اضافة حقل سبب الاغلاق';

	$p[13] 		= 	$PowerBB->install->AddMemberIP();
	$msgs[13] 	= 	($p[13]) ? 'تم اضافة حقل عنوان الآيبي' : 'لم يتم اضافة حقل عنوان الآيبي';

	$p[15] 		= 	$PowerBB->install->AddMIMEType();
	$msgs[15] 	= 	($p[15]) ? 'تم اضافة حقل نوع MIME' : 'لم يتم اضافة حقل  نوع MIME';

	$p[15] 		= 	$PowerBB->install->AddDelReason();
	$msgs[15] 	= 	($p[15]) ? 'تم اضافة حقل سبب حذف الموضوع' : 'لم يتم اضافة حقل  حذف الموضوع';

	$p[16] 		= 	$PowerBB->install->AddAjaxModeratorOptions();
	$msgs[16] 	= 	($p[16]) ? 'تم اضافة حقل التحكم بالمواضيع عن طريق اجاكس' : 'لم يتم اضافة حقل التحكم بالمواضيع عن طريق اجاكس';

	$p[17]		=	$PowerBB->install->AddUsernameStyleCache();
	$msgs[17] 	= 	($p[17]) ? 'تم اضافة حقل اسم المستخدم حسب المجموعه' : 'لم يتم اضافة حقل اسم المستخدم حسب المجموعه';

	$p[18]		=	$PowerBB->install->AddUsePowerCodeAllow();
	$msgs[18] 	= 	($p[18]) ? 'تم اضافة حقل السماح باستخدام أوسمة BBcode' : 'لم يتم اضافة حقل السماح باستخدام أوسمة BBcode';

	$p[19]		=	$PowerBB->install->AddIcon();
	$msgs[19] 	= 	($p[19]) ? 'تم اضافة حقل ظهور ايقونة الموضوع بجانب اخر مشاركة في الصفحة الرئيسية' : 'لم يتم اضافة حقل ظهور ايقونة الموضوع بجانب اخر مشاركة في الصفحة الرئيسية';

	$p[20]		=	$PowerBB->install->AddHeader();
	$msgs[20] 	= 	($p[20]) ? 'تم اضافة حقل نص يظهر اعلى المنتدى' : 'لم يتم اضافة حقل نص يظهر اعلى المنتدى';

	$PowerBB->html->open_p();

	foreach ($msgs as $msg)
	{
		$PowerBB->html->p_msg($msg);
	}

	$PowerBB->html->close_p();

	$PowerBB->html->make_link('الخطوه الثانيه -> عمليات الإضافة 3','?stepAdd=3');

	}
 elseif ($PowerBB->_GET['stepAdd'] == 3)
 {
	$PowerBB->html->cells('عمليات الإضافة 2','main1');
	$PowerBB->html->close_table();

	$p 			= 	array();
	$msgs 		= 	$PowerBB->install->_Masseges;

	$p[21]		=	$PowerBB->install->AddFooter();
	$msgs[21] 	= 	($p[21]) ? 'تم اضافة حقل نص يظهر اسفل المنتدى' : 'لم يتم اضافة حقل نص يظهر اسفل المنتدى';

	$p[22]		=	$PowerBB->install->AddNoPosts();
	$msgs[22] 	= 	($p[22]) ? 'تم اضافة حقل عدم احتساب المشاركات' : 'لم يتم اضافة حقل عدم احتساب المشاركات';

	$p[23]		=	$PowerBB->install->AddReviewSubjectSection();
	$msgs[23] 	= 	($p[23]) ? 'تم اضافة حقل مواضيع في انتظار الموافقه' : 'لم يتم اضافة حقل مواضيع في انتظار الموافقه';

	$p[24]		=	$PowerBB->install->AddReviewSubject();
	$msgs[24] 	= 	($p[24]) ? 'تم اضافة حقل مواضيع في انتظار الموافقه' : 'لم يتم اضافة حقل مواضيع في انتظار الموافقه';

	$p[25]		=	$PowerBB->install->AddInviter();
	$msgs[25] 	= 	($p[25]) ? 'تم اضافة حقل الدعوات' : 'لم يتم اضافة حقل الدعوات';

	$p[26]		=	$PowerBB->install->AddInviteNum();
	$msgs[26] 	= 	($p[26]) ? 'تم اضافة حقل عدد الدعوات' : 'لم يتم اضافة حقل عدد الدعوات';

	$p[27]		=	$PowerBB->install->AddWarnings();
	$msgs[27] 	= 	($p[27]) ? 'تم اضافة حقل عدد الانذارات' : 'لم يتم اضافة حقل عدد الانذارات';

	$p[28]		=	$PowerBB->install->AddLangMember();
	$msgs[28] 	= 	($p[28]) ? 'تم اضافة حقل lang' : 'لم يتم اضافة حقل lang';

	$p[29]		=	$PowerBB->install->AddReview_subject();
	$msgs[29] 	= 	($p[29]) ? 'تم اضافة حقل review_subject' : 'لم يتم اضافة حقل review_subject';

	$p[30]		=	$PowerBB->install->AddSpecial();
	$msgs[30] 	= 	($p[30]) ? 'تم اضافة حقل special' : 'لم يتم اضافة حقل special';

	$p[31]		=	$PowerBB->install->AddPmId();
	$msgs[31] 	= 	($p[31]) ? 'تم اضافة حقل pm_id' : 'لم يتم اضافة حقل pm_id';

	$p[32]		=	$PowerBB->install->AddSendWarning();
	$msgs[32] 	= 	($p[32]) ? 'تم اضافة حقل send_warning' : 'لم يتم اضافة حقل send_warning';

	$p[33]		=	$PowerBB->install->AddCanWarned();
	$msgs[33] 	= 	($p[33]) ? 'تم اضافة حقل can_warned' : 'لم يتم اضافة حقل can_warned';

	$p[34] 		= 	$PowerBB->install->AddDefLang();
	$msgs[34] 	= 	($p[34]) ? 'تم إنشاء حقل اللغة الإفتراضية' : 'لم يتم إنشاء حقل اللغة الإفتراضية';


	$PowerBB->html->open_p();

	foreach ($msgs as $msg)
	{
		$PowerBB->html->p_msg($msg);
	}

	$PowerBB->html->close_p();

	$PowerBB->html->make_link('الخطوه الثانيه -> عمليات الإضافة 4','?stepAdd=4');

	}
elseif ($PowerBB->_GET['stepAdd'] == 4)
 {
	$PowerBB->html->cells('عمليات الإضافة 2','main1');
	$PowerBB->html->close_table();

	$p 			= 	array();
	$msgs 		= 	$PowerBB->install->_Masseges;

	$p[35] 		= 	$PowerBB->install->AddNoSub();
	$msgs[35] 	= 	($p[35]) ? 'تم إنشاء حقل no_sub' : 'لم يتم إنشاء حقل no_sub';

	$p[36] 		= 	$PowerBB->install->AddNoModerators();
	$msgs[36] 	= 	($p[36]) ? 'تم إنشاء حقل no_moderators' : 'لم يتم إنشاء حقل no_moderators';

	$p[37] 		= 	$PowerBB->install->AddNoDescribe();
	$msgs[37] 	= 	($p[37]) ? 'تم إنشاء حقل no_describe' : 'لم يتم إنشاء حقل no_describe';

	$p[38] 		= 	$PowerBB->install->AddDefaultAvatar();
	$msgs[38] 	= 	($p[38]) ? 'تم إنشاء حقل default_avatar' : 'لم يتم إنشاء حقل default_avatar';

	$p[39] 		= 	$PowerBB->install->AddWarningNumberTtoBan();
	$msgs[39] 	= 	($p[39]) ? 'تم إنشاء حقل warning_number_to_ban' : 'لم يتم إنشاء حقل warning_number_to_ban';

	$p[40] 		= 	$PowerBB->install->AddRegSat();
	$msgs[40] 	= 	($p[40]) ? 'تم إنشاء حقل reg_Sat' : 'لم يتم إنشاء حقل reg_Sat';

	$p[41] 		= 	$PowerBB->install->AddRegSun();
	$msgs[41] 	= 	($p[41]) ? 'تم إنشاء حقل reg_Sun' : 'لم يتم إنشاء حقل reg_Sun';

	$p[42] 		= 	$PowerBB->install->AddRegMon();
	$msgs[42] 	= 	($p[42]) ? 'تم إنشاء حقل reg_Mon' : 'لم يتم إنشاء حقل reg_Mon';

	$p[43] 		= 	$PowerBB->install->AddRegTue();
	$msgs[43] 	= 	($p[43]) ? 'تم إنشاء حقل reg_Tue' : 'لم يتم إنشاء حقل reg_Tue';

	$p[44] 		= 	$PowerBB->install->AddRegWed();
	$msgs[44] 	= 	($p[44]) ? 'تم إنشاء حقل reg_Wed' : 'لم يتم إنشاء حقل reg_Wed';

	$p[45] 		= 	$PowerBB->install->AddRegThu();
	$msgs[45] 	= 	($p[45]) ? 'تم إنشاء حقل reg_Thu' : 'لم يتم إنشاء حقل reg_Thu';


	$PowerBB->html->open_p();

	foreach ($msgs as $msg)
	{
		$PowerBB->html->p_msg($msg);
	}

	$PowerBB->html->close_p();

	$PowerBB->html->make_link('الخطوه الثانيه -> عمليات الإضافة 5','?stepAdd=5');

	}
elseif ($PowerBB->_GET['stepAdd'] == 5)
{
    $PowerBB->html->cells('عمليات الإضافة 5','main1');
	$PowerBB->html->close_table();

	$p 			= 	array();
	$msgs 		= 	$PowerBB->install->_Masseges;

	$p[46] 		= 	$PowerBB->install->AddRegFri();
	$msgs[46] 	= 	($p[46]) ? 'تم إنشاء حقل reg_Fri' : 'لم يتم إنشاء حقل reg_Fri';

	$p[47] 		= 	$PowerBB->install->AddAdminNotes();
	$msgs[47] 	= 	($p[47]) ? 'تم إنشاء حقل admin_notes' : 'لم يتم إنشاء حقل admin_notes';

	$p[48] 		= 	$PowerBB->install->AddPmFeature();
	$msgs[48] 	= 	($p[48]) ? 'تم إنشاء حقل pm_feature' : 'لم يتم إنشاء حقل pm_feature';

	$p[49] 		= 	$PowerBB->install->AddWordwrap();
	$msgs[49] 	= 	($p[49]) ? 'تم إنشاء حقل wordwrap' : 'لم يتم إنشاء حقل wordwrap';

	$p[50] 		= 	$PowerBB->install->AddMembersSendPm();
	$msgs[50] 	= 	($p[50]) ? 'تم إنشاء حقل members_send_pm' : 'لم يتم إنشاء حقل members_send_pm';

	$p[51] 		= 	$PowerBB->install->AddDescription();
	$msgs[51] 	= 	($p[51]) ? 'تم إنشاء حقل description' : 'لم يتم إنشاء حقل description';

	$p[52] 		= 	$PowerBB->install->AddKeywords();
	$msgs[52] 	= 	($p[52]) ? 'تم إنشاء حقل keywords' : 'لم يتم إنشاء حقل keywords';

	$p[53] 		= 	$PowerBB->install->AddContent_Language();
	$msgs[53] 	= 	($p[53]) ? 'تم إنشاء حقل content_language' : 'لم يتم إنشاء حقل content_language';

	$p[54] 		= 	$PowerBB->install->AddCharset();
	$msgs[54] 	= 	($p[54]) ? 'تم إنشاء حقل charset' : 'لم يتم إنشاء حقل charset';

	$p[55] 		= 	$PowerBB->install->AddContent_Dir();
	$msgs[55] 	= 	($p[55]) ? 'تم إنشاء حقل content_dir' : 'لم يتم إنشاء حقل content_dir';

	$p[56] 		= 	$PowerBB->install->AddAnswerNumber();
	$msgs[56] 	= 	($p[56]) ? 'تم إنشاء حقل answer_number' : 'لم يتم إنشاء حقل answer_number';


	$PowerBB->html->open_p();

	foreach ($msgs as $msg)
	{
		$PowerBB->html->p_msg($msg);
	}

	$PowerBB->html->close_p();

	$PowerBB->html->make_link('الخطوه الثانيه -> عمليات الإضافة 6','?stepAdd=6');

	}
elseif ($PowerBB->_GET['stepAdd'] == 6)
{
	$PowerBB->html->cells('عمليات الإضافة 6','main1');
	$PowerBB->html->close_table();

	$p 			= 	array();
	$msgs 		= 	$PowerBB->install->_Masseges;

	$p[57] 		= 	$PowerBB->install->AddSubjectId();
	$msgs[57] 	= 	($p[57]) ? 'تم إنشاء حقل subject_id' : 'لم يتم إنشاء حقل subject_id';

	$p[58] 		= 	$PowerBB->install->AddVotes();
	$msgs[58] 	= 	($p[58]) ? 'تم إنشاء حقل votes' : 'لم يتم إنشاء حقل votes';

	$p[59]		=	$PowerBB->install->AddNoPostsGroup();
	$msgs[59] 	= 	($p[59]) ? 'تم اضافة حقل عدم احتساب المشاركات' : 'لم يتم اضافة حقل عدم احتساب المشاركات';

	$p[60] 		= 	$PowerBB->install->AddAttachExtension();
	$msgs[60] 	= 	($p[60]) ? 'تم إنشاء حقل extension' : 'لم يتم إنشاء حقل extension';

	$p[61] 		= 	$PowerBB->install->AddCaptcha();
	$msgs[61] 	= 	($p[61]) ? 'تم إنشاء حقل captcha_o' : 'لم يتم إنشاء حقل captcha_o';

	$p[62] 		= 	$PowerBB->install->AddAcStat();
	$msgs[62] 	= 	($p[62]) ? 'تم إنشاء حقل activate_last_static_list' : 'لم يتم إنشاء حقل activate_last_static_list';

	$p[63] 		= 	$PowerBB->install->AddLastStaticNum();
	$msgs[63] 	= 	($p[63]) ? 'تم إنشاء حقل last_static_num' : 'لم يتم إنشاء حقل last_static_num';

	$p[64] 		= 	$PowerBB->install->AddLastPostsStaticNum();
	$msgs[64] 	= 	($p[64]) ? 'تم إنشاء حقل last_posts_static_num' : 'لم يتم إنشاء حقل last_posts_static_num';

	$p[65] 		= 	$PowerBB->install->AddForumIdNotInStatic();
	$msgs[65] 	= 	($p[65]) ? 'تم إنشاء حقل forum_id_not_in_static' : 'لم يتم إنشاء حقل forum_id_not_in_static';



	$PowerBB->html->open_p();

	foreach ($msgs as $msg)
	{
		$PowerBB->html->p_msg($msg);
	}

	$PowerBB->html->close_p();

	$PowerBB->html->make_link('الخطوه الثانيه -> عمليات الإضافة 7','?stepAdd=7');

	}
elseif ($PowerBB->_GET['stepAdd'] == 7)
 {
	$PowerBB->html->cells('عمليات الإضافة 7','main1');
	$PowerBB->html->close_table();

	$p 			= 	array();
	$msgs 		= 	$PowerBB->install->_Masseges;

		$p[66] 		= 	$PowerBB->install->AddActivateLastsPostsBar();
	$msgs[66] 	= 	($p[66]) ? 'تم إنشاء حقل activate_lasts_posts_bar' : 'لم يتم إنشاء حقل activate_lasts_posts_bar';

	$p[67] 		= 	$PowerBB->install->AddForumIdNotInLastsPostsBar();
	$msgs[67] 	= 	($p[67]) ? 'تم إنشاء حقل forum_id_not_in_lasts_posts_bar' : 'لم يتم إنشاء حقل forum_id_not_in_lasts_posts_bar';

	$p[68] 		= 	$PowerBB->install->AddLastsPostsBarNum();
	$msgs[68] 	= 	($p[68]) ? 'تم إنشاء حقل lasts_posts_bar_num' : 'لم يتم إنشاء حقل lasts_posts_bar_num';

	$p[69] 		= 	$PowerBB->install->AddLastsPostsBarDir();
	$msgs[69] 	= 	($p[69]) ? 'تم إنشاء حقل lasts_posts_bar_dir' : 'لم يتم إنشاء حقل lasts_posts_bar_dir';

	$p[70] 		= 	$PowerBB->install->AddActivateSpecialBar();
	$msgs[70] 	= 	($p[70]) ? 'تم إنشاء حقل activate_special_bar' : 'لم يتم إنشاء حقل activate_special_bar';

	$p[71] 		= 	$PowerBB->install->AddSpecialBarDir();
	$msgs[71] 	= 	($p[71]) ? 'تم إنشاء حقل special_bar_dir' : 'لم يتم إنشاء حقل special_bar_dir';

	$p[72]		=	$PowerBB->install->AddHideAllow();
	$msgs[72] 	= 	($p[72]) ? 'تم اضافة حقل hide_allow' : 'لم يتم اضافة حقل hide_allow';

	$p[73] 		= 	$PowerBB->install->AddSubjectDescribeShow();
	$msgs[73] 	= 	($p[73]) ? 'تم إنشاء حقل subject_describe_show' : 'لم يتم إنشاء حقل subject_describe_show';

	$p[74] 		= 	$PowerBB->install->AddRules();
	$msgs[74] 	= 	($p[74]) ? 'تم إنشاء حقل rules' : 'لم يتم إنشاء حقل rules';

	$p[75] 		= 	$PowerBB->install->AddCensorWords();
	$msgs[75] 	= 	($p[75]) ? 'تم إنشاء حقل censorwords' : 'لم يتم إنشاء حقل censorwords';

	$PowerBB->html->open_p();

	foreach ($msgs as $msg)
	{
		$PowerBB->html->p_msg($msg);
	}

	$PowerBB->html->close_p();

	$PowerBB->html->make_link('الخطوه الثانيه -> عمليات تغيير الاسم','?step=2');
}
elseif ($PowerBB->_GET['step'] == 2)
{
	$PowerBB->html->cells('عمليات تغيير الاسم','main1');
	$PowerBB->html->close_table();

	$p 			= 	array();
	$msgs 		= 	$PowerBB->install->_Masseges;

	$p[1] 		= 	$PowerBB->install->RenameModeratorTable();
	$msgs[1] 	= 	($p[1]) ? 'تم تغيير اسم جدول المشرفين' : 'لم يتم تغيير اسم جدول المشرفين';

	$PowerBB->html->open_p();

	foreach ($msgs as $msg)
	{
		$PowerBB->html->p_msg($msg);
	}

	$PowerBB->html->close_p();

	$PowerBB->html->make_link('الخطوه الثالثه -> تغيير نظام التصويت','?step=3');
}
elseif ($PowerBB->_GET['step'] == 3)
{
	$PowerBB->html->cells('تغيير نظام التصويت','main1');
	$PowerBB->html->close_table();

	$convert = $PowerBB->install->ConvertPollInformation();

	if ($convert)
	{
		$PowerBB->html->open_p();
		$PowerBB->html->p_msg('تم نقل المعلومات إلى النظام الجديد');
		$PowerBB->html->close_p();

		$p = $PowerBB->install->DropAnswerFields();

		if ($p)
		{
			$PowerBB->html->open_p();
			$PowerBB->html->p_msg('تم ازالة الحقول غير المرغوب بها');
			$PowerBB->html->close_p();
		}
	}

	$PowerBB->html->make_link('الخطوه الرابعه -> عمليات الإنشاء','?step=4');
}
elseif ($PowerBB->_GET['step'] == 4)
{
	$PowerBB->html->cells('عمليات الانشاء','main1');
	$PowerBB->html->close_table();

	$p 			= 	array();
	$msgs 		= 	$PowerBB->install->_Masseges;

	$p[1] 		= 	$PowerBB->install->CreateTagsTable();
	$msgs[1] 	= 	($p[1]) ? 'تم إنشاء جدول العلامات' : 'لم يتم إنشاء جدول العلامات';

	$p[2] 		= 	$PowerBB->install->CreateTagsSubjectTable();
	$msgs[2] 	= 	($p[2]) ? 'تم إنشاء جدول علامات المواضيع' : 'لم يتم إنشاء جدول علامات المواضيع';

	$p[3] 		= 	$PowerBB->install->CreateExtrafields();
	$msgs[3] 	= 	($p[3]) ? 'تم إنشاء جدول الحقول الأضافية' : 'لم يتم إنشاء جدول الحقول الأضافية';

	$p[4] 		= 	$PowerBB->install->CreateWarnlog();
	$msgs[4] 	= 	($p[4]) ? 'تم إنشاء جدول إنذارات الأعضاء' : 'لم يتم إنشاء جدول إنذارات الأعضاء';


	$PowerBB->html->open_p();

	foreach ($msgs as $msg)
	{
		$PowerBB->html->p_msg($msg);
	}

	$PowerBB->html->close_p();

	$PowerBB->html->make_link('الخطوه الخامسه -> تغيير نظام المنتديات','?step=5');
}
elseif ($PowerBB->_GET['step'] == 5)
{
	$PowerBB->html->cells('تغيير نظام المنتديات','main1');
	$PowerBB->html->close_table();


		$PowerBB->html->open_p();
		$PowerBB->html->p_msg('تم اضافة الحقل');
		$PowerBB->html->close_p();

		$main = $PowerBB->install->ChangeMainSections();

		if ($main)
		{
			$PowerBB->html->open_p();
			$PowerBB->html->p_msg('تم تحويل الاقسام الرئيسيه إلى النظام الجديد');
			$PowerBB->html->close_p();

			$normal = $PowerBB->install->ChangeSections();

			if ($normal)
			{
				$PowerBB->html->open_p();
				$PowerBB->html->p_msg('تم تحويل المنتديات إلى النظام الجديد');
				$PowerBB->html->close_p();

			}


		}


		   $SubSections = $PowerBB->install->ChangeSubSections();

		   	if ($SubSections)
			{
				$PowerBB->html->open_p();
				$PowerBB->html->p_msg('تم تحويل المنتديات الفرعية إلى النظام الجديد');
				$PowerBB->html->close_p();

			}


$PowerBB->html->make_link('الخطوه السادسه  -> تغيير اصدار المنتدى وتحديث الكاش','?step=6');
}
elseif ($PowerBB->_GET['step'] == 6)
{
	$PowerBB->html->cells('الخطوة السادسة ','main1');
	$PowerBB->html->close_table();

	$Update = $PowerBB->section->UpdateAllSectionsCache();

	$NewVersion = $PowerBB->install->UpdateVersion();

    $PowerBB->install->UpdateIconPathn();

    $PowerBB->section->UpdateSectionsCache(array('id'=>'normal'));


    $PowerBB->html->open_p();
	$PowerBB->html->make_link('اضغط هنا','upg_201.php?step=1');
	$PowerBB->html->p_msg('لتبدأ الترقية إلى الإصدار 2.0.1');
	$PowerBB->html->close_p();



}


?>