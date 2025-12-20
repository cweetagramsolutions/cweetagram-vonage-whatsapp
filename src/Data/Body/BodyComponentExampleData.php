<?php

namespace Cweetagram\CweetagramVonageWhatsapp\Data\Body;

use Spatie\LaravelData\Data;

class BodyComponentExampleData extends Data
{
    public function __construct(
        public ?string $body_text = null,
    ) {

    }
}