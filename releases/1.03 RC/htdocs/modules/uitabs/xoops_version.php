<?php
/**
 * Private message module
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code 
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright       The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license         http://www.fsf.org/copyleft/gpl.html GNU public license
 * @package         pm
 * @since           2.3.0
 * @author          Jan Pedersen
 * @author          Taiwen Jiang <phppp@users.sourceforge.net>
 * @version         $Id$
 */
 
/**
 * This is a temporary solution for merging XOOPS 2.0 and 2.2 series
 * A thorough solution will be available in XOOPS 3.0
 *
 */

$modversion = array();
$modversion['name'] = _MI_TABS_NAME;
$modversion['version'] = 1.03;
$modversion['description'] = _MI_TABS_DESC;
$modversion['author'] = "Simon Roberts (simon@chronolabs.coop)";
$modversion['credits'] = "Wishcraft";
$modversion['license'] = "GPL";
$modversion['image'] = "images/uitabs_slogo.png";
$modversion['dirname'] = basename(dirname(__FILE__));
$modversion['status'] = "stable";

// Admin things
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = "admin/index.php";
$modversion['adminmenu'] = "admin/menu.php";

//Install scripts
//$modversion['onUpdate'] = "include/onupdate.php";

// Search
//$modversion['hasSearch'] = 1;
//$modversion['search']['file'] = "include/search.inc.php";
//$modversion['search']['func'] = "sexy_search";

// Mysql file
$modversion['sqlfile']['mysql'] = "sql/mysql.sql";

// Table
$i=0;
$modversion['tables'][$i++] = "uitabs_tabs";
$modversion['tables'][$i++] = "uitabs_items";
$modversion['tables'][$i++] = "uitabs_votes";

// Comments
//$modversion['hasComments'] = 1;
//$modversion['comments']['itemName'] = 'pid';
//$modversion['comments']['pageName'] = 'index.php';

$modversion['hasMain'] = 1;

// Templates
$i=1;
$modversion['templates'][$i]['file'] = 'uitabs_index.html';
$modversion['templates'][$i]['description'] = 'UI Tabs Index Template (Form)';
$i++;
$modversion['templates'][$i]['file'] = 'uitabs_tabs.html';
$modversion['templates'][$i]['description'] = 'UI Tabs Tabs Content';
$i++;
$modversion['templates'][$i]['file'] = 'uitabs_tab.html';
$modversion['templates'][$i]['description'] = 'UI Tabs Tab Content';
$i++;
$modversion['templates'][$i]['file'] = 'uitabs_profile.html';
$modversion['templates'][$i]['description'] = 'UI Tabs Profile Content';
$i++;
$modversion['templates'][$i]['file'] = 'uitabs_cpanel_tabs_edit.html';
$modversion['templates'][$i]['description'] = 'UI Tabs Tabs Edit Content';
$i++;
$modversion['templates'][$i]['file'] = 'uitabs_cpanel_tabs_list.html';
$modversion['templates'][$i]['description'] = 'UI Tabs Tabs List Content';
$i++;
$modversion['templates'][$i]['file'] = 'uitabs_cpanel_items_edit.html';
$modversion['templates'][$i]['description'] = 'UI Tabs Tabs Items Content';
$i++;
$modversion['templates'][$i]['file'] = 'uitabs_cpanel_items_list.html';
$modversion['templates'][$i]['description'] = 'UI Tabs Tabs Items Content';

$i=1;
$modversion['blocks'][$i]['file'] = "uitabs_block_tabs.php";
$modversion['blocks'][$i]['name'] = 'UI Tabs Tabs shows';
$modversion['blocks'][$i]['description'] = "Shows a block which has the weighted tabs group of images and content.";
$modversion['blocks'][$i]['show_func'] = "b_uitabs_blocks_tabs_show";
$modversion['blocks'][$i]['edit_func'] = "b_uitabs_blocks_tabs_edit";
$modversion['blocks'][$i]['options'] = "5|140|100";
$modversion['blocks'][$i]['template'] = 'uitabs_blocks_tabs.html';

$i++;
$modversion['blocks'][$i]['file'] = "uitabs_tags.php";
$modversion['blocks'][$i]['name'] = 'UI Tabs Tag Cloud';
$modversion['blocks'][$i]['description'] = "Show UI Tabs tag cloud.";
$modversion['blocks'][$i]['show_func'] = "uitabs_block_tag_cloud_show";
$modversion['blocks'][$i]['edit_func'] = "uitabs_block_tag_cloud_edit";
$modversion['blocks'][$i]['options'] = "100|0|150|80";
$modversion['blocks'][$i]['template'] = 'uitabs_block_tag_cloud.html';

$i++;
$modversion['blocks'][$i]['file'] = "uitabs_tags.php";
$modversion['blocks'][$i]['name'] = 'UI Tabs Top Tags';
$modversion['blocks'][$i]['description'] = "Show UI Tabs top tags.";
$modversion['blocks'][$i]['show_func'] = "uitabs_block_tag_top_show";
$modversion['blocks'][$i]['edit_func'] = "uitabs_block_tag_top_edit";
$modversion['blocks'][$i]['options'] = "50|30|c";
$modversion['blocks'][$i]['template'] = 'uitabs_block_tag_top.html';

$i=1;
$modversion['config'][$i]['name'] = 'items';
$modversion['config'][$i]['title'] = "_MI_TABS_ITEMS";
$modversion['config'][$i]['description'] = "_MI_TABS_ITEMS_DESC";
$modversion['config'][$i]['formtype'] = 'textbox';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = '5';

$i++;
$modversion['config'][$i]['name'] = 'filesize_upload';
$modversion['config'][$i]['title'] = "_MI_TABS_FILESIZEUPLD";
$modversion['config'][$i]['description'] = "_MI_TABS_FILESIZEUPLD_DESC";
$modversion['config'][$i]['formtype'] = 'textbox';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = '1950351';

$i++;
$modversion['config'][$i]['name'] = 'allowed_mimetype';
$modversion['config'][$i]['title'] = "_MI_TABS_ALLOWEDMIMETYPE";
$modversion['config'][$i]['description'] = "_MI_TABS_ALLOWEDMIMETYPE_DESC";
$modversion['config'][$i]['formtype'] = 'textarea';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = 'image/gif|image/pjpeg|image/jpeg|image/x-png|image/png';

$i++;
$modversion['config'][$i]['name'] = 'allowed_extensions';
$modversion['config'][$i]['title'] = "_MI_TABS_ALLOWEDEXTENSIONS";
$modversion['config'][$i]['description'] = "_MI_TABS_ALLOWEDEXTENSIONS_DESC";
$modversion['config'][$i]['formtype'] = 'textarea';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = 'gif|pjpeg|jpeg|jpg|png';

$i++;
$modversion['config'][$i]['name'] = 'upload_areas';
$modversion['config'][$i]['title'] = "_MI_TABS_UPLOADAREAS";
$modversion['config'][$i]['description'] = "_MI_TABS_UPLOADAREAS_DESC";
$modversion['config'][$i]['formtype'] = 'select';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = DS.'uploads'.DS.'uitabs';
$modversion['config'][$i]['options'] = array(
												_MI_TABS_UPLOADAREAS_UPLOADS => DS.'uploads',
												_MI_TABS_UPLOADAREAS_UPLOADS_UITABS => DS.'uploads'.DS.'uitabs'
										);

$i++;
$modversion['config'][$i]['name'] = 'fullsize_size';
$modversion['config'][$i]['title'] = "_MI_TABS_FULLSIZE";
$modversion['config'][$i]['description'] = "_MI_TABS_FULLSIZE_DESC";
$modversion['config'][$i]['formtype'] = 'textbox';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 540;

$i++;
$modversion['config'][$i]['name'] = 'fullsize_rule';
$modversion['config'][$i]['title'] = "_MI_TABS_FULLSIZE_RULE";
$modversion['config'][$i]['description'] = "_MI_TABS_FULLSIZE_RULE_DESC";
$modversion['config'][$i]['formtype'] = 'select';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = 'w';
$modversion['config'][$i]['options'] =  array(
													_MI_TABS_FULLSIZE_RULE_W => 'w' ,
													_MI_TABS_FULLSIZE_RULE_H => 'h' ,
													_MI_TABS_FULLSIZE_RULE_B => 'b' 
										);
										
$i++;
$modversion['config'][$i]['name'] = 'thumbnail_size';
$modversion['config'][$i]['title'] = "_MI_TABS_THUMBSIZE";
$modversion['config'][$i]['description'] = "_MI_TABS_THUMBSIZE_DESC";
$modversion['config'][$i]['formtype'] = 'textbox';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 140;

$i++;
$modversion['config'][$i]['name'] = 'thumbnail_rule';
$modversion['config'][$i]['title'] = "_MI_TABS_THUMBNAIL_RULE";
$modversion['config'][$i]['description'] = "_MI_TABS_THUMBNAIL_RULE_DESC";
$modversion['config'][$i]['formtype'] = 'select';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = 'w';
$modversion['config'][$i]['options'] =  array(
													_MI_TABS_THUMBNAIL_RULE_W => 'w' ,
													_MI_TABS_THUMBNAIL_RULE_H => 'h' ,
													_MI_TABS_THUMBNAIL_RULE_B => 'b' 
										);
										
$i++;
$modversion['config'][$i]['name'] = 'wideimage';
$modversion['config'][$i]['title'] = "_MI_TABS_WIDEIMAGE";
$modversion['config'][$i]['description'] = "_MI_TABS_WIDEIMAGE_DESC";
$modversion['config'][$i]['formtype'] = 'yesno';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 1;

$i++;
$modversion['config'][$i]['name'] = 'watermark';
$modversion['config'][$i]['title'] = "_MI_TABS_WATERMARK";
$modversion['config'][$i]['description'] = "_MI_TABS_WATERMARK_DESC";
$modversion['config'][$i]['formtype'] = 'yesno';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 1;

$i++;
$modversion['config'][$i]['name'] = 'watermark_trans';
$modversion['config'][$i]['title'] = "_MI_TABS_WATERMARK_TRANSPARENCY";
$modversion['config'][$i]['description'] = "_MI_TABS_WATERMARK_TRANSPARENCY_DESC";
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = '75';

$i++;
$modversion['config'][$i]['name'] = 'watermark_image';
$modversion['config'][$i]['title'] = "_MI_TABS_WATERMARK_IMAGE";
$modversion['config'][$i]['description'] = "_MI_TABS_WATERMARK_IMAGE_DESC";
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = XOOPS_ROOT_PATH.'/uploads/uitabs/watermarks/default.png';

$i++;
$modversion['config'][$i]['name'] = 'watermark_position';
$modversion['config'][$i]['title'] = "_MI_TABS_WATERMARK_POSITION";
$modversion['config'][$i]['description'] = "_MI_TABS_WATERMARK_POSITION_DESC";
$modversion['config'][$i]['formtype'] = 'select';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = 'BR';
$modversion['config'][$i]['options'] = array(	
												_MI_TABS_WATERMARK_POSITION_TL => 'TL', 
												_MI_TABS_WATERMARK_POSITION_TR => 'TR', 
												_MI_TABS_WATERMARK_POSITION_BL => 'BL', 
												_MI_TABS_WATERMARK_POSITION_BR => 'BR', 
												_MI_TABS_WATERMARK_POSITION_MD => 'MD'
										);

$i++;
$modversion['config'][$i]['name'] = 'passkeyvalidfor';
$modversion['config'][$i]['title'] = "_MI_TABS_PASSKEY_VALIDFOR";
$modversion['config'][$i]['description'] = "_MI_TABS_PASSKEY_VALIDFOR_DESC";
$modversion['config'][$i]['formtype'] = 'select';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 10;
$modversion['config'][$i]['options'] = array(
												_MI_TABS_PASSKEY_VALIDFOR_2MIN => 2, 
												_MI_TABS_PASSKEY_VALIDFOR_4MIN => 4, 
												_MI_TABS_PASSKEY_VALIDFOR_6MIN => 6, 
												_MI_TABS_PASSKEY_VALIDFOR_8MIN => 8, 
												_MI_TABS_PASSKEY_VALIDFOR_10MIN => 10, 
												_MI_TABS_PASSKEY_VALIDFOR_15MIN => 15, 
												_MI_TABS_PASSKEY_VALIDFOR_20MIN => 20, 
												_MI_TABS_PASSKEY_VALIDFOR_30MIN => 30, 
												_MI_TABS_PASSKEY_VALIDFOR_60MIN => 60, 
												_MI_TABS_PASSKEY_VALIDFOR_120MIN => 120, 
												_MI_TABS_PASSKEY_VALIDFOR_240MIN => 240, 
												_MI_TABS_PASSKEY_VALIDFOR_360MIN => 360, 
												_MI_TABS_PASSKEY_VALIDFOR_480MIN => 480, 
												_MI_TABS_PASSKEY_VALIDFOR_600MIN => 600
										);

xoops_load('XoopsEditorHandler');
$editor_handler = XoopsEditorHandler::getInstance();
foreach ($editor_handler->getList(false) as $id => $val)
	$options[$val] = $id;
	
$i++;
$modversion['config'][$i]['name'] = 'editor';
$modversion['config'][$i]['title'] = "_MI_TABS_EDITOR";
$modversion['config'][$i]['description'] = "_MI_TABS_EDITOR_DESC";
$modversion['config'][$i]['formtype'] = 'select';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = 'tinymce';
$modversion['config'][$i]['options'] = $options;

$i++;
$modversion['config'][$i]['name'] = 'htaccess';
$modversion['config'][$i]['title'] = "_MI_TABS_HTACCESS";
$modversion['config'][$i]['description'] = "_MI_TABS_HTACCESS_DESC";
$modversion['config'][$i]['formtype'] = 'yesno';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = '0';

$i++;
$modversion['config'][$i]['name'] = 'baseofurl';
$modversion['config'][$i]['title'] = "_MI_TABS_HTACCESS_BASEOFURL";
$modversion['config'][$i]['description'] = "_MI_TABS_HTACCESS_BASEOFURL_DESC";
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = 'uitabs';

$i++;
$modversion['config'][$i]['name'] = 'endofurl';
$modversion['config'][$i]['title'] = "_MI_TABS_HTACCESS_ENDOFURL";
$modversion['config'][$i]['description'] = "_MI_TABS_HTACCESS_ENDOFURL_DESC";
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = '.html';

$i++;
$modversion['config'][$i]['name'] = 'effect';
$modversion['config'][$i]['title'] = "_MI_TABS_EFFECT";
$modversion['config'][$i]['description'] = "_MI_TABS_EFFECT_DESC";
$modversion['config'][$i]['formtype'] = 'select';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = 'default';
$modversion['config'][$i]['options'] = array(
												_MI_TABS_EFFECT_DEFAULT => 'default', 
												_MI_TABS_EFFECT_FADE => 'fade', 
												_MI_TABS_EFFECT_AJAX => 'ajax', 
												_MI_TABS_EFFECT_SLIDE => 'slide', 
												_MI_TABS_EFFECT_HORIZONTAL => 'horizontal'
										);
$i++;
$modversion['config'][$i]['name'] = 'event';
$modversion['config'][$i]['title'] = "_MI_TABS_EVENT";
$modversion['config'][$i]['description'] = "_MI_TABS_EVENT_DESC";
$modversion['config'][$i]['formtype'] = 'select';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = 'default';
$modversion['config'][$i]['options'] = array(
												_MI_TABS_EVENT_CLICK => 'click', 
												_MI_TABS_EVENT_MOUSEOVER => 'mouseover', 
												_MI_TABS_EVENT_DBLCLICK => 'dblclick'
												);
$i++;
$modversion['config'][$i]['name'] = 'fadeInSpeed';
$modversion['config'][$i]['title'] = "_MI_TABS_FADE_INSPEED";
$modversion['config'][$i]['description'] = "_MI_TABS_FADE_INSPEED_DESC";
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = '200';

$i++;
$modversion['config'][$i]['name'] = 'fadeOutSpeed';
$modversion['config'][$i]['title'] = "_MI_TABS_FADE_OUTSPEED";
$modversion['config'][$i]['description'] = "_MI_TABS_FADE_OUTSPEED_DESC";
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = '0';

$i++;
$modversion['config'][$i]['name'] = 'history';
$modversion['config'][$i]['title'] = "_MI_TABS_HISTORY";
$modversion['config'][$i]['description'] = "_MI_TABS_HISTORY_DESC";
$modversion['config'][$i]['formtype'] = 'select';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = 'false';
$modversion['config'][$i]['options'] = array(
												_MI_TABS_HISTORY_TRUE => 'true', 
												_MI_TABS_HISTORY_FALSE => 'false'

												);
$i++;
$modversion['config'][$i]['name'] = 'rotate';
$modversion['config'][$i]['title'] = "_MI_TABS_ROTATE";
$modversion['config'][$i]['description'] = "_MI_TABS_ROTATE_DESC";
$modversion['config'][$i]['formtype'] = 'select';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = 'false';
$modversion['config'][$i]['options'] = array(
												_MI_TABS_ROTATE_TRUE => 'true', 
												_MI_TABS_ROTATE_FALSE => 'false'

												);												
$i++;
$modversion['config'][$i]['name'] = 'default_class';
$modversion['config'][$i]['title'] = "_MI_TABS_DEFAULT_CLASS";
$modversion['config'][$i]['description'] = "_MI_TABS_DEFAULT_CLASS_DESC";
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = 'current';

$i++;
$modversion['config'][$i]['name'] = 'ul_class';
$modversion['config'][$i]['title'] = "_MI_TABS_UL_CLASS";
$modversion['config'][$i]['description'] = "_MI_TABS_UL_CLASS_DESC";
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = 'ul_uitabs';

$i++;
$modversion['config'][$i]['name'] = 'div_class';
$modversion['config'][$i]['title'] = "_MI_TABS_DIV_CLASS";
$modversion['config'][$i]['description'] = "_MI_TABS_DIV_CLASS_DESC";
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = 'div_uitabs';

$i++;
$modversion['config'][$i]['name'] = 'matrixstream';
$modversion['config'][$i]['title'] = "_MI_TABS_MATRIXSTREAM";
$modversion['config'][$i]['description'] = "_MI_TABS_MATRIXSTREAM_DESC";
$modversion['config'][$i]['formtype'] = 'yesno';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = '0';

$i++;
$modversion['config'][$i]['name'] = 'flowplayer';
$modversion['config'][$i]['title'] = "_MI_TABS_FLOWPLAYER";
$modversion['config'][$i]['description'] = "_MI_TABS_FLOWPLAYER_DESC";
$modversion['config'][$i]['formtype'] = 'yesno';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = '0';

$i++;
$modversion['config'][$i]['name'] = 'tags';
$modversion['config'][$i]['title'] = "_MI_TABS_TAGS";
$modversion['config'][$i]['description'] = "_MI_TABS_TAGS_DESC";
$modversion['config'][$i]['formtype'] = 'yesno';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = '0';

$i++;
$modversion['config'][$i]['name'] = 'force_jquery';
$modversion['config'][$i]['title'] = "_MI_TABS_FORCE_JQUERY";
$modversion['config'][$i]['description'] = "_MI_TABS_FORCE_JQUERY_DESC";
$modversion['config'][$i]['formtype'] = 'yesno';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = '0';
?>