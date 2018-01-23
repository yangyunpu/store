<?php
// +----------------------------------------------------------------------
// |招商如此生活控制类
// +----------------------------------------------------------------------
// | Copyright (c) 2016年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   BusinessController.php
// | Author: Dandan_Sun
// | Created: 2016-11-04 13:38:32
// +----------------------------------------------------------------------
namespace Soolife\Sales\Mobile\Controllers;
use Soolife\Member\Librarys\BaseController;
use Soolife\Member\Services\BusinessService;

class BusinessController extends BaseController{
	//首页
	function indexAction(){
		$this->display("business/business");
	}

	//提交
	function submiteContentACtion(){
		$data['message'] = $this -> context -> get_post("message");
		$data['name'] = $this -> context -> get_post("name");
		$data['work'] = $this -> context -> get_post("work");
		$data['company'] = $this -> context -> get_post("company");
		$data['tel'] = $this -> context -> get_post("tel");
		$data['address'] = $this -> context -> get_post("address");
		$data['a'] = $this -> context -> get_post("a");
		if($data['a'] == 1){
			$str = file_get_contents(ROOT_PATH . "/public/template/template_mail_periodical.html");
			if(empty($str) || !isset($str)){
				$this->logger->error("文件不存在或者文件内容为空");
			}

			$content = str_replace('{{message}}',$data['message'],$str);
			$content = str_replace('{{name}}',$data['name'],$content);
			$content = str_replace('{{work}}',$data['work'],$content);
			$content = str_replace('{{company}}',$data['company'],$content);
			$content = str_replace('{{tel}}',$data['tel'],$content);
			$content = str_replace('{{address}}',$data['address'],$content);

			//写日志
			$this->logger->info(var_export($data,TRUE));
			//发送邮件
			ini_set("magic_quotes_runtime",0);
			require ROOT_PATH . '/apps/librarys/Phpmailer.php';
			try {
				$mail = new \PHPMailer(true);
				$mail->IsSMTP();
				$mail->CharSet='UTF-8'; //设置邮件的字符编码，这很重要，不然中文乱码
				$mail->SMTPAuth   = true;                  //开启认证
				$mail->Port       = $this->config->mail['smtp']['port'];                    //Port
				$mail->Host       = $this->config->mail['smtp']['server'];             //Mail Host
				$mail->Username   = $this->config->mail['smtp']['username'];    		//Send Mail From Address
				$mail->Password   = $this->config->mail['smtp']['password'];            //授权码
				//$mail->IsSendmail(); //如果没有sendmail组件就注释掉，否则出现“Could  not execute: /var/qmail/bin/sendmail ”的错误提示
				$mail->AddReplyTo($this->config->mail['smtp']['username'],$this->config->mail['fromName']);    //回复地址
				$mail->From       = $this->config->mail['fromEmail'];
				$mail->FromName   = $this->config->mail['fromName'];
				// $to = "jessica_wang@soolife.com.cn";
				$to = "dandan_sun@soolife.com.cn";
				$mail->AddAddress($to);
				$mail->Subject  = "[如此生活]招商";  //回复主题
				$mail->Body = $content;
				$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; //当邮件不支持html时备用显示，可以省略
				$mail->WordWrap   = 80; // 设置每行字符串的长度
				// $mail->AddAttachment("D:\wamp\apache\htdocs\phpmailer\bookmarks_16_5_15.html");  //可以添加附件
				$mail->IsHTML(true);
				$mail->Send();
				return $data['a'];
			} catch (\Exception $e) {
				return 0;
				echo "邮件发送失败：".$e->getMessage();
			}
		}else{
			return $data['a'];
		}
	}

	//地址
	function regionAction() {
		$pid = $this -> context -> get_query("pid");
		$explore = new BusinessService();
		$lists = $explore -> region($pid);
		$this -> success('', $lists);
	}

}