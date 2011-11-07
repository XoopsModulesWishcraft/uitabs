<?php
	require_once (dirname(dirname(dirname(dirname(__FILE__)))).'/include/cp_header.php');

	require_once('../include/functions.php');
	require_once('../include/formobjects.uitabs.php');
	require_once('../include/forms.uitabs.php');
	
	xoops_loadLanguage('modinfo', 'uitabs');
	
	$config_handler = xoops_gethandler('config');
	$module_handler = xoops_gethandler('module');
	
	$GLOBALS['xoopsModule'] = $module_handler->getByDirname('uitabs');
	$GLOBALS['xoopsModuleConfig'] = $config_handler->getConfigList($GLOBALS['xoopsModule']->getVar('mid'));
		
?>