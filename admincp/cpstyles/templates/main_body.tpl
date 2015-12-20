<table width="90%" class="t_style_b" border="0" cellspacing="1" align="center">
	<tr align="center">
		<td class="main1" colspan="2">{$lang['Quick_Stats']}</td>
	</tr>
	<tr align="center">
		<td class="row1" width="40%">{$lang['version_number']}</td>
		<td class="row1" width="40%" dir="ltr"><strong>{$_CONF['info_row']['MySBB_version']}</strong></td>
	</tr>
	<tr align="center">
		<td id="Notifyboxr1" style="font-family:Tahoma;font-size:8pt;padding-right:10px;padding:3px;" width="40%" bgColor="#F5F8F7">{$lang['check_version']}</td>
		<td id="Notifyboxr2" style="font-family:Tahoma;font-size:8pt;padding-right:10px;padding:4px;" width="40%" bgColor="#F5F8F7">
		<!--versioncheck-->
		<!--versionnotification-->
		</td>
	</tr>
	<tr align="center">
		<td class="row2" width="40%">{$lang['Number_of_Members']}</td>
		<td class="row2" width="40%">{$MemberNumber}</td>
	</tr>
	<tr align="center">
		<td class="row1" width="40%">{$lang['ActiveMember']}</td>
		<td class="row1" width="40%">{$ActiveMember}</td>
	</tr>
	<tr align="center">
		<td class="row2" width="40%">{$lang['ForumsNumber']}</td>
		<td class="row2" width="40%">{$ForumsNumber}</td>
	</tr>
	<tr align="center">
		<td class="row1" width="40%">{$lang['SubjectNumber']}</td>
		<td class="row1" width="40%">{$SubjectNumber}</td>
	</tr>
	<tr align="center">
		<td class="row2" width="40%">{$lang['ReplyNumber']}</td>
		<td class="row2" width="40%">{$ReplyNumber}</td>
	</tr>
	<tr align="center">
		<td class="row1" width="40%">{$lang['TodayMemberNumber']}</td>
		<td class="row1" width="40%">{$TodayMemberNumber}</td>
	</tr>
	<tr align="center">
		<td class="row2" width="40%">{$lang['TodaySubjectNumber']}</td>
		<td class="row2" width="40%">{$TodaySubjectNumber}</td>
	</tr>
	<tr align="center">
		<td class="row1" width="40%">{$lang['TodayReplyNumber']}</td>
		<td class="row1" width="40%">{$TodayReplyNumber}</td>
	</tr>
	<tr align="center">
		<td class="row2" width="40%">{$lang['MembersActiveList']}</td>
		<td class="row2" width="40%">{$MembersActiveList}
		 {if {$MembersActiveList} > '0'}
		(<a href="index.php?page=member&amp;active_member=1&amp;main=1" target="main"> {$lang['active_member']}</a>  )
		{/if}
		</td>
	</tr>
</table>

<br />

<table width="90%" class="t_style_b" border="0" cellspacing="1" align="center">
	<tr>
		<td class="main1" colspan="2" align="center">{$lang['license']} - {$lang['Programmers_program_PBBoard']}</td>
	</tr>
	<tr>
		<td class="row1" width="20%">{$lang['Management_and_program_development']}</td>
<td class="row1" width="60%">SULAIMAN DAWOD SULAIMAN ALMUTAIRI</td>
	</tr>
		<tr>
		<td class="row1" width="20%">{$lang['license']}</td>
<td class="row1" width="60%">
PBBoard Is Free Software , Falls under the license GNU GPL General Public
</td>
	</tr>
		<tr>
		<td class="row1" width="20%">{$lang['Program_Version']}</td>
<td class="row1" width="60%">Version {$_CONF['info_row']['MySBB_version']}</td>
	</tr>
</table>
<br />
<table width="90%" class="t_style_b" border="0" cellspacing="1" align="center">
	<tr>
		<td class="main1" colspan="2" align="center">{$lang['pbboard_last_updates']}</td>
	</tr>
<tr>
<td class="row1" width="80%" colspan="2">
<!--PBBoard_Updates-->
</td>
	</tr>
</table>
<br />
<table width="90%" class="t_style_b" border="0" cellspacing="1" align="center">
	<tr align="center">
		<td class="main1">{$lang['Administrators_Note']}</td>
	</tr>
	<tr align="center">
		<td class="row1">
			<form method="post" action="index.php?page=note">
				<textarea name="note" rows="9" cols="77">{$_CONF['info_row']['admin_notes']}</textarea>
				<br />
				<input type="submit" value="{$lang['acceptable']}" name="submit" />
			</form>
		</td>
	</tr>
</table>
<br />
<br />
<br />
		<p id="copyright" align="center">
		<!--copyright-->
		</b>
