<?php
/**
 * Created by PhpStorm.
 * User: Jade
 * Date: 2018/2/8
 * Time: 下午2:21
 */

namespace App\Http\Controllers\WeChat;

use App\Http\Controllers\Controller;
use App\Services\WeChatController as WeChat;
use EasyWeChat\Kernel\Messages\Text;

class WeChatController extends Controller
{
    /**
     * 处理微信的请求消息
     *
     * @return string
     */
    public function serve()
    {
        return WeChat::serve();
    }

    public function aa()
    {
        $message = new Text('Hello world!');
        $app = app('wechat.official_account');
        return $app->customer_service->message($message)->to("oGpl_wpt1lW4F6-WSnjh2p6752Kc")->send();
    }

}