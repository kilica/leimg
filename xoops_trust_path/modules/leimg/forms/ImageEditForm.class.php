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

require_once XOOPS_ROOT_PATH . '/core/XCube_ActionForm.class.php';
require_once XOOPS_MODULE_PATH . '/legacy/class/Legacy_Validator.class.php';

/**
 * Leimg_ImageEditForm
**/
class Leimg_ImageEditForm extends XCube_ActionForm
{
	/**
	 * getTokenName
	 * 
	 * @param	void
	 * 
	 * @return	string
	**/
	public function getTokenName()
	{
		return "module.leimg.ImageEditForm.TOKEN";
	}

	/**
	 * prepare
	 * 
	 * @param	void
	 * 
	 * @return	void
	**/
	public function prepare()
	{
		//
		// Set form properties
		//
		$this->mFormProperties['image_id'] = new XCube_IntProperty('image_id');
		$this->mFormProperties['title'] = new XCube_StringProperty('title');
		$this->mFormProperties['uid'] = new XCube_IntProperty('uid');
		$this->mFormProperties['dirname'] = new XCube_StringProperty('dirname');
		$this->mFormProperties['dataname'] = new XCube_StringProperty('dataname');
		$this->mFormProperties['data_id'] = new XCube_IntProperty('data_id');
		$this->mFormProperties['num'] = new XCube_IntProperty('num');
		$this->mFormProperties['file_name'] = new XCube_StringProperty('file_name');
		$this->mFormProperties['file_type'] = new XCube_IntProperty('file_type');
		$this->mFormProperties['image_width'] = new XCube_IntProperty('image_width');
		$this->mFormProperties['image_height'] = new XCube_IntProperty('image_height');
		$this->mFormProperties['posttime'] = new XCube_IntProperty('posttime');

	
		//
		// Set field properties
		//
		$this->mFieldProperties['image_id'] = new XCube_FieldProperty($this);
$this->mFieldProperties['image_id']->setDependsByArray(array('required'));
$this->mFieldProperties['image_id']->addMessage('required', _MD_LEIMG_ERROR_REQUIRED, _MD_LEIMG_LANG_IMAGE_ID);
		$this->mFieldProperties['title'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['title']->setDependsByArray(array('required','maxlength'));
		$this->mFieldProperties['title']->addMessage('required', _MD_LEIMG_ERROR_REQUIRED, _MD_LEIMG_LANG_TITLE);
		$this->mFieldProperties['title']->addMessage('maxlength', _MD_LEIMG_ERROR_MAXLENGTH, _MD_LEIMG_LANG_TITLE, '255');
		$this->mFieldProperties['title']->addVar('maxlength', '255');
		$this->mFieldProperties['uid'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['dirname'] = new XCube_FieldProperty($this);
$this->mFieldProperties['dirname']->setDependsByArray(array('required'));
$this->mFieldProperties['dirname']->addMessage('required', _MD_LEIMG_ERROR_REQUIRED, _MD_LEIMG_LANG_DIRNAME);
		$this->mFieldProperties['dataname'] = new XCube_FieldProperty($this);
$this->mFieldProperties['dataname']->setDependsByArray(array('required'));
$this->mFieldProperties['dataname']->addMessage('required', _MD_LEIMG_ERROR_REQUIRED, _MD_LEIMG_LANG_DATANAME);
		$this->mFieldProperties['data_id'] = new XCube_FieldProperty($this);
$this->mFieldProperties['data_id']->setDependsByArray(array('required'));
$this->mFieldProperties['data_id']->addMessage('required', _MD_LEIMG_ERROR_REQUIRED, _MD_LEIMG_LANG_DATA_ID);
		$this->mFieldProperties['num'] = new XCube_FieldProperty($this);
$this->mFieldProperties['num']->setDependsByArray(array('required'));
$this->mFieldProperties['num']->addMessage('required', _MD_LEIMG_ERROR_REQUIRED, _MD_LEIMG_LANG_NUM);
		$this->mFieldProperties['file_name'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['file_name']->setDependsByArray(array('required','maxlength'));
		$this->mFieldProperties['file_name']->addMessage('required', _MD_LEIMG_ERROR_REQUIRED, _MD_LEIMG_LANG_FILE_NAME);
		$this->mFieldProperties['file_name']->addMessage('maxlength', _MD_LEIMG_ERROR_MAXLENGTH, _MD_LEIMG_LANG_FILE_NAME, '60');
		$this->mFieldProperties['file_name']->addVar('maxlength', '60');
		$this->mFieldProperties['file_type'] = new XCube_FieldProperty($this);
$this->mFieldProperties['file_type']->setDependsByArray(array('required'));
$this->mFieldProperties['file_type']->addMessage('required', _MD_LEIMG_ERROR_REQUIRED, _MD_LEIMG_LANG_FILE_TYPE);
		$this->mFieldProperties['image_width'] = new XCube_FieldProperty($this);
$this->mFieldProperties['image_width']->setDependsByArray(array('required'));
$this->mFieldProperties['image_width']->addMessage('required', _MD_LEIMG_ERROR_REQUIRED, _MD_LEIMG_LANG_IMAGE_WIDTH);
		$this->mFieldProperties['image_height'] = new XCube_FieldProperty($this);
$this->mFieldProperties['image_height']->setDependsByArray(array('required'));
$this->mFieldProperties['image_height']->addMessage('required', _MD_LEIMG_ERROR_REQUIRED, _MD_LEIMG_LANG_IMAGE_HEIGHT);
		$this->mFieldProperties['posttime'] = new XCube_FieldProperty($this);
	}

	/**
	 * load
	 * 
	 * @param	XoopsSimpleObject  &$obj
	 * 
	 * @return	void
	**/
	public function load(/*** XoopsSimpleObject ***/ &$obj)
	{
		$this->set('image_id', $obj->get('image_id'));
		$this->set('title', $obj->get('title'));
		$this->set('uid', $obj->get('uid'));
		$this->set('dirname', $obj->get('dirname'));
		$this->set('dataname', $obj->get('dataname'));
		$this->set('data_id', $obj->get('data_id'));
		$this->set('num', $obj->get('num'));
		$this->set('file_name', $obj->get('file_name'));
		$this->set('file_type', $obj->get('file_type'));
		$this->set('image_width', $obj->get('image_width'));
		$this->set('image_height', $obj->get('image_height'));
		$this->set('posttime', $obj->get('posttime'));

	}

	/**
	 * update
	 * 
	 * @param	XoopsSimpleObject  &$obj
	 * 
	 * @return	void
	**/
	public function update(/*** XoopsSimpleObject ***/ &$obj)
	{
		$obj->set('title', $this->get('title'));
		$obj->set('dirname', $this->get('dirname'));
		$obj->set('dataname', $this->get('dataname'));
		$obj->set('data_id', $this->get('data_id'));
		$obj->set('num', $this->get('num'));
		$obj->set('file_name', $this->get('file_name'));
		$obj->set('file_type', $this->get('file_type'));
		$obj->set('image_width', $this->get('image_width'));
		$obj->set('image_height', $this->get('image_height'));

	}

	/**
	 * _makeUnixtime
	 * 
	 * @param	string	$key
	 * 
	 * @return	void
	**/
	protected function _makeUnixtime($key)
	{
		$timeArray = explode('-', $this->get($key));
		return mktime(0, 0, 0, $timeArray[1], $timeArray[2], $timeArray[0]);
	}
}

?>
