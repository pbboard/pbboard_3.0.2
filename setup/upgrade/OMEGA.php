<?php

/**********
* Text to utf-8 converter By : Alexander Minkovsky (a_minkovsky@hotmail.com)
* Source : http://phpclasses.waaf.net/browse/package/1974.html
***********/

/**
* 	OMEGA upgrager :
*		1- Change registe_date size in member table
*		2- Change date size in pm table
*		3- Change date size in announcement table
*		4- Drop contactus_extensions table
*		5- Drop contactus_messages table
*		6- Drop contactus_settings table
*		7- Drop membergroup table
*		8- Drop write_date field in reply table
*		9- Drop gmt_time field in reply table
*		10- Drop reply_time field in subject table
*		11- Drop wr_date field in subject table
*		12- Drop gmt_time field in subject table
*		13- Drop lastreply_date field in subject table
*		14- Rename avater to avatar
*		15- Rename emailmsgs to email_msg
*		16- Rename pmfolder to pm_folder
*		17- Rename pmlists to pm_lists
*		18- Change charset from CP1256 to UTF-8
*		19- Fix icons path
*		20- Fix smiles path
*		21- Add PowerBB_banned table which deleted in 1.5!
*		22- Change smile_path size in smiles table
*		23- Add style_cache field in member table
*		24- Add style_id_cache field in member table
*		25- Add should_update_style_cache field in member table
*		26- Add today_date_cache in info table
*		27- Add today_number_cache in info table
*		28- Add adress_bar_separate in info table
*/

define('NO_TEMPLATE',true);

$CALL_SYSTEM				= 	array();
$CALL_SYSTEM['SECTION'] 	= 	true;
$CALL_SYSTEM['ICONS'] 		= 	true;
$CALL_SYSTEM['MODERATORS'] 	= 	true;
$CALL_SYSTEM['GROUP'] 		= 	true;
$CALL_SYSTEM['SUBJECT'] 	= 	true;

include('../common.php');

class PowerBBOMEGA extends PowerBBInstall
{
	var $_TempArr 	= 	array();
	var $_Masseges	=	array();
	// Text to utf-8 variables
	var $ascMap = array();
	var $utfMap = array();
	var $charset;

	//
	function CheckVersion()
	{
		global $PowerBB;

		return ($PowerBB->_CONF['info_row']['MySBB_version'] == '2.0 SEGMA') ? true : false;
	}

	function UpdateVersion()
	{
		global $PowerBB;

		$update = $PowerBB->DB->sql_query("UPDATE " . $PowerBB->table['info'] . " SET value='2.0 OMEGA' WHERE var_name='MySBB_version'");

		return ($update) ? true : false;
	}

	// Change operation(s)
	function ChangeRegisterDate()
	{
		global $PowerBB;


	  $change = $PowerBB->DB->sql_query("ALTER TABLE " . $PowerBB->table['member'] . " CHANGE register_date register_date VARCHAR( 100 ) NOT NULL");

	  return ($change) ? true : false;

	}

	function ChangePrivateMassegeDate()
	{
		global $PowerBB;

		 $change = $PowerBB->DB->sql_query("ALTER TABLE " . $PowerBB->table['pm'] . " CHANGE date date VARCHAR( 100 ) NOT NULL");

         return ($change) ? true : false;
	}

	function ChangeAnnouncementDate()
	{
		global $PowerBB;

		 $change = $PowerBB->DB->sql_query("ALTER TABLE " . $PowerBB->table['announcement'] . " CHANGE date date VARCHAR( 100 ) NOT NULL");

		 return ($change) ? true : false;
	}

	function ChangeSmilePath()
	{
		global $PowerBB;

		 $change = $PowerBB->DB->sql_query("ALTER TABLE " . $PowerBB->table['smiles'] . " CHANGE smile_path smile_path VARCHAR( 255 ) NOT NULL");

        return ($change) ? true : false;
	}

	// Drop operation(s)
	function DropContactusTables()
	{
		global $PowerBB;

		$drop = array();
		$drop[0] = $this->drop_table($PowerBB->prefix . 'contactus_extensions');
		$drop[1] = $this->drop_table($PowerBB->prefix . 'contactus_messages');
		$truncate[2] = $this->truncate_table($PowerBB->prefix . 'today');

		return ($drop[0] and $drop[1] and $truncate[2]) ? true : false;
	}

	function DropWriteDateField()
	{
		global $PowerBB;

		$drop = $PowerBB->DB->sql_query("ALTER TABLE " . $PowerBB->table['reply'] . " DROP write_date");

       return ($drop) ? true : false;
	}

	function DropGMTimeFieldReply()
	{
		global $PowerBB;

		$drop = $PowerBB->DB->sql_query("ALTER TABLE " . $PowerBB->table['reply'] . " DROP gmt_time");

		return ($drop) ? true : false;
	}

	function DropReplyTimeField()
	{
		global $PowerBB;

        $drop = $PowerBB->DB->sql_query("ALTER TABLE " . $PowerBB->table['subject'] . " DROP reply_time");

        return ($drop) ? true : false;
	}

	function DropWRDateField()
	{
		global $PowerBB;

        $drop = $PowerBB->DB->sql_query("ALTER TABLE " . $PowerBB->table['subject'] . " DROP wr_date");

        return ($drop) ? true : false;
	}

	function DropGMTimeFieldSubject()
	{
		global $PowerBB;

        $drop = $PowerBB->DB->sql_query("ALTER TABLE " . $PowerBB->table['subject'] . " DROP gmt_time");

        return ($drop) ? true : false;
	}

	function DropLastReplyDateField()
	{
		global $PowerBB;

        $drop = $PowerBB->DB->sql_query("ALTER TABLE " . $PowerBB->table['subject'] . " DROP lastreply_date");

        return ($drop) ? true : false;
	}

	// Rename operation(s)
	function RenameAvatarTable()
	{
		global $PowerBB;

		$rename = $this->rename_table($PowerBB->prefix . 'avater',$PowerBB->prefix . 'avatar');

		return ($rename) ? true : false;
	}

	function RenameEmailMassegesTable()
	{
		global $PowerBB;

		$rename = $this->rename_table($PowerBB->prefix . 'emailmsgs',$PowerBB->prefix . 'email_msg');

		return ($rename) ? true : false;
	}

	function RenamePMFolderTable()
	{
		global $PowerBB;

		$rename = $this->rename_table($PowerBB->prefix . 'pmfolder',$PowerBB->prefix . 'pm_folder');

		return ($rename) ? true : false;
	}

	function RenamePMListsTable()
	{
		global $PowerBB;

		$rename = $this->rename_table($PowerBB->prefix . 'pmlists',$PowerBB->prefix . 'pm_lists');

		return ($rename) ? true : false;
	}


	// Repair operation(s)
	function RepairDefaultStyle()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query("INSERT INTO " . $PowerBB->table['style'] . " SET
												style_title='النمط الافتراضي',
												style_on='1',
												style_order='0',
												style_path='look/styles/forum/main/css/style.css',
												image_path='look/styles/forum/main/images',
												template_path='look/styles/forum/main/templates',
												cache_path='look/styles/forum/main/compiler'
												");

		if ($insert)
		{
			$id = $PowerBB->DB->sql_insert_id();

			$update = $PowerBB->DB->sql_query("UPDATE " . $PowerBB->table['info'] . " SET value='" . $id . "' WHERE var_name='def_style'");

			if ($update)
			{
				$update = $PowerBB->DB->sql_query("UPDATE " . $PowerBB->table['member'] . " SET style='" . $id . "'");

				return ($update) ? true : false;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}

	function FixIconsPath()
	{
		global $PowerBB;

		$query = $PowerBB->DB->sql_query("SELECT * FROM " . $PowerBB->table['smiles'] . " WHERE smile_type='1'");

		$state = array();

		while ($r = $PowerBB->DB->sql_fetch_array($query))
		{
			$update = $PowerBB->DB->sql_query("UPDATE " . $PowerBB->table['smiles']  . " SET smile_path='look/images/icons/" . $r['smile_path'] . "' WHERE id='" . $r['id'] . "'");

			if ($update)
			{
				$state[] = 'true';
			}
			else
			{
				$state[] = 'false';
			}
		}

		return $state;
	}

    	function GetAttachSubject()
	{
		global $PowerBB;

             $attach_query = $PowerBB->DB->sql_query("SELECT * FROM " . $PowerBB->table['attach'] . " WHERE reply<>'1'");
                while ($attach_row = $PowerBB->DB->sql_fetch_array($attach_query))
                {
                        $update = $PowerBB->DB->sql_query("UPDATE " . $PowerBB->table['subject']  . " SET attach_subject='1' WHERE id='" . $attach_row['subject_id'] . "'");


                }
   }
       	function GetAttachReply()
	{
		global $PowerBB;

             $attach_query = $PowerBB->DB->sql_query("SELECT * FROM " . $PowerBB->table['attach'] . " WHERE reply='1'");
                while ($attach_row = $PowerBB->DB->sql_fetch_array($attach_query))
                {
                        $update = $PowerBB->DB->sql_query("UPDATE " . $PowerBB->table['reply']  . " SET attach_reply='1' WHERE id='" . $attach_row['subject_id'] . "'");

                }
   }

	function FixSmilesPath()
	{
		global $PowerBB;

		$query = $PowerBB->DB->sql_query("SELECT * FROM " . $PowerBB->table['smiles'] . " WHERE smile_type='0'");

		$state = array();

		while ($r = $PowerBB->DB->sql_fetch_array($query))
		{
			$s = str_replace('image/smiles/','',$r['smile_path']);

			$update = $PowerBB->DB->sql_query("UPDATE " . $PowerBB->table['smiles']  . " SET smile_path='look/images/smiles/" . $s . "' WHERE id='" . $r['id'] . "'");

			if ($update)
			{
				$state[] = 'true';
			}
			else
			{
				$state[] = 'false';
			}
		}

		return $state;
	}


    function changeEncoding_DbToUtf8()
	{
		global $PowerBB;

		$update = $PowerBB->DB->sql_query("ALTER DATABASE " . $config['db']['prefix'] . $config['db']['name']  . " DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ");

	}

	// Text to utf-8 functions, By : Alexander Minkovsky (a_minkovsky@hotmail.com)
	function loadCharset()
	{
		$lines = @file_get_contents('./CP1256.MAP');
    	$this->charset = $charset;
    	$lines = @preg_replace("/#.*$/m","",$lines); // Delete comments
    	$lines = @preg_replace("/\n\n/","",$lines); // Delete double new line
    	$lines = explode("\n",$lines);

    	foreach ($lines as $line)
    	{
    		$parts = explode('0x',$line);

    		if (count($parts) == 3)
    		{
    			$asc = hexdec(substr($parts[1],0,2));
    			$utf = hexdec(substr($parts[2],0,4));

    			$this->ascMap[$charset][$asc]=$utf;
    		}
    	}

    	$this->utfMap = array_flip($this->ascMap[$charset]);
    }


	function strToUtf8($str)
	{
		$chars = unpack('C*', $str);
		$cnt = count($chars);

		for ($i=1; $i<=$cnt; $i++)
		{
			$this->_charToUtf8($chars[$i]);
		}

		return implode("",$chars);
	}



	function _charToUtf8(&$char)
	{
		$c = (int)$this->ascMap[$this->charset][$char];

    	if ($c < 0x80)
    	{
    		$char = chr($c);
    	}
    	elseif ($c<0x800) // 2 bytes
    	{
    		$char = (chr(0xC0 | $c>>6) . chr(0x80 | $c & 0x3F));
    	}
    	else if($c<0x10000) // 3 bytes
    	{
    		$char = (chr(0xE0 | $c>>12) . chr(0x80 | $c>>6 & 0x3F) . chr(0x80 | $c & 0x3F));
    	}
    	else if($c<0x200000) // 4 bytes
    	{
    		$char = (chr(0xF0 | $c>>18) . chr(0x80 | $c>>12 & 0x3F) . chr(0x80 | $c>>6 & 0x3F) . chr(0x80 | $c & 0x3F));
    	}
    }
    // End of Text to utf-8 functions

    ////

    function CreateBannedTable()
    {
    	global $PowerBB;

		$this->_TempArr['CreateArr']				= 	array();
		$this->_TempArr['CreateArr']['table_name'] 	= 	$PowerBB->table['banned'];
		$this->_TempArr['CreateArr']['fields'] 		= 	array();
		$this->_TempArr['CreateArr']['fields'][] 	= 	'id INT( 9 ) NOT NULL AUTO_INCREMENT PRIMARY KEY';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'text VARCHAR( 100 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'text_type INT( 1 ) NOT NULL';

		$create = $this->create_table($this->_TempArr['CreateArr']);

		return ($create) ? true : false;
    }

    function CreateLang()
    {
    	global $PowerBB;

		$this->_TempArr['CreateArr']				= 	array();
		$this->_TempArr['CreateArr']['table_name'] 	= 	$PowerBB->table['lang'];
		$this->_TempArr['CreateArr']['fields'] 		= 	array();
		$this->_TempArr['CreateArr']['fields'][] 	= 	'id INT( 9 ) NOT NULL AUTO_INCREMENT PRIMARY KEY';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'lang_title varchar( 200 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'lang_order int(9) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'lang_on int( 1 ) NOT NULL';
		$this->_TempArr['CreateArr']['fields'][] 	= 	'lang_path varchar( 200 ) NOT NULL';

		$create = $this->create_table($this->_TempArr['CreateArr']);

		return ($create) ? true : false;
    }

    function InsertLang()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query("INSERT INTO " . $PowerBB->table['lang'] . " SET
												lang_title='Arabic Language',
												lang_order='1',
												lang_on='1',
												lang_path='ar'
												");

		return ($insert) ? true : false;
	}

	function CreateFaq()
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

	function AddForumsCache()
	{
		global $PowerBB;

		$this->_TempArr['AddArr'] 				= array();
		$this->_TempArr['AddArr']['table'] 		= $PowerBB->table['section'];
		$this->_TempArr['AddArr']['field_name'] = 'forums_cache'; // Changed in THATA 1
		$this->_TempArr['AddArr']['field_des'] 	= 'TEXT';

		$add = $this->add_field($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

	function AddGroupName()
	{
		global $PowerBB;

		$this->_TempArr['AddArr'] 			= 	array();
		$this->_TempArr['AddArr']['table'] 		= 	$PowerBB->table['section_group'];
		$this->_TempArr['AddArr']['field_name'] 	= 	'group_name';
		$this->_TempArr['AddArr']['field_des'] 		= 	'VARCHAR(255) NOT NULL';

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

	function AddSectionsNumber()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='sections_number',value='0'");

		return ($insert) ? true : false;
	}


	function AddSubSectionsNumber()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='subsections_number',value='0'");

		return ($insert) ? true : false;
	}

	function AddSectionGroupNumber()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='sectiongroup_number',value='0'");


		return ($insert) ? true : false;
	}

	function AddSmilesNumber()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='smiles_number',value='0'");

		return ($insert) ? true : false;
	}

	function AddReplyNumber()
	{
		global $PowerBB;

		$this->_TempArr['AddArr'] 				= array();
		$this->_TempArr['AddArr']['table'] 		= $PowerBB->table['section'];
		$this->_TempArr['AddArr']['field_name'] = 'reply_num';
		$this->_TempArr['AddArr']['field_des'] 	= 'INT ( 9 )';

		$add = $this->add_field($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

	function AddSubjectNumber()
	{
		global $PowerBB;

		$this->_TempArr['AddArr'] 				= array();
		$this->_TempArr['AddArr']['table'] 		= $PowerBB->table['section'];
		$this->_TempArr['AddArr']['field_name'] = 'subject_num';
		$this->_TempArr['AddArr']['field_des'] 	= 'INT ( 9 )';

		$add = $this->add_field($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

	///

	function AddStyleCache()
	{
		global $PowerBB;

		$this->_TempArr['AddArr'] 				= array();
		$this->_TempArr['AddArr']['table'] 		= $PowerBB->table['member'];
		$this->_TempArr['AddArr']['field_name'] = 'style_cache';
		$this->_TempArr['AddArr']['field_des'] 	= 'TEXT';

		$add = $this->add_field($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

	function AddStyleIDCache()
	{
		global $PowerBB;

		$this->_TempArr['AddArr'] 				= array();
		$this->_TempArr['AddArr']['table'] 		= $PowerBB->table['member'];
		$this->_TempArr['AddArr']['field_name'] = 'style_id_cache';
		$this->_TempArr['AddArr']['field_des'] 	= 'INT( 9 )';

		$add = $this->add_field($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

	function AddUpdateStyleCache()
	{
		global $PowerBB;

		$this->_TempArr['AddArr'] 				= array();
		$this->_TempArr['AddArr']['table'] 		= $PowerBB->table['member'];
		$this->_TempArr['AddArr']['field_name'] = 'should_update_style_cache';
		$this->_TempArr['AddArr']['field_des'] 	= 'INT( 1 )';

		$add = $this->add_field($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

	function AddTodayDateCache()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='today_date_cache',value='ar'");

		return ($insert) ? true : false;
	}

	function AddTodayNumberCache()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='today_number_cache'");

		return ($insert) ? true : false;
	}

	function AddAdressBarSeparate()
	{
		global $PowerBB;

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " VALUES('NULL','adress_bar_separate','&raquo')");

		return ($insert) ? true : false;
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

		// Finally : Add section group cache
	function AddSectionGroupCache()
	{
		global $PowerBB;

		$this->_TempArr['AddArr']					=	array();
		$this->_TempArr['AddArr']['table']			=	$PowerBB->table['section'];
		$this->_TempArr['AddArr']['field_name']		=	'sectiongroup_cache';
		$this->_TempArr['AddArr']['field_des']		=	'TEXT NOT NULL';

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

	function UpdateForumsCache()
	{
		global $PowerBB;


					$SecArr 					= 	array();
					$SecArr['get_from']			=	'db';
					$SecArr['proc'] 			= 	array();
					$SecArr['proc']['*'] 		= 	array('method'=>'clean','param'=>'html');
					$SecArr['order']			=	array();
					$SecArr['order']['field']	=	'sort';
					$SecArr['order']['type']	=	'ASC';


					$SecList = $PowerBB->core->GetList($SecArr,'section');

					$x = 0;
					$y = sizeof($SecList);
					$s = array();

					while ($x < $y)
					{
						$name = 'order-' . $SecList[$x]['id'];

						if ($SecList[$x]['order'] != $PowerBB->_POST[$name])
						{
							$UpdateArr 						= 	array();

							$UpdateArr['field']		 		= 	array();
							$UpdateArr['field']['sort'] 	= 	$PowerBB->_POST[$name];

							$UpdateArr['where'] 			=	array('id',$SecList[$x]['id']);

							$update = $PowerBB->core->Update($UpdateArr,'section');


							$s[$SecList[$x]['id']] = ($update) ? 'true' : 'false';
						}

						$x += 1;
					}

        		$cache = $PowerBB->section->UpdateSectionsCache(array('type'=>'normal'));
		return ($cache) ? true : false;
	}

	function UpdateSubForumsCache()
	{
		global $PowerBB;

		$SecArr 					= 	array();
		$SecArr['get_from']			=	'db';
		$SecArr['proc'] 			= 	array();
		$SecArr['proc']['*'] 		= 	array('method'=>'clean','param'=>'html');
		$SecArr['order']			=	array();
		$SecArr['order']['field']	=	'sort';
		$SecArr['order']['type']	=	'ASC';

		$SecList = $PowerBB->core->GetList($SecArr,'section');

		$x = 0;
		$y = sizeof($SecList);
		$s = array();

		while ($x < $y)
		{
			$name = 'order-' . $SecList[$x]['id'];

			if ($SecList[$x]['order'] != $PowerBB->_POST[$name])
			{
				$UpdateArr 						= 	array();

				$UpdateArr['field']		 		= 	array();
				$UpdateArr['field']['sort'] 	= 	$PowerBB->_POST[$name];

				$UpdateArr['where'] 			=	array('id',$SecList[$x]['id']);

				$update = $PowerBB->core->Update($UpdateArr,'section');


				$s[$SecList[$x]['id']] = ($update) ? 'true' : 'false';
			}

			$x += 1;
		}

		$query = $PowerBB->DB->sql_query('SELECT * FROM ' . $PowerBB->table['section']);

		$cache = array();

		while ($r = $PowerBB->DB->sql_fetch_array($query))
		{
			$update = $PowerBB->section->UpdateSectionsCache(array('type'=>'sub','from'=>$r['id']));

			$cache[$r['id']] = ($update) ? 'true' : 'false';
		}

		return (!in_array('false',$cache)) ? true : false;

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

				$SecArr['field']['group_name'] 			= 	$groups[$x]['title'];
				$SecArr['where'] 	= 	array('group_id',$groups[$x]['id']);

				$update = $PowerBB->group->UpdateSectionGroup($SecArr);



			$CacheArr 			= 	array();
			$CacheArr['id'] 	= 	$sections[$x]['id'];

			$cache = $PowerBB->group->UpdateSectionGroupCache($CacheArr);
            				$x += 1;


			}


		return ($cache) ? true : false;
	}

	function UpdateSmilesNumberCache()
	{
		global $PowerBB;

		 $cache = $PowerBB->icon->UpdateSmilesCache(null);

			if ($cache)
			{
				$num = $PowerBB->icon->GetSmilesNumber(null);

				$number = $PowerBB->info->UpdateInfo(array('value'=>$num,'var_name'=>'smiles_number'));

			}

	}
}

$PowerBB->install = new PowerBBOMEGA;

$PowerBB->html->page_header('معالج ترقية برنامج منتديات PBBoard v2.0.3');

$logo = $PowerBB->html->create_image(array('align'=>'right','alt'=>'PowerBB','src'=>'../logo.jpg','return'=>true));
$PowerBB->html->open_table('100%',true);
$PowerBB->html->cells($logo,'header_logo_side');

if (!$PowerBB->install->CheckVersion())
{
	$PowerBB->html->cells('اصدار غير صحيح','main1');
	$PowerBB->html->close_table();

	$PowerBB->functions->errorstop('يرجى التحقق من انك قمت بتشغيل تحديثات SEGMA');
}

if ($PowerBB->_GET['step'] == 1)
{
	$PowerBB->html->cells('عمليات التغيير','main1');
	$PowerBB->html->close_table();

	$p 			= 	array();
	$msgs 		= 	$PowerBB->install->_Masseges;

	$p[1] 		= 	$PowerBB->install->ChangeRegisterDate();
	$msgs[1] 	= 	($p[1]) ? 'تم تغيير حجم حقل تاريخ التسجيل' : 'لم يتم تغيير حجم حقل تاريخ التسجيل';

	$p[2]		=	$PowerBB->install->ChangePrivateMassegeDate();
	$msgs[2]	=	($p[2]) ? 'تم تغيير حجم حقل التاريخ في جدول الرسائل الخاصه' : 'لم يتم تغيير حجم حقل التاريخ في جدول الرسائل الخاصه';

	$p[3]		=	$PowerBB->install->ChangeAnnouncementDate();
	$msgs[3]	=	($p[3]) ? 'تم تغيير حقل التاريخ في جدول الاعلانات الاداريه' : 'لم يتم تغيير حقل التاريخ في جدول الاعلانات الاداريه';

	$p[4]		=	$PowerBB->install->ChangeSmilePath();
	$msgs[4]	=	($p[4]) ? 'تم تغيير حقل المسار في جدول الابتسامات' : 'لم يتم تغيير حقل المسار في جدول الابتسامات';

	$PowerBB->html->open_p();

	foreach ($msgs as $msg)
	{
		$PowerBB->html->p_msg($msg);
	}

	$PowerBB->html->close_p();

	$PowerBB->html->make_link('الخطوه الثانيه -> عمليات الحذف','?step=2');
}
elseif ($PowerBB->_GET['step'] == 2)
{
	$PowerBB->html->cells('عمليات الحذف','main1');
	$PowerBB->html->close_table();

	$p 			= 	array();
	$msgs 		= 	$PowerBB->install->_Masseges;

	$p[1] 		= 	$PowerBB->install->DropContactusTables();
	$msgs[1] 	= 	($p[1]) ? 'تم حذف الجداول الثلاثه' : 'لم يتم حذف الجداول الثلاثه';

	$p[2]		=	$PowerBB->install->DropWriteDateField();
	$msgs[2]	=	($p[2]) ? 'تم حذف الحقل write_date' : 'لم يتم تغيير حقل التاريخ في جدول الاعلانات الاداريه';

	$p[3] 		= 	$PowerBB->install->DropGMTimeFieldReply();
	$msgs[3] 	= 	($p[3]) ? 'تم حذف حقل توقيت GMT' : 'لم يتم حذف حقل توقيت GMT';

	$p[4]		=	$PowerBB->install->DropReplyTimeField();
	$msgs[4]	=	($p[4]) ? 'تم حذف حقل reply_time' : 'لم يتم حذف حقل reply_time';

	$p[5]		=	$PowerBB->install->DropWRDateField();
	$msgs[5]	=	($p[5]) ? 'تم حذف حقل wr_date' : 'لم يتم حذف حقل wr_date';

	$p[6]		=	$PowerBB->install->DropGMTimeFieldSubject();
	$msgs[6]	=	($p[6]) ? 'تم حذف حقل توقيت GMT في جدول المواضيع' : 'لم يتم حذف حقل توقيت GMT في جدول المواضيع';

	$p[7]		=	$PowerBB->install->DropLastReplyDateField();
	$msgs[7]	=	($p[7]) ? 'تم حذف حقل آخر رد' : 'لم يتم حذف حقل آخر رد';


	$PowerBB->html->open_p();

	foreach ($msgs as $msg)
	{
		$PowerBB->html->p_msg($msg);
	}

	$PowerBB->html->close_p();

	$PowerBB->html->make_link('الخطوه الثالثه -> عمليات تغيير الاسم','?step=3');
}
elseif ($PowerBB->_GET['step'] == 3)
{
	$PowerBB->html->cells('عمليات تغيير الاسم','main1');
	$PowerBB->html->close_table();

	$p 			= 	array();
	$msgs 		= 	$PowerBB->install->_Masseges;

	$p[0]		=	$PowerBB->install->RenameAvatarTable();
	$msgs[0]	=	($p[0]) ? 'تم تغيير اسم الجدول #1' : 'لم يتم تغيير اسم الجدول #1';

	$p[1]		=	$PowerBB->install->RenameEmailMassegesTable();
	$msgs[1]	=	($p[1]) ? 'تم تغيير اسم الجدول #2' : 'لم يتم تغيير اسم الجدول #2';

	$p[2]		=	$PowerBB->install->RenamePMFolderTable();
	$msgs[2]	=	($p[2]) ? 'تم تغيير اسم الجدول #3' : 'لم يتم يتغيير اسم الجدول #3';

	$p[3]		=	$PowerBB->install->RenamePMListsTable();
	$msgs[3]	=	($p[3]) ? 'تم تغيير اسم الجدول #4' : 'لم يتم تغيير اسم الجدول #4';

	$PowerBB->html->open_p();

	foreach ($msgs as $msg)
	{
		$PowerBB->html->p_msg($msg);
	}

	$PowerBB->html->close_p();

	$PowerBB->html->make_link('الخطوه الرابعه : تغيير ترميز المواضيع','?step=4&amp;page=1');
}
elseif ($PowerBB->_GET['step'] == 4)
{
	$PowerBB->html->cells('الخطوه الرابعه : تغيير ترميز المواضيع','main1');
	$PowerBB->html->close_table();

    $PowerBB->install->changeEncoding_DbToUtf8();
	$PowerBB->install->loadCharset();

					 $page  = intval($PowerBB->_GET['page']);
                     $start = (150 * ($page-1));

        $query = $PowerBB->DB->sql_query('SELECT * FROM ' . $PowerBB->table['subject'] . ' ORDER BY id ASC LIMIT ' . $start . ',150 ');

       $RP = $PowerBB->DB->sql_num_rows($PowerBB->DB->sql_query('SELECT * FROM ' . $PowerBB->table['subject'] . ' ORDER BY id ASC'));


	$PowerBB->html->open_p();

	while ($r = $PowerBB->DB->sql_fetch_array($query))
	{
		$title 		= 	$PowerBB->install->strToUtf8($r['title']);
		$text 		= 	$PowerBB->install->strToUtf8($r['text']);
		$writer 	= 	$PowerBB->install->strToUtf8($r['writer']);
		$icon 	= 	"look/images/icons/". $r['icon'];
		$last_replier 	= 	$PowerBB->install->strToUtf8($r['last_replier']);
		$describe 	= 	$PowerBB->install->strToUtf8($r['subject_describe']);
		$action_by 	= 	$PowerBB->install->strToUtf8($r['action_by']);

        $title = str_ireplace("'","",$title);
		$text = str_ireplace("'","",$text);
		$text = str_ireplace("\t","",$text);
		$text = str_ireplace("\n","",$text);
		$text= str_replace (array('\\', '\\n'), "", $text);
		$writer = str_ireplace("'","",$writer);
		$icon = str_ireplace("'","",$icon);
		$last_replier = str_ireplace("'","",$last_replier);
		$describe = str_ireplace("'","",$describe);
		$action_by = str_ireplace("'","",$action_by);

		$update = $PowerBB->DB->sql_query("UPDATE " . $PowerBB->table['subject'] . " SET
												title='" . mysql_escape_string($title) . "',
												text='" . mysql_escape_string($text) . "',
												writer='" . mysql_escape_string($writer) . "',
												icon='" . mysql_escape_string($icon) . "',
												last_replier='" . mysql_escape_string($last_replier) . "',
												subject_describe='" . mysql_escape_string($describe) . "',
												action_by='" . mysql_escape_string($action_by) . "'
												WHERE id='" . $r['id'] . "'");

     	if ($update)
		{
			$PowerBB->html->p_msg('تم تغيير ترميز الموضوع رقم #' . $r['id']);
		}

 }


      	if ($update)
		{
	     $PowerBB->html->open_p();
		 $page = $PowerBB->_GET['page']+1;
	     $PowerBB->html->make_link(' استكمال تغيير ترميز المواضيع','?step=4&amp;page=' . $page);


		}
		else
       {
       	$PowerBB->html->close_p();
	    $PowerBB->html->make_link('<br>الخطوه الخامسه : تغيير ترميز الردود','?step=5&amp;page=1');
	   }
}
elseif ($PowerBB->_GET['step'] == 5)
{
	$PowerBB->html->cells('الخطوه الخامسه : تغيير ترميز الردود','main1');
	$PowerBB->html->close_table();

	$PowerBB->install->loadCharset();


					 $page  = intval($PowerBB->_GET['page']);
                     $start = (200 * ($page-1));

	$query = $PowerBB->DB->sql_query('SELECT * FROM ' . $PowerBB->table['reply'] . ' ORDER BY id ASC LIMIT ' . $start . ',200 ');


	$PowerBB->html->open_p();

	while ($r = $PowerBB->DB->sql_fetch_array($query))
	{

		$title 		= 	$PowerBB->install->strToUtf8($r['title']);
		$text 		= 	$PowerBB->install->strToUtf8($r['text']);
		$writer 	= 	$PowerBB->install->strToUtf8($r['writer']);
		$icon 	= 	"look/images/icons/". $r['icon'];
		$action_by 	= 	$PowerBB->install->strToUtf8($r['action_by']);


		$title = str_ireplace("'","",$title);
		$text = str_ireplace("'","",$text);
		$text = str_ireplace("\t","",$text);
		$text = str_ireplace("\n","",$text);
		$text= str_replace (array('\\', '\\n'), "", $text);
		$writer = str_ireplace("'","",$writer);
		$icon = str_ireplace("'","",$icon);
		$action_by = str_ireplace("'","",$action_by);


	    $update = $PowerBB->DB->sql_query("UPDATE " . $PowerBB->table['reply'] . " SET
												title='" . mysql_escape_string($title) . "',
												text='" . mysql_escape_string($text) . "',
												writer='" . mysql_escape_string($writer) . "',
												icon='" . mysql_escape_string($icon) . "',
												action_by='" . mysql_escape_string($action_by) . "'
												WHERE id='" . $r['id'] . "'");


    	if ($update)
		{
			$PowerBB->html->p_msg('تم تغيير ترميز الرد رقم #' . $r['id']);
		}


	}

      	if ($update)
		{
     $PowerBB->html->open_p();
     $page = $PowerBB->_GET['page']+1;
     $PowerBB->html->make_link(' استكمال تغيير ترميز الردود','?step=5&amp;page=' . $page );
     }
     else
    {
	$PowerBB->html->close_p();

	$PowerBB->html->make_link('الخطوه السادسه : تغيير ترميز الملفات المرفقه','?step=6&amp;page=1');
	}
}
elseif ($PowerBB->_GET['step'] == 6)
{
	$PowerBB->html->cells('الخطوه السادسه : تغيير ترميز الملفات المرفقه','main1');
	$PowerBB->html->close_table();
    $PowerBB->install->GetAttachSubject();
    $PowerBB->install->GetAttachReply();

	$PowerBB->install->loadCharset();

					 $page  = intval($PowerBB->_GET['page']);
                     $start = (150 * ($page-1));

	$query = $PowerBB->DB->sql_query('SELECT * FROM ' . $PowerBB->table['attach'] . ' ORDER BY id ASC LIMIT ' . $start . ',150 ');


	$PowerBB->html->open_p();

	while ($r = $PowerBB->DB->sql_fetch_array($query))
	{
		$filename = $PowerBB->install->strToUtf8($r['filename']);

		$update = $PowerBB->DB->sql_query("UPDATE " . $PowerBB->table['attach'] . " SET
												filename='" . $filename . "'
													WHERE id='" . $r['id'] . "'");


		if ($update)
		{
			$PowerBB->html->p_msg('تم تغيير ترميز المرفق رقم #' . $r['id']);
		}

	}

	      	if ($update)
		{
	     $PowerBB->html->open_p();
		 $page = $PowerBB->_GET['page']+1;
     $PowerBB->html->make_link(' استكمال تغيير ترميز المرفقات','?step=6&amp;page=' . $page );


		}
		else
       {
       	$PowerBB->html->close_p();
	    $PowerBB->html->make_link('الخطوه السابعه : تغيير ترميز الرسائل البريديه','?step=7');
	   }

}
elseif ($PowerBB->_GET['step'] == 7)
{
	$PowerBB->html->cells('الخطوه السابعه : تغيير ترميز الرسائل البريديه','main1');
	$PowerBB->html->close_table();

	$PowerBB->install->loadCharset();

	$query = $PowerBB->DB->sql_query("SELECT * FROM " . $PowerBB->table['email_msg'] . " ORDER BY id ASC");

	$PowerBB->html->open_p();

	while ($r = $PowerBB->DB->sql_fetch_array($query))
	{
		$title = $PowerBB->install->strToUtf8($r['title']);
		$text = $PowerBB->install->strToUtf8($r['text']);

		$r['text'] = str_ireplace("'","",$r['text']);
		$text = str_ireplace("'","",$text);
		$title = str_ireplace("'","",$title);

		$update = $PowerBB->DB->sql_query("UPDATE " . $PowerBB->table['email_msg'] . " SET
												title='" . mysql_escape_string($title) . "',
												text='" . mysql_escape_string($text) . "'
													WHERE id='" . $r['id'] . "'");

		if ($update)
		{
			$PowerBB->html->p_msg('تم تغيير ترميز الرساله رقم #' . $r['id']);
		}
	}

	$PowerBB->html->close_p();

	$PowerBB->html->make_link('الخطوه الثامنه : تغيير ترميز المجموعات','?step=8');
}
elseif ($PowerBB->_GET['step'] == 8)
{
	$PowerBB->html->cells('الخطوه الثامنه : تغيير ترميز المجموعات','main1');
	$PowerBB->html->close_table();

	$PowerBB->install->loadCharset();

	$query = $PowerBB->DB->sql_query("SELECT * FROM " . $PowerBB->table['group'] . " ORDER BY id ASC");

	$PowerBB->html->open_p();

	while ($r = $PowerBB->DB->sql_fetch_array($query))
	{
		$title = $PowerBB->install->strToUtf8($r['title']);
		$user_title = $PowerBB->install->strToUtf8($r['user_title']);

		$update = $PowerBB->DB->sql_query("UPDATE " . $PowerBB->table['group'] . " SET
												title='" . mysql_escape_string($title) . "',
												user_title='" .  mysql_escape_string($user_title) . "'
													WHERE id='" . $r['id'] . "'");

		if ($update)
		{
			$PowerBB->html->p_msg('تم تغيير ترميز المجموعه رقم #' . $r['id']);
		}
	}

	$PowerBB->html->close_p();

	$PowerBB->html->make_link('الخطوه التاسعه : تغيير ترميز اعدادات المنتدى','?step=9');
}
elseif ($PowerBB->_GET['step'] == 9)
{
	$PowerBB->html->cells('الخطوه التاسعه : تغيير ترميز اعدادات المنتدى','main1');
	$PowerBB->html->close_table();

	$PowerBB->install->loadCharset();

	$query = $PowerBB->DB->sql_query("SELECT * FROM " . $PowerBB->table['info'] . " ORDER BY id ASC");

	$PowerBB->html->open_p();

	while ($r = $PowerBB->DB->sql_fetch_array($query))
	{
		$value = $PowerBB->install->strToUtf8($r['value']);

		$update = $PowerBB->DB->sql_query("UPDATE " . $PowerBB->table['info'] . " SET
												value='" . addslashes($value) . "'
													WHERE id='" . $r['id'] . "'");

		if ($update)
		{
			$PowerBB->html->p_msg('تم تغيير ترميز الإعداد رقم #' . $r['id']);
		}
	}

	$PowerBB->html->close_p();

	$PowerBB->html->make_link('الخطوه العاشره : تغيير ترميز الاعضاء','?step=10&amp;page=1');
}
elseif ($PowerBB->_GET['step'] == 10)
{
	$PowerBB->html->cells('الخطوه العاشره : تغيير ترميز الاعضاء','main1');
	$PowerBB->html->close_table();

	$PowerBB->install->loadCharset();


					 $page  = intval($PowerBB->_GET['page']);
                     $start = (150 * ($page-1));

	$query = $PowerBB->DB->sql_query('SELECT * FROM ' . $PowerBB->table['member'] . ' ORDER BY id ASC LIMIT ' . $start . ',150 ');

	$PowerBB->html->open_p();

	while ($r = $PowerBB->DB->sql_fetch_array($query))
	{
		$username 	= 	$PowerBB->install->strToUtf8($r['username']);
		$email 		= 	$PowerBB->install->strToUtf8($r['email']);
		$notes 		= 	$PowerBB->install->strToUtf8($r['user_notes']);
		$sig 		= 	$PowerBB->install->strToUtf8($r['user_sig']);
		$country 	= 	$PowerBB->install->strToUtf8($r['user_country']);
		$gender 	= 	$PowerBB->install->strToUtf8($r['user_gender']);
		$title 		= 	$PowerBB->install->strToUtf8($r['user_title']);
		$info 		= 	$PowerBB->install->strToUtf8($r['user_info']);
		$away_msg 	= 	$PowerBB->install->strToUtf8($r['away_msg']);

		$update = $PowerBB->DB->sql_query("UPDATE " . $PowerBB->table['member'] . " SET
												username='" . mysql_escape_string($username) . "',
												email='" . $email . "',
												user_notes='" . mysql_escape_string($notes) . "',
												user_sig='" . mysql_escape_string($sig) . "',
												user_country='" . mysql_escape_string($country) . "',
												user_gender='" . mysql_escape_string($gender) . "',
												user_title='" .  mysql_escape_string($title) . "',
												user_info='" . $info . "',
												away_msg='" . mysql_escape_string($away_msg) . "'
													WHERE id='" . $r['id'] . "'");

		if ($update)
		{
			$PowerBB->html->p_msg('تم تغيير ترميز العضو رقم #' . $r['id']);
		}
	}


		if ($update)
		{
	     $PowerBB->html->open_p();
		 $page = $PowerBB->_GET['page']+1;
         $PowerBB->html->make_link(' استكمال تغيير ترميز الأعضاء','?step=10&amp;page=' . $page );

		}
		else
       {
       	$PowerBB->html->close_p();
	    $PowerBB->html->make_link('الخطوه الاولى بعد العاشره : تغيير ترميز الصفحات','?step=11');
	   }
}
elseif ($PowerBB->_GET['step'] == 11)
{
	$PowerBB->html->cells('الخطوه الاولى بعد العاشره : تغيير ترميز الصفحات','main1');
	$PowerBB->html->close_table();

	$PowerBB->install->loadCharset();

	$query = $PowerBB->DB->sql_query("SELECT * FROM " . $PowerBB->table['pages'] . " ORDER BY id ASC");

	$PowerBB->html->open_p();

	while ($r = $PowerBB->DB->sql_fetch_array($query))
	{
		$title 		= 	$PowerBB->install->strToUtf8($r['title']);
		$html_code 	= 	$PowerBB->install->strToUtf8($r['html_code']);

		$update = $PowerBB->DB->sql_query("UPDATE " . $PowerBB->table['pages'] . " SET
												title='" .  mysql_escape_string($title) . "',
												html_code='" . mysql_escape_string($html_code) . "'
													WHERE id='" . $r['id'] . "'");

		if ($update)
		{
			$PowerBB->html->p_msg('تم تغيير ترميز الصفحه رقم #' . $r['id']);
		}
	}

	$PowerBB->html->close_p();

	$PowerBB->html->make_link('الخطوه الثانيه بعد العاشره : تغيير ترميز الرسائل الخاصه','?step=12&amp;page=1');
}
elseif ($PowerBB->_GET['step'] == 12)
{
	$PowerBB->html->cells('الخطوه الثانيه بعد العاشره : تغيير ترميز الرسائل الخاصه','main1');
	$PowerBB->html->close_table();

	$PowerBB->install->loadCharset();


	$page  = intval($PowerBB->_GET['page']);
    $start = (200 * ($page-1));

	$query = $PowerBB->DB->sql_query('SELECT * FROM ' . $PowerBB->table['pm'] . ' ORDER BY id ASC LIMIT ' . $start . ',200 ');

	$PowerBB->html->open_p();

	while ($r = $PowerBB->DB->sql_fetch_array($query))
	{
		$title 	= 	$PowerBB->install->strToUtf8($r['title']);
		$text 	= 	$PowerBB->install->strToUtf8($r['text']);
		$from 	= 	$PowerBB->install->strToUtf8($r['user_from']);
		$to		=	$PowerBB->install->strToUtf8($r['user_to']);

		$update = $PowerBB->DB->sql_query("UPDATE " . $PowerBB->table['pm'] . " SET
												title='" . mysql_escape_string($title) . "',
												text='" . mysql_escape_string($text) . "',
												user_from='" . $from . "',
												user_to='" . $to . "'
												WHERE id='" . $r['id'] . "'");

		if ($update)
		{
			$PowerBB->html->p_msg('تم تغيير ترميز الرساله رقم #' . $r['id']);
		}
	}


		 if ($update)
		{
	     $PowerBB->html->open_p();
		 $page = $PowerBB->_GET['page']+1;
         $PowerBB->html->make_link(' استكمال تغيير ترميز  الرسائل الخاصة','?step=12&amp;page=' . $page );

		}
		else
       {
       	$PowerBB->html->close_p();
	$PowerBB->html->make_link('الخطوه الثالثه بعد العاشره : تغيير ترميز قوائم الاتصال','?step=13');
	   }
}
elseif ($PowerBB->_GET['step'] == 13)
{
	$PowerBB->html->cells('الخطوه الثالثه بعد العاشره : تغيير ترميز قوائم الاتصال','main1');
	$PowerBB->html->close_table();

	$PowerBB->install->loadCharset();

	$query = $PowerBB->DB->sql_query("SELECT * FROM " . $PowerBB->table['pm_lists'] . " ORDER BY id ASC");

	$PowerBB->html->open_p();

	while ($r = $PowerBB->DB->sql_fetch_array($query))
	{
		$list_username 	= 	$PowerBB->install->strToUtf8($r['list_username']);
		$username 		= 	$PowerBB->install->strToUtf8($r['username']);


		$update = $PowerBB->DB->sql_query("UPDATE " . $PowerBB->table['pm_lists'] . " SET
												list_username='" . $list_username . "',
												username='" . $username . "'
													WHERE id='" . $r['id'] . "'");

		if ($update)
		{
			$PowerBB->html->p_msg('تم تغيير ترميز القائمه رقم #' . $r['id']);
		}
	}

	$PowerBB->html->close_p();

	$PowerBB->html->make_link('الخطوه الرابعه بعد العاشره : تغيير ترميز الاستفتاءات','?step=14');
}
elseif ($PowerBB->_GET['step'] == 14)
{
	$PowerBB->html->cells('الخطوه الرابعه بعد العاشره : تغيير ترميز الاستفتاءات','main1');
	$PowerBB->html->close_table();

	$PowerBB->install->loadCharset();

	$query = $PowerBB->DB->sql_query("SELECT * FROM " . $PowerBB->table['poll'] . " ORDER BY id ASC");

	$PowerBB->html->open_p();

	while ($r = $PowerBB->DB->sql_fetch_array($query))
	{
		$qus 	= 	$PowerBB->install->strToUtf8($r['qus']);
		$ans1 	= 	$PowerBB->install->strToUtf8($r['ans1']);
		$ans2 	= 	$PowerBB->install->strToUtf8($r['ans2']);
		$ans3 	= 	$PowerBB->install->strToUtf8($r['ans3']);
		$ans4 	= 	$PowerBB->install->strToUtf8($r['ans4']);
		$ans5 	= 	$PowerBB->install->strToUtf8($r['ans5']);
		$ans6 	= 	$PowerBB->install->strToUtf8($r['ans6']);
		$ans7 	= 	$PowerBB->install->strToUtf8($r['ans7']);
		$ans8 	= 	$PowerBB->install->strToUtf8($r['ans8']);
		$res1 	= 	$PowerBB->install->strToUtf8($r['res1']);
		$res2 	= 	$PowerBB->install->strToUtf8($r['res2']);
		$res3 	= 	$PowerBB->install->strToUtf8($r['res3']);
		$res4 	= 	$PowerBB->install->strToUtf8($r['res4']);
		$res5 	= 	$PowerBB->install->strToUtf8($r['res5']);
		$res6 	= 	$PowerBB->install->strToUtf8($r['res6']);
		$res7 	= 	$PowerBB->install->strToUtf8($r['res7']);
		$res8 	= 	$PowerBB->install->strToUtf8($r['res8']);


		$update = $PowerBB->DB->sql_query("UPDATE " . $PowerBB->table['poll'] . " SET
												qus='" . $qus . "',
												ans1='" . $ans1 . "',
												ans2='" . $ans2 . "',
												ans3='" . $ans3 . "',
												ans4='" . $ans4 . "',
												ans5='" . $ans5 . "',
												ans6='" . $ans6 . "',
												ans7='" . $ans7 . "',
												ans8='" . $ans8 . "',
												res1='" . $res1 . "',
												res2='" . $res2 . "',
												res3='" . $res3 . "',
												res4='" . $res4 . "',
												res5='" . $res5 . "',
												res6='" . $res6 . "',
												res7='" . $res7 . "',
												res8='" . $res8 . "'
												WHERE id='" . $r['id'] . "'");

		if ($update)
		{
			$PowerBB->html->p_msg('تم تغيير ترميز الاستفتاء رقم #' . $r['id']);
		}
	}

	$PowerBB->html->close_p();

	$PowerBB->html->make_link('الخطوه الخامسه بعد العاشره : تغيير ترميز الاقسام','?step=15');
}
elseif ($PowerBB->_GET['step'] == 15)
{
	$PowerBB->html->cells('الخطوه الخامسه بعد العاشره : تغيير ترميز الاقسام','main1');
	$PowerBB->html->close_table();

	$PowerBB->install->loadCharset();

	$query = $PowerBB->DB->sql_query("SELECT * FROM " . $PowerBB->table['section'] . " ORDER BY id ASC");

	$PowerBB->html->open_p();

	while ($r = $PowerBB->DB->sql_fetch_array($query))
	{
		$title 			= 	$PowerBB->install->strToUtf8($r['title']);
		$describe 		= 	$PowerBB->install->strToUtf8($r['section_describe']);
		$last_writer 	= 	$PowerBB->install->strToUtf8($r['last_writer']);
		$last_subject 	= 	$PowerBB->install->strToUtf8($r['last_subject']);

		$update = $PowerBB->DB->sql_query("UPDATE " . $PowerBB->table['section'] . " SET
												title='" . mysql_escape_string($title) . "',
												section_describe='" . mysql_escape_string($describe) . "',
												last_writer='" . mysql_escape_string($last_writer) . "',
												last_subject='" . mysql_escape_string($last_subject) . "'
													WHERE id='" . $r['id'] . "'");

		if ($update)
		{
			$PowerBB->html->p_msg('تم تغيير ترميز القسم رقم #' . $r['id']);
		}
	}

	$PowerBB->html->close_p();

	$PowerBB->html->make_link('الخطوه السابعه بعد العاشره : تغيير ترميز الانماط','?step=17');
}
elseif ($PowerBB->_GET['step'] == 17)
{
	$PowerBB->html->cells('الخطوه السابعه بعد العاشره : تغيير ترميز الانماط','main1');
	$PowerBB->html->close_table();

	$PowerBB->install->loadCharset();

	$query = $PowerBB->DB->sql_query("SELECT * FROM " . $PowerBB->table['style'] . " ORDER BY id ASC");

	$PowerBB->html->open_p();

	while ($r = $PowerBB->DB->sql_fetch_array($query))
	{
		$title = $PowerBB->install->strToUtf8($r['style_title']);

		$update = $PowerBB->DB->sql_query("UPDATE " . $PowerBB->table['style'] . " SET
												style_title='" . mysql_escape_string($title) . "'
													WHERE id='" . $r['id'] . "'");

		if ($update)
		{
			$PowerBB->html->p_msg('تم تغيير ترميز النمط رقم #' . $r['id']);
		}
	}

	$PowerBB->html->close_p();

	$PowerBB->html->make_link('الخطوه الثامنه بعد العاشره : تغيير ترميز مراقبة المشرفين','?step=18');
}
elseif ($PowerBB->_GET['step'] == 18)
{
	$PowerBB->html->cells('الخطوه الثامنه بعد العاشره : تغيير ترميز مراقبة المشرفين','main1');
	$PowerBB->html->close_table();

	$PowerBB->install->loadCharset();

	$query = $PowerBB->DB->sql_query("SELECT * FROM " . $PowerBB->table['sm_logs'] . " ORDER BY id ASC");

	$PowerBB->html->open_p();

	while ($r = $PowerBB->DB->sql_fetch_array($query))
	{
		$username 		= 	$PowerBB->install->strToUtf8($r['username']);
		$edit_action 	= 	$PowerBB->install->strToUtf8($r['edit_action']);
		$subject_title 	= 	$PowerBB->install->strToUtf8($r['subject_title']);
		$username = str_ireplace("'","",$username);
		$edit_action = str_ireplace("'","",$edit_action);
		$edit_action = str_ireplace("\t","",$edit_action);
		$edit_action = str_ireplace("\n","",$edit_action);
		$edit_action= str_replace (array('\\', '\\n'), "", $edit_action);
		$subject_title = str_ireplace("'","",$subject_title);


		$update = $PowerBB->DB->sql_query("UPDATE " . $PowerBB->table['sm_logs'] . " SET
												username='" . mysql_escape_string($username) . "',
												edit_action='" . mysql_escape_string($edit_action) . "',
												subject_title='" . mysql_escape_string($subject_title) . "'
													WHERE id='" . $r['id'] . "'");

		if ($update)
		{
			$PowerBB->html->p_msg('تم تغيير ترميز المراقبه رقم #' . $r['id']);
		}
	}


	$PowerBB->html->close_p();

	$PowerBB->html->make_link('الخطوه التاسعه بعد العاشره : تغيير ترميز صندوق الادوات','?step=19');
}
elseif ($PowerBB->_GET['step'] == 19)
{
	$PowerBB->html->cells('الخطوه التاسعه بعد العاشره : تغيير ترميز صندوق الادوات','main1');
	$PowerBB->html->close_table();

	$PowerBB->install->loadCharset();

	$query = $PowerBB->DB->sql_query("SELECT * FROM " . $PowerBB->table['toolbox'] . " ORDER BY id ASC");

	$PowerBB->html->open_p();

	while ($r = $PowerBB->DB->sql_fetch_array($query))
	{
		$name 		= 	$PowerBB->install->strToUtf8($r['name']);

		$update = $PowerBB->DB->sql_query("UPDATE " . $PowerBB->table['toolbox'] . " SET
												name='" . $name . "'
													WHERE id='" . $r['id'] . "'");

		if ($update)
		{
			$PowerBB->html->p_msg('تم تغيير ترميز الاداة رقم #' . $r['id']);
		}
	}

	$PowerBB->html->close_p();

	$PowerBB->html->make_link('الخطوه العشرون : تغيير ترميز مسميات الاعضاء','?step=20&amp;page=1');
}
elseif ($PowerBB->_GET['step'] == 20)
{
	$PowerBB->html->cells('الخطوه العشرون : تغيير ترميز مسميات الاعضاء','main1');
	$PowerBB->html->close_table();

	$PowerBB->install->loadCharset();


	$page  = intval($PowerBB->_GET['page']);
    $start = (150 * ($page-1));
	$query = $PowerBB->DB->sql_query('SELECT * FROM ' . $PowerBB->table['usertitle'] . ' ORDER BY id ASC LIMIT ' . $start . ',150 ');


	$PowerBB->html->open_p();

	while ($r = $PowerBB->DB->sql_fetch_array($query))
	{
		$usertitle 		= 	$PowerBB->install->strToUtf8($r['usertitle']);

		$update = $PowerBB->DB->sql_query("UPDATE " . $PowerBB->table['usertitle'] . " SET
												usertitle='" . mysql_escape_string($usertitle) . "'
													WHERE id='" . $r['id'] . "'");

		if ($update)
		{
			$PowerBB->html->p_msg('تم تغيير ترميز العضو رقم #' . $r['id']);
		}
	}

	 if ($update)
		{
	     $PowerBB->html->open_p();
		 $page = $PowerBB->_GET['page']+1;
         $PowerBB->html->make_link(' استكمال تغيير ترميز مسميات الأعضاء','?step=20&amp;page=' . $page );

		}
		else
       {
       	$PowerBB->html->close_p();
	     $PowerBB->html->make_link('الخطوه الاولى بعد العشرين : تغيير ترميز الاعلانات التجاريه','?step=21');
	   }

}
elseif ($PowerBB->_GET['step'] == 21)
{
	$PowerBB->html->cells('الخطوه الاولى بعد العشرين : تغيير ترميز الاعلانات التجاريه','main1');
	$PowerBB->html->close_table();

	$PowerBB->install->loadCharset();

	$query = $PowerBB->DB->sql_query("SELECT * FROM " . $PowerBB->table['ads'] . " ORDER BY id ASC");

	$PowerBB->html->open_p();

	while ($r = $PowerBB->DB->sql_fetch_array($query))
	{
		$name 		= 	$PowerBB->install->strToUtf8($r['sitename']);

		$update = $PowerBB->DB->sql_query("UPDATE " . $PowerBB->table['ads'] . " SET
												sitename='" . $name . "'
													WHERE id='" . $r['id'] . "'");

		if ($update)
		{
			$PowerBB->html->p_msg('تم تغيير ترميز الاعلان رقم #' . $r['id']);
		}
	}

	$PowerBB->html->close_p();

	$PowerBB->html->make_link('الخطوه الثانيه بعد العشرين : تغيير ترميز الاعلانات الاداريه','?step=22');
}
elseif ($PowerBB->_GET['step'] == 22)
{
	$PowerBB->html->cells('الخطوه الثانيه بعد العشرين : تغيير ترميز الاعلانات الاداريه','main1');
	$PowerBB->html->close_table();

	$PowerBB->install->loadCharset();

	$query = $PowerBB->DB->sql_query("SELECT * FROM " . $PowerBB->table['announcement'] . " ORDER BY id ASC");

	$PowerBB->html->open_p();

	while ($r = $PowerBB->DB->sql_fetch_array($query))
	{
		$title 		= 	$PowerBB->install->strToUtf8($r['title']);
		$text 		= 	$PowerBB->install->strToUtf8($r['text']);
		$writer 	= 	$PowerBB->install->strToUtf8($r['writer']);

		$update = $PowerBB->DB->sql_query("UPDATE " . $PowerBB->table['announcement'] . " SET
												title='" . mysql_escape_string($title) . "',
												text='" . mysql_escape_string($text) . "',
												writer='" . mysql_escape_string($writer) . "'
													WHERE id='" . $r['id'] . "'");

		if ($update)
		{
			$PowerBB->html->p_msg('تم تغيير ترميز الاعلان رقم #' . $r['id']);
		}
	}

	$PowerBB->html->close_p();


$PowerBB->html->make_link('الخطوه الثالثة بعد العشرين : تغيير ترميز مشرفي الأقسام','?step=23');

}
elseif ($PowerBB->_GET['step'] == 23)
{
	$PowerBB->html->cells('الخطوه الثالثة بعد العشرين : تغيير ترميز مشرفي الأقسام','main1');
	$PowerBB->html->close_table();

	$PowerBB->install->loadCharset();

	$query = $PowerBB->DB->sql_query("SELECT * FROM " . $PowerBB->table['sectionadmin'] . " ORDER BY id ASC");

	$PowerBB->html->open_p();

	while ($r = $PowerBB->DB->sql_fetch_array($query))
	{
		$username 		= 	$PowerBB->install->strToUtf8($r['username']);

		$update = $PowerBB->DB->sql_query("UPDATE " . $PowerBB->table['sectionadmin'] . " SET

												username='" . mysql_escape_string($username) . "'
													WHERE id='" . $r['id'] . "'");

		if ($update)
		{
			$PowerBB->html->p_msg('تم تغيير ترميز المشرف رقم #' . $r['id']);
		 }
	}

	$PowerBB->html->close_p();

	$PowerBB->html->make_link('الخطوه الرابعة بعد العشرين : تصحيح النمط الافتراضي','?step=24');
}
elseif ($PowerBB->_GET['step'] == 24)
{
	$PowerBB->html->cells('الخطوه الرابعة بعد العشرين : تصحيح النمط الافتراضي','main1');
	$PowerBB->html->close_table();

	$repair = $PowerBB->install->RepairDefaultStyle();

	if ($repair)
	{
		$PowerBB->html->msg('تم تصحيح النمط الافتراضي');
	}

	$PowerBB->html->make_link('الخطوه الخامسة بعد العشرين','?step=25');
}
elseif ($PowerBB->_GET['step'] == 25)
{
	$PowerBB->html->cells('الخطوه الخامسة بعد العشرين : تصحيح مسار الايقونات','main1');
	$PowerBB->html->close_table();

	$repair = $PowerBB->install->FixIconsPath();

	if (in_array('false',$repair))
	{
		$PowerBB->html->msg('لم يتم التصحيح كاملاً');
	}
	else
	{
		$PowerBB->html->msg('تم تصحيح مسار الايقونات');
	}

	$PowerBB->html->make_link('الخطوه السادسة بعد العشرين : تصحيح مسار الابتسامات','?step=26');
}
elseif ($PowerBB->_GET['step'] == 26)
{
	$PowerBB->html->cells('الخطوه السادسة بعد العشرين : تصحيح مسار الابتسامات','main1');
	$PowerBB->html->close_table();

	$repair = $PowerBB->install->FixSmilesPath();

	if (in_array('false',$repair))
	{
		$PowerBB->html->msg('لم يتم التصحيح كاملاً');
	}
	else
	{
		$PowerBB->html->msg('تم تصحيح مسار الايقونات');
	}

	$PowerBB->html->make_link('الخطوه السابعة بعد العشرين : عمليات الانشاء','?step=27');
}
elseif ($PowerBB->_GET['step'] == 27)
{
	$PowerBB->html->cells('الخطوه السابعة بعد العشرين : عمليات الانشاء','main1');
	$PowerBB->html->close_table();


	$p 			= 	array();
	$msgs 		= 	$PowerBB->install->_Masseges;

	$p[1] 		= 	$PowerBB->install->CreateBannedTable();
	$msgs[1] 	= 	($p[1]) ? 'تم إنشاء جدول الحظر' : 'لم يتم إنشاء جدول الحظر';

	$p[2]		=	$PowerBB->install->ChangeAnnouncementDate();
	$msgs[2]	=	($p[2]) ? 'تم تغيير حقل التاريخ في جدول الاعلانات الاداريه' : 'لم يتم تغيير حقل التاريخ في جدول الاعلانات الاداريه';

	$p[3]		=	$PowerBB->install->AddForumsCache();
	$msgs[3]	=	($p[3]) ? 'تم اضافة حقل المعلومات المخبأه' : 'لم يتم اضافة حقل المعلومات المخبأه';

	$p[4] 		= 	$PowerBB->install->AddSectionsNumber();
	$msgs[4] 	= 	($p[4]) ? 'تم إنشاء مدخل عدد الاقسام' : 'لم يتم إنشاء مدخل عدد الاقسام';

	$p[5]		=	$PowerBB->install->AddSubSectionsNumber();
	$msgs[5]	=	($p[5]) ? 'تم إنشاء مدخل عدد المنتديات الفرعيه' : 'لم يتم إنشاء مدخل عدد المنتديات الفرعيه';

	$p[6]		=	$PowerBB->install->AddSectionGroupNumber();
	$msgs[6]	=	($p[6]) ? 'تم إنشاء مدخل عدد مجموعات الاقسام' : 'لم يتم إنشاء مدخل عدد مجموعات الاقسام';

	$p[7]		=	$PowerBB->install->AddSmilesNumber();
	$msgs[7]	=	($p[7]) ? 'تم إنشاء مدخل عدد الابتسامات' : 'لم يتم إنشاء مدخل عدد الابتسامات';

	$p[8]		=	$PowerBB->install->AddReplyNumber();
	$msgs[8]	=	($p[8]) ? 'تم اضافة حقل عدد الردود' : 'لم يتم اضافة حقل عدد الردود';

	$p[9]		=	$PowerBB->install->AddSubjectNumber();
	$msgs[9]	=	($p[9]) ? 'تم اضافة حقل عدد المواضيع' : 'لم يتم اضافة حقل عدد المواضيع';

	$p[10]		=	$PowerBB->install->AddStyleCache();
	$msgs[10]	=	($p[10]) ? 'تم اضافة حقل كاش الانماط' : 'لم يتم اضافة حقل كاش الانماط';

	$p[11]		=	$PowerBB->install->AddStyleIDCache();
	$msgs[11]	=	($p[11]) ? 'تم اضافة حقل كاش معرّف النمط' : 'لم يتم اضافة حقل كاش معرّف النمط';

	$p[12]		=	$PowerBB->install->AddUpdateStyleCache();
	$msgs[12]	=	($p[12]) ? 'تم اضافة حقل تحديث كاش الانماط' : 'لم يتم اضافة حقل تحديث كاش الانماط';

	$p[13]		=	$PowerBB->install->AddTodayDateCache();
	$msgs[13]	=	($p[13]) ? 'تم إنشاء مدخل كاش تاريخ اليوم' : 'لم يتم إنشاء مدخل كاش تاريخ اليوم';

	$p[14]		=	$PowerBB->install->AddTodayNumberCache();
	$msgs[14]	=	($p[14]) ? 'تم إنشاء مدخل كاش عدد زوار اليوم' : 'لم يتم إنشاء مدخل كاش عدد زوار اليوم';

	$p[15]		=	$PowerBB->install->AddAdressBarSeparate();
	$msgs[15]	=	($p[15]) ? 'تم إنشاء مدخل فاصل العنوان' : 'لم يتم إنشاء مدخل فاصل';

	$p[16] 		= 	$PowerBB->install->AddGroupName();
	$msgs[16] 	= 	($p[16]) ? 'تم اضافة حقل اسم المجموعه' : 'لم يتم اضافة حقل اسم المجموعه';



	$PowerBB->html->open_p();

	foreach ($msgs as $msg)
	{
		$PowerBB->html->p_msg($msg);
	}

	$PowerBB->html->close_p();

	$PowerBB->html->make_link('الخطوه الثامنة بعد العشرين : تحديث الكاش','?step=28');

}
elseif ($PowerBB->_GET['step'] == 28)
{
	$PowerBB->html->cells('الخطوه الثامنة بعد العشرين : تحديث الكاش','main1');
	$PowerBB->html->close_table();
   $add = $PowerBB->install->AddParent();
    $add = $PowerBB->install->AddSectionGroupCache();

	$p 			= 	array();
	$msgs 		= 	$PowerBB->install->_Masseges;

	$p[1] 		= 	$PowerBB->install->UpdateForumsCache();
	$msgs[1] 	= 	($p[1]) ? 'تم تحديث كاش المنتديات' : 'لم يتم تحديث كاش المنتديات';

	$p[2]		=	$PowerBB->install->UpdateSubForumsCache();
	$msgs[2]	=	($p[2]) ? 'تم تحديث كاش المنتديات الفرعيه' : 'لم يتم تحديث كاش المنتديات الفرعيه';

	$p[3]		=	$PowerBB->install->UpdateSectionGroupCache();
	$msgs[3]	=	($p[3]) ? 'تم تحديث كاش الصلاحيات' : 'لم يتم تحديث كاش الصلاحيات';

	$p[4]		=	$PowerBB->install->UpdateSmilesNumberCache();
	$msgs[4]	=	($p[4]) ? 'تم تحديث كاش عدد الابتسامات' : 'تم تحديث كاش الابتسامات';

	$PowerBB->html->open_p();

	foreach ($msgs as $msg)
	{
		$PowerBB->html->p_msg($msg);
	}

	$PowerBB->html->close_p();

	$PowerBB->html->make_link('الخطوه التاسعة بعد العشرين','?step=29');
}
elseif ($PowerBB->_GET['step'] == 29)
{
	$PowerBB->html->cells('الخطوه التاسعة بعد العشرين','main1');
	$PowerBB->html->close_table();
    $PowerBB->install->CreateLang();
	$PowerBB->install->InsertLang();

	$PowerBB->install->CreateFaq();

	$PowerBB->html->open_p();
	$PowerBB->html->make_link('اضغط هنا','THETA.php?step=1');
	$PowerBB->html->p_msg(' لتبدأ تحديثات THETA');
	$PowerBB->html->close_p();

	$NewVersion = $PowerBB->install->UpdateVersion();
}

?>
