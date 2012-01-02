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
class UitabsItems extends XoopsObject
{

	var $_ModConfig = NULL;
	var $_Mod = NULL;
	
    function UitabsItems($id = null)
    {
    	$config_handler = xoops_gethandler('config');
		$module_handler = xoops_gethandler('module');
		$this->_Mod = $module_handler->getByDirname('uitabs');
		$this->_ModConfig = $config_handler->getConfigList($this->_Mod->getVar('mid'));
		
        $this->initVar('iid', XOBJ_DTYPE_INT, null, false);
        $this->initVar('tid', XOBJ_DTYPE_INT, null, false);
		$this->initVar('title', XOBJ_DTYPE_TXTBOX, null, false, 128);		
		$this->initVar('summary', XOBJ_DTYPE_TXTBOX, null, false, 1500);
		$this->initVar('description', XOBJ_DTYPE_TXTBOX, null, false);
		$this->initVar('path', XOBJ_DTYPE_TXTBOX, null, false, 128);
        $this->initVar('image', XOBJ_DTYPE_TXTBOX, null, false, 128);		
        $this->initVar('extension', XOBJ_DTYPE_TXTBOX, null, false, 4);
        $this->initVar('weight', XOBJ_DTYPE_INT, null, false);
        $this->initVar('width', XOBJ_DTYPE_INT, null, false);
        $this->initVar('height', XOBJ_DTYPE_INT, null, false);		
        $this->initVar('pid', XOBJ_DTYPE_INT, null, false);
        $this->initVar('fid', XOBJ_DTYPE_INT, null, false);
        $this->initVar('url', XOBJ_DTYPE_TXTBOX, null, false, 500);
        $this->initVar('uid', XOBJ_DTYPE_INT, null, false);
        $this->initVar('votes', XOBJ_DTYPE_INT, null, false);
        $this->initVar('rating', XOBJ_DTYPE_DECIMAL, null, false);
        $this->initVar('rate', XOBJ_DTYPE_INT, null, false);
        $this->initVar('clicks', XOBJ_DTYPE_INT, null, false);
        $this->initVar('created', XOBJ_DTYPE_INT, null, false);
        $this->initVar('updated', XOBJ_DTYPE_INT, null, false);
        $this->initVar('clicked', XOBJ_DTYPE_INT, null, false);
        $this->initVar('tags', XOBJ_DTYPE_TXTBOX, null, false, 255);   
    }
    
    function getForm() {
		return uitabs_items_get_form($this, false);
	}
    
    function toHTML($tab = true, $block=false, $fp_width = 0, $fp_height = 0) {
    	xoops_loadLanguage('modinfo', 'uitabs');
    	$html=array();
    	switch($tab) {
    		case true:
    			if (strlen($this->getVar('url'))>0)
    				if ($this->getVar('clicks')==true)
    					$html['a'] = ''.XOOPS_URL.'/modules/uitabs/index.php?op=count&id='.$this->getVar('iid').'&url='.urlencode($this->getVar('url')).'';
    				else 
    					$html['a'] = ''.$this->getVar('url').'';
    			else 
    				if ($this->getVar('clicks')==true)
    					$html['a'] = ''.XOOPS_URL.'/modules/uitabs/index.php?op=count&id='.$this->getVar('iid').'&url='.urlencode($_SERVER['REQUEST_URI']).'';
    					
				$html['header'] = $this->getVar('title');
				
				if (strlen($this->getVar('image'))>0) {
					$html['image'] = '<img border="0" src="'.XOOPS_URL.'/modules/uitabs/image.php?op=thumbnail&id='.$this->getVar('iid').'&passkey='.uitabs_getPassKey().'" ';
					if ($this->_ModConfig['thumbnail_rule']=='w') {
						$html['image'].= 'width="'.$this->_ModConfig['thumbnail_size'].'px" >';
					} elseif ($this->_ModConfig['thumbnail_rule']=='h') {
						$html['image'].= 'height="'.$this->_ModConfig['thumbnail_size'].'px" >';
					} elseif ($this->_ModConfig['thumbnail_rule']=='b') {
						$html['image'].= 'height="'.$this->_ModConfig['thumbnail_size'].'px" width="'.$this->_ModConfig['thumbnail_size'].'px" >';
					}
				}
				
				if ($this->getVar('fid')>0&&$this->_ModConfig['flowplayer']) {
					$player_handler = xoops_getmodulehandler('player', 'flowplayer');
					$player = $player_handler->get($this->getVar('fid'));
					$html['player'] = $player->getBaseHTML($block, $fp_width, $fp_height);
					if (is_object($GLOBALS['xoTheme']))
						$GLOBALS['xoTheme']->addScript('', array('type' => 'text/javascript'), $player->getJS($block));
				}
				
				if ($this->getVar('rate')==true) {
					$html['rate'] = '<div style="clear:both; display:block;">';
					$html['rate'] .= '<form action="'.XOOPS_URL.'/modules/uitabs/index.php" method="GET">';
					$html['rate'] .= '<input type="hidden" name="op" value="vote"/>';
					$html['rate'] .= '<input type="hidden" name="id" value="'.$this->getVar('iid').'"/>';
					$html['rate'] .= '<select name="rating">';
					$html['rate'] .= '<option value="0.5">'._MI_TABS_RATING_05STAR.'</option>';
					$html['rate'] .= '<option value="1">'._MI_TABS_RATING_1STAR.'</option>';
					$html['rate'] .= '<option value="1.5">'._MI_TABS_RATING_15STARS.'</option>';
					$html['rate'] .= '<option value="2">'._MI_TABS_RATING_2STARS.'</option>';
					$html['rate'] .= '<option value="2.5">'._MI_TABS_RATING_25STARS.'</option>';
					$html['rate'] .= '<option value="3">'._MI_TABS_RATING_3STARS.'</option>';
					$html['rate'] .= '<option value="3.5">'._MI_TABS_RATING_35STARS.'</option>';
					$html['rate'] .= '<option value="4">'._MI_TABS_RATING_4STARS.'</option>';
					$html['rate'] .= '<option value="4.5">'._MI_TABS_RATING_45STARS.'</option>';
					$html['rate'] .= '<option value="5">'._MI_TABS_RATING_5STARS.'</option>';
					$html['rate'] .= '<option value="5.5">'._MI_TABS_RATING_55STARS.'</option>';
					$html['rate'] .= '<option value="6">'._MI_TABS_RATING_6STARS.'</option>';
					$html['rate'] .= '<option value="6.5">'._MI_TABS_RATING_65STARS.'</option>';
					$html['rate'] .= '<option value="7">'._MI_TABS_RATING_7STARS.'</option>';
					$html['rate'] .= '<option value="7.5">'._MI_TABS_RATING_75STARS.'</option>';
					$html['rate'] .= '<option value="8">'._MI_TABS_RATING_8STARS.'</option>';
					$html['rate'] .= '<option value="8.5">'._MI_TABS_RATING_855STARS.'</option>';
					$html['rate'] .= '<option value="9">'._MI_TABS_RATING_9STARS.'</option>';
					$html['rate'] .= '<option value="9.5">'._MI_TABS_RATING_95STARS.'</option>';
					$html['rate'] .= '<option value="10">'._MI_TABS_RATING_10STARS.'</option>';
					$html['rate'] .= '</select>';
					$html['rate'] .= '<input type="submit" name="submit" value="'._MI_TABS_RATING_VOTE.'"/>';
					$html['rate'] .= '</form>';
					$html['rate'] .= '</div>'; 
				}

				if ($this->getVar('pid')>0&&$this->_ModConfig['matrixstream']&&is_object($GLOBALS['xoopsUser'])) {
					$subscriber_handler = xoops_getmodulehandler('subscriber', 'matrixstream');
					$subscribed_handler = xoops_getmodulehandler('subscribed', 'matrixstream');
					$subscriber = $subscriber_handler->getSubscriberWithUID($GLOBALS['xoopsUser']->getVar('uid'));
					if (is_object($subscriber)) {
						$criteria = new CriteriaCompo(new Criteria('sub_id', $subscriber->getVar('sub_id')));
						$criteria->add(new Criteria('pid', $this->getVar('pid')));
						if ($subscribed_handler->getCount($criteria)==0) {
							$html['subscribe'] = '<div style="clear:both; display:block;">';
							$html['subscribe'] .= '<form action="'.XOOPS_URL.'/modules/uitabs/index.php" method="GET">';
							$html['subscribe'] .= '<input type="hidden" name="op" value="count"/>';
							$html['subscribe'] .= '<input type="hidden" name="id" value="'.$this->getVar('iid').'"/>';
							$html['subscribe'] .= '<input type="hidden" name="url" value="'.XOOPS_URL.'/modules/matrixstream/add.php?op=package&pid='.$this->getVar('pid').'&url='.urlencode($_SERVER['REQUEST_URI']).'"/>';
							$html['subscribe'] .= '<input type="submit" name="submit" value="'._MI_TABS_SUBSCRIBE_TO_PACKAGE.'"/>';
							$html['subscribe'] .= '</form>';
							$html['subscribe'] .= '</div>';
						}
					}
				}
				
				if (strlen($this->getVar('summary'))>0)
					$html['text'] = '<div>'.$this->getVar('summary');
					if (strlen($this->getVar('description'))>0)
						$html['text'].= '<a href="'.XOOPS_URL.'/modules/uitabs/index.php?op=full&id='.$this->getVar('iid').'">'._MI_TABS_MORE.'</a></p>';
					else
						$html['text'].= '</div>';
    		break;
    		case false:
    			if (strlen($this->getVar('url'))>0)
    				if ($this->getVar('clicks')==true)
    					$html['a'] = ''.XOOPS_URL.'/modules/uitabs/index.php?op=count&id='.$this->getVar('iid').'&url='.urlencode($this->getVar('url')).'';
    				else 
    					$html['a'] = ''.$this->getVar('url').'';
    			
    			$html['header'] = $this->getVar('title');
				
    			if (strlen($this->getVar('image'))>0) {
					$html['image'] = '<img border="0" src="'.XOOPS_URL.'/modules/uitabs/image.php?op=fullsize&id='.$this->getVar('iid').'&passkey='.uitabs_getPassKey().'" ';
					if ($this->_ModConfig['thumbnail_rule']=='w') {
						$html['image'].= 'width="'.$this->_ModConfig['thumbnail_size'].'px" >';
					} elseif ($this->_ModConfig['thumbnail_rule']=='h') {
						$html['image'].= 'height="'.$this->_ModConfig['thumbnail_size'].'px" >';
					} elseif ($this->_ModConfig['thumbnail_rule']=='b') {
						$html['image'].= 'height="'.$this->_ModConfig['thumbnail_size'].'px" width="'.$this->_ModConfig['thumbnail_size'].'px" >';
					}
				}
				
				if ($this->getVar('fid')>0&&$this->_ModConfig['flowplayer']) {
					$player_handler = xoops_getmodulehandler('player', 'flowplayer');
					$player = $player_handler->get($this->getVar('fid'));
					$html['player'] = $player->getBaseHTML($block, $fp_width, $fp_height);
					if (is_object($GLOBALS['xoTheme']))
						$GLOBALS['xoTheme']->addScript('', array('type' => 'text/javascript'), $player->getJS($block));
				}
				
    			if ($this->getVar('rate')==true) {
					$html['rate'] = '<div style="clear:both; display:block;">';
					$html['rate'] .= '<form action="'.XOOPS_URL.'/modules/uitabs/index.php" method="GET">';
					$html['rate'] .= '<input type="hidden" name="op" value="vote"/>';
					$html['rate'] .= '<input type="hidden" name="id" value="'.$this->getVar('iid').'"/>';
					$html['rate'] .= '<select name="rating">';
					$html['rate'] .= '<option value="0.5">'._MI_TABS_RATING_05STAR.'</option>';
					$html['rate'] .= '<option value="1">'._MI_TABS_RATING_1STAR.'</option>';
					$html['rate'] .= '<option value="1.5">'._MI_TABS_RATING_15STARS.'</option>';
					$html['rate'] .= '<option value="2">'._MI_TABS_RATING_2STARS.'</option>';
					$html['rate'] .= '<option value="2.5">'._MI_TABS_RATING_25STARS.'</option>';
					$html['rate'] .= '<option value="3">'._MI_TABS_RATING_3STARS.'</option>';
					$html['rate'] .= '<option value="3.5">'._MI_TABS_RATING_35STARS.'</option>';
					$html['rate'] .= '<option value="4">'._MI_TABS_RATING_4STARS.'</option>';
					$html['rate'] .= '<option value="4.5">'._MI_TABS_RATING_45STARS.'</option>';
					$html['rate'] .= '<option value="5">'._MI_TABS_RATING_5STARS.'</option>';
					$html['rate'] .= '<option value="5.5">'._MI_TABS_RATING_55STARS.'</option>';
					$html['rate'] .= '<option value="6">'._MI_TABS_RATING_6STARS.'</option>';
					$html['rate'] .= '<option value="6.5">'._MI_TABS_RATING_65STARS.'</option>';
					$html['rate'] .= '<option value="7">'._MI_TABS_RATING_7STARS.'</option>';
					$html['rate'] .= '<option value="7.5">'._MI_TABS_RATING_75STARS.'</option>';
					$html['rate'] .= '<option value="8">'._MI_TABS_RATING_8STARS.'</option>';
					$html['rate'] .= '<option value="8.5">'._MI_TABS_RATING_855STARS.'</option>';
					$html['rate'] .= '<option value="9">'._MI_TABS_RATING_9STARS.'</option>';
					$html['rate'] .= '<option value="9.5">'._MI_TABS_RATING_955STARS.'</option>';
					$html['rate'] .= '<option value="10">'._MI_TABS_RATING_10STARS.'</option>';
					$html['rate'] .= '</select>';
					$html['rate'] .= '<input type="submit" name="submit" value="'._MI_TABS_RATING_VOTE.'"/>';
					$html['rate'] .= '</form>';
					$html['rate'] .= '</div>'; 
				}

				if ($this->getVar('pid')>0&&$this->_ModConfig['matrixstream']&&is_object($GLOBALS['xoopsUser'])) {
					$subscriber_handler = xoops_getmodulehandler('subscriber', 'matrixstream');
					$subscribed_handler = xoops_getmodulehandler('subscribed', 'matrixstream');
					$subscriber = $subscriber_handler->getSubscriberWithUID($GLOBALS['xoopsUser']->getVar('uid'));
					if (is_object($subscriber)) {
						$criteria = new CriteriaCompo(new Criteria('sub_id', $subscriber->getVar('sub_id')));
						$criteria->add(new Criteria('pid', $this->getVar('pid')));
						if ($subscribed_handler->getCount($criteria)==0) {
							$html['subscribe'] = '<div style="clear:both; display:block;">';
							$html['subscribe'] .= '<form action="'.XOOPS_URL.'/modules/uitabs/index.php" method="GET">';
							$html['subscribe'] .= '<input type="hidden" name="op" value="count"/>';
							$html['subscribe'] .= '<input type="hidden" name="id" value="'.$this->getVar('iid').'"/>';
							$html['subscribe'] .= '<input type="hidden" name="url" value="'.XOOPS_URL.'/modules/matrixstream/add.php?op=package&pid='.$this->getVar('pid').'&url='.urlencode($_SERVER['REQUEST_URI']).'"/>';
							$html['subscribe'] .= '<input type="submit" name="submit" value="'._MI_TABS_SUBSCRIBE_TO_PACKAGE.'"/>';
							$html['subscribe'] .= '</form>';
							$html['subscribe'] .= '</div>'; 
						}
					}
				}
				
				if (strlen($this->getVar('description'))>0)
					$html['text'] = '<div>'.$this->getVar('description').'</div>';   		
			break;
    	}
    	include_once ($GLOBALS['xoops']->path('class/template.php'));
    	$utTpl = new XoopsTpl();
    	$utTpl->assign('html', $html);
    	ob_start();
    	switch($tab) {
    		case true:
    	    	$utTpl->display('db:uitabs_tab.html');
    	    	break;
    	    case false:
    	    	$utTpl->display('db:uitabs_profile.html');
    	    	break;
    	}    
    	$data = ob_get_contents();
    	ob_end_clean();
    	
    	return $data;
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
    	if ($this->getVar('clicked')>0) {
    		$ret['dates']['clicked'] = date(_DATESTRING, $this->getVar('clicked'));
    	}
    	if ($this->getVar('rating')>0&&$this->getVar('votes')>0) {
    		$ret['rank'] = $this->getVar('rating') / $this->getVar('votes');	
    	}
    	if (function_exists('uitabs_items_get_form')) {
	    	$ele = uitabs_items_get_form($this, true);
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
class UitabsItemsHandler extends XoopsPersistableObjectHandler
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
        parent::__construct($db, 'uitabs_items', 'UitabsItems', "iid", "name");
    }

    function getForm() {
		return uitabs_items_get_form(NULL, false);
	}
    
    function insert($object, $force = true) {
    	
    	if (is_object($GLOBALS['xoopsUser']))
    		$object->setVar('uid', $GLOBALS['xoopsUser']->getVar('uid'));
    	
       	if ($object->isNew()) {
    		$object->setVar('created', time());
    	} else {
    		$object->setVar('updated', time());
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
    
    function setClicked($iid) {
    	$sql = "UPDATE " . $GLOBALS['xoopsDB']->prefix('uitabs_items') . ' SET `clicks` = `clicks` + 1, `clicked` = "' . time() . '" WHERE `iid` = "' . $iid . '"';
    	return $GLOBALS['xoopsDB']->queryF($sql);
    }
    
    function getByField($search='', $field='') {
    	if (empty($search)&&empty($field))
    		return false;
    	$criteria = new Criteria($field, $search);
    	$objects = $this->getObjects($criteria, false);
    	if (!is_object($objects[0]))
    		return false;
    	else 
    		return $objects[0];
    }
    
    function delete($object, $force=true) {
    	if (file_exists($GLOBALS['xoops']->path($object->getVar('path').DS.$object->getVar('filename'))))
    		unlink($GLOBALS['xoops']->path($object->getVar('path').DS.$object->getVar('filename')));
    	return parent::delete($object, $force);
    }
    
	function deleteAll($criteria, $force=true, $asObject=true) {
		foreach($this->getObjects($criteria, true) as $iid => $object) {
	    	$this->delete($object, $force);
		}
    	return true;
    }
}

?>