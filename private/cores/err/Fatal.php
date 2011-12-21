<?php
// Common
define('CZ_FATAL_COMMON_NOT_EXIST_ACTION_NAME', 0x0101);

// Err
define('CZ_FATAL_ERR_NOT_SAVED_MSG', 0x0201);

// Obj
define('CZ_FATAL_OBJ_INVALID_MAIN_TYPE',      0x0301);
define('CZ_FATAL_OBJ_INVALID_SUB_TYPE',       0x0302);
define('CZ_FATAL_OBJ_NOT_EXIST_CLASS_FILE',   0x0303);
define('CZ_FATAL_OBJ_NOT_LOADED_DYNAMIC_OBJ', 0x0304);

// Config
define('CZ_FATAL_CONFIG_SET_VAR',     0x0401);
define('CZ_FATAL_CONFIG_NOT_SET_VAR', 0x0402);

// Ses
define('CZ_FATAL_SES_NOT_SET_VAR', 0x0501);
define('CZ_FATAL_SES_NOT_SECURE',  0x0502);

// Var
define('CZ_FATAL_VAR_NOT_SAVED_VAR', 0x0601);

// DB
define('CZ_FATAL_DB_NOT_SET_SERVER_MAIN',   0x0701);
define('CZ_FATAL_DB_NOT_SET_SERVER_SUB',    0x0702);
define('CZ_FATAL_DB_NOT_SET_SERVER_DSN',    0x0703);
define('CZ_FATAL_DB_NOT_SET_SERVER_USER',   0x0704);
define('CZ_FATAL_DB_NOT_SET_SERVER_PASS',   0x0705);
define('CZ_FATAL_DB_NOT_SUPPORT_DRIVER',    0x0706);
define('CZ_FATAL_DB_CONNECT_SERVER',        0x0707);
define('CZ_FATAL_DB_BEGIN_TRAN',            0x0708);
define('CZ_FATAL_DB_COMMIT_TRAN',           0x0709);
define('CZ_FATAL_DB_PREPARE_QUERY',         0x070a);
define('CZ_FATAL_DB_BIND_VALUE',            0x070b);
define('CZ_FATAL_DB_EXEC_QUERY',            0x070c);
define('CZ_FATAL_DB_INVALID_SET_VALUE_KEY', 0x070d);

// Filter
define('CZ_FATAL_FILTER_NOT_SET_FUNC',       0x0801);
define('CZ_FATAL_FILTER_NOT_SET_REF',        0x0802);
define('CZ_FATAL_FILTER_NOT_SET_REF_VALUE',  0x0803);
define('CZ_FATAL_FILTER_NOT_SET_FUNC_PARAM', 0x0804);

// Model
define('CZ_FATAL_MODEL_NOT_SET_TABLE_NAME',               0x0901);
define('CZ_FATAL_MODEL_NOT_SET_ID_COLUMN_NAME',           0x0902);
define('CZ_FATAL_MODEL_NOT_SET_FORMAT_TABLE_VALUE',       0x0903);
define('CZ_FATAL_MODEL_GET_RECORD',                       0x0904);
define('CZ_FATAL_MODEL_INVALID_MODEL_SET_VALUE_KEY',      0x0905);
define('CZ_FATAL_MODEL_INVALID_FORM_SET_VALUE_KEY',       0x0906);
define('CZ_FATAL_MODEL_NOT_EXIST_UNIQUE_COLUMN_NAME',     0x0907);
define('CZ_FATAL_MODEL_NOT_BEGUN_UPDATE',                 0x0908);
define('CZ_FATAL_MODEL_NOT_BEGUN_DELETE',                 0x0909);
define('CZ_FATAL_MODEL_ADDED_RECORDS',                    0x090a);
define('CZ_FATAL_MODEL_NOT_ADDED_RECORDS',                0x090b);
define('CZ_FATAL_MODEL_NOT_SET_FORM_SET_VALUE_REF_VALUE', 0x090c);
define('CZ_FATAL_MODEL_INVALID_COLUMN_NAME',              0x090d);
define('CZ_FATAL_MODEL_NOT_ENABLED_PAGING',               0x090e);

// Form
define('CZ_FATAL_FORM_SET_PART',                 0x0a01);
define('CZ_FATAL_FORM_NOT_SET_PARTS',            0x0a02);
define('CZ_FATAL_FORM_INVALID_PART_TYPE',        0x0a03);
define('CZ_FATAL_FORM_NOT_EXIST_UPLOADED_FILE',  0x0a04);
define('CZ_FATAL_FORM_CREATE_TMP_FILE',          0x0a05);
define('CZ_FATAL_FORM_WRITE_TMP_FILE',           0x0a06);
define('CZ_FATAL_FORM_UPLOAD_FILE',              0x0a07);
define('CZ_FATAL_FORM_NOT_POST',                 0x0a08);
define('CZ_FATAL_FORM_NOT_SET_PART',             0x0a09);
define('CZ_FATAL_FORM_NOT_SAVED_ERR_MSG',        0x0a0a);
define('CZ_FATAL_FORM_NOT_SET_PART_TABLE',       0x0a0b);
define('CZ_FATAL_FORM_USE_PART_TYPE',            0x0a0c);
define('CZ_FATAL_FORM_INVALID_FORM_TAG_ENCTYPE', 0x0a0d);
define('CZ_FATAL_FORM_NOT_SAVED_VALUES',         0x0a0e);
define('CZ_FATAL_FORM_SET_PART_PROPERTY',        0x0a0f);

// View
define('CZ_FATAL_VIEW_ADDED_VAR',      0x0b01);
define('CZ_FATAL_VIEW_NOT_EXIST_FILE', 0x0b02);
define('CZ_FATAL_VIEW_READ_FILE',      0x0b03);

// Table
define('CZ_FATAL_TABLE_NOT_SET_TABLE', 0x0c01);
define('CZ_FATAL_TABLE_NOT_SET_ID',    0x0c02);

// Request
define('CZ_FATAL_REQUEST_INVALID_VAR_NAME', 0x0d01);

// Html
define('CZ_FATAL_HTML_NOT_SET_HTML_TYPE', 0x0e01);
define('CZ_FATAL_HTML_INVALID_HTML_TYPE', 0x0e02);

// Image
define('CZ_FATAL_IMAGE_CREATE_TMP_FILE',  0x0f01);
define('CZ_FATAL_IMAGE_WRITE_FILE',       0x0f02);
define('CZ_FATAL_IMAGE_DELETE_FILE',      0x0f03);
define('CZ_FATAL_IMAGE_GET_INFO',         0x0f04);
define('CZ_FATAL_IMAGE_NOT_SUPPORT_TYPE', 0x0f05);
define('CZ_FATAL_IMAGE_READ_GIF_FILE',    0x0f06);
define('CZ_FATAL_IMAGE_READ_JPEG_FILE',   0x0f07);
define('CZ_FATAL_IMAGE_READ_PNG_FILE',    0x0f08);
define('CZ_FATAL_IMAGE_CREATE_RESOURCE',  0x0f09);
define('CZ_FATAL_IMAGE_RESAMPLE_DATA',    0x0f0a);
define('CZ_FATAL_IMAGE_DISPLAY_PNG',      0x0f0b);
define('CZ_FATAL_IMAGE_INVALID_DIR_TYPE', 0x0f0c);

// Login
define('CZ_FATAL_LOGIN_NOT_SET_AUTH_COLUMN_NAMES',       0x1001);
define('CZ_FATAL_LOGIN_NOT_SET_AUTH_VALUE',              0x1002);
define('CZ_FATAL_LOGIN_AUTHORIZED',                      0x1003);
define('CZ_FATAL_LOGIN_NOT_SET_AUTO_REDIRECT_CTRL_NAME', 0x1004);
define('CZ_FATAL_LOGIN_NOT_SAVED_SRC_URL',               0x1005);

// Mail
define('CZ_FATAL_MAIL_READ_TEMPLATE_FILE', 0x1101);

// Facebook
define('CZ_FATAL_FACEBOOK_ILLEGAL_ACCESS', 0x1201);


final class CZCerrFatal extends CZBase
{
	/*
	 * Fatal error messages.
	 * 
	 * @author Takamichi Yanai
	 */
	private $_msgs = array(
		// Common
		CZ_FATAL_COMMON_NOT_EXIST_ACTION_NAME => 'Action name is missing.',

		// Err
		CZ_FATAL_ERR_NOT_SAVED_MSG => 'The error message is not saved.',

		// Obj
		CZ_FATAL_OBJ_INVALID_MAIN_TYPE      => 'Global object type is invalid.',
		CZ_FATAL_OBJ_INVALID_SUB_TYPE       => 'User object type is invalid.',
		CZ_FATAL_OBJ_NOT_EXIST_CLASS_FILE   => 'The class file does not exist.',
		CZ_FATAL_OBJ_NOT_LOADED_DYNAMIC_OBJ => 'The dynamic object is not loaded.',

		// Config
		CZ_FATAL_CONFIG_SET_VAR     => 'The config variable is already set.',
		CZ_FATAL_CONFIG_NOT_SET_VAR => 'The config variable is not set.',

		// Ses
		CZ_FATAL_SES_NOT_SET_VAR => 'The session variable is not set.',
		CZ_FATAL_SES_NOT_SECURE  => 'CZ_FATAL_SES_NOT_SECURE',	//TODO: Modify to Yanai-sann by Shin.

		// Var
		CZ_FATAL_VAR_NOT_SAVED_VAR => 'The variable is not saved.',

		// DB
		CZ_FATAL_DB_NOT_SET_SERVER_MAIN   => 'Main DB Server is not set.',
		CZ_FATAL_DB_NOT_SET_SERVER_SUB    => 'Sub DB Server is not set.',
		CZ_FATAL_DB_NOT_SET_SERVER_DSN    => 'DB DSN is not set.',
		CZ_FATAL_DB_NOT_SET_SERVER_USER   => 'DB username is not set.',
		CZ_FATAL_DB_NOT_SET_SERVER_PASS   => 'DB password is not set.',
		CZ_FATAL_DB_NOT_SUPPORT_DRIVER    => 'The DB driver is not supported.',
		CZ_FATAL_DB_CONNECT_SERVER        => 'Cannot connect to server.',
		CZ_FATAL_DB_BEGIN_TRAN            => 'Cannot begin transaction.',
		CZ_FATAL_DB_COMMIT_TRAN           => 'Cannot commit transaction.',
		CZ_FATAL_DB_PREPARE_QUERY         => 'Cannot prepare query.',
		CZ_FATAL_DB_BIND_VALUE            => 'Cannot bind value.',
		CZ_FATAL_DB_EXEC_QUERY            => 'Cannot execute query.',
		CZ_FATAL_DB_INVALID_SET_VALUE_KEY => 'Invalid set-value key.',

		// Filter
		CZ_FATAL_FILTER_NOT_SET_FUNC       => 'The function is not set.',
		CZ_FATAL_FILTER_NOT_SET_REF        => 'The reference is not set.',
		CZ_FATAL_FILTER_NOT_SET_REF_VALUE  => 'The value in the reference is not set.',
		CZ_FATAL_FILTER_NOT_SET_FUNC_PARAM => 'The parameter in the function is not set.',

		// Model
		CZ_FATAL_MODEL_NOT_SET_TABLE_NAME               => 'Table name is not set.',
		CZ_FATAL_MODEL_NOT_SET_ID_COLUMN_NAME           => 'ID column name is not set.',
		CZ_FATAL_MODEL_NOT_SET_FORMAT_TABLE_VALUE       => 'Format table value is not set.',
		CZ_FATAL_MODEL_GET_RECORD                       => 'Cannot get record.',
		CZ_FATAL_MODEL_INVALID_MODEL_SET_VALUE_KEY      => 'Model-set-value key is invalid.',
		CZ_FATAL_MODEL_INVALID_FORM_SET_VALUE_KEY       => 'Form-set-value key is invalid.',
		CZ_FATAL_MODEL_NOT_EXIST_UNIQUE_COLUMN_NAME     => 'Unique column specified does not exist.',
		CZ_FATAL_MODEL_NOT_BEGUN_UPDATE                 => 'Update not started.',
		CZ_FATAL_MODEL_NOT_BEGUN_DELETE                 => 'Delete not started.',
		CZ_FATAL_MODEL_ADDED_RECORDS                    => 'Records are already added.',
		CZ_FATAL_MODEL_NOT_ADDED_RECORDS                => 'Records are not added.',
		CZ_FATAL_MODEL_NOT_SET_FORM_SET_VALUE_REF_VALUE => 'Reference of form-set-value value is not set.',
		CZ_FATAL_MODEL_INVALID_COLUMN_NAME              => 'The column name is invalid.',
		CZ_FATAL_MODEL_NOT_ENABLED_PAGING               => 'Paging is not enabled.',

		// Form
		CZ_FATAL_FORM_SET_PART                 => 'The part(input property) is already set.',
		CZ_FATAL_FORM_NOT_SET_PARTS            => 'The parts(input property set) are not set.',
		CZ_FATAL_FORM_INVALID_PART_TYPE        => 'The part(input) type is invalid.',
		CZ_FATAL_FORM_NOT_EXIST_UPLOADED_FILE  => 'The uploaded file does not exist.',
		CZ_FATAL_FORM_CREATE_TMP_FILE          => 'Cannot create temporary file.',
		CZ_FATAL_FORM_WRITE_TMP_FILE           => 'Cannot write temporary file.',
		CZ_FATAL_FORM_UPLOAD_FILE              => 'Cannot upload file.',
		CZ_FATAL_FORM_NOT_POST                 => 'The HTTP request type is not POST.',
		CZ_FATAL_FORM_NOT_SET_PART             => 'The part(input property) is not set.',
		CZ_FATAL_FORM_NOT_SAVED_ERR_MSG        => 'The error message is not set.',
		CZ_FATAL_FORM_NOT_SET_PART_TABLE       => 'The table in the part(input property) is not set.',
		CZ_FATAL_FORM_USE_PART_TYPE            => 'Cannot use this part(input) type.',
		CZ_FATAL_FORM_INVALID_FORM_TAG_ENCTYPE => 'Encryption type of uploaded file is invalid.',
		CZ_FATAL_FORM_NOT_SAVED_VALUES         => 'No Values are saved.',
		CZ_FATAL_FORM_SET_PART_PROPERTY        => 'This property element is already set.',

		// View
		CZ_FATAL_VIEW_ADDED_VAR      => 'The variable is already added.',
		CZ_FATAL_VIEW_NOT_EXIST_FILE => 'The file does not exist.',
		CZ_FATAL_VIEW_READ_FILE      => 'Cannot read file.',

		// Table
		CZ_FATAL_TABLE_NOT_SET_TABLE => 'The table is not set.',
		CZ_FATAL_TABLE_NOT_SET_ID    => 'The ID is invalid.',

		// Request
		CZ_FATAL_REQUEST_INVALID_VAR_NAME => 'Variable name is invalid.',

		// Html
		CZ_FATAL_HTML_NOT_SET_HTML_TYPE => 'Html type is not set.',
		CZ_FATAL_HTML_INVALID_HTML_TYPE => 'Html type is invalid.',

		// Image
		CZ_FATAL_IMAGE_CREATE_TMP_FILE  => 'Cannot create temporary file.',
		CZ_FATAL_IMAGE_WRITE_FILE       => 'Cannot write file.',
		CZ_FATAL_IMAGE_DELETE_FILE      => 'Cannot delete file.',
		CZ_FATAL_IMAGE_GET_INFO         => 'Cannot get image info.',
		CZ_FATAL_IMAGE_NOT_SUPPORT_TYPE => 'This image type is not supported.',
		CZ_FATAL_IMAGE_READ_GIF_FILE    => 'Cannot read GIF file.',
		CZ_FATAL_IMAGE_READ_JPEG_FILE   => 'Cannot read JPG file.',
		CZ_FATAL_IMAGE_READ_PNG_FILE    => 'Cannot read PNG file.',
		CZ_FATAL_IMAGE_CREATE_RESOURCE  => 'Cannot create image resource.',
		CZ_FATAL_IMAGE_RESAMPLE_DATA    => 'Cannot resample data.',
		CZ_FATAL_IMAGE_DISPLAY_PNG      => 'Cannot display PNG.',
		CZ_FATAL_IMAGE_INVALID_DIR_TYPE => 'The directory type is invalid.',

		// Login
		CZ_FATAL_LOGIN_NOT_SET_AUTH_COLUMN_NAMES       => 'Auth column names are not set.',
		CZ_FATAL_LOGIN_NOT_SET_AUTH_VALUE              => 'Auth value is not set.',
		CZ_FATAL_LOGIN_AUTHORIZED                      => 'Already logged in.',
		CZ_FATAL_LOGIN_NOT_SET_AUTO_REDIRECT_CTRL_NAME => 'Auto-redirect controller name is not set.',
		CZ_FATAL_LOGIN_NOT_SAVED_SRC_URL               => 'CZ_FATAL_LOGIN_NOT_SAVED_SRC_URL',	//TODO: Modify to Yanai-sann by Shin.

		// Mail
		CZ_FATAL_MAIL_READ_TEMPLATE_FILE => 'Cannot read template file.',

		// Facebook
		CZ_FATAL_FACEBOOK_ILLEGAL_ACCESS => 'CZ_FATAL_FACEBOOK_ILLEGAL_ACCESS',	//TODO: Modify to Yanai-sann by Shin.
	);


	/**
	 * @param string  $path
	 * @param integer $file_line
	 * @param integer $fatal_id
	 * @param string  $add_msg
	 * @param string  $relating_obj_name
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($path, $file_line, $fatal_id, $add_msg = '', $relating_obj_name = '')
	{
		if (!isset($this->_msgs[$fatal_id])) {
			throw new CZException('Invalid fatal id.(' . $fatal_id . ')');
		}

		$msg = $this->_msgs[$fatal_id];
		if ($this->_cz->develop_flag) {
			if ($this->_cz->isValidStr($add_msg)) {
				$msg .= '(' . $add_msg . ')';
			}
			$msg .= ' => ' . $path . ':' . $file_line;
			if ($this->_cz->isValidStr($relating_obj_name)) {
				$msg .= '(Relating object: ' . $relating_obj_name . ')';
			}
		}

		throw new CZException($msg, $fatal_id);
	}
}
?>