<?php

namespace Cweetagram\CweetagramVonageWhatsapp\Data;

use Cweetagram\CweetagramVonageWhatsapp\Data\Body\BodyComponentButtonData;
use Cweetagram\CweetagramVonageWhatsapp\Data\Body\BodyComponentExampleData;
use Spatie\LaravelData\Data;

class BodyComponentData extends Data
{
    public function __construct(
        public ?string $type = null,
        public string $format,
        public string $text,
        public ?BodyComponentExampleData $example = null,
        public ?array $buttons = null

    )
    {

    }

    public static function text(string $text, ?string $example_body_text = null, array $buttons = []): self
    {
        return new self(
            type: 'BODY',
            format: 'TEXT',
            text: $text,
            example: new BodyComponentExampleData(
                body_text: $example_body_text
            ),
            buttons: $buttons
        );
    }
}
