<?php

/**
* 	     upgrager PBBoard :
*		1- Upgrade to new method of info table
*		2- Add forum's create day to info table
*		3- Drop "notinindex_id" field from online table
*		4- Add logged field to member table
*		5- Add register_time field to member table
*		6- Convert register dates format from old method to new one (which based on unixstamp)
*/

define('NO_TEMPLATE',true);

$CALL_SYSTEM				= 	array();

include('../common.php');

class PowerBBTHETA extends PowerBBInstall
{
	var $_TempArr 	= 	array();
	var $_Masseges	=	array();
}


		  global $PowerBB;

      $info_query = $PowerBB->DB->sql_query("SELECT * FROM " . $PowerBB->table['info'] . " WHERE id='1'");
      $info_row   = $PowerBB->DB->sql_fetch_array($info_query);


		  if ($info_row['MySBB_version'] == "1.7.0")
           {
           echo "<META HTTP-EQUIV=\"refresh\" CONTENT=\"0; URL=SEGMA.php\">\n";
           }
           if ($info_row['MySBB_version'] == '1.7.1')
           {
           echo "<META HTTP-EQUIV=\"refresh\" CONTENT=\"0; URL=SEGMA.php\">\n";
           }
           if ($info_row['MySBB_version'] == '1.7.9')
           {
           echo "<META HTTP-EQUIV=\"refresh\" CONTENT=\"0; URL=SEGMA.php\">\n";
           }
           if ($info_row['MySBB_version'] == '1.7.8')
           {
           echo "<META HTTP-EQUIV=\"refresh\" CONTENT=\"0; URL=SEGMA.php\">\n";
           }
           if ($info_row['MySBB_version'] == '1.8.0')
           {
           echo "<META HTTP-EQUIV=\"refresh\" CONTENT=\"0; URL=SEGMA.php\">\n";
           }
           if ($info_row['MySBB_version'] == '1.6.0')
           {
           echo "<META HTTP-EQUIV=\"refresh\" CONTENT=\"0; URL=SEGMA.php\">\n";
           }
           if ($info_row['MySBB_version'] == '1.6.0-Beta1')
           {
           echo "<META HTTP-EQUIV=\"refresh\" CONTENT=\"0; URL=SEGMA.php\">\n";
           }
           if ($info_row['MySBB_version'] == '1.5.0')
           {
           echo "<META HTTP-EQUIV=\"refresh\" CONTENT=\"0; URL=SEGMA.php\">\n";
           }
          if ($PowerBB->_CONF['info_row']['MySBB_version'] == '2.0 OMEGA')
           {
           echo "<META HTTP-EQUIV=\"refresh\" CONTENT=\"0; URL=OMEGA.php\">\n";
           }
           if ($PowerBB->_CONF['info_row']['MySBB_version'] == '2.0 SEGMA')
           {
           echo "<META HTTP-EQUIV=\"refresh\" CONTENT=\"0; URL=THETA.php\">\n";
           }
           if ($PowerBB->_CONF['info_row']['MySBB_version'] == '2.0.0 Beta')
           {
           echo "<META HTTP-EQUIV=\"refresh\" CONTENT=\"0; URL=SEGMA.php\">\n";
           }
           if ($PowerBB->_CONF['info_row']['MySBB_version'] == '2.0.0')
           {
           echo "<META HTTP-EQUIV=\"refresh\" CONTENT=\"0; URL=SEGMA.php\">\n";
           }
           if ($PowerBB->_CONF['info_row']['MySBB_version'] == '2.0.1')
           {
           echo "<META HTTP-EQUIV=\"refresh\" CONTENT=\"0; URL=upg_202.php\">\n";
           }
           if ($PowerBB->_CONF['info_row']['MySBB_version'] == '2.0.2')
           {
           echo "<META HTTP-EQUIV=\"refresh\" CONTENT=\"0; URL=upg_203.php\">\n";
           }
           if ($PowerBB->_CONF['info_row']['MySBB_version'] == '2.0.3')
           {
	       echo "<META HTTP-EQUIV=\"refresh\" CONTENT=\"0; URL=upg_204.php?step=0\">\n";
           }
           if ($PowerBB->_CONF['info_row']['MySBB_version'] == '2.0.4')
           {
	       echo "<META HTTP-EQUIV=\"refresh\" CONTENT=\"0; URL=upg_205.php?step=0\">\n";
           }
           if ($PowerBB->_CONF['info_row']['MySBB_version'] == '2.0.5')
           {
	       echo "<META HTTP-EQUIV=\"refresh\" CONTENT=\"0; URL=upg_210.php?step=0\">\n";
           }
           if ($PowerBB->_CONF['info_row']['MySBB_version'] == '2.1.0')
           {
	       echo "<META HTTP-EQUIV=\"refresh\" CONTENT=\"0; URL=upg_211.php?step=0\">\n";
           }
           if ($PowerBB->_CONF['info_row']['MySBB_version'] == '2.1.1')
           {
	       echo "<META HTTP-EQUIV=\"refresh\" CONTENT=\"0; URL=upg_212.php?step=0\">\n";
           }
           if ($PowerBB->_CONF['info_row']['MySBB_version'] == '2.1.2')
           {
	       echo "<META HTTP-EQUIV=\"refresh\" CONTENT=\"0; URL=upg_213.php?step=0\">\n";
           }
           if ($PowerBB->_CONF['info_row']['MySBB_version'] == '2.1.3')
           {
	       echo "<META HTTP-EQUIV=\"refresh\" CONTENT=\"0; URL=upg_214.php?step=0\">\n";
           }
           if ($PowerBB->_CONF['info_row']['MySBB_version'] == '2.1.4')
           {
	       echo "<META HTTP-EQUIV=\"refresh\" CONTENT=\"0; URL=upg_300.php?step=0\">\n";
           }
           if ($PowerBB->_CONF['info_row']['MySBB_version'] == '3.0.0')
           {
	       echo "<META HTTP-EQUIV=\"refresh\" CONTENT=\"0; URL=upg_301.php?step=0\">\n";
           }
           if ($PowerBB->_CONF['info_row']['MySBB_version'] == '3.0.1')
           {
	       echo "<META HTTP-EQUIV=\"refresh\" CONTENT=\"0; URL=upg_302.php?step=0\">\n";
           }
           if ($PowerBB->_CONF['info_row']['MySBB_version'] == '3.0.2'
           or $PowerBB->_CONF['info_row']['MySBB_version'] == '3.0.2 Beta')
           {
           echo '<body bgcolor="#F3F3F3"><br><br><font face="Tahoma" size="2"><div dir=' . $PowerBB->_CONF['info_row']['content_dir'] . ' align="center">برنامج المنتدى مرقى بالفعل إلى أحدث إصدار 3.0.2 وليس بحاجة إلى ترقية</div></font></body>';
           }










?>
