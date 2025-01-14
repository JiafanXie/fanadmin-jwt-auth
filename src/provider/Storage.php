<?php


namespace FanAdmin\jwt\provider;


use FanAdmin\jwt\contract\Storage as StorageContract;
use think\facade\Cache;

class Storage implements StorageContract
{
    public function delete($key)
    {
        return Cache::delete($key);
    }

    public function get($key)
    {
        return Cache::get($key);
    }

    public function set($key, $val, $time = 0)
    {
        return Cache::set($key, $val, $time);
    }
}