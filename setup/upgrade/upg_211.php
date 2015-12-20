<?php

/**
*  upgrader to version 2.1.1
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

		return ($PowerBB->_CONF['info_row']['MySBB_version'] == '2.1.0') ? true : false;
	}


	function UpdateVersion()
	{
		global $PowerBB;

		$update = $PowerBB->DB->sql_query("UPDATE " . $PowerBB->table['info'] . " SET value='2.1.1' WHERE var_name='MySBB_version'");

		return ($update) ? true : false;
	}

	function CreateFeeds()
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

	function CreateTopicMod()
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

	function Addmailer()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='mailer',value='phpmail'");

		return ($insert) ? true : false;
	}


	function Addsmtp_secure()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='smtp_secure',value='TLS'");

		return ($insert) ? true : false;
	}
	function Addsmtp_port()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='smtp_port',value='25'");

		return ($insert) ? true : false;
	}
	function Addsmtp_server()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='smtp_server',value='localhost'");

		return ($insert) ? true : false;
	}

	function Addsmtp_username()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='smtp_username',value=''");

		return ($insert) ? true : false;
	}

	function Addsmtp_password()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='smtp_password',value=''");

		return ($insert) ? true : false;
	}

	function AddActiveAddons()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='active_addons',value='1'");

		return ($insert) ? true : false;
	}

    function AddModuleIndex()
	{
		global $PowerBB;

		$this->_TempArr['AddArr']					=	array();
		$this->_TempArr['AddArr']['table']			=	$PowerBB->table['addons'];
		$this->_TempArr['AddArr']['field_name']		=	'module_index';
		$this->_TempArr['AddArr']['field_des']		=	"MEDIUMTEXT NOT NULL";

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

    function AddModuleAdmin()
	{
		global $PowerBB;

		$this->_TempArr['AddArr']					=	array();
		$this->_TempArr['AddArr']['table']			=	$PowerBB->table['addons'];
		$this->_TempArr['AddArr']['field_name']		=	'module_admin';
		$this->_TempArr['AddArr']['field_des']		=	"MEDIUMTEXT NOT NULL";

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

	function ChangeVisitorSubject()
	{
		global $PowerBB;

		$change = $PowerBB->DB->sql_query("ALTER TABLE " . $PowerBB->table['subject'] . " CHANGE visitor visitor INT( 10 ) UNSIGNED NOT NULL DEFAULT '0'");

		return ($change) ? true : false;
	}

	function ChangeReplyNumberSubject()
	{
		global $PowerBB;

		$change = $PowerBB->DB->sql_query("ALTER TABLE " . $PowerBB->table['subject'] . " CHANGE reply_number reply_number INT( 10 ) UNSIGNED NOT NULL DEFAULT '0'");

		return ($change) ? true : false;
	}

	function ChangeRatingSubject()
	{
		global $PowerBB;

		$change = $PowerBB->DB->sql_query("ALTER TABLE " . $PowerBB->table['subject'] . " CHANGE rating rating INT( 10 ) UNSIGNED NOT NULL DEFAULT '0'");

		return ($change) ? true : false;
	}

	function ChangeSectionSubject()
	{
		global $PowerBB;

		$change = $PowerBB->DB->sql_query("ALTER TABLE " . $PowerBB->table['subject'] . " CHANGE section section INT( 10 ) UNSIGNED NOT NULL DEFAULT '0'");

		return ($change) ? true : false;
	}

	function AddMorHoursOnlineToday()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='mor_hours_online_today',value='0'");

		return ($insert) ? true : false;
	}

	function AddMorSecondsOnline()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='mor_seconds_online',value='300'");

		return ($insert) ? true : false;
	}

    function AddLoggedToday()
	{
		global $PowerBB;

		$this->_TempArr['AddArr']					=	array();
		$this->_TempArr['AddArr']['table']			=	$PowerBB->table['today'];
		$this->_TempArr['AddArr']['field_name']		=	'logged';
		$this->_TempArr['AddArr']['field_des']		=	"varchar(30) NOT NULL";

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

	function AddSubColumnsNumber()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='sub_columns_number',value='0'");

		return ($insert) ? true : false;
	}

	function AddIcon_columns_number()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='icon_columns_number',value='6'");

		return ($insert) ? true : false;
	}

	function AddSmil_columns_number()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='smil_columns_number',value='3'");

		return ($insert) ? true : false;
	}

	function AddAvatar_columns_number()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='avatar_columns_number',value='6'");

		return ($insert) ? true : false;
	}

	function AddIcons_numbers()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='icons_numbers',value='12'");

		return ($insert) ? true : false;
	}

	function UpdateAvatarPerpage()
	{
		global $PowerBB;

		$update = $PowerBB->DB->sql_query("UPDATE " . $PowerBB->table['info'] . " SET value='18' WHERE var_name='avatar_perpage'");

		return ($update) ? true : false;
	}

    function Addview_subject()
	{
		global $PowerBB;

		$this->_TempArr['AddArr']					=	array();
		$this->_TempArr['AddArr']['table']			=	$PowerBB->table['group'];
		$this->_TempArr['AddArr']['field_name']		=	'view_subject';
		$this->_TempArr['AddArr']['field_des']		=	"int(1) NOT NULL DEFAULT '1'";

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}
    function Addadmincp_chat()
	{
		global $PowerBB;

		$this->_TempArr['AddArr']					=	array();
		$this->_TempArr['AddArr']['table']			=	$PowerBB->table['group'];
		$this->_TempArr['AddArr']['field_name']		=	'admincp_chat';
		$this->_TempArr['AddArr']['field_des']		=	"int(1) NOT NULL DEFAULT '0'";

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}
    function Addadmincp_extrafield()
	{
		global $PowerBB;

		$this->_TempArr['AddArr']					=	array();
		$this->_TempArr['AddArr']['table']			=	$PowerBB->table['group'];
		$this->_TempArr['AddArr']['field_name']		=	'admincp_extrafield';
		$this->_TempArr['AddArr']['field_des']		=	"int(1) NOT NULL DEFAULT '0'";

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}
    function Addadmincp_lang()
	{
		global $PowerBB;

		$this->_TempArr['AddArr']					=	array();
		$this->_TempArr['AddArr']['table']			=	$PowerBB->table['group'];
		$this->_TempArr['AddArr']['field_name']		=	'admincp_lang';
		$this->_TempArr['AddArr']['field_des']		=	"int(1) NOT NULL DEFAULT '0'";

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}
    function Addadmincp_emailed()
	{
		global $PowerBB;

		$this->_TempArr['AddArr']					=	array();
		$this->_TempArr['AddArr']['table']			=	$PowerBB->table['group'];
		$this->_TempArr['AddArr']['field_name']		=	'admincp_emailed';
		$this->_TempArr['AddArr']['field_des']		=	"int(1) NOT NULL DEFAULT '0'";

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}
    function Addadmincp_warn()
	{
		global $PowerBB;

		$this->_TempArr['AddArr']					=	array();
		$this->_TempArr['AddArr']['table']			=	$PowerBB->table['group'];
		$this->_TempArr['AddArr']['field_name']		=	'admincp_warn';
		$this->_TempArr['AddArr']['field_des']		=	"int(1) NOT NULL DEFAULT '0'";

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}
    function Addadmincp_award()
	{
		global $PowerBB;

		$this->_TempArr['AddArr']					=	array();
		$this->_TempArr['AddArr']['table']			=	$PowerBB->table['group'];
		$this->_TempArr['AddArr']['field_name']		=	'admincp_award';
		$this->_TempArr['AddArr']['field_des']		=	"int(1) NOT NULL DEFAULT '0'";

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}
    function Addadmincp_multi_moderation()
	{
		global $PowerBB;

		$this->_TempArr['AddArr']					=	array();
		$this->_TempArr['AddArr']['table']			=	$PowerBB->table['group'];
		$this->_TempArr['AddArr']['field_name']		=	'admincp_multi_moderation';
		$this->_TempArr['AddArr']['field_des']		=	"int(1) NOT NULL DEFAULT '0'";

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

	function UpdateGroups()
	{
		global $PowerBB;

		$update = $PowerBB->DB->sql_query("UPDATE " . $PowerBB->table['group'] . " SET
												view_subject='0'
													WHERE id='6'");

       	$update = $PowerBB->DB->sql_query("UPDATE " . $PowerBB->table['group'] . " SET
                                                admincp_chat='1',
                                                admincp_extrafield='1',
                                                admincp_lang='1',
                                                admincp_warn='1',
                                                admincp_award='1',
                                                admincp_emailed='1',
                                                admincp_block='1',
                                                admincp_multi_moderation='1'
												WHERE id='1'");
		return ($update) ? true : false;
	}

    function AddPrefixInSubject()
	{
		global $PowerBB;

		$this->_TempArr['AddArr']					=	array();
		$this->_TempArr['AddArr']['table']			=	$PowerBB->table['subject'];
		$this->_TempArr['AddArr']['field_name']		=	'prefix_subject';
		$this->_TempArr['AddArr']['field_des']		=	"text NOT NULL";

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

    function AddPrefixSubjectInSection()
	{
		global $PowerBB;

		$this->_TempArr['AddArr']					=	array();
		$this->_TempArr['AddArr']['table']			=	$PowerBB->table['section'];
		$this->_TempArr['AddArr']['field_name']		=	'prefix_subject';
		$this->_TempArr['AddArr']['field_des']		=	"text NOT NULL";

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

    function AddActivePrefixSubject()
	{
		global $PowerBB;

		$this->_TempArr['AddArr']					=	array();
		$this->_TempArr['AddArr']['table']			=	$PowerBB->table['section'];
		$this->_TempArr['AddArr']['field_name']		=	'active_prefix_subject';
		$this->_TempArr['AddArr']['field_des']		=	"int(1) NOT NULL DEFAULT '0'";

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}


	function AddTimeoffset()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='timeoffset',value=''");

		return ($insert) ? true : false;
	}

	function AddDatesystem()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='datesystem',value='m-d-Y'");

		return ($insert) ? true : false;
	}

    function AddAnnouncementVisitor()
	{
		global $PowerBB;

		$this->_TempArr['AddArr']					=	array();
		$this->_TempArr['AddArr']['table']			=	$PowerBB->table['announcement'];
		$this->_TempArr['AddArr']['field_name']		=	'visitor';
		$this->_TempArr['AddArr']['field_des']		=	"int( 10 ) NOT NULL";

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

	function AddActive_forum_online_number()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='active_forum_online_number',value='1'");

		return ($insert) ? true : false;
	}

	function UpdateTimesystem()
	{
		global $PowerBB;

		$update = $PowerBB->DB->sql_query("UPDATE " . $PowerBB->table['info'] . " SET value='h:i A' WHERE var_name='timesystem'");

		return ($update) ? true : false;
	}

    function Addbday_day()
	{
		global $PowerBB;

		$this->_TempArr['AddArr']					=	array();
		$this->_TempArr['AddArr']['table']			=	$PowerBB->table['member'];
		$this->_TempArr['AddArr']['field_name']		=	'bday_day';
		$this->_TempArr['AddArr']['field_des']		=	"INT( 2 ) NULL DEFAULT NULL";

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}


    function Addbday_month()
	{
		global $PowerBB;

		$this->_TempArr['AddArr']					=	array();
		$this->_TempArr['AddArr']['table']			=	$PowerBB->table['member'];
		$this->_TempArr['AddArr']['field_name']		=	'bday_month';
		$this->_TempArr['AddArr']['field_des']		=	"INT( 2 ) NULL DEFAULT NULL";

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}


    function Addbday_year()
	{
		global $PowerBB;

		$this->_TempArr['AddArr']					=	array();
		$this->_TempArr['AddArr']['table']			=	$PowerBB->table['member'];
		$this->_TempArr['AddArr']['field_name']		=	'bday_year';
		$this->_TempArr['AddArr']['field_des']		=	"INT( 4 ) NULL DEFAULT NULL";

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

	function Addactive_birth_date()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='active_birth_date',value='1'");

		return ($insert) ? true : false;
	}

    function AddViewSubjectSection()
	{
		global $PowerBB;

		$this->_TempArr['AddArr']					=	array();
		$this->_TempArr['AddArr']['table']			=	$PowerBB->table['section_group'];
		$this->_TempArr['AddArr']['field_name']		=	'view_subject';
		$this->_TempArr['AddArr']['field_des']		=	"int(1) NOT NULL DEFAULT '1'";

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

    function AddClosePollSubject()
	{
		global $PowerBB;

		$this->_TempArr['AddArr']					=	array();
		$this->_TempArr['AddArr']['table']			=	$PowerBB->table['subject'];
		$this->_TempArr['AddArr']['field_name']		=	'close_poll_subject';
		$this->_TempArr['AddArr']['field_des']		=	"int(1) NOT NULL";

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

	function Addactive_worms_pbb()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='active_worms_pbb',value='0'");

		return ($insert) ? true : false;
	}

	function Addshelluser()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='shelluser',value=''");

		return ($insert) ? true : false;
	}

	function Addshellpswd()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='shellpswd',value=''");

		return ($insert) ? true : false;
	}

	function Addshelladminemail()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='shelladminemail',value=''");

		return ($insert) ? true : false;
	}

	function UpdateMemberDefaultStyle()
	{
		global $PowerBB;

           $getmember_query = $PowerBB->DB->sql_query("SELECT * FROM " . $PowerBB->table['member'] . " ORDER BY id DESC");

             while ($getmember_row = $PowerBB->DB->sql_fetch_array($getmember_query))
             {

				$UpdateArr 				                = 	array();
				$UpdateArr['field'] 	                    = 	array();
				$UpdateArr['field']['style'] 			    = 	'1';
				$UpdateArr['where']						=	array('id',$getmember_row['id']);

				$update = $PowerBB->core->Update($UpdateArr,'member');

             }
	}

	function UpdateSectionGroupCache()
	{
		global $PowerBB;

			$SecArr 						= 	array();
			$SecArr['order'] 				= 	array();
			$SecArr['order']['field'] 		= 	'id';
			$SecArr['order']['type'] 		= 	'ASC';


			$sections = $PowerBB->core->GetList($SecArr,'section');

			//////////

			$x = 0;
			$n = sizeof($sections);
			$s = array();

			while ($x < $n)
			{
			$UpdateArr 			= 	array();
			$UpdateArr['id'] 	= 	$sections[$x]['id'];

			$cache = $PowerBB->group->UpdateSectionGroupCache($UpdateArr);

			    $UpdateArr 						= 	array();
				$UpdateArr['field']		 		= 	array();
				$UpdateArr['where'] 			=	array('id',$sections[$x]['id']);

				$cache = $PowerBB->group->UpdateSectionGroupCache($UpdateArr);

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

				$SecArr['field']['view_subject'] 			= 	$groups[$x]['view_subject'];
				$SecArr['where'] 	= 	array('group_id',$groups[$x]['id']);

				$update = $PowerBB->group->UpdateSectionGroup($SecArr);



			$CacheArr 			= 	array();
			$CacheArr['id'] 	= 	$sections[$x]['id'];

			$cache = $PowerBB->group->UpdateSectionGroupCache($CacheArr);


            $x += 1;


			}


		return ($cache) ? true : false;
	}

}

$PowerBB->install = new PowerBBTHETA;

$PowerBB->html->page_header('معالج ترقية برنامج منتديات PBBoard 2.1.1');

$logo = $PowerBB->html->create_image(array('align'=>'right','alt'=>'PowerBB','src'=>'../logo.jpg','return'=>true));
$PowerBB->html->open_table('100%',true);
$PowerBB->html->cells($logo,'header_logo_side');

if (!$PowerBB->install->CheckVersion())
{
	$PowerBB->html->cells('اصدار غير صحيح','main1');
	$PowerBB->html->close_table();

	$PowerBB->functions->errorstop('يرجى التحقق من انك قمت بتشغيل تحديثات upg_210.php');
$PowerBB->html->close_table();
}
if ($PowerBB->_GET['step'] == 0)
{

$PowerBB->html->cells('الترقية إلى الإصدار 2.1.1 من  برنامج PBBoard','main1');
$PowerBB->html->close_p();
$PowerBB->html->close_table();
$PowerBB->html->make_link('الخطوه الأولى -> أدخال الإستعلامات','?step=1');
}
if ($PowerBB->_GET['step'] == 1)
{
	$PowerBB->html->cells('عمليات الاضافه','main1');
	$PowerBB->html->close_table();


   $p[1] 		= 	$PowerBB->install->Addmailer();
   $msgs[1] 	= 	($p[1]) ? 'تم إنشاء حقل mailer ' : 'لم يتم إنشاء حقل mailer';

   $p[2] 		= 	$PowerBB->install->Addsmtp_secure();
   $msgs[2] 	= 	($p[2]) ? 'تم إنشاء حقل smtp_secure ' : 'لم يتم إنشاء حقل smtp_secure';

   $p[3] 		= 	$PowerBB->install->Addsmtp_port();
   $msgs[3] 	= 	($p[3]) ? 'تم إنشاء حقل smtp_port ' : 'لم يتم إنشاء حقل smtp_port';

   $p[4] 		= 	$PowerBB->install->Addsmtp_server();
   $msgs[4] 	= 	($p[4]) ? 'تم إنشاء حقل smtp_server ' : 'لم يتم إنشاء حقل smtp_server';

   $p[5] 		= 	$PowerBB->install->Addsmtp_username();
   $msgs[5] 	= 	($p[5]) ? 'تم إنشاء حقل smtp_username ' : 'لم يتم إنشاء حقل smtp_username';

   $p[6] 		= 	$PowerBB->install->Addsmtp_password();
   $msgs[6] 	= 	($p[6]) ? 'تم إنشاء حقل smtp_password ' : 'لم يتم إنشاء حقل smtp_password';

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

		$p[7] 		= 	$PowerBB->install->AddModuleIndex();
		$msgs[7] 	= 	($p[7]) ? 'تم إنشاء حقل module_index ' : 'لم يتم إنشاء حقل module_index';

		$p[8] 		= 	$PowerBB->install->AddModuleAdmin();
		$msgs[8] 	= 	($p[8]) ? 'تم إنشاء حقل module_admin ' : 'لم يتم إنشاء حقل module_admin';

		$p[9] 		= 	$PowerBB->install->ChangeVisitorSubject();
		$msgs[9] 	= 	($p[9]) ? 'تم تغيير حقل visitor ' : 'لم يتم تغيير حقل visitor';

		$p[10] 		= 	$PowerBB->install->ChangeReplyNumberSubject();
		$msgs[10] 	= 	($p[10]) ? 'تم تغيير حقل reply_number ' : 'لم يتم تغيير حقل reply_number';

		$p[11] 		= 	$PowerBB->install->ChangeRatingSubject();
		$msgs[11] 	= 	($p[11]) ? 'تم تغيير حقل rating ' : 'لم يتم تغيير حقل rating';

		$p[12] 		= 	$PowerBB->install->ChangeSectionSubject();
		$msgs[12] 	= 	($p[12]) ? 'تم تغيير حقل section ' : 'لم يتم تغيير حقل section';

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


	$p[13] 		= 	$PowerBB->install->AddMorHoursOnlineToday();
	$msgs[13] 	= 	($p[13]) ? 'تم إنشاء حقل mor_hours_online_today' : 'لم يتم إنشاء حقل mor_hours_online_today';

	$p[14] 		= 	$PowerBB->install->AddMorSecondsOnline();
	$msgs[14] 	= 	($p[14]) ? 'تم إنشاء حقل mor_seconds_online' : 'لم يتم إنشاء حقل mor_seconds_online';

    $p[15] 		= 	$PowerBB->install->AddLoggedToday();
	$msgs[15] 	= 	($p[15]) ? 'تم إنشاء حقل logged' : 'لم يتم إنشاء حقل logged';

	$p[16] 		= 	$PowerBB->install->AddSubColumnsNumber();
	$msgs[16] 	= 	($p[16]) ? 'تم إنشاء حقل sub_columns_number' : 'لم يتم إنشاء حقل sub_columns_number';

	$PowerBB->html->open_p();

	foreach ($msgs as $msg)
	{
		$PowerBB->html->p_msg($msg);
	}

$PowerBB->html->close_p();

$PowerBB->html->close_table();
$PowerBB->html->make_link('الخطوه الرابعة -> أدخال الإستعلامات','?step=4');
 }
if ($PowerBB->_GET['step'] == 4)
{
	$PowerBB->html->cells('عمليات الاضافه','main1');
	$PowerBB->html->close_table();


	$p[17] 		= 	$PowerBB->install->AddIcon_columns_number();
	$msgs[17] 	= 	($p[17]) ? 'تم إنشاء حقل icon_columns_number' : 'لم يتم إنشاء حقل icon_columns_number';

	$p[18] 		= 	$PowerBB->install->AddSmil_columns_number();
	$msgs[18] 	= 	($p[18]) ? 'تم إنشاء حقل smil_columns_number' : 'لم يتم إنشاء حقل smil_columns_number';

    $p[19] 		= 	$PowerBB->install->AddAvatar_columns_number();
	$msgs[19] 	= 	($p[19]) ? 'تم إنشاء حقل avatar_columns_number' : 'لم يتم إنشاء حقل avatar_columns_number';

	$p[20] 		= 	$PowerBB->install->AddIcons_numbers();
	$msgs[20] 	= 	($p[20]) ? 'تم إنشاء حقل icons_numbers' : 'لم يتم إنشاء حقل icons_numbers';

	$PowerBB->html->open_p();

	foreach ($msgs as $msg)
	{
		$PowerBB->html->p_msg($msg);
	}

$PowerBB->html->close_p();

$PowerBB->html->close_table();
$PowerBB->html->make_link('الخطوه الخامسة -> أدخال الإستعلامات','?step=5');
 }
if ($PowerBB->_GET['step'] == 5)
{
	$PowerBB->html->cells('عمليات الاضافه','main1');
	$PowerBB->html->close_table();


	$p[21] 		= 	$PowerBB->install->Addview_subject();
	$msgs[21] 	= 	($p[21]) ? 'تم إنشاء حقل view_subject' : 'لم يتم إنشاء حقل view_subject';
	$p[22] 		= 	$PowerBB->install->Addadmincp_chat();
	$msgs[22] 	= 	($p[22]) ? 'تم إنشاء حقل admincp_chat' : 'لم يتم إنشاء حقل admincp_chat';
	$p[23] 		= 	$PowerBB->install->Addadmincp_extrafield();
	$msgs[23] 	= 	($p[23]) ? 'تم إنشاء حقل admincp_extrafield' : 'لم يتم إنشاء حقل admincp_extrafield';
	$p[24] 		= 	$PowerBB->install->Addadmincp_lang();
	$msgs[24] 	= 	($p[24]) ? 'تم إنشاء حقل admincp_lang' : 'لم يتم إنشاء حقل admincp_lang';
	$PowerBB->html->open_p();

	foreach ($msgs as $msg)
	{
		$PowerBB->html->p_msg($msg);
	}

$PowerBB->html->close_p();

$PowerBB->html->close_table();
$PowerBB->html->make_link('الخطوه السادسة -> أدخال الإستعلامات','?step=6');
 }
if ($PowerBB->_GET['step'] == 6)
{
	$PowerBB->html->cells('عمليات الاضافه','main1');
	$PowerBB->html->close_table();

	$p[25] 		= 	$PowerBB->install->Addadmincp_emailed();
	$msgs[25] 	= 	($p[25]) ? 'تم إنشاء حقل admincp_emailed' : 'لم يتم إنشاء حقل admincp_emailed';
	$p[26] 		= 	$PowerBB->install->Addadmincp_warn();
	$msgs[26] 	= 	($p[26]) ? 'تم إنشاء حقل admincp_warn' : 'لم يتم إنشاء حقل admincp_warn';
	$p[27] 		= 	$PowerBB->install->Addadmincp_award();
	$msgs[27] 	= 	($p[27]) ? 'تم إنشاء حقل admincp_award' : 'لم يتم إنشاء حقل admincp_award';
	$p[28] 		= 	$PowerBB->install->Addadmincp_multi_moderation();
	$msgs[28] 	= 	($p[28]) ? 'تم إنشاء حقل admincp_multi_moderation' : 'لم يتم إنشاء حقل admincp_multi_moderation';
	$p[29] 		= 	$PowerBB->install->UpdateGroups();
    $msgs[29] 	= 	($p[29]) ? 'تم تحديث المجموعات بقيم الحقول الجديدة' : 'لم يتم تحديث المجموعات بقيم الحقول الجديدة';

	$PowerBB->html->open_p();

	foreach ($msgs as $msg)
	{
		$PowerBB->html->p_msg($msg);
	}

$PowerBB->html->close_p();

$PowerBB->html->close_table();
$PowerBB->html->make_link('الخطوه السابعة -> أدخال الإستعلامات','?step=7');
 }
if ($PowerBB->_GET['step'] == 7)
{
	$PowerBB->html->cells('عمليات الاضافه','main1');
	$PowerBB->html->close_table();

	$p[30] 		= 	$PowerBB->install->AddPrefixInSubject();
	$msgs[30] 	= 	($p[30]) ? 'تم إنشاء حقل prefix_subject in Subject Table' : 'لم يتم إنشاء حقل prefix_subject in Subject Table';

	$p[31] 		= 	$PowerBB->install->AddPrefixSubjectInSection();
	$msgs[31] 	= 	($p[31]) ? 'تم إنشاء حقل prefix_subject in Section Table' : 'لم يتم إنشاء حقل prefix_subject in Section Table';

	$p[32] 		= 	$PowerBB->install->AddActivePrefixSubject();
	$msgs[32] 	= 	($p[32]) ? 'تم إنشاء حقل active_prefix_subject' : 'لم يتم إنشاء حقل active_prefix_subject';

	$p[33] 		= 	$PowerBB->install->AddTimeoffset();
	$msgs[33] 	= 	($p[33]) ? 'تم إنشاء حقل timeoffset' : 'لم يتم إنشاء حقل timeoffset';

	$p[34] 		= 	$PowerBB->install->AddDatesystem();
	$msgs[34] 	= 	($p[34]) ? 'تم إنشاء حقل datesystem' : 'لم يتم إنشاء حقل datesystem';

	$p[35] 		= 	$PowerBB->install->AddAnnouncementVisitor();
	$msgs[35] 	= 	($p[35]) ? 'تم إنشاء حقل visitor' : 'لم يتم إنشاء حقل visitor';

	$PowerBB->html->open_p();

	foreach ($msgs as $msg)
	{
		$PowerBB->html->p_msg($msg);
	}
$PowerBB->html->close_p();

$PowerBB->html->close_table();
$PowerBB->html->make_link('الخطوه الثامنة -> أدخال الإستعلامات','?step=8');
 }
if ($PowerBB->_GET['step'] == 8)
{
	$PowerBB->html->cells('عمليات الاضافه','main1');
	$PowerBB->html->close_table();

	$p[36] 		= 	$PowerBB->install->AddActive_forum_online_number();
	$msgs[36] 	= 	($p[36]) ? 'تم إنشاء حقل active_forum_online_number' : 'لم يتم إنشاء حقل active_forum_online_number';

	$p[37] 		= 	$PowerBB->install->UpdateTimesystem();
	$msgs[37] 	= 	($p[37]) ? 'تم تحديث حقل timesystem' : 'لم يتم تحديث حقل timesystem';

	$p[38] 		= 	$PowerBB->install->Addbday_day();
	$msgs[38] 	= 	($p[38]) ? 'تم إنشاء حقل bday_day' : 'لم يتم إنشاء حقل bday_day';

	$p[39] 		= 	$PowerBB->install->Addbday_month();
	$msgs[39] 	= 	($p[39]) ? 'تم إنشاء حقل bday_month' : 'لم يتم إنشاء حقل bday_month';

	$p[40] 		= 	$PowerBB->install->Addbday_year();
	$msgs[40] 	= 	($p[40]) ? 'تم إنشاء حقل bday_year' : 'لم يتم إنشاء حقل bday_year';

	$p[41] 		= 	$PowerBB->install->Addactive_birth_date();
	$msgs[41] 	= 	($p[41]) ? 'تم إنشاء حقل active_birth_date' : 'لم يتم إنشاء حقل active_birth_date';

	$PowerBB->html->open_p();

	foreach ($msgs as $msg)
	{
		$PowerBB->html->p_msg($msg);
	}

$PowerBB->html->close_p();

$PowerBB->html->close_table();
$PowerBB->html->make_link('الخطوه التاسعة -> أدخال الإستعلامات','?step=9');
 }
if ($PowerBB->_GET['step'] == 9)
{
	$PowerBB->html->cells('عمليات الاضافه','main1');
	$PowerBB->html->close_table();

	$p[42] 		= 	$PowerBB->install->AddViewSubjectSection();
	$msgs[42] 	= 	($p[42]) ? 'تم إنشاء حقل view_subject' : 'لم يتم إنشاء حقل view_subject';

	$p[43] 		= 	$PowerBB->install->AddClosePollSubject();
	$msgs[43] 	= 	($p[43]) ? 'تم إنشاء حقل close_poll_subject' : 'لم يتم إنشاء حقل close_poll_subject';

	$p[44] 		= 	$PowerBB->install->Addactive_worms_pbb();
	$msgs[44] 	= 	($p[44]) ? 'تم إنشاء حقل active_worms_pbb' : 'لم يتم إنشاء حقل active_worms_pbb';

	$p[45] 		= 	$PowerBB->install->Addshelluser();
	$msgs[45] 	= 	($p[45]) ? 'تم إنشاء حقل shelluser' : 'لم يتم إنشاء حقل shelluser';

	$p[46] 		= 	$PowerBB->install->Addshellpswd();
	$msgs[46] 	= 	($p[46]) ? 'تم إنشاء حقل shellpswd' : 'لم يتم إنشاء حقل shellpswd';

	$p[47] 		= 	$PowerBB->install->Addshelladminemail();
	$msgs[47] 	= 	($p[47]) ? 'تم إنشاء حقل shelladminemail' : 'لم يتم إنشاء حقل shelladminemail';

	$PowerBB->html->open_p();

	foreach ($msgs as $msg)
	{
		$PowerBB->html->p_msg($msg);
	}
	$PowerBB->html->close_p();
$PowerBB->html->close_table();
$PowerBB->html->make_link('الخطوه العاشرة والأخيرة -> اتمام الترقية','?step=10');
}
elseif ($PowerBB->_GET['step'] == 10)
{
	$PowerBB->html->cells('الخطوة النهائية','main1');

	$PowerBB->html->close_table();

	 $Create_Feeds = $PowerBB->install->CreateFeeds();
	 $CreateTopicMod = $PowerBB->install->CreateTopicMod();
	 $NewVersion = $PowerBB->install->UpdateVersion();
     $UpdateMemberDefaultStyle = $PowerBB->install->UpdateMemberDefaultStyle();
     $UpdateSectionGroupCache = $PowerBB->install->UpdateSectionGroupCache();

		$PowerBB->html->open_p();
        $PowerBB->html->p_msg('تم الترقية إلى الأصدار 2.1.1 بنجاح');
		$PowerBB->html->close_p();

		$PowerBB->html->open_p();
		$PowerBB->html->make_link('البدأ بالترقية إلى الإصدار 2.1.2','upg_212.php?step=1');
		$PowerBB->html->close_p();


}


?>
