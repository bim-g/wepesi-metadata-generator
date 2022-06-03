<?php


namespace Wepesi;
/**
 * * Meta tags for SEO are key because they tell search engines what a page is about.
 * Think of them as the first impression for all search engines.
 *
 * Class MetaData
 * @package Wepesi
 */
class MetaData
{
    function __construct(){

    }
    static function generate(): MetaProperties
    {
        return new MetaProperties();
    }
}