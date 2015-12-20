/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/**
 * @file Quote plugin.
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
	var quoteCmd =
	{
		canUndo : false,    // The undo snapshot will be handled by 'insertElement'.
		exec : function( editor )
		{
			var quote = editor.insertHtml('[quote]' + getSelectedHtml(editor) + '[/quote]'),
				range = new CKEDITOR.dom.range( editor.document );
			editor.insertElement( quote );

			// If there's nothing or a non-editable block followed by, establish a new paragraph
			// to make sure cursor is not trapped.
			range.moveToPosition( quote, CKEDITOR.POSITION_AFTER_END );
			var next = hr.getNext();
			if ( !next || next.type == CKEDITOR.NODE_ELEMENT && !next.isEditable() )
				range.fixBlock( true, editor.config.enterMode == CKEDITOR.ENTER_DIV ? 'div' : 'p'  );

			range.select();
		}
	};

	var pluginName = 'quote';

	// Register a plugin named "quote".
	CKEDITOR.plugins.add( pluginName,
	{
		init : function( editor )
		{
			editor.addCommand( pluginName, quoteCmd );

			editor.ui.addButton( 'Quote',
				{
					label : (l_quote),
					command : pluginName,
				icon:this.path+"images/quote.gif"});
		}
	});
})();
