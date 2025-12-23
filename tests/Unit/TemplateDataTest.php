<?php

namespace Cweetagram\CweetagramVonageWhatsapp\Tests\Unit;

use Cweetagram\CweetagramVonageWhatsapp\Data\BodyComponentData;
use Cweetagram\CweetagramVonageWhatsapp\Data\FooterComponentData;
use Cweetagram\CweetagramVonageWhatsapp\Data\HeaderComponentData;
use Cweetagram\CweetagramVonageWhatsapp\Data\TemplateData;
use Cweetagram\CweetagramVonageWhatsapp\Enums\HeaderFormats;
use Cweetagram\CweetagramVonageWhatsapp\Enums\TemplateCategories;
use Cweetagram\CweetagramVonageWhatsapp\Tests\TestCase;

class TemplateDataTest extends TestCase
{
    public function testMarketingTextHeaderTemplate()
    {
        $components[] = HeaderComponentData::text("Congratulations")->toArray();
        $components[] = BodyComponentData::text("Lorem ipsum messages come here there")->toArray();
        $components[] = FooterComponentData::text("This is an automated message. Please do not reply")->toArray();

        $template = new TemplateData(
            name: "test_demo",
            language: "en",
            category: TemplateCategories::MARKETING->value,
            allow_category_change: true,
            components: $components
        );

        $this->assertEquals('HEADER', $template->toArray()['components'][0]['type']);
        $this->assertEquals(HeaderFormats::TEXT->value, $template->toArray()['components'][0]['format']);
        $this->assertEquals('BODY', $template->toArray()['components'][1]['type']);
        $this->assertEquals('Lorem ipsum messages come here there', $template->toArray()['components'][1]['text']);
        $this->assertEquals('FOOTER', $template->toArray()['components'][2]['type']);
    }
}
