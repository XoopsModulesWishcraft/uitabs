<?php

	error_reporting(0);
	
	include('header.php');
	
	if (!uitabs_checkpasskey($passkey)) { 
		echo 'Passkey Mismatch - '. date('Y-m-d h');
		exit(0);
	}
	
	error_reporting(0);
	$items_handler =& xoops_getmodulehandler('items', 'uitabs');
	$item = $items_handler->get($id);
	
	if ($GLOBALS['xoopsModuleConfig']['wideimage']) {
		require_once($GLOBALS['xoops']->path(_MI_TABS_FRAMEWORK_WIDEIMAGE));
		$img = WideImage::load($GLOBALS['xoops']->path($item->getVar('path').DS.$item->getVar('image')));
		if ($GLOBALS['xoopsModuleConfig']['watermark']) {
			$watermark = WideImage::load($GLOBALS['xoopsModuleConfig']['watermark_image']);
			$wwidth = $watermark->getWidth();
			$wheight = $watermark->getHeight();
			switch($GLOBALS['xoopsModuleConfig']['watermark_position']) {
				case 'TL':
					$img = $img->merge($watermark, sprintf("left + %s", $wwidth*(1/5)), sprintf("top + %s", $wheight*(1/5)), $GLOBALS['xoopsModuleConfig']['watermark_trans']);		
					break;
				case 'TR':
					$img = $img->merge($watermark, sprintf("right - %s", $wwidth+$wwidth*(1/5)), sprintf("top + %s", $wheight*(1/5)), $GLOBALS['xoopsModuleConfig']['watermark_trans']);
					break;
				case 'BL':
					$img = $img->merge($watermark, sprintf("left + %s", $wwidth*(1/5)), sprintf("bottom - %s", $wheight+$wheight*(1/5)), $GLOBALS['xoopsModuleConfig']['watermark_trans']);
					break;
				case 'BR':
					$img = $img->merge($watermark, sprintf("right - %s", $wwidth-$wwidth*(1/5)), sprintf("bottom - %s", $wheight+$wheight*(1/5)), $GLOBALS['xoopsModuleConfig']['watermark_trans']);
					break;
				case 'MD':
					$img = $img->merge($watermark, "50%", "50%", $GLOBALS['xoopsModuleConfig']['watermark_trans']);
					break;
			}
		}
		switch($op) {
			case "fullsize":
				switch($GLOBALS['xoopsModuleConfig']['fullsize_rule']) {
					case 'w':
						$newImage = $img->resize($GLOBALS['xoopsModuleConfig']['fullsize_size'], NULL);		
						break;
					case 'h':
						$newImage = $img->resize(NULL, $GLOBALS['xoopsModuleConfig']['fullsize_size']);
						break;
					case 'b':
						$newImage = $img->resize($GLOBALS['xoopsModuleConfig']['fullsize_size'], $GLOBALS['xoopsModuleConfig']['fullsize_size']);
						break;
				}
				switch($item->getVar('extension')) {
					case 'jpg':
					case 'jpeg':
						$newImage->output('jpg', 46);				
						break;
					case 'gif':
						$newImage->output('gif', 46);
						break;
					case 'png':
						$newImage->output('png', 46);
						break;
				}
				break;
			case "thumbnail":
				switch($GLOBALS['xoopsModuleConfig']['thumbnail_rule']) {
					case 'w':
						$newImage = $img->resize($GLOBALS['xoopsModuleConfig']['thumbnail_size'], NULL);		
						break;
					case 'h':
						$newImage = $img->resize(NULL, $GLOBALS['xoopsModuleConfig']['thumbnail_size']);
						break;
					case 'b':
						$newImage = $img->resize($GLOBALS['xoopsModuleConfig']['thumbnail_size'], $GLOBALS['xoopsModuleConfig']['thumbnail_size']);
						break;
				}
				switch($item->getVar('extension')) {
					case 'jpg':
					case 'jpeg':
						$newImage->output('jpg', 46);				
						break;
					case 'gif':
						$newImage->output('gif', 46);
						break;
					case 'png':
						$newImage->output('png', 46);
						break;
				}
				break;			
		}
	} else {
		switch($item->getVar('extension')) {
			case 'jpg':
			case 'jpeg':
				header('Content-type: image/jpeg');				
				break;
			case 'gif':
				header('Content-type: image/gif');
				break;
			case 'png':
				header('Content-type: image/png');
				break;
		}
		readfile($GLOBALS['xoops']->path($item->getVar('path').DS.$item->getVar('image')));
		exit;
	}
	exit(0);
?>