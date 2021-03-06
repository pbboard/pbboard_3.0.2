var PowerBB = {};
// objects
var comm, bbcode,baseHeight;
// vars
var isIE, isOpera,isGecko, isWebKit,ua,Editor;
// Browsers check
ua = navigator.userAgent;
PowerBB.isOpera = isOpera = window['opera'] && opera.buildNumber;
PowerBB.isWebKit = isWebKit = /WebKit/.test(ua);
PowerBB.isGecko = isGecko = !isWebKit && /Gecko/.test(ua);
PowerBB.isIE = isIE = !isWebKit && !isOpera && (/MSIE/gi).test(ua) && (/Explorer/gi).test(navigator.appName);

// ----------- PowerBB plug-ins object -----------//
PowerBB.plugins = {};

// ----------- PowerBB bbcode object -----------//
PowerBB.bbcode = bbcode = {
//print the editor
_Print : function(mode,box_height){

//CSS Editor
document.writeln('<div class="editortoolbar"><div class="editoroover">');

if(mode=="mini"){
	// Toolbar icons
	//  switch bbcode /HTML VIEW
//document.writeln('<img src="' + path +'switch.gif" class="editorbutton"  onClick="comm._toggle();" onmouseover="overIcon(this)" onmouseout="outIcon(this)"  title="'+ change_editor + '" align="left" />');
// expand editor & cotract editor
//	document.writeln('<img src="' + path +'arrow_up.gif" class="editorbutton"  onClick="textbox_resize(-100);" onmouseover="overIcon(this)" onmouseout="outIcon(this)"  title="'+ l_con + '" align="left" /><img src="' + path +'arrow_down.gif" class="editorbutton"  onClick="textbox_resize(100);" onmouseover="overIcon(this)" onmouseout="outIcon(this)" title="'+ l_ex + '" align="left" />');
	// remove format
//	document.writeln('<img src="' + path +'delete.gif" class="editorbutton"  onClick="comm._command(\'removeformat\')" onmouseover="overIcon(this)" onmouseout="outIcon(this)" title="'+ l_rf + '" />');
//	document.writeln('<img src="' + path +'separator.gif" />');
	//Size menu
//document.writeln('<select class="editorselect" unselectable="on" id="fontsize" onchange="comm._select(this.id);"><option value="Size" selected>' + l_size +'</option><option value="1">----------------</option><option value="1">' + size1 + '</option><option value="2">' + size2 + '</option><option value="4">' + size3 + '</option><option value="5">' + size4 + '</option><option value="6">' + size5 + '</option></select>');

//document.writeln('<img src="' + path +'separator.gif" />');
// color palette

//font menu
	document.writeln('<select class="editorselect" id="fontname" onchange="comm._select(this.id);"><option value="' + l_font + '">' + l_font + '</option>');
	for (i=0;i<fontsarr.length;i++)
		document.writeln('<option value="' + fontsarr[i] + '">' + fontsarr[i] + '</option>');
		document.writeln('</select>');
 		document.writeln('<img src="' + path +'separator.gif" />');
	document.writeln('<img src="' + path +'palette.gif" id="forecolor" class="editorbutton"  onClick="toggle_visibility(\'colour_palette\');" onmouseover="overIcon(this)" onmouseout="outIcon(this)" title="'+ l_p + '" />');
 		document.writeln('<img src="' + path +'separator.gif" />');

// Bold
	document.writeln('<img src="' + path +'text_bold.gif" class="editorbutton"  onClick="comm._command(\'bold\')" onmouseover="overIcon(this)" onmouseout="outIcon(this)" title="'+ l_b + '" />');
	// italic
	document.writeln('<img src="' + path +'text_italic.gif" class="editorbutton"  onClick="comm._command(\'italic\')" onmouseover="overIcon(this)" onmouseout="outIcon(this)" title="'+ l_i + '" />');
	// Underline
	document.writeln('<img src="' + path +'text_underline.gif" class="editorbutton"  onClick="comm._command(\'underline\')" onmouseover="overIcon(this)" onmouseout="outIcon(this)" title="'+ l_u + '" />');
	// Strike through
	document.writeln('<img src="' + path +'strike.gif" class="editorbutton"  onClick="comm._command(\'StrikeThrough\')" onmouseover="overIcon(this)" onmouseout="outIcon(this)" title="' + l_s +'" />');
		document.writeln('<img src="' + path +'separator.gif" />');

	// Smiles list
	//document.writeln('<img src="' + path +'smilie.gif" class="editorbutton"  onClick="comm._cmd_allsmiles()" onmouseover="overIcon(this)" onmouseout="outIcon(this)" title="'+ smiles + '" />');
		// align right
	//document.writeln('<img src="' + path +'text_align_right.gif" class="editorbutton"  onClick="comm._command(\'justifyright\')" onmouseover="overIcon(this)" onmouseout="outIcon(this)" title="'+ l_jr + '" />');
	// align center
	//document.writeln('<img src="' + path +'text_align_center.gif" class="editorbutton"  onClick="comm._command(\'justifycenter\')" onmouseover="overIcon(this)" onmouseout="outIcon(this)" title="'+ l_jc + '" />');
   			// align left
	//document.writeln('<img src="' + path +'text_align_left.gif" class="editorbutton"  onClick="comm._command(\'justifyleft\')" onmouseover="overIcon(this)" onmouseout="outIcon(this)" title="'+ l_jl + '" />');
//document.writeln('<img src="' + path +'separator.gif" />');
// link
//	document.writeln('<img src="' + path +'world_link.gif" class="editorbutton"  onClick="comm._url('+ l_link_p +')" onmouseover="overIcon(this)" onmouseout="outIcon(this)" title="'+ l_link + '" />');
//insert image
//	document.writeln('<img src="' + path +'photo.gif" class="editorbutton"  onClick="comm._image()" onmouseover="overIcon(this)" onmouseout="outIcon(this)" title="'+ l_image + '" />');
//	document.writeln('<img src="' + path +'separator.gif" />');
// quote
//	document.writeln('<img src="' + path +'quote.gif" class="editorbutton"  onClick="comm._command(\'quote\')" onmouseover="overIcon(this)" onmouseout="outIcon(this)" title="'+ l_quote + '" />');
		// PHP code
//	document.writeln('<img src="' + path +'page_white_code.gif" class="editorbutton" onClick="comm._command(\'code\')" onmouseover="overIcon(this)" onmouseout="outIcon(this)" title="'+ l_phpcode + '" />');
//	document.writeln('<img src="' + path +'separator.gif" />');
	 // keyboard
//	document.writeln('<img src="' + path +'keyboard.png" class="editorbutton" onClick="comm._toggle_key(\'keyboard_palette\');" onmouseover="overIcon(this)" onmouseout="outIcon(this)" title="'+ l_keyboard + '" />');
//	document.writeln('<img src="' + path +'separator.gif" />');
	 // Undo
//	document.writeln('<img src="' + path +'arrow_undo.gif" class="editorbutton"  onClick="comm._command(\'Undo\')" onmouseover="overIcon(this)" onmouseout="outIcon(this)" title="'+ l_undo + '" />');
	//Redo
//	document.writeln('<img src="' + path +'arrow_redo.gif" class="editorbutton"  onClick="comm._command(\'Redo\')" onmouseover="overIcon(this)" onmouseout="outIcon(this)" title="'+ l_redo + '" /> ');

	document.writeln('<div id="colour_palette" style="display:none;">');
	comm._palette('h', 15, 10);
	document.writeln('</div>');
	document.writeln('<iframe class="editoriframemini" id="box" scrolling="auto" frameborder="0" cellspacing="1" scrolling="auto"></iframe>');

	document.writeln('<br /></div>');
}

if(mode=="full"){
//CSS Editor
document.writeln('<div class="editortoolbar"><div class="editoroover">');

	// Toolbar icons
	//  switch bbcode /HTML VIEW
document.writeln('<img src="' + path +'switch.gif" class="editorbutton"  onClick="comm._toggle();" onmouseover="overIcon(this)" onmouseout="outIcon(this)"  title="'+ change_editor + '" align="left" />');
// expand editor & cotract editor
	document.writeln('<img src="' + path +'arrow_up.gif" class="editorbutton"  onClick="textbox_resize(-100);" onmouseover="overIcon(this)" onmouseout="outIcon(this)"  title="'+ l_con + '" align="left" /><img src="' + path +'arrow_down.gif" class="editorbutton"  onClick="textbox_resize(100);" onmouseover="overIcon(this)" onmouseout="outIcon(this)" title="'+ l_ex + '" align="left" />');
	// remove format
	document.writeln('<img src="' + path +'delete.gif" class="editorbutton"  onClick="comm._command(\'removeformat\')" onmouseover="overIcon(this)" onmouseout="outIcon(this)" title="'+ l_rf + '" />');
//font menu
	document.writeln('<select class="editorselect" id="fontname" onchange="comm._select(this.id);"><option value="' + l_font + '">' + l_font + '</option>');
	for (i=0;i<fontsarr.length;i++)
		document.writeln('<option value="' + fontsarr[i] + '">' + fontsarr[i] + '</option>');
		document.writeln('</select>');
	//Size menu
document.writeln('<select class="editorselect" unselectable="on" id="fontsize" onchange="comm._select(this.id);"><option value="Size" selected>' + l_size +'</option><option value="1">----------------</option><option value="1">' + size1 + '</option><option value="2">' + size2 + '</option><option value="4">' + size3 + '</option><option value="5">' + size4 + '</option><option value="6">' + size5 + '</option></select>');
// custom menu
	document.writeln('<select class="editorselect" id="sent" onchange="comm._focus();comm._HTML(\' \',\' \',this.value);comm._focus();"><option value="' + l_exp + '">' + l_exp + '</option>');
	for (i=0;i<l_sent.length;i++)
		document.writeln('<option value="' + l_sent_value[i] + '">' + l_sent[i] + '</option>');
		document.writeln('</select>');
// Bold
	document.writeln('<br /><img src="' + path +'text_bold.gif" class="editorbutton"  onClick="comm._command(\'bold\')" onmouseover="overIcon(this)" onmouseout="outIcon(this)" title="'+ l_b + '" />');
	// italic
	document.writeln('<img src="' + path +'text_italic.gif" class="editorbutton"  onClick="comm._command(\'italic\')" onmouseover="overIcon(this)" onmouseout="outIcon(this)" title="'+ l_i + '" />');
	// Underline
	document.writeln('<img src="' + path +'text_underline.gif" class="editorbutton"  onClick="comm._command(\'underline\')" onmouseover="overIcon(this)" onmouseout="outIcon(this)" title="'+ l_u + '" />');
	// Strike through
	//document.writeln('<img src="' + path +'strike.gif" class="editorbutton"  onClick="comm._command(\'StrikeThrough\')" onmouseover="overIcon(this)" onmouseout="outIcon(this)" title="' + l_s +'" />');
		document.writeln('<img src="' + path +'separator.gif" />');
	// align right
	document.writeln('<img src="' + path +'text_align_right.gif" class="editorbutton"  onClick="comm._command(\'justifyright\')" onmouseover="overIcon(this)" onmouseout="outIcon(this)" title="'+ l_jr + '" />');
	// align center
	document.writeln('<img src="' + path +'text_align_center.gif" class="editorbutton"  onClick="comm._command(\'justifycenter\')" onmouseover="overIcon(this)" onmouseout="outIcon(this)" title="'+ l_jc + '" />');
   			// align left
	document.writeln('<img src="' + path +'text_align_left.gif" class="editorbutton"  onClick="comm._command(\'justifyleft\')" onmouseover="overIcon(this)" onmouseout="outIcon(this)" title="'+ l_jl + '" />');
document.writeln('<img src="' + path +'separator.gif" />');
	// Outdent text
  	document.writeln('<img src="' + path +'text_indent_remove.gif" class="editorbutton"  onClick="comm._command(\'outdent\')" onmouseover="overIcon(this)" onmouseout="outIcon(this)" title="'+ l_out + '" />');
	// indent text
 	document.writeln('<img src="' + path +'text_indent.gif" class="editorbutton"  onClick="comm._command(\'indent\')" onmouseover="overIcon(this)" onmouseout="outIcon(this)" title="'+ l_ind + '" />');
document.writeln('<img src="' + path +'separator.gif" />');

// ordered list
	document.writeln('<img src="' + path +'text_list_numbers.gif" class="editorbutton"  onClick="comm._command(\'InsertOrderedlist\')" onmouseover="overIcon(this)" onmouseout="outIcon(this)" title="'+ l_ol + '" />');
	// unordered list
	document.writeln('<img src="' + path +'text_list_bullets.gif" class="editorbutton"  onClick="comm._command(\'InsertUnorderedlist\')" onmouseover="overIcon(this)" onmouseout="outIcon(this)" title="'+ l_ul + '" />');
	// Smiles list
	document.writeln('<img src="' + path +'smilie.gif" class="editorbutton"  onClick="comm._cmd_allsmiles()" onmouseover="overIcon(this)" onmouseout="outIcon(this)" title="'+ smiles + '" />');
 //
     document.writeln('<img src="' + path +'separator.gif" />');
// link
	document.writeln('<img src="' + path +'world_link.gif" class="editorbutton"  onClick="comm._url('+ l_link_p +')" onmouseover="overIcon(this)" onmouseout="outIcon(this)" title="'+ l_link + '" />');
	// unlink
	document.writeln('<img src="' + path +'world_delete.gif" class="editorbutton"  onClick="comm._command(\'Unlink\')" onmouseover="overIcon(this)" onmouseout="outIcon(this)" title="'+ l_unlink + '" />');
// Email
document.writeln('<img src="' + path +'email.gif" class="editorbutton"  onClick="comm._email('+ l_email_p +')" onmouseover="overIcon(this)" onmouseout="outIcon(this)" title="'+ l_email + '" />');
//insert image
	document.writeln('<img src="' + path +'photo.gif" class="editorbutton"  onClick="comm._image()" onmouseover="overIcon(this)" onmouseout="outIcon(this)" title="'+ l_image + '" />');
	// insert youtube
	document.writeln('<img src="' + path +'youtube.gif" class="editorbutton"  onClick="comm._youtube('+ l_youtube_p +')" onmouseover="overIcon(this)" onmouseout="outIcon(this)" title="'+ l_youtube + '" />');
// insert flash
	document.writeln('<img src="' + path +'flash.gif" class="editorbutton"  onClick="comm._flash('+ l_flash_p +')" onmouseover="overIcon(this)" onmouseout="outIcon(this)" title="'+ l_flash + '" />');
// insert media
	document.writeln('<img src="' + path +'media.gif" class="editorbutton"  onClick="comm._media('+ l_media_p +')" onmouseover="overIcon(this)" onmouseout="outIcon(this)" title="'+ l_media + '" />');
// insert rplayer
	document.writeln('<img src="' + path +'ram.gif" class="editorbutton"  onClick="comm._ram('+ l_ram_p +')" onmouseover="overIcon(this)" onmouseout="outIcon(this)" title="'+ l_ram + '" />');
// color palette
	document.writeln('<img src="' + path +'palette.gif" id="forecolor" class="editorbutton"  onClick="toggle_visibility(\'colour_palette\');" onmouseover="overIcon(this)" onmouseout="outIcon(this)" title="'+ l_p + '" />');
// insert gradient
	document.writeln('<img src="' + path +'separator.gif" />');
	document.writeln('<img src="' + path +'gradient.gif" class="editorbutton" onClick="comm._cmd_gradient()" onmouseover="overIcon(this)" onmouseout="outIcon(this)" title="'+ l_gradient + '" />');
// insert poem
	document.writeln('<img src="' + path +'poem.gif" class="editorbutton" onClick="comm._cmd_poem()" onmouseover="overIcon(this)" onmouseout="outIcon(this)" title="'+ l_poem + '" />');
// insert frames
	document.writeln('<img src="' + path +'frame.gif" class="editorbutton" onClick="comm._cmd_frame()" onmouseover="overIcon(this)" onmouseout="outIcon(this)" title="'+ l_frame + '" />');
	document.writeln('<img src="' + path +'separator.gif" />');
	// Horizontal Rule
	document.writeln('<img src="' + path +'hr.gif" class="editorbutton"  onClick="comm._command(\'InsertHorizontalRule\')" onmouseover="overIcon(this)" onmouseout="outIcon(this)" onmouseover="overIcon(this)" onmouseout="outIcon(this)" title="' + l_hr +'" />');

	// subscript
	document.writeln('<img src="' + path +'subscript.gif" class="editorbutton"  onClick="comm._command(\'subscript\')" onmouseover="overIcon(this)" onmouseout="outIcon(this)" title="' + l_sub +'" />');
	// superscript
	document.writeln('<img src="' + path +'superscript.gif" class="editorbutton"  onClick="comm._command(\'superscript\')" onmouseover="overIcon(this)" onmouseout="outIcon(this)" title="' + l_sup +'" />');
if (!isIE) {
	//Delete text
	document.writeln('<img src="' + path +'del.gif" class="editorbutton"  onClick="comm._command(\'delete\')" onmouseover="overIcon(this)" onmouseout="outIcon(this)" title="'+ l_remove + '" />');
}
	document.writeln('<img src="' + path +'separator.gif" />');
	// insert table
 document.writeln('<img src="' + path +'table.gif" class="editorbutton"  onClick="comm._table()" onmouseover="overIcon(this)" onmouseout="outIcon(this)" title="'+ insert_table + '" />');
	// quote
	document.writeln('<img src="' + path +'quote.gif" class="editorbutton"  onClick="comm._command(\'quote\')" onmouseover="overIcon(this)" onmouseout="outIcon(this)" title="'+ l_quote + '" />');
	//code
	// document.writeln('<img src="' + path +'page_white_code.gif" class="editorbutton"  onClick="comm._command(\'code\')" onmouseover="overIcon(this)" onmouseout="outIcon(this)" title="'+ l_code + '" />');
	// PHP code
	document.writeln('<img src="' + path +'page_white_code.gif" class="editorbutton"   onClick="comm._command(\'code\')" onmouseover="overIcon(this)" onmouseout="outIcon(this)" title="'+ l_phpcode + '" />');
	document.writeln('<img src="' + path +'separator.gif" />');
	 // keyboard
	document.writeln('<img src="' + path +'keyboard.png" class="editorbutton" onClick="comm._toggle_key(\'keyboard_palette\');" onmouseover="overIcon(this)" onmouseout="outIcon(this)" title="'+ l_keyboard + '" />');
	document.writeln('<img src="' + path +'separator.gif" />');
	 // Undo
	document.writeln('<img src="' + path +'arrow_undo.gif" class="editorbutton"  onClick="comm._command(\'Undo\')" onmouseover="overIcon(this)" onmouseout="outIcon(this)" title="'+ l_undo + '" />');
	//Redo
	document.writeln('<img src="' + path +'arrow_redo.gif" class="editorbutton"  onClick="comm._command(\'Redo\')" onmouseover="overIcon(this)" onmouseout="outIcon(this)" title="'+ l_redo + '" /> ');

	document.writeln('<div id="colour_palette" style="display:none;">');
	comm._palette('h', 15, 10);
	document.writeln('</div>');
	document.writeln('<iframe class="editoriframe" id="box" scrolling="auto" frameborder="0" cellspacing="1"></iframe');
	document.writeln('<br /></div>');
}

	bbcode.Start();
},

// turning the editor on
Start  : function (){
		Editor = document.getElementById('box').contentWindow.document;
		//writing iframe content and style of the editor
		var iframeContent;
		iframeContent  = '<html xmlns="http://www.w3.org/1999/xhtml" dir="' + direction + '" lang="ar-sa" xml:lang="ar-sa">\n';
		iframeContent += '<head></head><body>';
		iframeContent += '</body></html>';
		Editor.open();
		Editor.write(iframeContent);
		Editor.close();
		Editor.designMode = "on";
		// disable CSS in Geko ,IE and opera
		try {
			// Try new Gecko method
			Editor.execCommand("styleWithCSS", 0, false);
		} catch (e) {
			// Use old method
			try {Editor.execCommand("useCSS", 0, true);} catch (e) {};
		}
},

// convert BBcode to HTML code
_BBcodetoHTML : function (a)
{
    function r(re, str) {
            a = a.replace(re, str);
    };
	r(/\n+(\[\/list\])/gi,'[/list]');
	r(/\[list\]\n+/gi,'[list]');
	r(/\[list=1\]\n+/gi,'[list=1]');
	r(/\[list=a\]\n+/gi,'[list=a]');
	r(/\n+\[\/tr\]/gi,'[/tr]');
	r(/\n+\[tr\]/gi,'[tr]');
	r(/\n+\[td\]/gi,'[td]');
	r(/\n+\[\/td\]/gi,'[/td]');
	r(/\n+\[\/table\]/gi,'[/table]');
	r(/\[\/table\]$/gi,"[/table]\n");
	r(/&/g,'&amp;');
	r(/</g,'&lt;');
	r(/>/g,'&gt;');
	r(/  /g,'&nbsp;&nbsp;');
	r(/\t/g,'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
	r(/\n/g,'<br />');
	r(/\[hr\]/gi,'<hr />');
	r(/\[\/hr]/gi,'');
	r(/\[table\]/gi,'<table style="width: 100%; padding: 0px; border: none; border: 1px solid #789DB3;">');
	r(/\[\/table\]/gi,'</table>');
	r(/\[(\/|)tr\]/gi,'<$1tr>');
	r(/\[(\/|)td\]/gi,'<$1td style="font-size: 20px; border: 1px solid #789DB3; background-color: #F4F4F4">');
	r(/\[(sub|sup|strike|s|b|i|u)\]/gi,'<$1>');
	r(/\[\/(sub|sup|strike|s|b|i|u)\]/gi,'</$1>');
	r(/\[font=(.*?)\]/gi,'<font face="$1">');
	r(/\[color=(.*?)\]/gi,'<font color="$1">');
	r(/\[size=(.*?)\]/gi,'<font size="$1">');
	r(/\[\/(font|color|size)\]/gi,'</font>');
	r(/\[(center|left|right|justify)\]/gi,'<div align="$1">');
	r(/\[\/(center|left|right|justify)\]/gi,'</div>');
	r(/\[url=(.*?)\]/gi,'<a href="$1">');
	r(/\[url\](.*?)\[\/url\]/gi,'<a href="$1">$1[/url]');
	r(/\[\/url\]/gi,'</a>');
	r(/\[Email=(.*?)\]/gi,'<a href="$1">');
	r(/\[Email\](.*?)\[\/Email\]/gi,'<a href="mailto:$1">$1[/email]');
	r(/\[\/Email\]/gi,'</a>');
	r(/\[img\](.*?)\[\/img\]/gi,'<img src="$1">');
	var b=a.match(/\[(list|list=1|list=a)\]/gi);
	r(/\[list=1\]/gi,'<ol>');
	r(/\[list=a\]/gi,'<ol style="list-style-type: lower-alpha">');
	r(/\[list\]/gi,'<ul>');
	r(/\[\*\]/gi,'<li>');
	r(/<br[^>]*><li>/gi,'<li>');
	r(/<br[^>]*> <li>/gi,'<li>');
	r(/<br[^>]*><\/li>/gi,'</li>');
	r(/\[h([1-6])?\]/gi,"<h$1>");
	r(/\[\/h([1-6])?\]/gi,"</h$1>");
	if(b){for(var i=0;i<b.length;i++){if(b[i].toLowerCase()=="[list]"){r(/\[\/list\]/i,'</ul>');}else if(b[i].toLowerCase()=="[list=1]"||b[i].toLowerCase()=="[list=a]"){r(/\[\/list\]/i,'</ol>');}}}
	if(isOpera){r(/<\/table>/gi,'</tr></table>');r(/<\/tr>/gi,'</td></tr>');}
	if(isOpera||isIE){r(/<li>/gi,'</li><li>');r(/<\/(ol|ul)>/gi,'</li></$1>');}
	return a;
},

// erase white spaces from the text inside the editor
_erase : function (a)
{
	if(typeof a!="string")return a;
	var b=a;
	var c=b.substring(0,1);
	while(c==" ")
	{
		b=b.substring(1,b.length);
		c=b.substring(0,1)
	}
	c=b.substring(b.length-1,b.length);
	while(c==" ")
	{
		b=b.substring(0,b.length-1);
		c=b.substring(b.length-1,b.length)
	}
	while(b.indexOf("  ")!=-1)
	{
		b=b.substring(0,b.indexOf("  "))+b.substring(b.indexOf("  ")+1,b.length)
	}
	return b ;
},

// convert HTML to bb when submit bbcode
_HTMLtoBBcode : function (a) {
	    function r(re, str) {
	            a = a.replace(re, str);
	    };
        if (isIE) {
            r(/<\/li>/gi, "");
            r(/<li>/gi, "[*]");
        }
        r(/<div><\/div>/gi, "");
        r(/<br[^>]*>/gi, "<br />");
        r(/[\n\r]/gi, "");
        r(/<script>(.*?)<\/script>/gi, "");
        r(/<script.*?>(.*?)<\/script>/gi, "");
		// remove style tag with anything within
        r(/<style>(.*?)<\/style>/gi, "");
        r(/<style.*?>(.*?)<\/style>/gi, "");
		// remove tags <w:> of MS word
        r(/<w:.*?>(.*?)<\/w:.*?>/gi, "");
        r(/<(abbr|acronym|applet|area|base|basefont|bdo|bgSound|big|body|button|caption|center|cite|code|col|colGroup|comment|custom|dd|del|dfn|dir|dl|dt|embed|fieldSet|frame|frameSet|head|html|ins|isIndex|kbd|label|legend|link|listing|map|marquee|menu|meta|noBR|noFrames|noScript|optGroup|option|param|plainText|pre|q|rt|ruby|samp|small|tBody|tFoot|tHead|title|tt|wbr|xml|xmp|th|script|form|input|iframe|object|select|textarea)(.*?)>/gi, "");
        r(/<\/(abbr|acronym|applet|area|base|basefont|bdo|bgSound|big|body|button|caption|center|cite|code|col|colGroup|comment|custom|dd|del|dfn|dir|dl|dt|embed|fieldSet|frame|frameSet|head|html|ins|isIndex|kbd|label|legend|link|listing|map|marquee|menu|meta|noBR|noFrames|noScript|optGroup|option|param|plainText|pre|q|rt|ruby|samp|small|tBody|tFoot|tHead|title|tt|wbr|xml|xmp|th|script|form|iframe|object|select|textarea)(.*?)>/gi, "");
        r(/\xA0/gi, " ");
        r(/<br[^>]*><\/div>/gi, "</div>");
        r(/<br[^>]*>/gi, "\n");
        r(/<hr[^>]*>/gi, "[hr][/hr]");
        r(/<\/hr>/gi, "");
        r(/<(ul|ol)><\/li>/gi, "<$1>");
        r(/  /gi, " ");
        r(/<p([^>]*)>/gi, "<div$1>");
        r(/<\/p([^>]*)>/gi, "</div$1>\n");
        r(/\t/g, "     ");
        r(/\n /g, "\n");
        r(/<a.*?href=\"(.*?)\".*?>(.*?)<\/a>/gi, "[url=$1]$2[/url]");
        r(/<a.*?href=\"mailto:(.*?)\".*?>(.*?)<\/a>/gi, "[Email=$1]$2[/Email]");
        r(/<h([1-6])([^>]*)>/gi, "[h$1]");
        r(/<\/h([1-6])([^>]*)>/gi, "[/h$1]");
        var b = a.split("<");
        var c = new Array;
        var e = 0;
        if (b.length > 1) {
            for (var i = 0; i < b.length; i++) {
                if (i > 0) {
                    b[i] = "<" + b[i];
                }
                var f = b[i];
                if (f.match(/<(div|span|font|strong|b|u|i|em|var|address|h1|h2|h3|h4|h5|h6|blockquote|img|ol|ul|li|a|strike|s|sub|sup|hr|table|tr|td)( ([^>]{1,}.*?)){0,1}( {0,1}){0,1}>/i)) {
                    var g = RegExp.$1;
                    var h = RegExp.$3;
                    if (h.toLowerCase().indexOf("style=") != -1 && h.toLowerCase().indexOf("font-family:") != -1 && h.toLowerCase().indexOf("face=") != -1) {
                        h = h.replace(/face="(.*?)"/gi, "");
                    } else if (h.toLowerCase().indexOf("style=") != -1 &&  h.toLowerCase().indexOf("color:") != -1 && h.toLowerCase().indexOf("color=") != -1) {
                        h = h.replace(/color="(.*?)"/gi, "");
                    }
                    h = h.replace(/(color=|size=|face=|style=)/gi, "|$1");
                    h = h.replace(/('|")/g, "");
                    h = h.replace(/ \|/g, "|");
                    var j = h.split("|");
                    var k = new Array;
                    if (j != null) {
                        for (var z = 0; z < j.length; z++) {
                            var l = j[z].split("=");
                            k[l[0].toLowerCase()] = j[z].replace(l[0].toLowerCase() + "=", "");
                        }
                    }
                    var m = "";
                    var g = g.toLowerCase();
                    if (g == "strike" || g == "s") {
                        if (k.style) {
                            m = "[s]" + this._process(g, k);
                        } else {
                            m = "[s]";
                        }
                    } else if (g == "sub") {
                        if (k.style) {
                            m = "[sub]" + this._process(g, k);
                        } else {
                            m = "[sub]";
                        }
                    } else if (g == "sup") {
                        if (k.style) {
                            m = "[sup]" + this._process(g, k);
                        } else {
                            m = "[sup]";
                        }
                    } else if (g == "li") {
                        if (k.style) {
                            m = "[*]" + this._process(g, k);
                        } else {
                            m = "[*]";
                        }
                    } else if (g == "strong" || g == "b") {
                        if (k.style) {
                            if (k.style.toLowerCase().indexOf("font-weight: bold") != -1 ||  k.style.toLowerCase().indexOf("font-weight: 700") != -1) {
                                m = this._process(g, k);
                            } else {
                                m = "[b]" + this._process(g, k);
                            }
                        } else {
                            m = "[b]";
                        }
                    } else if (g == "em" ||
                        g == "i" || g == "var" || g == "address") {
                        if (k.style) {
                            if (k.style.toLowerCase().indexOf("font-style: italic") != -1) {
                                m = this._process(g, k);
                            } else {
                                m = "[i]" + this._process(g, k);
                            }
                        } else {
                            m = "[i]";
                        }
                    } else if (g == "u") {
                        if (k.style) {
                            if (k.style.toLowerCase().indexOf("text-decoration: underline") != -1) {
                                m = this._process(g, k);
                            } else {
                                m = "[u]" + this._process(g, k);
                            }
                        } else {
                            m = "[u]";
                        }
                    } else if (g == "ol") {
                        if (k.style) {
                            m = this._process(g, k);
                            if (m.indexOf("[list=a]") == -1) {
                                m += "[list=1]";
                            }
                        } else if (k.align) {
                            m = "[" + k.align.toUpperCase() + "]" + "[list=1]";
                        } else {
                            m = "[list=1]";
                        }
                    } else if (g == "ul") {
                        if (k.style) {
                            m = this._process(g, k) + "[list]";
                        } else if (k.align) {
                            m = "[" + k.align.toUpperCase() + "]" + "[list=1]";
                        } else {
                            m = "[list]";
                        }
                    } else if (g == "font" || g == "h1" || g == "h2" || g == "h3" || g == "h4" || g == "h5" || g == "h6") {
                        if (j.length > 0) {
                            for (var r in k) {
                                if (r == "color") {
                                    m += "[color=" + k.color + "]";
                                } else if (r == "size") {
                                    if (isNaN(parseInt(k.size))) {
                                        k.size = 2;
                                    }
                                    m += "[size=" + k.size + "]";
                                } else if (r == "face") {
                                    m += "[font=" + k.face + "]";
                                } else if (r == "style") {
                                    m += this._process(g, k);
                                }
                            }
                        }
                    } else if (g == "div" || g == "span") {
                        if (k.style) {
                            m = this._process(g, k);
                        } else if (k.align) {
                            m = "[" + k.align.toUpperCase() + "]";
                        } else {
                            m = "[PowerBB]";
                        }
                    } else if (g == "img") {
                        if (isWebKit) {
                            f = f.replace(/<img(.*?)src="(.*?)">/gi, "[IMG]$2[/IMG]");
                        } else {
                            f.match(/<img(.*?)src="(.*?)"(.*?)>/gi);
                            var s = RegExp.$2;
                            s = s.replace("./", "");
                            if (s.toLowerCase().substr(0, 7) != "http://") {
                                var t = document.URL;
                                t = t.replace("http://", "");
                                var u = t.split("/");
                                var v = "http://";
                                for (var d = 0; d < u.length; d++) {
                                    if (d < u.length - 1) {
                                        v += u[d] + "/";
                                    }
                                }
                                f = f.replace(/<img(.*?)src="(.*?)"(.*?)>/gi, "[IMG]$2[/IMG]");
                                f = f.replace("unsaved:///", "");

                            } else {
                                f = f.replace(/<img(.*?)src="(.*?)"(.*?)>/gi, "[IMG]$2[/IMG]");
                                f = f.replace("unsaved:///", "");
                            }
                        }
                    } else if (g == "table") {
                        m = "[table]";
                    } else if (g == "tr") {
                        m = "[tr]";
                    } else if (g == "td") {
                        m = "[td]";
                    }
                    b[i] = f.replace(/(<([^>]+)>)/, m);
                    if (g != "img") {
                        c[e] = m;
                        e++;
                    }
                } else if (f.match(/<\/(div|span|font|strong|b|u|i|em|var|address|h1|h2|h3|h4|h5|h6|blockquote|ol|ul|li|a|strike|s|sub|sup|table|tr|td)>/i)) {
                    e--;
                    var w = c.pop();
                    if (w != null) {
                        var x = "";
                        var A = w;
                        A = A.replace(/=(.*?)\]/g, "]");
                        A = A.replace(/\]/g, "],");
                        A = A.replace(/\[(.*?)\]/g, "[/$1]");
                        var B = A.split(",");
                        B.reverse();
                        for (var y = 0; y < B.length; y++) {
                            x += B[y];
                        }
                        x = x.replace(/\[\/\*\]/gi, "");
                        b[i] = b[i].replace(/(<([^>]+)>)/, x);
                    } else {
                        b[i] = b[i].replace(/(<([^>]+)>)/, "");
                    }
                }
            }
            var C = b.join("");
        } else {
            var C = a;
        }
		function r2(re, str) {
	            C = C.replace(re, str);
	    };
        r2(/<[^>]*>/g, "");
        r2(/&lt;/g, "<");
        r2(/&gt;/g, ">");
        r2(/&nbsp;/g, " ");
        r2(/&amp;/g, "&");
        r2(/     /g, "\t");
        r2(/\[PowerBB\]/g, "\n");
        r2(/\[PowerBB\]\n+/g, "\n");
        r2(/\[\/PowerBB\]\n+/g, "\n");
        r2(/\[\/PowerBB\]/g, "\n");
        r2(/\[\*\]/gi, "\n[*]");
        r2(/\n\n\[\*\]/gi, "\n[*]");
        r2(/\[color=#.\w*\]\[\/color\]/gi, "");
        r2(/\[size=\d\]\[\/size\]/gi, "");
        r2(/\[b\]\[\/b\]/gi, "");
        r2(/\[u\]\[\/u\]/gi, "");
        r2(/\[i\]\[\/i\]/gi, "");
        r2(/\[left\]\[\/left\]/gi, "");
        r2(/\[center\]\[\/center\]/gi, "");
        r2(/\[right\]\[\/right\]/gi, "");
        r2(/\[Email\]\[\/Email\]/gi, "");
        r2(/\[s\]\[\/s\]/gi, "");
        r2(/\[sub\]\[\/sub\]/gi, "");
        r2(/\[sup\]\[\/sup\]/gi, "");
        r2(/\[img\]\[\/img\]/gi, "");
        r2(/^\n+/, "");
        r2(/\n+$/, "");
        var D = C.match(/\[table\]/gi);
        var E = C.match(/\[\/table\]/gi);
        if (D && E) {
            if (D.length > E.length) {
                C += "[/table]";
            }
        } else if (D && !E) {
            C += "[/table]";
        }
        r2(/\[\/tr\]/gi, "\n[/tr]");
        r2(/\[tr\]/gi, "\n[tr]");
        r2(/\[td\]/gi, "\n[td]");
        r2(/\[\/table\]/gi, "\n[/table]");
        r2(/\[\/table\]$/gi, "[/table]\n");
        r2(/\[table\]\n+/gi, "[table]");
        r2(/\n+\[td\]/gi, "[td]");
        r2(/\n+\[\/table\]/gi, "[/table]");
        r2(/\n+\[\/td\]/gi, "[/td]");
        r2(/\n+\[tr\]/gi, "[tr]");
        r2(/\n+\[\/tr\]/gi, "[/tr]");
        return C;
},

// processing HTML code to BBcode
_process : function (a, b) {
	var c="";
	var d=b['style'].split(";");
	for(var j=0;j<d.length;j++){
		if(d[j]!=""&&d[j]!=null){
			var e=d[j].split(":");
			var f=e[0].toLowerCase().replace(/ /g,"");
			f=f.replace(/style=/gi,"");
			// fix 'Your message contains too few characters.'
			if(e[1]){
				var g=e[1].replace(/^ +| +$/g,"");
			}
                        if(f=="background-color")
                                {
                                        if(g.indexOf("#")==-1)
                                        {
                                                var h=this._toHex(g);
                                        } else {
                                                var h=g ;
                                        }
                                c+='[highlight='+h+']';
                                }
                                else if (f == "vertical-align" && g == "sub") {
                    c += "[sub]";
                } else if (f == "vertical-align" && g == "super") {
                    c += "[sup]";
                } else if (f == "list-style-type" && g == "lower-alpha") {
                    c += "[list=a]";
                } else if (f == "text-align") {
                    g = g.toUpperCase();
                    c += "[" + g + "]";
                } else if(f=="margin-left"||f=="margin-right"){
                                g=parseInt(g)/40;
                                for(var z=0;z<g;z++)
                                        {
                                        c+='[blockquote]';
                                        }
                        }else if (f == "font-weight") {
                    if (g.toUpperCase() == "BOLD" || g.toUpperCase() == "700") {
                        c += "[b]";
                    }
                } else if (f == "font-style") {
                    if (g.toUpperCase() == "ITALIC") {
                        c += "[i]";
                    }
                } else if (f == "font-family") {
                    c += "[font=" + g + "]";
                } else if (f == "font-size") {
                    if (g == "8pt" || g == "9pt" || g == "x-small") {
                        c += "[size=1]";
                    } else if (g == "10pt" || g == "11pt" || g == "small") {
                        c += "[size=2]";
                    } else if (g == "12pt" || g == "13pt" || g == "medium") {
                        c += "[size=3]";
                    } else if (parseInt(g) >= 14 && parseInt(g) < 18 || g == "large") {
                        c += "[size=4]";
                    } else if (parseInt(g) >= 18 && parseInt(g) < 24 || g == "x-large") {
                        c += "[size=5]";
                    } else if (parseInt(g) >= 24 && parseInt(g) < 36 || g == "xx-large") {
                        c += "[size=6]";
                    } else if (parseInt(g) >= 36 || g == "-webkit-xxx-large") {
                        c += "[size=7]";
                    }
                } else if (f == "text-decoration") {
                    if (g.toUpperCase() == "UNDERLINE") {
                        c += "[u]";
                    } else if (g.toUpperCase() == "LINE-THROUGH") {
                        c += "[s]";
                    }
                } else if (f == "color") {
                                        g=g.replace(/^ +| +$/g,"");
                    if (g.indexOf("#") == -1) {
                                        if (g.match(/rgb\((.*?)\)/gi)){
                                        var h = this._toHex(g);
                                        }else{
                       var h = g; }
                                           } else {
                        var h = g;
                    }
                    c += "[color=" + h + "]";
                }
            }
        }
        return c;
},
//converting rgb(..) to Hex
_toHex : function (a)
	{
	a=a.replace(/rgb\((.*?)\)/gi,"$1");
	a=a.replace(/ /,"");
	var c=a.split(",");
	var r=parseInt(c[0]).toString(16);
	var g=parseInt(c[1]).toString(16);
	var b=parseInt(c[2]).toString(16);
	if(r.length==1)r="0"+r;
	if(g.length==1)g="0"+g;
	if(b.length==1)b="0"+b;
	return"#"+r+g+b
}
};

// ----------- PowerBB command object -----------//
PowerBB.comm = comm = {
_viewmode : 0 ,
_focus : function ()
{
var editor = document.getElementById('box');
editor.contentWindow.focus();
},
// the execCommand function
_command : function (command)
{
	if (this._viewmode == 1){
	if (command == 'justifycenter' && isWebKit){
	this._focus();
	this._HTML('<div align="center">','</div>','');
	this._focus();
	}else if (command == 'justifyleft' && isWebKit){
	this._focus();
	this._HTML('<div align="left">','</div>','');
	this._focus();
	}else if (command == 'justifyright' && isWebKit){
	this._focus();
	this._HTML('<div align="right">','</div>','');
	this._focus();
	}else if (command == 'quote'){
	this._focus();
	this._HTML('[quote]','[/quote]','');
	this._focus();
	}else if (command == 'code'){
	this._focus();
	this._HTML('[code]','[/code]','');
	this._focus();
	}else{
	this._focus();
	document.getElementById('box').contentWindow.document.queryCommandEnabled(command);
	document.getElementById('box').contentWindow.document.execCommand(command, false, null);
	this._focus();
}
}else {
if (command == 'bold'){
bbfontstyle('[b]','[/b]');
}else if (command == 'italic'){
bbfontstyle('[i]','[/i]');
}else if (command == 'underline'){
bbfontstyle('[u]','[/u]');
}else if (command == 'StrikeThrough'){
bbfontstyle('[s]','[/s]');
}else if (command == 'InsertHorizontalRule'){
bbfontstyle('[hr]','[/hr]');
}else if (command == 'subscript'){
bbfontstyle('[sub]','[/sub]');
}else if (command == 'code'){
bbfontstyle('[code]','[/code]');
}else if (command == 'quote'){
bbfontstyle('[quote]','[/quote]');
}else if (command == 'superscript'){
bbfontstyle('[sup]','[/sup]');
}else if (command == 'justifyleft'){
bbfontstyle('[left]','[/left]');
}else if (command == 'justifyright'){
bbfontstyle('[right]','[/right]');
}else if (command == 'justifycenter'){
bbfontstyle('[center]','[/center]');
}else if (command == 'InsertOrderedlist'){
bbfontstyle('[list=1]','[/list]');
}else if (command == 'InsertUnorderedlist'){
bbfontstyle('[list]','[/list]');
}else if (command == 'indent'){
bbfontstyle('                ','             ');

}else {
alert(must_disabled_bbcode_mode);

}
}
},

// create youtube of selection through prompt
_youtube : function (prompyoutubeURL)
{
	if (this._viewmode == 1){
    if (prompyoutubeURL == 1){
	var youtubeURL = cbPrompt(l_youtube, 'http://');
	if ((youtubeURL != null) && (youtubeURL != "")) {
		editor = document.getElementById('box');
		this._focus();
		this._HTML('[youtube]'+ youtubeURL +'[/youtube]','');
		this._focus();
		}
		}
		  	  }else {
bbfontstyle('[youtube]','[/youtube]');
}
},

// create media of selection through prompt
_media : function (prompmediaURL)
{
	if (this._viewmode == 1){
    if (prompmediaURL == 1){
	var mediaURL = cbPrompt(l_media, 'http://');
	if ((mediaURL != null) && (mediaURL != "")) {
		editor = document.getElementById('box');
		this._focus();
		this._HTML('[media]'+ mediaURL +'[/media]','');
		this._focus();
		}
		}
		  	  }else {
bbfontstyle('[media]','[/media]');
}
},

// create ram of selection through prompt
_ram : function (prompramURL)
{
	if (this._viewmode == 1){
    if (prompramURL == 1){
	var ramURL = cbPrompt(l_ram, 'http://');
	if ((ramURL != null) && (ramURL != "")) {
		editor = document.getElementById('box');
		this._focus();
		this._HTML('[ram]'+ ramURL +'[/ram]','');
		this._focus();
		}
		}
		  	  }else {
bbfontstyle('[ram]','[/ram]');
}
},

// create flash of selection through prompt
_flash : function (prompflash)
{
	if (this._viewmode == 1){
    if (prompflash== 1){
	var flash = cbPrompt(l_flash_url, "http://");
	if ((flash != null) && (flash != "")) {
		editor = document.getElementById('box');
		var width = cbPrompt(l_flash_width, "200");
	    var height = cbPrompt(l_flash_height, "400");
		this._focus();
		this._HTML('[Flash='+ flash +']width='+ height +' height='+ width +'[/Flash]','');
		this._focus();
		}
		}
		  	  }else {
		var flash = cbPrompt(l_flash_url, "http://");
	if ((flash != null) && (flash != "")) {
		editor = document.getElementById('box');
		var width = cbPrompt(l_flash_width, "200");
		var height = cbPrompt(l_flash_height, "400");
		this._focus();
bbfontstyle('[Flash='+ flash +']width='+ height +' height='+ width ,'[/Flash]');
		this._focus();
		}
}
},

// create frame of selection through prompt
_cmd_frame : function (str)
{
if (!isIE) {
		d=document.getElementById('box').contentWindow;
		d.focus();
		var oSelText=d.getSelection();
		if (oSelText == "") {
    		    alert(should_mislead_or_select_text_first);
    		    return;
    	    }
}
             code = showModalDialog("index.php?page=misc&frame_form=1","","help:no; center:yes; status:no; dialogHeight:220px; dialogWidth:450px");
        	if (!code)
        		return;
		editor = document.getElementById('box');
		this._focus();
		this._HTML('[frame=' + code +']'  ,'[/frame]');
		this._focus();

        },



// create URL of selection through prompt
_url : function (prompturl)
{
        if (this._viewmode == 1){
                var szURL = prompt(url_enter, "http://");
                var tURL = prompt(url_enter_desc, "");
                if(tURL!= null){
				editor = document.getElementById('box');
				this._focus();
				this._HTML('<a href ="'+ szURL +'">'+ tURL +'</a>','');
				this._focus();
		                 }else{
                if ((szURL != null) && (szURL != "")) {
                        var Editor = document.getElementById('box').contentWindow.document;
                        this._focus();
                        Editor.queryCommandEnabled("CreateLink");
                        Editor.execCommand("CreateLink", false,szURL);
                        this._focus();
                  }
          }
		  	  }else {
	var szURL = prompt(url_enter, 'http://');
	if ((szURL!= null) && (szURL!= "")) {
		editor = document.getElementById('box');
	  var tURL = prompt(url_enter_desc, "");
		this._focus();
        bbfontstyle('[url=' + szURL +']' + tURL ,'[/url]');
		this._focus();
}
}
},

// create gradient of selection through prompt
_cmd_gradient : function (str)
{
	if (!isIE) {
		d=document.getElementById('box').contentWindow;
		d.focus();
		var oSelText=d.getSelection();
		if (oSelText == "") {
    		    alert(should_mislead_or_select_text_first);
    		    return;
    	    }
}
            code = showModalDialog("index.php?page=misc&gradient_form=1","","help:no; center:yes; status:no; dialogHeight:150px; dialogWidth:370px");

        	if (!code)
        		return;
		editor = document.getElementById('box');
		this._focus();
		this._HTML('[gradient=' + code +']'  ,'[/gradient]');
		this._focus();
        },

// create email of selection through prompt
_email : function (promptemail)
{
	if (this._viewmode == 1){
    if (promptemail== 1){
	var szemail= prompt(email_enter, '');
	if ((szemail!= null) && (szemail!= "")) {
		editor = document.getElementById('box');
		this._focus();
		this._HTML('<a href ="mailto:'+ szemail +'">'+ szemail +'</a>','');
		this._focus();
		}
		}
		  	  }else {
	var szemail= prompt(email_enter, '');
	if ((szemail!= null) && (szemail!= "")) {
		editor = document.getElementById('box');
		this._focus();
       bbfontstyle('[Email=' + szemail +']' + szemail ,'[/Email]');
		this._focus();
}
}
},

// create keyboard of selection through prompt
_cmd_keyboard : function (str)
{
		d=document.getElementById('box').contentWindow;
		d.focus();
            code = showModalDialog(""+ path +"editor/keyboard_form.htm","","help:no; center:yes; status:no; dialogHeight:520px; dialogWidth:650px");
        	if (!code)
        		return;
		editor = document.getElementById('box');
		this._focus();
		this._HTML('text1');
		this._focus();
        },

// select font size,font-family,heading
_select : function (selectname)
{
	if (this._viewmode == 1){
  var cursel = document.getElementById(selectname).selectedIndex;
  if (cursel != 0) {
    var selected = document.getElementById(selectname).options[cursel].value;
    var editor = document.getElementById('box');
	this._focus();
	Editor.queryCommandEnabled(selectname);
	Editor.execCommand(selectname, false, selected);
	this._focus();
    document.getElementById(selectname).selectedIndex = 0;
  }
  document.getElementById("box").contentWindow.focus();
  	  }else {  var cursel = document.getElementById(selectname).selectedIndex;
  var selected = document.getElementById(selectname).options[cursel].value;

		this._focus();
		this._HTML('[font=' + selected +']'  ,'[/font]');
		this._focus();
}
},

// create poem of selection through prompt
_cmd_poem : function (str)
{
if (!isIE) {
		d=document.getElementById('box').contentWindow;
		d.focus();
		var oSelText=d.getSelection();
		if (oSelText == "") {
    		    alert(should_mislead_or_select_text_first);
    		    return;
    	    }
}
             code = showModalDialog("index.php?page=misc&poem_form=1","","help:no; center:yes; status:no; dialogHeight:420px; dialogWidth:620px");
        	if (!code)
        		return;
		editor = document.getElementById('box');
		this._focus();
		this._HTML('[poem=' + code +']'  ,'[/poem]');
		this._focus();

        },
// creating table in the editor
_table : function ()
{
if (this._viewmode == 1){

		var p=cbPrompt(rows_number,"");
		var q=cbPrompt(columns_number,"");
		if(p!=null&&q!=null&&!isNaN(p)&&!isNaN(q))
			{
			var r='<table style="width: 100%; padding: 0px; border: none; border: 1px solid #789DB3;">';
			var t="";
			for(irow=0;irow<p;irow++)
				{
				t+="<tr>";
				for(icol=0;icol<q;icol++)
					{
					t+='<td style="font-size: 20px; border: none;border: 1px solid #789DB3; background-color: #F4F4F4;">&nbsp;</td>'
				}
				t+="</tr>"
			}
			r+=t+"</table><br />";
	var editor = document.getElementById('box');
	this._focus();
    this._HTML('','',r);
	this._focus();
    }
	  	  }else {
alert(must_disabled_bbcode_mode);
}
},

// open all smiles
_cmd_allsmiles : function (imagePath)
{
       code = window.open("index.php?page=smile&all=1","Legends","width=250,height=550,resizable=yes,scrollbars=yes");
	 if (!code)
		return;
		editor = document.getElementById('box');
		this._focus();
		if (!imagePath)
		return;
		comm._HTML(' ',' ',' <img src="'+ imagePath +'" />');
		this._focus();
     },


//alternative to insertHTML with all browsers to insert bbcode OR html
_HTML : function (tag,tagend,a)
	{
	if (this._viewmode == 1){
	var c;
	var u="";
	var d;
	tagend = tagend.replace("=","");
	if(isIE) {
		d=document.getElementById('box').contentWindow;
		var f=d.document.selection;
		if(f!=null)
			{
			rng=f.createRange();
			u=rng.htmlText;
		}
	} else if (window.getSelection) {
		d=document.getElementById('box').contentWindow;
		d.focus();
		var f=d.getSelection();
		if(f!=""&&f.rangeCount>0)
			{
			rng=f.getRangeAt(f.rangeCount-1).cloneContents();
			var g=d.document.createElement('div');
			g.appendChild(rng);
			u=g.innerHTML;
		}
	}
	if(a){
	var cc = tag+a+tagend;
	}else if(u){
			if(tag=="[code]"||tag=="[code=php]")
		{
				u=u.replace(/[\n\r]/ig,'');
				u=u.replace(/<(br|p|div|li).*?>/ig,"[BR/]");
				u=u.replace(/<\/(p|div).*?>/ig,"");
				u=u.replace(/(<([^>]+)>)/ig,"");
				u=u.replace(/\[BR\/\]/ig,"<br />");
				var cc = tag+u+tagend;
		}else{
				var cc = tag+u+tagend;
		}
	}else {
		if(tag=="[code]"||tag=="[code=php]"||tag=="[quote]"){
			var cc = tag+tagend;
		}else if(tag =="[video]"){
		var q=cbPrompt(lang_s[14],"");
		if(q!=""&&q!=null){
		var cc = tag+q+tagend;
		}else{
		var cc = '';
		}
		}else{
			var cc = tag+tagend;
			}
	}
	if(isIE)
		{
		d.document.execCommand("removeformat",false,"");
		d.focus();
		rng.pasteHTML(cc);
		d.focus();
	}
	else if(isWebKit)
		{
		c=document.getElementById('box').contentWindow;
		c.focus();
		u=u.replace(/</g,"[OPEN]");
		u=u.replace(/>/g,"[CLOSE]");
		c.document.execCommand('insertHTML',false,cc);
		var e=document.getElementById('box').contentWindow.document.body.innerHTML;
		u=u.replace(/\[OPEN\]/g,'<');
		u=u.replace(/\[CLOSE\]/g,'>');
		u=u.replace(/[\n\r]/ig,'');
		document.getElementById('box').contentWindow.document.body.innerHTML=e;
		c.focus();
	}
	else
		{
		c=document.getElementById('box').contentWindow;
		c.focus();
		c.document.execCommand("removeformat",false,"");
		c.document.execCommand('insertHTML',false,cc);
		c.document.execCommand("removeformat",false,"");
		c.focus();
	}
	  	  }else {
		  if(a){
bbfontstyle(tag + a,tagend);
}else{
bbfontstyle(tag ,tagend);
}
}
},
//alternative to insertALERT with all browsers to insert bbcode OR html
_ALERT: function (tag,tagend,a)
	{
	if (this._viewmode == 1){
	var c;
	var u="";
	var d;
	tagend = tagend.replace("=","");
	if(isIE) {
		d=document.getElementById('box').contentWindow;
		var f=d.document.selection;
		if(f!=null)
			{
			rng=f.createRange();
			u=rng.htmlText;
		}
	} else if (window.getSelection) {
		d=document.getElementById('box').contentWindow;
		d.focus();
		var f=d.getSelection();
		if(f!=""&&f.rangeCount>0)
			{
			rng=f.getRangeAt(f.rangeCount-1).cloneContents();
			var g=d.document.createElement('div');
			g.appendChild(rng);
			u=g.innerHTML;
		}
	}
	if(a){
	var cc = tag+a+tagend;
	}else if(u){
	if(tag=="[code]"||tag=="[code]")
	{
			u=u.replace(/[\n\r]/ig,'');
			u=u.replace(/<(br|p|div|li).*?>/ig,"[BR/]");
			u=u.replace(/<\/(p|div).*?>/ig,"");
			u=u.replace(/(<([^>]+)>)/ig,"");
			u=u.replace(/\[BR\/\]/ig,"<br />");
	}
	var cc = tag+u+tagend;
	}else {
	if(tag=="[code]"||tag=="[code]"||tag=="[quote]"){
	var cc = tag+tagend;
	}else{
		if (prompt_bbcode == 1){
				if(tag == "[Flash="){
					var flash = cbPrompt(l_flash_url, "http://");
					var width = cbPrompt(l_flash_width, "]width=400");
					var height = cbPrompt(l_flash_height, " height=200");
					 if(flash){
						var cc = tag+flash+width+height+tagend;
					}else{
						var cc = tag+tagend;
					}

				}else if(tag == '<div align="center">' || tag == '<div align="right">'  || tag == '<div align="left">' ){
				var cc ='';
				}else {
						var a = cbPrompt("alr8 :", "");
				if(a){
				var cc = tag+a+tagend;
				}else{
				var cc = tag+tagend;
			}
		}
		}else{
		var cc = tag+tagend;
		}
	}
	}
	if(isIE)
		{
		d.document.execCommand("removeformat",false,"");
		d.focus();
		rng.pasteHTML(cc);
		d.focus();
	}
	else if(isWebKit)
		{
		c=document.getElementById('box').contentWindow;
		c.focus();
		u=u.replace(/</g,"[OPEN]");
		u=u.replace(/>/g,"[CLOSE]");
		c.document.execCommand('insertHTML',false,cc);
		var e=document.getElementById('box').contentWindow.document.body.innerHTML;
		u=u.replace(/\[OPEN\]/g,'<');
		u=u.replace(/\[CLOSE\]/g,'>');
		u=u.replace(/[\n\r]/ig,'');
		document.getElementById('box').contentWindow.document.body.innerHTML=e;
		c.focus();
	}
	else
		{
		c=document.getElementById('box').contentWindow;
		c.focus();
		c.document.execCommand("removeformat",false,"");
		c.document.execCommand('insertHTML',false,cc);
		c.document.execCommand("removeformat",false,"");
		c.focus();
	}
	  	  }else {
		  if(a){
bbfontstyle(tag + a,tagend);
}else{
alert(must_disabled_bbcode_mode);
}
}
},
// insert image in the editor
_image : function ()
{
	if (this._viewmode == 1){
	var imagePath = cbPrompt(image_enter, 'http://');
	if ((imagePath != null) && (imagePath != "")) {
		editor = document.getElementById('box');
         editor.contentWindow.focus();
         editor.contentWindow.document.queryCommandEnabled("InsertImage");
         editor.contentWindow.document.execCommand("InsertImage", false, imagePath);
         editor.contentWindow.focus();
		}
		  	  }else {
bbfontstyle('[img]','[/img]');
}
},
//colour EXECCOMMAND
_colour : function (colour)
{
	if (this._viewmode == 1){
	var editor = document.getElementById('box');
	this._focus();
	Editor.queryCommandEnabled('forecolor');
	Editor.execCommand('forecolor', false, colour);
	this._focus();
	  	  }else {
bbfontstyle('[color=' + colour +']','[/color]');
}
},
//toggle BBcode HTML
_toggle : function (colour)
{
		var Editor = document.getElementById('box').contentWindow.document;
if(this._viewmode == 1)
{
	var source = document.getElementById('box_text');
	var editor = document.getElementById('box');
	editor.style.display = 'none';
	source.style.display = 'block';
	var ceditor = bbcode._HTMLtoBBcode(bbcode._erase(Editor.body.innerHTML));
	source.value = ceditor;
	this._viewmode = 2; // Code
}
else
{
	var source = document.getElementById('box_text');
	var editor = document.getElementById('box');
	editor.style.display = 'block';
	source.style.display = 'none';
	//writing iframe content and style of the editor
	var iframeContent;
	iframeContent  = '<html xmlns="http://www.w3.org/1999/xhtml" dir="' + direction + '" lang="ar-sa" xml:lang="ar-sa">\n';
	iframeContent += '<head></head><body>';
	if (source.value !== ""){
	var v = source.value;
	iframeContent +=  bbcode._BBcodetoHTML(v) ;
	}
	iframeContent += '</body></html>';
	Editor.open();
	Editor.write(iframeContent);
	Editor.close();
	this._viewmode = 1; // WYSIWYG
}
},
//submit BBcode HTML
_submit : function (colour)
{
		var Editor = document.getElementById('box').contentWindow.document;
if(this._viewmode == 1)
{
	var source = document.getElementById('box_text');
	var editor = document.getElementById('box');
	var ceditor = bbcode._HTMLtoBBcode(bbcode._erase(Editor.body.innerHTML));
	source.value = ceditor;
	this._viewmode = 2; // Code
}

},

//key BBcode HTML
_toggle_key : function (colour)
{
       var e = document.getElementById(colour);
      if(e.style.display == 'block')
         e.style.display = 'none';
      else
         e.style.display = 'block';

		var Editor = document.getElementById('box').contentWindow.document;
if(this._viewmode == 1)
{
	var source = document.getElementById('box_text');
	var editor = document.getElementById('box');
	editor.style.display = 'none';
	source.style.display = 'block';
	var ceditor = bbcode._HTMLtoBBcode(bbcode._erase(Editor.body.innerHTML));
	source.value = ceditor;
	this._viewmode = 2; // Code
}
else
{
	var source = document.getElementById('box_text');
	var editor = document.getElementById('box');
	editor.style.display = 'block';
	source.style.display = 'none';
	//writing iframe content and style of the editor
	var iframeContent;
	iframeContent  = '<html xmlns="http://www.w3.org/1999/xhtml" dir="' + direction + '" lang="ar-sa" xml:lang="ar-sa">\n';
	iframeContent += '<head></head><body>';
	if (source.value !== ""){
	var v = source.value;
	iframeContent +=  bbcode._BBcodetoHTML(v) ;
	}
	iframeContent += '</body></html>';
	Editor.open();
	Editor.write(iframeContent);
	Editor.close();
	this._viewmode = 1; // WYSIWYG
}
},
// print colour palette in a table [PBB2.1.0]
_palette : function (dir, width, height)
{
	var r = 0, g = 0, b = 0;
	var numberlist = new Array(6);
	var color = '';
	numberlist[0] = '00';
	numberlist[1] = '40';
	numberlist[2] = '80';
	numberlist[3] = 'BF';
	numberlist[4] = 'FF';
	document.writeln('<table class="border" cellspacing="0" border="0"  cellpadding="0" >');
	for (r = 0; r < 5; r++)
	{
		if (dir == 'h')
		{
			document.writeln('<tr>');
		}

		for (g = 0; g < 5; g++)
		{
			if (dir == 'v')
			{
				document.writeln('<tr>');
			}
			for (b = 0; b < cpaletc; b++)
			{
				color = String(numberlist[r]) + String(numberlist[g]) + String(numberlist[b]);
				document.write('<td bgcolor="#' + color + '" style="width: ' + width + 'px; height: ' + height + 'px;">');
				document.write('<a href="#" onClick="comm._colour(\'#' + color + '\'); return false;"><img src="' + path + 'spacer.gif" border="0" width="' + width + '" height="' + height + '" alt="#' + color + '" title="#' + color + '" /></a>');
				document.writeln('</td>');
			}
			if (dir == 'v')
			{
				document.writeln('</tr>');
			}
		}
		if (dir == 'h')
		{
			document.writeln('</tr>');
		}
	}
	document.writeln('</table>');
}
};

//-------  golbal functions -------- //

// gettext into textarea html or bbcode
// gettext into textarea html or bbcode
function Gettext(value,bb) {
		if (bb){
  	 var text = document.getElementById(value);
	 if (comm._viewmode == 2){
	 	var source = document.getElementById('box_text');
	text.value = source.value;
	 comm._viewmode = 1; // WYSIWYG
		 }else {
		 Editor = document.getElementById('box').contentWindow.document;
		 var ceditor = bbcode._HTMLtoBBcode(bbcode._erase(Editor.body.innerHTML));
		 text.value = ceditor;
		 }
		 }else{
		 var text = document.getElementById(value);
 		 Editor = document.getElementById('box').contentWindow.document;
		 var ceditor = Editor.body.innerHTML;
		 text.value = ceditor;
		 }
};

// increase and decrease size of the iframe
function textbox_resize(pix)
{
	var box			= document.getElementById('box');
	var new_height	= (parseInt(box.style.height) ? parseInt(box.style.height) : 200) + pix;
	if (new_height > 0)
	{
		box.style.height = new_height + 'px';
	}
	return false;
};
//visibility of the color pallette
function toggle_visibility(id)
{
       var e = document.getElementById(id);
       if(e.style.display == 'block')
          e.style.display = 'none';
       else
          e.style.display = 'block';
};
// adding quote in topic revision
function addquote(post_id, username){
	var message_name = 'message_' + post_id;
	divarea = document.getElementById(message_name).innerHTML;
	comm._HTML('[quote="' + username + '"]','[/quote]',divarea);
};
// add smiley through path as image
		function AddSmileyIcon(imagePath,theme){
			// removing dot from URL
				 if (comm._viewmode == 1){
			imagePath = imagePath.replace(/.\/images\/smilies/gi,"/images/smilies");
				comm._focus();
				comm._HTML(' ',' ',' <img src="'+ imagePath +'" />');
				comm._focus();
				}else{
				bbfontstyle('' + imagePath,'');
				}
};

// add through keyboard
		function Addthrough(insertPath,theme){
			// removing dot from URL
				 if (comm._viewmode == 1){
				comm._focus();
				comm._HTML('','',''+ insertPath +'');
				comm._focus();
				}else{
				bbfontstyle('' + insertPath,'');
				}
};

//Function to hover button icon
function overIcon(iconItem){
	iconItem.className='oover';
};
//Function to moving off button icon
function outIcon(iconItem){
	iconItem.className='editorbutton';
};


/**
* Caret Position object
*/
function caretPosition()
{
	var start = null;
	var end = null;
}


/**
* Get the caret position in an textarea
*/
function getCaretPosition(txtarea)
{
	var caretPos = new caretPosition();

	// simple Gecko/Opera way
	if(txtarea.selectionStart || txtarea.selectionStart == 0)
	{
		caretPos.start = txtarea.selectionStart;
		caretPos.end = txtarea.selectionEnd;
	}
	// dirty and slow IE way
	else if(document.selection)
	{

		// get current selection
		var range = document.selection.createRange();

		// a new selection of the whole textarea
		var range_all = document.body.createTextRange();
		range_all.moveToElementText(txtarea);

		// calculate selection start point by moving beginning of range_all to beginning of range
		var sel_start;
		for (sel_start = 0; range_all.compareEndPoints('StartToStart', range) < 0; sel_start++)
		{
			range_all.moveStart('character', 1);
		}

		txtarea.sel_start = sel_start;

		// we ignore the end value for IE, this is already dirty enough and we don't need it
		caretPos.start = txtarea.sel_start;
		caretPos.end = txtarea.sel_start;
	}

	return caretPos;
}

/**
* Apply bbcodes
*/
function bbfontstyle(bbopen, bbclose)
{
	theSelection = false;

	var textarea = document.getElementById('box_text');

	textarea.focus();

  if (isIE)
   {
      // Get text selection
      theSelection = document.selection.createRange().text;
      var sel = document.selection.createRange();

      if (theSelection)
      {
         // Add tags around selection
         document.selection.createRange().text = bbopen + theSelection + bbclose;
         textarea.focus();
         sel.moveStart('character', bbopen.length);
         sel.moveEnd('character', theSelection.length);
         sel.select();
         theSelection = '';
         return;
      }
   }
	else if (textarea.selectionEnd && (textarea.selectionEnd - textarea.selectionStart > 0))
	{
		mozWrap(textarea, bbopen, bbclose);
		textarea.focus();
		theSelection = '';
		return;
	}

	//The new position for the cursor after adding the bbcode
	var caret_pos = getCaretPosition(textarea).start;
	var new_pos = caret_pos + bbopen.length;

	// Open tag
	insert_text(bbopen + bbclose);

	// Center the cursor when we don't have a selection
	// Gecko and proper browsers
	if (!isNaN(textarea.selectionStart))
	{
		textarea.selectionStart = new_pos;
		textarea.selectionEnd = new_pos;
	}
	// IE
	else if (document.selection)
	{
		var range = textarea.createTextRange();
		range.move("character", new_pos);
		range.select();
		storeCaret(textarea);
	}

	textarea.focus();
	return;
};
function mozWrap(txtarea, open, close)
{
	var selLength = txtarea.textLength;
	var selStart = txtarea.selectionStart;
	var selEnd = txtarea.selectionEnd;
	var scrollTop = txtarea.scrollTop;

	if (selEnd == 1 || selEnd == 2)
	{
		selEnd = selLength;
	}

	var s1 = (txtarea.value).substring(0,selStart);
	var s2 = (txtarea.value).substring(selStart, selEnd)
	var s3 = (txtarea.value).substring(selEnd, selLength);

	txtarea.value = s1 + open + s2 + close + s3;
    txtarea.selectionStart = selStart + open.length;
    txtarea.selectionEnd = selEnd + open.length;
	txtarea.focus();
	txtarea.scrollTop = scrollTop;

	return;
};
function insert_text(text, spaces, popup)
{
	var textarea;

	if (!popup)
	{
		textarea = document.getElementById('box_text');
	}
	else
	{
		textarea = opener.document.getElementById('box_text');
	}
	if (spaces)
	{
		text = ' ' + text + ' ';
	}

	if (!isNaN(textarea.selectionStart))
	{
		var sel_start = textarea.selectionStart;
		var sel_end = textarea.selectionEnd;

		mozWrap(textarea, text, '')
		textarea.selectionStart = sel_start + text.length;
		textarea.selectionEnd = sel_end + text.length;
	}
	else if (textarea.createTextRange && textarea.caretPos)
	{
		if (baseHeight != textarea.caretPos.boundingHeight)
		{
			textarea.focus();
			storeCaret(textarea);
		}

		var caret_pos = textarea.caretPos;
		caret_pos.text = caret_pos.text.charAt(caret_pos.text.length - 1) == ' ' ? caret_pos.text + text + ' ' : caret_pos.text + text;
	}
	else
	{
		textarea.value = textarea.value + text;
	}
	if (!popup)
	{
		textarea.focus();
	}
}
wino = function(){
var box_text = document.getElementById("box_text");
var Sub = document.getElementById("sub");
if(Check.checked==true){
	txtArea.readOnly = false
	}else{
	txtArea.readOnly = true
	}
}

function storeCaret(textEl)
{
	if (textEl.createTextRange)
	{
		textEl.caretPos = document.selection.createRange().duplicate();
	}
}

//Iframe top offset
function getOffsetTop(elm){
	var mOffsetTop = elm.offsetTop;
	var mOffsetParent = elm.offsetParent;
	while(mOffsetParent){
		mOffsetTop += mOffsetParent.offsetTop;
		mOffsetParent = mOffsetParent.offsetParent;
	}
	return mOffsetTop;
};

//Iframe left offset
function getOffsetLeft(elm){
	var mOffsetLeft = elm.offsetLeft;
	var mOffsetParent = elm.offsetParent;
	while(mOffsetParent){
		mOffsetLeft += mOffsetParent.offsetLeft;
		mOffsetParent = mOffsetParent.offsetParent;
	}
	return mOffsetLeft;
};
//Run Editor Events
function editorEvents(evt){
	var keyCode = evt.keyCode ? evt.keyCode : evt.charCode;
	var keyCodeChar = String.fromCharCode(keyCode).toLowerCase();
	if(isIE){
		//run if enter key is pressed
	if (evt.type=='keypress' && keyCode==13){
		var editor = document.getElementById('box');
		var selectedRange = editor.contentWindow.document.selection.createRange();
		var parentElement = selectedRange.parentElement();
		var tagName = parentElement.tagName;
		while((/^(a|abbr|acronym|b|bdo|big|cite|code|dfn|em|font|i|kbd|label|q|s|samp|select|small|span|strike|strong|sub|sup|textarea|tt|u|var)$/i.test(tagName)) && (tagName!='HTML')){
			parentElement = parentElement.parentElement;
			tagName = parentElement.tagName;
		}
		//Insert <div> instead of <p>
		if (parentElement.tagName == 'P'||parentElement.tagName=='BODY'||parentElement.tagName=='HTML'||parentElement.tagName=='TD'||parentElement.tagName=='THEAD'||parentElement.tagName=='TFOOT'){
			selectedRange.pasteHTML('<div>');
			selectedRange.select();
			return false;
		}
	}
	hideall();
	return true;
	}else{
  	//Keyboard shortcuts
  	if (evt.type=='keypress' && evt.ctrlKey){
  		var kbShortcut;
  		switch (keyCodeChar){
			case 'b': kbShortcut = 'bold'; break;
			case 'i': kbShortcut = 'italic'; break;
			case 'u': kbShortcut = 'underline'; break;
			case 's': kbShortcut = 'strikethrough'; break;
		}
		if (kbShortcut){
			comm._focus();
			document.getElementById('box').contentWindow.document.queryCommandEnabled(kbShortcut);
			document.getElementById('box').contentWindow.document.execCommand(kbShortcut, false, null);
			comm._focus();
			evt.preventDefault();
			evt.stopPropagation();
		}
	}
	hideall();
	return true;
	}
};

