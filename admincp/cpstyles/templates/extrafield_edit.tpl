<br />

<div class="address_bar">{$lang['Control_Panel']} &raquo;
<a href="index.php?page=extrafield&amp;control=1&amp;main=1">{$lang['extrafields']}</a> &raquo;
 {$lang['edit']} :
 {$field['name']}</div>

<br />
<div style="color:RED;">
&nbsp;{$errors}
</div>
<form action="index.php?page=extrafield&amp;edit=1&amp;start=1&amp;id={$field['id']}" method="post">
  <table width="60%" class="t_style_b" border="0" cellspacing="1" align="center">
    <tr align="center">
      <td class="main1" colspan="2">
       {$lang['edit']} :
 {$field['name']}
      </td>
    </tr>
    <tr>
      <td class="row1">
      {$lang['extrafieldname']}
      </td>
      <td class="row1">
        <input type="text" value="{$field['name']}" name="name" />
      </td>
    </tr>
    <tr>
      <td class="row2">
      {$lang['Appears_in_posts']}
      </td>
      <td class="row2">
        <select name="show_in_forum">
          <option value="yes" >{$lang['yes']}</option>
          <option value="no" {if {$field['show_in_forum']}=='no' } selected="selected" {/if} >{$lang['no']}</option>
        </select>
      </td>
    </tr>
    <tr>
      <td class="row1">
      {$lang['Compulsory']}
      </td>
      <td class="row1">
        <select name="required">
          <option value="yes">{$lang['yes']}</option>
          <option value="no" {if {$field['required']}=='no' } selected="selected" {/if}>{$lang['no']}</option>
        </select>
      </td>
    </tr>
    <tr>
      <td class="row2">
      {$lang['type']}
      </td>
      <td class="row2">
        <select name="type">
          <option value="input_text">{$lang['input_text']}</option>
          <option value="select_option" {if {$field['type']}=='select_option' } selected="selected" {/if}>{$lang['select_option']}</option>
        </select>
      </td>
    </tr>
    <tr>
      <td class="row2">
      {$lang['options']}
      </td>
      <td class="row2">
       {$lang['Each_option_in_the_line']} <br />
        {$lang['Multiple_Choices']} <br />
        <textarea name="options" rows="5" cols="50">{$field['options']}</textarea>
      </td>
    </tr>
  </table>

  <br />

  <div align="center">
    <input type="submit" value="{$lang['acceptable']}" name="submit" />
  </div>


  <br />

</form>