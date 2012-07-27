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
 * Leimg_ImageDeleteForm
**/
class Leimg_ImageDeleteForm extends XCube_ActionForm
{
    /**
     * getTokenName
     * 
     * @param   void
     * 
     * @return  string
    **/
    public function getTokenName()
    {
        return "module.leimg.ImageDeleteForm.TOKEN";
    }

    /**
     * prepare
     * 
     * @param   void
     * 
     * @return  void
    **/
    public function prepare()
    {
        //
        // Set form properties
        //
        $this->mFormProperties['image_id'] = new XCube_IntProperty('image_id');
    
        //
        // Set field properties
        //
        $this->mFieldProperties['image_id'] = new XCube_FieldProperty($this);
        $this->mFieldProperties['image_id']->setDependsByArray(array('required'));
        $this->mFieldProperties['image_id']->addMessage('required', _MD_LEIMG_ERROR_REQUIRED, _MD_LEIMG_LANG_IMAGE_ID);
    }

    /**
     * load
     * 
     * @param   XoopsSimpleObject  &$obj
     * 
     * @return  void
    **/
    public function load(/*** XoopsSimpleObject ***/ &$obj)
    {
        $this->set('image_id', $obj->get('image_id'));
    }

    /**
     * update
     * 
     * @param   XoopsSimpleObject  &$obj
     * 
     * @return  void
    **/
    public function update(/*** XoopsSimpleObject ***/ &$obj)
    {
        $obj->set('image_id', $this->get('image_id'));
    }
}

?>
