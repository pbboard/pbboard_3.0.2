<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="rtl" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>معالج تثبيت برنامج منتديات PBBoard - Wizard Install PBBoard Forums v3.0.2 - (Powered By PBBoard)</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" href="../../setup/setup.css" type="text/css" />
</head>
<body>
<div class="pbboard_body">
<table cellpadding="3" cellspacing="1" width="100%" class="t_style_b" border="0" align="center">
<tr valign="top" align="center">
	<td class="header_logo_side" colspan="2"><img align="left" alt="PowerBB" border="0" src="../logo.png" /></td>
</tr>
<tr valign="top" align="center">
	<td class="main1" colspan="2">
	فحص متطلبات التشغيل - Check the operating requirements
</td>
</tr>
</table><br />
<style type="text/css">
.row1 li
{
padding: 4px;
 }
</style>


<table cellpadding="3" cellspacing="1" width="90%" class="t_style_b" border="1" align="center">
<thead>
<tr>
	<th class="main1" align="center" colspan="2">فحص متطلبات التشغيل - Check the operating requirements</th>
</tr>
</thead>
<tr valign="top">
		<td align="left" class="row1" dir="ltr">
		<ul>
		<li>
		<font color="#800080">PHP Version :</font>
    <?php
// check Requirements
 if (version_compare(PHP_VERSION, '7.0.0') >= 0) {
echo PHP_VERSION. " <font color='#FF0000' size='2'> ( Change the Version of PHP to <font color='#008000' size='2'>5.x.x</font> from cpanel <b>Select PHP Version</b> )</font>";
$check ='0';
}
elseif (version_compare(PHP_VERSION, '5.6.30') < 0) {
echo '<font color="#008000">'. PHP_VERSION . " √ </font>";
$check ='1';
}
?>
</li>
<li>
<font color="#800080">MySQLi Support :</font>
<?php
if (function_exists('mysqli_connect')) {
echo '<font color="#008000"> √ </font>';
$check ='1';
}
else
{
echo '<font color="#FF0000"> X </font>';
}
MySQLi

?>
</li>
<li>
<font color="#800080">MySQL Support :</font>
<?php
if (function_exists('mysql_connect')) {
echo '<font color="#008000"> √ </font>';
$check ='1';
}
else
{
echo '<font color="#FF0000"> X </font>';
}
?>
</li>
<li>
<font color="#800080">CURL Library Support :</font>
<?php
if (function_exists('curl_version')) {
echo '<font color="#008000"> √ </font>';
$check ='1';
}
else
{
echo '<font size="2" color="#FF0000"> X  Must be Enabled cURL Library</font>';
$check ='0';
}
?>
</li>
<li>
<font color="#800080">Base64 Encoding is Enabled :</font>
<?php
if (function_exists('base64_decode')) {
echo '<font color="#008000"> √ </font>';
$check ='1';
}
else
{
echo '<font size="2" color="#FF0000"> X  Must be Enabled Function <b>base64_decode</b></font>';
$check ='0';
}
?>
</li>
<li>
<font color="#800080">Allow_url_fopen is Enabled :</font>
<?php
if( ini_get('allow_url_fopen') ) {
echo '<font color="#008000"> √ </font>';
$check ='1';
}
else
{
echo '<font size="2" color="#FF0000"> X  Must be Enable <b>allow_url_fopen</b></font>';
$check ='0';
}
?>
</li>
<li>
<font color="#800080">GD Library Support :</font>
<?php
if (extension_loaded('gd') && function_exists('gd_info')) {
echo '<font color="#008000"> √ </font>';
$check ='1';
}
else
{
echo '<font size="2" color="#FF0000"> X  PHP GD library is NOT installed on your web server</font>';
$check ='0';
}
?>
</li>
</ul>

</td>
</tr>
</table><br />
<div align="center"><tr>
	<td class="submit-buttons" colspan="2" align="center">
</tr>
</table><br />



</div><br><br><br><div id='copyright'>Powered by PBBoard © Version 3.0.2 </div></div>
</body>

</html>
<?php
 exit;
?>