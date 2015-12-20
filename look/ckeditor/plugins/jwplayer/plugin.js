/*
 * @file Jwplayer plugin for CKEditor
 * Copyright (C) 2014 Tan Dung Phan
 *
 * == BEGIN LICENSE ==
 *
 * Licensed under the terms of any of the following licenses at your
 * choice:
 *
 *  - GNU General Public License Version 2 or later (the "GPL")
 *    http://www.gnu.org/licenses/gpl.html
 *
 *  - GNU Lesser General Public License Version 2.1 or later (the "LGPL")
 *    http://www.gnu.org/licenses/lgpl.html
 *
 *  - Mozilla Public License Version 1.1 or later (the "MPL")
 *    http://www.mozilla.org/MPL/MPL-1.1.html
 *
 * == END LICENSE ==
 *
 */

(function() {
	CKEDITOR.plugins.add('jwplayer', {
		lang : ['en', 'vi', 'ar'],
	    requires: ['dialog'],
	    init: function (editor) {
	        var pluginName = 'jwplayer';
	        CKEDITOR.dialog.add(pluginName, this.path + 'dialogs/jwplayer.js');
	        editor.addCommand(pluginName, new CKEDITOR.dialogCommand(pluginName));
	        editor.ui.addButton('jwplayer', {
	            label: 'jwplayer',
	            command: pluginName,
	            icon: this.path + 'images/jwplayer.png',
	        });
	    }
	});
})();