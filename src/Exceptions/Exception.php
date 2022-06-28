<?php

namespace Vance\LaravelNotificationWechat\Exceptions;

class Exception extends \Exception
{
    public const MISSING_APPID_APPSECRET = 1;

    public const GET_ACCESS_TOKEN_ERROR = 2;

    public const MISSING_TOWECHAT_METHOD = 3;

    public const SEND_TEMPLATE_MESSAGE_ERROR = 4;

    /**
     * Error raw data.
     *
     * @var array
     */
    public $raw = [];

    /**
     * Bootstrap.
     *
     * @param string       $message
     * @param string|int   $code
     * @param array|string $raw
     */
    public function __construct(string $message, $code, $raw = [])
    {
        $this->raw = is_array($raw) ? $raw : [];

        parent::__construct($message, intval($code));
    }
}
