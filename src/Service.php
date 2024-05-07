<?php


namespace FanAdmin\jwt;

use FanAdmin\jwt\command\SecretCommand;
use FanAdmin\jwt\middleware\InjectJwt;
use FanAdmin\jwt\provider\JWT as JWTProvider;

class Service extends \think\Service
{
    public function boot()
    {
        $this->commands(SecretCommand::class);

        (new JWTProvider())->register();
    }
}
