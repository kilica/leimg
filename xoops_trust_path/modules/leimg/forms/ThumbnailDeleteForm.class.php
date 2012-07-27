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
 * Leimg_ThumbnailDeleteForm
**/
class Leimg_ThumbnailDeleteForm extends XCube_ActionForm
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
        return "module.leimg.ThumbnailDeleteForm.TOKEN";
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
        $this->mFormProperties['thumbnail_id'] = new XCube_IntProperty('thumbnail_id');
    
        //
        // Set field properties
        //
        $this->mFieldProperties['thumbnail_id'] = new XCube_FieldProperty($this);
        $this->mFieldProperties['thumbnail_id']->setDependsByArray(array('required'));
        $this->mFieldProperties['thumbnail_id']->addMessage('required', _MD_LEIMG_ERROR_REQUIRED, _MD_LEIMG_LANG_THUMBNAIL_ID);
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
        $this->set('thumbnail_id', $obj->get('thumbnail_id'));
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
        $obj->set('thumbnail_id', $this->get('thumbnail_id'));
    }
}

?>
