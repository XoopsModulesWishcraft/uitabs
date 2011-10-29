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
class UitabsVotes extends XoopsObject
{

	var $_ModConfig = NULL;
	var $_Mod = NULL;
	
    function UitabsVotes($id = null)
    {
    	$config_handler = xoops_gethandler('config');
		$module_handler = xoops_gethandler('module');
		$this->_Mod = $module_handler->getByDirname('uitabs');
		$this->_ModConfig = $config_handler->getConfigList($this->_Mod->getVar('mid'));
		
        $this->initVar('vid', XOBJ_DTYPE_INT, null, false);
        $this->initVar('tid', XOBJ_DTYPE_INT, null, false);
        $this->initVar('iid', XOBJ_DTYPE_INT, null, false);
        $this->initVar('pid', XOBJ_DTYPE_INT, null, false);
        $this->initVar('fid', XOBJ_DTYPE_INT, null, false);
		$this->initVar('ip', XOBJ_DTYPE_TXTBOX, null, false, 64);		
        $this->initVar('rating', XOBJ_DTYPE_DECIMAL, null, false);
        $this->initVar('uid', XOBJ_DTYPE_INT, null, false);
        $this->initVar('created', XOBJ_DTYPE_INT, null, false);
        
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
class UitabsVotesHandler extends XoopsPersistableObjectHandler
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
        parent::__construct($db, 'uitabs_votes', 'UitabsVotes', "vid", "rating");
    }

    function insert($object, $force = true) {
    	if (is_object($GLOBALS['xoopsUser']))
    		$object->setVar('uid', $GLOBALS['xoopsUser']->getVar('uid'));
    	if ($object->isNew()) {
    		$object->setVar('created', time());
    	} else {
    		$object->setVar('updated', time());
    	}
    	if ($this->_ModConfig['matrixstream']&&$object->getVar('pid')>0) {
    		$packages_handler = xoops_getmodulehandler('packages', 'matrixstream');
    		$packages_handler->sendVote($object->getVar('pid'), $object->getVar('rating'));
    	}
    	if ($this->_ModConfig['flowplayer']&&$object->getVar('fid')>0) {
    		$player_handler = xoops_getmodulehandler('player', 'matrixstream');
    		$player_handler->sendVote($object->getVar('fid'), $object->getVar('rating'));
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
    
    function setVotes($iid=0, $pid=0, $fid=0, $rating=0, $url=XOOPS_URL) {
    	xoops_loadLanguage('modinfo', 'uitabs');
    	if ($iid>0) {
    		$items_handler = xoops_getmodulehandler('items', 'uitabs');
    		$item = $items_handler->get($iid);
    		$tid = $item->getVar('tid');
    		$pid = $item->getVar('pid');
    		$fid = $item->getVar('fid'); 
    	} elseif ($pid>0&&$this->_ModConfig['matrixstream']) {
    		$items_handler = xoops_getmodulehandler('items', 'uitabs');
    		$item = $items_handler->getByField($pid, 'pid');
    		if (is_object($item)) {
  				$tid = $item->getVar('tid');
    			$iid = $item->getVar('iid');
	    		$fid = $item->getVar('fid');
    		} else {
    			$packages_handler = xoops_getmodulehandler('packages', 'matrixstream');
    			$package = $packages_handler->get($pid);
    			if (is_object($package))
    				if ($package->getVar('player_id')>0)
    					$fid = $package->getVar('player_id');
    				else 
    					$fid = $package->getVar('preview_player_id');
    		}
    	} elseif ($fid>0&&$this->_ModConfig['flowplayer']) {
    		$items_handler = xoops_getmodulehandler('items', 'uitabs');
    		$item = $items_handler->getByField($fid, 'fid');
    		if (is_object($item)) {
	    		$iid = $item->getVar('iid');
	    		$pid = $item->getVar('pid');
	    		$tid = $item->getVar('tid');
    		} elseif ($this->_ModConfig['matrixstream']) {
    			$packages_handler = xoops_getmodulehandler('packages', 'matrixstream');
    			$package = $packages_handler->getByField($fid, 'player_id');
    			if (is_object($package))
    				$pid = $package->getVar('player_id');
    			else {
    				$package = $packages_handler->getByField($fid, 'preview_player_id');
    				if (is_object($package))
    					$pid = $package->getVar('preview_player_id');
    			}
    			$item = $items_handler->getByField($pid, 'pid');
   				if (is_object($item)) {
    				$iid = $item->getVar('iid');
    				$tid = $item->getVar('tid');
   				}
    		}
    	}
    	$criteria = new CriteriaCompo(new Criteria('ip', $_SERVER['REMOTE_ADDR']));
    	if (is_object($GLOBALS['xoopsUser']))
    		$criteria->add(new Criteria('uid', $GLOBALS['xoopsUser']->getVar('uid')));
    	$criteria->add(new Criteria('pid', $pid));    	
    	$criteria->add(new Criteria('fid', $fid));
    	$criteria->add(new Criteria('iid', $iid));
    	$criteria->add(new Criteria('tid', $tid));

    	if ($this->getCount($criteria)>0) {
    		redirect_header($url, 10, _MI_TABS_VOTEALREADYDONE);
    		exit;
    	}
    	
    	$object = $this->create();
    	$object->setVar('tid', $tid);
    	$object->setVar('pid', $pid);
    	$object->setVar('iid', $iid);
    	$object->setVar('fid', $fid);
    	$object->setVar('ip', $_SERVER['REMOTE_ADDR']);
    	$object->setVar('rating', $rating);
    	@$this->insert($object, true);
    	redirect_header($url, 10, _MI_TABS_VOTETAKEN);
    	exit;
    }
}

?>