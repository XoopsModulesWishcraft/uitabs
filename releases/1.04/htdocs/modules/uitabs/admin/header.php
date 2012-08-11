<?php
	require_once (dirname(dirname(dirname(dirname(__FILE__)))).'/include/cp_header.php');
	
	if (!defined('_CHARSET'))
		define("_CHARSET","UTF-8");
	if (!defined('_CHARSET_ISO'))
		define("_CHARSET_ISO","ISO-8859-1");
	
	$GLOBALS['myts'] = MyTextSanitizer::getInstance();
	
	$module_handler = xoops_gethandler('module');
	$config_handler = xoops_gethandler('config');
	$GLOBALS['uitabsModule'] = $module_handler->getByDirname('uitabs');
	$GLOBALS['uitabsModuleConfig'] = $config_handler->getConfigList($GLOBALS['uitabsModule']->getVar('mid')); 
	
	xoops_load('pagenav');	
	xoops_load('xoopslists');
	xoops_load('xoopsformloader');
	
	include_once $GLOBALS['xoops']->path('class'.DS.'xoopsmailer.php');
	include_once $GLOBALS['xoops']->path('class'.DS.'xoopstree.php');
	
	if ( file_exists($GLOBALS['xoops']->path('/Frameworks/moduleclasses/moduleadmin/moduleadmin.php'))){
        include_once $GLOBALS['xoops']->path('/Frameworks/moduleclasses/moduleadmin/moduleadmin.php');
    }else{
        echo xoops_error("Error: You don't use the Frameworks \"admin module\". Please install this Frameworks");
    }
    $GLOBALS['uitabsModule'] = $module_handler->getByDirname('uitabs');
	$GLOBALS['uitabsImageIcon'] = XOOPS_URL .'/'. $GLOBALS['uitabsModule']->getInfo('icons16');
	$GLOBALS['uitabsModule'] = $module_handler->getByDirname('uitabs');
	$GLOBALS['uitabsImageAdmin'] = XOOPS_URL .'/'. $GLOBALS['uitabsModule']->getInfo('icons32');
	
	if ($GLOBALS['xoopsUser']) {
	    $moduleperm_handler =& xoops_gethandler('groupperm');
	    if (!$moduleperm_handler->checkRight('module_admin', $GLOBALS['uitabsModule']->getVar( 'mid' ), $GLOBALS['xoopsUser']->getGroups())) {
	        redirect_header(XOOPS_URL, 1, _NOPERM);
	        exit();
	    }
	} else {
	    redirect_header(XOOPS_URL . "/user.php", 1, _NOPERM);
	    exit();
	}
	
	if (!isset($GLOBALS['xoopsTpl']) || !is_object($GLOBALS['xoopsTpl'])) {
		include_once(XOOPS_ROOT_PATH."/class/template.php");
		$GLOBALS['xoopsTpl'] = new XoopsTpl();
	}
	
	$GLOBALS['xoopsTpl']->assign('pathImageIcon', $GLOBALS['uitabsImageIcon']);
	$GLOBALS['xoopsTpl']->assign('pathImageAdmin', $GLOBALS['uitabsImageAdmin']);
	
	include(dirname(dirname(__FILE__)).'/include/functions.php');
	include(dirname(dirname(__FILE__)).'/include/formobjects.uitabs.php');
	include(dirname(dirname(__FILE__)).'/include/forms.uitabs.php');
	
	xoops_loadLanguage('admin', 'uitabs');
	xoops_loadLanguage('forms', 'uitabs');
	xoops_loadLanguage('modinfo', 'uitabs');
			
?>