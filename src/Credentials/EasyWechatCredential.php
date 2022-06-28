<?php

namespace Vance\LaravelNotificationWechat\Credentials;

use Vance\LaravelNotificationWechat\Contracts\AccessTokenInterface;

class EasyWechatCredential implements AccessTokenInterface
{
    /**
     * Wechat access token.
     *
     * @var string
     */
    public $accessToken;

    /**
     * Bootstrap.
     */
    public function __construct()
    {
    }

    /**
     * Set wechat access_token.
     *
     * @param string $token
     *
     * @return EasyWechatCredential
     */
    public function setAccessToken($token)
    {
        $this->accessToken = $token;

        return $this;
    }

    /**
     * Get wechat access_token.
     *
     * @return string
     */
    public function getAccessToken()
    {
        if (!isset($this->accessToken)) {
            $app = app('wechat.official_account');

            return $app->access_token->getToken()['access_token'];
        }

        return $this->accessToken;
    }
}
