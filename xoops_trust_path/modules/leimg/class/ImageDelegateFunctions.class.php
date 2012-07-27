<?php
/**
 * @package leimg
 */

if (!defined('XOOPS_ROOT_PATH')) exit();

class Leimg_ImageDelegate implements Legacy_iImageDelegate
{
	/**
	 * getImageObject
	 *
	 * @param string	&$obj
	 *
	 * @return	void
	 */ 
	public static function createImageObject(/*** Legacy_AbstractImageObject ***/ &$obj)
	{
		$handler = Legacy_Utils::getModuleHandler('image', LEGACY_IMAGE_DIRNAME);
		$obj = $handler->create();
	}

	/**
	 * saveImage
	 *
	 * @param bool		&$ret
	 * @param Leimg_ImageObject	$obj
	 *
	 * @return	void
	 */ 
	public static function saveImage(/*** bool ***/ &$ret, /*** Legacy_AbstractImageObject ***/ $obj)
	{
		$handler = Legacy_Utils::getModuleHandler('image', $obj->getDirname());
		$ret = $handler->saveUploadedFile($obj);
	}

	/**
	 * deleteImage
	 *
	 * @param bool		&$ret
	 * @param Abstract_ImageObject	$obj
	 *
	 * @return	void
	 */ 
	public static function deleteImage(/*** bool ***/ &$ret, /*** Legacy_AbstractImageObject ***/ $obj)
	{
		$handler = Legacy_Utils::getModuleHandler('image', $obj->getDirname());
		$ret = $handler->delete($obj);
	}

	/**
	 * getImageObjects
	 *
	 * @param Legacy_AbstractImageObject[]	&$objects
	 * @param string	$dirname
	 * @param string	$dataname
	 * @param int		$dataId
	 * @param int		$num
	 * @param int		$limit
	 * @param int		$start
	 *
	 * @return	void
	 */ 
	public static function getImageObjects(/*** Legacy_AbstractImageObject ***/ &$objects, /*** string ***/ $dirname, /*** string ***/ $dataname, /*** int ***/ $dataId=0, /*** int ***/ $num=0, /*** int ***/ $limit=10, /*** int ***/ $start=0)
	{
		XCube_Root::getSingleton()->mLanguageManager->loadModuleMessageCatalog(LEGACY_IMAGE_DIRNAME);
		$handler = Legacy_Utils::getModuleHandler('image', LEGACY_IMAGE_DIRNAME);
		$images = $handler->getImageObjects($dirname, $dataname, $dataId, $num, $limit, $start);
		foreach($images as $image){
			$objects[$image->getShow('num')] = $image;
		}
	}


	/**
	 * validate uploaded image file. size, extension, etc.
	 *
	 * @param XCube_ActionForm	&$result
	 * @param string	$path
	 *
	 * @return	void
	 */ 
	public static function validateImage(/*** XCube_ActionForm ***/ &$actionForm, /*** string ***/ $path)
	{
		if(is_null($actionForm)){
			$actionForm = new XCube_ActionForm();
		}
	
		//check file exists
        if(! is_uploaded_file($path)){
			$actionForm->addErrorMessage(_MD_LEIMG_ERROR_NO_UPLOADED_FILE);
        }
    
		//check extension
        $info = getimagesize($uploadedFile);
		if(! in_array($info[2], array(IMAGETYPE_GIF, IMAGETYPE_JPG, IMAGETYPE_PNG))){
			$actionForm->addErrorMessage(_MD_LEIMG_ERROR_EXTENSION);
		}
	
		//check max file size
    	$chandler = xoops_gethandler('config');
    	$conf = $chandler->getConfigsByDirname(LEGACY_IMAGE_DIRNAME);
    	if($conf['max_size']>0 && filesize($path) > $conf['max_size']){
			$actionForm->addErrorMessage(sprintf(_MD_LEIMG_ERROR_MAX_SIZE_OVER, $conf['max_size']));
    	}
	}

}

?>
