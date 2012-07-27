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
 * Leimg_BlankEditAction
**/
class Leimg_ThumbnailRemakeAction extends Leimg_AbstractEditAction
{
	/**
	 * get target dirname
	 * 
	 * @param	void
	 * 
	 * @return	int
	**/
	protected function _getTargetDirname()
	{
		return $this->mRoot->mContext->mRequest->getRequest('dirname');
	}

	/**
	 * get target dataname
	 * 
	 * @param	void
	 * 
	 * @return	int
	**/
	protected function _getTargetDataname()
	{
		return $this->mRoot->mContext->mRequest->getRequest('dataname');
	}

	/**
	 * &_getHandler
	 * 
	 * @param	void
	 * 
	 * @return	Leimg_ThumbnailHandler
	**/
	protected function &_getHandler()
	{
		$handler =& $this->mAsset->getObject('handler', 'Thumbnail');
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
		$this->mActionForm =& $this->mAsset->getObject('form', 'Thumbnail', false, 'remake');
		$this->mActionForm->prepare();
		$this->mActionForm->set('dirname', $this->_getTargetDirname());
		$this->mActionForm->set('dataname', $this->_getTargetDataname());
	}

	/**
	 * _setupObject
	 * 
	 * @param	void
	 * 
	 * @return	void
	**/
	protected function _setupObject()
	{
		$this->mObjectHandler =& $this->_getHandler();
	}

	/**
	 * getDefaultView
	 * 
	 * @param	void
	 * 
	 * @return	Enum
	**/
	public function getDefaultView()
	{
		return LEIMG_FRAME_VIEW_INPUT;
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
		$render->setTemplateName($this->mAsset->mDirname . '_thumbnail_remake.html');
		$render->setAttribute('actionForm', $this->mActionForm);
		$render->setAttribute('dirname', $this->mAsset->mDirname);
		$render->setAttribute('target_dirname', $this->_getTargetDirname());
		$render->setAttribute('target_dataname', $this->_getTargetDataname());
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
		$this->mRoot->mController->executeForward(Legacy_Utils::renderUri($this->mAsset->mDirname));
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
		$this->mRoot->mController->executeRedirect(Legacy_Utils::renderUri($this->mAsset->mDirname), 1, _MD_LEIMG_ERROR_DBUPDATE_FAILED);
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
		$this->mRoot->mController->executeForward(Legacy_Utils::renderUri($this->mAsset->mDirname));
	}

	/**
	 * execute
	 * 
	 * @param	void
	 * 
	 * @return	Enum
	**/
	public function execute()
	{
		if ($this->mRoot->mContext->mRequest->getRequest('_form_control_cancel') != null)
		{
			return LEIMG_FRAME_VIEW_CANCEL;
		}
	
		$this->mActionForm->validate();
		if ($this->mActionForm->hasError())
		{
			return LEIMG_FRAME_VIEW_INPUT;
		}
		return $this->_doExecute();
	}

	protected function _doExecute()
	{
		$cri = new CriteriaCompo();
		$cri->add(new Criteria('dirname', $this->mActionForm->get('dirname')));
		$cri->add(new Criteria('dataname', $this->mActionForm->get('dataname')));
		$images = Legacy_Utils::getModuleHandler('image', $this->mAsset->mDirname)->getObjects($cri);
		foreach($images as $image){
			//create thumbnails
			$this->mObjectHandler->createThumbnails($image);
		}
		return LEIMG_FRAME_VIEW_SUCCESS;
	}
}

?>
