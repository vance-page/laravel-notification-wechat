<?php

namespace Vance\LaravelNotificationWechat;

use Illuminate\Notifications\Notification;
use Vance\LaravelNotificationWechat\Contracts\AccessTokenInterface;
use Vance\LaravelNotificationWechat\Credentials\DefaultCredential;
use Vance\LaravelNotificationWechat\Exceptions\SendTemplateMessageException;

class WechatChannel
{
    /**
     * Wechat.
     *
     * @var Wechat
     */
    protected $wechat;

    /**
     * Bootstrap.
     *
     * @param Wechat $wechat
     */
    public function __construct(Wechat $wechat)
    {
        $this->wechat = $wechat;
    }

    /**
     * Send the given notification.
     *
     * @param mixed        $notifiable
     * @param Notification $notification
     *
     * @throws Exceptions\SendTemplateMessageException
     *
     * @return array
     */
    public function send($notifiable, Notification $notification)
    {
        if (!method_exists($notification, 'toWechat')) {
            throw new SendTemplateMessageException('Missing ToWechat Method In Wechat Channel', SendTemplateMessageException::MISSING_TOWECHAT_METHOD);
        }

        /* @var WechatMessage $message */
        $message = $notification->toWechat($notifiable);

        if (is_string($message->credential)) {
            $credential = (new DefaultCredential())->setAccessToken($message->credential);

            $this->wechat = new Wechat($credential);
        } elseif ($message->credential instanceof AccessTokenInterface) {
            $this->wechat = new Wechat($message->credential);
        }

        $params = $message->toJson();

        return $this->wechat->sendMessage($params);
    }
}
