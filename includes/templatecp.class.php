<?php

class PowerBBTemplate
{
	var $templates_dir;
	var $compiler_dir;
	var $templates_ex;
	var $template;
	var $while_num;
	var $while_array		=	null;
	var $foreach_array		=	null;
	var $_vars 				= 	null;
	var $method				=	'file';
	var $x_loop				=	0; // Private
	var $size_loop			=	0; // Private
	var $_while_var			=	null;
	var $_while_var_num		=	0;
	var $_foreach_var		=	null;
	var $_foreach_var_num	=	0;


	function PowerBBTemplate()
	{
		$this->while_array 		= 	array();
		$this->foreach_array 	= 	array();
		$this->_vars 			= 	array();
		$this->_while_var 		= 	array();
		$this->_foreach_var 	= 	array();
	}

	/**
	 * Set the information
	 */
	function SetInformation($templates_dir,$templates_ex,$method)
	{
		$this->templates_dir 		= 	$templates_dir;
		$this->templates_ex			=	$templates_ex;
		$this->method				=	$method;
	}

	function GetTemplateDir()
	{
		return $this->templates_dir;
	}

	function GetCompilerDir()
	{
		return $this->compilter_dir;
	}

	function GetTemplateExtention()
	{
		return $this->templates_ex;
	}

	/**
	 * Display the template after compile it
	 */
	function display($template_name)
	{
		global $PowerBB;


			if ($PowerBB->_GET['debug'] != 1)
			{
				$this->_TemplateFromFile($template_name);
			}

	}


	function content($template_name)
	{		global $PowerBB;

		if ($PowerBB->_GET['debug'] != 1)
		{
			return $this->_TemplatepagerFromFile($template_name,true);
		}
	}

	/**
	 * If the template isn't compiled , we search it in template directory and if we found it we will compile it
	 */
	function _TemplateFromFile($template_name,$content=false)
	{		global $PowerBB;

		if (filesize($this->templates_dir . $template_name . $this->templates_ex) > 0)
		{
					$fp = fopen($this->templates_dir . $template_name . $this->templates_ex,'r');

					if (!$fp)
					{
						return 'ERROR::CAN_NOT_OPEN_THE_FILE';
					}

					$fr = fread($fp,filesize($this->templates_dir . $template_name . $this->templates_ex));

					fclose($fp);

					$this->_CompileTemplate($fr,$template_name);

		}
		else
		{
			trigger_error('ERROR::FILE_SIZE_IS_ZERO',E_USER_ERROR);
		}
	}

	function _TemplatepagerFromFile($template_name,$content=false)
	{		global $PowerBB;

			if (!$content)
			{
				$this->_GetCompiledFile($template_name,$content);
			}
			else
			{
				return $this->_GetCompiledFile($template_name,$content);
			}
	}

	/**
	 * Can I call it "The Compiler" ? :)
	 */
	function _CompileTemplate($string,$filename)
	{		global $PowerBB;


		if ($filename == 'main_body')
		{
           $string = str_replace("<!--PBBoard_Updates-->",$PowerBB->functions->PBBoard_Updates(),$string);
           $string = str_replace("<!--versioncheck-->",$PowerBB->functions->check_version_date(),$string);
		}
		// We have loop
		if (preg_match('~\{Des::while}{([^[<].*?)}~',$string)
			or preg_match('~\{Des::while::complete}~',$string))
		{
			$string = $this->_ProccessWhile($string);
		}

		if (preg_match('~\{Des::foreach}{([^[<].*?)}~',$string))
		{
			$string = $this->_ProccessForeach($string);
		}

		if (preg_match('~\{if (.*)\}~',$string))
		{
			$string = $this->_ProccessIfStatement($string);
		}

		$search_array 	= 	array();
		$replace_array 	= 	array();

		//////////

		/**
		 * Array
		 */

		// 2D Array (Without print) :
		// 			{$array['0']} -> $array['0']
		/*$search_array[] 	= 	'~\{{\$([^[<].*?)\[\'([^[<].*?)\'\]\[\'([^[<].*?)\'\]\}}~';
		$replace_array[] 	= 	'$PowerBB->_CONF[\'template\'][\'\\1\'][\'\\2\'][\'\\3\']';*/

		// 2D Array :
		// 			{$array['0']} -> $array['0']
		$search_array[] 	= 	'~\{\$([^[<].*?)\[\'([^[<].*?)\'\]\[\'([^[<].*?)\'\]\}~';
		$replace_array[] 	= 	'<?php echo $PowerBB->_CONF[\'template\'][\'\\1\'][\'\\2\'][\'\\3\']; ?>';

		// 2D Array (Without print) :
		//			{$array[0]} -> $array[0]
		/*$search_array[] 	= 	'~\{{\$([^[<].*?)\[([^[<].*?)\]\[([^[<].*?)\]\}}~';
		$replace_array[] 	= 	'$PowerBB->_CONF[\'template\'][\'\\1\'][\'\\2\'][\'\\3\']';*/

		// 2D Array :
		//			{$array[0]} -> $array[0]
		$search_array[] 	= 	'~\{\$([^[<].*?)\[([^[<].*?)\]\[([^[<].*?)\]\}~';
		$replace_array[] 	= 	'<?php echo $PowerBB->_CONF[\'template\'][\'\\1\'][\'\\2\'][\'\\3\']; ?>';

		// Array (Without print) :
		// 			{$array['0']} -> $array['0']
		/*$search_array[] 	= 	'~\{{\$([^[<].*?)\[\'([^[<].*?)\'\]\}}~';
		$replace_array[] 	= 	'$PowerBB->_CONF[\'template\'][\'\\1\'][\'\\2\']';*/

		// Array :
		// 			{$array['0']} -> $array['0']
		$search_array[] 	= 	'~\{\$([^[<].*?)\[\'([^[<].*?)\'\]\}~';
		$replace_array[] 	= 	'<?php echo $PowerBB->_CONF[\'template\'][\'\\1\'][\'\\2\']; ?>';

		// Array (Without print) :
		//			{$array[0]} -> $array[0]
		/*$search_array[] 	= 	'~\{{\$([^[<].*?)\[([^[<].*?)\]\}}~';
		$replace_array[] 	= 	'$PowerBB->_CONF[\'template\'][\'\\1\'][\'\\2\']';*/

		// Array :
		//			{$array[0]} -> $array[0]
		$search_array[] 	= 	'~\{\$([^[<].*?)\[([^[<].*?)\]\}~';
		$replace_array[] 	= 	'<?php echo $PowerBB->_CONF[\'template\'][\'\\1\'][\'\\2\']; ?>';

		//////////

		/**
		 * Variable
		 */

		// Variable (Without print) :
		//				{$var} -> $var
		/*$search_array[] 	= 	'~\{{\$([^[<].*?)\}}~';
		$replace_array[] 	= 	'$PowerBB->_CONF[\'template\'][\'\\1\']';*/

		// Variable :
		//				{$var} -> $var
		$search_array[] 	= 	'~\{\$([^[<].*?)\}~';
		$replace_array[] 	= 	'<?php echo $PowerBB->_CONF[\'template\'][\'\\1\']; ?>';

		//////////

		/**
		 * Misc
		 */

		// Fetch another template in work template
		// {template}template_name{/template}
		$search_array[] 	= 	'~\{template}([^[<].*?){/template}~';
		$replace_array[] 	= 	'<?php $this->display(\'\\1\'); ?>';

		// Include anther file in template
		// {include}style.css{/include}
		$search_array[] 	= 	'~\{include}([^[<].*?){/include}~';
		$replace_array[] 	= 	'<?php include(\\1); ?>';

		//////////

 		$string = @preg_replace($search_array,$replace_array,$string);
 		$string = str_replace("['template']['lang']","['template']['_CONF']['lang']",$string);
 		$string = str_replace("['lang']['addons']","['lang']",$string);
        $string = str_replace("<!--copyright-->",$PowerBB->functions->copyright(),$string);

 		$string = $PowerBB->sys_functions->ReplaceMysqlExtension($string);

         $write  = @eval(" ?> ".$string." <?php ");

	}

	/**
	 * We have {Des::while} loop , that's mean probably we will fetch information from database
	 */
	function _ProccessWhile($string)
	{
		$search_array 		= 	array();
		$replace_array 		= 	array();

		// I am sorry, but we _must_ do that
		$string = @preg_replace('~\{Des::while}{([^[<].*?)}~ise','$this->_StoreWhileVarName(\'\\1\');',$string);

		// If statement _must_ be first
		if (preg_match('~\{if (.*)\}~',$string)
			or preg_match('~if (.*) {~',$string))
		{
			$string = $this->_ProccessIfStatement($string,'while');
		}

		foreach ($this->_while_var as $var_name)
		{
			$search_array[] 	=	'~\{\{\$' . $var_name . '\[([^[<].*?)\]\}\}~';
			$replace_array[] 	=	'$PowerBB->_CONF[\'template\'][\'while\'][\'' . $var_name . '\'][$this->x_loop][\\1]';

			$search_array[] 	=	'~\{\$' . $var_name . '\[([^[<].*?)\]\}~';
			$replace_array[] 	=	'<?php echo $PowerBB->_CONF[\'template\'][\'while\'][\'' . $var_name . '\'][$this->x_loop][\\1]; ?>';
		}

		$string 	= 	@preg_replace($search_array,$replace_array,$string);

		$string 	= 	str_replace('{/Des::while}','<?php $this->x_loop = $this->x_loop + 1; } ?>',$string);
		$string 	= 	str_replace('{Des::while::complete}','',$string);
		$string 	= 	str_replace('{/Des::while::complete}','',$string);

		$this->_while_var 		= 	null;
		$this->_while_var_num 	= 	0;

		return $string;
	}


	function _StoreWhileVarName($varname)
	{
		$this->_while_var[$this->_while_var_num] = $varname;

		$this->_while_var_num += 1;

		return '<?php $this->x_loop = 0; $this->size_loop = sizeof($PowerBB->_CONF[\'template\'][\'while\'][\'' . $varname . '\']); while ($this->x_loop < $this->size_loop) { ?>';
	}

	function _ProccessForeach($string)
	{
		$search_array 		= 	array();
		$replace_array 		= 	array();

		$string = @preg_replace('~\{Des::foreach}{([^[<].*?)}{([^[<].*?)}~ise','$this->_StoreForeachVarName(\'\\2\',\'\\1\');',$string);

		if (preg_match('~\{if (.*)\}~',$string)
			or preg_match('~if (.*) {~',$string))
		{
			$string = $this->_ProccessIfStatement($string,'foreach');
		}

		foreach ($this->_foreach_var as $var_name)
		{
			// Variable (Without print) :
			//				{$var} -> $var
			$search_array[] 	= 	'~\{{\$' . $var_name . '\}}~';
			$replace_array[] 	= 	'$' . $var_name;

			$search_array[] 	=	'~\{{\$' . $var_name . '\[([^[<].*?)\]}}~';
			$replace_array[] 	=	'$' . $var_name . '[\\1]';

			// Variable :
			//				{$var} -> $var
			$search_array[] 	= 	'~\{\$' . $var_name . '\}~';
			$replace_array[] 	= 	'<?php echo $' . $var_name . '; ?>';

			$search_array[] 	=	'~\{\$' . $var_name . '\[([^[<].*?)\]\}~';
			$replace_array[] 	=	'<?php echo $' . $var_name . '[\\1]; ?>';
		}

		$search_array[] 	=	'~\{counter}~';
		$replace_array[] 	=	'<?php echo $this->x_loop ?>';

		$search_array[] 	=	'~\{{counter}}~';
		$replace_array[] 	=	'$this->x_loop';

		$string 			= 	@preg_replace($search_array,$replace_array,$string);

		$string 			= 	str_replace('{/Des::foreach}','<?php $this->x_loop += 1; } ?>',$string);

		return $string;
	}

	function _StoreForeachVarName($varname,$oldname)
	{
		$this->_foreach_var[$this->_foreach_var_num] = $varname;

		$this->_foreach_var_num += 1;

		return '<?php foreach ($PowerBB->_CONF[\'template\'][\'foreach\'][\'' . $oldname . '\'] as $' . $varname . ') { ?>';
	}


	function _ProccessIfStatement($string,$type = null)
	{
		$search_array = array();
		$replace_array = array();

		// If statement :
		//					{if $i == 1} Hi {/if}
		//					if ($i == 1) { echo 'Hi'; }

		$search_array[] 	= 	'~\{if (.*)}(.*){/if}~'; // SEE : We have a problem here, \\2 may contain "else" or "elseif"
		$replace_array[] 	= 	'<?php if (\\1) { ?> \\2 <?php } ?>';

		$search_array[] 	= 	'~\{if (.*)}~';
		$replace_array[] 	= 	'<?php if (\\1) { ?>';

		$search_array[] 	= 	'~\{/if}~';
		$replace_array[] 	= 	'<?php } ?>';

		// Elseif statement
		$search_array[] 	= 	'~\{elseif (.*)}(.*){/if}~';
		$replace_array[] 	= 	'<?php elseif (\\1) { ?> \\2 <?php } ?>';

		$search_array[] 	= 	'~\{elseif (.*)}~';
		$replace_array[] 	= 	'<?php } elseif (\\1) { ?>';

		// Else statement
		$search_array[] 	= 	'~\{else}~';
		$replace_array[] 	= 	'<?php } else { ?>';

		$string = @preg_replace($search_array,$replace_array,$string);

		$string = @preg_replace('~\if (.*) \{~ie','$this->_ProccessIfStatementVariables(\'\\1\',\'' . $type . '\');',$string);

		return $string;
	}

	function _ProccessIfStatementVariables($input,$type = null)
	{
		$string = 'if ' . $input . ' { ';

		if ($type == 'while')
		{
			foreach ($this->_while_var as $var_name)
			{
				$search_array[] 	=	'~\{\$' . $var_name . '\[([^[<].*?)\]\}~';
				$replace_array[] 	=	'$PowerBB->_CONF[\'template\'][\'while\'][\'' . $var_name . '\'][$this->x_loop][\\1]';
			}
		}
		elseif ($type == 'foreach')
		{
			foreach ($this->_foreach_var as $var_name)
			{
				// Variable (Without print) :
				//				{$var} -> $var
				$search_array[] 	= 	'~\{\$' . $var_name . '\}~';
				$replace_array[] 	= 	'$' . $var_name;

				$search_array[] 	=	'~\{\$' . $var_name . '\[([^[<].*?)\]}~';
				$replace_array[] 	=	'$' . $var_name . '[\\1]';
			}
		}

		// 2D Array (Without print) :
		// 			{$array['0']} -> $array['0']
		$search_array[] 	= 	'~\{\$([^[<].*?)\[\'([^[<].*?)\'\]\[\'([^[<].*?)\'\]\}~';
		$replace_array[] 	= 	'$PowerBB->_CONF[\'template\'][\'\\1\'][\'\\2\'][\'\\3\']';

		// 2D Array (Without print) :
		//			{$array[0]} -> $array[0]
		$search_array[] 	= 	'~\{\$([^[<].*?)\[([^[<].*?)\]\[([^[<].*?)\]\}~';
		$replace_array[] 	= 	'$PowerBB->_CONF[\'template\'][\'\\1\'][\'\\2\'][\'\\3\']';

		// Array (Without print) :
		// 			{$array['0']} -> $array['0']
		$search_array[] 	= 	'~\{\$([^[<].*?)\[\'([^[<].*?)\'\]\}~';
		$replace_array[] 	= 	'$PowerBB->_CONF[\'template\'][\'\\1\'][\'\\2\']';

		// Array (Without print) :
		//			{$array[0]} -> $array[0]
		$search_array[] 	= 	'~\{\$([^[<].*?)\[([^[<].*?)\]\}~';
		$replace_array[] 	= 	'$PowerBB->_CONF[\'template\'][\'\\1\'][\'\\2\']';

		//////////

		/**
		 * Variable
		 */

		// Variable (Without print) :
		//				{$var} -> $var
		$search_array[] 	= 	'~\{\$([^[<].*?)\}~';
		$replace_array[] 	= 	'$PowerBB->_CONF[\'template\'][\'\\1\']';

		$string = @preg_replace($search_array,$replace_array,$string);

		$string = str_replace("['template']['lang']","['template']['_CONF']['lang']",$string);
 		$string = str_replace("['lang']['addons']","['lang']",$string);
		return $string;
	}

	/**
	 * If the template is already compiled , so include it
	 */
	function _GetCompiledFile($template_name,$content=false)
	{
		global $PowerBB;

		// Yeah it's here , include it .
		if (filesize($this->templates_dir . $template_name . $this->templates_ex) > 0)
		{
					$fp = fopen($this->templates_dir . $template_name . $this->templates_ex,'r');

					if (!$fp)
					{
						return 'ERROR::CAN_NOT_OPEN_THE_FILE';
					}

					$fr = fread($fp,filesize($this->templates_dir . $template_name . $this->templates_ex));

					fclose($fp);

					return $fr;

		}
		else
		{
			trigger_error('ERROR::FILE_SIZE_IS_ZERO',E_USER_ERROR);
		}
	}

	// Define variable to use it in template
	function assign($varname,$value)
	{
		global $PowerBB;

		$PowerBB->_CONF['template'][$varname] = $value;
	}

	// Stop script
	function _error($msg)
	{
		die($msg);
	}
}


?>
