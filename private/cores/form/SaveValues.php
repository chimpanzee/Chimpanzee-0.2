<?php
final class CZCformSaveValues extends CZBase
{
	/**
	 * @param object $form
	 * @param string $part_name
	 * @param string $uploaded_path
	 * 
	 * @author Shin Uesugi
	 */
	private function _saveUploadedFile($form, $part_name, $uploaded_path)
	{
		$uploaded_files = $form->load('uploaded_files', array());
		$info = $_FILES[$part_name];
		$uploaded_files[$part_name] = array(
			'path' => $uploaded_path,
			'file' => basename($uploaded_path),
			'name' => $info['name'],
			'type' => $info['type'],
			'size' => $info['size'],
		);
		$form->save('uploaded_files', $uploaded_files);
	}
	
	/**
	 * @param object $form
	 * @param string $part_name
	 * 
	 * @return boolean / ''
	 * 
	 * @author Shin Uesugi
	 */
	private function _getUploadedFileValue($form, $part_name)
	{
		if (!isset($_FILES[$part_name])) {
			$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_FORM_INVALID_FORM_TAG_ENCTYPE);
		}
		if ($_FILES[$part_name]['error'] != UPLOAD_ERR_OK) {
			switch ($_FILES[$part_name]['error']) {
				case UPLOAD_ERR_NO_FILE:
					return '';
				case UPLOAD_ERR_INI_SIZE:
				case UPLOAD_ERR_FORM_SIZE:
					$err_msg = $this->_cz->getUser('config', 'form')->getValue('upload_file_size_err_msg', 'Please reduce the size of the file.');
					$this->_cz->newCore('form', 'save_err')->exec($form, $part_name, $err_msg);
					return FALSE;
					break;
				default:
					$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_FORM_UPLOAD_FILE, 'Part: ' . $part_name, $form->getMainClassName());
			}
		}
		
		if (!is_uploaded_file($_FILES[$part_name]['tmp_name'])) {
			$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_FORM_NOT_EXIST_UPLOADED_FILE, 'Part: ' . $part_name, $form->getMainClassName());
		}
		if (!($tmp_path = tempnam($this->_cz->tmp_dir, 'CZ'))) {
			$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_FORM_CREATE_TMP_FILE, 'Part:' . $part_name . '/Directory:' . $this->_cz->tmp_dir, $form->getMainClassName());
		}
		if (!move_uploaded_file($_FILES[$part_name]['tmp_name'], $tmp_path)) {
			@unlink($tmp_path);
			$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_FORM_WRITE_TMP_FILE, 'Part:' . $part_name . '/File:' . $tmp_path, $form->getMainClassName());
		}
		self::_saveUploadedFile($form, $part_name, $tmp_path);
		
		return TRUE;
	}
	
	/**
	 * @param object  $form
	 * @param string  $part_name
	 * @param array   $part
	 * @param array   $values
	 * @param boolean $post_flag
	 * 
	 * @return scalar
	 * 
	 * @author Shin Uesugi
	 */
	private function _getSetValue($form, $part_name, $part, $values, $post_flag)
	{
		if ($post_flag) {
			switch ($part['type']) {
				case 'text':
				case 'textarea':
					$value = stripslashes($values[$part_name]);
					if (isset($part['mb_convert_kana_option'])) {
						$option = $part['mb_convert_kana_option'];
						switch ($option) {
							case 'half':
								$option = 'as';
								break;
							case 'kana':
								$option = 'KCV';
								break;
						}
						$value = mb_convert_kana($value, $option);
					}
					break;
				case 'radio':
				case 'select':
				case 'password':
				case 'hidden':
					$value = stripslashes($values[$part_name]);
					break;
				case 'checkbox':
					$value = isset($values[$part_name]);
					break;
				case 'file':
					$value = self::_getUploadedFileValue($form, $part_name);
					break;
				default:
					$this->_cz->newCore('err', 'fatal')->exec(__FILE__, __LINE__, CZ_FATAL_FORM_INVALID_PART_TYPE, $part['type'], $form->getMainClassName());
			}
		} else {
			$value = isset($values[$part_name]) ? $values[$part_name] : '';
		}
		
		return $value;
	}
	
	/**
	 * @param object $form
	 * @param string $part_name
	 * @param array  $part
	 * @param array  $set_values
	 * 
	 * @return boolean
	 * 
	 * @author Shin Uesugi
	 */
	private function _isRequiredErr($form, $part_name, $part, $set_values)
	{
		$err_flag = FALSE;
		if (isset($part['required_flag']) && $part['required_flag']) {
			if (isset($part['parts'])) {
				$child_part_names = array_keys($part['parts']);
				foreach ($child_part_names as $child_part_name) {
					if ($set_values[$child_part_name] === '') {
						$err_flag = TRUE;
						break;
					}
				}
			} else {
				if ($set_values[$part_name] === '') {
					$err_flag = TRUE;
				}
			}
		}
		if ($err_flag) {
			$msg = $this->_cz->newUser('config', 'form')->getValue('required_err_msg', 'Please input it.');
			$this->_cz->newCore('form', 'save_err')->exec($form, $part_name, $msg);
		}
		
		return $err_flag;
	}
	
	/**
	 * @param object $form
	 * @param string $part_name
	 * @param array  $part
	 * @param array  $set_values
	 * 
	 * @return boolean
	 * 
	 * @author Shin Uesugi
	 */
	private function _isConfirmErr($form, $part_name, $part, $set_values)
	{
		if (isset($part['confirm']) && ($set_values[$part_name] !== $set_values[$part['confirm']])) {
			$msg = $this->_cz->newUser('config', 'form')->getValue('confirm_err_msg', 'The content is not corresponding.');
			$this->_cz->newCore('form', 'save_err')->exec($form, $part_name, $msg);
			return TRUE;
		}
		
		return FALSE;
	}
	
	/**
	 * @param object $form
	 * @param string $part_name
	 * @param array  $part
	 * @param array  $set_values
	 * 
	 * @return boolean
	 * 
	 * @author Shin Uesugi
	 */
	private function _isValidateErr($form, $part_name, $part, $set_values)
	{
		if (!isset($part['validate'])) {
			return FALSE;
		}
		
		$subject = isset($set_values[$part_name]) ? $set_values[$part_name] : '';
		if ($msg = $this->_cz->newCore('filter', 'validate')->exec($part['validate'], $subject, $set_values)) {
			$this->_cz->newCore('form', 'save_err')->exec($form, $part_name, $msg);
			return TRUE;
		}
		
		return FALSE;
	}
	
	/**
	 * @param object  $form
	 * @param array   $values
	 * @param boolean $post_flag (Set TRUE by self::byHttpPost / self::byHttpGet)
	 * 
	 * @return boolean
	 * 
	 * @author Shin Uesugi
	 */
	public function exec($form, $values, $post_flag = FALSE)
	{
		$form->free('err_msgs');
		
		$set_values = array();
		$parts = $form->getParts();
		foreach ($parts as $part_name => $part) {
			if (isset($part['parts'])) {
				foreach ($part['parts'] as $child_part_name => $child_part) {
					$set_values[$child_part_name] = self::_getSetValue($form, $child_part_name, $child_part, $values, $post_flag);
					if (!self::_isRequiredErr($form, $child_part_name, $child_part, $set_values)) {
						if (!self::_isConfirmErr($form, $child_part_name, $child_part, $set_values)) {
							self::_isValidateErr($form, $child_part_name, $child_part, $set_values);
						}
					}
				}
				if (!self::_isRequiredErr($form, $part_name, $part, $set_values)) {
					self::_isValidateErr($form, $part_name, $part, $set_values);
				}
			} else {
				$set_values[$part_name] = self::_getSetValue($form, $part_name, $part, $values, $post_flag);
				if (!self::_isRequiredErr($form, $part_name, $part, $set_values)) {
					if (!self::_isConfirmErr($form, $part_name, $part, $set_values)) {
						self::_isValidateErr($form, $part_name, $part, $set_values);
					}
				}
			}
		}
		
		$form->save('values', $set_values);
		
		return !$this->_cz->newCore('form', 'is_err')->exec($form);
	}

	/**
	 * @param object $form
	 * 
	 * @return boolean
	 * 
	 * @author Shin Uesugi
	 */
	public function byPost($form)
	{
		if ($_SERVER['REQUEST_METHOD'] != 'POST') {
			$this->_cz->newCore('forward', '404')->exec();
		}
		$form->free('uploaded_files');
		
		$values = $this->_cz->newCore('request', 'get_param')->getPostParams();
		
		return self::exec($form, $values, TRUE);
	}
}
?>