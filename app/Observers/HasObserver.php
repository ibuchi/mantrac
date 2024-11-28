<?php

namespace App\Observers;

trait HasObserver
{
    public static function bootHasObserver()
    {
        $observer = class_basename(self::class) . 'Observer';

        self::observe("App\Observers\\$observer");
    }
}
