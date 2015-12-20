<?php
define('NO_INFO',true);

$CALL_SYSTEM = array();
$CALL_SYSTEM['ICONS'] = true;
$CALL_SYSTEM['GROUP'] 		= 	true;
$CALL_SYSTEM['MEMBER'] 		= 	true;
$CALL_SYSTEM['INFO'] 		= 	true;
$CALL_SYSTEM['SECTION'] 	= 	true;
$CALL_SYSTEM['CORE']        = 	true;
$CALL_SYSTEM['LANG']        = 	true;

$Get_language = @include("../lang/".$PowerBB->_GET['lang']."/language.php");
if (!$Get_language)
{
@include("../lang/ar/language.php");
}
require_once('database_struct.php');
class Install extends DatabaseStruct
{
	var $_TempArr 	= 	array();
	var $_Masseges	=	array();
	var $lang	    =	array();

	function CheckMember()
	{
		global $PowerBB;

        $info_query = $PowerBB->DB->sql_num_rows($PowerBB->DB->sql_query("SELECT * FROM " . $PowerBB->table['member'] . " WHERE id "));

		return ($info_query > '0') ? true : false;
	}

	function NOT_INSTALLED()
	{
		global $PowerBB;

      $info_query = $PowerBB->DB->sql_query("SELECT * FROM " . $PowerBB->table['info'] . " ");
		return ($info_query) ? true : false;
	}

	function CheckMember1()
	{
		global $PowerBB;

        $info_query = $PowerBB->DB->sql_num_rows($PowerBB->DB->sql_query("SELECT * FROM " . $PowerBB->table['member'] . " WHERE id "));

		return ($info_query > '1') ? true : false;
	}

   // Create Tables 2  PRIMARY KEY
	function _CreateProfileVisitor()
	{
		global $PowerBB;
		  $create_query = $PowerBB->DB->sql_query("CREATE TABLE ".$PowerBB->table['profile_view']." (
		  profile_user_id mediumint(8) unsigned NOT NULL,
		  viewer_user_id mediumint(8) unsigned NOT NULL,
		  viewer_user_counter mediumint(8) unsigned NOT NULL,
		  viewer_visit_time int(11) unsigned NOT NULL default '0',
		   KEY profile_user_id (profile_user_id),
		   KEY viewer_user_id (viewer_user_id))");

		return ($create_query) ? true : false;

	}

	function CreateTables(&$msgs)
	{
		global $PowerBB;


		$p = array();
        @include("../lang/".$PowerBB->_GET['lang']."/language.php");


        $success 	= 	$lang['The_table_is_created'];
		$fail 		= 	$lang['Table_is_not_created'];

		$p[1] = $this->_CreateEmailMasseges();
		$msgs[1] = ($p[1]) ? $success . $PowerBB->table['email_msg'] : $fail . $PowerBB->table['email_msg'];

		$p[2] = $this->_CreateExtension();
		$msgs[2] = ($p[2]) ? $success . $PowerBB->table['extension'] : $fail . $PowerBB->table['extension'];

		$p[3] = $this->_CreateGroup();
		$msgs[3] = ($p[3]) ? $success . $PowerBB->table['group'] : $fail . $PowerBB->table['group'];

		$p[4] = $this->_CreateInfo();
		$msgs[4] = ($p[4]) ? $success . $PowerBB->table['info'] : $fail . $PowerBB->table['info'];

		$p[5] = $this->_CreateMember();
		$msgs[5] = ($p[5]) ? $success . $PowerBB->table['member'] : $fail . $PowerBB->table['member'];

		$p[6] = $this->_CreateOnline();
		$msgs[6] = ($p[6]) ? $success . $PowerBB->table['online'] : $fail . $PowerBB->table['online'];

		$p[7] = $this->_CreatePages();
		$msgs[7] = ($p[7]) ? $success . $PowerBB->table['pages'] : $fail . $PowerBB->table['pages'];

		$p[8] = $this->_CreatePrivateMassege();
		$msgs[8] = ($p[8]) ? $success . $PowerBB->table['pm'] : $fail . $PowerBB->table['pm'];

		$p[9] = $this->_CreatePrivateMassegeFolder();
		$msgs[9] = ($p[9]) ? $success . $PowerBB->table['pm_folder'] : $fail . $PowerBB->table['pm_folder'];

		$p[10] = $this->_CreatePrivateMassegeLists();
		$msgs[10] = ($p[10]) ? $success . $PowerBB->table['pm_lists'] : $fail . $PowerBB->table['pm_lists'];

		$p[11] = $this->_CreatePoll();
		$msgs[11] = ($p[11]) ? $success . $PowerBB->table['poll'] : $fail . $PowerBB->table['poll'];

		$p[12] = $this->_CreateReply();
		$msgs[12] = ($p[12]) ? $success . $PowerBB->table['reply'] : $fail . $PowerBB->table['reply'];

		$p[13] = $this->_CreateRequests();
		$msgs[13] = ($p[13]) ? $success . $PowerBB->table['requests'] : $fail . $PowerBB->table['requests'];

		$p[14] = $this->_CreateSection();
		$msgs[14] = ($p[14]) ? $success . $PowerBB->table['section'] : $fail . $PowerBB->table['section'];

		$p[15] = $this->_CreateSectionAdmin();
		$msgs[15] = ($p[15]) ? $success . $PowerBB->table['moderators'] : $fail . $PowerBB->table['moderators'];

		$p[16] = $this->_CreateSectionGroup();
		$msgs[16] = ($p[16]) ? $success . $PowerBB->table['section_group'] : $fail . $PowerBB->table['section_group'];

		$p[17] = $this->_CreateSmiles();
		$msgs[17] = ($p[17]) ? $success . $PowerBB->table['smiles'] : $fail . $PowerBB->table['smiles'];

		$p[18] = $this->_CreateStyle();
		$msgs[18] = ($p[18]) ? $success . $PowerBB->table['style'] : $fail . $PowerBB->table['style'];

		$p[19] = $this->_CreateSubject();
		$msgs[19] = ($p[19]) ? $success . $PowerBB->table['subject'] : $fail . $PowerBB->table['subject'];

		$p[20] = $this->_CreateSuperMemberLogs();
		$msgs[20] = ($p[20]) ? $success . $PowerBB->table['sm_logs'] : $fail . $PowerBB->table['sm_logs'];

		$p[21] = $this->_CreateToday();
		$msgs[21] = ($p[21]) ? $success . $PowerBB->table['today'] : $fail . $PowerBB->table['today'];

		$p[22] = $this->_CreateToolBox();
		$msgs[22] = ($p[22]) ? $success . $PowerBB->table['toolbox'] : $fail . $PowerBB->table['toolbox'];

		$p[23] = $this->_CreateUserTitle();
		$msgs[23] = ($p[23]) ? $success . $PowerBB->table['usertitle'] : $fail . $PowerBB->table['usertitle'];

		$p[24] = $this->_CreateVote();
		$msgs[24] = ($p[24]) ? $success . $PowerBB->table['vote'] : $fail . $PowerBB->table['vote'];

		$p[25] = $this->_CreateAds();
		$msgs[25] = ($p[25]) ? $success . $PowerBB->table['ads'] : $fail . $PowerBB->table['ads'];

		$p[26] = $this->_CreateAnnouncement();
		$msgs[26] = ($p[26]) ? $success . $PowerBB->table['announcement'] : $fail . $PowerBB->table['announcement'];

		$p[27] = $this->_CreateAttach();
		$msgs[27] = ($p[27]) ? $success . $PowerBB->table['attach'] : $fail . $PowerBB->table['attach'];

		$p[28] = $this->_CreateAvatar();
		$msgs[28] = ($p[28]) ? $success . $PowerBB->table['avatar'] : $fail . $PowerBB->table['avatar'];

		$p[29] = $this->_CreateBanned();
		$msgs[29] = ($p[29]) ? $success . $PowerBB->table['banned'] : $fail . $PowerBB->table['banned'];

		$p[30] = $this->_CreateTags();
		$msgs[30] = ($p[30]) ? $success . $PowerBB->table['tag'] : $fail . $PowerBB->table['tag'];

		$p[31] = $this->_CreateTagsSubject();
		$msgs[31] = ($p[31]) ? $success . $PowerBB->table['tag_subject'] : $fail . $PowerBB->table['tag_subject'];

	    $p[32] = $this->_CreateExtrafields();
        $msgs[32] = ($p[32]) ? $success . $PowerBB->table['extrafield'] : $fail . $PowerBB->table['extrafield'];

        $p[33] = $this->_CreateWarnlog();
        $msgs[33] = ($p[33]) ? $success . $PowerBB->table['warnlog'] : $fail . $PowerBB->table['warnlog'];

        $p[34] = $this->_CreateLang();
		$msgs[34] = ($p[34]) ? $success . $PowerBB->table['lang'] : $fail . $PowerBB->table['lang'];

		$p[35] = $this->_CreateFaq();
		$msgs[35] = ($p[35]) ? $success . $PowerBB->table['faq'] : $fail . $PowerBB->table['faq'];

		$p[36] = $this->_CreateReputation();
		$msgs[36] = ($p[36]) ? $success . $PowerBB->table['reputation'] : $fail . $PowerBB->table['reputation'];

		$p[37] = $this->_CreateRating();
		$msgs[37] = ($p[37]) ? $success . $PowerBB->table['rating'] : $fail . $PowerBB->table['rating'];

		$p[38] = $this->_CreateChat_Message();
		$msgs[38] = ($p[38]) ? $success . $PowerBB->table['chat'] : $fail . $PowerBB->table['chat'];

 		$p[39] = $this->_CreateEmailed();
		$msgs[39] = ($p[39]) ? $success . $PowerBB->table['emailed'] : $fail . $PowerBB->table['emailed'];

 		$p[40] = $this->_CreateVisitor();
		$msgs[40] = ($p[40]) ? $success . $PowerBB->table['visitor'] : $fail . $PowerBB->table['visitor'];

 		$p[41] = $this->_CreateAward();
		$msgs[41] = ($p[41]) ? $success . $PowerBB->table['award'] : $fail . $PowerBB->table['award'];

 		$p[42] = $this->_CreateAdsense();
		$msgs[42] = ($p[42]) ? $success . $PowerBB->table['adsense'] : $fail . $PowerBB->table['adsense'];

 		$p[43] = $this->_CreateFriends();
		$msgs[43] = ($p[43]) ? $success . $PowerBB->table['friends'] : $fail . $PowerBB->table['friends'];

 		$p[44] = $this->_CreateAddons();
		$msgs[44] = ($p[44]) ? $success . $PowerBB->table['addons'] : $fail . $PowerBB->table['addons'];

		$p[45] = $this->_CreateHooks();
		$msgs[45] = ($p[45]) ? $success . $PowerBB->table['hooks'] : $fail . $PowerBB->table['hooks'];

		$p[46] = $this->_CreateTemplatesEdits();
		$msgs[46] = ($p[46]) ? $success . $PowerBB->table['templates_edits'] : $fail . $PowerBB->table['templates_edits'];

 		$p[47] = $this->_CreateVisitorMessage();
		$msgs[47] = ($p[47]) ? $success . $PowerBB->table['visitormessage'] : $fail . $PowerBB->table['visitormessage'];

 		$p[48] = $this->_CreateUserRating();
		$msgs[48] = ($p[48]) ? $success . $PowerBB->table['userrating'] : $fail . $PowerBB->table['userrating'];

 		$p[49] = $this->_CreateEmailMessages();
		$msgs[49] = ($p[49]) ? $success . $PowerBB->table['emailmessages'] : $fail . $PowerBB->table['emailmessages'];

 		$p[50] = $this->_CreateFeeds();
		$msgs[50] = ($p[50]) ? $success . $PowerBB->table['feeds'] : $fail . $PowerBB->table['feeds'];

 		$p[51] = $this->_CreateTopicMod();
		$msgs[51] = ($p[51]) ? $success . $PowerBB->table['topicmod'] : $fail . $PowerBB->table['topicmod'];

 		$p[52] = $this->_CreateCustomBBcode();
		$msgs[52] = ($p[52]) ? $success . $PowerBB->table['custom_bbcode'] : $fail . $PowerBB->table['custom_bbcode'];

 		$p[53] = $this->_CreateBlocks();
		$msgs[53] = ($p[53]) ? $success . $PowerBB->prefix."blocks" : $fail . $PowerBB->prefix."blocks";

 		$p[54] = $this->_CreateTemplate();
		$msgs[54] = ($p[54]) ? $success . $PowerBB->prefix."template" : $fail . $PowerBB->prefix."template";

 		$p[55] = $this->_CreatePhrase();
		$msgs[55] = ($p[55]) ? $success . $PowerBB->prefix."phrase_language" : $fail . $PowerBB->prefix."phrase_language";

 		$p[65] = $this->_CreateProfileVisitor();
		$msgs[65] = ($p[65]) ? $success . $PowerBB->prefix."profile_view" : $fail . $PowerBB->prefix."profile_view";

	}

	function InsertInformation(&$msgs)
	{
		global $PowerBB;

		$p = array();

        @include("../lang/".$PowerBB->_GET['lang']."/language.php");

        $success 	= 	$lang['Been_introduced'];
		$fail       =   $lang['Is_not_introduced'];

		$p[0] = $this->_InsertGroup();
		$msgs[0] = ($p[0]) ? $success . $lang['InsertGroup'] : $fail . $lang['InsertGroup'];

		$p[1] = $this->_InsertExtension();
		$msgs[1] = ($p[1]) ? $success . $lang['InsertExtension'] : $fail . $lang['InsertExtension'];

		$p[2] = $this->_InsertEmailMasseges();
		$msgs[2] = ($p[2]) ? $success . $lang['InsertEmailMasseges'] : $fail . $lang['InsertEmailMasseges'];

		$p[3] = $this->_InsertInfo();
		$msgs[3] = ($p[3]) ? $success . $lang['InsertInfo'] : $fail . $lang['InsertInfo'];

		$p[4] = $this->_InsertSmiles();
		$msgs[4] = ($p[4]) ? $success . $lang['InsertSmiles'] : $fail . $lang['InsertSmiles'];

		$p[7] = $this->_InsertToolBox();
		$msgs[7] = ($p[7]) ? $success . $lang['InsertToolBox'] : $fail . $lang['InsertToolBox'];

		$p[8] = $this->_InsertUserTitle();
		$msgs[8] = ($p[8]) ? $success . $lang['InsertUserTitle'] : $fail . $lang['InsertUserTitle'];

	    $p[9] = $this->_InsertSection();
        $msgs[9] = ($p[9]) ? $success . $lang['InsertSection'] : $fail . $lang['InsertSection'];

		$p[10] = $this->_InsertAvatar();
		$msgs[10] = ($p[10]) ? $success . $lang['InsertAvatar'] : $fail . $lang['InsertAvatar'];

		$p[11] = $this->_InsertUserRating();
		$msgs[11] = ($p[11]) ? $success . $lang['InsertUserRating'] : $fail . $lang['InsertUserRating'];

		$p[12] = $this->_InsertBlocks();
		$msgs[12] = ($p[12]) ? $success . $lang['InsertBlocks'] : $fail . $lang['InsertBlocks'];

	}

	function InsertStyle(&$msgs)
	{
		global $PowerBB;

		$p = array();

       @include("../lang/".$PowerBB->_GET['lang']."/language.php");

        $success 	= 	$lang['Been_introduced'];
		$fail       =   $lang['Is_not_introduced'];

		$p[0] = $this->_InsertStyle();
		$msgs[0] = ($p[0]) ? $success . $lang['InsertStyle'] : $fail . $lang['InsertStyle'];
    }

	function InsertLang_ar(&$msgs)
	{
		global $PowerBB;

		$p = array();

       @include("../lang/".$PowerBB->_GET['lang']."/language.php");

        $success 	= 	$lang['Been_introduced'];
		$fail       =   $lang['Is_not_introduced'];

        $p[0] = $this->_InsertLang_ar();
        $msgs[0] = ($p[0]) ? $success . $lang['InsertArLang'] : $fail . $lang['InsertArLang'];
   }

	function InsertLang_en(&$msgs)
	{
		global $PowerBB;

		$p = array();

       @include("../lang/".$PowerBB->_GET['lang']."/language.php");

        $success 	= 	$lang['Been_introduced'];
		$fail       =   $lang['Is_not_introduced'];

        $p[0] = $this->_InsertLang_en();
        $msgs[0] = ($p[0]) ? $success . $lang['InsertEnLang'] : $fail . $lang['InsertEnLang'];
   }
}

$PowerBB->install = new Install;
$langchoose = $PowerBB->_POST['lang'].$PowerBB->_GET['lang'];
$PowerBB->html->page_body('<div class="pbboard_body">');

	if ($langchoose=='en')
	{
     $PowerBB->html->page_header('Wizard Install PBBoard Forums v3.0.2');
	}
	elseif ($langchoose=='ar')
	{
     $PowerBB->html->page_header('معالج تثبيت برنامج منتديات PBBoard');
	}
	else
	{
     $PowerBB->html->page_header('معالج تثبيت برنامج منتديات PBBoard - Wizard Install PBBoard Forums v3.0.2');
    }
$logo = $PowerBB->html->create_image(array('id'=>'logo','align'=>'left','alt'=>'PowerBB','src'=>'../logo.png', 'border'=>'0', 'cellspacing'=>'0','return'=>true));
$PowerBB->html->open_table('100%',true);
$PowerBB->html->cells($logo,'header_logo_side');
if (empty($PowerBB->_GET['step']))
{

    $PowerBB->html->cells('اختيار اللغة - choose language','main1');
	$PowerBB->html->close_table();
    $PowerBB->html->open_form('index.php?step=lang');
	$PowerBB->html->open_table('60%',true,1);
	$PowerBB->html->open_table_head('اختيار اللغة - choose language','main1');
	$PowerBB->html->row1('',$PowerBB->html->select('lang',array('ar'=>' (اللغة العربية) Arabic language','en'=>' (اللغة الإنجليزية) English Language')));
	$PowerBB->html->close_table();
	$PowerBB->html->close_form();
}

if ($PowerBB->_GET['step'] == 'lang')
{

    @include("../lang/".$PowerBB->_POST['lang']."/language.php");

	$PowerBB->html->cells($lang['welcome_message_cells'],'main1');
	$PowerBB->html->close_table();

	$PowerBB->html->msg($lang['welcome_message_msg']);
	$PowerBB->html->make_link($lang['make_link_step1'],'?step=1&lang='.$PowerBB->_POST['lang']);
 }

if ($PowerBB->_GET['step'] == 1)
{

    @include("../lang/".$PowerBB->_GET['lang']."/language.php");
	$PowerBB->html->cells($lang['verification_permits_folders'],'main1');
	$PowerBB->html->close_table();
       // Check Permissions Foldrs
		if (!is_writable('../../download'))
		{
		$PowerBB->html->msg($lang['error_permissions_download_file']);
		}
		else
		{
		$PowerBB->html->msg($lang['correctly_permissions_download_file']);
		}
		if (!is_writable('../../download/avatar'))
		{
		$PowerBB->html->msg($lang['error_permissions_avatar_file'])	;
		}
		else
		{
		$PowerBB->html->msg($lang['correctly_permissions_avatar_file']);
		}
		if (!is_writable('../../download/contact'))
		{
		$PowerBB->html->msg($lang['error_permissions_contact_file'])	;
		}
		else
		{
		$PowerBB->html->msg($lang['correctly_permissions_contact_file']);
		}
		if (!is_writable('../../admincp/cpstyles/templates'))
		{
		$PowerBB->html->msg($lang['error_permissions_admin_templates_file'])	;
		}
		else
		{
		$PowerBB->html->msg($lang['correctly_permissions_admin_templates_file']);
		}
		if (!is_writable('../../addons'))
		{
		$PowerBB->html->msg($lang['error_permissions_addons'])	;
		}
		else
		{
		$PowerBB->html->msg($lang['correctly_permissions_addons']);
		}
		if (!is_writable('../../look/images/avatar/upload'))
		{
		$PowerBB->html->msg($lang['error_permissions_avatar_file_upload'])	;
		}
		else
		{
		$PowerBB->html->msg($lang['correctly_permissions_avatar_file_upload']);
		}
		if (!is_writable('../../look/images/icons/upload'))
		{
		$PowerBB->html->msg($lang['error_permissions_icons_file_upload'])	;
		}
		else
		{
		$PowerBB->html->msg($lang['correctly_permissions_icons_file_upload']);
		}
		if (!is_writable('../../look/images/smiles/upload'))
		{
		$PowerBB->html->msg($lang['error_permissions_smiles_file_upload'])	;
		}
		else
		{
		$PowerBB->html->msg($lang['correctly_permissions_smiles_file_upload']);
		}
		if (!is_writable('../../cache'))
		{
		$PowerBB->html->msg($lang['error_permissions_cache'])	;
		}
		else
		{
		$PowerBB->html->msg($lang['correctly_permissions_cache']);
		}
		if (!is_writable('../../cache/original_default_templates.xml'))
		{
		$PowerBB->html->msg($lang['error_permissions_original_templates'])	;
		}
		else
		{
		$PowerBB->html->msg($lang['correctly_permissions_original_templates']);
		}
		if (!is_writable('../../cache/HooksCache.php'))
		{
		$PowerBB->html->msg($lang['error_permissions_HooksCache'])	;
		}
		else
		{
		$PowerBB->html->msg($lang['correctly_permissions_HooksCache']);
		}
		if (!is_writable('../../cache_templates'))
		{
		$PowerBB->html->msg($lang['error_permissions_cache_templates'])	;
		}
		else
		{
		$PowerBB->html->msg($lang['correctly_permissions_cache_templates']);
		}



$PowerBB->html->make_link($lang['make_step2'],'?step=2&lang='.$PowerBB->_GET['lang']);
}
elseif ($PowerBB->_GET['step'] == 2)
{

       @include("../lang/".$PowerBB->_GET['lang']."/language.php");


	$PowerBB->html->cells($lang['make_cells_step2'],'main1');
	$PowerBB->html->close_table();

	$p = $PowerBB->install->CreateTables($PowerBB->install->_Masseges);


	foreach ($PowerBB->install->_Masseges as $msg)
	{
		$PowerBB->html->msg($msg);
	}

	$PowerBB->html->make_link($lang['make_step3'],'?step=3&lang='.$PowerBB->_GET['lang']);
}
elseif ($PowerBB->_GET['step'] == 3)
{

  @include("../lang/".$PowerBB->_GET['lang']."/language.php");

	$PowerBB->html->cells($lang['make_cells_step3'],'main1');
	$PowerBB->html->close_table();

	$p = $PowerBB->install->InsertInformation($PowerBB->install->_Masseges);

	foreach ($PowerBB->install->_Masseges as $msg)
	{
		$PowerBB->html->msg($msg);
	}

	$PowerBB->html->make_link($lang['make_step_style'],'?step=4&lang='.$PowerBB->_GET['lang']);
}
elseif ($PowerBB->_GET['step'] == 4)
{

  @include("../lang/".$PowerBB->_GET['lang']."/language.php");

	$PowerBB->html->cells($lang['make_cells_step_style'],'main1');
	$PowerBB->html->close_table();

	$p = $PowerBB->install->InsertStyle($PowerBB->install->_Masseges);

	foreach ($PowerBB->install->_Masseges as $msg)
	{
		$PowerBB->html->msg($msg);
	}

	$PowerBB->html->make_link($lang['make_step_lang'],'?step=5&lang='.$PowerBB->_GET['lang']);
}
elseif ($PowerBB->_GET['step'] == 5)
{

  @include("../lang/".$PowerBB->_GET['lang']."/language.php");

	$PowerBB->html->cells($lang['make_cells_step_lang'],'main1');
	$PowerBB->html->close_table();

	$p = $PowerBB->install->InsertLang_ar($PowerBB->install->_Masseges);

	foreach ($PowerBB->install->_Masseges as $msg)
	{
		$PowerBB->html->msg($msg);
	}

	$PowerBB->html->make_link($lang['make_step_information'],'?step=6&lang='.$PowerBB->_GET['lang']);
}
elseif ($PowerBB->_GET['step'] == 6)
{

  @include("../lang/".$PowerBB->_GET['lang']."/language.php");

	$PowerBB->html->cells($lang['make_cells_step_lang'],'main1');
	$PowerBB->html->close_table();

	$p = $PowerBB->install->InsertLang_en($PowerBB->install->_Masseges);

	foreach ($PowerBB->install->_Masseges as $msg)
	{
		$PowerBB->html->msg($msg);
	}

	$PowerBB->html->make_link($lang['make_step_information'],'?step=7&lang='.$PowerBB->_GET['lang']);
}
elseif ($PowerBB->_GET['step'] == 7)
{
  @include("../lang/".$PowerBB->_GET['lang']."/language.php");
	if ($PowerBB->install->CheckMember())
	{
      $PowerBB->html->cells($lang['Can_not_reinstall_the_program_again'],'main1');
	  $PowerBB->html->close_table();
	  $PowerBB->functions->errorstop($lang['must_delete_all_tables_from_the_database_Forum']);
	  $PowerBB->html->close_table();
	}

	$PowerBB->html->cells($lang['make_cells_information'],'main1');
	$PowerBB->html->close_table();

	$PowerBB->html->open_form('index.php?step=8&lang='.$PowerBB->_GET['lang']);

	$PowerBB->html->open_table('60%',true,1);
	$PowerBB->html->open_table_head($lang['Information_manager'],'main1');
	$PowerBB->html->row($lang['Username'],$PowerBB->html->input('username'));
	$PowerBB->html->row($lang['Password'],$PowerBB->html->password('password'));
	$PowerBB->html->row($lang['email'],$PowerBB->html->input('email'));
	$PowerBB->html->row($lang['Gender'],$PowerBB->html->select('gender',array('m'=>$lang['Male'],'f'=>$lang['Female'])));
	$PowerBB->html->close_table();

	$PowerBB->html->open_table('60%',true,1);
	$PowerBB->html->open_table_head($lang['Forum_Info'],'main1');
	$PowerBB->html->row($lang['Forum_Name'],$PowerBB->html->input('title'));
	$PowerBB->html->close_table();

	$PowerBB->html->close_form();
}
elseif ($PowerBB->_GET['step'] == 8)
{
  @include("../lang/".$PowerBB->_GET['lang']."/language.php");


	if ($PowerBB->install->CheckMember1())
	{
      $PowerBB->html->cells($lang['Can_not_reinstall_the_program_again'],'main1');
	  $PowerBB->html->close_table();
	  $PowerBB->functions->errorstop($lang['must_delete_all_tables_from_the_database_Forum']);
	  $PowerBB->html->close_table();
	}

	$PowerBB->html->cells($lang['The_last_step'],'main1');
	$PowerBB->html->close_table();

	if (empty($PowerBB->_POST['username'])
		or empty($PowerBB->_POST['password'])
		or empty($PowerBB->_POST['email'])
		or empty($PowerBB->_POST['gender'])
		or empty($PowerBB->_POST['title']))
	{
	  $PowerBB->functions->errorstop($lang['Please_fill_in_all_the_information']);
	}


	$username_style_cache	=	'<strong><em><span style="color: #800000;">' . $PowerBB->_POST['username'] . '</span></em></strong>';

       $insert = $PowerBB->DB->sql_query("INSERT INTO " . $PowerBB->table['member'] . " SET
							id='1',
							username='" . $PowerBB->_POST['username'] . "',
							password='" . md5($PowerBB->_POST['password']) . "',
							email='" . $PowerBB->_POST['email'] . "',
							usergroup= '1',
							user_gender='" . $PowerBB->_POST['gender'] . "',
							register_date='" . $PowerBB->_CONF['now'] . "',
							user_title='" . $lang['General_supervisor'] . "',
							style='1',
							username_style_cache='" . $username_style_cache . "'");

if ($insert)
	{
		$PowerBB->html->msg($lang['Account_has_been_created_successfully_Director'],'center');
	}
	else
	{
		$PowerBB->html->msg($lang['Not_create_an_account_manager'],'center');
	}

	$update = $PowerBB->DB->sql_query('UPDATE ' . $PowerBB->table['info'] . " SET value='" . $PowerBB->_CONF['now'] . "' WHERE var_name='create_date'");

	if ($update)
	{
		$PowerBB->html->msg($lang['Has_been_registered_date_of_establishment_of_the_Forum'],'center');
	}
	else
	{
		$PowerBB->html->msg($lang['Is_not_registered_date_of_establishment_of_the_Forum'],'center');
	}

	$update = $PowerBB->DB->sql_query('UPDATE ' . $PowerBB->table['info'] . " SET value='" . $PowerBB->_POST['title'] . "' WHERE var_name='title'");

	if ($update)
	{
		$PowerBB->html->msg($lang['Has_been_developed_title_of_the_Forum'],'center');
	}
	else
	{
		$PowerBB->html->msg($lang['Is_not_been_developed_title_of_the_Forum'],'center');
	}

	$cache = $PowerBB->icon->UpdateSmilesCache(null);

	if ($cache)
	{
		$PowerBB->html->msg($lang['Has_been_developed_cached_information_of_smilies'],'center');
	}
	else
	{
		$PowerBB->html->msg($lang['Is_not_been_developed_cached_information_of_smilies'],'center');
	}

	$PowerBB->html->msg($lang['Forum_has_been_installed_successfully'],'center');
	 echo ('<div align="center">');
	$PowerBB->html->make_link($lang['To_go_to_the_home_page_of_the_forum_click_here'],'../../index.php');
	$PowerBB->html->make_link($lang['To_go_to_the_administrative_control_panel_of_the_forum_click_here'],'../../admincp/index.php');
	 echo ('</div>');

}
     $PowerBB->html->page_footer("<br><br><br><div id='copyright'>Powered by PBBoard © Version 3.0.2 </div></div>");

?>
