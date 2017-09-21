/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	
	// %REMOVE_START%
	// The configuration options below are needed when running CKEditor from source files.
	//config.plugins = 'dialogui,dialog,about,a11yhelp,dialogadvtab,basicstyles,bidi,blockquote,clipboard,button,panelbutton,panel,floatpanel,colorbutton,colordialog,templates,menu,contextmenu,div,resize,toolbar,elementspath,enterkey,entities,popup,filebrowser,find,fakeobjects,flash,floatingspace,listblock,richcombo,font,forms,format,horizontalrule,htmlwriter,iframe,wysiwygarea,image,indent,smiley,justify,link,indentlist,list,liststyle,magicline,maximize,newpage,pagebreak,pastetext,pastefromword,preview,print,removeformat,save,selectall,showblocks,showborders,sourcearea,specialchar,menubutton,scayt,stylescombo,tab,table,tabletools,undo,wsc';
	
	   config.language = 'zh-TW';//語言
	  
	   config.height = 110;
	   config.width = 810;	
      // config.filebrowserImageUploadUrl = 'upload.php?type=img';
	/*config.filebrowserBrowseUrl = 'js/ckfinder/ckfinder.html';
	config.filebrowserImageBrowseUrl = 'js/ckfinder/ckfinder.html?Type=';
	config.filebrowserImageUploadUrl = 'js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=htmlEdit';//可上傳圖檔
	config.filebrowserImageUploadUrl = '../siteadmin/Upload.ashx';*/
	config.entities = false;
	   config.protectedSource.push(/<pre[\s\S]*?pre>/g);
	config.protectedSource.push(/<i[^>]*><\/i>/g);

	
	config.plugins = 'dialogui,dialog,a11yhelp,dialogadvtab,basicstyles,clipboard,button,panelbutton,panel,floatpanel,colorbutton,colordialog,templates,menu,contextmenu,div,resize,toolbar,elementspath,enterkey,entities,popup,filebrowser,find,fakeobjects,floatingspace,listblock,richcombo,font,horizontalrule,htmlwriter,wysiwygarea,image,indent,justify,link,indentlist,list,liststyle,magicline,maximize,pagebreak,pastetext,pastefromword,preview,removeformat,selectall,showblocks,showborders,sourcearea,specialchar,menubutton,scayt,tab,table,tabletools,undo,wsc';
	config.removeButtons = 'Anchor';
	config.removeButtons = 'Font';
    config.allowedContent=true;
	config.disallowedContent = 'img{width,height}';
	//config.skin = 'moono';
	//config.contentsCss = ['../../styles/style.css'];
	config.baseFloatZIndex = 10000000;
	config.enterMode = CKEDITOR.ENTER_BR;
	config.shiftEnterMode = CKEDITOR.ENTER_P;
	config.htmlEncodeOutput = false;
	//config.entities_greek = false;
	config.fontSize_sizes = '8/8px;9/9px;10/10px;11/11px;12/12px;13/13px;14/14px;15/15px;16/16px;18/18px;20/20px;22/22px;24/24px;26/26px;28/28px;32/32px;36/36px;48/48px;72/72px';
	
	// %REMOVE_END%

	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
};
CKEDITOR.on('instanceReady', function (ev) {

// Ends self closing tags the HTML4 way, like <br>.
	ev.editor.dataProcessor.htmlFilter.addRules(
		{
			elements:
			{
				$: function (element) {
					// Output dimensions of images as width and height
					if (element.name == 'img') {
						var style = element.attributes.style;

						if (style) {
							// Get the width from the style.
							var match = /(?:^|\s)width\s*:\s*(\d+)px/i.exec(style),
								width = match && match[1];

							// Get the height from the style.
							match = /(?:^|\s)height\s*:\s*(\d+)px/i.exec(style);
							var height = match && match[1];

							// Get the float from the style.
							match = /(?:^|\s)float\s*:\s*(\w+)/i.exec(style);
							var float = match && match[1];

							if (width) {
								//element.attributes.style = element.attributes.style.replace(/(?:^|\s)width\s*:\s*(\d+)px;?/i, 'width:100%');
								//element.attributes.width = width;
							}

							if (height) {
								element.attributes.style = element.attributes.style.replace(/(?:^|\s)height\s*:\s*(\d+)px;?/i, '');
								// element.attributes.height = height;
							}
							if (float) {
								element.attributes.style = element.attributes.style.replace(/(?:^|\s)float\s*:\s*(\w+)/i, '');
								//element.attributes.align = float;
							}

						}
					}



					if (!element.attributes.style)
						delete element.attributes.style;

					return element;
				}
			}
		});
});
