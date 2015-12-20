CKEDITOR.plugins.add( 'rplayer',
{
	init: function( editor )
	{
		editor.addCommand( 'rplayerCommand', new CKEDITOR.dialogCommand( 'rplayerDialog' ) );
		editor.ui.addButton( 'rplayer',
			{
				label: 'إدراج ملف ريل بلاير',
				command: 'rplayerCommand',
				icon: this.path + 'rplayer.gif'
			}
		);
		// dialog
		CKEDITOR.dialog.add( 'rplayerDialog', function( editor )
		{
			return {
				title : 'إدراج ملف ريل بلاير',
				width : 400,
				height : 'auto',
				contents :
				[
					{
						id : 'rplayer',
						label : 'rplayer',
						elements :
						[
							{
								type : 'html',
								html : '<center>لاداج ملف ريال بلاير و الخيارت المتاح اما ملف صوتى فقط او ملف صوت و صورة</center>'
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
							},
							{
								type : 'select',
								id : 'fileType',
								label : 'نوع الملف',
								default : 'ram',
								items :
								[
									[ ' ملف صوتى ', 'ram' ],
									[ ' ملف فديو ', 'media' ]
								],
								required : true,
								commit : function( me )
								{
									me.fileType = this.getValue();
								}
							}
						]
					}
				],
				onOk : function()
				{
					me = {},
					this.commitContent( me );
					editor.insertHtml('[' + me.fileType + ']' + me.url + '[/' + me.fileType + ']');
				}
			};
		});
	}
});