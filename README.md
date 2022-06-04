# Simple-scraper
Apache 2.4.53, MariaDB 10.4.24, PHP 8.1.6, phpMyAdmin 5.2.0

# Create a database table

CREATE TABLE `scraped_articles` (
  `scraped_articles_id` int(11) NOT NULL,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `body` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `img_url` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` text COLLATE utf8_unicode_ci NOT NULL,
  `reading_time` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

ALTER TABLE `scraped_articles`
  ADD PRIMARY KEY (`scraped_articles_id`);

ALTER TABLE `scraped_articles`
  MODIFY `scraped_articles_id` int(11) NOT NULL AUTO_INCREMENT;
  
 # How it works
 
 The system will start working when you open main_view.php or scraper.php in the browser.
 main_view.php will open the default view page without scraping information from websites.
 scraper.php will parse information from websites and saves it to the database before loading the default view.
