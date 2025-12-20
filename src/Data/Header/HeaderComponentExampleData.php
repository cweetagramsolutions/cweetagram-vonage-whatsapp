<?php

namespace Cweetagram\CweetagramVonageWhatsapp\Data\Header;

use Spatie\LaravelData\Data;

class HeaderComponentExampleData extends Data
{
    public function __construct(
        public ?string $header_handle = null,

    ) {

    }
}