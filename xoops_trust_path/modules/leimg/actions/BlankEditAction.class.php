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
 * Leimg_BlankEditAction
**/
class Leimg_BlankEditAction extends Leimg_AbstractEditAction
{
	public $mBlankImage = null;	//	Legacy_AbstractImageObject

	/**
	 * _getTitle
	 * 
	 * @param	void
	 * 
	 * @return	string
	**/
	protected function _getTitle()
	{
		return _MD_LEIMG_LANG_BLANK_IMAGE;
	}

	/**
	 * &_getHandler
	 * 
	 * @param	void
	 * 
	 * @return	Leimg_ThumbnailHandler
	**/
	protected function &_getHandler()
	{
		$handler =& $this->mAsset->getObject('handler', 'Image');
		return $handler;
	}

	/**
	 * _setupActionForm
	 * 
	 * @param	void
	 * 
	 * @return	void
	**/
	protected function _setupActionForm()
	{
		$this->mActionForm =& $this->mAsset->getObject('form', 'Blank',false,'edit');
		$this->mActionForm->prepare();
	}

	/**
	 * _setupObject
	 * 
	 * @param	void
	 * 
	 * @return	void
	**/
	protected function _setupObject()
	{
		$this->mObjectHandler =& $this->_getHandler();
	}

	/**
	 * prepare
	 * 
	 * @param	void
	 * 
	 * @return	bool
	**/
	public function prepare()
	{
		$dirname = $this->mRoot->mContext->mRequest->getRequest('dir');
		$dataname = $this->mRoot->mContext->mRequest->getRequest('dtname');
		$this->_setupObject();
	
		$this->_setupActionForm();
		
		$blankImage = $this->mObjectHandler->create();
		$blankImage->set('dirname', $dirname);
		$blankImage->set('dataname', $dataname);
		$this->mBlankImage = $blankImage;
		return true;
	}

	/**
	 * getDefaultView
	 * 
	 * @param	void
	 * 
	 * @return	Enum
	**/
	public function getDefaultView()
	{
		return LEIMG_FRAME_VIEW_INPUT;
	}

	/**
	 * executeViewInput
	 * 
	 * @param	XCube_RenderTarget	&$render
	 * 
	 * @return	void
	**/
	public function executeViewInput(/*** XCube_RenderTarget ***/ &$render)
	{
		$render->setTemplateName($this->mAsset->mDirname . '_blank_edit.html');
		$render->setAttribute('actionForm', $this->mActionForm);
		$render->setAttribute('blankImage', $this->mBlankImage);
		$render->setAttribute('dirname', $this->mAsset->mDirname);
		$render->setAttribute('dir', $this->mRoot->mContext->mRequest->getRequest('dir'));
		$render->setAttribute('dtname', $this->mRoot->mContext->mRequest->getRequest('dtname'));
	}

	/**
	 * executeViewSuccess
	 * 
	 * @param	XCube_RenderTarget	&$render
	 * 
	 * @return	void
	**/
	public function executeViewSuccess(/*** XCube_RenderTarget ***/ &$render)
	{
		$this->mRoot->mController->executeForward(Legacy_Utils::renderUri($this->mAsset->mDirname));
	}

	/**
	 * executeViewError
	 * 
	 * @param	XCube_RenderTarget	&$render
	 * 
	 * @return	void
	**/
	public function executeViewError(/*** XCube_RenderTarget ***/ &$render)
	{
		$this->mRoot->mController->executeRedirect(Legacy_Utils::renderUri($this->mAsset->mDirname), 1, _MD_LEIMG_ERROR_DBUPDATE_FAILED);
	}

	/**
	 * executeViewCancel
	 * 
	 * @param	XCube_RenderTarget	&$render
	 * 
	 * @return	void
	**/
	public function executeViewCancel(/*** XCube_RenderTarget ***/ &$render)
	{
		$this->mRoot->mController->executeForward(Legacy_Utils::renderUri($this->mAsset->mDirname));
	}

	/**
	 * execute
	 * 
	 * @param	void
	 * 
	 * @return	Enum
	**/
	public function execute()
	{
		if ($this->mRoot->mContext->mRequest->getRequest('_form_control_cancel') != null)
		{
			return LEIMG_FRAME_VIEW_CANCEL;
		}
	
		$this->mActionForm->validate();
	
		if ($this->mActionForm->hasError())
		{
			return LEIMG_FRAME_VIEW_INPUT;
		}
		return $this->_doExecute();
	}

	protected function _doExecute()
	{
		$uploadedFile = $_FILES['blankimage'];
		if(! $uploadedFile){
			return LEIMG_FRAME_VIEW_SUCCESS;
		}
	
		$info = getimagesize($uploadedFile['tmp_name']);
		$orgExt = $this->_getUploadedExt($uploadedFile['type']);
		$ext = LEGACY_IMAGE_DUMMY_EXT;
	
		$image = $this->mObjectHandler->create();
		$image->set('dirname', $this->mRoot->mContext->mRequest->getRequest('dirname'));
		$image->set('dataname', $this->mRoot->mContext->mRequest->getRequest('dataname'));
		$image->set('file_name', 'blank');
		$image->set('file_type', 1);
		$image->set('image_width', $info[0]);
		$image->set('image_height', $info[1]);

		$image->mIsBlank = true;
	
		$resource = $this->_getImageResource($uploadedFile['tmp_name'], $orgExt);
	
		$imagePath = $image->getFilePath();
		//delete old file
		if(file_exists($imagePath)){
			@unlink($imagePath);
		}
	
		//copy uploaded file
		/*
		if (!move_uploaded_file($uploadedFile['tmp_name'], $imagePath)) {
			return LEIMG_FRAME_VIEW_ERROR;
		}
		*/
		$this->_createImage($resource, $imagePath, $image->get('file_type'));
	
		//create thumbnails
		return Legacy_Utils::getModuleHandler('thumbnail', $this->mAsset->mDirname)->createThumbnails($image) ? LEIMG_FRAME_VIEW_SUCCESS : LEIMG_FRAME_VIEW_ERROR;
	}

	/**
	 * _getUploadedExt
	 * get uploaded file's extension
	 * 
	 * @param	string	$type
	 * 
	 * @return	Legacy_AbstractImageObject[]
	**/
	protected function _getUploadedExt(/*** string ***/ $type)
	{
		switch($type){
		case 'image/jpeg':
			return 'jpg';
			break;
		case 'image/gif':
			return 'gif';
			break;
		case 'image/png':
			return 'png';
			break;
		}
	}

	/**
	 * _getImageResource
	 * 
	 * @param	string	$filePath
	 * @param	string	$ext
	 * 
	 * @return	resource
	**/
	protected function _getImageResource(/*** string ***/ $filePath, /*** string ***/ $ext)
	{
		switch($ext){
		case 'gif':
			$resource = imagecreatefromgif($filePath);
			break;
		case 'jpg':
			$resource = imagecreatefromjpeg($filePath);
			break;
		case 'png':
			$resource = imagecreatefrompng($filePath);
			break;
		}
		return $resource;
	}

	protected function _createImage($resource, $filePath, $ext)
	{
		//create thumbnail image
		switch($ext){
		case Lenum_ImageType::JPG:
			imagejpeg($resource, $filePath);
			break;
		case Lenum_ImageType::GIF:
			imagegif($resource, $filePath);
			break;
		case Lenum_ImageType::PNG:
			imagepng($resource, $filePath);
			break;
		}
	}
}

?>
