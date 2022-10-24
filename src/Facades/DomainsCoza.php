<?php

namespace FintechSystems\DomainsCoza\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \FintechSystems\DomainsCoza\DomainsCoza
 */
class DomainsCoza extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'domainscoza';
    }
}
