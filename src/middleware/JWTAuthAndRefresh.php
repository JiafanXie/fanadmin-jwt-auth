<?php


namespace FanAdmin\jwt\middleware;

use FanAdmin\jwt\exception\TokenExpiredException;
use FanAdmin\jwt\exception\TokenBlacklistGracePeriodException;

class JWTAuthAndRefresh extends BaseMiddleware
{
    public function handle($request, \Closure $next)
    {
        // OPTIONS请求直接返回
        if ($request->isOptions()) {
            return response();
        }

        // 验证token
        try {
            $this->auth->auth();
        } catch (TokenExpiredException $e) { // 捕获token过期
            // 尝试刷新token
            try {
                $this->auth->setRefresh();
                $token = $this->auth->refresh();

                // $payload = $this->auth->auth(false);
                // $request->uid = $payload['uid']->getValue();

                $response = $next($request);
                return $this->setAuthentication($response, $token);
            } catch (TokenBlacklistGracePeriodException $e) { // 捕获黑名单宽限期
                // $payload = $this->auth->auth(false);
                // $request->uid = $payload['uid']->getValue();

                return $next($request);
            }
        } catch (TokenBlacklistGracePeriodException $e) { // 捕获黑名单宽限期
            // $payload = $this->auth->auth(false);
            // $request->uid = $payload['uid']->getValue();
        }

        return $next($request);
    }
}
