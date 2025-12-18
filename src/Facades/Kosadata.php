<?php

namespace Nawasara\Kosadata\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Nawasara\Kosadata\Kosadata
 */
class Kosadata extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Nawasara\Kosadata\Kosadata::class;
    }
}
