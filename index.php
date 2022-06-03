<?php
require "vendor/autoload.php";
use Wepesi\MetaData;

$meta= MetaData::generate()->title('Welcom To our Article')
    ->descriptions('About Description of the article')
    ->lang('sw')
    ->type('article')
    ->link('http://www.domaine.com/about')
    ->cover('http://www.domaine.com/article-cover/cover.jpg')
    ->index()
    ->follow()
    ->structure();
var_dump($meta);