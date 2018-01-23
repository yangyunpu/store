<?php
// +----------------------------------------------------------------------
// | 上传图片
// +----------------------------------------------------------------------
// | Copyright (c) 2016年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | Author: Dandan_sun
// | Created: 2017-07-03 10:12:00
// +----------------------------------------------------------------------
namespace Soolife\Cms\Services;
use Soolife\Cms\Librarys\BaseService;
use Soolife\Cms\Librarys\Common;
class PcService extends BaseService {
	public function __construct()
	{
		$this -> select_db('database');
	}
	/**
	 * 检查商品sku
	 * return array
	 */
	public function checkSku($skuid)
	{
		$sql = "SELECT `Sku_ID`,`S_Logo`,`S_Name`,`S_MarketPrice`,`S_ShopPrice` FROM `GM_Sku` WHERE `Sku_ID` = :Sku_ID;";
		$data = $this-> db -> fetchOne($sql,\Phalcon\Db::FETCH_ASSOC,array(
				'Sku_ID' => $skuid,
		));
		if (!empty($data)) {
			$data['S_Logo']= Common::get_image_url($this->config,$data['S_Logo']);
		}
		return $data;
	}

	/**
	 * 上传图片
	 */
	public function index($all_pic){
		$data = array();
		// 写入文件库
		foreach ($all_pic as $key => $value) {
			$this->select_db('db_imgs');
			$sql = "SELECT O_MD5 FROM FS_Others WHERE O_MD5='{$value['pic']}';";
			$result = $this->sdb->fetchOne($sql);
			if (!$result)
			{
				$sql = "INSERT INTO `FS_Others`(
						`O_MD5`,
						`O_SHA1`,
						`O_Content`,
						`O_Size`,
						`O_FileType`)
						VALUES(
						:O_MD5,
						:O_SHA1,
						:O_Content,
						:O_Size,
						:O_FileType
					);";

				$rows = $this->sdb->execute($sql,array(
						'O_MD5'=>$value['pic'],
						'O_SHA1'=>sha1($value['content']),
						'O_Content'=>$value['content'],
						'O_Size'=>strlen($value['content']),
						'O_FileType'=>$value['file_type']
				));

				if (!$rows)
				{
					throw new Exception('文件写入错误', 500);
				}
			}
			$data[$key]['pic'] = Common::get_image_url($this->config,$value['pic'],'','','others');

			$data[$key]['img_url'] = $value['img_url'];
			$data[$key]['identify'] = $value['identify'];
			$data[$key]['sku_id'] = $value['sku_id'];
			$data[$key]['floor_id'] = $value['floor_id'];
			$data[$key]['pic_target'] = $value['pic_target'];
			$data[$key]['pic_link'] = $value['pic_link'];
			
		}
		return $data;

	}
	/**
	 * 判断是否有cms
	 * return 布尔值
	 */
	public function IsCms($S_Code)
	{
		if (!empty($S_Code)) {
			$sql = "SELECT `S_Name` FROM `PA_Subject` WHERE `S_Path` = :S_Code;";
			$data = $this->db->fetchOne($sql, \Phalcon\Db::FETCH_ASSOC, array(
					'S_Code' => $S_Code,
			));
			if (!empty($data)) {
				return true;
			} else {
				return false;
			}
		}
	}

	/**
	  *获取PC的cms
	  * @return Array
	  * @param 活动代码
	  * @author Chaoqun_Liu
	  * @date 2017年9月13日11:34:48
	 */
	public function GetPcms($S_Code)
	{
		$data ='';
		if (!empty($S_Code)) {
			$sql = "SELECT `S_Pcms` FROM `PA_Subject` WHERE `S_Path` = :S_Code;";
			$data = $this->db->fetchOne($sql, \Phalcon\Db::FETCH_ASSOC, array(
					'S_Code' => $S_Code,
			));
			return $data;
		} else {

			return $data;

		}
	}
	/**
	  *保存PC cms
	  * @return ID
	  * @param 活动代码，内容
	  * @author Chaoqun_Liu
	  * @date 2017年9月13日11:34:48
	 */
	public function SaveCms($S_Code,$contents)
	{
			if (!empty($S_Code) && !empty($contents)) {
				$mypath  = $S_Code;
				$sql = "INSERT INTO `PA_Subject` (`S_Code`, `S_Name`, `S_Path`, `S_BeginDate`, `S_EndDate`,`S_Status`, `S_Remark`, `S_Pcms`) VALUES(:code,:name, :mypath, :b_date, :e_date,:status, :remark,:contents);";
				$rows = $this->db->execute($sql, array(
						"code" => "64base",
						"name" => '专题活动名称',
						"mypath" => $mypath, 
						"b_date"=>time(),
						"e_date"=>time()+60*60*24*7,
						"status" => 1, 
						"remark" => '',
						"contents" => $contents,
				));
				return $rows;
			} else {
				throw new Exception("非法参数", 400);
			}

		}
	/**
	 * 更新PCcms
	 */
	public function UpdateCms($S_Code,$contents)
	{
		if (!empty($S_Code) && !empty($contents)) {
			$sql = "UPDATE `PA_Subject` SET `S_Pcms`='{$contents}' WHERE `S_Path`='{$S_Code}';";
			$rows = $this->db->execute($sql);
			return $rows;
		} else {
			throw new Exception("非法参数", 400);
		}

	}
	/***
	*获取店铺信息
    * @param 店铺ID
	*/
	public function CheckStore($store_id)
	{
		if($this->curl->get_request('/shop/'.$store_id,'php_api') == 200)
		{
			$result = $this->curl->getArrayData();
			if($this-> common->valid_result($result))
			{
				return $result;
			}
		}
		return false;
   }
   	/***
    * @param 活动代码
	*获取专题活动的信息
	*/
	public function CheckActivity($activity_code)
	{
		if (!empty($activity_code)) {
			$sql = "SELECT `S_Pcms` FROM `PA_Subject` WHERE `S_Code` = :S_Code;";
			$data = $this->db->fetchOne($sql, \Phalcon\Db::FETCH_ASSOC, array(
					'S_Code' => $activity_code,
			));
			return true;
		} else {
			return false;
		}
   }
	/***
	 * @param 活动代码
	 *获取专题活动的信息
	 */
	public function CheckCode($code)
	{
		$sql = "SELECT `Sku_ID` FROM `GM_Sku` WHERE `Sku_ID` = :Sku_ID;";
		$data = $this-> db -> fetchOne($sql,\Phalcon\Db::FETCH_ASSOC,array(
				'Sku_ID' => $code,
		));
		if (!empty($data)) {
			return array($code => 'goods_sku');
		}
		$sql = "SELECT `S_ShopNo` FROM `ER_Shop` WHERE `S_ShopNo` = :S_ShopNo;";
		$data = $this-> db -> fetchOne($sql,\Phalcon\Db::FETCH_ASSOC,array(
				'S_ShopNo' => $code,
		));
		if (!empty($data)) {
			return array($code => 'shop_id');
		}
		$sql = "SELECT `S_Code` FROM `PA_Subject` WHERE `S_Path` = :S_Path;";
		$data = $this->db->fetchOne($sql, \Phalcon\Db::FETCH_ASSOC, array(
				'S_Path' => $code,
		));
		if (!empty($data)) {
			return array($code => 'activity_code','aclink' => $data['S_Code'] );
		}
		return array($code => 'undefine');


	}

}
?>