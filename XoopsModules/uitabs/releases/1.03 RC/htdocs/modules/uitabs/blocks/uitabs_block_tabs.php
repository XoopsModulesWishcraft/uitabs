<?php


function b_uitabs_blocks_tabs_show( $options )
{
	include_once($GLOBALS['xoops']->path('/modules/uitabs/include/functions.php'));
	error_reporting(E_ALL);
	xoops_loadLanguage('blocks', 'uitabs');
	xoops_loadLanguage('modinfo', 'uitabs');
		
	$tabs_handler = xoops_getmodulehandler('tabs', 'uitabs');
	$items_handler = xoops_getmodulehandler('items', 'uitabs');
	
	$criteria = new Criteria('weight', '0', '!=');
	$criteria->setSort('`weight`');
	$criteria->setOrder('ASC');
	if ($tabs_handler->getCount($criteria)==0)
		return false;
	
	$config_handler = xoops_gethandler('config');
	$module_handler = xoops_gethandler('module');
	$_Mod = $module_handler->getByDirname('uitabs');
	$_ModConfig = $config_handler->getConfigList($_Mod->getVar('mid'));
	
	$block = array();
	$block['xoConfig'] = $_ModConfig;
	$index = 0;
	$tabs = $tabs_handler->getObjects($criteria, true);
	foreach($tabs as $tid => $tab) {
		$block['tabs'][$index] = $tab->toArray();
		if ($tab->getVar('default')==true)
			$initialIndex = $index;
		$criteria = new Criteria('tid', $tid);
		$criteria->setStart(0);
		$criteria->setLimit($options[0]);
		if ($tab->getVar('recommend')==true&&$tab->getVar('random')==true) {
			$criteria->setSort('`clicks`/`rating`/`votes` DESC, RAND()');
		} elseif ($tab->getVar('recommend')==true) {
			$criteria->setSort('`clicks`/`rating`/`votes` DESC, `weight`');
		} elseif ($tab->getVar('random')==true) {
			$criteria->setSort('RAND()');
		} else {
			$criteria->setSort('`weight` ASC, `clicks` DESC, `rating`/`votes`/`clicks`');
		}
		$criteria->setOrder('DESC');
		foreach($items_handler->getObjects($criteria, true) as $iid => $item) {
			$block['tabs'][$index]['items'][$iid] = $item->toArray();
			$block['tabs'][$index]['items'][$iid]['html'] = $item->toHTML(true, true, $option[1], $option[2]);
		}
		$index++;
	}	
	$block['initialIndex'] = $initialIndex;
	if ($_ModConfig['force_jquery']&&!isset($GLOBALS['jquery'])) {
		$GLOBALS['xoTheme']->addScript(XOOPS_URL._MI_TABS_JQUERY, array('type'=>'text/javascript'));
		$GLOBALS['jquery']=true;
	}
	if (!isset($GLOBALS['jquery_tools'])) {
		$GLOBALS['xoTheme']->addScript(XOOPS_URL._MI_TABS_TOOLS, array('type'=>'text/javascript'));
		$GLOBALS['xoTheme']->addStylesheet(XOOPS_URL._MI_TABS_STYLE, array('type'=>'text/css'));
		$GLOBALS['jquery_tools']=true;
	}
	return $block;

}


function b_uitabs_blocks_tabs_edit( $options )
{
	include_once($GLOBALS['xoops']->path('/modules/uitabs/include/formobjects.uitabs.php'));
	xoops_loadLanguage('blocks', 'uitabs');
	
	$items = new XoopsFormText(_BL_UITABS_TABS_ITEMS, 'options[0]', 15, 10, $options[0]);
	$width = new XoopsFormText(_BL_UITABS_FLOWPLAYER_BLOCK_WIDTH, 'options[1]', 15, 10, $options[1]);
	$height = new XoopsFormText(_BL_UITABS_FLOWPLAYER_BLOCK_HEIGHT, 'options[2]', 15, 10, $options[2]);
		
	$form = $items->render()."<br/>".$width->render()."<br/>".$height->render();
	return $form ;
}
?>