<?php
/**
* 服务器探针
* @category WuxcBlog
* @copyright Copyright (c) 2016 PhalconCMS team (http://www.wuxceng.cn)
* @license GNU General Public License 2.0
* @link www.wuxceng.cn
*/

namespace Wuxc\Apps\Library;

class ServerNeedle{

    /**
     * 服务器操作系统
     * @return string
     */
    public static function os_name(){
        return PHP_OS;
    }

    /**
     * 服务器的版本名称
     * @return string
     */
    public static function os_version(){
        return php_uname('r');
    }

    /**
     * 服务器域名
     * @return mixed
     */
    public static function server_host(){
        return $_SERVER['SERVER_NAME'];
    }

    /**
     * 服务器IP
     * @return mixed
     */
    public static function server_ip(){
        return $_SERVER['SERVER_ADDR'];
    }

    /**
     * web服务器信息
     * @return mixed
     */
    public static function server_software(){
        return $_SERVER['SERVER_SOFTWARE'];
    }

    /**
     * 服务器语言
     * @return array|false|string
     */
    public static function accept_language(){
        return getenv('HTTP_ACCEPT_LANGUAGE');
    }

    /**
     * 服务器端口
     * @return mixed
     */
    public static function server_port(){
        return $_SERVER['SERVER_PORT'];
    }

    /**
     * 获取php版本
     * @return string
     */
    public static function php_version(){
        return PHP_VERSION;
    }

    /**
     * php的运行方式
     * @return string
     */
    public static function php_sapi_name(){
        return strtoupper(php_sapi_name());
    }

    /**
     * 获取客户端浏览器信息 添加win10 edge浏览器判断
     * @param  null
     * @author  Jea杨
     * @return string
     */
    public static function get_broswer(){
        $sys = $_SERVER['HTTP_USER_AGENT'];  //获取用户代理字符串
        if (stripos($sys, "Firefox/") > 0) {
            preg_match("/Firefox\/([^;)]+)+/i", $sys, $b);
            $exp[0] = "Firefox";
            $exp[1] = $b[1];  //获取火狐浏览器的版本号
        } elseif (stripos($sys, "Maxthon") > 0) {
            preg_match("/Maxthon\/([\d\.]+)/", $sys, $aoyou);
            $exp[0] = "傲游";
            $exp[1] = $aoyou[1];
        } elseif (stripos($sys, "MSIE") > 0) {
            preg_match("/MSIE\s+([^;)]+)+/i", $sys, $ie);
            $exp[0] = "IE";
            $exp[1] = $ie[1];  //获取IE的版本号
        } elseif (stripos($sys, "OPR") > 0) {
            preg_match("/OPR\/([\d\.]+)/", $sys, $opera);
            $exp[0] = "Opera";
            $exp[1] = $opera[1];
        } elseif(stripos($sys, "Edge") > 0) {
            //win10 Edge浏览器 添加了chrome内核标记 在判断Chrome之前匹配
            preg_match("/Edge\/([\d\.]+)/", $sys, $Edge);
            $exp[0] = "Edge";
            $exp[1] = $Edge[1];
        } elseif (stripos($sys, "Chrome") > 0) {
            preg_match("/Chrome\/([\d\.]+)/", $sys, $google);
            $exp[0] = "Chrome";
            $exp[1] = $google[1];  //获取google chrome的版本号
        } elseif(stripos($sys,'rv:')>0 && stripos($sys,'Gecko')>0){
            preg_match("/rv:([\d\.]+)/", $sys, $IE);
            $exp[0] = "IE";
            $exp[1] = $IE[1];
        }else {
            $exp[0] = "未知浏览器";
            $exp[1] = "";
        }
        return $exp[0].'('.$exp[1].')';
    }

    /**
     * 获取文件上传信息
     */
    public static function is_upload(){
        return ini_get('file_uploads') ? '支持' : '不支持';
    }

    /**
     * 获取最大上传信息
     */
    public static function max_upload_size(){
        return ini_get('upload_max_filesize');
    }

    /**
     * 表单上传最大值
     */
    public static function post_max_size(){
        return ini_get('post_max_size');
    }

    /**
     * 获取字符编码
     * @param $str
     * @return string
     */
    public static function getcode($str)
    {
        $s1 = iconv('utf-8','gbk',$str);
        $s0 = iconv('gbk','utf-8',$s1);
        if($s0 == $str){
            return 'utf-8';
        }else{
            return 'gbk';
        }
    }
}