<?php

namespace Cweetagram\CweetagramVonageWhatsapp\Data\Responses;

use Spatie\LaravelData\Data;

class CreatedTemplateResponseData extends Data
{
    public function __construct(
        public string $id,
    ) {

    }
}