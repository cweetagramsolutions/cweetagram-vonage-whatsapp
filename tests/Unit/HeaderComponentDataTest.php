<?php

namespace Cweetagram\CweetagramVonageWhatsapp\Tests\Unit;

use Cweetagram\CweetagramVonageWhatsapp\Data\HeaderComponentData;
use Cweetagram\CweetagramVonageWhatsapp\Enums\HeaderFormats;
use Cweetagram\CweetagramVonageWhatsapp\Tests\TestCase;

class HeaderComponentDataTest extends TestCase
{
    public function testTextHeaderComponentData(): void
    {
        $data = HeaderComponentData::text("Hello World!")->toArray();
        $this->assertEquals("Hello World!", $data["text"]);
        $this->assertEquals($data['format'], HeaderFormats::TEXT->value);
    }
}