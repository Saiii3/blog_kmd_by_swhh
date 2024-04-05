<?php

namespace App\Providers;

use HTMLPurifier;

class HTMLPurifierService
{
    public function clean($html)
    {
        $config = \HTMLPurifier_Config::createDefault();
        $purifier = new \HTMLPurifier($config);
        return $purifier->purify($html);
    }
}
