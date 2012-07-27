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
 * Leimg_ThumbnailEditAction
**/
class Leimg_ThumbnailEditAction extends Leimg_AbstractEditAction
{
	/**
	 * _getId
	 * 
	 * @param	void
	 * 
	 * @return	int
	**/
	protected function _getId()
	{
		return $this->mRoot->mContext->mRequest->getRequest('thumbnail_id');
	}

	/**
	 * _getTitle
	 * 
	 * @param	void
	 * 
	 * @return	string
	**/
	protected function _getTitle()
	{
		return _MD_LEIMG_LANG_THUMBNAIL;
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
		$this->mActionForm =& $this->mAsset->getObject('form', 'Thumbnail',false,'edit');
		$this->mActionForm->prepare();
	}

	/**
	 * hasPermission
	 * 
	 * @param	void
	 * 
	 * @return	bool
	**/
	public function hasPermission()
	{
		return $this->mRoot->mContext->mUser->isInRole('Site.Owner') ? true : false;
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
			$dirname = $this->mRoot->mContext->mRequest->getRequest('dirname');
			$dataname = $this->mRoot->mContext->mRequest->getRequest('dataname');
			if(! $dirname || ! $dataname){
				$this->mRoot->mController->executeRedirect($this->_getNextUri('thumbnail'), 1, _MD_LEIMG_ERROR_DIRNAME_DATANAME_REQUIRED);
			}
			//set requested values
			$this->mObject->set('dirname', $dirname);
			$this->mObject->set('dataname', $dataname);
			//set tsize
			$cri = new CriteriaCompo();
			$cri->add(new Criteria('dirname', $dirname));
			$cri->add(new Criteria('dataname', $dataname));
			$cri->setSort('tsize', 'DESC');
			$objs = $this->mObjectHandler->getObjects($cri, 1, 0);
			$tsize = (count($objs)>0) ? $objs[0]->get('tsize') +1 : 1;
			$this->mObject->set('tsize', $tsize);
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
		$render->setTemplateName($this->mAsset->mDirname . '_thumbnail_edit.html');
		$render->setAttribute('actionForm', $this->mActionForm);
		$render->setAttribute('object', $this->mObject);
		$render->setAttribute('dirname', $this->mAsset->mDirname);
	
		//get Image client module list
		//$clients = $this->mRoot->mContext->getAttribute('client_modules');
		//$render->setAttribute('clientList', $clients['image']);
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
		$this->mRoot->mController->executeForward($this->_getNextUri('thumbnail', 'list'));
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
		$this->mRoot->mController->executeRedirect($this->_getNextUri('thumbnail'), 1, _MD_LEIMG_ERROR_DBUPDATE_FAILED);
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
		$this->mRoot->mController->executeForward($this->_getNextUri('thumbnail', 'list'));
	}
}

?>
