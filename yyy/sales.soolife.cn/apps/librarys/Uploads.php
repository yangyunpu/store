<?php
// +----------------------------------------------------------------------
// | 上传类
// +----------------------------------------------------------------------
// | Copyright (c) 2016年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   Users.php
// |
// | Author: Tony Wang <tony@iapp.hk>
// | Created:   2015-05-12
// +----------------------------------------------------------------------
namespace Soolife\Member\Librarys;
use Phalcon\Mvc\User\Component;

/**
 * 上传文件类
 * @author Tony Wang<tony@iapp.hk>
 */
class Uploads extends Component {
	private $error = '';
	private $mimes = array(); //允许上传的文件MiMe类型
    private $maxSize =  0; //上传的文件大小限制 (0-不做限制)
    private $exts =  array(); //允许上传的文件后缀
    private $autoSub = true; //自动子目录保存文件
    private $subName = array('date', 'Y-m-d');//子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
    private $rootPath =  '/public/uploads/'; //保存根路径
    private $savePath = 'images'; //保存路径
    private $saveName =  array('uniqid', '');//上传文件命名规则，[0]-函数名，[1]-参数，多个参数使用数组
    private $saveExt =  ''; //文件保存后缀，空则使用原后缀
    private $replace =  false; //存在同名是否覆盖
    private $hash =  true; //是否生成hash编码
	
	// 错误信息
	public function init() {
		$ini = $this -> config -> upload;
		$this->mimes = $ini->mimes;
		$this->maxSize = $ini->maxSize;
		$this->exts = $ini->exts;
		$this->rootPath = ROOT_PATH.$ini->rootPath;	
	}

	/**
	 * 获取最后一次上传错误信息
	 * @return string 错误信息
	 */
	public function getError() {
		return $this -> error;
	}

	/**
	 * 上传单个文件
	 * @param  array  $file 文件数组
	 * @return array        上传成功后的文件信息
	 */
	public function uploadOne($files = '',$path = "images/") {
		$info = $this -> upload(array($file),$path);		
		return $info ? $info[0] : $info;
	}

	/**
	 * 上传文件
	 * @param 文件信息数组 $files ，通常是 $_FILES数组
	 */
	public function upload($files = '',$path = "images/") {
		$this->init();
		if ('' === $files) {
			$files = $_FILES;
		}
		$this->savePath = $path;
		if (empty($files)) {
			$this -> error = '没有上传的文件！';
			return false;
		}
		/* 检测上传根目录 */
		if (!$this -> checkRootPath($this -> rootPath)) {
			return false;
		}

		/* 检查上传目录 */
		if (!$this -> checkSavePath($this -> savePath)) {
			return false;
		}

		/* 逐个检测并上传文件 */
		$info = array();
		if (function_exists('finfo_open')) {
			$finfo = finfo_open(FILEINFO_MIME_TYPE);
		}
		// 对上传文件数组信息处理
		foreach ($files as $key => $file) {
			//var_dump($files);exit;
			if (!isset($file['key']))
				$file['key'] = $key;

			//* 通过扩展获取文件类型，可解决FLASH上传$FILES数组返回文件类型错误的问题 */
			if (isset($finfo)) {
				$file['type'] = finfo_file($finfo, $file['tmp_name']);
			}

			/* 获取上传文件后缀，允许上传无后缀文件 */
			$file['ext'] = pathinfo($file['name'], PATHINFO_EXTENSION);

			/* 文件上传检测 */
			if (!$this -> check($file)) {
				continue;
			}

			/* 获取文件hash */
            if($this->hash){
                $file['md5']  = md5_file($file['tmp_name']);
                $file['sha1'] = sha1_file($file['tmp_name']);
            }
       
            /* 生成保存文件名 */
            $savename = $this->getSaveName($file);
            if(false == $savename){
                continue;
            } else {
                $file['savename'] = $savename;
            }

            /* 检测并创建子目录 */
            $subpath = $this->getSubPath($file['name']);
			//var_dump($subpath);exit;
            if(false === $subpath){
                continue;
            } else {
                $file['savepath'] = $this->savePath . $subpath;
            }

            /* 对图像文件进行严格检测 */
            $ext = strtolower($file['ext']);
            if(in_array($ext, array('gif','jpg','jpeg','bmp','png','swf'))) {
                $imginfo = getimagesize($file['tmp_name']);
                if(empty($imginfo) || ($ext == 'gif' && empty($imginfo['bits']))){
                    $this->error = '非法图像文件！';
                    continue;
                }
            }

            /* 保存文件 并记录保存成功的文件 */
            if ($this->save($file,$this->replace)) {
                unset($file['error'], $file['tmp_name']);
                $info[$key] = $file;
            } 
		}
		if (isset($finfo)) {
			finfo_close($finfo);
		}
		return empty($info) ? false : $info;
	}

	/**
	 * 检测上传根目录
	 * @param string $rootpath   根目录
	 * @return boolean true-检测通过，false-检测失败
	 */
	public function checkRootPath($rootpath) {
		//var_dump($rootpath);exit;
		if (!(is_dir($rootpath) && is_writable($rootpath))) {
			$this -> error = '上传根目录不存在！请尝试手动创建:' . $rootpath;
			return false;
		}
		$this -> rootPath = $rootpath;
		return true;
	}

	/**
	 * 检测上传目录
	 * @param  string $savepath 上传目录
	 * @return boolean          检测结果，true-通过，false-失败
	 */
	public function checkSavePath($savepath) {
		/* 检测并创建目录 */
		if (!$this -> mkdir($savepath)) {
			return false;
		} else {
			/* 检测目录是否可写 */
			if (!is_writable($this -> rootPath . $savepath)) {
				$this -> error = '上传目录 ' . $savepath . ' 不可写！';
				return false;
			} else {
				return true;
			}
		}
	}

	/**
	 * 保存指定文件
	 * @param  array   $file    保存的文件信息
	 * @param  boolean $replace 同名文件是否覆盖
	 * @return boolean          保存状态，true-成功，false-失败
	 */
	public function save($file, $replace = true) {
		$filename = $this -> rootPath . $file['savepath'] . $file['savename'];

		/* 不覆盖同名文件 */
		if (!$replace && is_file($filename)) {
			$this -> error = '存在同名文件' . $file['savename'];
			return false;
		}

		/* 移动文件 */
		if (!move_uploaded_file($file['tmp_name'], $filename)) {
			$this -> error = '文件上传保存错误！';
			return false;
		}

		return true;
	}

	/**
	 * 创建目录
	 * @param  string $savepath 要创建的穆里
	 * @return boolean          创建状态，true-成功，false-失败
	 */
	public function mkdir($savepath) {
		$dir = $this -> rootPath . $savepath;
		if (is_dir($dir)) {
			return true;
		}
		if (mkdir($dir, 0777, true)) {
			return true;
		} else {
			$this -> error = "目录 {$savepath} 创建失败！";
			return false;
		}
	}

	/**
	 * 检查上传的文件
	 * @param array $file 文件信息
	 */
	private function check($file) {
		/* 文件上传失败，捕获错误代码 */
		if ($file['error']) {
			$this -> error($file['error']);
			return false;
		}

		/* 无效上传 */
		if (empty($file['name'])) {
			$this -> error = '未知上传错误！';
		}

		/* 检查是否合法上传
		 * 文件是通过 HTTP POST 上传的则返回 TRUE
		 * 可以用于确保恶意的用户无法欺骗脚本去访问本不能访问的文件*/
		if (!is_uploaded_file($file['tmp_name'])) {
			$this -> error = '非法上传文件！';
			return false;
		}

		/* 检查文件大小 */
		if (!$this -> checkSize($file['size'])) {
			$this -> error = '上传文件大小不符！';
			return false;
		}

		/* 检查文件Mime类型 */
		//TODO:FLASH上传的文件获取到的mime类型都为application/octet-stream
		if (!$this -> checkMime($file['type'])) {
			$this -> error = '上传文件MIME类型不允许！';
			return false;
		}

		/* 检查文件后缀 */
		if (!$this -> checkExt($file['ext'])) {
			$this -> error = '上传文件后缀不允许';
			return false;
		}
		/* 通过检测 */
		return true;
	}

	/**
	 * 获取错误代码信息
	 * @param string $errorNo  错误号
	 */
	private function error($errorNo) {
		switch ($errorNo) {
			case 1 :
				$this -> error = '上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值！';
				break;
			case 2 :
				$this -> error = '上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值！';
				break;
			case 3 :
				$this -> error = '文件只有部分被上传！';
				break;
			case 4 :
				$this -> error = '没有文件被上传！';
				break;
			case 6 :
				$this -> error = '找不到临时文件夹！';
				break;
			case 7 :
				$this -> error = '文件写入失败！';
				break;
			default :
				$this -> error = '未知上传错误！';
		}
	}

	/**
	 * 检查文件大小是否合法
	 * @param integer $size 数据
	 */
	private function checkSize($size) {
		$maxSize = $this -> config -> upload -> maxSize;
		return !($size > $maxSize) || (0 == $maxSize);
	}

	/**
	 * 检查上传的文件MIME类型是否合法
	 * @param string $mime 数据
	 */
	private function checkMime($mime) {
		//print_r($mime);
		$mimes = $this -> config -> upload -> mimes -> toArray();
		return empty($mimes) ? true : in_array(strtolower($mime), $mimes);
	}

	/**
	 * 检查上传的文件后缀是否合法
	 * @param string $ext 后缀
	 */
	private function checkExt($ext) {
		$exts = $this -> config -> upload -> exts -> toArray();
		return empty($exts) ? true : in_array(strtolower($ext), $exts);
	}

	/**
	 * 根据上传文件命名规则取得保存文件名
	 * @param string $file 文件信息
	 */
	private function getSaveName($file) {
		$rule = $this -> saveName;
		if (empty($rule)) {//保持文件名不变
			/* 解决pathinfo中文文件名BUG */
			$filename = substr(pathinfo("_{$file['name']}", PATHINFO_FILENAME), 1);
			$savename = $filename;
		} else {
			$savename = $this -> getName($rule, $file['name']);
			if (empty($savename)) {
				$this -> error = '文件命名规则错误！';
				return false;
			}
		}

		/* 文件保存后缀，支持强制更改文件后缀 */
		$ext = empty($this -> config['saveExt']) ? $file['ext'] : $this -> saveExt;

		return $savename . '.' . $ext;
	}

	/**
	 * 获取子目录的名称
	 * @param array $file  上传的文件信息
	 */
	private function getSubPath($filename) {
		$subpath = '';
		$rule = $this -> subName;
		if ($this -> autoSub && !empty($rule)) {
			$subpath = $this -> getName($rule, $filename) . '/';

			if (!empty($subpath) && !$this -> mkdir($this -> savePath . $subpath)) {
				$this -> error = $this -> getError();
				return false;
			}
		}
		return $subpath;
	}

	/**
	 * 根据指定的规则获取文件或目录名称
	 * @param  array  $rule     规则
	 * @param  string $filename 原文件名
	 * @return string           文件或目录名称
	 */
	private function getName($rule, $filename) {
		$name = '';
		if (is_array($rule)) {//数组规则
			$func = $rule[0];
			$param = (array)$rule[1];
			foreach ($param as &$value) {
				$value = str_replace('__FILE__', $filename, $value);
			}
			$name = call_user_func_array($func, $param);
		} elseif (is_string($rule)) {//字符串规则
			if (function_exists($rule)) {
				$name = call_user_func($rule);
			} else {
				$name = $rule;
			}
		}
		return $name;
	}

	/////////////////////////////////////////////////////////////////////
	/**
	 * 上传文件到远程服务器
	 * @author Tony Wang 2016-05-19
	 * @param $filename array 上传目录下临时文件
	 * @param $url 提交数据地址
	 * @param $data 提交数据表单
	 */
	function upload_remote($files,$url='',$data=array()) {
		//print_r($data);
		//print_r($files);
		$this->init(); // 读取配置
		$orgid = $this -> config -> application -> orgid;
		$info = array();
		//var_dump($files);exit;
		// 上传文件到接口
		if (empty($url))
			$url = '/v1/file/upload';
		$post = array(
			'path' => 'images',
			'owner' => "{$orgid}"
		);
		
		$index = 1;
	//var_dump($files);exit;
		foreach ($files as $k => $v) {
			$path_file = realpath(ROOT_PATH . $v);
			//var_dump($path_file);
			if (file_exists($path_file))
			{	
				$post["file{$index}"] = new \CURLFile($path_file);	
			}
			$index ++;
		}
		//print_r($post);
		if ($this -> curl -> upload_request($url, $post, $data) == 200) {
			//unset($path_file);
			return $this -> curl -> getArrayData();
		}else{
			$d = $this -> curl -> getArrayData();
			if (isset($d) && count($d)>0){
				$this->error = $d['Message'];
			}
		}
		//print_r($this -> curl -> getResponseText());exit;
		return null;
	}
	
	/**
	 * 
	 */
	function covert_base64($files) {
		// $info = array();
		// foreach ($files as $k => $v) {
			// $path_file = realpath(ROOT_PATH . $v);
			// if (file_exists($path_file)){
				// $content = file_get_contents($path_file); 
				// $info[$k] = base64_encode($content);
			// }
		// }
		$path_file = realpath(ROOT_PATH . $files);
		if (file_exists($path_file)){
				$content = file_get_contents($path_file); 
				$info = base64_encode($content);
			}
		
		return $info;
	}
}
