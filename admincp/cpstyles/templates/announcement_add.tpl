<br />

<div class="address_bar">{$lang['Control_Panel']} &raquo;
 <a href="index.php?page=announcement&amp;control=1&amp;main=1">{$lang['announcement']}</a>
 &raquo; {$lang['Add_new_announcement']}</div>

<br />

<form action="index.php?page=announcement&amp;add=1&amp;start=1" method="post">
	<div align="center">
	<table width="90%" class="t_style_b" border="0" cellspacing="1">
		<tr align="center">
			<td class="main1">
			{$lang['Add_new_announcement']}
			</td>
		</tr>
		<tr>
			<td class="row1">
			{$lang['title']}
				<input type="text" name="title" size="50"  />
			</td>
		</tr>
		<tr>
			<td class="row2">
					{$lang['text_announcement']}
<br />
<script type="text/javascript" src="../look/ckeditor/ckeditor.js"></script>
<textarea cols="50" id="text" name="text" rows="5">
</textarea>
{template}editor_js{/template}
</td>
		</tr>
		<tr>
			<td class="row2" align="center">
				<input type="submit" value="  {$lang['acceptable']}  " name="submit"/>

</td>
		</tr>
	</table>

	</div>

	<br />
	<br />

</form>