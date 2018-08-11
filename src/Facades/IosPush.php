<?php
namespace peal\iosnotification\Facades;

use Illuminate\Support\Facades\Facade;

class IosPush extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'IosPush'; }
}