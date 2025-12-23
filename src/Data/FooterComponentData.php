<?php

namespace Cweetagram\CweetagramVonageWhatsapp\Data;

use Spatie\LaravelData\Data;

class FooterComponentData extends Data
{
    public function __construct(
        public ?string $type = null,
        public string $text,
    ) {

    }

    public static function text(string $text): self
    {
        return new self(type: "FOOTER", text: $text);
    }
}
