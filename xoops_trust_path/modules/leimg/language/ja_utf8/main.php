<?php
/**
 * @file
 * @package leimg
 * @version $Id$
**/

define('_MD_LEIMG_ERROR_REQUIRED', '{0}は必ず入力して下さい');
define('_MD_LEIMG_ERROR_MINLENGTH', '{0}は半角{1}文字以上にして下さい');
define('_MD_LEIMG_ERROR_MAXLENGTH', '{0}は半角{1}文字以内で入力して下さい');
define('_MD_LEIMG_ERROR_EXTENSION', 'アップロードされたファイルは許可された拡張子と一致しません');
define('_MD_LEIMG_ERROR_NO_UPLOADED_FILE', 'アップロードされたファイルが見つかりません。');
define('_MD_LEIMG_ERROR_MAX_SIZE_OVER', 'ファイルサイズ制限（%s バイト）を越えています。');
define('_MD_LEIMG_ERROR_INTRANGE', '{0}の入力値が不正です');
define('_MD_LEIMG_ERROR_MIN', '{0}は{1}以上の数値を指定して下さい');
define('_MD_LEIMG_ERROR_MAX', '{0}は{1}以下の数値を指定して下さい');
define('_MD_LEIMG_ERROR_OBJECTEXIST', '{0}の入力値が不正です');
define('_MD_LEIMG_ERROR_DBUPDATE_FAILED', 'データベースの更新に失敗しました');
define('_MD_LEIMG_ERROR_EMAIL', '{0}は不正なメールアドレスです');
define('_MD_LEIMG_ERROR_DIRNAME_DATANAME_REQUIRED', 'ディレクトリ名とデータ名が必要です');
define('_MD_LEIMG_MESSAGE_CONFIRM_DELETE', '以下のデータを本当に削除しますか？');
define('_MD_LEIMG_LANG_CONTROL', 'CONTROL');
define('_MD_LEIMG_ERROR_CONTENT_IS_NOT_FOUND', 'CONTENT_IS_NOT_FOUND');
define('_MD_LEIMG_LANG_TITLE', 'タイトル');
define('_MD_LEIMG_LANG_DIRNAME', 'ディレクトリ名');
define('_MD_LEIMG_LANG_DATANAME', 'データ名');
define('_MD_LEIMG_LANG_DESCRIPTION', '内容');
define('_MD_LEIMG_LANG_IMAGE_ID', 'Image id');
define('_MD_LEIMG_LANG_UID', 'ユーザID');
define('_MD_LEIMG_LANG_DATA_ID', 'データID');
define('_MD_LEIMG_LANG_NUM', 'Num');
define('_MD_LEIMG_LANG_FILE_NAME', 'ファイル名');
define('_MD_LEIMG_LANG_FILE_TYPE', 'ファイルタイプ');
define('_MD_LEIMG_LANG_IMAGE_WIDTH', '画像の幅');
define('_MD_LEIMG_LANG_IMAGE_HEIGHT', '画像の高さ');
define('_MD_LEIMG_LANG_POSTTIME', '投稿日');
define('_MD_LEIMG_LANG_ADD_A_NEW_IMAGE', '画像を追加する');
define('_MD_LEIMG_LANG_IMAGE_EDIT', '画像の編集');
define('_MD_LEIMG_LANG_IMAGE_DELETE', '画像の削除');
define('_MD_LEIMG_LANG_THUMBNAIL', 'サムネイル設定');
define('_MD_LEIMG_LANG_THUMBNAIL_ID', 'サムネイル設定ID');
define('_MD_LEIMG_LANG_MAX_WIDTH', '幅(px)');
define('_MD_LEIMG_LANG_MAX_HEIGHT', '高さ(px)');
define('_MD_LEIMG_LANG_ADD_A_NEW_THUMBNAIL', '設定の追加');
define('_MD_LEIMG_LANG_THUMBNAIL_EDIT', 'サムネイル設定の編集');
define('_MD_LEIMG_LANG_THUMBNAIL_DELETE', 'サムネイル設定の削除');
define('_MD_LEIMG_LANG_TSIZE', 'サムネイル番号');
define('_MD_LEIMG_LANG_BLANK_IMAGE', 'ダミー画像');
define('_MD_LEIMG_LANG_UPLOAD_BLANK_IMAGE', 'ダミー画像のアップロード');
define('_MD_LEIMG_DESC_UPLOAD_BLANK_IMAGE', 'ダミーの画像ファイルをアップロードすることができます。ここでアップロードした画像は、リクエストされた画像が存在しない場合に代わりに表示されます。');
define('_MD_LEIMG_DESC_ABOUT_LEIMG', 'このモジュールは他のモジュールのためのユーティリティです。このモジュール単独では役に立ちません。別のモジュールが画像の保存をリクエストしたときに、そのファイルを保存し、サムネイルを作ります。<br />ここでは、リクエストもとのモジュールごとに、作成するサムネイルの縦横サイズを指定することができます。<br />このモジュールを利用して画像を処理するモジュールが以下に表示されています。何も表示が無ければ、インストールされているモジュールの中に画像処理を行うモジュールが無いということです。');
define('_MD_LEIMG_MESSAGE_NO_THUMBNAIL_SETTING', 'サムネイルの設定はありません');
define('_MD_LEIMG_LANG_THUMBNAIL_REMAKE', 'サムネイルの再作成');
define('_MD_LEIMG_DESC_THUMBNAIL_REMAKE', 'サムネイル画像をすべて再作成します。再作成には、時間とサーバへの負荷がかかります。よろしければ、以下の「送信」ボタンを押してください。');

//blank 画像の拡張子
if(!defined('_MD_LEIMG_LANG_BLANK_EXT')) define('_MD_LEIMG_LANG_BLANK_EXT', 'gif');

?>
