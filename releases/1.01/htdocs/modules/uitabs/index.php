<?php

	include ('header.php');

	if ($GLOBALS['xoopsModuleConfig']['htaccess']&&!in_array($op, array('count', 'vote'))) {
		if ($op=='full'&&$id>0) {
			$item = $items_handler->get($id);
			$url = XOOPS_URL.'/'.$GLOBALS['xoopsModuleConfig']['baseofurl'].'/'.xoops_sef($item->getVar('title')).'/'.$op.','.$id.$GLOBALS['xoopsModuleConfig']['endofurl'];
		} else {
			$url = XOOPS_URL.'/'.$GLOBALS['xoopsModuleConfig']['baseofurl'].'/'.$op.$GLOBALS['xoopsModuleConfig']['endofurl'];
		}
		if (!strpos($url, $_SERVER['REQUEST_URI'])) {
			header( "HTTP/1.1 301 Moved Permanently" ); 
			header('Location: '.$url);
			exit(0);
		}
	}
	
	switch ($op) {
		default:
		case "tabs":
			$xoopsOption['template_main'] = 'uitabs_index.html';
			include($GLOBALS['xoops']->path('header.php'));
			if ($GLOBALS['xoopsModuleConfig']['force_jquery']&&!isset($GLOBALS['jquery'])) {
				$GLOBALS['xoTheme']->addScript(XOOPS_URL._MI_TABS_JQUERY, array('type'=>'text/javascript'));
				$GLOBALS['jquery']=true;
			}
			if (!isset($GLOBALS['jquery_tools'])) {
				$GLOBALS['xoTheme']->addScript(XOOPS_URL._MI_TABS_TOOLS, array('type'=>'text/javascript'));
				$GLOBALS['xoTheme']->addStylesheet(XOOPS_URL._MI_TABS_STYLE, array('type'=>'text/css'));
				$GLOBALS['jquery_tools']=true;
			}
			$criteria = new Criteria('weight', '0', '!=');
			$criteria->setSort('`weight`');
			$criteria->setOrder('ASC');
			if ($tabs_handler->getCount($criteria)>0) {
				$GLOBALS['xoopsTpl']->assign('xoConfig', $GLOBALS['xoopsModuleConfig']);
				$index = 0;
				$tabs = array();
				$tabsobjs = $tabs_handler->getObjects($criteria, true);
				foreach($tabsobjs as $tid => $tab) {
					$tabs[$index] = $tab->toArray();
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
						$tabs[$index]['items'][$iid] = $item->toArray();
						$tabs[$index]['items'][$iid]['html'] = $item->toHTML(true, true, $option[1], $option[2]);
					}
					$index++;
				}	
				$GLOBALS['xoopsTpl']->assign('tabs', $tabs);
				$GLOBALS['xoTheme']->addScript('', array('type'=>'text/javascript'), '$("ul.blocks_'.$GLOBALS['xoopsModuleConfig']['ul_class'].'").tabs("div.blocks_'.$GLOBALS['xoopsModuleConfig']['div_class'].' > div", {
	current: \''.$GLOBALS['xoopsModuleConfig']['default_class'].'\',
	effect: \''.$GLOBALS['xoopsModuleConfig']['effect'].'\',
	event: \''.$GLOBALS['xoopsModuleConfig']['event'].'\',
	fadeInSpeed: '.$GLOBALS['xoopsModuleConfig']['fadeInSpeed'].',
	fadeOutSpeed: '.$GLOBALS['xoopsModuleConfig']['fadeOutSpeed'].',
	history: '.$GLOBALS['xoopsModuleConfig']['history'].',
	initialIndex: '.$initialIndex.',
	rotate: '.$GLOBALS['xoopsModuleConfig']['rotate'].',							
});');
			}
			include($GLOBALS['xoops']->path('footer.php'));
			break;
		case "full":
			$item = $items_handler->get($id);
			$xoopsOption['template_main'] = 'uitabs_profile.html';
			include($GLOBALS['xoops']->path('header.php'));
			$GLOBALS['xoopsTpl']->assign('html', $item->toHTML(false, false, 0 ,0));
			include($GLOBALS['xoops']->path('footer.php'));
			exit;
			break;			
		case "count":
			$items_handler->setClicked($id);
			redirect(($url!=$_SERVER['REQUEST_URI'])?$url:XOOPS_URL, 10);
			exit;
			break;
		case "vote":
			$votes_handler->setVote($id, 0, 0, $_REQUEST['rating'], ($url!=$_SERVER['REQUEST_URI'])?$url:XOOPS_URL);
			redirect(($url!=$_SERVER['REQUEST_URI'])?$url:XOOPS_URL, 10);
			exit;
			break;
		}
	
?>