<?php


namespace Test;

use PHPUnit\Framework\TestCase;
use Wepesi\MetaData;

/**
 *
 */
class MetaDataTest extends TestCase
{
    function testMetaDataObject()
    {
        $this->assertIsObject(MetaData::build());
        $this->assertIsObject(new MetaData());
    }

    function testMetaDataStructureIsArray()
    {
        $meta = MetaData::build()->toArray();
        $this->assertIsArray($meta);
    }

    function testMetaDataStructureHasArrayKeys()
    {
        $meta = MetaData::build()
            ->title('Welcom Home')
            ->description('Test MetaData')
            ->lang('fr')
            ->cover('https://domaine.com/cover.jpg')
            ->author('Ibrahim Mussa')
            ->type('Website')
            ->link('https://ibmussa.me')
            ->follow()
            ->keywords('metadata')
            ->index()
            ->toArray();
        $expected = [
            'title' => 'Welcom Home',
            'description' => 'Test MetaData',
            'lang' => 'fr',
            'cover' => 'https://domaine.com/cover.jpg',
            'author' => 'Ibrahim Mussa',
            'type' => 'Website',
            'link' => 'https://ibmussa.me',
            'keywords' => ['metadata'],
            'tags' => ["follow","index"],
            'canonical' => null

        ];
        // check if all key are well-defined
        $this->assertArrayHasKey("title", $meta);
        $this->assertArrayHasKey("description", $meta);
        $this->assertArrayHasKey("lang", $meta);
        $this->assertArrayHasKey("cover", $meta);
        $this->assertArrayHasKey("author", $meta);
        $this->assertArrayHasKey("type", $meta);
        $this->assertArrayHasKey("link", $meta);
        $this->assertArrayHasKey("tags", $meta);
        $this->assertArrayHasKey("keywords", $meta);
        // check expectation
        $this->assertEquals($expected, $meta);
    }
    function testMetaDataStructureNotHaveArrayKeys()
    {
        $meta = MetaData::build()
            ->title('Welcom Home')
            ->description('Test MetaData')
            ->lang('fr')
            ->cover('https://domaine.com/cover.jpg')
            ->author('Ibrahim Mussa')
            ->type('Website')
            ->link('https://ibmussa.me')
            ->follow()
            ->keywords('metadata')
            ->index()
            ->toArray();
        $expected = [
            'title' => 'Welcom Home',
            'description' => 'Test MetaData',
            'lang' => 'fr',
            'cover' => 'https://domaine.com/cover.jpg',
            'author' => 'Ibrahim Mussa',
            'type' => 'Website',
            'follow' => true,
            'index' => true,
            'link' => 'https://ibmussa.me',
            'keyword' => 'metadata'
        ];
        /*
         * check keys with are not defined
         */
        $this->assertArrayNotHasKey('index', $meta);
        $this->assertArrayNotHasKey('follow', $meta);

        /**
         * check expectation
         */
        $this->assertNotEquals($expected, $meta);
    }

    function testMetaDataStructureAsJSON(){
        $meta = MetaData::build()
            ->title('Welcom Home')
            ->description('Test MetaData')
            ->lang('fr')
            ->cover('https://domaine.com/cover.jpg')
            ->author('Ibrahim Mussa')
            ->type('Website')
            ->link('https://ibmussa.me')
            ->follow()
            ->keywords('metadata')
            ->index()
            ->toJson();
        $expected = json_encode([
            'title' => 'Welcom Home',
            'description' => 'Test MetaData',
            'lang' => 'fr',
            'cover' => 'https://domaine.com/cover.jpg',
            'author' => 'Ibrahim Mussa',
            'type' => 'Website',
            'link' => 'https://ibmussa.me',
            'keywords' => ['metadata'],
            'tags' => ['follow', 'index'],
            'canonical' => null

        ],true);
        // check if is a json
        $this->assertJson($meta);
        // this json should be the same
        $this->assertJsonStringEqualsJsonString($expected, $meta);
    }
    function testMetaHTMLMedataDataHTMLStructure()
    {
        $meta = MetaData::build()
            ->title('Welcom Home')
            ->description('Test MetaData')
            ->lang('fr')
            ->cover('https://domaine.com/cover.jpg')
            ->author('Ibrahim Mussa')
            ->type('Website')
            ->link('https://ibmussa.me')
            ->follow()
            ->keywords('metadata')
            ->index()
            ->toHtml();
        $metaExpectation = <<<METADATA
        <!-- Extra information -->
            <meta name="mobile-web-app-capable" content="yes" />
            <meta name="apple-mobile-web-app-title" content="yes" />
            <link name="keywords" href="metadata">
            <meta name="author" content="Ibrahim Mussa">
            <meta name="robots" content="follow,index">
        
            <!-- Open Graph meta data-->
            <meta property="og:site_name" content="Doctawetu" />
            <meta property="og:title" content="Welcom Home" />
            <meta property="og:description" content="Test MetaData" />
            <meta property="og:url" content="https://ibmussa.me" />
            <meta property="og:type" content="Website" />
            <meta property="og:image:secure_url" content="https://domaine.com/cover.jpg" />
            <meta property="og:image:type" content="image/jpeg">
            <!-- Size of image. Any size up to 300. Anything above 300px will not work in WhatsApp -->
            <meta property="og:image:width" content="300">
            <meta property="og:image:height" content="300">
            <meta property="og:local" content="fr" />
        
            <!-- Twitter meta Data -->
            <meta name="twitter:card" content="summary" />
            <meta name="twitter:title" content="Welcom Home" />
            <meta name="twitter:description" content="Test MetaData" />
            <meta name="twitter:url" content="https://ibmussa.me" />
            <meta name="twitter:image" content="https://domaine.com/cover.jpg" />
            <meta name="twitter:local" content="fr" />        
            <meta name="twitter:type" content="article" />"
        METADATA;

        /**
         * check expectation
         */
        $this->assertNotEquals($metaExpectation, $meta);
    }
    function testNotHTMLMedataDataStructure()
    {
        $meta = MetaData::build()
            ->title('Welcom Home')
            ->description('Test MetaData')
            ->lang('fr')
            ->cover('https://domaine.com/cover.jpg')
            ->author('Ibrahim Mussa')
            ->type('Website')
            ->link('https://ibmussa.me')
            ->follow()
            ->keywords('metadata')
            ->index()
            ->toJson();
        $metaExpectation = <<<METADATA
        <!-- Extra information -->
            <meta name="mobile-web-app-capable" content="yes" />
            <meta name="apple-mobile-web-app-title" content="yes" />
            <link name="keywords" href="metadata">
            <meta name="author" content="Ibrahim Mussa">
            <meta name="index" content="index">
            <meta name="follow" content="follow">
        
            <!-- Open Grap data-->
            <meta property="og:site_name" content="Doctawetu" />
            <meta property="og:title" content="Welcom Home" />
            <meta property="og:description" content="Test MetaData" />
            <meta property="og:url" content="https://ibmussa.me" />
            <meta property="og:type" content="Website" />
            <meta property="og:image:secure_url" content="https://domaine.com/cover.jpg" />            
        
            <!-- Twitter Metta Data -->
            <meta name="twitter:card" content="summary" />
            <meta name="twitter:title" content="Welcom Home" />
            <meta name="twitter:description" content="Test MetaData" />
            <meta name="twitter:url" content="https://ibmussa.me" />
            <meta name="twitter:image" content="https://domaine.com/cover.jpg" />
            <meta name="twitter:local" content="fr" />        
            <meta name="twitter:type" content="website" />"
        METADATA;

        /**
         * check expectation
         */
        $this->assertNotEquals($metaExpectation, $meta);
    }
}