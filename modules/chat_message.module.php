<?php

(!defined('IN_PowerBB')) ? die() : '';

$CALL_SYSTEM					=	array();
$CALL_SYSTEM['SUBJECT'] 		= 	true;
$CALL_SYSTEM['SECTION'] 		= 	true;
$CALL_SYSTEM['TOOLBOX'] 		= 	true;
$CALL_SYSTEM['ICONS'] 			= 	true;

define('JAVASCRIPT_PowerCode',true);

include('common.php');

define('CLASS_NAME','PowerBBChatMOD');

class PowerBBChatMOD
{
	function run()
	{
		global $PowerBB;

        $PowerBB->functions->ShowHeader();
		/** Go to Chat site **/
		if ($PowerBB->_GET['chat'])
		{
			$this->_AddchatMessage();
		}
		elseif ($PowerBB->_GET['start'])
		{
			$this->_StartchatMessage();
		}
		else
		{	if ($PowerBB->_CONF['member_permission'])
			{
				if ($PowerBB->_CONF['member_row']['usergroup'] == '1'
					or $PowerBB->_CONF['group_info']['vice'])
				{


					if ($PowerBB->_GET['control'])
					{
						if ($PowerBB->_GET['main'])
						{
							$this->_ControlMain();
						}
					}
					elseif ($PowerBB->_GET['edit'])
					{
						if ($PowerBB->_GET['main'])
						{
							$this->_EditMain();
						}
						elseif ($PowerBB->_GET['started'])
						{
							$this->_EditStart();
						}
					}
					elseif ($PowerBB->_GET['del'])
					{
		                if ($PowerBB->_GET['startdel'])
						{
							$this->_DelStart();
						}
						elseif ($PowerBB->_GET['del_all'])
						{
							$this->_DelAllStart();
						}
					}
				}
				else
				{
				@header("Location: index.php");
				exit;
				}
	         }
			else
			{
			@header("Location: index.php");
			exit;
			}

		}
		 $PowerBB->functions->GetFooter();
	}

	/**
	 * add chat message
	 */
	function _AddchatMessage()
	{
		global $PowerBB;


		/** member can't use the chat system if his posts was less than 20 posts **/

		$MemberArr 				= 	array();
		$MemberArr['where']		=	array('username',$PowerBB->_CONF['member_row']['username']);

		$member = $PowerBB->core->GetInfo($MemberArr,'member');
		if ($PowerBB->_CONF['member_row']['posts'] < $PowerBB->_CONF['info_row']['chat_num_mem_posts']
		and $PowerBB->_CONF['group_info']['banned'])
		{
          $PowerBB->template->assign('num_mem_posts',true);
		}


		$SmlArr 					= 	array();
		$SmlArr['order'] 			=	array();
		$SmlArr['order']['field']	=	'id';
		$SmlArr['order']['type']	=	'ASC';
		$SmlArr['limit']			=	$PowerBB->_CONF['info_row']['smiles_nm'];
		$SmlArr['proc'] 			= 	array();
		$SmlArr['proc']['*'] 		= 	array('method'=>'clean','param'=>'html');

		$PowerBB->_CONF['template']['while']['SmileRows'] = $PowerBB->icon->GetSmileList($SmlArr);

        $PowerBB->template->display('add_chat_message');

	}

	function _StartchatMessage()
	{

		global $PowerBB;

		/** Visitor can't use the chat system **/
		if (!$PowerBB->_CONF['member_permission'])
		{
          $PowerBB->functions->error($PowerBB->_CONF['template']['_CONF']['lang']['Visitor_can_not_use_the_chat_system']);
		}

		/** member can't use the chat system if his posts was less than 20 posts **/
		$MemberArr 				= 	array();
		$MemberArr['where']		=	array('username',$PowerBB->_CONF['member_row']['username']);

		$member = $PowerBB->core->GetInfo($MemberArr,'member');
		if ($member['posts'] < $PowerBB->_CONF['info_row']['chat_num_mem_posts'])
		{
         $PowerBB->_CONF['template']['_CONF']['lang']['Member_can_not_use_the_chat_system_posts_less'] = str_ireplace('20',$PowerBB->_CONF['info_row']['chat_num_mem_posts'],$PowerBB->_CONF['template']['_CONF']['lang']['Member_can_not_use_the_chat_system_posts_less']);
         $PowerBB->functions->error($PowerBB->_CONF['template']['_CONF']['lang']['Member_can_not_use_the_chat_system_posts_less']);
		}


			if (empty($PowerBB->_POST['textc']))
			{
				$PowerBB->functions->error_no_foot($PowerBB->_CONF['template']['_CONF']['lang']['Please_write_the_message']);
			}

			if ($PowerBB->_CONF['info_row']['chat_hide_country'] == 1)
			{

			if (empty($PowerBB->_POST['country']))
			{
	         $PowerBB->functions->error_no_foot($PowerBB->_CONF['template']['_CONF']['lang']['Please_write_the_country']);
			}
			}


            //$PowerBB->Powerparse->replace_smiles($PowerBB->_POST['textc']);
            $PowerBB->_POST['textc'] = str_ireplace('{39}',"'",$PowerBB->_POST['textc']);
            $PowerBB->_POST['textc'] = str_ireplace('cookie','',$PowerBB->_POST['textc']);


             // Filter Words
	        $censorwords = preg_split('#[ \r\n\t]+#', $PowerBB->_CONF['info_row']['censorwords'], -1, PREG_SPLIT_NO_EMPTY);
            $PowerBB->_POST['country'] = str_ireplace($censorwords,'', $PowerBB->_POST['country']);
            $PowerBB->_POST['textc'] = str_ireplace($censorwords,'', $PowerBB->_POST['textc']);
            $PowerBB->_POST['textc'] = str_ireplace('&amp;','&',$PowerBB->_POST['textc']);
            $PowerBB->_POST['textc'] = str_ireplace('<br>','',$PowerBB->_POST['textc']);
            $PowerBB->_POST['textc'] = str_ireplace('</p>','',$PowerBB->_POST['textc']);
            $PowerBB->_POST['textc'] = str_ireplace('<p>','',$PowerBB->_POST['textc']);
            $PowerBB->_POST['textc'] = str_ireplace('XSS','',$PowerBB->_POST['textc']);
            $PowerBB->_POST['textc'] = str_ireplace('write','',$PowerBB->_POST['textc']);
            $PowerBB->_POST['textc'] = str_ireplace('document','',$PowerBB->_POST['textc']);
            $PowerBB->_POST['textc'] = str_ireplace('&quot;','',$PowerBB->_POST['textc']);
            $PowerBB->_POST['country'] = str_ireplace('&amp;','&',$PowerBB->_POST['country']);
            $PowerBB->_POST['country'] = str_ireplace('<br>','',$PowerBB->_POST['country']);
            $PowerBB->_POST['country'] = str_ireplace('</p>','',$PowerBB->_POST['country']);
            $PowerBB->_POST['country'] = str_ireplace('<p>','',$PowerBB->_POST['country']);
            $PowerBB->_POST['country'] = str_ireplace('&quot;','',$PowerBB->_POST['country']);
            $PowerBB->_POST['country'] = str_ireplace('http://','',$PowerBB->_POST['country']);
            $PowerBB->_POST['country'] = str_ireplace('www','',$PowerBB->_POST['country']);
            $PowerBB->_POST['country'] = str_ireplace('com','',$PowerBB->_POST['country']);
            $PowerBB->_POST['country'] = str_ireplace('net','',$PowerBB->_POST['country']);
            $PowerBB->_POST['country'] = str_ireplace('org;','',$PowerBB->_POST['country']);
            $PowerBB->_POST['country'] = str_ireplace('iframe;','',$PowerBB->_POST['country']);
            $PowerBB->_POST['textc'] = str_ireplace('iframe;','',$PowerBB->_POST['textc']);
            //
        	   $PowerBB->_POST['country'] = 	$PowerBB->functions->CleanVariable($PowerBB->_POST['country'],'html');
               //$PowerBB->_POST['textc'] =  $PowerBB->functions->CleanVariable($PowerBB->_POST['textc'],'nohtml');
		       // Kill SQL Injection
		        $PowerBB->_POST['country'] = $PowerBB->functions->CleanVariable($PowerBB->_POST['country'],'sql');
		        $PowerBB->_POST['textc'] = $PowerBB->functions->CleanVariable($PowerBB->_POST['textc'],'sql');

            $TextPost = utf8_decode($PowerBB->_POST['textc']);
    		if (isset($TextPost{$PowerBB->_CONF['info_row']['chat_num_characters']}))
    		{
    		     $PowerBB->_CONF['template']['_CONF']['lang']['message_large_number_of_characters'] = str_ireplace('970',$PowerBB->_CONF['info_row']['chat_num_characters'],$PowerBB->_CONF['template']['_CONF']['lang']['message_large_number_of_characters']);

                 $PowerBB->functions->error_no_foot($PowerBB->_CONF['template']['_CONF']['lang']['message_large_number_of_characters']);
             }

			$ChatArr 			= 	array();
			$ChatArr['field']	=	array();

			$ChatArr['field']['country'] 	    = 	$PowerBB->functions->CleanVariable($PowerBB->_POST['country'],'html');
			$ChatArr['field']['message'] 		= 	$PowerBB->_POST['textc'];
			$ChatArr['field']['username'] 		= 	$PowerBB->_CONF['member_row']['username'];
			$ChatArr['field']['user_id'] 		= 	$PowerBB->_CONF['member_row']['id'];

			$insert = $PowerBB->core->Insert($ChatArr,'chat');


		$TotleCahtArr 					= 	array();
		$TotleCahtArr['order']			=	array();
		$TotleCahtArr['order']['field']	=	'id';
		$TotleCahtArr['order']['type']	=	'DESC';
       if ($PowerBB->core->GetNumber($TotleCahtArr,'chat') > $PowerBB->_CONF['info_row']['chat_message_num'])
        {
			$LastChatArr 						= 	array();
			$LastChatArr['order'] 				= 	array();
			$LastChatArr['order']['field'] 		= 	'id';
			$LastChatArr['order']['type']	 	= 	' ASC';
			$LastChatArr['limit'] 				= 	'0,1';

			$PowerBB->_CONF['template']['LastChat'] = $PowerBB->core->GetInfo($LastChatArr,'chat');

			$DelArr 			= 	array();
			$DelArr['where'] 	= 	array('id',$PowerBB->_CONF['template']['LastChat']['id']);

			$del = $PowerBB->core->Deleted($DelArr,'chat');

		}


			if ($insert)
			{
                 $PowerBB->functions->header_redirect('index.php');

			}



	}

	function _ControlMain()
	{
		global $PowerBB;

		$PowerBB->_GET['count'] = (!isset($PowerBB->_GET['count'])) ? 0 : $PowerBB->_GET['count'];
		$PowerBB->_GET['count'] = $PowerBB->functions->CleanVariable($PowerBB->_GET['count'],'intval');

		$TotleCahtArr 					= 	array();
		$TotleCahtArr['order']			=	array();
		$TotleCahtArr['order']['field']	=	'id';
		$TotleCahtArr['order']['type']	=	'DESC';

        // show Caht bar
		$CahtArr 					= 	array();
		$CahtArr['order']			=	array();
		$CahtArr['order']['field']	=	'id';
		$CahtArr['order']['type']	=	'DESC';

		$CahtArr['pager'] 				= 	array();
		$CahtArr['pager']['total']		= 	$PowerBB->core->GetNumber($TotleCahtArr,'chat');
		$CahtArr['pager']['perpage'] 	= 	$PowerBB->_CONF['info_row']['chat_message_num'];
		$CahtArr['pager']['count'] 		= 	$PowerBB->_GET['count'];
		$CahtArr['pager']['location'] 	= 	'index.php?page=chat_message&control=1&main=1';
		$CahtArr['pager']['var'] 		= 	'count';

		$CahtArr['proc'] 			= 	array();
		$CahtArr['limit']           = $PowerBB->_CONF['info_row']['chat_message_num'];
		$CahtArr['proc']['*'] 		= 	array('method'=>'clean','param'=>'html');

		$PowerBB->_CONF['template']['while']['MessagesList'] = $PowerBB->chat->GetChatList($CahtArr);

       if ($PowerBB->core->GetNumber($TotleCahtArr,'chat') > $PowerBB->_CONF['info_row']['chat_message_num'])
        {
		$PowerBB->template->assign('pager',$PowerBB->pager->show());
        }
        $PowerBB->template->assign('CahtMessagesNumber',$PowerBB->core->GetNumber($TotleCahtArr,'chat'));

		$PowerBB->template->display('chat_main');
	}




	function _EditMain()
	{
		global $PowerBB;

			if (empty($PowerBB->_GET['id']))
			{
				$PowerBB->functions->error($PowerBB->_CONF['template']['_CONF']['lang']['Chat_message_requested_does_not_exist']);
			}

			$CahtEditArr				=	array();
		    $CahtEditArr['where'] 	= 	array('id',$PowerBB->_GET['id']);

			$chatEdit = $PowerBB->chat->GetChatInfo($CahtEditArr);
         $chatEdit['message'] = $PowerBB->Powerparse->censor_words($chatEdit['message']);
			$PowerBB->template->assign('chatEdit',$chatEdit);
            $PowerBB->template->assign('message',$chatEdit['message']);

		$smiles = $PowerBB->icon->GetCachedSmiles();
		foreach ($smiles as $smile)
		{
			$PowerBB->functions->CleanVariable($smile,'html');

			$chatEdit['message'] = str_replace('<img src="' . $smile['smile_path'] . '" border="0" alt="' . $smile['smile_short'] . '" />',$smile['smile_short'],$chatEdit['message']);
			$PowerBB->template->assign('message',$chatEdit['message']);

		}


		$SmlArr 					= 	array();
		$SmlArr['order'] 			=	array();
		$SmlArr['order']['field']	=	'id';
		$SmlArr['order']['type']	=	'ASC';
		$SmlArr['limit']			=	$PowerBB->_CONF['info_row']['smiles_nm'];
		$SmlArr['proc'] 			= 	array();
		$SmlArr['proc']['*'] 		= 	array('method'=>'clean','param'=>'html');

		$PowerBB->_CONF['template']['while']['SmileRows'] = $PowerBB->icon->GetSmileList($SmlArr);

		$PowerBB->template->display('chat_edit');
	}

	function _EditStart()
	{
		global $PowerBB;

			if (empty($PowerBB->_GET['id']))
			{
				$PowerBB->functions->error($PowerBB->_CONF['template']['_CONF']['lang']['Chat_message_requested_does_not_exist']);
			}

           $PowerBB->_POST['textc'] = str_ireplace('{39}',"'",$PowerBB->_POST['textc']);
            $PowerBB->_POST['textc'] = str_ireplace('cookie','',$PowerBB->_POST['textc']);


             // Filter Words
	        $censorwords = preg_split('#[ \r\n\t]+#', $PowerBB->_CONF['info_row']['censorwords'], -1, PREG_SPLIT_NO_EMPTY);
            $PowerBB->_POST['country'] = str_ireplace($censorwords,'', $PowerBB->_POST['country']);
            $PowerBB->_POST['textc'] = str_ireplace($censorwords,'', $PowerBB->_POST['textc']);
            $PowerBB->_POST['textc'] = str_ireplace('&amp;','&',$PowerBB->_POST['textc']);
            $PowerBB->_POST['textc'] = str_ireplace('<br>','',$PowerBB->_POST['textc']);
            $PowerBB->_POST['textc'] = str_ireplace('</p>','',$PowerBB->_POST['textc']);
            $PowerBB->_POST['textc'] = str_ireplace('<p>','',$PowerBB->_POST['textc']);
            $PowerBB->_POST['textc'] = str_ireplace('XSS','',$PowerBB->_POST['textc']);
            $PowerBB->_POST['textc'] = str_ireplace('write','',$PowerBB->_POST['textc']);
            $PowerBB->_POST['textc'] = str_ireplace('document','',$PowerBB->_POST['textc']);
            $PowerBB->_POST['textc'] = str_ireplace('&quot;','',$PowerBB->_POST['textc']);
            $PowerBB->_POST['country'] = str_ireplace('&amp;','&',$PowerBB->_POST['country']);
            $PowerBB->_POST['country'] = str_ireplace('<br>','',$PowerBB->_POST['country']);
            $PowerBB->_POST['country'] = str_ireplace('</p>','',$PowerBB->_POST['country']);
            $PowerBB->_POST['country'] = str_ireplace('<p>','',$PowerBB->_POST['country']);
            $PowerBB->_POST['country'] = str_ireplace('&quot;','',$PowerBB->_POST['country']);
            $PowerBB->_POST['country'] = str_ireplace('http://','',$PowerBB->_POST['country']);
            $PowerBB->_POST['country'] = str_ireplace('www','',$PowerBB->_POST['country']);
            $PowerBB->_POST['country'] = str_ireplace('com','',$PowerBB->_POST['country']);
            $PowerBB->_POST['country'] = str_ireplace('net','',$PowerBB->_POST['country']);
            $PowerBB->_POST['country'] = str_ireplace('org;','',$PowerBB->_POST['country']);
            $PowerBB->_POST['country'] = str_ireplace('iframe;','',$PowerBB->_POST['country']);
            $PowerBB->_POST['textc'] = str_ireplace('iframe;','',$PowerBB->_POST['textc']);
            //
        	   $PowerBB->_POST['country'] = 	$PowerBB->functions->CleanVariable($PowerBB->_POST['country'],'html');
               //$PowerBB->_POST['textc'] =  $PowerBB->functions->CleanVariable($PowerBB->_POST['textc'],'nohtml');
		       // Kill SQL Injection
		        $PowerBB->_POST['country'] = $PowerBB->functions->CleanVariable($PowerBB->_POST['country'],'sql');
		        $PowerBB->_POST['textc'] = $PowerBB->functions->CleanVariable($PowerBB->_POST['textc'],'sql');

            $TextPost = utf8_decode($PowerBB->_POST['textc']);
    		if (isset($TextPost{$PowerBB->_CONF['info_row']['chat_num_characters']}))
    		{    		     $PowerBB->_CONF['template']['_CONF']['lang']['message_large_number_of_characters'] = str_ireplace('970',$PowerBB->_CONF['info_row']['chat_num_characters'],$PowerBB->_CONF['template']['_CONF']['lang']['message_large_number_of_characters']);
                 $PowerBB->functions->error_no_foot($PowerBB->_CONF['template']['_CONF']['lang']['message_large_number_of_characters']);
             }

		$ChatArr 			= 	array();
		$ChatArr['field']	=	array();

		$ChatArr['field']['country'] 	    = 	$PowerBB->functions->CleanVariable($PowerBB->_POST['country'],'html');
		$ChatArr['field']['message'] 		= 	$PowerBB->_POST['textc'];
		$ChatArr['field']['country'] 	= 	$PowerBB->_POST['country'];
		$ChatArr['field']['username'] 	= 	$PowerBB->_POST['username'];
		$ChatArr['where'] 				= 	array('id',$PowerBB->_GET['id']);

		$update = $PowerBB->chat->UpdateChat($ChatArr);

		if ($update)
		{
			$PowerBB->functions->msg($PowerBB->_CONF['template']['_CONF']['lang']['Chat_message_has_been_updated_successfully']);
			$PowerBB->functions->redirect('index.php?page=chat_message&amp;control=1&amp;main=1');
		}
	}

	function _DelStart()
	{
		global $PowerBB;

			if (empty($PowerBB->_GET['id']))
			{
				$PowerBB->functions->error($PowerBB->_CONF['template']['_CONF']['lang']['Chat_message_requested_does_not_exist']);
			}

			$DelArr 			= 	array();
			$DelArr['where'] 	= 	array('id',$PowerBB->_GET['id']);

			$del = $PowerBB->core->Deleted($DelArr,'chat');

		if ($del)
		{
				$PowerBB->functions->msg($PowerBB->_CONF['template']['_CONF']['lang']['Chat_message_has_been_deleted_successfully']);
				$PowerBB->functions->redirect('index.php?page=chat_message&amp;control=1&amp;main=1');

		}
	}

	function _DelAllStart()
	{
		global $PowerBB;


			$truncate = $PowerBB->DB->sql_query("TRUNCATE " . $PowerBB->table['chat'] );


		if ($truncate)
		{
			$PowerBB->functions->msg($PowerBB->_CONF['template']['_CONF']['lang']['Chat_messages_has_been_deleted_successfully']);
			$PowerBB->functions->redirect('index.php?page=chat_message&amp;control=1&amp;main=1');
		}
	}

}

?>
