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

require_once XOOPS_TRUST_PATH . '/modules/leimg/preload/AssetPreload.class.php';
Leimg_AssetPreloadBase::prepare(basename(dirname(dirname(__FILE__))));

?>
