<?php

namespace Cweetagram\CweetagramVonageWhatsapp\Tests\Unit;

use Cweetagram\CweetagramVonageWhatsapp\Data\Body\BodyComponentButtonData;
use Cweetagram\CweetagramVonageWhatsapp\Data\BodyComponentData;
use Cweetagram\CweetagramVonageWhatsapp\Enums\BodyButtonTypes;
use Cweetagram\CweetagramVonageWhatsapp\Tests\TestCase;

class BodyComponentDataTest extends TestCase
{
    public function testTextBodyComponentDataWithNoButton()
    {
        $data = BodyComponentData::text(
            text: 'Hello world. Welcome to our template'
        )->toArray();

        $this->assertEquals($data['type'], 'BODY');
        $this->assertEquals($data['format'], 'TEXT');
    }

    public function testTextBodyComponentDataWithExample()
    {
        $data = BodyComponentData::text(
            text: 'Hello {{1}}. Welcome to our template',
            example_body_text: "[['Chancel']]"
        )->toArray();

        $this->assertEquals($data['type'], 'BODY');
        $this->assertEquals($data['format'], 'TEXT');
        $this->assertArrayHasKey('example', $data);
        $this->assertArrayHasKey('body_text', $data['example']);
    }

    public function testTextBodyComponentDataWithButtons()
    {
        $messageButtons = [];
        $messageButtons[] = BodyComponentButtonData::url(
            text: "View our website",
            url: 'https://cweetagram.com'
        )->toArray();

        $messageButtons[] = BodyComponentButtonData::quickReply(
            text: "Opt out"
        )->toArray();

        $messageButtons[] = BodyComponentButtonData::phoneNumber(
            text: "Call us now",
            phone_number: '27765876652'
        )->toArray();

        $data = BodyComponentData::text(
            text: 'Hello {{1}}. Welcome to our template',
            example_body_text: "[['Chancel']]",
            buttons: $messageButtons
        )->toArray();

        $this->assertEquals($data['type'], 'BODY');
        $this->assertEquals($data['format'], 'TEXT');
        $this->assertArrayHasKey('example', $data);
        $this->assertArrayHasKey('body_text', $data['example']);
        $this->assertEquals($data['buttons'][0]['type'], BodyButtonTypes::URL->value);
    }
}
