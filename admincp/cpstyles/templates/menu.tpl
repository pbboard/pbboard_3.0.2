<script type="text/javascript" src="../includes/js/jquery.save.js"></script>
<script type="text/javascript" src="../includes/js/jquery.treeview.js"></script>
<script type="text/javascript" src="../includes/js/dev.js"></script>
<table cellspacing="1" width="94%" class="t_style_b" border="0" style="margin-right:1px; padding-right:10px">
<tr valign="top">
<td class="row1" align="center">
<div class="logo-cp"></div></td>
</tr>
</table>
<br />
<table cellspacing="1" width="94%" class="t_style_b" border="0" style="margin-right:1px; padding-right:10px">
<tr valign="top">
<td class="row1">{$lang['welcome']}
{$_CONF['rows']['member_row']['username']}
</td>
</tr>
<tr valign="top">
<td class="row1">
<a href="index.php?page=index&amp;left=1" target="main">
{$lang['home_admin']}
</a></td>
</tr>
<tr valign="top">
<td class="row1">
<a target="_blank" href="../index.php" target="main">
{$lang['home_forum']}
</a>
- <a href="index.php?page=logout" target="_top">
{$lang['logout_admin']}
</a>
</td>
</tr>
<tr valign="top">
<td class="row1">
<a id="expandAll" href="#">{$lang['expand_all']}</a> -
<a id="collapseAll" href="#">{$lang['collapse_all']}</a>
</td>
</tr>
</table>
<div class="pbb-menu">
<ul id="treeview" class="treeview-black">
<!-- action_find_addons_1 -->
{if {$group_info['admincp_option']} == 1}
<br />
<ul><li><span class="headerbar">{$lang['Settings']}
<img border="0" alt="" src="{$admincpdir_cssprefs}/collapse_b.gif" /></span><ul>
<li><a href="index.php?page=options&amp;index=1" target="main">{$lang['mange_forum']}</a></li>
<li><a href="index.php?page=options&amp;human_verification=1&amp;main=1" target="main">{$lang['manage_human_verification']}</a></li>
<li><a href="index.php?page=options&amp;sidebar_list=1&amp;main=1&amp;left=1" target="main">{$lang['sidebar_list_settings']}</a></li>
<!-- action_find_addons_2 -->
<!--
<li><a href="index.php?page=cp_options&amp;index=1" target="main">
{$lang['Settings_for_the_Admin_Control_Panel']}
</a></li>

-->
<!-- action_find_addons_cp -->
</ul>
</li>
</li>
</ul>
{/if}
<!-- action_find_addons_3 -->
{if {$_CONF['rows']['member_row']['usergroup']} == 1}
<?php $PowerBB->functions->get_hooks_template("menu_cp")?>
<br /><ul><li><span class="headerbar">{$lang['portal']}
<img border="0" alt="" src="{$admincpdir_cssprefs}/collapse_b.gif" /></span><ul>
<li><a href="index.php?page=portal&amp;control=1&amp;main=1" target="main">
{$lang['settings_portal']}
</a></li>
<li><a href="index.php?page=portal&amp;add_block=1&amp;main=1" target="main">
{$lang['add_block']}
</a></li>
<li><a href="index.php?page=portal&amp;control_blocks=1&amp;main=1" target="main">
{$lang['control_blocks']}
</a></li>
</ul>
</li>
</li>
</ul>
{/if}
{if {$group_info['admincp_section']} == 1}
<br /><ul>
<li><span class="headerbar">
{$lang['Sections_Mains']}
<img border="0" alt="" src="{$admincpdir_cssprefs}/collapse_b.gif" /></span><ul>

<li><a href="index.php?page=sections&amp;add=1&amp;main=1" target="main">
{$lang['Add_new_Main_section']}
</a></li>
<li><a href="index.php?page=sections&amp;control=1&amp;main=1" target="main">
{$lang['mange_sections']}
</a></li>
</ul>
</li>
</li>
</ul>
<br />
<ul>
<li><span class="headerbar">
{$lang['Forums']}
<img border="0" alt="" src="{$admincpdir_cssprefs}/collapse_b.gif" /></span><ul>
<li><a href="index.php?page=forums&amp;add=1&amp;main=1" target="main">
{$lang['Add_new_Forum']}
</a></li>

<li><a href="index.php?page=forums&amp;control=1&amp;main=1" target="main">
{$lang['mange_Forums']}
</a></li>
</ul>
</li>
</li>
</ul>
{/if}
{if {$group_info['admincp_style']} == 1}
<br />
<ul>
<li><span class="headerbar">
{$lang['styles']}
<img border="0" alt="" src="{$admincpdir_cssprefs}/collapse_b.gif" /></span><ul>
<li>
<a href="index.php?page=style&amp;control=1&amp;main=1" target="main">
{$lang['mange_styles']}
</a></li>
<li><a href="index.php?page=style&amp;add=1&amp;main=1" target="main">
{$lang['add_new_style']}
</a></li>
{if {$group_info['admincp_template']} == 1}
<li><a href="index.php?page=template&amp;control=1&amp;main=1" target="main">
{$lang['mange_templates']}
</a></li>
<li><a href="index.php?page=template&amp;search=1&amp;main=1" target="main">
{$lang['search_templates']}
</a></li>
<li><a href="index.php?page=template&amp;add=1&amp;main=1" target="main">
{$lang['add_new_template']}
</a></li>
{/if}
</ul>
</li>
</li>
</ul>
{/if}
{if {$group_info['admincp_lang']} == 1}
<br />
<ul>
<li><span class="headerbar">
{$lang['langs']}
<img border="0" alt="" src="{$admincpdir_cssprefs}/collapse_b.gif" /></span><ul>
<li><a href="index.php?page=lang&amp;control=1&amp;main=1" target="main">
{$lang['mange_langs']}
</a></li>
<li><a href="index.php?page=lang&amp;control_fieldname=1&amp;main=1" target="main">
{$lang['phrase_manager']}
</a></li>
<li><a href="index.php?page=lang&amp;add=1&amp;main=1" target="main">
{$lang['add_new_lang']}
</a></li>
<li><a href="index.php?page=lang&amp;add_fieldname=1&amp;main=1" target="main">
{$lang['add_new_phrase']}
</a></li>
<li><a href="index.php?page=lang&amp;search_fieldname=1&amp;main=1" target="main">
{$lang['search_in_phrases']}
</a></li>
</ul>
</li>
</li>
</ul>
{/if}
{if {$group_info['admincp_adminads']} == 1}
<br />
<ul>
<li><span class="headerbar">
{$lang['announcement']}
<img border="0" alt="" src="{$admincpdir_cssprefs}/collapse_b.gif" /></span><ul>
<li><a href="index.php?page=announcement&amp;add=1&amp;main=1" target="main">
{$lang['Add_new_announcement']}
</a></li>
<li><a href="index.php?page=announcement&amp;control=1&amp;main=1" target="main">
{$lang['mange_announcement']}
</a></li>
</ul>
</li>
</li>
</ul>
{/if}
{if {$group_info['admincp_adminads']} == 1}
<br />
<ul>
<li><span class="headerbar">
{$lang['Pages']}
<img border="0" alt="" src="{$admincpdir_cssprefs}/collapse_b.gif" /></span><ul>
<li><a href="index.php?page=pages&amp;add=1&amp;main=1" target="main">
{$lang['Add_new_Page']}
</a></li>
<li><a href="index.php?page=pages&amp;control=1&amp;main=1" target="main">
{$lang['mange_Pages']}
</a></li>
</ul>
</li>
</li>
</ul>
{/if}
{if {$group_info['admincp_ads']} == 1}
<br />
<ul>
<li><span class="headerbar">
{$lang['Ads']}
<img border="0" alt="" src="{$admincpdir_cssprefs}/collapse_b.gif" /></span><ul>
<li><a href="index.php?page=ads&amp;add=1&amp;main=1" target="main">
{$lang['Add_new_Ads']}
</a></li>
<li><a href="index.php?page=ads&amp;control=1&amp;main=1" target="main">
{$lang['mange_Ads']}
</a></li>
</ul>
</li>
</li>
</ul><br />
<ul>
<li><span class="headerbar">
{$lang['adsense']}
<img border="0" alt="" src="{$admincpdir_cssprefs}/collapse_b.gif" /></span><ul>
<li><a href="index.php?page=adsense&amp;add=1&amp;main=1" target="main">
{$lang['add_new_adsense']}
</a></li>
<li><a href="index.php?page=adsense&amp;control=1&amp;main=1" target="main">
{$lang['control_adsense']}
</a></li>
</ul>
</li>
</li>
</ul>
{/if}
{if {$group_info['admincp_chat']} == 1}
<br />
<ul>
<li><span class="headerbar">
{$lang['chat']}
<img border="0" alt="" src="{$admincpdir_cssprefs}/collapse_b.gif" /></span><ul>
<li><a href="index.php?page=chat&amp;control=1&amp;main=1" target="main">
{$lang['mange_chat']}
</a></li>
</ul>
</li>
</li>
</ul>
{/if}
{if {$group_info['admincp_member']} == 1}
<br />
<ul>
<li><span class="headerbar">
{$lang['members']}
<img border="0" alt="" src="{$admincpdir_cssprefs}/collapse_b.gif" /></span><ul>
<li><a href="index.php?page=member&amp;add=1&amp;main=1" target="main">
{$lang['Add_new_member']}
</a></li>
<li><a href="index.php?page=member&amp;control=1&amp;main=1" target="main">
{$lang['mange_members']}
</a></li>
<li><a href="index.php?page=member&amp;merge=1&amp;main=1" target="main">
{$lang['merge_members']}
</a></li>
<li><a href="index.php?page=member&amp;active_member=1&amp;main=1" target="main"> {$lang['active_member']}
</a></li>
<li><a href="index.php?page=member&amp;search=1&amp;main=1" target="main">
{$lang['search_members']}
</a></li>
<li><a href="index.php?page=emailsend&amp;mail=1&amp;main=1" target="main">
{$lang['send_email_members']}
</a></li>
<li><a href="index.php?page=pm&amp;send_pm=1&amp;pm=1" target="main">
{$lang['send_pm_members']}
</a></li>
<li><a href="index.php?page=pm&amp;pm=1&amp;main=1" target="main">
{$lang['View_private_messages']}
</a></li>
<li><a href="index.php?page=member&amp;warnings=1&amp;main=1" target="main">
{$lang['View_warnings']}
</a></li>
<li><a href="index.php?page=banned&amp;banning=1&amp;main=1" target="main">
{$lang['banning_ip']}
</a></li>
</ul>
</li>
</li>
</ul>
{/if}
{if {$group_info['admincp_membergroup']} == 1}
<br />
<ul>
<li><span class="headerbar">
{$lang['groups']}
<img border="0" alt="" src="{$admincpdir_cssprefs}/collapse_b.gif" /></span><ul>
<li><a href="index.php?page=groups&amp;add=1&amp;main=1" target="main">
{$lang['Add_new_group']}
</a></li>
<li><a href="index.php?page=groups&amp;control=1&amp;main=1" target="main">
{$lang['mange_groups']}
</a></li>
</ul>
</li>
</li>
</ul>
{/if}
{if {$group_info['admincp_extrafield']} == 1}
<br />
<ul>
<li><span class="headerbar">
{$lang['extrafields']}
<img border="0" alt="" src="{$admincpdir_cssprefs}/collapse_b.gif" /></span><ul>
<li><a href="index.php?page=extrafield&amp;add=1&amp;main=1" target="main">
{$lang['Add_new_extrafield']}
</a></li>
<li><a href="index.php?page=extrafield&amp;control=1&amp;main=1" target="main">
{$lang['mange_extrafields']}
</a></li>
</ul>
</li>
</li>
</ul>
{/if}
{if {$group_info['admincp_membertitle']} == 1}
<br />
<ul>
<li><span class="headerbar">
{$lang['usertitles']}
<img border="0" alt="" src="{$admincpdir_cssprefs}/collapse_b.gif" /></span><ul>
<li><a href="index.php?page=usertitle&amp;add=1&amp;main=1" target="main">
{$lang['Add_new_usertitle']}
</a></li>
<li><a href="index.php?page=usertitle&amp;control=1&amp;main=1" target="main">
{$lang['mange_usertitles']}
</a></li>
</ul>
</li>
</li>
</ul><br />
<ul>
<li><span class="headerbar">
{$lang['userrating']}
<img border="0" alt="" src="{$admincpdir_cssprefs}/collapse_b.gif" /></span><ul>
<li><a href="index.php?page=userrating&amp;add=1&amp;main=1" target="main">
{$lang['add_new_userrating']}
</a></li>
<li><a href="index.php?page=userrating&amp;control=1&amp;main=1" target="main">
{$lang['control_userrating']}
</a></li>
</ul>
</li>
</li>
</ul>
{/if}
{if {$group_info['admincp_admin']} == 1}
<br />
<ul>
<li><span class="headerbar">
{$lang['moderators']}
<img border="0" alt="" src="{$admincpdir_cssprefs}/collapse_b.gif" /></span><ul>
<li><a href="index.php?page=moderators&amp;add=1&amp;main=1" target="main">
{$lang['Add_new_moderator']}
</a></li>
<li><a href="index.php?page=moderators&amp;control=1&amp;main=1" target="main">
{$lang['mange_moderators']}
</a></li>
{if {$group_info['admincp_adminstep']} == 1}
<li><a href="index.php?page=moderators&amp;modaction=1&amp;main=1" target="main">
{$lang['shwo_modaction']}
</a></li>
{/if}
</ul>
</li>
</li>
</ul>
{/if}
{if {$group_info['admincp_subject']} == 1}
<br />
<ul>
<li><span class="headerbar">
{$lang['trash']}
<img border="0" alt="" src="{$admincpdir_cssprefs}/collapse_b.gif" /></span><ul>
<li><a href="index.php?page=trash&amp;subject=1&amp;main=1" target="main">
{$lang['trash_subjects']}
</a></li>
<li><a href="index.php?page=trash&amp;reply=1&amp;main=1" target="main">
{$lang['trash_reply']}
</a></li>
</ul>
</li>
</li>
</ul><br />
<ul>
<li><span class="headerbar">
{$lang['subjects']}
<img border="0" alt="" src="{$admincpdir_cssprefs}/collapse_b.gif" /></span><ul>
<li><a href="index.php?page=subject&amp;close=1&amp;main=1" target="main">
{$lang['subjects_close']}
</a></li>
<li><a href="index.php?page=subject&amp;review=1&amp;main=1" target="main">
{$lang['review_subjects']}
</a></li>
<li><a href="index.php?page=subject&amp;attach=1&amp;main=1" target="main">
{$lang['subjects_attach']}
</a></li>
<li><a href="index.php?page=subject&amp;mass_del=1&amp;main=1" target="main">
{$lang['subjects_del']}
</a></li>
<li><a href="index.php?page=subject&amp;mass_move=1&amp;main=1" target="main">
{$lang['subjects_move']}
</a></li>
<li><a href="index.php?page=subject&amp;deleted_subject=1&amp;main=1" target="main">
{$lang['deleted_subject']}
</a></li>
</ul>
</li>
</li>
</ul>
<br />
<ul>
<li><span class="headerbar">
{$lang['custom_bbcodes']}
<img border="0" alt="" src="{$admincpdir_cssprefs}/collapse_b.gif" /></span><ul>
<li><a href="index.php?page=custom_bbcode&amp;control=1&amp;main=1" target="main">
{$lang['control_custom_bbcodes']}
</a></li>
<li><a href="index.php?page=custom_bbcode&amp;add=1&amp;main=1" target="main">
{$lang['add_custom_bbcode']}
</a></li>
</ul>
</li>
</li>
</ul>
<br />
<ul>
<li><span class="headerbar">
{$lang['feed_rss']}
<img border="0" alt="" src="{$admincpdir_cssprefs}/collapse_b.gif" /></span><ul>
<li><a href="index.php?page=feeder&amp;control=1&amp;main=1" target="main">
{$lang['postr_rss']}
</a></li>
<li><a href="index.php?page=feeder&amp;add=1&amp;main=1" target="main">
{$lang['feed']}
</a></li>
</ul>
</li>
</li>
</ul>
{/if}
{if {$group_info['admincp_multi_moderation']} == 1}
<br />
<ul>
<li><span class="headerbar">
{$lang['multi_moderation']}
<img border="0" alt="" src="{$admincpdir_cssprefs}/collapse_b.gif" /></span><ul>
<li><a href="index.php?page=topic_mod&amp;add=1&amp;main=1" target="main">
{$lang['add_new_multi_moderation']}
</a></li>
<li><a href="index.php?page=topic_mod&amp;control=1&amp;main=1" target="main">
{$lang['mange_multi_moderation']}
</a></li>
</ul>
</li>
</li>
</ul>
{/if}
{if {$group_info['admincp_attach']} == 1}
<br />
<ul>
<li><span class="headerbar">
{$lang['extensions']}
<img border="0" alt="" src="{$admincpdir_cssprefs}/collapse_b.gif" /></span><ul>
<li><a href="index.php?page=extension&amp;add=1&amp;main=1" target="main">
{$lang['add_new_extension']}
</a></li>
<li><a href="index.php?page=extension&amp;control=1&amp;main=1" target="main">
{$lang['mange_extensions']}
</a></li>
<li><a href="index.php?page=extension&amp;search=1&amp;main=1" target="main">
{$lang['search_extension']}
</a></li>
</ul>
</li>
</li>
</ul>
{/if}
{if {$group_info['admincp_smile']} == 1}
<br />
<ul>
<li><span class="headerbar">
{$lang['smiles']}
<img border="0" alt="" src="{$admincpdir_cssprefs}/collapse_b.gif" /></span><ul>
<li><a href="index.php?page=smile&amp;add=1&amp;main=1" target="main">
{$lang['add_new_smile']}
</a></li>
<li><a href="index.php?page=smile&amp;control=1&amp;main=1" target="main">
{$lang['mange_smiles']}
</a></li>
<li><a href="index.php?page=smile&amp;upload_smiles=1&amp;main=1" target="main">
{$lang['upload_smiles']}
</a></li>
</ul>
</li>
</li>
</ul>
{/if}
{if {$group_info['admincp_icon']} == 1}
<br />
<ul>
<li><span class="headerbar">
{$lang['icons']}
<img border="0" alt="" src="{$admincpdir_cssprefs}/collapse_b.gif" /></span><ul>
<li><a href="index.php?page=icon&amp;add=1&amp;main=1" target="main">
{$lang['add_new_icon']}
</a></li>
<li><a href="index.php?page=icon&amp;control=1&amp;main=1" target="main">
{$lang['mange_icons']}
</a></li>
<li><a href="index.php?page=icon&amp;upload_icons=1&amp;main=1" target="main">
{$lang['upload_icons']}
</a></li>
</ul>
</li>
</li>
</ul>
{/if}
{if {$group_info['admincp_avater']} == 1}
<br />
<ul>
<li><span class="headerbar">
{$lang['avatars']}
<img border="0" alt="" src="{$admincpdir_cssprefs}/collapse_b.gif" /></span><ul>
<li><a href="index.php?page=avatar&amp;add=1&amp;main=1" target="main">
{$lang['add_new_avatar']}
</a></li>
<li><a href="index.php?page=avatar&amp;control=1&amp;main=1" target="main">
{$lang['mange_avatars']}
</a></li>
<li><a href="index.php?page=avatar&amp;upload_avatars=1&amp;main=1" target="main">
{$lang['upload_avatars']}
</a></li>
</ul>
</li>
</li>
</ul>
{/if}
{if {$group_info['admincp_emailed']} == 1}
<br />
<ul>
<li><span class="headerbar">
{$lang['Subscriptions_postal']}
<img border="0" alt="" src="{$admincpdir_cssprefs}/collapse_b.gif" /></span><ul>
<li><a href="index.php?page=emailed&amp;main=1" target="main">
{$lang['mange_postal']}
</a></li>
<li><a href="index.php?page=emailed&amp;main_del=1" target="main">
{$lang['Subscriptions_del']}
</a></li>
</ul>
</li>
</li>
</ul>
{/if}
{if {$group_info['admincp_warn']} == 1}
<br />
<ul>
<li><span class="headerbar">
{$lang['warns']}
<img border="0" alt="" src="{$admincpdir_cssprefs}/collapse_b.gif" /></span><ul>
<li><a href="index.php?page=warn&amp;main=1" target="main">
{$lang['View_warns']}
</a></li>
<li>
<a href="index.php?page=warn&amp;del=1" onclick="return confirm('{$lang['confirm']}')" target="main">
{$lang['warn_del']}
</a></li>
</ul>
</li>
</li>
</ul>
{/if}
{if {$group_info['admincp_award']} == 1}
<br />
<ul>
<li><span class="headerbar">
{$lang['awards']}
<img border="0" alt="" src="{$admincpdir_cssprefs}/collapse_b.gif" /></span><ul>
<li><a href="index.php?page=award&amp;add=1&amp;main=1" target="main">
{$lang['add_new_award']}
</a></li>
<li><a href="index.php?page=award&control=1&main=1" target="main">
{$lang['control_awards']}
</a></li>
</ul>
</li>
</li>
</ul>
{/if}
{if {$group_info['admincp_fixup']} == 1}
<br />
<ul>
<li><span class="headerbar">
{$lang['addons_pbb']}
<img border="0" alt="" src="{$admincpdir_cssprefs}/collapse_b.gif" /></span><ul>
<li><a href="index.php?page=addons&amp;add=1&amp;main=1" target="main">
{$lang['add_addons']}
</a></li>
<li><a href="index.php?page=addons&amp;control=1&amp;main=1" target="main">
{$lang['control_addons']}
</a></li>
<!--<li><a href="index.php?page=addons&amp;writing_addon=1&amp;main=1" target="main">
{$lang['writing_addon']}
</a></li>
<li><a href="index.php?page=addons&amp;control_hooks=1&amp;main=1" target="main">
{$lang['control_hooks']}
</a></li>
-->
</ul>
</li>
</li>
</ul>
<br />
<ul>
<li><span class="headerbar">
{$lang['Maintenance']}
<img border="0" alt="" src="{$admincpdir_cssprefs}/collapse_b.gif" /></span><ul>
<li><a href="index.php?page=backup&amp;backup=1&amp;main=1" target="main">
{$lang['backup']}
</a></li>
<li><a href="index.php?page=fixup&amp;repair=1&amp;main=1" target="main">
{$lang['repair']}
</a></li>
<li><a href="index.php?page=sql&amp;sql=1&amp;main=1" target="main">
{$lang['sql']}
</a></li>
<li><a href="index.php?page=fixup&amp;update_meter=1&amp;main=1" target="main">
{$lang['fixup']}
</a></li>
<li><a href="index.php?page=fixup&amp;info=1" target="main">
{$lang['phpinfo']}
</a></li>
</ul>
</li>
</li>
</ul><br />
{/if}
<!-- action_find_addons_4 -->
</ul>
<div id="treecontrol">
<a href="#"></a><a href="#"></a><a href="#"></a>
</div>
</div>