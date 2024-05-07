<?php


namespace FanAdmin\jwt\contract;

use think\Request;

interface Parser
{
    public function parse(Request $request);
}
