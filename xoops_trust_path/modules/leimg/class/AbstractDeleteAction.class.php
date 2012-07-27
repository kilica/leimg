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
 * Leimg_AbstractDeleteAction
**/
abstract class Leimg_AbstractDeleteAction extends Leimg_AbstractEditAction
{
    /**
     * _isEnableCreate
     * 
     * @param   void
     * 
     * @return  bool
    **/
    protected function _isEnableCreate()
    {
        return false;
    }

    /**
     * _getActionName
     * 
     * @param   void
     * 
     * @return  string
    **/
    protected function _getActionName()
    {
        return _DELETE;
    }

    /**
     * prepare
     * 
     * @param   void
     * 
     * @return  bool
    **/
    public function prepare()
    {
        return parent::prepare() && is_object($this->mObject);
    }

    /**
     * _doExecute
     * 
     * @param   void
     * 
     * @return  Enum
    **/
    protected function _doExecute()
    {
        if($this->mObjectHandler->delete($this->mObject))
        {
            return LEIMG_FRAME_VIEW_SUCCESS;
        }
    
        return LEIMG_FRAME_VIEW_ERROR;
    }
}

?>
