<?php
include('../Model/Scraper_model.php');

class Main{
    public function getArticles(){
        $scrapperModel = new Scraper_model();

        $articles = $scrapperModel->getArticles();

        return $articles;
    }
}