<?php

namespace Cweetagram\CweetagramVonageWhatsapp\Tests\Unit;

use Cweetagram\CweetagramVonageWhatsapp\Data\HeaderComponentData;
use Cweetagram\CweetagramVonageWhatsapp\Enums\HeaderFormats;
use Cweetagram\CweetagramVonageWhatsapp\Enums\TemplateComponentTypes;
use Cweetagram\CweetagramVonageWhatsapp\Tests\TestCase;

class HeaderComponentDataTest extends TestCase
{
    public function testTextHeaderComponentData(): void
    {
        $data = HeaderComponentData::text("Hello World!")->toArray();
        $this->assertEquals("Hello World!", $data["text"]);
        $this->assertEquals($data['format'], HeaderFormats::TEXT->value);
        $this->assertEquals($data['type'], TemplateComponentTypes::HEADER->value);
    }

    public function testImageHeaderComponentData(): void
    {
        $data = HeaderComponentData::image("https://cweetagram.com/logo.png")->toArray();
        $this->assertEquals("https://cweetagram.com/logo.png", $data["example"]['header_handle']);
        $this->assertEquals($data['format'], HeaderFormats::IMAGE->value);
    }

    public function testImageVideoComponentData(): void
    {
        $data = HeaderComponentData::video("https://cweetagram.com/logo.mp4")->toArray();
        $this->assertEquals("https://cweetagram.com/logo.mp4", $data["example"]['header_handle']);
        $this->assertEquals($data['format'], HeaderFormats::VIDEO->value);
    }

    public function testImageDocumentComponentData(): void
    {
        $data = HeaderComponentData::document("https://cweetagram.com/logo.pdf")->toArray();
        $this->assertEquals("https://cweetagram.com/logo.pdf", $data["example"]['header_handle']);
        $this->assertEquals($data['format'], HeaderFormats::DOCUMENT->value);
    }
}