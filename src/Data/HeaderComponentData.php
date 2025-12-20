<?php

namespace Cweetagram\CweetagramVonageWhatsapp\Data;

use Cweetagram\CweetagramVonageWhatsapp\Data\Header\HeaderComponentExampleData;
use Cweetagram\CweetagramVonageWhatsapp\Enums\HeaderFormats;
use Cweetagram\CweetagramVonageWhatsapp\Enums\TemplateComponentTypes;
use Spatie\LaravelData\Attributes\Validation\In;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Data;

class HeaderComponentData extends Data
{
    public function __construct(
        public ?string $type = null,
        #[Required]
        #[In(['IMAGE', 'VIDEO', 'DOCUMENT', 'TEXT'])]
        public string $format,
        public ?string $text = null,
        public ?HeaderComponentExampleData $example = null,


    ) {

    }

    public static function text(string $text): self
    {
        return new self(
            type: TemplateComponentTypes::HEADER->value,
            format: HeaderFormats::TEXT->value,
            text: $text,
        );
    }

    public static function image(string $image): self
    {
        return new self(
            type: TemplateComponentTypes::HEADER->value,
            format: HeaderFormats::IMAGE->value,
            example: new HeaderComponentExampleData(
                header_handle: $image,
            ),
        );
    }

    public static function video(string $video): self
    {
        return new self(
            type: TemplateComponentTypes::HEADER->value,
            format: HeaderFormats::VIDEO->value,
            example: new HeaderComponentExampleData(
                header_handle: $video,
            ),
        );
    }

    public static function document(string $document): self
    {
        return new self(
            type: TemplateComponentTypes::HEADER->value,
            format: HeaderFormats::DOCUMENT->value,
            example: new HeaderComponentExampleData(
                header_handle: $document,
            ),
        );
    }
}