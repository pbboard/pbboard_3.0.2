<?php
 class iam_backup
	{
		/**
		 *
		 * var string $host Host that holds the DB
		 * access private
		 */
		var $host = "localhost";

		/**
		 *
		 * var string $dbname Database to back up
		 * access private
		 */
		var $dbname = "mysql";

		/**
		 *
		 * var string $dbuser User to access the Database
		 * access private
		 */
		var $dbuser = "root";

		/**
		 *
		 * var string $dbpass Password to access the Database
		 * access private
		 */
		var $dbpass = "";

		/**
		 *
		 * var string $newline Newline character (OS dependant)
		 * access private
		 */
		var $newline;

		/**
		 *
		 * var Boolean $struct_only Indicates whether the backup will contain only the DB structure and no data (when true)
		 * access private
		 */
		var $struct_only = false;

		/**
		 *
		 * var string $output Whether to send the output to the browser (when false)or download it as a file (when true)
		 * access private
		 */
		var $output = false;

		/**
		 *
		 * var string $compress Indicates whether the dump will be compressed (using GZIP compression). It only has an effect when downloading the file.
		 * access private
		 */
		var $compress = false;

		/**
		 *
		 * var string $filename Indicates Path and name of the file (when the dump is done on the server). If not null, the dump will be performed on the local server. If null, the file will be sent to the browser.
		 * access private
		 */
		var $filename = "";

		/**
		 * Initialize this class. Constructor
		 * access public
		 * param Mixed $host Host that holds the DB. The user of the class can pass it either a Hostaname (and fill in the rest of the data) or a Connection Object (and avoid filling in all the parameters). Thanks Sebastiaan van Stijn
		 * param String $dbanme Database to back up
		 * param String $dbuser User to access the Database
		 * param String $dbpass Password to access the Database
		 * param Boolean $output Whether to send the output to the browser (when false)or download it as a file (when true)
		 * param Boolean $struct_only Indicates whether the backup will contain only the DB structure and no data (when true)
		 * param Boolean $compress Indicates whether the dump will be compressed (using GZIP compression). It only has an effect when downloading the file.
		 * param String $filename Indicates Path and name of the file (when the dump is done on the server)
		 */
		function iam_backup( $host = 'localhost', $dbname = 'mysql', $dbuser = 'root', $dbpass = '', $struct_only = false, $output = true, $compress = true, $filename = "" )
		{
			$this->output = $output;
			$this->struct_only = $struct_only;
			$this->compress = $compress;

			/*
			* check if 'host' contains a connection instead of a hostname
			* Check takes place on two properties;
			* 1) check if 'host' is an object
			* 2) check if 'host' has a property called 'database' (any other connection-specific property should do)
			*/
			if ( is_object($host) && isset($host->database) )
			{
				$this->host = $host->host;
				$this->dbname = $host->database;
				$this->dbuser = $host->user;
				$this->dbpass = $host->password;
			}
			else
			{
				$this->host = $host;
				$this->dbname = $dbname;
				$this->dbuser = $dbuser;
				$this->dbpass = $dbpass;
			}
			$this->filename = $filename;
			$this->newline = $this->_define_newline();
		}

		/**
		 * Generate the DB Dump.
		 * access private
		 */
		function _backup()
		{
			$now = gmdate( 'D, d M Y H:i:s' ) . ' GMT';

			$newfile .= "#------------------------------------------" . $this->newline;
			$newfile .= "# PBBOARD Database Backup" . $this->newline;
			$newfile .= "# Database: $this->dbname" . $this->newline;
			$newfile .= "# Date: $now" . $this->newline;
			$newfile .= "#------------------------------------------" . $this->newline . $this->newline;

			$result = @mysql_pconnect( "$this->host", "$this->dbuser", "$this->dbpass" );
			if ( !$result ) // If no connection can be obtained, return empty string
			{
				return "Error. Can´t connect to Database: $this->dbname";
			}

			if ( !@mysql_select_db("$this->dbname") ) // If db can't be set, return empty string
			{
				return "Error. Database $this->dbname could not be selected.";
			}

			$result = @mysql_query( "show tables from `$this->dbname`" );
			while ( list($table) = @mysql_fetch_row($result) )
			{
				$newfile .= $this->_get_def( $table );
				$newfile .= "$this->newline";
				if ( !$struct_only ) // If table data also has to be written, get table contents
 						$newfile .= $this->_get_content( $table );
				$newfile .= "$this->newline";
				$i++;
			}

			$this->_out( $newfile );
		}

		/**
		 * Send the output to the browser
		 * access private
		 * param string $output Contains the database dump
		 */
		function _out( $dump )
		{
			if ( $this->filename )
			{
				$fptr = fopen("../".$this->filename, "wb" );
				if ( $fptr )
				{
					//$dump = str_replace('\"','"',$dump);
					//$dump = str_replace("\&#39;","&#39;",$dump);
					$dump = str_replace("\r\n",'\r\n',$dump);
				    $dump = str_replace( "',)", "')", $dump );
					$dump =@preg_replace('#NOT NULL default (.*?),#i', "NOT NULL default '$1',", $dump);
				    $dump = str_ireplace( ")   KEY", "),\r\nKEY", $dump );
                    $dump =@preg_replace("#'{sq}(.*?){sq}'#i", "{sq}$1{sq}", $dump);
					$dump = str_ireplace("NULL,)","NULL)",$dump);
					if ( $this->compress )
					{
						$gzbackupData = "\x1f\x8b\x08\x00\x00\x00\x00\x00" . substr( gzcompress($dump, 9), 0, -4 ) . pack( 'V', crc32($dump) ) . pack( 'V', strlen($dump) );
						fwrite( $fptr, $gzbackupData );
					}
					else  fwrite( $fptr, $dump );
					fclose( $fptr );
				}
			}
			else
			{
				if ( ($this->compress) and ($this->output) )
				{
					$gzbackupData = "\x1f\x8b\x08\x00\x00\x00\x00\x00" . substr( gzcompress($dump, 9), 0, -4 ) . pack( 'V', crc32($dump) ) . pack( 'V', strlen($dump) );
					echo $gzbackupData;
				}
				else  echo $dump;
			}
		}

		/**
		 * Generate the selected table's definition
		 * access private
		 * return String table definition dump
		 * param String $tablename Name of the table to back up
		 */
		function _get_def( $tablename )
		{
			$def = "";
			$def .= "#------------------------------------------" . $this->newline;
			$def .= "# Table definition for $tablename" . $this->newline;
			$def .= "#------------------------------------------" . $this->newline;
			$def .= "DROP TABLE IF EXISTS $tablename;" . $this->newline . $this->newline;
			$def .= "CREATE TABLE `$tablename` (" . $this->newline;
			$result = @mysql_query( "SHOW FIELDS FROM `$tablename`" ) or die( "Table $tablename not existing in database" );
			while ( $row = @mysql_fetch_array($result) )
			{
				// Updated after Carlos Carrasco's suggestion. Thanks!
				$def .= " `$row[Field]` $row[Type]"; // Sorround field names with quotes
				if ( $row["Null"] != "YES" ) $def .= " NOT NULL";
				if ( $row["Default"] != "" )
				{
					if ( $row["Default"] == "CURRENT_TIMESTAMP" )
					{
						$def .= " default CURRENT_TIMESTAMP";
					}
					else
					{
						$def .= " default $row[Default]";
					}
				}
				if ( $row[Extra] != "" ) $def .= " $row[Extra]";
				$def .= ",$this->newline";
			}
			$def = str_replace( ",$this->newline$", "", $def );
            $def = str_replace('\"','"',$def);
			$result = @mysql_query( "SHOW KEYS FROM `$tablename`" );
			while ( $row = @mysql_fetch_array($result) )
			{
				$kname = $row[Key_name];
				if ( ($kname != "PRIMARY") && ($row[Non_unique] == 0) ) $kname = "UNIQUE|$kname";
				if ( !isset($index[$kname]) ) $index[$kname] = array();
				$index[$kname][] = $row[Column_name];
			}

			while ( list($x, $columns) = each($index) )
			{
				if ( $x == "PRIMARY" ) $def .= "   PRIMARY KEY (`" . implode( $columns, "`, `" ) . "`)";
				else
					if ( substr($x, 0, 6) == "UNIQUE" ) $def .= "   UNIQUE " . substr( $x, 7 ) . " (" . implode( $columns, ", " ) . ")";
					else  $def .= "   KEY $x (`" . implode( $columns, "`, `" ) . "`)";
			}
            $resultField = @mysql_query( "SELECT * FROM `$tablename`" );
			$Field = @mysql_num_rows($resultField);
			$def .= "$this->newline) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=$Field ;";

			return ( stripslashes($def) );
		}

		/**
		 * Generate the selected table's contents
		 * access private
		 * return String table data as INSERT statements
		 * param String $tablename Name of the table to back up
		 */
		function _get_content( $tablename )
		{
			$content = "";

			$result = @mysql_query( "SELECT * FROM $tablename" );

			if ( @mysql_num_rows($result) > 0 )
			{
				$content .= "#------------------------------------------" . $this->newline;
				$content .= "# Data inserts for $tablename" . $this->newline;
				$content .= "#------------------------------------------" . $this->newline;
			}

			while ( $row = @mysql_fetch_row($result) )
			{
				$insert = "INSERT INTO $tablename VALUES (";

				for ( $j = 0; $j < @mysql_num_fields($result); $j++ )
				{
					if ( !isset($row[$j]) ) $insert .= "NULL,";
					else
						if ( $row[$j] != "" ) $insert .= "'" . addslashes( $row[$j] ) . "',";
						else  $insert .= "'',";
				}

				$insert .= ");$this->newline";
				$content .= $insert;
			}

			return $content . $this->newline;
		}

		/**
		 * Define EOL character according to target OS
		 * return String a string containing the newline sequence used by the client (browser)
		 * access private
		 */
		function _define_newline()
		{
			$unewline = "\r\n";

			if ( strstr(strtolower($_SERVER["HTTP_USER_AGENT"]), 'win') )
			{
				$unewline = "\r\n";
			}
			else
				if ( strstr(strtolower($_SERVER["HTTP_USER_AGENT"]), 'mac') )
				{
					$unewline = "\r";
				}
				else
				{
					$unewline = "\n";
				}

				return $unewline;
		}

		/**
		 * Generate the DB backup and send it to browser or download it as a file
		 * access public
		 */
		function perform_backup()
		{

			$now = gmdate( 'D, d M Y H:i:s' ) . ' GMT';
			if ( $this->compress )
			{
				$filename = $this->dbname . ".sql";
				$ext = "gz";
			}
			else
			{
				$filename = $this->dbname;
				$ext = "sql";
			}


			if ( $this->filename )
			{
				$this->_backup();
			}
			else
				if ( $this->output == true )
				{
					$this->_backup();
				}

		}
	}

?>
