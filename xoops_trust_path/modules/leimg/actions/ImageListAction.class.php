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
 * Leimg_ImageListAction
**/
class Leimg_ImageListAction extends Leimg_AbstractListAction
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
	 * &_getFilterForm
	 * 
	 * @param	void
	 * 
	 * @return	Leimg_ImageFilterForm
	**/
	protected function &_getFilterForm()
	{
		$filter =& $this->mAsset->getObject('filter', 'Image',false);
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
		return './index.php?action=ImageList';
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
		$this->mFilter =& $this->_getFilterForm();
		$this->mFilter->fetch();
	
		$handler =& $this->_getHandler();
		$criteria=$this->mFilter->getCriteria();
	
		$this->mObjects = $handler->getObjects($criteria);
	
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
		$render->setTemplateName($this->mAsset->mDirname . '_image_list.html');
		#cubson::lazy_load_array('image', $this->mObjects);
		$render->setAttribute('objects', $this->mObjects);
		$render->setAttribute('dirname', $this->mAsset->mDirname);
		$render->setAttribute('dataname', 'image');
		$render->setAttribute('pageNavi', $this->mFilter->mNavi);
	}
}

?>
