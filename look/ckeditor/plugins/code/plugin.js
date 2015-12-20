/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @file Code plugin.
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
	var codeCmd =
	{
		canUndo : false,    // The undo snapshot will be handled by 'insertElement'.
		exec : function( editor )
		{
if (CKEDITOR.env.ie) {
     editor.insertText('[code]' +editor.getSelection().document.$.selection.createRange().text + '[/code]');
} else {
     editor.insertText('[code]' +editor.getSelection().getNative() + '[/code]');
}
		}
	};

	var pluginName = 'code';

	// Register a plugin named "code".
	CKEDITOR.plugins.add( pluginName,
	{
		init : function( editor )
		{
			editor.addCommand( pluginName, codeCmd );

			editor.ui.addButton( 'Code',
				{
					label : (l_phpcode),
					command : pluginName,
				icon:this.path+"images/code.gif"});
		}
	});
})();
