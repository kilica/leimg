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

require_once LEIMG_TRUST_PATH . '/class/AbstractViewAction.class.php';

/**
 * Leimg_ImageViewAction
**/
class Leimg_ImageViewAction extends Leimg_AbstractViewAction
{
	/**
	 * _getId
	 * 
	**/
	protected function _getId()
	{
		return $this->mRoot->mContext->mRequest->getRequest('image_id');
	}

	/**
	 * &_getHandler
	 * 
	 * @param	void
	 * 
	 * @return	Leimg_ImageHandler
	**/
	protected function &_getHandler()
	{
		$handler =& $this->mAsset->getObject('handler', 'Image');
		return $handler;
	}

	/**
	 * executeViewSuccess
	 * 
	 * @param	XCube_RenderTarget	&$render
	 * 
	 * @return	void
	**/
	public function executeViewSuccess(/*** XCube_RenderTarget ***/ &$render)
	{
		$render->setTemplateName($this->mAsset->mDirname . '_image_view.html');
		$render->setAttribute('object', $this->mObject);
	}

	/**
	 * executeViewError
	 * 
	 * @param	XCube_RenderTarget	&$render
	 * 
	 * @return	void
	**/
	public function executeViewError(/*** XCube_RenderTarget ***/ &$render)
	{
		$this->mRoot->mController->executeRedirect($this->_getNextUri('image', 'list'), 1, _MD_LEIMG_ERROR_CONTENT_IS_NOT_FOUND);
	}
}

?>
