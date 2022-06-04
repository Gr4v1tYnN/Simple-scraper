<?php

class Scraper_model{
    public function insertScrapedData($data) {
        $conn = $this->checkDbConnection();

        $title = $data->getTitle();
        $body = $data->getBody();
        $imgUrl = $data->getImgUrl();
        $url = $data->getUrl();
        $readingTime = $data->getReadingTime();
        $websiteName = $data->getWebsiteName();

        $select = $this->getArticle($title, $url, $websiteName);
        $res = $conn->query($select);

        if ($res->num_rows > 0) {
            $sql = $this->updateArticle($title, $body, $imgUrl, $url, $readingTime, $websiteName);
        } else {
            $sql = $this->insertArticle($title, $body, $imgUrl, $url, $readingTime, $websiteName);
        }

        $conn->query($sql);
        $conn->close();
    }

    public function getArticles() {
        $conn = $this->checkDbConnection();

        $sql = "SELECT * FROM scraped_articles";
        $result = $conn->query($sql);
        $resultArray = $this->prepareResultArray($result);

        $conn->close();

        return $resultArray;
    }

    private function prepareResultArray($result){
        $resultArray = [];

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $resultArray[] = $row;
            }
        }

        return $resultArray;
    }

    private function getArticle($title, $url, $websiteName){
        $sql = "SELECT * 
                FROM scraped_articles
                WHERE title = '{$title}'
                    AND url = '{$url}'
                    AND website_name = '{$websiteName}'
                ";

        return $sql;
    }

    private function updateArticle($title, $body, $imgUrl, $url, $readingTime, $websiteName){
        $sql = "UPDATE scraped_articles 
                    SET
                        body = '{$body}'
                        ,img_url = '{$imgUrl}'
                        ,reading_time = '{$readingTime}'
                    WHERE
                        title = '{$title}'
                        AND url = '{$url}'
                        AND website_name = '{$websiteName}'";

        return $sql;
    }

    private function insertArticle($title, $body, $imgUrl, $url, $readingTime, $websiteName){
        $sql = "INSERT INTO scraped_articles (
                        title
                        ,body
                        ,img_url
                        ,url 
                        ,reading_time
                        ,website_name
                    )
                    VALUES (
                        '{$title}'
                        ,'{$body}'
                        ,'{$imgUrl}'
                        ,'{$url}'
                        ,'{$readingTime}'
                        ,'{$websiteName}'
                    )";

        return $sql;
    }

    private function checkDbConnection(){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "my_projects";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        return $conn;
    }
}
