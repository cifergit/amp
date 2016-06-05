<?php

require_once(APPPATH . "libraries/wx_user_tools.php");

/**
 * Created by IntelliJ IDEA.
 * User: Administrator
 * Date: 2014/11/14
 * Time: 16:32
 */
define("WX_UNION", 'wx_union');

class MY_Controller extends CI_Controller
{
    // 当前url地址
    public $strCurUrl;
    public $sDomain;
    public $oWXUserTool;
    public $oWXConfig;
    public $oLoginConfig;

    public $uin;
    public $skey;
    public $uid;
    public $openid;
    public $sWXOpenid;
    public $sQQOpenid;
    public $sPCWXOpenid;
    public $sWXOpenidHash;
    public $sQQOpenidHash;
    public $sPCWXOpenidHash;
    public $oEnv;
    public $nSenceid = 1;
    public $nChannel = 3;
    public $arrRegSource = array('nPtag1' => 0, 'nPtag2' => 0, 'nPtag3' => 0);

    public $webLoginUrl;
    public $qqLoginUrl;
    public $wxLoginUrl;
    public $registUrl;
    public $plateform; //当前平台类型
    public $oUserInfo;
    public $oUidInfo;

    function __construct()
    {
        parent::__construct();
        $this->load->helper('cookie');
        $this->load->helper('env');
        $this->load->library('log');
        $this->config->load('config', TRUE);
        $this->config->load('my_errmsg', TRUE);
        $this->config->load('user_center', TRUE);
        $this->oWXConfig = $this->config->item('wx_config');
        $this->oQQConfig = $this->config->item('qq_config');
        $this->oWXWebConfig = $this->config->item('wxweb_config');
        $this->oLoginConfig = $this->config->item('login');
        $this->oUserCenter = $this->config->item('user_center');
        $this->oLoginUidConfig = $this->oUserCenter['login_uid'];
        $this->oLoginPlatform = $this->oUserCenter['login_platform'];

        $this->sDomain = $this->oLoginConfig['domain'];
        $this->webLoginUrl = $this->oLoginConfig['webLoginUrl'];
        $this->wxLoginUrl = $this->oLoginConfig['wxLoginUrl'];
        $this->qqLoginUrl = $this->oLoginConfig['qqLoginUrl'];
        $this->registUrl = $this->oLoginConfig['registUrl'];

        $this->webUidLoginUrl = $this->oLoginUidConfig['webLoginUrl'];
        $this->wxUidLoginUrl = $this->oLoginUidConfig['wxLoginUrl'];
        $this->wxWebUidLoginUrl = $this->oLoginUidConfig['wxWebLoginUrl'];
        $this->qqUidLoginUrl = $this->oLoginUidConfig['qqLoginUrl'];
        $this->registUidUrl = $this->oLoginUidConfig['registUrl'];
        $this->userIndexUrl = $this->oLoginUidConfig['userIndexUrl'];

        $this->strCurUrl = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $this->load->model('my/model_user');
        $this->checkHost();
        $this->getReqInput();
    }

    // 入口检验openid的合法性
    private function _check_openid()
    {
        // 微信openid
        $sWXOpenid = $this->input->cookie($this->oWXConfig['cnOpenId']);
        // 手Q openid
        $sQQOpenid = $this->input->cookie($this->oQQConfig['cnOpenId']);
        // web微信openid
        $sPCWXOpenid = $this->input->cookie($this->oWXWebConfig['cnOpenId']);

        if ($sWXOpenid) {
            $sWXOpenidHash = $this->input->cookie($this->oWXConfig['hashKey']);
            $nRet = $this->model_user->check_hash($sWXOpenidHash, $sWXOpenid);
            if (!$nRet) {
                $this->delete_login_cookie(1);
                $this->delete_login_cookie(4);
                cilog("[_check_openid] 校验微信客户端openid异常");
                // openid有异常，重新进行授权
                $this->doWXAuth();
                return false;
            } else {
                // 保存当前已验证的openid和hash
                $this->sWXOpenid = $sWXOpenid;
                $this->sWXOpenidHash = $sWXOpenidHash;
                // 删除其他场景的用户登录信息cookie
                $this->delete_login_cookie(2);
                $this->delete_login_cookie(3);
                return true;
            }
        } else if ($sQQOpenid) {
            $sQQOpenidHash = $this->input->cookie($this->oQQConfig['hashKey']);
            $nRet = $this->model_user->check_hash($sQQOpenidHash, $sQQOpenid);
            if (!$nRet) {
                $this->delete_login_cookie(2);
                $this->delete_login_cookie(4);
                cilog("[_check_openid] 校验第三方QQ openid异常");
                redirect_url($this->strCurUrl);
                exit();
                return false;
            } else {
                $this->sQQOpenid = $sQQOpenid;
                $this->sQQOpenidHash = $sQQOpenidHash;
                $this->delete_login_cookie(1);
                $this->delete_login_cookie(3);
                return true;
            }
        } else if ($sPCWXOpenid) {
            $sPCWXOpenidHash = $this->input->cookie($this->oWXWebConfig['hashKey']);
            $nRet = $this->model_user->check_hash($sPCWXOpenidHash, $sPCWXOpenid);

            if (!$nRet) {
                cilog("[_check_openid] 校验第三方微信 openid异常");
                $this->delete_login_cookie(3);
                $this->delete_login_cookie(4);
                redirect_url($this->strCurUrl);
                exit();
                return false;
            } else {
                $this->sPCWXOpenid = $sPCWXOpenid;
                $this->sPCWXOpenidHash = $sPCWXOpenidHash;
                $this->delete_login_cookie(1);
                $this->delete_login_cookie(2);
                return true;
            }
        } else {
            return true;
        }
    }

    function check_openid()
    {
        return $this->_check_openid();
    }

    // 校验openid与当前用户是否相符
    private function _check_openid_with_user($userInfo)
    {
        if ($this->sWXOpenid) {
            if ($userInfo->strWxOpenid == $this->sWXOpenid) {
                return true;
            } else {
                return false;
            }
        } else if ($this->sQQOpenid) {
            if ($userInfo->strQqOpenid == $this->sQQOpenid) {
                return true;
            } else {
                return false;
            }
        } else if ($this->sPCWXOpenid) {
            if ($userInfo->strPCWxOpenid == $this->sPCWXOpenid) {
                return true;
            } else {
                return false;
            }
        } else {
            // 无第三方openid
            return true;
        }
    }

    function delete_login_cookie($openidType = 0)
    {
        // 微信openid
        $sWXOpenid = $this->input->cookie($this->oWXConfig['cnOpenId']);
        // 手Q openid
        $sQQOpenid = $this->input->cookie($this->oQQConfig['cnOpenId']);
        // web微信openid
        $sPCWXOpenid = $this->input->cookie($this->oWXWebConfig['cnOpenId']);

        $uin = $this->input->cookie('uin');

        // $openidType:1 微信客户端登录， 2 qq登录， 3 pc版微信登录
        if (($openidType == 1 || $openidType == 0) && $sWXOpenid) {
            $this->delCookie($this->oWXConfig['cnOpenId']);
            $this->delCookie($this->oWXConfig['hashKey']);
        }

        if (($openidType == 2 || $openidType == 0) && $sQQOpenid) {
            $this->delCookie($this->oQQConfig['cnOpenId']);
            $this->delCookie($this->oQQConfig['hashKey']);
        }

        if (($openidType == 3 || $openidType == 0) && $sPCWXOpenid) {
            $this->delCookie($this->oWXWebConfig['cnOpenId']);
            $this->delCookie($this->oWXWebConfig['hashKey']);
        }

        if (($openidType == 4 || $openidType == 0) && $uin) {
            $this->delCookie('uin');
            $this->delCookie('skey');
        }
    }

// 获取请求接口的相关数据（cookie，输入参数）
    function getReqInput()
    {
        cilog('debug', "refer: " . (isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : ''));
        $strRegSource = $this->input->get_post('regsrc');

        try {
            $isEditCookie = false;
            $sEnv = $this->input->cookie('env');
            if (!$sEnv) {
                $this->oEnv = array();
            } else {
                if (!is_string($sEnv)) {
                    cilog("不符合预期的env值：" . json_encode($sEnv));
                } else {
                    $this->oEnv = json_decode($sEnv, true);
                    if (!is_array($this->oEnv)) {
                        $this->oEnv = array();
                    }
                }
            }

            // 获取channel
            if (isset($this->oEnv['channel'])) {
                $this->nChannel = $this->oEnv['channel'];
            }
            // 异常情况默认设置nChannel为1
            if (!preg_match("/\d+/", $this->nChannel) || !$this->nChannel) {
                $this->oEnv['channel'] = $this->nChannel = 1;
                $isEditCookie = true;
            }

            // 获取regsource
            if ($strRegSource) {
                // url中含有regsource，则需要更新cookie
                $this->oEnv['regsrc'] = $strRegSource;
                $isEditCookie = true;
            } else if (!isset($this->oEnv['regsrc']) || !$this->oEnv['regsrc']) {
                $this->oEnv['regsrc'] = '0.0.0';
            }
            $regNumber = "/^\d{1,15}$/";
            $arrPtags = explode('.', $this->oEnv['regsrc']);
            for ($i = 0; $i < 3; $i++) {
                if (preg_match($regNumber, $arrPtags[$i])) {
                    $this->arrRegSource['nPtag' . ($i + 1)] = $arrPtags[$i];
                }
            }
            $this->oEnv['regsrc'] = implode('.', $this->arrRegSource);

            if ($isEditCookie) {
                $this->input->set_cookie(array(
                    'name' => 'env',
                    'value' => json_encode(array(
                        'regsrc' => $this->oEnv['regsrc'],
                        'channel' => $this->oEnv['channel']
                    )),
                    'expire' => '2592000',
                    'domain' => $this->sDomain,
                    'path' => '/'
                ));
            }
        } catch (Exception $e) {

        }
    }

    function checkHost()
    {
        $whiteHosts = $this->config->item('whitehost');
        if ($whiteHosts && isset($_SERVER['HTTP_REFERER'])) {
            try {
                $refer = $_SERVER['HTTP_REFERER'];
                for ($i = 0; $i < count($whiteHosts); $i++) {
                    $whiteHosts[$i] = urldecode($whiteHosts[$i]);
                    if ($refer && (strpos($refer, $whiteHosts[$i]) !== false)) {
                        header("P3P: CP=CURa ADMa DEVa PSAo PSDo OUR BUS UNI PUR INT DEM STA PRE COM NAV OTC NOI DSP COR");
                        header("Access-Control-Allow-Origin: " . $whiteHosts[$i]);
                        header("Access-Control-Allow-Credentials: true");
                        return false;
                    }
                }
            } catch (Exception $e) {

            }
        }
    }

    function checklogin($type = 1, $custom = FALSE, $checkMobile = TRUE)
    {
        $arrQuery = array(
            // 1: ajax请求，2：页面请求
            'reqType' => $type,
            // 自定义跳转绑定或注册页面
            'custom' => $custom,
            // 是否校验手机
            'checkMobile' => $checkMobile,
            // 验证方式
            'wxAuthType' => 'snsapi_base',
            'wxAppName' => 'midea'
        );

        /*if (ENVIRONMENT != 'production' || $this->input->cookie('gray') == 1) {*/
        /*       if ($this->_check_openid()) {*/
        return $this->check_online_member($arrQuery);
        /*        } else {
            exit();
        }*/
    }

    function rediectLogin($oResp, $type = 1, $custom = false, $authType = 'base')
    {
        // 判断是否在微信场景中
        $isInWX = $this->model_user->isInWX();

        if ($custom == false) {
            if ($type != 1) {
                // 非ajax请求
                if ($this->sQQOpenid || $this->sWXOpenid || $this->sPCWXOpenid) {
                    // 都有合法的openid，跳转用户注册页
                    cilog('debug', "redirect regist page");
                    redirect_url($this->registUrl . '?rurl=' . urlencode($this->strCurUrl));
                    exit();
                } else if ($isInWX) {
                    // 无微信openid的情况下，判断是否在微信客户端内，如果是，则进行微信openid的获取逻辑，否则跳转到web登录页
                    cilog('debug', "redirect do auth");
                    $this->doWXAuth($authType);
                } else {
                    // 其他场景跳转登录页面
                    cilog('debug', "redirect login page");
                    redirect_url($this->webLoginUrl . '?rurl=' . urlencode($this->strCurUrl));
                    exit();
                }
            } else {
                // ajax请求
                $this->showErrorPage($oResp, $type);
            }
        } else {
            if ($isInWX && !$this->sWXOpenid) {
                // 判断是否在微信客户端内，如果是，则进行微信openid的获取逻辑，否则跳转到web登录页
                // 初始化微信工具包
                $this->oWXUserTool = new WXUserTools($this->oWXConfig['appid'], $this->oWXConfig['secret']);
                // 跳转授权页面
                //cilog('do auth: ' . $this->wxLoginUrl . '?rurl=' . urlencode($this->strCurUrl));
                $this->oWXUserTool->doAuth($this->wxLoginUrl . '?rurl=' . urlencode($this->strCurUrl), $authType);
            }
        }
    }

    function doWXAuth($authType = 'snsapi_base', $returnUrl = '')
    {
        // 判断是否在微信客户端内，如果是，则进行微信openid的获取逻辑，否则跳转到web登录页
        // 初始化微信工具包
        $this->oWXUserTool = new WXUserTools($this->oWXConfig['appid'], $this->oWXConfig['secret']);
        // 跳转授权页面
        //cilog('do auth: ' . $this->wxLoginUrl . '?rurl=' . urlencode($this->strCurUrl));
        $this->oWXUserTool->doAuth($returnUrl ? $returnUrl : ($this->wxLoginUrl . '?rurl=' . urlencode($this->strCurUrl)), $authType);
    }

    // 弱登录，通过openid获取用户信息
    function checkLoginByOP($type = 2, $custom = false, $authType = 'snsapi_base')
    {
        if ($this->_check_openid()) {
            if ($this->check_online(array(
                'reqType' => $type,
                'custom' => $custom,
                'wxAuthType' => $authType
            ))
            ) {
                // 拉取用户信息
                $oUserInfoResp = $this->model_user->get_user_info_uid(array(
                    'lUid' => $this->uid,
                    'strCurSession' => $this->skey
                ));

                if ($oUserInfoResp->iResult == 0) {
                    // 判断uin和openid是否为同一用户
                    $isReal = $this->_check_openid_with_user($oUserInfoResp->oUserInfo);
                    if ($isReal) {
                        $this->uin = $oUserInfoResp->oUserInfo->lUin;
                        $this->oUserInfo = $oUserInfoResp->oUserInfo;
                        cilog('debug', "[checkLoginByOP] User info: " . json_encode($this->oUserInfo));
                        return true;
                    } else {
                        // uin与openid不属于同一个用户，删除所有登录信息
                        // 只有在登录信息存在伪造的情况下，需要重新获取
                        cilog('[checkLoginByOP] Uin与openid不属于同一个用户');
                        $this->delete_login_cookie();
                        $this->rediectLogin_v2(array(
                            'iResult' => -1,
                            'strErrmsg' => 'Uin与openid不属于同一个用户'
                        ), array(
                            // 1: ajax请求，2：页面请求
                            'reqType' => $type,
                            // 自定义跳转绑定或注册页面
                            'custom' => $custom,
                            // 验证方式
                            'wxAuthType' => $authType
                        ));
                        return false;
                    }
                } else {
                    cilog('[checkLoginByOP] 获取用户个人信息失败：' . json_encode($oUserInfoResp));
                    // uin和skey虽然合法，但是已经无效
                    $this->delete_login_cookie(4);
                    return false;
                }
            }
        }
    }

    function showErrorPage($oResp, $type = 1)
    {
        if (is_array($oResp)) {
            $oRE = (object)$oResp;
        } else {
            $oRE = $oResp;
        }

        $this->load->view($type == 1 ? 'common/err_ajax' : 'common/err_page', array(
            'data' => array(
                'errCode' => $oRE->iResult,
                'errMsg' => $this->getErrMsg($oRE),
                'errcode' => $oRE->iResult,
                'errmsg' => $this->getErrMsg($oRE),
                'detail' => $oRE
            )
        ));
    }

    /**
     * 根据错误码获取错误信息
     *
     * @access public
     * @param object $oRE 错误数据对象
     * @return string 错误信息
     */
    function getErrMsg($oRE)
    {
        $strCommMsg = '系统繁忙，请稍后再试';
        $oErrMsgConfig = $this->config->item('my_errmsg');
        if (isset($oErrMsgConfig['my_err'][$oRE->iResult])) {
            // 获取配置的后台错误信息
            return $oErrMsgConfig['my_err'][$oRE->iResult];
        } else if ($oRE->iResult < 10000 || ($oRE->iResult >= 536850000 && $oRE->iResult <= 536870912)) {
            $this->load->helper('cgi_errmsg');
            // 小于 10000 或者错误码在536870912和536850000之间，取前端自定义错误信息
            return get_cgi_err_msg($oRE);
        } else {
            // 什么信息都没有，展示默认错误信息
            return $strCommMsg;
        }
    }

    // 根据openid获取用户基本信息
    function getDataByOP()
    {
        $oTemp = false;
        $userInfo = array('errcode' => 0);
        $content = '';
        if ($this->sQQOpenid) {
            $at = $this->input->cookie($this->oQQConfig['cnWebAccessToken']);
            $content = $this->http_get('https://graph.qq.com/user/get_user_info?access_token=' . $at . '&oauth_consumer_key=' . $this->oQQConfig['appid'] . '&openid=' . $this->sQQOpenid);

            $oTemp = json_decode($content);
            if ($oTemp->ret == '0') {
                $userInfo['strImageUrl'] = $oTemp->figureurl_qq_2;
                $userInfo['strNickname'] = $oTemp->nickname;
                $userInfo['sGender'] = $oTemp->gender == '女' ? 1 : 2;
            } else {
                $userInfo['errcode'] = 1;
            }
        } else if ($this->sPCWXOpenid) {
            $content = $this->http_get('http://wechat.midea.com/wxinterface/getuserinfo?app=midea_develop' . '&openid=' . $this->sPCWXOpenid);
            $oTemp = json_decode($content);
            if ($oTemp && isset($oTemp->subscribe) && $oTemp->subscribe == 1) {
                $userInfo['strImageUrl'] = $oTemp->headimgurl;
                $userInfo['strNickname'] = $oTemp->nickname;
                $userInfo['sGender'] = $oTemp->sex == '2' ? 1 : 2;
            } else {
                $userInfo['errcode'] = 1;
            }
        } else if ($this->sWXOpenid) {
            $content = $this->http_get('http://wechat.midea.com/wxinterface/getuserinfo?app=midea' . '&openid=' . $this->sWXOpenid);
            $oTemp = json_decode($content);
            if ($oTemp && isset($oTemp->subscribe) && $oTemp->subscribe == 1) {
                $userInfo['strImageUrl'] = $oTemp->headimgurl;
                $userInfo['strNickname'] = $oTemp->nickname;
                $userInfo['sGender'] = $oTemp->sex == '2' ? 1 : 2;
            } else {
                $userInfo['errcode'] = 1;
            }
        }
        if (isset($userInfo['strImageUrl'])) {
            $userInfo['strImageUrl'] = urldecode($userInfo['strImageUrl']);
        }

        return $userInfo;
    }

    // 更新用户基本信息
    public function updateUserInfoByOP()
    {
        $userData = $this->getDataByOP();
        if ($userData['errcode'] == 0) {
            $userData['lUin'] = $this->uin;
            $this->model_user->updateUser($userData);
        }
    }

    public function showNotice()
    {
        $time = time();
        if ($time >= 1420023600 && $time <= 1420070400) {
            $this->load->view('common/notice');
            return true;
        } else {
            return false;
        }
    }

    public function delCookie($name)
    {
        // 删除当前的登录信息
        $this->input->set_cookie(array(
            'name' => $name,
            'value' => '',
            'expire' => '-1',
            'domain' => $this->sDomain,
            'path' => '/'
        ));

        delete_cookie($name);
    }

    /**
     * GET 请求
     * @param string $url
     */
    public function http_get($url)
    {
        $oCurl = curl_init();
        if (stripos($url, "https://") !== FALSE) {
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, FALSE);
        }
        curl_setopt($oCurl, CURLOPT_URL, $url);
        curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
        $sContent = curl_exec($oCurl);
        $aStatus = curl_getinfo($oCurl);

        curl_close($oCurl);
        if (intval($aStatus["http_code"]) == 200) {
            return $sContent;
        } else {
            return false;
        }
    }

    /**
     * POST 请求
     * @param string $url
     * @param array $param
     * @return string content
     */
    public function http_post($url, $param)
    {
        $oCurl = curl_init();
        if (stripos($url, "https://") !== FALSE) {
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, false);
        }
        if (is_string($param)) {
            $strPOST = $param;
        } else {
            $aPOST = array();
            foreach ($param as $key => $val) {
                $aPOST[] = $key . "=" . urlencode($val);
            }
            $strPOST = join("&", $aPOST);
        }
        curl_setopt($oCurl, CURLOPT_URL, $url);
        curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($oCurl, CURLOPT_POST, true);
        curl_setopt($oCurl, CURLOPT_POSTFIELDS, $strPOST);
        $sContent = curl_exec($oCurl);
        $aStatus = curl_getinfo($oCurl);
        curl_close($oCurl);
        if (intval($aStatus["http_code"]) == 200) {
            return $sContent;
        } else {
            return false;
        }
    }

    public function date2second($strDate)
    {
        if ($strDate) {
            try {
                $oDate = strtotime($strDate);
            } catch (Exception $e) {
                cilog('日期转换出错：' . $e->getMessage() . '，字符串：' . $strDate);
                return "";
            }

            return $oDate;
        } else {
            return '';
        }
    }

    public function getValue($key, $df = '')
    {
        return get_post_value($key, $df);
    }

    public function getValueI($key, $df = 0)
    {
        return get_post_valueI($key, $df);
    }

    /**
     * 检查uid登录态（普通用户）
     *
     * @access public
     * @param array $arrParams
     * @return string
     */
    //$type = 1, $custom = FALSE, $checkMobile = TRUE, $isNeedStLogin = TRUE
    function check_online($arrParams = array())
    {
        $arrQuery = array_merge(array(
            // 1: ajax请求，2：页面请求
            'reqType' => 1,
            // 自定义跳转绑定或注册页面
            'custom' => FALSE,
            // 验证方式
            'wxAuthType' => 'snsapi_base', //userinfo
            'wxAppName' => 'midea'
        ), $arrParams);

        // 取当前页面中cookie进行校验(uid+skey, openid)
        $arrLoginData = $this->model_user->get_login_cookie();

        if (!$arrLoginData['uid'] || !$arrLoginData['skey']) {
            itil(245, 2);
            $oResp = (object)array(
                'iResult' => 539299862,
                'strErrmsg' => '用户未登录'
            );
        } else {
            $oResp = $this->model_user->check_online_uid(array(
                'lUid' => $arrLoginData['uid'],
                'strCurSession' => $arrLoginData['skey']
            ));
        }

        if ($oResp->iResult == 0) {
            itil(245, 1);
            // 验证合法的值记录到内容中，便于业务使用
            $this->uid = $arrLoginData['uid'];
            $this->skey = $arrLoginData['skey'];
            ciLogMark('uid', $this->uid);
            cilog('debug', "[check_online] 验证通过，uid[{$this->uid}，skey[{$this->skey}].");
            $oResp = $this->model_user->get_uid_info_by_id(array(
                'appName' => WX_UNION
            ));
            if ($oResp->iResult == 0) {
                $this->oUidInfo = $oResp->oUidInfo;
            } else {
                // 获取不到uid信息
                $this->showErrorPage($oResp, $arrQuery['reqType']);
                return false;
            }
            return true;
        } else {
            itil(245, 2);
            cilog('[check_online] 通过当前的uid或openid登录失败，进行重定向：' . json_encode($oResp));
            $this->rediectLogin_v2($oResp, $arrQuery);
            return false;
        }
    }

    /**
     * 检查会员登录态（普通用户）
     *
     * @access public
     * @param array $arrParams
     * @return string
     */
    function check_online_member($arrParams = array())
    {
        // 删除老版登录cookie的值，不删除浏览器cookie
        $this->model_user->unset_cookie(array(
            'uin', 'skey'
        ));

        $arrQuery = array_merge(array(
            // 1: ajax请求，2：页面请求
            'reqType' => 1,
            // 自定义跳转绑定或注册页面
            'custom' => FALSE,
            // 是否校验手机
            'checkMobile' => TRUE,
            // 验证方式
            'wxAuthType' => 'snsapi_base',
            'wxAppName' => 'midea'
        ), $arrParams);

        // 进行uid的登录态验证
        if ($this->check_online($arrQuery)) {
            // 拉取用户信息
            $oUserInfoResp = $this->model_user->get_user_info_uid(array(
                'lUid' => $this->uid,
                'strCurSession' => $this->skey
            ));

            if ($oUserInfoResp->iResult == 0) {
                // 是个会员
                // 记录用户个人信息
                $this->oUserInfo = $oUserInfoResp->oUserInfo;
                $this->uin = $this->oUserInfo->lUin;
                ciLogMark('uin', $this->uin);
                if ($arrQuery['custom']) {
                    // 判断会员是否有手机号，兼容老数据
                    if (!$this->oUserInfo->strMobile && $arrQuery['checkMobile'] == TRUE) {
                        cilog("[check_online_member] 用户[{$this->uin}]尚未绑定手机号");
                        return FALSE;
                    } else {
                        cilog('debug', "[check_online_member] 验证成功，uin[$this->uin]");
                        // $this->updateHeadImg();
                        return TRUE;
                    }
                } else {
                    // 判断会员是否有手机号，兼容老数据
                    if (!$this->oUserInfo->strMobile && $arrQuery['checkMobile'] == TRUE) {
                        cilog("[check_online_member] 用户[{$this->uin}]尚未绑定手机号");
                        if ($arrQuery['reqType'] == 2) {
                            // 跳转到重新绑定手机页
                            $this->load->view('my/account_setting', array(
                                'userData' => $this->oUserInfo
                            ));
                            return FALSE;
                        } else {
                            $oResp = (Object)array(
                                'iResult' => 1003,
                                'strErrmsg' => '您尚未绑定手机号'
                            );
                            $this->showErrorPage($oResp, $arrQuery['reqType']);
                            return FALSE;
                        }
                    } else {
                        cilog('debug', "[check_online_member] 验证成功，uin[$this->uin]");
                        // $this->updateHeadImg();
                        return TRUE;
                    }
                }
            } else {
                // 无该uid对应的会员信息，跳转用户注册页
                cilog("无该uid[{$this->uid}]对应的会员信息，跳转用户注册页: " . json_encode($oUserInfoResp));
                if ($arrQuery['custom']) {
                    return FALSE;
                } else {
                    if ($arrQuery['reqType'] == 2) {
                        redirect_url($this->registUidUrl . '?rurl=' . urlencode($this->strCurUrl));
                        exit();
                    } else {
                        $this->showErrorPage($oUserInfoResp, $arrQuery['reqType']);
                        return FALSE;
                    }
                }
            }
        }
    }

    /**
     * 校验登录态失败后的处理方法
     *
     * @access public
     * @param array $oResp 校验登录结果
     * @param array $arrParams 登录参数
     * @return string
     */
    function rediectLogin_v2($oResp, $arrParams)
    {
        $arrQuery = array_merge(
            array(
                'reqType' => 1,
                'custom' => FALSE,
                'wxAuthType' => 'snsapi_base',
                'wxAppName' => 'midea'
            ),
            $arrParams);

        if ($arrQuery['custom'] == FALSE) {
            if ($arrQuery['reqType'] != 1) {
                if ($oResp->iResult < 65535) {
                    // 系统级错误（<65535），不删登录信息，展示错误
                    $this->showErrorPage($oResp, $arrQuery['reqType']);
                    // 统计平台性错误
                    itil(246, 1);
                } else {
                    // 删除当前的登录信息
                    $this->model_user->delete_login_cookie();
                    // 非ajax请求
                    redirect_url($this->webUidLoginUrl . '?rurl=' . urlencode($this->strCurUrl));
                    exit();
                }
            } else {
                // 系统级错误（<65535），不删登录信息
                if ($oResp->iResult >= 65535) {
                    $this->model_user->delete_login_cookie();
                } else {
                    // 统计平台性错误
                    itil(246, 1);
                }
                // ajax请求，直接返回登录失败的json数据
                $this->showErrorPage($oResp, $arrQuery['reqType']);
            }
        } else {
            if ($oResp->iResult < 65535) {
                // 系统级错误（<65535），不删登录信息，展示错误
                // 统计平台性错误
                itil(246, 1);
            } else {
                $this->model_user->delete_login_cookie();
            }
        }
    }

    /**
     * 服务器更新（废弃方法）
     */
    public function checkServerUpgrade()
    {
        return false;
    }

    private function updateHeadImg()
    {
        // 设置cookie，标记正在更新头像
        if ($this->oUserInfo->strImageUrl && strpos($this->oUserInfo->strImageUrl, 'http://static.midea.com/') === false) {
            cilog('debug', '需要更新头像' . $this->oUserInfo->strImageUrl);
            // 不是本地头像，需要更新
            $nUpdateTag = $this->input->cookie('uig');
            if ($nUpdateTag != 1) {
                cilog('debug', '还未更新过头像');
                // 还未进行更新头像
                $this->load->driver('cache');
                $redis = $this->cache->redis->getRedis();
                $redis->rPush('old_wxuser_headimg', json_encode(array(
                    'uin' => $this->oUserInfo->lUin,
                    'headimg' => $this->oUserInfo->strImageUrl,
                    'env' => ENVIRONMENT
                )));

                // 设置更新标记
                $this->input->set_cookie(array(
                    'name' => 'uig',
                    'value' => 1,
                    'expire' => 86400,
                    'domain' => $this->sDomain,
                    'path' => '/'
                ));
            } else {
                cilog('debug', '头像正在更新');
            }
        }
    }
}