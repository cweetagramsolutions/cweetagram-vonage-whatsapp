<?php

namespace Cweetagram\CweetagramVonageWhatsapp\Data\Responses;

use Spatie\LaravelData\Data;

class TemplateStateResponseData extends Data
{
    public function __construct(
        public string $state
    ) {

    }
}