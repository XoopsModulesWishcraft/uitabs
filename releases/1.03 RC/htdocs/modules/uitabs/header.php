<?php
	require_once (dirname(dirname(dirname(__FILE__))).'/mainfile.php');

	require_once(dirname(__FILE__).DS.'include'.DS.'functions.php');
	require_once(dirname(__FILE__).DS.'include'.DS.'formobjects.uitabs.php');
	require_once(dirname(__FILE__).DS.'include'.DS.'forms.uitabs.php');
	
	xoops_loadLanguage('modinfo', basename(dirname(__FILE__)));
	
	$config_handler = xoops_gethandler('config');
	$module_handler = xoops_gethandler('module');
	
	$GLOBALS['xoopsModule'] = $module_handler->getByDirname(basename(dirname(__FILE__)));
	$GLOBALS['xoopsModuleConfig'] = $config_handler->getConfigList($GLOBALS['xoopsModule']->getVar('mid'));
	
	$op = isset($_REQUEST['op'])?$_REQUEST['op']:'tabs';
	$url = isset($_REQUEST['url'])?$_REQUEST['url']:$_SERVER['REQUEST_URI'];
	$id = isset($_REQUEST['id'])?intval($_REQUEST['id']):0;
	$passkey = isset($_REQUEST['passkey'])?$_REQUEST['passkey']:'';
	
	$tabs_handler = xoops_getmodulehandler('tabs', basename(dirname(__FILE__)));
	$items_handler = xoops_getmodulehandler('items', basename(dirname(__FILE__)));
	$votes_handler = xoops_getmodulehandler('votes', basename(dirname(__FILE__)));
	
?>