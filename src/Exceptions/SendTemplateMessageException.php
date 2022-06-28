<?php

namespace Vance\LaravelNotificationWechat\Exceptions;

use Vance\LaravelNotificationWechat\Contracts\AccessTokenInterface;

class SendTemplateMessageException extends Exception
{
    /**
     * Credential.
     *
     * @var AccessTokenInterface
     */
    public $credential;

    /**
     * Bootstrap.
     *
     * @param string                      $message
     * @param string|int                  $code
     * @param array                       $raw
     * @param AccessTokenInterface | null $credential
     */
    public function __construct(string $message, $code = Exception::SEND_TEMPLATE_MESSAGE_ERROR, $raw = [], $credential = null)
    {
        parent::__construct($message, $code, $raw);

        $this->credential = $credential;
    }
}
