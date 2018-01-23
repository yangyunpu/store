<?php
/**
 * 工具类的控制器
 * @author Luo Qing
 */
class ToolsController extends BaseController {
	/**
	 * 产生验证码
	 * @access public
	 * @return image/jpg
	 */
	public function validcodeAction(){
        $config = array(
            'font_path' => ROOT_PATH.'/public/verify/',
            'fontSize' => 30, // 验证码字体大小
            'length' => 4
        );
        $rand_key = $this->request -> get('key');
        $type = $this->request -> get('type');
        $Verify = new Verify($config);
        if($type == 1){
            $Verify -> useNumeric = true;
            $Verify -> useCurve = false;
        }
        $Verify->entry($rand_key);
	}
}

