<?php
include('../Controller/Scraper.php');

$scrapper = new Scraper();

$scrapper->scrap15minNewest();
$scrapper->scrapDelfiNewest();

header('Location: http://localhost/myProjects/webParser/app/View/main_view.php');