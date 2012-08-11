<?php

	// Forms
	define('_MI_TABS_NONE','None');
	define('_MI_TABS_SUBSCRIBE_TO_PACKAGE','Subscribe to Video');
	define('_MI_TABS_MORE','&nbsp;(Click Here for More)');
	define('_MI_TABS_USER_GUEST','Guest');
	define('_MI_TABS_DIRNAME','uitabs');
	
	//Messages
	define('_MI_TABS_VOTEALREADYDONE','You have already voted for this item!');
	define('_MI_TABS_VOTETAKEN','Many thanks for the vote!');
	
	// XOOPS Version Constants
	define('_MI_TABS_NAME','UI Tabs');
	define('_MI_TABS_DESC','UI Tabs was written for Fibredyne Pty Ltd.');

	// Javascripts and style sheets
	define('_MI_TABS_JQUERY','/browse.php?Frameworks/jquery/jquery.js');
	define('_MI_TABS_TOOLS','/modules/'._MI_TABS_DIRNAME.'/js/jquery.tools.min.js');
	define('_MI_TABS_STYLE','/modules/'._MI_TABS_DIRNAME.'/language/'.$GLOBALS['xoopsConfig']['language'].'/uitabs.css');
	
	//Preferences
	define('_MI_TABS_ITEMS','Items in a Tab');
	define('_MI_TABS_ITEMS_DESC','This is the number of items in a tab when displayed');
	define('_MI_TABS_FILESIZEUPLD','File Size Upload');
	define('_MI_TABS_FILESIZEUPLD_DESC','File size allowed to be uploaded of images');
	define('_MI_TABS_ALLOWEDMIMETYPE','Allowed Mimetypes');
	define('_MI_TABS_ALLOWEDMIMETYPE_DESC','Allowed mimetypes for file upload of images');
	define('_MI_TABS_ALLOWEDEXTENSIONS','Allowed Extensions');
	define('_MI_TABS_ALLOWEDEXTENSIONS_DESC','Allowed extensions for uploading images');
	define('_MI_TABS_UPLOADAREAS','Upload Area');
	define('_MI_TABS_UPLOADAREAS_DESC','Area to be uploaded to');
	define('_MI_TABS_UPLOADAREAS_UPLOADS','/uploads');
	define('_MI_TABS_UPLOADAREAS_UPLOADS_UITABS','/uploads/uitabs');
	define('_MI_TABS_FULLSIZE','Full-size Image Size');
	define('_MI_TABS_FULLSIZE_DESC','Size of images Full Size in Profile');
	define('_MI_TABS_FULLSIZE_RULE','Full-size Rule');
	define('_MI_TABS_FULLSIZE_RULE_DESC','Rule of full size sizing');
	define('_MI_TABS_FULLSIZE_RULE_W','Based on Width');
	define('_MI_TABS_FULLSIZE_RULE_H','Based on Height');
	define('_MI_TABS_FULLSIZE_RULE_B','Based on Box');
	define('_MI_TABS_THUMBSIZE','Thumbnail Size');
	define('_MI_TABS_THUMBSIZE_DESC','Size of thumbnails in tab');
	define('_MI_TABS_THUMBNAIL_RULE','Thumbnail Rule');
	define('_MI_TABS_THUMBNAIL_RULE_DESC','Rule of thumbnail sizing');
	define('_MI_TABS_THUMBNAIL_RULE_W','Based on Width');
	define('_MI_TABS_THUMBNAIL_RULE_H','Based on Height');
	define('_MI_TABS_THUMBNAIL_RULE_B','Based on Box');
	define('_MI_TABS_WIDEIMAGE','Allow wideimage use?');
	define('_MI_TABS_WIDEIMAGE_DESC','Allow wideimage framework to be used (If images aren\'t displaying turn this off');
	define('_MI_TABS_WATERMARK','Do Watermarking?');
	define('_MI_TABS_WATERMARK_DESC','Do watermarking with wideimage framework?');
	define('_MI_TABS_WATERMARK_TRANSPARENCY','Watermark Transparency');
	define('_MI_TABS_WATERMARK_TRANSPARENCY_DESC','This is the amount of opacity a watermark has (0=none, 100=solid)');
	define('_MI_TABS_WATERMARK_IMAGE','Path for watermark');
	define('_MI_TABS_WATERMARK_IMAGE_DESC','This is the path for the watermark image');
	define('_MI_TABS_WATERMARK_POSITION','Watermark Position');
	define('_MI_TABS_WATERMARK_POSITION_DESC','Position of the watermark on the image');
	define('_MI_TABS_WATERMARK_POSITION_TL','Top Left');
	define('_MI_TABS_WATERMARK_POSITION_TR','Top Right');
	define('_MI_TABS_WATERMARK_POSITION_BL','Bottom Left');
	define('_MI_TABS_WATERMARK_POSITION_BR','Bottom Right');
	define('_MI_TABS_WATERMARK_POSITION_MD','Middle');
	define('_MI_TABS_PASSKEY_VALIDFOR','Passkey Valid for');
	define('_MI_TABS_PASSKEY_VALIDFOR_DESC','This is the amount of time a passkey is valid for');
	define('_MI_TABS_PASSKEY_VALIDFOR_2MIN','2 Minutes');
	define('_MI_TABS_PASSKEY_VALIDFOR_4MIN','4 Minutes');
	define('_MI_TABS_PASSKEY_VALIDFOR_6MIN','6 Minutes');
	define('_MI_TABS_PASSKEY_VALIDFOR_8MIN','8 Minutes');
	define('_MI_TABS_PASSKEY_VALIDFOR_10MIN','10 Minutes');
	define('_MI_TABS_PASSKEY_VALIDFOR_15MIN','15 Minutes');
	define('_MI_TABS_PASSKEY_VALIDFOR_20MIN','20 Minutes');
	define('_MI_TABS_PASSKEY_VALIDFOR_30MIN','30 Minutes');
	define('_MI_TABS_PASSKEY_VALIDFOR_60MIN','1 Hour');
	define('_MI_TABS_PASSKEY_VALIDFOR_120MIN','2 Hours');
	define('_MI_TABS_PASSKEY_VALIDFOR_240MIN','4 Hours');
	define('_MI_TABS_PASSKEY_VALIDFOR_360MIN','6 Hours');
	define('_MI_TABS_PASSKEY_VALIDFOR_480MIN','8 Hours');
	define('_MI_TABS_PASSKEY_VALIDFOR_600MIN','10 Hours');
	define('_MI_TABS_EDITOR','Text Editor to Use');
	define('_MI_TABS_EDITOR_DESC','This is the type of editor to use');
	define('_MI_TABS_EFFECT','The effect to be used when a tab is clicked.');
	define('_MI_TABS_EFFECT_DESC','This can dramatically change the behaviour of the tabs.');
	define('_MI_TABS_EFFECT_DEFAULT','simple show/hide effec');
	define('_MI_TABS_EFFECT_FADE','the tab contents are gradually shown from zero to full opacity');
	define('_MI_TABS_EFFECT_AJAX','loads tab contents from the server using AJAX');
	define('_MI_TABS_EFFECT_SLIDE','a vertical sliding effect');
	define('_MI_TABS_EFFECT_HORIZONTAL','a horizontal sliding effect');
	define('_MI_TABS_EVENT','Specifies the event when a tab is opened');
	define('_MI_TABS_EVENT_DESC','By default, this happens when the user clicks on the tab');
	define('_MI_TABS_EVENT_CLICK','single user clicks on the tab');
	define('_MI_TABS_EVENT_MOUSEOVER','user mouse overs on the tab');
	define('_MI_TABS_EVENT_DBLCLICK','double user clicks on the tab');
	define('_MI_TABS_FADE_INSPEED','How fast (in milliseconds) the opened pane reveals its content.');
	define('_MI_TABS_FADE_INSPEED_DESC','Only available when used together with the "fade" effect.');
	define('_MI_TABS_FADE_OUTSPEED','How fast (in milliseconds) the opened pane hides its content.');
	define('_MI_TABS_FADE_OUTSPEED_DESC','Only available when used together with the "fade" effect.');
	define('_MI_TABS_HISTORY','Enables support for browser\'s "back button"');
	define('_MI_TABS_HISTORY_DESC','So that when a user clicks on the back or forward buttons the tabs are opened accordingly');
	define('_MI_TABS_HISTORY_TRUE', _YES);
	define('_MI_TABS_HISTORY_FALSE', _NO);
	define('_MI_TABS_ROTATE','Rotate Tabs');
	define('_MI_TABS_ROTATE_DESC','The tabs will start from the beginning and when the first tab is open and the tabs will advance to the last tab.');
	define('_MI_TABS_ROTATE_TRUE', _YES);
	define('_MI_TABS_ROTATE_FALSE', _NO);
	define('_MI_TABS_DEFAULT_CLASS','Current Tab Class');
	define('_MI_TABS_DEFAULT_CLASS_DESC','This is the class used for the default tab.');
	define('_MI_TABS_UL_CLASS','UL Tabs Class');
	define('_MI_TABS_UL_CLASS_DESC','This is the class used for the Tabs List');
	define('_MI_TABS_DIV_CLASS','DIV Tabs Clas');
	define('_MI_TABS_DIV_CLASS_DESC','This is the class used for the panes of the Tabs');
	define('_MI_TABS_HTACCESS','Support htaccess SEO');
	define('_MI_TABS_HTACCESS_DESC','Whether .htaccess SEO is turned on (see /docs)');
	define('_MI_TABS_HTACCESS_BASEOFURL','SEO Base of URL');
	define('_MI_TABS_HTACCESS_BASEOFURL_DESC','Base of SEO URL (modify /docs)');
	define('_MI_TABS_HTACCESS_ENDOFURL','End of URL');
	define('_MI_TABS_HTACCESS_ENDOFURL_DESC','End of SEO URL (modify /docs)');
	define('_MI_TABS_MATRIXSTREAM','Support Matrixstream Module');
	define('_MI_TABS_MATRIXSTREAM_DESC','Whether Matrixstream 1.06 or later is supported!');
	define('_MI_TABS_FLOWPLAYER','Support Flowplayer Module');
	define('_MI_TABS_FLOWPLAYER_DESC','Whether Flowplayer 1.04 or later is supported');
	define('_MI_TABS_TAGS','Support Tags Module');
	define('_MI_TABS_TAGS_DESC','Whether Tags 2.3 or later is supported');
	define('_MI_TABS_FORCE_JQUERY','Force JQuery?');
	define('_MI_TABS_FORCE_JQUERY_DESC','This option will force JQuery if your theme doesn\'t have it hardcoded.');
	
	//Framework Includes
	define('_MI_TABS_FRAMEWORK_WIDEIMAGE','/Frameworks/wideimage/WideImage.php');
	define('_MI_TABS_FRAMEWORK_TCPF','/Frameworks/tcpdf/tcpdf.php');
	
	// Voting Constants
	define('_MI_TABS_RATING_05STAR','Half Star');
	define('_MI_TABS_RATING_1STAR','1 Star');
	define('_MI_TABS_RATING_15STARS','1.5 Stars');
	define('_MI_TABS_RATING_2STARS','2 Stars');
	define('_MI_TABS_RATING_25STARS','2.5 Stars');
	define('_MI_TABS_RATING_3STARS','3 Stars');
	define('_MI_TABS_RATING_35STARS','3.5 Stars');
	define('_MI_TABS_RATING_4STARS','4 Stars');
	define('_MI_TABS_RATING_45STARS','4.5 Stars');
	define('_MI_TABS_RATING_5STARS','5 Stars');
	define('_MI_TABS_RATING_55STARS','5.5 Stars');
	define('_MI_TABS_RATING_6STARS','6 Stars');
	define('_MI_TABS_RATING_65STARS','6.5 Stars');
	define('_MI_TABS_RATING_7STARS','7 Stars');
	define('_MI_TABS_RATING_75STARS','7.5 Stars');
	define('_MI_TABS_RATING_8STARS','8 Stars');
	define('_MI_TABS_RATING_855STARS','8.5 Stars');
	define('_MI_TABS_RATING_9STARS','9 Stars');
	define('_MI_TABS_RATING_95STARS','9.5 Stars');
	define('_MI_TABS_RATING_10STARS','10 Stars');
	define('_MI_TABS_RATING_VOTE','Vote');

	//Version 1.04
	//Admin Menu
	$module_handler =& xoops_gethandler('module');
	$GLOBALS['uitabsModule'] =& XoopsModule::getByDirname('uitabs');
	if (is_object($GLOBALS['uitabsModule'])) {
		
		// Admin menu
		define('_MI_TABS_TITLE_ADMENU0','Dashboard');
		define('_MI_TABS_ICON_ADMENU0','../../'.$GLOBALS['uitabsModule']->getInfo('icons32').'/home.png');
		define('_MI_TABS_LINK_ADMENU0','admin/index.php?op=dashboard');
		define('_MI_TABS_TITLE_ADMENU1','Tabs List');
		define('_MI_TABS_ICON_ADMENU1','../../'.$GLOBALS['uitabsModule']->getInfo('icons32').'/uitabs.tabs.list.png');
		define('_MI_TABS_LINK_ADMENU1','admin/index.php?op=tabs&fct=list');
		define('_MI_TABS_TITLE_ADMENU2','New Tab');
		define('_MI_TABS_ICON_ADMENU2','../../'.$GLOBALS['uitabsModule']->getInfo('icons32').'/uitabs.tabs.new.png');
		define('_MI_TABS_LINK_ADMENU2','admin/index.php?op=tabs&fct=new');
		define('_MI_TABS_TITLE_ADMENU3','Tab Items List');
		define('_MI_TABS_ICON_ADMENU3','../../'.$GLOBALS['uitabsModule']->getInfo('icons32').'/uitabs.items.list.png');
		define('_MI_TABS_LINK_ADMENU3','admin/index.php?op=items&fct=list');
		define('_MI_TABS_TITLE_ADMENU4','New Tab Item');
		define('_MI_TABS_ICON_ADMENU4','../../'.$GLOBALS['uitabsModule']->getInfo('icons32').'/uitabs.items.new.png');
		define('_MI_TABS_LINK_ADMENU4','admin/index.php?op=items&fct=new');
		define('_MI_TABS_TITLE_ADMENU5','About');
		define('_MI_TABS_ICON_ADMENU5','../../'.$GLOBALS['uitabsModule']->getInfo('icons32').'/about.png');
		define('_MI_TABS_LINK_ADMENU5','admin/index.php?op=about');
		
	}
	
?>