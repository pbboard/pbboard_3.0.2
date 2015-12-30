<?php
class PowerBBCodeParse
{
 	function replace($string)
 	{
 		global $PowerBB;
 		$brackets = (strpos($string,'[') !== false) and (strpos($string,']') !== false);

        if ($brackets)
 		{
            //$string = htmlspecialchars($string);
            //$string = $PowerBB->functions->pbb_stripslashes($string);

	         // jwplayer tag replace
	        $jwplayer_search = array();
	 		$jwplayer_replace = array();
	        $jwplayer_search['[jwplayer]'] = '#\[jwplayer=(.*),(.*),(.*),(.*)\](.*)\[/jwplayer\]#esiU';
	        $jwplayer_replace['[jwplayer]'] = "\$this->jwplayer('\\1','\\2','\\3','\\4','\\5')";
	        $string = @preg_replace($jwplayer_search,$jwplayer_replace,$string);

            // start regex
 			$first_search = array();
 			$first_replace = array();

            $first_search['[code]'] = '#\[code\](.*)\[/code\]#esiU';
            $first_replace['[code]'] = "\$this->PowerCode_Code('\\1','1')";

            $first_search['[php]'] = '#\[php\](.*)\[/php\]#esiU';
            $first_replace['[php]'] = "\$this->PowerCode_Code('\\1','1')";

 			$string = @preg_replace($first_search,$first_replace,$string);

			//$string = @str_ireplace("[youtube]","",$string);
			//$string = @str_ireplace("[/youtube]","",$string);


 			$search_array = array();
 			$replace_array = array();

            $search_array['[color='] = '#\[color=(.*)\](.*)\[/color\]#esiU';
            $replace_array['[color='] = "\$this->PowerCode_Tag('font', '\\2', ' color=\"\\1\" ')";

            $search_array['[font='] = '#\[font=(.*)\](.*)\[/font\]#esiU';
            $replace_array['[font='] = "\$this->PowerCode_Tag('font', '\\2', ' face=\"\\1\"')";

            $search_array['[b]'] = '#\[b\](.*)\[/b\]#esiU';
            $replace_array['[b]'] = "\$this->PowerCode_Tag('b', '\\1')";

            $search_array['[u]'] = '#\[u\](.*)\[/u\]#esiU';
            $replace_array['[u]'] = "\$this->PowerCode_Tag('u', '\\1')";

            $search_array['[i]'] = '#\[i\](.*)\[/i\]#esiU';
            $replace_array['[i]'] = "\$this->PowerCode_Tag('i', '\\1')";

      	    $search_array['[s]'] = '#\[s\](.*)\[/s\]#esiU';
            $replace_array['[s]'] = "\$this->PowerCode_Tag('s', '\\1')";

            $search_array['[youtube]'] = '#\[youtube\](.*)\[/youtube\]#esiU';
            $replace_array['[youtube]'] = "\$this->PowerCode_Youtube('\\1', '\\1')";
            $search_array['[youtube='] = '#\[youtube=(.*)\](.*)\[/youtube\]#esiU';
            $replace_array['[youtube='] = "\$this->PowerCode_Youtube('\\1', '\\2')";

            $search_array['[blockquote]'] = '#\[blockquote\](.*)\[/blockquote\]#esiU';
            $replace_array['[blockquote]'] = "\$this->PowerCode_Tag('blockquote', '\\1')";

            $search_array['[indent]'] = '#\[indent\](.*)\[/indent\]#esiU';
            $replace_array['[indent]'] = "\$this->PowerCode_Tag('blockquote', '\\1')";

            $search_array['[right]'] = '#\[right\](.*)\[/right\]#esiU';
            $replace_array['[right]'] = "\$this->PowerCode_Tag('div', '\\1', ' align=\"right\"')";

            $search_array['[left]'] = '#\[left\](.*)\[/left\]#esiU';
            $replace_array['[left]'] = "\$this->PowerCode_Tag('div', '\\1', ' align=\"left\"')";

            $search_array['[justify]'] = '#\[justify\](.*)\[/justify\]#esiU';
            $replace_array['[justify]'] = "\$this->PowerCode_Tag('div', '\\1', ' align=\"justify\"')";

            $search_array['[JUSTIFY]'] = '#\[JUSTIFY\](.*)\[/JUSTIFY\]#esiU';
            $replace_array['[JUSTIFY]'] = "\$this->PowerCode_Tag('div', '\\1', ' align=\"justify\"')";

            $search_array['[h1]'] = '#\[h1\](.*)\[/h1\]#esiU';
            $replace_array['[h1]'] = "\$this->PowerCode_Tag('h1', '\\1')";

            $search_array['[h2]'] = '#\[h2\](.*)\[/h2\]#esiU';
            $replace_array['[h2]'] = "\$this->PowerCode_Tag('h2', '\\1')";

            $search_array['[h3]'] = '#\[h3\](.*)\[/h3\]#esiU';
            $replace_array['[h3]'] = "\$this->PowerCode_Tag('h3', '\\1')";

            $search_array['[h4]'] = '#\[h4\](.*)\[/h4\]#esiU';
            $replace_array['[h4]'] = "\$this->PowerCode_Tag('h4', '\\1')";

            $search_array['[h5]'] = '#\[h5\](.*)\[/h5\]#esiU';
            $replace_array['[h5]'] = "\$this->PowerCode_Tag('h5', '\\1')";

            $search_array['[h6]'] = '#\[h6\](.*)\[/h6\]#esiU';
            $replace_array['[h6]'] = "\$this->PowerCode_Tag('h6', '\\1')";

            $search_array['[highlight='] = '#\[highlight=(.*)\](.*)\[/highlight\]#esiU';
            $replace_array['[highlight='] = "\$this->PowerCode_Tag('span', '\\2',' style=\"background: \\1\"')";

            $search_array['[center]'] = '#\[center\](.*)\[/center\]#esiU';
            $replace_array['[center]'] = "\$this->PowerCode_Tag('div', '\\1', ' align=\"center\"')";

            $search_array['[-WEBKIT-CENTER]'] = '#\[-WEBKIT-CENTER\](.*)\[/-WEBKIT-CENTER\]#esiU';
            $replace_array['[-WEBKIT-CENTER]'] = "\$this->PowerCode_Tag('div', '\\1', ' align=\"center\"')";

            $search_array['[quote='] = '#\[quote=(.*)\](.*)\[/quote\]#esiU';
            $replace_array['[quote='] = "\$this->PowerCode_Quote('\\2', '\\1')";

            $search_array['[quote]'] = '#\[quote\](.*)\[/quote\]#esiU';
            $replace_array['[quote]'] = "\$this->PowerCode_Quote('\\1')";

            $search_array['[qu]'] = '#\[qu\](.*)\[/qu\]#esiU';
            $replace_array['[qu]'] = "\$this->PowerCode_Quote('\\1')";


            $search_array['[media]'] = '#\[media\](.*)\[/media\]#esiU';
            $replace_array['[media]'] = "\$this->PowerCode_Media('\\1', '\\1')";
            $search_array['[media='] = '#\[media=(.*)\](.*)\[/media\]#esiU';
            $replace_array['[media='] = "\$this->PowerCode_Media('\\1', '\\2')";

            $search_array['[ram]'] = '#\[ram\](.*)\[/ram\]#esiU';
            $replace_array['[ram]'] = "\$this->PowerCode_Ram('\\1', '\\1')";
            $search_array['[ram='] = '#\[ram=(.*)\](.*)\[/ram\]#esiU';
            $replace_array['[ram='] = "\$this->PowerCode_Ram('\\1', '\\2')";

            $search_array['[Flash='] = '#\[flash=(&quot;|"|\'|)(.*)\\1\](height=)\\1([0-9]+)\\1[ ]+(width=)\\1([0-9]+)\\1\[/flash\]#esiU';
            $replace_array['[Flash='] = "\$this->PowerCode_Flash('\\2', '\\6','\\4', 'flash')";
            $search_array['[Flash='] = '#\[flash=(&quot;|"|\'|)(.*)\\1\]([w|W][i|I][d|D][t|T][h|H][=])\\1([0-9]+)\\1[ ]+([h|H][e|E][i|I][g|G][h|H][t|T][=])\\1([0-9]+)\\1\[/flash\]#esiU';
            $replace_array['[Flash='] = "\$this->PowerCode_Flash('\\2', '\\6','\\4', 'flash')";

            $search_array['[frame]'] = '#\[frame\](.*)\[/frame\]#esiU';
            $replace_array['[frame]'] = "\$this->PowerCode_frame('\\1', '\\1')";
            $search_array['[frame='] = '#\[frame=(.*)\](.*)\[/frame\]#esiU';
            $replace_array['[frame='] = "\$this->PowerCode_frame('\\1', '\\2')";

            $search_array['[gradient]'] = '#\[gradient\](.*)\[/gradient\]#esiU';
            $replace_array['[gradient]'] = "\$this->PowerCode_gradient('\\1', '\\1')";
            $search_array['[gradient='] = '#\[gradient=(.*)\](.*)\[/gradient\]#esiU';
            $replace_array['[gradient='] = "\$this->PowerCode_gradient('\\1', '\\2')";

            $search_array['[poem]'] = '#\[poem\](.*)\[/poem\]#esiU';
            $replace_array['[poem]'] = "\$this->PowerCode_poem('\\1', '\\1')";
            $search_array['[poem='] = '#\[poem=(.*)\](.*)\[/poem\]#esiU';
            $replace_array['[poem='] = "\$this->PowerCode_poem('\\1', '\\2')";

            $search_array['[hr]'] = '#\[hr\](.*)\[/hr\]#esiU';
            $replace_array['[hr]'] = "\$this->PowerCode_Tag('span', '<HR id=null>')";

            $search_array['[sub]'] = '#\[sub\](.*)\[/sub\]#esiU';
            $replace_array['[sub]'] = "\$this->PowerCode_Tag('SUB', '\\1')";

            $search_array['[sup]'] = '#\[sup\](.*)\[/sup\]#esiU';
            $replace_array['[sup]'] = "\$this->PowerCode_Tag('SUP', '\\1')";

            $search_array['[table]'] = '#\[table\](.*)\[/table\]#esiU';
            $replace_array['[table]'] = "\$this->PowerCode_table('\\1')";

            $search_array['[tr]'] = '#\[tr\](.*)\[/tr\]#esiU';
            $replace_array['[tr]'] = "\$this->PowerCode_tr('\\1')";

            $search_array['[td]'] = '#\[td\](.*)\[/td\]#esiU';
            $replace_array['[td]'] = "\$this->PowerCode_td('\\1')";

            $search_array['[th]'] = '#\[th\](.*)\[/th\]#esiU';
            $replace_array['[th]'] = "\$this->PowerCode_th('\\1')";

            $search_array['[size='] = '#\[size=(.*)\](.*)\[/size\]#esiU';
            $replace_array['[size='] = "\$this->PowerCode_Tag('font', '\\2', ' size=\"\\1\" ')";

			$search_array['[list]'] = '#\[list\](.*)\[/list\]#esiU';
			$replace_array['[list]'] ="\$this->DoListli('\\1')";

			$search_array['[list='] = '#\[list=(1|2)\](.*)\[/list\]#esiU';
			$replace_array['[list='] ="\$this->DoList('\\1','\\2')";

            $search_array['[guest_name]'] = '#\[guest_name\](.*)\[/guest_name\]#esiU';
            $replace_array['[guest_name]'] = "\$this->PowerCode_Tag('br', '\\1' )";

            $PowerBB->functions->get_hooks('BBCodeParseHooks1');

			foreach($search_array AS $tag => $regex)
			{
			  while (stristr($string, $tag) !== false)
			  {
			          $text = $string;
			          $string = @preg_replace($regex, $replace_array["$tag"], $string);
			          if ($text == $string)
			          {
			                  break;
			          }
			  }
			}

              $string = @preg_replace($search_array,$replace_array ,$this->closetags($string));

         }
          if(@strstr($string,"<br")
          or @strstr($string,"<table"))
          {
          	$string = $string;
          }
          else
          {
          	$string = nl2br($string);

          }

        $string = $this->text_with_hyperlink($string);
        return $this->closetags($PowerBB->sys_functions->fetch_gzipped_text($string));
 	}

 	function Simplereplace($string)
 	{
 		$brackets = (strpos($string,'[') !== false) and (strpos($string,']') !== false);

        if ($brackets)
 		{
			$search_array = array();
			$replace_array = array();

			$search_array['[color='] = '#\[color=(.*)\](.*)\[/color\]#esiU';
			$replace_array['[color='] = "\$this->PowerCode_Tag('font', '\\2', ' color=\"\\1\" ')";

			$search_array['[font='] = '#\[font=(.*)\](.*)\[/font\]#esiU';
			$replace_array['[font='] = "\$this->PowerCode_Tag('font', '\\2', ' face=\"\\1\"')";

			$search_array['[b]'] = '#\[b\](.*)\[/b\]#esiU';
			$replace_array['[b]'] = "\$this->PowerCode_Tag('b', '\\1')";

			$search_array['[u]'] = '#\[u\](.*)\[/u\]#esiU';
			$replace_array['[u]'] = "\$this->PowerCode_Tag('u', '\\1')";

			$search_array['[i]'] = '#\[i\](.*)\[/i\]#esiU';
			$replace_array['[i]'] = "\$this->PowerCode_Tag('i', '\\1')";

			$search_array['[s]'] = '#\[s\](.*)\[/s\]#esiU';
			$replace_array['[s]'] = "\$this->PowerCode_Tag('s', '\\1')";


			$string = @preg_replace($search_array,$replace_array ,$this->closetags($string));
 	   }
 	return $this->closetags($string);
 	}
 	    function PowerCode_Tag($tag, $message, $att = '')
        {

				if (trim($message) == '')
                {
                        return '';
                }

				if (count(explode('=',$att)) > 2)
                {
                        return $message;
                }

                $message = str_replace('\\"', '"', $message);

                if($tag == 'tag')
                {
                        return $message;
                }
                return "<$tag$att>$message</$tag>";
        }

         function PowerCode_Tag_BBcode($bbcode_replace,$bbcode_tag,$message)
        {
        	global $PowerBB;
				if (trim($message) == '')
                {
                        return '';
                }
                $bbcode_replace = ($bbcode_replace);
                $bbcode_replace = str_replace("&#39;","'",$bbcode_replace);
                $message = str_replace('\\"', '"', $message);
                $bbcode_replace = str_replace("#", '', $bbcode_replace);
                $bbcode_replace = str_replace("{content}",$message, $bbcode_replace);
                $bbcode_replace = str_replace("{option}","", $bbcode_replace);

                return $bbcode_replace;
        }

 	  function PowerCode_Quote($message, $username = '')
        {
        	global $PowerBB;

                if (trim($message) == '')
                {
                        return '';
                }

                $message = str_replace('\\"', '"', $message);
               $message= $this->closetags($message);
                $message = str_replace('<div', '<span', $message);
                $message = str_replace('div>', 'span>', $message);
                if($username)
                {
                   $Quote = '<blockquote class="quotetop">' .$PowerBB->_CONF['template']['_CONF']['lang']['quote_username'] .' '. $username . '  » </blockquote><blockquote class="quotemain">' . $message . '</blockquote>';
                }
                else
                {
                   $Quote ='<blockquote class="quotetop">'.$PowerBB->_CONF['template']['_CONF']['lang']['quote'].'</blockquote><blockquote class="quotemain">' . $message . '</blockquote>';
                }


             return $Quote;

        }

 	  function PowerCode_table($txt)
        {
        	global $PowerBB;


                if (trim($txt) == '')
                {
                        return '';
                }

                $txt = str_replace('\\"', '"', $txt);

                return '<table align="center" border="0" cellspacing="1" class="Code_table" width="98%">' . $txt . '</table>';
        }

	  function text_with_hyperlink($string)
        {
        	global $PowerBB;

			if (trim($string) == '')
			{
			return '';
			}
               $PowerBB->functions->get_hooks('BBCodeParseHooks5');
              $string = str_replace('\\"', '"', $string);

				$Guest_message = ($PowerBB->_CONF['info_row']['guest_message_for_haid_links']);
				$register_link = ('index.php?page=register&amp;index=1');
				if ($PowerBB->_CONF['info_row']['haid_links_for_guest'] == 0)
				{
			        $string = @preg_replace(",([^]_a-z0-9-=\"'\/])((https?|ftp|gopher|news|telnet):\/\/|www\.)([^ \r\n\(\)\*\^\$!`\"'\|\[\]\{\}<>]*),i", "<a href=\"$2$4\" target=\"_blank\" title=\"$2$4\">$2$4</a>",$string);
			        $string = @preg_replace(",^((https?|ftp|gopher|news|telnet):\/\/|\.)([^ \r\n\(\)\*\^\$!`\"'\|\[\]\{\}<>]*),i", "<a href=\"$1$3\" target=\"_blank\" title=\"$1$3\">$1$3</a>",$string);
				}
				else
				{
	                 if ($PowerBB->_CONF['member_permission'])
					 {
			           $string = @preg_replace(",([^]_a-z0-9-=\"'\/])((https?|ftp|gopher|news|telnet):\/\/|www\.)([^ \r\n\(\)\*\^\$!`\"'\|\[\]\{\}<>]*),i", "<a href=\"$2$4\" target=\"_blank\" title=\"$2$4\">$2$4</a>",$string);
			           $string = @preg_replace(",^((https?|ftp|gopher|news|telnet):\/\/|\.)([^ \r\n\(\)\*\^\$!`\"'\|\[\]\{\}<>]*),i", "<a href=\"$1$3\" target=\"_blank\" title=\"$1$3\">$1$3</a>",$string);
                     }
	                if (!$PowerBB->_CONF['member_permission'])
					{
			        $string = @preg_replace(",([^]_a-z0-9-=\"'\/])((https?|ftp|gopher|news|telnet):\/\/|www\.)([^ \r\n\(\)\*\^\$!`\"'\|\[\]\{\}<>]*),i", "<a href=\"$register_link\" target=\"_blank\" title=\"$Guest_message\">$Guest_message</a>",$string);
			        $string = @preg_replace(",^((https?|ftp|gopher|news|telnet):\/\/|\.)([^ \r\n\(\)\*\^\$!`\"'\|\[\]\{\}<>]*),i", "<a href=\"$register_link\" target=\"_blank\" title=\"$Guest_message\">$Guest_message</a>",$string);
			        $string = @preg_replace('/<a(.*?)>(.*?)<\/a>/is', "<a href=\"$register_link\" target=\"_blank\" title=\"$Guest_message\">$Guest_message</a>",$string);

  	                }
				}


			$search_array['[url]'] = '#\[url\](.*)\[/url\]#esiU';
			$replace_array['[url]'] = "\$this->PowerCode_Tag_Url('\\1', '\\1')";

			$search_array['[url='] = '#\[url=(.*)\](.*)\[/url\]#esiU';
			$replace_array['[url='] = "\$this->PowerCode_Tag_Url('\\1', '\\2')";

			$search_array['[email]'] = '#\[email\](.*)\[/email\]#esiU';
			$replace_array['[email]'] = "\$this->PowerCode_Tag_Url('mailto:\\1', '\\1')";

			$search_array['[email='] = '#\[url=mailto:(.*)\](.*)\[/url\]#esiU';
			$replace_array['[email='] = "\$this->PowerCode_Tag_Url('mailto:\\1', '\\2')";

			$search_array[] = '/([ \n\r\t])([_a-z0-9-+]+(\.[_a-z0-9-+]+)*@[^\s]+(\.[a-z0-9-]+)*(\.[a-z]{2,6}))/si';
			$replace_array[] = $this->PowerCode_Tag_Url('mailto:\\2', '\\2');

			$search_array[] = '/^([_a-z0-9-+]+(\.[_a-z0-9-+]+)*@[^\s]+(\.[a-z0-9-]+)*(\.[a-z]{2,6}))/si';
			$replace_array[] = $this->PowerCode_Tag_Url('mailto:\\0', '\\0');

			$string = @preg_replace($search_array,$replace_array ,$string);

            $string = str_replace('"<a', '"><a', $string);
            $string = str_replace('href="www.', 'href="http://www.', $string);


            $PowerBB->functions->get_hooks('BBCodeParseHooks4');

			return $string;
        }

 	  function PowerCode_tr($txt)
        {
        	global $PowerBB;

                if (trim($txt) == '')
                {
                        return '';
                }

                $txt = str_replace('\\"', '"', $txt);

                return '<tr>' . $txt . '</tr>';
        }

 	  function PowerCode_td($txt)
        {
        	global $PowerBB;


                if (trim($txt) == '')
                {
                        return '';
                }

                $txt = str_replace('\\"', '"', $txt);
                return '<td class="Code_td">&nbsp;' . $txt . '</td>';
        }

 	  function PowerCode_th($txt)
        {
        	global $PowerBB;

                if (trim($txt) == '')
                {
                        return '';
                }

                $txt = str_replace('\\"', '"', $txt);

                return '<th style="font-size: 20px; border: none;border: 1px solid #789DB3; background-color: #F4F4F4;">&nbsp;' . $txt . '</th>';
        }

	function PowerCode_Code($txt, $var)
	{
		global $PowerBB;

            if ($PowerBB->_POST['preview'] == false)
            {
              // $txt = $PowerBB->functions->pbb_stripslashes($txt);
            }
			if($var)
			{
				$txt = base64_encode($txt);
		        return '[code]'.$txt.'[/code]';
	        }
	        elseif($var =='0')
	        {
			     $txt = base64_decode($txt);
                 $txt = str_replace("&amp;#39;", "'", $txt);
	             return '<div class="codemain"><pre style="float: left;" class="brush:php">'.$txt.'</pre></div>';
	        }

        $PowerBB->functions->get_hooks('BBCodeParseHooks8');

	}

		function PowerCode_Email($link, $message)
        {
			if (preg_match('#^[a-z0-9.!\#$%&\'*+-/=?^_`{|}~]+@([0-9.]+|([^\s\'"<>@,;]+\.+[a-z]{2,6}))$#si', $link))
			{
                return "<a href=\"mailto:$link\" target=\"_blank\">$message</a>";
			}
			else
			{
                return '';
			}
        }

		function PowerCode_Youtube($linky, $messages)
        {
            	global $PowerBB;

                $linky = str_replace('\\"', '"', $linky);
                $linky = @str_ireplace("youtube.com/embed/", "youtube.com/watch?v=", $linky);
                $linky = @str_ireplace("youtu.be/", "youtube.com/watch?v=", $linky);
                $linky = str_replace("youtube.com/embed/", "youtube.com/watch?v=", $linky);
                $linky = str_replace("youtu.be/", "youtube.com/watch?v=", $linky);
                $linky = str_replace('&lt;br /&gt;"', "<br />", $linky);
                $linky = str_replace("&lt;", "<", $linky);
                $linky = str_replace("&quot;", '"', $linky);
                $linky = str_replace("&gt;", ">", $linky);

                $linky = str_replace(array('"', "'"), array('&quot;', '&#39;'), $linky);
                $linky = str_replace(array('/watch?', "v="), array('/v', '/'), $linky);

             return "<span id='ytplayer'><object id='ytplayer' width='560' height='315'><param name='movie' value='$linky'></param><param name='allowFullScreen' value='true'></param><param id='ytplayer' name='allowscriptaccess' value='always'></param><embed id='ytplayer' src='$linky' type='application/x-shockwave-flash' allowscriptaccess='always' allowfullscreen='false' allownetworking='internal' width='560' height='315'></embed></object></span>";
            // return "<iframe id='ytplayer' type='text/html' width='560' height='315' src='$linky' frameborder='0' allowfullscreen></iframe>";
         }


		function PowerCode_BBcode($option, $content, $bbcode_tag)
        {
		      global $PowerBB;

                $content = str_replace('\\"', '"', $content);
            if ($PowerBB->_POST['preview'] == false)
            {
                    $content = $PowerBB->functions->pbb_stripslashes($content);
            }
                $querybbcode1 = $PowerBB->DB->sql_query("SELECT * FROM " . $PowerBB->table['custom_bbcode'] . " WHERE bbcode_tag = '$bbcode_tag' ");
				$bbcode_row1 = $PowerBB->DB->sql_fetch_array($querybbcode1);

				$bbcode_replace = $bbcode_row1['bbcode_replace'];
                $bbcode_replace = str_replace("&#39;","'",$bbcode_replace);
                $bbcode_replace = str_replace( "{option}",$option , $bbcode_replace );
                $bbcode_replace = str_replace("{content}", $content, $bbcode_replace);

                return $bbcode_replace;

         }

		function PowerCode_Media($linky, $messages)
        {
		      global $PowerBB;

                if (trim($messages) == '')
                {
                        return '';
                }

                $messages = str_replace('\\"', '"', $messages);
                $messages = str_replace('&lt;br /&gt;"', "<br />", $messages);
                $messages = str_replace("&lt;", "<", $messages);
                $messages = str_replace("&quot;", '"', $messages);
                $messages = str_replace("&gt;", ">", $messages);

                $linky = str_replace('\\"', '"', $linky);
                $linky = str_replace('&lt;br /&gt;"', "<br />", $linky);
                $linky = str_replace("&lt;", "<", $linky);
                $linky = str_replace("&quot;", '"', $linky);
                $linky = str_replace("&gt;", ">", $linky);

                $linky = str_replace(array('"', "'"), array('&quot;', '&#39;'), $linky);
                return "<span><object width='350' height='350'><param name='movie' value='$linky'><PARAM name='ShowControls' VALUE='true'><param name='ShowStatusBar' value='true'><PARAM name='ShowDisplay' VALUE='false'><PARAM name='autostart' VALUE='false'><embed src='$linky' type='vudio/x-pn-realaudio-plugin' ShowControls='1' ShowStatusBar='1' ShowDisplay='0' autostart='0' width='350' height='300'></embed></object></span>";
         }

		function PowerCode_Ram($linky, $messages)
        {
        			      global $PowerBB;

                if (trim($messages) == '')
                {
                        return '';
                }
                $messages = str_replace('\\"', '"', $messages);
                $messages = str_replace('&lt;br /&gt;"', "<br />", $messages);
                $messages = str_replace("&lt;", "<", $messages);
                $messages = str_replace("&quot;", '"', $messages);
                $messages = str_replace("&gt;", ">", $messages);

                $linky = str_replace('\\"', '"', $linky);
                $linky = str_replace('&lt;br /&gt;"', "<br />", $linky);
                $linky = str_replace("&lt;", "<", $linky);
                $linky = str_replace("&quot;", '"', $linky);
                $linky = str_replace("&gt;", ">", $linky);

                $linky = str_replace(array('"', "'"), array('&quot;', '&#39;'), $linky);
                return "<span><object width='275' height='40'><param name='movie' value='$linky'></param><param name='autostart' value='true'></param><param name='allowscriptaccess' value='always'></param><embed src='$linky' type='audio/x-pn-realaudio-plugin' allowscriptaccess='always' allowfullscreen='true' width='275' height='40'></embed></object></span>";

         }

        function PowerCode_Flash ($message, $param1 = '', $param2 = '', $type = '' )
		{
		      global $PowerBB;

			if (trim($message) == '' || $type == '')
			{
			return '';
		    }

			if (!preg_match('#^[a-z]+://#si', $message)){
			return '';
			}

                $param1 = str_replace('\\"', '"', $param1);
                $param1 = str_replace('&lt;br /&gt;"', "<br />", $param1);
                $param1 = str_replace("&lt;", "<", $param1);
                $param1 = str_replace("&quot;", '"', $param1);
                $param1 = str_replace("&gt;", ">", $param1);

                $param2 = str_replace('\\"', '"', $param2);
                $param2 = str_replace('&lt;br /&gt;"', "<br />", $param2);
                $param2 = str_replace("&lt;", "<", $param2);
                $param2 = str_replace("&quot;", '"', $param2);
                $param2 = str_replace("&gt;", ">", $param2);

                $messages = str_replace('\\"', '"', $messages);
                $messages = str_replace('&lt;br /&gt;"', "<br />", $messages);
                $messages = str_replace("&lt;", "<", $messages);
                $messages = str_replace("&quot;", '"', $messages);
                $messages = str_replace("&gt;", ">", $messages);

			$param1 = intval($param1);
			$param2 = intval($param2);
            $html = '<span><embed src="'.$message.'" width="'.$param2.'" height="'.$param1.'" quality=high wmode=transparent loop=true menu=false TYPE="application/x-shockwave-flash"></embed></span>';

			return $html;
	    }



       function PowerCode_frame($option_frame, $content_frame)
        {
		      global $PowerBB;
                if (trim($content_frame) == '')
                {
                        return '';
                }

                $content_frame = str_replace('\\"', '"', $content_frame);
                if ($PowerBB->_CONF['info_row']['content_dir'] == 'ltr')
                {
				$bbcode_replace_frame = '<br/><table border="0" width="98%" cellpadding="0" cellspacing="0"><tr><td width="1%"><img src="look/images/myframes/{option}_cul.gif" alt=""  border="0" /></td><td width="100%" style="background-image: url(look/images/myframes/{option}_u.gif)"></td><td width="1%"><img src="look/images/myframes/{option}_cur.gif" alt=""  border="0" /></td></tr><tr><td width="1%" style="background-image: url(look/images/myframes/{option}_l.gif)"></td><td align="center" width="100%" style="background-image: url(look/images/myframes/{option}.gif)">{content}</td><td width="1%" style="background-image: url(look/images/myframes/{option}_r.gif)"></td></tr><tr><td width="1%"><img src="look/images/myframes/{option}_cdl.gif" alt=""  border="0" /></td><td width="100%" style="background-image: url(look/images/myframes/{option}_d.gif)"></td><td width="1%"><img src="look/images/myframes/{option}_cdr.gif" alt=""  border="0" /></td></tr></table>';
                }
                else
                {
				$bbcode_replace_frame = '<br/><table border="0" width="98%" cellpadding="0" cellspacing="0"><tr><td width="1%"><img src="look/images/myframes/{option}_cur.gif" alt=""  border="0" /></td><td width="100%" style="background-image: url(look/images/myframes/{option}_u.gif)"></td><td width="1%"><img src="look/images/myframes/{option}_cul.gif" alt=""  border="0" /></td></tr><tr><td width="1%" style="background-image: url(look/images/myframes/{option}_r.gif)"></td><td align="center" width="100%" style="background-image: url(look/images/myframes/{option}.gif)">{content}</td><td width="1%" style="background-image: url(look/images/myframes/{option}_l.gif)"></td></tr><tr><td width="1%"><img src="look/images/myframes/{option}_cdr.gif" alt=""  border="0" /></td><td width="100%" style="background-image: url(look/images/myframes/{option}_d.gif)"></td><td width="1%"><img src="look/images/myframes/{option}_cdl.gif" alt=""  border="0" /></td></tr></table>';
                }
                $bbcode_replace_frame = str_replace("{option}",$option_frame ,  $bbcode_replace_frame);
                $bbcode_replace_frame = str_replace("{content}", $content_frame, $bbcode_replace_frame);
                $bbcode_replace_frame = str_replace("&#39;",'"',$bbcode_replace_frame);

               // return $bbcode_replace_frame;
                return $content_frame;

         }

       function PowerCode_gradient($option_gradient, $content_gradient)
        {
		      global $PowerBB;
                if (trim($content_gradient) == '')
                {
                        return '';
                }

                $content_gradient = str_replace('\\"', '"', $content_gradient);

				$bbcode_replace_gradient = '<div id="mygradient" title="{option}" style="display:none">{content}</div><script type="text/javascript">drawGradient()</script>';
                $bbcode_replace_gradient = str_replace("{option}",$option_gradient ,  $bbcode_replace_gradient);
                $bbcode_replace_gradient = str_replace("{content}", $content_gradient, $bbcode_replace_gradient);
                $bbcode_replace_gradient = str_replace("&#39;",'"',$bbcode_replace_gradient);

                //return $bbcode_replace_gradient;
                return $content_gradient;

         }

      function PowerCode_poem($option_poem, $content_poem)
        {
		      global $PowerBB;
                if (trim($content_poem) == '')
                {
                        return '';
                }

                $content_poem = str_replace('\\"', '"', $content_poem);

				$bbcode_replace_poem = '<div tag="{option}">{content}</div><script type="text/javascript">doPoem(0)</script>';
                $bbcode_replace_poem = str_replace("{option}",$option_poem ,  $bbcode_replace_poem);
                $bbcode_replace_poem = str_replace("{content}", $content_poem, $bbcode_replace_poem);
                $bbcode_replace_poem = str_replace('\"','"',$bbcode_replace_poem);

               // return $bbcode_replace_poem;
                return $content_poem;
         }

 	    function DoListli($txt)
        {
        	global $PowerBB;


                if (trim($txt) == '')
                {
                        return '';
                }

                $txt = str_replace('\\"', '"', $txt);

           return '' . $txt . '';
        }


        function DoList($mark,$item)
         {

                  if ($mark=="1")
                  {
                      $tag = "ol";
                  }
                  else
                  {
                      $tag = "ul";
                  }

                  $return = "<".$tag.">";

                  $new_item = explode("[*]" , $item);
                  $new_item = str_replace('\\"', '"', $new_item);
                  for ($i=1; $i <= count($new_item); $i++)
                  {
                       if ($new_item[$i]!="")
                       {
                           $return .= "<li>".$new_item[$i]."</li>";
                       }
                  }

                  $return .= "</".$tag.">";
                  return $return;
         }


 	function censor_words($text)
	{
		global $PowerBB;
       // feltr words
    	 static $blanks = null;
		if ($PowerBB->_GET['page'] != 'profile')
		{
             if ($PowerBB->_POST['preview'] == false)
            {
              $text = $PowerBB->functions->pbb_stripslashes($text);
            }

		}
         $text = str_replace('\\"', '"', $text);

		 $text = @preg_replace('#\<li\>(.*)\</li\>#esiU',"\$this->li_not_bar('\\1')",$text);
		 $text = str_replace("&amp;","&",$text);
         $text = str_replace('{39}',"'",$text);
         $text = str_replace('&#092;&#092;',"&#092;",$text);
         $text = str_replace("&amp;#39;","'",$text);
         $text = str_replace("&#39;","'",$text);
         $text = str_replace('<p align="left">','<p dir="ltr" align="left">',$text);
         $text = str_replace("&amp;#092;","\(:*:)",$text);
         $text = str_replace("(:*:)","",$text);
		 $text = str_replace( "#text_area#"   , "textarea ", $text );
         $text = @str_ireplace("<script", "&lt;script", $text);
         $text = @str_ireplace("<meta", "&lt;meta", $text);
          // regex iframe
        $text = @str_ireplace("<iframe", '<iframe sandbox="allow-popups allow-same-origin"', $text);

          // nofollow links out said
        $text = @str_ireplace('target="_blank"', '', $text);
        $text = @str_ireplace("target='_blank'", '', $text);
        $text = @str_ireplace('rel="dofollow"', '', $text);
        $text = @str_ireplace('rel="nofollow"', '', $text);


		$GetHOSThttp  = "http://".$PowerBB->_SERVER['HTTP_HOST'];
		$text = @str_ireplace('href="'.$GetHOSThttp,'rel="dofollow" href="'.$GetHOSThttp,$text);
		$text = @str_ireplace('href="'.!$GetHOSThttp,'rel="nofollow" href="'.!$GetHOSThttp,$text);

		$GetHOSTwww  = "www.".$PowerBB->_SERVER['HTTP_HOST'];
		$text = @str_ireplace('href="'.$GetHOSTwww,'rel="dofollow" href="'.$GetHOSTwww,$text);
		$text = @str_ireplace('href="'.!$GetHOSTwww,'rel="nofollow" href="'.!$GetHOSTwww,$text);

		$GetHOSThttpwww  = "http://www.".$PowerBB->_SERVER['HTTP_HOST'];
		$text = @str_ireplace('href="'.$GetHOSThttpwww,'rel="dofollow" href="'.$GetHOSThttpwww,$text);
		$text = @str_ireplace('href="'.!$GetHOSThttpwww,'rel="nofollow" href="'.!$GetHOSThttpwww,$text);
        //
        $text = @str_ireplace("<a ", '<a target="_blank" ', $text);

        $text = @str_ireplace('rel="dofollow" rel="dofollow"', '', $text);
        $text = @str_ireplace('rel="nofollow" rel="nofollow"', '', $text);
        $text = @str_ireplace('rel="dofollow"  rel="nofollow"', 'rel="dofollow"', $text);

        $text = @str_ireplace('"   rel="', '" rel="', $text);
        $text = @str_ireplace('blank"  rel="', 'blank" rel="', $text);
        $text = @str_ireplace('target="_blank" rel="nofollow" href="#', 'href="#', $text);
        $text = @str_ireplace('target="_blank" rel="dofollow" href="#', 'href="#', $text);

        $PowerBB->functions->get_hooks('BBCodeParseHooks3');

         $text = @str_ireplace('absolute',"a*bsolute",$text);
         $text = @str_ireplace('document',"d*ocument",$text);
         $text = @str_ireplace('cookie',"c*ookie",$text);
         $text = @str_ireplace('alert',"a*lert",$text);
         $text = @str_ireplace('location',"l*ocation",$text);
         $text = @str_ireplace('equiv',"e*quiv",$text);
         $text = @str_ireplace('refresh',"r*efresh",$text);
         $text = @str_ireplace('meta',"m*eta",$text);
         $text = @str_ireplace('base',"b*ase",$text);
        // $text = @str_ireplace('iframe',"i*frame",$text);
         $text = @str_ireplace('method',"m*ethod",$text);
         $text = @str_ireplace('input',"i*nput",$text);
         $text = @str_ireplace('action',"a*ction",$text);
         $text = @str_ireplace('<form',"<f*orm",$text);

        $censorwords = preg_split('#[ \r\n\t]+#', $PowerBB->_CONF['info_row']['censorwords'], -1, PREG_SPLIT_NO_EMPTY);
        $text = @str_ireplace($censorwords,'**', $text);

         $blankasciistrip ="160 173 u8205 u8204 u8237 u8238";

		if ($blanks === null AND trim($blankasciistrip) != '')
		{
			$blanks = array();

			$charset_unicode = (strtolower($PowerBB->_CONF['info_row']['charset']) == 'utf-8');

			$raw_blanks = preg_split('#\s+#', $blankasciistrip, -1, PREG_SPLIT_NO_EMPTY);
			foreach ($raw_blanks AS $code_point)
			{
				if ($code_point[0] == 'u')
				{
					// this is a unicode character to remove
					$code_point = intval(substr($code_point, 1));
					$force_unicode = true;
				}
				else
				{
					$code_point = intval($code_point);
					$force_unicode = false;
				}

				if ($code_point > 255 OR $force_unicode OR $charset_unicode)
				{
					// outside ASCII range or forced Unicode, so the chr function wouldn't work anyway
					$blanks[] = '&#' . $code_point . ';';
					$blanks[] = $this->convert_int_to_utf8($code_point);
				}
				else
				{
					$blanks[] = chr($code_point);
				}
			}
		}

		if ($blanks)
		{
			//$text = str_replace($blanks, '**', $text);
		}





         //Replace YouTube links the video directly
             /*
			$text = @str_ireplace("[youtube]","",$text);
			$text = @str_ireplace("[/youtube]","",$text);
			$search = '#<a(.*?)(?:href="https?://)?(?:www\.)?(?:youtu\.be/|youtube\.com(?:/embed/|/v/|/watch?.*?v=))([\w\-]{10,12}).*<\/a>#x';
			$replace = $this->PowerCode_Youtube("$2", "$2");
			$text =@preg_replace($search, $replace, $text);
             */
 			$first_search = array();
 			$first_replace = array();

            $first_search['[code]'] = '#\[code\](.*)\[/code\]#esiU';
            $first_replace['[code]'] = "\$this->PowerCode_Code('\\1','0')";

            $first_search['[php]'] = '#\[php\](.*)\[/php\]#esiU';
            $first_replace['[php]'] = "\$this->PowerCode_Code('\\1','0')";

 			$text = @preg_replace($first_search,$first_replace,$text);



			$PowerBB->functions->get_hooks('BBCodeParseHooks_cr');

          // long URL, Shortening Long URLs With PHP
 	    //$text = @preg_replace('#\<a(.*)\">(.*)\</a\>#esiU',"\$this->shortenurl('\\1','\\2','44')",$text);

       		$text = str_replace("<br>","<br />",$text);
			$text = @preg_replace('#<img .*src="(.*)".*>#iUe', "'[img]'.trim('$1').'[/img]'", $text);
			$search_array['[img]'] = '#\[img\](.*)\[/img\]#esiU';
			$replace_array['[img]'] = "\$this->resize_image('\\1')";
			$search_array['[IMG]'] = '#\[IMG\]\s*(https?://([^<>*"]+|[a-z0-9/\\._\- !]+))\[/IMG\]#iUe';
			$replace_array['[IMG]'] = "\$this->resize_image('\\1', '\\1')";

			//
			$text = @preg_replace($search_array,$replace_array ,$text);

         //replace Custom bbcode
	        $Custom_bbcodes = $PowerBB->functions->GetCachedCustom_bbcode();
	        if(!empty($Custom_bbcodes))
	        {
				$search_Custom_bbcode_array = array();
				$replace_Custom_bbcode_array = array();

              foreach ($Custom_bbcodes as $getbbcode_row)
		      {
		      	$bbcode_tag = $getbbcode_row['bbcode_tag'];
		      	$bbcode_replace = $getbbcode_row['bbcode_replace'];
                $bbcode_replace = @str_ireplace("'","&#39;",$bbcode_replace);

				if ($getbbcode_row['bbcode_useoption'] == '1')
				{
		            $search_Custom_bbcode_array['['.$bbcode_tag.'='] = '#\['.$bbcode_tag.'=(.*)\](.*)\[/'.$bbcode_tag.'\]#esiU';
		            $replace_Custom_bbcode_array['['.$bbcode_tag.'='] = "\$this->PowerCode_BBcode('\\1', '\\2', $bbcode_tag)";

				}
				else
				{
					$search_Custom_bbcode_array['['.$bbcode_tag.']'] = '#\['.$bbcode_tag.'\](.*)\[/'.$bbcode_tag.'\]#esiU';
					$replace_Custom_bbcode_array['['.$bbcode_tag.']'] = "\$this->PowerCode_Tag_BBcode('$bbcode_replace','$bbcode_tag','\\1')";
			    }

		      }

	          $text = @preg_replace($search_Custom_bbcode_array,$replace_Custom_bbcode_array,$text);

            }

			$text = @str_ireplace("{h-h}", "http", $text);
			$text = @str_ireplace("{w-w}", "www.", $text);


        return $text;
	}


   // long URL, Shortening Long URLs With PHP
 	function shortenurl($Aurl,$Burl,$lg_max)
	{
		global $PowerBB;

       $Burl = str_replace('\\"', '"', $Burl);
	   $Burl = str_replace('\"','"',$Burl);
	   $Aurl = str_replace('\"','"',$Aurl);
       $Aurl = str_replace('\\"', '"', $Aurl);
       $Burl = @preg_replace('#\<a(.*)\">#esiU',"('')",$Burl);
	   $Burl = str_replace('"', '', $Burl);
	   $Burl = str_replace('</a>', '', $Burl);
	   $Burl = str_replace('  ', ' ', $Burl);
	  // $Burl = str_replace('>', '', $Burl);

		$num =$lg_max;
		$start ='0';
		$length = strlen(utf8_decode($Burl));
		if ($length >= $lg_max)
		{
		if (@strstr($Burl,'https://')
		or @strstr($Burl,'http://')
		or @strstr($Burl,'http://www.'))
		{
		$Burl = @preg_replace('#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'. $start .'}'.'((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'. $num .'}).*#s','$1', $Burl);
		}
		}

		$length2 = strlen(utf8_decode($Burl));
		if($length2 == $lg_max)
		{
		$sfdr = " ... ";
		}

		$url = "<a".$Aurl.'">'.$Burl.$sfdr."</a>";
		return $url;
	}

  // jwplayer run withe image url
 	function jwplayer($width, $height, $auto, $imageUrl, $fileUrl)
	{
		global $PowerBB;

		$width = str_replace('\\"', '"', $width);
		$height = str_replace('\\"', '"', $height);
		$auto = str_replace('\\"', '"', $auto);
		$imageUrl = str_replace('\\"', '"', $imageUrl);
		$fileUrl = str_replace('\\"', '"', $fileUrl);
		$imageUrl = @str_ireplace("http", "{h-h}", $imageUrl);
		$imageUrl = @str_ireplace("www.", "{w-w}", $imageUrl);
		$fileUrl = @str_ireplace("http", "{h-h}", $fileUrl);
		$fileUrl = @str_ireplace("www.", "{w-w}", $fileUrl);

        $imageUrl = $PowerBB->functions->CleanVariable($imageUrl,'trim');
        $fileUrl = $PowerBB->functions->CleanVariable($fileUrl,'trim');
        $imageUrl = $PowerBB->functions->CleanVariable($imageUrl,'sql');
        $fileUrl = $PowerBB->functions->CleanVariable($fileUrl,'sql');
        $width = $PowerBB->functions->CleanVariable($width,'intval');
        $height = $PowerBB->functions->CleanVariable($height,'intval');

        if( $imageUrl == "false")
        {
        $url = $PowerBB->functions->GetForumAdress();
         $imageUrl = $url."look/images/pbboard.png";
        }

       if ($PowerBB->functions->checkmobile())
		{
        $width = '250';
        $height = '250';
		}
       // jwplayer tag replace
       echo "<script type=\"text/javascript\" src=\"applications/core/jwplayer/jwplayer.js\"></script><script type=\"text/javascript\" src=\"applications/core/jwplayer/jwplayer.trigger.js\"></script>";
		$jwplayer = "<div style=\" margin:0 auto;width:'$width'px;height:'$height'px;\" data-width=\"$width\" data-height=\"$height\" data-auto=\"$auto\" data-image=\"$imageUrl\" data-url=\"$fileUrl\" class=\"jwplayer-html5-item\"></div><br />";
	    return $jwplayer;
	}

	/** * close all open xhtml tags at the end of the string
	* * @param string $html
	* @return string
	* @author Milian <mail@mili.de>
	*/
	 function closetags($html)
	 {

	  #put all opened tags into an array

	  @preg_match_all('#<([a-z]+)(?: .*)?(?<![/|/ ])>#iU', $html, $result);

	  $openedtags = $result[1];   #put all closed tags into an array

	  @preg_match_all('#</([a-z]+)>#iU', $html, $result);

	  $closedtags = $result[1];

	  $len_opened = @count($openedtags);

	  # all tags are closed

	  if (count($closedtags) == $len_opened) {

	    return $html;

	  }

	  $openedtags = array_reverse($openedtags);

	  # close tags

	  for ($i=0; $i < $len_opened; $i++) {

	    if (!in_array($openedtags[$i], $closedtags)){

	      $html .= '</'.$openedtags[$i].'>';

	    } else {

	      unset($closedtags[array_search($openedtags[$i], $closedtags)]);
	       }

	  }
      $html = @str_ireplace('</img>','',$html);

	   return $html;
	   }

 	function feltr_words($text)
	{
		global $PowerBB;
       // feltr words2
         $text = str_replace('&lt;','<',$text);
         $text = str_replace('&quot;','"',$text);
         $text = str_replace('&gt;','>',$text);
         $text = str_replace("&amp;#39;","'",$text);
		 $text = $PowerBB->functions->pbb_stripslashes($text);
         $text = str_replace('{39}',"'",$text);
         $text = @str_ireplace('xss',"**",$text);
         $text = @str_ireplace('document',"**",$text);
         $text = @str_ireplace('cookie',"**",$text);
         $text = @str_ireplace('alert',"**",$text);
         $text = @str_ireplace('location',"**",$text);
         $text = @str_ireplace('equiv',"**",$text);
         $text = @str_ireplace('script',"**",$text);
         $text = @str_ireplace('equiv',"**",$text);
         $text = @str_ireplace('refresh',"**",$text);
         $text = @str_ireplace('meta',"**",$text);
         $text = @str_ireplace('base',"**",$text);
         $text = @str_ireplace('iframe',"**",$text);
         $text = @str_ireplace('style',"",$text);
         $text = @str_ireplace('method',"**",$text);
         $text = @str_ireplace('input',"**",$text);
         $text = @str_ireplace('action',"**",$text);
        $censorwords = preg_split('#[ \r\n\t]+#', $PowerBB->_CONF['info_row']['censorwords'], -1, PREG_SPLIT_NO_EMPTY);
        $text = @str_ireplace($censorwords,'**', $text);

         $blankasciistrip ="160 173 u8205 u8204 u8237 u8238";

		if ($blanks === null AND trim($blankasciistrip) != '')
		{
			$blanks = array();

			$charset_unicode = (strtolower($PowerBB->_CONF['info_row']['charset']) == 'utf-8');

			$raw_blanks = preg_split('#\s+#', $blankasciistrip, -1, PREG_SPLIT_NO_EMPTY);
			foreach ($raw_blanks AS $code_point)
			{
				if ($code_point[0] == 'u')
				{
					// this is a unicode character to remove
					$code_point = intval(substr($code_point, 1));
					$force_unicode = true;
				}
				else
				{
					$code_point = intval($code_point);
					$force_unicode = false;
				}

				if ($code_point > 255 OR $force_unicode OR $charset_unicode)
				{
					// outside ASCII range or forced Unicode, so the chr function wouldn't work anyway
					$blanks[] = '&#' . $code_point . ';';
					$blanks[] = $this->convert_int_to_utf8($code_point);
				}
				else
				{
					$blanks[] = chr($code_point);
				}
			}
		}

		if ($blanks)
		{
			//$text = str_replace($blanks, '**', $text);
		}

        return $text;
	}

 	function replace_smiles(&$text)
	{
		global $PowerBB;

		$smiles = $PowerBB->icon->GetCachedSmiles();
		$text = str_replace("../","", $text);
		foreach ($smiles as $smile)
		{
			$PowerBB->functions->CleanVariable($smile,'html');
		if (defined('IN_ADMIN'))
		{
			$smile['smile_short'] = @str_ireplace(":#","{:#}", $smile['smile_short']);
			$text = str_replace($smile['smile_short'],'<img src="' . "../".$smile['smile_path'] . '" border="0" alt="' . $smile['smile_short'] . '" />',$text);
		}
		else
		{
			$smile['smile_short'] = @str_ireplace(":#","{:#}", $smile['smile_short']);
			$text = str_replace($smile['smile_short'],'<img src="' . $smile['smile_path'] . '" border="0" alt="' . $smile['smile_short'] . '" />',$text);
		}
        		$text = str_replace("smiles//","smiles/", $text);

		}
	}


 	function replace_smiles_print(&$text)
	{
		global $PowerBB;
		$text = str_replace("../","", $text);

		$smiles = $PowerBB->icon->GetCachedSmiles();

		foreach ($smiles as $smile)
		{
            $Adress = $PowerBB->functions->GetForumAdress();
			$text = str_replace($smile['smile_short'],'<img src="' . $Adress.$smile['smile_path'] . '" border="0" />',$text);
			$text = str_replace("smiles//","smiles/", $text);

		}
	}


	function replace_wordwrap(&$text)
	{
		global $PowerBB;
		/*
        $wordwrap = $PowerBB->_CONF['info_row']['wordwrap'];
		$wordwrap = intval($wordwrap);

		if ($wordwrap > 0 AND !empty($text))
		{
		 $text = @preg_replace("/([^\s]{".$wordwrap."})/", "$1 ", ($text));
		 return $text;
		}
		else
		{
		 return $text;
		}
		*/

	}


 	function _wordwrap($text,$lg_max)
	{
		global $PowerBB;
       $num =$lg_max;
       $start ='0';
       $text = @preg_replace('#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'. $start .'}'.'((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'. $num .'}).*#s','$1', $text);

       $length = strlen(utf8_decode($text));
       if($length == $lg_max)
       {
       	$sfdr = " .. ";
       }
       return $text.$sfdr;
	}

       function PowerCode_Tag_Url($link, $message)
        {
        	global $PowerBB;
          $Guest_message = ($PowerBB->_CONF['info_row']['guest_message_for_haid_links']);
          $register_link = ('index.php?page=register&index=1');

                if (trim($message) == '')
                {
                        return '';
                }

                $message = str_replace('\\"', '"', $message);
                $message = @str_ireplace("&quot;", '', $message);
                $message = @str_ireplace('"<a ', "<a ", $message);
                $message = @str_ireplace('&quot;<a ', "<a ", $message);
                $message = @str_ireplace('\"', '"', $message);
                $message = @str_ireplace('""', '"', $message);
                $message = @preg_replace('#<a href="(.*?)" (.*?)</a>#i', "$1", $message);
                $message = @str_ireplace("&quot", '', $message);

                $link = str_replace('\\"', '"', $link);
                $link = @str_ireplace("&quot;", '', $link);
                $link = @str_ireplace('"<a ', "<a ", $link);
                $link = @str_ireplace('&quot;<a ', "<a ", $link);
                $link = @str_ireplace('\"', '"', $link);
                $link = @str_ireplace('""', '"', $link);
                $link = @preg_replace('#<a href="(.*?)" (.*?)</a>#i', "$1", $link);
                $link = @str_ireplace("&quot", '', $link);

               $PowerBB->functions->get_hooks('BBCodeParseHooks6');

                $link = str_replace(array('"', "'"), array('&quot;', '&#39;'), $link);

				if ($PowerBB->_CONF['info_row']['haid_links_for_guest'] == 0)
				{
				 $url = "<a href=\"$link\" target=\"_blank\" title=\"$link\">$message</a>";
				}
				else
				{

	                 if ($PowerBB->_CONF['member_permission'])
					 {
						$url = "<a href=\"$link\" target=\"_blank\" title=\"$link\">$message</a>";
					 }
	                if (!$PowerBB->_CONF['member_permission'])
					{
					 $url = "<a href=\"$register_link\" target=\"_blank\" title=\"$register_link\">$Guest_message</a>";
	                }
				}

               $PowerBB->functions->get_hooks('BBCodeParseHooks_url');

			return $url;
        }

    function li_not_bar($text)
    {
        global $PowerBB;
        $text = str_replace('\\"', '"', $text);
        $text = str_replace("&lt;br&gt;","<br>",$text);
        $text = str_replace("&lt;br /&gt;","<br>",$text);
        $text = str_replace("<br />", '',$text);
        $text = str_replace("<br>", '',$text);
        $text = str_replace("\n", '',$text);
        $text = str_replace("\t", '',$text);
        $text = str_replace("\r", '',$text);
        $text = str_replace("&nbsp;", '',$text);
        $text = str_replace("\s", '',$text);

        $text = $PowerBB->functions->pbb_stripslashes($text);
		return "<li>".$text."</li>";
     }

	function strip_smiles(&$text)
	{
   		global $PowerBB;

		$smiles = $PowerBB->icon->GetCachedSmiles();

		foreach ($smiles as $smile)
		{
			$PowerBB->functions->CleanVariable($smile,'html');

			$text = str_replace('<img src="' . $smile['smile_path'] . '" border="0" alt="' . $smile['smile_short'] . '" />',$smile['smile_short'],$text);
			$text = str_replace("smiles//","smiles/", $text);

		}
    }

    function resize_image($img)
    {
        global $PowerBB;
        $img = str_replace('\\"', '"', $img);
        $img = trim($img);

        /*
        $img = @preg_replace('#&gt;(.*?)&lt;#i', "&gt;&lt;", $img);
        $img = @preg_replace('#<(.*?)>(.*?)#i', "", $img);
        $img = @preg_replace('#<(.*?)>#i', "", $img);
        $img = @preg_replace('#&lt;(.*?)&gt;(.*?)#i', "", $img);

        $img = @preg_replace("#&lt;(.*?)&gt;#i", "", $img);
        $img = @preg_replace('#>(.*?)<#i', "", $img);
        $img = @preg_replace("#&lt;(.*?)&gt;#i", "", $img);

        $img = str_replace("<>", '',$img);
        $img = str_replace("&gt;&lt;", '',$img);
        $img = str_replace("&lt;&gt;", '',$img);
        */
        $img = str_replace("&lt;br&gt;","<br>",$img);
       // $img = str_replace("&lt;br /&gt;","<br>",$img);
        $img = @str_ireplace("&amp;quot;", "", $img);
		$img = @str_ireplace("alt=", '', $img);
		$img = @str_ireplace("border=0", '', $img);
   		//$img = @str_ireplace('<br />', '', $img);
        $img = str_replace("<br>", '',$img);
   		$img = str_replace('\n', '', $img);
   		$img = str_replace('\s', '', $img);
   		$img = str_replace('\r', '', $img);
        $img = @str_ireplace("&nbsp;", '',$img);

        //attach url img replace id
        $Adress = $PowerBB->functions->GetForumAdress();
        if(strstr($img,$PowerBB->_SERVER['HTTP_HOST']))
        {
        preg_match("/[^\/index.php?page=download&attach=1&id=]+$/", $img, $matches);
		 if (is_numeric($matches[0])) {
		  $img = $this->attach_url_img_replace($matches[0],$Adress);
		 }
        }

		$fileParts = pathinfo($img);

		if(isset($fileParts['filename']))
		{
		 $fileParts['filename'] = substr($fileParts['basename'], 0, strrpos($fileParts['basename'], '.'));
         $imagename= trim($fileParts['filename']);
		}
		else
		{
         $imagename= $img;
		}

		 $onload_resize_name ='ResizeIt(this,'.$PowerBB->_CONF['info_row']['default_imagesW'].','.$PowerBB->_CONF['info_row']['default_imagesH'].')';
		$PowerBB->functions->get_hooks('hook_resize_images');

        if ($PowerBB->_CONF['info_row']['resize_imagesAllow']
         and!@strstr($img,"smiles"))
        {
		 $img ='<img src="'.$img.'" border="0" alt="'.$imagename.'" onload="'.$onload_resize_name.'" />
		 <div class="resize" id="'.$imagename.'">
		 <a class="resize_img smallfont" href="'.$img.'" title="'.$imagename.'">'.$PowerBB->_CONF['template']['_CONF']['lang']['resize_image_w_h'].'</a>
		 </div>';
        }
	    else
	    {
         $img = '<img src="'.$img.'" border="0" alt="'.$imagename.'" />';
		}


		return $img;
     }

 	function attach_url_img_replace($string, $url)
 	{
 		global $PowerBB;

	   $GetAttachArr 					= 	array();
	   $GetAttachArr['where'] 			= 	array('id',$string);
	   $Attachinfo = $PowerBB->core->GetInfo($GetAttachArr,'attach');

	    return $url.$Attachinfo['filepath'];
	}

	function content_search_highlight( $text, $highlight )
	{
        global $PowerBB;

		$highlight  = urldecode( $highlight );
		$loosematch = @strstr( $highlight, '*' ) ? 1 : 0;
		$keywords   = str_replace( '*', '', str_replace( "+", " ", str_replace( "++", "+", str_replace( '-', '', trim($highlight) ) ) ) );
		$word_array = array();
		$endmatch   = "(.)?";
		$beginmatch = "(.)?";

		if ( $keywords )
		{
			if ( preg_match("/,(and|or),/i", $keywords) )
			{
				while ( preg_match("/,(and|or),/i", $keywords, $match) )
				{
					$word_array = explode( ",".$match[1].",", $keywords );
					$keywords   = str_replace( $match[0], '' ,$keywords );
				}
			}
			else if ( @strstr( $keywords, ' ' ) )
			{
				$word_array = explode( ' ', str_replace( '  ', ' ', $keywords ) );
			}
			else
			{
				$word_array[] = $keywords;
			}

			if ( ! $loosematch )
			{
				$beginmatch = "(^|\s|\>|;)";
				$endmatch   = "(\s|,|\.|!|<br|&|$)";
			}

			if ( is_array($word_array) )
			{
				foreach ( $word_array as $keywords )
				{
					preg_match_all( "/{$beginmatch}(".preg_quote($keywords, '/')."){$endmatch}/is", $text, $matches );

					for ( $i = 0; $i < count($matches[0]); $i++ )
					{
						$text = str_replace( $matches[0][$i], $matches[1][$i]."[color=#ff0000]".$matches[2][$i]."[/color]".$matches[3][$i], $text );
					}
				}
			}
		}

		return $text;
	}

	function bb_common(&$string)
	{
        global $PowerBB;

        $string = str_replace('\\"', '"', $string);
		$string = str_replace("\r\n", " ", $string);
		$string = str_replace("\r", " ", $string);
		$string = str_replace("\n", " ", $string);
		$string = str_replace('<br>', " ", $string);
		$string = str_replace('<br />', " ", $string);

		 $string = str_replace("&amp;","&",$string);
         $string = str_replace('{39}',"'",$string);
         $string = str_replace('&#092;&#092;',"&#092;",$string);
         $string = str_replace("&amp;#39;","'",$string);
         $string = str_replace("&#39;","'",$string);
         $string = str_replace('<p align="left">','<p dir="ltr" align="left">',$string);
         $string = str_replace("&amp;#092;","\(:*:)",$string);
         $string = str_replace("(:*:)","",$string);

         $string = str_replace("&gt;&lt;","><",$string);
         $string = str_replace("&lt;", "<", $string);
         $string = str_replace("&gt;", ">", $string);
         $string = str_replace("<img", '<img  width="20" height="20"', $string);
         $string = str_replace("<td", '', $string);
         $string = str_replace("<table", '', $string);
         $string = str_replace("<tr", '', $string);
         $string = str_replace("<div", '', $string);
         $string = str_replace("<p", '', $string);
         $string = str_replace("</div>", '', $string);
         $string = str_replace("</td>", '', $string);
         $string = str_replace("</table>", '', $string);
         $string = str_replace("</tr>", '', $string);

		return $string;
     }
	function html_common($string)
	{
        global $PowerBB;

		if (stristr($string, "<body"))
		{
      if (preg_match('#<body.*?>(.*)</body>#is', $string, $matches))
      {
        $string = $matches[1];
      }
      elseif (preg_match('#<body.*?>(.*)#is', $string, $matches))
      {
        $string = $matches[1];
      }
		}

		$string = @preg_replace('#(</?)(\w+)([^>]*>)#e','"$1".strtolower("$2")."$3"',$string);
		preg_match_all('#<pre(| .*?)>(.*?)</pre>#s', $string, $matches);
		$preformated_strings = $matches[2];
		$cp = count($preformated_strings);

		for ($i = 0; $i < $cp; $i++)
		{
			$string = @preg_replace('#<pre(| .*?)>(.*?)</pre>#s', "***pre_string***$i", $string, 1);
		}

        $string = str_replace('\\"', '"', $string);
		$string = str_replace('&amp;quot;', '"', $string);
		$string = str_replace("\r\n", ' ', $string);
		$string = str_replace("\r", ' ', $string);
		$string = str_replace("\n", ' ', $string);
		$string = str_replace('<br>', "\r\n", $string);
		$string = str_replace('<br />', "\r\n", $string);
		$string = str_replace('&nbsp;', ' ', $string);
		$string = str_replace('/ {2,}/', ' ', $string);
		for ($i = 0; $i < $cp; $i++)
		{
			$string = str_replace("***pre_string***$i", '<pre>' . $preformated_strings[$i] . '</pre>', $string);
		}
		return $string;
	}

	// Converts an HTML email into bbcode
	// This function is loosely based on cbparser.php by corz.org
	function html2bb($string)
	{
        global $PowerBB;

	  $string = @preg_replace('#<font color="(.*?)">(.*?)</font>#i', " $2 ", $string);
	  $string = @preg_replace('#<font size="(.*?)">(.*?)</font>#i', " $2 ", $string);
	  $string = @preg_replace('#<font face="(.*?)">(.*?)</font>#i', " $2 ", $string);
	  $string = @preg_replace('#<p align="(.*?)">(.*?)</p>#i', "[$1] $2 [/$1]", $string);
	  $string = @preg_replace('#<div align="(.*?)">(.*?)</div>#i', "[$1] $2 [/$1]", $string);

        $string = str_replace('\\"', '"', $string);
		$string = str_replace('</b>',  '[/b]',    $string);
		$string = str_replace('</i>',  '[/i]',    $string);
		$string = str_replace('</u>',  '[/u]',    $string);
		$string = str_replace('</ul>', '[/list]', $string);
		$string = str_replace('</ol>', '[/list]', $string);
		$string = str_replace('</em>', '[/i]',    $string);
		$string = str_replace('</strong>', '[/b]', $string);
		$string = str_replace('</blockquote>', '[/quote]', $string);
		$string = str_replace('</pre>', '[/code]', $string);

		// Do simple reg expr replacements
		$string = @preg_replace('#<b(| .*?)>#',      '[b]',      $string);
		$string = @preg_replace('#<i(| .*?)>#',      '[i]',      $string);
		$string = @preg_replace('#<u(| .*?)>#',      '[u]',      $string);
		$string = @preg_replace('#<ul(| .*?)>#',     '[list]',   $string);
		$string = @preg_replace('#<ol(| .*?)>#',     '[list=1]', $string);
		$string = @preg_replace('#<li(| .*?)>#',     '[*]',      $string);
		$string = @preg_replace('#<em(| .*?)>#',     '[i]',      $string);
		$string = @preg_replace('#<strong(| .*?)>#', '[b]',      $string);
		$string = @preg_replace('#<blockquote(| .*?)>#', '[quote]',  $string);
		$string = @preg_replace('#<pre(| .*?)>#', '[code]',  $string);

		// replace multiple instances of [b] or [i] with single tags
		$string = @preg_replace('#(\[b\])+#',      '[b]',      $string);
		$string = @preg_replace('#(\[i\])+#',      '[i]',      $string);
		$string = @preg_replace('#(\[/b\])+#',     '[/b]',      $string);
		$string = @preg_replace('#(\[/i\])+#',     '[/i]',      $string);

		// fix for thunderbird which chops up quotes into little chunks for some reason. Remove if necessary!
		$string = @preg_replace('#\[\/quote\]\s*?\[quote\]#', '',  $string);

		// Replace email address
		$string = @preg_replace('#<a .*?href=.*?"mailto:(.*?)".*?>(.*?)</a>#i', "$2 ([email]$1[/email])", $string);

		// Replace links
		$string = @preg_replace('#<a .*href=.*"(.*)".*>(.*)</a>#iUe', "'[url'. (trim('$1') ? '='.trim('$1') : '') .']'.trim('$2').'[/url]'", $string);

		// Remove any image tags whose source starts with 'cid:' - this is an inline attachment, and will be added to the post as a normal attachment.
		$string = @preg_replace('#<img[^>]+src="cid:[^>]+>#i', '', $string);

		// Replace image references
		$string = @preg_replace('#<img .*src="(.*)".*>#iUe', "'[img]'.trim('$1').'[/img]'", $string);

		// Remove all remaining HTML tags
		$string = @preg_replace('#<(/?\w+|!--)[^>]*>#', '', $string);

		// Convert HTML entities
		$string = @html_entity_decode($string, ENT_QUOTES, 'UTF-8');
		$string = @urldecode($string);

		// Convert quotes
	  return $PowerBB->functions->pbb_stripslashes($string);

	}


 	function mqtids_replace_cod($string)
 	{
 		global $PowerBB;

           $string = str_replace('\\"', '"', $string);
           if ($PowerBB->_POST['preview'] == false)
            {
              $string = $PowerBB->functions->pbb_stripslashes($string);
            }

	    return ($string);
	}

	function convert_int_to_utf8($intval)
	{
		$intval = intval($intval);
		switch ($intval)
		{
			// 1 byte, 7 bits
			case 0:
				return chr(0);
			case ($intval & 0x7F):
				return chr($intval);

			// 2 bytes, 11 bits
			case ($intval & 0x7FF):
				return chr(0xC0 | (($intval >> 6) & 0x1F)) .
					chr(0x80 | ($intval & 0x3F));

			// 3 bytes, 16 bits
			case ($intval & 0xFFFF):
				return chr(0xE0 | (($intval >> 12) & 0x0F)) .
					chr(0x80 | (($intval >> 6) & 0x3F)) .
					chr (0x80 | ($intval & 0x3F));

			// 4 bytes, 21 bits
			case ($intval & 0x1FFFFF):
				return chr(0xF0 | ($intval >> 18)) .
					chr(0x80 | (($intval >> 12) & 0x3F)) .
					chr(0x80 | (($intval >> 6) & 0x3F)) .
					chr(0x80 | ($intval & 0x3F));
		}
	}

   //end_function

 	function replace_htmlentities($string)
 	{
 		global $PowerBB;
          if ($PowerBB->_POST['preview'] == false)
          {
           $string = $PowerBB->functions->pbb_stripslashes($string);
          }

          $brackets = (strpos($string,'[') !== false) and (strpos($string,']') !== false);
         if ($brackets)
 		{
 			$first_search = array();
 			$first_replace = array();

            $first_search['[code]'] = '#\[code\](.*)\[/code\]#esiU';
            $first_replace['[code]'] = "\$this->ent_quotesutf('\\1','code')";

            $first_search['[php]'] = '#\[php\](.*)\[/php\]#esiU';
            $first_replace['[php]'] = "\$this->ent_quotesutf('\\1','php')";

            $first_search['[html]'] = '#\[html\](.*)\[/html\]#esiU';
            $first_replace['[html]'] = "\$this->ent_quotesutf('\\1','html')";

            $first_search['[sql]'] = '#\[sql\](.*)\[/sql\]#esiU';
            $first_replace['[sql]'] = "\$this->ent_quotesutf('\\1','sql')";

 			$string = @preg_replace($first_search,$first_replace,$string);
        }
        $string = str_replace('\\"', '"', $string);
        $string = @preg_replace('#\<li\>(.*)\</li\>#esiU',"\$this->li_not_bar('\\1')",$string);
		$string = str_replace( "#textarea#"   , "text_area ", $string );
		$string  = @str_ireplace("<iframe", "&lt;iframe", $string);


        return $string;
 	}

	function ent_quotesutf($string, $message)
 	{
 		global $PowerBB;
 		$string = str_replace('\\"', '"', $string);
		$strings = @htmlentities($string, @ENT_QUOTES, "UTF-8");
		return "[".$message."]".$strings."[/".$message."]";

 	}

 }

?>
