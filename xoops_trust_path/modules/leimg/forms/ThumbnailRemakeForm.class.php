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
class Leimg_ThumbnailRemakeForm extends XCube_ActionForm
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
		return "module.leimg.ThumbnailRenameForm.TOKEN";
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
	
		//
		// Set field properties
		//
		$this->mFieldProperties['thumbnail_id'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['dirname'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['dataname'] = new XCube_FieldProperty($this);
		$this->mFieldProperties['dirname']->setDependsByArray(array('required'));
		$this->mFieldProperties['dirname']->addMessage('required', _MD_LEIMG_ERROR_REQUIRED, _MD_LEIMG_LANG_DIRNAME);
		$this->mFieldProperties['dataname']->setDependsByArray(array('required'));
		$this->mFieldProperties['dataname']->addMessage('required', _MD_LEIMG_ERROR_REQUIRED, _MD_LEIMG_LANG_DATANAME);
	}
}

?>
