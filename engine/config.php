<?php
/*=============================================*\
// ######################################## \\
// # ****** DATABASE TYPE ******          # \\
// # PBBoard 3.0.2                        # \\
// # http://www.pbboard.info               # \\
// # PHP code in this file is © 2015      # \\
// # PBBoard IS FREE SOFTWARE             # \\
// ######################################## \\
\*=============================================*/

// MASTER DATABASE SERVER NAME
$config['db']['server']       ="localhost";
// DATABASE NAME
$config['db']['name']         ="";
// DATABASE username
$config['db']['username']     ="root";
// DATABASE password
$config['db']['password']     ="";
// TABLE PREFIX
$config['db']['prefix']       ="pbb_";

//	****** DATABASE TYPE ******
//	This is the type of the database server on which your PBBoard database will be located.
//	Valid options are mysql and mysqli, for slave support add _slave.  Try to use mysqli if you are using PHP 5 and MySQL 4.1+
// for slave options just append _slave to your preferred database type.
$config['db']['dbtype'] = 'mysql';

//	****** PATH TO ADMIN CONTROL PANELS ******
//	This setting allows you to change the name of the folders that the admin
//	control panels reside in. You may wish to do this for security purposes.
//	Please note that if you change the name of the directory here, you will still need
//	to manually change the name of the directory on the server.

$config['Misc']['admincpdir'] = 'admincp';

//	****** SUPER ADMINISTRATORS ******
//	The users specified below will have permission to access the administrator permissions
//	page, which controls the permissions of other administrators

$config['SpecialUsers']['superadministrators'] = '1';

//To disable the plugin/hook system
$config['HOOKS']['DISABLE_HOOKS'] = '1';

?>
