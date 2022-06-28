<?php

namespace Vance\LaravelNotificationWechat;

use Vance\LaravelNotificationWechat\Contracts\AccessTokenInterface;
use Vance\LaravelNotificationWechat\Exceptions\SendTemplateMessageException;
use Vance\LaravelNotificationWechat\Traits\HasHttpRequest;

class Wechat
{
    use HasHttpRequest;

    /**
     * Credential.
     *
     * @var AccessTokenInterface
     */
    public $credential;

    /**
     * Wechat api gateway.
     *
     * @var string
     */
    protected $baseUri = 'https://api.weixin.qq.com/cgi-bin/';

    /**
     * Bootstrap.
     * @param AccessTokenInterface $credential
     *
     */
    public function __construct(AccessTokenInterface $credential)
    {
        $this->credential = $credential;
    }

    /**
     * Send template message.
     * @param string $params
     * @return array
     * @throws SendTemplateMessageException
     */
    public function sendMessage(string $params): array
    {
        $data = $this->post('message/template/send', $params, [
            'query' => [
                'access_token' => $this->credential->getAccessToken(),
            ],
        ]);

        if ($data['errcode'] !== 0) {
            throw new SendTemplateMessageException($data['errmsg'], $data['errcode'], $data, $this->credential);
        }

        return $data;
    }
}
