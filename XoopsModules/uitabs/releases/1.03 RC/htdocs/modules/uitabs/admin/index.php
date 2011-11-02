<?php
	
	include('header.php');
		
	xoops_loadLanguage('admin', 'uitabs');
	
	xoops_cp_header();
	
	$op = isset($_REQUEST['op'])?$_REQUEST['op']:"tabs";
	$fct = isset($_REQUEST['fct'])?$_REQUEST['fct']:"list";
	$limit = !empty($_REQUEST['limit'])?intval($_REQUEST['limit']):30;
	$start = !empty($_REQUEST['start'])?intval($_REQUEST['start']):0;
	$order = !empty($_REQUEST['order'])?$_REQUEST['order']:'DESC';
	$sort = !empty($_REQUEST['sort'])?''.$_REQUEST['sort'].'':'created';
	$filter = !empty($_REQUEST['filter'])?''.$_REQUEST['filter'].'':'1,1';
	
	switch($op) {
		default:
		case "tabs":	
			switch ($fct)
			{
				default:
				case "list":				
					uitabs_adminMenu(1);

					include_once $GLOBALS['xoops']->path( "/class/pagenav.php" );
					include_once $GLOBALS['xoops']->path( "/class/template.php" );
					
					$GLOBALS['utTpl'] = new XoopsTpl();
					
					$tab_handler =& xoops_getmodulehandler('tabs', 'uitabs');
					$criteria = $tab_handler->getFilterCriteria($filter);
					$ttl = $tab_handler->getCount($criteria);
					$sort = !empty($_REQUEST['sort'])?''.$_REQUEST['sort'].'':'created';
					
					$pagenav = new XoopsPageNav($ttl, $limit, $start, 'start', 'limit='.$limit.'&sort='.$sort.'&order='.$order.'&op='.$op.'&fct='.$fct.'&filter='.$filter.'&fct='.$fct.'&filter='.$filter);
					$GLOBALS['utTpl']->assign('pagenav', $pagenav->renderNav());
					
					foreach (array('tid','name','weight','uid','random','recommend','default','created','updated') as $id => $key) {
						$GLOBALS['utTpl']->assign(strtolower(str_replace('-','_',$key).'_th'), '<a href="'.$_SERVER['PHP_SELF'].'?start='.$start.'&limit='.$limit.'&sort='.str_replace('_','-',$key).'&order='.((str_replace('_','-',$key)==$sort)?($order=='DESC'?'ASC':'DESC'):$order).'&op='.$op.'&filter='.$filter.'">'.(defined('_AM_TABS_TH_'.strtoupper(str_replace('-','_',$key)))?constant('_AM_TABS_TH_'.strtoupper(str_replace('-','_',$key))):'_AM_TABS_TH_'.strtoupper(str_replace('-','_',$key))).'</a>');
						$GLOBALS['utTpl']->assign('filter_'.strtolower(str_replace('-','_',$key)).'_th', $tab_handler->getFilterForm($filter, $key, $sort, $op, $fct));
					}
					
					$GLOBALS['utTpl']->assign('limit', $limit);
					$GLOBALS['utTpl']->assign('start', $start);
					$GLOBALS['utTpl']->assign('order', $order);
					$GLOBALS['utTpl']->assign('sort', $sort);
					$GLOBALS['utTpl']->assign('filter', $filter);
					$GLOBALS['utTpl']->assign('xoConfig', $GLOBALS['xoopsModuleConfig']);
					
					$criteria->setStart($start);
					$criteria->setLimit($limit);
					$criteria->setSort('`'.$sort.'`');
					$criteria->setOrder($order);
					
					$tabs = $tab_handler->getObjects($criteria, true);
					foreach($tabs as $cid => $tab) {
						if (is_object($tab))
							$GLOBALS['utTpl']->append('tabs', $tab->toArray());
					}
					
					$GLOBALS['utTpl']->assign('form', uitabs_tabs_get_form(false));
					$GLOBALS['utTpl']->assign('php_self', $_SERVER['PHP_SELF']);
					$GLOBALS['utTpl']->display('db:uitabs_cpanel_tabs_list.html');
					break;		
					
				case "new":
				case "edit":
					
					uitabs_adminMenu(2);
					
					include_once $GLOBALS['xoops']->path( "/class/pagenav.php" );
					include_once $GLOBALS['xoops']->path( "/class/template.php" );
					$GLOBALS['utTpl'] = new XoopsTpl();
					
					$tab_handler =& xoops_getmodulehandler('tabs', 'uitabs');
					if (isset($_REQUEST['id'])) {
						$tab = $tab_handler->get(intval($_REQUEST['id']));
					} else {
						$tab = $tab_handler->create();
					}
					
					$GLOBALS['utTpl']->assign('form', $tab->getForm());
					$GLOBALS['utTpl']->assign('php_self', $_SERVER['PHP_SELF']);
					$GLOBALS['utTpl']->display('db:uitabs_cpanel_tabs_edit.html');
					break;
				case "save":
					
					$tab_handler =& xoops_getmodulehandler('tabs', 'uitabs');
					$id=0;
					if ($id=intval($_REQUEST['id'])) {
						$tab = $tab_handler->get($id);
					} else {
						$tab = $tab_handler->create();
					}
					$tab->setVars($_POST[$id]);
					if (!$id=$tab_handler->insert($tab)) {
						redirect_header('index.php?op='.$op.'&fct=list&limit='.$limit.'&start='.$start.'&order='.$order.'&sort='.$sort.'&filter='.$filter, 10, _AM_MSG_TABS_FAILEDTOSAVE);
						exit(0);
					} else {
						switch($_REQUEST['mode']) {
							case 'new':
								redirect_header('index.php?op='.$op.'&fct=edit&id='.$id, 10, _AM_MSG_TABS_SAVEDOKEY);
								break;
							default:
							case 'edit':
								redirect_header('index.php?op='.$op.'&fct=list&limit='.$limit.'&start='.$start.'&order='.$order.'&sort='.$sort.'&filter='.$filter, 10, _AM_MSG_TABS_SAVEDOKEY);
								break;
						}
						exit(0);					
					}
					break;
				case "savelist":
					
					$tab_handler =& xoops_getmodulehandler('tabs', 'uitabs');
					foreach($_REQUEST['id'] as $id) {
						$tab = $tab_handler->get($id);
						$tab->setVars($_POST[$id]);
						if (!$tab_handler->insert($tab)) {
							redirect_header('index.php?op='.$op.'&fct=list&limit='.$limit.'&start='.$start.'&order='.$order.'&sort='.$sort.'&filter='.$filter, 10, _AM_MSG_TABS_FAILEDTOSAVE);
							exit(0);
						} 
					}
					redirect_header('index.php?op='.$op.'&fct=list&limit='.$limit.'&start='.$start.'&order='.$order.'&sort='.$sort.'&filter='.$filter, 10, _AM_MSG_TABS_SAVEDOKEY);
					exit(0);
					break;				
				case "delete":	
								
					$tab_handler =& xoops_getmodulehandler('tabs', 'uitabs');
					$id=0;
					if (isset($_POST['id'])&&$id=intval($_POST['id'])) {
						$tab = $tab_handler->get($id);
						if (!$tab_handler->delete($tab)) {
							redirect_header('index.php?op='.$op.'&fct=list&limit='.$limit.'&start='.$start.'&order='.$order.'&sort='.$sort.'&filter='.$filter, 10, _AM_MSG_TABS_FAILEDTODELETE);
							exit(0);
						} else {
							redirect_header('index.php?op='.$op.'&fct=list&limit='.$limit.'&start='.$start.'&order='.$order.'&sort='.$sort.'&filter='.$filter, 10, _AM_MSG_TABS_DELETED);
							exit(0);
						}
					} else {
						$tab = $tab_handler->get(intval($_REQUEST['id']));
						xoops_confirm(array('id'=>$_REQUEST['id'], 'op'=>$_REQUEST['op'], 'fct'=>$_REQUEST['fct'], 'limit'=>$_REQUEST['limit'], 'start'=>$_REQUEST['start'], 'order'=>$_REQUEST['order'], 'sort'=>$_REQUEST['sort'], 'filter'=>$_REQUEST['filter']), 'index.php', sprintf(_AM_MSG_TABS_DELETE, $tab->getVar('name')));
					}
					break;
			}
			break;
		case "items":	
			switch ($fct)
			{
				default:
				case "list":				
					uitabs_adminMenu(3);

					include_once $GLOBALS['xoops']->path( "/class/pagenav.php" );
					include_once $GLOBALS['xoops']->path( "/class/template.php" );
					
					$GLOBALS['utTpl'] = new XoopsTpl();
					
					$items_handler =& xoops_getmodulehandler('items', 'uitabs');
					$criteria = $items_handler->getFilterCriteria($filter);
					$ttl = $items_handler->getCount($criteria);
					$sort = !empty($_REQUEST['sort'])?''.$_REQUEST['sort'].'':'created';
					
					$pagenav = new XoopsPageNav($ttl, $limit, $start, 'start', 'limit='.$limit.'&sort='.$sort.'&order='.$order.'&op='.$op.'&fct='.$fct.'&filter='.$filter.'&fct='.$fct.'&filter='.$filter);
					$GLOBALS['utTpl']->assign('pagenav', $pagenav->renderNav());
					
					foreach (array(	'iid','tid','title','summary','path','image','extension','weight','width','height','pid','fid','url','uid','rank','clicks','clicked','created','updated') as $id => $key) {
						$GLOBALS['utTpl']->assign(strtolower(str_replace('-','_',$key).'_th'), '<a href="'.$_SERVER['PHP_SELF'].'?start='.$start.'&limit='.$limit.'&sort='.str_replace('_','-',$key).'&order='.((str_replace('_','-',$key)==$sort)?($order=='DESC'?'ASC':'DESC'):$order).'&op='.$op.'&filter='.$filter.'">'.(defined('_AM_TABS_TH_'.strtoupper(str_replace('-','_',$key)))?constant('_AM_TABS_TH_'.strtoupper(str_replace('-','_',$key))):'_AM_TABS_TH_'.strtoupper(str_replace('-','_',$key))).'</a>');
						$GLOBALS['utTpl']->assign('filter_'.strtolower(str_replace('-','_',$key)).'_th', $items_handler->getFilterForm($filter, $key, $sort, $op, $fct));
					}
					
					$GLOBALS['utTpl']->assign('limit', $limit);
					$GLOBALS['utTpl']->assign('start', $start);
					$GLOBALS['utTpl']->assign('order', $order);
					$GLOBALS['utTpl']->assign('sort', $sort);
					$GLOBALS['utTpl']->assign('filter', $filter);
					$GLOBALS['utTpl']->assign('xoConfig', $GLOBALS['xoopsModuleConfig']);
					
					$criteria->setStart($start);
					$criteria->setLimit($limit);
					$criteria->setSort('`'.$sort.'`');
					$criteria->setOrder($order);
					
					$items = $items_handler->getObjects($criteria, true);
					foreach($items as $cid => $item) {
						if (is_object($item))
							$GLOBALS['utTpl']->append('items', $item->toArray());
					}
					
					$GLOBALS['utTpl']->assign('form', uitabs_items_get_form(false));
					$GLOBALS['utTpl']->assign('php_self', $_SERVER['PHP_SELF']);
					$GLOBALS['utTpl']->display('db:uitabs_cpanel_items_list.html');
					break;		
					
				case "new":
				case "edit":
					
					uitabs_adminMenu(4);
					
					include_once $GLOBALS['xoops']->path( "/class/pagenav.php" );
					include_once $GLOBALS['xoops']->path( "/class/template.php" );
					$GLOBALS['utTpl'] = new XoopsTpl();
					
					$items_handler =& xoops_getmodulehandler('items', 'uitabs');
					if (isset($_REQUEST['id'])) {
						$item = $items_handler->get(intval($_REQUEST['id']));
					} else {
						$item = $items_handler->create();
					}
					
					$GLOBALS['utTpl']->assign('form', $item->getForm());
					$GLOBALS['utTpl']->assign('php_self', $_SERVER['PHP_SELF']);
					$GLOBALS['utTpl']->display('db:uitabs_cpanel_items_edit.html');
					break;
				case "save":
					
					$items_handler =& xoops_getmodulehandler('items', 'uitabs');
					$id=0;
					if ($id=intval($_REQUEST['id'])) {
						$item = $items_handler->get($id);
					} else {
						$item = $items_handler->create();
					}
					$item->setVars($_POST[$id]);
					if (!$id=$items_handler->insert($item)) {
						redirect_header('index.php?op='.$op.'&fct=list&limit='.$limit.'&start='.$start.'&order='.$order.'&sort='.$sort.'&filter='.$filter, 10, _AM_MSG_ITEMS_FAILEDTOSAVE);
						exit(0);
					} else {
						if (isset($_FILES['upload'])&&!empty($_FILES['upload']['name'])) {
							include_once($GLOBALS['xoops']->path('modules/uitabs/include/uploader.php'));
							$item = $items_handler->get($id);
							$uploader = new UitabsMediaUploader($GLOBALS['xoops']->path($GLOBALS['xoopsModuleConfig']['upload_areas']), explode('|', $GLOBALS['xoopsModuleConfig']['allowed_mimetype']), $GLOBALS['xoopsModuleConfig']['filesize_upload'], 0, 0, explode('|', $GLOBALS['xoopsModuleConfig']['allowed_extensions']));
							$uploader->setPrefix(substr(md5(microtime(true), mt_rand(0,20), 13)));
							if ($uploader->fetchMedia('upload')) {
							  	if (!$uploader->upload()) {
							    	uitabs_adminMenu(4);
							    	echo $uploader->getErrors();
									uitabs_footer_adminMenu();
									xoops_cp_footer();
									exit(0);
						  	    } else {
							      	if (strlen($item->getVar('image')))
							      		unlink($GLOBALS['xoops']->path($item->getVar('path')).DS.$item->getVar('image'));
							      	
							      	$item->setVar('path', $GLOBALS['xoopsModuleConfig']['upload_areas']);
							      	$item->setVar('image', $uploader->getSavedFileName());
							      	
							      	$filename = explode('.', $uploader->getSavedFileName());
							      	$item->setVar('extension', $filename[sizeof($filename)-1]);
							      	
							      	if ($dimension = getimagesize($item->getVar('path').(substr($item->getVar('path'), strlen($item->getVar('path'))-1, 1)!=DS?DS:'').$item->getVar('filename'))) {
							      		$item->setVar('width', $dimension[0]);
							      		$item->setVar('height', $dimension[1]);
							      	} else {
							      		$item->setVar('width', 0);
							      		$item->setVar('height', 0);
							      	}
							      	@$items_handler->insert($item);
							    }      	
						  	} else {
						  		uitabs_adminMenu(4);
						       	echo $uploader->getErrors();
								uitabs_footer_adminMenu();
								xoops_cp_footer();
								exit(0);
						   	}
						}	
						if ($GLOBALS['xoopsModuleConfig']['tags']) {
				   			$tag_handler = xoops_getmodulehandler('tag', 'tag');
							$tag_handler->updateByItem($_POST[$id]['tags'], $id, $GLOBALS['xoopsModule']->getVar("dirname"), $catid=0);
				   		}
						switch($_REQUEST['mode']) {
							case 'new':
								redirect_header('index.php?op='.$op.'&fct=edit&id='.$id, 10, _AM_MSG_ITEMS_SAVEDOKEY);
								break;
							default:
							case 'edit':
								redirect_header('index.php?op='.$op.'&fct=list&limit='.$limit.'&start='.$start.'&order='.$order.'&sort='.$sort.'&filter='.$filter, 10, _AM_MSG_ITEMS_SAVEDOKEY);
								break;
						}
						exit(0);					
					}
					break;
				case "savelist":
					
					$items_handler =& xoops_getmodulehandler('items', 'uitabs');
					foreach($_REQUEST['id'] as $id) {
						$item = $items_handler->get($id);
						$item->setVars($_POST[$id]);
						if (!$items_handler->insert($item)) {
							redirect_header('index.php?op='.$op.'&fct=list&limit='.$limit.'&start='.$start.'&order='.$order.'&sort='.$sort.'&filter='.$filter, 10, _AM_MSG_ITEMS_FAILEDTOSAVE);
							exit(0);
						} 
					}
					redirect_header('index.php?op='.$op.'&fct=list&limit='.$limit.'&start='.$start.'&order='.$order.'&sort='.$sort.'&filter='.$filter, 10, _AM_MSG_ITEMS_SAVEDOKEY);
					exit(0);
					break;				
				case "delete":	
								
					$items_handler =& xoops_getmodulehandler('items', 'uitabs');
					$id=0;
					if (isset($_POST['id'])&&$id=intval($_POST['id'])) {
						$item = $items_handler->get($id);
						if (!$items_handler->delete($item)) {
							redirect_header('index.php?op='.$op.'&fct=list&limit='.$limit.'&start='.$start.'&order='.$order.'&sort='.$sort.'&filter='.$filter, 10, _AM_MSG_ITEMS_FAILEDTODELETE);
							exit(0);
						} else {
							redirect_header('index.php?op='.$op.'&fct=list&limit='.$limit.'&start='.$start.'&order='.$order.'&sort='.$sort.'&filter='.$filter, 10, _AM_MSG_ITEMS_DELETED);
							exit(0);
						}
					} else {
						$item = $items_handler->get(intval($_REQUEST['id']));
						xoops_confirm(array('id'=>$_REQUEST['id'], 'op'=>$_REQUEST['op'], 'fct'=>$_REQUEST['fct'], 'limit'=>$_REQUEST['limit'], 'start'=>$_REQUEST['start'], 'order'=>$_REQUEST['order'], 'sort'=>$_REQUEST['sort'], 'filter'=>$_REQUEST['filter']), 'index.php', sprintf(_AM_MSG_ITEMS_DELETE, $item->getVar('title')));
					}
					break;
			}
			break;
	}
	
	uitabs_footer_adminMenu();
	xoops_cp_footer();
?>