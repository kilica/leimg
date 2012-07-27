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

require_once LEIMG_TRUST_PATH . '/class/AbstractListAction.class.php';

/**
 * Leimg_ThumbnailListAction
**/
class Leimg_ThumbnailListAction extends Leimg_AbstractListAction
{
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
	 * &_getFilterForm
	 * 
	 * @param	void
	 * 
	 * @return	Leimg_ThumbnailFilterForm
	**/
	protected function &_getFilterForm()
	{
		$filter =& $this->mAsset->getObject('filter', 'Thumbnail',false);
		$filter->prepare($this->_getPageNavi(), $this->_getHandler());
		return $filter;
	}

	/**
	 * _getBaseUrl
	 * 
	 * @param	void
	 * 
	 * @return	string
	**/
	protected function _getBaseUrl()
	{
		return Legacy_Utils::renderUri($this->mAsset->mDirname, 'thumbnail');
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

		return true;
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
		//$this->mFilter =& $this->_getFilterForm();
		//$this->mFilter->fetch();
		//$cri = $this->mFilter->getCriteria();
	
		//get Image client module list
		$list = array();
		XCube_DelegateUtils::call('Legacy_ImageClient.GetClientList', new XCube_Ref($list), $this->mAsset->mDirname);
		foreach($list as $client){
			$cri = new CriteriaCompo();
			$cri->add(new Criteria('dirname', $client['dirname']));
			$cri->add(new Criteria('dataname', $client['dataname']));
			$cri->setSort('tsize', 'ASC');
			$this->mObjects['dirname'][] = $client['dirname'];
			$this->mObjects['dataname'][] = $client['dataname'];
			$this->mObjects['object'][] = $this->_getHandler()->getObjects($cri);
		}
	
		return LEIMG_FRAME_VIEW_INDEX;
	}

	/**
	 * executeViewIndex
	 * 
	 * @param	XCube_RenderTarget	&$render
	 * 
	 * @return	void
	**/
	public function executeViewIndex(/*** XCube_RenderTarget ***/ &$render)
	{
		$render->setTemplateName($this->mAsset->mDirname . '_thumbnail_list.html');
	
		$render->setAttribute('clientList', $this->mObjects);
		$render->setAttribute('dirname', $this->mAsset->mDirname);
		$render->setAttribute('dataname', 'thumbnail');
		//$render->setAttribute('pageNavi', $this->mFilter->mNavi);
	}
}

?>
