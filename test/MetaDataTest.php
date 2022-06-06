<?php


namespace Test;

use PHPUnit\Framework\TestCase;
use Wepesi\MetaData;

class MetaDataTest extends TestCase
{
    function testMetaDataObject()
    {
        $this->assertIsObject(MetaData::generate());
    }

    function testMetaDataStructureIsArray()
    {
        $meta = MetaData::generate()->structure();
        $this->assertIsArray($meta);
    }

    function testMetaDataStructureTitleArray()
    {
        $meta = MetaData::generate()->title("Welcom Home")->structure();
        $expected = [
            "title" => 'Welcom Home'
        ];
        $this->assertArrayHasKey("title", $meta);
        $this->assertEquals($expected, $meta);
    }
}