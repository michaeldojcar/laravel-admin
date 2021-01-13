<?php


namespace MichaelDojcar\LaravelAdmin\Facades;


use Illuminate\Support\Facades\Facade;

/**
 * @method static bool routes(array $options = [])
 *
 * @package MichaelDojcar\LaravelAdmin\Facades
 */
class Admin extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'admin';
    }
}