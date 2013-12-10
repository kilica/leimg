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
 * Leimg_ThumbnailObject
**/
class Leimg_ThumbnailObject extends XoopsSimpleObject
{
	const	QUALITY = 100;

	/**
	 * __construct
	 * 
	 * @param	void
	 * 
	 * @return	void
	**/
	public function __construct()
	{
		$this->initVar('thumbnail_id', XOBJ_DTYPE_INT, '', false);
		$this->initVar('dirname', XOBJ_DTYPE_STRING, '', false);
		$this->initVar('dataname', XOBJ_DTYPE_STRING, '', false);
		$this->initVar('max_width', XOBJ_DTYPE_INT, 120, false);
		$this->initVar('max_height', XOBJ_DTYPE_INT, 120, false);
		$this->initVar('file_type', XOBJ_DTYPE_INT, 0, false);	//file_type is currently ignored.
		$this->initVar('tsize', XOBJ_DTYPE_INT, 1, false);
	}

	/**
	 * saveThumbnail
	 * create thumbnail image from original
	 * 
	 * @param	Leimg_ImageObject	$obj
	 * 
	 * @return	bool
	**/
    public function saveThumbnail(/*** Leimg_ImageObject ***/ $obj)
    {
        $ret = true;
        $filePath = $obj->getFilePath($this->get('tsize'));
        $orgFilePath = $obj->getFilePath();

        //create resized image
        $size = $this->_getResizedSize($obj->getImageInfo('width'),$obj->getImageInfo('height'));
        $result = function_exists('imagecreatetruecolor') ? imagecreatetruecolor($size['width'],$size['height']) : imagecreate($size['width'],$size['height']);

        //create image source
        switch($obj->getImageInfo('file_type')){
            case Lenum_ImageType::JPG:	//2
                $source = imagecreatefromjpeg($orgFilePath);
                break;
            case Lenum_ImageType::GIF:	//1
                $source = imagecreatefromgif($orgFilePath);
                // set alpha channel
                $alpha = imagecolortransparent($source);
                imagefill($result, 0, 0, $alpha);
                imagecolortransparent($result, $alpha);
                break;
            case Lenum_ImageType::PNG:	//3
                $source = imagecreatefrompng($orgFilePath);
                // set alpha channel
                imagealphablending($result, false);
                imagesavealpha($result, true);
                break;
            default:
                $ret = false;
                break;
        }

        if(!imagecopyresampled($result, $source,0,0,0,0,$size['width'],$size['height'],$obj->get('image_width'),$obj->get('image_height')))
        {
            die('failed to imagecopyresampled');
        }

        //delete old thumbnails
        if(file_exists($filePath)){
            @unlink($filePath);
        }

        //create thumbnail image
        switch($obj->getImageInfo('file_type')){
            case Lenum_ImageType::JPG:
                imagejpeg($result, $filePath, self::QUALITY);
                break;
            case Lenum_ImageType::GIF:
                imagegif($result, $filePath);
                break;
            case Lenum_ImageType::PNG:
                imagepng($result, $filePath);
                break;
            default:
                $ret = false;
                break;
        }
        return $ret;
    }

	/** 
	 * _getResizedSize
	 * Calcurate resized width/height to fit in thumbnail's width/height.
	 * If original image's width & height are within thumbnail's width/height,
	 * leave it as is.
	 * 
	 * @param	int $width
	 * @param	int $height
	 * 
	 * @return	int[]
	**/
	public function _getResizedSize(/*** int ***/ $width,/*** int ***/ $height)
	{
		$maxWidth = $this->get('max_width');
		$maxHeight = $this->get('max_height');
		if(min($width,$height,$maxWidth,$maxHeight) < 1)
		{
			echo $width .'/'. $height .'/'. $maxWidth .'/'. $maxHeight;
			die('invalid width, height');
		}
		$scale = min($maxWidth / $width,$maxHeight / $height, 1);
		return array('width' => intval($width * $scale),'height' => intval($height * $scale));
	}
}

/**
 * Leimg_ThumbnailHandler
**/
class Leimg_ThumbnailHandler extends XoopsObjectGenericHandler
{
	public /*** string ***/ $mTable = '{dirname}_thumbnail';

	public /*** string ***/ $mPrimary = 'thumbnail_id';

	public /*** string ***/ $mClass = 'Leimg_ThumbnailObject';

	/**
	 * __construct
	 * 
	 * @param	XoopsDatabase  &$db
	 * @param	string	$dirname
	 * 
	 * @return	void
	**/
	public function __construct(/*** XoopsDatabase ***/ &$db,/*** string ***/ $dirname)
	{
		$this->mTable = strtr($this->mTable,array('{dirname}' => $dirname));
		parent::XoopsObjectGenericHandler($db);
	}

	/**
	 * _getThumbnailList
	 * 
	 * @param	string	$dirname
	 * @param	string	$dataname
	 * 
	 * @return	Leimg_ImageObject[]
	**/
	protected function _getThumbnailList(/*** string ***/ $dirname, /*** string ***/ $dataname)
	{
		$cri = new CriteriaCompo();
		$cri->add(new Criteria('dirname', $dirname));
		$cri->add(new Criteria('dataname', $dataname));
		$cri->setSort('tsize', 'ASC');
		return $this->getObjects($cri);
	}

	/**
	 * createThumbnails
	 * Create thumbnails from the original image. 
	 * 
	 * @param	Leimg_ImageObject	$obj
	 * 
	 * @return	bool
	**/
	public function createThumbnails(/*** Leimg_ImageObject ***/ $obj)
	{
		$thumbs = $this->_getThumbnailList($obj->get('dirname'), $obj->get('dataname'));
		foreach(array_keys($thumbs) as $key){
			if(! $thumbs[$key]->saveThumbnail($obj)){
				return false;
			}
		}
		return true;
	}

	/**
	 * removeThumbnails
	 * 
	 * @param	Leimg_ImageObject	$obj
	 * 
	 * @return	void
	**/
	public function removeThumbnails(/*** Leimg_ImageObject ***/ $obj)
	{
		$thumbs = $this->_getThumbnailList($obj->get('dirname'), $obj->get('dataname'));
		foreach(array_keys($thumbs) as $key){
			if(file_exists($obj->getFilePath($thumbs[$key]->get('tsize')))){
				@unlink($obj->getFilePath($thumbs[$key]->get('tsize')));
			}
		}
	}
}

?>
