<?php

namespace FanAdmin\jwt\exception;

class TokenMissingException extends JWTException
{
    protected $message = 'token missing';
}
