<?php
define('DIR',dirname( __FILE__ ) . '/');
// Define safe_mode
define('SAFEMODE', (@ini_get('safe_mode') == 1 OR strtolower(@ini_get('safe_mode')) == 'on') ? true : false);

////////////
/*
# Security Written By Z A I D
# Pbboard Developer Group
*/
	$_Injection = array("'","%27","order","union","select",'from');
	foreach($_GET as $key=>$val)
	{
	$val = strtolower($val);
		foreach($_Injection as $String)
		{
			if(strpos($val,$String) !== false)
			{
			exit("This is access not allowed");
			}
		}
	}

// PowerBB Engine
require_once(DIR . 'engine/Engine.class.php');

////////////

class PowerBB extends Engine
{

	function PowerBB()
	{
		////////////

		$e = Engine::Engine();

		if (!is_bool($e)
		and $e == 'ERROR::THE_TABLES_ARE_NOT_INSTALLED'
		and !defined('INSTALL'))
		{
		header("Location: setup/install");
		exit;
		}



  		// Get informations from info table
  		if (!defined('NO_INFO'))
  		{
 			$this->_GetInfoRows();
           if (!defined('INSTALL'))
           {
 			$this->_GetLangRows();
 		   }
 		}
		$this->_CONF['ip'] = $this->get_IP_address();

  	}
 	////////////

 	function _GetInfoRows()
	{
		// TODO :: Cache me please!
		$arr 				= 	array();
		$arr['select'] 		= 	'*';
		$arr['from'] 		= 	$this->table['info'];

		$rows = $this->records->GetList($arr);

		$x = 0;
		$y = sizeof($rows);

		while ($x <= $y)
		{
			$this->_CONF['info_row'][$rows[$x]['var_name']] = $rows[$x]['value'];

			$x += 1;
		}
	}

 	function _GetLangRows()
	{

		 $username = $this->sys_functions->CleanSymbols($this->_COOKIE[$this->_CONF['username_cookie']]);
         $username = $this->sys_functions->CleanVariable($username,'trim');
         $username = $this->sys_functions->CleanVariable($username,'html');
         $username = $this->sys_functions->CleanVariable($username,'sql');

		 $lang_cookie = $this->sys_functions->CleanSymbols($this->_COOKIE[$this->_CONF['lang_cookie']]);
         $lang_cookie = $this->sys_functions->CleanVariable($lang_cookie,'trim');
         $lang_cookie = $this->sys_functions->CleanVariable($lang_cookie,'html');
         $lang_cookie = $this->sys_functions->CleanVariable($lang_cookie,'sql');
         $lang_cookie = $this->sys_functions->CleanVariable($lang_cookie,'intval');
        if (isset($lang_cookie)
        and $lang_cookie)
        {
         $languageid = $lang_cookie;
        }
        else
        {
         $languageid = $this->_CONF['info_row']['def_lang'];
        }

		if (empty($username))
		{

			$this->_CONF['LangId'] = $languageid;

        }
       else
		{
	        $MemberArr							    =	array();
	 		$MemberArr['select']					=	'*';
	 		$MemberArr['from']					    =	$this->table['member'];
	 	    $MemberArr['where'] 					= 	array();
	 	    $MemberArr['where'][0] 				    = 	array();
	 	    $MemberArr['where'][0]['name'] 		    = 	'username';
	 	    $MemberArr['where'][0]['oper'] 		    = 	'=';
	 	    $MemberArr['where'][0]['value'] 		= 	$username;

 		    $MemberRows = $this->records->GetInfo($MemberArr);
 		    if($MemberRows == true)
 		    {
				if($languageid != $MemberRows['lang'])
				{
				 $idMemberRows = $MemberRows['id'];
				 $update = $this->DB->sql_query("UPDATE " . $this->table['member'] . " SET lang='$languageid' WHERE id='$idMemberRows'");
					if($update)
					{
					$this->functions->redirect2('index.php');
					exit();
					}
				}
 		    $languageid = $MemberRows['lang'];
			$this->_CONF['LangId'] = $languageid;
			}
		}

		if (empty($languageid))
		{
		 $languageid = $this->_CONF['info_row']['def_lang'];
		 $this->_CONF['LangId'] = $languageid;
 		}
 		else
 		{
		$LangArr							    =	array();
		$LangArr['select']					=	'*';
		$LangArr['from']					    =	$this->table['lang'];
		$LangArr['where'] 					= 	array();
		$LangArr['where'][0] 				    = 	array();
		$LangArr['where'][0]['name'] 		    = 	'id';
		$LangArr['where'][0]['oper'] 		    = 	'=';
		$LangArr['where'][0]['value'] 		= 	$languageid;

		$LangRows = $this->records->GetInfo($LangArr);
        if ($LangRows)
        {
		$languageid = $LangRows['id'];
		$this->_CONF['LangId'] = $languageid;
		$this->_CONF['LangDir'] = $LangRows['lang_path'];
        }
        else
        {
			$def_language = $this->_CONF['info_row']['def_lang'];
			ob_start();
			setcookie("PowerBB_lang", $def_language, time()+2592000);
			ob_end_flush();
			//$this->functions->redirect2('index.php');
			exit;

        }
       }

		$arr 				            = 	array();
		$arr['select'] 		            = 	'*';
		$arr['from'] 		            = 	$this->table['phrase_language'];
 	    $arr['where'] 					= 	array();
 	    $arr['where'][0] 				= 	array();
 	    $arr['where'][0]['name'] 		= 	'languageid';
 	    $arr['where'][0]['oper'] 		= 	'=';
 	    $arr['where'][0]['value'] 		= 	$languageid;
 	    if ($this->_GET['page'] != 'chat_message')
 	    {
		  if (defined('IN_ADMIN'))
			{
			$arr['where'][1]       =    array();
			$arr['where'][1]['name'] =    'and fieldname';
			$arr['where'][1]['oper']   =    '=';
			$arr['where'][1]['value']    =    'admincp';
			}
			else
			{
			$arr['where'][1]       =    array();
			$arr['where'][1]['name'] =    'and fieldname';
			$arr['where'][1]['oper']   =    '=';
			$arr['where'][1]['value']    =    'forum';
			}
		}
 	    $rows = $this->records->GetList($arr);

		$x = 0;
		$y = sizeof($rows);

		while ($x <= $y)
		{
            $rows[$x]['text'] = str_replace("&#39;", "'", $rows[$x]['text']);
            if ($rows[$x]['varname'] == 'post_text_max')
            {
             $rows[$x]['text'] = str_replace("30000", $this->_CONF['info_row']['post_text_max'], $rows[$x]['text']);
            }
            if ($rows[$x]['varname'] == 'floodctrl')
            {
              $rows[$x]['text'] = str_replace("30", $this->_CONF['info_row']['floodctrl'], $rows[$x]['text']);
            }
            if ($rows[$x]['varname'] == 'Reply_Editing_time_out')
            {
              $rows[$x]['text'] = str_replace("1440", $this->_CONF['info_row']['time_out'], $rows[$x]['text']);
            }
            if ($rows[$x]['varname'] == 'Editing_time_out')
            {
              $rows[$x]['text'] = str_replace("1440", $this->_CONF['info_row']['time_out'], $rows[$x]['text']);
            }
            if ($rows[$x]['varname'] == 'characters_keyword_search')
            {
              $rows[$x]['text'] = str_replace("3", $this->_CONF['info_row']['characters_keyword_search'], $rows[$x]['text']);
            }
            if ($rows[$x]['varname'] == 'flood_search1')
            {
              $rows[$x]['text'] = str_replace("40", $this->_CONF['info_row']['flood_search'], $rows[$x]['text']);
            }
            if ($rows[$x]['varname'] == 'max_avatar')
            {
              $rows[$x]['text'] = str_ireplace("150 في", $this->_CONF['info_row']['max_avatar_width']." في", $rows[$x]['text']);
              $rows[$x]['text'] = str_ireplace("150 بيكسل", $this->_CONF['info_row']['max_avatar_height']." بيكسل", $rows[$x]['text']);
              $rows[$x]['text'] = str_ireplace("150 in", $this->_CONF['info_row']['max_avatar_width']." in", $rows[$x]['text']);
              $rows[$x]['text'] = str_ireplace("150 Pixel", $this->_CONF['info_row']['max_avatar_height']." Pixel", $rows[$x]['text']);
            }
            if ($rows[$x]['varname'] == 'post_text_max_subjects')
            {
              $rows[$x]['text'] = str_replace("60", $this->_CONF['info_row']['post_title_max'], $rows[$x]['text']);
            }
            if ($rows[$x]['varname'] == 'post_text_min_subjects')
            {
              $rows[$x]['text'] = str_replace("(4)", $this->_CONF['info_row']['post_title_min'], $rows[$x]['text']);
              $rows[$x]['text'] = str_replace("60", $this->_CONF['info_row']['post_title_min'], $rows[$x]['text']);
            }
            if ($rows[$x]['varname'] == 'post_text_min')
            {
              $rows[$x]['text'] = str_replace("5", $this->_CONF['info_row']['post_text_min'], $rows[$x]['text']);
            }
            if ($rows[$x]['varname'] == 'Character_name_a_few_user')
            {
              $rows[$x]['text'] = str_replace("3", $this->_CONF['info_row']['reg_less_num'], $rows[$x]['text']);
            }
            if ($rows[$x]['varname'] == 'characters_Username_many')
            {
              $rows[$x]['text'] = str_replace("25", $this->_CONF['info_row']['reg_max_num'], $rows[$x]['text']);
            }
            if ($rows[$x]['varname'] == 'Character_pass_few')
            {
              $rows[$x]['text'] = str_replace("5", $this->_CONF['info_row']['reg_pass_min_num'], $rows[$x]['text']);
            }
            if ($rows[$x]['varname'] == 'Character_pass_many')
            {
              $rows[$x]['text'] = str_replace("25", $this->_CONF['info_row']['reg_pass_max_num'], $rows[$x]['text']);
            }
            $rows[$x]['text'] = str_replace("{info_row_title}", $this->_CONF['info_row']['title'], $rows[$x]['text']);
			$this->_CONF['lang'][$rows[$x]['varname']] = $rows[$x]['text'];
			$x += 1;
		}
	}

     // Function to get the client IP address
	function get_IP_address()
	{
		$IPaddress = $this->_SERVER['REMOTE_ADDR'];
		$IPaddress = $this->sys_functions->CleanVariable($IPaddress,'trim');
		$IPaddress = $this->sys_functions->CleanVariable($IPaddress,'html');
		$IPaddress = $this->sys_functions->CleanVariable($IPaddress,'sql');
		$ip_filter = $IPaddress;
		$ip_filter = str_replace(".", "", $ip_filter);
		if (is_numeric($ip_filter))
		{
		return $IPaddress;
		}
		else
		{
		return 'UNKNOWN';
		}
	}
	////////////

}

////////////

?>
