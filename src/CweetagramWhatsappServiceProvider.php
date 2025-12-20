<?php

namespace Cweetagram\CweetagramVonageWhatsapp;

use Illuminate\Support\ServiceProvider;

class CweetagramWhatsappServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/Config/vonage_api.php', 'cweetagram');
    }
}