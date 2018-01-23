<?php
// +----------------------------------------------------------------------
// | Web Redis 请求缓存数据类
// +----------------------------------------------------------------------
// | Copyright (c) 2015年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   WebCurl.php
// |
// | Author: Tony Wang <tony@iapp.hk>
// | Created:   2014-12-20
// +----------------------------------------------------------------------
namespace Soolife\Member\Librarys;
use Phalcon\Mvc\User\Component;

class WebRedis  extends Component {
	protected $_token_timeout = 3600;
	protected $database = array(
		"other"=>0,
		/**
		 * 会话库：String
		 * 		格式
		 */
		"session"=>1,

		/**
		 * 队列库: List
		 * 		订单生成消息队列 = orders:create
		 * 		订单支付消息队列 = orders:pay
		 * 		订单取消消息队列 = orders:cancel
		 * 		订单确认订单消息队列 = orders:confirm
		 * 		订单发货订单消息队列 = orders:delivery
		 * 		订单等待取货消息队列 = orders:pick
		 *
		 *      注册会员消息队列 = members:register
		 * 		更新消息队列 ＝ msg:update
		 */
		"queue"=>2,

		/**
		 * 页面库:List
		 * 		防刷新过快 = page:refresh:{ip}
		 * 		页面访问记录 = page:visit
		 * 		页面访问历史记录 = page:history:{id}      	//登录后的记录
		 * 		页面访问历史记录 = page:history:{session}  	// 登录前的记录，用cookie+id来记录与跟踪
		 */
		"page"=>3,

		/**
		 * 手机短信库
		 * 		手机验证码 = sms:vcode:{phone}
		 *      手机号码限制 = sms:phone:{ip}   同一个IP，一分钟内只能用2个手机号来发验证码，如果过多，则判定非法请求
		 */
		"sms"=>4,

		/**
		 * 1. {id}
		 * 2. rank:{code} 排名
		 */
		"goods"=>7,
		"shop"=>8,

		/**
		 * 1. promo:{id}
		 * 2. promo:soolife:all     // 平台所有活动
		 * 3. promo:shop:{shop_id}  // 店铺所有活动
		 * 4. promo:rule:{rule_id}  // 按活动规则获取活动编号
		 * 5. promo:channel:{org_id} // 按渠道获取活动
		 */
		"promo"=>9,
		"ads"=>10,
		"member"=>11,
		"orders"=>12,
		/**
		 * 1. coupon:{id}
		 * 2. coupon:soolife:all     // 平台所有活动
		 * 3. coupon:shop:{shop_id}  // 店铺所有活动
		 */
		"coupon"=>13,
		/**
		 * 配置库:
		 * 		category:core:all  = 所有核心分类对象
		 * 		category:core:{no} = 单个核杺分类的对象
		 * 		category:menus:{id} = 单个网站分类的对象
		 * 		category:menus:pc:all = 所有网站分类对象
		 * 		category:menus:mobile:all = 所有手机分类对象
		 * 		category:menus:overseas:all = 所有海外购分类对象
		 * 		category:menus:virtual:all = 所有虚拟商品分类对象
		 * 		limit:word:all = 所有限制词语
		 * 		region:all ＝ 所有行政区域信息
		 * 		region:{no} = 单个行政区域的信息
		 * 		tips:all = 所有提示名句
		 * 		rank:{code} = 推荐商品
		 *
		 */
		"settings"=>15
	);
	protected $_redis = null;

    public function get_redis($db)
    {
        if (!isset($this->_redis))
        {
            $this->connect();
            $this->select_db($db);
        }
        return $this->_redis;
    }
	/**
	 * 连接到缓存数据库
	 * @author Tony Wang
	 * @return void
	 */
	protected function connect() {
		$conf = $this -> config -> redis;
		$this -> _redis = new \Redis();

		$this -> _redis -> connect($conf -> host, $conf -> port);
		if (!empty($conf -> auth_password)){
			$this->_redis->auth($conf -> auth_password);
		}
		return $this->_redis;
	}

	/**
	 * 选择Redis 缓存数据库
	 * @author Tony Wang
	 * @param $db 数据库标识
	 * @return void
	 */
	protected function select_db($db) {
		if (isset($this->_redis)){
			return $this -> _redis -> select(intval($this -> database[$db]));
		}
	}

	/**
	 * 判断redis 是否连通
	 * @author Tony Wang
	 * @return void
	 */
	protected function is_pang() {
		$pattern = '/PONG/';
		$ping = $this -> _redis -> ping();
		return (preg_match($pattern, $ping));
	}

	/**
	 * 移除缓存数据
	 * @author Tony Wang
	 * @param $key string | array 可以是字符串或数组
	 * @param $db string
	 * @return void
	 */
	function remove($key,$db)
	{
		$this -> connect();
		$this -> select_db($db);
		if ($this -> _redis -> exists($key)) {
			return $this -> _redis -> del($key);
		}
		return 0;
	}

	/**
	 * 写入数据
	 */
	function write($key,$data,$db,$lifetime=0) {
		$this -> connect($db,'w');
		$this->select_db($db);
		$this -> _redis -> multi();
		if (is_array($data))
			$info = json_encode($data);
		else{
			$info = $data;
		}

		if (empty($info))
			$this->logger->error($info);

		$this -> _redis -> set($key, $info);

		if ($lifetime>0)
			$this->_redis->setTimeout($key,$lifetime);
		// 执行事务
		$this -> _redis -> exec();
	}

	/**
	 * 读取数据
	 * @author tony wang
	 * @param $key 关键字
	 * @param $db 数据库标识
	 * @param $type 类型 1：string 2:hash 3:list 4:set 5:zset
	 */
	function read($key,$db,$type=1) {
		$data = null;
		$this -> connect();
		$this -> select_db($db);
		if ($this -> _redis -> exists($key)) {
			$value = '';
			switch ($type) {
				case 1:
					$value = $this -> _redis -> get($key);
					break;
				case 2:
					$value = $this -> _redis -> hGetAll($key);
					break;
			}
			$data = json_decode($value,TRUE);
		}
		return $data;
	}

	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/**
	 * 添加字符串数据
	 * @author Tony Wang
	 * @param $token string
	 * @param $member array || object
	 * 		$db string 默认是session数据库
	 * 		$expire 过期时间,默认是3600,1小时，如果1小时无任何操作，将退出
	 */
	function register_token($token, $member) {
		return $this->add_string($token,$member,'session',$this->_token_timeout);
	}

	/**
	 * 读取票据，看是否有数据
	 * @author Tony Wang
	 * @param $token string 票据编号
	 * @return  object || null
	 */
	function read_token($token)
	{
		$member = null;
		if ($this->connect())
		{
			$this -> _redis->select($this -> select_db('session'));
			if ($this -> _redis ->exists("member:token:" . $token))
			{
				$json = $this -> _redis -> get("member:token:" . $token);
				$member = json_decode($json);
				$this -> _redis -> setTimeout($token, $this->_token_timeout); // 重设过期时间
			}
		}
		return $member;
	}

	/**
	 * 登出系统
	 * @author Tony Wang
	 * @param $token string 票据编号
	 * @return void
	 */
	function remove_token($token)
	{
		$this->remove($token, 'session');
	}

	/**
	 * 添加字符串数据
	 * @author Tony Wang
	 * @param $key 关键字
	 * @param $value 字符串值，可以是JSON字符串或数字
	 * @param $db 数据库名称
	 * @param $expire 过期时间
	 */
	function add_string($key, $value, $db, $expire = 0) {
		$json = '';
		if (is_array($value) || is_object($value))
			$json = json_encode($value);

		if ($this -> connect()) {
			$this -> select_db($db);

			$this -> _redis -> multi();
			$mm = $this -> _redis -> set($key, $json);
			if ($expire>0)
				$this -> _redis -> setTimeout($key, $expire);
			$this -> _redis -> exec();
		}
	}

	/**
	 * 添加散列数据
	 * @author Tony Wang
	 * @param $key 关键字
	 * @param $value 值
	 * @param $db 数据库名称
	 * @param $expire 过期时间
	 */
	function add_hash($key, $value, $db, $expire = 0) {
		if ($this -> connect()) {
			$this -> select_db($db);

			$this -> _redis -> multi();
			$this -> _redis -> hSet($key, $value);
			if ($expire>0)
				$this -> _redis -> expireat($key, $expire);
			$this -> _redis -> exec();
		}
	}

	/**
	 * 向队列的左边添加一项
	 * @author Tony Wang
	 * @param $key 队列名称
	 * @param $value 值
	 * @param $db 数据库名称
	 */
	function add_list_lpush($key,$value,$db)
	{
		if ($this -> connect()) {
			$this -> select_db($db);

			$this -> _redis -> multi();
			$this -> _redis -> hSet($key, $value);
			$this -> _redis -> exec();
		}
	}

	/**
	 * 取出队列的右边一项，并且删除
	 * @author Tony Wang
	 * @param $key 队列名称
	 * @param $value 值
	 * @param $db 数据库名称
	 */
	function get_list_rpop($key,$db)
	{
		if ($this -> connect()) {
			$this -> select_db($db);
			return $this -> _redis -> rPop($key, $value);
		}
		return FALSE;
	}

	/**
	 * 返回名称为key的list有多少个元素
	 * @author Tony Wang
	 * @param $key 队列名称
	 * @param $db 数据库名称
	 */
	function get_list_size($key,$db)
	{
		if ($this -> connect()) {
			$this -> select_db($db);
			return $this -> _redis -> rPop($key, $value);
		}
		return 0;
	}
}