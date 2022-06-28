<?php

namespace Vance\LaravelNotificationWechat\Contracts;

interface AccessTokenInterface
{
    /**
     * Get access token.
     *
     * @return string
     */
    public function getAccessToken();
}
