<?php

(!defined('IN_PowerBB')) ? die() : '';
define('IN_ADMIN',true);
include('../common.php');

define('CLASS_NAME','PowerBBCoreMOD');

class PowerBBCoreMOD extends _functions
{

    var $dir_name;
    var $search_phrase;
    var $allowed_file_types = array('tpl');
    var $foundFiles;
    var $myfiles;

	function run()
	{
		global $PowerBB;

		if ($PowerBB->_CONF['member_permission'])
		{
			if ($PowerBB->_CONF['rows']['group_info']['admincp_template'] == '0')
			{
			  $PowerBB->template->display('header');
			  $PowerBB->functions->error($PowerBB->_CONF['template']['_CONF']['lang']['error_permission']);
			}

			if ($PowerBB->_GET['add'])
			{
			  $PowerBB->template->display('header');
				if ($PowerBB->_GET['main'])
				{
					$this->_AddMain();
				}
				elseif ($PowerBB->_GET['start'])
				{
					$this->_AddStart();
				}
			}
			elseif ($PowerBB->_GET['control'])
			{
			  $PowerBB->template->display('header');
				if ($PowerBB->_GET['main'])
				{
					$this->_ControlMain();
				}
				elseif ($PowerBB->_GET['show'])
				{
					$this->_ControlShow();
				}
				elseif ($PowerBB->_GET['get'])
				{
					$this->_ControlGet();
				}
			}
			elseif ($PowerBB->_GET['edit'])
			{
			  $PowerBB->template->display('header');
				if ($PowerBB->_GET['main'])
				{
					$this->_EditMain();
				}
				elseif ($PowerBB->_GET['start'])
				{
					$this->_EditStart();
				}
			}
			elseif ($PowerBB->_GET['del'])
			{
			  $PowerBB->template->display('header');
				if ($PowerBB->_GET['main'])
				{
					$this->_DelStart();
				}
			}
			elseif ($PowerBB->_GET['delcache'])
			{
			  $PowerBB->template->display('header');
				if ($PowerBB->_GET['main'])
				{
					$this->_DelAllcache();
				}
			}
			elseif ($PowerBB->_GET['delstartcache'])
			{
			  $PowerBB->template->display('header');
			  if ($PowerBB->_GET['main'])
			  {
			     $this->_DelStartAllcache();
			  }
			}
			elseif ($PowerBB->_GET['delcache_admin'])
			{
			  $PowerBB->template->display('header');
				if ($PowerBB->_GET['main'])
				{
					$this->_DelAllcacheAdmin();
				}
			}
			elseif ($PowerBB->_GET['view'])
			{
			  $PowerBB->template->display('header');
				$PowerBB->template->display('header');

				if ($PowerBB->_GET['main'])
				{
					$this->_ViewOrginalTemplate();
				}
				elseif ($PowerBB->_GET['start'])
				{
					$this->_ViewStart();
				}
			}
			elseif ($PowerBB->_GET['search'])
			{
			  $PowerBB->template->display('header');
				if ($PowerBB->_GET['main'])
				{
					$this->_SearchMain();
				}
				elseif ($PowerBB->_GET['start'])
				{
					$this->_SearchStart();
				}

			}
			elseif ($PowerBB->_GET['revertall'])
			{
			  $PowerBB->template->display('header');
                if ($PowerBB->_GET['start'])
				{
                 $Yes = $PowerBB->_CONF['template']['_CONF']['lang']['yes'];
                 $no = $PowerBB->_CONF['template']['_CONF']['lang']['no'];
                 $PowerBB->functions->error("<b>".$PowerBB->_CONF['template']['_CONF']['lang']['revert_all_templates_from_style_x']."</b><br /><br /><br /><a class='button' href='index.php?page=template&amp;revertall=1&amp;start_revertall=1&amp;id=".$PowerBB->_GET['id']."'>&nbsp;<b> ".$Yes." </b>&nbsp;</a>&nbsp;&nbsp;<a class='button' href='index.php?page=style&amp;control=1&amp;&main=1'> &nbsp;<b>".$no." </b>&nbsp;</a>");
				}
				elseif ($PowerBB->_GET['start_revertall'])
				{
					$this->_RevertallStart();
				}
				elseif ($PowerBB->_GET['start_def'])
				{
					$this->_RevertallDefStart();
				}
			}
			elseif ($PowerBB->_GET['common_templates'])
			{
			   $PowerBB->template->display('header');
				if ($PowerBB->_GET['start'])
				{
					$this->_CommonTemplatesStart();
				}

			}
			elseif ($PowerBB->_GET['singles_original'])
			{
				if ($PowerBB->_GET['start'])
				{
					$this->_Get_singles_original_default();
				}

			}

			$PowerBB->template->display('footer');
		}
	}

	function _AddMain()
	{
		global $PowerBB;

		$StyArr 					= 	array();
		$StyArr['order'] 			=	array();
		$StyArr['order']['field'] 	= 	'id';
		$StyArr['order']['type']	=	'DESC';
		$StyArr['proc'] 			= 	array();
		$StyArr['proc']['*'] 		= 	array('method'=>'clean','param'=>'html');

		$PowerBB->_CONF['template']['while']['StyleList'] = $PowerBB->core->GetList($StyArr,'style');

		$PowerBB->template->display('template_add');
	}

	function _AddStart()
	{
		global $PowerBB;

		if (empty($PowerBB->_POST['filename'])
			or empty($PowerBB->_POST['style'])
			or empty($PowerBB->_POST['context']))
		{
			$PowerBB->functions->error($PowerBB->_CONF['template']['_CONF']['lang']['Please_fill_in_all_the_information']);
		}
      		$PowerBB->_POST['filename'] = $PowerBB->functions->CleanVariable($PowerBB->_POST['filename'],'trim');

        $PowerBB->functions->GetFileExtension($PowerBB->_POST['filename']);

		$StyleArr 			= 	array();
		$StyleArr['where'] 	= 	array('id',$PowerBB->_POST['style']);

		$StyleInfo = $PowerBB->core->GetInfo($StyleArr,'style');

		if (!$StyleInfo)
		{
			$PowerBB->functions->error($PowerBB->_CONF['template']['_CONF']['lang']['Style_requested_does_not_exist']);
		}
            $PowerBB->_POST['context'] = str_replace("'", "&#39;", $PowerBB->_POST['context']);

			$styleid 	    = $PowerBB->_POST['style'];
			$Templattitle 	= $PowerBB->_POST['filename'];

		  $_query1= $PowerBB->DB->sql_query("SELECT * FROM " . $PowerBB->table['template'] . " WHERE styleid = '$styleid' AND title LIKE '$Templattitle' AND templatetype = 'template'");
          $row1 = $PowerBB->DB->sql_fetch_array($_query1);

		if (!empty($row1['title']))
		{
           $PowerBB->_CONF['template']['_CONF']['lang']['The_template_name_that_you_entered_already_exists'] = str_replace("%te%", ": ".$PowerBB->_POST['filename'], $PowerBB->_CONF['template']['_CONF']['lang']['The_template_name_that_you_entered_already_exists']);

			$PowerBB->functions->error($PowerBB->_CONF['template']['_CONF']['lang']['The_template_name_that_you_entered_already_exists']);
		}

		if ($PowerBB->_CONF['rows']['member_row']['usergroup'] != '1')
		{
			$PowerBB->functions->error($PowerBB->_CONF['template']['_CONF']['lang']['error_permission']);
		}

		$TemplateArr 			= 	array();
		$TemplateArr['field']	=	array();

		$TemplateArr['field']['styleid'] 		    = 	$PowerBB->_POST['style'];
		$TemplateArr['field']['title'] 		    = 	$PowerBB->_POST['filename'];
		$TemplateArr['field']['template'] 	    = 	$PowerBB->_POST['context'];
		$TemplateArr['field']['template_un'] 	    	= 	$PowerBB->_POST['context'];
		$TemplateArr['field']['templatetype'] 		        = 	"template";
		$TemplateArr['field']['dateline'] 		            = 	$PowerBB->_CONF['now'];
		$TemplateArr['field']['version'] 	    = 	$PowerBB->_CONF['info_row']['MySBB_version'];
		$TemplateArr['field']['username'] 	    = 	$PowerBB->_CONF['rows']['member_row']['username'];
		$TemplateArr['field']['product'] 		    = 	"PBBoard";

		$insert = $PowerBB->core->Insert($TemplateArr,'template');

	     if ($insert)
	     {
			$TemplateEditArr				=	array();
			$TemplateEditArr['where'] 	= 	array('title',$PowerBB->_POST['filename']);

			$TemplateEdit = $PowerBB->core->GetInfo($TemplateEditArr,'template');

            $templates_dir = ("../cache_templates/".$TemplateEdit['title']."_".$TemplateEdit['styleid'].".php");
	    	$fp = fopen($templates_dir,'w');
	    	$fw = fwrite($fp,$TemplateEdit['template']);
    		 fclose($fp);

			$PowerBB->functions->msg($PowerBB->_CONF['template']['_CONF']['lang']['Template_has_been_added_successfully']);
	     	$PowerBB->functions->redirect('index.php?page=template&amp;edit=1&amp;main=1&amp;templateid=' . $TemplateEdit['templateid'] . '&amp;styleid='.$PowerBB->_POST['style']);
	     }
	}

	function _ControlMain()
	{
		global $PowerBB;

		$StyleArr 					= 	array();
		$StyleArr['order'] 			=	array();
		$StyleArr['order']['field']	= 	'style_order';
		$StyleArr['order']['type']	=	'ASC';
		$StyleArr['proc'] 			= 	array();
		$StyleArr['proc']['*'] 		= 	array('method'=>'clean','param'=>'html');

		$PowerBB->_CONF['template']['while']['StyleList'] = $PowerBB->core->GetList($StyleArr,'style');

		$PowerBB->template->display('templates_main');
	}

	function _ControlShow()
	{
		global $PowerBB;

		$PowerBB->_GET['id'] = $PowerBB->functions->CleanVariable($PowerBB->_GET['id'],'intval');

		if (empty($PowerBB->_GET['id']))
		{
			$PowerBB->functions->error($PowerBB->_CONF['template']['_CONF']['lang']['path_not_true']);
		}

		$StyleArr 				= 	array();
		$StyleArr['where'] 		= 	array('id',$PowerBB->_GET['id']);

		$StyleInfo = $PowerBB->core->GetInfo($StyleArr,'style');

		if (!$StyleInfo)
		{
			$PowerBB->functions->error($PowerBB->_CONF['template']['_CONF']['lang']['Style_requested_does_not_exist']);
		}

		$StyleInfoid = $PowerBB->_GET['id'];

      //  $Getstyles = $PowerBB->DB->sql_query("SELECT * FROM " . $PowerBB->table['template'] . " WHERE styleid ='$StyleInfoid' ORDER BY title ASC");

		$TemplatArr 					= 	array();
		$TemplatArr['where']                =    array();
		$TemplatArr['where'][0]             =    array();
		$TemplatArr['where'][0]['name']       =    'styleid';
		$TemplatArr['where'][0]['oper']       =    '=';
		$TemplatArr['where'][0]['value']       =    $StyleInfoid;

		$TemplatArr['order'] 			=	array();
		$TemplatArr['order']['field']	= 	'title';
		$TemplatArr['order']['type']	=	'ASC';
		$TemplatArr['proc'] 			= 	array();
		$TemplatArr['proc']['*'] 		= 	array('method'=>'clean','param'=>'html');
		$TemplatArr['proc']['dateline']    =    array('method'=>'date','store'=>'dateline','type'=>$PowerBB->_CONF['info_row']['timesystem']);


		$PowerBB->_CONF['template']['while']['TemplatList'] = $PowerBB->core->GetList($TemplatArr,'template');

		$PowerBB->template->assign('StyleInfo',$StyleInfo);

        ////////
		$_query_common_templates = array(
			'header',
			'footer',
			'headinclud'
		);

		$templatesArr 					= 	array();
		$templatesArr['where']                =    array();
		$templatesArr['where'][0]             =    array();
		$templatesArr['where'][0]['name']       =    "title IN ('" . implode("', '", $_query_common_templates) . "') AND styleid";
		$templatesArr['where'][0]['oper']       =    '=';
		$templatesArr['where'][0]['value']       =    $StyleInfoid;

		$templatesArr['order'] 			=	array();
		$templatesArr['order']['field']	= 	'title';
		$templatesArr['order']['type']	=	'DESC';
		$templatesArr['proc'] 			= 	array();
		$templatesArr['proc']['*'] 		= 	array('method'=>'clean','param'=>'html');
		$templatesArr['proc']['dateline']    =    array('method'=>'date','store'=>'dateline','type'=>$PowerBB->_CONF['info_row']['timesystem']);


		$PowerBB->_CONF['template']['while']['CommonTemplates'] = $PowerBB->core->GetList($templatesArr,'template');

		$PowerBB->template->display('templates_show_templates_list');
	}

	function _ControlGet()
	{
		global $PowerBB;

		$PowerBB->_GET['id'] = $PowerBB->functions->CleanVariable($PowerBB->_GET['id'],'intval');

		if (empty($PowerBB->_GET['id']))
		{
			$PowerBB->functions->error($PowerBB->_CONF['template']['_CONF']['lang']['path_not_true']);
		}

		$StyleArr 				= 	array();
		$StyleArr['where'] 		= 	array('id',$PowerBB->_GET['id']);

		$StyleInfo = $PowerBB->core->GetInfo($StyleArr,'style');

		if (!$StyleInfo)
		{
			$PowerBB->functions->error($PowerBB->_CONF['template']['_CONF']['lang']['Style_requested_does_not_exist']);
		}

		$PowerBB->functions->CleanVariable($StyleInfo,'html');

		$TemplatesList = array();

		if (is_dir($StyleInfo['template_path']))
		{
			$dir = opendir($StyleInfo['template_path']);

			if ($dir)
			{
				while (($file = readdir($dir)) !== false)
				{
					if ($file == '.'
						or $file == '..')
					{
						continue;
					}
                    @sort($file);
					$TemplatesList[]['filename'] = $file;
				}

				closedir($dir);
			}
		}

			foreach($TemplatesList as $template){

			  	$path = './' . $StyleInfo['template_path'] . '/' . $template['filename'];

		    	if (!file_exists($path))
		    	{
		    		$PowerBB->functions->error($PowerBB->_CONF['template']['_CONF']['lang']['Template_requested_does_not_exist']);
		    	}
		    	// To be more advanced :D
		    	if (!is_writable($path))
		    	{
		    		$PowerBB->functions->error($PowerBB->_CONF['template']['_CONF']['lang']['is_not_writable']);
		    	}

                   $lines = file($path);
			    	$con = '';
			    	foreach ($lines as $line)
			    	{
			    		$con .= $line;
			    	}


	                     $filenametemplate = $template['filename'];
	                   	 $filenametemplate = str_replace(".tpl","",$filenametemplate);
				    	  $context .= "<context_".$filenametemplate."><![CDATA[".$con."]]></context_".$filenametemplate.">\n";


				     $filename = 'templates.xml';
				     $fp = fopen($filename,'w');
				     $fw = fwrite($fp,$context);
                      fclose($fp);
			}


	}

	function _EditMain()
    {
    	global $PowerBB;

			if (empty($PowerBB->_GET['templateid']))
			{
				$PowerBB->functions->error($PowerBB->_CONF['template']['_CONF']['lang']['The_declaration_does_not_exist']);
			}

		$StyleArr 			= 	array();
		$StyleArr['where'] 	= 	array('id',$PowerBB->_GET['styleid']);

		$StyleInfo = $PowerBB->core->GetInfo($StyleArr,'style');

		if (!$StyleInfo)
		{
			$PowerBB->functions->error($PowerBB->_CONF['template']['_CONF']['lang']['Style_requested_does_not_exist']);
		}


			$TemplateEditArr				=	array();
			$TemplateEditArr['where'] 	= 	array('templateid',$PowerBB->_GET['templateid']);

			$TemplateEdit = $PowerBB->core->GetInfo($TemplateEditArr,'template');

		if (!$TemplateEdit)
		{
		    		$PowerBB->functions->error($PowerBB->_CONF['template']['_CONF']['lang']['Template_requested_does_not_exist']);
		}


		$PowerBB->template->assign('TemplateEdit',$TemplateEdit);
		$PowerBB->template->assign('StyleInfo',$StyleInfo);

    	$context = $TemplateEdit['template'];
     	$context =htmlspecialchars($context);
        $context = str_replace("&#39;", "'", $context);
        $context = str_replace("&amp;#39;", "'", $context);
        $context = str_replace("&rdquo;", '"', $context);


		$last_edit = $PowerBB->functions->date($TemplateEdit['dateline']);
    	$PowerBB->template->assign('filename',$TemplateEdit['title']);
    	$PowerBB->template->assign('last_edit',$last_edit);
    	$PowerBB->template->assign('context',$context);

    	$PowerBB->template->display('template_edit');
	}

	function _EditStart()
	{
		global $PowerBB;

    	if (empty($PowerBB->_GET['templateid']))
    	{
    		$PowerBB->functions->error($PowerBB->_CONF['template']['_CONF']['lang']['path_not_true']);
    	}
        $PowerBB->_POST['context'] = str_replace("'", "&#39;", $PowerBB->_POST['context']);

		$TemplateArr 			= 	array();
		$TemplateArr['field']	=	array();

		$TemplateArr['field']['template'] 		= 	$PowerBB->_POST['context'];
		$TemplateArr['field']['dateline'] 		    = $PowerBB->_CONF['now'];
		$TemplateArr['where'] 				= 	array('templateid',$PowerBB->_GET['templateid']);

		$update = $PowerBB->core->Update($TemplateArr,'template');


    	if ($update)
    	{
			$TemplateEditArr				=	array();
			$TemplateEditArr['where'] 	= 	array('templateid',$PowerBB->_GET['templateid']);

			$TemplateEdit = $PowerBB->core->GetInfo($TemplateEditArr,'template');

            $templates_dir = ("../cache_templates/".$TemplateEdit['title']."_".$TemplateEdit['styleid'].".php");
	    	$fp = fopen($templates_dir,'w+');
	    	$fw = fwrite($fp,$TemplateEdit['template']);
    		 fclose($fp);
			$PowerBB->functions->msg($PowerBB->_CONF['template']['_CONF']['lang']['Template_has_been_updated_successfully']);
			$PowerBB->functions->redirect('index.php?page=template&edit=1&main=1&templateid=' . $TemplateEdit['templateid'] . '&styleid=' .$TemplateEdit['styleid']);
    	}
    }

	function _ViewOrginalTemplate()
    {
    	global $PowerBB;

			if (empty($PowerBB->_GET['templateid']))
			{
				$PowerBB->functions->error($PowerBB->_CONF['template']['_CONF']['lang']['The_declaration_does_not_exist']);
			}

		$StyleArr 			= 	array();
		$StyleArr['where'] 	= 	array('id',$PowerBB->_GET['styleid']);

		$StyleInfo = $PowerBB->core->GetInfo($StyleArr,'style');

		if (!$StyleInfo)
		{
			$PowerBB->functions->error($PowerBB->_CONF['template']['_CONF']['lang']['Style_requested_does_not_exist']);
		}


			$TemplateEditArr				=	array();
			$TemplateEditArr['where'] 	= 	array('templateid',$PowerBB->_GET['templateid']);

			$TemplateEdit = $PowerBB->core->GetInfo($TemplateEditArr,'template');


		if (!$TemplateEdit)
		{
		   $PowerBB->functions->error($PowerBB->_CONF['template']['_CONF']['lang']['Template_requested_does_not_exist']);
		}

         $originalfile ="../cache/original_default_templates.xml";

			if (file_exists($originalfile))
			{

			   $xml_code = @file_get_contents($originalfile);

			}

			if (strstr($xml_code,'decode="0"'))
			{
				$xml_code = str_replace('decode="0"','decode="1"',$xml_code);
				preg_match_all('/<!\[CDATA\[(.*?)\]\]>/is', $xml_code, $match);
				foreach($match[0] as $val)
				{
				$xml_code = str_replace($val,base64_encode($val),$xml_code);
				}

			}
        		$import = $PowerBB->functions->xml_array($xml_code);
				$Templates = $import['styles']['templategroup'];
				$Templates_number = sizeof($import['styles']['templategroup']['template']);

			            $x = 0;
     			while ($x < $Templates_number)
     			{
						$templatetitle = $Templates['template'][$x.'_attr']['name'];
						$version = $Templates['template'][$x.'_attr']['version'];
						$template_version = $Templates['template'][$x.'_attr']['version'];
						$template_version = str_replace(".", "", $template_version);
						if ($Templates['template'][$x.'_attr']['decode'] == '1'
						or $template_version <= '301')
						{
						$template = @base64_decode($Templates['template'][$x]);
     				    }
     				    else
						{
						$template = $Templates['template'][$x];
     				    }

     				    $template = str_replace("//<![CDATA[", "", $template);
						$template = str_replace("//]]>", "", $template);
     				    $template = str_replace("<![CDATA[","", $template);
						$template = str_replace("]]>","", $template);
	                if($TemplateEdit['title'] == $templatetitle)
				    {
				      $TemplateEdit['template_un'] = $template;
				      $x = 0;
				      break;
				    }
                     $x += 1;
                 }


		$PowerBB->template->assign('TemplateEdit',$TemplateEdit);
		$PowerBB->template->assign('StyleInfo',$StyleInfo);

    	$context = $TemplateEdit['template_un'];
        $context =htmlspecialchars($context);
        $context = str_replace("&#39;", "'", $context);
        $context = str_replace("&amp;#39;", "'", $context);
        $context = str_replace("&rdquo;", '"', $context);

		$last_edit = $PowerBB->functions->date($TemplateEdit['dateline']);
    	$PowerBB->template->assign('filename',$TemplateEdit['title']);
    	$PowerBB->template->assign('last_edit',$last_edit);
    	$PowerBB->template->assign('context',$context);

		//$OrginalTemplate = $PowerBB->functions->CleanVariable($OrginalTemplate,'html');
    	$PowerBB->template->display('view_orginal_template');
	}

	function _ViewStart()
    {
    	global $PowerBB;

			if (empty($PowerBB->_GET['templateid']))
			{
				$PowerBB->functions->error($PowerBB->_CONF['template']['_CONF']['lang']['The_declaration_does_not_exist']);
			}

		$TemplateEditArr				=	array();
		$TemplateEditArr['where'] 	= 	array('templateid',$PowerBB->_GET['templateid']);

		$TemplateEdit = $PowerBB->core->GetInfo($TemplateEditArr,'template');

		if (!$TemplateEdit)
		{
		  $PowerBB->functions->error($PowerBB->_CONF['template']['_CONF']['lang']['Template_requested_does_not_exist']);
		}

		$StyleArr 			= 	array();
		$StyleArr['where'] 	= 	array('id',$TemplateEdit['styleid']);

		$StyleInfo = $PowerBB->core->GetInfo($StyleArr,'style');

		if (!$StyleInfo)
		{
			$PowerBB->functions->error($PowerBB->_CONF['template']['_CONF']['lang']['Style_requested_does_not_exist']);
		}


         $originalfile ="../cache/original_default_templates.xml";

			if (file_exists($originalfile))
			{

			   $xml_code = @file_get_contents($originalfile);

			}
			if (strstr($xml_code,'decode="0"'))
			{
				$xml_code = str_replace('decode="0"','decode="1"',$xml_code);
				preg_match_all('/<!\[CDATA\[(.*?)\]\]>/is', $xml_code, $match);
				foreach($match[0] as $val)
				{
				$xml_code = str_replace($val,base64_encode($val),$xml_code);
				}

			}
        		$import = $PowerBB->functions->xml_array($xml_code);
				$Templates = $import['styles']['templategroup'];
				$Templates_number = sizeof($import['styles']['templategroup']['template']);

			            $x = 0;
     			while ($x < $Templates_number)
     			{
						$templatetitle = $Templates['template'][$x.'_attr']['name'];
						$version = $Templates['template'][$x.'_attr']['version'];
						$template_version = $Templates['template'][$x.'_attr']['version'];
						$template_version = str_replace(".", "", $template_version);
						if ($Templates['template'][$x.'_attr']['decode'] == '1'
						or $template_version <= '301')
						{
						$template = @base64_decode($Templates['template'][$x]);
     				    }
     				    else
						{
						$template = $Templates['template'][$x];
     				    }
     				    $template = str_replace("//<![CDATA[", "", $template);
						$template = str_replace("//]]>", "", $template);
     				    $template = str_replace("<![CDATA[","", $template);
						$template = str_replace("]]>","", $template);

	                if($TemplateEdit['title'] == $templatetitle)
				    {
				      $row['template_un'] = $template;
				      $x = 0;
				      break;
				    }
                     $x += 1;
                 }



        $row['template_un'] = str_replace("'", "&#39;", $row['template_un']);

		$TemplateArr 			= 	array();
		$TemplateArr['field']	=	array();

		$TemplateArr['field']['template'] 		= 	$row['template_un'];
		$TemplateArr['field']['template_un'] 		= 	$row['template_un'];
		$TemplateArr['field']['dateline'] 		    = $PowerBB->_CONF['now'];
		$TemplateArr['where'] 				= 	array('templateid',$PowerBB->_GET['templateid']);

		$update = $PowerBB->core->Update($TemplateArr,'template');

		if ($update)
		{

			$TemplateEditArr				=	array();
			$TemplateEditArr['where'] 	= 	array('templateid',$PowerBB->_GET['templateid']);

			$TemplateEdit = $PowerBB->core->GetInfo($TemplateEditArr,'template');

            $templates_dir = ("../cache_templates/".$TemplateEdit['title']."_".$TemplateEdit['styleid'].".php");
	    	$fp = fopen($templates_dir,'w+');
	    	$fw = fwrite($fp,$TemplateEdit['template']);
    		 fclose($fp);

		    $PowerBB->functions->msg($PowerBB->_CONF['template']['_CONF']['lang']['retrieved_template_origin']);
			$PowerBB->functions->redirect('index.php?page=template&edit=1&main=1&templateid=' . $PowerBB->_GET['templateid'] . '&styleid=' .$TemplateEdit['styleid']);
		}
	}

	function _RevertallStart()
    {
    	global $PowerBB;

			if (empty($PowerBB->_GET['id']))
			{
				$PowerBB->functions->error($PowerBB->_CONF['template']['_CONF']['lang']['The_declaration_does_not_exist']);
			}
	           $styleid			= $PowerBB->_GET['id'];

         $originalfile ="../cache/original_default_templates.xml";

			if (file_exists($originalfile))
			{

			   $xml_code = @file_get_contents($originalfile);

			}
			if (strstr($xml_code,'decode="0"'))
			{
				$xml_code = str_replace('decode="0"','decode="1"',$xml_code);
				preg_match_all('/<!\[CDATA\[(.*?)\]\]>/is', $xml_code, $match);
				foreach($match[0] as $val)
				{
				$xml_code = str_replace($val,base64_encode($val),$xml_code);
				}

			}

        		$import = $PowerBB->functions->xml_array($xml_code);
				$Templates = $import['styles']['templategroup'];
				$Templates_number = sizeof($import['styles']['templategroup']['template']);

		            $x = 0;

     			while ($x < $Templates_number)
     			{
			           $Templattitle = $Templates['template'][$x.'_attr']['name'];
						$version = $Templates['template'][$x.'_attr']['version'];
						$template_version = $Templates['template'][$x.'_attr']['version'];
						$template_version = str_replace(".", "", $template_version);
						if ($Templates['template'][$x.'_attr']['decode'] == '1'
						or $template_version <= '301')
						{
						$template = @base64_decode($Templates['template'][$x]);
     				    }
     				    else
						{
						$template = $Templates['template'][$x];
     				    }

     				    $template = str_replace("//<![CDATA[", "", $template);
						$template = str_replace("//]]>", "", $template);
     				    $template = str_replace("<![CDATA[","", $template);
						$template = str_replace("]]>","", $template);
			            $template = str_replace("'", "&#39;", $template);

					 $_query1= $PowerBB->DB->sql_query("SELECT * FROM " . $PowerBB->table['template'] . " WHERE styleid = '$styleid' AND title = '$Templattitle'");
			          while ($row1 = $PowerBB->DB->sql_fetch_array($_query1))
			          {

							$templates_dir = ("../cache_templates/".$row1['title']."_".$row1['styleid'].".php");

							if (file_exists($templates_dir))
							{
						 	 $cache_del = unlink($templates_dir);
							}

						$TemplateArr 			= 	array();
						$TemplateArr['field']	=	array();

						$TemplateArr['field']['template'] 		= 	$template;
						$TemplateArr['field']['template_un'] 		= 	$template;
						$TemplateArr['field']['dateline'] 	    = $PowerBB->_CONF['now'];
						$TemplateArr['where'] 				    = 	array('templateid',$row1['templateid']);
			          }
						$update = $PowerBB->core->Update($TemplateArr,'template');

                     $x += 1;
     			}

			  if ($update)
			  {
		       $deltemplates = $PowerBB->DB->sql_query("DELETE FROM " . $PowerBB->table['template'] . " WHERE styleid = '$styleid' and title = ''");
              }

		     $PowerBB->functions->msg($PowerBB->_CONF['template']['_CONF']['lang']['retrieved_templates_origin']);
			$PowerBB->functions->redirect('index.php?page=style&amp;control=1&amp;&main=1');
	}

	function _RevertallDefStart()
    {
    	global $PowerBB;

			if (empty($PowerBB->_GET['id']))
			{
				$PowerBB->functions->error($PowerBB->_CONF['template']['_CONF']['lang']['The_declaration_does_not_exist']);
			}

           $styleid			= $PowerBB->_GET['id'];
		 $_query= $PowerBB->DB->sql_query("SELECT * FROM " . $PowerBB->table['template'] . " WHERE styleid = '1' ");
         while ($row = $PowerBB->DB->sql_fetch_array($_query))
       {

         $Templattitle = $row['title'];
		 $_query1= $PowerBB->DB->sql_query("SELECT * FROM " . $PowerBB->table['template'] . " WHERE styleid = '$styleid' AND title = '$Templattitle'");
          while ($row1 = $PowerBB->DB->sql_fetch_array($_query1))
          {

				$templates_dir = ("../cache_templates/".$row1['title']."_".$row1['styleid'].".php");
				if (file_exists($templates_dir))
				{
				$cache_del = unlink($templates_dir);
				}

			$TemplateArr 			= 	array();
			$TemplateArr['field']	=	array();

			$TemplateArr['field']['template_un'] 		= 	$row['template'];
			$TemplateArr['field']['dateline'] 	    = $PowerBB->_CONF['now'];
			$TemplateArr['where'] 				    = 	array('templateid',$row1['templateid']);
          }
			$update = $PowerBB->core->Update($TemplateArr,'template');
       }

		if ($update)
		{
			$PowerBB->functions->msg($PowerBB->_CONF['template']['_CONF']['lang']['has_updated_all_templates']);
			$PowerBB->functions->redirect('index.php?page=style&amp;control=1&amp;&main=1');
	    }
	}
	function _DelStart()
	{
		global $PowerBB;


		if (empty($PowerBB->_GET['templateid']))
		{
			$PowerBB->functions->error($PowerBB->_CONF['template']['_CONF']['lang']['path_not_true']);
		}

			$TemplateEditArr				=	array();
			$TemplateEditArr['where'] 	= 	array('templateid',$PowerBB->_GET['templateid']);

			$TemplateEdit = $PowerBB->core->GetInfo($TemplateEditArr,'template');

			$templates_dir = ("../cache_templates/".$TemplateEdit['title']."_".$TemplateEdit['styleid'].".php");

			if (file_exists($templates_dir))
			{
		 	$cache_del = unlink($templates_dir);
			}

			$DelArr 			= 	array();
			$DelArr['where'] 	= 	array('templateid',$PowerBB->_GET['templateid']);

			$del = $PowerBB->core->Deleted($DelArr,'template');

		if ($del)
		{

			$PowerBB->functions->msg($PowerBB->_CONF['template']['_CONF']['lang']['Template_has_been_deleted_successfully']);
			$PowerBB->functions->redirect('index.php?page=template&amp;control=1&amp;show=1&amp;id=' . $PowerBB->_GET['styleid']);
		}
	}

	function _DelAllcache()
	{
      		global $PowerBB;

		$StyleArr 					= 	array();
		$StyleArr['order'] 			=	array();
		$StyleArr['order']['field']	= 	'style_order';
		$StyleArr['order']['type']	=	'ASC';
		$StyleArr['proc'] 			= 	array();
		$StyleArr['proc']['*'] 		= 	array('method'=>'clean','param'=>'html');

		$PowerBB->_CONF['template']['while']['StyleList'] = $PowerBB->core->GetList($StyleArr,'style');

		$PowerBB->template->display('cache_main');


	}

	function _DelStartAllcache()
	{
		global $PowerBB;

		$PowerBB->_GET['id'] = $PowerBB->functions->CleanVariable($PowerBB->_GET['id'],'intval');

		if (empty($PowerBB->_GET['id']))
		{
			$PowerBB->functions->error($PowerBB->_CONF['template']['_CONF']['lang']['path_not_true']);
		}

		$StyleArr 				= 	array();
		$StyleArr['where'] 		= 	array('id',$PowerBB->_GET['id']);

		$StyleInfo = $PowerBB->core->GetInfo($StyleArr,'style');

		if (!$StyleInfo)
		{
			$PowerBB->functions->error($PowerBB->_CONF['template']['_CONF']['lang']['Style_requested_does_not_exist']);
		}

		$PowerBB->functions->CleanVariable($StyleInfo,'html');

		$TemplatesList = array();

		if (is_dir($StyleInfo['cache_path']))
		{
			$dir = opendir($StyleInfo['cache_path']);

			if ($dir)
			{
				while (($file = readdir($dir)) !== false)
				{
					if ($file == '.'
						or $file == '..')
					{
						continue;
					}

					$del = unlink('./' . $StyleInfo['cache_path'] . '/' . $file);

                     if ($del)
                     {
                         $PowerBB->functions->msg($PowerBB->_CONF['template']['_CONF']['lang']['Deleted'].' ' . $file . ' '.$PowerBB->_CONF['template']['_CONF']['lang']['Successfully']);
                     }
                     else
                     {
                         $PowerBB->functions->msg($PowerBB->_CONF['template']['_CONF']['lang']['NotDeleted'].' ' . $file);
                     }
				}

				closedir($dir);
			}
		}


	}

	function _DelAllcacheAdmin()
	{
		global $PowerBB;


		$TemplatesList = '../look/styles/admin/main/compiler/';

		if (is_dir($TemplatesList))
		{
			$dir = opendir($TemplatesList);

			if ($dir)
			{
				while (($file = readdir($dir)) !== false)
				{
					if ($file == '.'
						or $file == '..')
					{
						continue;
					}

					$del = unlink('./' . $TemplatesList . $file);

                     if ($del)
                     {
                        $PowerBB->functions->msg($PowerBB->_CONF['template']['_CONF']['lang']['Deleted'].' ' . $file . ' '.$PowerBB->_CONF['template']['_CONF']['lang']['Successfully']);
                     }
                     else
                     {
                         $PowerBB->functions->msg($PowerBB->_CONF['template']['_CONF']['lang']['NotDeleted'].' ' . $file);
                     }
				}

				closedir($dir);
			}
		}


	}

	function _SearchMain()
	{
		global $PowerBB;

		$StyArr 					= 	array();
		$StyArr['order'] 			=	array();
		$StyArr['order']['field'] 	= 	'id';
		$StyArr['order']['type']	=	'DESC';
		$StyArr['proc'] 			= 	array();
		$StyArr['proc']['*'] 		= 	array('method'=>'clean','param'=>'html');

		$PowerBB->_CONF['template']['while']['StyleList'] = $PowerBB->core->GetList($StyArr,'style');

		$PowerBB->template->display('template_search');
	}

	function _SearchStart()
	{
		global $PowerBB;

		if (empty($PowerBB->_POST['text']))
		{
			$PowerBB->functions->error($PowerBB->_CONF['template']['_CONF']['lang']['no_enter_text']);
		}

		if ($PowerBB->_POST['style'] == 'all')
		{
            $PowerBB->_POST['text'] = str_replace("'", "&#39;", $PowerBB->_POST['text']);
             $text = $PowerBB->_POST['text'];
			$TemplateArr 							= 	array();
			$TemplateArr['where'] 					= 	array();
			$TemplateArr['where'][0] 				= 	array();
          if ($PowerBB->_POST['titlesonly'] == '1')
          {
			$TemplateArr['where'][0]['name'] 		= 	'title';
			$TemplateArr['where'][0]['oper'] 		= 	'LIKE';
			$TemplateArr['where'][0]['value']		= 	'%' .$text .'%';
           }
           else
          {
			$TemplateArr['where'][0]['name'] 		= 	'template';
			$TemplateArr['where'][0]['oper'] 		= 	'LIKE';
			$TemplateArr['where'][0]['value']		= 	'%' .$text .'%';
		   }
			$TemplateArr['order'] 					= 	array();
			$TemplateArr['order']['field'] 		= 	'styleid';
			$TemplateArr['order']['type'] 			= 	'DESC';

			$PowerBB->_CONF['template']['while']['TemplateList'] = $PowerBB->core->GetList($TemplateArr,'template');

			if (is_array($PowerBB->_CONF['template']['while']['TemplateList'])
				and sizeof($PowerBB->_CONF['template']['while']['TemplateList']) > 0)
			{
				$PowerBB->template->assign('found',false);
			}
			else
			{
				$PowerBB->template->assign('found',true);
			}

		}
        else
        {
			$StyleArr 				= 	array();
			$StyleArr['where'] 		= 	array('id',$PowerBB->_POST['style']);

			$StyleInfo = $PowerBB->core->GetInfo($StyleArr,'style');
            $PowerBB->template->assign('Style',$StyleInfo);

			if (!$StyleInfo)
			{
				$PowerBB->functions->error($PowerBB->_CONF['template']['_CONF']['lang']['Style_requested_does_not_exist']);
			}

			 $PowerBB->functions->CleanVariable($StyleInfo,'html');
             $style = $PowerBB->_POST['style'];
            $PowerBB->_POST['text'] = str_replace("'", "&#39;", $PowerBB->_POST['text']);
             $text = $PowerBB->_POST['text'];

			$TemplateArr 							= 	array();

			$TemplateArr['where'] 					= 	array();
			$TemplateArr['where'][0] 				= 	array();
			$TemplateArr['where'][0]['name'] 		= 	'styleid';
			$TemplateArr['where'][0]['oper'] 		= 	'=';
			$TemplateArr['where'][0]['value']		= 	$style;

		    $TemplateArr['where'][1] 			= 	array();
		    $TemplateArr['where'][1]['con']		=	'AND';
          if ($PowerBB->_POST['titlesonly'] == '1')
          {
			$TemplateArr['where'][1]['name'] 		= 	'title';
			$TemplateArr['where'][1]['oper'] 		= 	'LIKE';
			$TemplateArr['where'][1]['value']		= 	'%' .$text .'%';
           }
           else
          {
			$TemplateArr['where'][1]['name'] 		= 	'template';
			$TemplateArr['where'][1]['oper'] 		= 	'LIKE';
			$TemplateArr['where'][1]['value']		= 	'%' .$text .'%';
		   }

			$TemplateArr['order'] 					= 	array();
			$TemplateArr['order']['field'] 		= 	'templateid';
			$TemplateArr['order']['type'] 			= 	'ASC';

			$PowerBB->_CONF['template']['while']['TemplateList'] = $PowerBB->core->GetList($TemplateArr,'template');
			if (is_array($PowerBB->_CONF['template']['while']['TemplateList'])
				and sizeof($PowerBB->_CONF['template']['while']['TemplateList']) > 0)
			{
				$PowerBB->template->assign('found',false);
			}
			else
			{
				$PowerBB->template->assign('found',true);
			}

         }

        $PowerBB->template->display('templates_search_templates_list');

	}

    function GetDirContents($dir){
       if (!is_dir($dir)){die ("Function GetDirContents: Problem reading : $dir!");}
       if ($root=@opendir($dir)){
           while ($file=readdir($root)){
               if($file=="." || $file==".."){continue;}
               if(is_dir($dir."/".$file)){
                   $files=array_merge($files,$this->GetDirContents($dir."/".$file));
               }else{
               $files[]=$dir."/".$file;
               }
           }
       }
       return $files;
    }

	function _CommonTemplatesStart()
	{
		global $PowerBB;

   	  if (empty($PowerBB->_GET['styleid']))
    	{
    		$PowerBB->functions->error($PowerBB->_CONF['template']['_CONF']['lang']['path_not_true']);
    	}
   	   if (empty($PowerBB->_GET['templateid']))
    	{
    		$PowerBB->functions->error($PowerBB->_CONF['template']['_CONF']['lang']['path_not_true']);
    	}
        $PowerBB->_POST['context'] = str_replace("'", "&#39;", $PowerBB->_POST['context']);

		$TemplateArr 			= 	array();
		$TemplateArr['field']	=	array();

		$TemplateArr['field']['template'] 		= 	$PowerBB->_POST['context'];
		$TemplateArr['field']['dateline'] 		    = $PowerBB->_CONF['now'];
		$TemplateArr['where'] 				= 	array('templateid',$PowerBB->_GET['templateid']);

		$update = $PowerBB->core->Update($TemplateArr,'template');


    	if ($update)
    	{
			$TemplateEditArr				=	array();
			$TemplateEditArr['where'] 	= 	array('templateid',$PowerBB->_GET['templateid']);

			$TemplateEdit = $PowerBB->core->GetInfo($TemplateEditArr,'template');

            $templates_dir = ("../cache_templates/".$TemplateEdit['title']."_".$TemplateEdit['styleid'].".php");
	    	$fp = fopen($templates_dir,'w+');
	    	$fw = fwrite($fp,$TemplateEdit['template']);
    		 fclose($fp);
			$PowerBB->functions->msg($PowerBB->_CONF['template']['_CONF']['lang']['Template_has_been_updated_successfully']);
			$PowerBB->functions->redirect('index.php?page=template&control=1&show=1&id=' .$TemplateEdit['styleid']);
    	}
	}

	function _Get_singles_original_default()
    {
    	global $PowerBB;

   	  if (empty($PowerBB->_GET['styleid']))
    	{
    		$PowerBB->functions->error($PowerBB->_CONF['template']['_CONF']['lang']['path_not_true']);
    	}
        $styleid = $PowerBB->_GET['styleid'];
		$StyleArr 			= 	array();
		$StyleArr['where'] 	= 	array('id',$styleid);

		$StyleInfo = $PowerBB->core->GetInfo($StyleArr,'style');

		$TemplateArr 						= 	array();
		$TemplateArr['get_from']				=	'db';

		$TemplateArr['proc'] 				= 	array();
		$TemplateArr['proc']['*'] 			= 	array('method'=>'clean','param'=>'html');

		$TemplateArr['order']				=	array();
		$TemplateArr['order']['field']		=	'templateid';
		$TemplateArr['order']['type']		=	'ASC';

		$TemplateArr['where']				=	array();
		$TemplateArr['where'][0]['name']		= 	'styleid';
		$TemplateArr['where'][0]['oper']		= 	'=';
		$TemplateArr['where'][0]['value']	= 	$styleid;

		// Get Templatets
		$querytemplate = $PowerBB->core->GetList($TemplateArr,'template');

       $st = strtolower($style_title);
        $st = str_replace(" ", "_", $st);
	    $filename = "singles_templates_original_".$st.".xml";
     foreach ($querytemplate as $getTemplate_row)
      {

        $title = $getTemplate_row['title'];
        $context = $getTemplate_row['template'];
        $context = str_replace("&#39;", "'", $context);
        $xml .= "<$title><![CDATA[$context]]></$title>\r\n";
      }

		$xmlup = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\r\n<templategroup>\r\n";
		$xmldun = "</templategroup>\r\n";
		header("Content-Disposition: attachment; filename=\"" . basename($filename) . "\"");
		header("Content-type: application/octet-stream");
		header("Content-Length: ".strlen($xmlup.$xml.$xmldun));
		header("Pragma: no-cache");
		header("Expires: 0");
		echo $xmlup.$xml.$xmldun;
		exit;
	}
}

class _functions
{
	function check_by_id(&$StyleInfo)
	{
		global $PowerBB;

		if (empty($PowerBB->_GET['id']))
		{
			$PowerBB->functions->error($PowerBB->_CONF['template']['_CONF']['lang']['The_request_is_not_valid']);
		}

		$PowerBB->_GET['id'] = $PowerBB->functions->CleanVariable($PowerBB->_GET['id'],'intval');

		$StyleArr 			= 	array();
		$StyleArr['where'] 	= 	array('id',$PowerBB->_GET['id']);

		$StyleInfo = $PowerBB->core->GetInfo($StyleArr,'style');

		if ($StyleInfo == false)
		{
			$PowerBB->functions->error($PowerBB->_CONF['template']['_CONF']['lang']['Style_requested_does_not_exist']);
		}

		$PowerBB->functions->CleanVariable($StyleInfo,'html');
	}
}



?>
