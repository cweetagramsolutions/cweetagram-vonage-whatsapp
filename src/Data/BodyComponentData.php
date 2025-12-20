<?php

namespace Cweetagram\CweetagramVonageWhatsapp\Data;

use Cweetagram\CweetagramVonageWhatsapp\Data\Body\BodyComponentButtonData;
use Cweetagram\CweetagramVonageWhatsapp\Data\Body\BodyComponentExampleData;
use Spatie\LaravelData\Data;

class BodyComponentData extends Data
{
    public function __construct(
        public string $type = "BODY",
        public string $format,
        public string $text,
        public ?BodyComponentExampleData $example,
        public ?array $buttons

    )
    {

    }

    public static function body(string $body, ?string $example_body_text, array $buttons = []): self
    {
        return self::from([
            'format' => 'TEXT',
            'text' => $body,
            'example' => new BodyComponentExampleData(
                body_text: $example_body_text
            ),
            'buttons' => $buttons,
        ]);
    }
}