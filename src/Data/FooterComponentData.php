<?php

namespace Cweetagram\CweetagramVonageWhatsapp\Data;

use Spatie\LaravelData\Data;

class FooterComponentData extends Data
{
    public function __construct(
        public string $text,
    ) {

    }
}