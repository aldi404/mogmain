<?php

namespace App\Libs\Whatsapp\Facade;

use Illuminate\Support\Facades\Facade;

class Whatsapp extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'whatsapp';
    }
}
