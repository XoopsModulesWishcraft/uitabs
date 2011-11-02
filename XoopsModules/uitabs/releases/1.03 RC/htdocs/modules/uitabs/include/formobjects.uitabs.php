<?php
	
	require_once($GLOBALS['xoops']->path('class/xoopsformloader.php'));
	require_once($GLOBALS['xoops']->path('class/pagenav.php'));
	
	require_once('formselecttab.php');
	require_once('formselectplayer.php');
	require_once('formselectpackageid.php');
	
	if ($GLOBALS['xoopsModuleConfig']['tags']) {
		if (file_exists($GLOBALS['xoops']->path('modules/tag/include/formtag.php')))
			include_once($GLOBALS['xoops']->path('modules/tag/include/formtag.php'));
		else 
			$GLOBALS['xoopsModuleConfig']['tags']=false;
	}
	
?>