<?php

namespace Cweetagram\CweetagramVonageWhatsapp\Data\Body;

use Cweetagram\CweetagramVonageWhatsapp\Enums\BodyButtonTypes;
use Spatie\LaravelData\Attributes\Validation\In;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Data;

class BodyComponentButtonData extends Data
{
    public function __construct(
        #[Required]
        #[In('QUICK_REPLY', 'URL', 'PHONE_NUMBER')]
        public string $type,
        #[Required]
        public string $text,
        public ?string $url = null,
        public ?string $phone_number = null,
    ) {

    }

    public static function quickReply(string $text): self
    {
        return new self(
            type: BodyButtonTypes::QUICK_REPLY->value,
            text: $text
        );
    }

    public static function phoneNumber(string $text, string $phone_number): self
    {
        return new self(
            type: BodyButtonTypes::PHONE_NUMBER->value,
            text: $text,
            phone_number: $phone_number
        );
    }

    public static function url(string $text, string $url): self
    {
        return new self(
            type: BodyButtonTypes::URL->value,
            text: $text,
            url: $url
        );
    }
}