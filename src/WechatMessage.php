<?php

namespace Vance\LaravelNotificationWechat;

class WechatMessage
{
    /**
     * Payload.
     *
     * @var array
     */
    public $payload;

    /**
     * Credential.
     *
     * @var mixed
     */
    public $credential;

    /**
     * Bootstrap.
     *
     * @param mixed $credential
     */
    public function __construct($credential = null)
    {
        $this->credential = $credential;
    }

    /**
     * Create a new instance.
     *
     * @param mixed $credential
     *
     * @return WechatMessage
     */
    public static function create($credential = null)
    {
        return new static($credential);
    }

    /**
     * Target user.
     *
     * @param string $openid
     *
     * @return WechatMessage
     */
    public function to($openid)
    {
        $this->payload['touser'] = $openid;

        return $this;
    }

    /**
     * Target template id.
     *
     * @param string $template_id
     *
     * @return WechatMessage
     */
    public function template(string $template_id)
    {
        $this->payload['template_id'] = $template_id;

        return $this;
    }

    /**
     * Template's target url.
     *
     * @param string $url
     *
     * @return WechatMessage
     */
    public function url(string $url)
    {
        $this->payload['url'] = $url;

        return $this;
    }

    /**
     * Template's target miniprogram.
     *
     * @param string $appid
     * @param string $pagepath
     *
     * @return WechatMessage
     */
    public function miniprogram(string $appid, string $pagepath)
    {
        $this->payload['miniprogram']['appid'] = $appid;
        $this->payload['miniprogram']['pagepath'] = $pagepath;

        return $this;
    }

    /**
     * Target data.
     *
     * @param array $data
     *
     * @return WechatMessage
     */
    public function data(array $data)
    {
        foreach ($data as $k => $v) {
            $this->payload['data'][$k] = is_array($v) ?
                ['value' => reset($v), 'color' => end($v)] :
                ['value' => $v, 'color' => '#173177'];
        }

        return $this;
    }

    /**
     * Convent payload to json format.
     *
     * @return string
     */
    public function toJson()
    {
        return json_encode($this->payload);
    }
}
