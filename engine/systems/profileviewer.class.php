<?php
/**
 *
 * @package 	: PowerBBoard
 * @name	   	: PowerBBProfileViewer
 * @author 		: Abu Ghadeer(ashoms0a@gmail.com)
 * @copyright	: 2010
 * @since		: 09/16/2010
 * @uses
 *
 * This class is to manage who views a user profile. It basically adds the following
 * information to the table "pbb_profile_views" or "XXX_profile_views" where XXX is
 * the table prefix defined in your configurations file:
 *
 * 1) Profile user id - This is the user id of the profile owner
 * 2) Viewer user id  - This is the id of the one who is viewing the profile
 * 3) Visit Counter   - This is the number of time the user view the profiel
 * 4) Visit Time      - This is the last visit time
 *
 * The list of the viewer will be generated and ordered by the last visit time which means that
 * the last one who visits the profile, his/her name will be shown the first
 *
 *
 * الهدف الرئيسي من هذا الملف هو اداره زوار الملف التعريفي لاعضاء المنتدى
 * سوف يتم عرض اسماء زوار الملف التعريفي مع عدد مرات الزياره لكل عضو وسوف تكون
 * مرتبه بوقت الزياره لكل عضو اي ان اخر عضو قام بزياره الملف سوف يظهر اسمه  اولا في القائمة
 */
class PowerBBProfileViewer {

	/**
	 * Version of this hack
	 * نسخه هذا الهاك
	 * @var string
	 */
	var $version = '1.0';

	/**
	 * Name of the database table
	 * اسم جدول قاعده البيانات الذي سوف يستخدم لحفظ معلومات الزوار
	 * @var string
	 */
	var $table_name;

	/**
	 * PBBoard Engine Instance
	 *
	 * @access	public
	 * @var 	object
	 */
	var $Engine;

	/**
	 * Show number of visit
	 * للتحكم بإخفاء وإظهار عدد الزيارات بجانب اسما الزوار للملف التعريفي
	 *
	 * @var		boolean
	 */
	var $show_visit_number = false;

	/**
	 * Class Constructor
	 * @param $Engine
	 */
	function PowerBBProfileViewer($Engine) {

		# Set our engine object instance
		$this->Engine = $Engine;

		# Set our table name
		$this->table_name = $this->Engine->prefix . 'profile_view';
	}

	/**
	 * This will log the current user visit to the selected member profile
	 *
	 * الهدف من هذه الداله هو انشاء معلومات جديده عن زائر الملف التعريفي
	 * او تحديث عدد الزيارات ووقت اخر زياره لكل زائر للملف التعريفي
	 *
	 * @access	public
	 * @param	integer	 $viewer_id    رقم زائر الملف التعريفي
	 * @param	integer	 $profile_id   رقم صاحب الملف التعريفي
	 * @return	void
	 */
	function startLog($viewer_id, $profile_id) {


		# Perform necessary initializations. This is a good programming practice
		# for good secure code :)
		$visit_log = array();

		# Clearn user's ids by casting them to integer(faster than calling any thing ;))
		$viewer_id =(int)$viewer_id;
		$profile_id =(int)$profile_id;

		# If any id is 0 or empty after casting, this means that someone has passed
		# the wrong informatoin, so just exit
		if(empty($viewer_id) || empty($profile_id)) {
			return false;
		}

		# we don't want to log the same user as a visitor to his/her own profile :). That just
		# going to be insane ;)
		if($viewer_id == $profile_id) {
			return false;
		}

		# First, we need to check if the viewer has already
		# visisted the current profile or not
		$SQL = "SELECT * FROM `" . $this->table_name . "` WHERE  profile_user_id = " . $profile_id . " AND
		                                             		     viewer_user_id  = " . $viewer_id . "";

		# Run the SQL Statement
		$result = $this->Engine->DB->sql_query($SQL);
		$visit_log = $this->Engine->DB->sql_fetch_array($result);

		# Get the current time
		$current_time = time();

		# If we have found something, then we need to update the following:
		# 1) visit count
		# 2) Time of the last visit
		if(is_array($visit_log)&& count($visit_log)> 0) {

			# Update the visit counter
			$visit_log ['viewer_user_counter'] = $visit_log['viewer_user_counter'] + 1;

			# Build our SQL statement
			$Update_Sql = "UPDATE `" . $this->table_name . "`
			               SET viewer_user_counter = " . $visit_log['viewer_user_counter'] . " ,
						   viewer_visit_time       = " . $current_time . "

						   WHERE

						   profile_user_id         = " . $profile_id . " AND
			               viewer_user_id          = " . $viewer_id . "";

			# Go ahead and update the database
			$this->Engine->DB->sql_query($Update_Sql);

		} else {

			# No this is the first time this user visits the profile. So
			# we need to insert a new visit log into our database
			$Insert_SQL = "INSERT INTO `" . $this->table_name . "`(profile_user_id,
			                                                         viewer_user_id,
			                                                         viewer_user_counter,
			                                                         viewer_visit_time)
			               VALUES( " . $profile_id . "," . $viewer_id . ",1," . $current_time . ")";
			# Go ahead and insert the new log
			$this->Engine->DB->sql_query($Insert_SQL);
		}

	}

	/**
	 * Gets the list of members who have viewed the current member profile
	 *
	 * الهدف من هذه الداله هو استخراج بيانات زوار الملف التعريفي للعضو الحالي
	 *
	 * @access	public
	 * @param	integer	$profile_id   رقم صاحب الملف التعريفي
	 * @return  void
	 *
	 */
	function getViewersList($profile_id) {

		global $PowerBB;

		$viewersList = array();

		# Clearn user's ids by casting them to integer(faster than calling any thing ;))
		$profile_id =(int) $profile_id;

		# If any id is 0 after casting, this means that someone has passed
		# wrong informatoin, so just exit
		if(empty($profile_id)) {
			return false;
		}

		# Go ahead and get the required data
		$SQL = 'SELECT m.id , m.username, p.viewer_user_id, p.viewer_user_counter, p.viewer_visit_time
		FROM `' . $this->table_name . '` AS p INNER JOIN  `' . $this->Engine->prefix . 'member` AS m
		ON p.viewer_user_id =  m.id
		WHERE p.profile_user_id = ' . $profile_id . '
		ORDER BY p.viewer_visit_time DESC LIMIT 0, 20';

		# Get visitors list
		$result = $this->Engine->DB->sql_query($SQL);
		while($log_row = $this->Engine->DB->sql_fetch_array($result)) {
			$viewersList [] = $log_row;
		}

		# Go ahead and feed our template engine with the required information
		$PowerBB->_CONF['template']['while']['viewersList'] = $viewersList;

		# Set a flag to indicate whether the current user has visitors or not
		if(is_array($viewersList)and count($viewersList)> 0) {
			$no_viewers = false;
		} else {
			$no_viewers = true;
		}
       $mn = $PowerBB->DB->sql_num_rows($PowerBB->DB->sql_query("SELECT * FROM " . $this->table_name . " WHERE profile_user_id = '$profile_id'"));

		# I gues that is it folks :)
		$PowerBB->template->assign('no_viewers', $no_viewers);
		$PowerBB->template->assign('view_page_num', $mn);

		# Do we need to show the visit number of each member as well
		$PowerBB->template->assign('show_visit_number', $this->show_visit_number);
	}
}

?>