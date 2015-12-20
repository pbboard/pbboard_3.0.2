CKEDITOR.plugins.add( 'media',
{
	init: function( editor )
	{
		editor.addCommand( 'mediaCommand', new CKEDITOR.dialogCommand( 'mediaDialog' ) );
		editor.ui.addButton( 'media',
			{
				label: 'إدراج ملف مديا بلاير',
				command: 'mediaCommand',
				icon: this.path + 'media.gif'
			}
		);
		// dialog
		CKEDITOR.dialog.add( 'mediaDialog', function( editor )
		{
			return {
				title : 'إدراج ملف مديا بلاير',
				width : 400,
				height : 'auto',
				contents :
				[
					{
						id : 'media',
						label : 'media',
						elements :
						[
							{
								type : 'html',
								html : '<center>من فضلك أدخل رابط ملف المديا بلاير</center>'
							},
							{
								type : 'text',
								id : 'url',
								label : 'الرابط',
				     				validate: CKEDITOR.dialog.validate.regex(/(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/, 'برجاء ادخال رابط صحيح'),
								required : true,
								commit : function( me )
								{
									me.url = this.getValue();
								}
							}
						]
					}
				],
				onOk : function()
				{
					me = {},
					this.commitContent( me );
					editor.insertHtml('[media]' + me.url + '[/media]');
				}
			};
		});
	}
});