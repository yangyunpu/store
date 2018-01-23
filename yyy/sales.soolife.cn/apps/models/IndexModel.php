<?php

// +----------------------------------------------------------------------
// | 商品模型类
// +----------------------------------------------------------------------
// | Copyright (c) 2016年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   GoodsModel.php
// |
// | Author: Gao Qi
// | Created:   2016-07-25
// +----------------------------------------------------------------------

namespace Soolife\Member\Models;

use Soolife\Member\Librarys\BaseModel;
use Soolife\Member\Librarys\WebRedis;
use Soolife\Member\Librarys\Common;

class IndexModel extends BaseModel {

    private $db_identifier = 'promo';

    public function Getname($code) {
            $sql = "SELECT * FROM `PA_Subject` WHERE S_Code=:code";
            $result = $this->db->fetchOne($sql, \Phalcon\Db::FETCH_ASSOC, array("code" => $code,));
            $data  =array();
            if ($result) {
                $data = array(
                    "id" => $result['Subject_ID'],
                    "code" => $result['S_Code'],
                    "name" => $result['S_Name'],
                    "path" => $result['S_Path'],
                    "begin_date" => $result['S_BeginDate'],
                    "end_date" => $result['S_EndDate'],
                    "S_Pcms" => $result['S_Pcms'],
                    "S_Mcms" => $result['S_Mcms']
                );
            } else {
                $data = "NODATA";
            }
        return $data;
    }
    public function GetcmsName($id) {
        $sql = "SELECT `S_Name` FROM `PA_Subject` WHERE S_Code=:code";
        $data  =array();
        $result = $this->db->fetchOne($sql, \Phalcon\Db::FETCH_ASSOC, array("code" => $id,));
        if(!empty($result)) {
            $data = $result;
        }
        return $data;
    }

    public function GetactivityDetails($type = 'mobile', $code) {
        $rediskey = "sale:thematicactivity:{$type}:{$code}";
        $redis = $this->redis->get_redis('promo');
        $data = array();
        if ($this->redis->read($rediskey, $this->db_identifier)) {
            $data = $redis->get($rediskey);
            if ($data != "NODATA") {
                $data = json_decode($data, TRUE);
            }
        }
        $result['floorname'] = array();
        if ($data != "NODATA" && empty($data)) {
            if ($type == 'mobile') {
                $sql = "SELECT * FROM `SALE_ThematicActivity` WHERE T_ThematicCode=:code AND (T_Type = 2 OR T_Type = 3) AND T_Status = 3;";
                $result = $this->db->fetchOne($sql, \Phalcon\Db::FETCH_ASSOC, array("code" => $code));
                if(empty($result))
                    return $data;
                $result['T_Banner'] = json_decode($result['T_Banner'], true);
                if (array_key_exists("mo_banner", $result['T_Banner'])) {
                    $result['T_Banner'] = $result['T_Banner']['mo_banner'];
                    foreach ($result['T_Banner'] as $kbm => &$vbm) {
                        $vbm = Common::get_image_url($vbm, '', '', 'others');
                    }
                }
                //获取各个楼层
                $sql = "SELECT F_Banner,F_Package,F_MobileLink,F_FloorName FROM `SALE_ThematicFloor` WHERE F_ThematicCode=:code";
                $floor = $this->db->fetchAll($sql, \Phalcon\Db::FETCH_ASSOC, array("code" => $code));
//                print_r($floor);
//                exit();
                foreach ($floor as $key => $value) {
                    $value['F_Banner'] = json_decode($value['F_Banner'], true);
                    foreach ($value['F_Banner'] as $key_banner => $val_banner) {
                        if (array_key_exists("mof_banner", $val_banner)) {
                            $result['floor'][$key]['banner'] =  $val_banner['mof_banner'] ? Common::get_image_url($val_banner['mof_banner'], '', '', 'others') : '';
                            $result['floor'][$key]['link'] = $value['F_MobileLink'];
                        } else {
                            continue;
                        }
                    }
                    //获取各个楼层名字
                    if(!empty($value['F_FloorName'])){
                        $result['floorname'][] = $value['F_FloorName'];
                    }
                    //获取各个楼层所有sku 并获取每个sku的单品的最优价
                    $sql = "SELECT Sku_ID sku,S_Name name,S_MarketPrice market_price,S_ShopPrice shop_price,S_Logo logo FROM GM_Sku WHERE Sku_ID IN({$value['F_Package']}) AND S_OnlineSale = 1;";
                    $sku = $this->db->fetchAll($sql);
                    $time = time();
                    foreach ($sku as $key_sku => &$value_sku) {
                        $value_sku['logo'] = Common::get_image_url($value_sku['logo'], '', '', 'images');
                        // $sql = "SELECT Group_concat(Promotion_ID) promotionid FROM SALE_Promo WHERE P_SaleMode = '10' AND P_RuleID = '1010' AND P_BeginTime < '{$time}' AND P_EndTime > '{$time}' AND P_Status = 1;";
                        // $promo_num_arr = $this->db->fetchOne($sql);
                        // $sql = "SELECT G_PromoID,G_ActPrice,G_SkuID FROM SALE_PromoGoods WHERE G_SkuID = {$value_sku['sku']} AND G_PromoID IN ({$promo_num_arr['promotionid']}) ORDER BY G_ActPrice DESC;";
                        // $prosku = $this->db->fetchOne($sql);
                        // if ($prosku) {
                        //     $value_sku['shop_price'] = $prosku['G_ActPrice'];
                        // }
                        $url = "/v2/promo/sku/{$value_sku['sku']}/promos";
                        if ($this->curl->get_request($url,'v2_api') == 200) {
                            $price = $this->curl->getArrayData();
                            $value_sku['shop_price'] = number_format($price['price'], 2);
                        }
                    }
                    $result['floor'][$key]['sku'] = $sku;
                }
                if ($result) {
                    $data = array(
                        "id" => $result['Thematic_ID'],
                        "name" => $result['T_ThematicName'],
                        "code" => $result['T_ThematicCode'],
                        "begintime" => $result['T_BeginTime'],
                        "endtime" => $result['T_EndTime'],
                        "backgroudcolor" => $result['T_BackgroudColor'],
                        "floatingbottomcolor" => $result['T_FloatingBottomColor'],
                        "floatbarclickcolor" => $result['T_FloatBarClickColor'],
                        "floatcolumnfontcolor" => $result['T_FloatColumnFontColor'],
                        "banner" => $result['T_Banner'],
                        "type" => $result['T_Type'],
                        "status" => $result['T_Status'],
                        "createtime" => $result['T_CreateTime'],
                        "updatetime" => $result['T_UpdateTime'],
                        "createuser" => $result['T_CreateUser'],
                        "remark" => $result['T_Remark'],
                        "floor" => $result['floor'],
                        "floorname" => $result['floorname']
                    );
                    $val = json_encode($data);
                } else {
                    $val = "NODATA";
                }
            } else {
                $sql = "SELECT * FROM `SALE_ThematicActivity` WHERE T_ThematicCode=:code AND (T_Type = 1 OR T_Type = 3) AND T_Status = 3;";
                $result = $this->db->fetchOne($sql, \Phalcon\Db::FETCH_ASSOC, array("code" => $code));
                if(empty($result))
                    return $data;
//                echo '<pre>';
//                var_dump($result);
//                exit;
                $result['T_Banner'] = json_decode($result['T_Banner'], true);
                if (array_key_exists("pc_banner", $result['T_Banner'])) {
                    $result['T_Banner'] = $result['T_Banner']['pc_banner'];
                    foreach ($result['T_Banner'] as $kbpc => &$vbpc) {
                        $vbpc = Common::get_image_url($vbpc, '', '', 'others');
                    }
                }
                $sql = "SELECT F_Banner,F_Package,F_PcLink,F_FloorName FROM `SALE_ThematicFloor` WHERE F_ThematicCode=:code";
                $floor = $this->db->fetchAll($sql, \Phalcon\Db::FETCH_ASSOC, array("code" => $code));
                foreach ($floor as $key => $value) {
                    $value['F_Banner'] = json_decode($value['F_Banner'], true);
                    foreach ($value['F_Banner'] as $key_banner => $val_banner) {
                        if (array_key_exists("pcf_banner", $val_banner)) {
                            $result['floor'][$key]['banner'] = $val_banner['pcf_banner'] ? Common::get_image_url($val_banner['pcf_banner'], '', '', 'others') : '';
                            $result['floor'][$key]['link'] = $value['F_PcLink'];
                        } else {
                            continue;
                        }
                    }
                    //获取各个楼层名字
                    if(!empty($value['F_FloorName'])){
                        $result['floorname'][] = $value['F_FloorName'];
                    }
                    //获取各个楼层所以sku 并获取每个sku的单品的最优价
                    $sql = "SELECT Sku_ID sku,S_Name name,S_MarketPrice market_price,S_ShopPrice shop_price,S_Logo logo FROM GM_Sku WHERE Sku_ID IN({$value['F_Package']}) AND S_OnlineSale = 1;";
                    $sku = $this->db->fetchAll($sql);
                    $time = time();
                    foreach ($sku as $key_sku => &$value_sku) {
                         $value_sku['logo'] = Common::get_image_url($value_sku['logo'], '', '', 'images');
                        // $sql = "SELECT Group_concat(Promotion_ID) promotionid FROM SALE_Promo WHERE P_SaleMode = '10' AND P_RuleID = '1010' AND P_BeginTime < '{$time}' AND P_EndTime > '{$time}' AND P_Status = 1;";
                        // $promo_num_arr = $this->db->fetchOne($sql);
                        // $sql = "SELECT G_PromoID,G_ActPrice,G_SkuID FROM SALE_PromoGoods WHERE G_SkuID = {$value_sku['sku']} AND G_PromoID IN ({$promo_num_arr['promotionid']}) ORDER BY G_ActPrice DESC;";
                        // $prosku = $this->db->fetchOne($sql);
                        // if ($prosku) {
                        //     $value_sku['shop_price'] = $prosku['G_ActPrice'];
                        // }
                        $url = "/v2/promo/sku/{$value_sku['sku']}/promos";
                        $value_sku['coin'] = 0;
                        if ($this->curl->get_request($url,'v2_api') == 200) {
                            $price = $this->curl->getArrayData();
                            $value_sku['shop_price'] = number_format($price['price'], 2);
                            $value_sku['coin'] = $price['coin'];
                        }
                    }
                    $result['floor'][$key]['sku'] = $sku;
                }
                if ($result) {
                    $data = array(
                        "id" => $result['Thematic_ID'],
                        "name" => $result['T_ThematicName'],
                        "code" => $result['T_ThematicCode'],
                        "begintime" => $result['T_BeginTime'],
                        "endtime" => $result['T_EndTime'],
                        "backgroudcolor" => $result['T_BackgroudColor'],
                        "floatingbottomcolor" => $result['T_FloatingBottomColor'],
                        "floatbarclickcolor" => $result['T_FloatBarClickColor'],
                        "floatcolumnfontcolor" => $result['T_FloatColumnFontColor'],
                        "banner" => $result['T_Banner'],
                        "type" => $result['T_Type'],
                        "status" => $result['T_Status'],
                        "createtime" => $result['T_CreateTime'],
                        "updatetime" => $result['T_UpdateTime'],
                        "createuser" => $result['T_CreateUser'],
                        "remark" => $result['T_Remark'],
                        "floor" => $result['floor'],
                        "floorname" => $result['floorname']
                    );
                    $val = json_encode($data);
                } else {
                    $val = "NODATA";
                }
            }
            $this->redis->write($rediskey, $val, $this->db_identifier);
        }
        return $data;
    }

}
