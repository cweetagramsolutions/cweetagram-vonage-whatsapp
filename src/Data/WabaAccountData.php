<?php

namespace Cweetagram\CweetagramVonageWhatsapp\Data;

use Spatie\LaravelData\Data;

class WabaAccountData extends Data
{
    public function __construct(
        public string $waba_id,
        public string $from,
        public string $appJwt
    )
    {
        
    }
}
