<?php
/**
 * @file
 * @package leimg
 * @version $Id$
**/

if(!defined('XOOPS_ROOT_PATH'))
{
	exit;
}

if(!defined('LEIMG_TRUST_PATH'))
{
	define('LEIMG_TRUST_PATH',XOOPS_TRUST_PATH . '/modules/leimg');
}

require_once LEIMG_TRUST_PATH . '/class/LeimgUtils.class.php';

//
// Define a basic manifesto.
//
$modversion['name'] = _MI_LEIMG_LANG_LEIMG;
$modversion['version'] = 0.6;
$modversion['description'] = _MI_LEIMG_DESC_LEIMG;
$modversion['author'] = _MI_LEIMG_LANG_AUTHOR;
$modversion['credits'] = _MI_LEIMG_LANG_CREDITS;
$modversion['help'] = 'help.html';
$modversion['license'] = 'GPL';
$modversion['official'] = 0;
$modversion['image'] = 'images/module_icon.png';
$modversion['dirname'] = $myDirName;
$modversion['trust_dirname'] = 'leimg';
$modversion['role'] = 'image';

$modversion['cube_style'] = true;
$modversion['legacy_installer'] = array(
	'installer'   => array(
		'class' 	=> 'Installer',
		'namespace' => 'Leimg',
		'filepath'	=> LEIMG_TRUST_PATH . '/admin/class/installer/LeimgInstaller.class.php'
	),
	'uninstaller' => array(
		'class' 	=> 'Uninstaller',
		'namespace' => 'Leimg',
		'filepath'	=> LEIMG_TRUST_PATH . '/admin/class/installer/LeimgUninstaller.class.php'
	),
	'updater' => array(
		'class' 	=> 'Updater',
		'namespace' => 'Leimg',
		'filepath'	=> LEIMG_TRUST_PATH . '/admin/class/installer/LeimgUpdater.class.php'
	)
);
$modversion['disable_legacy_2nd_installer'] = false;

$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';
$modversion['tables'] = array(
//	  '{prefix}_{dirname}_xxxx',
##[cubson:tables]
	'{prefix}_{dirname}_image',
	'{prefix}_{dirname}_thumbnail',
##[/cubson:tables]
);

//
// Templates. You must never change [cubson] chunk to get the help of cubson.
//
$modversion['templates'] = array(
/*
	array(
		'file'		  => '{dirname}_xxx.html',
		'description' => _MI_LEIMG_TPL_XXX
	),
*/
##[cubson:templates]
		array('file' => '{dirname}_image_delete.html','description' => _MI_LEIMG_TPL_IMAGE_DELETE),
		array('file' => '{dirname}_image_edit.html','description' => _MI_LEIMG_TPL_IMAGE_EDIT),
		array('file' => '{dirname}_image_list.html','description' => _MI_LEIMG_TPL_IMAGE_LIST),
		array('file' => '{dirname}_image_view.html','description' => _MI_LEIMG_TPL_IMAGE_VIEW),
		array('file' => '{dirname}_thumbnail_delete.html','description' => _MI_LEIMG_TPL_THUMBNAIL_DELETE),
		array('file' => '{dirname}_thumbnail_edit.html','description' => _MI_LEIMG_TPL_THUMBNAIL_EDIT),
		array('file' => '{dirname}_thumbnail_remake.html','description' => 'Remake thumbnails'),
		array('file' => '{dirname}_thumbnail_list.html','description' => _MI_LEIMG_TPL_THUMBNAIL_LIST),
		array('file' => '{dirname}_blank_edit.html','description' => _MI_LEIMG_TPL_BLANK_EDIT),

##[/cubson:templates]
);

//
// Admin panel setting
//
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = 'admin/index.php?action=Index';
$modversion['adminmenu'] = array(
	array(
		'title'    => _MI_LEIMG_LANG_MENU_INDEX,
		'link'	   => 'admin/index.php?action=Index',
		'keywords' => _MI_LEIMG_KEYWORD_MENU_INDEX,
		'show'	   => true,
		'absolute' => false
	),
##[cubson:adminmenu]
##[/cubson:adminmenu]
);

//
// Public side control setting
//
$modversion['hasMain'] = 1;
$modversion['hasSearch'] = 0;
$modversion['sub'] = array(
/*
	array(
		'name' => _MI_LEIMG_LANG_SUB_XXX,
		'url'  => 'index.php?action=XXX'
	),
*/
##[cubson:submenu]
##[/cubson:submenu]
);

//
// Config setting
//
$modversion['config'] = array(
/*
	array(
		'name'			=> 'xxxx',
		'title' 		=> '_MI_LEIMG_TITLE_XXXX',
		'description'	=> '_MI_LEIMG_DESC_XXXX',
		'formtype'		=> 'xxxx',
		'valuetype' 	=> 'xxx',
		'options'		=> array(xxx => xxx,xxx => xxx),
		'default'		=> 0
	),
*/
	array(
		'name'			=> 'css_file' ,
		'title' 		=> "_MI_LEIMG_LANG_CSS_FILE" ,
		'description'	=> "_MI_LEIMG_DESC_CSS_FILE" ,
		'formtype'		=> 'textbox' ,
		'valuetype' 	=> 'text' ,
		'default'		=> '/modules/'.$myDirName.'/style.css',
		'options'		=> array()
	) ,
	array(
		'name'			=> 'max_size' ,
		'title' 		=> "_MI_LEIMG_LANG_MAX_SIZE" ,
		'description'	=> "_MI_LEIMG_DESC_MAX_SIZE" ,
		'formtype'		=> 'textbox' ,
		'valuetype' 	=> 'int' ,
		'default'		=> '500000',
		'options'		=> array()
	) ,
##[cubson:config]
##[/cubson:config]
);

//
// Block setting
//
$modversion['blocks'] = array(
/*
	x => array(
		'func_num'			=> x,
		'file'				=> 'xxxBlock.class.php',
		'class' 			=> 'xxx',
		'name'				=> _MI_LEIMG_BLOCK_NAME_xxx,
		'description'		=> _MI_LEIMG_BLOCK_DESC_xxx,
		'options'			=> '',
		'template'			=> '{dirname}_block_xxx.html',
		'show_all_module'	=> true,
		'visible_any'		=> true
	),
*/
##[cubson:block]
##[/cubson:block]
);

?>
