<br />

<div class="address_bar">{$lang['Control_Panel']} &raquo;
<a href="index.php?page=forums&amp;control=1&amp;main=1">{$lang['Forums']}</a> &raquo;
<a href="index.php?page=forums&amp;groups=1&amp;control_group=1&amp;index=1&amp;id={$Inf['id']}">
 {$lang['Control_the_powers_of_the_groups_of_the_Forum']} :
 {$Inf['title']}</a></div>

<br />

<form action="index.php?page=forums&amp;groups=1&amp;control_group=1&amp;start=1&amp;id={$Inf['id']}" method="post">

	{Des::while}{SecGroupList}
	<table width="60%" class="t_style_b" border="0" cellspacing="1" align="center">
		<tr valign="top" align="center">
			<td class="row1" colspan="2">
				<strong>{$SecGroupList['group_name']}</strong>
			</td>
		</tr>
		<tr valign="top">
			<td class="row2">
			{$lang['view_section']}
			</td>
			<td class="row2">
			<label for="groups[{$SecGroupList['group_id']}][view_section]">
			{if {$SecGroupList['view_section']}}
			<input name="groups[{$SecGroupList['group_id']}][view_section]" id="select_view_section" value="1" tabindex="1" checked type="radio">{$lang['yes']}
			<input name="groups[{$SecGroupList['group_id']}][view_section]" id="select_view_section" value="0" tabindex="1" type="radio">{$lang['no']}
			{else}
			<input name="groups[{$SecGroupList['group_id']}][view_section]" id="select_view_section" value="1" tabindex="1" type="radio">{$lang['yes']}
			<input name="groups[{$SecGroupList['group_id']}][view_section]" id="select_view_section" value="0" tabindex="1" checked type="radio">{$lang['no']}
			{/if}
            </label>
			</td>
		</tr>
		<tr valign="top">
			<td class="row1">
			{$lang['view_subject']}
			</td>
			<td class="row1">
			<label for="groups[{$SecGroupList['group_id']}][view_subject]">
			{if {$SecGroupList['view_subject']}}
			<input name="groups[{$SecGroupList['group_id']}][view_subject]" id="select_view_subject" value="1" tabindex="1" checked type="radio">{$lang['yes']}
			<input name="groups[{$SecGroupList['group_id']}][view_subject]" id="select_view_subject" value="0" tabindex="1" type="radio">{$lang['no']}
			{else}
			<input name="groups[{$SecGroupList['group_id']}][view_subject]" id="select_view_subject" value="1" tabindex="1" type="radio">{$lang['yes']}
			<input name="groups[{$SecGroupList['group_id']}][view_subject]" id="select_view_subject" value="0" tabindex="1" checked type="radio">{$lang['no']}
			{/if}
            </label>
			</td>
		</tr>
		<tr valign="top">
			<td class="row2">
			{$lang['download_attach']}
			</td>
			<td class="row2">
			<label for="groups[{$SecGroupList['group_id']}][download_attach]">
			{if {$SecGroupList['download_attach']}}
			<input name="groups[{$SecGroupList['group_id']}][download_attach]" id="select_download_attach" value="1" tabindex="1" checked type="radio">{$lang['yes']}
			<input name="groups[{$SecGroupList['group_id']}][download_attach]" id="select_download_attach" value="0" tabindex="1" type="radio">{$lang['no']}
			{else}
			<input name="groups[{$SecGroupList['group_id']}][download_attach]" id="select_download_attach" value="1" tabindex="1" type="radio">{$lang['yes']}
			<input name="groups[{$SecGroupList['group_id']}][download_attach]" id="select_download_attach" value="0" tabindex="1" checked type="radio">{$lang['no']}
			{/if}
            </label>
			</td>
		</tr>
		<tr valign="top">
			<td class="row1">
			{$lang['upload_attach']}
			</td>
			<td class="row1">
			<label for="groups[{$SecGroupList['group_id']}][upload_attach]">
			{if {$SecGroupList['upload_attach']}}
			<input name="groups[{$SecGroupList['group_id']}][upload_attach]" id="select_upload_attach" value="1" tabindex="1" checked type="radio">{$lang['yes']}
			<input name="groups[{$SecGroupList['group_id']}][upload_attach]" id="select_upload_attach" value="0" tabindex="1" type="radio">{$lang['no']}
			{else}
			<input name="groups[{$SecGroupList['group_id']}][upload_attach]" id="select_upload_attach" value="1" tabindex="1" type="radio">{$lang['yes']}
			<input name="groups[{$SecGroupList['group_id']}][upload_attach]" id="select_upload_attach" value="0" tabindex="1" checked type="radio">{$lang['no']}
			{/if}
            </label>
			</td>
		</tr>
		<tr valign="top">
			<td class="row2">
			{$lang['Write_subjects']}
			</td>
			<td class="row2">
			<label for="groups[{$SecGroupList['group_id']}][write_subject]">
			{if {$SecGroupList['write_subject']}}
			<input name="groups[{$SecGroupList['group_id']}][write_subject]" id="select_write_subject" value="1" tabindex="1" checked type="radio">{$lang['yes']}
			<input name="groups[{$SecGroupList['group_id']}][write_subject]" id="select_write_subject" value="0" tabindex="1" type="radio">{$lang['no']}
			{else}
			<input name="groups[{$SecGroupList['group_id']}][write_subject]" id="select_write_subject" value="1" tabindex="1" type="radio">{$lang['yes']}
			<input name="groups[{$SecGroupList['group_id']}][write_subject]" id="select_write_subject" value="0" tabindex="1" checked type="radio">{$lang['no']}
			{/if}
            </label>
			</td>
		</tr>
		<tr valign="top">
			<td class="row1">
			{$lang['write_reply']}
			</td>
			<td class="row1">
			<label for="groups[{$SecGroupList['group_id']}][write_reply]">
			{if {$SecGroupList['write_reply']}}
			<input name="groups[{$SecGroupList['group_id']}][write_reply]" id="select_write_reply" value="1" tabindex="1" checked type="radio">{$lang['yes']}
			<input name="groups[{$SecGroupList['group_id']}][write_reply]" id="select_write_reply" value="0" tabindex="1" type="radio">{$lang['no']}
			{else}
			<input name="groups[{$SecGroupList['group_id']}][write_reply]" id="select_write_reply" value="1" tabindex="1" type="radio">{$lang['yes']}
			<input name="groups[{$SecGroupList['group_id']}][write_reply]" id="select_write_reply" value="0" tabindex="1" checked type="radio">{$lang['no']}
			{/if}
            </label>
			</td>
		</tr>
		<tr valign="top">
			<td class="row2">
			{$lang['edit_own_subject']}
			</td>
			<td class="row2">
			<label for="groups[{$SecGroupList['group_id']}][edit_own_subject]">
			{if {$SecGroupList['edit_own_subject']}}
			<input name="groups[{$SecGroupList['group_id']}][edit_own_subject]" id="select_edit_own_subject" value="1" tabindex="1" checked type="radio">{$lang['yes']}
			<input name="groups[{$SecGroupList['group_id']}][edit_own_subject]" id="select_edit_own_subject" value="0" tabindex="1" type="radio">{$lang['no']}
			{else}
			<input name="groups[{$SecGroupList['group_id']}][edit_own_subject]" id="select_edit_own_subject" value="1" tabindex="1" type="radio">{$lang['yes']}
			<input name="groups[{$SecGroupList['group_id']}][edit_own_subject]" id="select_edit_own_subject" value="0" tabindex="1" checked type="radio">{$lang['no']}
			{/if}
            </label>
			</td>
		</tr>
		<tr valign="top">
			<td class="row1">
			{$lang['edit_own_reply']}
			</td>
			<td class="row1">
			<label for="groups[{$SecGroupList['group_id']}][edit_own_reply]">
			{if {$SecGroupList['edit_own_reply']}}
			<input name="groups[{$SecGroupList['group_id']}][edit_own_reply]" id="select_edit_own_reply" value="1" tabindex="1" checked type="radio">{$lang['yes']}
			<input name="groups[{$SecGroupList['group_id']}][edit_own_reply]" id="select_edit_own_reply" value="0" tabindex="1" type="radio">{$lang['no']}
			{else}
			<input name="groups[{$SecGroupList['group_id']}][edit_own_reply]" id="select_edit_own_reply" value="1" tabindex="1" type="radio">{$lang['yes']}
			<input name="groups[{$SecGroupList['group_id']}][edit_own_reply]" id="select_edit_own_reply" value="0" tabindex="1" checked type="radio">{$lang['no']}
			{/if}
            </label>
			</td>
		</tr>
		<tr valign="top">
			<td class="row2">
			{$lang['del_own_subject']}
			</td>
			<td class="row2">
			<label for="groups[{$SecGroupList['group_id']}][del_own_subject]">
			{if {$SecGroupList['del_own_subject']}}
			<input name="groups[{$SecGroupList['group_id']}][del_own_subject]" id="select_del_own_subject" value="1" tabindex="1" checked type="radio">{$lang['yes']}
			<input name="groups[{$SecGroupList['group_id']}][del_own_subject]" id="select_del_own_subject" value="0" tabindex="1" type="radio">{$lang['no']}
			{else}
			<input name="groups[{$SecGroupList['group_id']}][del_own_subject]" id="select_del_own_subject" value="1" tabindex="1" type="radio">{$lang['yes']}
			<input name="groups[{$SecGroupList['group_id']}][del_own_subject]" id="select_del_own_subject" value="0" tabindex="1" checked type="radio">{$lang['no']}
			{/if}
            </label>
			</td>
		</tr>
		<tr valign="top">
			<td class="row1">
			{$lang['del_own_reply']}
			</td>
			<td class="row1">
			<label for="groups[{$SecGroupList['group_id']}][del_own_reply]">
			{if {$SecGroupList['del_own_reply']}}
			<input name="groups[{$SecGroupList['group_id']}][del_own_reply]" id="select_del_own_reply" value="1" tabindex="1" checked type="radio">{$lang['yes']}
			<input name="groups[{$SecGroupList['group_id']}][del_own_reply]" id="select_del_own_reply" value="0" tabindex="1" type="radio">{$lang['no']}
			{else}
			<input name="groups[{$SecGroupList['group_id']}][del_own_reply]" id="select_del_own_reply" value="1" tabindex="1" type="radio">{$lang['yes']}
			<input name="groups[{$SecGroupList['group_id']}][del_own_reply]" id="select_del_own_reply" value="0" tabindex="1" checked type="radio">{$lang['no']}
			{/if}
            </label>
			</td>
		</tr>
		<tr valign="top">
			<td class="row2">
			{$lang['write_poll']}
			</td>
			<td class="row2">
			<label for="groups[{$SecGroupList['group_id']}][write_poll]">
			{if {$SecGroupList['write_poll']}}
			<input name="groups[{$SecGroupList['group_id']}][write_poll]" id="select_write_poll" value="1" tabindex="1" checked type="radio">{$lang['yes']}
			<input name="groups[{$SecGroupList['group_id']}][write_poll]" id="select_write_poll" value="0" tabindex="1" type="radio">{$lang['no']}
			{else}
			<input name="groups[{$SecGroupList['group_id']}][write_poll]" id="select_write_poll" value="1" tabindex="1" type="radio">{$lang['yes']}
			<input name="groups[{$SecGroupList['group_id']}][write_poll]" id="select_write_poll" value="0" tabindex="1" checked type="radio">{$lang['no']}
			{/if}
            </label>
			</td>
		</tr>
		<tr valign="top">
			<td class="row1">
			{$lang['vote_poll']}
			</td>
			<td class="row1">
			<label for="groups[{$SecGroupList['group_id']}][vote_poll]">
			{if {$SecGroupList['vote_poll']}}
			<input name="groups[{$SecGroupList['group_id']}][vote_poll]" id="select_vote_poll" value="1" tabindex="1" checked type="radio">{$lang['yes']}
			<input name="groups[{$SecGroupList['group_id']}][vote_poll]" id="select_vote_poll" value="0" tabindex="1" type="radio">{$lang['no']}
			{else}
			<input name="groups[{$SecGroupList['group_id']}][vote_poll]" id="select_vote_poll" value="1" tabindex="1" type="radio">{$lang['yes']}
			<input name="groups[{$SecGroupList['group_id']}][vote_poll]" id="select_vote_poll" value="0" tabindex="1" checked type="radio">{$lang['no']}
			{/if}
            </label>
			</td>
		</tr>
		<tr valign="top">
			<td class="row2">
			{$lang['no_posts']}
			</td>
			<td class="row2">
			<label for="groups[{$SecGroupList['group_id']}][no_posts]">
			{if {$SecGroupList['no_posts']}}
			<input name="groups[{$SecGroupList['group_id']}][no_posts]" id="select_no_posts" value="1" tabindex="1" checked type="radio">{$lang['yes']}
			<input name="groups[{$SecGroupList['group_id']}][no_posts]" id="select_no_posts" value="0" tabindex="1" type="radio">{$lang['no']}
			{else}
			<input name="groups[{$SecGroupList['group_id']}][no_posts]" id="select_no_posts" value="1" tabindex="1" type="radio">{$lang['yes']}
			<input name="groups[{$SecGroupList['group_id']}][no_posts]" id="select_no_posts" value="0" tabindex="1" checked type="radio">{$lang['no']}
			{/if}
            </label>
			</td>
		</tr>
	</table>

	<br />
	{/Des::while}

	<div align="center">
		<input type="submit" value="{$lang['acceptable']}" name="submit" />
	</div>

	<br />
</form>
