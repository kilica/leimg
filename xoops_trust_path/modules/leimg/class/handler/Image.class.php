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
 * Leimg_ImageObject
**/
class Leimg_ImageObject extends Legacy_AbstractImageObject
{
    public $mIsBlank = null;   //object for blank image

    /**
     * getBasePath
     * 
     * @param   int     $tsize
     * 
     * @return  string
     */
    public function getBasePath($tsize=0)
    {
        umask(0);
        //module upload path
        $path = sprintf('%s/%s', XOOPS_UPLOAD_PATH, $this->getShow('dirname').'_'.$this->getShow('dataname'));
        if (! is_dir($path)) {
            @mkdir($path, 0777);
            copy(XOOPS_UPLOAD_PATH.'/index.html', $path.'/index.html');
        }
    
        //module thumb path
        $thumbPath = ($tsize>0) ? '/thumb'.$tsize : null;
        $path = $path . $thumbPath;
        if (! is_dir($path)) {
            @mkdir($path, 0777);
            copy(XOOPS_UPLOAD_PATH.'/index.html', $path.'/index.html');
        }
    
        //module upload path
        if($this->isBlank()===false){
	        $path = sprintf('%s/%04d', $path, intval($this->getShow('image_id') / 1000));
	        if (! is_dir($path)) {
	            @mkdir($path, 0777);
	            copy(XOOPS_UPLOAD_PATH.'/index.html', $path.'/index.html');
	        }
	    }
    
        return $path;
    }

    /**
     * getBaseUrl
     * 
     * @param   int     $tsize
     * 
     * @return  string
     */
    public function getBaseUrl($tsize=0)
    {
        $thumbPath = ($tsize>0) ? '/thumb'.$tsize : null;
        if($this->isBlank()===false){
            return sprintf('%s/%s%s/%04d', XOOPS_UPLOAD_URL, $this->getShow('dirname').'_'.$this->getShow('dataname'), $thumbPath, $this->getShow('image_id') / 1000);
        }
        else{
            return sprintf('%s/%s%s', XOOPS_UPLOAD_URL, $this->getShow('dirname').'_'.$this->getShow('dataname'), $thumbPath);
        }
    }

    /**
     * getFilePath
     * 
     * @param   int     $tsize
     * 
     * @return  string
     */
    public function getFilePath($tsize=0)
    {
    	$filename = $this->getShow('file_name') ? $this->getShow('file_name') .'.'. Lenum_ImageType::getName($this->get('file_type')) : null;
        return $this->getBasePath($tsize) .'/'. $filename;
    }

    /**
     * getFileUrl
     * 
     * @param   int     $tsize
     * 
     * @return  string
     */
    public function getFileUrl($tsize=0)
    {
        $fileName = ($this->isBlank()===true) ? 'blank.'.LEGACY_IMAGE_DUMMY_EXT : $this->getShow('file_name') .'.'. Lenum_ImageType::getName($this->get('file_type'));
        return $this->getBaseUrl($tsize) .'/'. $fileName;
    }

    /**
     * is image file ?
     * 
     * @param   int	$tsize
     * 
     * @return  bool
     */
    public function isImage(/*** int ***/ $tsize=0)
    {
    	$srcPath = $this->getFilePath($tsize);
        if(file_exists($srcPath) && @exif_imagetype($srcPath)!==false){
        	return true;
        }
        else{
        	return false;
        }
    }

    /**
     * image exists ?
     * 
     * @param   void
     * 
     * @return  bool
     */
    public function isBlank()
    {
    	if(! isset($this->mIsBlank)){
            $srcPath = sprintf('%s/%s/%04d/%s.%s', XOOPS_UPLOAD_PATH, $this->getShow('dirname').'_'.$this->getShow('dataname'), intval($this->getShow('image_id') / 1000), $this->getShow('file_name'), Lenum_ImageType::getName($this->get('file_type')));
	    	$this->mIsBlank = (file_exists($srcPath) && @exif_imagetype($srcPath)!==false) ? false : true;
	    }
    	return $this->mIsBlank;
    
    }

    /**
     * has blank image file ?
     * 
     * @param   void
     * 
     * @return  bool
     */
    public function hasBlankImage()
    {
    	$srcPath = $this->getBasePath() .'/blank.'.LEGACY_IMAGE_DUMMY_EXT;
        return (file_exists($srcPath) && @exif_imagetype($srcPath)!==false) ? true : false;
    }

    /**
     * makeImageTag
     * 
     * @param   int     $tsize
     * @param   string  $htmlId     id attribute in html element
     * @param   string  $htmlClass  class attribute in html element
     * 
     * @return  string
     */
    public function makeImageTag(/*** int ***/ $tsize=1, /*** string ***/ $htmlId=null, /*** string ***/ $htmlClass=null)
    {
        $html = '<img src="%s"%s%s%s%s%s />';
    
        $id = isset($htmlId) ? ' id="'.$htmlId.'"' : null;
        $class = isset($htmlClass) ? ' class="'.$htmlClass.'"' : null;
    
    	$title = $this->get('title');
    	$alt = $title ? ' alt="'.$title.'"' : null;
    	$w = $this->getImageInfo('width', $tsize);
    	$h = $this->getImageInfo('height', $tsize);
    	$width = isset($w) ? ' width="'.$w.'"' : null;
    	$height = isset($h) ? ' height="'.$h.'"' : null;
    
        $src = $this->getFileUrl($tsize);
        return sprintf($html, $src, $alt, $width, $height, $id, $class);
    }
}

/**
 * Leimg_ImageHandler
**/
class Leimg_ImageHandler extends XoopsObjectGenericHandler
{
    public /*** string ***/ $mTable = '{dirname}_image';

    public /*** string ***/ $mPrimary = 'image_id';

    public /*** string ***/ $mClass = 'Leimg_ImageObject';

    /**
     * __construct
     * 
     * @param   XoopsDatabase  &$db
     * @param   string  $dirname
     * 
     * @return  void
    **/
    public function __construct(/*** XoopsDatabase ***/ &$db,/*** string ***/ $dirname)
    {
        $this->mTable = strtr($this->mTable,array('{dirname}' => $dirname));
        parent::XoopsObjectGenericHandler($db);
    }

    /**
     * saveUploadedFile
     * 
     * @param   Legacy_AbstractImageObject  $obj
     * 
     * @return  bool
    **/
    public function saveUploadedFile(/*** Leimg_ImageObject ***/ $obj)
    {
    	$uploadedFile = $obj->getTemporaryPath();
        if(! is_uploaded_file($uploadedFile)){
            return true;
        }
    
       	//check filesize
    	$chandler = xoops_gethandler('config');
    	$conf = $chandler->getConfigsByDirname(LEGACY_IMAGE_DIRNAME);
    	if($conf['max_size']>0 && filesize($uploadedFile) > $conf['max_size']){
    		return false;
    	}
    
        //set image infomation(width, height, type)
        $info = getimagesize($uploadedFile);
        $obj->set('file_type', $info[2]);
        $obj->set('image_width', $info[0]);
        $obj->set('image_height', $info[1]);
    
        //set filename
        if(! $obj->get('file_name')){
            $filename = $obj->getRandomFileName(sprintf('%08d',$obj->getShow('data_id')));
            $obj->set('file_name', $filename);
        }
    
        //insert database
        $this->insert($obj, true);
    
    	$obj->mIsBlank = false;
        $imagePath = $obj->getFilePath();
    
        //delete old file
        if(file_exists($imagePath)){
            @unlink($imagePath);
        }
    
        //copy uploaded file
        if (!move_uploaded_file($uploadedFile, $imagePath)) {
            $this->delete($obj, true);
            return false;
        }
    
        //create thumbnails
        $handler = Legacy_Utils::getModuleHandler('thumbnail', $obj->getDirname());
        return $handler->createThumbnails($obj);
    }

    /**
     * getImageObjects
     * 
     * @param   string  $dirname
     * @param   string  $dataname
     * @param   int     $dataId
     * @param   int     $num
     * @param   int     $limit
     * @param   int     $start
     * 
     * @return  Legacy_AbstractImageObject[]
    **/
    public function getImageObjects(/*** string ***/ $dirname, /*** string ***/ $dataname, /*** int ***/ $dataId=0, /*** int ***/ $num=0, /*** int ***/ $limit=10, /*** int ***/ $start=0)
    {
        $cri = new CriteriaCompo();
        $cri->add(new Criteria('dirname', $dirname));
        $cri->add(new Criteria('dataname', $dataname));
        if($dataId>0){
            $cri->add(new Criteria('data_id', $dataId));
        }
        if($num>0){
            $cri->add(new Criteria('num', $num));
        }
        return $this->getObjects($cri, $limit, $start);
    }

    /**
     * getImageObject
     * 
     * @param   string  $dirname
     * @param   string  $dataname
     * @param   int     $dataId
     * @param   int     $num
     * 
     * @return  Legacy_AbstractImageObject
    **/
    public function getImageObject(/*** string ***/ $dirname, /*** string ***/ $dataname, /*** int ***/ $dataId, /*** int ***/ $num=1)
    {
        if(count($objs = $this->getImageObjects($dirname, $dataname, $dataId, $num))>0){
            return array_shift($objs);
        }
    }

    /**
     * delete
     * 
     * @param   Abstract_ImageObject  $dirname
     * @param   bool    $force
     * 
     * @return  bool
    **/
    public function delete(/*** Abstract_ImageObject ***/ &$obj, /*** bool ***/ $force = false)
    {
        //delete photo
        $this->_removeImageFile($obj);
    
        //delete db
        return parent::delete($obj, $force);
    }

    /**
     * _removeImageFile
     * 
     * @param   Abstract_ImageObject  $obj
     * 
     * @return  void
    **/
    protected function _removeImageFile(/*** Abstract_ImageObject ***/ $obj)
    {
        if(file_exists($obj->getFilePath())){
            @unlink($obj->getFilePath());
        }
        $handler = Legacy_Utils::getModuleHandler('thumbnail', $obj->getDirname());
        $handler->removeThumbnails($obj);
    }
}

?>
