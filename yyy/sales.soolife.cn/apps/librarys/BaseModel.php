<?php
// +----------------------------------------------------------------------
// | 基类数据模型
// +----------------------------------------------------------------------
// | Copyright (c) 2015年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   BaseController.php
// |
// | Author: Tony Wang <tony@iapp.hk>
// | Created:   2014-12-20
// +----------------------------------------------------------------------
namespace Soolife\Member\Librarys;
use Phalcon\Mvc\User\Component;

/**
 * 基类数据模型
 */
class BaseModel extends Component {
	var $path = "";
	
	function toJSON()
	{
		return json_encode($this);
	}
}
?>	