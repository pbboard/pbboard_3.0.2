<?
/*
utf8 1.0
Copyright: Left
---------------------------------------------------------------------------------
Version:        1.0
Date:           23 November 2004
---------------------------------------------------------------------------------
Author:         Alexander Minkovsky (a_minkovsky@hotmail.com)
---------------------------------------------------------------------------------
License:        Choose the more appropriated for You - I don't care.
---------------------------------------------------------------------------------
Description:
Class provides functionality to convert single byte strings, such as CP1251
ti UTF-8 multibyte format and vice versa.
Class loads a concrete charset map, for example CP1251.
(Refer to ftp://ftp.unicode.org/Public/MAPPINGS/ for map files)
Directory containing MAP files is predefined as constant.
Each charset is also predefined as constant pointing to the MAP file.
---------------------------------------------------------------------------------
Example usage:
Pass the desired charset in the class constructor:
$utfConverter = new utf8(CP1251); //defaults to CP1250.
or load the charset MAP using loadCharset method like this:
$utfConverter->loadCharset(CP1252);
Then call
$res = $utfConverter->strToUtf8($str);
or
$res = $utfConverter->utf8ToStr($utf);
to get the needed encoding.
---------------------------------------------------------------------------------
Note:
Rewrite or Override the onError method if needed. It's the error handler used from everywhere and takes 2 parameters:
err_code and err_text. By default it just prints out a message about the error.
*/

//Charset maps
define("MAP_DIR", ROOT_PATH . "usr/system/utf");
define("CP1250", MAP_DIR . "/CP1250.MAP");
define("CP1251", MAP_DIR . "/CP1251.MAP");
define("CP1252", MAP_DIR . "/CP1252.MAP");
define("CP1253", MAP_DIR . "/CP1253.MAP");
define("CP1254", MAP_DIR . "/CP1254.MAP");
define("CP1255", MAP_DIR . "/CP1255.MAP");
define("CP1256", MAP_DIR . "/CP1256.MAP");
define("CP1257", MAP_DIR . "/CP1257.MAP");
define("CP1258", MAP_DIR . "/CP1258.MAP");
define("CP874", MAP_DIR . "/CP874.MAP");
define("CP932", MAP_DIR . "/CP932.MAP");
define("CP936", MAP_DIR . "/CP936.MAP");
define("CP949", MAP_DIR . "/CP949.MAP");
define("CP950", MAP_DIR . "/CP950.MAP");

//Error constants
define("ERR_OPEN_MAP_FILE","ERR_OPEN_MAP_FILE");

//Class definition
Class utf8{

	var $charset = CP1250;
	var $ascMap = array();
	var $utfMap = array();

	//Constructor
	function utf8($charset=CP1250){
		$this->loadCharset($charset);
	}

	//Load charset
	function loadCharset($charset){
		//if(strstr(strtolower($charset), "windows")) $charset=@preg_replace("/windows-/i", "CP", $charset);
		if(!@is_file($charset)) {
			//if(strstr(strtolower($charset), "windows")) $charset=@preg_replace("/windows(-)?/i", "CP", $charset);
			$charset=MAP_DIR . "/" . $charset . ".MAP";
		}

		$fp=fopen($charset, "r");
		if($fp){
			$lines = fread($fp, filesize($charset));
			fclose($fp);
		}else exit($this->onError(ERR_OPEN_MAP_FILE,"Error openning file: " . $charset));

		$this->charset = $charset;
		$lines = @preg_replace("/#.*$/m","",$lines);
		$lines = @preg_replace("/\n\n/","",$lines);
		$lines = explode("\n",$lines);
		foreach($lines as $line){
			$parts = explode('0x',$line);
			if(count($parts)==3){
				$asc=hexdec(substr($parts[1],0,2));
				$utf=hexdec(substr($parts[2],0,4));
				$this->ascMap[$charset][$asc]=(int)$utf;
			}
		}
		$this->utfMap = array_flip($this->ascMap[$charset]);
	}

	//Error handler
	function onError($err_code,$err_text){
		print($err_code . " : " . $err_text . "<hr>\n");
	}

	//Translate string ($str) to UTF-8 from given charset
	function strToUtf8($str){
		$chars = unpack('C*', $str);
		$cnt = count($chars);
		for($i=1;$i<=$cnt;$i++) $this->_charToUtf8(&$chars[$i]);
		return implode("",$chars);
	}

	//Translate UTF-8 string to single byte string in the given charset
	function utf8ToStr($utf){
		$chars = unpack('C*', $utf);
		$cnt = count($chars);
		$res = ""; //No simple way to do it in place... concatenate char by char
		for ($i=1;$i<=$cnt;$i++){
			$res .= $this->_utf8ToChar(&$chars, &$i);
		}
		return $res;
	}

	//Char to UTF-8 sequence
	function _charToUtf8(&$char){
		$c = (int)$this->ascMap[$this->charset][$char];
		if ($c < 0x80){
			$char = chr($c);
		}
		else if($c<0x800) // 2 bytes
		$char = (chr(0xC0 | $c>>6) . chr(0x80 | $c & 0x3F));
		else if($c<0x10000) // 3 bytes
		$char = (chr(0xE0 | $c>>12) . chr(0x80 | $c>>6 & 0x3F) . chr(0x80 | $c & 0x3F));
		else if($c<0x200000) // 4 bytes
		$char = (chr(0xF0 | $c>>18) . chr(0x80 | $c>>12 & 0x3F) . chr(0x80 | $c>>6 & 0x3F) . chr(0x80 | $c & 0x3F));
	}

	//UTF-8 sequence to single byte character
	function _utf8ToChar(&$chars, &$idx){
		if(($chars[$idx] >= 240) && ($chars[$idx] <= 255)){ // 4 bytes
		$utf =    (intval($chars[$idx]-240)   << 18) +
		(intval($chars[++$idx]-128) << 12) +
		(intval($chars[++$idx]-128) << 6) +
		(intval($chars[++$idx]-128) << 0);
		}
		else if (($chars[$idx] >= 224) && ($chars[$idx] <= 239)){ // 3 bytes
		$utf =    (intval($chars[$idx]-224)   << 12) +
		(intval($chars[++$idx]-128) << 6) +
		(intval($chars[++$idx]-128) << 0);
		}
		else if (($chars[$idx] >= 192) && ($chars[$idx] <= 223)){ // 2 bytes
		$utf =    (intval($chars[$idx]-192)   << 6) +
		(intval($chars[++$idx]-128) << 0);
		}
		else{ // 1 byte
		$utf = $chars[$idx];
		}
		if(array_key_exists($utf,$this->utfMap))
		return chr($this->utfMap[$utf]);
		else
		return "?";
	}

}
?>