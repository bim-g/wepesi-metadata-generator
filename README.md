# Wepesi Metadata generator

# Integration

The integration is simple and does not require to much knowled. The fist step required to is to call  `generate` a
static method that give u the possiblity to access all the methode defined.

```php
    $meta = \Wepesi\MetaData::generate();
```

To get a structure of data to be display call the `structure` method, it will return a array object of field generated
et to have build to be display call the `build` method.

* Structure & Build In case there is no element defined if will return en empty array in case of structure methode and
  an metadata without informations. No `title`,`description`
* Build

```php 
    $structure= MetaData::generate()->structure()
    //array(0) {
    //}

    $build= MetaData::generate()->build()
    /**
        <!-- Open Grap data-->
    <meta property="og:site_name" content="Doctawetu" />
    <meta property="og:title" content="" />
    <meta property="og:description" content="" />
    <meta property="og:url" content="" />
    <meta property="og:type" content="" />
    <meta property="og:image:secure_url" content="" />
    <meta property="og:local" content="En" />
    <meta property="og:image:type" content="image/jpeg">
    <!-- Size of image. Any size up to 300. Anything above 300px will not work in WhatsApp -->
    <meta property="og:image:width" content="300">
    <meta property="og:image:height" content="300">
    <!-- Twitter Metta Data -->
        <!-- Twitter Card-->
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" content="" />
    <meta name="twitter:description" content="" />
    <meta name="twitter:url" content="" />
    <meta name="twitter:type" content="article" />
    <meta name="twitter:image" content="" />
    <meta name="twitter:local" content="En" />
    <meta name="twitter:site" content="">
    <meta name="twitter:creator" content="">
    <!-- Extra information -->
    <meta name="mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-title" content="yes" />
    <meta name="robots" content="">
    <link rel="canonical" href="" />"
    */
```

## Implementation

To build a usefull metadata, method are well design to help no strugle with it.

#### `title` method

The title tag is the first HTML element that specifies what your web page is about. Title tags are important for SEO and
visitors because they appear in the search engine results page (SERP) and in browser tabs.

```php
    $structure= \Wepesi\MetaData::generate()->title("Welcom To Wepesi")->structure();
    //array(1) {
    //  ["title"]=>"Welcom To Wepesi"
    //}
```

#### `lang` method

A meta lang is an HTML element that help to set the language of the webpage.

```php
    $structure= \Wepesi\MetaData::generate()
                ->title("Welcom To Wepesi")
                ->lang("fr")
                ->structure();
    //array(1) {
    //  ["title"]=>"Welcom To Wepesi"
    //  ["lang"]=>"fr"
    // }
```

#### `cover` method

A meta cover is an HTML element that help to set the image to be play on the card that will be display. supported image
are `jpg` and `png`.

```php
    $structure= \Wepesi\MetaData::generate()
                ->title("Welcom To Wepesi")
                ->lang("en")
                ->cover("https://www.domaine.com/cover.jpg")
                ->structure();
    //array(1) {
    //  ["title"]=>"Welcom To Wepesi"
    //  ["lang"]=>"en"
    //  ["cover"]=>"https://www.domaine.com/cover.jpg"
    // }
```

#### `author` method

A meta author is an HTML element that help to provide more detail about the author.

```php
    $structure= \Wepesi\MetaData::generate()
                ->title("Welcom To Wepesi")
                ->author("Wepesi.")
                ->structure();
    //array(1) {
    //  ["title"]=>"Welcom To Wepesi"
    //  ["author"]=>"Wepesi"
    // }
```

#### `descriptions` method

A meta description is an HTML element that sums up the content on your web page. Search engines typically show the meta
description in search results below your title tag.

```php
    $structure= \Wepesi\MetaData::generate()
                ->title("Welcom To Wepesi")
                ->descriptions("Search engines typically show the meta description in search results below your title tag.")
                ->lang("fr")
                ->cover("htpps://www.domaine.com/cover.jpg")
                ->structure();
    //array(1) {
    //  ["title"]=>"Welcom To Wepesi",
    //  ["descriptions"]=>"Search engines typically show the meta description in search results below your title tag.",
    //  ["lang"]=>"fr",
    //  ["cover"]=>"htpps://www.domaine.com/cover.jpg",
    // }
```

#### `type` method

The type help to define whether its about an `article` or `website` or a `blog`, there few type of meta data
{article,blog,...}

```php
    $structure= \Wepesi\MetaData::generate()
                ->title("Welcom To Wepesi")
                ->descriptions("Search engines typically show the meta description in search results below your title tag.")
                ->lang("sw")
                ->type("article")
                ->structure();
    //array(1) {
    //  ["title"]=>"Welcom To Wepesi",
    //  ["descriptions"]=>"Search engines typically show the meta description in search results below your title tag.",
    //  ["lang"]=>"sw",
    //  ["type"]=>"article",
    // }
```

#### `link` method

The link metho help to define whether the website link or the link of your article for redirection. in case of an
article you should provide the link of the blog post, to help reach directly to the post.

```php
    $structure= \Wepesi\MetaData::generate()
                ->title("Welcom To our Article")
                ->descriptions("Description of the article")
                ->lang("sw")
                ->type("article")
                ->link("http://www.domaine.com/article/welcom-to-wepesi")
                ->cover("http://www.domaine.com/article-cover/cover.jpg")
                ->structure();
    //array(1) {
    //  ["title"]=>"Welcom To our Article",
    //  ["descriptions"]=>"Description of the article",
    //  ["lang"]=>"sw",
    //  ["type"]=>"article",
    //  ["link"]=>"http://www.domaine.com/article/welcom-to-wepesi",
    //  ["cover"]=>"http://www.domaine.com/article-cover/cover.jpg",
    // }
```

### Robots Meta Tag

List a tags to be apply eg: follow,index,nofollow,noindex
`FOLLOW`: The search engine crawler will follow all the links in that webpage,
`INDEX`: The search engine crawler will index the whole webpage.
`NOFOLLOW`: The search engine crawler will NOT follow the page and any links in that webpage.
`NOINDEX`:The search engine crawler will NOT index that webpages.

Use the following syntax for your robots meta tag:
Oly 2 Robots tags can be used

```php
    $structure= \Wepesi\MetaData::generate()
                ->title("Welcom To our Article")
                ->descriptions("About Description of the article")
                ->lang("sw")
                ->type("article")
                ->link("http://www.domaine.com/about")
                ->cover("http://www.domaine.com/article-cover/cover.jpg")
                ->index()
                ->follow()
                ->structure();
    //array(1) {
    //  ["title"]=>"Welcom To our Article",
    //  ["descriptions"]=>"About Description of the article",
    //  ["lang"]=>"sw",
    //  ["type"]=>"article",
    //  ["link"]=>"http://www.domaine.com/article/welcom-to-wepesi",
    //  ["cover"]=>"http://www.domaine.com/article-cover/cover.jpg",
    //  ["tags"]=>["index","follow"],
    // }
```

in case you dont need to index and follow the pages use:

```php
    $structure= \Wepesi\MetaData::generate()
                ->title("Welcom To our Article")
                ->descriptions("About Description of the article")                
                ->noindex()
                ->nofollow()
                ->structure();
    //array(1) {
    //  ["title"]=>"Welcom To our Article",
    //  ["descriptions"]=>"About Description of the article",
    //  ["tags"]=>["noindex","nofollow"],
    // }
```

checkout the would be the output for both example

```html

<meta name="robots" content="index, follow"> Means index and follow this webpage.
<meta name="robots" content="noindex, nofollow"> Means not to index or not to follow this webpage.
```

#### `keyword` method

It’s used to add keyword witch will be help for the search engine to easyly map your website.
It take parameter as string if you have one keyword, by in other way u can pass an array with multiple keyword
```php
    $structure= \Wepesi\MetaData::generate()
                ->title("Welcom To our Article")
                ->descriptions("About Description of the article")                
                ->keyword(["HTML","CSS","JavaScript"])
                ->structure();
    //array(1) {
    //  ["title"]=>"Welcom To our Article",
    //  ["descriptions"]=>"About Description of the article",
    //  ["keyword"]=>["HTML","CSS","JavaScript"]
    // }
```
#### `canonical` method

It’s used to indicate that there are other versions of this webpage. By implementing the canonical tag in the code, your
website tells search engines that this URL is the main page and that the engines shouldn’t index other pages.

```php
    $structure= \Wepesi\MetaData::generate()
                ->title("Welcom To our Article")
                ->descriptions("About Description of the article")                
                ->canonical("https://www.domaine.com")
                ->structure();
    //array(1) {
    //  ["title"]=>"Welcom To our Article",
    //  ["descriptions"]=>"About Description of the article",
    //  ["canonical"]=>"https://www.domaine.com",
    // }
```

# BUILD

The build method will help to generate the metadata tag to be display in your head html tags,

```php
$meta= \Wepesi\MetaData::generate()
                ->title("Welcom To our Article")
                ->descriptions("About Description of the article")
                ->lang("sw")
                ->type("article")
                ->link("http://www.domaine.com/about")
                ->cover("http://www.domaine.com/article-cover/cover.jpg")
                ->index()
                ->follow()
                ->build();
```

```html
    <!-- Open Grap data-->
<meta property="og:site_name" content="Doctawetu"/>
<meta property="og:title" content="Welcom To our Article"/>
<meta property="og:description" content="About Description of the article"/>
<meta property="og:url" content="http://www.domaine.com/about"/>
<meta property="og:type" content="article"/>
<meta property="og:image:secure_url" content="http://www.domaine.com/article-cover/cover.jpg"/>
<meta property="og:local" content="sw"/>
<meta property="og:image:type" content="image/jpeg">
<!-- Size of image. Any size up to 300. Anything above 300px will not work in WhatsApp -->
<meta property="og:image:width" content="300">
<meta property="og:image:height" content="300">
<!-- Twitter Metta Data -->
<meta name="twitter:card" content="summary"/>
<meta name="twitter:title" content="Welcom To our Article"/>
<meta name="twitter:description" content="About Description of the article"/>
<meta name="twitter:url" content="http://www.domaine.com/about"/>
<meta name="twitter:type" content="article"/>
<meta name="twitter:image" content="http://www.domaine.com/article-cover/cover.jpg"/>
<meta name="twitter:local" content="sw"/>
<meta name="twitter:site" content="">
<meta name="twitter:creator" content="">
<!-- Extra information -->
<meta name="mobile-web-app-capable" content="yes"/>
<meta name="apple-mobile-web-app-title" content="yes"/>
<meta name="robots" content="index,follow">
<link rel="canonical" href=""/>"

```