<?php

include('../common.php');


class DatabaseStruct extends PowerBBInstall
{
	var $_TempArr 	= 	array();
	var $_Masseges	=	array();
	var $lang	    =	array();

	function _CreateTemplate()
	{
		global $PowerBB;

		$this->_TempArr['CreateArr']				= 	array();
		$this->_TempArr['CreateArr']['table_name'] 	= 	$PowerBB->table['template'];
		$this->_TempArr['CreateArr']['fields'] 		= 	array();
		$this->_TempArr['CreateArr']['fields'][] 	= 	'templateid INT( 10 ) unsigned NOT NULL auto_increment PRIMARY KEY';
		$this->_TempArr['CreateArr']['fields'][] 	= 	"styleid smallint(6) NOT NULL default '0'";
		$this->_TempArr['CreateArr']['fields'][] 	= 	"title varchar(100) NOT NULL default ''";
		$this->_TempArr['CreateArr']['fields'][] 	= 	'template longtext';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'template_un longtext';
		$this->_TempArr['CreateArr']['fields'][] 	= 	"templatetype enum('template','stylevar','css','replacement') NOT NULL default 'template'";
		$this->_TempArr['CreateArr']['fields'][] 	= 	"dateline int(10) unsigned NOT NULL default '0'";
		$this->_TempArr['CreateArr']['fields'][] 	= 	"username varchar(100) NOT NULL default ''";
		$this->_TempArr['CreateArr']['fields'][] 	= 	"version  varchar(30) NOT NULL default ''";
		$this->_TempArr['CreateArr']['fields'][] 	= 	"product varchar(25) NOT NULL default ''";
		$this->_TempArr['CreateArr']['fields'][] 	= 	'sort int(5) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	"active smallint(5) unsigned NOT NULL default '1'";

        $create = $this->create_table($this->_TempArr['CreateArr']);

        return ($create) ? true : false;
	}

    function _CreatePhrase()
	{
		global $PowerBB;

		$this->_TempArr['CreateArr']				= 	array();
		$this->_TempArr['CreateArr']['table_name'] 	= 	$PowerBB->table['phrase_language'];
		$this->_TempArr['CreateArr']['fields'] 		= 	array();
		$this->_TempArr['CreateArr']['fields'][] 	= 	'phraseid INT( 10 ) unsigned NOT NULL auto_increment PRIMARY KEY';
		$this->_TempArr['CreateArr']['fields'][] 	= 	"languageid smallint(6) NOT NULL default '0'";
		$this->_TempArr['CreateArr']['fields'][] 	= 	"varname varchar(250) character set utf8 collate utf8_bin NOT NULL default ''";
		$this->_TempArr['CreateArr']['fields'][] 	= 	"fieldname varchar(20) NOT NULL default ''";
		$this->_TempArr['CreateArr']['fields'][] 	= 	'text mediumtext';
		$this->_TempArr['CreateArr']['fields'][] 	= 	"product varchar(25) NOT NULL default ''";
		$this->_TempArr['CreateArr']['fields'][] 	= 	"dateline int(10) unsigned NOT NULL default '0'";
		$this->_TempArr['CreateArr']['fields'][] 	= 	"username varchar(100) NOT NULL default ''";
		$this->_TempArr['CreateArr']['fields'][] 	= 	"version varchar(30) NOT NULL default ''";

        $create = $this->create_table($this->_TempArr['CreateArr']);
        return ($create) ? true : false;
	}

	function _CreateExtrafields()
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



    function _CreateWarnlog()
    {
        global $PowerBB;

	    $this->_TempArr['CreateArr']        =   array();
	    $this->_TempArr['CreateArr']['table_name']  =   $PowerBB->table['warnlog'];
	    $this->_TempArr['CreateArr']['fields']    =   array();
	    $this->_TempArr['CreateArr']['fields'][]  =   'id INT( 9 ) NOT NULL AUTO_INCREMENT PRIMARY KEY';
	    $this->_TempArr['CreateArr']['fields'][]  =   'warn_from VARCHAR( 200 ) NOT NULL';
	    $this->_TempArr['CreateArr']['fields'][]  =   'warn_to VARCHAR( 200 ) NOT NULL';
	    $this->_TempArr['CreateArr']['fields'][]  =   'warn_text LONGTEXT NOT NULL';
	    $this->_TempArr['CreateArr']['fields'][]  =   'warn_date VARCHAR( 200 ) NOT NULL';
	    $this->_TempArr['CreateArr']['fields'][]  =   "warn_liftdate VARCHAR( 200 ) NOT NULL";


    $create = $this->create_table($this->_TempArr['CreateArr']);

    return ($create) ? true : false;
    }

    function _CreateAddons()
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
	    $this->_TempArr['CreateArr']['fields'][]  =   'module_index MEDIUMTEXT NOT NULL';
	    $this->_TempArr['CreateArr']['fields'][]  =   'module_admin MEDIUMTEXT NOT NULL';
  	    $this->_TempArr['CreateArr']['fields'][]  =   "active SMALLINT UNSIGNED NOT NULL DEFAULT '1'";
	    $this->_TempArr['CreateArr']['fields'][]  =   'languagevals LONGTEXT NOT NULL';


    $create = $this->create_table($this->_TempArr['CreateArr']);

    return ($create) ? true : false;
    }


    function _CreateHooks()
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

    function _CreateTemplatesEdits()
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


    function _CreateVisitorMessage()
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

    function _CreateVisitor()
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

    function _CreateAdsense()
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
	    // 3.0.0
	    $this->_TempArr['CreateArr']['fields'][]  =   'downfoot int( 9 ) NOT NULL';
	    $this->_TempArr['CreateArr']['fields'][]  =   'all_page int( 9 ) NOT NULL';
	    $this->_TempArr['CreateArr']['fields'][]  =   'between_replys int( 9 ) NOT NULL';
	    $this->_TempArr['CreateArr']['fields'][]  =   'down_topic int( 9 ) NOT NULL';
	    $this->_TempArr['CreateArr']['fields'][]  =   'in_page VARCHAR( 255 ) NOT NULL';
	    $this->_TempArr['CreateArr']['fields'][]  =   'side int( 9 ) NOT NULL';
	    $this->_TempArr['CreateArr']['fields'][]  =   'mid_topic int( 9 ) NOT NULL';


    $create = $this->create_table($this->_TempArr['CreateArr']);

    return ($create) ? true : false;
    }

    function _CreateFriends()
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

    function _CreateEmailed()
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

    function _CreateAward()
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

    function _CreateEmailMessages()
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

	function _CreateAds()
	{
		global $PowerBB;

		$this->_TempArr['CreateArr']				= 	array();
		$this->_TempArr['CreateArr']['table_name'] 	= 	$PowerBB->table['ads'];
		$this->_TempArr['CreateArr']['fields'] 		= 	array();
		$this->_TempArr['CreateArr']['fields'][] 	= 	'id INT( 9 ) NOT NULL AUTO_INCREMENT PRIMARY KEY';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'sitename VARCHAR( 200 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'site VARCHAR( 200 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'picture VARCHAR( 200 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'width int( 9 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'height int( 9 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'clicks int( 9 ) NOT NULL';

		$create = $this->create_table($this->_TempArr['CreateArr']);

		return ($create) ? true : false;
	}

	function _CreateAnnouncement()
	{
		global $PowerBB;

		$this->_TempArr['CreateArr']				= 	array();
		$this->_TempArr['CreateArr']['table_name'] 	= 	$PowerBB->table['announcement'];
		$this->_TempArr['CreateArr']['fields'] 		= 	array();
		$this->_TempArr['CreateArr']['fields'][] 	= 	'id INT( 9 ) NOT NULL AUTO_INCREMENT PRIMARY KEY';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'title VARCHAR( 200 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'text text NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'writer VARCHAR( 200 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'date VARCHAR( 100 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'visitor int( 10 ) NOT NULL';

		$create = $this->create_table($this->_TempArr['CreateArr']);

		return ($create) ? true : false;
	}

	function _CreateFaq()
    {
    global $PowerBB;

	    $this->_TempArr['CreateArr']        =   array();
	    $this->_TempArr['CreateArr']['table_name']  =   $PowerBB->table['faq'];
	    $this->_TempArr['CreateArr']['fields']    =   array();
	    $this->_TempArr['CreateArr']['fields'][]  =   'id INT( 9 ) NOT NULL AUTO_INCREMENT PRIMARY KEY';
	    $this->_TempArr['CreateArr']['fields'][]  =   'title VARCHAR( 200 ) NOT NULL';
	    $this->_TempArr['CreateArr']['fields'][]  =   'text LONGTEXT NOT NULL';
	    $this->_TempArr['CreateArr']['fields'][]  =   'description LONGTEXT NOT NULL';


    $create = $this->create_table($this->_TempArr['CreateArr']);

    return ($create) ? true : false;
    }


    function _CreateReputation()
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
		$this->_TempArr['CreateArr']['fields'][]  =   "reputationread smallint(5) unsigned NOT NULL default '0'";



    $create = $this->create_table($this->_TempArr['CreateArr']);

    return ($create) ? true : false;
    }

    function _CreateRating()
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

    function _CreateChat_Message()
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
	    // 3.0.2
		$this->_TempArr['CreateArr']['fields'][]  =   'date VARCHAR( 100 ) NOT NULL';


    $create = $this->create_table($this->_TempArr['CreateArr']);

    return ($create) ? true : false;
    }

	function _CreateAttach()
	{
		global $PowerBB;

		$this->_TempArr['CreateArr']				= 	array();
		$this->_TempArr['CreateArr']['table_name'] 	= 	$PowerBB->table['attach'];
		$this->_TempArr['CreateArr']['fields'] 		= 	array();
		$this->_TempArr['CreateArr']['fields'][] 	= 	'id INT( 9 ) NOT NULL AUTO_INCREMENT PRIMARY KEY';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'filename VARCHAR( 350 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'filepath VARCHAR( 350 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	"filesize VARCHAR( 20 ) NOT NULL default '0'";
		$this->_TempArr['CreateArr']['fields'][] 	= 	'subject_id int( 9 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	"visitor int( 9 ) NOT NULL default '0'";
		$this->_TempArr['CreateArr']['fields'][] 	= 	'reply int( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'pm_id int( 9 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'u_id int( 9 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	"time int( 11 ) NOT NULL default '0'";
		$this->_TempArr['CreateArr']['fields'][] 	= 	"last_down  int( 11 ) NOT NULL default '0'";
		$this->_TempArr['CreateArr']['fields'][] 	= 	'extension VARCHAR( 20 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'user_ip VARCHAR( 250 ) NOT NULL';


		$create = $this->create_table($this->_TempArr['CreateArr']);

		return ($create) ? true : false;
	}

	function _CreateAvatar()
	{
		global $PowerBB;

		$this->_TempArr['CreateArr']				= 	array();
		$this->_TempArr['CreateArr']['table_name'] 	= 	$PowerBB->table['avatar'];
		$this->_TempArr['CreateArr']['fields'] 		= 	array();
		$this->_TempArr['CreateArr']['fields'][] 	= 	'id INT( 9 ) NOT NULL AUTO_INCREMENT PRIMARY KEY';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'avatar_path VARCHAR( 100 ) NOT NULL';

		$create = $this->create_table($this->_TempArr['CreateArr']);

		return ($create) ? true : false;
	}

	function _InsertAvatar()
	{
		global $PowerBB;

		$AvatarArray = array();

		$AvatarArray[0] 					= 	array();
		$AvatarArray[0]['avatar_path'] 		= 	'look/images/avatar/Aeroplane.gif';

		$AvatarArray[1] 					= 	array();
		$AvatarArray[1]['avatar_path'] 		= 	'look/images/avatar/Fish.gif';

		$AvatarArray[2] 					= 	array();
		$AvatarArray[2]['avatar_path'] 		= 	'look/images/avatar/Golfball.gif';

		$AvatarArray[3] 					= 	array();
		$AvatarArray[3]['avatar_path'] 		= 	'look/images/avatar/Green-haze.gif';

		$AvatarArray[4] 					= 	array();
		$AvatarArray[4]['avatar_path'] 		= 	'look/images/avatar/Leaf.gif';

		$AvatarArray[5] 					= 	array();
		$AvatarArray[5]['avatar_path'] 		= 	'look/images/avatar/Melon.gif';

		$AvatarArray[6] 					= 	array();
		$AvatarArray[6]['avatar_path'] 		= 	'look/images/avatar/Meow.gif';

		$AvatarArray[7] 					= 	array();
		$AvatarArray[7]['avatar_path'] 		= 	'look/images/avatar/Orange-sticks.gif';

		$AvatarArray[8] 					= 	array();
		$AvatarArray[8]['avatar_path'] 		= 	'look/images/avatar/Pink-sea.gif';

		$AvatarArray[9] 					= 	array();
		$AvatarArray[9]['avatar_path'] 		= 	'look/images/avatar/Woof.gif';

		$AvatarArray[10] 					= 	array();
		$AvatarArray[10]['avatar_path'] 		= 	'look/images/avatar/Wub.gif';

		$AvatarArray[11] 					= 	array();
		$AvatarArray[11]['avatar_path'] 		= 	'look/images/avatar/Crazyman.jpg';

		$AvatarArray[12] 					= 	array();
		$AvatarArray[12]['avatar_path'] 		= 	'look/images/avatar/Dolphin.jpg';

		$AvatarArray[13] 					= 	array();
		$AvatarArray[13]['avatar_path'] 		= 	'look/images/avatar/Hammer-man.jpg';

		$AvatarArray[14] 					= 	array();
		$AvatarArray[14]['avatar_path'] 		= 	'look/images/avatar/PowerBB1.jpg';

		$AvatarArray[15] 					= 	array();
		$AvatarArray[15]['avatar_path'] 		= 	'look/images/avatar/PowerBB.jpg';

		$AvatarArray[16] 					= 	array();
		$AvatarArray[16]['avatar_path'] 		= 	'look/images/avatar/Whale.jpg';

		$AvatarArray[17] 					= 	array();
		$AvatarArray[17]['avatar_path'] 		= 	'look/images/avatar/coof.jpg';


		$x = 0;
		$i = array();

		while ($x < sizeof($AvatarArray))
		{
			$insert = $PowerBB->DB->sql_query("INSERT INTO " . $PowerBB->table['avatar'] . " SET
														avatar_path='" . $AvatarArray[$x]['avatar_path'] . "'");

			$i[$x] = ($insert) ? 'true' : 'false';

			$x += 1;
		}

		return $i;

	}

	function _CreateBanned()
	{
		global $PowerBB;

		$this->_TempArr['CreateArr']				= 	array();
		$this->_TempArr['CreateArr']['table_name'] 	= 	$PowerBB->table['banned'];
		$this->_TempArr['CreateArr']['fields'] 		= 	array();
		$this->_TempArr['CreateArr']['fields'][] 	= 	'id INT( 9 ) NOT NULL AUTO_INCREMENT PRIMARY KEY';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'text VARCHAR( 100 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'text_type INT( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'ip VARCHAR( 100 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'reason VARCHAR( 255 ) NOT NULL';

		$create = $this->create_table($this->_TempArr['CreateArr']);

		return ($create) ? true : false;
	}

	function _CreateEmailMasseges()
	{
		global $PowerBB;

		$this->_TempArr['CreateArr']				= 	array();
		$this->_TempArr['CreateArr']['table_name'] 	= 	$PowerBB->table['email_msg'];
		$this->_TempArr['CreateArr']['fields'] 		= 	array();
		$this->_TempArr['CreateArr']['fields'][] 	= 	'id INT( 9 ) NOT NULL AUTO_INCREMENT PRIMARY KEY';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'title VARCHAR( 200 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'text text NOT NULL';

		$create = $this->create_table($this->_TempArr['CreateArr']);

		return ($create) ? true : false;
	}

	function _InsertEmailMasseges()
	{
		global $PowerBB;

        include("../lang/".$PowerBB->_GET['lang']."/language.php");
		$Password_change_request = $lang['Password_change_request'];
		$text_Password_change_request = $lang['text_Password_change_request'];
		$Request_to_change_your_email = $lang['Request_to_change_your_email'];
		$text_Request_to_change_your_email = $lang['text_Request_to_change_your_email'];
		$Report_on_the_subject_of_abuse = $lang['Report_on_the_subject_of_abuse'];
		$text_Report_on_the_subject_of_abuse = $lang['text_Report_on_the_subject_of_abuse'];
		$Activation = $lang['Activation'];
		$text_Activation = $lang['text_Activation'];

		$MassegesArray = array();

		$MassegesArray[0] 			= 	array();
		$MassegesArray[0]['id'] 		= 	1;
		$MassegesArray[0]['title'] 	= 	$Password_change_request;
		$MassegesArray[0]['text'] 	= 	$text_Password_change_request;

		$MassegesArray[1] 			= 	array();
		$MassegesArray[1]['id'] 		= 	2;
		$MassegesArray[1]['title'] 	= 	$Request_to_change_your_email;
		$MassegesArray[1]['text'] 	= 	$text_Request_to_change_your_email;

		$MassegesArray[2] 			= 	array();
		$MassegesArray[2]['id'] 		= 	3;
		$MassegesArray[2]['title'] 	= 	$Report_on_the_subject_of_abuse;
		$MassegesArray[2]['text'] 	= 	$text_Report_on_the_subject_of_abuse;

		$MassegesArray[3] 			= 	array();
		$MassegesArray[3]['id'] 		= 	4;
		$MassegesArray[3]['title'] 	= 	$Activation;
		$MassegesArray[3]['text'] 	= 	$text_Activation;



		$x = 0;
		$i = array();

		while ($x <= 3)
		{
			$insert = $PowerBB->DB->sql_query("INSERT INTO " . $PowerBB->table['email_msg'] . " SET
													id='NULL',
													title='" . $MassegesArray[$x]['title'] . "',
													text='" . $MassegesArray[$x]['text'] . "'");

			$i[$x] = ($insert) ? 'true' : 'false';

			$x += 1;
		}

		return $i;
	}

	function _CreateExtension()
	{
		global $PowerBB;

		$this->_TempArr['CreateArr']				= 	array();
		$this->_TempArr['CreateArr']['table_name'] 	= 	$PowerBB->table['extension'];
		$this->_TempArr['CreateArr']['fields'] 		= 	array();
		$this->_TempArr['CreateArr']['fields'][] 	= 	'id INT( 9 ) NOT NULL AUTO_INCREMENT PRIMARY KEY';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'Ex VARCHAR( 5 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'max_size VARCHAR( 20 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'mime_type VARCHAR( 255 ) NOT NULL';

		$create = $this->create_table($this->_TempArr['CreateArr']);

		return ($create) ? true : false;
	}

	function _InsertExtension()
	{
		global $PowerBB;

		$ExtensionsArray = array();

		$ExtensionsArray[0] 					= 	array();
		$ExtensionsArray[0]['extension'] 		= 	'.zip';
		$ExtensionsArray[0]['max_size'] 		= 	'20000';
		$ExtensionsArray[0]['mime_type'] 		= 	'application/zip';

		$ExtensionsArray[1] 					= 	array();
		$ExtensionsArray[1]['extension'] 		= 	'.txt';
		$ExtensionsArray[1]['max_size'] 		= 	'2000';
		$ExtensionsArray[1]['mime_type'] 		= 	'plain/text';

		$ExtensionsArray[2] 					= 	array();
		$ExtensionsArray[2]['extension'] 		= 	'.jpg';
		$ExtensionsArray[2]['max_size'] 		= 	'2000';
		$ExtensionsArray[2]['mime_type'] 		= 	'image/jpeg';

		$ExtensionsArray[3] 					= 	array();
		$ExtensionsArray[3]['extension'] 		= 	'.gif';
		$ExtensionsArray[3]['max_size'] 		= 	'2000';
		$ExtensionsArray[3]['mime_type'] 		= 	'image/gif';

		$ExtensionsArray[4] 					= 	array();
		$ExtensionsArray[4]['extension'] 		= 	'.bmp';
		$ExtensionsArray[4]['max_size'] 		= 	'2000';
		$ExtensionsArray[4]['mime_type'] 		= 	'image/bitmap';


		$ExtensionsArray[5] 					= 	array();
		$ExtensionsArray[5]['extension'] 		= 	'.doc';
		$ExtensionsArray[5]['max_size'] 		= 	'2000';
		$ExtensionsArray[5]['mime_type'] 		= 	'application/msword';

		$ExtensionsArray[6] 					= 	array();
		$ExtensionsArray[6]['extension'] 		= 	'.pdf';
		$ExtensionsArray[6]['max_size'] 		= 	'2000';
		$ExtensionsArray[6]['mime_type'] 		= 	'application/pdf';

		$ExtensionsArray[7] 					= 	array();
		$ExtensionsArray[7]['extension'] 		= 	'.png';
		$ExtensionsArray[7]['max_size'] 		= 	'2000';
		$ExtensionsArray[7]['mime_type'] 		= 	'image/png';

		$ExtensionsArray[8] 					= 	array();
		$ExtensionsArray[8]['extension'] 		= 	'.psd';
		$ExtensionsArray[8]['max_size'] 		= 	'2000';
		$ExtensionsArray[8]['mime_type'] 		= 	'unknown/unknown';

		$ExtensionsArray[9] 					= 	array();
		$ExtensionsArray[9]['extension'] 		= 	'.jpe';
		$ExtensionsArray[9]['max_size'] 		= 	'2000';
		$ExtensionsArray[9]['mime_type'] 		= 	'image/jpeg';

		$ExtensionsArray[10] 					= 	array();
		$ExtensionsArray[10]['extension'] 		= 	'.rar';
		$ExtensionsArray[10]['max_size'] 		= 	'2000';
		$ExtensionsArray[10]['mime_type'] 		= 	'application/x-rar-compressed';

		$x = 0;
		$i = array();

		while ($x < sizeof($ExtensionsArray))
		{
			$insert = $PowerBB->DB->sql_query("INSERT INTO " . $PowerBB->table['extension'] . " SET
														id='NULL',
														Ex='" . $ExtensionsArray[$x]['extension'] . "',
														max_size='" . $ExtensionsArray[$x]['max_size'] . "'");

			$i[$x] = ($insert) ? 'true' : 'false';

			$x += 1;
		}

		return $i;
	}

	function _CreateGroup()
	{
		// Hmmmmmmmm , It's long table :/ , anyway i should do it
		global $PowerBB;

		$this->_TempArr['CreateArr']				= 	array();
		$this->_TempArr['CreateArr']['table_name'] 	= 	$PowerBB->table['group'];
		$this->_TempArr['CreateArr']['fields'] 		= 	array();
		$this->_TempArr['CreateArr']['fields'][] 	= 	'id INT( 9 ) NOT NULL AUTO_INCREMENT PRIMARY KEY';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'title VARCHAR( 100 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'username_style VARCHAR( 100 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'user_title VARCHAR( 100 ) NOT NULL';

		$this->_TempArr['CreateArr']['fields'][] 	= 	'forum_team INT( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'banned INT( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'view_section INT( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'download_attach INT( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'download_attach_number SMALLINT( 4 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'write_subject INT( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'write_reply INT( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'upload_attach INT( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'upload_attach_num INT( 5 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'edit_own_subject INT( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'edit_own_reply INT( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'del_own_subject INT( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'del_own_reply INT( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'write_poll INT( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'vote_poll INT( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'no_posts INT( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'use_pm INT( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'send_pm INT( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'resive_pm INT( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'max_pm INT( 9 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'min_send_pm INT( 9 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'sig_allow INT( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'sig_len INT( 5 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'group_mod INT( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'del_subject INT( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'del_reply INT( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'edit_subject INT( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'edit_reply INT( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'stick_subject INT( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'unstick_subject INT( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'move_subject INT( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'close_subject INT( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'usercp_allow INT( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'admincp_allow INT( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'search_allow INT( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'memberlist_allow INT( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'vice INT( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'show_hidden INT( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'view_usernamestyle INT( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'usertitle_change INT( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'onlinepage_allow INT( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'allow_see_offstyles INT( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'admincp_section INT( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'admincp_option INT( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'admincp_member INT( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'admincp_membergroup INT( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'admincp_membertitle INT( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'admincp_admin INT( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'admincp_adminstep INT( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'admincp_subject INT( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'admincp_database INT( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'admincp_fixup INT( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'admincp_ads INT( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'admincp_template INT( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'admincp_adminads INT( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'admincp_attach INT( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'admincp_page INT( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'admincp_block INT( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'admincp_style INT( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'admincp_toolbox INT( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'admincp_smile INT( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'admincp_icon INT( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'admincp_avater INT( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'group_order INT( 9 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'admincp_contactus INT( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'send_warning INT( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'can_warned INT( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'hide_allow INT( 1 ) NOT NULL';
        $this->_TempArr['CreateArr']['fields'][] 	= 	'visitormessage INT( 1 ) NOT NULL';
        $this->_TempArr['CreateArr']['fields'][] 	= 	'see_who_on_topic INT( 1 ) NOT NULL';
        $this->_TempArr['CreateArr']['fields'][] 	= 	'reputation_number INT( 1 ) NOT NULL';
        // 2.1.1
		$this->_TempArr['CreateArr']['fields'][] 	= 	'admincp_chat INT( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'admincp_extrafield INT( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'admincp_lang INT( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'admincp_emailed INT( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'admincp_warn INT( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'admincp_award INT( 1 ) NOT NULL';
        $this->_TempArr['CreateArr']['fields'][] 	= 	'admincp_multi_moderation INT( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'view_subject INT( 1 ) NOT NULL';
        // 2.1.2
		$this->_TempArr['CreateArr']['fields'][] 	= 	'review_subject int( 1 ) NOT NULL';
        $this->_TempArr['CreateArr']['fields'][] 	= 	'review_reply int( 1 ) NOT NULL';
        // 2.1.3
        $this->_TempArr['CreateArr']['fields'][] 	= 	"view_action_edit int( 1 ) NOT NULL DEFAULT '1'";
     // 2.1.3
        $this->_TempArr['CreateArr']['fields'][] 	= 	"topic_day_number int( 1 ) NOT NULL DEFAULT '0'";
       // 3.0.2
        $this->_TempArr['CreateArr']['fields'][] 	= 	"groups_security int( 1 ) NOT NULL DEFAULT '1'";
        $this->_TempArr['CreateArr']['fields'][] 	= 	"profile_photo int( 1 ) NOT NULL DEFAULT '1'";

		$create = $this->create_table($this->_TempArr['CreateArr']);

		return ($create) ? true : false;
	}

	function _InsertGroup()
	{
		global $PowerBB;
        include("../lang/".$PowerBB->_GET['lang']."/language.php");
		$Administrators     = $lang['Administrators'];
		$General_supervisor = $lang['General_supervisor'];
		$Deputy_Director    = $lang['Deputy_Director'];
		$Attorney_General   = $lang['Attorney_General'];
		$Moderators         = $lang['Moderators'];
		$Moderator         = $lang['Moderator'];
		$Members            = $lang['Members'];
		$Member             = $lang['Member'];
		$Validat            = $lang['Validat'];
		$Validating         = $lang['Validating'];
		$Banneds             = $lang['Banneds'];
		$Banned             = $lang['Banned'];
		$Guests             = $lang['Guests'];
		$Guest              = $lang['Guest'];
		$Comptroller_General = $lang['Comptroller_General'];
		$Assistant_Director = $lang['Assistant_Director'];

		// Do you know? I hate this table :(

		$GroupsArray = array();

		// Group ID : 1
		$GroupsArray[0] 								= array();
		$GroupsArray[0]['id'] 						= 1;
		$GroupsArray[0]['title'] 					= $Administrators;
		$GroupsArray[0]['username_style'] 			= '<strong><em><span style="color: #800000;">[username]</span></em></strong>';
		$GroupsArray[0]['user_title'] 				= $General_supervisor;
		$GroupsArray[0]['forum_team'] 				= 1;
		$GroupsArray[0]['banned'] 					= 0;
		$GroupsArray[0]['view_section'] 				= 1;
		$GroupsArray[0]['view_subject'] 				= 1;
		$GroupsArray[0]['download_attach']			= 1;
		$GroupsArray[0]['download_attach_number'] 	= 0;
		$GroupsArray[0]['write_subject'] 			= 1;
		$GroupsArray[0]['write_reply'] 				= 1;
		$GroupsArray[0]['upload_attach'] 			= 1;
		$GroupsArray[0]['upload_attach_num'] 		= 1;
		$GroupsArray[0]['edit_own_subject'] 			= 1;
		$GroupsArray[0]['edit_own_reply'] 			= 1;
		$GroupsArray[0]['del_own_subject'] 			= 1;
		$GroupsArray[0]['del_own_reply'] 			= 1;
		$GroupsArray[0]['write_poll'] 				= 1;
		$GroupsArray[0]['vote_poll'] 				= 1;
		$GroupsArray[0]['no_posts'] 				= 1;
		$GroupsArray[0]['use_pm'] 					= 1;
		$GroupsArray[0]['send_pm'] 					= 1;
		$GroupsArray[0]['resive_pm'] 				= 1;
		$GroupsArray[0]['max_pm'] 					= 0;
		$GroupsArray[0]['min_send_pm'] 				= 0;
		$GroupsArray[0]['sig_allow'] 				= 1;
		$GroupsArray[0]['sig_len']					= 2000;
		$GroupsArray[0]['group_mod'] 				= 0;
		$GroupsArray[0]['del_subject'] 				= 0;
		$GroupsArray[0]['del_reply'] 				= 0;
		$GroupsArray[0]['edit_subject'] 				= 0;
		$GroupsArray[0]['edit_reply'] 				= 0;
		$GroupsArray[0]['stick_subject'] 			= 0;
		$GroupsArray[0]['unstick_subject'] 			= 0;
		$GroupsArray[0]['close_subject'] 			= 0;
		$GroupsArray[0]['usercp_allow'] 				= 1;
		$GroupsArray[0]['admincp_allow'] 			= 1;
		$GroupsArray[0]['search_allow'] 				= 1;
		$GroupsArray[0]['memberlist_allow'] 			= 1;
		$GroupsArray[0]['vice'] 						= 0;
		$GroupsArray[0]['show_hidden'] 				= 1;
		$GroupsArray[0]['hide_allow'] 				= 1;
		$GroupsArray[0]['view_usernamestyle'] 		= 1;
		$GroupsArray[0]['usertitle_change'] 			= 0;
		$GroupsArray[0]['onlinepage_allow'] 			= 1;
		$GroupsArray[0]['allow_see_offstyles'] 		= 0;
		$GroupsArray[0]['admincp_section'] 			= 1;
		$GroupsArray[0]['admincp_option'] 			= 1;
		$GroupsArray[0]['admincp_member'] 			= 1;
		$GroupsArray[0]['admincp_membergroup'] 		= 1;
		$GroupsArray[0]['admincp_membertitle'] 		= 1;
		$GroupsArray[0]['admincp_admin'] 			= 1;
		$GroupsArray[0]['admincp_adminstep'] 		= 1;
		$GroupsArray[0]['admincp_subject'] 			= 1;
		$GroupsArray[0]['admincp_database'] 			= 1;
		$GroupsArray[0]['admincp_fixup'] 			= 1;
		$GroupsArray[0]['admincp_ads'] 				= 1;
		$GroupsArray[0]['admincp_template'] 			= 1;
		$GroupsArray[0]['admincp_adminads'] 			= 1;
		$GroupsArray[0]['admincp_attach'] 			= 1;
		$GroupsArray[0]['admincp_page'] 				= 1;
		$GroupsArray[0]['admincp_block'] 			= 1;
		$GroupsArray[0]['admincp_style'] 			= 1;
		$GroupsArray[0]['admincp_toolbox'] 			= 1;
		$GroupsArray[0]['admincp_smile'] 			= 1;
		$GroupsArray[0]['admincp_icon'] 				= 1;
		$GroupsArray[0]['admincp_avater'] 			= 1;
		$GroupsArray[0]['group_order'] 				= 1;
		$GroupsArray[0]['admincp_contactus'] 		= 1;
		$GroupsArray[0]['can_warned'] 		        = 0;
		$GroupsArray[0]['send_warning'] 	     	= 1;
        $GroupsArray[0]['visitormessage'] 	     	= 1;
        $GroupsArray[0]['see_who_on_topic'] 	    = 1;
        $GroupsArray[0]['reputation_number'] 	    = 100;
        $GroupsArray[0]['admincp_chat'] 	        = 1;
        $GroupsArray[0]['admincp_extrafield'] 	    = 1;
        $GroupsArray[0]['admincp_lang'] 	        = 1;
        $GroupsArray[0]['admincp_emailed'] 	        = 1;
        $GroupsArray[0]['admincp_warn'] 	        = 1;
        $GroupsArray[0]['admincp_award'] 	        = 1;
        $GroupsArray[0]['admincp_multi_moderation'] = 1;
        $GroupsArray[0]['topic_day_number'] 	    = 0;
        $GroupsArray[0]['groups_security'] 	        = 1;
        $GroupsArray[0]['profile_photo'] 	        = 1;

		// Group ID : 2
		$GroupsArray[1] 								= array();
		$GroupsArray[1]['id'] 						= 2;
		$GroupsArray[1]['title'] 					= $Deputy_Director;
		$GroupsArray[1]['username_style'] 			= '<strong><span style="color: #FF0000;">[username]</span></strong>';
		$GroupsArray[1]['user_title'] 				= $Attorney_General;
		$GroupsArray[1]['forum_team'] 				= 1;
		$GroupsArray[1]['banned'] 					= 0;
		$GroupsArray[1]['view_section'] 				= 1;
		$GroupsArray[1]['view_subject'] 				= 1;
		$GroupsArray[1]['download_attach']			= 1;
		$GroupsArray[1]['download_attach_number'] 	= 0;
		$GroupsArray[1]['write_subject'] 			= 1;
		$GroupsArray[1]['write_reply'] 				= 1;
		$GroupsArray[1]['upload_attach'] 			= 1;
		$GroupsArray[1]['upload_attach_num'] 		= 1;
		$GroupsArray[1]['edit_own_subject'] 			= 1;
		$GroupsArray[1]['edit_own_reply'] 			= 1;
		$GroupsArray[1]['del_own_subject'] 			= 1;
		$GroupsArray[1]['del_own_reply'] 			= 1;
		$GroupsArray[1]['write_poll'] 				= 1;
		$GroupsArray[1]['vote_poll'] 				= 1;
		$GroupsArray[1]['no_posts'] 				= 1;
		$GroupsArray[1]['use_pm'] 					= 1;
		$GroupsArray[1]['send_pm'] 					= 1;
		$GroupsArray[1]['resive_pm'] 				= 1;
		$GroupsArray[1]['max_pm'] 					= 0;
		$GroupsArray[1]['min_send_pm'] 				= 0;
		$GroupsArray[1]['sig_allow'] 				= 1;
		$GroupsArray[1]['sig_len']					= 2000;
		$GroupsArray[1]['group_mod'] 				= 0;
		$GroupsArray[1]['del_subject'] 				= 0;
		$GroupsArray[1]['del_reply'] 				= 0;
		$GroupsArray[1]['edit_subject'] 				= 0;
		$GroupsArray[1]['edit_reply'] 				= 0;
		$GroupsArray[1]['stick_subject'] 			= 0;
		$GroupsArray[1]['unstick_subject'] 			= 0;
		$GroupsArray[1]['close_subject'] 			= 0;
		$GroupsArray[1]['usercp_allow'] 				= 1;
		$GroupsArray[1]['admincp_allow'] 			= 0;
		$GroupsArray[1]['search_allow'] 				= 1;
		$GroupsArray[1]['memberlist_allow'] 			= 1;
		$GroupsArray[1]['vice'] 						= 1;
		$GroupsArray[1]['show_hidden'] 				= 1;
		$GroupsArray[1]['hide_allow'] 				= 1;
		$GroupsArray[1]['view_usernamestyle'] 		= 1;
		$GroupsArray[1]['usertitle_change'] 			= 0;
		$GroupsArray[1]['onlinepage_allow'] 			= 1;
		$GroupsArray[1]['allow_see_offstyles'] 		= 0;
		$GroupsArray[1]['admincp_section'] 			= 0;
		$GroupsArray[1]['admincp_option'] 			= 0;
		$GroupsArray[1]['admincp_member'] 			= 0;
		$GroupsArray[1]['admincp_membergroup'] 		= 0;
		$GroupsArray[1]['admincp_membertitle'] 		= 0;
		$GroupsArray[1]['admincp_admin'] 			= 0;
		$GroupsArray[1]['admincp_adminstep'] 		= 0;
		$GroupsArray[1]['admincp_subject'] 			= 0;
		$GroupsArray[1]['admincp_database'] 			= 0;
		$GroupsArray[1]['admincp_fixup'] 			= 0;
		$GroupsArray[1]['admincp_ads'] 				= 0;
		$GroupsArray[1]['admincp_template'] 			= 0;
		$GroupsArray[1]['admincp_adminads'] 			= 0;
		$GroupsArray[1]['admincp_attach'] 			= 0;
		$GroupsArray[1]['admincp_page'] 				= 0;
		$GroupsArray[1]['admincp_block'] 			= 0;
		$GroupsArray[1]['admincp_style'] 			= 0;
		$GroupsArray[1]['admincp_toolbox'] 			= 0;
		$GroupsArray[1]['admincp_smile'] 			= 0;
		$GroupsArray[1]['admincp_icon'] 				= 0;
		$GroupsArray[1]['admincp_avater'] 			= 0;
		$GroupsArray[1]['group_order'] 				= 3;
		$GroupsArray[1]['admincp_contactus'] 		= 0;
		$GroupsArray[1]['can_warned'] 		        = 0;
		$GroupsArray[1]['send_warning'] 		    = 1;
        $GroupsArray[1]['visitormessage'] 	     	= 1;
        $GroupsArray[1]['see_who_on_topic'] 	    = 1;
        $GroupsArray[1]['reputation_number'] 	    = 50;
        $GroupsArray[1]['admincp_chat'] 	        = 0;
        $GroupsArray[1]['admincp_extrafield'] 	    = 0;
        $GroupsArray[1]['admincp_lang'] 	        = 0;
        $GroupsArray[1]['admincp_emailed'] 	        = 0;
        $GroupsArray[1]['admincp_warn'] 	        = 0;
        $GroupsArray[1]['admincp_award'] 	        = 0;
        $GroupsArray[1]['admincp_multi_moderation'] = 0;
        $GroupsArray[1]['topic_day_number'] 	    = 0;
        $GroupsArray[1]['groups_security'] 	        = 1;
        $GroupsArray[1]['profile_photo'] 	        = 1;

		// Group ID : 3
		$GroupsArray[2] 								= array();
		$GroupsArray[2]['id'] 						= 3;
		$GroupsArray[2]['title'] 					= $Moderators;
		$GroupsArray[2]['username_style'] 			= '<strong><span style="color: #0000FF;">[username]</span></strong>';
		$GroupsArray[2]['user_title'] 				= $Moderator;
		$GroupsArray[2]['forum_team'] 				= 1;
		$GroupsArray[2]['banned'] 					= 0;
		$GroupsArray[2]['view_section'] 				= 1;
		$GroupsArray[2]['view_subject'] 				= 1;
		$GroupsArray[2]['download_attach']			= 1;
		$GroupsArray[2]['download_attach_number'] 	= 0;
		$GroupsArray[2]['write_subject'] 			= 1;
		$GroupsArray[2]['write_reply'] 				= 1;
		$GroupsArray[2]['upload_attach'] 			= 1;
		$GroupsArray[2]['upload_attach_num'] 		= 1;
		$GroupsArray[2]['edit_own_subject'] 		= 1;
		$GroupsArray[2]['edit_own_reply'] 			= 1;
		$GroupsArray[2]['del_own_subject'] 			= 0;
		$GroupsArray[2]['del_own_reply'] 			= 0;
		$GroupsArray[2]['write_poll'] 				= 1;
		$GroupsArray[2]['vote_poll'] 				= 1;
		$GroupsArray[2]['no_posts'] 				= 1;
		$GroupsArray[2]['use_pm'] 					= 1;
		$GroupsArray[2]['send_pm'] 					= 1;
		$GroupsArray[2]['resive_pm'] 				= 1;
		$GroupsArray[2]['max_pm'] 					= 0;
		$GroupsArray[2]['min_send_pm'] 				= 0;
		$GroupsArray[2]['sig_allow'] 				= 1;
		$GroupsArray[2]['sig_len']					= 2000;
		$GroupsArray[2]['group_mod'] 				= 1;
		$GroupsArray[2]['del_subject'] 				= 1;
		$GroupsArray[2]['del_reply'] 				= 1;
		$GroupsArray[2]['edit_subject'] 				= 1;
		$GroupsArray[2]['edit_reply'] 				= 1;
		$GroupsArray[2]['stick_subject'] 			= 1;
		$GroupsArray[2]['unstick_subject'] 			= 1;
		$GroupsArray[2]['close_subject'] 			= 1;
		$GroupsArray[2]['usercp_allow'] 				= 0;
		$GroupsArray[2]['admincp_allow'] 			= 0;
		$GroupsArray[2]['search_allow'] 				= 1;
		$GroupsArray[2]['memberlist_allow'] 			= 1;
		$GroupsArray[2]['vice'] 						= 0;
		$GroupsArray[2]['show_hidden'] 				= 0;
		$GroupsArray[2]['hide_allow'] 				= 1;
		$GroupsArray[2]['view_usernamestyle'] 		= 1;
		$GroupsArray[2]['usertitle_change'] 			= 0;
		$GroupsArray[2]['onlinepage_allow'] 			= 1;
		$GroupsArray[2]['allow_see_offstyles'] 		= 0;
		$GroupsArray[2]['admincp_section'] 			= 0;
		$GroupsArray[2]['admincp_option'] 			= 0;
		$GroupsArray[2]['admincp_member'] 			= 0;
		$GroupsArray[2]['admincp_membergroup'] 		= 0;
		$GroupsArray[2]['admincp_membertitle'] 		= 0;
		$GroupsArray[2]['admincp_admin'] 			= 0;
		$GroupsArray[2]['admincp_adminstep'] 		= 0;
		$GroupsArray[2]['admincp_subject'] 			= 0;
		$GroupsArray[2]['admincp_database'] 			= 0;
		$GroupsArray[2]['admincp_fixup'] 			= 0;
		$GroupsArray[2]['admincp_ads'] 				= 0;
		$GroupsArray[2]['admincp_template'] 			= 0;
		$GroupsArray[2]['admincp_adminads'] 			= 0;
		$GroupsArray[2]['admincp_attach'] 			= 0;
		$GroupsArray[2]['admincp_page'] 				= 0;
		$GroupsArray[2]['admincp_block'] 			= 0;
		$GroupsArray[2]['admincp_style'] 			= 0;
		$GroupsArray[2]['admincp_toolbox'] 			= 0;
		$GroupsArray[2]['admincp_smile'] 			= 0;
		$GroupsArray[2]['admincp_icon'] 				= 0;
		$GroupsArray[2]['admincp_avater'] 			= 0;
		$GroupsArray[2]['group_order'] 				= 4;
		$GroupsArray[2]['admincp_contactus'] 		= 0;
		$GroupsArray[2]['can_warned'] 		        = 0;
		$GroupsArray[2]['send_warning'] 		    = 0;
        $GroupsArray[2]['visitormessage'] 	     	= 1;
        $GroupsArray[2]['see_who_on_topic'] 	    = 1;
        $GroupsArray[2]['reputation_number'] 	    = 30;
        $GroupsArray[2]['admincp_chat'] 	        = 0;
        $GroupsArray[2]['admincp_extrafield'] 	    = 0;
        $GroupsArray[2]['admincp_lang'] 	        = 0;
        $GroupsArray[2]['admincp_emailed'] 	        = 0;
        $GroupsArray[2]['admincp_warn'] 	        = 0;
        $GroupsArray[2]['admincp_award'] 	        = 0;
        $GroupsArray[2]['admincp_multi_moderation'] = 0;
        $GroupsArray[2]['topic_day_number'] 	    = 0;
        $GroupsArray[2]['groups_security'] 	        = 1;
        $GroupsArray[2]['profile_photo'] 	        = 1;

		// Group ID : 4
		$GroupsArray[3] 								= array();
		$GroupsArray[3]['id'] 						= 4;
		$GroupsArray[3]['title'] 					= $Members;
		$GroupsArray[3]['username_style'] 			= '<span style="color: #000000;">[username]</span>';
		$GroupsArray[3]['user_title'] 				= $Member;
		$GroupsArray[3]['forum_team'] 				= 0;
		$GroupsArray[3]['banned'] 					= 0;
		$GroupsArray[3]['view_section'] 				= 1;
		$GroupsArray[3]['view_subject'] 				= 1;
		$GroupsArray[3]['download_attach']			= 1;
		$GroupsArray[3]['download_attach_number'] 	= 0;
		$GroupsArray[3]['write_subject'] 			= 1;
		$GroupsArray[3]['write_reply'] 				= 1;
		$GroupsArray[3]['upload_attach'] 			= 1;
		$GroupsArray[3]['upload_attach_num'] 		= 1;
		$GroupsArray[3]['edit_own_subject'] 		= 1;
		$GroupsArray[3]['edit_own_reply'] 			= 1;
		$GroupsArray[3]['del_own_subject'] 			= 0;
		$GroupsArray[3]['del_own_reply'] 			= 0;
		$GroupsArray[3]['write_poll'] 				= 1;
		$GroupsArray[3]['vote_poll'] 				= 1;
		$GroupsArray[3]['no_posts'] 				= 1;
		$GroupsArray[3]['use_pm'] 					= 1;
		$GroupsArray[3]['send_pm'] 					= 1;
		$GroupsArray[3]['resive_pm'] 				= 1;
		$GroupsArray[3]['max_pm'] 					= 0;
		$GroupsArray[3]['min_send_pm'] 				= 0;
		$GroupsArray[3]['sig_allow'] 				= 1;
		$GroupsArray[3]['sig_len']					= 2000;
		$GroupsArray[3]['group_mod'] 				= 0;
		$GroupsArray[3]['del_subject'] 				= 0;
		$GroupsArray[3]['del_reply'] 				= 0;
		$GroupsArray[3]['edit_subject'] 				= 0;
		$GroupsArray[3]['edit_reply'] 				= 0;
		$GroupsArray[3]['stick_subject'] 			= 0;
		$GroupsArray[3]['unstick_subject'] 			= 0;
		$GroupsArray[3]['close_subject'] 			= 0;
		$GroupsArray[3]['usercp_allow'] 				= 0;
		$GroupsArray[3]['admincp_allow'] 			= 0;
		$GroupsArray[3]['search_allow'] 				= 1;
		$GroupsArray[3]['memberlist_allow'] 			= 1;
		$GroupsArray[3]['vice'] 						= 0;
		$GroupsArray[3]['show_hidden'] 				= 0;
		$GroupsArray[3]['hide_allow'] 				= 1;
		$GroupsArray[3]['view_usernamestyle'] 		= 1;
		$GroupsArray[3]['usertitle_change'] 			= 1;
		$GroupsArray[3]['onlinepage_allow'] 			= 1;
		$GroupsArray[3]['allow_see_offstyles'] 		= 0;
		$GroupsArray[3]['admincp_section'] 			= 0;
		$GroupsArray[3]['admincp_option'] 			= 0;
		$GroupsArray[3]['admincp_member'] 			= 0;
		$GroupsArray[3]['admincp_membergroup'] 		= 0;
		$GroupsArray[3]['admincp_membertitle'] 		= 0;
		$GroupsArray[3]['admincp_admin'] 			= 0;
		$GroupsArray[3]['admincp_adminstep'] 		= 0;
		$GroupsArray[3]['admincp_subject'] 			= 0;
		$GroupsArray[3]['admincp_database'] 			= 0;
		$GroupsArray[3]['admincp_fixup'] 			= 0;
		$GroupsArray[3]['admincp_ads'] 				= 0;
		$GroupsArray[3]['admincp_template'] 			= 0;
		$GroupsArray[3]['admincp_adminads'] 			= 0;
		$GroupsArray[3]['admincp_attach'] 			= 0;
		$GroupsArray[3]['admincp_page'] 				= 0;
		$GroupsArray[3]['admincp_block'] 			= 0;
		$GroupsArray[3]['admincp_style'] 			= 0;
		$GroupsArray[3]['admincp_toolbox'] 			= 0;
		$GroupsArray[3]['admincp_smile'] 			= 0;
		$GroupsArray[3]['admincp_icon'] 				= 0;
		$GroupsArray[3]['admincp_avater'] 			= 0;
		$GroupsArray[3]['group_order'] 				= 5;
		$GroupsArray[3]['admincp_contactus'] 		= 0;
		$GroupsArray[3]['can_warned'] 		        = 1;
		$GroupsArray[3]['send_warning'] 		    = 0;
        $GroupsArray[3]['visitormessage'] 	     	= 1;
        $GroupsArray[3]['see_who_on_topic'] 	    = 1;
        $GroupsArray[3]['reputation_number'] 	    = 10;
        $GroupsArray[3]['admincp_chat'] 	        = 0;
        $GroupsArray[3]['admincp_extrafield'] 	    = 0;
        $GroupsArray[3]['admincp_lang'] 	        = 0;
        $GroupsArray[3]['admincp_emailed'] 	        = 0;
        $GroupsArray[3]['admincp_warn'] 	        = 0;
        $GroupsArray[3]['admincp_award'] 	        = 0;
        $GroupsArray[3]['admincp_multi_moderation'] = 0;
        $GroupsArray[3]['topic_day_number'] 	    = 0;
        $GroupsArray[3]['groups_security'] 	        = 1;
        $GroupsArray[3]['profile_photo'] 	        = 1;

		// Group ID : 5
		$GroupsArray[4] 								= array();
		$GroupsArray[4]['id'] 						= 5;
		$GroupsArray[4]['title'] 					= $Validating;
		$GroupsArray[4]['username_style'] 			= '<span style="color: #008080;">[username]</span>';
		$GroupsArray[4]['user_title'] 				= $Validat;
		$GroupsArray[4]['forum_team'] 				= 0;
		$GroupsArray[4]['banned'] 					= 0;
		$GroupsArray[4]['view_section'] 				= 1;
		$GroupsArray[4]['view_subject'] 				= 1;
		$GroupsArray[4]['download_attach']			= 0;
		$GroupsArray[4]['download_attach_number'] 	= 0;
		$GroupsArray[4]['write_subject'] 			= 0;
		$GroupsArray[4]['write_reply'] 				= 0;
		$GroupsArray[4]['upload_attach'] 			= 0;
		$GroupsArray[4]['upload_attach_num'] 		= 1;
		$GroupsArray[4]['edit_own_subject'] 			= 0;
		$GroupsArray[4]['edit_own_reply'] 			= 0;
		$GroupsArray[4]['del_own_subject'] 			= 0;
		$GroupsArray[4]['del_own_reply'] 			= 0;
		$GroupsArray[4]['write_poll'] 				= 0;
		$GroupsArray[4]['vote_poll'] 				= 0;
		$GroupsArray[4]['no_posts'] 				= 1;
		$GroupsArray[4]['use_pm'] 					= 0;
		$GroupsArray[4]['send_pm'] 					= 0;
		$GroupsArray[4]['resive_pm'] 				= 0;
		$GroupsArray[4]['max_pm'] 					= 0;
		$GroupsArray[4]['min_send_pm'] 				= 0;
		$GroupsArray[4]['sig_allow'] 				= 0;
		$GroupsArray[4]['sig_len']					= 0;
		$GroupsArray[4]['group_mod'] 				= 0;
		$GroupsArray[4]['del_subject'] 				= 0;
		$GroupsArray[4]['del_reply'] 				= 0;
		$GroupsArray[4]['edit_subject'] 				= 0;
		$GroupsArray[4]['edit_reply'] 				= 0;
		$GroupsArray[4]['stick_subject'] 			= 0;
		$GroupsArray[4]['unstick_subject'] 			= 0;
		$GroupsArray[4]['close_subject'] 			= 0;
		$GroupsArray[4]['usercp_allow'] 				= 0;
		$GroupsArray[4]['admincp_allow'] 			= 0;
		$GroupsArray[4]['search_allow'] 				= 1;
		$GroupsArray[4]['memberlist_allow'] 			= 1;
		$GroupsArray[4]['vice'] 						= 0;
		$GroupsArray[4]['show_hidden'] 				= 0;
		$GroupsArray[4]['hide_allow'] 				= 0;
		$GroupsArray[4]['view_usernamestyle'] 		= 0;
		$GroupsArray[4]['usertitle_change'] 			= 0;
		$GroupsArray[4]['onlinepage_allow'] 			= 0;
		$GroupsArray[4]['allow_see_offstyles'] 		= 0;
		$GroupsArray[4]['admincp_section'] 			= 0;
		$GroupsArray[4]['admincp_option'] 			= 0;
		$GroupsArray[4]['admincp_member'] 			= 0;
		$GroupsArray[4]['admincp_membergroup'] 		= 0;
		$GroupsArray[4]['admincp_membertitle'] 		= 0;
		$GroupsArray[4]['admincp_admin'] 			= 0;
		$GroupsArray[4]['admincp_adminstep'] 		= 0;
		$GroupsArray[4]['admincp_subject'] 			= 0;
		$GroupsArray[4]['admincp_database'] 			= 0;
		$GroupsArray[4]['admincp_fixup'] 			= 0;
		$GroupsArray[4]['admincp_ads'] 				= 0;
		$GroupsArray[4]['admincp_template'] 			= 0;
		$GroupsArray[4]['admincp_adminads'] 			= 0;
		$GroupsArray[4]['admincp_attach'] 			= 0;
		$GroupsArray[4]['admincp_page'] 				= 0;
		$GroupsArray[4]['admincp_block'] 			= 0;
		$GroupsArray[4]['admincp_style'] 			= 0;
		$GroupsArray[4]['admincp_toolbox'] 			= 0;
		$GroupsArray[4]['admincp_smile'] 			= 0;
		$GroupsArray[4]['admincp_icon'] 				= 0;
		$GroupsArray[4]['admincp_avater'] 			= 0;
		$GroupsArray[4]['group_order'] 				= 6;
		$GroupsArray[4]['admincp_contactus'] 		= 0;
		$GroupsArray[4]['can_warned'] 		        = 1;
		$GroupsArray[4]['send_warning'] 		    = 0;
        $GroupsArray[4]['visitormessage'] 	     	= 1;
        $GroupsArray[4]['see_who_on_topic'] 	    = 1;
        $GroupsArray[4]['reputation_number'] 	    = 10;
        $GroupsArray[4]['admincp_chat'] 	        = 0;
        $GroupsArray[4]['admincp_extrafield'] 	    = 0;
        $GroupsArray[4]['admincp_lang'] 	        = 0;
        $GroupsArray[4]['admincp_emailed'] 	        = 0;
        $GroupsArray[4]['admincp_warn'] 	        = 0;
        $GroupsArray[4]['admincp_award'] 	        = 0;
        $GroupsArray[4]['admincp_multi_moderation'] = 0;
        $GroupsArray[4]['topic_day_number'] 	    = 0;
        $GroupsArray[4]['groups_security'] 	        = 0;
        $GroupsArray[4]['profile_photo'] 	        = 0;

		// Group ID : 6
		$GroupsArray[5] 								= array();
		$GroupsArray[5]['id'] 						= 6;
		$GroupsArray[5]['title'] 					= $Banneds;
		$GroupsArray[5]['username_style'] 			= '<span style="color: #FF0000;">[username]</span>';
		$GroupsArray[5]['user_title'] 				= $Banned;
		$GroupsArray[5]['forum_team'] 				= 0;
		$GroupsArray[5]['banned'] 					= 1;
		$GroupsArray[5]['view_section'] 				= 0;
		$GroupsArray[5]['view_subject'] 				= 0;
		$GroupsArray[5]['download_attach']			= 0;
		$GroupsArray[5]['download_attach_number'] 	= 0;
		$GroupsArray[5]['write_subject'] 			= 0;
		$GroupsArray[5]['write_reply'] 				= 0;
		$GroupsArray[5]['upload_attach'] 			= 0;
		$GroupsArray[5]['upload_attach_num'] 		= 1;
		$GroupsArray[5]['edit_own_subject'] 			= 0;
		$GroupsArray[5]['edit_own_reply'] 			= 0;
		$GroupsArray[5]['del_own_subject'] 			= 0;
		$GroupsArray[5]['del_own_reply'] 			= 0;
		$GroupsArray[5]['write_poll'] 				= 0;
		$GroupsArray[5]['vote_poll'] 				= 0;
		$GroupsArray[5]['no_posts'] 				= 0;
		$GroupsArray[5]['use_pm'] 					= 0;
		$GroupsArray[5]['send_pm'] 					= 0;
		$GroupsArray[5]['resive_pm'] 				= 0;
		$GroupsArray[5]['max_pm'] 					= 0;
		$GroupsArray[5]['min_send_pm'] 				= 0;
		$GroupsArray[5]['sig_allow'] 				= 0;
		$GroupsArray[5]['sig_len']					= 0;
		$GroupsArray[5]['group_mod'] 				= 0;
		$GroupsArray[5]['del_subject'] 				= 0;
		$GroupsArray[5]['del_reply'] 				= 0;
		$GroupsArray[5]['edit_subject'] 				= 0;
		$GroupsArray[5]['edit_reply'] 				= 0;
		$GroupsArray[5]['stick_subject'] 			= 0;
		$GroupsArray[5]['unstick_subject'] 			= 0;
		$GroupsArray[5]['close_subject'] 			= 0;
		$GroupsArray[5]['usercp_allow'] 				= 0;
		$GroupsArray[5]['admincp_allow'] 			= 0;
		$GroupsArray[5]['search_allow'] 				= 0;
		$GroupsArray[5]['memberlist_allow'] 			= 0;
		$GroupsArray[5]['vice'] 						= 0;
		$GroupsArray[5]['show_hidden'] 				= 0;
		$GroupsArray[5]['hide_allow'] 				= 0;
		$GroupsArray[5]['view_usernamestyle'] 		= 1;
		$GroupsArray[5]['usertitle_change'] 			= 0;
		$GroupsArray[5]['onlinepage_allow'] 			= 0;
		$GroupsArray[5]['allow_see_offstyles'] 		= 0;
		$GroupsArray[5]['admincp_section'] 			= 0;
		$GroupsArray[5]['admincp_option'] 			= 0;
		$GroupsArray[5]['admincp_member'] 			= 0;
		$GroupsArray[5]['admincp_membergroup'] 		= 0;
		$GroupsArray[5]['admincp_membertitle'] 		= 0;
		$GroupsArray[5]['admincp_admin'] 			= 0;
		$GroupsArray[5]['admincp_adminstep'] 		= 0;
		$GroupsArray[5]['admincp_subject'] 			= 0;
		$GroupsArray[5]['admincp_database'] 			= 0;
		$GroupsArray[5]['admincp_fixup'] 			= 0;
		$GroupsArray[5]['admincp_ads'] 				= 0;
		$GroupsArray[5]['admincp_template'] 			= 0;
		$GroupsArray[5]['admincp_adminads'] 			= 0;
		$GroupsArray[5]['admincp_attach'] 			= 0;
		$GroupsArray[5]['admincp_page'] 				= 0;
		$GroupsArray[5]['admincp_block'] 			= 0;
		$GroupsArray[5]['admincp_style'] 			= 0;
		$GroupsArray[5]['admincp_toolbox'] 			= 0;
		$GroupsArray[5]['admincp_smile'] 			= 0;
		$GroupsArray[5]['admincp_icon'] 				= 0;
		$GroupsArray[5]['admincp_avater'] 			= 0;
		$GroupsArray[5]['group_order'] 				= 7;
		$GroupsArray[5]['admincp_contactus'] 		= 0;
		$GroupsArray[5]['can_warned'] 		        = 1;
		$GroupsArray[5]['send_warning'] 		    = 0;
        $GroupsArray[5]['visitormessage'] 	     	= 0;
        $GroupsArray[5]['see_who_on_topic'] 	     	= 0;
        $GroupsArray[5]['reputation_number'] 	    = 0;
        $GroupsArray[5]['admincp_chat'] 	        = 0;
        $GroupsArray[5]['admincp_extrafield'] 	    = 0;
        $GroupsArray[5]['admincp_lang'] 	        = 0;
        $GroupsArray[5]['admincp_emailed'] 	        = 0;
        $GroupsArray[5]['admincp_warn'] 	        = 0;
        $GroupsArray[5]['admincp_award'] 	        = 0;
        $GroupsArray[5]['admincp_multi_moderation'] = 0;
        $GroupsArray[5]['topic_day_number'] 	    = 0;
        $GroupsArray[5]['groups_security'] 	        = 0;
        $GroupsArray[5]['profile_photo'] 	        = 0;

		// Group ID : 7
		$GroupsArray[6] 								= array();
		$GroupsArray[6]['id'] 						= 7;
		$GroupsArray[6]['title'] 					= $Guests;
		$GroupsArray[6]['username_style'] 			= '[username]';
		$GroupsArray[6]['user_title'] 				= $Guest;
		$GroupsArray[6]['forum_team'] 				= 0;
		$GroupsArray[6]['banned'] 					= 0;
		$GroupsArray[6]['view_section'] 				= 1;
		$GroupsArray[6]['view_subject'] 				= 1;
		$GroupsArray[6]['download_attach']			= 0;
		$GroupsArray[6]['download_attach_number'] 	= 0;
		$GroupsArray[6]['write_subject'] 			= 0;
		$GroupsArray[6]['write_reply'] 				= 0;
		$GroupsArray[6]['upload_attach'] 			= 0;
		$GroupsArray[6]['upload_attach_num'] 		= 1;
		$GroupsArray[6]['edit_own_subject'] 			= 0;
		$GroupsArray[6]['edit_own_reply'] 			= 0;
		$GroupsArray[6]['del_own_subject'] 			= 0;
		$GroupsArray[6]['del_own_reply'] 			= 0;
		$GroupsArray[6]['write_poll'] 				= 0;
		$GroupsArray[6]['vote_poll'] 				= 0;
		$GroupsArray[6]['no_posts'] 				= 0;
		$GroupsArray[6]['use_pm'] 					= 0;
		$GroupsArray[6]['send_pm'] 					= 0;
		$GroupsArray[6]['resive_pm'] 				= 0;
		$GroupsArray[6]['max_pm'] 					= 0;
		$GroupsArray[6]['min_send_pm'] 				= 0;
		$GroupsArray[6]['sig_allow'] 				= 0;
		$GroupsArray[6]['sig_len']					= 0;
		$GroupsArray[6]['group_mod'] 				= 0;
		$GroupsArray[6]['del_subject'] 				= 0;
		$GroupsArray[6]['del_reply'] 				= 0;
		$GroupsArray[6]['edit_subject'] 				= 0;
		$GroupsArray[6]['edit_reply'] 				= 0;
		$GroupsArray[6]['stick_subject'] 			= 0;
		$GroupsArray[6]['unstick_subject'] 			= 0;
		$GroupsArray[6]['close_subject'] 			= 0;
		$GroupsArray[6]['usercp_allow'] 				= 0;
		$GroupsArray[6]['admincp_allow'] 			= 0;
		$GroupsArray[6]['search_allow'] 				= 1;
		$GroupsArray[6]['memberlist_allow'] 			= 1;
		$GroupsArray[6]['vice'] 						= 0;
		$GroupsArray[6]['show_hidden'] 				= 0;
		$GroupsArray[6]['hide_allow'] 				= 0;
		$GroupsArray[6]['view_usernamestyle'] 		= 0;
		$GroupsArray[6]['usertitle_change'] 			= 0;
		$GroupsArray[6]['onlinepage_allow'] 			= 0;
		$GroupsArray[6]['allow_see_offstyles'] 		= 0;
		$GroupsArray[6]['admincp_section'] 			= 0;
		$GroupsArray[6]['admincp_option'] 			= 0;
		$GroupsArray[6]['admincp_member'] 			= 0;
		$GroupsArray[6]['admincp_membergroup'] 		= 0;
		$GroupsArray[6]['admincp_membertitle'] 		= 0;
		$GroupsArray[6]['admincp_admin'] 			= 0;
		$GroupsArray[6]['admincp_adminstep'] 		= 0;
		$GroupsArray[6]['admincp_subject'] 			= 0;
		$GroupsArray[6]['admincp_database'] 			= 0;
		$GroupsArray[6]['admincp_fixup'] 			= 0;
		$GroupsArray[6]['admincp_ads'] 				= 0;
		$GroupsArray[6]['admincp_template'] 			= 0;
		$GroupsArray[6]['admincp_adminads'] 			= 0;
		$GroupsArray[6]['admincp_attach'] 			= 0;
		$GroupsArray[6]['admincp_page'] 				= 0;
		$GroupsArray[6]['admincp_block'] 			= 0;
		$GroupsArray[6]['admincp_style'] 			= 0;
		$GroupsArray[6]['admincp_toolbox'] 			= 0;
		$GroupsArray[6]['admincp_smile'] 			= 0;
		$GroupsArray[6]['admincp_icon'] 				= 0;
		$GroupsArray[6]['admincp_avater'] 			= 0;
		$GroupsArray[6]['group_order'] 				= 8;
		$GroupsArray[6]['admincp_contactus'] 		= 0;
		$GroupsArray[6]['can_warned'] 		        = 1;
		$GroupsArray[6]['send_warning'] 		    = 0;
        $GroupsArray[6]['visitormessage'] 	     	= 1;
        $GroupsArray[6]['see_who_on_topic'] 	    = 0;
        $GroupsArray[6]['reputation_number'] 	    = 0;
        $GroupsArray[6]['admincp_chat'] 	        = 0;
        $GroupsArray[6]['admincp_extrafield'] 	    = 0;
        $GroupsArray[6]['admincp_lang'] 	        = 0;
        $GroupsArray[6]['admincp_emailed'] 	        = 0;
        $GroupsArray[6]['admincp_warn'] 	        = 0;
        $GroupsArray[6]['admincp_award'] 	        = 0;
        $GroupsArray[6]['admincp_multi_moderation'] = 0;
        $GroupsArray[6]['topic_day_number'] 	    = 0;
        $GroupsArray[6]['groups_security'] 	        = 0;
        $GroupsArray[6]['profile_photo'] 	        = 0;

		// Group ID : 8
		$GroupsArray[7] 								= array();
		$GroupsArray[7]['id'] 						= 8;
		$GroupsArray[7]['title'] 					= $Comptroller_General;
		$GroupsArray[7]['username_style'] 			= '<strong><span style="color: #800000;">[username]</span></strong>';
		$GroupsArray[7]['user_title'] 				= $Assistant_Director;
		$GroupsArray[7]['forum_team'] 				= 1;
		$GroupsArray[7]['banned'] 					= 0;
		$GroupsArray[7]['view_section'] 				= 1;
		$GroupsArray[7]['view_subject'] 				= 1;
		$GroupsArray[7]['download_attach']			= 1;
		$GroupsArray[7]['download_attach_number'] 	= 0;
		$GroupsArray[7]['write_subject'] 			= 1;
		$GroupsArray[7]['write_reply'] 				= 1;
		$GroupsArray[7]['upload_attach'] 			= 1;
		$GroupsArray[7]['upload_attach_num'] 		= 1;
		$GroupsArray[7]['edit_own_subject'] 			= 1;
		$GroupsArray[7]['edit_own_reply'] 			= 1;
		$GroupsArray[7]['del_own_subject'] 			= 1;
		$GroupsArray[7]['del_own_reply'] 			= 1;
		$GroupsArray[7]['write_poll'] 				= 1;
		$GroupsArray[7]['vote_poll'] 				= 1;
		$GroupsArray[7]['no_posts'] 				= 1;
		$GroupsArray[7]['use_pm'] 					= 1;
		$GroupsArray[7]['send_pm'] 					= 1;
		$GroupsArray[7]['resive_pm'] 				= 1;
		$GroupsArray[7]['max_pm'] 					= 0;
		$GroupsArray[7]['min_send_pm'] 				= 0;
		$GroupsArray[7]['sig_allow'] 				= 1;
		$GroupsArray[7]['sig_len']					= 3000;
		$GroupsArray[7]['group_mod'] 				= 0;
		$GroupsArray[7]['del_subject'] 				= 0;
		$GroupsArray[7]['del_reply'] 				= 0;
		$GroupsArray[7]['edit_subject'] 				= 0;
		$GroupsArray[7]['edit_reply'] 				= 0;
		$GroupsArray[7]['stick_subject'] 			= 0;
		$GroupsArray[7]['unstick_subject'] 			= 0;
		$GroupsArray[7]['close_subject'] 			= 0;
		$GroupsArray[7]['usercp_allow'] 				= 0;
		$GroupsArray[7]['admincp_allow'] 			= 1;
		$GroupsArray[7]['search_allow'] 				= 1;
		$GroupsArray[7]['memberlist_allow'] 			= 1;
		$GroupsArray[7]['vice'] 						= 0;
		$GroupsArray[7]['show_hidden'] 				= 1;
		$GroupsArray[7]['hide_allow'] 				= 1;
		$GroupsArray[7]['view_usernamestyle'] 		= 1;
		$GroupsArray[7]['usertitle_change'] 			= 0;
		$GroupsArray[7]['onlinepage_allow'] 			= 1;
		$GroupsArray[7]['allow_see_offstyles'] 		= 0;
		$GroupsArray[7]['admincp_section'] 			= 1;
		$GroupsArray[7]['admincp_option'] 			= 1;
		$GroupsArray[7]['admincp_member'] 			= 1;
		$GroupsArray[7]['admincp_membergroup'] 		= 0;
		$GroupsArray[7]['admincp_membertitle'] 		= 1;
		$GroupsArray[7]['admincp_admin'] 			= 0;
		$GroupsArray[7]['admincp_adminstep'] 		= 1;
		$GroupsArray[7]['admincp_subject'] 			= 1;
		$GroupsArray[7]['admincp_database'] 			= 0;
		$GroupsArray[7]['admincp_fixup'] 			= 1;
		$GroupsArray[7]['admincp_ads'] 				= 1;
		$GroupsArray[7]['admincp_template'] 			= 0;
		$GroupsArray[7]['admincp_adminads'] 			= 1;
		$GroupsArray[7]['admincp_attach'] 			= 0;
		$GroupsArray[7]['admincp_page'] 				= 1;
		$GroupsArray[7]['admincp_block'] 			= 1;
		$GroupsArray[7]['admincp_style'] 			= 0;
		$GroupsArray[7]['admincp_toolbox'] 			= 1;
		$GroupsArray[7]['admincp_smile'] 			= 1;
		$GroupsArray[7]['admincp_icon'] 				= 1;
		$GroupsArray[7]['admincp_avater'] 			= 1;
		$GroupsArray[7]['group_order'] 				= 2;
		$GroupsArray[7]['admincp_contactus'] 		= 0;
		$GroupsArray[7]['can_warned'] 		        = 0;
		$GroupsArray[7]['send_warning'] 		    = 1;
        $GroupsArray[7]['visitormessage'] 	     	= 1;
        $GroupsArray[7]['see_who_on_topic'] 	    = 1;
        $GroupsArray[7]['reputation_number'] 	    = 50;
        $GroupsArray[7]['admincp_chat'] 	        = 0;
        $GroupsArray[7]['admincp_extrafield'] 	    = 0;
        $GroupsArray[7]['admincp_lang'] 	        = 0;
        $GroupsArray[7]['admincp_emailed'] 	        = 0;
        $GroupsArray[7]['admincp_warn'] 	        = 0;
        $GroupsArray[7]['admincp_award'] 	        = 0;
        $GroupsArray[7]['admincp_multi_moderation'] = 0;
        $GroupsArray[7]['topic_day_number'] 	    = 0;
        $GroupsArray[7]['groups_security'] 	        = 1;
        $GroupsArray[7]['profile_photo'] 	        = 1;

		$GroupArray = $PowerBB->functions->CleanVariable($GroupArray,'sql');

		$x = 0;
		$i = array();

		while ($x < sizeof($GroupsArray))
		{
			$insert = $PowerBB->DB->sql_query("INSERT INTO " . $PowerBB->table['group'] . " SET
											id='" . $GroupsArray[$x]['id'] . "',
											title='" . $GroupsArray[$x]['title'] . "',
											username_style='" . $GroupsArray[$x]['username_style'] . "',
											user_title='" . $GroupsArray[$x]['user_title'] . "',
											forum_team='" . $GroupsArray[$x]['forum_team'] . "',
											banned='" . $GroupsArray[$x]['banned'] . "',
											view_section='" . $GroupsArray[$x]['view_section'] . "',
											view_subject='" . $GroupsArray[$x]['view_subject'] . "',
											download_attach='" . $GroupsArray[$x]['download_attach'] . "',
											download_attach_number='" . $GroupsArray[$x]['download_attach_number'] . "',
											write_subject='" . $GroupsArray[$x]['write_subject'] . "',
											write_reply='" . $GroupsArray[$x]['write_reply'] . "',
											upload_attach='" . $GroupsArray[$x]['upload_attach'] . "',
											upload_attach_num='" . $GroupsArray[$x]['upload_attach_num'] . "',
											edit_own_subject='" . $GroupsArray[$x]['edit_own_subject'] . "',
											edit_own_reply='" . $GroupsArray[$x]['edit_own_reply'] . "',
											del_own_subject='" . $GroupsArray[$x]['del_own_subject'] . "',
											del_own_reply='" . $GroupsArray[$x]['del_own_reply'] . "',
											write_poll='" . $GroupsArray[$x]['write_poll'] . "',
											vote_poll='" . $GroupsArray[$x]['vote_poll'] . "',
											no_posts='" . $GroupsArray[$x]['no_posts'] . "',
											use_pm='" . $GroupsArray[$x]['use_pm'] . "',
											send_pm='" . $GroupsArray[$x]['send_pm'] . "',
											resive_pm='" . $GroupsArray[$x]['resive_pm'] . "',
											max_pm='" . $GroupsArray[$x]['max_pm'] . "',
											min_send_pm='" . $GroupsArray[$x]['min_send_pm'] . "',
											sig_allow='" . $GroupsArray[$x]['sig_allow'] . "',
											sig_len='" . $GroupsArray[$x]['sig_len'] . "',
											group_mod='" . $GroupsArray[$x]['group_mod'] . "',
											del_subject='" . $GroupsArray[$x]['del_subject'] . "',
											del_reply='" . $GroupsArray[$x]['del_reply'] . "',
											edit_subject='" . $GroupsArray[$x]['edit_subject'] . "',
											edit_reply='" . $GroupsArray[$x]['edit_reply'] . "',
											stick_subject='" . $GroupsArray[$x]['stick_subject'] . "',
											unstick_subject='" . $GroupsArray[$x]['unstick_subject'] . "',
											close_subject='" . $GroupsArray[$x]['close_subject'] . "',
											usercp_allow='" . $GroupsArray[$x]['usercp_allow'] . "',
											admincp_allow='" . $GroupsArray[$x]['admincp_allow'] . "',
											search_allow='" . $GroupsArray[$x]['search_allow'] . "',
											memberlist_allow='" . $GroupsArray[$x]['memberlist_allow'] . "',
											vice='" . $GroupsArray[$x]['vice'] . "',
											show_hidden='" . $GroupsArray[$x]['show_hidden'] . "',
											hide_allow='" . $GroupsArray[$x]['hide_allow'] . "',
											view_usernamestyle='" . $GroupsArray[$x]['view_usernamestyle'] . "',
											usertitle_change='" . $GroupsArray[$x]['usertitle_change'] . "',
											onlinepage_allow='" . $GroupsArray[$x]['onlinepage_allow'] . "',
											allow_see_offstyles='" . $GroupsArray[$x]['allow_see_offstyles'] . "',
											can_warned='" . $GroupsArray[$x]['can_warned'] . "',
											send_warning='" . $GroupsArray[$x]['send_warning'] . "',
											admincp_section='" . $GroupsArray[$x]['admincp_section'] . "',
											admincp_option='" . $GroupsArray[$x]['admincp_option'] . "',
											admincp_member='" . $GroupsArray[$x]['admincp_member'] . "',
											admincp_membergroup='" . $GroupsArray[$x]['admincp_membergroup'] . "',
											admincp_membertitle='" . $GroupsArray[$x]['admincp_membertitle'] . "',
											admincp_admin='" . $GroupsArray[$x]['admincp_admin'] . "',
											admincp_adminstep='" . $GroupsArray[$x]['admincp_adminstep'] . "',
											admincp_subject='" . $GroupsArray[$x]['admincp_subject'] . "',
											admincp_database='" . $GroupsArray[$x]['admincp_database'] . "',
											admincp_fixup='" . $GroupsArray[$x]['admincp_fixup'] . "',
											admincp_ads='" . $GroupsArray[$x]['admincp_ads'] . "',
											admincp_template='" . $GroupsArray[$x]['admincp_template'] . "',
											admincp_adminads='" . $GroupsArray[$x]['admincp_adminads'] . "',
											admincp_attach='" . $GroupsArray[$x]['admincp_attach'] . "',
											admincp_page='" . $GroupsArray[$x]['admincp_page'] . "',
											admincp_style='" . $GroupsArray[$x]['admincp_style'] . "',
											admincp_toolbox='" . $GroupsArray[$x]['admincp_toolbox'] . "',
											admincp_smile='" . $GroupsArray[$x]['admincp_smile'] . "',
											admincp_icon='" . $GroupsArray[$x]['admincp_icon'] . "',
											admincp_avater='" . $GroupsArray[$x]['admincp_avater'] . "',
											group_order='" . $GroupsArray[$x]['group_order'] . "',
											visitormessage='" . $GroupsArray[$x]['visitormessage'] . "',
											see_who_on_topic='" . $GroupsArray[$x]['see_who_on_topic'] . "',
											reputation_number='" . $GroupsArray[$x]['reputation_number'] . "',
											admincp_chat='" . $GroupsArray[$x]['admincp_chat'] . "',
											admincp_extrafield='" . $GroupsArray[$x]['admincp_extrafield'] . "',
											admincp_lang='" . $GroupsArray[$x]['admincp_lang'] . "',
											admincp_emailed='" . $GroupsArray[$x]['admincp_emailed'] . "',
											admincp_warn='" . $GroupsArray[$x]['admincp_warn'] . "',
											admincp_award='" . $GroupsArray[$x]['admincp_award'] . "',
											admincp_multi_moderation='" . $GroupsArray[$x]['admincp_multi_moderation'] . "',
											topic_day_number='" . $GroupsArray[$x]['topic_day_number'] . "',
											groups_security='" . $GroupsArray[$x]['groups_security'] . "',
											profile_photo='" . $GroupsArray[$x]['profile_photo'] . "',
											admincp_contactus='" . $GroupsArray[$x]['admincp_contactus'] . "'");

			$i[$x] = ($insert) ? 'true' : 'false';

			$x += 1;

		}

		return $i;
	}

	function _CreateInfo()
	{
		global $PowerBB;

		$this->_TempArr['CreateArr']				= 	array();
		$this->_TempArr['CreateArr']['table_name'] 	= 	$PowerBB->table['info'];
		$this->_TempArr['CreateArr']['fields'] 		= 	array();
		$this->_TempArr['CreateArr']['fields'][] 	= 	'id INT( 9 ) NOT NULL AUTO_INCREMENT PRIMARY KEY';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'var_name VARCHAR( 255 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'value text NOT NULL';

		$create = $this->create_table($this->_TempArr['CreateArr']);

		return ($create) ? true : false;
	}

	function _InsertInfo()
	{
		global $PowerBB;
        include("../lang/".$PowerBB->_GET['lang']."/language.php");

		$InfoArray 								= array();
		$InfoArray['title'] 					= '';
		$InfoArray['show_onlineguest'] 			= 0;
		$InfoArray['perpage'] 					= 12;
		$InfoArray['subject_perpage'] 			= 12;
		$InfoArray['show_subject_all'] 			= 0;
		$InfoArray['send_email'] 				= '';
		$InfoArray['avatar_perpage'] 			= 18;
		$InfoArray['admin_email'] 				= '';
		$InfoArray['MySBB_version'] 			= '3.0.2';
		$InfoArray['Sat'] 						= 1;
		$InfoArray['Sun'] 						= 1;
		$InfoArray['Mon'] 						= 1;
		$InfoArray['Tue'] 						= 1;
		$InfoArray['Wed'] 						= 1;
		$InfoArray['Thu'] 						= 1;
		$InfoArray['Fri'] 						= 1;
		$InfoArray['fastreply_allow'] 			= 1;
		$InfoArray['download_path'] 			= 'download';
		$InfoArray['def_group'] 				= 4;
		$InfoArray['adef_group'] 				= 4;
		if ($PowerBB->_GET['lang']=='en')
		{
		$InfoArray['def_style'] 				= 2;
		}
		else
		{
		$InfoArray['def_style'] 				= 1;
		}
		$InfoArray['board_close'] 				= 0;
		$InfoArray['board_msg'] 				= '';
		$InfoArray['use_list'] 					= 'xa-4c4700355e83e612';
		$InfoArray['supermember_logs'] 			= 0;
		$InfoArray['page_max'] 					= 5;
		$InfoArray['reg_o'] 					= 1;
		$InfoArray['captcha_o'] 					= 1;
		$InfoArray['time_out'] 					= 1440;
		$InfoArray['samesubject_show'] 			= 1;
		$InfoArray['reg_less_num'] 				= 3;
		$InfoArray['reg_max_num'] 				= 25;
		$InfoArray['reg_pass_min_num'] 			= 5;
		$InfoArray['reg_pass_max_num'] 			= 25;
		$InfoArray['post_text_min'] 			= 5;
		$InfoArray['post_text_max'] 			= 30000;
		$InfoArray['post_title_min'] 			= 4;
		$InfoArray['post_title_max'] 			= 99;
		$InfoArray['upload_avatar'] 			= 1;
		$InfoArray['max_avatar_width'] 			= 150;
		$InfoArray['max_avatar_height'] 		= 150;
		$InfoArray['reg_close'] 				= 0;
		$InfoArray['msg_title_temp'] 			= '';
		$InfoArray['msg_content_temp'] 			= '';
		$InfoArray['confirm_on_change_mail'] 	= 0;
		$InfoArray['confirm_on_change_pass'] 	= 0;
		$InfoArray['allow_avatar'] 				= 1;
		$InfoArray['allow_apsent'] 				= 1;
		$InfoArray['ads_num'] 					= 0;
		$InfoArray['smiles_cache'] 				= '';
		$InfoArray['forums_cache'] 				= '';
		$InfoArray['subforums_cache'] 			= '';
		$InfoArray['sectiongroup_cache'] 		= '';
		$InfoArray['subject_number'] 			= 0;
		$InfoArray['reply_number'] 				= 0;
		$InfoArray['member_number'] 			= 0;
		$InfoArray['last_member'] 				= '';
		$InfoArray['last_member_id'] 			= 0;
		$InfoArray['floodctrl'] 				= 30;
	    $InfoArray['description'] 				= $lang['description'];
		$InfoArray['keywords'] 				    = $lang['keywords'];
		if ($PowerBB->_GET['lang']=='en')
		{
		      $InfoArray['content_language'] 			= 'en';
		      $InfoArray['content_dir'] 			    = 'ltr';
		      $InfoArray['lasts_posts_bar_dir']	    = 'left';
		      $InfoArray['special_bar_dir']	        = 'left';
		      $InfoArray['max_online_date'] 		    = date("d/m/Y h:i a");
		      $InfoArray['chat_bar_dir'] 		        = 'left';
              $InfoArray['def_lang']			    	= '2';
		}
		else
		{
		      $InfoArray['content_language'] 			= 'ar';
		      $InfoArray['content_dir'] 			    = 'rtl';
		      $InfoArray['lasts_posts_bar_dir']	    = 'right';
		      $InfoArray['special_bar_dir']	        = 'right';
		      $InfoArray['max_online_date'] 		    = date("d/m/Y الساعة h:i a");
		      $InfoArray['chat_bar_dir'] 		        = 'right';
              $InfoArray['def_lang']			    	= '1';

		}
	    $InfoArray['charset'] 			        = 'utf-8';
		$InfoArray['toolbox_show'] 				= 1;
		$InfoArray['smiles_show'] 				= 1;
		$InfoArray['icons_show'] 				= 1;
		$InfoArray['title_quote'] 				= 1;
		$InfoArray['close_stick_activate'] 		= 1;
		$InfoArray['timestamp'] 				= '0';
		$InfoArray['timesystem'] 				= 'h:i A';
		$InfoArray['online_now_section'] 		= 1;
		$InfoArray['online_now_subject'] 		= 1;
		$InfoArray['resize_imagesAllow'] 		= 1;
		$InfoArray['default_imagesW'] 			= 400;
		$InfoArray['default_imagesH'] 			= 600;
		$InfoArray['wordwrap'] 			        = '50';
		$InfoArray['create_date'] 				= '';
		$InfoArray['icon_path'] 				= 'look/images/icons/';
		// Since OMEGA 5
		$InfoArray['sectiongroup_number']		= 0;
		$InfoArray['subsections_number']		= 0;
		$InfoArray['sections_number']			= 0;
		$InfoArray['smiles_number']				= 0;
		// Since OMEGA 6
		$InfoArray['today_date_cache']			= 0;
		$InfoArray['today_number_cache']		= 0;
		$InfoArray['adress_bar_separate']		= '&raquo;';
		// Since THETA 1
		$InfoArray['ajax_search']				= 0;
		$InfoArray['ajax_register']				= 0;
		$InfoArray['ajax_freply']				= 0;
		$InfoArray['get_group_username_style']	= 0;
		// Since THETA 2 (ALPHA 3)
		$InfoArray['ajax_moderator_options']	= 0;
		$InfoArray['reg_Sat'] 					= 1;
		$InfoArray['reg_Sun'] 					= 1;
		$InfoArray['reg_Mon'] 					= 1;
		$InfoArray['reg_Tue'] 					= 1;
		$InfoArray['reg_Wed'] 					= 1;
		$InfoArray['reg_Thu'] 					= 1;
		$InfoArray['reg_Fri'] 					= 1;
		$InfoArray['admin_notes']				= '';
		$InfoArray['pm_feature']				= 1;
		$InfoArray['default_avatar'] 			= 'default_avatar.gif';
		$InfoArray['no_describe']				= 1;
		$InfoArray['no_moderators']				= 1;
		$InfoArray['no_sub']				    = 1;
		$InfoArray['warning_number_to_ban'] 	= '10';
		$InfoArray['members_send_pm']   	    = '7';
		// (2.0.0)
		$InfoArray['activate_last_static_list'] = '0';
		$InfoArray['last_static_num']	        = '5';
		$InfoArray['last_posts_static_num']	    = '10';
		$InfoArray['forum_id_not_in_static']	= '0';
		$InfoArray['activate_lasts_posts_bar']	= '0';
		$InfoArray['forum_id_not_in_lasts_posts_bar']	    = '0';
		$InfoArray['lasts_posts_bar_num']	    = '10';
		$InfoArray['activate_special_bar']	    = '0';
		$InfoArray['subject_describe_show'] 			= 1;
		$InfoArray['rules']	                     = $lang['rules'];
		$InfoArray['censorwords']	             = 'equiv';
		// 2.0.2
		$InfoArray['activate_closestick'] 			= 1;
		$InfoArray['reputationallw'] 				= 1;
		$InfoArray['show_reputation_number'] 		= '10';
		$InfoArray['show_rating_num_max'] 		    = '5';
		$InfoArray['rating_show'] 		            = '1';
		// 2.0.3
		$InfoArray['max_online'] 		            = '1';
		$InfoArray['smiles_nm'] 		                = '12';
		$InfoArray['random_ads'] 		            = '0';
		$InfoArray['show_ads'] 		                = '1';
		$InfoArray['show_online_list_today'] 	    = '0';
		$InfoArray['show_list_last_5_posts_member'] 	= '0';
		$InfoArray['last_subject_writer_nm'] 		= '5';
		$InfoArray['last_subject_writer_not_in']     = '0';
		$InfoArray['activate_chat_bar'] 		        = '0';
		$InfoArray['chat_message_num'] 		        = '10';
		$InfoArray['chat_num_mem_posts'] 		    = '5';
		$InfoArray['chat_num_characters'] 		    = '650';
		$InfoArray['chat_hide_country'] 		        = '0';
		// 2.0.4
		$InfoArray['characters_keyword_search'] 		= '4';
		$InfoArray['flood_search'] 				    = 40;
		$InfoArray['allowed_emailed'] 		        = '1';
		$InfoArray['allowed_emailed_pm'] 		    = '1';
		$InfoArray['rewriterule'] 		            = '1';
		$InfoArray['sitemap'] 		                = '1';
		// 2.0.5
		$InfoArray['allowed_powered'] 		        = '1';
		// 2.1.0
		$InfoArray['visitor_message_chars'] 		    = '8000';
		$InfoArray['active_addons'] 		            = '1';
		$InfoArray['haid_links_for_guest'] 		    = '0';
		$InfoArray['guest_message_for_haid_links'] 	= $lang['guest_message_for_haid_links'];
		$InfoArray['add_tags_automatic'] 	= '0';
		// 2.1.1
		$InfoArray['mailer'] 		               = 'phpmail';
		$InfoArray['smtp_secure'] 				   = 'TLS';
		$InfoArray['smtp_port'] 		               = '25';
		$InfoArray['smtp_server'] 		           = '';
		$InfoArray['smtp_username'] 		           = '';
		$InfoArray['smtp_password'] 		           = '';
		$InfoArray['mor_hours_online_today'] 	   = '0';
		$InfoArray['mor_seconds_online'] 		   = '300';
		$InfoArray['sub_columns_number'] 		   = '2';
		$InfoArray['icon_columns_number'] 		   = '6';
		$InfoArray['smil_columns_number'] 		   = '3';
		$InfoArray['avatar_columns_number'] 		   = '6';
		$InfoArray['icons_numbers'] 		           = '12';
		$InfoArray['datesystem'] 			       = 'd-m-Y';
		$InfoArray['timeoffset'] 			       = 'Asia/Riyadh';
		$InfoArray['active_forum_online_number']	   = '0';
		$InfoArray['active_birth_date']	   = '1';
		$InfoArray['active_worms_pbb']	   = '0';
		$InfoArray['shelluser']	   = '';
		$InfoArray['shellpswd']	   = '';
		$InfoArray['shelladminemail']	   = '';
		// 2.1.3
		$InfoArray['active_like_facebook']	   = '0';
		$InfoArray['active_add_this']	   = '0';
		$InfoArray['active_visitor_message']	   = '1';
		$InfoArray['active_friend']	   = '1';
		$InfoArray['active_archive']	   = '1';
		$InfoArray['active_calendar']	   = '1';
		$InfoArray['active_send_admin_message']	   = '1';
		$InfoArray['active_reply_today']	   = '1';
		$InfoArray['active_subject_today']	   = '1';
		$InfoArray['active_static']	   = '1';
		$InfoArray['active_team']	   = '1';
		$InfoArray['active_rss']	   = '1';
		// 2.1.4
		$InfoArray['title_portal']	   = 'PBB Portal';
		$InfoArray['active_portal']	   = '1';
		$InfoArray['portal_section_news']	   = '2';
		$InfoArray['portal_columns']	   = '3';
		$InfoArray['portal_news_num']	   = '4';
		$InfoArray['portal_news_along']	   = '300';
		// 3.0.0
		$InfoArray['cssprefs']	   = 'PBBoard_1_Default';
		$InfoArray['captcha_type']	   = 'captcha_IMG';
		$InfoArray['questions']	   = '';
		$InfoArray['answers']	   = '';
		$InfoArray['adsense_limited_sections']	   = '9,8';
		$InfoArray['activ_welcome_message']	   = '0';
		$InfoArray['welcome_message_text']	   = $lang['welcome_message_text'];
		$InfoArray['welcome_message_mail_or_private']	   = '3';
		$InfoArray['num_entries_error']	   = '7';
		$InfoArray['style_block_latest_news']	   = '1';
		$InfoArray['search_engine_spiders']	   = "Googlebot,Yahoo!,msnbot,Googlebot-Image,Gaisbot,GalaxyBot,msnbot,Rambler,AbachoBOT,accoona,AcoiRobot,ASPSeek,CrocCrawler,Dumbot,FAST-WebCrawler,GeonaBot,Lycos,MSRBOT,Scooter,AltaVista,IDBot,eStyle,Scrubby";
        // 3.0.1
        $InfoArray['users_ratings_cache']	   = 'a:6:{i:0;a:3:{s:2:"id";s:1:"1";s:6:"rating";s:31:"look/images/rating/rating_0.gif";s:5:"posts";s:2:"10";}i:1;a:3:{s:2:"id";s:1:"2";s:6:"rating";s:31:"look/images/rating/rating_1.gif";s:5:"posts";s:2:"20";}i:2;a:3:{s:2:"id";s:1:"3";s:6:"rating";s:31:"look/images/rating/rating_2.gif";s:5:"posts";s:2:"40";}i:3;a:3:{s:2:"id";s:1:"4";s:6:"rating";s:31:"look/images/rating/rating_3.gif";s:5:"posts";s:3:"400";}i:4;a:3:{s:2:"id";s:1:"5";s:6:"rating";s:31:"look/images/rating/rating_4.gif";s:5:"posts";s:3:"600";}i:5;a:3:{s:2:"id";s:1:"6";s:6:"rating";s:31:"look/images/rating/rating_5.gif";s:5:"posts";s:4:"6000";}}';
        $InfoArray['users_titles_cache']	   = 'a:5:{i:0;a:3:{s:2:"id";s:1:"1";s:9:"usertitle";s:6:"Ø¹Ø¶Ùˆ";s:5:"posts";s:1:"0";}i:1;a:3:{s:2:"id";s:1:"3";s:9:"usertitle";s:17:"Ø¹Ø¶Ùˆ Ù…Ø´Ø§Ø±Ùƒ";s:5:"posts";s:2:"10";}i:2;a:3:{s:2:"id";s:1:"4";s:9:"usertitle";s:15:"Ø¹Ø¶Ùˆ ÙØ¹Ø§Ù„";s:5:"posts";s:2:"20";}i:3;a:3:{s:2:"id";s:1:"5";s:9:"usertitle";s:17:"Ø¹Ø¶Ùˆ Ù…Ø³Ø§Ù‡Ù…";s:5:"posts";s:2:"30";}i:4;a:3:{s:2:"id";s:1:"6";s:9:"usertitle";s:15:"Ø¹Ø¶Ùˆ Ø±Ø§Ø¦Ø¹";s:5:"posts";s:2:"90";}}';
        // 3.0.2
		$InfoArray['users_security']	   = '1';
		$InfoArray['sidebar_list_active']	   = '1';
		$InfoArray['sidebar_list_align']	   = 'left';
		$InfoArray['sidebar_list_pages']	   = 'index';
		$InfoArray['sidebar_list_width']	   = '25';
		$InfoArray['sidebar_list_exclusion_forums']	   = '254,545';
		$InfoArray['sidebar_list_content']	   = "{template}login_box{/template}\n{template}whatis_new{/template}";
		$InfoArray['last_posts_cache']	   = '';
		$InfoArray['last_time_cache']	   = time();
		$InfoArray['groups_cache'] 		= '';
		$InfoArray['custom_bbcodes_list_cache'] 		= '';
		$InfoArray['rss_feeds_cache'] 		= '';
		$InfoArray['extrafields_cache'] 		= '';
		$InfoArray['awards_cache'] 		= '';
		$InfoArray['pages_cache'] 		= '';
		$InfoArray['adsenses_cache'] 		= '';
		$InfoArray['languages_list_cache'] 		= '';
		$InfoArray['styles_list_cache'] 		= '';
		$InfoArray['p_cache'] 		= '';
		$InfoArray['last_time_updates']	   = time();
		if ($PowerBB->_GET['lang']=='en')
		{
		$InfoArray['mobile_style_id'] 				= 2;
		}
		else
		{
		$InfoArray['mobile_style_id'] 				= 1;
		}
		$x = 0;
		$i = array();

		foreach ($InfoArray as $k => $v)
		{
			$insert = $PowerBB->DB->sql_query("INSERT INTO " . $PowerBB->table['info'] . " SET var_name='" . $k . "',value='" . $v . "'");

			$i[$x] = ($insert) ? 'true' : 'false';

			$x += 1;
		}

		return $i;
	}

	function _CreateMember()
	{
		global $PowerBB;

		$this->_TempArr['CreateArr']				= 	array();
		$this->_TempArr['CreateArr']['table_name'] 	= 	$PowerBB->table['member'];
		$this->_TempArr['CreateArr']['fields'] 		= 	array();
		$this->_TempArr['CreateArr']['fields'][] 	= 	'id INT( 9 ) NOT NULL AUTO_INCREMENT PRIMARY KEY';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'username VARCHAR( 200 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'password VARCHAR( 200 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'email VARCHAR( 200 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'usergroup INT( 9 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	"membergroupids CHAR( 250 ) NOT NULL";
		$this->_TempArr['CreateArr']['fields'][] 	= 	'user_notes mediumtext NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'user_sig mediumtext NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'user_country varchar(100) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'user_gender char(1) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'user_website varchar(100) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'lastvisit varchar(10) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'user_time varchar(6) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'register_date varchar(100) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'posts int(9) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'user_title varchar(200) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'visitor int(9) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'user_info varchar(255) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'avater_path varchar(255) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'away int(1) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'away_msg varchar(255) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'new_password varchar(200) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'new_email varchar(200) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'active_number varchar(90) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'style int(9) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'hide_online int(1) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	"send_allow int(1) NOT NULL DEFAULT '1'";
		$this->_TempArr['CreateArr']['fields'][] 	= 	'unread_pm int(9) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'lastpost_time varchar(15) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'keepmeon int(9) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'logged varchar(30) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'register_time varchar(50) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'style_cache TEXT NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'style_id_cache INT( 9 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'should_update_style_cache INT( 1 ) NOT NULL';
		// Since THETA 1
		$this->_TempArr['CreateArr']['fields'][] 	= 	'autoreply int(9) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'autoreply_title varchar(255) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'autoreply_msg text NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'pm_senders int( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'pm_senders_msg varchar( 255 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'member_ip varchar( 20 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'subject_sig mediumtext NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'reply_sig mediumtext NOT NULL';
		// Since ALPHA 3 (THETA 3)
		$this->_TempArr['CreateArr']['fields'][] 	= 	'username_style_cache varchar( 255 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'review_subject int( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'inviter VARCHAR( 200 ) NOT NULL';
        $this->_TempArr['CreateArr']['fields'][] 	= 	'invite_num INT( 9 ) NOT NULL';
        $this->_TempArr['CreateArr']['fields'][] 	= 	"warnings INT UNSIGNED NOT NULL DEFAULT '0'";
        $this->_TempArr['CreateArr']['fields'][] 	= 	"lang int(9) NOT NULL DEFAULT '1'";
        // 2.0.1
        $this->_TempArr['CreateArr']['fields'][] 	= 	'review_reply int( 1 ) NOT NULL';
        // 2.0.2
        $this->_TempArr['CreateArr']['fields'][] 	= 	"reputation INT UNSIGNED NOT NULL DEFAULT '10'";
        // 2.0.3
        $this->_TempArr['CreateArr']['fields'][] 	= 	'award VARCHAR( 250 ) NOT NULL';
        // 2.0.4
        $this->_TempArr['CreateArr']['fields'][] 	= 	'lastsearch_time varchar(15) NOT NULL';
        $this->_TempArr['CreateArr']['fields'][] 	= 	"pm_emailed int(1) NOT NULL DEFAULT '0'";
        $this->_TempArr['CreateArr']['fields'][] 	= 	"pm_window int(1) NOT NULL DEFAULT '1'";
       // 2.1.0 Beta
       $this->_TempArr['CreateArr']['fields'][] 	= 	"visitormessage int(1) NOT NULL DEFAULT '1'";
       // 2.1.1
       $this->_TempArr['CreateArr']['fields'][] 	= 	"bday_day INT( 2 ) NULL DEFAULT NULL";
       $this->_TempArr['CreateArr']['fields'][] 	= 	"bday_month INT( 2 ) NULL DEFAULT NULL";
       $this->_TempArr['CreateArr']['fields'][] 	= 	"bday_year INT( 4 ) NULL DEFAULT NULL";
       // 3.0.0
       $this->_TempArr['CreateArr']['fields'][] 	= 	"profile_viewers int(1) NOT NULL DEFAULT '1'";
       $this->_TempArr['CreateArr']['fields'][] 	= 	"style_sheet_profile LONGTEXT NOT NULL";
       // 3.0.2
       $this->_TempArr['CreateArr']['fields'][] 	= 	"send_security_code int(1) NOT NULL DEFAULT '0'";
       $this->_TempArr['CreateArr']['fields'][] 	= 	"send_security_error_login int(1) NOT NULL DEFAULT '0'";
       $this->_TempArr['CreateArr']['fields'][] 	= 	"profile_cover_photo VARCHAR( 255 ) NOT NULL";
       $this->_TempArr['CreateArr']['fields'][] 	= 	"profile_cover_photo_position VARCHAR( 255 ) NOT NULL";

		$create = $this->create_table($this->_TempArr['CreateArr']);

		return ($create) ? true : false;
	}

	function _CreateOnline()
	{
		global $PowerBB;

		$this->_TempArr['CreateArr']				= 	array();
		$this->_TempArr['CreateArr']['table_name'] 	= 	$PowerBB->table['online'];
		$this->_TempArr['CreateArr']['fields'] 		= 	array();
		$this->_TempArr['CreateArr']['fields'][] 	= 	'id INT( 9 ) NOT NULL AUTO_INCREMENT PRIMARY KEY';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'username varchar(255) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'path varchar(200) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'logged varchar(30) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'user_id int(9) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'user_ip varchar(30) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'hide_browse int(1) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'username_style varchar(255) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'user_location varchar(200) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'subject_show int(1) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'subject_id int(9) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'last_move varchar(30) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'section_id int(9) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'is_bot int(1) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'bot_name varchar(255) NOT NULL';

		$create = $this->create_table($this->_TempArr['CreateArr']);

		return ($create) ? true : false;
	}

	function _CreatePages()
	{
		global $PowerBB;

		$this->_TempArr['CreateArr']				= 	array();
		$this->_TempArr['CreateArr']['table_name'] 	= 	$PowerBB->table['pages'];
		$this->_TempArr['CreateArr']['fields'] 		= 	array();
		$this->_TempArr['CreateArr']['fields'][] 	= 	'id INT( 9 ) NOT NULL AUTO_INCREMENT PRIMARY KEY';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'title varchar(255) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'html_code longtext NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'sort INT( 9 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'link text NOT NULL';


		$create = $this->create_table($this->_TempArr['CreateArr']);

		return ($create) ? true : false;
	}

	function _CreatePrivateMassege()
	{
		global $PowerBB;

		$this->_TempArr['CreateArr']				= 	array();
		$this->_TempArr['CreateArr']['table_name'] 	= 	$PowerBB->table['pm'];
		$this->_TempArr['CreateArr']['fields'] 		= 	array();
		$this->_TempArr['CreateArr']['fields'][] 	= 	'id INT( 9 ) NOT NULL AUTO_INCREMENT PRIMARY KEY';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'title varchar(200) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'text text NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'user_from varchar(200) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'user_to varchar(200) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'user_read char(1) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'alarm char(1) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'date varchar(100) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'icon varchar(50) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'folder varchar(90) NOT NULL';

		$create = $this->create_table($this->_TempArr['CreateArr']);

		return ($create) ? true : false;
	}

	function _CreatePrivateMassegeFolder()
	{
		global $PowerBB;

		$this->_TempArr['CreateArr']				= 	array();
		$this->_TempArr['CreateArr']['table_name'] 	= 	$PowerBB->table['pm_folder'];
		$this->_TempArr['CreateArr']['fields'] 		= 	array();
		$this->_TempArr['CreateArr']['fields'][] 	= 	'id INT( 9 ) NOT NULL AUTO_INCREMENT PRIMARY KEY';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'folder_name varchar(50) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'username varchar(200) NOT NULL';

		$create = $this->create_table($this->_TempArr['CreateArr']);

		return ($create) ? true : false;
	}

	function _CreatePrivateMassegeLists()
	{
		global $PowerBB;

		$this->_TempArr['CreateArr']				= 	array();
		$this->_TempArr['CreateArr']['table_name'] 	= 	$PowerBB->table['pm_lists'];
		$this->_TempArr['CreateArr']['fields'] 		= 	array();
		$this->_TempArr['CreateArr']['fields'][] 	= 	'id INT( 9 ) NOT NULL AUTO_INCREMENT PRIMARY KEY';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'list_username varchar(200) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'username varchar(200) NOT NULL';

		$create = $this->create_table($this->_TempArr['CreateArr']);

		return ($create) ? true : false;
	}

	function _CreatePoll()
	{
		global $PowerBB;

		$this->_TempArr['CreateArr']				= 	array();
		$this->_TempArr['CreateArr']['table_name'] 	= 	$PowerBB->table['poll'];
		$this->_TempArr['CreateArr']['fields'] 		= 	array();
		$this->_TempArr['CreateArr']['fields'][] 	= 	'id INT( 9 ) NOT NULL AUTO_INCREMENT PRIMARY KEY';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'qus varchar(200) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'answers text NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'subject_id int(9) NOT NULL';

		$create = $this->create_table($this->_TempArr['CreateArr']);

		return ($create) ? true : false;
	}

	function _CreateReply()
	{
		global $PowerBB;

		$this->_TempArr['CreateArr']				= 	array();
		$this->_TempArr['CreateArr']['table_name'] 	= 	$PowerBB->table['reply'];
		$this->_TempArr['CreateArr']['fields'] 		= 	array();
		$this->_TempArr['CreateArr']['fields'][] 	= 	'id INT( 9 ) NOT NULL AUTO_INCREMENT PRIMARY KEY';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'title varchar(255) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'text mediumtext NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'writer varchar(200) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'subject_id int(9) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'stick int(1) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'close int(1) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'delete_topic int(1) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'section int(9) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'write_time varchar(15) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'icon varchar(50) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'action_by varchar(200) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'attach_reply int(1) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'actiondate varchar(50) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'keepmeon int(1) NOT NULL';
		// 2.0.1
        $this->_TempArr['CreateArr']['fields'][] 	= 	'review_reply int( 1 ) NOT NULL';
        // 2.0.3
        $this->_TempArr['CreateArr']['fields'][] 	= 	'last_time VARCHAR( 60 ) NOT NULL';
		// 2.0.5
		$this->_TempArr['CreateArr']['fields'][] 	= 	'reason_edit VARCHAR( 200 ) NOT NULL';

		$create = $this->create_table($this->_TempArr['CreateArr']);

		return ($create) ? true : false;
	}

	function _CreateRequests()
	{
		global $PowerBB;

		$this->_TempArr['CreateArr']				= 	array();
		$this->_TempArr['CreateArr']['table_name'] 	= 	$PowerBB->table['requests'];
		$this->_TempArr['CreateArr']['fields'] 		= 	array();
		$this->_TempArr['CreateArr']['fields'][] 	= 	'id INT( 9 ) NOT NULL AUTO_INCREMENT PRIMARY KEY';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'random_url varchar(26) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'username varchar(200) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'request_type int(1) NOT NULL';

		$create = $this->create_table($this->_TempArr['CreateArr']);

		return ($create) ? true : false;
	}

	function _CreateSection()
	{
		global $PowerBB;

		$this->_TempArr['CreateArr']				= 	array();
		$this->_TempArr['CreateArr']['table_name'] 	= 	$PowerBB->table['section'];
		$this->_TempArr['CreateArr']['fields'] 		= 	array();
		$this->_TempArr['CreateArr']['fields'][] 	= 	'id INT( 9 ) NOT NULL AUTO_INCREMENT PRIMARY KEY';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'title varchar(255) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'section_describe text NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'parent int(9) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'sort int(5) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'section_password varchar(50) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'show_sig int(1) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'use_power_code_allow int(1) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'section_picture varchar(200) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'sectionpicture_type int(1) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'use_section_picture int(1) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'linksection int(1) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'linkvisitor int(9) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'linksite varchar(200) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'subject_order int(1) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'hide_subject int(1) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'last_writer varchar(255) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'last_subject varchar(255) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'last_subjectid int(9) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'last_date varchar(11) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'sec_section int(1) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'sig_iteration int(1) NOT NULL';
		// Since OMEGA 5
		$this->_TempArr['CreateArr']['fields'][] 	= 	'subject_num int(9) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'reply_num int(9) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'forums_cache LONGTEXT NOT NULL';
		// Since THETA 1
		$this->_TempArr['CreateArr']['fields'][] 	= 	'moderators LONGTEXT NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'sectiongroup_cache LONGTEXT NOT NULL';
		// Since ALPHA 1
		$this->_TempArr['CreateArr']['fields'][] 	= 	'footer text NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'header text NOT NULL';
		// Since ALPHA 3
		$this->_TempArr['CreateArr']['fields'][] 	= 	'review_subject int(1) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'icon varchar(50) NOT NULL';
		// Since 2.0.3
		 $this->_TempArr['CreateArr']['fields'][] 	= 	'last_time VARCHAR( 60 ) NOT NULL';
		 $this->_TempArr['CreateArr']['fields'][] 	= 	'last_reply int(9) NOT NULL';
		 $this->_TempArr['CreateArr']['fields'][] 	= 	'last_berpage_nm int(9) NOT NULL';
		 // Since 2.1.1
		$this->_TempArr['CreateArr']['fields'][] 	= 	'prefix_subject text NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	"active_prefix_subject int(1) NOT NULL DEFAULT '0'";
		 // Since 2.1.3
		$this->_TempArr['CreateArr']['fields'][] 	= 	'forum_title_color varchar(7) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	"trash int(1) NOT NULL DEFAULT '0'";
		 // Since 3.0.0
		$this->_TempArr['CreateArr']['fields'][] 	= 	"subjects_review_num int(1) NOT NULL DEFAULT '0'";
		$this->_TempArr['CreateArr']['fields'][] 	= 	"replys_review_num int(1) NOT NULL DEFAULT '0'";

		$create = $this->create_table($this->_TempArr['CreateArr']);

		return ($create) ? true : false;
	}

	function _InsertSection()
	{
		global $PowerBB;
        include("../lang/".$PowerBB->_GET['lang']."/language.php");
		$Test_Category = $lang['A_Test_Category'];
		$Test_Forum = $lang['A_Test_Forum'];
		$section_describe = $lang['section_describe'];


		$SecArr 			= 	array();
		$SecArr['field']	=	array();

		$SecArr['field']['title'] 		= 	$Test_Category;
		$SecArr['field']['sort'] 		= 	'1';
		$SecArr['field']['parent'] 		= 	'0';
		$SecArr['get_id']				=	true;

		$insert = $PowerBB->section->InsertSection($SecArr);

		if ($insert)
		{
			$GroupArr 						= 	array();
			$GroupArr['order'] 				= 	array();
			$GroupArr['order']['field'] 	= 	'id';
			$GroupArr['order']['type'] 		= 	'ASC';

			$groups = $PowerBB->core->GetList($GroupArr,'group');

			$x = 0;
			$n = sizeof($groups);

			while ($x < $n)
			{
				$SecArr 				= 	array();
				$SecArr['field']		=	array();

				$SecArr['field']['section_id'] 			= 	'1';
				$SecArr['field']['group_id'] 			= 	$groups[$x]['id'];
				$SecArr['field']['view_section'] 		= 	$groups[$x]['view_section'];
				$SecArr['field']['view_subject'] 		= 	$groups[$x]['view_subject'];
				$SecArr['field']['download_attach'] 	= 	$groups[$x]['download_attach'];
				$SecArr['field']['write_subject'] 		= 	$groups[$x]['write_subject'];
				$SecArr['field']['write_reply'] 		= 	$groups[$x]['write_reply'];
				$SecArr['field']['upload_attach'] 		= 	$groups[$x]['upload_attach'];
				$SecArr['field']['edit_own_subject'] 	= 	$groups[$x]['edit_own_subject'];
				$SecArr['field']['edit_own_reply'] 		= 	$groups[$x]['edit_own_reply'];
				$SecArr['field']['del_own_subject'] 	= 	$groups[$x]['del_own_subject'];
				$SecArr['field']['del_own_reply'] 		= 	$groups[$x]['del_own_reply'];
				$SecArr['field']['write_poll'] 			= 	$groups[$x]['write_poll'];
				$SecArr['field']['vote_poll'] 			= 	$groups[$x]['vote_poll'];
				$SecArr['field']['no_posts'] 			= 	$groups[$x]['no_posts'];
				$SecArr['field']['main_section'] 		= 	1;
				$SecArr['field']['group_name'] 			= 	$groups[$x]['title'];

				$insert = $PowerBB->core->Insert($SecArr,'sectiongroup');

				$x += 1;
			}

            /*
			$CacheArr 			= 	array();
			$CacheArr['id'] 	= 	'1';

			$cache = $PowerBB->group->UpdateSectionGroupCache($CacheArr);
			$cache = $PowerBB->section->UpdateSectionsCache(array('parent'=>'0'));
            */
        }




		$SecArr 			= 	array();
		$SecArr['field']	=	array();

		$SecArr['field']['title'] 					= 	$Test_Forum;
		$SecArr['field']['sort'] 					= 	'1';
		$SecArr['field']['section_describe']		=	$section_describe;
		$SecArr['field']['parent']					=	'1';
		$SecArr['field']['show_sig']				=	1;
		$SecArr['field']['use_power_code_allow']		=	1;
		$SecArr['field']['subject_order']			=	1;
		$SecArr['field']['sectionpicture_type']		=	2;
		$SecArr['get_id']							=	true;

		$insertForum = $PowerBB->section->InsertSection($SecArr);

		//////////

	  	if ($insertForum)
		{
			//////////

			$SecArr 					= 	array();
			$SecArr['get_from']			=	'db';
			$SecArr['proc'] 			= 	array();
			$SecArr['proc']['*'] 		= 	array('method'=>'clean','param'=>'html');
			$SecArr['order']			=	array();
			$SecArr['order']['field']	=	'sort';
			$SecArr['order']['type']	=	'ASC';

			$SecArr['where']				=	array();
			$SecArr['where'][0]				=	array();
			$SecArr['where'][0]['name']		=	'parent';
			$SecArr['where'][0]['oper']		=	'<>';
			$SecArr['where'][0]['value']	=	'0';

			$SecList = $PowerBB->core->GetList($SecArr,'section');

			$x = 0;
			$y = sizeof($SecList);
			$s = array();

			while ($x < $y)
			{
				$name = 'order-' . $SecList[$x]['id'];

				if ($SecList[$x]['order'] != $Test_Forum)
				{
					$UpdateArr 						= 	array();

					$UpdateArr['field']		 		= 	array();
					$UpdateArr['field']['sort'] 	= 	'1';

					$UpdateArr['where'] 			=	array('id','2');

					$update = $PowerBB->core->Update($UpdateArr,'section');
                    /*
					if ($update)
					{
						$cache = $PowerBB->section->UpdateSectionsCache(array('parent'=>'1'));
					}
                    */
					$s[$SecList[$x]['id']] = ($update) ? 'true' : 'false';
				}

				$x += 1;
			}


				$GroupArr 						= 	array();
				$GroupArr['order'] 				= 	array();
				$GroupArr['order']['field'] 	= 	'id';
				$GroupArr['order']['type'] 		= 	'ASC';

				$groups = $PowerBB->core->GetList($GroupArr,'group');

				$x = 0;
				$n = sizeof($groups);

				while ($x < $n)
				{
					$SecArr 				= 	array();
					$SecArr['field']		=	array();


				$SecArr['field']['section_id'] 			= 	'2';
				$SecArr['field']['group_id'] 			= 	$groups[$x]['id'];
				$SecArr['field']['view_section'] 		= 	$groups[$x]['view_section'];
				$SecArr['field']['view_subject'] 		= 	$groups[$x]['view_section'];
				$SecArr['field']['download_attach'] 	= 	$groups[$x]['download_attach'];
				$SecArr['field']['write_subject'] 		= 	$groups[$x]['write_subject'];
				$SecArr['field']['write_reply'] 		= 	$groups[$x]['write_reply'];
				$SecArr['field']['upload_attach'] 		= 	$groups[$x]['upload_attach'];
				$SecArr['field']['edit_own_subject']	= 	$groups[$x]['edit_own_subject'];
				$SecArr['field']['edit_own_reply'] 		= 	$groups[$x]['edit_own_reply'];
				$SecArr['field']['del_own_subject'] 	= 	$groups[$x]['del_own_subject'];
				$SecArr['field']['del_own_reply'] 		= 	$groups[$x]['del_own_reply'];
				$SecArr['field']['write_poll'] 			= 	$groups[$x]['write_poll'];
				$SecArr['field']['no_posts'] 			= 	$groups[$x]['no_posts'];
				$SecArr['field']['vote_poll'] 			= 	$groups[$x]['vote_poll'];
				$SecArr['field']['main_section'] 		= 	0;
				$SecArr['field']['group_name'] 			= 	$groups[$x]['title'];

				$insert = $PowerBB->core->Insert($SecArr,'sectiongroup');


				unset($SecArr);

				if ($insert)
				{
					$success[] = $id;
				}
				else
				{
					$fail[] = $id;
				}

				unset($insert);

				$x += 1;
			}
            /*
			$CacheArr 			= 	array();
			$CacheArr['id'] 	= 	'2';

			$cache = $PowerBB->group->UpdateSectionGroupCache($CacheArr);
			$cache = $PowerBB->section->UpdateSectionsCache(array('parent'=>'1'));
            */
        }
		return ($insertForum) ? true : false;
	   }

	function _CreateSectionAdmin()
	{
		global $PowerBB;

		$this->_TempArr['CreateArr']				= 	array();
		$this->_TempArr['CreateArr']['table_name'] 	= 	$PowerBB->table['moderators'];
		$this->_TempArr['CreateArr']['fields'] 		= 	array();
		$this->_TempArr['CreateArr']['fields'][] 	= 	'id INT( 9 ) NOT NULL AUTO_INCREMENT PRIMARY KEY';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'section_id int(9) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'member_id int(9) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'username varchar(255) NOT NULL';

		$create = $this->create_table($this->_TempArr['CreateArr']);

		return ($create) ? true : false;
	}

	function _CreateSectionGroup()
	{
		global $PowerBB;

		$this->_TempArr['CreateArr']				= 	array();
		$this->_TempArr['CreateArr']['table_name'] 	= 	$PowerBB->table['section_group'];
		$this->_TempArr['CreateArr']['fields'] 		= 	array();
		$this->_TempArr['CreateArr']['fields'][] 	= 	'id INT( 9 ) NOT NULL AUTO_INCREMENT PRIMARY KEY';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'section_id int(9) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'group_id int(9) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'view_section int(1) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'view_subject int(1) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'download_attach int(1) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'write_subject int(1) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'write_reply int(1) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'upload_attach int(1) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'edit_own_subject int(1) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'edit_own_reply int(1)  NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'del_own_subject int(1) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'del_own_reply int(1) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'write_poll int(1) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'vote_poll int(1) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'no_posts int(1) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'main_section int(1) NOT NULL';
		// Since THETA 1
		$this->_TempArr['CreateArr']['fields'][] 	= 	'group_name varchar(255) NOT NULL';

		$create = $this->create_table($this->_TempArr['CreateArr']);

		return ($create) ? true : false;
	}

	function _CreateSmiles()
	{
		global $PowerBB;

		$this->_TempArr['CreateArr']				= 	array();
		$this->_TempArr['CreateArr']['table_name'] 	= 	$PowerBB->table['smiles'];
		$this->_TempArr['CreateArr']['fields'] 		= 	array();
		$this->_TempArr['CreateArr']['fields'][] 	= 	'id INT( 9 ) NOT NULL AUTO_INCREMENT PRIMARY KEY';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'smile_short varchar(15) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'smile_path varchar(255) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'smile_type int(1) NOT NULL';

		$create = $this->create_table($this->_TempArr['CreateArr']);

		return ($create) ? true : false;
	}

	function _InsertSmiles()
	{
		global $PowerBB;

		$SmilesArray = array();

		$SmilesArray[0] 					= 	array();
		$SmilesArray[0]['smile_short'] 		= 	':)';
		$SmilesArray[0]['smile_path'] 		= 	'look/images/smiles/smile.gif';
		$SmilesArray[0]['smile_type'] 		= 	'0';

		$SmilesArray[1] 					= 	array();
		$SmilesArray[1]['smile_short'] 		= 	';)';
		$SmilesArray[1]['smile_path'] 		= 	'look/images/smiles/wink_3.gif';
		$SmilesArray[1]['smile_type'] 		= 	'0';

		$SmilesArray[2] 					= 	array();
		$SmilesArray[2]['smile_short'] 		= 	':roll:';
		$SmilesArray[2]['smile_path'] 		= 	'look/images/smiles/rolleyes.gif';
		$SmilesArray[2]['smile_type'] 		= 	'0';

		$SmilesArray[3] 					= 	array();
		$SmilesArray[3]['smile_short'] 		= 	':D';
		$SmilesArray[3]['smile_path'] 		= 	'look/images/smiles/biggrin2.gif';
		$SmilesArray[3]['smile_type'] 		= 	'0';

		$SmilesArray[4] 					= 	array();
		$SmilesArray[4]['smile_short'] 		= 	':cool:';
		$SmilesArray[4]['smile_path'] 		= 	'look/images/smiles/cool.gif';
		$SmilesArray[4]['smile_type'] 		= 	'0';

		$SmilesArray[5] 					= 	array();
		$SmilesArray[5]['smile_short'] 		= 	':lol:';
		$SmilesArray[5]['smile_path'] 		= 	'look/images/smiles/laugh.gif';
		$SmilesArray[5]['smile_type'] 		= 	'0';

		$SmilesArray[6] 					= 	array();
		$SmilesArray[6]['smile_short'] 		= 	':(';
		$SmilesArray[6]['smile_path'] 		= 	'look/images/smiles/sad.gif';
		$SmilesArray[6]['smile_type'] 		= 	'0';

		$SmilesArray[7] 					= 	array();
		$SmilesArray[7]['smile_short'] 		= 	':mad:';
		$SmilesArray[7]['smile_path'] 		= 	'look/images/smiles/mad_1.gif';
		$SmilesArray[7]['smile_type'] 		= 	'0';

		$SmilesArray[8] 					= 	array();
		$SmilesArray[8]['smile_short'] 		= 	':#';
		$SmilesArray[8]['smile_path'] 		= 	'look/images/smiles/blushing.gif';
		$SmilesArray[8]['smile_type'] 		= 	'0';

		$SmilesArray[9] 					= 	array();
		$SmilesArray[9]['smile_short'] 		= 	':@@:';
		$SmilesArray[9]['smile_path'] 		= 	'look/images/smiles/blink.gif';
		$SmilesArray[9]['smile_type'] 		= 	'0';

		$SmilesArray[10] 					= 	array();
		$SmilesArray[10]['smile_short'] 	= 	':yes:';
		$SmilesArray[10]['smile_path'] 		= 	'look/images/smiles/yes.gif';
		$SmilesArray[10]['smile_type'] 		= 	'0';

		$SmilesArray[11] 					= 	array();
		$SmilesArray[11]['smile_short'] 	= 	':no:';
		$SmilesArray[11]['smile_path'] 		= 	'look/images/smiles/no_1.gif';
		$SmilesArray[11]['smile_type'] 		= 	'0';

		$SmilesArray[12] 					= 	array();
		$SmilesArray[12]['smile_short'] 	= 	':hmm:';
		$SmilesArray[12]['smile_path'] 		= 	'look/images/smiles/g.gif';
		$SmilesArray[12]['smile_type'] 		= 	'0';

		$SmilesArray[13] 					= 	array();
		$SmilesArray[13]['smile_short'] 	= 	'';
		$SmilesArray[13]['smile_path'] 		= 	'look/images/icons/bomb.gif';
		$SmilesArray[13]['smile_type'] 		= 	'1';

		$SmilesArray[14] 					= 	array();
		$SmilesArray[14]['smile_short'] 	= 	'';
		$SmilesArray[14]['smile_path'] 		= 	'look/images/icons/boxed.gif';
		$SmilesArray[14]['smile_type'] 		= 	'1';

		$SmilesArray[15] 					= 	array();
		$SmilesArray[15]['smile_short'] 	= 	'';
		$SmilesArray[15]['smile_path'] 		= 	'look/images/icons/bye2.gif';
		$SmilesArray[15]['smile_type'] 		= 	'1';

		$SmilesArray[16] 					= 	array();
		$SmilesArray[16]['smile_short'] 	= 	'';
		$SmilesArray[16]['smile_path'] 		= 	'look/images/icons/clap_1.gif';
		$SmilesArray[16]['smile_type'] 		= 	'1';

		$SmilesArray[17] 					= 	array();
		$SmilesArray[17]['smile_short'] 	= 	'';
		$SmilesArray[17]['smile_path'] 		= 	'look/images/icons/coffee.gif';
		$SmilesArray[17]['smile_type'] 		= 	'1';

		$SmilesArray[18] 					= 	array();
		$SmilesArray[18]['smile_short'] 	= 	'';
		$SmilesArray[18]['smile_path'] 		= 	'look/images/icons/cry.gif';
		$SmilesArray[18]['smile_type'] 		= 	'1';

		$SmilesArray[19] 					= 	array();
		$SmilesArray[19]['smile_short'] 	= 	'';
		$SmilesArray[19]['smile_path'] 		= 	'look/images/icons/cupidarrow.gif';
		$SmilesArray[19]['smile_type'] 		= 	'1';

		$SmilesArray[20] 					= 	array();
		$SmilesArray[20]['smile_short'] 	= 	'';
		$SmilesArray[20]['smile_path'] 		= 	'look/images/icons/devil_2.gif';
		$SmilesArray[20]['smile_type'] 		= 	'1';

		$SmilesArray[21] 					= 	array();
		$SmilesArray[21]['smile_short'] 	= 	'';
		$SmilesArray[21]['smile_path'] 		= 	'look/images/icons/g.gif';
		$SmilesArray[21]['smile_type'] 		= 	'1';

		$SmilesArray[22] 					= 	array();
		$SmilesArray[22]['smile_short'] 	= 	'';
		$SmilesArray[22]['smile_path'] 		= 	'look/images/icons/icecream.gif';
		$SmilesArray[22]['smile_type'] 		= 	'1';

		$SmilesArray[23] 					= 	array();
		$SmilesArray[23]['smile_short'] 	= 	'';
		$SmilesArray[23]['smile_path'] 		= 	'look/images/icons/king.gif';
		$SmilesArray[23]['smile_type'] 		= 	'1';

		$SmilesArray[24] 					= 	array();
		$SmilesArray[24]['smile_short'] 	= 	'';
		$SmilesArray[24]['smile_path'] 		= 	'look/images/icons/lock.gif';
		$SmilesArray[24]['smile_type'] 		= 	'1';

		$SmilesArray[25] 					= 	array();
		$SmilesArray[25]['smile_short'] 	= 	'';
		$SmilesArray[25]['smile_path'] 		= 	'look/images/icons/marsa117.gif';
		$SmilesArray[25]['smile_type'] 		= 	'1';

		$SmilesArray[26] 					= 	array();
		$SmilesArray[26]['smile_short'] 	= 	'';
		$SmilesArray[26]['smile_path'] 		= 	'look/images/icons/mf_bookread.gif';
		$SmilesArray[26]['smile_type'] 		= 	'1';

		$SmilesArray[27] 					= 	array();
		$SmilesArray[27]['smile_short'] 	= 	'';
		$SmilesArray[27]['smile_path'] 		= 	'look/images/icons/smoke.gif';
		$SmilesArray[27]['smile_type'] 		= 	'1';

		$SmilesArray[28] 					= 	array();
		$SmilesArray[28]['smile_short'] 	= 	'';
		$SmilesArray[28]['smile_path'] 		= 	'look/images/icons/thumbup.gif';
		$SmilesArray[28]['smile_type'] 		= 	'1';

		$SmilesArray[29] 					= 	array();
		$SmilesArray[29]['smile_short'] 	= 	'';
		$SmilesArray[29]['smile_path'] 		= 	'look/images/icons/tooth.gif';
		$SmilesArray[29]['smile_type'] 		= 	'1';

		$SmilesArray[30] 					= 	array();
		$SmilesArray[30]['smile_short'] 	= 	'';
		$SmilesArray[30]['smile_path'] 		= 	'look/images/icons/vertag.gif';
		$SmilesArray[30]['smile_type'] 		= 	'1';

		$SmilesArray[31] 					= 	array();
		$SmilesArray[31]['smile_short'] 	= 	'';
		$SmilesArray[31]['smile_path'] 		= 	'look/images/icons/wub.gif';
		$SmilesArray[31]['smile_type'] 		= 	'1';

		$SmilesArray[32] 					= 	array();
		$SmilesArray[32]['smile_short'] 	= 	'';
		$SmilesArray[32]['smile_path'] 		= 	'look/images/icons/winner_first_h4h.gif';
		$SmilesArray[32]['smile_type'] 		= 	'1';

		$SmilesArray[33] 					= 	array();
		$SmilesArray[33]['smile_short'] 	= 	'';
		$SmilesArray[33]['smile_path'] 		= 	'look/images/icons/winner_second_h4h.gif';
		$SmilesArray[33]['smile_type'] 		= 	'1';

		$SmilesArray[34] 					= 	array();
		$SmilesArray[34]['smile_short'] 	= 	'';
		$SmilesArray[34]['smile_path'] 		= 	'look/images/icons/winner_third_h4h.gif';
		$SmilesArray[34]['smile_type'] 		= 	'1';

		$x = 0;
		$i = array();

		while ($x < sizeof($SmilesArray))
		{
			$insert = $PowerBB->DB->sql_query("INSERT INTO " . $PowerBB->table['smiles'] . " SET
														smile_short='" . $SmilesArray[$x]['smile_short'] . "',
														smile_path='" . $SmilesArray[$x]['smile_path'] . "',
														smile_type='" . $SmilesArray[$x]['smile_type'] . "'");

			$i[$x] = ($insert) ? 'true' : 'false';

			$x += 1;
		}

		return $i;

	}

	function _CreateStyle()
	{
		global $PowerBB;

		$this->_TempArr['CreateArr']				= 	array();
		$this->_TempArr['CreateArr']['table_name'] 	= 	$PowerBB->table['style'];
		$this->_TempArr['CreateArr']['fields'] 		= 	array();
		$this->_TempArr['CreateArr']['fields'][] 	= 	'id INT( 9 ) NOT NULL AUTO_INCREMENT PRIMARY KEY';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'style_title varchar(200) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'style_on int(1) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'style_order int(9) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'style_path varchar(200) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'image_path varchar(200) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'template_path varchar(200) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'cache_path varchar(200) NOT NULL';

		$create = $this->create_table($this->_TempArr['CreateArr']);

		return ($create) ? true : false;
	}

	function _InsertStyle()
	{
		global $PowerBB;
        include("../lang/".$PowerBB->_GET['lang']."/language.php");
        $xml_code = @file_get_contents("../PBBoard-Style.xml");

		preg_match_all('/<!\[CDATA\[(.*?)\]\]>/is', $xml_code, $match);
		foreach($match[0] as $val)
		{
		$xml_code = str_replace($val,base64_encode($val),$xml_code);
		}

		$import = $this->xml_array($xml_code);
		$title = $import['styles_attr']['name'];
		$pbbversion = $import['styles_attr']['pbbversion'];

		$image_path = $import['styles_attr']['image_path'];
		$style_path = $import['styles_attr']['style_path'];
		$Templates = $import['styles']['templategroup'];
		$Templates_number = sizeof($import['styles']['templategroup']['template'])/2;


	       	$StlArr 					= 	array();
			$StlArr['field']			=	array();

			$StlArr['field']['style_title'] 	= 	$title;
			$StlArr['field']['style_path'] 		= 	$style_path;
			$StlArr['field']['style_order'] 	= 	'1';
			$StlArr['field']['style_on'] 		= 	'1';
			$StlArr['field']['image_path'] 		= 	$image_path;

			//Edited----------------------------------------
			$insert = $PowerBB->style->InsertStyle($StlArr);


					$styleid = '1';

		            $x = 0;

     			while ($x < $Templates_number)
     			{
						$templatetitle = $Templates['template'][$x.'_attr']['name'];
						$version = $Templates['template'][$x.'_attr']['version'];
						$TemplateArr = $PowerBB->DB->sql_query("SELECT * FROM " . $PowerBB->table['template'] . " WHERE styleid = 1 AND title = '$templatetitle' ");
						$getstyle_row = $PowerBB->DB->sql_fetch_array($TemplateArr);
						$template = base64_decode($Templates['template'][$x]);
						$templatetype = $Templates['template'][$x.'_attr']['templatetype'];
						$dateline = $Templates['template'][$x.'_attr']['date'];
						$product = $Templates['template'][$x.'_attr']['product'];
						$username = $Templates['template'][$x.'_attr']['username'];
			            $template = str_replace("'", "&#39;", $template);
						$template = str_replace("//<![CDATA[", "", $template);
						$template = str_replace("//]]>", "", $template);
     				    $template = str_replace("<![CDATA[","", $template);
						$template = str_replace("]]>","", $template);

						$InsertTemplatesArr	=	array();
						$InsertTemplatesArr['field']	=	array();
						$InsertTemplatesArr['field']['styleid']	=	$styleid;
						$InsertTemplatesArr['field']['title']	=	$templatetitle;
						$InsertTemplatesArr['field']['template']	=	$template;
						$InsertTemplatesArr['field']['template_un']	=	$template;
						$InsertTemplatesArr['field']['templatetype']	=	$templatetype;
						$InsertTemplatesArr['field']['dateline']	=	$dateline;
						$InsertTemplatesArr['field']['username']	=	$username;
						$InsertTemplatesArr['field']['version']	=	$version;
						$InsertTemplatesArr['field']['product']	=	$product;
						$Insert = $PowerBB->core->Insert($InsertTemplatesArr,'template');

                     $x += 1;
     			}


		       $deltemplates = $PowerBB->DB->sql_query("DELETE FROM " . $PowerBB->table['template'] . " WHERE styleid = '$styleid' and title = ''");

		return ($insert) ? true : false;
	}

	function _CreateLang()
	{
		global $PowerBB;

		$this->_TempArr['CreateArr']				= 	array();
		$this->_TempArr['CreateArr']['table_name'] 	= 	$PowerBB->table['lang'];
		$this->_TempArr['CreateArr']['fields'] 		= 	array();
		$this->_TempArr['CreateArr']['fields'][] 	= 	'id INT( 9 ) NOT NULL AUTO_INCREMENT PRIMARY KEY';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'lang_title varchar(200) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'lang_order int(9) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'lang_on int(1) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'lang_path varchar(200) NOT NULL';

		$create = $this->create_table($this->_TempArr['CreateArr']);

		return ($create) ? true : false;
	}

	function _InsertLang_ar()
	{
		global $PowerBB;
        include("../lang/".$PowerBB->_GET['lang']."/language.php");

         $xml_code_ar = @file_get_contents("../ArabicLanguage.xml");

		$import = $this->xml_array($xml_code_ar);
		$title = $import['language_attr']['name'];
		$pbbversion = $import['language_attr']['version'];


		$Languages = $import['language']['phrasegroup'];
		$language_number = sizeof($import['language']['phrasegroup']['phrase'])/2;

	       	$LangArr 					= 	array();
			$LangArr['field']			=	array();

			$LangArr['field']['lang_title'] 	= 	$title;
			$LangArr['field']['lang_order'] 	= 	"1";
			$LangArr['field']['lang_on'] 		= 	"1";
			$LangArr['field']['lang_path'] 		= 	"rtl";
			$insert = $PowerBB->lang->InsertLang($LangArr);
			$langid = '1';
		            $x = 0;
     			while ($x < $language_number)
     			{
						$varname = $Languages['phrase'][$x.'_attr']['name'];
						$fieldname = $Languages['phrase'][$x.'_attr']['fieldname'];
						$version = $Languages['phrase'][$x.'_attr']['pbbversion'];
						$text = $Languages['phrase'][$x];
						$product = $Languages['phrase'][$x.'_attr']['product'];
						$dateline = $Languages['phrase'][$x.'_attr']['date'];
						$username = $Languages['phrase'][$x.'_attr']['username'];
			            $text = str_replace("'", "&#39;", $text);

						$InsertLanguagesArr	=	array();
						$InsertLanguagesArr['field']	=	array();
						$InsertLanguagesArr['field']['languageid']	=	$langid;
						$InsertLanguagesArr['field']['varname']  	=	$varname;
						$InsertLanguagesArr['field']['fieldname']	=	$fieldname;
						$InsertLanguagesArr['field']['text']	    =	$text;
						$InsertLanguagesArr['field']['dateline']	=	$dateline;
						$InsertLanguagesArr['field']['username']	=	$username;
						$InsertLanguagesArr['field']['version']	    =	$version;
						$InsertLanguagesArr['field']['product']	    =	$product;
						$insertLanguages_ar = $PowerBB->core->Insert($InsertLanguagesArr,'phrase_language');
                     $x += 1;
     			}

           if ($insertLanguages_ar)
			{
		        $delLanguages_ar = $PowerBB->DB->sql_query("DELETE FROM " . $PowerBB->table['phrase_language'] . " WHERE languageid = '$langid' and varname = ''");

			}


		return ($insertLanguages_ar) ? true : false;
	}

	function _InsertLang_en()
	{
		global $PowerBB;
        include("../lang/".$PowerBB->_GET['lang']."/language.php");

				$xml_code_en = @file_get_contents("../EnglishLanguage.xml");

				$import_en = $this->xml_array($xml_code_en);
				$titleen = $import_en['language_attr']['name'];
				$pbbversion = $import_en['language_attr']['version'];


				$Languages_en = $import_en['language']['phrasegroup'];
				$language_numbers = sizeof($import_en['language']['phrasegroup']['phrase'])/2;


				$LangenArr 					= 	array();
				$LangenArr['field']			=	array();

				$LangenArr['field']['lang_title'] 	= 	$titleen;
				$LangenArr['field']['lang_order'] 	= 	"2";
				$LangenArr['field']['lang_on'] 		= 	"1";
			    $LangenArr['field']['lang_path'] 		= 	"ltr";
				$insert_en = $PowerBB->lang->InsertLang($LangenArr);
				$langid_en = '2';
		            $x = 0;
     			while ($x < $language_numbers)
     			{
						$varname = $Languages_en['phrase'][$x.'_attr']['name'];
						$fieldname = $Languages_en['phrase'][$x.'_attr']['fieldname'];
						$version = $Languages_en['phrase'][$x.'_attr']['pbbversion'];
						$texten = $Languages_en['phrase'][$x];
						$product = $Languages_en['phrase'][$x.'_attr']['product'];
						$dateline = $Languages_en['phrase'][$x.'_attr']['date'];
						$username = $Languages_en['phrase'][$x.'_attr']['username'];
			            $texten = str_replace("'", "&#39;", $texten);

						$InsertLanguagesArr	=	array();
						$InsertLanguagesArr['field']	=	array();
						$InsertLanguagesArr['field']['languageid']	=	$langid_en;
						$InsertLanguagesArr['field']['varname']  	=	$varname;
						$InsertLanguagesArr['field']['fieldname']	=	$fieldname;
						$InsertLanguagesArr['field']['text']	    =	$texten;
						$InsertLanguagesArr['field']['dateline']	=	$dateline;
						$InsertLanguagesArr['field']['username']	=	$username;
						$InsertLanguagesArr['field']['version']	    =	$version;
						$InsertLanguagesArr['field']['product']	    =	$product;
						$insertLanguages_en = $PowerBB->core->Insert($InsertLanguagesArr,'phrase_language');
                     $x += 1;
     			}

	           if ($insertLanguages_en)
				{
			        $delLanguages = $PowerBB->DB->sql_query("DELETE FROM " . $PowerBB->table['phrase_language'] . " WHERE languageid = '$langid_en' and varname = ''");
				}




		return ($insertLanguages_en) ? true : false;
	}

	function _CreateSubject()
	{
		global $PowerBB;

		$this->_TempArr['CreateArr']				= 	array();
		$this->_TempArr['CreateArr']['table_name'] 	= 	$PowerBB->table['subject'];
		$this->_TempArr['CreateArr']['fields'] 		= 	array();
		$this->_TempArr['CreateArr']['fields'][] 	= 	'id INT( 9 ) NOT NULL AUTO_INCREMENT PRIMARY KEY';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'title varchar(255) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'text mediumtext NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'writer varchar(200) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'section int(9) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'write_date varchar(10) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'stick int(1) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'close int(1) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'delete_topic int(1) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'reply_number int(9) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'visitor int(9) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'write_time varchar(25) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'native_write_time int(15) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'icon varchar(50) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'subject_describe varchar(200) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'action_by varchar(200) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'sec_subject int(1) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'lastreply_cache text NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'last_replier varchar(255) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'poll_subject int(1) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'attach_subject int(1) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'actiondate varchar(50) NOT NULL';
		// Since THETA 1
		$this->_TempArr['CreateArr']['fields'][] 	= 	'tags_cache text NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'close_reason varchar(255) NOT NULL';
		// Since ALPHA 2 (THETA 2)
		$this->_TempArr['CreateArr']['fields'][] 	= 	'delete_reason varchar(255) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'review_subject int(1) NOT NULL';
		// 2.0.1
		$this->_TempArr['CreateArr']['fields'][] 	= 	'special int(1) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'review_reply int(1) NOT NULL';
		// 2.0.2
		$this->_TempArr['CreateArr']['fields'][] 	= 	'rating int(9) NOT NULL';
		// 2.0.3
		$this->_TempArr['CreateArr']['fields'][] 	= 	'last_time VARCHAR( 60 ) NOT NULL';
		// 2.0.5
		$this->_TempArr['CreateArr']['fields'][] 	= 	'reason_edit VARCHAR( 200 ) NOT NULL';
		// 2.1.1
		$this->_TempArr['CreateArr']['fields'][] 	= 	'prefix_subject text NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'close_poll_subject int(1) NOT NULL';

		$create = $this->create_table($this->_TempArr['CreateArr']);

		return ($create) ? true : false;
	}

	function _CreateSuperMemberLogs()
	{
		global $PowerBB;

		$this->_TempArr['CreateArr']				= 	array();
		$this->_TempArr['CreateArr']['table_name'] 	= 	$PowerBB->table['sm_logs'];
		$this->_TempArr['CreateArr']['fields'] 		= 	array();
		$this->_TempArr['CreateArr']['fields'][] 	= 	'id INT( 9 ) NOT NULL AUTO_INCREMENT PRIMARY KEY';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'username varchar(200) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'edit_action varchar(255) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'subject_title varchar(200) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'subject_id int(9) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'edit_date varchar(10) NOT NULL';

		$create = $this->create_table($this->_TempArr['CreateArr']);

		return ($create) ? true : false;
	}

	function _CreateToday()
	{
		global $PowerBB;

		$this->_TempArr['CreateArr']				= 	array();
		$this->_TempArr['CreateArr']['table_name'] 	= 	$PowerBB->table['today'];
		$this->_TempArr['CreateArr']['fields'] 		= 	array();
		$this->_TempArr['CreateArr']['fields'][] 	= 	'id INT( 9 ) NOT NULL AUTO_INCREMENT PRIMARY KEY';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'username varchar(200) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'user_id int(9) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'user_date varchar(10) NOT NULL';
        $this->_TempArr['CreateArr']['fields'][] 	= 	'logged varchar(30) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'hide_browse int(1) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'username_style varchar(255) NOT NULL';

		$create = $this->create_table($this->_TempArr['CreateArr']);

		return ($create) ? true : false;
	}

	function _CreateToolBox()
	{
		global $PowerBB;

		$this->_TempArr['CreateArr']				= 	array();
		$this->_TempArr['CreateArr']['table_name'] 	= 	$PowerBB->table['toolbox'];
		$this->_TempArr['CreateArr']['fields'] 		= 	array();
		$this->_TempArr['CreateArr']['fields'][] 	= 	'id INT( 9 ) NOT NULL AUTO_INCREMENT PRIMARY KEY';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'name varchar(200) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'tool_type int(1) NOT NULL';

		$create = $this->create_table($this->_TempArr['CreateArr']);

		return ($create) ? true : false;
	}

	function _InsertToolBox()
	{
		global $PowerBB;

		$ToolboxArray = array();

		// Fonts
		$ToolboxArray['Tahoma'] 			= 1;
		$ToolboxArray['Times_new_roman'] 	= 1;
		$ToolboxArray['Courier_new'] 		= 1;
		$ToolboxArray['Arial'] 				= 1;

		// Colors - i think convert it to hex is better!
		$ToolboxArray['skyblue'] 			= 2;
		$ToolboxArray['royalblue'] 			= 2;
		$ToolboxArray['blue'] 				= 2;
		$ToolboxArray['darkblue'] 			= 2;
		$ToolboxArray['orange'] 			= 2;
		$ToolboxArray['orangered'] 			= 2;
		$ToolboxArray['crimson'] 			= 2;
		$ToolboxArray['red'] 				= 2;
		$ToolboxArray['firebrick'] 			= 2;
		$ToolboxArray['darkred'] 			= 2;
		$ToolboxArray['green'] 				= 2;
		$ToolboxArray['limegreen'] 			= 2;
		$ToolboxArray['seagreen'] 			= 2;
		$ToolboxArray['deeppink'] 			= 2;
		$ToolboxArray['tomato'] 			= 2;
		$ToolboxArray['coral'] 				= 2;
		$ToolboxArray['purple'] 			= 2;
		$ToolboxArray['indigo'] 			= 2;
		$ToolboxArray['burlywood'] 			= 2;
		$ToolboxArray['sandybrown'] 		= 2;
		$ToolboxArray['sienna'] 			= 2;
		$ToolboxArray['chocolate'] 			= 2;
		$ToolboxArray['teal'] 				= 2;
		$ToolboxArray['silver'] 			= 2;

		$x = 0;
		$i = array();

		foreach ($ToolboxArray as $k	=>	$v)
		{
			$k = str_replace('_',' ',$k);

			$insert = $PowerBB->DB->sql_query("INSERT INTO " . $PowerBB->table['toolbox'] . " SET
													name='" . $k . "',
													tool_type='" . $v ."'");

			$i[$x] = ($insert) ? 'true' : 'false';

			$x += 1;
		}

		return $i;
	}

	function _CreateUserTitle()
	{
		global $PowerBB;

		$this->_TempArr['CreateArr']				= 	array();
		$this->_TempArr['CreateArr']['table_name'] 	= 	$PowerBB->table['usertitle'];
		$this->_TempArr['CreateArr']['fields'] 		= 	array();
		$this->_TempArr['CreateArr']['fields'][] 	= 	'id INT( 9 ) NOT NULL AUTO_INCREMENT PRIMARY KEY';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'usertitle varchar(200) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'posts int(9) NOT NULL';

		$create = $this->create_table($this->_TempArr['CreateArr']);

		return ($create) ? true : false;
	}

	function _InsertUserTitle()
	{
		global $PowerBB;
        include("../lang/".$PowerBB->_GET['lang']."/language.php");
		$usertitle = $lang['Member'];

		$insert = $PowerBB->DB->sql_query("INSERT INTO " . $PowerBB->table['usertitle'] . " SET
												usertitle='$usertitle',
												posts='0'");

		return ($insert) ? true : false;
	}


	function _CreateUserRating()
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

	function _InsertUserRating()
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

	function _CreateVote()
	{
		global $PowerBB;

		$this->_TempArr['CreateArr']				= 	array();
		$this->_TempArr['CreateArr']['table_name'] 	= 	$PowerBB->table['vote'];
		$this->_TempArr['CreateArr']['fields'] 		= 	array();
		$this->_TempArr['CreateArr']['fields'][] 	= 	'id INT( 9 ) NOT NULL AUTO_INCREMENT PRIMARY KEY';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'poll_id int(9) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'member_id int(9) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'answer_number int(9) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'votes int(9) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'subject_id int(9) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'user_ip varchar(50) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'username varchar(255) NOT NULL';

		$create = $this->create_table($this->_TempArr['CreateArr']);

		return ($create) ? true : false;
	}

	/** Since THETA 1 **/
	function _CreateTags()
	{
		global $PowerBB;

		$this->_TempArr['CreateArr']				= 	array();
		$this->_TempArr['CreateArr']['table_name'] 	= 	$PowerBB->table['tag'];
		$this->_TempArr['CreateArr']['fields'] 		= 	array();
		$this->_TempArr['CreateArr']['fields'][] 	= 	'id INT( 9 ) NOT NULL AUTO_INCREMENT PRIMARY KEY';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'tag varchar(255) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'number int(9) NOT NULL';

		$create = $this->create_table($this->_TempArr['CreateArr']);

		return ($create) ? true : false;
	}

	function _CreateTagsSubject()
	{
		global $PowerBB;

		$this->_TempArr['CreateArr']				= 	array();
		$this->_TempArr['CreateArr']['table_name'] 	= 	$PowerBB->table['tag_subject'];
		$this->_TempArr['CreateArr']['fields'] 		= 	array();
		$this->_TempArr['CreateArr']['fields'][] 	= 	'id INT( 9 ) NOT NULL AUTO_INCREMENT PRIMARY KEY';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'tag_id int(9) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'subject_id int(9) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'tag varchar(255) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'subject_title varchar(255) NOT NULL';

		$create = $this->create_table($this->_TempArr['CreateArr']);

		return ($create) ? true : false;
	}

	function _CreateFeeds()
    {
    global $PowerBB;

	    $this->_TempArr['CreateArr']                =   array();
	    $this->_TempArr['CreateArr']['table_name']  =   $PowerBB->table['feeds'];
	    $this->_TempArr['CreateArr']['fields']      =   array();
		$this->_TempArr['CreateArr']['fields'][]    = 	'id INT( 9 ) NOT NULL AUTO_INCREMENT PRIMARY KEY';
	    $this->_TempArr['CreateArr']['fields'][]    =   "title VARCHAR( 250 ) NOT NULL";
	    $this->_TempArr['CreateArr']['fields'][]    =   "title2 VARCHAR( 250 ) NOT NULL";
	    $this->_TempArr['CreateArr']['fields'][]    =   "rsslink TEXT NOT NULL";
	    $this->_TempArr['CreateArr']['fields'][]    =   "userid int(10) unsigned NOT NULL default '0'";
	    $this->_TempArr['CreateArr']['fields'][]    =   "forumid SMALLINT UNSIGNED NOT NULL DEFAULT '0'";
	    $this->_TempArr['CreateArr']['fields'][]    =   "text mediumtext NOT NULL";
	    $this->_TempArr['CreateArr']['fields'][]    =   "ttl SMALLINT UNSIGNED NOT NULL DEFAULT '1500'";
	    $this->_TempArr['CreateArr']['fields'][]    =   "options INT( 10 ) UNSIGNED NOT NULL DEFAULT '1'";
		$this->_TempArr['CreateArr']['fields'][] 	= 	'feeds_time varchar(20) NOT NULL';

    $create = $this->create_table($this->_TempArr['CreateArr']);

    return ($create) ? true : false;
    }

	function _CreateTopicMod()
    {
    global $PowerBB;

	    $this->_TempArr['CreateArr']                =   array();
	    $this->_TempArr['CreateArr']['table_name']  =   $PowerBB->table['topicmod'];
	    $this->_TempArr['CreateArr']['fields']      =   array();
		$this->_TempArr['CreateArr']['fields'][]    = 	'id INT( 9 ) NOT NULL AUTO_INCREMENT PRIMARY KEY';
	    $this->_TempArr['CreateArr']['fields'][]    =   "title VARCHAR( 250 ) NOT NULL";
	    $this->_TempArr['CreateArr']['fields'][]    =   "enabled tinyint(1) NOT NULL default '0'";
	    $this->_TempArr['CreateArr']['fields'][]    =   "state varchar(10) NOT NULL default 'leave'";
	    $this->_TempArr['CreateArr']['fields'][]    =   "pin varchar(10) NOT NULL default 'leave'";
	    $this->_TempArr['CreateArr']['fields'][]    =   "move smallint(5) NOT NULL default '0'";
	    $this->_TempArr['CreateArr']['fields'][]    =   "move_link tinyint(1) NOT NULL default '0'";
	    $this->_TempArr['CreateArr']['fields'][]    =   "title_st varchar(250) NOT NULL default ''";
	    $this->_TempArr['CreateArr']['fields'][]    =   "title_end varchar(250) NOT NULL default ''";
		$this->_TempArr['CreateArr']['fields'][] 	= 	"reply tinyint(1) NOT NULL default '0'";
		$this->_TempArr['CreateArr']['fields'][] 	= 	"reply_content text";
		$this->_TempArr['CreateArr']['fields'][] 	= 	"approve tinyint(1) NOT NULL default '0'";
		$this->_TempArr['CreateArr']['fields'][] 	= 	'forums text';

    $create = $this->create_table($this->_TempArr['CreateArr']);

    return ($create) ? true : false;
    }

	function _CreateCustomBBcode()
    {
    global $PowerBB;

	    $this->_TempArr['CreateArr']        =   array();
	    $this->_TempArr['CreateArr']['table_name']  =   $PowerBB->table['custom_bbcode'];
	    $this->_TempArr['CreateArr']['fields']    =   array();
	    $this->_TempArr['CreateArr']['fields'][]  =   'id INT( 9 ) NOT NULL AUTO_INCREMENT PRIMARY KEY';
	    $this->_TempArr['CreateArr']['fields'][]  =   "bbcode_title varchar(255) NOT NULL default ''";
	    $this->_TempArr['CreateArr']['fields'][]  =   "bbcode_desc text";
	    $this->_TempArr['CreateArr']['fields'][]  =   "bbcode_tag varchar(255) NOT NULL default ''";
	    $this->_TempArr['CreateArr']['fields'][]  =   "bbcode_replace text";
	    $this->_TempArr['CreateArr']['fields'][]  =   "bbcode_useoption tinyint(1) NOT NULL default '0'";
	    $this->_TempArr['CreateArr']['fields'][]  =   "bbcode_example text";
	    $this->_TempArr['CreateArr']['fields'][]  =   "bbcode_switch varchar(355) NOT NULL default ''";
	    $this->_TempArr['CreateArr']['fields'][]  =   "bbcode_add_into_menu int(1) NOT NULL default '0'";
	    $this->_TempArr['CreateArr']['fields'][]  =   "bbcode_menu_option_text varchar(200) NOT NULL default ''";
	    $this->_TempArr['CreateArr']['fields'][]  =   "bbcode_menu_content_text varchar(200) NOT NULL default ''";

    $create = $this->create_table($this->_TempArr['CreateArr']);

    return ($create) ? true : false;
    }

	function _CreateBlocks()
	{
		global $PowerBB;

		$this->_TempArr['CreateArr']				= 	array();
		$this->_TempArr['CreateArr']['table_name'] 	= 	$PowerBB->prefix."blocks";
		$this->_TempArr['CreateArr']['fields'] 		= 	array();
		$this->_TempArr['CreateArr']['fields'][] 	= 	'id INT( 9 ) NOT NULL AUTO_INCREMENT PRIMARY KEY';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'title VARCHAR( 255 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'text longtext NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'place_block VARCHAR( 100 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'sort int(5) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	"active smallint(5) unsigned NOT NULL default '1'";

		$create = $this->create_table($this->_TempArr['CreateArr']);

		return ($create) ? true : false;
	}

	function _InsertBlocks()
	{
		global $PowerBB;
        include("../lang/".$PowerBB->_GET['lang']."/language.php");
		$BlocksArray = array();

		$BlocksArray[0] 					= 	array();
		$BlocksArray[0]['title'] 		= 	$lang['portal_main_categories'];
		$BlocksArray[0]['text'] 		= 	'{template}portal_main_categories{/template}';
		$BlocksArray[0]['place_block'] 		= 	'left';
		$BlocksArray[0]['sort'] 		= 	'1';

		$BlocksArray[1] 				= 	array();
		$BlocksArray[1]['title'] 		= 	$lang['portal_static'];
		$BlocksArray[1]['text'] 		= 	'{template}portal_static{/template}';
		$BlocksArray[1]['place_block'] 		= 	'left';
		$BlocksArray[1]['sort'] 		= 	'2';

		$BlocksArray[2] 					= 	array();
		$BlocksArray[2]['title'] 		= 	$lang['portal_clock'];
		$BlocksArray[2]['text'] 		= 	'{template}portal_clock{/template}';
		$BlocksArray[2]['place_block'] 		= 	'left';
		$BlocksArray[2]['sort'] 		= 	'3';

		$BlocksArray[3] 					= 	array();
		$BlocksArray[3]['title'] 		= 	$lang['portal_calendar'];
		$BlocksArray[3]['text'] 		= 	'{template}portal_calendar{/template}';
		$BlocksArray[3]['place_block'] 		= 	'center';
		$BlocksArray[3]['sort'] 		= 	'2';

		$BlocksArray[4] 					= 	array();
		$BlocksArray[4]['title'] 		= 	$lang['portal_last_news'];
		$BlocksArray[4]['text'] 		= 	'{template}portal_last_news{/template}';
		$BlocksArray[4]['place_block'] 		= 	'center';
		$BlocksArray[4]['sort'] 		= 	'1';

		$BlocksArray[5] 					= 	array();
		$BlocksArray[5]['title'] 		= 	$lang['portal_main_menu'];
		$BlocksArray[5]['text'] 		= 	'{template}portal_main_menu{/template}';
		$BlocksArray[5]['place_block'] 		= 	'right';
		$BlocksArray[5]['sort'] 		= 	'1';

		$BlocksArray[6] 					= 	array();
		$BlocksArray[6]['title'] 		= 	$lang['portal_online'];
		$BlocksArray[6]['text'] 		= 	'{template}portal_online{/template}';
		$BlocksArray[6]['place_block'] 		= 	'right';
		$BlocksArray[6]['sort'] 		= 	'2';

		$BlocksArray[7] 					= 	array();
		$BlocksArray[7]['title'] 		= 	$lang['portal_latest_posts'];
		$BlocksArray[7]['text'] 		= 	'{template}portal_latest_posts{/template}';
		$BlocksArray[7]['place_block'] 		= 	'right';
		$BlocksArray[7]['sort'] 		= 	'3';

		$x = 0;
		$i = array();
		while ($x < sizeof($BlocksArray))
		{
			$insert = $PowerBB->DB->sql_query("INSERT INTO " . $PowerBB->prefix."blocks SET
														id='NULL',
														title='" . $BlocksArray[$x]['title'] . "',
														text='" . $BlocksArray[$x]['text'] . "',
														place_block='" . $BlocksArray[$x]['place_block'] . "',
														sort='" . $BlocksArray[$x]['sort'] . "'");

			$i[$x] = ($insert) ? 'true' : 'false';

			$x += 1;
		}

		return $i;
	}


	// That's it !
}

?>
