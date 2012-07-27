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

/**
 * Leimg_Utils
**/
class Leimg_Utils
{
    /**
     * &getXoopsHandler
     * 
     * @param   string  $name
     * @param   bool  $optional
     * 
     * @return  XoopsObjectHandler
    **/
    public static function &getXoopsHandler(/*** string ***/ $name,/*** bool ***/ $optional = false)
    {
        // TODO will be emulated xoops_gethandler
        return xoops_gethandler($name,$optional);
    }

    /**
     * &getModuleHandler
     * 
     * @param   string  $name
     * @param   string  $dirname
     * 
     * @return  XoopsObjectHandleer
    **/
    public static function &getModuleHandler(/*** string ***/ $name,/*** string ***/ $dirname)
    {
        // TODO will be emulated xoops_getmodulehandler
        return xoops_getmodulehandler($name,$dirname);
    }

    /**
     * &getLeimgHandler
     * 
     * @param   string  $name
     * @param   string  $dirname
     * 
     * @return  XoopsObjectHandleer
    **/
    public static function &getLeimgHandler(/*** string ***/ $name,/*** string ***/ $dirname)
    {
        $asset = null;
        XCube_DelegateUtils::call(
            'Module.leimg.Global.Event.GetAssetManager',
            new XCube_Ref($asset),
            $dirname
        );
        if(is_object($asset) && is_a($asset, 'Leimg_AssetManager'))
        {
            return $asset->getObject('handler',$name);
        }
    }

    /**
     * getEnv
     * 
     * @param   string  $key
     * 
     * @return  string
    **/
    public static function getEnv(/*** string ***/ $key)
    {
        return getenv($key);
    }
}

?>
