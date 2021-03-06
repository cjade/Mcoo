<?php
/**
 * Created by PhpStorm.
 * User: Jade
 * Date: 2018/2/8
 * Time: 下午2:21
 */

namespace App\Http\Controllers\WeChat;

use App\Http\Controllers\Controller;
use App\Services\WeChat;

class WeChatController extends Controller
{
    /**
     * 处理微信的请求消息
     *
     * @return string
     */
    public function serve()
    {
        WeChat::initWechat();
        return WeChat::serve();
    }


}