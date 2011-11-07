<?php

if (!defined('XOOPS_ROOT_PATH')) {
	exit();
}
/**
 * Class for Blue Room Xcenter
 * @author Simon Roberts <simon@xoops.org>
 * @copyright copyright (c) 2009-2003 XOOPS.org
 * @package kernel
 */
class UitabsTabs extends XoopsObject
{

	var $_ModConfig = NULL;
	var $_Mod = NULL;
	
    function UitabsTabs($id = null)
    {
    	$config_handler = xoops_gethandler('config');
		$module_handler = xoops_gethandler('module');
		$this->_Mod = $module_handler->getByDirname('uitabs');
		$this->_ModConfig = $config_handler->getConfigList($this->_Mod->getVar('mid'));
		
        $this->initVar('tid', XOBJ_DTYPE_INT, null, false);
		$this->initVar('name', XOBJ_DTYPE_TXTBOX, null, false, 128);		
		$this->initVar('weight', XOBJ_DTYPE_INT, null, false);
        $this->initVar('uid', XOBJ_DTYPE_INT, null, false);
        $this->initVar('random', XOBJ_DTYPE_INT, null, false);
        $this->initVar('recommend', XOBJ_DTYPE_INT, null, false);
        $this->initVar('default', XOBJ_DTYPE_INT, null, false);        
        $this->initVar('created', XOBJ_DTYPE_INT, null, false);
        $this->initVar('updated', XOBJ_DTYPE_INT, null, false);
    }
        
	function getForm() {
		return uitabs_tabs_get_form($this, false);
	}
	
    function toArray() {
    	$ret = parent::toArray();
    	$user_handler = xoops_gethandler('user');
    	if ($this->getVar('uid')>0) {
    		$user = $user_handler->get($this->getVar('uid'));
    		if (is_object($user))
    			$ret['user']['uid'] = '<a href="'.XOOPS_URL.'/userinfo.php?uid='.$user->getVar('uid').'">'.$user->getVar('uname').'</a>';
    		else 
    		 	$ret['user']['uid'] = _MI_TABS_USER_GUEST; 
    	} else {
    		$ret['user']['uid'] = _MI_TABS_USER_GUEST; 
    	}
    	if ($this->getVar('created')>0) {
    		$ret['dates']['created'] = date(_DATESTRING, $this->getVar('created'));
    	}
    	if ($this->getVar('updated')>0) {
    		$ret['dates']['updated'] = date(_DATESTRING, $this->getVar('updated'));
    	}
    	if (function_exists('uitabs_tabs_get_form')) {
	        $ele = uitabs_tabs_get_form($this, true);
	    	foreach($ele as $key => $field) {
	    		$field->setCaption('');
	    		$field->setDescription('');
	    		$ret['form'][$key] = $field->render();
	    	}
    	}
    	return $ret;
    }   
}


/**
* XOOPS policies handler class.
* This class is responsible for providing data access mechanisms to the data source
* of XOOPS user class objects.
*
* @author  Simon Roberts <simon@chronolabs.coop>
* @package kernel
*/
class UitabsTabsHandler extends XoopsPersistableObjectHandler
{

	var $_ModConfig = NULL;
	var $_Mod = NULL;
	
	function __construct(&$db) 
    {
		$config_handler = xoops_gethandler('config');
		$module_handler = xoops_gethandler('module');
		$this->_Mod = $module_handler->getByDirname('uitabs');
		$this->_ModConfig = $config_handler->getConfigList($this->_Mod->getVar('mid'));
    	
		$this->db = $db;
        parent::__construct($db, 'uitabs_tabs', 'UitabsTabs', "tid", "name");
    }

    function getForm() {
		return uitabs_tabs_get_form(NULL, false);
	}
    
    function insert($object, $force = true) {
    	if (is_object($GLOBALS['xoopsUser']))
    		$object->setVar('uid', $GLOBALS['xoopsUser']->getVar('uid'));
    	if ($object->isNew()) {
    		$object->setVar('created', time());
    	} else {
    		$object->setVar('updated', time());
    	}
    	if 	( 	$object->getVar('default')==true &&
    			$object->vars['default']['changed']==true	) {
    		$sql = "UPDATE " . $GLOBALS['xoopsDB']->prefix('uitabs_tabs') . ' SET `default` = 0';
    		$GLOBALS['xoopsDB']->queryF($sql);
    	}
    	return parent::insert($object, $force);
    }
    
    function getFilterCriteria($filter) {
    	$parts = explode('|', $filter);
    	$criteria = new CriteriaCompo();
    	foreach($parts as $part) {
    		$var = explode(',', $part);
    		if (!empty($var[1])&&!is_numeric($var[0])) {
    			$object = $this->create();
    			if (		$object->vars[$var[0]]['data_type']==XOBJ_DTYPE_TXTBOX || 
    						$object->vars[$var[0]]['data_type']==XOBJ_DTYPE_TXTAREA) 	{
    				$criteria->add(new Criteria('`'.$var[0].'`', '%'.$var[1].'%', (isset($var[2])?$var[2]:'LIKE')));
    			} elseif (	$object->vars[$var[0]]['data_type']==XOBJ_DTYPE_INT || 
    						$object->vars[$var[0]]['data_type']==XOBJ_DTYPE_DECIMAL || 
    						$object->vars[$var[0]]['data_type']==XOBJ_DTYPE_FLOAT ) 	{
    				$criteria->add(new Criteria('`'.$var[0].'`', $var[1], (isset($var[2])?$var[2]:'=')));			
				} elseif (	$object->vars[$var[0]]['data_type']==XOBJ_DTYPE_ENUM ) 	{
    				$criteria->add(new Criteria('`'.$var[0].'`', $var[1], (isset($var[2])?$var[2]:'=')));    				
				} elseif (	$object->vars[$var[0]]['data_type']==XOBJ_DTYPE_ARRAY ) 	{
    				$criteria->add(new Criteria('`'.$var[0].'`', '%"'.$var[1].'";%', (isset($var[2])?$var[2]:'LIKE')));    				
				}
    		} elseif (!empty($var[1])&&is_numeric($var[0])) {
    			$criteria->add(new Criteria("'".$var[0]."'", $var[1]));
    		}
    	}
    	return $criteria;
    }
        
	function getFilterForm($filter, $field, $sort='created', $op = '', $fct = '') {
    	$ele = uitabs_getFilterElement($filter, $field, $sort, $op, $fct);
    	if (is_object($ele))
    		return $ele->render();
    	else 
    		return '&nbsp;';
    }
    
    function delete($object, $force=true) {
		$items_handler = xoops_getmodulehandler('items', 'uitabs');
		$criteria = new Criteria('tid', $object->getVar($tid));
		if ($items_handler->deleteAll($criteria))
    		return parent::delete($object, $force);
    	else
    		return false;
    }
    
	function deleteAll($criteria, $force=true, $asObject=true) {
		foreach($this->getObjects($criteria, true) as $tid => $object) {
	    	$this->delete($object, $force);
		}
    	return true;
    }
}

?>