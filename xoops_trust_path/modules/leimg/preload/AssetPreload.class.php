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

/**
 * Leimg_AssetPreloadBase
**/
class Leimg_AssetPreloadBase extends XCube_ActionFilter
{
	public $mDirname = null;

	/**
	 * prepare
	 * 
	 * @param	string	$dirname
	 * 
	 * @return	void
	**/
	public static function prepare(/*** string ***/ $dirname)
	{
		static $setupCompleted = false;
		if(!$setupCompleted)
		{
			$setupCompleted = self::_setup($dirname);
		}
	}

	/**
	 * _setup
	 * 
	 * @param	string	$dirname
	 * 
	 * @return	bool
	**/
	public static function _setup($dirname)
	{
		$root =& XCube_Root::getSingleton();
		$instance = new self($root->mController);
        $instance->mDirname = $dirname;
		$root->mController->addActionFilter($instance);
		return true;
	}

	/**
	 * preBlockFilter
	 * 
	 * @param	void
	 * 
	 * @return	void
	**/
	public function preBlockFilter()
	{
		$this->mRoot->mDelegateManager->add('Module.leimg.Global.Event.GetAssetManager','Leimg_AssetPreloadBase::getManager');
		$this->mRoot->mDelegateManager->add('Legacy_Utils.CreateModule','Leimg_AssetPreloadBase::getModule');
		$this->mRoot->mDelegateManager->add('Legacy_Utils.CreateBlockProcedure','Leimg_AssetPreloadBase::getBlock');
	
		$file = LEIMG_TRUST_PATH . '/class/DelegateFunctions.class.php';
		$this->mRoot->mDelegateManager->add('Module.'.$this->mDirname.'.Global.Event.GetNormalUri','Leimg_CoolUriDelegate::getNormalUri', $file);
	
		if(! defined('LEGACY_IMAGE_DUMMY_EXT')){
			define('LEGACY_IMAGE_DUMMY_EXT', 'gif');
		}
	}

	/**
	 * getManager
	 * 
	 * @param	Leimg_AssetManager	&$obj
	 * @param	string	$dirname
	 * 
	 * @return	void
	**/
	public static function getManager(/*** Leimg_AssetManager ***/ &$obj,/*** string ***/ $dirname)
	{
		require_once LEIMG_TRUST_PATH . '/class/AssetManager.class.php';
		$obj = Leimg_AssetManager::getInstance($dirname);
	}

	/**
	 * getModule
	 * 
	 * @param	Legacy_AbstractModule  &$obj
	 * @param	XoopsModule  $module
	 * 
	 * @return	void
	**/
	public static function getModule(/*** Legacy_AbstractModule ***/ &$obj,/*** XoopsModule ***/ $module)
	{
		if($module->getInfo('trust_dirname') == 'leimg')
		{
			require_once LEIMG_TRUST_PATH . '/class/Module.class.php';
			$obj = new Leimg_Module($module);
		}
	}

	/**
	 * getBlock
	 * 
	 * @param	Legacy_AbstractBlockProcedure  &$obj
	 * @param	XoopsBlock	$block
	 * 
	 * @return	void
	**/
	public static function getBlock(/*** Legacy_AbstractBlockProcedure ***/ &$obj,/*** XoopsBlock ***/ $block)
	{
		$moduleHandler =& Leimg_Utils::getXoopsHandler('module');
		$module =& $moduleHandler->get($block->get('mid'));
		if(is_object($module) && $module->getInfo('trust_dirname') == 'leimg')
		{
			require_once LEIMG_TRUST_PATH . '/blocks/' . $block->get('func_file');
			$className = 'Leimg_' . substr($block->get('show_func'), 4);
			$obj = new $className($block);
		}
	}
}

?>
