<?php

namespace Lambq\GeeTest;

/**
 * Class GeeCaptcha.
 */
class GeeCaptcha extends GeetestLib
{
    /**
     * @return bool
     *
     * 判断是否是正确来自GT的服务器，万一down机或者什么的。
     */
    public function isFromGTServer()
    {
        session_start();

        return $_SESSION['gtserver'] == 1;
    }

    /**
     * @return bool|mixed|string
     *
     * 判断验证是否成功
     */
    public function success()
    {
        $data = [
            "user_id" => "test", # 网站用户id
            "client_type" => "web", #web:电脑上的浏览器；h5:手机上的浏览器，包括移动应用内完全内置的web_view；native：通过原生SDK植入APP应用的方式
            "ip_address" => "127.0.0.1" # 请在此处传输用户请求验证时所携带的IP
        ];
        $result = $this->success_validate($_POST['geetest_challenge'], $_POST['geetest_validate'], $_POST['geetest_seccode'],$data);

        return $result;
    }

    /**
     * @return int
     *
     * GT 服务器是否有回应
     */
    public function hasAnswer()
    {
        return $this->fail_validate($_POST['geetest_challenge'],$_POST['geetest_validate'],$_POST['geetest_seccode']);
    }

    /**
     * @return mixed
     *
     * 判断GT 服务器是否正常
     */
    public function GTServerIsNormal()
    {
        session_start();
        $data = [
            "user_id" => "test", # 网站用户id
            "client_type" => "web", #web:电脑上的浏览器；h5:手机上的浏览器，包括移动应用内完全内置的web_view；native：通过原生SDK植入APP应用的方式
            "ip_address" => "127.0.0.1" # 请在此处传输用户请求验证时所携带的IP
        ];
        $status = $this->pre_process($data,1);
        $_SESSION['gtserver'] = $status;
        $_SESSION['user_id'] = $data['user_id'];

        return $this->get_response_str();
    }
}