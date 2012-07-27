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
 * Leimg_ThumbnailEditForm
**/
class Leimg_ThumbnailEditForm extends XCube_ActionForm
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
		return "module.leimg.ThumbnailEditForm.TOKEN";
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
		$this->mFormProperties['thumbnail_id'] = new XCube_IntProperty('thumbnail_id');
		$this->mFormProperties['dirname'] = new XCube_StringProperty('dirname');
		$this->mFormProperties['dataname'] = new XCube_StringProperty('dataname');
		$this->mFormProperties['max_width'] = new XCube_IntProperty('max_width');
		$this->mFormProperties['max_height'] = new XCube_IntProperty('max_height');
		$this->mFormProperties['file_type'] = new XCube_IntProperty('file_type');
		$this->mFormProperties['tsize'] = new XCube_IntProperty('tsize');
	
		$this->mFormProperties['dataset'] = new XCube_StringProperty('dataset');
	
		//
		// Set field properties
		//
		$this->mFieldProperties['thumbnail_id'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['dirname'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['dataname'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['max_width'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['max_width']->setDependsByArray(array('required'));
		$this->mFieldProperties['max_width']->addMessage('required', _MD_LEIMG_ERROR_REQUIRED, _MD_LEIMG_LANG_MAX_WIDTH);
		$this->mFieldProperties['max_height'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['max_height']->setDependsByArray(array('required'));
		$this->mFieldProperties['max_height']->addMessage('required', _MD_LEIMG_ERROR_REQUIRED, _MD_LEIMG_LANG_MAX_HEIGHT);
		$this->mFieldProperties['file_type'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['file_type']->setDependsByArray(array('required'));
		$this->mFieldProperties['file_type']->addMessage('required', _MD_LEIMG_ERROR_REQUIRED, _MD_LEIMG_LANG_FILE_TYPE);
		$this->mFieldProperties['tsize'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['tsize']->setDependsByArray(array('required'));
		$this->mFieldProperties['tsize']->addMessage('required', _MD_LEIMG_ERROR_REQUIRED, _MD_LEIMG_LANG_TSIZE);
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
		$this->set('thumbnail_id', $obj->get('thumbnail_id'));
		$this->set('dirname', $obj->get('dirname'));
		$this->set('dataname', $obj->get('dataname'));
		$this->set('max_width', $obj->get('max_width'));
		$this->set('max_height', $obj->get('max_height'));
		$this->set('file_type', $obj->get('file_type'));
		$this->set('tsize', $obj->get('tsize'));
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
		//$dataset = explode(' ', $this->get('dataset'));
		$obj->set('dirname', $this->get('dirname'));
		$obj->set('dataname', $this->get('dataname'));
		$obj->set('max_width', $this->get('max_width'));
		$obj->set('max_height', $this->get('max_height'));
		$obj->set('file_type', $this->get('file_type'));
		$obj->set('tsize', $this->get('tsize'));
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
