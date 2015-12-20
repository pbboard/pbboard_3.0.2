<?php

/**
* 	SEGMA upgrager :
*		1- Upgrade to new method of info table
*		2- Add forum's create day to info table
*		3- Drop "notinindex_id" field from online table
*		4- Add logged field to member table
*		5- Add register_time field to member table
*		6- Convert register dates format from old method to new one (which based on unixstamp)
*/

$CALL_SYSTEM				= 	array();
$CALL_SYSTEM['GROUP'] 		= 	true;
$CALL_SYSTEM['ICONS'] 		= 	true;

include('../common.php');

class PowerBBSEGMA extends PowerBBInstall
{
	var $_TempArr 	= 	array();
	var $_Masseges	=	array();

	// Convert old info table to new info table :)
	function ConvertInfoTable()
	{
		global $PowerBB;

		$this->_TempArr['RenameArr'] = array();
		$this->_TempArr['RenameArr']['old_name'] = $PowerBB->prefix . 'info';
		$this->_TempArr['RenameArr']['new_name'] = $PowerBB->prefix . 'oldinfo';

		$rename = $this->rename_field($this->_TempArr['RenameArr']);

		if ($rename)
		{
			$this->_TempArr['CreateArr']				= 	array();
			$this->_TempArr['CreateArr']['table_name'] 	= 	$PowerBB->prefix . 'info';
			$this->_TempArr['CreateArr']['fields'] 		= 	array();
			$this->_TempArr['CreateArr']['fields'][] 	= 	'id INT( 9 ) NOT NULL AUTO_INCREMENT PRIMARY KEY';
			$this->_TempArr['CreateArr']['fields'][] 	= 	'var_name VARCHAR( 255 ) NOT NULL';
			$this->_TempArr['CreateArr']['fields'][] 	= 	'value text NOT NULL';

			$create = $this->create_table($this->_TempArr['CreateArr']);

			if ($create)
			{
				$getoldinfo = $PowerBB->DB->sql_query('SELECT * FROM ' . $PowerBB->prefix . "oldinfo WHERE id='1'");
				$old_info   = $PowerBB->DB->sql_fetch_array($getoldinfo);

		        $did = false;

				$field_query = $PowerBB->DB->sql_query('SHOW FIELDS FROM ' . $PowerBB->prefix . 'oldinfo');
				while ($row = $PowerBB->DB->sql_fetch_array($field_query))
				{
					$value = addslashes($old_info[$row['Field']]);

		    		$query = $PowerBB->DB->sql_query("INSERT INTO " . $PowerBB->prefix . "info(id,var_name,value) VALUES('NULL','" . $row['Field'] . "','" . $value . "')");

		    		if ($query)
		    		{
		    			$did = true;
		    		}
				}

				if ($did)
				{
					$del = $this->drop_table($PowerBB->prefix . 'oldinfo');

					if ($del)
					{
						return true;
					}
				}
			}
		}
	}

	// The create_date entry
	function AddCreateDateEntry()
	{
		global $PowerBB;

		$query = $PowerBB->DB->sql_query('SELECT register_date FROM ' . $PowerBB->table['member'] . ' ORDER BY id ASC LIMIT 1');
		$row = $PowerBB->DB->sql_fetch_array($query);

		$date = $this->_DateFormatDo($row['register_date']);

		$new_date = explode('/', $date, 3);
		$time = gmmktime(0,  0, 0, $new_date[1], $new_date[2], $new_date[0]);

		$insert = $PowerBB->DB->sql_query('INSERT INTO ' . $PowerBB->table['info'] . " SET var_name='create_date',value='" . $time . "'");

		return ($insert) ? true : false;
	}

	// The create_date entry
	function UpdateCreateDateEntry()
	{
		global $PowerBB;

      $info_query = $PowerBB->DB->sql_query("SELECT * FROM " . $PowerBB->table['subject'] . " WHERE id ORDER BY id ASC");
      $info_row   = $PowerBB->DB->sql_fetch_array($info_query);

		$CreateDate = $info_row['native_write_time'];

	   $update = $PowerBB->DB->sql_query('UPDATE ' . $PowerBB->table['info'] . " SET value='" . $CreateDate . "' WHERE var_name='create_date'");

		return ($update) ? true : false;
	}

	// Drop notinindex_id
	function DropNotInIndex()
	{
		global $PowerBB;

		$this->_TempArr['DropArr'] = array();
		$this->_TempArr['DropArr']['table_name'] = $PowerBB->table['online'];
		$this->_TempArr['DropArr']['field_name'] = 'notinindex_id';

		$drop = $this->drop_field($this->_TempArr['DropArr']);

		return ($drop) ? true : false;
	}

	// Add logged field
	function AddLogged()
	{
		global $PowerBB;

		$this->_TempArr['AddArr'] 				= array();
		$this->_TempArr['AddArr']['table'] 		= $PowerBB->table['member'];
		$this->_TempArr['AddArr']['field_name'] = 'logged';
		$this->_TempArr['AddArr']['field_des'] 	= 'VARCHAR( 30 ) NOT NULL';

		$add = $this->add_field($this->_TempArr['AddArr']);

		unset($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

	function AddRegisterTime()
	{
		global $PowerBB;

		$this->_TempArr['AddArr'] 				= array();
		$this->_TempArr['AddArr']['table'] 		= $PowerBB->table['member'];
		$this->_TempArr['AddArr']['field_name'] = 'register_time';
		$this->_TempArr['AddArr']['field_des'] 	= 'VARCHAR( 50 ) NOT NULL';

		$add = $this->add_field($this->_TempArr['AddArr']);

		return ($add) ? true : false;
	}

	function NewRegisterDateFormat(/* I Love & :D */&$msgs)
	{
		global $PowerBB;

		$query = $PowerBB->DB->sql_query('SELECT * FROM ' . $PowerBB->table['member']);

		while ($row = $PowerBB->DB->sql_fetch_array($query))
		{
			$r_date = $this->_DateFormatDo($row['register_date']);

			$date = explode('/', $r_date, 3);
			$time = gmmktime(0,  0, 0, $date[1], $date[2], $date[0]);

			$update = $PowerBB->DB->sql_query("UPDATE " . $PowerBB->table['member'] . " SET register_time='" . $time . "'");

			if ($update)
			{
             $msgs[] = ' تم تحديث تاريخ تسجيل العضو رقم ' . htmlspecialchars($row['id']);
			}
		}
	}

	// By KHALED MAMDOUH .. vbzoom.com
 	function _DateFormatDo($GetDateFormat,$DateFormat="j/n/Y")
    {
  		$Day   = SubStr($GetDateFormat,8,2);
  		$Month = SubStr($GetDateFormat,5,2);
  		$Year  = SubStr($GetDateFormat,0,4);

  		$ResultDate = @date ($DateFormat, mktime (0,0,0,$Month,$Day,$Year));

  		return $ResultDate;
 	}

 	function FixCaches(&$msgs)
 	{
 		global $PowerBB;

 		//  Smiles Cache
		$update = $this->_UpdateSmileArray();
		$msgs[] = ($update) ? 'تم تحديث كاش الابتسامات' : 'لم يتم تحديث كاش الابتسامات';
 	}

	function _UpdateSmileArray()
	{
		global $PowerBB;

		$cache = $PowerBB->icon->UpdateSmilesCache(null);

		return ($cache) ? true : false;
	}

	function UpdateVersion()
	{
		global $PowerBB;

		$update = $PowerBB->DB->sql_query("UPDATE " . $PowerBB->table['info'] . " SET value='2.0 SEGMA' WHERE var_name='MySBB_version'");

		return ($update) ? true : false;
	}
}

$PowerBB->install = new PowerBBSEGMA;

$PowerBB->html->page_header('معالج ترقية برنامج منتديات PBBoard v2.0.3');

$logo = $PowerBB->html->create_image(array('align'=>'right','alt'=>'PowerBB','src'=>'../logo.jpg','return'=>true));
$PowerBB->html->open_table('100%',true);
$PowerBB->html->cells($logo,'header_logo_side');

if ($PowerBB->_GET['welcome'] or !isset($PowerBB->_GET['step']))
{
	$PowerBB->html->cells('مرحباً بك','main1');
	$PowerBB->html->close_table();
$PowerBB->html->msg('مرحباً بك في معالج ترقية الجيل الاول من برنامج MysmartBB إلى الجيل الثاني   PBBoard v2.0.3');
	$PowerBB->html->msg('يرجى التحقق من انك قمت بأخذ نسخه احتياطيه من قاعدة البيانات قبل البدأ بعملية الترقيه، بالاضافه إلى التحقق من انك تستخدم آخر نسخه من الجيل الاول من ابناء 1.5.x حتى تتمكن من الترقيه بدون مشاكل.');
$PowerBB->html->msg('ملاحظه : عملية الترقيه طويله قليلاً و مُقسمه إلى عدّة خطوات و مراحل.');
$PowerBB->html->make_link('الخطوه الاولى -> تعديلات على جداول قواعد البيانات','?step=1');
}
elseif ($PowerBB->_GET['step'] == 1)
{
	$PowerBB->html->cells('الخطوه الاولى : تعديلات على جداول قواعد البيانات','main1');
	$PowerBB->html->close_table();

	$p 			= 	array();
	$msgs 		= 	$PowerBB->install->_Masseges;

	$p[1] 		= 	$PowerBB->install->ConvertInfoTable();
	$msgs[1] 	= 	($p[1]) ? 'تم تحديث جدول المعلومات إلى النمط الجديد' : 'لم يتم تحديث جدول المعلومات إلى النمط الجديد';

	$p[2]		=	$PowerBB->install->AddCreateDateEntry();
	$msgs[2]	=	($p[2]) ? 'تم اضافه مدخل تاريخ انشاء المنتدى' : 'لم يتم اضافة مدخل تاريخ انشاء المنتدى';

	$p[3]		=	$PowerBB->install->DropNotInIndex();
	$msgs[3]	=	($p[3]) ? 'تم حذف الحقل' : 'لم يتم حذف الحقل';

	$p[4]		=	$PowerBB->install->AddLogged();
	$msgs[4]	=	($p[4]) ? 'تم اضافة الحقل logged' : 'لم يتم اضافة الحقل logged';

	$p[5]		=	$PowerBB->install->AddRegisterTime();
	$msgs[5]	=	($p[5]) ? 'تم اضافة الحقل register_time' : 'لم يتم اضافة الحقل register_time';

	$PowerBB->html->open_p();

	foreach ($msgs as $msg)
	{
		$PowerBB->html->p_msg($msg);
	}

	$PowerBB->html->close_p();

	$NewVersion = $PowerBB->install->UpdateVersion();
    $PowerBB->install->UpdateCreateDateEntry();
	$PowerBB->html->make_link('الخطوه الثانية -> تعديل الكاش','?step=2');
}
elseif ($PowerBB->_GET['step'] == 2)
{
	$PowerBB->html->cells('الخطوه الثانية : تعديل الكاش','main1');
	$PowerBB->html->close_table();

	$p		=	array();

	$p[]	=	$PowerBB->install->FixCaches($PowerBB->install->_Masseges);

	$PowerBB->html->open_p();

	foreach ($PowerBB->install->_Masseges as $msg)
	{
		$PowerBB->html->p_msg($msg);
	}

	$PowerBB->html->close_p();

	$PowerBB->html->make_link('الخطوه الثالثة','?step=4');
}
elseif ($PowerBB->_GET['step'] == 4)
{
	$PowerBB->html->cells('الخطوه الثالثة','main1');
	$PowerBB->html->close_table();

	$PowerBB->html->open_p();
	$PowerBB->html->make_link('اضغط هنا','OMEGA.php?step=1');
	$PowerBB->html->p_msg(' لتبدأ تحديثات OMEGA');
	$PowerBB->html->close_p();
}

?>
