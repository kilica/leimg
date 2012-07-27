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

define('LEIMG_IMAGE_SORT_KEY_IMAGE_ID', 1);
define('LEIMG_IMAGE_SORT_KEY_TITLE', 2);
define('LEIMG_IMAGE_SORT_KEY_UID', 3);
define('LEIMG_IMAGE_SORT_KEY_DIRNAME', 4);
define('LEIMG_IMAGE_SORT_KEY_DATANAME', 5);
define('LEIMG_IMAGE_SORT_KEY_DATA_ID', 6);
define('LEIMG_IMAGE_SORT_KEY_NUM', 7);
define('LEIMG_IMAGE_SORT_KEY_FILE_NAME', 8);
define('LEIMG_IMAGE_SORT_KEY_FILE_TYPE', 9);
define('LEIMG_IMAGE_SORT_KEY_IMAGE_WIDTH', 10);
define('LEIMG_IMAGE_SORT_KEY_IMAGE_HEIGHT', 11);
define('LEIMG_IMAGE_SORT_KEY_POSTTIME', 12);

define('LEIMG_IMAGE_SORT_KEY_DEFAULT', LEIMG_IMAGE_SORT_KEY_IMAGE_ID);

/**
 * Leimg_ImageFilterForm
**/
class Leimg_ImageFilterForm extends Leimg_AbstractFilterForm
{
	public /*** string[] ***/ $mSortKeys = array(
 	   LEIMG_IMAGE_SORT_KEY_IMAGE_ID => 'image_id',
 	   LEIMG_IMAGE_SORT_KEY_TITLE => 'title',
 	   LEIMG_IMAGE_SORT_KEY_UID => 'uid',
 	   LEIMG_IMAGE_SORT_KEY_DIRNAME => 'dirname',
 	   LEIMG_IMAGE_SORT_KEY_DATANAME => 'dataname',
 	   LEIMG_IMAGE_SORT_KEY_DATA_ID => 'data_id',
 	   LEIMG_IMAGE_SORT_KEY_NUM => 'num',
 	   LEIMG_IMAGE_SORT_KEY_FILE_NAME => 'file_name',
 	   LEIMG_IMAGE_SORT_KEY_FILE_TYPE => 'file_type',
 	   LEIMG_IMAGE_SORT_KEY_IMAGE_WIDTH => 'image_width',
 	   LEIMG_IMAGE_SORT_KEY_IMAGE_HEIGHT => 'image_height',
 	   LEIMG_IMAGE_SORT_KEY_POSTTIME => 'posttime',

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
		return LEIMG_IMAGE_SORT_KEY_DEFAULT;
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
	
		if (($value = $root->mContext->mRequest->getRequest('image_id')) !== null) {
			$this->mNavi->addExtra('image_id', $value);
			$this->_mCriteria->add(new Criteria('image_id', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('title')) !== null) {
			$this->mNavi->addExtra('title', $value);
			$this->_mCriteria->add(new Criteria('title', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('uid')) !== null) {
			$this->mNavi->addExtra('uid', $value);
			$this->_mCriteria->add(new Criteria('uid', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('dirname')) !== null) {
			$this->mNavi->addExtra('dirname', $value);
			$this->_mCriteria->add(new Criteria('dirname', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('dataname')) !== null) {
			$this->mNavi->addExtra('dataname', $value);
			$this->_mCriteria->add(new Criteria('dataname', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('data_id')) !== null) {
			$this->mNavi->addExtra('data_id', $value);
			$this->_mCriteria->add(new Criteria('data_id', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('num')) !== null) {
			$this->mNavi->addExtra('num', $value);
			$this->_mCriteria->add(new Criteria('num', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('file_name')) !== null) {
			$this->mNavi->addExtra('file_name', $value);
			$this->_mCriteria->add(new Criteria('file_name', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('file_type')) !== null) {
			$this->mNavi->addExtra('file_type', $value);
			$this->_mCriteria->add(new Criteria('file_type', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('image_width')) !== null) {
			$this->mNavi->addExtra('image_width', $value);
			$this->_mCriteria->add(new Criteria('image_width', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('image_height')) !== null) {
			$this->mNavi->addExtra('image_height', $value);
			$this->_mCriteria->add(new Criteria('image_height', $value));
		}
		if (($value = $root->mContext->mRequest->getRequest('posttime')) !== null) {
			$this->mNavi->addExtra('posttime', $value);
			$this->_mCriteria->add(new Criteria('posttime', $value));
		}

	
		$this->_mCriteria->addSort($this->getSort(), $this->getOrder());
	}
}

?>
