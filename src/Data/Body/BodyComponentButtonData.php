<?php

namespace Cweetagram\CweetagramVonageWhatsapp\Data\Body;

use Spatie\LaravelData\Data;

class BodyComponentButtonData extends Data
{
    public function __construct(
        public string $type,
        public string $text,
        public ?string $url = null,
        public ?string $phone_number = null,
    ) {

    }
}