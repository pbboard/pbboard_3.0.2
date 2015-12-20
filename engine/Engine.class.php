<?php
@error_reporting(E_ALL ^ E_NOTICE);
/**
 * PowerBB Engine
 */

////////////

// General systems
require_once('config.php');
require_once('libs/functions.class.php');
// Connect to database
if($config['db']['dbtype'] == 'mysqli')
{
require_once('libs/db_mysqli.class.php');
}
else
{
require_once('libs/db.class.php');
}
require_once('libs/records.class.php');
require_once('libs/pager.class.php');

// General systems
require(DIR . 'includes/functions.class.php');
require_once(DIR . 'includes/pbboardCodeparse.class.php');
if (defined('IN_ADMIN'))
{
require_once(DIR . 'includes/FeedParser.php');
}

if (defined('IN_ADMIN'))
{
require_once(DIR . 'includes/templatecp.class.php');
}
else
{
require_once(DIR . 'includes/template.class.php');
}

////////////

if (is_array($CALL_SYSTEM))
{
	////////////

	$files = array();

	$files[] = ($CALL_SYSTEM['INFO']) 				? 'info.class.php' : null;
	$files[] = ($CALL_SYSTEM['ADS']) 				? 'ads.class.php' : null;
	$files[] = ($CALL_SYSTEM['ANNOUNCEMENT']) 		? 'announcement.class.php' : null;
	$files[] = ($CALL_SYSTEM['AVATAR']) 			? 'avatar.class.php' : null;
	$files[] = ($CALL_SYSTEM['BANNED']) 			? 'banned.class.php' : null;
	$files[] = ($CALL_SYSTEM['GROUP']) 				? 'group.class.php' : null;
	$files[] = ($CALL_SYSTEM['MEMBER']) 			? 'member.class.php' : null;
	$files[] = ($CALL_SYSTEM['ONLINE']) 			? 'online.class.php' : null;
	$files[] = ($CALL_SYSTEM['PAGES']) 				? 'pages.class.php' : null;
	$files[] = ($CALL_SYSTEM['PM']) 				? 'pm.class.php' : null;
	$files[] = ($CALL_SYSTEM['REPLY']) 				? 'reply.class.php' : null;
	$files[] = ($CALL_SYSTEM['SEARCH']) 			? 'search.class.php' : null;
	$files[] = ($CALL_SYSTEM['SECTION']) 			? 'sections.class.php' : null;
	$files[] = ($CALL_SYSTEM['STYLE']) 				? 'style.class.php' : null;
	$files[] = ($CALL_SYSTEM['SUBJECT']) 			? 'subject.class.php' : null;
	$files[] = ($CALL_SYSTEM['CACHE']) 				? 'cache.class.php' : null;
	$files[] = ($CALL_SYSTEM['REQUEST']) 			? 'request.class.php' : null;
	$files[] = ($CALL_SYSTEM['MISC']) 				? 'misc.class.php' : null;
	$files[] = ($CALL_SYSTEM['MESSAGE']) 			? 'messages.class.php' : null;
	$files[] = ($CALL_SYSTEM['ATTACH']) 			? 'attach.class.php' : null;
	$files[] = ($CALL_SYSTEM['FIXUP']) 				? 'fixup.class.php' : null;
	$files[] = ($CALL_SYSTEM['FILESEXTENSION']) 	? 'extension.class.php' : null;
	$files[] = ($CALL_SYSTEM['USERTITLE']) 			? 'usertitle.class.php' : null;
	$files[] = ($CALL_SYSTEM['ICONS']) 				? 'icons.class.php' : null;
	$files[] = ($CALL_SYSTEM['TOOLBOX']) 			? 'toolbox.class.php' : null;
	$files[] = ($CALL_SYSTEM['MODERATORS']) 		? 'moderators.class.php' : null;
	$files[] = ($CALL_SYSTEM['POLL']) 				? 'poll.class.php' : null;
	$files[] = ($CALL_SYSTEM['VOTE']) 				? 'vote.class.php' : null;
	$files[] = ($CALL_SYSTEM['TAG']) 				? 'tags.class.php' : null;
	$files[] = ($CALL_SYSTEM['TAG_SUBJECT']) 		? 'tags.class.php' : null;
	$files[] = ($CALL_SYSTEM['WARNLOG']) 			? 'warnlog.class.php' : null;
	$files[] = ($CALL_SYSTEM['EXTRAFIELD'])         ? 'extrafield.class.php' : null;
	$files[] = ($CALL_SYSTEM['LANG']) 				? 'lang.class.php' : null;
	$files[] = ($CALL_SYSTEM['REPUTATION']) 		? 'reputation.class.php' : null;
	$files[] = ($CALL_SYSTEM['RATING']) 		    ? 'rating.class.php' : null;
	$files[] = ($CALL_SYSTEM['SUPERMEMBERLOGS']) 	? 'supermemberlogs.class.php' : null;
	$files[] = ($CALL_SYSTEM['CHAT']) 	            ? 'chat.class.php' : null;
	$files[] = ($CALL_SYSTEM['EMAILED']) 	        ? 'emailed_notification.class.php' : null;
	$files[] = ($CALL_SYSTEM['VISITOR']) 	        ? 'visitor.class.php' : null;
	$files[] = ($CALL_SYSTEM['AWARD']) 	            ? 'award.class.php' : null;
	$files[] = ($CALL_SYSTEM['ADSENSE']) 	        ? 'adsense.class.php' : null;
	$files[] = ($CALL_SYSTEM['FRIENDS']) 	        ? 'friends.class.php' : null;
	$files[] = ($CALL_SYSTEM['ADDONS']) 	        ? 'addons.class.php' : null;
	$files[] = ($CALL_SYSTEM['HOOKS']) 	            ? 'hooks.class.php' : null;
	$files[] = ($CALL_SYSTEM['TEMPLATESEDITS']) 	? 'templatesedits.class.php' : null;
	$files[] = ($CALL_SYSTEM['VISITORMESSAGE']) 	? 'visitormessage.class.php' : null;
	$files[] = ($CALL_SYSTEM['USERRATING']) 	    ? 'userrating.class.php' : null;
	$files[] = ($CALL_SYSTEM['EMAILMESSAGES']) 	    ? 'emailmessages.class.php' : null;
	$files[] = ($CALL_SYSTEM['FEEDS']) 	            ? 'feeds.class.php' : null;
	$files[] = ($CALL_SYSTEM['TOPICMOD']) 	        ? 'topicmod.class.php' : null;
	$files[] = ($CALL_SYSTEM['CUSTOM_BBCODE']) 	    ? 'custom_bbcode.class.php' : null;
	$files[] = ($CALL_SYSTEM['CORE']) 	            ? 'core.class.php' : null;
    $files[] = ($CALL_SYSTEM ['LOG_VISIT_PROFILE']) ? 'profileviewer.class.php' : null;

	////////////

	if (sizeof($files) > 0)
	{
		foreach ($files as $filename)
		{
			if (!is_null($filename))
			{
				require_once(DIR . 'engine/systems/' . $filename);
			}
		}
	}

	////////////
}

////////////

class Engine
{
	////////////

	// General systems
	var $DB;
	var $sys_functions;
	var $records;
	var $pager;
	// General systems
	var $functions;
	var $template;
	var $Powerparse;
	var $FeedParser;
	////////////
	////////////

	// Systems
	var $ads;
	var $announcement;
	var $avatar;
	var $banned;
	var $group;
	var $member;
	var $online;
	var $pages;
	var $pm;
 	var $postcontrol;
	var $reply;
	var $search;
	var $section;
	var $style;
	var $subject;
	var $cache;
	var $misc;
	var $PowerCode;
	var $request;
	var $massege;
    var $message;
	var $attach;
	var $info;
	var $usertitle;
	var $toolbox;
	var $fixup;
	var $extension;
	var $warnlog;
	var $extrafield;
	var $lang;
	var $reputation;
	var $rating;
	var $supermemberlogs;
	var $chat;
	var $emailed;
	var $visitor;
	var $award;
	var $adsense;
	var $friends;
	var $addons;
	var $hooks;
	var $templates_edits;
	var $visitormessage;
	var $userrating;
    var $emailmessages;
    var $feeds;
    var $topicmod;
	var $custom_bbcode;

   ////////////

 	// Other variables
	var $_CONF		=	array();
	var $_GET		=	array();
	var $_POST		=	array();
	var $_COOKIE	=	array();
	var $_FILES		=	array();
	var $_SERVER	=	array();
	var $table 		= 	array();
	var $_REQUEST	=	array();


	////////////

	// Main system
	function Engine()
	{
		global $config,$_VARS,$CALL_SYSTEM;

		////////////

		// General systems
  		$this->DB				= 	new PowerBBSQL;
  		$this->pager			=	new PowerBBPager;
  		$this->sys_functions	=	new PowerBBSystemFunctions($this);
  		$this->records			=	new PowerBBRecords($this);
        $this->functions        =   new PowerBBFunctions;

  		////////////
		if (!defined('INSTALL'))
		{
  			$this->Powerparse	  	= 	new PowerBBCodeParse;
  		    $this->template		  	= 	new PowerBBTemplate;
	  		if (defined('IN_ADMIN'))
	  		{
				$this->FeedParser	  	= 	new FeedParser;
	  		}
		 }

  		$this->DB->SetInformation(	$config['db']['server'],
  									$config['db']['username'],
  									$config['db']['password'],
  									$config['db']['name'],
  									$config['db']['dbtype']);

  		////////////

  		if (!empty($config['db']['prefix']))
  		{
  			$this->prefix = $config['db']['prefix'];
  		}
  		if (!empty($config['Misc']['admincpdir']))
  		{
  			$this->admincpdir = $config['Misc']['admincpdir'];
  		}
  		if (!empty($config['SpecialUsers']['superadministrators']))
  		{
  			$this->superadministrators = $config['SpecialUsers']['superadministrators'];
  		}
  		if (!empty($config['HOOKS']['DISABLE_HOOKS']))
  		{
  			$this->DISABLE_HOOKS = $config['HOOKS']['DISABLE_HOOKS'];
  		}
  		////////////

  		$this->table['ads'] 			= 	$this->prefix . 'ads';
  		$this->table['announcement'] 	= 	$this->prefix . 'announcement';
  		$this->table['attach'] 			= 	$this->prefix . 'attach';
  		$this->table['avatar'] 			= 	$this->prefix . 'avatar';
  		$this->table['banned'] 			= 	$this->prefix . 'banned';
  		$this->table['email_msg'] 		= 	$this->prefix . 'email_msg';
  		$this->table['extension'] 		= 	$this->prefix . 'extension';
  		$this->table['group'] 			= 	$this->prefix . 'group';
  		$this->table['info'] 			= 	$this->prefix . 'info';
  		$this->table['member']			= 	$this->prefix . 'member';
  		$this->table['online'] 			= 	$this->prefix . 'online';
  		$this->table['pages'] 			= 	$this->prefix . 'pages';
  		$this->table['pm'] 				= 	$this->prefix . 'pm';
  		$this->table['pm_folder'] 		= 	$this->prefix . 'pm_folder';
  		$this->table['pm_lists'] 		= 	$this->prefix . 'pm_lists';
  		$this->table['poll'] 			= 	$this->prefix . 'poll';
  		$this->table['reply'] 			= 	$this->prefix . 'reply';
  		$this->table['requests'] 		= 	$this->prefix . 'requests';
  		$this->table['section'] 		= 	$this->prefix . 'section';
  		$this->table['smiles'] 			= 	$this->prefix . 'smiles';
  		$this->table['style'] 			= 	$this->prefix . 'style';
  		$this->table['subject'] 		= 	$this->prefix . 'subject';
  		$this->table['sm_logs'] 		= 	$this->prefix . 'supermemberlogs';
  		$this->table['sectionadmin'] 	= 	$this->prefix . 'sectionadmin';
  		$this->table['today'] 			= 	$this->prefix . 'today';
  		$this->table['toolbox'] 		= 	$this->prefix . 'toolbox';
  		$this->table['usertitle'] 		= 	$this->prefix . 'usertitle';
  		$this->table['vote'] 			= 	$this->prefix . 'vote';
  		$this->table['section_group']	=	$this->prefix . 'sectiongroup';
  		$this->table['extension']		=	$this->prefix . 'ex';
  		$this->table['moderators']		=	$this->prefix . 'moderators';
  		$this->table['cats']			=	$this->prefix . 'cats';
  		$this->table['tag']				=	$this->prefix . 'tags';
  		$this->table['tag_subject']		=	$this->prefix . 'tags_subject';
  		$this->table['warnlog']		    =	$this->prefix . 'warnlog';
  		$this->table['extrafield']      =   $this->prefix . 'extrafield';
  		$this->table['lang'] 			= 	$this->prefix . 'lang';
  		$this->table['faq'] 			= 	$this->prefix . 'faq';
  		$this->table['filter_words'] 	= 	$this->prefix . 'filter_words';
  		$this->table['reputation']   	= 	$this->prefix . 'reputation';
  		$this->table['rating']   	    = 	$this->prefix . 'rating';
  		$this->table['supermemberlogs'] = 	$this->prefix . 'supermemberlogs';
  		$this->table['chat']            = 	$this->prefix . 'chat';
  		$this->table['emailed']         = 	$this->prefix . 'emailed';
  		$this->table['visitor']         = 	$this->prefix . 'visitor';
  		$this->table['award']           = 	$this->prefix . 'award';
  		$this->table['adsense']         = 	$this->prefix . 'adsense';
  		$this->table['friends']         = 	$this->prefix . 'friends';
  		$this->table['addons']          = 	$this->prefix . 'addons';
  		$this->table['hooks']           = 	$this->prefix . 'hooks';
  		$this->table['templates_edits'] = 	$this->prefix . 'templates_edits';
  		$this->table['visitormessage']  = 	$this->prefix . 'visitormessage';
  		$this->table['userrating']      = 	$this->prefix . 'userrating';
  		$this->table['emailmessages']   = 	$this->prefix . 'emailmessages';
        $this->table['feeds']           = 	$this->prefix . 'feeds';
        $this->table['topicmod']        = 	$this->prefix . 'topicmod';
  		$this->table['custom_bbcode']   = 	$this->prefix . 'custom_bbcode';
  		$this->table['template']        = 	$this->prefix . 'template';
  		$this->table['phrase_language'] = 	$this->prefix . 'phrase_language';
  		$this->table['profile_view']    =   $this->prefix . 'profile_view';


  		////////////

    	$this->_CONF['temp']					=	array();
    	$this->_CONF['info']					=	array();
    	$this->_CONF['info_row']				=	array();

    	$this->_CONF['now']						=	time();
 		$this->_CONF['timeout']					=	time()-300;
 		$this->_CONF['date']					=	@date('j/n/Y');
 		$this->_CONF['day']						=	@date('D');
 		$this->_CONF['temp']['query_num']		=	0;
 		$this->_CONF['username_cookie']			=	'PowerBB_username';
 		$this->_CONF['password_cookie']			=	'PowerBB_password';
 		$this->_CONF['admin_username_cookie']	=	'PowerBB_admin_username';
 		$this->_CONF['admin_password_cookie']	=	'PowerBB_admin_password';
 		$this->_CONF['mqtids']	                =	'mqtids';
 		$this->_CONF['style_cookie']			=	'PowerBB_style';
 		$this->_CONF['lang_cookie']			    =	'PowerBB_lang';
 		$this->_CONF['today_cookie']			=	'PowerBB_today_date';

 		////////////

 		$this->sys_functions->LocalArraySetup();

 		////////////


 		// Connect to database
 		if($config['db']['dbtype'] == 'mysql')
 		{
	 		$this->DB->sql_connect();
	  		$this->DB->sql_select_db();
        }
  		////////////

  		// Ensure if tables are installed or not
  		$check = $this->DB->check($this->prefix . 'info');

  		// Well, the table "MySBB_info" isn't exists, so return an error message
  		if (!$check
  			and !defined('INSTALL'))
  		{
  			return 'ERROR::THE_TABLES_ARE_NOT_INSTALLED';
  		}

  		////////////

		$this->info 			= 	($CALL_SYSTEM['INFO']) 				? new PowerBBInfo($this) : null;
		$this->ads 				= 	($CALL_SYSTEM['ADS']) 				? new PowerBBAds($this) : null;
		$this->announcement 	= 	($CALL_SYSTEM['ANNOUNCEMENT']) 		? new PowerBBAnnouncement($this) : null;
		$this->avatar 			= 	($CALL_SYSTEM['AVATAR']) 			? new PowerBBAvatar($this) : null;
		$this->banned 			= 	($CALL_SYSTEM['BANNED']) 			? new PowerBBBanned($this) : null;
		$this->group 			= 	($CALL_SYSTEM['GROUP']) 			? new PowerBBGroup($this) : null;
		$this->member 			= 	($CALL_SYSTEM['MEMBER']) 			? new PowerBBMember($this) : null;
		$this->online 			= 	($CALL_SYSTEM['ONLINE']) 			? new PowerBBOnline($this) : null;
		$this->pages 			= 	($CALL_SYSTEM['PAGES']) 			? new PowerBBPages($this) : null;
		$this->pm 				= 	($CALL_SYSTEM['PM']) 				? new PowerBBPM($this) : null;
		$this->reply 			= 	($CALL_SYSTEM['REPLY']) 			? new PowerBBReply($this) : null;
		$this->search 			= 	($CALL_SYSTEM['SEARCH']) 			? new PowerBBSearch($this) : null;
		$this->section 			= 	($CALL_SYSTEM['SECTION']) 			? new PowerBBSection($this) : null;
		$this->style 			= 	($CALL_SYSTEM['STYLE']) 			? new PowerBBStyle($this) : null;
		$this->subject 			= 	($CALL_SYSTEM['SUBJECT']) 			? new PowerBBSubject($this) : null;
		$this->cache 			= 	($CALL_SYSTEM['CACHE']) 			? new PowerBBCache($this) : null;
		$this->misc 			= 	($CALL_SYSTEM['MISC']) 				? new PowerBBMisc($this) : null;
		$this->request 			= 	($CALL_SYSTEM['REQUEST']) 			? new PowerBBRequest($this) : null;
		$this->message 			= 	($CALL_SYSTEM['MESSAGE']) 			? new PowerBBMessages($this) : null;
		$this->attach 			= 	($CALL_SYSTEM['ATTACH']) 			? new PowerBBAttach($this) : null;
		$this->fixup 			= 	($CALL_SYSTEM['FIXUP']) 			? new PowerBBFixup($this) : null;
		$this->extension 		= 	($CALL_SYSTEM['FILESEXTENSION']) 	? new PowerBBFileExtension($this) : null;
		$this->usertitle 		= 	($CALL_SYSTEM['USERTITLE']) 		? new PowerBBUsertitle($this) : null;
		$this->icon 			= 	($CALL_SYSTEM['ICONS']) 			? new PowerBBIcons($this) : null;
		$this->toolbox 			= 	($CALL_SYSTEM['TOOLBOX']) 			? new PowerBBToolBox($this) : null;
		$this->moderator 		= 	($CALL_SYSTEM['MODERATORS']) 		? new PowerBBModerators($this) : null;
		$this->poll 			= 	($CALL_SYSTEM['POLL']) 				? new PowerBBPoll($this) : null;
		$this->vote 			= 	($CALL_SYSTEM['VOTE']) 				? new PowerBBVote($this) : null;
		$this->tag 				= 	($CALL_SYSTEM['TAG']) 				? new PowerBBTag($this) : null;
		$this->tag_subject 		= 	($CALL_SYSTEM['TAG_SUBJECT']) 		? new PowerBBTag($this) : null;
		$this->warnlog 			= 	($CALL_SYSTEM['WARNLOG']) 			? new PowerBBWarnLog($this) : null;
		$this->extrafield       =   ($CALL_SYSTEM['EXTRAFIELD'])        ? new PowerBBExtraField($this) : null;
		$this->lang 			= 	($CALL_SYSTEM['LANG']) 				? new PowerBBLang($this) : null;
		$this->reputation 		= 	($CALL_SYSTEM['REPUTATION']) 		? new PowerBBReputation($this) : null;
		$this->rating 	     	= 	($CALL_SYSTEM['RATING']) 		    ? new PowerBBRating($this) : null;
		$this->supermemberlogs 	= 	($CALL_SYSTEM['SUPERMEMBERLOGS']) 	? new PowerBBSupermemberlogs($this) : null;
		$this->chat            	= 	($CALL_SYSTEM['CHAT']) 	            ? new PowerBBChat($this) : null;
		$this->emailed          = 	($CALL_SYSTEM['EMAILED']) 	        ? new PowerBBEmailed($this) : null;
		$this->visitor          = 	($CALL_SYSTEM['VISITOR']) 	        ? new PowerBBVisitor($this) : null;
		$this->award            = 	($CALL_SYSTEM['AWARD']) 	        ? new PowerBBAward($this) : null;
		$this->adsense          = 	($CALL_SYSTEM['ADSENSE']) 	        ? new PowerBBAdsense($this) : null;
		$this->friends          = 	($CALL_SYSTEM['FRIENDS']) 	        ? new PowerBBFriends($this) : null;
		$this->addons           = 	($CALL_SYSTEM['ADDONS']) 	        ? new PowerBBAddons($this) : null;
		$this->hooks            = 	($CALL_SYSTEM['HOOKS']) 	        ? new PowerBBHooks($this) : null;
		$this->templates_edits  = 	($CALL_SYSTEM['TEMPLATESEDITS']) 	? new PowerBBTemplatesEdits($this) : null;
		$this->visitormessage   = 	($CALL_SYSTEM['VISITORMESSAGE']) 	? new PowerBBVisitorMessage($this) : null;
		$this->userrating       = 	($CALL_SYSTEM['USERRATING']) 	    ? new PowerBBUserRating($this) : null;
		$this->emailmessages    = 	($CALL_SYSTEM['EMAILMESSAGES']) 	? new PowerBBEmailMessages($this) : null;
		$this->feeds            = 	($CALL_SYSTEM['FEEDS']) 	        ? new PowerBBFeeds($this) : null;
		$this->topicmod         = 	($CALL_SYSTEM['TOPICMOD']) 	        ? new PowerBBTopicmodr($this) : null;
		$this->custom_bbcode    = 	($CALL_SYSTEM['CUSTOM_BBCODE']) 	? new PowerBBCustom_bbcode($this) : null;
	    $this->core             = 	($CALL_SYSTEM['CORE']) 	            ? new PowerBBCore($this) : null;
        $this->log_profile_visit= ($CALL_SYSTEM['LOG_VISIT_PROFILE'])  ? new PowerBBProfileViewer($this): null;

		////////////
		// Free memory
		unset($CALL_SYSTEM);

 	}

 	////////////


}

?>
