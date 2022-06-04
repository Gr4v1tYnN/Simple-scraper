<?php

class Article{
    private $title;
    private $body;
    private $imgUrl;
    private $url;
    private $readingTime;
    private $websiteName;

    public function setTitle($title){
        $this->title = $title;
    }
    public function setBody($body){
        $this->body = $body;
    }
    public function setImgUrl($imgUrl){
        $this->imgUrl = $imgUrl;
    }
    public function setUrl($url){
        $this->url = $url;
    }
    public function setReadingTime($readingTime){
        $this->readingTime = $readingTime;
    }
    public function setWebsiteName($websiteName){
        $this->websiteName = $websiteName;
    }

    public function getTitle(){
        return $this->title;
    }
    public function getBody(){
        return $this->body;
    }
    public function getImgUrl(){
        return $this->imgUrl;
    }
    public function getUrl(){
        return $this->url;
    }
    public function getReadingTime(){
        return $this->readingTime;
    }
    public function getWebsiteName(){
        return $this->websiteName;
    }
}