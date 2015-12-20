<script type="text/javascript">
//<![CDATA[
var l_youtube="{$lang['l_youtube']}";
var l_phpcode="{$lang['l_phpcode']}";
var l_quote="{$lang['l_quote']}";
CKEDITOR.editorConfig = function( config )
{
config.language = "{$_CONF['info_row']['content_language']}";
// config.uiColor = '#AADC6E';
config.smiley_path= '../look/images/smiles/';
config.contentsLangDirection = "{$_CONF['info_row']['content_dir']}";
config.defaultLanguage = "{$_CONF['info_row']['content_language']}";
config.extraPlugins = 'code,quote,youtube';
config.enterMode = CKEDITOR.ENTER_BR;
};
//]]>
</script>

 	<script type="text/javascript">
	//<![CDATA[

			CKEDITOR.replace('text',
				{
					toolbar :
					[
						['Source','RemoveFormat'],
						['Maximize', 'NewPage'],
						['Paste', 'Copy'],
						['Font','FontSize'],
						['TextColor','BGColor'],
						['NumberedList','BulletedList'],
						['SelectAll'],
						['Undo','Redo'],
						'/',
						['Bold', 'Italic','Underline','Strike'],
						['JustifyRight','JustifyCenter','JustifyLeft','JustifyBlock'],
						['Flash','-','Image','-', 'Smiley','-', 'Youtube'],
						['Link', 'Unlink'],
						['Table','Templates'],
						['Find','Replace'],
						'/',
						['BidiRtl','BidiLtr'],
						['Superscript','Subscript'],
						['HorizontalRule'],
						['Quote','Code'],
						['Outdent', 'Indent','keystrokeHandler']
					],
smiley_images :
[
{Des::while}{SmlList}<?php $PowerBB->_CONF['template']['while']['SmlList'][$this->x_loop]['smile_path'] = str_replace("look/images/smiles/", "", $PowerBB->_CONF['template']['while']['SmlList'][$this->x_loop]['smile_path']); ?>'{$SmlList['smile_path']}', {/Des::while}
],
smiley_descriptions :
[
{Des::while}{SmlList}<?php $PowerBB->_CONF['template']['while']['SmlList'][$this->x_loop]['smile_path'] = str_replace("look/images/smiles/", "", $PowerBB->_CONF['template']['while']['SmlList'][$this->x_loop]['smile_path']); ?><?php $PowerBB->_CONF['template']['while']['SmlList'][$this->x_loop]['smile_path'] = str_replace(".gif", "", $PowerBB->_CONF['template']['while']['SmlList'][$this->x_loop]['smile_path']); ?>'{$SmlList['smile_path']}', {/Des::while}
]
} );
//]]>
</script>
