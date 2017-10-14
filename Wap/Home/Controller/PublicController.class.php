<?php
namespace Home\Controller;
use Think\Controller;
use Think\Upload;
use Think\Image;
ini_set('max_execution_time', 0);
class PublicController extends BaseController {
	public function verify() {
		$config = array('imageH' => 43, 'imageW' => 104, 'fontSize' => 14, 'fontttf' => '4.ttf', 'length' => 4,);
		$verify = new \Think\Verify($config);
		$verify -> entry();
	} 
	public function uploadify() {
		$targetFolder = 'avatar';
		if (!empty($_FILES)) {
			$url = $this -> _uploadimg($targetFolder, false);
			$img_info = getimagesize($url['image']);
			$width = $img_info[0];
			$height = $img_info[1];
			$this -> ajaxReturn(array('status' => 1, 'info' => '上传成功', 'url' => $url['image'], 'width' => $width, 'height' => $height));
		} 
	} 
	public function uploadimg() {
		$savePath = 'joke';
		if (!empty($_FILES)) {
			$url = $this -> _uploadimg($savePath, true);
			$this -> ajaxReturn(array('status' => 1, 'info' => '上传成功', 'url' => $url['image'], 'm_url' => $url['m_image']));
		} 
	} 
	public function uploadvedio() {
		$savePath = 'joke';
		if (!empty($_FILES)) {
			$url = $this -> _uploadvedio($savePath);
			$this -> ajaxReturn(array('status' => 1, 'info' => '上传成功', 'url' => $url));
		} 
	} 
	private function _uploadimg($savePath, $is_water) {
		$exts = array();
		if (trim($this -> setting['attach_pic_type']) != '') {
			array_push($exts, $this -> setting['attach_pic_type']);
		} 
		if (count($exts) > 0) {
			$exts = implode(',', $exts);
		} else {
			$exts = '*';
		} 
		$config = array('maxSize' => $this -> setting['attach_limit_size'], 'exts' => explode(',', $exts), 'savePath' => $savePath . '/', 'rootPath' => UPLOAD_PATH, 'subName' => array('date', 'Y/m/d'), 'saveName' => array('uniqid', ''));
		$upload = new Upload($config);
		if ($info = $upload -> upload($_FILES)) {
			$path = UPLOAD_PATH . $info['Filedata']['savepath'] . $info['Filedata']['savename'];
			if ($info['Filedata']['ext'] != 'gif' && $info['Filedata']['ext'] != 'GIF') {
				$img = new Image(Image :: IMAGE_GD, $path);
				if ($this -> setting['water_status'] == 1 && $is_water) {
					if ($this -> setting['water_type'] == 1) {
						$source = '.' . $this -> setting['water_img'];
						$img -> water($source, $this -> setting['water_pos'], $this -> setting['water_alpha']) -> save($path);
					} 
					if ($this -> setting['water_type'] == 0) {
						$img -> text($this -> setting['water_font'], $this -> setting['water_font_path'], $this -> setting['water_font_size'], $this -> setting['water_font_color'], $this -> setting['water_font_pos']) -> save($path);
					} 
				} 
				$m_path = UPLOAD_PATH . $info['Filedata']['savepath'] . 'm_' . $info['Filedata']['savename'];
				$img -> thumb(540, 10000) -> save($m_path);
			} 
			if ($info['Filedata']['ext'] == 'gif' || $info['Filedata']['ext'] == 'GIF') {
				$img = new Image(Image :: IMAGE_GD, $path);
				$m_path = UPLOAD_PATH . $info['Filedata']['savepath'] . 'm_' . $info['Filedata']['savename'];
				$img -> thumb(540, 10000) -> save($m_path);
			} 
			return array('image' => $path, 'm_image' => $m_path);
		} 
		return $upload -> getError();
	} 
	private function _uploadvedio($savePath) {
		$exts = array();
		if (trim($this -> setting['attach_video_type']) != '') {
			array_push($exts, $this -> setting['attach_video_type']);
		} 
		if (count($exts) > 0) {
			$exts = implode(',', $exts);
		} else {
			$exts = '*';
		} 
		$config = array('maxSize' => $this -> setting['attach_limit_size'], 'exts' => explode(',', $exts), 'savePath' => $savePath . '/', 'rootPath' => UPLOAD_PATH, 'subName' => array('date', 'Y/m/d'), 'saveName' => array('uniqid', ''));
		$upload = new Upload($config);
		if ($info = $upload -> upload($_FILES)) {
			$path = UPLOAD_PATH . $info['Filedata']['savepath'] . $info['Filedata']['savename'];
			return $path;
		} 
		return $upload -> getError();
	} 
	private function _uploadfile($savePath) {
		$exts = array();
		if (trim($this -> setting['attach_file_type']) != '') {
			array_push($exts, $this -> setting['attach_file_type']);
		} 
		if (count($exts) > 0) {
			$exts = implode(',', $exts);
		} else {
			$exts = '*';
		} 
		$config = array('maxSize' => $this -> setting['attach_limit_size'], 'exts' => explode(',', $exts), 'savePath' => $savePath . '/', 'rootPath' => UPLOAD_PATH, 'subName' => array('date', 'Y/m/d'), 'saveName' => array('uniqid', ''));
		$upload = new Upload($config);
		if ($info = $upload -> upload($_FILES)) {
			$path = UPLOAD_PATH . $info['Filedata']['savepath'] . $info['Filedata']['savename'];
			return $path;
		} 
		return $upload -> getError();
	} 
	public function token() {
		vendor('Qiniu.Auth', '', '.class.php');
		vendor('Qiniu.Config', '', '.class.php');
		vendor('Qiniu.Etag', '', '.class.php');
		vendor('Qiniu.functions', '', '.class.php');
		vendor('Qiniu.Zone', '', '.class.php');
		vendor('Qiniu.Http.Client', '', '.class.php');
		vendor('Qiniu.Http.Error', '', '.class.php');
		vendor('Qiniu.Http.Request', '', '.class.php');
		vendor('Qiniu.Http.Response', '', '.class.php');
		vendor('Qiniu.Process.PersistenFop', '', '.class.php');
		vendor('Qiniu.Storage.BucketManager', '', '.class.php');
		vendor('Qiniu.Storage.FormUploader', '', '.class.php');
		vendor('Qiniu.Storage.ResumeUploader', '', '.class.php');
		vendor('Qiniu.Storage.UploadManager', '', '.class.php');
		$accessKey = $this -> setting['qiniu_access_key'];
		$secretKey = $this -> setting['qiniu_secret_key'];
		$auth = new \Auth($accessKey, $secretKey);
		$bucket = $this -> setting['qiniu_name'];
		$token = $auth -> uploadToken($bucket);
		$this -> ajaxReturn(array('uptoken' => $token));
	} 
} 
