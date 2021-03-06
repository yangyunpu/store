<?php
// +----------------------------------------------------------------------
// | 安全类
// +----------------------------------------------------------------------
// | Copyright (c) 2015年 如此生活. All rights reserved.
// +----------------------------------------------------------------------
// | File:   Safety.php
// |
// | Author: Tony Wang <tony@iapp.hk>
// | Created:   2014-12-20
// +----------------------------------------------------------------------
namespace Soolife\Cms\Librarys;

class Safety {
    /* 设置加密种子 */
    private static $key_t = "soolife.cn";
    
    /**
     * 加密函数(参数:数组，返回值:字符串)
     * @access public
     * @param $cookie_array array 需要加密的数组
     * @return string 返回加密后的字符串
     */
    public function encrypt($cookie_array){
        $txt = serialize($cookie_array);
        srand();//生成随机数
        $encrypt_key = md5(rand(0,10000));//从0到10000取一个随机数
        $ctr = 0;
        $tmp = '';
        for($i = 0;$i < strlen($txt);$i++){
            $ctr = $ctr == strlen($encrypt_key) ? 0 : $ctr;
            $tmp .= $encrypt_key[$ctr].($txt[$i] ^ $encrypt_key[$ctr++]);
        }
        return base64_encode(Safety::key($tmp,Safety::$key_t));
    }
     
    /**
     * 解密函数
     * @param $txt string 需要解密的字符串
     * @return array 返回数组
     */
    public function decrypt($txt){
        $txt = Safety::key(base64_decode($txt), Safety::$key_t);
        $tmp = '';
        for($i = 0;$i < strlen($txt); $i++) {
            $md5 = $txt[$i];
            $tmp .= $txt[++$i] ^ $md5;
        }
        $tmp_t = unserialize($tmp);
        return $tmp_t;
    }
     
    /**
     * 动态加密的key
     * @access private
     * @param $txt string 加密的字符串
     * @param $encrypt_key string 种子密码
     * @return string 加密后的字符串
     */
    private static function key($txt,$encrypt_key){
        $encrypt_key = md5($encrypt_key);
        $ctr = 0;
        $tmp = '';
        for($i = 0; $i < strlen($txt); $i++) {
            $ctr = $ctr == strlen($encrypt_key) ? 0 : $ctr;
            $tmp .= $txt[$i] ^ $encrypt_key[$ctr++];
        }
        return $tmp;
    }
}