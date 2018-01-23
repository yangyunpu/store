<?php
// +----------------------------------------------------------------------
// | 业务模式控制器
// +----------------------------------------------------------------------
// | Copyright (c) 2017年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   AboutController.php
// |
// | Author:    Elliot
// | Created:   2017-02-15
// +----------------------------------------------------------------------
namespace Soolife\Member\Pc\Controllers;
use Soolife\Member\Librarys\BaseController;

class ContactUsController extends BaseController
{
	public $contact = 'cn.soolife.intranet.contactus';
	public function contactInformationAction() {
		$this -> page->setContentTitle('联系我们', "",'contactUs/contactInformation.html');
		$this -> page -> init('联系我们', $this->contact);
	}
}