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

require_once LEIMG_TRUST_PATH . '/class/AbstractEditAction.class.php';

/**
 * Leimg_ImageEditAction
**/
class Leimg_ImageEditAction extends Leimg_AbstractEditAction
{
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
	 * _setupActionForm
	 * 
	 * @param	void
	 * 
	 * @return	void
	**/
	protected function _setupActionForm()
	{
		$this->mActionForm =& $this->mAsset->getObject('form', 'Image',false,'edit');
		$this->mActionForm->prepare();
	}

	/**
	 * prepare
	 * 
	 * @param	void
	 * 
	 * @return	bool
	**/
	public function prepare()
	{
		parent::prepare();
		if($this->mObject->isNew()){
			if($this->mRoot->mContext->mUser->isInRole('Site.RegisteredUser')){
				$this->mObject->set('uid', $this->mRoot->mContext->mXoopsUser->get('uid'));
			}
		}
		return true;
	}

	/**
	 * executeViewInput
	 * 
	 * @param	XCube_RenderTarget	&$render
	 * 
	 * @return	void
	**/
	public function executeViewInput(/*** XCube_RenderTarget ***/ &$render)
	{
		$render->setTemplateName($this->mAsset->mDirname . '_image_edit.html');
		$render->setAttribute('actionForm', $this->mActionForm);
		$render->setAttribute('object', $this->mObject);
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
		$this->mRoot->mController->executeForward($this->_getNextUri('image'));
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
		$this->mRoot->mController->executeRedirect($this->_getNextUri('image'), 1, _MD_LEIMG_ERROR_DBUPDATE_FAILED);
	}

	/**
	 * executeViewCancel
	 * 
	 * @param	XCube_RenderTarget	&$render
	 * 
	 * @return	void
	**/
	public function executeViewCancel(/*** XCube_RenderTarget ***/ &$render)
	{
		$this->mRoot->mController->executeForward($this->_getNextUri('image'));
	}
}

?>
