<?php


namespace FanAdmin\jwt;

use FanAdmin\jwt\claim\Factory;
use FanAdmin\jwt\claim\Issuer;
use FanAdmin\jwt\claim\Audience;
use FanAdmin\jwt\claim\Expiration;
use FanAdmin\jwt\claim\IssuedAt;
use FanAdmin\jwt\claim\JwtId;
use FanAdmin\jwt\claim\NotBefore;
use FanAdmin\jwt\claim\Subject;

class Payload
{
    protected $factory;

    protected $classMap
        = [
            'aud' => Audience::class,
            'exp' => Expiration::class,
            'iat' => IssuedAt::class,
            'iss' => Issuer::class,
            'jti' => JwtId::class,
            'nbf' => NotBefore::class,
            'sub' => Subject::class,
        ];

    /**
     * @var array
     */
    public const CLAIMS_MAP = [
        'aud' => 'permittedFor',
        'exp' => 'expiresAt',
        'iat' => 'issuedAt',
        'iss' => 'issuedBy',
        'jti' => 'identifiedBy',
        'nbf' => 'canOnlyBeUsedAfter',
        'sub' => 'relatedTo',
    ];

    protected $claims;

    public function __construct(Factory $factory)
    {
        $this->factory = $factory;
    }

    public function customer(array $claim = [])
    {
        foreach ($claim as $key => $value) {
            $this->factory->customer(
                $key,
                is_object($value) ? $value->getValue() : $value
            );
        }

        return $this;
    }

    public function get()
    {
        $claim = $this->factory->builder()->getClaims();

        return $claim;
    }

    public function check($refresh = false)
    {
        $this->factory->validate($refresh);

        return $this;
    }


    /**
     * @desc match class map
     * @param string $key
     * @return string|null
     */
    public function matchClassMap(string $key): ?string
    {
        $class = null;
        switch($key) {
            case 'aud':
                $class = Audience::class;
                break;
            case 'exp':
                $class = Expiration::class;
                break;
            case 'iat':
                $class = IssuedAt::class;
                break;
            case 'iss':
                $class = Issuer::class;
                break;
            case 'jti':
                $class = JwtId::class;
                break;
            case 'nbf':
                $class = NotBefore::class;
                break;
            case 'sub':
                $class = Subject::class;
                break;
        }

        return $class;
    }
}
