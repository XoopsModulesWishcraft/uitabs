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
		case "dashboard":
	        uitabs_adminMenu(0, 'index.php?op=dashboard');
			$indexAdmin = new ModuleAdmin();	
		    $indexAdmin->addInfoBox(_AM_TABS_DASHBOARD_TAB_COUNTS);
			$tabs_handler = xoops_getmodulehandler('tabs', 'uitabs');
			$indexAdmin->addInfoBoxLine(_AM_TABS_DASHBOARD_TAB_COUNTS, "<label>"._AM_TABS_DASHBOARD_COUNTS_TABS."</label>", $tabs_handler->getCount(), ($tabs_handler->getCount()>0)?'Green':'Red');
			$indexAdmin->addInfoBoxLine(_AM_TABS_DASHBOARD_TAB_COUNTS, "<label>"._AM_TABS_DASHBOARD_COUNTS_TABS_RANDOM."</label>", $tabs_handler->getCount(new Criteria('`random`', true)), ($tabs_handler->getCount(new Criteria('`random`', true))>0)?'Green':'Red');
			$indexAdmin->addInfoBoxLine(_AM_TABS_DASHBOARD_TAB_COUNTS, "<label>"._AM_TABS_DASHBOARD_COUNTS_TABS_RECOMMEND."</label>", $tabs_handler->getCount(new Criteria('`recommend`', true)), ($tabs_handler->getCount(new Criteria('`recommend`', true))>0)?'Green':'Red');
			$indexAdmin->addInfoBox(_AM_TABS_DASHBOARD_ITEM_COUNTS);
			$items_handler = xoops_getmodulehandler('items', 'uitabs');
			$indexAdmin->addInfoBoxLine(_AM_TABS_DASHBOARD_ITEM_COUNTS, "<label>"._AM_TABS_DASHBOARD_COUNTS_ITEMS."</label>", $items_handler->getCount(), ($items_handler->getCount()>0)?'Green':'Red');
			$indexAdmin->addInfoBoxLine(_AM_TABS_DASHBOARD_ITEM_COUNTS, "<label>"._AM_TABS_DASHBOARD_COUNTS_ITEMS_WITHIMAGE."</label>", $items_handler->getCount(new Criteria('`image`', "", 'NOT LIKE')), ($items_handler->getCount(new Criteria('`image`', "", 'NOT LIKE'))>0)?'Green':'Red');
			$indexAdmin->addInfoBoxLine(_AM_TABS_DASHBOARD_ITEM_COUNTS, "<label>"._AM_TABS_DASHBOARD_COUNTS_ITEMS_WITHOUTIMAGE."</label>", $items_handler->getCount(new Criteria('`image`', "", 'LIKE')), ($items_handler->getCount(new Criteria('`image`', "", 'LIKE'))>0)?'Green':'Red');
			if ($GLOBALS['uitabsModuleConfig']['flowplayer']) {
				$indexAdmin->addInfoBoxLine(_AM_TABS_DASHBOARD_ITEM_COUNTS, "<label>"._AM_TABS_DASHBOARD_COUNTS_ITEMS_WITHFLOWPLAYER."</label>", $items_handler->getCount(new Criteria('`fid`', "0", '<>')), ($items_handler->getCount(new Criteria('`fid`', "0", '<>'))>0)?'Green':'Red');
				$indexAdmin->addInfoBoxLine(_AM_TABS_DASHBOARD_ITEM_COUNTS, "<label>"._AM_TABS_DASHBOARD_COUNTS_ITEMS_WITHOUTFLOWPLAYER."</label>", $items_handler->getCount(new Criteria('`fid`', "0", '=')), ($items_handler->getCount(new Criteria('`fid`', "0", '='))>0)?'Green':'Red');
			}
			if ($GLOBALS['uitabsModuleConfig']['matrixstream']) {
				$indexAdmin->addInfoBoxLine(_AM_TABS_DASHBOARD_ITEM_COUNTS, "<label>"._AM_TABS_DASHBOARD_COUNTS_ITEMS_WITHPACKAGE."</label>", $items_handler->getCount(new Criteria('`pid`', "0", '<>')), ($items_handler->getCount(new Criteria('`pid`', "0", '<>'))>0)?'Green':'Red');
				$indexAdmin->addInfoBoxLine(_AM_TABS_DASHBOARD_ITEM_COUNTS, "<label>"._AM_TABS_DASHBOARD_COUNTS_ITEMS_WITHOUTPACKAGE."</label>", $items_handler->getCount(new Criteria('`pid`', "0", '=')), ($items_handler->getCount(new Criteria('`pid`', "0", '='))>0)?'Green':'Red');
			}
			$indexAdmin->addInfoBox(_AM_TABS_DASHBOARD_ITEM_AVERAGES);
			$indexAdmin->addInfoBoxLine(_AM_TABS_DASHBOARD_ITEM_AVERAGES, "<label>"._AM_TABS_DASHBOARD_AVERAGE_ITEMS."</label>", number_format($items_handler->getCount()/$tabs_handler->getCount(),2), ($items_handler->getCount()/$tabs_handler->getCount()>0)?'Green':'Red');
			$indexAdmin->addInfoBoxLine(_AM_TABS_DASHBOARD_ITEM_AVERAGES, "<label>"._AM_TABS_DASHBOARD_AVERAGE_ITEMS_WITHIMAGE."</label>", number_format($items_handler->getCount(new Criteria('`image`', "", 'NOT LIKE'))/$tabs_handler->getCount(),2), ($items_handler->getCount(new Criteria('`image`', "", 'NOT LIKE'))/$tabs_handler->getCount()>0)?'Green':'Red');
			$indexAdmin->addInfoBoxLine(_AM_TABS_DASHBOARD_ITEM_AVERAGES, "<label>"._AM_TABS_DASHBOARD_AVERAGE_ITEMS_WITHOUTIMAGE."</label>", number_format($items_handler->getCount(new Criteria('`image`', "", 'LIKE'))/$tabs_handler->getCount(),2), ($items_handler->getCount(new Criteria('`image`', "", 'LIKE'))/$tabs_handler->getCount()>0)?'Green':'Red');
			if ($GLOBALS['uitabsModuleConfig']['flowplayer']) {
				$indexAdmin->addInfoBoxLine(_AM_TABS_DASHBOARD_ITEM_AVERAGES, "<label>"._AM_TABS_DASHBOARD_AVERAGE_ITEMS_WITHFLOWPLAYER."</label>", number_format($items_handler->getCount(new Criteria('`fid`', "0", '<>'))/$tabs_handler->getCount(),2), ($items_handler->getCount(new Criteria('`fid`', "0", '<>'))/$tabs_handler->getCount()>0)?'Green':'Red');
				$indexAdmin->addInfoBoxLine(_AM_TABS_DASHBOARD_ITEM_AVERAGES, "<label>"._AM_TABS_DASHBOARD_AVERAGE_ITEMS_WITHOUTFLOWPLAYER."</label>", number_format($items_handler->getCount(new Criteria('`fid`', "0", '='))/$tabs_handler->getCount(),2), ($items_handler->getCount(new Criteria('`fid`', "0", '='))/$tabs_handler->getCount()>0)?'Green':'Red');
			}
			if ($GLOBALS['uitabsModuleConfig']['matrixstream']) {
				$indexAdmin->addInfoBoxLine(_AM_TABS_DASHBOARD_ITEM_AVERAGES, "<label>"._AM_TABS_DASHBOARD_AVERAGE_ITEMS_WITHPACKAGE."</label>", number_format($items_handler->getCount(new Criteria('`pid`', "0", '<>'))/$tabs_handler->getCount(),2), ($items_handler->getCount(new Criteria('`pid`', "0", '<>'))/$tabs_handler->getCount()>0)?'Green':'Red');
				$indexAdmin->addInfoBoxLine(_AM_TABS_DASHBOARD_ITEM_AVERAGES, "<label>"._AM_TABS_DASHBOARD_AVERAGE_ITEMS_WITHOUTPACKAGE."</label>", number_format($items_handler->getCount(new Criteria('`pid`', "0", '='))/$tabs_handler->getCount(),2), ($items_handler->getCount(new Criteria('`pid`', "0", '='))/$tabs_handler->getCount()>0)?'Green':'Red');
			}
			echo $indexAdmin->renderIndex();
	        break;
		case 'about':
			uitabs_adminMenu(0, 'index.php?op=about');
			$paypalitemno='WURFL20';
			$aboutAdmin = new ModuleAdmin();
			$about = $aboutAdmin->renderabout($paypalitemno, false);
			$donationform = array(	0 => '<form name="donation" id="donation" action="http://www.chronolabs.coop/modules/xpayment/" method="post" onsubmit="return xoopsFormValidate_donation();">',
										1 => '<table class="outer" cellspacing="1" width="100%"><tbody><tr><th colspan="2">'.constant('_AM_TABS_ABOUT_MAKEDONATE').'</th></tr><tr align="left" valign="top"><td class="head"><div class="xoops-form-element-caption-required"><span class="caption-text">Donation Amount</span><span class="caption-marker">*</span></div></td><td class="even"><select size="1" name="item[A][amount]" id="item[A][amount]" title="Donation Amount"><option value="5">5.00 AUD</option><option value="10">10.00 AUD</option><option value="20">20.00 AUD</option><option value="40">40.00 AUD</option><option value="60">60.00 AUD</option><option value="80">80.00 AUD</option><option value="90">90.00 AUD</option><option value="100">100.00 AUD</option><option value="200">200.00 AUD</option></select></td></tr><tr align="left" valign="top"><td class="head"></td><td class="even"><input class="formButton" name="submit" id="submit" value="'._SUBMIT.'" title="'._SUBMIT.'" type="submit"></td></tr></tbody></table>',
										2 => '<input name="op" id="op" value="createinvoice" type="hidden"><input name="plugin" id="plugin" value="donations" type="hidden"><input name="donation" id="donation" value="1" type="hidden"><input name="drawfor" id="drawfor" value="Chronolabs Co-Operative" type="hidden"><input name="drawto" id="drawto" value="%s" type="hidden"><input name="drawto_email" id="drawto_email" value="%s" type="hidden"><input name="key" id="key" value="%s" type="hidden"><input name="currency" id="currency" value="AUD" type="hidden"><input name="weight_unit" id="weight_unit" value="kgs" type="hidden"><input name="item[A][cat]" id="item[A][cat]" value="XDN%s" type="hidden"><input name="item[A][name]" id="item[A][name]" value="Donation for %s" type="hidden"><input name="item[A][quantity]" id="item[A][quantity]" value="1" type="hidden"><input name="item[A][shipping]" id="item[A][shipping]" value="0" type="hidden"><input name="item[A][handling]" id="item[A][handling]" value="0" type="hidden"><input name="item[A][weight]" id="item[A][weight]" value="0" type="hidden"><input name="item[A][tax]" id="item[A][tax]" value="0" type="hidden"><input name="return" id="return" value="http://www.chronolabs.coop/modules/donations/success.php" type="hidden"><input name="cancel" id="cancel" value="http://www.chronolabs.coop/modules/donations/success.php" type="hidden"></form>',																'D'=>'',
										3 => '',
										4 => '<!-- Start Form Validation JavaScript //-->
		<script type="text/javascript">
		<!--//
		function xoopsFormValidate_donation() { var myform = window.document.donation; 
		var hasSelected = false; var selectBox = myform.item[A][amount];for (i = 0; i < selectBox.options.length; i++ ) { if (selectBox.options[i].selected == true && selectBox.options[i].value != \'\') { hasSelected = true; break; } }if (!hasSelected) { window.alert("Please enter Donation Amount"); selectBox.focus(); return false; }return true;
		}
		//--></script>
		<!-- End Form Validation JavaScript //-->');
			$paypalform = array(	0 => '<form action="https://www.paypal.com/cgi-bin/webscr" method="post">',
									1 => '<input name="cmd" value="_s-xclick" type="hidden">',
									2 => '<input name="hosted_button_id" value="%s" type="hidden">',
									3 => '<img alt="" src="https://www.paypal.com/fr_FR/i/scr/pixel.gif" height="1" border="0" width="1">',
									4 => '<input src="https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif" name="submit" alt="PayPal - The safer, easier way to pay online!" border="0" type="image">',
									5 => '</form>');
			for($key=0;$key<=4;$key++) {
				switch ($key) {
					case 2:
						$donationform[$key] =  sprintf($donationform[$key], $GLOBALS['xoopsConfig']['sitename'] . ' - ' . (strlen($GLOBALS['xoopsUser']->getVar('name'))>0?$GLOBALS['xoopsUser']->getVar('name'). ' ['.$GLOBALS['xoopsUser']->getVar('uname').']':$GLOBALS['xoopsUser']->getVar('uname')), $GLOBALS['xoopsUser']->getVar('email'), XOOPS_LICENSE_KEY, strtoupper($GLOBALS['uitabsModule']->getVar('dirname')),  strtoupper($GLOBALS['uitabsModule']->getVar('dirname')). ' '.$GLOBALS['uitabsModule']->getVar('name'));
						break;
				}
			}
				
			$istart = strpos($about, ($paypalform[0]), 1);
			$iend = strpos($about, ($paypalform[5]), $istart+1)+strlen($paypalform[5])-1;
			echo (substr($about, 0, $istart-1));
			echo implode("\n", $donationform);
			echo (substr($about, $iend+1, strlen($about)-$iend-1));
			break;
		case "tabs":	
			switch ($fct)
			{
				default:
				case "list":				
					uitabs_adminMenu(1, 'index.php?op=tabs&fct=list');

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
					$GLOBALS['utTpl']->assign('xoConfig', $GLOBALS['uitabsModuleConfig']);
					
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
					
					uitabs_adminMenu(2, 'index.php?op=tabs&fct=new');
					
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
					uitabs_adminMenu(3, 'index.php?op=items&fct=list');

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
					$GLOBALS['utTpl']->assign('xoConfig', $GLOBALS['uitabsModuleConfig']);
					
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
					
					uitabs_adminMenu(4, 'index.php?op=items&fct=new');
					
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
							$uploader = new UitabsMediaUploader($GLOBALS['xoops']->path($GLOBALS['uitabsModuleConfig']['upload_areas']), explode('|', $GLOBALS['uitabsModuleConfig']['allowed_mimetype']), $GLOBALS['uitabsModuleConfig']['filesize_upload'], 0, 0, explode('|', $GLOBALS['uitabsModuleConfig']['allowed_extensions']));
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
							      	
							      	$item->setVar('path', $GLOBALS['uitabsModuleConfig']['upload_areas']);
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
						if ($GLOBALS['uitabsModuleConfig']['tags']) {
				   			$tag_handler = xoops_getmodulehandler('tag', 'tag');
							$tag_handler->updateByItem($_POST[$id]['tags'], $id, $GLOBALS['uitabsModule']->getVar("dirname"), $catid=0);
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