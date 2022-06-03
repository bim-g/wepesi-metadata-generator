<?php
require "vendor/autoload.php";
use Wepesi\MetaData;

$meta= MetaData::generate()->title('Welcom to wepesi')->structure();
var_dump($meta);