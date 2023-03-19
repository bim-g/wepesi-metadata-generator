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
    private ?string $title = null;
    private ?string $canonical = null;
    private ?string $lang = null;
    private ?string $cover = null;
    private ?string $link = null;

    private ?string $author = null;
    private ?string $type = null;
    private ?string $description = null;
    private array $tags = [];
    private array $keywords = [];
    private bool $follow, $index, $noindex, $nofollow;

    /**
     * BundleMetaData constructor.
     */
    function __construct()
    {
        $this->follow = $this->index = $this->noindex = $this->nofollow = false;
    }

    /**
     *The title tag is the first HTML element that specifies what your web page is about.
     * Title tags are important for SEO
     * and visitors because they appear in the search engine results page (SERP) and in browser tabs.
     * @param string $title
     * @return $this
     */
    function title(string $title): MetaData
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Defined the website language
     * @param string $lang
     * @return $this
     */
    function lang(string $lang): MetaData
    {
        $this->lang = $lang;
        return $this;
    }

    /**
     * Cover for image display
     * @param string $cover
     * @return $this
     */
    function cover(string $cover): MetaData
    {
        $this->cover = $cover;
        return $this;
    }

    /**
     * Author most of time used for twitter
     * @param string $author
     * @return $this
     */
    function author(string $author): MetaData
    {
        $this->author = $author;
        return $this;
    }

    /**
     *A meta description is an HTML element that sums up the content on your web page.
     * Search engines typically show the meta description in search results below your title tag.
     *
     * @param string $description
     * @return $this
     */
    function description(string $description): MetaData
    {
        $this->description = $description;
        return $this;
    }

    /**
     * the type of meta data {article,blog,}
     * @param string $type
     * @return $this
     */
    function type(string $type): MetaData
    {
        $this->type = $type;
        return $this;
    }

    /**
     * website link page for redirection
     * @param string $link
     * @return $this
     */
    function link(string $link): MetaData
    {
        $this->link = $link;
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
    function follow(): MetaData
    {
        $this->tags[] = 'follow';
        $this->tags = $this->follow ? array_diff($this->tags, ['nofollow']) : $this->tags;
        $this->follow = true;
        $this->nofollow = false;
        return $this;
    }

    /**
     * Define keywords for search engines. eg: HTML,css,JavaScript
     * @param $keyword
     * @return MetaData
     */
    function keyword($keyword): MetaData
    {
        $this->keywords = is_array($keyword) ? $keyword : [$keyword];
        return $this;
    }

    /**
     * 'INDEX': The search engine crawler will index the whole webpage.
     * @return $this
     */
    function index(): MetaData
    {
        $this->tags[] = 'index';
        $this->tags = $this->index ? array_diff($this->tags, ['noindex']) : $this->tags;
        $this->index = true;
        $this->noindex = false;
        return $this;
    }

    /**
     * 'NOFOLLOW': The search engine crawler will NOT follow the page and any links in that webpage.
     * @return $this
     */
    function nofollow(): MetaData
    {
        $this->tags[] = 'nofollow';
        $this->tags = $this->follow ? array_diff($this->tags, ['follow']) : $this->tags;
        $this->nofollow = true;
        $this->follow = false;
        return $this;
    }

    /**
     * 'NOINDEX':The search engine crawler will NOT index that webpages.
     * @return $this
     */
    function noIndex(): MetaData
    {
        $this->tags[] = 'noindex';
        $this->tags = $this->index ? array_diff($this->tags, ['index']) : $this->tags;
        $this->noindex = true;
        $this->index = false;
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
    function canonical(string $canonical): MetaData
    {
        $this->canonical = $canonical;
        return $this;
    }

    /**
     * Get the complete meta data to be displayed
     * @return string|null
     */
    function generate(): ?string
    {
        if ($this->title && $this->description) {
            $tags = implode(',', $this->tags);
            $keyword = implode(",", $this->keywords);
            $open_graph_meta = $this->openGraphMeta();
            $twitter_meta = $this->twitterMeta();
            $tags_exist = count($this->tags) > 0 ? "<meta name=\"robots\" content=\"$tags\">" : '';
            $canonical_exist = $this->canonical ? "<link rel=\"canonical\" href=\"$this->canonical\">" : '';
            $keyword_exist = count($this->keywords) > 0 ? "<link name=\"keywords\" href=\"$keyword\">" : '';
            $author_exist = $this->author ? "<meta name=\"author\" content=\"$this->author\">" : '';
            return <<<META
                <!-- Extra information -->
                <meta name="mobile-web-app-capable" content="yes" />
                <meta name="apple-mobile-web-app-title" content="yes" />
                $keyword_exist
                $author_exist
                $tags_exist
                $canonical_exist
                <!-- Open Grap data-->
                $open_graph_meta
                
                <!-- Twitter Metta Data -->
                $twitter_meta
            META;
        }
        return null;
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
                    <meta property="og:image:secure_url" content="$this->cover" />
                    <meta property="og:image:type" content="image/jpeg">
                    <!-- Size of image. Any size up to 300. Anything above 300px will not work in WhatsApp -->
                    <meta property="og:image:width" content="300">
                    <meta property="og:image:height" content="300">
                IMG;
        $link_exist = $this->link ? "<meta property=\"og:url\" content=\"$this->link\" />" : '';
        $type_exist = $this->link ? "<meta property=\"og:type\" content=\"$this->type\" />" : '';
        $cover_exist = $this->cover ? $cover : '';
        $lang_exist = $this->lang ? "<meta property=\"og:local\" content=\"$this->lang\" />" : '';
        return <<<HTML
                    <meta property="og:site_name" content="Doctawetu" />
                    <meta property="og:title" content="$this->title" />
                    <meta property="og:description" content="$this->description" />
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
        $link_exist = $this->link ? "<meta name=\"twitter:url\" content=\"$this->link\" />" : '';
        $cover_exist = $this->cover ? "<meta name=\"twitter:image\" content=\"$this->cover\" />" : '';
        $lang_exist = $this->lang ? "<meta name=\"twitter:local\" content=\"$this->lang\" />" : '';
        $canonical_exist = $this->canonical ? "<meta name=\"twitter:site\" content=\"$this->canonical\">" : null;
        return <<<HTML
                <meta name="twitter:card" content="summary" />
                <meta name="twitter:title" content="$this->title" />
                <meta name="twitter:description" content="$this->description" />
                $link_exist
                $cover_exist
                $lang_exist
                $canonical_exist
                <meta name="twitter:type" content="article" />
            HTML;
    }

    /**
     * Convert the object to an array
     * @return array
     */
    function toArray(): array
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'link' => $this->link,
            'cover' => $this->cover,
            'tags' => $this->tags,
            'type' => $this->type,
            'lang' => $this->lang,
            'author' => $this->author,
            'keyword' => $this->keywords,
            'canonical' => $this->canonical
        ];
    }
}