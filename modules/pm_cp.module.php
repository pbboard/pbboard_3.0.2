<?php

(!defined('IN_PowerBB')) ? die() : '';

$CALL_SYSTEM					=	array();
$CALL_SYSTEM['PM'] 				= 	true;
$CALL_SYSTEM['ICONS'] 			= 	true;
$CALL_SYSTEM['TOOLBOX'] 		= 	true;
$CALL_SYSTEM['FILESEXTENSION'] 	= 	true;
$CALL_SYSTEM['ATTACH'] 			= 	true;

define('JAVASCRIPT_PowerCode',true);

include('common.php');

define('CLASS_NAME','PowerBBPrivateMassegeCPMOD');

class PowerBBPrivateMassegeCPMOD
{
	function run()
	{
		global $PowerBB;

		if (!$PowerBB->_CONF['info_row']['pm_feature'])
		{
            $PowerBB->functions->ShowHeader();
			$PowerBB->functions->error($PowerBB->_CONF['template']['_CONF']['lang']['no_pm']);
		}

		/** Can't use the private massege system **/
		if (!$PowerBB->_CONF['rows']['group_info']['use_pm'])
		{
        	$PowerBB->functions->ShowHeader();
		     /** Visitor can't use the private massege system **/
			if (!$PowerBB->_CONF['member_permission'])
			{
				  $PowerBB->template->display('login');
	              $PowerBB->functions->error_stop();
			 }
		    else
            {
			$PowerBB->functions->error($PowerBB->_CONF['template']['_CONF']['lang']['Cant_use_pm']);
	        }
		}
		/** **/

		/** Conrol private masseges **/
		if ($PowerBB->_GET['cp'])
		{
			/** Delete private massege **/
			if ($PowerBB->_GET['tools'])
			{
				$this->_ToolsPrivateMassege();
			}
			else
			{
				@header("Location: index.php");
				exit;
			}
			/** **/
		}
		else
		{
			@header("Location: index.php");
			exit;
		}
		/** **/

		$PowerBB->functions->GetFooter();
	}

	function _ToolsPrivateMassege()
	{
		global $PowerBB;
		if ($PowerBB->_POST['delet'])
		{

		$PowerBB->functions->ShowHeader($PowerBB->_CONF['template']['_CONF']['lang']['deletion_process']);

		$PowerBB->functions->AddressBar('<a href="index.php?page=pm&amp;list=1&amp;folder=inbox"> ' .$PowerBB->_CONF['template']['_CONF']['lang']['Private_Messages'] . '</a>' . $PowerBB->_CONF['info_row']['adress_bar_separate'] . $PowerBB->_CONF['template']['_CONF']['lang']['Ongoing_process']);

		if (empty($PowerBB->_POST['check']))
		{
			$PowerBB->functions->error($PowerBB->_CONF['template']['_CONF']['lang']['You_do_not_select_any_pm']);
		}


       $Massege_D = $PowerBB->_POST['check'];


       foreach ($Massege_D as $DeleteMassege)
       {


			$DelArr 			= 	array();
			$DelArr['where'] 	= 	array('id',intval($DeleteMassege));

			$del = $PowerBB->pm->DeletePrivateMessage($DelArr);

			if ($del)
			{
				// Recount the number of new messages after delete this message
				$NumArr 						= 	array();
				$NumArr['where'] 				= 	array();

				$NumArr['where'][0] 			= 	array();
				$NumArr['where'][0]['name'] 	= 	'user_to';
				$NumArr['where'][0]['oper'] 	= 	'=';
				$NumArr['where'][0]['value'] 	= 	$PowerBB->_CONF['member_row']['username'];

				$NumArr['where'][1] 			= 	array();
				$NumArr['where'][1]['con'] 		= 	'AND';
				$NumArr['where'][1]['name'] 	= 	'folder';
				$NumArr['where'][1]['oper'] 	= 	'=';
				$NumArr['where'][1]['value'] 	= 	'inbox';

				$NumArr['where'][2] 			= 	array();
				$NumArr['where'][2]['con'] 		= 	'AND';
				$NumArr['where'][2]['name'] 	= 	'user_read';
				$NumArr['where'][2]['oper'] 	= 	'=';
				$NumArr['where'][2]['value'] 	= 	'0';

				$Number = $PowerBB->pm->GetPrivateMassegeNumber($NumArr);

				$CacheArr 					= 	array();
				$CacheArr['field']			=	array();

				$CacheArr['field']['unread_pm'] 	= 	$Number;
				$CacheArr['where'] 					= 	array('username',$PowerBB->_CONF['member_row']['username']);

				$Cache = $PowerBB->member->UpdateMember($CacheArr);

			}

       }



                $PowerBB->functions->msg($PowerBB->_CONF['template']['_CONF']['lang']['pm_del_successfully']);
				$PowerBB->functions->redirect('index.php?page=pm_list&list=1&folder=inbox');

	 }


	 if ($PowerBB->_POST['readable'])
	 {

		$PowerBB->functions->ShowHeader($PowerBB->_CONF['template']['_CONF']['lang']['deletion_process']);

		$PowerBB->functions->AddressBar('<a href="index.php?page=pm&amp;list=1&amp;folder=inbox"> ' .$PowerBB->_CONF['template']['_CONF']['lang']['Private_Messages'] . '</a>' . $PowerBB->_CONF['info_row']['adress_bar_separate'] . $PowerBB->_CONF['template']['_CONF']['lang']['Ongoing_process']);

		if (empty($PowerBB->_POST['check']))
		{
			$PowerBB->functions->error($PowerBB->_CONF['template']['_CONF']['lang']['You_do_not_select_any_pm']);
		}


       $Massege_D = $PowerBB->_POST['check'];


          foreach ($Massege_D as $Read)
          {


			$ReadArr 						= 	array();
			$ReadArr['where'] 				= 	array();

			$ReadArr['where'][0] 			= 	array();
			$ReadArr['where'][0]['name'] 	= 	'id';
			$ReadArr['where'][0]['oper'] 	= 	'=';
			$ReadArr['where'][0]['value'] 	= 	intval($Read);

			$Read = $PowerBB->pm->MakeMassegeRead($ReadArr);

			if ($Read)
			{
				$NumArr 				= 	array();
				$NumArr['username'] 	= 	$PowerBB->_CONF['member_row']['username'];

				$Number = $PowerBB->pm->NewMessageNumber($NumArr);

				$CacheArr 					= 	array();
				$CacheArr['field']			=	array();

				$CacheArr['field']['unread_pm'] 	= 	$Number;
				$CacheArr['where'] 					= 	array('username',$PowerBB->_CONF['member_row']['username']);

				$Cache = $PowerBB->member->UpdateMember($CacheArr);
			}


		  }


                $PowerBB->functions->msg($PowerBB->_CONF['template']['_CONF']['lang']['Make_it_readable_successfully']);
				$PowerBB->functions->redirect('index.php?page=pm_list&list=1&folder=inbox');
       }
          if ($PowerBB->_POST['unreadable'])
     {

       $PowerBB->functions->ShowHeader($PowerBB->_CONF['template']['_CONF']['lang']['deletion_process']);

       $PowerBB->functions->AddressBar('<a href="index.php?page=pm&list=1&folder=inbox"> ' .$PowerBB->_CONF['template']['_CONF']['lang']['Private_Messages'] . '</a>' . $PowerBB->_CONF['info_row']['adress_bar_separate'] . $PowerBB->_CONF['template']['_CONF']['lang']['Ongoing_process']);

       if (empty($PowerBB->_POST['check']))
       {
          $PowerBB->functions->error($PowerBB->_CONF['template']['_CONF']['lang']['You_do_not_select_any_pm']);
       }


      $Massege_D = $PowerBB->_POST['check'];

        $x=1;
        foreach ($Massege_D as $UnRead)
        {


          $UnReadArr                    =    array();
          $UnReadArr['where']              =    array();

          $UnReadArr['where'][0]           =    array();
          $UnReadArr['where'][0]['name']    =    'id';
          $UnReadArr['where'][0]['oper']    =    '=';
          $UnReadArr['where'][0]['value']    =    intval($UnRead);

          $UnRead = $PowerBB->pm->MakeMassegeUnRead($UnReadArr);

          if ($UnRead)
          {
             $NumArr              =    array();
             $NumArr['username']    =    $PowerBB->_CONF['member_row']['username'];

             $Number = $PowerBB->pm->NewMessageNumber($NumArr);


             $CacheArr                 =    array();
             $CacheArr['field']          =    array();

             $CacheArr['field']['unread_pm']    =    $Number;
             $CacheArr['where']                 =    array('username',$PowerBB->_CONF['member_row']['username']);

             $Cache = $PowerBB->member->UpdateMember($CacheArr);
          }

          $x += 1;
        }


             $PowerBB->functions->msg($PowerBB->_CONF['template']['_CONF']['lang']['Make_it_unreadable_successfully']);
             $PowerBB->functions->redirect('index.php?page=pm_list&list=1&folder=inbox');

       }


               if ($PowerBB->_POST['inbox_empty'] || $PowerBB->_POST['sent_empty'])
             {

                $PowerBB->functions->ShowHeader($PowerBB->_CONF['template']['_CONF']['lang']['deletion_process']);
                $PowerBB->functions->AddressBar('<a href="index.php?page=pm&list=1&folder=inbox"> ' .$PowerBB->_CONF['template']['_CONF']['lang']['Private_Messages'] . '</a>' . $PowerBB->_CONF['info_row']['adress_bar_separate'] . $PowerBB->_CONF['template']['_CONF']['lang']['Ongoing_process']);

                if ($PowerBB->_POST['inbox_empty'])
                    {

                    $InboxEmpty                    =    array();
                    $InboxEmpty['table'] = $PowerBB->table['pm'];
                    $InboxEmpty['where']              =    array();

                    $InboxEmpty['where'][0]           =    array();
                    $InboxEmpty['where'][0]['name']    =    'user_to';
                    $InboxEmpty['where'][0]['oper']    =    '=';
                    $InboxEmpty['where'][0]['value']    =    $PowerBB->_CONF['member_row']['username'];

                    $InboxEmpty['where'][1]           =    array();
                    $InboxEmpty['where'][1]['con']        =    'AND';
                    $InboxEmpty['where'][1]['name']    =    'folder';
                    $InboxEmpty['where'][1]['oper']    =    '=';
                    $InboxEmpty['where'][1]['value']    =    'inbox';

                    $del = $PowerBB->records->Delete($InboxEmpty);
                    if ($del)
                       {
                       $NumArr              =    array();
                       $NumArr['username']    =    $PowerBB->_CONF['member_row']['username'];
                       $Number                = $PowerBB->pm->NewMessageNumber($NumArr);
                       $CacheArr                 =    array();
                       $CacheArr['field']          =    array();
                       $CacheArr['field']['unread_pm']    =    $Number;
                       $CacheArr['where']                 =    array('username',$PowerBB->_CONF['member_row']['username']);

                       $Cache = $PowerBB->member->UpdateMember($CacheArr);
                       }
                       $PowerBB->functions->msg($PowerBB->_CONF['template']['_CONF']['lang']['inbox_empty_successfully']);
                       $PowerBB->functions->redirect('index.php?page=pm_list&list=1&folder=inbox');
                    }elseif($PowerBB->_POST['sent_empty'])
                       {
                       $SentEmpty                        =    array();
                       $SentEmpty['table']                 = $PowerBB->table['pm'];
                       $SentEmpty['where']              =    array();

                       $SentEmpty['where'][0]              =    array();
                       $SentEmpty['where'][0]['name']        =    'user_from';
                       $SentEmpty['where'][0]['oper']        =    '=';
                       $SentEmpty['where'][0]['value']    =    $PowerBB->_CONF['member_row']['username'];

                       $SentEmpty['where'][1]              =    array();
                       $SentEmpty['where'][1]['con']        =    'AND';
                       $SentEmpty['where'][1]['name']        =    'folder';
                       $SentEmpty['where'][1]['oper']        =    '=';
                       $SentEmpty['where'][1]['value']    =    'sent';

                       $del = $PowerBB->records->Delete($SentEmpty);
                       if ($del)
                          {
                          $PowerBB->functions->msg($PowerBB->_CONF['template']['_CONF']['lang']['sent_empty_successfully']);
                          $PowerBB->functions->redirect('index.php?page=pm_list&list=1&folder=inbox');
                          }

                       }

             }

	}

}
