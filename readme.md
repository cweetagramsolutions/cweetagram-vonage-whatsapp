# Cweetagram Vonage WhatsApp

A Laravel package for creating and managing WhatsApp message templates using the Vonage WhatsApp Manager API with type-safe data structures.

## Features

- 🎯 Type-safe WhatsApp template creation using `spatie/laravel-data`
- 📝 Support for all template components (Header, Body, Footer, Buttons)
- 🖼️ Multiple header formats (Text, Image, Video, Document)
- ✅ Built-in validation
- 🔄 Easy conversion to Vonage API format
- 🛠️ Template management services (Create, Delete, Get State)
- 🧪 Fully tested

## Requirements

- PHP 8.1 or higher
- Laravel 10.x or 11.x

## Installation

Install the package via Composer:

```bash
composer require cweetagram/cweetagram-vonage-whatsapp
```

Publish the configuration file:

```bash
php artisan vendor:publish --provider="Cweetagram\CweetagramVonageWhatsapp\VonageServiceProvider" --tag="config"
```

Add your Vonage API endpoint to your `.env` file:

```env
VONAGE_API_ENDPOINT=https://api.nexmo.com/v2/
```

## Configuration

The package configuration file (`config/vonage_api.php`) includes:

```php
return [
    'api_endpoint' => env('VONAGE_API_ENDPOINT', 'https://api.nexmo.com/v2/'),
];
```

## Usage

### Setting Up WABA Account Data

Before making API calls, you need to provide your WhatsApp Business Account credentials:

```php
use Cweetagram\CweetagramVonageWhatsapp\Data\WabaAccountData;

$wabaAccount = new WabaAccountData(
    waba_id: 'your-waba-id',
    appJwt: 'your-jwt-token'
);
```

### Creating Templates

#### Simple Text Template

```php
use Cweetagram\CweetagramVonageWhatsapp\Data\TemplateData;
use Cweetagram\CweetagramVonageWhatsapp\Data\HeaderComponentData;
use Cweetagram\CweetagramVonageWhatsapp\Data\BodyComponentData;
use Cweetagram\CweetagramVonageWhatsapp\Data\FooterComponentData;
use Cweetagram\CweetagramVonageWhatsapp\Enums\TemplateCategories;
use Cweetagram\CweetagramVonageWhatsapp\Services\Templates\CreateTemplateService;

$components = [
    HeaderComponentData::text("Congratulations")->toArray(),
    BodyComponentData::text("Lorem ipsum messages come here there")->toArray(),
    FooterComponentData::text("This is an automated message. Please do not reply")->toArray(),
];

$template = new TemplateData(
    name: "welcome_message",
    language: "en",
    category: TemplateCategories::MARKETING->value,
    allow_category_change: true,
    components: $components
);

$service = new CreateTemplateService();
$response = $service->handle($wabaAccount, $template);

if ($response) {
    // Template created successfully
    echo "Template ID: " . $response->template_id;
}
```

#### Marketing Template with Image Header

```php
$components = [
    HeaderComponentData::image("https://example.com/promo.jpg")->toArray(),
    BodyComponentData::text("🎉 Special offer! Get {{1}}% off on all products. Use code: {{2}}")->toArray(),
    FooterComponentData::text("Offer valid until {{3}}")->toArray(),
];

$template = new TemplateData(
    name: "summer_sale_2024",
    language: "en",
    category: TemplateCategories::MARKETING->value,
    allow_category_change: true,
    components: $components
);

$service = new CreateTemplateService();
$response = $service->handle($wabaAccount, $template);
```

### Getting Template State

Check the approval status of a template:

```php
use Cweetagram\CweetagramVonageWhatsapp\Services\Templates\GetTemplateStateService;

$service = new GetTemplateStateService();
$state = $service->handle($wabaAccount, 'template-id-here');

if ($state) {
    echo "Template status: " . $state->state;
    // Possible states: APPROVED, PENDING, REJECTED, etc.
}
```

### Deleting Templates

Remove a template from your WABA:

```php
use Cweetagram\CweetagramVonageWhatsapp\Services\Templates\DeleteTemplateService;

$service = new DeleteTemplateService();
$service->handle($wabaAccount, 'template-id-here');
```

## Header Component Types

### Text Header
```php
$header = HeaderComponentData::text("Welcome to Our Store");
```

### Image Header
```php
$header = HeaderComponentData::image("https://example.com/image.jpg");
```

### Video Header
```php
$header = HeaderComponentData::video("https://example.com/video.mp4");
```

### Document Header
```php
$header = HeaderComponentData::document("https://example.com/document.pdf");
```

## Body Component

Create body text with variable placeholders:

```php
$body = BodyComponentData::text("Your order #{{1}} has been shipped and will arrive by {{2}}");
```

## Footer Component

Add footer text to your template:

```php
$footer = FooterComponentData::text("Thank you for shopping with us");
```

## Available Services

### CreateTemplateService

Creates a new WhatsApp template in your WABA.

**Method:** `handle(WabaAccountData $wabaAccountData, TemplateData $templateData): ?CreatedTemplateResponseData`

**Returns:** `CreatedTemplateResponseData` on success, `null` on failure

### GetTemplateStateService

Retrieves the current state/status of a template.

**Method:** `handle(WabaAccountData $wabaAccountData, string $templateId): ?TemplateStateResponseData`

**Returns:** `TemplateStateResponseData` on success, `null` on failure

### DeleteTemplateService

Deletes a template from your WABA.

**Method:** `handle(WabaAccountData $wabaAccountData, string $templateId): void`

**Returns:** `void` (logs errors if deletion fails)

## Available Template Categories

The package supports all Vonage WhatsApp template categories:

```php
use Cweetagram\CweetagramVonageWhatsapp\Enums\TemplateCategories;

TemplateCategories::MARKETING->value;        // Marketing messages
TemplateCategories::UTILITY->value;          // Utility messages (order updates, etc.)
TemplateCategories::AUTHENTICATION->value;   // OTP and authentication
```

## Available Header Formats

```php
use Cweetagram\CweetagramVonageWhatsapp\Enums\HeaderFormats;

HeaderFormats::TEXT->value;      // Plain text header
HeaderFormats::IMAGE->value;     // Image header
HeaderFormats::VIDEO->value;     // Video header
HeaderFormats::DOCUMENT->value;  // Document header
```

## Template Structure

When you call `$template->toArray()` or `$template->all()`, it returns a structure compatible with Vonage's API:

```php
[
    'name' => 'template_name',
    'language' => 'en',
    'category' => 'MARKETING',
    'allow_category_change' => true,
    'components' => [
        [
            'type' => 'HEADER',
            'format' => 'TEXT',
            'text' => 'Header text'
        ],
        [
            'type' => 'BODY',
            'text' => 'Body text with {{1}} variables'
        ],
        [
            'type' => 'FOOTER',
            'text' => 'Footer text'
        ]
    ]
]
```

## Error Handling

All services include built-in error handling and logging. Failed operations are logged with detailed error messages:

```php
$service = new CreateTemplateService();
$response = $service->handle($wabaAccount, $template);

if ($response === null) {
    // Check logs for detailed error information
    // Error: "Failed to create template for account {waba_id} : {error_message}"
}
```

## Example: Complete Workflow

```php
use Cweetagram\CweetagramVonageWhatsapp\Data\WabaAccountData;
use Cweetagram\CweetagramVonageWhatsapp\Data\TemplateData;
use Cweetagram\CweetagramVonageWhatsapp\Data\HeaderComponentData;
use Cweetagram\CweetagramVonageWhatsapp\Data\BodyComponentData;
use Cweetagram\CweetagramVonageWhatsapp\Data\FooterComponentData;
use Cweetagram\CweetagramVonageWhatsapp\Enums\TemplateCategories;
use Cweetagram\CweetagramVonageWhatsapp\Services\Templates\CreateTemplateService;
use Cweetagram\CweetagramVonageWhatsapp\Services\Templates\GetTemplateStateService;
use Cweetagram\CweetagramVonageWhatsapp\Services\Templates\DeleteTemplateService;

// 1. Set up WABA credentials
$wabaAccount = new WabaAccountData(
    waba_id: 'your-waba-id',
    appJwt: 'your-jwt-token'
);

// 2. Create template
$components = [
    HeaderComponentData::text("Order Update")->toArray(),
    BodyComponentData::text("Your order {{1}} has been {{2}}")->toArray(),
    FooterComponentData::text("Track your order anytime")->toArray(),
];

$template = new TemplateData(
    name: "order_status_update",
    language: "en",
    category: TemplateCategories::UTILITY->value,
    allow_category_change: false,
    components: $components
);

$createService = new CreateTemplateService();
$created = $createService->handle($wabaAccount, $template);

if ($created) {
    $templateId = $created->template_id;
    
    // 3. Check template state
    $stateService = new GetTemplateStateService();
    $state = $stateService->handle($wabaAccount, $templateId);
    
    if ($state) {
        echo "Template status: " . $state->state;
    }
    
    // 4. Delete template if needed
    // $deleteService = new DeleteTemplateService();
    // $deleteService->handle($wabaAccount, $templateId);
}
```

## Testing

Run the test suite:

```bash
composer test
```

Run tests with coverage:

```bash
composer test:coverage
```

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Credits

- Built with [spatie/laravel-data](https://github.com/spatie/laravel-data)
- Powered by [Vonage WhatsApp Manager API](https://developer.vonage.com/en/messages/whatsapp)

## Support

For issues, questions, or suggestions, please open an issue on GitHub.