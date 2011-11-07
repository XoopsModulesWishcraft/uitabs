<?php

if (!function_exists('xoops_sef')) {
	function xoops_sef($datab, $char ='-')
	{
		$datab = urldecode(strtolower($datab));
		$datab = urlencode($datab);
		$datab = str_replace(urlencode('æ'),'ae',$datab);
		$datab = str_replace(urlencode('ø'),'oe',$datab);
		$datab = str_replace(urlencode('å'),'aa',$datab);
		$replacement_chars = array(' ', '|', '=', '\\', '+', '-', '_', '{', '}', ']', '[', '\'', '"', ';', ':', '?', '>', '<', '.', ',', ')', '(', '*', '&', '^', '%', '$', '#', '@', '!', '`', '~', ' ', '', '¡', '¦', '§', '¨', '©', 'ª', '«', '¬', '®', '­', '¯', '°', '±', '²', '³', '´', 'µ', '¶', '·', '¸', '¹', 'º', '»', '¼', '½', '¾', '¿');
		$return_data = str_replace($replacement_chars,$char,urldecode($datab));
		#print $return_data."<BR><BR>";
		switch ($char) {
		default:
			return urldecode($return_data);
			break;
		case "-";
			return urlencode($return_data);
			break;
		}
	}
}

if (!function_exists('uitabs_getFilterElement')) {
	function uitabs_getFilterElement($filter, $field, $sort='created', $op = '', $fct = '') {
		$components = uitabs_getFilterURLComponents($filter, $field, $sort);
		$ele = false;
		include_once('formobjects.uitabs.php');
		switch ($field) {
	    	case 'pid':
				if ($GLOBALS['xoopsModuleConfig']['matrixstream']) {
					$ele = new UitabsFormSelectPackageID('', 'filter_'.$field.'', $components['value'], 1, false, true);
			    	$ele->setExtra('onchange="window.open(\''.$_SERVER['PHP_SELF'].'?'.$components['extra'].'&filter='.$components['filter'].(!empty($components['filter'])?'|':'').$field.',\'+this.options[this.selectedIndex].value'.(!empty($components['operator'])?'+\','.$components['operator'].'\'':'').',\'_self\')"');
			    	break;
	    		}
	    	case 'fid':
	    		if ($GLOBALS['xoopsModuleConfig']['flowplayer']) {
					$ele = new UitabsFormSelectPlayer('', 'filter_'.$field.'', $components['value'], 1, false, true);
			    	$ele->setExtra('onchange="window.open(\''.$_SERVER['PHP_SELF'].'?'.$components['extra'].'&filter='.$components['filter'].(!empty($components['filter'])?'|':'').$field.',\'+this.options[this.selectedIndex].value'.(!empty($components['operator'])?'+\','.$components['operator'].'\'':'').',\'_self\')"');
			    	break;
	    		}
	    	case 'tid':
				$ele = new UitabsFormSelectTab('', 'filter_'.$field.'', $components['value'], 1, false, true);
		    	$ele->setExtra('onchange="window.open(\''.$_SERVER['PHP_SELF'].'?'.$components['extra'].'&filter='.$components['filter'].(!empty($components['filter'])?'|':'').$field.',\'+this.options[this.selectedIndex].value'.(!empty($components['operator'])?'+\','.$components['operator'].'\'':'').',\'_self\')"');
		    	break;
			case 'id':
		    case 'name':
		    case 'title':
		    case 'url':
		    case 'weight':
		    case 'summary':
		    case 'description':
		    case 'path':
		    case 'image':
		    case 'extension':
		    case 'width':
		    case 'height':
		    	$ele = new XoopsFormElementTray('');
				$ele->addElement(new XoopsFormText('', 'filter_'.$field.'', 11, 40, $components['value']));
				$button = new XoopsFormButton('', 'button_'.$field.'', '[+]');
		    	$button->setExtra('onclick="window.open(\''.$_SERVER['PHP_SELF'].'?'.$components['extra'].'&filter='.$components['filter'].(!empty($components['filter'])?'|':'').$field.',\'+$(\'#filter_'.$field.'\').val()'.(!empty($components['operator'])?'+\','.$components['operator'].'\'':'').',\'_self\')"');
		    	$ele->addElement($button);
		    	break;
		}
		return $ele;
	}
}

if (!function_exists('uitabs_getFilterURLComponents')) {
	function uitabs_getFilterURLComponents($filter, $field, $sort='created') {
		$parts = explode('|', $filter);
		$ret = array();
		$value = '';
		$ele_value = '';
		$operator = '';
    	foreach($parts as $part) {
    		$var = explode(',', $part);
    		if (count($var)>1) {
	    		if ($var[0]==$field) {
	    			$ele_value = $var[1];
	    			if (isset($var[2]))
	    				$operator = $var[2];
	    		} elseif ($var[0]!=1) {
	    			$ret[] = implode(',', $var);
	    		}
    		}
    	}
    	$pagenav = array();
    	$pagenav['op'] = isset($_REQUEST['op'])?$_REQUEST['op']:"uitabs";
		$pagenav['fct'] = isset($_REQUEST['fct'])?$_REQUEST['fct']:"list";
		$pagenav['limit'] = !empty($_REQUEST['limit'])?intval($_REQUEST['limit']):30;
		$pagenav['start'] = 0;
		$pagenav['order'] = !empty($_REQUEST['order'])?$_REQUEST['order']:'DESC';
		$pagenav['sort'] = !empty($_REQUEST['sort'])?''.$_REQUEST['sort'].'':$sort;
    	$retb = array();
		foreach($pagenav as $key=>$value) {
			$retb[] = "$key=$value";
		}
		return array('value'=>$ele_value, 'field'=>$field, 'operator'=>$operator, 'filter'=>implode('|', $ret), 'extra'=>implode('&', $retb));
	}
}

if (!function_exists("uitabs_adminMenu")) {
  function uitabs_adminMenu ($currentoption = 0)  {
		$module_handler = xoops_gethandler('module');
		$xoModule = $module_handler->getByDirname('uitabs');

	  /* Nice buttons styles */
	    echo "
    	<style type='text/css'>
		#form {float:left; width:100%; background: #e7e7e7 url('" . XOOPS_URL . "/modules/".$xoModule->getVar('dirname')."/images/bg.gif') repeat-x left bottom; font-size:93%; line-height:normal; border-bottom: 1px solid black; border-top: 1px solid black; border-left: 1px solid black; border-right: 1px solid black;}
		    	#buttontop { float:left; width:100%; background: #e7e7e7; font-size:93%; line-height:normal; border-top: 1px solid black; border-left: 1px solid black; border-right: 1px solid black; margin: 0; }
    	#buttonbar { float:left; width:100%; background: #e7e7e7 url('" . XOOPS_URL . "/modules/".$xoModule->getVar('dirname')."/images/bg.gif') repeat-x left bottom; font-size:93%; line-height:normal; border-left: 1px solid black; border-right: 1px solid black; margin-bottom: 0px; border-bottom: 1px solid black; }
    	#buttonbar ul { margin:0; margin-top: 15px; padding:10px 10px 0; list-style:none; }
		  #buttonbar li { display:inline; margin:0; padding:0; }
		  #buttonbar a { float:left; background:url('" . XOOPS_URL . "/modules/".$xoModule->getVar('dirname')."/images/left_both.gif') no-repeat left top; margin:0; padding:0 0 0 9px;  text-decoration:none; }
		  #buttonbar a span { float:left; display:block; background:url('" . XOOPS_URL . "/modules/".$xoModule->getVar('dirname')."/images/right_both.gif') no-repeat right top; padding:5px 15px 4px 6px; font-weight:bold; color:#765; }
		  /* Commented Backslash Hack hides rule from IE5-Mac \*/
		  #buttonbar a span {float:none;}
		  /* End IE5-Mac hack */
		  #buttonbar a:hover span { color:#333; }
		  #buttonbar #current a { background-position:0 -150px; border-width:0; }
		  #buttonbar #current a span { background-position:100% -150px; padding-bottom:5px; color:#333; }
		  #buttonbar a:hover { background-position:0% -150px; }
		  #buttonbar a:hover span { background-position:100% -150px; }
		  </style>";
	
	   // global $xoopsDB, $xoModule, $xoopsConfig, $xoModuleConfig;
	
	   $myts = &MyTextSanitizer::getInstance();
	
	   $tblColors = Array();
		// $adminmenu=array();
	   if (file_exists(XOOPS_ROOT_PATH . '/modules/'.$xoModule->getVar('dirname').'/language/' . $GLOBALS['xoopsConfig']['language'] . '/modinfo.php')) {
		   include_once XOOPS_ROOT_PATH . '/modules/'.$xoModule->getVar('dirname').'/language/' . $GLOBALS['xoopsConfig']['language'] . '/modinfo.php';
	   } else {
		   include_once XOOPS_ROOT_PATH . '/modules/'.$xoModule->getVar('dirname').'/language/english/modinfo.php';
	   }
       
	   include XOOPS_ROOT_PATH . '/modules/'.$xoModule->getVar('dirname').'/admin/menu.php';
	   global $adminmenu;
	   echo "<table width=\"100%\" border='0'><tr><td>";
	   echo "<div id='buttontop'>";
	   echo "<table style=\"width: 100%; padding: 0; \" cellspacing=\"0\"><tr>";
	   echo "<td style=\"width: 45%; font-size: 10px; text-align: left; color: #2F5376; padding: 0 6px; line-height: 18px;\"><a class=\"nobutton\" href=\"".XOOPS_URL."/modules/system/admin.php?fct=preferences&amp;op=showmod&amp;mod=" . $xoModule->getVar('mid') . "\">" . _PREFERENCES . "</a></td>";
	   echo "<td style='font-size: 10px; text-align: right; color: #2F5376; padding: 0 6px; line-height: 18px;'><b>" . $myts->displayTarea($xoModule->name()) ."</td>";
	   echo "</tr></table>";
	   echo "</div>";
	   echo "<div id='buttonbar'>";
	   echo "<ul>";
		 foreach ($adminmenu as $key => $value) {
		   $tblColors[$key] = '';
		   $tblColors[$currentoption] = 'current';
	     echo "<li id='" . $tblColors[$key] . "'><a href=\"" . XOOPS_URL . "/modules/".$xoModule->getVar('dirname')."/".$value['link']."\"><span>" . $value['title'] . "</span></a></li>";
		 }
		 
	   echo "</ul></div>";
	   echo "</td></tr>";
	   echo "<tr'><td><div id='form'>";
    
  }
  
  function uitabs_footer_adminMenu()
  {
		echo "</div></td></tr>";
  		echo "</table>";
  }
}

if (!function_exists("uitabs_checkpasskey")) {
	function uitabs_checkpasskey($key) {
		$config_handler = xoops_gethandler('config');
		$module_handler = xoops_gethandler('module');
		$Mod = $module_handler->getByDirname('uitabs');
		$ModConfig = $config_handler->getConfigList($Mod->getVar('mid'));
		
		$minseed = strtotime(date('Y-m-d h:i'))-120;
		$diff = intval(intval($ModConfig['passkeyvalidfor'])*60);
		for($step=$minseed;$step<=($minseed+$diff);$step=$step+60) {
			if ($key==uitabs_getPassKey($step))
				return true;
			//else 
			//	echo "$key != ".md5($GLOBALS['xoopsModuleConfig']['salt'].XOOPS_LICENSE_KEY.date('Ymdhi', $step)).' - '.$step.'<br/>';
		}
		return false;
	}
}

if (!function_exists("uitabs_getPassKey")) {
	function uitabs_getPassKey($time=0) {
		static $ModConfig;
		if (!isset($ModConfig)) {
			$config_handler = xoops_gethandler('config');
			$module_handler = xoops_gethandler('module');
			$Mod = $module_handler->getByDirname('uitabs');
			$ModConfig = $config_handler->getConfigList($Mod->getVar('mid'));
		}
		if ($time=0)
			$time=time();
		return md5($ModConfig['salt'].XOOPS_LICENSE_KEY.date('Ymdhi', strtotime(date('Y-m-d h:i', $time))));
	}
}