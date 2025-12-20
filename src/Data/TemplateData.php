<?php

namespace Cweetagram\CweetagramVonageWhatsapp\Data;

use Spatie\LaravelData\Attributes\Validation\In;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Data;

class TemplateData extends Data
{
    public function __construct(
        #[Required]
        public string $name,
        #[Required]
        public string $language,
        #[Required]
        public string $category,
        #[Required]
        #[In(['UTILITY', 'AUTHENTICATION', 'MARKETING'])]
        public bool $allow_category_change,
        #[Required]
        public ?array $components = null
    ) {

    }
}