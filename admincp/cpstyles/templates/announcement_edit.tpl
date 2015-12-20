<br />

<div class="address_bar">{$lang['Control_Panel']} &raquo;
<a href="index.php?page=announcement&amp;control=1&amp;main=1">{$lang['announcement']}</a>
 &raquo; {$lang['edit']} :
 {$AnnInfo['title']}</div>

<br />

<form action="index.php?page=announcement&amp;edit=1&amp;start=1&amp;id={$AnnInfo['id']}" method="post">
	<table width="96%" class="t_style_b" border="0" cellspacing="1" align="center">
		<tr align="center">
			<td class="main1">
			{$lang['edit']} :
 {$AnnInfo['title']}
			</td>
		</tr>
		<tr>
			<td class="row1">
			{$lang['title']}
				<input type="text" name="title" value="{$AnnInfo['title']}" size="50"  />
			</td>
		</tr>
		<tr>
			<td class="row2">
<script type="text/javascript" src="../look/ckeditor/ckeditor.js"></script>
<textarea cols="50" id="text" name="text" rows="5">{$AnnInfo['text']}</textarea>
{template}editor_js{/template}
			</td>
		</tr>
		<tr>
			<td class="row2" align="center">
				<input type="submit" value="  {$lang['acceptable']}  " name="submit" onClick="comm._submit();"/>

</td>
		</tr>
	</table>

	<br />

	<br />

</form>