<?php


namespace FanAdmin\jwt\parser;

use FanAdmin\jwt\contract\Parser as ParserContract;
use think\Request;

class Param implements ParserContract
{
    use KeyTrait;

    public function parse(Request $request)
    {
        return $request->param($this->key);
    }
}
