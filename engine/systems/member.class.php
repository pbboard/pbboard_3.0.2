<?php

class PowerBBMember
{
	var $id;
	var $Engine;

	function PowerBBMember($Engine)
	{
		$this->Engine = $Engine;
	}

	/**
	 * Insert new member in database
	 *
	 * @access : public
	 * @return :
	 *				false			->	if the function can't add the member
	 *				true			->	if the function success to add member
	 *
	 * @param :
	 *			username -> the username
	 *			password -> of course the password :)
	 *			email	 -> the email :\
	 *			usergroup
	 *			user_gender
	 *			register_date
	 *			user_title
	 *			style
	 */
	function InsertMember($param)
	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$query = $this->Engine->records->Insert($this->Engine->table['member'],$param['field']);

		if ($param['get_id'])
		{
			$this->id = $this->Engine->DB->sql_insert_id();
		}

		return ($query) ? true : false;
	}

	/**
	 * Get members list
	 *
	 * @param :
	 *				sql_statment -> complete the sql query
	 */
	function GetMemberList($param)
	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$param['select'] 	= 	'*';
 		$param['from'] 		= 	$this->Engine->table['member'];

		$rows = $this->Engine->records->GetList($param);

		return $rows;
	}

	/**
	 * Get member information
	 *
	 * @param :
	 *			get	->	the list of fields
	 */
	function GetMemberInfo($param)
	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$param['select'] 	= 	(!empty($param['get'])) ? $param['get'] : '*';
		$param['from'] 		= 	$this->Engine->table['member'];

		$rows = $this->Engine->records->GetInfo($param);
		return $rows;
	}

	/**
	 * Get the total of members
	 *
	 * @param :
	 *			get_from	->	cache or db
	 */
	function GetMemberNumber($param)
	{
		if ($param['get_from'] == 'cache')
		{
			$num = $this->Engine->_CONF['info_row']['member_number'];
		}
		elseif ($param['get_from'] == 'db')
		{
			$param['select'] 	= 	'*';
			$param['from'] 		= 	$this->Engine->table['member'];

			$num = $this->Engine->records->GetNumber($param);
		}
		else
		{
			trigger_error('ERROR::BAD_VALUE_OF_GET_FROM_VARIABLE -- FROM GetMemberNumber() -- get_from SHOULD BE cache OR db',E_USER_ERROR);
		}

		return $num;
	}

	function UpdateMember($param)
	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$query = $this->Engine->records->Update($this->Engine->table['member'],$param['field'],$param['where']);

		return ($query) ? true : false;
	}

	function DeleteMember($param)
	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$param['table'] = $this->Engine->table['member'];

		$del = $this->Engine->records->Delete($param);

		return ($del) ? true : false;
	}

	///

	/**
	 * Check if the member exists in database or not
	 *
	 * @param :
	 *				way	->
	 						id
	 						username
	 						email
	 *
	 * @return :
	 *				false 	-> if isn't member
	 *				true	-> if is member
	 */
	function IsMember($param)
	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$param['select'] 	= 	'*';
		$param['from'] 		= 	$this->Engine->table['member'];

		$num = $this->Engine->records->GetNumber($param);

		return ($num <= 0) ? false : true;
	}

	/**
	 * Check if user is exists and set cookie to log in
	 *
	 * @param :
	 *			username -> the usename
	 *			password -> the password with md5
	 */
	function LoginMember($param)
	{
		if (empty($param['username'])
			or empty($param['password']))
		{
			trigger_error('ERROR::NEED_PARAMETER -- FROM LoginMember() -- EMPTY username or password',E_USER_ERROR);
		}

		$CheckMember = $this->CheckMember(array('username'	=>	$param['username'],
		       									'password'	=>	$param['password']));

		if (!$CheckMember)
		{
			return false;
		}
		else
		{

			setcookie($this->Engine->_CONF['username_cookie'],$param['username'],$param['expire'], NULL ,NULL, NULL, TRUE);
			setcookie($this->Engine->_CONF['password_cookie'],$param['password'],$param['expire'], NULL ,NULL, NULL, TRUE);
    		session_start();
            $_SESSION['HTTP_USER_AGENT'] = strtolower(md5($this->Engine->_SERVER['HTTP_USER_AGENT']));
       		return $CheckMember;
       	}
	}

	/**
	 * Check if the member information is correct
	 *
	 * @param :
	 *			username -> the username
	 *			password -> the password
	 *			object	 -> if this function used in system file we sould identify the system object
	 */
	function CheckMember($param)
	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$MemberArr['get'] = '*';

		if (!empty($param['username'])
			and !empty($param['password']))
		{
			$MemberArr['where'] 				= 	array();
			$MemberArr['where'][0] 				= 	array();
			$MemberArr['where'][0]['name'] 		= 	'username';
			$MemberArr['where'][0]['oper'] 		= 	'=';
			$MemberArr['where'][0]['value'] 	= 	$param['username'];

			$MemberArr['where'][1] 				= 	array();
			$MemberArr['where'][1]['con'] 		= 	'AND';
			$MemberArr['where'][1]['name'] 		= 	'password';
			$MemberArr['where'][1]['oper'] 		= 	'=';
			$MemberArr['where'][1]['value'] 	= 	$param['password'];
		}

		$CheckMember = $this->GetMemberInfo($MemberArr);

		return (!$CheckMember) ? false : $CheckMember;
	}

	/**
	 * Member logout
	 *
	 */
	function Logout()
	{
      	 session_start();
		$del = array();
		$del[1] = setcookie($this->Engine->_CONF['username_cookie'],'');
     	$del[2] = setcookie($this->Engine->_CONF['password_cookie'],'');
        session_destroy();
     	return ($del[1] and $del[2]) ? true : false;
	}

	/**
	 * Get username with group style
	 *
	 * @param :
	 *				username	->	the name of user
	 *				group_style	->	the style of gorup
	 */
	function GetUsernameByStyle($param)
	{
		// These codes from the first generation of PowerBB
		// Do you remember it ? :)

 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		if (empty($param['group_style'])
			or empty($param['username']))
		{
			trigger_error('ERROR::NEED_PARAMATER -- FROM GetUsernameByStyle() -- EMPTY group_style or username',E_USER_ERROR);
		}

		$general_style = $param['group_style'];
		$general_style = explode('[username]',$general_style);

		$style  = $general_style[0];
		$style .= $this->Engine->sys_functions->CleanVariable($param['username'],'html');
		$style .= $general_style[1];

		return $style;
	}

	/**
	 * Update the last visit date
	 *
	 * @param :
	 *			last_visit	->	the date
	 */
	function LastVisitCookie($param)
	{

		// TODO :: store the name of cookie in a variable like username,password cookies.
		$cookie = setcookie('PowerBB_lastvisit',$param['last_visit'],time()+85200, NULL ,NULL, NULL, TRUE);

		$UpdateArr 					= 	array();

		$UpdateArr['field']					=	array();
		$UpdateArr['field']['lastvisit'] 	= 	$param['date'];

		$UpdateArr['where']			=	array('id',$param['id']);

		$query = $this->UpdateMember($UpdateArr);
	}



	/**
	 * Get the member time
	 */
	 // Probabbly this way is wrong
	function GetMemberTime($param)
	{
		$time   = $this->Engine->_CONF['gmt_hour'] + $param['time'];
     	$time   = $time . $this->Engine->_CONF['gmt_seconds'];

     	return $time;
	}

	/**
	 * Get the number of member who have posts > 0
	 */
	function GetActiveMemberNumber()
	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$param['select'] 			= 	'*';
		$param['from'] 				= 	$this->Engine->table['member'];

		$param['where'] 			= 	array();
		$param['where'][0] 			= 	array();
		$param['where'][0]['name'] 	= 	'posts';
		$param['where'][0]['oper'] 	= 	'>';
		$param['where'][0]['value'] = 	'0';

		$num   = $this->Engine->records->GetNumber($param);

		return $num;
	}


	function CleanNewPassword($param)
	{
 		if (!isset($param)
 			or !is_array($param))
 		{
 			$param = array();
 		}

		$UpdateArr 					= 	array();
		$UpdateArr['new_password'] 	= 	'';
		$UpdateArr['where']			=	array('id',$param['id']);

		$query = $this->UpdateMember($UpdateArr);

		return ($query) ? true : false;
	}

	function CheckAdmin($param)
	{
 		if (!isset($param['username'])
 			or !isset($param['password']))
 		{
 			trigger_error('ERROR::NEED_PARAMETER -- FROM CheckAdmin() -- EMPTY username OR password',E_USER_ERROR);
 		}

 		$MemberArr 					= 	array();
 		$MemberArr['username']		=	$param['username'];
 		$MemberArr['password']		=	$param['password'];

		$CheckMember = $this->CheckMember($MemberArr);

		// Well , this is a member
		if ($CheckMember != false)
		{
			$GroupArr 			= 	array();
			$GroupArr['where'] 	= 	array('id',$CheckMember['usergroup']);

			$GroupInfo = $this->Engine->core->GetInfo($GroupArr,'group');

			if ($GroupInfo != false)
			{
				return ($GroupInfo['admincp_allow']) ? $CheckMember : false;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}

	function LoginAdmin($param)
	{
 		if (empty($param['username'])
 			or empty($param['password']))
 		{
 			trigger_error('ERROR::NEED_PARAMETER -- FROM LoginAdmin() -- EMPTY username OR password',E_USER_ERROR);
 		}

		$Check = $this->CheckAdmin($param);

		if ($Check != false)
		{
			setcookie($this->Engine->_CONF['admin_username_cookie'],$param['username']);
			setcookie($this->Engine->_CONF['admin_password_cookie'],$param['password']);
  		    session_start();
            $_SESSION['HTTP_USER_AGENT_CP'] = strtolower(md5($this->Engine->_SERVER['HTTP_USER_AGENT']));
       		return true;
		}
		else
		{
			return false;
		}
	}

	/**
			 * Insert new field in the members table , Default type VARCHAR(250)
			 * @param string $name the new field name
			 * @return bool result!
			 */
			function InsertMemberField($_name){
		      ( true==empty($_name) )
		      ? trigger_error('',E_USER_ERROR)
		      : $alterParams=array(
		            'table' => $this->Engine->table['member'],
		            'new_name' => $_name,
		            'def'   => 'VARCHAR(250) NULL',
		            'type' => 'add'
		          );
		      return $this->Engine->records->Alter($alterParams);
			}

			 /**
		   * Insert new field in the members table
		   * @param string $name the new field name
		   * @return bool result!
		   */
		 function DeleteMemberField($_name){
		      ( true==empty($_name) )
		      ? trigger_error('member::DeleteMemberField > empty field name !',E_USER_ERROR)
		      : $alterParams=array(
		            'table' => $this->Engine->table['member'],
		            'name' => $_name,
		            'type' => 'drop'
		          );
		      return $this->Engine->records->Alter($alterParams);
		  }

}

?>
