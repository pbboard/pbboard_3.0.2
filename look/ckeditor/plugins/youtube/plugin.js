if (CKEDITOR.env.ie) {
/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @file Youtube plugin.
 */

/**
* Retrieve HTML presentation of the current selected range, require editor
* to be focused first.
*/
function getSelectedHtml(editor)
{
   var selection = editor.getSelection();
   if( selection )
   {
      var bookmarks = selection.createBookmarks(),
         range = selection.getRanges()[ 0 ],
         fragment = range.clone().cloneContents();

      selection.selectBookmarks( bookmarks );

      var retval = "",
         childList = fragment.getChildren(),
         childCount = childList.count();
      for ( var i = 0; i < childCount; i++ )
      {
         var child = childList.getItem( i );
         retval += ( child.getOuterHtml?
            child.getOuterHtml() : child.getText() );
      }
      return retval;
   }
};
(function()
{
	var youtubeCmd =
	{
		canUndo : false,    // The undo snapshot will be handled by 'insertElement'.
		exec : function( editor )
		{
if (CKEDITOR.env.ie) {
     editor.insertText('[youtube]' +editor.getSelection().document.$.selection.createRange().text + '[/youtube]');
} else {
     editor.insertText('[youtube]' +editor.getSelection().getNative() + '[/youtube]');
}
		}
	};

	var pluginName = 'youtube';

	// Register a plugin named "youtube".
	CKEDITOR.plugins.add( pluginName,
	{
		init : function( editor )
		{
			editor.addCommand( pluginName, youtubeCmd );

			editor.ui.addButton( 'youtube',
				{
					label : (l_youtube),
					command : pluginName,
				icon:this.path+"youtube.gif"});
		}
	});
})();


} else {
CKEDITOR.plugins.add( 'youtube',
{
	init: function( editor )
	{
		editor.addCommand( 'youtubeCommand', new CKEDITOR.dialogCommand( 'youtubeDialog' ) );
		editor.ui.addButton( 'youtube',
			{
				label: (l_youtube),
				command: 'youtubeCommand',
				icon: this.path + 'youtube.gif'
			}
		);
		CKEDITOR.dialog.add( 'youtubeDialog', function( editor )
		{
			var url = '';
			return {
				title : 'ادراج يوتيوب',
				width : 400,
				height : 'auto',
				contents :
				[
					{
						id : 'youtube',
						label : 'youtube',
						elements :
						[

							{
								type : 'text',
								id : 'url',
								label : 'الرابط',
								validate : CKEDITOR.dialog.validate.functions(function( youtube_url ) {
									var regExp = /^.*((youtu.be\/)|(embed\/)|(feature\=))\??v?=?([^#\&\?]*).*/;
									var match = youtube_url;
									if (match){
										url = match;
										return match;
									}else{
										return false;
									}
									return true;
								}, 'رجاء ادخال رابط يو تيوب صحح'),
								required : true,
								commit : function( me )
								{
									me.url = url;
								}
							},
							{
								type : 'html',
								html : '<center>يجب ان يكون الرابط رابط صحيح من اليوتيوب</center>'
							}
						]
					}
				],
				onOk : function(me)
				{
					this.commitContent( me );
					editor.insertHtml('[youtube]' + me.url  + '[/youtube]');
				}
			};
		}
		);
	}
});
}