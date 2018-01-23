<?php
// +----------------------------------------------------------------------
// | 招商服务类
// +----------------------------------------------------------------------
// | Copyright (c) 2016年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:
// | Author: Dandan_Sun
// | Created: 2016-11-07 11:38:15
// +----------------------------------------------------------------------
namespace Soolife\Member\Services;
use Soolife\Member\Librarys\BaseService;

class BusinessService extends BaseService{
	private $db_identifier = 'settings';

	/**
	 * 地址转换
	 * @param $member_id int 会员编号
	 *GET v1/basic/region/{id}
	 */
	function region($region_id){
		$id = strtolower($region_id);
		$key = "region:{$id}";
		$data = $this->redis -> read($key,$this->db_identifier);
		// 如果存在，将从缓存中读取
		if (!$data) {
			$id = strtoupper($region_id);
			$sql = "SELECT * FROM DP_Region WHERE Region_ID = '{$id}';";
			$result = $this -> db -> fetchOne($sql,\Phalcon\Db::FETCH_ASSOC);
			$data = array();
			$data['region_id'] = $result['Region_ID'];
			$data['name'] = $result['R_Name'];
			$data['pid'] = $result['R_ParentID'];
			if(!empty($result)){
				$children_sql = "SELECT * FROM DP_Region WHERE R_ParentID = '{$result['Region_ID']}';";
				$res = $this -> db -> fetchAll($children_sql,\Phalcon\Db::FETCH_ASSOC);
			}
			foreach ($res as $kk => $value) {
				$data['children'][$kk]['region_id'] = $value['Region_ID'];
				$data['children'][$kk]['name'] = $value['R_Name'];
				$data['children'][$kk]['pid'] = $value['R_ParentID'];
				$data['children'][$kk]['children'] = array();
			}
			$this->redis -> write($key,$data,$this->db_identifier);

			return $data;
		}
		return $data;
	}

}