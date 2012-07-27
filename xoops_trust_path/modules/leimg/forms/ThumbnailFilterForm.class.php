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

require_once LEIMG_TRUST_PATH . '/class/AbstractFilterForm.class.php';

define('LEIMG_THUMBNAIL_SORT_KEY_THUMBNAIL_ID', 1);
define('LEIMG_THUMBNAIL_SORT_KEY_DIRNAME', 2);
define('LEIMG_THUMBNAIL_SORT_KEY_DATANAME', 3);
define('LEIMG_THUMBNAIL_SORT_KEY_MAX_WIDTH', 4);
define('LEIMG_THUMBNAIL_SORT_KEY_MAX_HEIGHT', 5);
define('LEIMG_THUMBNAIL_SORT_KEY_FILE_TYPE', 6);
define('LEIMG_THUMBNAIL_SORT_KEY_TSIZE', 7);

define('LEIMG_THUMBNAIL_SORT_KEY_DEFAULT', LEIMG_THUMBNAIL_SORT_KEY_THUMBNAIL_ID);

/**
 * Leimg_ThumbnailFilterForm
**/
class Leimg_ThumbnailFilterForm extends Leimg_AbstractFilterForm
{
	public /*** string[] ***/ $mSortKeys = array(
 	   LEIMG_THUMBNAIL_SORT_KEY_THUMBNAIL_ID => 'thumbnail_id',
 	   LEIMG_THUMBNAIL_SORT_KEY_DIRNAME => 'dirname',
 	   LEIMG_THUMBNAIL_SORT_KEY_DATANAME => 'dataname',
 	   LEIMG_THUMBNAIL_SORT_KEY_MAX_WIDTH => 'max_width',
 	   LEIMG_THUMBNAIL_SORT_KEY_MAX_HEIGHT => 'max_height',
 	   LEIMG_THUMBNAIL_SORT_KEY_FILE_TYPE => 'file_type',
 	   LEIMG_THUMBNAIL_SORT_KEY_TSIZE => 'tsize',

	);

	/**
	 * getDefaultSortKey
	 * 
	 * @param	void
	 * 
	 * @return	void
	**/
	public function getDefaultSortKey()
	{
		return LEIMG_THUMBNAIL_SORT_KEY_DEFAULT;
	}

	/**
	 * fetch
	 * 
	 * @param	void
	 * 
	 * @return	void
	**/
	public function fetch()
	{
		parent::fetch();
	
		$root =& XCube_Root::getSingleton();
	
		if (($value = $root->mContext->mRequest->getRequest('thumbnail_id')) !== null) {
			$this->mNavi->addExtra('thumbnail_id', $value);
			$this->_mCriteria->add(new Criteria('thumbnail_id', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('dirname')) !== null) {
			$this->mNavi->addExtra('dirname', $value);
			$this->_mCriteria->add(new Criteria('dirname', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('dataname')) !== null) {
			$this->mNavi->addExtra('dataname', $value);
			$this->_mCriteria->add(new Criteria('dataname', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('max_width')) !== null) {
			$this->mNavi->addExtra('max_width', $value);
			$this->_mCriteria->add(new Criteria('max_width', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('max_height')) !== null) {
			$this->mNavi->addExtra('max_height', $value);
			$this->_mCriteria->add(new Criteria('max_height', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('file_type')) !== null) {
			$this->mNavi->addExtra('file_type', $value);
			$this->_mCriteria->add(new Criteria('file_type', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('tsize')) !== null) {
			$this->mNavi->addExtra('tsize', $value);
			$this->_mCriteria->add(new Criteria('tsize', $value));
		}

	
		$this->_mCriteria->addSort($this->getSort(), $this->getOrder());
	}
}

?>
