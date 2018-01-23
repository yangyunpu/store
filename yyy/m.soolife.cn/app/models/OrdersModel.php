<?php
// +----------------------------------------------------------------------
// | 订单模型
// +----------------------------------------------------------------------
// | Copyright (c) 2016年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   OrdersModel.php
// |
// | Author: Qing_L
// | Created:   2016-11-23
// +----------------------------------------------------------------------
// namespace Soolife\Member\Models;

// use Soolife\Member\Librarys\BaseModel;
// 订单模型
class OrdersModel extends BaseModel 
{
    /**
	 * 订单列表数据处理
	 * @author Qing_L 2016-11-23
	 * $data 订单列表数据
	 * $return array
	 * */	    
    function indent($data)
	{
		$a = array();
		$a['member_id'] = $data->member_id;
		$a['index']     = $data->index;
		$a['size']      = $data->count;
		$a['pages']     = $data->pages;

		foreach($data->data as $key=>&$val)
		{		
			if($val->pay_status == 0 || $val->pay_status == 1)    //订单未支付或者支付了一半
			{
				$goods       = array();
				$order_no    = $val->main_orderno;      //订单编号
				$shop_name   = $val->order_name;        //店铺名称
				$pay_status  = $val->pay_status;
				foreach($val ->order as $o_key=>$o_val)
				{
					if($o_key==0)
					{
					    $count_number  =$o_val->ttl_count;      //商品总数量
					    $count_coin    =$o_val->ttl_coin;       //商品总星币
					    $count_pay     = $o_val->pay_fee;       //商品需要支付的价钱
					    $count_express = $o_val->delivery_fee;  //商品需要的快递费
					    $order_id = $o_val->id;
					    $delivery_type = $o_val->delivery_type;
					    $create_time  = $o_val->create_time;
					}else
					{
					    $count_number += $o_val ->ttl_count;     //商品总数量
					    $count_coin += $o_val   ->ttl_coin;      //商品总星币
					    $count_pay += $o_val    ->pay_fee;       //商品需要支付的价钱
					    $count_express += $o_val->delivery_fee;  //商品需要的快递费
					}
					$status=$o_val->status;
					if($o_val -> delivery_type !=5)
					{
						$consignee = $o_val->consignee;
					}
					
					foreach($o_val->items as $i_key=>$i_val)
					{
						$goods[]=$i_val;
					}		
				}
				$orders = array();
				$orders['order_no']      = $order_no;
				$orders['order_id']      = $order_id;
				$orders['shop_name']     = $shop_name;
				$orders['pay_status']    = $pay_status;
				$orders['status']        = $status;
				$orders['count_number']  = $count_number;
				$orders['count_coin']    = $count_coin;
				$orders['count_pay']     = $count_pay;
				$orders['count_express'] = $count_express;
				$orders['goods']         = $goods;
				$orders['type']          = 1;
				$orders['delivery_type'] = $delivery_type;
				$orders['comment']       = "";
				//$orders['consignee']     = $consignee;
				$orders['create_time']   = $create_time;
				$a['data'][]=$orders;
			}
	
			if($val->pay_status == 2)      //表示订单已经支付
			{   

				$res = array();
				foreach($val->order as $o_key=>&$v_val)
				{
					//print_r($v_val);exit;
					$goods=array();
			        $res['order_no']      = $v_val->order_no;
				    $res['shop_name']     = $v_val->shop_name;
				    $res['status']        = $v_val->status;
				    $res['count_number']  = $v_val->ttl_count;
				    $res['count_coin']    = $v_val->ttl_coin;
				    $res['count_pay']     = $v_val->pay_fee;
				    $res['count_express'] = $v_val->delivery_fee;
					$res['pay_status']    = $val  ->pay_status;
					$res['comment']       = $v_val->comment;
					$res['order_id']      = $v_val->id;
					$res['type']          = 2;
					$res['delivery_type'] = $v_val->delivery_type;
					$res['goods']         = $v_val->items;
					if($v_val -> delivery_type !=5 && isset($v_val ->consignee))
					{
						$res['consignee'] = $v_val->consignee;
					}else{
						$res['consignee'] = '';
					}
					$res['create_time']   = $v_val->create_time;
					$a['data'][]=$res;

				}
			}					
		}
	return $a;
	}		
				
		
}
	