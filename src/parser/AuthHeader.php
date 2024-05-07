<?php


namespace FanAdmin\jwt\parser;

use FanAdmin\jwt\contract\Parser as ParserContract;
use FanAdmin\jwt\exception\TokenMissingException;
use think\Request;

class AuthHeader implements ParserContract
{
    protected $header = 'authorization';

    protected $prefix = 'bearer';

    public function parse(Request $request)
    {
        $header = $request->header($this->header);
        if ($header
            && preg_match('/'.$this->prefix.'\s*(\S+)\b/i', $header, $matches)
        ) {
            return $matches[1];
        }

        throw new TokenMissingException();
    }

    public function setHeaderName($name)
    {
        $this->header = $name;

        return $this;
    }

    public function setHeaderPrefix($prefix)
    {
        $this->prefix = $prefix;

        return $this;
    }
}
