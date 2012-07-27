<?php
/**
 * @file
 * @package leimg
 * @version $Id$
**/

define('_MD_LEIMG_ERROR_REQUIRED', '{0} is required.');
define('_MD_LEIMG_ERROR_MINLENGTH', 'Input {0} with {1} or more characters.');
define('_MD_LEIMG_ERROR_MAXLENGTH', 'Input {0} with {1} or less characters.');
define('_MD_LEIMG_ERROR_EXTENSION', 'Uploaded file\'s extension does not match any entry in the allowed list.');
define('_MD_LEIMG_ERROR_NO_UPLOADED_FILE', 'The uploaded file is not found.');
define('_MD_LEIMG_ERROR_MAX_SIZE_OVER', 'The uploaded file\'s size is over max file size limit (%s byte).');
define('_MD_LEIMG_ERROR_INTRANGE', 'Incorrect input on {0}.');
define('_MD_LEIMG_ERROR_MIN', 'Input {0} with {1} or more numeric value.');
define('_MD_LEIMG_ERROR_MAX', 'Input {0} with {1} or less numeric value.');
define('_MD_LEIMG_ERROR_OBJECTEXIST', 'Incorrect input on {0}.');
define('_MD_LEIMG_ERROR_DBUPDATE_FAILED', 'Failed updating database.');
define('_MD_LEIMG_ERROR_EMAIL', '{0} is an incorrect email address.');
define('_MD_LEIMG_ERROR_DIRNAME_DATANAME_REQUIRED', 'Dirname and Dataname is required');
define('_MD_LEIMG_MESSAGE_CONFIRM_DELETE', 'Are you sure to delete?');
define('_MD_LEIMG_LANG_CONTROL', 'CONTROL');
define('_MD_LEIMG_ERROR_CONTENT_IS_NOT_FOUND', 'Content is not found');
define('_MD_LEIMG_LANG_TITLE', 'Title');
define('_MD_LEIMG_LANG_DIRNAME', 'Dirname');
define('_MD_LEIMG_LANG_DATANAME', 'Dataname');
define('_MD_LEIMG_LANG_DESCRIPTION', 'Description');
define('_MD_LEIMG_LANG_IMAGE_ID', 'Image ID');
define('_MD_LEIMG_LANG_UID', 'Uid');
define('_MD_LEIMG_LANG_DATA_ID', 'Data ID');
define('_MD_LEIMG_LANG_NUM', 'Num');
define('_MD_LEIMG_LANG_FILE_NAME', 'File Name');
define('_MD_LEIMG_LANG_FILE_TYPE', 'File Type');
define('_MD_LEIMG_LANG_IMAGE_WIDTH', 'Image Width');
define('_MD_LEIMG_LANG_IMAGE_HEIGHT', 'Image Height');
define('_MD_LEIMG_LANG_POSTTIME', 'Posttime');
define('_MD_LEIMG_LANG_ADD_A_NEW_IMAGE', 'Add a new Image');
define('_MD_LEIMG_LANG_IMAGE_EDIT', 'Image Edit');
define('_MD_LEIMG_LANG_IMAGE_DELETE', 'Image Delete');
define('_MD_LEIMG_LANG_THUMBNAIL', 'Thumbnail Setting');
define('_MD_LEIMG_LANG_THUMBNAIL_ID', 'Thumbnail Setting ID');
define('_MD_LEIMG_LANG_MAX_WIDTH', 'Width(px)');
define('_MD_LEIMG_LANG_MAX_HEIGHT', 'Height(px)');
define('_MD_LEIMG_LANG_ADD_A_NEW_THUMBNAIL', 'Add a new Thumbnail Setting');
define('_MD_LEIMG_LANG_THUMBNAIL_EDIT', 'Thumbnail Setting Edit');
define('_MD_LEIMG_LANG_THUMBNAIL_DELETE', 'Thumbnail Setting Delete');
define('_MD_LEIMG_LANG_TSIZE', 'Thumbnail Number');
define('_MD_LEIMG_LANG_BLANK_IMAGE', 'Dummy Image');
define('_MD_LEIMG_LANG_UPLOAD_BLANK_IMAGE', 'Upload Dummy Image');
define('_MD_LEIMG_DESC_UPLOAD_BLANK_IMAGE', 'You can upload dummy image file. The uploaded image is used when requested image is not exist.');
define('_MD_LEIMG_DESC_ABOUT_LEIMG', 'This module is utility for other modules. This module itself do nothing. When another module requests to save image file, this module save it and create the thumbnails.<br />You can set the number of thumnail and the size of each.<br />Modules handling images are automatically shown below. So if you have no line below, this site don\'t have any module handling image.');
define('_MD_LEIMG_MESSAGE_NO_THUMBNAIL_SETTING', 'No Thumbnail setting is exists');
define('_MD_LEIMG_LANG_THUMBNAIL_REMAKE', 'Remake Thumbnails');
define('_MD_LEIMG_DESC_THUMBNAIL_REMAKE', 'Remake Thumbnails. It requires time and add server load. Click the following submit button.');

//
if(!defined('_MD_LEIMG_LANG_BLANK_EXT')) define('_MD_LEIMG_LANG_BLANK_EXT', 'gif');
?>
