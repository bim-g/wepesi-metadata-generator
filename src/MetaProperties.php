<?php


namespace Wepesi;


class MetaProperties
{
    private ?string $_title = null;
    private ?string $_canonical = null;
    private ?string $_lang = null;
    private ?string $_cover = null;
    private ?string $_link = null;
    private ?string $_author = null;
    private ?string $_type = null;
    private ?string $_description = null;
    private array $_tags = [];
    private bool $_follow, $_index, $_noindex, $_nofollow;

    /**
     * BundleMetaData constructor.
     */
    function __construct()
    {
        $this->_follow = $this->_index = $this->_noindex = $this->_nofollow = false;
        $this->_lang = 'En';
    }

    /**
     *The title tag is the first HTML element that specifies what your web page is about.
     * Title tags are important for SEO
     * and visitors because they appear in the search engine results page (SERP) and in browser tabs.
     * @param string $title
     * @return $this
     */
    function title(string $title): MetaProperties
    {
        $this->_title = $title;
        return $this;
    }

    /**
     * Defined the website language
     * @param string $lang
     * @return $this
     */
    function lang(string $lang): MetaProperties
    {
        $this->_lang = $lang;
        return $this;
    }

    /**
     * Cover for image display
     * @param string $cover
     * @return $this
     */
    function cover(string $cover): MetaProperties
    {
        $this->_cover = $cover;
        return $this;
    }

    /**
     * Author most of time used for twitter
     * @param string $author
     * @return $this
     */
    function author(string $author): MetaProperties
    {
        $this->_author = $author;
        return $this;
    }

    /**
     *A meta description is an HTML element that sums up the content on your web page.
     * Search engines typically show the meta description in search results below your title tag.
     *
     * @param string $description
     * @return $this
     */
    function descriptions(string $description): MetaProperties
    {
        $this->_description = $description;
        return $this;
    }

    /**
     * the type of meta data {article,blog,}
     * @param string $type
     * @return $this
     */
    function type(string $type): MetaProperties
    {
        $this->_type = $type;
        return $this;
    }

    /**
     * website link page for redirection
     * @param string $link
     * @return $this
     */
    function link(string $link): MetaProperties
    {
        $this->_link = $link;
        return $this;
    }

    /**
     * Robots Meta Tag
     * list a tags to be apply eg: follow,index,nofollow,noindex
     */

    /**
     * 'FOLLOW': The search engine crawler will follow all the links in that webpage,
     * @return $this
     */
    function follow(): MetaProperties
    {
        $this->_tags[] = 'follow';
        $this->_tags = $this->_follow ? array_diff($this->_tags, ['nofollow']) : $this->_tags;
        $this->_follow = true;
        $this->_nofollow = false;
        return $this;
    }

    /**
     * 'INDEX': The search engine crawler will index the whole webpage.
     * @return $this
     */
    function index(): MetaProperties
    {
        $this->_tags[] = 'index';
        $this->_tags = $this->_index ? array_diff($this->_tags, ['noindex']) : $this->_tags;
        $this->_index = true;
        $this->_noindex = false;
        return $this;
    }

    /**
     * 'NOFOLLOW': The search engine crawler will NOT follow the page and any links in that webpage.
     * @return $this
     */
    function nofollow(): MetaProperties
    {
        $this->_tags[] = 'nofollow';
        $this->_tags = $this->_follow ? array_diff($this->_tags, ['follow']) : $this->_tags;
        $this->_nofollow = true;
        $this->_follow = false;
        return $this;
    }

    /**
     * 'NOINDEX':The search engine crawler will NOT index that webpages.
     * @return $this
     */
    function noIndex(): MetaProperties
    {
        $this->_tags[] = 'noindex';
        $this->_tags = $this->_index ? array_diff($this->_tags, ['index']) : $this->_tags;
        $this->_noindex = true;
        $this->_index = false;
        return $this;
    }

    /**
     * It’s used to indicate that there are other versions of this webpage.
     * By implementing the canonical tag in the code,
     * your website tells search engines that this URL is the main page
     * and that the engines shouldn’t index other pages.
     * @param string $canonical : https://doctawetu.com
     * @return $this
     */
    function canonical(string $canonical): MetaProperties
    {
        $this->_canonical = $canonical;
        return $this;
    }

    /**
     * Open graph meta tags promote integration between
     * Facebook, LinkedIn, Google, and your website.
     *
     * @return string
     */
    protected function openGraphMeta(): string
    {
        $cover = <<<IMG
            <meta property="og:image:secure_url" content="$this->_cover" />
            <meta property="og:image:type" content="image/jpeg">
            <!-- Size of image. Any size up to 300. Anything above 300px will not work in WhatsApp -->
            <meta property="og:image:width" content="300">
            <meta property="og:image:height" content="300">
        IMG;
        $link_exist=$this->_link?"<meta property=\"og:url\" content=\"$this->_link\" />":'';
        $type_exist=$this->_link?"<meta property=\"og:type\" content=\"$this->_type\" />":'';
        $cover_exist=$this->_cover?$cover:'';
        $lang_exist=$this->_lang?"<meta property=\"og:local\" content=\"$this->_lang\" />":'';
        return <<<HTML
            <!-- Open Grap data-->
            <meta property="og:site_name" content="Doctawetu" />
            <meta property="og:title" content="$this->_title" />
            <meta property="og:description" content="$this->_description" />
            $link_exist
            $type_exist
            $cover_exist
            $lang_exist
        HTML;
    }

    /**
     * Twitter cards work in a similar way to Open Graph.
     * It will use these tags to enhance the display of your page when shared on their platform.
     *
     * @return string
     */
    protected function twitterMeta(): string
    {
        $link_exist=$this->_link?"<meta name=\"twitter:url\" content=\"$this->_link\" />":'';
        $cover_exist=$this->_cover?"<meta name=\"twitter:image\" content=\"$this->_cover\" />":'';
        $lang_exist=$this->_lang?"<meta name=\"twitter:local\" content=\"$this->_lang\" />":'';
        $canonical_exist=$this->_canonical?"<meta name=\"twitter:site\" content=\"$this->_canonical\">":'';
        $author_exist=$this->_author?"<meta name=\"twitter:creator\" content=\"$this->_author\">":'';
        return <<<HTML
                <meta name="twitter:card" content="summary" />
                <meta name="twitter:title" content="$this->_title" />
                <meta name="twitter:description" content="$this->_description" />
                $link_exist
                $cover_exist
                $lang_exist
                $canonical_exist
                $author_exist
                <meta name="twitter:type" content="article" />
            HTML;
    }

    /**
     * Get the complete meta data to be displayed
     * @return string
     */
    function build(): string
    {
        if($this->_title && $this->_description){
            $tags = implode(',', $this->_tags);
            $open_graph_meta = $this->openGraphMeta();
            $twitter_meta = $this->twitterMeta();
            $tags_exist=count($this->_tags)>1?"<meta name=\"robots\" content=\"$tags\">":"";
            $canonical_exist=count($this->_tags)>1?"<link rel=\"canonical\" href=\"$this->_canonical\">":"";
            return <<<META
                $open_graph_meta
                <!-- Twitter Metta Data -->
                $twitter_meta
                <!-- Extra information -->
                <meta name="mobile-web-app-capable" content="yes" />
                <meta name="apple-mobile-web-app-title" content="yes" />
                $tags_exist
                $canonical_exist
            META;
        }
    }

    function structure(): array
    {
        $structure = [];
        $this->_title ? ($structure['title'] = $this->_title):[];
        $this->_description ? ($structure['description'] = $this->_description):[];
        $this->_link ? ($structure['link'] = $this->_link):[];
        $this->_cover ? ($structure['cover'] = $this->_cover):[];
        $this->_tags ? ($structure['tags'] = $this->_tags):[];
        $this->_type ? ($structure['type'] = $this->_type):[];
        $this->_canonical ? ($structure['canonical'] = $this->_canonical):[];
        return $structure;
    }
}