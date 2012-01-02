<?php

	function uitabs_tabs_get_form($object, $as_array=false) {
		
		if (!is_object($object)) {
			$handler = xoops_getmodulehandler('tabs', 'uitabs');
			$object = $handler->create(); 
		}
		
		xoops_loadLanguage('forms', 'uitabs');
		$ele = array();
		
		if ($object->isNew()) {
			$sform = new XoopsThemeForm(_FRM_TABS_FORM_ISNEW_TABS, 'tabs', $_SERVER['PHP_SELF'], 'post');
			$ele['mode'] = new XoopsFormHidden('mode', 'new');
		} else {
			$sform = new XoopsThemeForm(_FRM_TABS_FORM_EDIT_TABS, 'tabs', $_SERVER['PHP_SELF'], 'post');
			$ele['mode'] = new XoopsFormHidden('mode', 'edit');
		}
		
		$id = $object->getVar('tid');
		if (empty($id)) $id = '0';
		
		$ele['op'] = new XoopsFormHidden('op', 'tabs');
		$ele['fct'] = new XoopsFormHidden('fct', 'save');
		if ($as_array==false)
			$ele['id'] = new XoopsFormHidden('id', $id);
		else 
			$ele['id'] = new XoopsFormHidden('id['.$id.']', $id);
		$ele['sort'] = new XoopsFormHidden('sort', isset($_REQUEST['sort'])?$_REQUEST['sort']:'created');
		$ele['order'] = new XoopsFormHidden('order', isset($_REQUEST['order'])?$_REQUEST['order']:'DESC');
		$ele['start'] = new XoopsFormHidden('start', isset($_REQUEST['start'])?intval($_REQUEST['start']):0);
		$ele['limit'] = new XoopsFormHidden('limit', isset($_REQUEST['limit'])?intval($_REQUEST['limit']):0);
		$ele['filter'] = new XoopsFormHidden('filter', isset($_REQUEST['filter'])?$_REQUEST['filter']:'1,1');
							
		$ele['name'] = new XoopsFormText(($as_array==false?_FRM_TABS_FORM_TAB_NAME:''), $id.'[name]', ($as_array==false?35:21),128, $object->getVar('name'));
		$ele['name']->setDescription(($as_array==false?_FRM_TABS_FORM_TAB_NAME_DESC:''));
		$ele['weight'] = new XoopsFormText(($as_array==false?_FRM_TABS_FORM_TAB_WEIGHT:''), $id.'[weight]', ($as_array==false?15:11), 15, $object->getVar('weight'));
		$ele['weight']->setDescription(($as_array==false?_FRM_TABS_FORM_TAB_WEIGHT_DESC:''));
		$ele['random'] = new XoopsFormRadioYN(($as_array==false?_FRM_TABS_FORM_TAB_RANDOM:''), $id.'[random]', $object->getVar('random'));
		$ele['random']->setDescription(($as_array==false?_FRM_TABS_FORM_TAB_RANDOM_DESC:''));
		$ele['recommend'] = new XoopsFormRadioYN(($as_array==false?_FRM_TABS_FORM_TAB_RECOMMEND:''), $id.'[recommend]', $object->getVar('recommend'));
		$ele['recommend']->setDescription(($as_array==false?_FRM_TABS_FORM_TAB_RECOMMEND_DESC:''));
		$ele['default'] = new XoopsFormRadioYN(($as_array==false?_FRM_TABS_FORM_TAB_DEFAULT:''), $id.'[default]', $object->getVar('default'));
		$ele['default']->setDescription(($as_array==false?_FRM_TABS_FORM_TAB_DEFAULT_DESC:''));
		
		if ($object->getVar('uid')>0) {
			$member_handler=xoops_gethandler('member');
			$user = $member_handler->getUser($object->getVar('uid'));
			$ele['uid'] = new XoopsFormLabel(_FRM_TABS_FORM_TAB_UID, '<a href="'.XOOPS_URL.'/userinfo.php?uid='.$object->getVar('uid').'">'.$user->getVar('uname').'</a>');
		} else {
			$ele['uid'] = new XoopsFormLabel(_FRM_TABS_FORM_TAB_UID, _MI_TABS_USER_GUEST);
		}
				
		if ($object->getVar('created')>0) {
			$ele['created'] = new XoopsFormLabel(($as_array==false?_FRM_TABS_FORM_TAB_CREATED:''), date(_DATESTRING, $object->getVar('created')));
		}
		
		if ($object->getVar('updated')>0) {
			$ele['updated'] = new XoopsFormLabel(($as_array==false?_FRM_TABS_FORM_TAB_UPDATED:''), date(_DATESTRING, $object->getVar('updated')));
		}
		
		if ($as_array==true)
			return $ele;
		
		$ele['submit'] = new XoopsFormButton('', 'submit', _SUBMIT, 'submit');
		
		$required = array('name', 'uid', 'weight');
		
		foreach($ele as $id => $obj)			
			if (in_array($id, $required))
				$sform->addElement($ele[$id], true);			
			else
				$sform->addElement($ele[$id], false);
		
		return $sform->render();
		
	}

	function uitabs_items_get_form($object, $as_array=false) {
		
		if (!is_object($object)) {
			$handler = xoops_getmodulehandler('items', 'uitabs');
			$object = $handler->create(); 
		}
		
		xoops_loadLanguage('forms', 'uitabs');
		$ele = array();
		
		if ($object->isNew()) {
			$sform = new XoopsThemeForm(_FRM_TABS_FORM_ISNEW_ITEMS, 'items', $_SERVER['PHP_SELF'], 'post');
			$ele['mode'] = new XoopsFormHidden('mode', 'new');
		} else {
			$sform = new XoopsThemeForm(_FRM_TABS_FORM_EDIT_ITEMS, 'items', $_SERVER['PHP_SELF'], 'post');
			$ele['mode'] = new XoopsFormHidden('mode', 'edit');
		}
		$sform->setExtra( "enctype='multipart/form-data'" ) ;
		
		$id = $object->getVar('iid');
		if (empty($id)) $id = '0';
		
		$ele['op'] = new XoopsFormHidden('op', 'items');
		$ele['fct'] = new XoopsFormHidden('fct', 'save');
		if ($as_array==false)
			$ele['id'] = new XoopsFormHidden('id', $id);
		else 
			$ele['id'] = new XoopsFormHidden('id['.$id.']', $id);
		$ele['sort'] = new XoopsFormHidden('sort', isset($_REQUEST['sort'])?$_REQUEST['sort']:'created');
		$ele['order'] = new XoopsFormHidden('order', isset($_REQUEST['order'])?$_REQUEST['order']:'DESC');
		$ele['start'] = new XoopsFormHidden('start', isset($_REQUEST['start'])?intval($_REQUEST['start']):0);
		$ele['limit'] = new XoopsFormHidden('limit', isset($_REQUEST['limit'])?intval($_REQUEST['limit']):0);
		$ele['filter'] = new XoopsFormHidden('filter', isset($_REQUEST['filter'])?$_REQUEST['filter']:'1,1');
							
		$ele['tid'] = new UitabsFormSelectTab(($as_array==false?_FRM_TABS_FORM_ITEM_TAB:''), $id.'[tid]', $object->getVar('tid'));
		$ele['tid']->setDescription(($as_array==false?_FRM_TABS_FORM_ITEM_TAB_DESC:''));
		$ele['title'] = new XoopsFormText(($as_array==false?_FRM_TABS_FORM_ITEM_TITLE:''), $id.'[title]', ($as_array==false?35:18), 128, $object->getVar('title'));
		$ele['title']->setDescription(($as_array==false?_FRM_TABS_FORM_ITEM_TITLE_DESC:''));
		$ele['summary'] = new XoopsFormTextArea(($as_array==false?_FRM_TABS_FORM_ITEM_SUMMARY:''), $id.'[summary]', $object->getVar('summary'), 4, 15);
		$ele['summary']->setDescription(($as_array==false?_FRM_TABS_FORM_ITEM_SUMMARY_DESC:''));
		$description_configs = array();
		$description_configs['name'] = $id.'[description]';
		$description_configs['value'] = $object->getVar('description');
		$description_configs['rows'] = 35;
		$description_configs['cols'] = 60;
		$description_configs['width'] = "100%";
		$description_configs['height'] = "400px";
		$description_configs['editor'] = $GLOBALS['xoopsModuleConfig']['editor'];
		$ele['description'] = new XoopsFormEditor(($as_array==false?_FRM_TABS_FORM_ITEM_DESCRIPTION:''), $description_configs['name'], $description_configs);
		$ele['description']->setDescription(($as_array==false?_FRM_TABS_FORM_ITEM_DESCRIPTION_DESC:''));
		$ele['upload'] = new XoopsFormFile(($as_array==false?_FRM_TABS_FORM_ITEM_UPLOAD:''), 'upload', $GLOBALS['xoopsModuleConfig']['filesize_upload']);
		$ele['upload']->setDescription(($as_array==false?_FRM_TABS_FORM_ITEM_UPLOAD_DESC:''));
		$ele['image'] = new XoopsFormLabel(($as_array==false?_FRM_TABS_FORM_ITEM_IMAGE:''), $object->getVar('image'));
		$ele['image']->setDescription(($as_array==false?_FRM_TABS_FORM_ITEM_IMAGE_DESC:''));
		$ele['path'] = new XoopsFormLabel(($as_array==false?_FRM_TABS_FORM_ITEM_PATH:''), $object->getVar('path'));
		$ele['path']->setDescription(($as_array==false?_FRM_TABS_FORM_ITEM_PATH_DESC:''));
		$ele['extension'] = new XoopsFormLabel(($as_array==false?_FRM_TABS_FORM_ITEM_EXTENSION:''), $object->getVar('extension'));
		$ele['extension']->setDescription(($as_array==false?_FRM_TABS_FORM_ITEM_EXTENSION_DESC:''));
		$ele['width'] = new XoopsFormLabel(($as_array==false?_FRM_TABS_FORM_ITEM_WIDTH:''), $object->getVar('width'));
		$ele['width']->setDescription(($as_array==false?_FRM_TABS_FORM_ITEM_WIDTH_DESC:''));
		$ele['height'] = new XoopsFormLabel(($as_array==false?_FRM_TABS_FORM_ITEM_HEIGHT:''), $object->getVar('height'));
		$ele['height']->setDescription(($as_array==false?_FRM_TABS_FORM_ITEM_HEIGHT_DESC:''));
		if ($GLOBALS['xoopsModuleConfig']['matrixstream']) {
			$ele['pid'] = new UitabsFormSelectPackageID(($as_array==false?_FRM_TABS_FORM_ITEM_PID:''), $id.'[pid]', $object->getVar('pid'), 1, false, true);
			$ele['pid']->setDescription(($as_array==false?_FRM_TABS_FORM_ITEM_PID_DESC:''));
		}
		if ($GLOBALS['xoopsModuleConfig']['flowplayer']) {
			$ele['fid'] = new UitabsFormSelectPlayer(($as_array==false?_FRM_TABS_FORM_ITEM_FID:''), $id.'[fid]', $object->getVar('fid'), 1, false, true);
			$ele['fid']->setDescription(($as_array==false?_FRM_TABS_FORM_ITEM_FID_DESC:''));
		}
		if ($GLOBALS['xoopsModuleConfig']['tags']) {
			$ele['tags'] = new XoopsFormTag("tags", 60, 255, $id, $catid = 0);
		}
		$ele['url'] = new XoopsFormText(($as_array==false?_FRM_TABS_FORM_ITEM_URL:''), $id.'[url]', ($as_array==false?30:18), 500, $object->getVar('url'));
		$ele['url']->setDescription(($as_array==false?_FRM_TABS_FORM_ITEM_URL_DESC:''));
		$ele['rate'] = new XoopsFormRadioYN(($as_array==false?_FRM_TABS_FORM_ITEM_RATE:''), $id.'[rate]', $object->getVar('rate'));
		$ele['rate']->setDescription(($as_array==false?_FRM_TABS_FORM_ITEM_RATE_DESC:''));

		if ($object->getVar('uid')>0) {
			$member_handler=xoops_gethandler('member');
			$user = $member_handler->getUser($object->getVar('uid'));
			$ele['uid'] = new XoopsFormLabel(_FRM_TABS_FORM_ITEM_UID, '<a href="'.XOOPS_URL.'/userinfo.php?uid='.$object->getVar('uid').'">'.$user->getVar('uname').'</a>');
		} else {
			$ele['uid'] = new XoopsFormLabel(_FRM_TABS_FORM_ITEM_UID, _MI_TABS_USER_GUEST);
		}
		
		if ($object->getVar('created')>0) {
			$ele['created'] = new XoopsFormLabel(($as_array==false?_FRM_TABS_FORM_ITEM_CREATED:''), date(_DATESTRING, $object->getVar('created')));
		}
		
		if ($object->getVar('updated')>0) {
			$ele['updated'] = new XoopsFormLabel(($as_array==false?_FRM_TABS_FORM_ITEM_UPDATED:''), date(_DATESTRING, $object->getVar('updated')));
		}
		
		if ($object->getVar('clicked')>0) {
			$ele['clicked'] = new XoopsFormLabel(($as_array==false?_FRM_TABS_FORM_ITEM_CLICKED:''), date(_DATESTRING, $object->getVar('clicked')));
		}
		
		if ($as_array==true)
			return $ele;
		
		$ele['submit'] = new XoopsFormButton('', 'submit', _SUBMIT, 'submit');
		
		$required = array('tid', 'title', 'summary');
		
		foreach($ele as $id => $obj)			
			if (in_array($id, $required))
				$sform->addElement($ele[$id], true);			
			else
				$sform->addElement($ele[$id], false);
		
		return $sform->render();
		
	}
	
?>