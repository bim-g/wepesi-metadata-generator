# Wepesi Metadata generator

Meta tags for SEO are key because they tell search engines what a page is about.
Think of them as the first impression for all search engines.

`Metadata generator` help you generate metadata for your web page with caring about the platform to be suppoterd. The
oly thing is to provide information required.

# Installation

```bash
composer require wepesi/metadata
```

# Usage

The fist step required to is to call  `structure` a
static method that give u the possibility to access the method defined.

```php
    use Wepesi\MetaData;
    $meta = MetaData::build();
```

To get a structure of data to be display method are used

* `build()` :  will return an instance of the class.
* `toArray()` :  will return an array object of field defined.
* `toHtml()` and `generate` : will return a html meta tags that can be add to your web page,

In case there is no element defined if will return en empty array and the build will be without information.

```php
  use Wepesi\MetaData;
  MetaData::build()->toArray();
  /**
      array(0) {
      }
    **/

```

All known metadata method has been define
for: `title`,`lang`,`cover`,`author`,`descriptions`,`type`,`link`,`follow`,`keyword`,`index`,`nofollow`,`noIndex`,`canonical`.

## Generate the meta tag

The `generate()` or `toHtml()` method will help to generate the metadata tag to be display in your head html tags,

```php
    use Wepesi\MetaData;
    $meta= MetaData::build()
            ->title("Welcome To our Article")
            ->description("About Description of the article")
            ->lang("sw")
            ->type("article")
            ->link("https://www.domaine.com/about")
            ->cover("https://www.domaine.com/article-cover/cover.jpg")
            ->index()
            ->follow()
            ->toHtml();
```

```html
    <!-- Open Graph data-->
<meta property="og:site_name" content="Wepesi"/>
<meta property="og:title" content="Welcome To our Article"/>
<meta property="og:description" content="About Description of the article"/>
<meta property="og:url" content="https://www.domaine.com/about"/>
<meta property="og:type" content="article"/>
<meta property="og:image:secure_url" content="https://www.domaine.com/article-cover/cover.jpg"/>
<meta property="og:local" content="sw"/>
<meta property="og:image:type" content="image/jpeg">
<!-- Size of image. Any size up to 300. Anything above 300px will not work in WhatsApp -->
<meta property="og:image:width" content="300">
<meta property="og:image:height" content="300">
<!-- Twitter MetaData -->
<meta name="twitter:card" content="summary"/>
<meta name="twitter:title" content="Welcome To our Article"/>
<meta name="twitter:description" content="About Description of the article"/>
<meta name="twitter:url" content="https://www.domaine.com/about"/>
<meta name="twitter:type" content="article"/>
<meta name="twitter:image" content="https://www.domaine.com/article-cover/cover.jpg"/>
<meta name="twitter:local" content="sw"/>
<meta name="twitter:site" content="">
<meta name="twitter:creator" content="">
<!-- Extra information -->
<meta name="mobile-web-app-capable" content="yes"/>
<meta name="apple-mobile-web-app-title" content="yes"/>
<meta name="robots" content="index,follow">
<link rel="canonical" href=""/>"

```

## More about metadata methods

### Description

To build a useful metadata, method are well design to help no struggle with it.

#### `title` method

The title tag is the first HTML element that specifies what your web page is about. Title tags are important for SEO and
visitors because they appear in the search engine results page (SERP) and in browser tabs.

```php
    use Wepesi\MetaData;
    $structure= MetaData::build()->title("Welcome To Wepesi")->toArray();
    /**
    array(1) {
        ["title"]=>"Welcome To Wepesi"
    }
    */
```

#### `lang` method

A meta lang is an HTML element that help to set the language of the webpage.

```php
    use Wepesi\MetaData;
    $structure= MetaData::build()
                ->title("Welcome To Wepesi")
                ->lang("fr")
                ->toArray();
    /**
    array(1) {
      ["title"]=>"Welcome To Wepesi"
      ["lang"]=>"fr"
    }
    */
```

#### `cover` method

A meta cover is an HTML element that help to set the image to be play on the card that will be display. supported image
are `jpg` and `png`.

```php
    use Wepesi\MetaData;
    $structure= MetaData::build()
                ->title("Welcome To Wepesi")
                ->lang("en")
                ->cover("https://www.domaine.com/cover.jpg")
                ->toArray();
    //array(1) {
    //  ["title"]=>"Welcome To Wepesi"
    //  ["lang"]=>"en"
    //  ["cover"]=>"https://www.domaine.com/cover.jpg"
    // }
```

#### `author` method

A meta author is an HTML element that help to provide more detail about the author.

```php
    use Wepesi\MetaData;
    $structure= MetaData::build()
                ->title("Welcome To Wepesi")
                ->author("Wepesi.")
                ->toArray();
    //array(1) {
    //  ["title"]=>"Welcome To Wepesi"
    //  ["author"]=>"Wepesi"
    // }
```

#### `description` method

A meta description is an HTML element that sums up the content on your web page. Search engines typically show the meta
description in search results below your title tag.

```php
    use Wepesi\MetaData;
    $structure= MetaData::build()
                ->title("Welcome To Wepesi")
                ->description("Search engines typically show the meta description in search results below your title tag.")
                ->lang("fr")
                ->cover("https://www.domaine.com/cover.jpg")
                ->toArray();
    //array(1) {
    //  ["title"]=>"Welcome To Wepesi",
    //  ["description"]=>"Search engines typically show the meta description in search results below your title tag.",
    //  ["lang"]=>"fr",
    //  ["cover"]=>"https://www.domaine.com/cover.jpg",
    // }
```

#### `type` method

The type help to define whether it's about an `article` or `website` or a `blog`, there few types of metadata
{article,blog,...}

```php
    use Wepesi\MetaData;
    $structure= MetaData::build()
                ->title("Welcome To Wepesi")
                ->description("Search engines typically show the meta description in search results below your title tag.")
                ->lang("sw")
                ->type("article")
                ->toArray();
    //array(1) {
    //  ["title"]=>"Welcome To Wepesi",
    //  ["description"]=>"Search engines typically show the meta description in search results below your title tag.",
    //  ["lang"]=>"sw",
    //  ["type"]=>"article",
    // }
```

#### `link` method

The link method help to define whether the website link or the link of your article for redirection. in case of an
article you should provide the link of the blog post, to help reach directly to the post.

```php
    use Wepesi\MetaData;
    $structure= MetaData::build()
                ->title("Welcome To our Article")
                ->description("Description of the article")
                ->lang("sw")
                ->type("article")
                ->link("https://www.domaine.com/article/welcom-to-wepesi")
                ->cover("https://www.domaine.com/article-cover/cover.jpg")
                ->toArray();
    //array(1) {
    //  ["title"]=>"Welcome To our Article",
    //  ["description"]=>"Description of the article",
    //  ["lang"]=>"sw",
    //  ["type"]=>"article",
    //  ["link"]=>"https://www.domaine.com/article/welcom-to-wepesi",
    //  ["cover"]=>"https://www.domaine.com/article-cover/cover.jpg",
    // }
```

### Robots Meta Tag

List a tags to be applied e.g.,: follow,index,nofollow,noindex
`FOLLOW`: The search engine crawler will follow all the links in that webpage,
`INDEX`: The search engine crawler will index the whole webpage.
`NOFOLLOW` The search engine crawler will NOT follow the page and any links in that webpage.
`NOINDEX`The search engine crawler will NOT index that webpages.

Use the following syntax for your robots meta tag:
Oly 2 Robots tags can be used

```php
    use Wepesi\MetaData;
    $structure= MetaData::build()
                ->title("Welcome To our Article")
                ->description("About Description of the article")
                ->lang("sw")
                ->type("article")
                ->link("https://www.domaine.com/about")
                ->cover("https://www.domaine.com/article-cover/cover.jpg")
                ->index()
                ->follow()
                ->toArray();
    //array(1) {
    //  ["title"]=>"Welcome To our Article",
    //  ["description"]=>"About Description of the article",
    //  ["lang"]=>"sw",
    //  ["type"]=>"article",
    //  ["link"]=>"https://www.domaine.com/article/welcom-to-wepesi",
    //  ["cover"]=>"https://www.domaine.com/article-cover/cover.jpg",
    //  ["tags"]=>["index","follow"],
    // }
```

in case you don't need to index and follow the pages use:

```php
    use Wepesi\MetaData;
    $structure= MetaData::build()
                ->title("Welcome To our Article")
                ->description("About Description of the article")                
                ->noindex()
                ->nofollow()
                ->toArray();
    //array(1) {
    //  ["title"]=>"Welcome To our Article",
    //  ["description"]=>"About Description of the article",
    //  ["tags"]=>["noindex","nofollow"],
    // }
```

checkout they would be the output for both example

```html

<meta name="robots" content="index, follow"> Means index and follow this webpage.
<meta name="robots" content="noindex, nofollow"> Means not to index or not to follow this webpage.
```

#### `keywords` method

It’s used to add keyword witch will be help for the search engine to easily map your website.
It takes parameter as string if you have one keyword, by in other way u can pass an array with multiple keyword

```php
    use Wepesi\MetaData;
    $structure= MetaData::build()
                ->title("Welcome To our Article")
                ->description("About Description of the article")                
                ->keywords(["HTML","CSS","JavaScript"])
                ->toArray();
    //array(1) {
    //  ["title"]=>"Welcome To our Article",

    //  ["description"]=>"About Description of the article",
    //  ["keywords"]=>["HTML","CSS","JavaScript"]
    // }
```

#### `canonical` method

It’s used to indicate that there are other versions of this webpage. By implementing the canonical tag in the code, your
website tells search engines that this URL is the main page and that the engines shouldn’t index other pages.

```php
    use Wepesi\MetaData;
    $structure = MetaData::build()
                ->title("Welcome To our Article")
                ->description("About Description of the article")                
                ->canonical("https://www.domaine.com")
                ->toArray();
    //array(1) {
    //  ["title"]=>"Welcome To our Article",
    //  ["description"]=>"About Description of the article",
    //  ["canonical"]=>"https://www.domaine.com",
    // }
```

