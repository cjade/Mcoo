<?php
/**
 * Created by PhpStorm.
 * User: Jade
 * Date: 2018/2/8
 * Time: 下午2:21
 */
namespace App\Http\Controllers\WeChat;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class WeChatController extends Controller
{
    /**
     * 处理微信的请求消息
     *
     * @return string
     */
    public function serve()
    {
        Log::info('request arrived.'); # 注意：Log 为 Laravel 组件，所以它记的日志去 Laravel 日志看，而不是 EasyWeChat 日志

        $app = app('wechat.official_account');
        $app->server->push(function($message){
            switch ($message['MsgType']) {
                case 'event':
                    return self::_eventMsgHandler($message);
                    break;
                case 'text':
                    return self::_testMsgHandler($message);
                    break;
                case 'image':
                    return '收到图片消息';
                    break;
                case 'voice':
                    return '收到语音消息';
                    break;
                case 'video':
                    return '收到视频消息';
                    break;
                case 'location':
                    return '收到坐标消息';
                    break;
                case 'link':
                    return '收到链接消息';
                    break;
                // ... 其它消息
                default:
                    return '';
                    break;
            }
        });

        return $app->server->serve();
    }

    public static function _eventMsgHandler($message){

        switch ($message['Event']){
            case 'subscribe':
                return '欢迎关注 让时光有力量！输入help查看菜单';
                break;
            case 'unsubscribe'://取消关注
                Log::info('取消关注');
                break;
        }

    }

    public static function _testMsgHandler($message){
        switch ($message['Content']){
            case 'help':
                return "指令菜单:\n1. 用户信息 \n2. dsd \n3. dsa";
                break;
            case 'aa'://取消关注
                return 'aa';
                break;
            default:
                return '收到文字消息';
                break;
        }
    }


}