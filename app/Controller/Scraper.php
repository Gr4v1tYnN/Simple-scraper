<?php
include('../../public/simplehtmldom/simple_html_dom.php');
include('../Model/Scraper_model.php');
include('../Objects/Article.php');

class Scraper{
    public function scrapDelfiNewest() {
        $scraperModel = new Scraper_model();

        $html = file_get_html("https://www.delfi.lt/archive/latest.php");

        foreach($html->find('div[class=headline headline-lenta]') as $found) {
            $articleUrl = $found->find('a[class=img-link]')[0]->href;
            $articleImgUrl = $found->find('a[class=img-link] img')[0]->getAttribute('data-src');
            $articleTitle = $found->find('h3[class=headline-title] a')[0]->plaintext;
            $articleReadingTime = $found->find('h3[class=headline-title] span')[0]->plaintext;
            $articleBody = $found->find('p[class=headline-lead]')[0]->plaintext;

            $articleTitle = $this->prepareTextForQuery($articleTitle);
            $articleBody = $this->prepareTextForQuery($articleBody);
            $articleData = $this->prepareArticleData($articleTitle, $articleBody, $articleImgUrl, $articleUrl, $articleReadingTime, 'delfi');

            $scraperModel->insertScrapedData($articleData);
        }

        $html->clear();
        unset($html);
    }

    public function scrap15minNewest() {
        $scraperModel = new Scraper_model();

        $html = file_get_html("https://www.15min.lt/naujienos");

        foreach($html->find('article') as $found) {
            $articleUrl = $found->find('a[class=vl-img-container]')[0]->href;
            $articleImgUrl = $found->find('a[class=vl-img-container] img')[0]->getAttribute('data-src');
            $articleTitle = $found->find('h4[class=vl-title item-no-front-style] a')[0]->plaintext;
            $articleReadingTime = $found->find('div[class=reading-time] span[class=ico-text]')[0]->plaintext;
            $articleBody = '';

            $articleTitle = $this->prepareTextForQuery($articleTitle);
            $articleData = $this->prepareArticleData($articleTitle, $articleBody, $articleImgUrl, $articleUrl, $articleReadingTime, '15min');

            $scraperModel->insertScrapedData($articleData);
        }

        $html->clear();
        unset($html);
    }

    private function prepareArticleData($title, $body, $imgUrl, $url, $readingTime, $websiteName){
        $article = new Article();

        $article->setTitle($title);
        $article->setBody($body);
        $article->setImgUrl($imgUrl);
        $article->setUrl($url);
        $article->setReadingTime($readingTime);
        $article->setWebsiteName($websiteName);

        return $article;
    }

    private function prepareTextForQuery($text){
        $text = trim($text);
        $text = str_replace("'", "''", $text);

        return $text;
    }
}