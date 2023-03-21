<?php
use Wepesi\MetaData;

require __DIR__."/../vendor/autoload.php";

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
// output
/**
 * <!-- Extra information -->
 * <meta name='mobile-web-app-capable' content='yes' />
 * <meta name='apple-mobile-web-app-title' content='yes' />
 * <link name='keywords' href='metadata'>
 * <meta name='author' content='Ibrahim Mussa'>
 * <meta name='robots' content='follow,index'>
 *
 * <!-- Open Grap data-->
 * <meta property='og:site_name' content='Doctawetu' />
 * <meta property='og:title' content='Welcom Home' />
 * <meta property='og:description' content='Test MetaData' />
 * <meta property='og:url' content='https://ibmussa.me' />
 * <meta property='og:type' content='Website' />
 * <meta property='og:image:secure_url' content='https://domaine.com/cover.jpg' />
 * <meta property='og:image:type' content='image/jpeg'>
 * <!-- Size of image. Any size up to 300. Anything above 300px will not work in WhatsApp -->
 * <meta property='og:image:width' content='300'>
 * <meta property='og:image:height' content='300'>
 * <meta property='og:local' content='fr' />
 *
 * <!-- Twitter Metta Data -->
 * <meta name='twitter:card' content='summary' />
 * <meta name='twitter:title' content='Welcom Home' />
 * <meta name='twitter:description' content='Test MetaData' />
 * <meta name='twitter:url' content='https://ibmussa.me' />
 * <meta name='twitter:image' content='https://domaine.com/cover.jpg' />
 * <meta name='twitter:local' content='fr' />
 *
 * <meta name='twitter:type' content='article' />"
 */