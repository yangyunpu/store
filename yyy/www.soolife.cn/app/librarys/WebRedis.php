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
use Phalcon\Mvc\User\Component;

class WebRedis  extends Component {
	protected $_token_timeout = 3600;
	protected $database = array(
		"other"=>0,
		"session"=>1,
		/**
		 * 页面库:List
		 * 		防刷新过快 = page:refresh:{ip}
		 * 		页面访问记录 = page:visit
		 * 		页面访问历史记录 = page:history:{id}      	//登录后的记录
		 * 		页面访问历史记录 = page:history:{session}  	// 登录前的记录，用cookie+id来记录与跟踪
		 */   
		"page"=>3,
		"goods"=>7,
		"shop"=>8,
		"promo"=>9,
		"ads"=>10,
		"member"=>11,
		"orders"=>12,
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
	
	/**
	 * 读取核心分类
	 * @param $no 编号 
	 * @
	 */
	public function read_category($no='0')
	{
		if ($no=='0')
		{
			$key = "category:core:all";
		}else{
			$key = "category:core:{$no}";
		}
		return $this->read($key, 'settings');
	}
	
	/**
	 * 读取网站与移动端菜单
	 * @param $no 编号，如string: pc,mobile,overseas,virtual  如int: category:menus:{id}
	 */
	public function read_menus($id)
	{
		$key = "";
		if (is_string($id))
		{
			$key = "category:menus:{$id}:all";
		} else {
			$key = "category:menus:{$id}";
		}
		return $this->read($key, 'settings');
	}
	
	/**
	 * 读取行政区域
	 * @param $no 编号，0:表示所有数据
	 */
	public function read_region($no='0')
	{
		$no = strtolower($no);
		if ($no=='0')
		{
			$key = "region:all";
		}else{
			$key = "region:{$no}";
		}
		return $this->read($key, 'settings');
	}
	/**
	 * 随机产生几条名言
	 * @param $no 编号，0:表示所有数据
	 */
	public function read_tips($size=1)
	{
		$tips = null;
		$this -> connect();
		$this -> select_db('settings');
		$key = 'tips:all';
		if ($this -> _redis -> exists($key)) {
			$value = $this -> _redis -> get($key);
			$data = json_decode($value,TRUE);
			if (isset($data) && count($data))
				$tips = array_rand($data,1);
		}
		return $tips;
	}
	
	/**
	 * 获取推荐商品
	 * @author tony wang
	 * @param $rank 推荐代码,如：R1,R2
	 * @return array
	 */
	public function read_rank($rank)
	{
		$data = array();
		$this -> connect();
		$this -> select_db('settings');
		foreach ($rank as $value) {
			$key = "rank:{$value}";
			if ($this -> _redis -> exists($key)) {
				$val = $this -> _redis -> get($key);
				$data[] = json_decode($val,TRUE);
			}
		}
		return $data;
	}
	
	/**
	 * 读取商品资料
	 * @author tony wang
	 * @param $idx mixed (int | array) 商品编号
	 * @return array
	 */
	public function read_goods($idx)
	{
		$this -> connect();
		$this -> select_db('goods');
		$data = null;
		if (is_array($idx))
		{
			foreach ($idx as $key => $value) {
				$key = "goods:id:{$value}";
				if ($this -> _redis -> exists($key)) {
					$val = $this -> _redis -> get($key);
					$val = json_decode($val,TRUE);
					$data[] = $val['info'];
				}
			}
		}else{
			$idx = @intval($idx);
			$key = "goods:id:{$idx}";
			if ($this -> _redis -> exists($key)) {
				$val = $this -> _redis -> get($key);
				$val = json_decode($val,TRUE);
				$data = $val['info'];
			}
		}
		return $data;
	}

	/**
	 * 读取店铺资料
	 * @author tony wang
	 * @param $idx mixed (int | array) 商品编号
	 * @return array
	 */
	public function read_shop($idx)
	{
		$this -> connect();
		$this -> select_db('shop');
		$data = null;
		if (is_array($idx))
		{
			foreach ($idx as $key => $value) {
				$key = "shop:id:{$value}";
				if ($this -> _redis -> exists($key)) {
					$val = $this -> _redis -> get($key);
					$val = json_decode($val,TRUE);
					$data[] = $val['info'];
				}
			}
		}else{
			$idx = @intval($idx);
			$key = "shop:id:{$idx}";
			if ($this -> _redis -> exists($key)) {
				$val = $this -> _redis -> get($key);
				$val = json_decode($val,TRUE);
				$data = $val['info'];
			}
		}
		return $data;
	}
	
	/**
	 * 读取店铺资料
	 * @author tony wang
	 * @param $idx mixed (int | array) 商品编号
	 * @return array
	 */
	public function read_promo($id)
	{
		$key = "promo:id:{$id}";
		return $this->read($key, 'promo');
	}
	
	/**
	 * 读取店铺资料
	 * @author tony wang
	 * @param $idx mixed (int | array) 商品编号
	 * @return array
	 */
	public function read_ads($id)
	{
		$key = "ads:id:{$id}";
		return $this->read($key, 'ads');
	}
	
	/**
	 * 读取广告位置
	 * @author tony wang
	 * @param $code string 广告位置编号
	 */
	public function read_ads_location($code)
	{
		$data = null;
		$this -> connect();
		$this -> _redis -> select($this -> database['ads']);
		$key = "ads:location:".md5(strtolower($code));
		// 打开广告库
		if ($this -> _redis -> exists($key)) {
			$val = $this -> _redis -> get($key);
			$data = json_decode($val,TRUE); 
			foreach ($data as &$v1) {
				if (isset($v1['items']) && !empty($v1['items']) && count($v1['items'])>0)
				{
					$items = $v1['items'];
					$item = array();
					foreach ($items as $value) {
						$ad_key = "ads:id:{$value}";
						$d = json_decode($this -> _redis -> get($ad_key),TRUE);
						if (!empty($d) && count($d)>0)
						{
							unset($d['location_no']);
							unset($d['begin_date']);
							unset($d['end_date']);
							unset($d['status']);
							$item[] = $d;
						}
					}
					$v1['items'] = $item;
				}
			}
		}
		return $data;
	}
	
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/**
	 * 连接到缓存数据库
	 * @author Tony Wang
	 * @return void
	 */
	protected function connect() {
			$conf = $this -> config -> redis;
			$this -> _redis = new \Redis();
			
			$this -> _redis -> connect($conf -> host, $conf -> port);
			if (!empty($conf -> auth_password))
				$this -> _redis->auth($conf -> auth_password);
	}

	/**
	 * 选择Redis 缓存数据库
	 * @author Tony Wang
	 * @param $db 数据库标识
	 * @return void
	 */
	protected function select_db($db) {
		if (isset($this->_redis))
			return $this -> _redis -> select(intval($this -> database[$db]));
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
		$key = "member:token:{$token}";	
		return $this->add_string($key,$member,'session',$this->_token_timeout);
	}
	
	/**
	 * 读取票据，看是否有数据
	 * @author Tony Wang
	 * @param $token string 票据编号
	 * @return  object || null
	 */
	function read_token($token)
	{
		$key = "member:token:{$token}";		
		$member = null;
		if ($this->connect())
		{
			$this -> _redis->select($this -> select_db('session'));
			if ($this -> _redis ->exists($key))
			{
				$json = $this -> _redis -> get($key);
				$member = json_decode($json);
				$this -> _redis -> setTimeout($key, $this->_token_timeout); // 重设过期时间
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
		$key = "member:token:{$token}";		
		$this->remove($key, 'session');
	}
}
