<?php
/**
 * 首页
 * @category WuxcBlog
 * @copyright Copyright (c) 2016 WuxcBlog team (http://www.iwuxc.con)
 * @license GNU General Public License 2.0
 * @link www.iwuxc.com
 */

namespace Wuxc\Apps\Backend\Controllers;

use \Wuxc\Apps\Library\ServerNeedle;

class DashboardController extends BaseController {

    public function initialize()
    {
        parent::initialize();
    }

    /**
     * 控制面板
     */
    public function indexAction(){
        /** 获取服务器信息 */
        $systemInfo = array(
            'osName' => ServerNeedle::os_name(),
            'osVersion' => ServerNeedle::os_version(),
            'serverName' => ServerNeedle::server_host(),
            'serverIp' => ServerNeedle::server_ip(),
            'serverSoftware' => ServerNeedle::server_software(),
            'serverLanguage' => ServerNeedle::accept_language(),
            'serverPort' => ServerNeedle::server_port(),
            'phpVersion' => ServerNeedle::php_version(),
            'phpSapi' => ServerNeedle::php_sapi_name(),
            'getBroswer' => ServerNeedle::get_broswer(),
            'isUpload' => ServerNeedle::is_upload(),
            'maxUploadSize' => ServerNeedle::max_upload_size(),
            'postMaxSize' => ServerNeedle::post_max_size(),
            'getCode' =>ServerNeedle::getcode()
        );

        $this -> view ->setVars(
            [
                'systemInfo' => $systemInfo,
                'appVersion' => $this -> config -> application -> version,
                'currentTime' => date('Y-m-d H:i:s')
            ]
        );
        $this -> view -> pick('dashboard/index');
    }

}