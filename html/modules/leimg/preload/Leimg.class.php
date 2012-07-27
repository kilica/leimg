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

if(!defined('LEGACY_IMAGE_DIRNAME'))
{
	define('LEGACY_IMAGE_DIRNAME', basename(dirname(dirname(__FILE__))));
}

Leimg_Image::prepare();


/**
 * Leimg_Image
**/
class Leimg_Image extends XCube_ActionFilter
{
	/**
	 * prepare
	 * 
	 * @param	void
	 * 
	 * @return	void
	**/
	public static function prepare()
	{
		$root =& XCube_Root::getSingleton();
		$instance = new Leimg_Image($root->mController);
		$root->mController->addActionFilter($instance);
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
		$file = LEIMG_TRUST_PATH . '/class/ImageDelegateFunctions.class.php';
		$this->mRoot->mDelegateManager->add('Legacy_Image.CreateImageObject','Leimg_ImageDelegate::createImageObject', $file);
		$this->mRoot->mDelegateManager->add('Legacy_Image.SaveImage','Leimg_ImageDelegate::saveImage', $file);
		$this->mRoot->mDelegateManager->add('Legacy_Image.DeleteImage','Leimg_ImageDelegate::deleteImage', $file);
		$this->mRoot->mDelegateManager->add('Legacy_Image.GetImageObjects','Leimg_ImageDelegate::getImageObjects', $file);
	}
}

?>
