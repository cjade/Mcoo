<?php
/**
 * Created by PhpStorm.
 * User: Jade
 * Date: 2018/2/8
 * Time: 下午2:21
 */

namespace App\Http\Controllers\WeChat;

use App\Http\Controllers\Controller;
use EasyWeChat\Kernel\Messages\News;
use EasyWeChat\Kernel\Messages\NewsItem;
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
        $app->server->push(function ($message) {
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

    /**
     * 收到事件消息
     * @param $message
     * @return string
     */
    public static function _eventMsgHandler($message)
    {

        switch ($message['Event']) {
            case 'subscribe':
                return '欢迎关注 让时光有力量！输入help查看菜单';
                break;
            case 'unsubscribe'://取消关注
                Log::info('取消关注');
                break;
        }

    }

    /**
     * 收到文字消息
     * @param $message
     * @return News|string
     */
    public static function _testMsgHandler($message)
    {
        switch ($message['Content']) {
            case 'help':
                $menu = "指令菜单:\n";
                $menu .= "1. 用户信息\n";
                $menu .= "2. 最新文章\n";
                $menu .= "3. 博客首页\n";
                return $menu;
                break;
            case '1':
                return $message['FromUserName'] ;
                break;
            case '2':
                $items = [
                    new NewsItem([
                        'title'       => "阿里云Centos搭建lnmp(php7.2+nginx+mysql5.7)",
                        'description' => '阿里云Centos搭建lnmp(php7.2+nginx+mysql5.7)',
                        'url'         => "https://mp.weixin.qq.com/s/PfZthLNbtPlH_RX63ro6pw",
                        'image'       => "https://static.oschina.net/uploads/img/201801/31141427_38sD.png",
                        ]),
                    new NewsItem([
                        'title'       => "GitHub利用webhook实现push时项目自动部署",
                        'description' => 'GitHub利用webhook实现push时项目自动部署',
                        'url'         => "https://my.oschina.net/silents/blog/1613563",
                        'image'       => "https://static.oschina.net/uploads/img/201801/26154918_MbB6.jpg",
                    ]),
                    ];
                    $news = new News($items);
                return $news;
                break;
            case '3':
                return "<a href='https://www.mcoo.me/'>博客首页</a>";
                break;
            default:
                return '你是不是傻!';
                break;
        }
    }


}