<?php
// +----------------------------------------------------------------------
// | 用户类
// +----------------------------------------------------------------------
// | Copyright (c) 2016年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   Users.php
// |
// | Author: 
// | Created:  2016
// +----------------------------------------------------------------------
use Phalcon\Mvc\User\Component;
	
class Users  extends Component {
	private $_cke = array("token","id","nickname","coin","referer","from");  // 需要存储到cookie
	
	public $token;			// 当前会员登录令牌
    public $id;				// 当前会员编号
    public $name;      		// 当前会员登录名称
    public $nickname;  		// 当前会员姓名昵称
    public $coin;   		// 当前星币数
    public $type;   		// 会员类型
    public $shopid; 		// 如果是供应商，将会有店铺编号
    
    public $referer;    	// 推荐人
    public $from;          // 来源
    private $m_identifier = 'member_identifier';
	
	function getId()
	{
		return $this->getValue('id', '');
	}
	function getToken()
	{
		return $this->getValue('token', '');
	}
	function getName()
	{
		return $this->getValue('name', '');
	}
	function getNickname()
	{
		return $this->getValue('nickname', '');
	}
	function getCoin()
	{
		return $this->getValue('coin', '');
	}
	function getType()
	{
		return $this->getValue('type', '');
	}
	function getShopID()
	{
		return $this->getValue('shopid', '');
	}
	function getReferer()
	{
		return $this->getValue('referer', '');
	}
	function getSource()
	{
		return $this->getValue('source', '');
	}
	
	/**
	 * 获取数组中数据
	 * @author Tony Wang 2016-05-14
	 * @param $key 数组中键值
	 * @param $def 默认值
	 * @return string || $def
	 */
	function getValue($key,$def)
	{
		$member = $this->current();
		if (isset($member))
		{
			return $member[$key];
		}
		return $def;
	}
	
    /**
     * 注册用户信息
     * @param $id string 用户编号
	 * @param $name string 姓名
	 * @param $nickname string 昵称
	 * @param $token string 登录的票据
	 * @param $domain string 域名
	 * @param $referer string 推荐人
	 * @param $from string 来源代码
	 * 
     * @author tony wang 
     * @return $data string 返回加密的字符串
     */
    public function reg_member($id,$name,$nickname,$token,$type=1,$coin=0,$shopid=0)
    {
		$this->token = $token;
    	$this->id = $id;
    	$this->name = $name;
    	$this->nickname = $nickname;
    	$this->coin = $coin;
    	$this->type = $type;
    	$this->shopid = $shopid;
		
		return $this->save();
    }
	
	/**
	 * 获取当前会员信息
	 * @author tony wang  
	 * @return $data array 会员详细信息
	 */
	public function current()
	{
		$Safety = new Safety();  
		$member = $this-> cookies->get($this->m_identifier);
		$value = $member->getValue();
		if(!empty($value)){
			return $Safety->decrypt($value);
		}		 
		return null;
	}
	
	/**
	 * 清除Cookie数据
	 * @param $key string cookie名称
	 * 
	 * @author tony wang
	 * @return void 
	 */
	public function remove($key)
	{
		if ($key=="all")
		{	
			if ($this-> cookies->has($this->m_identifier))
			{
				$m = $this->_response->getCookies($this->m_identifier);
			}
			$this-> cookies->delete($this->m_identifier);
		}
		else{
			$member = $this-> cookies->get($key);
			$member->delete();
		}
	}  
	
	/**
	 * 保存数据到加密数组
	 * @param $key string cookie名称
	 * 
	 * @author tony wang
	 * @return void 
	 */
	public function save()
	{
        $data = array(
        		"token"=>$this->token,
        		"id"=>$this->id,
        		"name"=>$this->name,
        		"nickname"=>$this->nickname,
        		"coin"=>$this->coin,   // 当前星币数
        		"type"=>$this->type,   // 会员类型
        		"shopid"=>$this->shopid, // 如果是供应商，将会有店铺编号
        		"referer"=>$this->referer,    // 推荐人
        		"source"=>$this->from           // 来源
        );          
		$Safety = new Safety();
		$data = $Safety->encrypt($data);
        $expire = $this->lifetime();
		$domain = $this->domain();
		$this-> cookies->set('m_token', $this->token, $expire,"/",FALSE,$domain);
	    $this-> cookies->set($this->m_identifier, $data, $expire,"/",FALSE,$domain);
        return $data;	
	}
	
	/**
	 * 默认生命时间
	 * @author tony wang
	 * @return int Cookie 失效时间 365天 
	 */
	private function lifetime()
	{
		return time()+(365*86400);
	}
	
	/**
	 * 获取域名
	 * @author tony wang
	 * @return string
	 */
	function domain()
	{
		$domain = $this->config->application->domain;
		if (empty($domain))
			$domain = $_SERVER['HTTP_HOST'];
		return $domain;
	}
}