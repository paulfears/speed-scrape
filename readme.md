# Speed-scrape

a simple php-based tool to help you scrape web pages
## Installation
```php
require_once("scraper.php");
```
### usage

starting the scraper

```php
$scraper = new scraper();
```

retreving simple html

```php
$scraper->get_html("https://google.com"); //url must start with http:// or https://
```
this returns html as a string
and performs the request with a random user-agent selected from the top 10 most common user-agents
all cookies from a request are stored in a local file named cookies.txt

clearing Cookies
```php
$scraper->clear_cookies();
```
and thats it just like that all cookies are cleared


sending a post request
```php
$scraper->post_data("url", key_value_array);
```
Since cookies are automaticly saved that means that after logging on to a site your next request
will be made while still being logged into the website. useful for scraping social networks.




