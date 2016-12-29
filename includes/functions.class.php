<?php
class PowerBBFunctions
{
	/**
	 * Get sections list from cache and show it.
	 */
	function _GetSections()
	{
		global $PowerBB;
		$SecArr 						= 	array();
		$SecArr['get_from']				=	'db';
		$SecArr['proc'] 				= 	array();
		$SecArr['proc']['*'] 			= 	array('method'=>'clean','param'=>'html');
		$SecArr['order']				=	array();
		$SecArr['order']['field']		=	'sort';
		$SecArr['order']['type']		=	'ASC';
		$SecArr['where']				=	array();
		$SecArr['where'][0]['name']		= 	'parent';
		$SecArr['where'][0]['oper']		= 	'=';
		$SecArr['where'][0]['value']	= 	'0';
		// Get main sections
		$cats = $PowerBB->core->GetList($SecArr,'section');
 		////////////
		// Loop to read the information of main sections
		foreach ($cats as $cat)
		{
		   if ($PowerBB->functions->section_group_permission($cat['id'],$PowerBB->_CONF['group_info']['id'],'view_section'))
	      	{
             // foreach main sections
			$PowerBB->_CONF['template']['foreach']['forums_list'][$cat['id'] . '_m'] = $cat;
			@include("cache/forums_cache_".$cat['id'].".php");
			if (!empty($forums_cache))
			{
                $forums = unserialize(base64_decode($forums_cache));
					foreach ($forums as $forum)
					{
						if ($PowerBB->_CONF['group_info']['vice']
						or $PowerBB->_CONF['member_row']['usergroup'] == '1')
						{
			               if ($forum['subjects_review_num']>0)
							{
							$forum['num_subjects_awaiting_approval'] =	$PowerBB->functions->with_comma($forum['subjects_review_num']);
							}
                           if ($forum['replys_review_num']>0)
							{
							$forum['num_replys_awaiting_approval'] =	$PowerBB->functions->with_comma($forum['replys_review_num']);
							}
						}
						//////////////////////////
						if ($PowerBB->functions->section_group_permission($forum['id'],$PowerBB->_CONF['group_info']['id'],'view_section'))
						{
                         if ($PowerBB->functions->section_group_permission($forum['id'],$PowerBB->_CONF['group_info']['id'],'view_subject') == 0)
						 {
						   $forum['hide_subject']	= '1';
                         }
                           if (!empty($forum['last_date']))
                           {
							$forum_last_time1 = $forum['last_date'];
							$forum['last_subject'] = $PowerBB->Powerparse->censor_words($forum['last_subject']);
							$forum['last_subject_title'] =  $forum['last_subject'];
							$forum['last_subject'] =  $PowerBB->Powerparse->_wordwrap($forum['last_subject'],'35');
							$forum['last_post_date'] = $forum['last_time'];
							$forum['l_date'] = $forum_last_time1;
							$forum['last_date'] = $PowerBB->sys_functions->time_ago($forum_last_time1);
							$forum['last_time_ago'] = $PowerBB->sys_functions->time_ago($forum_last_time1);
							$forum['last_date_ago'] = $PowerBB->sys_functions->time($forum_last_time1);
							$forum['last_subjectid'] = $forum['last_subjectid'];
							$forum['last_time'] = $forum['last_time'];
							$forum['last_reply'] = $forum['last_reply'];
							$forum['icon'] = $forum['icon'];
							$forum['review_subject'] = $forum['review_subject'];
							$forum['last_berpage_nm'] = $forum['last_berpage_nm'];
							$forum['last_writer']= $forum['last_writer'];
							$forum['username_style_cache'] = $forum['username_style_cache'];
							$forum['writer_photo']= $forum['writer_photo'];
							$forum['avater_path']= $forum['avater_path'];
							$forum['last_subject'] =  $forum['prefix_subject']." ".$PowerBB->functions->pbb_stripslashes($forum['last_subject']);
                            $forum['sec_section']= $forum['sec_section'];
                            $forum['last_writer_id']= $forum['last_writer_id'];
                           }


                            $kay =$cat['id'];
							$forum['collapse']= $PowerBB->_COOKIE["pbboard_collapse_forumid_$kay"];
									$forum['is_sub'] 	= 	0;
									$forum['sub']		=	'';
									$t_sub=0;
			                        @include("cache/forums_cache_".$forum['id'].".php");
                                   if (!empty($forums_cache))
		                           {
										$subs = unserialize(base64_decode($forums_cache));
		                               foreach($subs as $sub)
										{
										   if ($forum['id'] == $sub['parent'])
		                                    {
										        if (!empty($sub['last_date']))
										         {
										           if ($forum['last_time']< $sub['last_time'])
										           {
	                                             	$forum_last_time1 = $sub['last_date'];
													$forum['last_subject'] = $PowerBB->Powerparse->censor_words($sub['last_subject']);
                                                   	$forum['last_subject_title'] =  $forum['last_subject'];
													$forum['last_subject'] =  $PowerBB->Powerparse->_wordwrap($sub['last_subject'],'35');
													$forum['last_post_date'] = $sub['last_time'];
				                                     $forum['l_date'] = $forum_last_time1;
													 $forum['last_date'] = $PowerBB->sys_functions->time_ago($forum_last_time1);
													 $forum['last_time_ago'] = $PowerBB->sys_functions->time_ago($forum_last_time1);
													 $forum['last_date_ago'] = $PowerBB->sys_functions->time($forum_last_time1);
													$forum['last_subjectid'] = $sub['last_subjectid'];
													$forum['last_time'] = $sub['last_time'];
													$forum['last_reply'] = $sub['last_reply'];
													$forum['icon'] = $sub['icon'];
													$forum['review_subject'] = $sub['review_subject'];
													$forum['last_berpage_nm'] = $sub['last_berpage_nm'];
													$forum['last_writer']= $sub['last_writer'];
                       							    $forum['username_style_cache'] = $sub['username_style_cache'];
                       							    $forum['writer_photo']= $sub['writer_photo'];
                       							    $forum['avater_path']= $sub['avater_path'];
								                    $forum['last_subject'] =  $sub['prefix_subject']." ".$PowerBB->functions->pbb_stripslashes($sub['last_subject']);
								                    $forum['sec_section']= $sub['sec_section'];
								                    $forum['last_writer_id']= $sub['last_writer_id'];
								                  }
                                               }

												  if ($PowerBB->functions->section_group_permission($sub['id'],$PowerBB->_CONF['group_info']['id'],'view_section'))
												   {
												        if ($sub['forum_title_color'] !='')
												         {
														    $forum_title_color = $sub['forum_title_color'];
														    $sub['title'] = "<span style=color:".$forum_title_color.">".$PowerBB->functions->pbb_stripslashes($sub['title'])."</span>";
														 }
														if ($sub['id'])
														{
														$forum['is_sub'] = 1;
														}
														if($t_sub== $PowerBB->_CONF['info_row']['sub_columns_number']){
														$t_sub=0;
														$forum['sub'] .='</ol><br /><ol class="home-sub-forums-columns-2">';
														}
														$forum_url = "index.php?page=forum&amp;show=1&amp;id=";
														$forum['sub'] .= '<li class="home-sub-forums">';
														$forum['sub'] .= ' <a class="sub-forums-title" style="padding-right:11px;" href="'.$PowerBB->functions->rewriterule($forum_url).$sub['id'].'"> '.$sub['title'].'</a>';
														$forum['sub'] .= "</li>";
														$t_sub=$t_sub+1;
											        }
                                                   // subs forum ++
							                        @include("cache/forums_cache_".$sub['id'].".php");
				                                   if (!empty($forums_cache))
						                           {
														$subsforum = unserialize(base64_decode($forums_cache));
						                               foreach($subsforum as $subforum)
														{
														    if ($sub['id'] == $subforum['parent'])
														    {
														        if (!empty($subforum['last_date']))
														         {
															           if ($subforum['last_time'] > $sub['last_time'] and $subforum['last_time'] > $forum['last_time'])
															           {
						                                             	$forum_last_time1 = $subforum['last_date'];
																		$forum['last_subject'] = $PowerBB->Powerparse->censor_words($subforum['last_subject']);
																		$forum['last_subject_title'] =  $forum['last_subject'];
																		$forum['last_subject'] =  $PowerBB->Powerparse->_wordwrap($subforum['last_subject'],'35');
																		$forum['last_post_date'] = $subforum['last_time'];
									                                    $forum['l_date'] = $forum_last_time1;
																		$forum['last_date'] = $PowerBB->sys_functions->time_ago($forum_last_time1);
																		$forum['last_time_ago'] = $PowerBB->sys_functions->time_ago($forum_last_time1);
																		$forum['last_date_ago'] = $PowerBB->sys_functions->time($forum_last_time1);
																		$forum['last_subjectid'] = $subforum['last_subjectid'];
																		$forum['last_time'] = $subforum['last_time'];
																		$forum['last_reply'] = $subforum['last_reply'];
																		$forum['icon'] = $subforum['icon'];
																		$forum['review_subject'] = $subforum['review_subject'];
																		$forum['last_berpage_nm'] = $subforum['last_berpage_nm'];
																		$forum['last_writer']= $subforum['last_writer'];
                                       							        $forum['username_style_cache'] = $subforum['username_style_cache'];
                                       							        $forum['writer_photo']= $subforum['writer_photo'];
                                       							        $forum['avater_path']= $subforum['avater_path'];
													                    $forum['last_subject'] =  $subforum['prefix_subject']." ".$PowerBB->functions->pbb_stripslashes($subforum['last_subject']);
													                    $forum['sec_section']= $subforum['sec_section'];
													                    $forum['last_writer_id']= $subforum['last_writer_id'];
	                                                                   }
				                                                 }


                                                            }

                                                              // subs forum +++
									                        @include("cache/forums_cache_".$subforum['id'].".php");
						                                   if (!empty($forums_cache))
								                           {
																$subs4forum = unserialize(base64_decode($forums_cache));
								                               foreach($subs4forum  as $sub4forum)
																{
																    if ($subforum['id'] == $sub4forum['parent'])
																    {
																        if (!empty($sub4forum['last_date']))
																         {
																	           if ($sub4forum['last_time'] > $sub['last_time'] and $sub4forum['last_time'] > $subforum['last_time'] and $sub4forum['last_time'] > $forum['last_time'])
																	           {
								                                             	$forum_last_time1 = $sub4forum['last_date'];
																				$forum['last_subject'] = $PowerBB->Powerparse->censor_words($sub4forum['last_subject']);
																				$forum['last_subject_title'] =  $forum['last_subject'];
																				$forum['last_subject'] =  $PowerBB->Powerparse->_wordwrap($sub4forum['last_subject'],'35');
																				$forum['last_post_date'] = $sub4forum['last_time'];
											                                    $forum['l_date'] = $forum_last_time1;
																				$forum['last_date'] = $PowerBB->sys_functions->time_ago($forum_last_time1);
																				$forum['last_time_ago'] = $PowerBB->sys_functions->time_ago($forum_last_time1);
																				$forum['last_date_ago'] = $PowerBB->sys_functions->time($forum_last_time1);
																				$forum['last_subjectid'] = $sub4forum['last_subjectid'];
																				$forum['last_time'] = $sub4forum['last_time'];
																				$forum['last_reply'] = $sub4forum['last_reply'];
																				$forum['icon'] = $sub4forum['icon'];
																				$forum['review_subject'] = $sub4forum['review_subject'];
																				$forum['last_berpage_nm'] = $sub4forum['last_berpage_nm'];
																				$forum['last_writer']= $sub4forum['last_writer'];
		                                       							        $forum['username_style_cache'] = $sub4forum['username_style_cache'];
		                                       							        $forum['writer_photo']= $sub4forum['writer_photo'];
		                                       							        $forum['avater_path']= $sub4forum['avater_path'];
															                    $forum['last_subject'] =  $sub4forum['prefix_subject']." ".$PowerBB->functions->pbb_stripslashes($sub4forum['last_subject']);
															                    $forum['sec_section']= $sub4forum['sec_section'];
															                    $forum['last_writer_id']= $sub4forum['last_writer_id'];
			                                                                   }
						                                                 }



		                                                            }

                                                                    $forum['subject_num']+= $sub4forum['subject_num'];
									                                $forum['reply_num']+= $sub4forum['reply_num'];
																}
						                                   }

							                                        $forum['subject_num'] += $subforum['subject_num'];
							                                        $forum['reply_num'] += $subforum['reply_num'];


														}
				                                   }
                                                   //

                                               }

                                               		 $forum['subject_num'] += $sub['subject_num'];
			                                        $forum['reply_num'] += $sub['reply_num'];
										 }
		                                    if ($PowerBB->_CONF['info_row']['no_sub'] == 0)
		                                     {
		                                       $forum['sub'] ='0';
		                                     }
								   }
                            /*
							if($sub['reply_num'] > 0)
							{
							$sub['reply_num']   = $sub['reply_num']-1;
							}
							if($forum['subject_num'] > 0)
							{
							$forum['subject_num']   = $forum['subject_num']-1;
							}
							*/
						   //////////
							// get writer username style cache And  writer photo
							$username = $forum['last_writer'];
	                         $forum['username'] = $forum['last_writer'];
	                         if ($PowerBB->_CONF['info_row']['allow_avatar'])
							 {
	                           $forum['avater_path'] = $forum['avater_path'];
	                         }

                             $user_id =  $forum['last_writer_id'];
	                        if ($forum['last_writer'] == $PowerBB->_CONF['template']['_CONF']['lang']['Guestp']
	                         or $forum['last_writer'] == 'Guest')
							{
							   if ($PowerBB->_CONF['info_row']['allow_avatar'])
							    {
								 $forum['writer_photo'] = $this->GetForumAdress().$PowerBB->_CONF['template']['image_path'].'/'.$PowerBB->_CONF['info_row']['default_avatar'];
								}
								 $forum['username'] = $PowerBB->_CONF['template']['_CONF']['lang']['Guest_'];
								 $forum['last_writer'] = $PowerBB->_CONF['template']['_CONF']['lang']['Guest_'];
							}
							else
							{
							   if ($PowerBB->_CONF['info_row']['allow_avatar'])
							    {
	                               if (empty($forum['avater_path']))
	                               {
									$forum['writer_photo'] = $this->GetForumAdress().$PowerBB->_CONF['template']['image_path'].'/'.$PowerBB->_CONF['info_row']['default_avatar'];
								   }
								   else
	                               {
								     $forum['writer_photo'] = $forum['avater_path'];
								   }
                                }
						    if ($PowerBB->_CONF['info_row']['get_group_username_style'])
						      {
	                               if (empty($forum['last_writer_id']))
	                               {
									$username_style_cache = '<a href="index.php?page=profile&amp;show=1&amp;username=' . $username . '">' . $forum['username_style_cache'] . '</a> ';
								   }
								   else
	                               {
									$username_style_cache = '<a href="index.php?page=profile&amp;show=1&amp;id=' . $forum['last_writer_id'] . '">' . $forum['username_style_cache'] . '</a> ';
								   }
      	                        $forum['last_writer'] = $PowerBB->functions->rewriterule($username_style_cache);
						      }
						      else
						      {
	                               if (empty($forum['last_writer_id']))
	                               {
									$username_style = '<a href="index.php?page=profile&amp;show=1&amp;username=' . $username . '">' . $forum['last_writer'] . '</a> ';
								   }
								   else
	                               {
									$username_style = '<a href="index.php?page=profile&amp;show=1&amp;id=' . $forum['last_writer_id'] . '">' . $forum['last_writer'] . '</a> ';
								   }
      	                        $forum['last_writer'] = $PowerBB->functions->rewriterule($username_style);
						      }
							}


								if (@!strstr($forum['writer_photo'],'http')
									or @!strstr($forum['writer_photo'],'www.'))
								{
									if (@strstr($forum['writer_photo'],'download/avatar/')
									or @strstr($forum['writer_photo'],'look/images/avatar/'))
									{
									 $forum['writer_photo'] = $this->GetForumAdress().$forum['writer_photo'];
									}
								}

                            if ($this->GetServerProtocol() == 'https://')
							 {
                              $https_  = "https://".$PowerBB->_SERVER['HTTP_HOST'];
                              $httpswww_  = "https://www.".$PowerBB->_SERVER['HTTP_HOST'];
                              $http_  = "http://".$PowerBB->_SERVER['HTTP_HOST'];
                              $http_www_  = "http://www.".$PowerBB->_SERVER['HTTP_HOST'];

	       					  $forum['writer_photo'] = str_replace($http_, $https_, $forum['writer_photo']);
							  $forum['writer_photo'] = @str_ireplace($http_, $https_, $forum['writer_photo']);
	       					  $forum['writer_photo'] = str_replace($http_www_, $httpswww_, $forum['writer_photo']);
							  $forum['writer_photo'] = @str_ireplace($http_www_, $httpswww_, $forum['writer_photo']);
                             }

                             $forum['writer_photo'] = str_replace($this->GetForumAdress().$this->GetForumAdress(), $this->GetForumAdress(), $forum['writer_photo']);
	                          //
						  // Get the moderators list as a _link_ and store it in $forum['moderators_list']
		                   if ($PowerBB->_CONF['info_row']['no_moderators'])
						   {
								$forum['is_moderators'] 		= 	0;
								$forum['moderators_list']		=	'';
								if (!empty($forum['moderators']))
								{
									$moderators = unserialize($forum['moderators']);
									if (is_array($moderators))
									{
		                               foreach($moderators as $moderator)
										{
											if (!$forum['is_moderators'])
											{
												$forum['is_moderators'] = 1;
											}
											if ($moderator['username'] == $PowerBB->_CONF['member_row']['username']
											or $PowerBB->_CONF['group_info']['vice']
											or $PowerBB->_CONF['member_row']['usergroup'] == '1')
											{
								               if ($forum['subjects_review_num']>0)
												{
												$forum['num_subjects_awaiting_approval'] =	$PowerBB->functions->with_comma($forum['subjects_review_num']);
												}
					                           if ($forum['replys_review_num']>0)
												{
													$forum['num_replys_awaiting_approval'] =	$PowerBB->functions->with_comma($forum['replys_review_num']);
												}
											}
							               if ($PowerBB->_CONF['info_row']['rewriterule'] == '1')
											{
											$forum['moderators_list'] .= '<a href="u' . $moderator['member_id'] . '.html">' . $PowerBB->functions->GetUsernameStyle($moderator['username']) . '</a> , ';
											}
											else
											{
								            $forum['moderators_list'] .= '<a href="index.php?page=profile&amp;show=1&amp;id=' . $moderator['member_id'] . '">' . $PowerBB->functions->GetUsernameStyle($moderator['username']) .'</a> , ';
											}
										}
									}
								}
		                    }
							//////////
							// Get online forums
							if ($PowerBB->_CONF['info_row']['active_forum_online_number'])
							{
							  $Forum_online_number = $PowerBB->DB->sql_num_rows($PowerBB->DB->sql_query("SELECT id FROM " . $PowerBB->table['online'] . " WHERE section_id='" . $forum['id'] . "'"));
							  if ($forum['is_sub'])
							  {
							  $Forum_online_number_sub = $PowerBB->DB->sql_num_rows($PowerBB->DB->sql_query("SELECT id FROM " . $PowerBB->table['online'] . " WHERE subject_show ='" . $forum['id'] . "' "));
							  $forum['forum_online'] = $Forum_online_number+$Forum_online_number_sub;
							  }
							  else
							  {
							   $forum['forum_online'] = $Forum_online_number;
							  }
							}
							if ($forum['forum_title_color'] !='')
					         {
							    $forum_title_color = $forum['forum_title_color'];
							    $forum['title'] = "<span style=color:".$forum_title_color.">".$forum['title']."</span>";
							 }
                            if ($forum['linksection'])
							{
							  $forum['forum_icon'] = "f_redirect";
							  $forum['forum_icon_alt'] = $PowerBB->_CONF['template']['_CONF']['lang']['Guidance_re'];
							}
							else
							{
								if ($PowerBB->_CONF['group_info']['write_subject'] == 0)
								{
								  $forum['forum_icon'] = "f_pass_unread";
								  $forum['forum_icon_alt'] = $PowerBB->_CONF['template']['_CONF']['lang']['no_write_subject'];
								}
								elseif ($forum['last_post_date'] > $PowerBB->_CONF['member_row']['lastvisit'])
								{
								  $forum['forum_icon'] = "f_unread";
								  $forum['forum_icon_alt'] = $PowerBB->_CONF['template']['_CONF']['lang']['new_posts'];
								}
								else
								{
								  $forum['forum_icon'] = "f_read";
								  $forum['forum_icon_alt'] = $PowerBB->_CONF['template']['_CONF']['lang']['no_new_posts'];
								}
                             }
                             if($PowerBB->functions->ModeratorCheck($forum['moderators']))
                             {
                              $forum['ModeratorCheck'] = 0;
                              $forum['IsModeratorCheck'] = 1;
                             }
                             else
                             {
                              $forum['ModeratorCheck'] = 1;
                              $forum['IsModeratorCheck'] = 0;
                             }
							$PowerBB->_CONF['template']['foreach']['forums_list'][$forum['id'] . '_f'] = $forum;
							unset($groups);
						}// end view forums
		             } // end foreach ($forums)
			  } // end !empty($forums_cache)
			  else
			  {
			   $PowerBB->functions->_AllCacheStart();
			  }
		   } // end view section
				unset($SecArr);
				$SecArr = $PowerBB->DB->sql_free_result($SecArr);
		} // end foreach ($cats)
		//////////
	}
	/**
	 * Check if delicious cookie is here or another eat it mmmm :)
	 */
	function IsCookie($cookie_name)
 	{
 		global $PowerBB;
		// I hate SQL injections
		$PowerBB->_COOKIE[$cookie_name] = $PowerBB->functions->CleanVariable($PowerBB->_COOKIE[$cookie_name],'sql');
		// I hate XSS
		$PowerBB->_COOKIE[$cookie_name] = $PowerBB->functions->CleanVariable($PowerBB->_COOKIE[$cookie_name],'html');
 		return empty($PowerBB->_COOKIE[$cookie_name]) ? false : true;
 	}
 	/**
 	 * Clean the variable from any dirty :) , we should be thankful for abuamal
 	 *
 	 * By : abuamal
 	 */
	function CleanVariable($variable, $type)
	{
		global $PowerBB;
		return $PowerBB->sys_functions->CleanVariable($variable, $type);
	}
 	function AddressBar($title)
 	{
 		global $PowerBB;
 		$PowerBB->template->display('address_bar_part1');
 		echo $title;
 		$PowerBB->template->display('address_bar_part2');
 	}
 	/**
 	 * Show footer and stop the script , footer is like water in the life :)
 	 */
 	function stop($no_style = false)
 	{
 		global $PowerBB;
 		if (!$no_style)
 		{
 			$PowerBB->template->display('footer');
 		}
 		exit();
 	}
 	/**
 	 * go to $site , abuamal hate this function :D don't ask me why , ask him ;)
 	 */
	function redirect($site,$m=0)
 	{
     global $PowerBB;
  		echo "<META HTTP-EQUIV=\"refresh\" CONTENT=\"$m; URL=$site\">\n";
		//$transition_click = $PowerBB->_CONF['template']['_CONF']['lang']['If_your_browser_does_not_support_automatic_transition_click_here'];
        //$transition = ('<div class="Button_redirect"><a class="Button_secondary" href="'.$PowerBB->functions->rewriterule($site).'">'.$PowerBB->functions->rewriterule($transition_click).'</a></div>');
        //echo $transition;
 	}
	function redirect2($site,$m=0)
 	{
     global $PowerBB;
  		echo "<META HTTP-EQUIV=\"refresh\" CONTENT=\"$m; URL=$site\">\n";
      //$transition = ('<a href="'.$PowerBB->functions->rewriterule($site).'">'.$PowerBB->functions->rewriterule($transition_click).'</a>');
 	}
	/**
	* Halts execution and redirects to the specified URL invisibly
	*
	* @param	string	Destination URL
	*/
	function header_redirect($url, $redirectcode = 303)
 	{
	     global $PowerBB;
		$url = str_replace('&amp;', '&', $url); // prevent possible oddity
		if (@strpos($url, "\r\n") !== false)
		{
			trigger_error("Header may not contain more than a single header, new line detected.", E_USER_ERROR);
		}
		if ($redirectcode == 303 AND $PowerBB->_SERVER['SERVER_PROTOCOL'] == 'HTTP/1.0')
		{
			$redirectcode = 302;
		}
        $url = $PowerBB->functions->rewriterule($url);
		 @header("Location: $url", 0, $redirectcode);
	  	 exit;
 	}
	/**
	 * Show $msg in nice template
	 */
 	function msg($msg,$no_style = false)
    {
    	global $PowerBB;
    	if (defined('STOP_STYLE')
    		or $no_style)
 		{
 			 if ($PowerBB->_GET['page'] == 'attachments')
		      {
 		      $PowerBB->template->assign('use_style',1);
 		      }
    		 $PowerBB->template->assign('msg',$msg);
    		$PowerBB->template->display('show_msg');
    	}
    	else
    	{
    		echo '<font face="Tahoma" size="2"><div dir=' . $PowerBB->_CONF['info_row']['content_dir'] . ' align="center">' . $msg . '</div></font>';
    	}
 	}
	function install_msg($code)
	{
		$installation_state = $PowerBB->_CONF['template']['_CONF']['lang']['installation_state'];
	echo '<table border="0" cellspacing="1" width="50%" class="t_style_b" align="center">
		<tr>
			<td class="main1" colspan="2" height="23">
	'.$installation_state.'
			</td>
		</tr>
		<tr>
			<td class="row1" colspan="2" align="center">
			<p>
	';
	eval($code);
	echo '</p>
			</td>
		</tr>
	</table>
	<br />
	<br />';
	}
    function reputation_alert($msg)
    {
       global $PowerBB;
          if (!$no_header and $no_style)
          {
          $this->ShowHeader('');
          }
       echo "<script>alert('".$msg."');</script>";
       $this->stop(TRUE);
    }
 	 function stoperror($no_style = false)
 	{
 		global $PowerBB;
 		if (!$no_style)
 		{
 		}
 		exit();
 	}
 	function msgerror($msg,$no_style = false)
    {
    	global $PowerBB;
    	if (defined('IN_ADMIN')
    		or defined('STOP_STYLE')
    		or $no_style)
 		{
    		echo '<font face="Tahoma" size="2"><div dir=' . $PowerBB->_CONF['info_row']['content_dir'] . ' align="center">' . $msg . '</div></font>';
    	}
 	}
 		/**
	 * Show error massege and stop script
	 */
 	function errorstop($msgerror,$no_header = false,$no_style = false)
    {
    	global $PowerBB;
    	if (!$no_header and $no_style)
    	{
    		$this->ShowHeader('');
    	}
  		$this->msgerror($msgerror,$no_style);
  		$this->stoperror($no_style);
 	}
	/**
	 * Show error massege and stop script
	 */
 	function error($msg,$no_header = false,$no_style = false)
    {
    	global $PowerBB;
    	if (!$no_header and $no_style)
    	{
    		$this->ShowHeader('');
    	}
  		$this->msg($msg,$no_style);
  		$this->stop($no_style);
 	}
	/**
	 * Check if $email is true email or not
	 *
	 * This function by : Pal Coder from PowerBB 1.x
	 */
      function CheckEmail($email)
      {
        // First, we check that there's one @ symbol, and that the lengths are right
        if (!preg_match("/^[^@]{1,64}@[^@]{1,255}$/", $email)) {
            // Email invalid because wrong number of characters in one section, or wrong number of @ symbols.
            return false;
        }
	    if (@strstr($email,'"')
		or @strstr($email,"'")
		or @strstr($email,'>')
		or @strstr($email,'<')
		or @strstr($email,'*')
		or @strstr($email,'%')
		or @strstr($email,'$')
		or @strstr($email,'#')
		or @strstr($email,'+')
		or @strstr($email,'^')
		or @strstr($email,'&')
		or @strstr($email,',')
		or @strstr($email,'~')
		or @strstr($email,'!')
		or @strstr($email,'{')
		or @strstr($email,'}')
		or @strstr($email,'(')
		or @strstr($email,')')
		or @strstr($email,'/'))
      	{
           return false;
        }
        // Split it into sections to make life easier
        $email_array = explode("@", $email);
        $local_array = explode(".", $email_array[0]);
        for ($i = 0; $i < sizeof($local_array); $i++) {
            if (!preg_match("/^(([A-Za-z0-9!#$%&'*+\/=?^_`{|}~-][A-Za-z0-9!#$%&'*+\/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$/", $local_array[$i])) {
                return false;
            }
        }
        if (!preg_match("/^\[?[0-9\.]+\]?$/", $email_array[1])) { // Check if domain is IP. If not, it should be valid domain name
            $domain_array = explode(".", $email_array[1]);
            if (sizeof($domain_array) < 2) {
                return false; // Not enough parts to domain
            }
            for ($i = 0; $i < sizeof($domain_array); $i++) {
                if (!preg_match("/^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$/", $domain_array[$i])) {
                    return false;
                }
            }
        }
        return true;
    }
 	/**
 	 * Get file extention
 	 *
 	 * @param :
 	 *				filename -> the name of file which we want know it's extension
 	 */
	function GetFileExtension($filename)
	{
				global $PowerBB;
              $filename = strtolower($filename);
              if ( stristr($filename,'.php') )
             {
              $PowerBB->functions->error("The file extension isn't allowed!");
			}
			if ( stristr($filename,'.php3') )
             {
              $PowerBB->functions->error("The file extension isn't allowed!");
			}
			if ( stristr($filename,'.phtml') )
             {
              $PowerBB->functions->error("The file extension isn't allowed!");
			}
			if ( stristr($filename,'.html') )
             {
              $PowerBB->functions->error("The file extension isn't allowed!");
			}
			if ( stristr($filename,'.htm') )
             {
              $PowerBB->functions->error("The file extension isn't allowed!");
			}
			if ( stristr($filename,'.pl') )
             {
              $PowerBB->functions->error("The file extension isn't allowed!");
			}
			if ( stristr($filename,'.cgi') )
             {
              $PowerBB->functions->error("The file extension isn't allowed!");
			}
			if ( stristr($filename,'.asp') )
             {
             $PowerBB->functions->error("The file extension isn't allowed!");
			}
			if ( stristr($filename,'.3gp') )
             {
              $PowerBB->functions->error("The file extension isn't allowed!");
			}
			if ( stristr($filename,'.exe') )
             {
              $PowerBB->functions->error("The file extension isn't allowed!");
			}
	   $temparray = explode(".", $filename);
	   $extension = $temparray[count($temparray) - 1];
	   $extension = strtolower($extension);
	   return '.' . $extension;
	}
 	/**
 	 * Show the default footer of forum page
 	 */
 	function GetFooter()
 	{
 		// The instructions stored in footer module
 		// so include footer module to execute these inctructions
         require_once(DIR . 'modules/footer.module.php');
 		// Get the name of class
        $footer_name = FOOTER_NAME;
        // Make a new object
        $footer_name = new $footer_name;
        // Execute inctructions
        $footer_name->run();
 	}
 	/**
 	 * Show the default header of forum page
 	 */
 	function ShowHeader($title = null)
 	{
 		global $PowerBB;
		// visito today number  today_cookie
		if ($PowerBB->_CONF['date'] == $PowerBB->_CONF['info_row']['today_date_cache'])
		{
          $PowerBB->functions->visitor_today_number();
        }
        else
        {
         if ($PowerBB->_CONF['info_row']['mor_hours_online_today'] == '0')
		 {
          $PowerBB->info->UpdateInfo(array('value'=>'1','var_name'=>'today_number_cache'));
		 }
        }
       $PowerBB->_GET['id']	= 	$PowerBB->functions->CleanVariable($PowerBB->_GET['id'],'intval');
 		// Check if title is empty so use the default name of forum
 		// which stored in info_row['title']
 		$title = (isset($title)) ? $title : $PowerBB->_CONF['info_row']['title'];
		$page = empty($PowerBB->_GET['page']) ? 'index' : $PowerBB->_GET['page'];
		$page_address 					= 	array();
		if ($page == 'index')
		{
		$page_address['index'] 		= 	$PowerBB->_CONF['info_row']['title'];
		$PowerBB->template->assign('description',$PowerBB->functions->CleanText($PowerBB->_CONF['info_row']['description']));
		$PowerBB->template->assign('keywords',$PowerBB->_CONF['info_row']['keywords']);
		$PowerBB->template->assign('index',1);
		}
		elseif ($PowerBB->_GET['page'] == 'forum')
		{
        $Forum 			= 	array();
		$Forum['where'] 	= 	array('id',$PowerBB->_GET['id']);
		$Forum_rwo = $PowerBB->core->GetInfo($Forum,'section');
		$page_address['forum'] 		= 	$Forum_rwo['title'];
		if($Forum_rwo['section_describe']!='')
		{
		  $PowerBB->template->assign('description',$PowerBB->functions->CleanText($Forum_rwo['section_describe']));
          $PowerBB->template->assign('keywords',$PowerBB->functions->Getkeywords($Forum_rwo['title']));
		}
		else
		{
		 $PowerBB->template->assign('description',$PowerBB->functions->CleanText($Forum_rwo['title']));
		 $PowerBB->template->assign('keywords',$PowerBB->functions->Getkeywords($Forum_rwo['title']));
		}
        $PowerBB->template->assign('index',1);

		}
		elseif ($PowerBB->_GET['page'] == 'profile')
		{
	        $MemberArr 			= 	array();
			if (empty($PowerBB->_GET['id']))
			{
			$MemberArr['where'] 	= 	array('username',$PowerBB->_GET['username']);
			}
			else
			{
			$MemberArr['where'] 	= 	array('id',$PowerBB->_GET['id']);
			}
		   $MemInfo = $PowerBB->core->GetInfo($MemberArr,'member');
		$page_address['profile'] 		= 	$PowerBB->_CONF['template']['_CONF']['lang']['View_Member_Profile']." - ".$MemInfo['username'];
		 $PowerBB->template->assign('keywords',$PowerBB->functions->CleanText($MemInfo['username']).",".$PowerBB->functions->CleanText($MemInfo['user_title']).",".$PowerBB->_CONF['info_row']['title']);
		 $PowerBB->template->assign('description',$PowerBB->functions->CleanText($MemInfo['username'])." : ".$PowerBB->functions->CleanText($MemInfo['user_title']));
         $PowerBB->template->assign('index',1);
		}
		elseif ($PowerBB->_GET['page'] == 'post')
		{
		$ReplyArr = array();
		$ReplyArr['where'] = array('id',intval($PowerBB->_GET['id']));
		$ReplyInfo = $PowerBB->core->GetInfo($ReplyArr,'reply');
		$num = '155';
        if ($PowerBB->functions->section_group_permission($ReplyInfo['section'],$PowerBB->_CONF['group_info']['id'],'view_subject'))
		 {
		    $page_address['post'] 		= 	$PowerBB->functions->CleanText($ReplyInfo['title'])." - ".$PowerBB->_CONF['template']['_CONF']['lang']['view_single_post']." - ".$PowerBB->_CONF['info_row']['title'];
			$PowerBB->template->assign('keywords',$PowerBB->functions->Getkeywords($ReplyInfo['title']));
			$PowerBB->template->assign('description',$PowerBB->Powerparse->_wordwrap($PowerBB->functions->CleanText($ReplyInfo['text']),$num));
			$PowerBB->template->assign('index',1);
		 }
		}
		elseif ($PowerBB->_GET['page'] == 'topic')
		{
		$SubjectArr = array();
		$SubjectArr['where'] = array('id',$PowerBB->_GET['id']);
		$SubjectInfo = $PowerBB->core->GetInfo($SubjectArr,'subject');
		$PowerBB->template->assign('Subject_Info_Row',$SubjectInfo);
		if ($PowerBB->functions->section_group_permission($SubjectInfo['section'],$PowerBB->_CONF['group_info']['id'],'view_subject'))
		 {
				$page_address['topic']         =     $PowerBB->Powerparse->censor_words($SubjectInfo['prefix_subject'].' '.$SubjectInfo['title']." - ".$PowerBB->_CONF['info_row']['title']);

				$TagArr 			= 	array();
				$TagArr['where'] 	= 	array('subject_id',$SubjectInfo['id']);
				$PowerBB->_CONF['template']['while']['tags'] = $PowerBB->tag->GetSubjectList($TagArr);
				$num = '155';
				if($PowerBB->_CONF['template']['while']['tags'])
				{
				$PowerBB->template->assign('keywords',$PowerBB->_CONF['template']['while']['tags']);
				}
				else
				{
				$PowerBB->template->assign('keywords',$PowerBB->functions->Getkeywords($SubjectInfo['title']));
				$PowerBB->template->assign('index',1);
				}
				$PowerBB->template->assign('description',$PowerBB->Powerparse->_wordwrap($PowerBB->functions->CleanText($SubjectInfo['text']),$num));
          }
		}
		elseif ($PowerBB->_GET['rules'] == '1')
		{
		$page_address['misc'] 		= 	$PowerBB->_CONF['template']['_CONF']['lang']['rules'] .' - '. $PowerBB->_CONF['info_row']['title'];
		$num = '155';
		 $PowerBB->template->assign('keywords',$PowerBB->functions->Getkeywords($PowerBB->_CONF['template']['_CONF']['lang']['rules']));
		 $PowerBB->template->assign('description',$PowerBB->functions->CleanText($PowerBB->Powerparse->_wordwrap($PowerBB->_CONF['info_row']['rules'],$num)));
         $PowerBB->template->assign('index',1);
		}
        elseif ($PowerBB->_GET['sendmessage'] == '1')
		{
		$page_address['send'] 		= 	$PowerBB->_CONF['template']['_CONF']['lang']['Contact_Manager'] .' - '. $PowerBB->_CONF['info_row']['title'];
		$PowerBB->template->assign('keywords',$PowerBB->functions->Getkeywords($PowerBB->_CONF['template']['_CONF']['lang']['Contact_Manager']));
		$PowerBB->template->assign('description',$PowerBB->functions->CleanText($PowerBB->_CONF['template']['_CONF']['lang']['Contact_Manager']) .'  '. $PowerBB->_CONF['info_row']['title']);
         $PowerBB->template->assign('index',1);
		}
        elseif ($PowerBB->_GET['folder'] == 'sent')
		{
		$page_address['pm_list'] 		= 	$PowerBB->_CONF['template']['_CONF']['lang']['Outgoing_Messages'] .' - '. $PowerBB->_CONF['info_row']['title'];
		}
        elseif ($PowerBB->_GET['folder'] == 'inbox')
		{
		$page_address['pm_list'] 		= 	$PowerBB->_CONF['template']['_CONF']['lang']['Contained_Messages'] .' - '. $PowerBB->_CONF['info_row']['title'];
		}
        elseif ($PowerBB->_GET['info'] == '1')
		{
		$page_address['usercp'] 		= 	$PowerBB->_CONF['template']['_CONF']['lang']['Your_Personal_Information'] .' - '. $PowerBB->_CONF['info_row']['title'];
		}
		elseif ($PowerBB->_GET['page'] == 'pages')
		{
		$PageArr 			= 	array();
		$PageArr['where'] 	= 	array('id',$PowerBB->_GET['id']);
		$PowerBB->_CONF['template']['GetPage'] = $PowerBB->core->GetInfo($PageArr,'pages');
		 $page_address['pages'] 		= 	$PowerBB->Powerparse->censor_words($PowerBB->_CONF['template']['GetPage']['title'] .' - '. $PowerBB->_CONF['info_row']['title']);
		 $num = '100';
		 $PowerBB->_CONF['template']['GetPage']['html_code'] = $PowerBB->functions->words_count_replace_strip_tags_html2bb($PowerBB->_CONF['template']['GetPage']['html_code'],$num);
         $PowerBB->template->assign('description',$PowerBB->_CONF['template']['GetPage']['html_code'].' '. $PowerBB->_CONF['info_row']['title']);
		 $PowerBB->template->assign('keywords',$PowerBB->functions->Getkeywords($PowerBB->_CONF['template']['GetPage']['title']));
         $PowerBB->template->assign('index',1);
		}
		elseif ($PowerBB->_CONF['info_row']['board_close'] == '1')
    	{
		 $title 		= 	$PowerBB->_CONF['template']['_CONF']['lang']['board_close'];
		 $num = '100';
		 $title = $PowerBB->functions->words_count_replace_strip_tags_html2bb($title,$num);
         $PowerBB->template->assign('description',$title);
		 $PowerBB->template->assign('keywords',$PowerBB->functions->Getkeywords($PowerBB->_CONF['template']['_CONF']['lang']['board_close']));
         $PowerBB->template->assign('index',1);
 		}
		elseif ($PowerBB->_GET['page'] == 'management'
		AND $PowerBB->_GET['subject'] == '1'
		AND $PowerBB->_GET['operator'] == 'edit')
    	{
		$page_address['management'] 		= 	$PowerBB->_CONF['template']['_CONF']['lang']['edit_Subject'] .' - '. $PowerBB->_CONF['info_row']['title'];
 		}
		elseif ($PowerBB->_GET['page'] == 'management'
		AND $PowerBB->_GET['reply'] == '1'
		AND $PowerBB->_GET['operator'] == 'edit')
    	{
		$page_address['management'] 		= 	$PowerBB->_CONF['template']['_CONF']['lang']['edit_reply'] .' - '. $PowerBB->_CONF['info_row']['title'];
 		}
		elseif ($PowerBB->_GET['operator'] == 'move')
    	{
		$page_address['management'] 		= 	$PowerBB->_CONF['template']['_CONF']['lang']['mov_Subject'] .' - '. $PowerBB->_CONF['info_row']['title'];
 		}
		elseif ($PowerBB->_GET['operator'] == 'close')
    	{
		$page_address['management'] 		= 	$PowerBB->_CONF['template']['_CONF']['lang']['locked_Topic'] .' - '. $PowerBB->_CONF['info_row']['title'];
 		}
		elseif ($PowerBB->_GET['operator'] == 'repeated')
    	{
		$page_address['management'] 		= 	$PowerBB->_CONF['template']['_CONF']['lang']['repeated_Subject'] .' - '. $PowerBB->_CONF['info_row']['title'];
 		}
		elseif ($PowerBB->_GET['operator'] == 'tools_thread')
    	{
		$page_address['management'] 		= 	$PowerBB->_CONF['template']['_CONF']['lang']['Management_Subjects'] .' - '. $PowerBB->_CONF['info_row']['title'];
 		}
		elseif ($PowerBB->_GET['page'] == 'tags')
		{
		$TagInfoArr 			= 	array();
		$TagInfoArr['where'] 	= 	array('id',intval($PowerBB->_GET['id']));
		$TagInfo = $PowerBB->core->GetInfo($TagInfoArr,'tags_subject');
		$page_address['tags'] 			= 	$TagInfo['tag'];
        $PowerBB->template->assign('description',$PowerBB->functions->CleanText($TagInfo['tag']));
		$PowerBB->template->assign('keywords',$PowerBB->functions->Getkeywords($TagInfo['tag']));
        $PowerBB->template->assign('index',1);
		}
		elseif ($PowerBB->_GET['page'] == 'portal')
		{
		$page_address['portal'] 		= 	$PowerBB->_CONF['info_row']['title_portal'];
        $PowerBB->template->assign('description',$PowerBB->functions->CleanText($PowerBB->_CONF['info_row']['title_portal']) .' '.$PowerBB->_CONF['info_row']['title']);
		$PowerBB->template->assign('keywords',$PowerBB->functions->Getkeywords($PowerBB->_CONF['info_row']['title_portal']));
		$PowerBB->template->assign('index',1);
		}
		elseif ($PowerBB->_GET['page'] == 'special_subject')
		{
		$page_address['special_subject'] 		= 	$PowerBB->_CONF['template']['_CONF']['lang']['Special_Subject'] .' - '. $PowerBB->_CONF['info_row']['title'];
        $PowerBB->template->assign('description',$PowerBB->functions->CleanText($PowerBB->_CONF['template']['_CONF']['lang']['Special_Subject'])  .' '. $PowerBB->_CONF['info_row']['title']);
		$PowerBB->template->assign('keywords',$PowerBB->functions->Getkeywords($PowerBB->_CONF['template']['_CONF']['lang']['Special_Subject']));
		$PowerBB->template->assign('index',1);
		}
		elseif ($PowerBB->_GET['page'] == 'calendar')
		{
		$page_address['calendar'] 		= 	$PowerBB->_CONF['template']['_CONF']['lang']['Calendar'] .' - '. $PowerBB->_CONF['info_row']['title'];
        $PowerBB->template->assign('description',$PowerBB->functions->CleanText($PowerBB->_CONF['template']['_CONF']['lang']['Calendar']) .' '. $PowerBB->_CONF['info_row']['title']);
		$PowerBB->template->assign('keywords',$PowerBB->functions->Getkeywords($PowerBB->_CONF['template']['_CONF']['lang']['Calendar']));
		$PowerBB->template->assign('index',1);
		}
		elseif ($PowerBB->_GET['page'] == 'static')
		{
		$page_address['static'] 		= 	$PowerBB->_CONF['template']['_CONF']['lang']['statics'] .' - '. $PowerBB->_CONF['info_row']['title'];
        $PowerBB->template->assign('description',$PowerBB->functions->CleanText($PowerBB->_CONF['template']['_CONF']['lang']['statics']) .' '. $PowerBB->_CONF['info_row']['title']);
		$PowerBB->template->assign('keywords',$PowerBB->functions->Getkeywords($PowerBB->_CONF['template']['_CONF']['lang']['statics']));
		$PowerBB->template->assign('index',1);
		}
		elseif ($PowerBB->_GET['page'] == 'search')
		{
		$page_address['search'] 		= 	$PowerBB->_CONF['template']['_CONF']['lang']['Search_Engine'] .' - '. $PowerBB->_CONF['info_row']['title'];
        $PowerBB->template->assign('description',$PowerBB->functions->CleanText($PowerBB->_CONF['template']['_CONF']['lang']['Search_Engine']) .' '. $PowerBB->_CONF['info_row']['title']);
		$PowerBB->template->assign('keywords',$PowerBB->functions->Getkeywords($PowerBB->_CONF['template']['_CONF']['lang']['Search_Engine']));
		$PowerBB->template->assign('index',1);
		}
		elseif ($PowerBB->_GET['page'] == 'login')
		{
		$page_address['login'] 		    = 	$PowerBB->_CONF['template']['_CONF']['lang']['Login_mem'] .' - '. $PowerBB->_CONF['info_row']['title'];
        $PowerBB->template->assign('description',$PowerBB->functions->CleanText($PowerBB->_CONF['template']['_CONF']['lang']['Login_mem']) .' '. $PowerBB->_CONF['info_row']['title']);
		$PowerBB->template->assign('keywords',$PowerBB->functions->Getkeywords($PowerBB->_CONF['template']['_CONF']['lang']['Login_mem']));
		$PowerBB->template->assign('index',1);
		}
		elseif ($PowerBB->_GET['page'] == 'register')
		{
		$page_address['register'] 		= 	$PowerBB->_CONF['template']['_CONF']['lang']['register'] .' - '. $PowerBB->_CONF['info_row']['title'];
        $PowerBB->template->assign('description',$PowerBB->functions->CleanText($PowerBB->_CONF['template']['_CONF']['lang']['register']) .' '. $PowerBB->_CONF['info_row']['title']);
		$PowerBB->template->assign('keywords',$PowerBB->functions->Getkeywords($PowerBB->_CONF['template']['_CONF']['lang']['register']));
		$PowerBB->template->assign('index',1);
		}
		elseif ($PowerBB->_GET['page'] == 'team')
		{
		$page_address['team'] 			= 	$PowerBB->_CONF['template']['_CONF']['lang']['Leaders'] .' - '. $PowerBB->_CONF['info_row']['title'];
        $PowerBB->template->assign('description',$PowerBB->functions->CleanText($PowerBB->_CONF['template']['_CONF']['lang']['Leaders']) .' '. $PowerBB->_CONF['info_row']['title']);
		$PowerBB->template->assign('keywords',$PowerBB->functions->Getkeywords($PowerBB->_CONF['template']['_CONF']['lang']['Leaders']));
		$PowerBB->template->assign('index',1);
		}
		elseif ($PowerBB->_GET['page'] == 'latest_reply')
		{
		$page_address['latest_reply'] 		= 	$PowerBB->_CONF['template']['_CONF']['lang']['latest_reply'] .' - '. $PowerBB->_CONF['info_row']['title'];
        $PowerBB->template->assign('description',$PowerBB->functions->CleanText($PowerBB->_CONF['template']['_CONF']['lang']['latest_reply']) .' '. $PowerBB->_CONF['info_row']['title']);
		$PowerBB->template->assign('keywords',$PowerBB->functions->Getkeywords($PowerBB->_CONF['template']['_CONF']['lang']['latest_reply']));
		$PowerBB->template->assign('index',1);
		}
		elseif ($PowerBB->_GET['page'] == 'latest')
		{
		$page_address['latest'] 		= 	$PowerBB->_CONF['template']['_CONF']['lang']['subject_today'];
        $PowerBB->template->assign('description',$PowerBB->functions->CleanText($PowerBB->_CONF['template']['_CONF']['lang']['subject_today']) .' '. $PowerBB->_CONF['info_row']['title']);
		$PowerBB->template->assign('keywords',$PowerBB->functions->Getkeywords($PowerBB->_CONF['template']['_CONF']['lang']['subject_today']));
		$PowerBB->template->assign('index',1);
		}
		elseif ($PowerBB->_GET['page'] == 'sitemap')
		{
		$page_address['sitemap'] 		= 	$PowerBB->_CONF['template']['_CONF']['lang']['Sitemap_title'] .' - '. $PowerBB->_CONF['info_row']['title'];
        $PowerBB->template->assign('description',$PowerBB->functions->CleanText($PowerBB->_CONF['template']['_CONF']['lang']['Sitemap_title']) .' '. $PowerBB->_CONF['info_row']['title']);
		$PowerBB->template->assign('keywords',$PowerBB->functions->Getkeywords($PowerBB->_CONF['template']['_CONF']['lang']['Sitemap_title']));
		$PowerBB->template->assign('index',1);
		}
		elseif ($PowerBB->_GET['page'] == 'member_list')
		{
		$page_address['member_list'] 	= 	$PowerBB->_CONF['template']['_CONF']['lang']['memberlist'] .' - '. $PowerBB->_CONF['info_row']['title'];
        $PowerBB->template->assign('description',$PowerBB->functions->CleanText($PowerBB->_CONF['template']['_CONF']['lang']['memberlist']) .' '. $PowerBB->_CONF['info_row']['title']);
		$PowerBB->template->assign('keywords',$PowerBB->functions->Getkeywords($PowerBB->_CONF['template']['_CONF']['lang']['memberlist']));
		$PowerBB->template->assign('index',1);
		}
		elseif ($PowerBB->_GET['page'] == 'announcement')
		{
		$page_address['announcement'] 	= 	$PowerBB->_CONF['template']['_CONF']['lang']['announcement'] .' - '. $PowerBB->_CONF['info_row']['title'];
        $PowerBB->template->assign('description',$PowerBB->functions->CleanText($PowerBB->_CONF['template']['_CONF']['lang']['announcement']) .' '. $PowerBB->_CONF['info_row']['title']);
		$PowerBB->template->assign('keywords',$PowerBB->functions->Getkeywords($PowerBB->_CONF['template']['_CONF']['lang']['announcement']));
		$PowerBB->template->assign('index',1);
		}
		$page_address['managementreply']= 	$PowerBB->_CONF['template']['_CONF']['lang']['Management_Subjects'] .' - '. $PowerBB->_CONF['info_row']['title'];
		$page_address['logout'] 		= 	$PowerBB->_CONF['template']['_CONF']['lang']['Guidance_re'] .' - '. $PowerBB->_CONF['info_row']['title'];
		$page_address['usercp'] 		= 	$PowerBB->_CONF['template']['_CONF']['lang']['User_Control_Panel'] .' - '. $PowerBB->_CONF['info_row']['title'];
		$page_address['pm'] 			= 	$PowerBB->_CONF['template']['_CONF']['lang']['Read_the_message'] .' - '. $PowerBB->_CONF['info_row']['title'];
		$page_address['new_topic'] 	= 	$PowerBB->_CONF['template']['_CONF']['lang']['add_new_topic'] .' - '. $PowerBB->_CONF['info_row']['title'];
		$page_address['new_reply'] 	= 	$PowerBB->_CONF['template']['_CONF']['lang']['add_new_reply'] .' - '. $PowerBB->_CONF['info_row']['title'];
		$page_address['vote'] 			= 	$PowerBB->_CONF['template']['_CONF']['lang']['show_votes'] .' - '. $PowerBB->_CONF['info_row']['title'];
		$page_address['online'] 		= 	$PowerBB->_CONF['template']['_CONF']['lang']['online_naw'] .' - '. $PowerBB->_CONF['info_row']['title'];
		$page_address['pm_setting'] 		= 	$PowerBB->_CONF['template']['_CONF']['lang']['Settings_Private_Messages'] .' - '. $PowerBB->_CONF['info_row']['title'];
		$page_address['warn'] 		       = 	$PowerBB->_CONF['template']['_CONF']['lang']['send_warn'];
		$page_address['pm_setting'] 		= 	$PowerBB->_CONF['template']['_CONF']['lang']['Settings_Private_Messages'] .' - '. $PowerBB->_CONF['info_row']['title'];
		$page_address['report'] 		= 	$PowerBB->_CONF['template']['_CONF']['lang']['Report_bad_post'] .' - '. $PowerBB->_CONF['info_row']['title'];
		$page_address['page'] 		= 	$PowerBB->_CONF['template']['_CONF']['lang']['Settings_Private_Messages'] .' - '. $PowerBB->_CONF['info_row']['title'];
		if (array_key_exists($page,$page_address))
		{
			$title = $page_address[$page];
		}
 		// Show header template
         $PowerBB->template->assign('title',$PowerBB->functions->CleanText($title));
 		$PowerBB->template->display('headinclud');
		if ($PowerBB->_GET['page'] == 'topic'
		or $PowerBB->_GET['page'] == 'post'
		or $PowerBB->_GET['page'] == 'new_topic'
		or $PowerBB->_GET['page'] == 'new_reply'
		or $PowerBB->_GET['page'] == 'print'
		or $PowerBB->_GET['reply_edit']
		or $PowerBB->_GET['subject_edit'])
		{
	       // jwplayer tag replace
	        echo "<script type=\"text/javascript\" src=\"applications/core/jwplayer/jwplayer.js\"></script><script type=\"text/javascript\" src=\"applications/core/jwplayer/jwplayer.trigger.js\"></script>";
	    }
 	}
 	/**
 	 * Get the forum's url adress
 	 */
 	function GetForumAdress()
 	{
 		global $PowerBB;
		$dir =($PowerBB->_SERVER['PHP_SELF']);
		// delet admincp folder name from dir
		$dir = @str_ireplace($PowerBB->admincpdir."/", '', $dir);
		$dir = 	explode('/',$dir);
		$dir = @str_ireplace("index.php/", '', $dir);
        if(isset($dir[2]))
        {
 		$url = $PowerBB->_SERVER['HTTP_HOST'].'/'.$dir[1].'/'.$dir[2].'/';
        }
        elseif(isset($dir[3]))
        {
 		$url = $PowerBB->_SERVER['HTTP_HOST'].'/'.$dir[1].'/'.$dir[2].'/'.$dir[3].'/';
        }
        elseif(isset($dir[4]))
        {
 		$url = $PowerBB->_SERVER['HTTP_HOST'].'/'.$dir[1].'/'.$dir[2].'/'.$dir[3].'/'.$dir[4].'/';
        }
        else
        {
 		$url = $PowerBB->_SERVER['HTTP_HOST'].'/'.$dir[1].'/';
        }
 		$url = @str_ireplace("index.php/", '', $url);
 		$url = @str_ireplace("upload.php/", '', $url);
 		$url = str_replace("index.php/", '', $url);
 		$url = str_replace("upload.php/", '', $url);
		$url = @preg_replace('#/.*(.*).php/.*#iUe', "", $url);
		$url = @preg_replace('#(.*).php.*#iUe', "", $url);
		// Get server port
		if (isset($PowerBB->_SERVER['HTTPS']) &&
		    ($PowerBB->_SERVER['HTTPS'] == 'on' || $PowerBB->_SERVER['HTTPS'] == 1) ||
		    isset($PowerBB->_SERVER['HTTP_X_FORWARDED_PROTO']) &&
		    $PowerBB->_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
		  $protocol = 'https://';
		}
		else {
		  $protocol = 'http://';
		}

		$scheme = $protocol.$url;
 		return $scheme;
 	}

 	/**
 	 * Get the Server Protocol http or https
 	 */
 	function GetServerProtocol()
 	{
 		global $PowerBB;
		// Get server port
		if (isset($PowerBB->_SERVER['HTTPS']) &&
		    ($PowerBB->_SERVER['HTTPS'] == 'on' || $PowerBB->_SERVER['HTTPS'] == 1) ||
		    isset($PowerBB->_SERVER['HTTP_X_FORWARDED_PROTO']) &&
		    $PowerBB->_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
		  $protocol = 'https://';
		}
		else {
		  $protocol = 'http://';
		}

 		return $protocol;
 	}
	/**
 	 * Get the Mian folder forum url adress
 	 */
 	function GetMianDir()
 	{
 		global $PowerBB;
		$dir =($PowerBB->_SERVER['PHP_SELF']);
		// delet admincp folder name from dir
		$dir = @str_ireplace($PowerBB->admincpdir."/", '', $dir);
		$dir = 	explode('/',$dir);
		$dir[1] = @str_ireplace("index.php/", '', $dir[1]);
		$PowerBB->_SERVER['DOCUMENT_ROOT'] = @str_ireplace("index.php/", '', $PowerBB->_SERVER['DOCUMENT_ROOT']);
        if(isset($dir[2]))
        {
 		$MianDir = $PowerBB->_SERVER['DOCUMENT_ROOT'].'/'.$dir[1].'/'.$dir[2].'/';
        }
        elseif(isset($dir[3]))
        {
 		$MianDir = $PowerBB->_SERVER['DOCUMENT_ROOT'].'/'.$dir[1].'/'.$dir[2].'/'.$dir[3].'/';
        }
        elseif(isset($dir[4]))
        {
 		$MianDir = $PowerBB->_SERVER['DOCUMENT_ROOT'].'/'.$dir[1].'/'.$dir[2].'/'.$dir[3].'/'.$dir[4].'/';
        }
        else
        {
 		$MianDir = $PowerBB->_SERVER['DOCUMENT_ROOT'].'/'.$dir[1].'/';
        }
 		$MianDir = @str_ireplace("index.php/", '', $MianDir);
		$MianDir = @preg_replace('#/.*(.*).php/.*#iUe', "", $MianDir);
		$MianDir = @preg_replace('#(.*).php.*#iUe', "", $MianDir);
 		return $MianDir;
 	}
 	/**
 	 * Get a strong random code :)
 	 */
 	function RandomCode()
    {
  		$code = rand(1,500) . rand(1,1000) . microtime();
  		$code = @ceil($code);
  		$code = base64_encode($code);
  		$code = substr($code,0,15);
  		$code = str_replace('=',rand(1,100),$code);
  		return $code;
 	}
 	/**
 	 * Get a strong random 4 numbers :)
 	 */
	function random_numbers()
	{
	    $alphabet = "0123456789";
	    $pass = array();
	    $alphaLength = strlen($alphabet) - 1;
	    for ($i = 0; $i < 4; $i++) {
	        $n = mt_rand(0, $alphaLength);
	        $pass[] = $alphabet[$n];
	    }
	    return implode($pass);
	}
    // hide a part of the email adress
	function obfuscate_email($email)
	{
	    $em   = explode("@",$email);
	    $name = implode(array_slice($em, 0, count($em)-1), '@');
	    $len  = floor(strlen($name)/2);
	    return substr($name,0, $len) . str_repeat('*', $len) . "@" . end($em);
	}
	/**
	 * Just send email for phpmail :)
	 */
 	function send_this_php($to,$subject,$message,$sender)
    {
        global $PowerBB;
        $mailfromname = $PowerBB->_CONF['info_row']['title'];
    	$headers  = "MIME-Version: 1.0 \r\n";
    	$headers .= "Content-type: text/html; charset=utf-8 \r\n";
        $headers .= "Content-Transfer-Encoding:8bit \r\n";
        $headers .= "From: $mailfromname <$sender> \r\n";
    	//$headers .= "Reply-To: $to \r\n";
        $headers .= "Cc:$to \r\n";
		$headers .= "X-Mailer: PHP ".phpversion()."\r\n";
		$headers .= "X-Priority: 3\r\n";
        $send = @mail($to,$subject,$message,$headers);
        return ($send) ? true : false;
 	}
	/**
	 * Just send email for smtp :)
	 */
  function send_this_smtp($to, $fromname, $message, $subject, $from)
    {
        global $PowerBB;
		require("mailer/PHPMailerAutoload.php");
        if(empty($PowerBB->_CONF['info_row']['smtp_username'])
        or empty($PowerBB->_CONF['info_row']['smtp_password']))
        {
        $SMTPmailer = false;
        }
        else
        {
        $SMTPmailer = true;
        }
	    // HTML body
	    $body  = "";
	    $body .= "";
	    $body .= $message;
	    // Plain text body (for mail clients that cannot read HTML)
	    $text_body  = "";
	    $text_body .= "";
	    $text_body .= $fromname;
		/////////////
		$mail = new PHPMailer;
		//$mail->SMTPDebug = 3;  // Enable verbose debug output
		$mail->isSMTP();   // Set mailer to use SMTP
		$mail->Host = $PowerBB->_CONF['info_row']['smtp_server'];  // Specify main and backup SMTP servers
		$mail->SMTPAuth = $SMTPmailer;  // Enable SMTP authentication
		$mail->Username = $PowerBB->_CONF['info_row']['smtp_username']; // SMTP username
		$mail->Password = $PowerBB->_CONF['info_row']['smtp_password']; // SMTP password
		$mail->SMTPSecure = strtolower($PowerBB->_CONF['info_row']['smtp_secure']); // Enable TLS encryption, `ssl` also accepted
		$mail->Port = $PowerBB->_CONF['info_row']['smtp_port'];  // TCP port to connect to
		$mail->From = $from;
		$mail->FromName = $PowerBB->_CONF['info_row']['title'];
		$mail->addAddress($to, $subject);     // Add a recipient
		$mail->addReplyTo($to, $PowerBB->_CONF['info_row']['title']);
		$mail->isHTML(true);   // Set email format to HTML
		$mail->Subject = $subject;
		$mail->Body    = $body;
		$mail->AltBody = $text_body;
		if(!$mail->send()) {
        return false;
		} else {
		return true;
		}
 	}
 	function words_count($string,$words_count)
 	{
 	 global $PowerBB;
		$string_arr = explode(" ", $string);
		for($i = sizeof($string_arr); $i >= $words_count; $i--)
		{
		    unset($string_arr[$i]);
		}
		$new_string = implode(" ",$string_arr);
		return ($new_string);
    }
 	function words_count_replace_strip_tags_html2bb($string,$words_count)
 	{
 	 global $PowerBB;
		$string = $string;
		$string = @str_replace("\n", ' ', $string);
		$string = @str_replace("\r", '', $string);
		$string = @str_replace("\t", '', $string);
		$string = @str_replace("   ", " ", $string);
		$string = @str_replace("  ", " ", $string);
        $string = strip_tags($string);
      	$string = @htmlspecialchars($string);
      	 $string = @str_replace("&nbsp;", " ", $string);
      	$string = @str_replace("&amp;", "", $string);
      	$string = @str_replace("nbsp;", " ", $string);
		$string =  $PowerBB->Powerparse->_wordwrap($string,$words_count+100);
		return ($string);
    }
function Getkeywords($string)
 	{
 	 global $PowerBB;

        $string = strip_tags($string);
		$string = @str_replace("\r","{s}", $string);
		$string = @str_replace("\n","{s}", $string);

      $originally_text = $string;
      $string = 	explode(" ",$string);
			  // Cycle through the words
			foreach($string as $key)
			{

				if (function_exists('mb_strlen'))
				{
				$tag_less_num = mb_strlen($key, 'UTF-8') >= 4;
				}
				else
				{
				$tag_less_num = strlen(utf8_decode($key)) >= 4;
				}
			      // If the word has more than 4 letters
			    if(!$tag_less_num)
			    {

			     $originally_text = str_replace($key,"", $originally_text);

			    }
			}
			  // Recreate string from array
			  // See what we got
			$originally_text = str_replace(" ",",", $originally_text);
			$originally_text = str_replace("..","", $originally_text);
			$originally_text = @str_replace("{s}",",", $originally_text);
			$originally_text = str_replace(",,",",", $originally_text);
			$originally_text = str_replace(",,",",", $originally_text);
			$originally_text = str_replace($originally_text,"'".$originally_text."'", $originally_text);
			$originally_text = str_replace("',","", $originally_text);
			$originally_text = str_replace(",'","", $originally_text);
			$originally_text = str_replace("'","", $originally_text);
			$originally_text = str_replace(",".$originally_text,$originally_text, $originally_text);
			$originally_text = str_replace($originally_text.",",$originally_text, $originally_text);

	        $_search = '#\[(.*)\]#esiU';
	        $_replace = "";
	        $originally_text = @preg_replace($_search,$_replace,$originally_text);

		return ($originally_text);
    }
function CleanText($string)
 	{
 	 global $PowerBB;

		$string = @str_replace(">","> ", $string);
		$string = @str_replace("<"," <", $string);
		$string = strip_tags($string);
		$string = @str_replace("\r","{s}", $string);
		$string = @str_replace("\n","{s}", $string);
		$string = @str_replace("\t","{s}", $string);

		$originally_text = $string;
		// Recreate string from array
		// See what we got
		$originally_text = str_replace(" ",",", $originally_text);
		$originally_text = str_replace("..","", $originally_text);
		$originally_text = str_replace("{s}",",", $originally_text);
		$originally_text = str_replace(",,",",", $originally_text);
		$originally_text = str_replace(",,",",", $originally_text);
		$originally_text = str_replace($originally_text,"'".$originally_text."'", $originally_text);
		$originally_text = str_replace("',","", $originally_text);
		$originally_text = str_replace(",'","", $originally_text);
		$originally_text = str_replace("'","", $originally_text);
		$originally_text = str_replace(","," ", $originally_text);
		$originally_text = str_replace("&nbsp;"," ", $originally_text);
		$originally_text = str_replace("  "," ", $originally_text);
		$originally_text = str_replace("&quot;","", $originally_text);
		$originally_text = str_replace("&amp;quot;","", $originally_text);
		$originally_text = str_replace("    "," ", $originally_text);
		$originally_text = str_replace("   "," ", $originally_text);

	    $pattern = '|[[\/\!]*?[^\[\]]*?]|si';
	    $replace = '';
        $originally_text = preg_replace($pattern, $replace, $originally_text);
		return ($originally_text);
    }
 	function replace_strip($string)
 	{
 	 global $PowerBB;
		$string = $PowerBB->Powerparse->replace($string);
		$PowerBB->Powerparse->replace_smiles($string);
		//$string = strip_tags($string);
        $string = $PowerBB->Powerparse->censor_words($string);
		return ($string);
    }
 	/**
 	 * Check if $adress is true site adress or not
 	 */
 	function IsSite($adress)
 	{
 		return preg_match('~http:\/\/(.*?)~',$adress) ? true : false;
 	}
 	function IsImage($filename,$upload)
 	{
 	    global $PowerBB;
		if (@strstr($filename,'alert')
			or @strstr($filename,"body")
			or @strstr($filename,'>')
			or @strstr($filename,'<')
			or @strstr($filename,'.php')
			or @strstr($filename,'.asp')
			or @strstr($filename,'.js')
			or @strstr($filename,'.html')
			or @strstr($filename,'.htm'))
      	{
			return false;
      	} else {
		return true;
		}
		if (@strstr($filename,".jpg")
			or @strstr($filename,".gif")
			or @strstr($filename,".png")
			or @strstr($filename,".bmp")
			or @strstr($filename,".jpeg"))
      	{
			return true;
		} else {
		return false;
		}
      	  if($upload)
      	  {
               $BAD_TYPES = array("image/gif",
                    "image/pjpeg",
                    "image/jpeg",
                    "image/png",
                    "image/jpg",
                    "image/bmp",
                    "image/x-png");
			   if(in_array($PowerBB->_FILES['upload']['type'],$BAD_TYPES))
			   {
			     return true;
			   } else {
		        return false;
		       }
		  }
	}
 	function GetURLExtension($path)
 	{
 		global $PowerBB;
 		$filename = @basename($path);
		return $this->GetFileExtension($filename);
 	}
	function date($input)
	{
		global $PowerBB;
		return $PowerBB->sys_functions->date($input);
	}
	function time_ago($input)
	{
		global $PowerBB;
		return $PowerBB->sys_functions->time_ago($input);
	}
	function year_date($input)
	{
		global $PowerBB;
		return $PowerBB->sys_functions->year_date($input);
	}
	function time($time)
	{
		global $PowerBB;
		return $PowerBB->sys_functions->time($time);
	}
	function ReplaceMysqlExtension($Ex)
	{
		global $PowerBB;
		return $PowerBB->sys_functions->ReplaceMysqlExtension($Ex);
	}
	function GetUsernameStyleAndUserId($username)
	{
		global $PowerBB;
     if ($PowerBB->_CONF['info_row']['get_group_username_style'])
      {
			if (!empty($username))
			{
	   		// Get username style
			$MemberArr 			= 	array();
			$MemberArr['where'] 	= 	array('username',$username);
			$StyleMemberInfo = $PowerBB->core->GetInfo($MemberArr,'member');
	        $username = $StyleMemberInfo['username_style_cache'];
	        $user_id = $StyleMemberInfo['id'];
			 $username = '<a href="index.php?page=profile&amp;show=1&amp;id=' . $user_id . '">' . $username . '</a> ';
			 return $writer_photo_thumb. $username = $PowerBB->functions->rewriterule($username);
		  }
		  else
		  {
			return $username;
	      }
	  }
	  else
	  {
		 $username = '<a href="index.php?page=profile&amp;show=1&amp;username=' . $username . '">' . $username . '</a> ';
		 return $username = $PowerBB->functions->rewriterule($username);
      }
	}
	function GetUsernameStyle($username)
	{
		global $PowerBB;
     if ($PowerBB->_CONF['info_row']['get_group_username_style'])
      {
   		// Get username style of last_writer
		$MemberArr 			= 	array();
		$MemberArr['where'] 	= 	array('username',$username);
		$StyleMemberInfo = $PowerBB->core->GetInfo($MemberArr,'member');
        $username = $StyleMemberInfo['username_style_cache'];
		return $username;
	  }
	  else
	  {
		 $username = '<a href="index.php?page=profile&amp;show=1&amp;username=' . $username . '">' . $username . '</a> ';
		 return $username = $PowerBB->functions->rewriterule($username);
      }
	}

	function GetwriterGroupStyle($Username,$Group)
	{
     if ($PowerBB->_CONF['info_row']['get_group_username_style'])
      {
		 if (!empty($Username))
		  {
	   		// Get username style of writer
			$MemberGroupArr 			= 	array();
			$MemberGroupArr['where'] 	= 	array('id',$Group);
			$GroupInfo = $PowerBB->core->GetInfo($MemberGroupArr,'group');
	         $style = $GroupInfo['username_style'];
			$username_style_cache = str_replace('[username]',$Username,$style);
			return $username_style_cache;
		  }
		  else
		  {
			return $Username;
	      }
	  }
	  else
	  {
        return $Username;
      }
	}
	function GetEditorTools()
	{
		global $PowerBB;
		if (!is_object($PowerBB->icon))
		{
			trigger_error('ERROR::ICON_OBJECT_DID_NOT_FOUND',E_USER_ERROR);
		}
		$SmlArr 					= 	array();
		$SmlArr['order'] 			=	array();
		$SmlArr['order']['field']	=	'id';
		$SmlArr['order']['type']	=	'ASC';
		$SmlArr['limit']			=	$PowerBB->_CONF['info_row']['smiles_nm'];
		$SmlArr['proc'] 			= 	array();
		$SmlArr['proc']['*'] 		= 	array('method'=>'clean','param'=>'html');
		$PowerBB->_CONF['template']['while']['SmileRows'] = $PowerBB->icon->GetSmileList($SmlArr);
		$IcnArr 					= 	array();
		$IcnArr['order'] 			=	array();
		$IcnArr['order']['field']	=	'id';
		$IcnArr['order']['type']	=	'DESC';
		$IcnArr['limit']			=	$PowerBB->_CONF['info_row']['icons_numbers'];
		$IcnArr['proc'] 			= 	array();
		$IcnArr['proc']['*'] 		= 	array('method'=>'clean','param'=>'html');
		$PowerBB->_CONF['template']['while']['IconRows'] = $PowerBB->icon->GetIconList($IcnArr);
	}
	function ModeratorCheck($Row,$username = null)
	{
		global $PowerBB;
        $Mod = false;
		if ($PowerBB->_CONF['member_permission'])
		{
			if ($PowerBB->_CONF['member_row']['usergroup'] == '1'
				or $PowerBB->_CONF['group_info']['vice'])
			{
				$Mod = true;
			}
			else
			{
                if(is_numeric($Row))
				{
				    $ModArr = array();
					if ($username == null)
					{
						$ModArr['username'] = $PowerBB->_CONF['member_row']['username'];
					}
					else
					{
						$ModArr['username'] = $username;
					}
					$ModArr['section_id']	=	$Row;
					$Mod = $PowerBB->moderator->IsModerator($ModArr);
				}
				else
				{
					    $moderators = unserialize($Row);
				       if (is_array($moderators))
						{
						 foreach($moderators as $moderator)
						 {
                           if($PowerBB->_CONF['member_row']['id'] == $moderator['member_id'])
                            {
						      $Mod = true;
						    }
						  }
						}
				}
			}
		}
		else
		{
		$Mod = false;
        }
       return $Mod;
	}
	/**
	 * dont Show error massege jast stop script
	 */
 	function error_stop($no_header = false,$no_style = false)
    {
    	global $PowerBB;
    	if (!$no_header and $no_style)
    	{
    		//$this->ShowHeader();
    	}
  		$this->stop($no_style);
 	}
	/**
	 * Show error massege and stop script
	 */
 	function stop_no_foot($no_style = false)
 	{
 		global $PowerBB;
 		if (!$no_style)
 		{
 			//$PowerBB->template->display('footer');
 		}
 		exit();
 	}
 	function error_no_foot($msg,$no_header = false,$no_style = false)
    {
    	global $PowerBB;
    	if (!$no_header and $no_style)
    	{
    		$this->ShowHeader();
    	}
 		$PowerBB->template->assign('use_style',1);
  		$this->msg($msg,$no_style);
  		$this->stop_no_foot($no_style);
 	}
 	function GetTimezoneSet($timezone)
 	{
 		global $PowerBB;
		// Force PHP 5.3.0+ to take time zone information from OS
		if ($PowerBB->_CONF['info_row']['timeoffset'] != '')
		{
		// Get time zone
		@date_default_timezone_set($timezone);
		}
       return $timezone;
 	}
 	function GetDisplayForums()
 	{
 		global $PowerBB;
        $display_forums_nm = $PowerBB->DB->sql_num_rows($PowerBB->DB->sql_query("SELECT id FROM " . $PowerBB->table['section'] . "  WHERE sec_section<>0"));
	   if ($display_forums_nm == '0')
	   {
		$update = $PowerBB->DB->sql_query("UPDATE " . $PowerBB->table['info'] . " SET value='0' WHERE var_name='last_subject_writer_not_in'");
       }
       else
	   {
         $DisplaSectionInfo = $PowerBB->DB->sql_query("SELECT * FROM " . $PowerBB->table['section'] . " WHERE sec_section<>0");
		  while ($display_forumsInfo = $PowerBB->DB->sql_fetch_array($DisplaSectionInfo))
	       {
		         $display_forums .= '0,'.$display_forumsInfo['id']. ',0';
				$update .= $PowerBB->DB->sql_query("UPDATE " . $PowerBB->table['info'] . " SET value='$display_forums' WHERE var_name='last_subject_writer_not_in'");
	      }
       }
		$PowerBB->_CONF['info_row']['last_subject_writer_not_in'] = @str_ireplace('00,','',$PowerBB->_CONF['info_row']['last_subject_writer_not_in']);
 	}
	 function checkmobile()
	 {
	  global $PowerBB;
		if (@strstr($PowerBB->_SERVER['HTTP_USER_AGENT'],"WebTV")
		or @strstr($PowerBB->_SERVER['HTTP_USER_AGENT'],"AvantGo")
		or @strstr($PowerBB->_SERVER['HTTP_USER_AGENT'],"Blazer")
		or @strstr($PowerBB->_SERVER['HTTP_USER_AGENT'],"PalmOS")
		or @strstr($PowerBB->_SERVER['HTTP_USER_AGENT'],"lynx")
		or @strstr($PowerBB->_SERVER['HTTP_USER_AGENT'],"Go.Web")
		or @strstr($PowerBB->_SERVER['HTTP_USER_AGENT'],"Elaine")
		or @strstr($PowerBB->_SERVER['HTTP_USER_AGENT'],"ProxiNet")
		or @strstr($PowerBB->_SERVER['HTTP_USER_AGENT'],"ChaiFarer")
		or @strstr($PowerBB->_SERVER['HTTP_USER_AGENT'],"Digital Paths")
		or @strstr($PowerBB->_SERVER['HTTP_USER_AGENT'],"UP.Browser")
		or @strstr($PowerBB->_SERVER['HTTP_USER_AGENT'],"Mazingo")
		or @strstr($PowerBB->_SERVER['HTTP_USER_AGENT'],"iPhone")
		or @strstr($PowerBB->_SERVER['HTTP_USER_AGENT'],"iPod")
		or @strstr($PowerBB->_SERVER['HTTP_USER_AGENT'],"Mobile")
		or @strstr($PowerBB->_SERVER['HTTP_USER_AGENT'],"T68")
		or @strstr($PowerBB->_SERVER['HTTP_USER_AGENT'],"Syncalot")
		or @strstr($PowerBB->_SERVER['HTTP_USER_AGENT'],"Danger")
		or @strstr($PowerBB->_SERVER['HTTP_USER_AGENT'],"Symbian")
		or @strstr($PowerBB->_SERVER['HTTP_USER_AGENT'],"Symbian OS")
		or @strstr($PowerBB->_SERVER['HTTP_USER_AGENT'],"SymbianOS")
		or @strstr($PowerBB->_SERVER['HTTP_USER_AGENT'],"Maemo")
		or @strstr($PowerBB->_SERVER['HTTP_USER_AGENT'],"Nokia")
		or @strstr($PowerBB->_SERVER['HTTP_USER_AGENT'],"Xiino")
		or @strstr($PowerBB->_SERVER['HTTP_USER_AGENT'],"AU-MIC")
		or @strstr($PowerBB->_SERVER['HTTP_USER_AGENT'],"EPOC")
		or @strstr($PowerBB->_SERVER['HTTP_USER_AGENT'],"Wireless")
		or @strstr($PowerBB->_SERVER['HTTP_USER_AGENT'],"Handheld")
		or @strstr($PowerBB->_SERVER['HTTP_USER_AGENT'],"Smartphone")
		or @strstr($PowerBB->_SERVER['HTTP_USER_AGENT'],"SAMSUNG")
		or @strstr($PowerBB->_SERVER['HTTP_USER_AGENT'],"J2ME")
		or @strstr($PowerBB->_SERVER['HTTP_USER_AGENT'],"MIDP")
		or @strstr($PowerBB->_SERVER['HTTP_USER_AGENT'],"MIDP-2.0")
		or @strstr($PowerBB->_SERVER['HTTP_USER_AGENT'],"320x240")
		or @strstr($PowerBB->_SERVER['HTTP_USER_AGENT'],"240x320")
		or @strstr($PowerBB->_SERVER['HTTP_USER_AGENT'],"Blackberry8700")
		or @strstr($PowerBB->_SERVER['HTTP_USER_AGENT'],"Opera Mini")
		or @strstr($PowerBB->_SERVER['HTTP_USER_AGENT'],"NetFront")
		or @strstr($PowerBB->_SERVER['HTTP_USER_AGENT'],"Android")
		or @strstr($PowerBB->_SERVER['HTTP_USER_AGENT'],"webOS")
		or @strstr($PowerBB->_SERVER['HTTP_USER_AGENT'],"BlackBerry")
		or @strstr($PowerBB->_SERVER['HTTP_USER_AGENT'],"LG-")
		or @strstr($PowerBB->_SERVER['HTTP_USER_AGENT'],"OperaMobi")
		or @strstr($PowerBB->_SERVER['HTTP_USER_AGENT'],"IEMobile")
		or @strstr($PowerBB->_SERVER['HTTP_USER_AGENT'],"Jasmine")
		or @strstr($PowerBB->_SERVER['HTTP_USER_AGENT'],"Fennec")
		or @strstr($PowerBB->_SERVER['HTTP_USER_AGENT'],"Minimo")
		or @strstr($PowerBB->_SERVER['HTTP_USER_AGENT'],"MOT-")
		or @strstr($PowerBB->_SERVER['HTTP_USER_AGENT'],"Polaris")
		or @strstr($PowerBB->_SERVER['HTTP_USER_AGENT'],"Mobile")
		or @strstr($PowerBB->_SERVER['HTTP_USER_AGENT'],"iPad")
		or @strstr($PowerBB->_SERVER['HTTP_USER_AGENT'],"nokia")
		or @strstr($PowerBB->_SERVER['HTTP_USER_AGENT'],"mobile"))
		{
	     if (empty($PowerBB->_COOKIE[$PowerBB->_CONF['style_cookie']]))
	       {
	        // Get mobile styleid
			$StyleArr 			= 	array();
			$StyleArr['where'] 	= 	array('id',$PowerBB->_CONF['info_row']['mobile_style_id']);
			$mobile_styleid = $PowerBB->core->GetInfo($StyleArr,'style');
	        // Change style for phones AGENT and bots AGENT
			if ($mobile_styleid)
	         {
	         /*
              	$MemberUpdateArr                =   array();
				$MemberUpdateArr['field']      =   array();
				$MemberUpdateArr['field']['style'] = $mobile_styleid['id'];
				if ($PowerBB->_CONF['member_permission'])
				{
				   $MemberUpdateArr['where'] = array('id',$PowerBB->_CONF['member_row']['id']);
				   $change = $PowerBB->member->UpdateMember($MemberUpdateArr);
					@setcookie("PowerBB_style", $mobile_styleid['id'], time()+3600);
				}
				else
				{
					@setcookie('PowerBB_style',$mobile_styleid['id'],time()+3600);
				}
                */
                @setcookie('PowerBB_style',$mobile_styleid['id'],time()+3600);
		       	$mobile_styleid['image_path']= str_replace('../','',$mobile_styleid['image_path']);
				$mobile_styleid['style_path']= str_replace('../','',$mobile_styleid['style_path']);
				$PowerBB->template->assign('image_path',$_VARS['path'] . $mobile_styleid['image_path']);
				$PowerBB->template->assign('style_path',$_VARS['path'] . $mobile_styleid['style_path']);
				$PowerBB->template->assign('style_id',$mobile_styleid['id']);
				$PowerBB->template->assign('style_title',$mobile_styleid['style_title']);
				$PowerBB->_CONF['rows']['style']['id'] = $mobile_styleid['id'];
				$PowerBB->template->assign('is_mobile',1);
              return $mobile_styleid['id'];
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
        else
        {
         return false;
        }
	  }
	function is_bot()
	{
 		global $PowerBB;
	    $agent = $PowerBB->_SERVER['HTTP_USER_AGENT'];
	    $list_agent = explode(",",$PowerBB->_CONF['info_row']['search_engine_spiders']);
		for ($i=0;$i<count($list_agent);$i++)
		{
			if (@strstr($agent,$list_agent[$i]))
			{
			  return 1;
			}
		}
		return 0;
	}
	function bot_name()
	{
 		global $PowerBB;
	    $agent = $PowerBB->_SERVER['HTTP_USER_AGENT'];
	    $list_agent = explode(",",$PowerBB->_CONF['info_row']['search_engine_spiders']);
	 for ($i=0;$i<count($list_agent);$i++)
	 {
	   if (@strstr($agent,$list_agent[$i]))
	   {
	   	 return $list_agent[$i];
	   }
	 }
	   return;
    }
    function change_style($Style)
    {
        global $PowerBB;
          if (empty($PowerBB->_COOKIE[$PowerBB->_CONF['style_cookie']]))
          {
			$StyleArr                =   array();
			$StyleArr['field']      =   array();
			$StyleArr['field']['style'] = $Style;
			if ($PowerBB->_CONF['member_permission'])
			{
			   $StyleArr['where'] = array('id',$PowerBB->_CONF['member_row']['id']);
			   $change = $PowerBB->member->UpdateMember($StyleArr);
				@setcookie("PowerBB_style", $Style, time()+3600);
		        @header("location: ".$PowerBB->_SERVER['HTTP_REFERER']."");
			}
			else
			{
				@setcookie('PowerBB_style',$Style,time()+3600);
		        @header("location: ".$PowerBB->_SERVER['HTTP_REFERER']."");
			}
           }
       return;
    }
 	/**
 	 *Update Section Cache ;)
 	 */
	function UpdateSectionCache($SectionCache)
 	{
     global $PowerBB;
		// The number of section's replys number
		$reply_num = $PowerBB->DB->sql_num_rows($PowerBB->DB->sql_query("SELECT id FROM " . $PowerBB->table['reply'] . " WHERE section = '$SectionCache' "));
		$UpdateArr 					= 	array();
		$UpdateArr['field']			=	array();
		$UpdateArr['field']['reply_num'] 	= 	$reply_num;
		$UpdateArr['where']					= 	array('id',$SectionCache);
		$UpdateReplyNumber = $PowerBB->core->Update($UpdateArr,'section');
		// The number of section's subjects number
		$subject_nm = $PowerBB->DB->sql_num_rows($PowerBB->DB->sql_query("SELECT id FROM " . $PowerBB->table['subject'] . " WHERE section = '$SectionCache' AND delete_topic<>1"));
		// The number of section's subjects number
		$UpdateArr 					= 	array();
		$UpdateArr['field']			=	array();
		$UpdateArr['field']['subject_num'] 	= 	$subject_nm;
		$UpdateArr['where']					= 	array('id',$SectionCache);
		$UpdateSubjectNumber = $PowerBB->core->Update($UpdateArr,'section');
		$GetLastqueryReplyForm = $PowerBB->DB->sql_query("SELECT * FROM " . $PowerBB->table['reply'] . " WHERE section = '$SectionCache' AND delete_topic<>1 AND review_reply<>1 ORDER by write_time DESC LIMIT 0 , 30");
		$GetLastReplyForm = $PowerBB->DB->sql_fetch_array($GetLastqueryReplyForm);
		$GetLastSubjectInfoQuery = $PowerBB->DB->sql_query("SELECT * FROM " . $PowerBB->table['subject'] . " WHERE section = '$SectionCache' AND delete_topic<>1 AND review_subject<>1 ORDER by native_write_time DESC LIMIT 0 , 30 ");
		$GetLastSubjectInf = $PowerBB->DB->sql_fetch_array($GetLastSubjectInfoQuery);
        if ($PowerBB->_GET['page'] != 'new_topic')
        {
		 if($GetLastReplyForm['write_time'] > $GetLastSubjectInf['native_write_time'])
		 {
			$GetSubjectInfoQuery = $PowerBB->DB->sql_query("SELECT * FROM " . $PowerBB->table['subject'] . " WHERE id = '".$GetLastReplyForm['subject_id']."' AND delete_topic<>1 AND review_subject<>1 ");
			$SubjectInf = $PowerBB->DB->sql_fetch_array($GetSubjectInfoQuery);
			// Get info subject
			$last_subjectid = $GetLastReplyForm['subject_id'];
			$icon = $SubjectInf['icon'];
			$last_reply = $SubjectInf['last_reply'];
			$last_berpage_nm = $SubjectInf['last_berpage_nm'];
			$last_writer = $SubjectInf['last_replier'];
			$title = $SubjectInf['title'];
			$last_date = $SubjectInf['write_time'];
		 }
		 else
		 {
			// Get info subject
			$last_subjectid = $GetLastSubjectInf['id'];
			$icon = $GetLastSubjectInf['icon'];
			$last_reply = $GetLastSubjectInf['last_reply'];
			$last_berpage_nm = $GetLastSubjectInf['last_berpage_nm'];
			$last_writer = $GetLastSubjectInf['writer'];
			$title = $GetLastSubjectInf['title'];
			$last_date = $GetLastSubjectInf['write_time'];
		 }
		}
        if ($PowerBB->_GET['page'] == 'new_topic')
        {
			// Get info subject
			$last_subjectid = $GetLastSubjectInf['id'];
			$icon = $GetLastSubjectInf['icon'];
			$last_reply = $GetLastSubjectInf['last_reply'];
			$last_berpage_nm = $GetLastSubjectInf['last_berpage_nm'];
			$last_writer = $GetLastSubjectInf['writer'];
			$title = $GetLastSubjectInf['title'];
			$last_date = $GetLastSubjectInf['native_write_time'];
		}
 		// Get Section Info
		$SecArr 			= 	array();
		$SecArr['where'] 	= 	array('id',$SectionCache);
		$this->SectionInfo = $PowerBB->core->GetInfo($SecArr,'section');
		if ($subject_nm == 0)
		{
	 		// Get Section Info
			$SecParenreplytArr = $PowerBB->DB->sql_query("SELECT * FROM " . $PowerBB->table['section'] . " WHERE parent='$SectionCache' AND review_subject<>1 ORDER by last_time DESC LIMIT 0 , 30 ");
			$this->ParentsInfo = $PowerBB->DB->sql_fetch_array($SecParenreplytArr);
			$CacheArr 			= 	array();
			$CacheArr['where'] 	= 	array('section_id',$SectionCache);
			$cache = $PowerBB->moderator->CreateModeratorsCache($CacheArr);
			if($this->ParentsInfo['last_writer'] !='')
			{
				// Update Last subject's information in Section Form
				$UpdateLastFormSecArr = array();
				$UpdateLastFormSecArr['field']			=	array();
				$UpdateLastFormSecArr['field']['last_writer'] 		= 	$this->ParentsInfo['last_writer'];
				$UpdateLastFormSecArr['field']['last_subject'] 		= 	$this->ParentsInfo['last_subject'];
				$UpdateLastFormSecArr['field']['last_subjectid'] 	= 	$this->ParentsInfo['last_subjectid'];
				$UpdateLastFormSecArr['field']['last_date'] 	= 	$this->ParentsInfo['last_date'];
				$UpdateLastFormSecArr['field']['last_time'] 	= 	$this->ParentsInfo['last_time'];
				$UpdateLastFormSecArr['field']['icon'] 		    = 	$this->ParentsInfo['icon'];
			    $UpdateLastFormSecArr['field']['moderators'] 		    = 	$cache;
				$UpdateLastFormSecArr['field']['last_reply'] 	= 	$this->ParentsInfo['last_reply'];
				$UpdateLastFormSecArr['field']['last_berpage_nm']  = 	$this->ParentsInfo['last_berpage_nm'];
			    $UpdateLastFormSecArr['field']['replys_review_num']  = 	$this->ParentsInfo['replys_review_num'];
			    $UpdateLastFormSecArr['field']['subjects_review_num']  = 	$this->ParentsInfo['subjects_review_num'];
				$UpdateLastFormSecArr['where'] 		        = 	array('id',$SectionCache);
				// Update Last Form Sec subject's information
				$UpdateLastFormSec = $PowerBB->core->Update($UpdateLastFormSecArr,'section');
			}
			else
			{
				// Update Last subject's information in Section Form
				$UpdateLastFormSecArr = array();
				$UpdateLastFormSecArr['field']			=	array();
				$UpdateLastFormSecArr['field']['last_writer'] 		= 	'';
				$UpdateLastFormSecArr['field']['last_subject'] 		= 	'';
				$UpdateLastFormSecArr['field']['last_subjectid'] 	= 	'';
				$UpdateLastFormSecArr['field']['last_date'] 	= 	'';
				$UpdateLastFormSecArr['field']['last_time'] 	= 	'';
				$UpdateLastFormSecArr['field']['icon'] 		    = 	'';
				$UpdateLastFormSecArr['field']['last_reply'] 	= 	0;
				$UpdateLastFormSecArr['field']['last_berpage_nm']  = 	0;
			    $UpdateLastFormSecArr['field']['replys_review_num']  = 	0;
			    $UpdateLastFormSecArr['field']['subjects_review_num']  = 	0;
				$UpdateLastFormSecArr['where'] 		        = 	array('id',$SectionCache);
				// Update Last Form Sec subject's information
				$UpdateLastFormSec = $PowerBB->core->Update($UpdateLastFormSecArr,'section');
			}
		}
		else
		{
		$review_replyNumArr = $PowerBB->DB->sql_num_rows($PowerBB->DB->sql_query("SELECT id FROM " . $PowerBB->table['reply'] . " WHERE section='$SectionCache' and review_reply=1 "));
		$review_subjectNumArr = $PowerBB->DB->sql_num_rows($PowerBB->DB->sql_query("SELECT id FROM " . $PowerBB->table['subject'] . " WHERE section='$SectionCache' and review_subject=1 "));
			$CacheArr 			= 	array();
			$CacheArr['where'] 	= 	array('section_id',$SectionCache);
			$cache = $PowerBB->moderator->CreateModeratorsCache($CacheArr);
		// Update Last subject's information in Section Form
		$UpdateLastFormSecArr = array();
		$UpdateLastFormSecArr['field']			=	array();
		$UpdateLastFormSecArr['field']['last_writer'] 		= 	$last_writer;
		$UpdateLastFormSecArr['field']['last_subject'] 		= 	$title;
		$UpdateLastFormSecArr['field']['last_subjectid'] 	= 	$last_subjectid;
		$UpdateLastFormSecArr['field']['last_date'] 	= 	$last_date;
		$UpdateLastFormSecArr['field']['last_time'] 	= 	$last_date;
		$UpdateLastFormSecArr['field']['icon'] 		    = 	$icon;
		$UpdateLastFormSecArr['field']['moderators'] 		    = 	$cache;
		$UpdateLastFormSecArr['field']['last_reply'] 	= 	$last_reply;
		$UpdateLastFormSecArr['field']['last_berpage_nm']  = 	$last_berpage_nm;
		$UpdateLastFormSecArr['field']['replys_review_num']  = 	$review_replyNumArr;
		$UpdateLastFormSecArr['field']['subjects_review_num']  = 	$review_subjectNumArr;
		$UpdateLastFormSecArr['where'] 		        = 	array('id',$SectionCache);
		// Update Last Form Sec subject's information
		$UpdateLastFormSec = $PowerBB->core->Update($UpdateLastFormSecArr,'section');
	   }
		// Update section's cache
		$UpdateArr 				= 	array();
		$UpdateArr['parent'] 	= 	$this->SectionInfo['parent'];
		$update_cache = $PowerBB->section->UpdateSectionsCache($UpdateArr);
       $PowerBB->functions->PBB_Create_last_posts_cache(0);
		unset($UpdateArr);
       return;
 	}
	function form_simple_input($name, $value="", $size, $color)
	{
		return "<input type='text' name='$name' value='$value' size='$size' class='$color' dir='ltr' style='float: left;'>";
	}
	function start_form($hiddens="", $name='theAdminForm', $js="", $id="")
	{
     global $PowerBB;
		if ( ! $id )
		{
			$id = $name;
		}
		$form = "<form action=".$this->GetForumAdress()." method='post' name='$name' $js id='$id'>";
		if (is_array($hiddens))
		{
			foreach ($hiddens as $v)
			{
				$form .= "\n<input type='hidden' name='{$v[0]}' value='{$v[1]}' />";
			}
		}
		//-----------------------------------------
		// Add in auth key
		//-----------------------------------------
		$form .= "\n<input type='hidden' name='_admin_auth_key' value='".$PowerBB->_POST['_admin_auth_key']."' />";
		return $form;
	}
	function _AllCacheStart()
	{
		global $PowerBB;
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
	     $UpdateSectionCache = $PowerBB->functions->UpdateSectionCache($SecList[$x]['id']);
			$x += 1;
		}
	}
	function _MeterGroupsStart()
	  {
		global $PowerBB;
        $query = $PowerBB->DB->sql_query("SELECT * FROM " . $PowerBB->table['section'] . " ");
        while ($r = $PowerBB->DB->sql_fetch_array($query))
	    {
			$CacheArr 			= 	array();
			$CacheArr['id'] 	= 	$r['id'];
			$cache = $PowerBB->group->UpdateSectionGroupCache($CacheArr);
		 }
	 }
	    /**
	 * Get the Jump Forums List
	 */
	function JumpForumsList()
    {
		global $PowerBB;
		$SecArr 						= 	array();
		$SecArr['get_from']				=	'db';
		$SecArr['proc'] 				= 	array();
		$SecArr['proc']['*'] 			= 	array('method'=>'clean','param'=>'html');
		$SecArr['order']				=	array();
		$SecArr['order']['field']		=	'sort';
		$SecArr['order']['type']		=	'ASC';
		$SecArr['where']				=	array();
		$SecArr['where'][0]['name']		= 	'parent';
		$SecArr['where'][0]['oper']		= 	'=';
		$SecArr['where'][0]['value']	= 	'0';
		// Get main sections
		$catys = $PowerBB->core->GetList($SecArr,'section');
 		////////////
		// Loop to read the information of main sections
		foreach ($catys as $caty)
		{
	       // Get the groups information to know view this section or not
		 if ($PowerBB->functions->section_group_permission($caty['id'],$PowerBB->_CONF['group_info']['id'],'view_section'))
	      {
             // foreach main sections
			$PowerBB->_CONF['template']['foreach']['forumsy_list'][$caty['id'] . '_m'] = $caty;
			unset($sectiongroup);
			@include("cache/forums_cache_".$caty['id'].".php");
			if (!empty($forums_cache))
			{
                $forumsy = unserialize(base64_decode($forums_cache));
					foreach ($forumsy as $forumy)
					{
						//////////////////////////
            		 if ($PowerBB->functions->section_group_permission($forumy['id'],$PowerBB->_CONF['group_info']['id'],'view_section'))
						{
							$forumy['is_sub'] 	= 	0;
							$forumy['sub']		=	'';
							$file_forums_cache =	"cache/forums_cache_".$forumy['id'].".php";
                               if (is_readable($file_forums_cache))
                               {
                                 @include("cache/forums_cache_".$forumy['id'].".php");
                               }
                               if (!empty($forums_cache))
	                           {
									$subs = unserialize(base64_decode($forums_cache));
	                               foreach ($subs as $sub)
									{
									   if ($forumy['id'] == $sub['parent'])
	                                    {
												if (!$forumy['is_sub'])
												{
													$forumy['is_sub'] = 1;
												}
            		                           if ($PowerBB->functions->section_group_permission($sub['id'],$PowerBB->_CONF['group_info']['id'],'view_section'))
											   {
                                                  if ($PowerBB->_GET['page'] == 'forum' && $PowerBB->_GET['show'] == 1 && $PowerBB->_GET['id'] == $sub['id'])
											   	  {
												   $selected = ' selected="selected"';
											      }
											      else
											   	  {
												   $selected = "";
											      }
											      	$forum_url = "index.php?page=forum&amp;show=1&amp;id=";
												    $forumy['sub'] .= ('<option ' .$selected . ' value="'.$PowerBB->functions->rewriterule($forum_url).$sub['id'] . '">--- '  . $sub['title'] . '</option>');
										        }
										  }
					                         ///////////////
									   if ($sub['id'] == $sub['parent'])
	                                    {
										$forumy['is_sub_sub'] 	= 	0;
										$forumy['sub_sub']		=	'';
										  $file_forums_cache =	"cache/forums_cache_".$sub['id'].".php";
			                               if (is_readable($file_forums_cache))
			                               {
			                                 @include("cache/forums_cache_".$sub['id'].".php");
			                               }
		                                   if (!empty($forums_cache))
				                           {
												$subs_sub = unserialize(base64_decode($forums_cache));
				                               foreach ($subs_sub as $sub_sub)
												{
												   if ($sub['id'] != $sub_sub['parent'])
				                                    {
															if (!$forumy['is_sub_sub'])
															{
																$forumy['is_sub_sub'] = 1;
															}
            		                                      if ($PowerBB->functions->section_group_permission($sub_sub['id'],$PowerBB->_CONF['group_info']['id'],'view_section'))
														   {
			                                                  if ($PowerBB->_GET['page'] == 'forum' && $PowerBB->_GET['show'] == 1 && $PowerBB->_GET['id'] == $sub_sub['id'])
														   	  {
															   $selected = ' selected="selected"';
														      }
														      else
														   	  {
															   $selected = "";
														      }
											               	$forum_url = "index.php?page=forum&amp;show=1&amp;id=";
															 $forumy['sub_sub'] .= ('<option ' .$selected . ' value="'.$PowerBB->functions->rewriterule($forum_url).$sub_sub['id'] . '">---- '  . $sub_sub['title'] . '</option>');
													        }
													  }
												 }
										   }
										 }
									 }
								}
							$PowerBB->_CONF['template']['foreach']['forumsy_list'][$forumy['id'] . '_f'] = $forumy;
							unset($groups);
						}// end view forums
		             } // end foreach ($forums)
			  } // end !empty($forums_cache)
		   } // end view section
				unset($SecArr);
				$SecArr = $PowerBB->DB->sql_free_result($SecArr);
		} // end foreach ($cats)
   }
	function range_key($max = 9)
	{
		global $PowerBB;
        $keytmp = rand(0, $max);
	  return $keytmp ;
	}
//	****** Conversion and shorten links ******
//	This setting allows you to change the links
 	function rewriterule($type)
	{
		global $PowerBB;
     if ($PowerBB->_CONF['info_row']['rewriterule'])
 	  {
        if (!defined('IN_ADMIN'))
        {
	   		$type = str_replace("index.php?page=forum&show=1&id=","f",$type);
	   		$type = str_replace("index.php?page=forum&amp;show=1&amp;id=","f",$type);
	   		$type = str_replace("index.php?page=topic&show=1&id=","t",$type);
	   		$type = str_replace("index.php?page=topic&amp;show=1&amp;id=","t",$type);
	   		$type = str_replace("index.php?page=profile&show=1&id=","u",$type);
	   		$type = str_replace("index.php?page=profile&amp;show=1&amp;id=","u",$type);
	   		$type = str_replace("index.php?page=profile&show=1&username=","name-",$type);
	   		$type = str_replace("index.php?page=profile&amp;show=1&amp;username=","name-",$type);
	   		$type = str_replace("index.php?page=print&show=1&id=","p",$type);
	   		$type = str_replace("index.php?page=print&amp;show=1&amp;id=","p",$type);
	   		$type = str_replace("index.php?page=archive","archive.html",$type);
	   		//$type = str_replace("index.php?page=portal&","portal",$type);
	   		$type = str_replace("index.php?page=portal","portal.html",$type);
	   		$type = str_replace("index.php?page=forum_archive&show=1&id=","Af",$type);
	   		$type = str_replace("index.php?page=forum_archive&amp;show=1&amp;id=","Af",$type);
	   		$type = str_replace("index.php?page=topic_archive&show=1&id=","At",$type);
	   		$type = str_replace("index.php?page=topic_archive&amp;show=1&amp;id=","At",$type);
	   		//$type = str_replace("index.php?page=search&index=1","search.html",$type);
	   		//$type = str_replace("index.php?page=search&amp;index=1","search.html",$type);
	   		$type = str_replace("index.php?page=sitemap&subject=1","sitemap.xml",$type);
	   		$type = str_replace("index.php?page=sitemap&amp;subject=1","sitemap.xml",$type);
	   		$type = str_replace("index.php?page=sitemap&section=1&id=","sitemap_forum_",$type);
	   		$type = str_replace("index.php?page=sitemap&amp;section=1&amp;id=","sitemap_forum_",$type);
	   		$type = str_replace("index.php?page=sitemap&sitemaps=1","sitemap.htm",$type);
	   		$type = str_replace("index.php?page=sitemap&amp;sitemaps=1","sitemap.htm",$type);
	   		$type = str_replace("index.php?page=team&show=1","team.html",$type);
	   		$type = str_replace("index.php?page=team&amp;show=1","team.html",$type);
	   		$type = str_replace("index.php?page=misc&rules=1&show=1","rules.html",$type);
	   		$type = str_replace("index.php?page=misc&amp;rules=1&amp;show=1","rules.html",$type);
	   		$type = str_replace("index.php?page=calendar&show=1","calendar.html",$type);
	   		$type = str_replace("index.php?page=calendar&amp;show=1","calendar.html",$type);
	   		$type = str_replace("index.php?page=special_subject&index=1","special_subject.html",$type);
	   		$type = str_replace("index.php?page=special_subject&amp;index=1","special_subject.html",$type);
	   		$type = str_replace("index.php?page=member_list&amp;index=1&amp;show=1","member",$type);
	   		$type = str_replace("index.php?page=member_list&amp;index=1&amp;order=1&amp;order_type=DESC","mem_order_posts",$type);
	   		$type = str_replace("index.php?page=member_list&amp;index=1&amp;order=3&amp;order_type=DESC","mem_order_visit",$type);
	   		$type = str_replace("index.php?page=member_list&amp;index=1&amp;order=2&amp;order_type=DESC","mem_order_reg",$type);
	   		$type = str_replace("index.php?page=member_list&amp;index=1&amp;sort=username&amp;letr=","mem_order_letters",$type);
			$type = str_replace("index.php?page=member_list&index=1&order=1&order_type=DESC","mem_order_posts",$type);
			$type = str_replace("index.php?page=member_list&index=1&order=3&order_type=DESC","mem_order_visit",$type);
			$type = str_replace("index.php?page=member_list&index=1&order=2&order_type=DESC","mem_order_reg",$type);
			$type = str_replace("index.php?page=member_list&index=1&sort=username&letr=","mem_order_letters",$type);
	   		$type = str_replace("index.php?page=member_list&index=1&show=1","member.html",$type);
	   		$type = str_replace("index.php?page=static&index=1","static.html",$type);
	   		$type = str_replace("index.php?page=static&amp;index=1","static.html",$type);
	   		$type = str_replace("index.php?page=latest&today=1","today_subjects",$type);
	   		$type = str_replace("index.php?page=latest&amp;today=1","today_subjects",$type);
	   		$type = str_replace("index.php?page=register&amp;index=1&amp;agree=1","register-agree.html",$type);
	   		$type = str_replace("index.php?page=register&amp;index=1","register.html",$type);
	   		$type = str_replace("index.php?page=login&amp;sign=1","login.html",$type);
	   		$type = str_replace("index.php?page=send&amp;sendmessage=1","contact.html",$type);
			$type = str_replace("index.php?page=rss&amp;subject=1","rss.xml",$type);
			$type = str_replace("index.php?page=rss&subject=1","rss.xml",$type);
			$type = str_replace("index.php?page=rss&amp;section=1&amp;id=","rss_forum_",$type);
			$type = str_replace("index.php?page=rss&section=1&id=","rss_forum_",$type);
            $type = @preg_replace('#href="rss_forum_(.*?)"#i', 'href="rss_forum_$1.xml"', $type);
            $type = @preg_replace('#href="sitemap_forum(.*?)"#i', 'href="sitemap_forum_$1.xml"', $type);

	   	}
      }
	   return $type;
	}
function xml_array($contents, $get_attributes=1, $priority = 'tag')
 {
	     global $PowerBB;
    if(!$contents) return array();
    if(!function_exists('xml_parser_create')) {
        //print "'xml_parser_create()' function not found!";
        return array();
    }
    //Get the XML parser of PHP - PHP must have this module for the parser to work
    $parser = xml_parser_create('');
    xml_parser_set_option($parser, XML_OPTION_TARGET_ENCODING, "UTF-8"); # http://minutillo.com/steve/weblog/2004/6/17/php-xml-and-character-encodings-a-tale-of-sadness-rage-and-data-loss
    xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
    xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
    xml_parse_into_struct($parser, trim($contents), $xml_values);
    xml_parser_free($parser);
    if(!$xml_values) return;//Hmm...
    //Initializations
    $xml_array = array();
    $parents = array();
    $opened_tags = array();
    $arr = array();
    $current = &$xml_array; //Refference
    //Go through the tags.
    $repeated_tag_index = array();//Multiple tags with same name will be turned into an array
    foreach($xml_values as $data) {
        unset($attributes,$value);//Remove existing values, or there will be trouble
        //This command will extract these variables into the foreach scope
        // tag(string), type(string), level(int), attributes(array).
        extract($data);//We could use the array by itself, but this cooler.
        $result = array();
        $attributes_data = array();
        if(isset($value)) {
            if($priority == 'tag') $result = $value;
            else $result['value'] = $value; //Put the value in a assoc array if we are in the 'Attribute' mode
        }
        //Set the attributes too.
        if(isset($attributes) and $get_attributes) {
            foreach($attributes as $attr => $val) {
                if($priority == 'tag') $attributes_data[$attr] = $val;
                else $result['attr'][$attr] = $val; //Set all the attributes in a array called 'attr'
            }
        }
        //See tag status and do the needed.
        if($type == "open") {//The starting of the tag '<tag>'
            $parent[$level-1] = &$current;
            if(!is_array($current) or (!in_array($tag, array_keys($current)))) { //Insert New tag
                $current[$tag] = $result;
                if($attributes_data) $current[$tag. '_attr'] = $attributes_data;
                $repeated_tag_index[$tag.'_'.$level] = 1;
                $current = &$current[$tag];
            } else { //There was another element with the same tag name
                if(isset($current[$tag][0])) {//If there is a 0th element it is already an array
                    $current[$tag][$repeated_tag_index[$tag.'_'.$level]] = $result;
                    $repeated_tag_index[$tag.'_'.$level]++;
                } else {//This section will make the value an array if multiple tags with the same name appear together
                    $current[$tag] = array($current[$tag],$result);//This will combine the existing item and the new item together to make an array
                    $repeated_tag_index[$tag.'_'.$level] = 2;
                    if(isset($current[$tag.'_attr'])) { //The attribute of the last(0th) tag must be moved as well
                        $current[$tag]['0_attr'] = $current[$tag.'_attr'];
                        unset($current[$tag.'_attr']);
                    }
                }
                $last_item_index = $repeated_tag_index[$tag.'_'.$level]-1;
                $current = &$current[$tag][$last_item_index];
            }
        } elseif($type == "complete") { //Tags that ends in 1 line '<tag />'
            //See if the key is already taken.
            if(!isset($current[$tag])) { //New Key
                $current[$tag] = $result;
                $repeated_tag_index[$tag.'_'.$level] = 1;
                if($priority == 'tag' and $attributes_data) $current[$tag. '_attr'] = $attributes_data;
            } else { //If taken, put all things inside a list(array)
                if(isset($current[$tag][0]) and is_array($current[$tag])) {//If it is already an array...
                    // ...push the new element into that array.
                    $current[$tag][$repeated_tag_index[$tag.'_'.$level]] = $result;
                    if($priority == 'tag' and $get_attributes and $attributes_data) {
                        $current[$tag][$repeated_tag_index[$tag.'_'.$level] . '_attr'] = $attributes_data;
                    }
                    $repeated_tag_index[$tag.'_'.$level]++;
                } else { //If it is not an array...
                    $current[$tag] = array($current[$tag],$result); //...Make it an array using using the existing value and the new value
                    $repeated_tag_index[$tag.'_'.$level] = 1;
                    if($priority == 'tag' and $get_attributes) {
                        if(isset($current[$tag.'_attr'])) { //The attribute of the last(0th) tag must be moved as well
                            $current[$tag]['0_attr'] = $current[$tag.'_attr'];
                            unset($current[$tag.'_attr']);
                        }
                        if($attributes_data) {
                            $current[$tag][$repeated_tag_index[$tag.'_'.$level] . '_attr'] = $attributes_data;
                        }
                    }
                    $repeated_tag_index[$tag.'_'.$level]++; //0 and 1 index is already taken
                }
            }
        } elseif($type == 'close') { //End of tag '</tag>'
            $current = &$parent[$level-1];
        }
    }
    return($xml_array);
 }
 function with_comma($int)
 {
	if( is_numeric($int) ){
	$int=(strrev($int));
	preg_match_all("#[0-9]{1,3}#",$int,$m);
	return strrev(implode(',',$m[0]));
	}else{
	return 0;
	}
  }
/**
 * Gzip encodes text to a specified level
 *
 * @param string The string to encode
 * @param int The level (1-9) to encode at
 * @return string The encoded string
 */
function gzip_encode($contents, $level=1)
{
	if(function_exists("gzcompress") && function_exists("crc32") && !headers_sent() && !(ini_get('output_buffering') && $this->my_strpos(' '.ini_get('output_handler'), 'ob_gzhandler')))
	{
		$httpaccept_encoding = '';
		if(isset($_SERVER['HTTP_ACCEPT_ENCODING']))
		{
			$httpaccept_encoding = $_SERVER['HTTP_ACCEPT_ENCODING'];
		}
		if($this->my_strpos(" ".$httpaccept_encoding, "x-gzip"))
		{
			$encoding = "x-gzip";
		}
		if($this->my_strpos(" ".$httpaccept_encoding, "gzip"))
		{
			$encoding = "gzip";
		}
		if(isset($encoding))
		{
			@header("Content-Encoding: $encoding");
			if(function_exists("gzencode"))
			{
				$contents = gzencode($contents, $level);
			}
			else
			{
				$size = strlen($contents);
				$crc = crc32($contents);
				$gzdata = "\x1f\x8b\x08\x00\x00\x00\x00\x00\x00\xff";
				$gzdata .= $this->my_substr(gzcompress($contents, $level), 2, -4);
				$gzdata .= pack("V", $crc);
				$gzdata .= pack("V", $size);
				$contents = $gzdata;
			}
		}
	}
	return $contents;
}
/**
 * Cuts a string at a specified point, mb strings accounted for
 *
 * @param string The string to cut.
 * @param int Where to cut
 * @param int (optional) How much to cut
 * @param bool (optional) Properly handle HTML entities?
 * @return int The cut part of the string.
 */
 function my_substr($string, $start, $length="", $handle_entities = false)
 {
	if($handle_entities)
	{
		$string = $this->unhtmlentities($string);
	}
	if(function_exists("mb_substr"))
	{
		if($length != "")
		{
			$cut_string = mb_substr($string, $start, $length);
		}
		else
		{
			$cut_string = mb_substr($string, $start);
		}
	}
	else
	{
		if($length != "")
		{
			$cut_string = substr($string, $start, $length);
		}
		else
		{
			$cut_string = substr($string, $start);
		}
	}
	if($handle_entities)
	{
		$cut_string = $this->htmlspecialchars_uni($cut_string);
	}
	return $cut_string;
 }
	/**
	 * Custom function for htmlspecialchars which takes in to account unicode
	 *
	 * @param string The string to format
	 * @return string The string with htmlspecialchars applied
	 */
	function htmlspecialchars_uni($message)
	{
		$message = @preg_replace("#&(?!\#[0-9]+;)#si", "&amp;", $message); // Fix & but allow unicode
		$message = str_replace("<", "&lt;", $message);
		$message = str_replace(">", "&gt;", $message);
		$message = str_replace("\"", "&quot;", $message);
		return $message;
	}
	/**
	 * Returns any html entities to their original character
	 *
	 * @param string The string to un-htmlentitize.
	 * @return int The un-htmlentitied' string.
	 */
	function unhtmlentities($string)
	{
		// Replace numeric entities
		$string = @preg_replace('~&#x([0-9a-f]+);~ei', 'unichr(hexdec("\\1"))', $string);
		$string = @preg_replace('~&#([0-9]+);~e', 'unichr("\\1")', $string);
		// Replace literal entities
		$trans_tbl = get_html_translation_table(HTML_ENTITIES);
		$trans_tbl = array_flip($trans_tbl);
		return strtr($string, $trans_tbl);
	}
	/**
	 * Finds a needle in a haystack and returns it position, mb strings accounted for
	 *
	 * @param string String to look in (haystack)
	 * @param string What to look for (needle)
	 * @param int (optional) How much to offset
	 * @return int false on needle not found, integer position if found
	 */
	function my_strpos($haystack, $needle, $offset=0)
	{
		if($needle == '')
		{
			return false;
		}
		if(function_exists("mb_strpos"))
		{
			$position = mb_strpos($haystack, $needle, $offset);
		}
		else
		{
			$position = strpos($haystack, $needle, $offset);
		}
		return $position;
	}
 // slurp all enabled feeds from the database
	function _RunFeedRss()
	{
     	 global $PowerBB;
	   include('includes/FeedParser.php');
		$feeds_result = $PowerBB->DB->sql_query("SELECT * FROM " . $PowerBB->table['feeds'] . " WHERE options = '1'");
		while ($FeedsInfo = $PowerBB->DB->sql_fetch_array($feeds_result))
		{
		    if ($FeedsInfo['feeds_time'] < $PowerBB->_CONF['now'] - $FeedsInfo['ttl'])
		    {
				$this->FeedParser	  	= 	new FeedParser;
				$this->FeedParser->parse($FeedsInfo['rsslink']);
				$Items	= $this->FeedParser->getItems();
			   if ($Items)
				{
						$x = 0;
						$y = $x++;
					      foreach($Items as $Item)
					      {
							$find = "{rss:link}";
							if(@stristr($FeedsInfo['text'],$find))
							{
							$LINK = "\n\n [url=".$Item['LINK']."]".$PowerBB->_CONF['template']['_CONF']['lang']['the_original_topic']."[/url]";
							}else{
							$LINK = "";
							}
							// $bad_characters: All ASCII characters below ASCII 32 (except 9, 10 and 13 (tab, newline and carrige return)).
							$bad_characters = array_diff(range(chr(0), chr(31)), array(chr(9), chr(10), chr(13)));
							$text = $Item['CONTENT:ENCODED'].$LINK;
							$text = str_replace($bad_characters, "", $text);
							$Item['TITLE'] = str_replace($bad_characters, "", $Item['TITLE']);
		                    $Item['TITLE'] 	= 	$PowerBB->functions->CleanVariable($Item['TITLE'],'html');
		                    $Item['TITLE'] 	= 	$PowerBB->functions->CleanVariable($Item['TITLE'],'sql');
		                   	$section = $FeedsInfo['forumid'];
		                    $section 	= 	$PowerBB->functions->CleanVariable($section,'intval');
							$ItemTitle	=	$Item['TITLE'];
							// Make sure that the topic does not exist before
							$exist_query = $PowerBB->DB->sql_query("SELECT * FROM " . $PowerBB->table['subject'] . " WHERE title LIKE '%$ItemTitle%'");
							$exist_row   = $PowerBB->DB->sql_fetch_array($exist_query);
							if (!$exist_row)
							{
							    $MemberArr 			= 	array();
								$MemberArr['where'] 	= 	array('id',$FeedsInfo['userid']);
								$MemberInfo = $PowerBB->core->GetInfo($MemberArr,'member');
								$section = $FeedsInfo['forumid'];
								$SubjectArr	=	array();
								$SubjectArr['field']	=	array();
								$SubjectArr['field']['title']	=	$Item['TITLE'];
								$SubjectArr['field']['text']	=	$text;
								$SubjectArr['field']['writer']	=	$MemberInfo['username'];
								$SubjectArr['field']['write_time'] 			= 	$PowerBB->_CONF['now'];
								$SubjectArr['field']['native_write_time'] 	= 	$PowerBB->_CONF['now'];
								$SubjectArr['field']['icon'] 				= 	'look/images/icons/i1.gif';
								$SubjectArr['field']['section']	=	$FeedsInfo['forumid'];
								$Insert = $PowerBB->subject->InsertSubject($SubjectArr);
								// The overall number of Member posts
								$posts = $MemberInfo['posts'] + 1;
								$MemberArr 				= 	array();
								$MemberArr['field'] 	= 	array();
								$MemberArr['field']['posts']			=	$posts;
								$MemberArr['field']['lastpost_time'] 	=	$PowerBB->_CONF['now'];
								$MemberArr['where']						=	array('id',$MemberInfo['id']);
								$UpdateMember = $PowerBB->member->UpdateMember($MemberArr);
                            }
								$x++;
						   if($x==$y) break;
						}
						// Update section's cache
                        $UpdateSectionCache = $PowerBB->functions->UpdateSectionCache($FeedsInfo['forumid']);
						// Update last feeds time
                        $feeds_time = $PowerBB->_CONF['now'];
						$feeds_id = $FeedsInfo['id'];
						$UpdateFeeds = $PowerBB->DB->sql_query("UPDATE " . $PowerBB->table['feeds'] . " SET feeds_time ='$feeds_time' where id = '$feeds_id'");
                       // Update last posts cache
				}
            }
         }
		//////////
		if (($current_memory_limit = $PowerBB->functions->size_to_bytes(@ini_get('memory_limit'))) < 128 * 1024 * 1024 AND $current_memory_limit > 0)
		{
			@ini_set('memory_limit', 128 * 1024 * 1024);
		}
		@set_time_limit(0);
   }
     // Visitor Today number
	function visitor_today_number()
	{
		global $PowerBB;
		  if ($PowerBB->_CONF['info_row']['show_online_list_today'])
		  {
		      if (!$PowerBB->_COOKIE[$PowerBB->_CONF['today_cookie']])
		  	  {
				@setcookie("PowerBB_today_date",$PowerBB->_CONF['date'], time()+3600*24);
				$number = $PowerBB->_CONF['info_row']['today_number_cache'] + 1;
				$PowerBB->info->UpdateInfo(array('value'=>$number,'var_name'=>'today_number_cache'));
			  }
		  }
          /////
	}
	function get_fetch_hooks($place_of_hook)
	{
		global $PowerBB;
		if (!empty($place_of_hook))
		{
	      if($PowerBB->DISABLE_HOOKS)
	      {
				if (!defined('INSTALL'))
				{
                     $url = ("cache/HooksCache.php");
                    if (!is_readable($url))
					{
					 $url = ("../cache/HooksCache.php");
					}
						@include($url);
						$Hooks_number = sizeof($Hooks, 1);
						if($Hooks_number > 0)
						{
							for ($x = 0; $x < $Hooks_number; $x++)
							{
                               if($Hooks[$place_of_hook][$x])
                               {
									$Hooksquery = $PowerBB->DB->sql_query("SELECT * FROM " . $PowerBB->table['hooks'] . " WHERE main_place = '$place_of_hook' ");
									while ($Hooks = $PowerBB->DB->sql_fetch_array($Hooksquery))
									{
									$Hooks['phpcode'] = str_replace("{sq}","'", $Hooks['phpcode']);
									$Hooks['phpcode'] = str_replace("\'","'", $Hooks['phpcode']);
									return ($Hooks['phpcode']);
									}
                               }
							}
						 }
	              }
		  }
       }
	}
	function get_hooks($place_of_hook)
	{
		global $PowerBB;
		if (!empty($place_of_hook))
		{
	      if($PowerBB->DISABLE_HOOKS)
	      {
				if (!defined('INSTALL'))
				{
                   $url = ("cache/HooksCache.php");
                    if (!is_readable($url))
					{
					 $url = ("../cache/HooksCache.php");
					}
						@include($url);
						$Hooks_number = sizeof($Hooks, 1);
						if($Hooks_number > 0)
						{
							for ($x = 0; $x < $Hooks_number; $x++)
							{
								$Hooks[$place_of_hook][$x] = str_replace("\'","'", $Hooks[$place_of_hook][$x]);
								eval($Hooks[$place_of_hook][$x]);
							}
						}
	              }
		  }
       }
	}
	function size_to_bytes($value)
	{
		$value = trim($value);
		$retval = intval($value);
		switch(strtolower($value[strlen($value) - 1]))
		{
			case 'g':
				$retval *= 1024;
				/* break missing intentionally */
			case 'm':
				$retval *= 1024;
				/* break missing intentionally */
			case 'k':
				$retval *= 1024;
				break;
		}
		return $retval;
	}
	function pbb_stripslashes($string)
	{
			// Convert quotes
		if (phpversion() >= '5.4.0')
		{
		  if (get_magic_quotes_gpc())
		   {
		     return ($string);
		   }
		  else
		  {
		    return @stripslashes($string);
		  }
		}
		elseif (phpversion() <= '5.4.0')
		{
		  if (phpversion() <= '5.3.0')
		  {
			  if (get_magic_quotes_gpc())
			   {
			    return @stripslashes($string);
			   }
			  else
			  {
			     return ($string);
			  }
		  }
		  else
		  {
			  if (get_magic_quotes_gpc())
			   {
				  return ($string);
			   }
			  else
			  {
			    return @stripslashes($string);
			  }
		  }
		}
	}
	function get_hooks_template($place_of_hook)
	{
		global $PowerBB;
		if (!empty($place_of_hook))
		{
	      if($PowerBB->DISABLE_HOOKS)
	      {
				if (!defined('INSTALL'))
				{
				   $url = ("cache/HooksCache.php");
                    if (!is_readable($url))
					{
					 $url = ("../cache/HooksCache.php");
					}
						@include($url);
						$Hooks_number = sizeof($Hooks, 1);
						if($Hooks_number > 0)
						{
                            for ($x = 0; $x < $Hooks_number; $x++)
                            {
								$Hooks[$place_of_hook][$x] = str_replace("\'","'", $Hooks[$place_of_hook][$x]);
                                @eval(" ?> ".$Hooks[$place_of_hook][$x]." <?php ");
							}
						}
	              }
		  }
	   }
	}
	function PBB_Create_last_posts_cache($cache_long)
	{
		global $PowerBB;
		$cache_time = $PowerBB->_CONF['info_row']['last_time_cache'];
		$cache = $PowerBB->_CONF['info_row']['last_posts_cache'];
		$Now= $PowerBB->_CONF['now'];
		$cache_end = $cache_time+($cache_long*60);
		if(!$cache || ($cache_end < $Now))
		{
		$last_posts_cache 							= 	array();
		// Order data
		$last_posts_cache['order'] 				= 	array();
		$last_posts_cache['order']['field'] 	= 	'write_time';
		$last_posts_cache['order']['type'] 		= 	'DESC';
		// Ten rows only
        $last_posts_cache['where'][1] 			= 	array();
		$last_posts_cache['where'][1]['con']		=	'AND';
		$last_posts_cache['where'][1]['name'] 	= 	'review_subject<>1 AND sec_subject<>1 AND delete_topic';
		$last_posts_cache['where'][1]['oper'] 	= 	'<>';
		$last_posts_cache['where'][1]['value'] 	= 	'1';
		$Createcache = $PowerBB->core->Create_last_posts_cache($last_posts_cache,$Now,$PowerBB->_CONF['info_row']['lasts_posts_bar_num']);
		}
       return ($Createcache) ? true : false;
    }
   	function copyright()
	{
	   global $PowerBB;
        $Version = 'Version '. $PowerBB->_CONF['info_row']['MySBB_version'];
    	$copy = 'Powered by <a target="_blank" href="https://www.pbboard.info">PBBoard</a> ©' .$Version;
		return $copy;
	}
	function Update_Cache_groups()
	{
	   global $PowerBB;
		$info_query_groups = $PowerBB->DB->sql_query("SELECT * FROM " . $PowerBB->table['group'] . " ");
		while ($groups = $PowerBB->DB->sql_fetch_array($info_query_groups))
		{
		$CacheGroupArr 			= 	array();
		$CacheGroupArr['id'] 	= 	$groups['id'];
		$Update_Group_Cache = $PowerBB->group->UpdateGroupCache($CacheGroupArr);
		}
	}
	function get_column_names($table_name)
	{
       		global $PowerBB;
	    $query = "SHOW COLUMNS FROM {$table_name}";
	    if(($result=$PowerBB->DB->sql_query($query)))
	     {
	        /* Store the column names retrieved in an array */
	        $column_names = array();
	        while ($row = $PowerBB->DB->sql_fetch_array($result))
	        {
	            $column_names[] = $row['Field'];
	        }
	        return $column_names;
	    }
	    else
	    {
	        return false;
	     }
	}
  	function GetCachedCustom_bbcode()
	{
	   global $PowerBB;
 		$cache = $PowerBB->_CONF['info_row']['custom_bbcodes_list_cache'];
		$cache = unserialize($cache);
        $cache = str_replace("&#39;","'",$cache);
		return $cache;
	}
  	function get_cache_permissions_group_id_numbr($param)
	{
	   global $PowerBB;
      $file_group_cache = "cache/group_cache".$param.".php";
	  if (file_exists($file_group_cache))
	    {
			@include("cache/group_cache".$param.".php");
			$Group = unserialize(base64_decode($group_cache));
	      	$permissions = $Group[$param];
			return $permissions;
		}
		else
		{
            $CacheArr 			= 	array();
			$CacheArr['id'] 	= 	$param;
			$cache = $PowerBB->group->UpdateGroupCache($CacheArr);
			$GrpArr 			= 	array();
			$GrpArr['where'] 	= 	array('id',$param);
			$permissions = $PowerBB->core->GetInfo($GrpArr,'group');
		  return $permissions;
		}
	}
  	function uploadedfile($tmp_name, $path, $filename)
	{
	   global $PowerBB;
    	$copy = move_uploaded_file($tmp_name,$path.$filename);
		return ($copy) ? true : false;
	}
  	function section_group_permission($forum_id, $group_id, $permission_name)
	{
	   global $PowerBB;
        $dir = "cache/sectiongroup_cache".$forum_id.".php";
        if (file_exists($dir))
        {
			@include($dir);
			$groups = unserialize(base64_decode($sectiongroup_cache));
			if (!empty($sectiongroup_cache))
			{
		 		if($PowerBB->_CONF['member_row']['membergroupids'] !='')
		 		{
		 		 $groupids = $group_id.",".$PowerBB->_CONF['member_row']['membergroupids'];
				 $pieces = explode(",", $groupids);
					 if ($groups[$pieces[0]][$permission_name]
					 or $groups[$pieces[1]][$permission_name]
					 or $groups[$pieces[2]][$permission_name]
					 or $groups[$pieces[3]][$permission_name]
					 or $groups[$pieces[4]][$permission_name]
					 or $groups[$pieces[5]][$permission_name]
					 or $groups[$pieces[6]][$permission_name]
					 or $groups[$pieces[7]][$permission_name]
					 or $groups[$pieces[8]][$permission_name]
					 or $groups[$pieces[9]][$permission_name]
					 or $groups[$pieces[10]][$permission_name])
					  {
						 return true;
			          }
			          else
					  {
						 return false;
			          }
				}
		       else
				{
		          $permission = $groups[$group_id][$permission_name];
			      return ($permission) ? true : false;
			    }
			}
			else
			{
               $permission = $PowerBB->functions->_MeterGroupsStart();
               return ($permission) ? true : false;
			}
		}
		else
		{
           $permission = $PowerBB->functions->_MeterGroupsStart();
           return ($permission) ? true : false;
		}
	}
   	function PBBoard_Updates()
	{
	   global $PowerBB;
        $last_Update = $PowerBB->_CONF['info_row']['last_time_updates'];
        $Version = $PowerBB->_CONF['info_row']['MySBB_version'];
        $pbboard_last_time_updates = 'http://www.pbboard.info/check_updates/pbboard_last_time_updates.txt';
      	$last_time_updates = @file_get_contents($pbboard_last_time_updates);
         if(!$last_time_updates)
		 {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $pbboard_last_time_updates);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$last_time_updates = curl_exec($ch);
		 }
         if($last_time_updates)
		 {
	      	$arr = explode('-',$last_time_updates);
	        $last_time     = trim($arr[0]);
			$LatestVersion = trim($arr[1]);
			if($last_Update<$last_time
			and $Version == $LatestVersion)
			{
			$update = '{template}pbboard_updates{/template}';
			}
			else
			{
			 $update = $PowerBB->_CONF['template']['_CONF']['lang']['pbboard_updated'];
			}
		}
		else
		{
		  $update = $PowerBB->_CONF['template']['_CONF']['lang']['failed_connect'];
		}
		return $update;
	}
	function check_version_date()
	{
	   global $PowerBB;
         // Check if this version is up to date
         $LatestVersionUrl = ("http://www.pbboard.info/pbboard_latest_version.txt");
		 $LatestVersionTxt = @file_get_contents($LatestVersionUrl);
         if(!$LatestVersionTxt)
		 {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $LatestVersionUrl);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$LatestVersionTxt = curl_exec($ch);
		 }
		if (!$LatestVersionTxt)
		{
         $PowerBB->_CONF['template']['_CONF']['lang']['failed_connect'] = str_replace("pbboard.com","pbboard.info",$PowerBB->_CONF['template']['_CONF']['lang']['failed_connect']);
		 $Result = $PowerBB->_CONF['template']['_CONF']['lang']['failed_connect'];
		}
		else
		{
			$arr = explode('-',$LatestVersionTxt);
			$LatestVersion     = trim($arr[0]);
			$LatestVersionLink = trim($arr[1]);
			if ( $LatestVersion == $PowerBB->_CONF['info_row']['MySBB_version'])
			{
			$JS_Notification = 0;
			$Result = $PowerBB->_CONF['template']['_CONF']['lang']['version_identical'];
			}
			else
			{
			$JS_Notification = 1;
			$morinfrmosn ="https://www.pbboard.info";
			$Result = $PowerBB->_CONF['template']['_CONF']['lang']['there_is_newer_version1'].$LatestVersion.$PowerBB->_CONF['template']['_CONF']['lang']['there_is_newer_version2'].$morinfrmosn.$PowerBB->_CONF['template']['_CONF']['lang']['there_is_newer_version3'];
			}
		}
        if ( $JS_Notification )
		{
			$Notification = '<script type="text/javascript">
							function VNTimer()
							{
								var BackgroundColor = document.getElementById("Notifyboxr1").bgColor.toLowerCase();
								if(BackgroundColor == \'#f5f8f7\' )
								{
									document.getElementById("Notifyboxr1").bgColor=\'#E0E0E0\';
									document.getElementById("Notifyboxr2").bgColor=\'#E0E0E0\';
							    }
								else
								{
									document.getElementById("Notifyboxr1").bgColor=\'#F5F8F7\';
									document.getElementById("Notifyboxr2").bgColor=\'#F5F8F7\';
								}
							}
							setInterval("VNTimer()",500);
							</script>';
			$PowerBB->template->assign('versionnotification',$Notification);
		}
		return $Result;
	}
  function convert_hex_color()
  {
  	   global $PowerBB;
  	 $RGB = $PowerBB->functions->hex2rgba($PowerBB->_COOKIE['jscolor'],'0.7');
    return ($RGB) ? true : false;
  }
 /* Convert hexdec color string to rgb(a) string */
  function hex2rgba($color, $opacity = false)
  {
	$default = 'rgb(0,0,0)';
	//Return default if no color provided
	if(empty($color))
          return $default;
	//Sanitize $color if "#" is provided
        if ($color[0] == '#' ) {
        	$color = substr( $color, 1 );
        }
        //Check if color has 6 or 3 characters and get values
        if (strlen($color) == 6) {
                $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        } elseif ( strlen( $color ) == 3 ) {
                $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
        } else {
                return $default;
        }
        //Convert hexadec to rgb
        $rgb =  array_map('hexdec', $hex);
        //Check if opacity is set(rgba or rgb)
        if($opacity){
        	if(abs($opacity) > 1)
        		$opacity = 1.0;
        	$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
        } else {
        	$output = 'rgb('.implode(",",$rgb).')';
        }
        //Return rgb(a) color string
        return $output;
  }


	function DoJumpList ($Master,$Url,$Type)
	{
	  global $PowerBB;
		$this->Main =	$this->SetMain($Master);
		$this->Sub	=	$this->SetSub($Master);
		$this->Url	=	$Url;
		$this->Type =	$Type;

		return $this->Build();
	}


	function SetMain($Master)
	{
		global $PowerBB;

		$Main= array();
		for($i=0;$i<sizeof($Master);$i++)

		{
		if($Master[$i]['parent']==0)
		{
		$Main[]=$Master[$i];
		}
		}
		return $Main;
	}

	function SetSub($Master)
	{
		global $PowerBB;

		$Sub = array();
		for($i=0;$i<sizeof($Master);$i++)
		{
		if($Master[$i]['parent']!==0)
		{
		$Sub[]=$Master[$i];
		}
		}
		return $Sub;
	}

	function Build()
	{
		global $PowerBB;

		$Form = "\n<select name=\"section\" id=\"section_id\">\n";
		 $Mn = 1;
		$size = sizeof($this->Main);
		for($i=0;$i<$size;$i++)
		{
			if($this->Main[$i]['parent'] == '0' and $this->Type)
			{
			$Form .= "<option class='row1' disabled='disabled' style=\"color: #FF0000\" value='".$this->Url.$this->Main[$i]['id']."' >".$this->Main[$i]['title']."</option>\n";
			}
			else
			{
			$Form .= "<option class='row1' style=\"color: #FF0000\" value='".$this->Url.$this->Main[$i]['id']."' >".$this->Main[$i]['title']."</option>\n";
			}

		     $Form .= $this->SubList($this->Main[$i]['id'],$Mn);
		if($i<($size-1))
		{
		   if(!$this->Type)
		     {
		     $Form .= "<option> ----------------------------</option>\n";
		     }
		}
		     $Mn++;
		}
		$Form .= "</select>\n";
		//Free Memory
		unset($this->Main);
		unset($this->Sub);
		return $Form;
	}

	function SubList($id,$Mn,$Sn="")
	{
		global $PowerBB;

		$b_id = array();
		$b_title = array();
		for($i=0;$i<sizeof($this->Sub);$i++)
		{
		if($id==$this->Sub[$i]['parent'])
		{
		$b_id[]= $this->Sub[$i]['id'];
		$b_title[] = $this->Sub[$i]['title'];
		}
		}
		if (empty($b_id))
		{
		return;
		} else
		{
		$Sn=1;
		}

		if (count($b_id) > 1 )

		{
		$Form ="";
		for($i=0;$i<sizeof($b_id);$i++)

		{
		$Form .= "<option value=\"".$this->Url.$b_id[$i]."\"> ".$b_title[$i]."</option>\n";
		$Mn2 = $Mn." ".$this->ListType($Sn,$b_title[$i]);
		$Form .=$this->SubList($b_id[$i],$Mn2);
		$Sn++;
		}
		}
		else
		{
		$Form = "<option value=\"".$this->Url.$b_id[0]."\"> ".$b_title[0]."</option>\n";
		$Mn2 = $Mn."  ".$this->ListType($Sn,$b_title[0]);
		$Form .=$this->SubList($b_id[0],$Mn2,$Sn);
		}
		//Free Memory
		unset($b_id);
		unset($b_title);
		return $Form;
	}

	function ListType($Sn,$b_title)
	{
		global $PowerBB;

		if($this->Type>2) $this->Type =1;
		if($this->Type==1)

		{
		return $Sn;
		} else if($this->Type==2)

		{
		return $b_title;
		}
	}


 }
?>