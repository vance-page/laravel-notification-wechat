<?php

namespace Vance\LaravelNotificationWechat;

use Illuminate\Support\ServiceProvider;
use Vance\LaravelNotificationWechat\Credentials\DefaultCredential;
use Vance\LaravelNotificationWechat\Credentials\EasyWechatCredential;

class WechatServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->app->when(WechatChannel::class)
            ->needs(Wechat::class)
            ->give(function () {
                $credential = new DefaultCredential(config('services.wechat.appid'), config('services.wechat.appsecret'));

                if (class_exists('EasyWeChat\Factory')) {
                    $credential = new EasyWechatCredential();
                }

                return new Wechat($credential);
            });
    }

    /**
     * Register any package services.
     */
    public function register()
    {
    }
}
